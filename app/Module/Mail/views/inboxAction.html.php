<h2>INBOX: <?php echo $username; ?>@disposeamail.com</h2>

<?php
// Using 'datagrid' Generic
$kernel = $this->kernel;
$grid = $this->generic('datagrid')
	->data($mail)
	->column('Subject', function($view, $item) use($kernel, $username) {
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
	->column('From', function($view, $item) use($kernel) {
		return "<span title='" . $item->from . "'>" . $kernel->truncate($item->from) . "</span>";
	})
	->column('Date', function($view, $item) {
		return "<nobr>" . $view->toDate($item->date_message) . "</nobr>";
	});

// Rendering is a simple 'echo', just like View templates
echo $grid;
?>