<?php

	session_start();

	include('conf/db.inc');
	$stmt = mysqli_stmt_init($mysqli);
	if(isset($_POST['submit']))
	{
		if($_POST['email'] == '')
		{
			$_SESSION['error']['email'] = "E-mail manquant";
		} else {
			if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
			{
				$email= $_POST['email'];
				$token = md5( rand() );
				$query = "UPDATE user SET token='$token' WHERE email=? AND active = 1";
					if(mysqli_stmt_prepare($stmt,$query))
					{
						mysqli_stmt_bind_param($stmt,'s',$email);
						mysqli_stmt_execute($stmt);
						
						if( mysqli_affected_rows($mysqli) > 0)
						{
							$to = $email;
							$subject = "Confirmation de votre demande de modification du mot de passe compte Wahoo!";
							$header = "Wahoo! - Mot de passe oublier";
							$message = "    Cliquez sur ce lien pour changer votre mot de passe:\n";
							$message .= "    http://localhost/wahoo/newpassword.php?email=$email&token=$token \n";
							$message .= "A bientôt !";

							$sentmail = mail($to,$subject,$message,$header);

							if($sentmail)
							{
							echo "<p class=\"bg-success\">Un mail vous a été envoyé à l'adresse $email afin de changer votre mot de passe.</p>";
							} else {
								echo "<p class=\"bg-danger\">Erreur lors de l'envoi du mail de confirmation.</p>";
							}
				
							exit;
						} else {
							echo "Erreur d'identification";
							exit;
						}
					}
				
			} else {
				$_SESSION['error']['email'] = "E-mail non valide";
			}
		}
				
	}

?>
