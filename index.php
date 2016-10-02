<?php
	require_once 'connection.php';
	
	$connection = new MySQLi(DB_HOST, DB_USER, DB_PASS, MYSQLDB);
	$connection->set_charset("utf8");
	$db = mysqli_connect("localhost", "root", "", "login_db");

	session_start();
		if (isset($_SESSION['userSession'])) {
	
 			header("Location: home.php");
	}

	if (isset($_POST['login_btn'])) {
		$name = strip_tags($_POST['name']);
		$password = strip_tags($_POST['pw']);
		
		$name = $connection->real_escape_string($name);
 		$password = $connection->real_escape_string($password);
		
		$query = $connection->query("SELECT user_id, name, pw FROM user WHERE name='$name'");
 		$row=$query->fetch_array();
		
		 $count = $query->num_rows; // hvis navn og password matcher, logind.
		 
		 	if (password_verify($password, $row['pw']) && $count==1) {
		  $_SESSION['userSession'] = $row['user_id'];
		  header("Location: home.php");
		  exit();
		 } else {
		  echo 'Forkert navn eller Password !'. mysqli_error($connection);
			}
		 $connection->close();
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>log ind</title>
    </head>
    
    <body>
    	<h2>log ind</h2>
        <form method="post" action="#">
        	Username<br>
        	<input type="text" name="name">
            <br><br>
            Password<br>
            <input type="password" name="pw">
            <br><br>
            <input type="submit" name="login_btn" value="Log ind">
        </form>
    </body>
</html>