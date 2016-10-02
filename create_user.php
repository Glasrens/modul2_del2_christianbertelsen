<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>opret bruger</title>
</head>

<body>
<?php
	require_once 'connection.php';
	
	$connection = new MySQLi(DB_HOST, DB_USER, DB_PASS, MYSQLDB);
	$connection->set_charset("utf8");
	
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>opret bruger</title>
    </head>
    
    <body>
    	<h2>Opret bruger</h2>
        
        <form method="post" action="#">
            <p>Brugernavn</p>
            <input name="name" type="text" placeholder="Username" required/>
            <p>Password</p>
            <input name="pw" type="password" placeholder="Password" required/>
            <p>Confirm password</p>
            <input name="pw2" type="password" placeholder="Password" required/>
            <br><br>
            <input type="submit" name="register_btn" value="Create user">
        </form>
		<?php 
        session_start();
        
        $db = mysqli_connect("localhost", "root", "", "login_db");
        
        if (isset($_POST['register_btn'])){
            session_start();
			// escape strings
            $username = mysqli_real_escape_string($db, $_POST['name']);
            $password = mysqli_real_escape_string($db, $_POST['pw']);
            $password2 = mysqli_real_escape_string($db, $_POST['pw2']);
            
            if ($password == $password2) {
                // Create user
				$password = password_hash($password, PASSWORD_DEFAULT);
                //$password = md5($password); 
                $sql = "INSERT INTO user(name, pw) VALUES('$username', '$password')";
                mysqli_query($db, $sql);
                $_SESSION['message'] = "User created!";
                $_SESSION['username'] = $username;
                header("location: index.php");
            }
            else {
                // Failed
                $_SESSION['message'] = "Kodeordene matcher ikke, prøv igen";
                
            }
        }
        ?>
        <br><br>
        
            <a style="text-decoration: none;"href="index.php">
            	<div style="border-radius: 10px; background: pink; height: 50px; width: 200px;">
                	<p style="line-height: 50px; text-align: center;  color: white; font-family:sans-serif;">Gå til login</p>
                </div>
            </a>

        
    </body>
</html>
</body>
</html>