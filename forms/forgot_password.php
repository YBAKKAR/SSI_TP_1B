<div id="forget-password-box" style="display:none;margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Reinit password</div>
        </div>
        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form" action="register.php" method="post">
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input name="email" class="form-control" placeholder="Votre email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Format de l'email inccorect"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Nouveau mot de passe</label>
                    <div class="col-md-9">
                        <input id="new-psw" name="new-password" class="form-control" placeholder="Votre Nouveau mot de passe"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Confirmez le mot de passe</label>
                    <div class="col-md-9">
                        <input id="confirm-new-psw" name="new-password-confirm" class="form-control" placeholder="Confirmer le mot de passe"/>
                    </div>
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