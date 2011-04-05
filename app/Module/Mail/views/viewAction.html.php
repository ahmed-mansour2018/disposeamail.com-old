<?php
$view->title($view->h($msg->subject));
$inboxUrl = $view->url(array('username' => $username), 'inbox');
?>

<a href="<?php echo $inboxUrl; ?>">&lt;&lt; Back to Inbox</a>
<h2><?php echo $msg->getSubject(); ?></h2>
<p>
  From: &nbsp; <a href="mailto:<?php echo $msg->from; ?>"><?php echo $msg->from; ?></a><br />
  Dated: &nbsp;<?php echo $this->toDate($msg->date_created, 'M d y, H:i:s T'); ?>
</p>

<div id="mail_message">
  <?php echo $msg->getMessage(); ?>
</div>

<br />
<a href="<?php echo $inboxUrl; ?>">&lt;&lt; Back to Inbox</a>