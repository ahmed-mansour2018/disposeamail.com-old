<?php
$form = $this->helper('form');
$request = $this->kernel->request();
?>

<section>
	<form action="<?php echo $this->url(array('module' => 'mail', 'action' => 'user'), 'module_action'); ?>" method="post">
	  <?php echo $form->text('username', $request->username, array('class' => 'email_username')); ?>
	  <label for="username">@disposeamail.com</label>

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
		//-->
	  </script>
	  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

	  <input type="submit" class="submit" value="Check Mail" />
	</form>
</section>

<section>
	<h2>Free Temporary and Disposable Email Accounts</h2>
	<p>Sick and tired of getting spam? Do you hate being forced to disclose your email address for ridiculous reasons? Get a disposable email address!</p>

	<h2>Get a temporary disposable email address!</h2>
	<p>With Disposeamail, you will never have worry about revealing your personal email address again. Simply enter your email address as <b><em>anything</em>@disposeamail.com</b>. Then, login into your AI inbox and read your email. No sign-up necessary!</p>
	<p>So, what are you waiting for? <em>Create your Disposeamail now!</em></p>
</section>