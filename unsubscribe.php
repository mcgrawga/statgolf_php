<?
session_start();
include 'functions.php';
DisplayCommonHeader();
ConnectToDB();
require_once(dirname(__FILE__) . '/config.php');

try
{
  Stripe::setApiKey("sk_test_qs7hlVrey8QcgqkOUbMFgdAK");
  $userId = $_SESSION['userid'];
  $sql = "select stripe_id from user_tbl where id = ";
  $sql .= $userId;
  //printf("%s<br>", $sql);
  $result = mysql_query($sql) or die("Could not get id to unsubscribe: " . mysql_error());
  $row = mysql_fetch_array($result);
  $stripe_id = $row["stripe_id"];

  // CANCEL THE SUBSCRIPTION
  if (isset($stripe_id))
  {
	  $cu = Stripe_Customer::retrieve($stripe_id);
	  $cu->cancelSubscription();
	  //printf("<br><br>id to delete:  %s<br><br>", $stripe_id);
	  printf("Subscription cancelled<br><br>");
  }

  // DELETE ALL OF THE USER'S DATA AND THE USER
  $sql = "delete from tee_tbl where courseid in ( select id from course_tbl where userid = ";
  $sql .= $userId;
  $sql .= " ) ";
  //printf("%s<br>", $sql);
  $result = mysql_query($sql) or die("Could not delete tees." . mysql_error());

  $sql = "delete from course_tbl where userid = ";
  $sql .= $userId;
  //printf("%s<br>", $sql);
  $result = mysql_query($sql) or die("Could not delete courses." . mysql_error());

  $sql = "delete from score_tbl where userid = ";
  $sql .= $userId;
  //printf("%s<br>", $sql);
  $result = mysql_query($sql) or die("Could not delete scores." . mysql_error());

  $sql = "delete from user_tbl where id = ";
  $sql .= $userId;
  //printf("%s<br>", $sql);
  $result = mysql_query($sql) or die("Could not delete user." . mysql_error());

  // KILL THE SESSION
  session_destroy();

}

catch (Stripe_Error $e)
{
        printf("%s",$e->getMessage());
}
catch (Exception $e)
{
        printf("%s", $e->getMessage());
}


DisplayCommonFooter();
?>















