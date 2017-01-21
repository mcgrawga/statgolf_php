<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function DisplayPage()
{
	DisplayCommonHeader();
	printf("<br><br><h3>Add a new golf course.</h3>");
	if ( $_POST['StoreNewCourse'] )
	{
		//
		//  FORM VALIDATION
		//
		if ( !IsCourseNameValid($_POST['CourseName']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsCityValid($_POST['City']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsStateValid($_POST['State']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsTeeValid($_POST['Tees']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsSlopeRatingValid($_POST['SlopeRating']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsCourseRatingValid($_POST['CourseRating']) )
		{
			DisplayCommonFooter();
			return;
		}
		if ( !IsCourseRatingLessThanSlope($_POST['CourseRating'], $_POST['SlopeRating']) )
		{
			DisplayCommonFooter();
			return;
		}
		
		
		//if ( !IsRequiredFieldPresent("Hole 1 par value", $_POST['par1']) || !IsParValueForHoleValid("Hole 1 par value", $_POST['par1']) )
		//	return;
		
		// holes 1 - 9 are required and must be valid.	
		for ($i = 1; $i < 10; $i++)
		{
			$postVarName = "par$i";
			$fieldName = "Hole $i par value";
			if ( !IsRequiredFieldPresent($fieldName, $_POST[$postVarName]) || !IsParValueForHoleValid($fieldName, $_POST[$postVarName]) )
				return;
		}
		
		// holes 10 - 18 are not required, but if present must be valid.
		for ($i = 10; $i < 19; $i++)
		{
			$postVarName = "par$i";
			$fieldName = "Hole $i par value";
			if ( $_POST[$postVarName] )
			{
				if ( !IsParValueForHoleValid($fieldName, $_POST[$postVarName]) )
					return;
			}
		}
		
		// Must enter a front nine or a full 18.
		if ( ($_POST["par10"] || $_POST["par11"] || $_POST["par12"] || $_POST["par13"] || $_POST["par14"] || $_POST["par15"] || $_POST["par16"] || $_POST["par17"] || $_POST["par18"]) && !($_POST["par10"] && $_POST["par11"] && $_POST["par12"] && $_POST["par13"] && $_POST["par14"] && $_POST["par15"] && $_POST["par16"] && $_POST["par17"] && $_POST["par18"]) )
		{
			printf("You must enter a complete front 9 or a complete 18.");
			return;
		}	
			
			

		
		
		// Connect to the db.
		ConnectToDB();
	
		$sql = "insert into course_tbl (userid, name, city, state) values (";
		$sql .= $_SESSION['userid'];
		$sql .= ", '";
		$sql .= $_POST['CourseName'];
		$sql .= "', '";
		$sql .= $_POST['City'];
		$sql .= "', '";
		$sql .= $_POST['State'];
		
		$sql .= "')";
		//printf("%s", $sql);
		mysql_query($sql) or die("Could not add new course: " . mysql_error());
		$CourseID = mysql_insert_id();
		//printf("Course ID:  %s", $CourseID);
		
		
		
		
		
		
		
		
		
		
		$sql = "insert into tee_tbl (courseid, name, slope, rating, par1, par2, par3, par4, par5, par6, par7, par8, par9, par10, par11, par12, par13, par14, par15, par16, par17, par18) values (";
		$sql .= $CourseID;
		$sql .= ", '";
		$sql .= $_POST['Tees'];
		$sql .= "', ";
		$sql .= $_POST['SlopeRating'];
		$sql .= ", ";
		$sql .= $_POST['CourseRating'];
		$sql .= ", ";
		$sql .= $_POST['par1'];
		$sql .= ", ";
		$sql .= $_POST['par2'];
		$sql .= ", ";
		$sql .= $_POST['par3'];
		$sql .= ", ";
		$sql .= $_POST['par4'];
		$sql .= ", ";
		$sql .= $_POST['par5'];
		$sql .= ", ";
		$sql .= $_POST['par6'];
		$sql .= ", ";
		$sql .= $_POST['par7'];
		$sql .= ", ";
		$sql .= $_POST['par8'];
		$sql .= ", ";
		$sql .= $_POST['par9'];
		$sql .= ", ";
		if ( $_POST['par10'] )
			$sql .= $_POST['par10'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par11'] )
			$sql .= $_POST['par11'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par12'] )
			$sql .= $_POST['par12'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par13'] )
			$sql .= $_POST['par13'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par14'] )
			$sql .= $_POST['par14'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par15'] )
			$sql .= $_POST['par15'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par16'] )
			$sql .= $_POST['par16'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par17'] )
			$sql .= $_POST['par17'];
		else
			$sql .= "null";
		$sql .= ", ";
		if ( $_POST['par18'] )
			$sql .= $_POST['par18'];
		else
			$sql .= "null";
		$sql .= ")";
		//printf("%s", $sql);
		mysql_query($sql) or die("Could not add new tees: " . mysql_error());
		
	
		//printf("Course successfully added.<br>Click <a href=\"addcourse.php\">here</a> to add another one.");
		if($_GET["frompage"])
		{
			printf("<meta http-equiv=\"refresh\" content=\"0; url=%s\">", $_GET["frompage"]);
		}
		else
		{
			?>
			<meta http-equiv="refresh" content="0; url=./courseadmin.php"> 
			<?
		}
	}
	else
	{
		DisplayScorecard( "NEW_COURSE", 0, $_SERVER['PHP_SELF'] );
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
