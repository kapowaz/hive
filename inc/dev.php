<h2>Development</h2>

<?php // talker_version(); ?>
<!--
<p class="small">
	<em>Talker version:</em> <?php echo $liveversion; ?><br />
	<em>Core loaded:</em> <?php echo date("l jS F Y, g:i a", $livecoredate); ?><br />
	<em>Library loaded:</em> <?php echo date("l jS F Y, g:i a", $livelibdate); ?><br />
</p>
-->

<h3>Please note: The Hive is not a basecode and is not suitable to be used as one.</h3>

<p>If you are interested in the development behind the scenes of The Hive, then you can find out more here.</p>
<p>The links above can take you to the respective idea, bug and change logs, or to the source code, which can be downloaded as an archive or browsed live.</p>

<?php
/*

for c in `find /home/hive/hive/src/|grep \.c$`
	do let "countc = `wc -l $c|awk '{print $1}'`"
	let "totalc = $totalc + $countc"
	done
for h in `find /home/hive/hive/src/|grep \.h$`
	do let "hcount = `wc -l $h|awk '{print $1}'`"
	let "htotal = $htotal + $hcount"
        done
let "total = $totalc + $htotal"

echo "Current Source:"
echo "<table CELLSPACING=\"0\" CELLPADDING=\"0\" ALIGN=\"LEFT\" BORDER=\"0\" WIDTH=\"30%\">"
echo "<tr>"
echo "<td>Total lines in header files</td>"
echo "<td>$htotal</td>"
echo "</tr>"
echo "<tr>"
echo "<td>Total lines in c files</td>"
echo "<td>$totalc</td>"
echo "</tr>"
echo "<tr>"
echo "<td>Total lines of code</td>"
echo "<td>$total</td>"

*/
?>
