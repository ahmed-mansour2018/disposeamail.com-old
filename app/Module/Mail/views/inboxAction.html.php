<?php
$view->title('INBOX for ' . $username . '@disposeamail.com');
?>
<h2>INBOX: <?php echo $username; ?>@disposeamail.com</h2>

<div id="mail_inbox">
<script type="text/javascript"><!--
google_ad_client = "pub-3241315962888840";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
google_ad_channel ="";
google_color_border = "003366";
google_color_bg = "FFFFFF";
google_color_link = "FFFFFF";
google_color_url = "000000";
google_color_text = "000000";
//--></script> 
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> 
</script><br />

<?php
// Using 'datagrid' Generic
$kernel = $view->kernel;
$grid = $view->generic('datagrid')
	->data($mail)
	->column('Subject', function($item) use($view, $kernel, $username) {
		// Build URL from route
		$msgUrl = $view->url(array(
			'module' => 'Mail',
			'action' => 'view',
			'username' => $username,
			'item' => $item->id),
		'inbox_action');
		
		// Reutrn HTML string
		return "<a href='" . $msgUrl . "' title='" . $item->subject . "'>" . $kernel->truncate($item->subject, 40) . "</a>";
	})
	->column('From', function($item) use($kernel) {
		return "<span title='" . $item->from . "'>" . $kernel->truncate($item->from) . "</span>";
	})
	->column('Date', function($item) use($view) {
		return "<nobr>" . $view->toDate($item->date_message) . "</nobr>";
	})
	// Called if dataset is empty
	->noData(function() use($username) {
		return '<p>No mail found for ' . $username . '</p>';
	});

// Rendering is a simple 'echo', just like View templates
echo $grid;
?>
</div>