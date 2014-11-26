<?php
include("database/connection.php");
include("PasswordHash.php");
// session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = $_POST['u'];
  $pword = $_POST['p'];

  $stmt = $db->prepare('SELECT * FROM Utilizador WHERE username = :user');
  $stmt->bindParam(':user',$username, PDO::PARAM_STR);
 // $stmt->bindParam(':pword',$pword, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch();
  
  if(validate_password($pword, $result['Pword']) ){

  
	// store session data
	$_SESSION['username']=$username;
	//$_SESSION['Permission']=$result[1];
	header("location: checklogin.php");
  }
  else echo "Wrong Username or Password";
  }

echo '<div id="login">
         <form action="" method="post">
          <p>Username: <input type="text" name="u"/></p>
          <p>Password: <input type="password" name="p"/></p>
          <p><input type="submit"/></p>
          </form></div>';
  
?>