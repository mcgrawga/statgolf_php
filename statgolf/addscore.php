<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';



function DisplayPage()
{
	DisplayCommonHeader();
	if ( $_POST["SubmitScore"])
	{
	
		//
		//  FORM VALIDATION
		//
		
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
		
		if ($SCORE_TYPE == "FB")
		{
			// holes 1 - 18 must be valid values
			for ($i = 1; $i < 19; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i score";
				if ( !IsScoreValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}

			if ( (	strlen($_POST["putt1"]) > 0 ||
				strlen($_POST["putt2"]) > 0 ||
				strlen($_POST["putt3"]) > 0 ||
				strlen($_POST["putt4"]) > 0 ||
				strlen($_POST["putt5"]) > 0 ||
				strlen($_POST["putt6"]) > 0 ||
				strlen($_POST["putt7"]) > 0 ||
				strlen($_POST["putt8"]) > 0 ||
				strlen($_POST["putt9"]) > 0 ||
				strlen($_POST["putt10"]) > 0 ||
				strlen($_POST["putt11"]) > 0 ||
				strlen($_POST["putt12"]) > 0 ||
				strlen($_POST["putt13"]) > 0 ||
				strlen($_POST["putt14"]) > 0 ||
				strlen($_POST["putt15"]) > 0 ||
				strlen($_POST["putt16"]) > 0 ||
				strlen($_POST["putt17"]) > 0 ||
				strlen($_POST["putt18"] ) > 0) && ( strlen($_POST["putt1"]) == 0 ||
							strlen($_POST["putt2"]) == 0 ||
							strlen($_POST["putt3"]) == 0 ||
							strlen($_POST["putt4"]) == 0 ||
							strlen($_POST["putt5"]) == 0 ||
							strlen($_POST["putt6"]) == 0 ||
							strlen($_POST["putt7"]) == 0 ||
							strlen($_POST["putt8"]) == 0 ||
							strlen($_POST["putt9"]) == 0 ||
							strlen($_POST["putt10"]) == 0 ||
							strlen($_POST["putt11"]) == 0 ||
							strlen($_POST["putt12"]) == 0 ||
							strlen($_POST["putt13"]) == 0 ||
							strlen($_POST["putt14"]) == 0 ||
							strlen($_POST["putt15"]) == 0 ||
							strlen($_POST["putt16"]) == 0 ||
							strlen($_POST["putt17"]) == 0 ||
							strlen($_POST["putt18"]) == 0))
			{
				printf("You must enter a putt total for every hole played or none at all.");
				return;
			}
			
			// putts 1 - 18 must be valid values
			for ($i = 1; $i < 19; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i putt value";
				if ( !IsPuttValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}
			
			                                
		}                                       
		else if ($SCORE_TYPE == "F")            
		{          
			// holes 1 - 9 must be valid values
			for ($i = 1; $i < 10; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i score";
				if ( !IsScoreValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}
			
			// if any putts were entered, make sure putts were entered for every hole
			if ( (	strlen($_POST["putt1"]) > 0 ||
				strlen($_POST["putt2"]) > 0 ||
				strlen($_POST["putt3"]) > 0 ||
				strlen($_POST["putt4"]) > 0 ||
				strlen($_POST["putt5"]) > 0 ||
				strlen($_POST["putt6"]) > 0 ||
				strlen($_POST["putt7"]) > 0 ||
				strlen($_POST["putt8"]) > 0 ||
				strlen($_POST["putt9"]) > 0)  && ( strlen($_POST["putt1"]) == 0 ||
							strlen($_POST["putt2"]) == 0 ||
							strlen($_POST["putt3"]) == 0 ||
							strlen($_POST["putt4"]) == 0 ||
							strlen($_POST["putt5"]) == 0 ||
							strlen($_POST["putt6"]) == 0 ||
							strlen($_POST["putt7"]) == 0 ||
							strlen($_POST["putt8"]) == 0 ||
							strlen($_POST["putt9"]) == 0))
							
							
			{
				printf("You must enter a putt total for every hole played or none at all.");
				return;
			}
			
			// putts 1 - 9 must be valid values
			for ($i = 1; $i < 10; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i putt value";
				if ( !IsPuttValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}                             
		}                                       
		else if ($SCORE_TYPE == "B")            
		{                     
			// holes 10 - 18 must be valid values
			for ($i = 10; $i < 19; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i score";
				if ( !IsScoreValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}
			
			// if any putts were entered, make sure putts were entered for every hole

			if ( (	strlen($_POST["putt10"]) > 0 ||
				strlen($_POST["putt11"]) > 0 ||
				strlen($_POST["putt12"]) > 0 ||
				strlen($_POST["putt13"]) > 0 ||
				strlen($_POST["putt14"]) > 0 ||
				strlen($_POST["putt15"]) > 0 ||
				strlen($_POST["putt16"]) > 0 ||
				strlen($_POST["putt17"]) > 0 ||
				strlen($_POST["putt18"] ) > 0) && ( strlen($_POST["putt10"]) == 0 ||
							strlen($_POST["putt11"]) == 0 ||
							strlen($_POST["putt12"]) == 0 ||
							strlen($_POST["putt13"]) == 0 ||
							strlen($_POST["putt14"]) == 0 ||
							strlen($_POST["putt15"]) == 0 ||
							strlen($_POST["putt16"]) == 0 ||
							strlen($_POST["putt17"]) == 0 ||
							strlen($_POST["putt18"]) == 0))							
							
							
							
							
			{
				printf("You must enter a putt total for every hole played or none at all.");
				return;
			}
			
			// putts 10 - 18 must be valid values
			for ($i = 10; $i < 19; $i++)
			{
				$postVarName = "par$i";
				$fieldName = "Hole $i putt value";
				if ( !IsPuttValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}                  
		}     

		if ( !IsGIRValid("Num of Greens in Reg", $_POST["greensInReg"]) )
			return;
		if ( !IsFairwaysHitValid("Num of Fairways Hit", $_POST["fairwaysHit"]) )
			return;
		if ( !IsPenaltiesValid("Num of Penalties", $_POST["penalties"]) )
			return;  
		
		                                
                                                        
		$theDate = sprintf("%u",$_POST["TheYear"]); // YEAR
		if ($_POST["TheMonth"] < 10)
			$theDate .= sprintf("0%u",$_POST["TheMonth"]); // MONTH
		else
			$theDate .= sprintf("%u",$_POST["TheMonth"]); // MONTH
		if ($_POST["TheDay"] < 10)
			$theDate .= sprintf("0%u",$_POST["TheDay"]); // DAY
		else
			$theDate .= sprintf("%u",$_POST["TheDay"]); // DAY
		
		if ( $SCORE_TYPE == "F" )
		{
			// ENTERING PUTTS IS OPTIONAL, SO WE MUST RECORD NULL IF NOT ENTERED.
			// OTHERWISE IT SHOWS UP AS A ZERO.
			$put1 = formatPuttScore( $_POST["putt1"] );
			$put2 = formatPuttScore( $_POST["putt2"] );
			$put3 = formatPuttScore( $_POST["putt3"] );
			$put4 = formatPuttScore( $_POST["putt4"] );
			$put5 = formatPuttScore( $_POST["putt5"] );
			$put6 = formatPuttScore( $_POST["putt6"] );
			$put7 = formatPuttScore( $_POST["putt7"] );
			$put8 = formatPuttScore( $_POST["putt8"] );
			$put9 = formatPuttScore( $_POST["putt9"] );
			$greens = formatPuttScore( $_POST["greensInReg"] );
			$fairways = formatPuttScore( $_POST["fairwaysHit"] );
			$penalties = formatPuttScore( $_POST["penalties"] );
			
			$tot = ($_POST["par1"] + $_POST["par2"] + $_POST["par3"] + $_POST["par4"] + $_POST["par5"] + $_POST["par6"] + $_POST["par7"] + $_POST["par8"] + $_POST["par9"]) * 2;
			$sql = "insert into score_tbl (userid, teeid, dateplayed, hole1, hole2, hole3, hole4, hole5, hole6, hole7, hole8, hole9, putt1, putt2, putt3, putt4, putt5, putt6, putt7, putt8, putt9, score, greens, fairways, penalties, comment) values (";
			$sql .= $_SESSION['userid'];
			$sql .= ", ";
			$sql .= $_POST["Tees"];
			$sql .= ", ";
			$sql .= $theDate;
			$sql .= ", '";
			$sql .= $_POST["par1"];
			$sql .= "', '";
			$sql .= $_POST["par2"];
			$sql .= "', '";
			$sql .= $_POST["par3"];
			$sql .= "', '";
			$sql .= $_POST["par4"];
			$sql .= "', '";
			$sql .= $_POST["par5"];
			$sql .= "', '";
			$sql .= $_POST["par6"];
			$sql .= "', '";
			$sql .= $_POST["par7"];
			$sql .= "', '";
			$sql .= $_POST["par8"];
			$sql .= "', '";
			$sql .= $_POST["par9"];
			$sql .= "', ";
			$sql .= $put1;
			$sql .= ", ";
			$sql .= $put2;
			$sql .= ", ";
			$sql .= $put3;
			$sql .= ", ";
			$sql .= $put4;
			$sql .= ", ";
			$sql .= $put5;
			$sql .= ", ";
			$sql .= $put6;
			$sql .= ", ";
			$sql .= $put7;
			$sql .= ", ";
			$sql .= $put8;
			$sql .= ", ";
			$sql .= $put9;
			$sql .= ", '";
			$sql .= $tot;
			$sql .= "', ";
			$sql .= $greens;
			$sql .= ", ";
			$sql .= $fairways;
			$sql .= ", ";
			$sql .= $penalties;
			$sql .= ", '";
			$sql .= $_POST["commentText"];
			//$sql .= preg_replace("/\'/", "''", $_POST["commentText"]);
			$sql .= "')";
		}
		else if ( $SCORE_TYPE == "B" )
		{
			// ENTERING PUTTS IS OPTIONAL, SO WE MUST RECORD NULL IF NOT ENTERED.
			// OTHERWISE IT SHOWS UP AS A ZERO.
			$put10 = formatPuttScore( $_POST["putt10"] );
			$put11 = formatPuttScore( $_POST["putt11"] );
			$put12 = formatPuttScore( $_POST["putt12"] );
			$put13 = formatPuttScore( $_POST["putt13"] );
			$put14 = formatPuttScore( $_POST["putt14"] );
			$put15 = formatPuttScore( $_POST["putt15"] );
			$put16 = formatPuttScore( $_POST["putt16"] );
			$put17 = formatPuttScore( $_POST["putt17"] );
			$put18 = formatPuttScore( $_POST["putt18"] );
			$greens = formatPuttScore( $_POST["greensInReg"] );
			$fairways = formatPuttScore( $_POST["fairwaysHit"] );
			$penalties = formatPuttScore( $_POST["penalties"] );
			
			
			$tot = ($_POST["par10"] + $_POST["par11"] + $_POST["par12"] + $_POST["par13"] + $_POST["par14"] + $_POST["par15"] + $_POST["par16"] + $_POST["par17"] + $_POST["par18"]) * 2;
			$sql = "insert into score_tbl (userid, teeid, dateplayed, hole10, hole11, hole12, hole13, hole14, hole15, hole16, hole17, hole18, putt10, putt11, putt12, putt13, putt14, putt15, putt16, putt17, putt18, score, greens, fairways, penalties, comment) values (";
			$sql .= $_SESSION['userid'];
			$sql .= ", ";
			$sql .= $_POST["Tees"];
			$sql .= ", ";
			$sql .= $theDate;
			$sql .= ", '";
			$sql .= $_POST["par10"];
			$sql .= "', '";
			$sql .= $_POST["par11"];
			$sql .= "', '";
			$sql .= $_POST["par12"];
			$sql .= "', '";
			$sql .= $_POST["par13"];
			$sql .= "', '";
			$sql .= $_POST["par14"];
			$sql .= "', '";
			$sql .= $_POST["par15"];
			$sql .= "', '";
			$sql .= $_POST["par16"];
			$sql .= "', '";
			$sql .= $_POST["par17"];
			$sql .= "', '";
			$sql .= $_POST["par18"];
			$sql .= "', ";
			$sql .= $put10;
			$sql .= ", ";
			$sql .= $put11;
			$sql .= ", ";
			$sql .= $put12;
			$sql .= ", ";
			$sql .= $put13;
			$sql .= ", ";
			$sql .= $put14;
			$sql .= ", ";
			$sql .= $put15;
			$sql .= ", ";
			$sql .= $put16;
			$sql .= ", ";
			$sql .= $put17;
			$sql .= ", ";
			$sql .= $put18;
			$sql .= ", '";
			$sql .= $tot;
			$sql .= "', ";
			$sql .= $greens;
			$sql .= ", ";
			$sql .= $fairways;
			$sql .= ", ";
			$sql .= $penalties;
			$sql .= ", '";
			//$sql .= preg_replace("/\'/", "''", $_POST["commentText"]);
			$sql .= $_POST["commentText"];
			$sql .= "')";
		}
		else
		{
			// ENTERING PUTTS IS OPTIONAL, SO WE MUST RECORD NULL IF NOT ENTERED.
			// OTHERWISE IT SHOWS UP AS A ZERO.
			$put1 = formatPuttScore( $_POST["putt1"] );
			$put2 = formatPuttScore( $_POST["putt2"] );
			$put3 = formatPuttScore( $_POST["putt3"] );
			$put4 = formatPuttScore( $_POST["putt4"] );
			$put5 = formatPuttScore( $_POST["putt5"] );
			$put6 = formatPuttScore( $_POST["putt6"] );
			$put7 = formatPuttScore( $_POST["putt7"] );
			$put8 = formatPuttScore( $_POST["putt8"] );
			$put9 = formatPuttScore( $_POST["putt9"] );
			$put10 = formatPuttScore( $_POST["putt10"] );
			$put11 = formatPuttScore( $_POST["putt11"] );
			$put12 = formatPuttScore( $_POST["putt12"] );
			$put13 = formatPuttScore( $_POST["putt13"] );
			$put14 = formatPuttScore( $_POST["putt14"] );
			$put15 = formatPuttScore( $_POST["putt15"] );
			$put16 = formatPuttScore( $_POST["putt16"] );
			$put17 = formatPuttScore( $_POST["putt17"] );
			$put18 = formatPuttScore( $_POST["putt18"] );
			$greens = formatPuttScore( $_POST["greensInReg"] );
			$fairways = formatPuttScore( $_POST["fairwaysHit"] );
			$penalties = formatPuttScore( $_POST["penalties"] );
			
			
			$tot = 0;
			if ( !$_POST["par1"] )	// if they just entered a back 9 on an 18 hole course
				$tot = ($_POST["par10"] + $_POST["par11"] + $_POST["par12"] + $_POST["par13"] + $_POST["par14"] + $_POST["par15"] + $_POST["par16"] + $_POST["par17"] + $_POST["par18"]) * 2;
			else if ( !$_POST["par10"] )  // if they just entered a front 9 on an 18 hole course
				$tot = ($_POST["par1"] + $_POST["par2"] + $_POST["par3"] + $_POST["par4"] + $_POST["par5"] + $_POST["par6"] + $_POST["par7"] + $_POST["par8"] + $_POST["par9"]) * 2;
			else
				$tot = $_POST["par1"] + $_POST["par2"] + $_POST["par3"] + $_POST["par4"] + $_POST["par5"] + $_POST["par6"] + $_POST["par7"] + $_POST["par8"] + $_POST["par9"] + $_POST["par10"] + $_POST["par11"] + $_POST["par12"] + $_POST["par13"] + $_POST["par14"] + $_POST["par15"] + $_POST["par16"] + $_POST["par17"] + $_POST["par18"];

			$sql = "insert into score_tbl (userid, teeid, dateplayed, hole1, hole2, hole3, hole4, hole5, hole6, hole7, hole8, hole9, hole10, hole11, hole12, hole13, hole14, hole15, hole16, hole17, hole18, putt1, putt2, putt3, putt4, putt5, putt6, putt7, putt8, putt9, putt10, putt11, putt12, putt13, putt14, putt15, putt16, putt17, putt18, score, greens, fairways, penalties, comment) values (";
			$sql .= $_SESSION['userid'];
			$sql .= ", ";
			$sql .= $_POST["Tees"];
			$sql .= ", ";
			$sql .= $theDate;
			$sql .= ", '";
			$sql .= $_POST["par1"];
			$sql .= "', '";
			$sql .= $_POST["par2"];
			$sql .= "', '";
			$sql .= $_POST["par3"];
			$sql .= "', '";
			$sql .= $_POST["par4"];
			$sql .= "', '";
			$sql .= $_POST["par5"];
			$sql .= "', '";
			$sql .= $_POST["par6"];
			$sql .= "', '";
			$sql .= $_POST["par7"];
			$sql .= "', '";
			$sql .= $_POST["par8"];
			$sql .= "', '";
			$sql .= $_POST["par9"];
			$sql .= "', '";
			$sql .= $_POST["par10"];
			$sql .= "', '";
			$sql .= $_POST["par11"];
			$sql .= "', '";
			$sql .= $_POST["par12"];
			$sql .= "', '";
			$sql .= $_POST["par13"];
			$sql .= "', '";
			$sql .= $_POST["par14"];
			$sql .= "', '";
			$sql .= $_POST["par15"];
			$sql .= "', '";
			$sql .= $_POST["par16"];
			$sql .= "', '";
			$sql .= $_POST["par17"];
			$sql .= "', '";
			$sql .= $_POST["par18"];
			$sql .= "', ";
			$sql .= $put1;
			$sql .= ", ";
			$sql .= $put2;
			$sql .= ", ";
			$sql .= $put3;
			$sql .= ", ";
			$sql .= $put4;
			$sql .= ", ";
			$sql .= $put5;
			$sql .= ", ";
			$sql .= $put6;
			$sql .= ", ";
			$sql .= $put7;
			$sql .= ", ";
			$sql .= $put8;
			$sql .= ", ";
			$sql .= $put9;
			$sql .= ", ";
			$sql .= $put10;
			$sql .= ", ";
			$sql .= $put11;
			$sql .= ", ";
			$sql .= $put12;
			$sql .= ", ";
			$sql .= $put13;
			$sql .= ", ";
			$sql .= $put14;
			$sql .= ", ";
			$sql .= $put15;
			$sql .= ", ";
			$sql .= $put16;
			$sql .= ", ";
			$sql .= $put17;
			$sql .= ", ";
			$sql .= $put18;
			$sql .= ", '";
			$sql .= $tot;
			$sql .= "', ";
			$sql .= $greens;
			$sql .= ", ";
			$sql .= $fairways;
			$sql .= ", ";
			$sql .= $penalties;
			$sql .= ", '";
			//$sql .= preg_replace("/\'/", "''", $_POST["commentText"]);
			$sql .= $_POST["commentText"];
			$sql .= "')";
		}
		//printf("%s", $sql);
		mysql_query($sql) or die("Could not add new score: " . mysql_error());
		//printf("Score Saved.<br>Click <a href=\"addscore.php\">here</a> to enter another score.");
		?>
		<meta http-equiv="Refresh" content="0; URL=./home.php">
		<?
	}
	else if ( $_GET["EnterScoreForCourse"])
	{	
		printf("<br><br><h3>Enter your round</h3>");
		DisplayScorecard( "ENTER_ROUND", $_GET["CourseID"], $_SERVER['PHP_SELF'] );
	}
	else
	{
		printf("<br><br><h3>Choose a course</h3>");
		$sql = "select name, id from course_tbl where userid = ";
		$sql .= $_SESSION['userid'];
		$result = mysql_query($sql) or die("Could not get a list of courses: " . mysql_error());
		if ( mysql_num_rows($result) == 0 )
			printf("You have not entered any courses yet.  <br>Click <a href=\"addcourse.php\">here</a> to enter a course.");
		else
		{
			$rowCnt = 0;
			printf("<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">");
			while ($row = mysql_fetch_array($result))
			{
				$classname = ($rowCnt % 2) ? 'CourseList2' : 'CourseList1';
				printf("<tr class=\"$classname\"><td>");
				if (getNumTeesForCourse($row["id"]) > 0)
					printf("<A HREF=\"addscore.php?EnterScoreForCourse=1&CourseID=%s\">%s</A><br>",$row["id"],$row["name"]);
				else
					printf("<A HREF=\"addscore.php?EnterScoreForCourse=1&CourseID=%s\" onclick=\"javascript:alert('There are no tees for this course.  Please create a set before entering a score.'); return false;\">%s</A><br>",$row["id"],$row["name"]);
				printf("</td></tr>");
				$rowCnt++;
			}
			printf("</table>");
		}
		printf("<br><a href=addcourse.php?frompage=%s>Add New Course</a>", $_SERVER['PHP_SELF']);
        ?>
        	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=searchcourse.php>Search For Course</a>
    	<?
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
