<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<?php
			echo file_get_contents("header.php");
		?>
		<body>
<?php 
	session_start();
	include('conf/db.inc');
	$stmt = mysqli_stmt_init($mysqli);

	if(!isset($_POST['submit'])){
		$email = $_GET['email'];
		$token = $_GET['token'];
		$query = "SELECT username FROM user WHERE token=? AND email =? AND active = 1";
		if(mysqli_stmt_prepare($stmt,$query))
		{
			mysqli_stmt_bind_param($stmt,'ss',$token,$email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$username);
			mysqli_stmt_fetch($stmt);
		if( !is_null($username))
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
							<form id="loginform" class="form-horizontal" role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<div class="form-group">
                    				<label for="username" class="col-md-3 control-label">Nouveau mot de passe</label>
                    					<div class="col-md-9">
                        					<input name="newpwd" type="password" class="form-control" placeholder="Votre nouveau mot de passe" />
                    					</div>
                				</div>
										<div class="form-group">
                    						<label for="username" class="col-md-3 control-label">Confirmer le mot de passe</label>
                    						<div class="col-md-9">
                        						<input name="confirm-newpwd" type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe"/>
                    						</div>
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
		else {
			echo "Erreur dans la REQUETE SQL";
			exit;
		}
	}
	else
	{
		$password = $_POST['newpwd'];
		$confirm = $_POST['confirm-newpwd'];
		if($password == $confirm)
		{
			$options = [
				'salt' => hash("sha256",$_SESSION['username']),
			];
			$password = password_hash ($password,PASSWORD_DEFAULT,$options);
			$token = md5(rand());
			$query = "UPDATE user SET token='$token' , password = '$password' WHERE username=? AND active = 1";
			if(mysqli_stmt_prepare($stmt,$query))
			{
				mysqli_stmt_bind_param($stmt,'s',$_SESSION['username']);
				mysqli_stmt_execute($stmt);
				if( mysqli_affected_rows($mysqli) > 0)
				{
					
					header('Location: index.php');
				}
				else
				{
					echo "token qdim";
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