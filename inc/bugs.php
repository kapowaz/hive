<h2>Development - Bugs Reported</h2>

<p>The following are known reported bugs. Please check to see if the problem you are encountering has been previously reported before you report it yourself.</p>

<ul class="small">
<?php

	// load the change log...
	$fd = fopen ("dev/bug", "r");
	$entirelog = "";
	
	while (!feof ($fd))
	{
    	$buffer = fgets($fd, 4096);
	    $entirelog .= $buffer;
	}
	fclose ($fd);
	
	$entries = explode("\n", $entirelog);
	
	for ($i=count($entries)-2;$i>=0;$i--)
	{
		echo "<li>";
		$entry_info = explode(" - ", $entries[$i], 4);
		$entry_date = $entry_info[0] . ", " . $entry_info[1];
		echo "<em>{$entry_info[2]}</em> ($entry_date)<br />\n".htmlspecialchars($entry_info[3]);
		echo "</li>\n";
	}
?>
</ul>