
<div id="signupbox" style="display:none;margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Créer votre compte Wahoo!</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Se connecter</a></div>
        </div>
        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form" action="register.php" method="post">
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Login</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" placeholder="login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Mot de Passe</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="mot de passe">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <input id="btn-signup" type="submit" class="btn btn-info" name="submit" type="submit" value="Valider"/>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
