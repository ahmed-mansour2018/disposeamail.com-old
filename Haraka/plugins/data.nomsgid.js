// Check whether an email has a Message-Id header or not, and reject if not

exports.hook_data_post = function (next, connection) {
    if (connection.transaction.header.get_all('Message-Id').length === 0) {
        next(DENY, "Mails here must have a Message-Id header");
    }
    else {
        next();
    }
}