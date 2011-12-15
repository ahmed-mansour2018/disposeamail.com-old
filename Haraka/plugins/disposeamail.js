// Example seen at:
// @link https://raw.github.com/maxogden/haraka-couchdb/master/plugins/couchdb.js

var fs = require('fs')
  , sys = require('sys')
  , _ = require('underscore')
  , request = require('request')
  , Buffers = require('buffers')
  , headers = {'content-type':'application/json', 'accept':'application/json'}
  , transactions = {}
  , mysql = require('mysql')
  ;

var client = mysql.createClient({
  host: 'localhost',
  user: 'dismail',
  password: 'dispose0f1t!',
  database: 'dismail'
});

exports.register = function () {
  // Setup
};

function attachment() {
  return function() {
    var bufs = Buffers()
      , doc = {_attachments: {}}
      , filename
      ;
    return {
      start: function(content_type, name) {
        filename = name;
        doc._attachments[filename] = {content_type: content_type.replace(/\n/g, " ")};
      },
      data: function(data) { bufs.push(data) },
      end: function() { if(filename) doc._attachments[filename]['data'] = bufs.slice().toString('base64') },
      doc: function() { return doc }
    }
  }();
}

exports.hook_data = function (next, connection) {
  connection.transaction.parse_body = 1;
  var attach = transactions[connection.transaction.uuid] = attachment();
  connection.transaction.attachment_hooks(attach.start, attach.data, attach.end);
  next();
}

function extractChildren(children) {
  return children.map(function(child) {
    var data = {
      bodytext: child.bodytext,
      headers: child.header.headers_decoded
    }
    if (child.children.length > 0) data.children = extractChildren(child.children);
    return data;
  }) 
}

// Extract message body and return full text or HTML string
// Looks both in raw message body and MIME parts
function extractMessageBody(body) {
  var res;
  var parts = extractChildren(body.children);
  var plen = parts.length;
  if(plen > 0) {
    parts.forEach(function(part) {
      res = res + part.bodytext;
    });
  } else {
    res = body.bodytext;
  }
  return res;
}

function parseSubaddress(user) {
  var parsed = {username: user};
  if (user.indexOf('+')) {
    parsed.username = user.split('+')[0];
    parsed.subaddress = user.split('+')[1];
  }
  return parsed;
}

// Returns date string in MySQL format
function dateToMysqlFormat(md) {
  return md.getFullYear()+'-'+md.getMonth()+1+'-'+md.getDate()+' '+md.getHours()+':'+md.getMinutes()+':'+md.getSeconds();
}

function dateToTimestamp(md) {
  return parseInt(md.getTime()/1000);
}

exports.hook_queue = function(next, connection) {
  var common = transactions[connection.transaction.uuid].doc()
    , body = connection.transaction.body
    , docCounter = 0
    ;
  //connection.logdebug(JSON.stringify(connection.transaction.rcpt_to));
  common['headers'] = body.header.headers_decoded;
  common['bodytext'] = extractMessageBody(body);
  common['content_type'] = body.ct;

  var dbs = connection.transaction.rcpt_to.map(function(recipient) {
    docCounter++;
    var db = {doc: {tags: []}};
    var user = parseSubaddress(recipient.user);
    db.doc.recipient = recipient;
    if (user.subaddress) db.doc.tags.push(user.subaddress);
    db.doc = _.extend({}, db.doc, common);
    return db;
  });
  
  function resolve(err, resp, body) {
    docCounter--;
    if (docCounter === 0) {
      delete transactions[connection.transaction.uuid];
      next(OK); 
    }
  }
  
  dbs.map(function(db) {
    var message = db.doc;

    if(!message.bodytext) {
      connection.loginfo('==' + body.children.length + ' MESSAGE PARTS');
      connection.loginfo(message);
      connection.loginfo(body.children);


      fs.writeFile("/etc/haraka/_mailfail", JSON.stringify(body.children), function(err) {
        if(err) {
          console.log(err);
        } else {
          console.log("The file was saved!");
        }
      }); 

      return next(DENY, "Mail has no body or MIME parts are invalid");
    }

//  connection.loginfo('======= MAIL BODYTEXT --');
//  connection.loginfo(message.bodytext);
    var msgDate = new Date(message.headers.date[0]);

    // Save mail message in mysql
    client.query(
      'INSERT INTO ai_inbox '+
      '(`username`, `to`, `from`, `subject`, `message`, `is_read`, `date_message`, `date_created`) '+
      'VALUES(?, ?, ?, ?, ?, 0, ?, ?)',
      [message.recipient.user, message.recipient.original, message.headers.from[0], message.headers.subject[0], message.bodytext, dateToTimestamp(msgDate), dateToTimestamp(new Date())]
    );
  });
};