
<div class="container">    
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">Connectez vous</div>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#"  onClick="$('#loginbox').hide(); $('#forget-password-box').show()">Mot de passe oublié ?</a></div>
			</div>     
			<div style="padding-top:30px" class="panel-body" >
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

				<form id="loginform" class="form-horizontal" role="form" action="index.php" method="post">
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="login" required="required">                                        
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="login-password" type="password" class="form-control" name="password" placeholder="mot de passe" >
					</div>
					
					
					<div style="margin-top:10px" class="form-group">

						<div class="col-sm-12 controls">
						<input id="btn-signup" type="submit" class="btn btn-info" name="submit" type="submit" value="Se connecter"/></div>
					</div>
					<div class="form-group">
						<div class="col-md-12 control">
							<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
								<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">Créer votre compte</a>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>