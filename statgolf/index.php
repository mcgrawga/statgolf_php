<?
include 'functions.php';
DisplayGeneralPublicHeader();
?>

<div id="paragraphtext">
<!--<h1>Welcome Golfers</h1>-->

<p>
<?
//
//  PRINT OUT THE TIP OF THE DAY
// 
ConnectToDB();
$sql = "select txt, DATE_FORMAT(dt, '%m/%d/%Y') theDate, title from tip_tbl where dt <= curdate() order by dt desc;";
//printf("SQL:  %s", $sql);
$Tips = mysql_query($sql) or die("Could not get tip info: " . mysql_error());
$row = mysql_fetch_array($Tips);
extract($row);
?>
<b>Golf Tip of the Day</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="NineHoleScoreFont"><?print("$theDate");?></span><br><?print("$txt");?>
<br>Check out all the <a href="#Tips">tips</a>.
<br><br>

<?
$result = GetMostRecentScores(10);
if ($result)
{
	printf("<div style=\"float: right; margin: 0px 0px 0px 25px;\">");
	printf("<table float=\"right\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" width=\"275\">");
	$rowCnt = 0;
	printf("<tr><td colspan=\"5\" align=\"center\" class=\"RecentScoresTableTitle\"><b>Recent Scores</b></td></tr>");
	printf("<tr><td class=\"RecentScoresTDHeader\"><b>Golfer</b></td><td class=\"RecentScoresTDHeader\"><b>Course</b></td><td class=\"RecentScoresTDHeader\"><b>Score</b></td><td class=\"RecentScoresTDHeader\"><b>Date</b></td></tr>");
	while ($row = mysql_fetch_array($result))
	{
		$classname = ($rowCnt % 2) ? 'CourseList2' : 'CourseList1';
		printf("<tr class=\"$classname\">");
		printf("<td class=\"RecentScoresTD\">%s</td>", ucwords(strtolower($row["firstname"])));
		printf("<td class=\"RecentScoresTD\">%s, %s</font></td>", substr(ucwords(strtolower($row["coursename"])), 0, 23), $row["state"]);
		printf("<td class=\"RecentScoresTD\">%s</td>", $row["score"]);
		printf("<td class=\"RecentScoresTD\">%s</td>", $row["dt"]);
		printf("</tr>");
		$rowCnt++;
	}
	printf("</table>");
	printf("</div>");
}
?>

Since 2003 StatGolf has helped golfers of all levels 
improve their golf game by storing a detailed account of each round played.  
You can track everything from courses played to putts made.  StatGolf will 
identify strengths and weaknesses for every part of your game.  StatGolf also provides charts and statistics
to take all the guess work out of improving your game.  


<br><br>StatGolf is <b>free!</b>  You have nothing to lose except a few strokes so go ahead and <a href="newuser.php">sign up now</a>.<br><br>

<p>
Are you interested in saving your course or club a lot of money?  Do you want to improve your club's public image?  Check out our <a href="clubproducts.php">Club Products</a> section.  We offer a USGA compliant handicap system and club websites for half the cost of our competitors.  Plus, we think our products are better!
<br><br>
</p>

<a name="Tips"></a>
<?
while ($row = mysql_fetch_array($Tips))
{
	extract($row);
	?>
	<b><?print("$title");?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="NineHoleScoreFont"><?print("$dt");?></span><br><?print("$txt");?>
	<br><br>
	<?
}
print("</table></p>");
?>


<span class="NineHoleScoreFont"><b>Disclaimer:</b>  StatGolf.com is a free game improvement tool available for use by individuals.  It calculates a non USGA handicap.  It is not an official USGA handicap, and does not use the USGA handicap formula, therefore it can not be used at USGA sanctioned events.  However, the  <a href="products.php">StatGolf Club Handicap System</a> that we offer to USGA licensed clubs is compliant with the USGA handicap system.</span>

</p>
</div>
<?
DisplayCommonFooter();
?>
