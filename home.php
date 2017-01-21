<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function DisplayPage()
{
	DisplayCommonHeader();
	printf("<h3>Handicap Index:  <span class=\"RequiredFieldIndicator\">%s</span></h3>",calcHandi());
	
	$sql = "select scores.*, 
		courses.name as name, 
		courses.city as city, 
		courses.state as state,
		tees.name as teename 
		from course_tbl courses, score_tbl scores, tee_tbl tees where courses.userid = ";
	$sql .= $_SESSION['userid']; 
	$sql .= " and tees.courseid = courses.id and scores.teeid = tees.id order by scores.dateplayed desc";
	
	
	//printf("%s", $sql);
	$result = mysql_query($sql) or die("Could not get a list of scores: " . mysql_error());
	
	if ( mysql_num_rows($result) == 0 )
		printf("No scores to report.  <br>Click <a href=\"addscore.php\">here</a> to enter scores.");
	else
	{
		printf("<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">");
		printf("<tr><td class=\"ScoreHistoryTDHeader\">Count</td><td class=\"ScoreHistoryTDHeader\">");
		printf("Date</td>");
		printf("<td class=\"ScoreHistoryTDHeader\">Golf Course</td>");
	        printf("<td class=\"ScoreHistoryTDHeader\">Front</td><td class=\"ScoreHistoryTDHeader\">Back</td><td class=\"ScoreHistoryTDHeader\">Total</td></tr>");
		$rowCnt = 0;
		
		$handiIDArray = array();
		$handiIDArray = getHandiIDArray();
		
		
		
		//printf("<BR>");
		
		/*
		for ( $i = 0; $i < count($handiIDArray); $i++ )
		{
			list($key, $val) = each($handiIDArray);
			printf("%s<br>", $val);
		}
		reset($handiIDArray);
		*/
		
		//print_r($handiIDArray);
		
		$numRounds = 1;
		while ($row = mysql_fetch_array($result))
		{
			$dbDate = $row["dateplayed"];
			$formattedDate = substr($dbDate, 5, 2);
			$formattedDate .= "/";
			$formattedDate .= substr($dbDate, 8, 2);
			$formattedDate .= "/";
			$formattedDate .= substr($dbDate, 0, 4);
			$formattedDate .= "  ";
			$front9 = calcFront($row);
			$back9 = calcBack($row);
			if ( $front9 == 0 )
				$front9 = "N/A";
			else if ( $back9 == 0 )
				$back9 = "N/A";
			$courseNm = $row["name"];
			$courseNm .= "  ";
			$classname = ($rowCnt % 2) ? 'ScoreHistoryTDScores2' : 'ScoreHistoryTDScores1';
			
			//
			//  THIS SECTION IS BEING COMMENTED OUT WHILE I'M ADDING THE NEW TEE IMPLEMENTATION
			//
			
			if ( in_array($row["id"], $handiIDArray) )
				printf("<tr class=\"$classname\"><td>%s</td><td><A HREF=\"scoreadmin.php?scoreID=%s\">%s</a></td><td>%s(%s)</td><td>%s</td><td>%s</td><td><font color=\"red\">%s</font></td></tr>",$numRounds, $row["id"],$formattedDate,$courseNm, $row["teename"], $front9, $back9, $row["score"]);
			else
				printf("<tr class=\"$classname\"><td>%s</td><td><A HREF=\"scoreadmin.php?scoreID=%s\">%s</a></td><td>%s(%s)</td><td>%s</td><td>%s</td><td>%s</td></tr>",$numRounds, $row["id"],$formattedDate,$courseNm, $row["teename"], $front9, $back9, $row["score"]);
			$rowCnt++;
			$numRounds++;
		}
		printf("</table>");
		

		
		printf("<br>A <font color=\"red\">red</font> score means that it has been used to calculate your current handicap.<br>");
		printf("To learn about how a handicap is calculated go <a href=\"http://www.usga.org/handicap/index.html#\">here</a>.");
	}
	DisplayCommonFooter();
}




	if (isset($_POST['LoginUser']))		// Check to see if we should login user
	{
		if ( ValidateCredentials($_POST['Email'], $_POST['Password']) )
			DisplayPage();
	}
	else if (isset($_SESSION['userid']) && isset($_SESSION['paidup']))	// Already logged in and account current?
	{
		DisplayPage();
	}
	else		// Make them login
	{
		?>
		<meta http-equiv="Refresh" content="0; URL=./index.php">
		<?
	}
?>














