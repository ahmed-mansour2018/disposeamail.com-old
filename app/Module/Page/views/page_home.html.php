<?php
$form = $this->helper('form');
?>

<section>
	<form action="<?php echo $this->url(array('module' => 'mail', 'action' => 'inbox'), 'module_action'); ?>" method="post">
	  <?php echo $form->text('username'); ?>
	  <button type="submit">Check Mail</button>
	</form>
</section>

<section>
	<h2>Free Temporary and Disposable Email Accounts</h2>
	<p>Sick and tired of getting spam? Do you hate being forced to disclose your email address for ridiculous reasons? Get a disposable email address!</p>

	<h2>Get a temporary disposable email address!</h2>
	<p>With Disposeamail, you will never have worry about revealing your personal email address again. Simply enter your email address as <b><em>anything</em>@disposeamail.com</b>. Then, login into your AI inbox and read your email. No sign-up necessary!</p>
	<p>So, what are you waiting for? <em>Create your Disposeamail now!</em></p>
</section>