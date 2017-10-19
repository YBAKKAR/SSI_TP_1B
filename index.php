<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

		<?php
			session_start();
	
			if(isset($_GET['action']) && ($_GET['action']=='logout'))
			{
				session_destroy();
			}

			if(isset($_SESSION['error']))
			{
				echo "<div id=\"error-message\" style=\"margin-top:50px;\" class=\"mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2\">
					  	<div class=\"panel panel-info\">
							<div class=\"panel-heading\">
								<div class=\"panel-title\">Erreur</div>";
				echo "<p class=\"text-danger\">".$_SESSION['error']['username']."</p>";
				echo "<p class=\"text-danger\">".$_SESSION['error']['email']."</p>";
				echo "<p class=\"text-danger\">".$_SESSION['error']['password']."</p>";
				echo "			</div>
							</div>
						</div>
					  </div>";
				unset($_SESSION['error']);
			}

			if(isset($_SESSION['username']) && isset($_COOKIE[$_SESSION['username']])  && $_COOKIE[$_SESSION['username']]==$_SESSION['username'])
			{
				header("Location: home.php");
			} 
			else 
			{
				if(isset($_POST['submit']))
				{
					include('conf/db.inc');
					$stmt = mysqli_stmt_init($mysqli);
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);
					$token="";$active=0;
					$options = [
						'salt' => hash("sha256",$username),
					];
					$password = password_hash ($password ,PASSWORD_DEFAULT, $options);
					//superadmin'# : SQLi
					$query = "SELECT username,email, password,token,active FROM user WHERE username=? AND password =? ";
					if(mysqli_stmt_prepare($stmt,$query))
					{
						mysqli_stmt_bind_param($stmt,'ss',$username,$password);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$username,$email,$password,$token,$active);
						mysqli_stmt_fetch($stmt);
						
						if( !is_null($username) && $active==1)
						{
							$_SESSION['username']=$username;
							
							if (!isset($_COOKIE[$username]))
							{
								$limiter=":";
								$str="$username$limiter".rand().":".(time()+60*5)."$limiter";
								$options = [
						            'salt' => $key,
						        ];
						        $hashed_str = password_hash ($str,PASSWORD_DEFAULT,$options);
						        $two_factor_token = $str.$hashed_str;

						        $two_factor_token = base64_encode($two_factor_token);

								$to = $email;
								$subject = "Wahoo! - Authentification à deux facteur:";
								$header = "Wahoo! - Authentification à deux facteur:";
								$message = "    Voici le code à utiliser pour votre 1er Authentification:\n";
								$message .= "    $two_factor_token\n";
								$message .= "A bientôt !";

								$sentmail = mail($to,$subject,$message,$header);

								if($sentmail)
								{
									header("Location: 2_auth_step_verification.php");
								} 
								else 
								{
									echo "<p class=\"bg-danger\">Erreur lors de l'envoi du mail de confirmation.</p>";
								}
								exit;
							}
							else
							{
								header("Location: home.php");
							}
							exit;
						} else
						 {
							echo "Erreur d'identification";
							exit;
						}
					}
				} else 
				{
					echo file_get_contents("forms/login.php");
					echo file_get_contents("forms/create.php");	
					echo file_get_contents("forms/forgot_password.php");
				}
			}
		?>

	</body>
</html>