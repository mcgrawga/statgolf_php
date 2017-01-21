<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function DisplayPage()
{

	$TeeID = $_GET['teeid'];
	DisplayCommonHeader();
	printf("<h3>Historical Statistics for %s</h3>", getCourseAndTeeName($TeeID));
	
		if (count(getLastScores($_SESSION['userid'], 12, $TeeID)) == 0)
			printf("<h3>Graph of Last 12 Scores:  No Data</h3>");
		else
			printf("<img src=\"graph_lastscores.php?teeid=$TeeID&num=12\" />");
			
		$NumScores = 12;
		$LastFewScores = array();
		$LastFewScores = getDatesAndIds($_SESSION['userid'], $NumScores, $TeeID);
		
		
		//
		//  FAIRWAYS HIT
		//
		//PrintArray($LastFewScores);
		$graphData = array();
		foreach( $LastFewScores as $key => $value)
		{
				$val = getPercentFairways($value);
				if ($val != "N/A")
					$graphData[$key] = $val;
		}
		//PrintArray($graphData);
		if (count($graphData) == 0)
			printf("<h3>Graph of Fairways Hit:  No Data</h3>");
		else
			printf("<img src=\"graph_fairwayshit.php?teeid=$TeeID&num=12\" />");
			
			
			
		//
		//  GREENS IN REGULATION
		//
		//PrintArray($LastFewScores);
		$graphData = array();
		reset($LastFewScores);
		foreach( $LastFewScores as $key => $value)
		{
				$val = getPercentGIR($value);
				if ($val != "N/A")
					$graphData[$key] = $val;
		}
		//PrintArray($graphData);
		if (count($graphData) == 0)
			printf("<h3>Graph of Greens in Regulation:  No Data</h3>");
		else
			printf("<img src=\"graph_gir.php?teeid=$TeeID&num=12\" />");
			
			
			
		//
		//  PUTTS PER GREEN
		//
		//PrintArray($LastFewScores);
		$graphData = array();
		reset($LastFewScores);
		foreach( $LastFewScores as $key => $value)
		{
				$val = getPuttsPerGreen($value);
				if ($val != "N/A")
					$graphData[$key] = $val;
		}
		//PrintArray($graphData);
		if (count($graphData) == 0)
			printf("<h3>Graph of Putts Per Green:  No Data</h3>");
		else
			printf("<img src=\"graph_puttspergreen.php?teeid=$TeeID&num=12\" />");
			
			
		//
		//  PENALTIES PER NINE PER ROUND
		//
		//PrintArray($LastFewScores);
		$graphData = array();
		reset($LastFewScores);
		foreach( $LastFewScores as $key => $value)
		{
				$val = getPenaltiesPerNineForRound($value);
				if ($val != "N/A")
					$graphData[$key] = $val;
		}
		//PrintArray($graphData);
		if (count($graphData) == 0)
			printf("<h3>Graph of Penalties:  No Data</h3>");
		else
			printf("<img src=\"graph_penaltiespernine.php?teeid=$TeeID&num=12\" />");
			
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















