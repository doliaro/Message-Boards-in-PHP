<?php
session_start();
ob_start();

ini_set('display_errors', 'On');
?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h1>User Login Form</h1>
<?php
if (!isset($_POST['submit'])){
?>
<!-- The HTML login form -->
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username <input type="text" name="username" /><br />
		<br/>
		Password <input type="password" name="password" /><br /><br />
 
		<input type="submit" name="submit" value="Login" />
	</form>
	<h4> <a href="register.php">New User?</a> </h4>
<?php
} else {
	require_once("db_const.php");
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
 
 	$_SESSION['username'] = $_POST['username'];
	$password = $_POST['password'];
 
	$sql = "SELECT * from users WHERE username LIKE '{$_SESSION['username']}' AND password LIKE '{$password}' LIMIT 1";
	$result = $mysqli->query($sql);
	if (!$result->num_rows == 1) {
		echo "<p>Invalid username/password combination</p>";
		echo "<a href='web.engr.oregonstate.edu/~oliarod/CS290/final/login.php'>Try Again</a>";
	} else {
		echo "<p>Logged in successfully</p>";
		//echo "Go to ";
		//echo "<a href='message.php'>Message Boards</a>"; 
		
		header("Location: message.php");
	}
}
?>		
</body>
</html>