<?php 
	
	include('../conf/db.inc');
	$stmt = mysqli_stmt_init($mysqli);
	$email = $_GET['email'];
	$token = $_GET['token'];
	
	$query = "SELECT username FROM user WHERE token=? AND email =? AND active = 1";
	if(mysqli_stmt_prepare($stmt,$query))
	{
		mysqli_stmt_bind_param($stmt,'ss',$token,$email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$username);
		mysqli_stmt_fetch($stmt);
		
		if( !is_null($username) )
		{
			// user exist & token is correct ==> pwd shall be renewed
		?>
		<div id="new-password-box" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Reinit password</div>
        </div>
        <div class="panel-body" >
            <form id="newPwdForm" class="form-horizontal" role="form" action="verify.php" method="post">

                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Nouveau mot de passe</label>
                    <div class="col-md-9">
                        <input id="new-psw" name="new-password" class="form-control" placeholder="Votre Nouveau mot de passe"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Confirmez le mot de passe</label>
                    <div class="col-md-9">
                        <input id="confirm-new-psw" name="new-password-confirm" onchange="confirmNewPassword()" class="form-control" placeholder="Confirmer le mot de passe"/>
                    </div>
                    <script>
                        function confirmNewPassword()
						{
							var password = document.getElementById("new-psw").value;
							var confirmpsw = document.getElementById("confirm-new-psw").value;
							if( password != confirmpsw)
							{
								document.getElementById("confirm-new-psw").className += " confirm-error";
							}
							else
							{
								document.getElementById("confirm-new-psw").className = "";
								document.getElementById("confirm-new-psw").className += " form-control";

							}

						}
                    </script>
                </div>
                <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input id="btn-reinit-psw" type="submit" class="btn btn-info" name="submit" type="submit" value="Valider"/>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
		
		<?php
			exit;
		} else {
			echo "Erreur d'identification";
			exit;
		}
	}


?>

