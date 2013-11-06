<h2>Development - Ideas Submitted</h2>

<p>The following are ideas suggested by users of The Hive. If you have an idea for a feature for the talker, be that a command, a game, or a more general concept, feel free to suggest it using the idea command.</p>

<?php

	// load the change log...
	$fd = fopen ("dev/idea", "r") or die();
	$entirelog = "";
	
	while (!feof ($fd))
	{
    	$buffer = fgets($fd, 4096);
	    $entirelog .= $buffer;
	}
	fclose ($fd);
	
	$entries = explode("\n\n", $entirelog);
	
	$smalltasks = $entries[1];
	$largerprojects = $entries[3];
	$newideas = $entries[5];
	
	echo "<h3>New Ideas</h3>\n<ul class=\"small\">\n";
	
	$entries = explode("\n", $newideas);
	
	for ($i=count($entries)-2;$i>=0;$i--)
	{
		echo "<li>";
		$entry_info = explode(" - ", $entries[$i], 4);
		$entry_date = $entry_info[0] . ", " . $entry_info[1];
		echo "<em>{$entry_info[2]}</em> ($entry_date)<br />\n".htmlspecialchars($entry_info[3]);
		echo "</li>\n";
	}
	
	echo "</ul>\n\n<h3>Small Tasks</h3>\n<ul class=\"small\">\n";
	
	$entries = explode("\n", $smalltasks);
	
	for ($i=count($entries)-2;$i>=0;$i--)
	{
		echo "<li>";
		$entry_info = explode(" - ", $entries[$i], 4);
		$entry_date = $entry_info[0] . ", " . $entry_info[1];
		echo "<em>{$entry_info[2]}</em> ($entry_date)<br />\n".htmlspecialchars($entry_info[3]);
		echo "</li>\n";
	}
	
	echo "</ul>\n\n<h3>Larger Projects</h3>\n<ul class=\"small\">\n";
	
	$entries = explode("\n", $largerprojects);
	
	for ($i=count($entries)-2;$i>=0;$i--)
	{
		echo "<li>";
		$entry_info = explode(" - ", $entries[$i], 4);
		$entry_date = $entry_info[0] . ", " . $entry_info[1];
		echo "<em>{$entry_info[2]}</em> ($entry_date)<br />\n".htmlspecialchars($entry_info[3]);
		echo "</li>\n";
	}
?>