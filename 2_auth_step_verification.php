<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
		echo file_get_contents("header.php");
	?>
    <body>
        <div class="container">
            <div id="2-step-auth" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
						<div class="panel-title">2-auth-verification</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >
                        <form class="form-horizontal" role="form" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                            <div class="form-group">
                                    <label for="username" class="col-md-3 control-label">
                                        Token de verification
                                    </label>
                                    <div class="col-md-9">
                        					<input name="token-verif" type="text" class="form-control" placeholder="Token de verification" />
                    				</div>
                                </div>
                                <div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
									    <input id="btn-signup" type="submit" class="btn btn-info" name="submit" type="submit" value="Continuer"/></div>
								    </div>
								</div>
                            </form>
                        </div>
					</div> 
                </div>
            </div>
        </div>
    </body>
    <?php
    include("security_functions.php");
    session_start();
    if(isset($_POST['submit']) && login_correct())
    {

        include('conf/db.inc');
        $username = $_SESSION['username'];        
        if( verify_2step_verification_hash($username,$_POST['token-verif']) ){
            generate_cookies($username);
            header("Location: index.php");
        }else{
                session_destroy();
                header("Location: index.php");
        }
    }

?>
</html>

