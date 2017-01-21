<?
include 'functions.php';
DisplayGeneralPublicHeader();
        ConnectToDB();

  require_once(dirname(__FILE__) . '/config.php');

  $token  = $_POST['stripeToken'];

try
{
  $customer = Stripe_Customer::create(array(
    "card" => $token,
    "plan" => 1,
    "email" => $_POST['email'])
  );

        $sql = "update user_tbl set stripe_id = '";  
        $sql .= $customer->id; 
        $sql .= "', paid  = 1";  
        $sql .= " where email = '"; 
        $sql .= $_POST['email'];
        $sql .= "'"; 

        //printf("%s", $sql);
        $result = mysql_query($sql) or die("Could not update stripe_id into user table." . mysql_error());

    printf("Monthly subscription successful, charged $4.99.  <br>Click <a href=\"index.php\">here</a> to log in.", $customer->id);
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















