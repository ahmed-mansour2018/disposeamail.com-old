<h2>INBOX for <?php echo $username; ?></h2>

<?php
// Using 'datagrid' Generic
$kernel = $this->kernel;
$grid = $this->generic('datagrid')
	->data($mail)
	->column('Subject', function($view, $item) use($kernel) {
		$msgUrl = $view->url(array('module' => 'Mail', 'action' => 'view', 'id' => $item->id), 'module_action');
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