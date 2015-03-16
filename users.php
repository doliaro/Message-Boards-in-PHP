<?php
session_start();

$db = new mysqli("127.0.0.1", "root", "");
//$db = mysqli_connect("127.0.0.1", "root", "");
$db->select_db('forum');

if (isset($_POST['username'])) {
	
	echo "username - post";
	//$username = mysqli_real_escape_string($_POST['username']);
	
	$username = $_POST['username'];
	mysqli_real_escape_string($db, $username);

	//$password = sha1(mysqli_real_escape_string($_POST['password'])); 
	$password = $_POST['username'];
	sha1(mysqli_real_escape_string($db, $password));
		
	$sql= "SELECT * FROM users WHERE username ='$username'";	
	
	$result = $db->query($sql); 
	
	if ($row = $result->fetch_assoc()) {
		if ($row['password']==$password) $_SESSION['auth']=true;
	} 
}

if (isset($_GET['logoff'])) {
   unset($_SESSION['auth'], $auth);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<h3> New User </h3>
<?php

ini_set('display_errors', 'On');
if (!isset($_SESSION['auth'])) { ?>
<form method="post" action="users.php">
<p>
  <label for="username"></label> Username: 
  <input type="text" name="username" id="username" />
</p>
<p>
  <label for="password"></label> Password: 
  <input type="text" name="password" id="password" />
</p><p>
  <input type="submit" name="Login" id="Login" value="Submit" />
</p>
</form>
<?php } ?>

<?php
if (isset($_SESSION['auth'])) { ?>

Logged in...
<br />
<a href="http://web.engr.oregonstate.edu/~oliarod/CS290/final/users.php?logoff=1">Log off</a>
	
<?php } ?>

</body>
</html>
<?

// $sql = "CREATE TABLE users(
// id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
// username TEXT NOT NULL,
// password TEXT NOT NULL
// )";


// if(! $result )
// {
//   die('Could not create table: ' . mysql_error());
// }
// echo "Table inventory created successfully\n";
?>
