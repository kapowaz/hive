<?php
/*
// for future reference, this is how you can spot Netscape 4.x...
if (ereg("Mozilla/4",$_SERVER['HTTP_USER_AGENT']) && !ereg("compatible;",$_SERVER['HTTP_USER_AGENT'])) echo "<h2>Found a horrid old Netscape!</h2>\n";
*/
?><h2>Connecting to The Hive</h2>

<p>So you've read the introduction, perused the <a href="?stafflessfaq" title="Staffless Talker? Frequently Asked Questions...">frequently asked questions</a> and now you're interesting in giving The Hive a go? Assuming you are in familiar territory you can go right ahead and <a href="<?php echo talker_stats("connect"); ?>">connect</a> using telnet. But if you're new to all this, we've prepared a short guide to get you started...</p>

<h2>Windows</h2>

<p>Depending on which version of Windows you are using, there are several choices. For Windows 95/98/Me and Windows NT the telnet application is somewhat limited and doesn't support colour. For Windows 2000 and XP there is an slightly improved telnet program which does support colour. In both cases these can be accessed by choosing Run from the Start Menu and typing &ldquo;telnet&rdquo;. You will probably want to set <a href="#" onclick="toggleDisplay('localecho');return false;" title="Setting local echo for Windows Telnet (opens below)">local echo</a> so that you can see what you are typing.</p>

<div id="localecho" <?php print ereg("Opera",$_SERVER['HTTP_USER_AGENT']) || (ereg("Mozilla/4",$_SERVER['HTTP_USER_AGENT']) && !ereg("compatible;",$_SERVER['HTTP_USER_AGENT']))? "" : "style=\"display:none;\""; // opera bodge... ?>>
	<h3>Setting local echo for Windows Telnet</h3>
	
	<ul>
		<li>
			<h4>Windows 95/98/Me/NT</h4>
	
			<p>Unfortunately due to limitations with the Windows Telnet program with these versions of Windows, you have to turn local echo on before connecting to The Hive, otherwise the setting will not be enabled. To do this, open the Telnet program and from the <em>Terminal</em> menu choose <em>Preferences</em>. You should now have a dialog box asking for your preferences. Ensure that <em>Local Echo</em> is ticked, then click OK. All future sessions will now have local echo turned on.</p>
		</li>
		<li>
			<h4>Windows 2000/XP</h4>
	
			<p>The Telnet program provided with Windows 2000 and Windows XP is a massive improvement over previous versions, but it can still prove somewhat confusing for the inexperienced user. If you are currently connected to The Hive, you will need to enter the settings mode to enable Local Echo. You can enter this by typing <code>CTRL-]</code> together. If you aren't currently connected anywhere, you will automatically be in this mode.</p>
			<a href="javascript:popup(331,668,'img/screenshot_win2k_telnet.png');" title="Windows 2000/XP Telnet - view full size (10Kb)"><img src="img/screenshot_win2k_telnet_sm.png" width="220" height="109" alt="Windows 2000/XP Telnet Screenshot" border="0" class="caption" /></a> <p class="small">Windows 2000/XP Telnet - <a href="javascript:popup(331,668,'img/screenshot_win2k_telnet.png');" title="Windows 2000/XP Telnet - view full size (10Kb)">view full size</a> (10Kb)</p>
			<p>Once you are in settings mode, you can then enable local echo by typing <code>SET LOCAL_ECHO</code> and pressing return. To get back to The Hive press <code>CTRL-]</code> again and local echo will now be set. Unfortunately this setting is not remembered next time you open the telnet program.</p>
		</li>
	
		<li>
			<h4>What is Local Echo anyway?</h4>
			<p>Connecting to talkers via telnet dates back to the good old days of computing when most programs ran over <em>Terminal Emulation</em> (which is where the name telnet originates, <em>T</em>erminal <em>E</em>mu<em>l</em>ation via <em>Net</em>work). On such systems, user input was typed into a text-only display much like a DOS Command Prompt, which would then be sent to a server to be processed, and whatever output was generated would be sent back to the user's terminal. This is pretty much how The Hive works.</p>
	
			<p>Since some programs would interpret the user's commands directly rather than display them on screen, local echo is necessary to filter out what should and should not be displayed. For example in a mail program (such as pine) you might type the letter &ldquo;q&rdquo; to quit. You wouldn't however want to see it appear on-screen, since the program would simply be interpreting it as a command. Unfortunately in these days of &ldquo;modern&rdquo; operating systems like Windows, such features are often deemed unnecessary (who uses telnet <em>anyway?</em>) and so the telnet programs supplied with them are for the most part inadequate.</p>
		</li>
	</ul>
	<p class="small"><?php print ereg("Opera",$_SERVER['HTTP_USER_AGENT']) || (ereg("Mozilla/4",$_SERVER['HTTP_USER_AGENT']) && !ereg("compatible;",$_SERVER['HTTP_USER_AGENT'])) ? "" : "<a href=\"#\" onclick=\"toggleDisplay('localecho');return false;\" title=\"Hide this again\">Hide</a>"; // opera bodge... ?></p>
</div>

<p>For Windows 95/98/Me/NT, once you have loaded the program, go to the <em>Connect</em> menu and select <em>Remote System</em>. From here, enter <em>hivechat.net 6000</em> then select OK to open the connection.</p>

<p>For Windows 2000/XP, simply type <code>open hivechat.net 6000</code> from the <code>Telnet&gt;</code> prompt and a connection will be opened.</p>

<p>There are many alternative third-party telnet clients available for Windows computers, in our experience the best of these is <a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html" target="_blank" title="PuTTY - telnet/SSH client for Windows">PuTTY</a>. This program is stable, fast, uses very little memory and best of all doesn't require installation - you can even run the program from a floppy disk if necessary!</p>

<a href="javascript:popup(435,426,'img/screenshot_putty.png');" title="PuTTY Configuration Screenshot - view full size (13Kb)"><img src="img/screenshot_putty_sm.png" width="141" height="144" alt="PuTTY Configuration Screenshot" border="0" class="caption" /></a> <p class="small">PuTTY Configuration Screenshot - <a href="javascript:popup(435,426,'img/screenshot_putty.png');" title="PuTTY Configuration Screenshot - view full size (13Kb)">view full size</a> (13Kb)</p>

<p>To use this program simply download the file <em>putty.exe</em> from the above site to your computer, then run it. In the configuration window that appears, enter <em>hivechat.net</em> as the hostname, and <em>6000</em> as the port. You can leave the rest of the settings as they are, although you can of course experiment with them to suit your taste. The PuTTY documentation can also advise you on how to set up a profile for connecting to The Hive so that you can save your preferences.</p>

<h2>Macintosh</h2>

<p>If you are using a version of Mac OS prior to Mac OS X, you are unfortunately out of luck - there simply is no telnet program supplied with this version and you will have to either download a decent third-party application, or <?php /* use the <a href="#java" title="Connecting with Java">Java</a> client instead, detailed further down the page */ ?> wait for the forthcoming web client. A good third-party client for Mac OS 9 and earlier is <a href="http://www.rapscallion.co.uk/" title="Rapscallion - telnet and MUD client for Mac OS" target="_blank">Rapscallion</a>.<?php /* [insert instructions for using rapscallion here!] */ ?></p>

<p>On the other hand, if you are fortunate enough to be using Mac OS X, you can use the supplied terminal application to connect to The Hive. Simply open the terminal and type <code>telnet hivechat.net 6000</code>.</p>

<p>If you are feeling adventurous, you could even try installing the seasoned talker user's client of choice, <a href="http://www.muq.org/~hawkeye/tf/" title="Tiny Fugue" target="_blank">Tiny Fugue</a>. Instructions on how to install this program are available on the Tiny Fugue <a href="http://www.muq.org/~hawkeye/tf/" title="Tiny Fugue" target="_blank">website</a>.</p>

<h2>Unix</h2>

<p>Chances are if you are using some flavour of Unix such as GNU/Linux, HP-UX or some kind of BSD, you will already be familiar with the many different terminals available for your operating system. Launch your favourite terminal program and type <code>telnet hivechat.net 6000</code> to connect. Alternatively of course you may wish to try the excellent <a href="http://www.muq.org/~hawkeye/tf/" title="Tiny Fugue" target="_blank">Tiny Fugue</a> MUD client, which provides some very useful features for connecting to talkers such as The Hive.</p>

<?php /*

as and when they are done!

<h2>Java</h2>

<p>[connecting with the java client?]</p>

<h2>HTML</h2>

<p>[connecting with the HTML client?]</p>

*/ ?>
