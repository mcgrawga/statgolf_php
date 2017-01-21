<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function validatePostVar($a)
{
	if ( $a == "" )
		$a = "null";
	return $a;
}

function DisplayPage()
{
	DisplayCommonHeader();
	printf("<br><br><h3>Score Detail.</h3>");
	if ($_POST["UpdateScore"])
	{
	/*
	
		if ( 	!( $_POST["par1"] && $_POST["par2"] && $_POST["par3"] && $_POST["par4"] && $_POST["par5"] && $_POST["par6"] && $_POST["par7"] && $_POST["par8"] && $_POST["par9"] && $_POST["par10"] && $_POST["par11"] && $_POST["par12"] && $_POST["par13"] && $_POST["par14"] && $_POST["par15"] && $_POST["par16"] && $_POST["par17"] && $_POST["par18"] ) && 
			!( $_POST["par1"] && $_POST["par2"] && $_POST["par3"] && $_POST["par4"] && $_POST["par5"] && $_POST["par6"] && $_POST["par7"] && $_POST["par8"] && $_POST["par9"]) && 
			!( $_POST["par10"] && $_POST["par11"] && $_POST["par12"] && $_POST["par13"] && $_POST["par14"] && $_POST["par15"] && $_POST["par16"] && $_POST["par17"] && $_POST["par18"] ) )
		{
			printf("here");
			printf("You must enter a complete front 9, a complete back 9 or a complete 18 hole score.");
			return;
		}
			
	*/
		$SCORE_TYPE = "";
		if ( $_POST["par1"] && $_POST["par2"] && $_POST["par3"] && $_POST["par4"] && $_POST["par5"] && $_POST["par6"] && $_POST["par7"] && $_POST["par8"] && $_POST["par9"] && $_POST["par10"] && $_POST["par11"] && $_POST["par12"] && $_POST["par13"] && $_POST["par14"] && $_POST["par15"] && $_POST["par16"] && $_POST["par17"] && $_POST["par18"] )
			$SCORE_TYPE = "FB";
		else if (( $_POST["par1"] && $_POST["par2"] && $_POST["par3"] && $_POST["par4"] && $_POST["par5"] && $_POST["par6"] && $_POST["par7"] && $_POST["par8"] && $_POST["par9"]) && (!$_POST["par10"] && !$_POST["par11"] && !$_POST["par12"] && !$_POST["par13"] && !$_POST["par14"] && !$_POST["par15"] && !$_POST["par16"] && !$_POST["par17"] && !$_POST["par18"]))
			$SCORE_TYPE = "F";
		else if ((!$_POST["par1"] && !$_POST["par2"] && !$_POST["par3"] && !$_POST["par4"] && !$_POST["par5"] && !$_POST["par6"] && !$_POST["par7"] && !$_POST["par8"] && !$_POST["par9"]) && ( $_POST["par10"] && $_POST["par11"] && $_POST["par12"] && $_POST["par13"] && $_POST["par14"] && $_POST["par15"] && $_POST["par16"] && $_POST["par17"] && $_POST["par18"]))
			$SCORE_TYPE = "B";
		else
		{
			printf("You must enter a complete front 9, a complete back 9 or a complete 18 hole score.  No partials");
			return;
		}
			
		if ( $SCORE_TYPE == "FB")
		{
			$par1 = validatePostVar( $_POST["par1"] );
			$par2 = validatePostVar( $_POST["par2"] );
			$par3 = validatePostVar( $_POST["par3"] );
			$par4 = validatePostVar( $_POST["par4"] );
			$par5 = validatePostVar( $_POST["par5"] );
			$par6 = validatePostVar( $_POST["par6"] );
			$par7 = validatePostVar( $_POST["par7"] );
			$par8 = validatePostVar( $_POST["par8"] );
			$par9 = validatePostVar( $_POST["par9"] );
			$putt1 = validatePostVar( $_POST["putt1"] );
			$putt2 = validatePostVar( $_POST["putt2"] );
			$putt3 = validatePostVar( $_POST["putt3"] );
			$putt4 = validatePostVar( $_POST["putt4"] );
			$putt5 = validatePostVar( $_POST["putt5"] );
			$putt6 = validatePostVar( $_POST["putt6"] );
			$putt7 = validatePostVar( $_POST["putt7"] );
			$putt8 = validatePostVar( $_POST["putt8"] );
			$putt9 = validatePostVar( $_POST["putt9"] );
			$par10 = validatePostVar( $_POST["par10"] );
			$par11 = validatePostVar( $_POST["par11"] );
			$par12 = validatePostVar( $_POST["par12"] );
			$par13 = validatePostVar( $_POST["par13"] );
			$par14 = validatePostVar( $_POST["par14"] );
			$par15 = validatePostVar( $_POST["par15"] );
			$par16 = validatePostVar( $_POST["par16"] );
			$par17 = validatePostVar( $_POST["par17"] );
			$par18 = validatePostVar( $_POST["par18"] );
			$putt10 = validatePostVar( $_POST["putt10"] );
			$putt11 = validatePostVar( $_POST["putt11"] );
			$putt12 = validatePostVar( $_POST["putt12"] );
			$putt13 = validatePostVar( $_POST["putt13"] );
			$putt14 = validatePostVar( $_POST["putt14"] );
			$putt15 = validatePostVar( $_POST["putt15"] );
			$putt16 = validatePostVar( $_POST["putt16"] );
			$putt17 = validatePostVar( $_POST["putt17"] );
			$putt18 = validatePostVar( $_POST["putt18"] );
			$greens = validatePostVar( $_POST["greensInReg"] );
			$fairways = validatePostVar( $_POST["fairwaysHit"] );
			$penalties = validatePostVar( $_POST["penalties"] );
			$tot = $_POST["par1"] + $_POST["par2"] + $_POST["par3"] + $_POST["par4"] + $_POST["par5"] + $_POST["par6"] + $_POST["par7"] + $_POST["par8"] + $_POST["par9"] + $_POST["par10"] + $_POST["par11"] + $_POST["par12"] + $_POST["par13"] + $_POST["par14"] + $_POST["par15"] + $_POST["par16"] + $_POST["par17"] + $_POST["par18"];
			
			
			//
			// FORMAT THE DATE FOR SQL
			//
			$theDate = sprintf("%u",$_POST["TheYear"]); // YEAR
			if ($_POST["TheMonth"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheMonth"]); // MONTH
			else
				$theDate .= sprintf("%u",$_POST["TheMonth"]); // MONTH
			if ($_POST["TheDay"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheDay"]); // DAY
			else
				$theDate .= sprintf("%u",$_POST["TheDay"]); // DAY
			
			//$theComment = preg_replace("/\'/", "''", $_POST["commentText"]);
			$theComment = $_POST["commentText"];
			
			$sql = "update score_tbl set comment = '$theComment', hole1 = $par1, hole2 = $par2, hole3 = $par3, hole4 = $par4, hole5 = $par5, hole6 = $par6, hole7 = $par7, hole8 = $par8, hole9 = $par9, hole10 = $par10, hole11 = $par11, hole12 = $par12, hole13 = $par13, hole14 = $par14, hole15 = $par15, hole16 = $par16, hole17 = $par17, hole18 = $par18, putt1 = $putt1, putt2 = $putt2, putt3 = $putt3, putt4 = $putt4, putt5 = $putt5, putt6 = $putt6, putt7 = $putt7, putt8 = $putt8, putt9 = $putt9, putt10 = $putt10, putt11 = $putt11, putt12 = $putt12, putt13 = $putt13, putt14 = $putt14, putt15 = $putt15, putt16 = $putt16, putt17 = $putt17, putt18 = $putt18, greens = $greens, fairways = $fairways, penalties = $penalties";
					
			$sql .= ", teeid = ";
			$sql .= $_POST["Tees"];
			$sql .= ", dateplayed = ";
			$sql .= $theDate;
			$sql .= ", score = ";
			$sql .= $tot;
			$sql .= " where id = ";
			$sql .= $_POST["id"];
		}
		else if ( $SCORE_TYPE == "F")
		{
			$par1 = validatePostVar( $_POST["par1"] );
			$par2 = validatePostVar( $_POST["par2"] );
			$par3 = validatePostVar( $_POST["par3"] );
			$par4 = validatePostVar( $_POST["par4"] );
			$par5 = validatePostVar( $_POST["par5"] );
			$par6 = validatePostVar( $_POST["par6"] );
			$par7 = validatePostVar( $_POST["par7"] );
			$par8 = validatePostVar( $_POST["par8"] );
			$par9 = validatePostVar( $_POST["par9"] );
			$putt1 = validatePostVar( $_POST["putt1"] );
			$putt2 = validatePostVar( $_POST["putt2"] );
			$putt3 = validatePostVar( $_POST["putt3"] );
			$putt4 = validatePostVar( $_POST["putt4"] );
			$putt5 = validatePostVar( $_POST["putt5"] );
			$putt6 = validatePostVar( $_POST["putt6"] );
			$putt7 = validatePostVar( $_POST["putt7"] );
			$putt8 = validatePostVar( $_POST["putt8"] );
			$putt9 = validatePostVar( $_POST["putt9"] );
			$par10 = "null";
			$par11 = "null";
			$par12 = "null";
			$par13 = "null";
			$par14 = "null";
			$par15 = "null";
			$par16 = "null";
			$par17 = "null";
			$par18 = "null";
			$putt10 = "null";
			$putt11 = "null";
			$putt12 = "null";
			$putt13 = "null";
			$putt14 = "null";
			$putt15 = "null";
			$putt16 = "null";
			$putt17 = "null";
			$putt18 = "null";
			$greens = validatePostVar( $_POST["greensInReg"] );
			$fairways = validatePostVar( $_POST["fairwaysHit"] );
			$penalties = validatePostVar( $_POST["penalties"] );
			$tot = ($_POST["par1"] + $_POST["par2"] + $_POST["par3"] + $_POST["par4"] + $_POST["par5"] + $_POST["par6"] + $_POST["par7"] + $_POST["par8"] + $_POST["par9"]) * 2;
			
			//
			// FORMAT THE DATE FOR SQL
			//
			$theDate = sprintf("%u",$_POST["TheYear"]); // YEAR
			if ($_POST["TheMonth"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheMonth"]); // MONTH
			else
				$theDate .= sprintf("%u",$_POST["TheMonth"]); // MONTH
			if ($_POST["TheDay"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheDay"]); // DAY
			else
				$theDate .= sprintf("%u",$_POST["TheDay"]); // DAY
			
			//$theComment = preg_replace("/\'/", "''", $_POST["commentText"]);
			$theComment = $_POST["commentText"];
			$sql = "update score_tbl set comment = '$theComment', hole1 = $par1, hole2 = $par2, hole3 = $par3, hole4 = $par4, hole5 = $par5, hole6 = $par6, hole7 = $par7, hole8 = $par8, hole9 = $par9, hole10 = $par10, hole11 = $par11, hole12 = $par12, hole13 = $par13, hole14 = $par14, hole15 = $par15, hole16 = $par16, hole17 = $par17, hole18 = $par18, putt1 = $putt1, putt2 = $putt2, putt3 = $putt3, putt4 = $putt4, putt5 = $putt5, putt6 = $putt6, putt7 = $putt7, putt8 = $putt8, putt9 = $putt9, putt10 = $putt10, putt11 = $putt11, putt12 = $putt12, putt13 = $putt13, putt14 = $putt14, putt15 = $putt15, putt16 = $putt16, putt17 = $putt17, putt18 = $putt18, greens = $greens, fairways = $fairways, penalties = $penalties";
					
			$sql .= ", teeid = ";
			$sql .= $_POST["Tees"];
			$sql .= ", dateplayed = ";
			$sql .= $theDate;
			$sql .= ", score = ";
			$sql .= $tot;
			$sql .= " where id = ";
			$sql .= $_POST["id"];			
		}
		else if ( $SCORE_TYPE == "B")
		{

			$par1 = "null";
			$par2 = "null";
			$par3 = "null";
			$par4 = "null";
			$par5 = "null";
			$par6 = "null";
			$par7 = "null";
			$par8 = "null";
			$par9 = "null";
			$putt1 = "null";
			$putt2 = "null";
			$putt3 = "null";
			$putt4 = "null";
			$putt5 = "null";
			$putt6 = "null";
			$putt7 = "null";
			$putt8 = "null";
			$putt9 = "null";
			$par10 = validatePostVar( $_POST["par10"] );
			$par11 = validatePostVar( $_POST["par11"] );
			$par12 = validatePostVar( $_POST["par12"] );
			$par13 = validatePostVar( $_POST["par13"] );
			$par14 = validatePostVar( $_POST["par14"] );
			$par15 = validatePostVar( $_POST["par15"] );
			$par16 = validatePostVar( $_POST["par16"] );
			$par17 = validatePostVar( $_POST["par17"] );
			$par18 = validatePostVar( $_POST["par18"] );
			$putt10 = validatePostVar( $_POST["putt10"] );
			$putt11 = validatePostVar( $_POST["putt11"] );
			$putt12 = validatePostVar( $_POST["putt12"] );
			$putt13 = validatePostVar( $_POST["putt13"] );
			$putt14 = validatePostVar( $_POST["putt14"] );
			$putt15 = validatePostVar( $_POST["putt15"] );
			$putt16 = validatePostVar( $_POST["putt16"] );
			$putt17 = validatePostVar( $_POST["putt17"] );
			$putt18 = validatePostVar( $_POST["putt18"] );
			$greens = validatePostVar( $_POST["greensInReg"] );
			$fairways = validatePostVar( $_POST["fairwaysHit"] );
			$penalties = validatePostVar( $_POST["penalties"] );
			$tot = ($_POST["par10"] + $_POST["par11"] + $_POST["par12"] + $_POST["par13"] + $_POST["par14"] + $_POST["par15"] + $_POST["par16"] + $_POST["par17"] + $_POST["par18"])*2;
			
			
			//
			// FORMAT THE DATE FOR SQL
			//
			$theDate = sprintf("%u",$_POST["TheYear"]); // YEAR
			if ($_POST["TheMonth"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheMonth"]); // MONTH
			else
				$theDate .= sprintf("%u",$_POST["TheMonth"]); // MONTH
			if ($_POST["TheDay"] < 10)
				$theDate .= sprintf("0%u",$_POST["TheDay"]); // DAY
			else
				$theDate .= sprintf("%u",$_POST["TheDay"]); // DAY
			
			//$theComment = preg_replace("/\'/", "''", $_POST["commentText"]);
			$theComment = $_POST["commentText"];
			$sql = "update score_tbl set comment = '$theComment', hole1 = $par1, hole2 = $par2, hole3 = $par3, hole4 = $par4, hole5 = $par5, hole6 = $par6, hole7 = $par7, hole8 = $par8, hole9 = $par9, hole10 = $par10, hole11 = $par11, hole12 = $par12, hole13 = $par13, hole14 = $par14, hole15 = $par15, hole16 = $par16, hole17 = $par17, hole18 = $par18, putt1 = $putt1, putt2 = $putt2, putt3 = $putt3, putt4 = $putt4, putt5 = $putt5, putt6 = $putt6, putt7 = $putt7, putt8 = $putt8, putt9 = $putt9, putt10 = $putt10, putt11 = $putt11, putt12 = $putt12, putt13 = $putt13, putt14 = $putt14, putt15 = $putt15, putt16 = $putt16, putt17 = $putt17, putt18 = $putt18, greens = $greens, fairways = $fairways, penalties = $penalties";
					
			$sql .= ", teeid = ";
			$sql .= $_POST["Tees"];
			$sql .= ", dateplayed = ";
			$sql .= $theDate;
			$sql .= ", score = ";
			$sql .= $tot;
			$sql .= " where id = ";
			$sql .= $_POST["id"];
		}
		
		
		
		
		//printf("%s", $sql);
		$result = mysql_query($sql) or die("Could not update score: " . mysql_error());
		//printf("Score successfully updated.");
		
		?>
		<meta http-equiv="Refresh" content="0; URL=./home.php">
		<?
		
		
	}
	else if ($_POST["DeleteScore"])
	{
		$sql = "delete from score_tbl where id = ";
		$sql .= $_POST["id"];
		$result = mysql_query($sql) or die("Could not delete score: " . mysql_error());
		//printf("Score successfully deleted.");
		?>
		<meta http-equiv="Refresh" content="0; URL=./home.php">
		<?
	}
	else
	{
		DisplayScorecard( "EDIT_ROUND", $_GET["scoreID"], $_SERVER['PHP_SELF'] );
	}
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
