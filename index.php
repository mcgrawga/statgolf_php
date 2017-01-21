<?
include 'functions.php';
DisplayGeneralPublicHeader();
?>

<div id="paragraphtext">
<div style="font-size: 1.2em;">
<span style="font-size: 1.3em;">NEWS FLASH:</span>  Check out my new site <a href="https://www.golfingscores.com">golfingscores.com</a> <br> <br>It is a replacement for statgolf.com with better statistics, graphs and game improvement tools.  Free 30 day trial.<br><br>  Statgolf.com will be going away at some point so create an account on <a href="https://www.golfingscores.com">golfingscores.com</a>, let me know the email you registered with and I will move your scores over to the new site.<br><br><br>
</div>

<p>
<?
$result = GetMostRecentScores(10);
if ($result)
{
	printf("<div style=\"float: right; margin: 0px 0px 0px 25px;\">");
	printf("<table float=\"right\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" width=\"275\">");
	$rowCnt = 0;
	printf("<tr><td colspan=\"3\" align=\"center\" class=\"RecentScoresTableTitle\"><b>Recent Scores</b></td></tr>");
	printf("<tr><td class=\"RecentScoresTDHeader\"><b>Course</b></td><td class=\"RecentScoresTDHeader\"><b>Score</b></td><td class=\"RecentScoresTDHeader\"><b>Date</b></td></tr>");
	while ($row = mysql_fetch_array($result))
	{
		$classname = ($rowCnt % 2) ? 'CourseList2' : 'CourseList1';
		printf("<tr class=\"$classname\">");
		printf("<td class=\"RecentScoresTD\">%s, %s</font></td>", 
			substr(ucwords(strtolower($row["coursename"])), 0, 23), 
			ucwords($row["state"]));
			
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


<br><br>You have nothing to lose except a few strokes so go ahead and <a href="newuser.php">sign up now</a>. For $4.99 a month you can record every score from every course.  Having a historical record of all your golf scores will help improve your game.<br><br>
</p>
</div>
<?
DisplayCommonFooter();
?>
