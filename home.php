<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

		<?php
			session_start();
			include("security_functions.php");
			if(!should_connect())
			{
				header("Location: index.php");
				exit;
			}
		?>

		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Wahoo!</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Aide</a></div>
					</div>     
					<div style="padding-top:30px" class="panel-body" >

						<div id="welcome" class="text-primary">
							<?php echo "Bonjour ".$_SESSION['username']." !"; ?>
						</div>

						<div  class="bg-danger">
							<?php echo "Ce compte possède un compte SSH valide"; ?>
						</div>

						<div class="form-group">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
									<a href="index.php?action=logout" onClick="$('#loginbox').hide(); $('#signupbox').show()">Se déconnecter</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</body>
</html>
