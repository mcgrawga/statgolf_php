<?
include 'functions.php';
DisplayGeneralPublicHeader();
if (isset($_POST['AddUser']))
{
	ConnectToDB();
	
	//
	//  FORM VALIDATION
	//
	if ( !IsEmailValid($_POST['email']) )
	{
		DisplayCommonFooter();
		return;
	}
	if ( userPreExists($_POST['email']) )
	{
		printf("The email you have choosen is already in use, please choose another email.");
		DisplayCommonFooter();
		return;
	}
	if ( !IsPasswordValid($_POST['password']) )
	{
		DisplayCommonFooter();
		return;
	}
	if ( $_POST['password'] == $_POST['email'] )
	{
		printf("Username and password must not be the same.");
		DisplayCommonFooter();
		return;
	}
	if ( !IsCPasswordValid($_POST['confirmpassword']) )
	{
		DisplayCommonFooter();
		return;
	}
	if ( $_POST['password'] != $_POST['confirmpassword'] )
	{
		printf("Passwords do not match.");
		DisplayCommonFooter();
		return;
	}

	$salt = bin2hex(openssl_random_pseudo_bytes(255));
    $hash = crypt($_POST['password'], '$2a$11$' . $salt);
	
	printf("<H1><B>New User Signup</B></H1>");
	//$sql = "insert into user_tbl (password, email, salt, password_hash) values ('";
	$sql = "insert into user_tbl (email, salt, password_hash) values ('";
	$sql .= $_POST['email']; 
	$sql .= "', '";
	$sql .= $salt; 
	$sql .= "', '";
	$sql .= $hash; 
	$sql .= "')";
	//printf("%s", $sql);
            //data-key="pk_test_yxT6Bqqd4iYidlLdNIveDgNb"

	mysql_query($sql) or die("Could not create the new user account: " . mysql_error());
?>
	<?php require_once('./config.php'); ?>
        <form action="/charge.php" method="POST">
          <input type="hidden" name="email" value="<?php echo($_POST['email']); ?>">
          <script
            src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-name="Statgolf Monthly Subscription"
            data-description="$4.99 per month"
            data-label="Pay with Card ($4.99 per month)"
            data-amount="499">
          </script>
        </form>
<?
}
else if (isset($_GET['SendPassword']))
{
	printf("<form action=\"newuser.php\" method=\"POST\">Please enter the email address you use to sign into StatGolf:<br><br>  <input type=\"text\" name=\"email\"><br><br><input type=\"submit\" name=\"SendPassword\" value=\"Send Me My Password\"></form>");
}
else if (isset($_POST['SendPassword']))
{
	$email = $_POST['email'];
	ConnectToDB();
	$sql = "select * from user_tbl where lcase(email) = lcase('$email')";
	$result = mysql_query($sql) or die("Could not get the user information: " . mysql_error());
	if ( mysql_num_rows($result) == 0 )
	{
		printf("%s does not match any email addresses in our system", $_POST['email']);
	}
	else
	{
		$row = mysql_fetch_array($result);
		$to = $row["email"];
		$subject = "StatGolf Account Info";
		$message = "Your password is:  ";
		$message .= $row["password"];
		SendEmail($to, $subject, $message);
		printf("Your password has been sent to %s.  Click <a href=\"index.php\">here</a> to log in.", $_POST['email']);
	}
}
else
{
	//printf("gift code:  %s", GenerateGiftCode());
?>
	<H1><B>New User Signup</B></H1>
	<form action="newuser.php" method="POST">
	<table>
		<tr><td>Email:  </td><td><input type="text" name="email"><span class="RequiredFieldIndicator">&nbsp*</span></td></tr>
		<tr><td>Password:  </td><td><input type="password" name="password"><span class="RequiredFieldIndicator">&nbsp*</span></td></tr>
		<tr><td>Confirm Password:  </td><td><input type="password" name="confirmpassword"><span class="RequiredFieldIndicator">&nbsp*</span></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><input type="submit" name="AddUser" value="Create My Account"></td></tr>
		<tr><td><span class="RequiredFieldIndicator">&nbsp*</span> indicates a required field.</td></tr>
	</table>
	</form>
<?
}
DisplayCommonFooter();
?>















