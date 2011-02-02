<?php
$view->title('INBOX for ' . $username . '@disposeamail.com');
?>
<h2>INBOX: <?php echo $username; ?>@disposeamail.com</h2>

<div id="mail_inbox">
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