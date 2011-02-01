<?php
$asset = $this->helper('Asset');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Disposable Email - Disposeable Email - Throw-Away Email - Disposeamail.com</title>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php echo $asset->stylesheet('lessframework.css'); ?>
	<meta name="viewport" content="width=device-width; initial-scale=1"/>
	<!-- Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, 
		but keep in mind that it will disable user-zooming completely. Bad for accessibility. -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>

<body>
	<div id="pageHead">
    	<h1>Disposeamail.com</h1>
    </div>

    <div id="pageContent">
    	<?php echo $content; ?>
    </div>
    

    <div id="pageFoot">
    	Copyright &copy; 2011 Disposable Email - Disposeable Email - Throw-Away Email
    </div>
	
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
</body>
</html>