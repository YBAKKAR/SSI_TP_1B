
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Enregistrement</div>
					</div>     
					<div style="padding-top:30px" class="panel-body" >

						<?php

							session_start();

							include('conf/db.inc');
							$stmt =  mysqli_stmt_init($mysqli);

							 $response=$_POST['g-recaptcha-response'];
							 $secret = '6LcjRzQUAAAAAFThMCW7U48PZMs6M1A1mPM-z_Mm';

				            $rsp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
				            $arr= json_decode($rsp,TRUE);
				            if($arr['success'] == TRUE){
				            	
				            	if(isset($_POST['submit']))
							{
								if($_POST['username'] == '')
								{
									$_SESSION['error']['username'] = "Login manquant";
								}
								if($_POST['email'] == '')
								{
									$_SESSION['error']['email'] = "E-mail manquant";
								} else {
									if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
									{
										$username = $_POST['username'];
										$email= $_POST['email'];
										$username1 = null;
										$email1 = null;
										$sql1 = "SELECT username,email FROM user WHERE email = ? OR username= ?";
										if(mysqli_stmt_prepare($stmt,$sql1))
										{
											mysqli_stmt_bind_param($stmt,'ss',$email,$username);
											mysqli_stmt_execute($stmt);
											mysqli_stmt_bind_result($stmt,$username1,$email1);
											mysqli_stmt_fetch($stmt);
											if( !is_null($username1) || !is_null($email1))
											{
												$_SESSION['error']['email'] = "Un compte existe déjà avec cet identifiant ou email.";
											}
										}
									} 
									else
									{
										$_SESSION['error']['email'] = "E-mail non valide";
									}
								}
								if($_POST['password'] == '')
								{
									$_SESSION['error']['password'] = "Mot de passe manquant";
								}

								if(isset($_SESSION['error']))
								{
									header("Location: index.php");
									exit;
								} else {
									$username = $_POST['username'];
									$email = $_POST['email'];
									$options = [
										'salt' => hash("sha256",$username),
									];
									$password = password_hash ($_POST['password'],PASSWORD_DEFAULT,$options);
									$token = md5( rand() );
									//todo
									$sql2 = "INSERT INTO user (username, email,token, password,active) VALUES (?, ?,?,?,0)";
									if(mysqli_stmt_prepare($stmt,$sql2))
									{
										mysqli_stmt_bind_param($stmt,'ssss',$username,$email,$token,$password);
										mysqli_stmt_execute($stmt);
										if( mysqli_affected_rows($mysqli) > 0)
										{
											$to = $email;
											$subject = "Confirmation de création de votre compte Wahoo!";
											$header = "Wahoo! - Votre compte";
											$message = "Votre username Wahoo! : \n";
											$message .= "    Login: $username\n";
											$message .= "    Cliquez sur ce lien pour activer votre compte:\n";
											$message .= "    http://localhost/wahoo/activation.php?user=$username&token=$token \n";
											$message .= "A bientôt !";
	
											$sentmail = mail($to,$subject,$message,$header);
	
											if($sentmail)
											{
											echo "<p class=\"bg-success\">Un mail de confirmation vous a été envoyé à l'adresse $email.</p>";
											} else {
												echo "<p class=\"bg-danger\">Erreur lors de l'envoi du mail de confirmation.</p>";
											}
										}
									}
								}
							}

				            	die;
							}else
							{ 
								echo "<p class=\"bg-danger\">You're not a human.</p>";
								die;
							}

						?>

			</div>
		</div>
	</div>
</div>