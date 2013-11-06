<h2>Development - Browse Source</h2>

<?php
if (ereg("file",$_SERVER['QUERY_STRING']))
{
	source_view($_GET['file']);
}
else
{
	talker_version();
	echo "<p>The files listed below are those currently in use on the running server (Version $liveversion).</p>\n";
	
	$rootpath		= "src";						// root path being browsed
	$template_icon	= "img/icon_{ext}_file.png";	// template for icons
	$default_icon	= "img/icon_makefile.png";		// default file icon
	$default_folder	= "img/icon_folder.png";		// default folder icon
	
	// browse_source_dir($rootpath);
	browse_dir($rootpath, "c;h", true, "?browsesrc&file=", "f;s;m"); //, "f;s;m"
}
?>
