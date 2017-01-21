<?php

	function hashPassword($password)
	{
		$salt = bin2hex(openssl_random_pseudo_bytes(255));
		$hash = crypt($password, '$2a$11$' . $salt);

		$result['salt'] = $salt;
		$result['hash'] = $hash;

		return $result;			
	}	
	
	function checkPassword($password, $salt)
	{
		return crypt($password, '$2a$11$' . $salt);
	}

	$db = mysql_connect("localhost", "statgolf_mcgraw", "blu1duck*");
        mysql_select_db("statgolf_db",$db);
	printf("Connected to DB\n");
	$sql = "select * from user_tbl";
	$result = mysql_query($sql) or die("Could not select users: " . mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$r = hashPassword($row["password"]);
		printf("id: %s, email: %s, password: %s, hash: %s, salt: %s\n", $row["id"], $row["email"], $row["password"], $r["hash"], $r["salt"]);
		$salt = $r["salt"];
		$hash = $r["hash"];
		$id = $row["id"];
		$insert = "update user_tbl set password_hash = '$hash', salt = '$salt' where id = $id";
		printf("%s", $insert);
		mysql_query($insert) or die("Could not update hashed password:  " . mysql_error());
	}

/*
	$p = hashPassword("Garthie");
	$hashedInputPassword = checkPassword("Garthie", $p["salt"]);
	if ($hashedInputPassword == $p["hash"])
		printf("Hashed input password matches hashed password in db\n");
	else
		printf("Hashed input password does not match hashed password in db\n");
*/
					
?>
