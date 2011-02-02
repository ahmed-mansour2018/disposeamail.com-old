<?php
$view->title($view->h($msg->subject));
$inboxUrl = $view->url(array('username' => $username), 'inbox');
?>

<a href="<?php echo $inboxUrl; ?>">&lt;&lt; Back to Inbox</a>
<h2><?php echo $view->h($msg->subject); ?></h2>
<p>
  From: &nbsp; <a href="mailto:<?php echo $msg->from; ?>"><?php echo $msg->from; ?></a><br />
  Dated: &nbsp;<?php echo $this->toDate($msg->date_message, 'M d y, H:i:s T'); ?>
</p>

<div id="mail_message">
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


  <?php echo $msg->message; ?>


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
	</script>
</div>

<br />
<a href="<?php echo $inboxUrl; ?>">&lt;&lt; Back to Inbox</a>