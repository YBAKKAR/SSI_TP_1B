<head>
	<link rel="stylesheet" type="text/css" href="forms/create_account_style.css">
</head>

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
                        <input type="text" class="form-control" name="username" placeholder="login" required pattern="[a-zA-Z0-9]+" title="must be correct">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email" placeholder="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="must be a correct email format">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Mot de Passe</label>
                    <div class="col-md-9">
                        <input type="password" id="psw" class="form-control" name="password" placeholder="mot de passe"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
					
					<div id="message">
					  <p><b><u>Password must contain the following:</u></b></p>
						<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
						<p id="number" class="invalid">A <b>number</b></p>
						<p id="length" class="invalid">Minimum <b>8 characters</b></p>
					</div>
					<script>
						var myInput = document.getElementById("psw");
						var letter = document.getElementById("letter");
						var capital = document.getElementById("capital");
						var number = document.getElementById("number");
						var length = document.getElementById("length");

						// When the user clicks on the password field, show the message box
						myInput.onfocus = function() {
							document.getElementById("message").style.display = "block";
						}

						// When the user clicks outside of the password field, hide the message box
						myInput.onblur = function() {
							document.getElementById("message").style.display = "none";
						}

						// When the user starts to type something inside the password field
						myInput.onkeyup = function() {
						  // Validate lowercase letters
						  var lowerCaseLetters = /[a-z]/g;
						  if(myInput.value.match(lowerCaseLetters)) {  
							letter.classList.remove("invalid");
							letter.classList.add("valid");
						  } else {
							letter.classList.remove("valid");
							letter.classList.add("invalid");
						  }
						  
						  // Validate capital letters
						  var upperCaseLetters = /[A-Z]/g;
						  if(myInput.value.match(upperCaseLetters)) {  
							capital.classList.remove("invalid");
							capital.classList.add("valid");
						  } else {
							capital.classList.remove("valid");
							capital.classList.add("invalid");
						  }

						  // Validate numbers
						  var numbers = /[0-9]/g;
						  if(myInput.value.match(numbers)) {  
							number.classList.remove("invalid");
							number.classList.add("valid");
						  } else {
							number.classList.remove("valid");
							number.classList.add("invalid");
						  }
						  
						  // Validate lengthd
						  if(myInput.value.length >= 8) {
							length.classList.remove("invalid");
							length.classList.add("valid");
						  } else {
							length.classList.remove("valid");
							length.classList.add("invalid");
						  }
						}
						</script>

                </div>
				<div class="form-group">
					<label for="password" class="col-md-3 control-label">Confirmation du mot de passe</label>
                    	<div class="col-md-9">
                        	<input type="password" id="confirmpsw" class="form-control" name="confirme-password" onchange="confirmPassword()" placeholder="Confirmer votre mot de passe"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    	</div>
					<script>
						function confirmPassword()
						{
							var password = document.getElementById("psw").value;
							var confirmpsw = document.getElementById("confirmpsw").value;
							if( password != confirmpsw)
							{
								console.log("non");
								document.getElementById("confirmpsw").className += " confirm-error";
							}
							else
							{
								console.log("password match")
								document.getElementById("confirmpsw").className = "";
								document.getElementById("confirmpsw").className += " form-control";

							}

						}
					</script>
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
