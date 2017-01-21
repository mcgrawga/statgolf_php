<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

function DisplayPage()
{
	DisplayCommonHeader();
	printf("<h1>TIP ADMIN</H1>");
	if ( !inConfigName("ADMIN_USER", $_SESSION['email']) )
	{
		printf("You are not authorized to view this page");
		//printf("Admin_User:  %s", getConfigValue("ADMIN_USER"));
		//printf("Email:  %s", $_SESSION['email']);
		DisplayCommonFooter();
		return;
	}
	else
	{
		extract($_POST);
		extract($_GET);
		if ($DeleteTip)
		{
			$sql = "delete from tip_tbl where id = $id";
			//printf("SQL:  %s", $sql);
			mysql_query($sql) or die("Could not insert info: " . mysql_error());
		}
		if ($AddTip)
		{
			$sql = "INSERT INTO tip_tbl (txt, title, dt) VALUES('$txt', '$title', '$dt')";
			//printf("SQL:  %s", $sql);
			mysql_query($sql) or die("Could not insert info: " . mysql_error());
		}
	
		?>
		<form method="post" action="tipadmin.php">
		Title<br>
	    <input type="text" name="title" size="45"><br><br>
		Date<br>
	    <input type="text" name="dt" size="45"> YYYY-MM-DD<br><br>
		Tip<br>
		<textarea name="txt" cols="35", rows="5"></textarea><br><br>
		<input name="AddTip" type="submit" id="AddTip" value="Add Tip">
	    </form>
		<br><br>
		<?
	
	
	
	
	
	
		$sql = "select id, txt, DATE_FORMAT(dt, '%m/%d/%Y') dt, title from tip_tbl order by dt desc;";
		//printf("SQL:  %s", $sql);
		$Tips = mysql_query($sql) or die("Could not get tip info: " . mysql_error());
		while ($row = mysql_fetch_array($Tips))
		{
			extract($row);
			?>
			<b><?print("$title");?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="NineHoleScoreFont"><?print("$dt");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tipadmin.php?DeleteTip=1&id=<?print("$id");?>">delete</a></span><br><?print("$txt");?>
			<br><br>
			<?
		}
		DisplayCommonFooter();
		return;
	}
}




	if ($_POST['LoginUser'])		// Check to see if we should login user
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














