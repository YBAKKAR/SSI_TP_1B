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

			if(isset($_SESSION['username']))
			{
				header("Location: home.php");
			} else {
				if(isset($_POST['submit']))
				{
					include('conf/db.inc');
					$stmt = mysqli_stmt_init($mysqli);
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);
					//$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
					//superadmin'# : SQLi
					/*$result = mysqli_query($mysqli,$query)or die(mysqli_error());
					$num_row = mysqli_num_rows($result);
					$row=mysqli_fetch_array($result);*/

					/*if( $num_row == 1 )
					{
						$_SESSION['username']=$row['username'];
						header("Location: home.php");
						exit;
					}*//* else {
						echo "Erreur d'identification";
						exit;
					}*/
					
					$query = "SELECT username, password FROM user WHERE username=? AND password =? ";
					if(mysqli_stmt_prepare($stmt,$query))
					{
						mysqli_stmt_bind_param($stmt,'ss',$username,$password);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$username,$password);
						mysqli_stmt_fetch($stmt);
						//echo ($username .' '.$password);
						echo (is_null($username));
						
						if( !is_null($username))
						{
							$_SESSION['username']=$username;
							header("Location: home.php");
							exit;
						} else {
							echo "Erreur d'identification";
							exit;
						}
					}
				} else {
					echo file_get_contents("forms/login.php");
					echo file_get_contents("forms/create.php");	
				}
			}
		?>

	</body>
</html>