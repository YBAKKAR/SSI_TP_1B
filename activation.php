<?php
	
	include('conf/db.inc');
	$stmt = mysqli_stmt_init($mysqli);
	$username = $_GET['user'];
	$token = $_GET['token'];
	$query = "UPDATE user SET active=1 WHERE username=? AND token =? ";
	if(mysqli_stmt_prepare($stmt,$query))
	{
		mysqli_stmt_bind_param($stmt,'ss',$username,$token);
		mysqli_stmt_execute($stmt);
		
		if( mysqli_affected_rows($mysqli) > 0)
		{
			session_start();
			$_SESSION['username'] = $username;
			header("Location: home.php");
			exit;
		} else {
			echo "Erreur d'identification";
			exit;
		}
	}
	
?>