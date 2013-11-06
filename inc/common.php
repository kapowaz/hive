<?php
// set error reporting to all errors
error_reporting(E_ALL);

// determine which set of content files to display based on querystring
// e.g. http://www.hivechat.net/?stafflessfaq displays the staffless FAQ
$content = "inc/home.php";
$sectionlinks = "inc/homelinks.php";
$pagetitle = "Internet Community";

// variables for socket functions
$livehost = "195.82.120.231";
$liveport = 6000;

$liveversion = "";
$livecoredate = "";
$livelibdate = "";

$talker_stats = -1;
$talker_stats_values[0] = 0;

// select a page based on only a single word querystring
switch ($_SERVER["QUERY_STRING"])
{
	// about pages...
	// {
	case "about":
		$pagetitle = "About";
		$content = "inc/about.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "faq":
		$pagetitle = "About - Frequently Asked Questions";
		$content = "inc/faq.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "stafflessfaq":
		$pagetitle = "About - Staffless Frequently Asked Questions";
		$content = "inc/stafflessfaq.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "connecting":
		$pagetitle = "About - Connecting";
		$content = "inc/connecting.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "features":
		$pagetitle = "About - Features";
		$content = "inc/features.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "etiquette":
		$pagetitle = "About - Etiquette";
		$content = "inc/etiquette.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "glossary":
		$pagetitle = "About - Glossary of terms";
		$content = "inc/glossary.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	case "credits":
		$pagetitle = "About - Credits";
		$content = "inc/credits.php";
		$sectionlinks = "inc/aboutlinks.php";
		break;
	// }
	
	// community pages...
	// {
	
	/*
	- Conferences
	- Users
	  - Personal Information
	- Groups
	  - Members
	  - Recent Conversation
	  - Topic History
	  - Information
	  - Forum
	- Forums
	  - All Groups
	*/

	case "community":
		$pagetitle = "Community";
		$content = "inc/community.php";
		$sectionlinks = "inc/communitylinks.php";
		break;
	case "users":
		$pagetitle = "Hive Users";
		$content = "inc/users.php";
		$sectionlinks = "inc/communitylinks.php";
		break;
	case "groups":
		$pagetitle = "Community Groups";
		$content = "inc/groups.php";
		$sectionlinks = "inc/communitylinks.php";
		break;
	case "forums":
		$pagetitle = "Discussion Forums";
		$content = "inc/forums.php";
		$sectionlinks = "inc/communitylinks.php";
		break;
	case "conferences":
		$pagetitle = "Conferences";
		$content = "inc/conferences.php";
		$sectionlinks = "inc/communitylinks.php";
		break;
	// }
	
	// development pages...
	// {
	case "dev":
		$pagetitle = "Development";
		$content = "inc/dev.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	case "browsesrc":
		$pagetitle = "Development - Browse Source";
		$content = "inc/browsesrc.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	case "download":
		$pagetitle = "Development - Download the source code";
		$content = "inc/download.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	case "changelog":
		$pagetitle = "Development - Change Log";
		$content = "inc/changelog.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	case "bugs":
		$pagetitle = "Development - Bugs Reported";
		$content = "inc/bugs.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	case "ideas":
		$pagetitle = "Development - Ideas Suggested";
		$content = "inc/ideas.php";
		$sectionlinks = "inc/devlinks.php";
		break;
	// }
	
	// help pages...
	// {
	case "help":
		$pagetitle = "Help";
		$content = "inc/help.php";
		$sectionlinks = "inc/helplinks.php";
		break;
	case "searchhelp":
		$pagetitle = "Search for Help";
		$content = "inc/searchhelp.php";
		$sectionlinks = "inc/helplinks.php";
		break;
	// }
	
	// for testing only...
	case "emoticons":
		$pagetitle = "Emoticons";
		$content = "inc/emoticons.php";
		$sectionlinks = "";
		break;
	default:
		// other possibilities...or just go to the homepage
		if (ereg("browsesrc",$_SERVER['QUERY_STRING']))
		{
			// potentially a file from the source viewer...
			$pagetitle = "Development - Live Source";
			$content = "inc/browsesrc.php";
			$sectionlinks = "inc/devlinks.php";
		}
}

// socket functions - connect to the talker to query the status of the talker

// query the talker and return the stat associated with $statname,
// e.g. "users", or -1 on error
function talker_stats($statname)
{
	global $talker_stats_values;
	flush();
	$errno = 0;
	$errstr = "";
	$fp = fsockopen($GLOBALS['livehost'], $GLOBALS['liveport'], $errno, $errstr, 5);
	$buff = "";
	$statname_value = "";

	if ($GLOBALS['talker_stats'] == -1)
	{
		// the stats haven't been grabbed on this passthrough, grab them now
		if (!$fp )
		{
			return -1;
		}
		else
		{
			fputs($fp, "stats_info\n");
			
			while (!feof($fp))
			{
				$buff .= fgets($fp, 255);
			}
			
			$values = explode("ÿù", $buff);
			$namevalues = explode("\n",$values[1]);
			
			for ($i=0;$i<count($namevalues)-1;$i++)
			{
				list($name,$value) = explode(": ", $namevalues[$i]);
				if (strlen($name) > 1)
				{
					$talker_stats_values[$name] = $value;
				}
			}
			
			// set the talker_stats array status to true
			$GLOBALS['talker_stats'] = true;
			// return the originally requested stat
			return $talker_stats_values[$statname];
			fclose($fp);
		}
	}
	else
	{
		// the stats already exist, return the associated value for the name
		return $talker_stats_values[$statname];
	}
}

// returns the number of users connected or -1 on failure (deprecated)
function talker_status()
{
	flush();
	$errno = 0;
	$errstr = "";
	$fp = fsockopen($GLOBALS['livehost'], $GLOBALS['liveport'], $errno, $errstr, 5);

	if (!$fp )
	{
		return -1;
	}
	else
	{
		fputs($fp, "stats_info\n");
		
		while (!feof($fp))
		{
			$str = "";
			$str = fgets($fp, 255);
		
			if (strlen($str) > 0 && strstr($str, "users:") == $str)
			{
				list($name,$value) = explode(": ", $str);
				$users = $value;
			}
		}
		return $users;
		fclose($fp);
	}
}

// sets the global variables for talker version, code date and lib date
function talker_version()
{
	flush();
	$errno = 0;
	$errstr = "";
	$fp = @fsockopen($GLOBALS['livehost'], $GLOBALS['liveport'], $errno, $errstr, 5);	

	if (!$fp)
	{
		return -1;
	}
	else
	{
		fputs($fp, "version\nquit\n");
		
		while (!feof($fp))
		{
			$str = "";
			$str = fgets($fp, 255);
			if (strlen($str) > 0 && strstr($str, "        hive - Version ") == $str)
			{
				$tmparray = explode("http://", $str);
				$GLOBALS['liveversion'] = trim(ereg_replace("hive - Version","",$tmparray[0]));
			}
			else if (strlen($str) > 0 && strstr($str, "	  Core Server Compiled: ") == $str)
			{
				$tmparray = explode(": ", $str);
				$tmparraytwo = explode("      ", $tmparray[1]);
				$GLOBALS['livecoredate'] = strtotime(trim(ereg_replace("	  Core Server Compiled: ","",$tmparraytwo[0])));
			}
			else if (strlen($str) > 0 && strstr($str, "    Talker Library Compiled: ") == $str)
			{
				$tmparray = explode(": ", $str);
				$tmparraytwo = explode("     			", $tmparray[1]);
				$GLOBALS['livelibdate'] = strtotime(trim(ereg_replace("    Talker Library Compiled: ","",$tmparraytwo[0])));
			}
		}
		fclose($fp);
	}
}

// encodes a string to unicode character entitites
function uniencode($s)
{
    $r = "";
    for ($i=0;$i<strlen($s);$i++) $r.= "&#".ord(substr($s,$i,1)).";";
    return $r;
}

// recursively looks through a directory for any source (*.c, *.h, no extension)
// file and prints information, plus links to display the contents of the file

function geticon($extension)
{
	// returns the appropriate icon according to the passed file extension
	
	global $template_icon;
	global $default_icon;
	
	switch(strtolower($extension))
	{
		case "c":
			return ereg_replace("{ext}","c",$template_icon);
			break;
		case "gif":
			return ereg_replace("{ext}","gif",$template_icon);
			break;
		case "h":
			return ereg_replace("{ext}","h",$template_icon);
			break;
		case "html":
		case "htm":
			return ereg_replace("{ext}","html",$template_icon);
			break;
		case "jpg":
		case "jpeg":
			return ereg_replace("{ext}","jpg",$template_icon);
			break;
		case "log":
			return ereg_replace("{ext}","log",$template_icon);
			break;
		case "mp3":
		case "wav":
		case "aiff":
		case "au":
			return ereg_replace("{ext}","audio",$template_icon);
			break;
		case "php":
		case "phps":
			return ereg_replace("{ext}","php",$template_icon);
			break;
		case "png":
			return ereg_replace("{ext}","png",$template_icon);
			break;
		case "psd":
			return ereg_replace("{ext}","psd",$template_icon);
			break;
		case "swf":
			return ereg_replace("{ext}","swf",$template_icon);
			break;
		case "ttf":
		case "fon":
			return ereg_replace("{ext}","font",$template_icon);
			break;
		case "txt":
		case "text":
			return ereg_replace("{ext}","txt",$template_icon);
			break;
		case "xml":
			return ereg_replace("{ext}","xml",$template_icon);
			break;
		case "xul":
			return ereg_replace("{ext}","xul",$template_icon);
			break;
		default:
			return $default_icon;
	}
}

function filetype_sort($a, $b)
{
	if ((filetype($a) == "dir") && (filetype($b) == "file")) return -1;
	else if ((filetype($a) == "file") && (filetype($b) == "dir")) return 1;
}

function browse_dir($initialpath, $showextensions = "*", $linktofile = true, $relativeto = "", $columns = "f;u;g;s;m", $dateformat = "M d, G:i", $showhidden = false, $shownoextension = false, $showparents = true)
{
	/*
	
	displays the file contents of initialpath, plus all subdirectories
	
	$initialpath: starting path for display
	$showextensions: semi-colon delimited list of file extensions to show
	$linktofile: show the filename as a link to that file
	$relativeto: prefix links to files with this
	$columns: semi-colon delimited list of columns to view
	$showhidden: true/false, show hidden files
	$shownoextension: true/false, show files with no extension
	$showparents: true/false, show parent/self directory links (. and ..)
	
	*/
	
	
	global $rootpath;
	global $default_folder;
	
	$extensions = explode(";",$showextensions);	// determine which extensions are to be shown
	$viewcolumns = explode(";",$columns);		// determine which columns should be shown
	
	$filenames[0] = ""; // initialize an empty array to contain the filenames
	
	/*
		viewcolumns possible values:
			f: file/icon
			u: user information
			g: group information
			s: size
			m: modification date
	*/
	
	if ($dirhandle = @opendir($initialpath))
	{
		// the directory is open...
		if ($rootpath == $initialpath)
		{
			echo "<table id=\"root\" class=\"directory\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\n";			
		}
		else
		{
			echo "<table class=\"directory\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
		}
		
		echo in_array("f",$viewcolumns) ? "\t<th colspan=\"2\">/$initialpath</th>\n" : "";
		echo in_array("u",$viewcolumns) ? "\t<th class=\"user\">Owner</th>\n" : "";
		echo in_array("g",$viewcolumns) ? "\t<th class=\"group\">Group</th>\n" : "";
		echo in_array("s",$viewcolumns) ? "\t<th class=\"size\">Size</th>\n" : "";
		echo in_array("m",$viewcolumns) ? "\t<th class=\"modified\">Modified</th>\n" : "";

		$i = 0;
		// read all the filenames into an array, with the correct preceding path
		while (false !== ($file = @readdir($dirhandle)))
		{
			$filenames[$i++] = $initialpath . "/". $file;
		}
		// sort this array according to file type
		usort($filenames, "filetype_sort");
		// split the array into directories and files
		/*
		$i = 0;
		while (filetype($filenames[$i]) == "dir")
		{
			$dirnames[$i] = $filenames[$i];
			$i++;
		}
		
		$j = 0;
		while (filetype($filenames[$i]) == "file")
		{
			$onlyfilenames[$j] = $filenames[$i];
			$i++;
			$j++;
		}
		
		$filenames = array_merge($dirnames, $onlyfilenames);
		
		//sort($filenames);
		*/
		for ($i=0;$i<count($filenames);$i++)
		{
			// for each file...
			// work out just the filename part for checking later on
			$forwardslashparts = explode("/",$filenames[$i]);

			switch (filetype($filenames[$i]))
			{
				case "dir":
					// show the parent dir stuff
					if (($filenames[$i] == $initialpath . "/." || $filenames[$i] == $initialpath . "/..") && $showparents)
					{
						echo "\t<tr>\n";
						echo in_array("f",$viewcolumns) ? "\t\t<td class=\"icon\"><img src=\"$default_folder\" height=\"16\" width=\"16\" alt=\"\" /></td>\n\t\t<td class=\"filename\">".$forwardslashparts[count($forwardslashparts)-1]."</td>\n" : "";
						echo in_array("u",$viewcolumns) ? "\t\t<td class=\"user\">-</td>\n" : "";
						echo in_array("g",$viewcolumns) ? "\t\t<td class=\"group\">-</td>\n" : "";
						echo in_array("s",$viewcolumns) ? "\t\t<td class=\"filesize\">-</td>\n" : "";
						echo in_array("m",$viewcolumns) ? "\t\t<td class=\"modified\">-</td>\n" : "";
						echo "\t</tr>\n";
					}
					// otherwise recurse the directory, assuming either it's not hidden or hidden files are being shown
					else if (substr($forwardslashparts[count($forwardslashparts)-1],0,1) != "." || $showhidden)
					{
						echo "\t<tr>\n";
						echo "\t\t<td class=\"icon\"><a href=\"#\" onclick=\"toggleTableView('{$filenames[$i]}')\" title=\"collapse\\expand this directory (/{$filenames[$i]})\"><img src=\"$default_folder\" height=\"16\" width=\"16\" alt=\"\" /></a>\n";
						echo "\t\t<td id=\"{$filenames[$i]}\" class=\"subdir\" colspan=\"".(count($viewcolumns))."\">\n";
						echo "\t\t<span><a href=\"#\" onclick=\"toggleTableView('{$filenames[$i]}')\" title=\"collapse\\expand this directory (/{$filenames[$i]})\">{$forwardslashparts[count($forwardslashparts)-1]}</a></span>\n";
						browse_dir($filenames[$i], $showextensions, $linktofile, $relativeto, $columns, $showhidden, $shownoextension);
						echo "\t\t</td>\n";
						echo "\t</tr>\n";
					}
					break;
				case "file":
					// if the file is of the right type then display it...
					$filenameparts = explode(".",$forwardslashparts[count($forwardslashparts)-1]);
					if (count($filenameparts) == 1)
					{
						// filename with no extension
						if ($shownoextension)
						{
							// show this file...
							echo "\t<tr>\n";
							echo in_array("f",$viewcolumns) ? "\t\t<td class=\"icon\"><img src=\"".geticon("")."\" height=\"16\" width=\"16\" alt=\"\" /></td>\n\t\t<td class=\"filename\">".($linktofile ? "<a href=\"$relativeto{$filenames[$i]}\" title=\"View /{$filenames[$i]}\">{$forwardslashparts[count($forwardslashparts)-1]}</a>" : $forwardslashparts[count($forwardslashparts)-1])."</td>\n" : "";
							if (in_array("u",$viewcolumns))
							{
								$fileowner_info = posix_getpwuid(fileowner($filenames[$i]));
								echo "\t\t<td class=\"user\">{$fileowner_info['name']}</td>\n";
							}
							if (in_array("g",$viewcolumns))
							{
								$filegroup_info = posix_getgrgid(filegroup($filenames[$i]));
								echo "\t\t<td class=\"group\">{$filegroup_info['name']}</td>\n";
							}
							if (in_array("s",$viewcolumns))
							{
								$filesizekb = round(filesize($filenames[$i])/1024,1);
								
								echo "\t\t<td class=\"filesize\">";
								echo $filesizekb > 999 ? round($filesizekb/1024,1) . " Mb" : $filesizekb . " Kb";
								echo "</td>\n";
							}
							echo in_array("m",$viewcolumns) ? "\t\t<td class=\"modified\">".date($dateformat,filectime($filenames[$i]))."</td>\n" : "";
							echo "\t</tr>\n";
						}
						// otherwise skip it...
					}
					else if ((in_array($filenameparts[count($filenameparts)-1],$extensions) || $showextensions == "*") && ($showhidden || substr($forwardslashparts[count($forwardslashparts)-1],0,1) != "."))
					{
						// show this file...
						
						echo "\t<tr>\n";
						echo in_array("f",$viewcolumns) ? "\t\t<td class=\"icon\"><img src=\"".geticon($filenameparts[count($filenameparts)-1])."\" height=\"16\" width=\"16\" alt=\"\" /></td>\n\t\t<td class=\"filename\">".($linktofile ? "<a href=\"$relativeto{$filenames[$i]}\" title=\"View /{$filenames[$i]}\">{$forwardslashparts[count($forwardslashparts)-1]}</a>" : $forwardslashparts[count($forwardslashparts)-1])."</td>\n" : "";
						if (in_array("u",$viewcolumns))
						{
							$fileowner_info = posix_getpwuid(fileowner($filenames[$i]));
							echo "\t\t<td class=\"user\">{$fileowner_info['name']}</td>\n";
						}
						if (in_array("g",$viewcolumns))
						{
							$filegroup_info = posix_getgrgid(filegroup($filenames[$i]));
							echo "\t\t<td class=\"group\">{$filegroup_info['name']}</td>\n";
						}
						if (in_array("s",$viewcolumns))
						{
							$filesizekb = round(filesize($filenames[$i])/1024,1);
							
							echo "\t\t<td class=\"filesize\">";
							echo $filesizekb > 999 ? round($filesizekb/1024,1) . " Mb" : $filesizekb . " Kb";
							echo "</td>\n";
						}
						echo in_array("m",$viewcolumns) ? "\t\t<td class=\"modified\">".date($dateformat,filectime($filenames[$i]))."</td>\n" : "";
						echo "\t</tr>\n";
					}
					break;
				case "link":
				case "block":
				case "fifo":
				case "char":
				case "unknown":
					// do absolutely nothing with these
					;
			}
		}
		echo "</table>\n";
		closedir($dirhandle);
	}
}

// code patterns to search for and replace with.

$search_pattern_before = array("        ", "\t");
$search_replace_before = array("\t", "    ");
$search_pattern_after = array("\/\*", "\*\/", "while", "for", "do ", "else if", "else", "if", "return ", "function", "void", "int", "long", "float", "double");
$search_replace_after = array("<span class=\"cm\">/*", "*/</span>", "<span class=\"kw\">while</span>", "<span class=\"kw\">for</span>", "<span class=\"kw\">do </span>", "<span class=\"kw\">else if</span>", "<span class=\"kw\">else</span>", "<span class=\"kw\">if </span>", "<span class=\"kw\">return </span>", "<span class=\"kw\">function</span>", "<var>void</var>", "<var>int</var>", "<var>long</var>", "<var>float</var>", "<var>double</var>");

// run through replacement pattern lists for a fragment of code

function source_replace($srcfragment, $stage = "after")
{
	global $search_pattern_after;
	global $search_replace_after;
	global $search_pattern_before;
	global $search_replace_before;
	
	if ($stage == "before")
	{
		for ($i=0;$i<count($search_pattern_before);$i++) $srcfragment = ereg_replace($search_pattern_before[$i], $search_replace_before[$i], $srcfragment);
	}
	else
	{
		for ($i=0;$i<count($search_pattern_after);$i++) $srcfragment = ereg_replace($search_pattern_after[$i], $search_replace_after[$i], $srcfragment);
	}
	return $srcfragment;
}

// show the source code from the specified file

function source_view($srcpath, $colwidth = 80)
{
	// check that the file exists, and is being requested within the source dir
	if (file_exists($srcpath) && substr($srcpath,0,3) == "src")
	{
		// display it
		echo "<p>Browsing /".$srcpath." ... <br />\nSize: ".round(filesize($srcpath)/1024,1)." Kb<br />\nLast modified: ".date("M d, G:i",filectime($srcpath))."<br /></p>\n<p><a href=\"?browsesrc\">Back to the source listing</a></p>\n";
		echo "<p class=\"small\">N.B: this source is forcibly wrapped at $colwidth characters - the ¬ symbol is used to denoted the point at which the code was wrapped.</p>\n";
		echo "<pre class=\"source\">";
		$fd = @fopen($srcpath,"r") or die("Permission denied opening /$srcpath\n");
		
		$strfilecontents = "";
		
		while (!feof($fd))
		{
			$buf = fgets($fd);
			if (ereg("#define ADMIN_PASSWORD", $buf))
			{
				$defineparts = explode("\"",$buf, 2);
				$buf = $defineparts[0] . "\"********\"\n";
				// $strfilecontents .= wordwrap($buf,$colwidth," ¬\n ");
				$strfilecontents .= source_replace($buf, "before");
			}
			else
			{
				// $strfilecontents .= wordwrap($buf,$colwidth," ¬\n ");
				$strfilecontents .= source_replace($buf, "before");
			}
		}
		
		$lines = explode("\n",trim($strfilecontents));
		$linenumberwidth = strlen(count($lines)."");
		
		for ($i=0;$i<count($lines);$i++)
		{
			echo "<span class=\"ln\" id=\"line".($i+1)."\">";
			for ($j=strlen(($i+1)."");$j<$linenumberwidth;$j++) echo "0";
			echo ($i+1)."</span> ".source_replace(htmlspecialchars($lines[$i]))."\n";
		}
		
		// echo $strfilecontents;
		
		echo "</pre>\n";
	}
	else
	{
		// some error message...
		echo "<p>The file /".$srcpath." doesn't appear to exist.</p>\n<p><a href=\"?browsesrc\">Back to the source listing</a></p>\n";
	}
}
?>
