<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

include 'functions.php';

$_SESSION = array(); 
session_destroy(); 
if($_SESSION['userid'])
{ 
	DisplayCommonHeader();
    	printf("Your session is still active."); 
} 
else 
{ 
	DisplayGeneralPublicHeader();	
    	printf("You have been logged out of StatGolf.  If you are not automatically redirected, <br>Click <a href=\"index.php\">here</a> to login again."); 
		?>
		<meta http-equiv="Refresh" content="0; URL=./index.php">
		<?
} 
DisplayCommonFooter();
?>














