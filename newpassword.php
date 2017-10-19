<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
echo file_get_contents("header.php");
?>
	<body>
<?php
session_start();
include ('conf/db.inc');

$stmt = mysqli_stmt_init($mysqli);

if (!isset($_POST['submit']))
{
$email = $_GET['email'];
$token = $_GET['token'];
$query = "SELECT username FROM user WHERE token=? AND email =? AND active = 1";
if (mysqli_stmt_prepare($stmt, $query))
	{
	mysqli_stmt_bind_param($stmt, 'ss', $token, $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $username);
	mysqli_stmt_fetch($stmt);
	if (!is_null($username))
		{
		$_SESSION['username'] = $username;
?>
		<div class="container">
			<div id="newpasword" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Saisir votre nouveau mot de passe</div>
					</div>
					<div style="padding-top:30px" class="panel-body" >
						<form id="loginform" class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
							<div class="form-group">
								<label for="username" class="col-md-3 control-label">Nouveau mot de passe</label>
									<div class="col-md-9">
										<input name="newpwd" id="newpwd" type="password" class="form-control" placeholder="Votre nouveau mot de passe" />
									</div>
									<div id="message">
										  <p><b><u>Password must contain the following:</u></b></p>
										<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
										<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
										<p id="number" class="invalid">A <b>number</b></p>
										<p id="length" class="invalid">Minimum <b>8 characters</b></p>
									</div>
									<script>
										var myInput = document.getElementById("newpwd");
										var letter = document.getElementById("letter");
										var capital = document.getElementById("capital");
										var number = document.getElementById("number");
										var length = document.getElementById("length");

										// When the user clicks on the password field, show the message box

										myInput.onfocus = function() {
											document.getElementById("message").style.display = "block";
										}

										// When the user clicks outside of the password field, hide the message box

										myInput.onblur = function() {
											document.getElementById("message").style.display = "none";
										}

										// When the user starts to type something inside the password field

										myInput.onkeyup = function() {

										  // Validate lowercase letters

										  var lowerCaseLetters = /[a-z]/g;
										  if(myInput.value.match(lowerCaseLetters)) {  
											letter.classList.remove("invalid");
											letter.classList.add("valid");
										  } 
										  else {
											letter.classList.remove("valid");
											letter.classList.add("invalid");
										  }

					  
										  // Validate capital letters

										  var upperCaseLetters = /[A-Z]/g;
										  if(myInput.value.match(upperCaseLetters)) 
										{  
											capital.classList.remove("invalid");
											capital.classList.add("valid");
										  }
										  else 
										{
											capital.classList.remove("valid");
											capital.classList.add("invalid");
										  }


					  // Validate numbers

										  var numbers = /[0-9]/g;
										  if(myInput.value.match(numbers)) 
										{  
											number.classList.remove("invalid");
											number.classList.add("valid");
										  }
										  else 
										{
											number.classList.remove("valid");
											number.classList.add("invalid");
										  }

					  
					  // Validate lengthd

										  if(myInput.value.length >= 8) {
											length.classList.remove("invalid");
											length.classList.add("valid");
										  } 
										  else
										{
											length.classList.remove("valid");
											length.classList.add("invalid");
										  }
									}
					</script>
			</div>
									<div class="form-group">
										<label for="username" class="col-md-3 control-label">Confirmer le mot de passe</label>
										<div class="col-md-9">
											<input name="confirm-newpwd" id="confirm-newpwd" onchange="confirmPassword()" type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe"/>
										</div>
										<script>
					function confirmPassword()
					{
						var password = document.getElementById("newpwd").value;
						var confirmpsw = document.getElementById("confirm-newpwd").value;
						if( password != confirmpsw)
						{
							console.log("non");
							document.getElementById("confirm-newpwd").className += " confirm-error";
						}
						  else
						{
							console.log("password match")
							document.getElementById("confirm-newpwd").className = "";
							document.getElementById("confirm-newpwd").className += " form-control";

						}

					}
				</script>
									</div>
									<div style="margin-top:10px" class="form-group">
										<div class="col-sm-12 controls">
											<input id="btn-signup" type="submit" class="btn btn-info" name="submit" type="submit" value="Se connecter"/></div>
										</div>
									</div>
								</form>
							</div>
						</div> 
					</div>
				</div>
<?php
		exit;
		}
	  else
		{
		echo "Email ou le token sont invalides.";
		}
	}
  else
	{
	echo "Erreur dans la REQUETE SQL";
	exit;
	}
}
else
{
$password = $_POST['newpwd'];
$confirm = $_POST['confirm-newpwd'];
if ($password == $confirm)
	{
	$options = ['salt' => hash("sha256", $_SESSION['username']) , ];
	$password = password_hash($password, PASSWORD_DEFAULT, $options);
	$token = md5(rand());
	$query = "UPDATE user SET token='$token' , password = '$password' WHERE username=? AND active = 1";
	if (mysqli_stmt_prepare($stmt, $query))
		{
		mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
		mysqli_stmt_execute($stmt);
		if (mysqli_affected_rows($mysqli) > 0)
			{
			header('Location: index.php');
			}
		  else
			{
			echo "token expired";
			}
		}
	}
  else
	{
	echo "passwords don't match";
	}

session_destroy();
}

?>
</body>
</html>