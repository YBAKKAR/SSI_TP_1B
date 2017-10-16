ALTER TABLE `user` ADD `token` VARCHAR(200) NULL DEFAULT NULL ;
ALTER TABLE `user` ADD `active` INT( 1 ) NOT NULL DEFAULT '1'



			// Ma clé privée
			$secret = "6LcjRzQUAAAAAFThMCW7U48PZMs6M1A1mPM-z_Mm";
			// Paramètre renvoyé par le recaptcha
			$response = $_POST['g-recaptcha-response'];
			// On récupère l'IP de l'utilisateur
			$remoteip = $_SERVER['REMOTE_ADDR'];
			
			$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
				. $secret
				. "&response=" . $response
				. "&remoteip=" . $remoteip ;
			
			$decode = json_decode(file_get_contents($api_url), true);
			
			if ($decode['success'] == true) {
				echo "C'est un humain";
			}
			
			else {
				echo " C'est un robot ou le code de vérification essst incorrecte\n";
				foreach ($_POST as $key => $value) {
		echo '<p><strong> hhhh' . $key.':</strong> '.$value.'</p>';}
			}