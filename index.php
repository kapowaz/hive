<?php include_once "inc/common.php"; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>The Hive - <?php echo $pagetitle; ?></title>
	<?php include_once "inc/comments_credits.php"; ?>
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
	</style>
	<link rel="SHORTCUT ICON" href="img/favicon.ico" />
	<link rel="icon" href="img/hive_icon.png" type="image/png" />
	<script language="JavaScript" type="text/javascript" src="inc/functions.js"></script>
</head>

<body>
	<h1 class="hide">The Hive Internet Community</h1>
	
	<div id="main">
		<a href="." title="The Hive : Home" class="noborder"><img src="img/hive_banner.png" width="600" height="110" border="0" alt="The Hive - Internet Community" /></a>
		<?php include_once "inc/global_links.php"; ?>
		<hr noshade="noshade" size="1" />
		<?php include_once "inc/section_links.php"; ?>
			
		<div id="content">
		<?php include_once $content; ?>
		</div>
		
		<?php include_once "inc/w3c.php"; ?>
	</div>
	<!--
	<div id="talkerstatus">Talker Status: <?php /* if (($users = talker_status()) == -1) echo "<span class=\"down\">Down</span>"; else echo "<span class=\"up\">Up</span><br /> Active users: <strong>$users</strong>"; */ ?></div>
	-->
</body>
</html>
