<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>The Hive</title>
	<?php include_once "inc/credits.php"; ?>
	<link rel="stylesheet" type="text/css" href="style/basic.css" />
	<?php
		// output Mozilla-specific styles if the user agent matches
		// Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.2b) Gecko/20021016
		if (ereg("Mozilla/5.",$_SERVER['HTTP_USER_AGENT']) && ereg("Gecko",$_SERVER['HTTP_USER_AGENT']))
		{
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/mozilla.css\" />";
		}
	?>
	<style type="text/css" media="all">
		@import url(style/advanced.css);
		body { background-image:url(<?php echo $_GET['image']; ?>); }
	</style>
</head>

<body>
	<p <?php echo (ereg("Mozilla/4",$_SERVER['HTTP_USER_AGENT']) && !ereg("compatible;",$_SERVER['HTTP_USER_AGENT'])) ? "" : "class=\"hide\""; ?>>If you cannot see the image here, you may not have a browser that properly supports cascading style sheets or understands the Portable Network Graphic (PNG) format. You can try to <a href="<?php echo $_GET['image']; ?>" target="_blank" title="Load the image &ldquo;<?php echo $_GET['image']; ?>&rdquo; in a separate window">view the image</a> independently if you wish.</p>
</body>
</html>