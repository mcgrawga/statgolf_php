<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function DisplayPage()
{
	DisplayCommonHeader();
	printf("<h3>Lifetime Statistics</h3>");
	DisplayQuickStats($_SESSION['userid']);
	
	
	
	
	//printf("<img src=\"colortester.php\" />");
	
		if (count(getLastScores($_SESSION['userid'], 12)) == 0)
			printf("<h3>Graph of Last 12 Scores:  No Data</h3>");
		else
			printf("<img src=\"graph_lastscores.php?num=12\" />");
			
		if (count(getScoreHistory($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Career Trend:  No Data</h3>");
		else
			printf("<img src=\"graph_careertrend.php\" />");
			
		if (count(getAvgScoreByMonth($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Avg Scores:  No Data</h3>");
		else
			printf("<img src=\"graph_scorebymonth.php\" />");
			
		if (count(getPercentFairwaysHitByMonth($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Fairways Hit:  No Data</h3>");
		else
			printf("<img src=\"graph_fairwayshitbymonth.php\" />");
			
		if (count(getAvgPuttsPerGreenByMonth($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Putts Per Green:  No Data</h3>");
		else
			printf("<img src=\"graph_puttspergreenbymonth.php\" />");
			
		if (count(getPenaltiesPerNineHolesByMonth($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Penalties per Round:  No Data</h3>");
		else
			printf("<img src=\"graph_penaltiesbymonth.php\"/>");
			
		if (count(getPercentGreensInRegulationByMonth($_SESSION['userid'])) == 0)
			printf("<h3>Graph of Greens In Regulation:  No Data</h3>");
		else
			printf("<img src=\"graph_girbymonth.php\" />");

	DisplayCommonFooter();
}



	if ($_POST['LoginUser'])		// Check to see if we should login user
	{
		if ( ValidateCredentials($_POST['UserName'], $_POST['Password']) )
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















