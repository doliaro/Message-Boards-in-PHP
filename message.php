<?php

ini_set('display_errors', 'On');
require_once("db_const.php");
session_start();
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->select_db('oliaro-db');

  if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else
      //echo "connected to db\n";

  if (isset($_GET['message'])) {
    
    
    $user_val = $_SESSION['username'];

    $user = $mysqli->query("SELECT user FROM forum");
    $user_result = $user->fetch_assoc($user);

    $message=$mysqli->real_escape_string($_GET['message']);
    $date=date('Y-m-d H:i:s');
    
    $sql="INSERT INTO forum(id, user, message, date) VALUES(0,'$user_val', '$message','$date')";
    $mysqli->query($sql);
  }
?>

<html>
<head>
<title> Message Boards </title> 
<link rel="stylesheet" type="text/css" href="style.css" />
</head> 
<body>

<?php  
// $sql = "SELECT first_name FROM users";
// $result = $mysqli->query($sql);
// $user = $result->fetch_assoc();

$welcome = "Welcome to the Message Boards, ";
$user_val = $_SESSION['username'];
?>

<h2>  <?php echo $welcome . $user_val; ?></h2>

<?php
$sql2 = "SELECT * FROM forum";
$result2 = $mysqli->query($sql2);
//$user = $result->fetch_assoc();

while($row = $result2->fetch_assoc()) {

echo "<h3>" . "--------------------------- Post by " . $row['user'] . "--------------------------" . '<br/>' . "</h3>";
echo "<h4>" . "Date posted: " . $row['date']. "<br />" . "</h4>";
echo "<h4>" . "- Message - " . '</br>' . $row['message'] . "<br />" . "</h4>";
echo "<h3>" . "------------------------------------------------------------------" . "<br />" . "</h3>";
  
}

// USED FOR DEBUGGING ONLY
// if(isset($_GET['delete_all'])){

// $sql = "TRUNCATE TABLE forum";

// $delete_data = $mysqli->query($sql);
  
// if(!$delete_data)
// {
//   die('Could not delete data: ' . mysql_error());
// }
// echo "Deleted data successfully\n";
// }


?>
<script> 
console.log(location.search); 

if (location.search.length > 1)
  location.search = '';

</script>


<form method="get" action="message.php">
 <!-- USED FOR DEBUGGING ONLY --> 
<!-- <p>
<input type="submit" name="delete_all" value="Delete All Posts"/>
</p> -->

<p>Post New Message: <br />
  <label for="message"></label>
  <textarea name="message" id="message" cols="45" rows="5"></textarea>
</p>
<p>
  <input type="submit" name="submit" id="submit" value="Post Message" />
</p>

</form>
<h4>  Click here to <a href="logout.php">Sign out</a> </h4>
</body>
</html>