<?php
$asset = $view->helper('Asset');
if($title = $view->title()) {
	$title .= " - Disposeamail.com";
} else {
	$title = "Disposable Email - Disposeable Email - Throw-Away Email - Disposeamail.com";
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title; ?></title>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
	<?php echo $asset->stylesheet('lessframework.css'); ?>
	<?php echo $asset->stylesheet('app.css'); ?>
	<meta name="viewport" content="width=device-width; initial-scale=1" />
	<!-- Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, 
		but keep in mind that it will disable user-zooming completely. Bad for accessibility. -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>

<body>
  <div id="pageWrapper">
	<header>
    	<h1><a href="<?php echo $this->url(array(), 'default'); ?>">Disposeamail.com</a></h1>
    </header>

    <article class="box">
    	<?php echo $content; ?>
    </article>
    
    <article class="box">
    	<p>
    	  <a href="<?php echo $this->url(array(), 'default'); ?>">Home</a> | 
    	  <a href="<?php echo $this->url(array(), 'page_faq'); ?>">F.A.Q.</a>
    	</p>
    </article>

    <footer>
    	<p>Copyright &copy; 2011 Disposable Email - Disposeable Email - Throw-Away Email</p>
    </footer>
	
	<!-- GA Tracker -->
    <script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script> 
	<script type="text/javascript"> 
		var pageTracker = _gat._getTracker("UA-359731-8");
		pageTracker._initData();
		pageTracker._trackPageview();
	</script>
 </div>
</body>
</html>