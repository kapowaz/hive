<h2>Development - Change Log</h2>

<p>A history of significant and user-visible changes to the talker.</p>

<?php

	// load the change log...
	$fd = fopen ("dev/ChangeLog", "r");
	$entirelog = "";
	
	while (!feof ($fd))
	{
    	$buffer = fgets($fd, 4096);
	    $entirelog .= $buffer;
	}
	fclose ($fd);
	
	$entries = explode("\n\n", $entirelog);
	
	for ($i=1;$i<count($entries);$i++)
	{
		$entry_info = explode("\n *", $entries[$i]);
		echo "<h4>".ereg_replace("v","Version ",$entry_info[0])."</h4>\n";
		echo "<ul class=\"small\">\n";
		for ($j=1;$j<count($entry_info);$j++)
		{
			echo "<li>".ereg_replace(" \* ","",$entry_info[$j])."</li>";
		}
		echo "</ul>\n";
	}
?>