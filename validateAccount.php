
<?php
 include('templates/header.php'); 
 include("database/connection.php");	



	// session_start();
if($_SERVER["REQUEST_METHOD"] == "GET")
{
	if (isset($_GET['codeValidate'])){
		
		$code = $_GET['codeValidate'];
		
		$utilizadore = '';
		if (isset($_SESSION['username']))
			$utilizadore = $_SESSION['username'];
		else if (isset($_GET['username']))
			$utilizadore = $_GET['username'];

		if ($utilizadore != ''){
				$stmt = $db->prepare('SELECT RegCode FROM Utilizador WHERE username = :user');
				$stmt->bindParam(':user',$utilizadore, PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetch();


				/*echo $result[0];
				echo '<br>'; 
				echo $code;*/


				if($result[0] == $code) {
					?>
					<div id="errorMessage">
					 <h1>Your account has been validated!</h1>
					</div>
					<?

					$_SESSION['activated'] = 1;
					$stmt = $db->prepare('UPDATE Utilizador SET Active=1 WHERE username = :user');
					$stmt->bindParam(':user',$utilizadore, PDO::PARAM_STR);
					$stmt->execute();
					header('Location: polls_index.php?err=validated');
				}
				else {
					//echo "Invalid code. Account not validated";
					?>
					<div id="errorMessage">
					 <h1>Wrong Code</h1>
					</div>

					<?
				}
		}
	}

}

?>


<center>
          <div id="validatemodal" >
            <h1>Validate your account</h1>
            <form id="loginform" name="loginform" method="get" action="">
              <label for="username">Verification Code:</label>
              <input type="text" name="codeValidate" id="code" class="txtfield" tabindex="1">
              
              <div class="center"><input type="submit" name="submit" id="loginbtn" class="flatbtn-blu hidemodal" value="Validate" tabindex="2"></div>
            </form>
          </div>
      </center>




<? include('templates/footer.php'); ?>




