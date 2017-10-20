<?php
	include('conf/db.inc');
	
	function generate_signature_with_secret($data)
	{
		$options = [
            'salt' => "XRoxnzQl2CDD.IVrzwKAQOOlPZkiU659oyplKfuv31D.wL8VX7QFS", // use secret salt included in conf/db.inc 
        ];
        $signature = password_hash ($data,PASSWORD_DEFAULT,$options);
		return $signature;
	}
	
	function verify_signature_with_secret($data,$signature)
	{
		return generate_signature_with_secret($data) == $signature;
	}
	///////////////////////////////////////////////////////////////////////////
	// USER STATUS
	function should_connect(){
		return (isset($_SESSION['username']) && isset($_COOKIE[$_SESSION['username']]) && verify_cookies($_COOKIE[$_SESSION['username']]));
	}
	
	function login_correct(){
		return (isset($_SESSION['username']));
	}
	
	function first_time(){
		return login_correct() && !isset($_COOKIE[$_SESSION['username']]);
	}
	// COOKIES FUNCTIONS 
	function verify_cookies($cookie)
	{
		$str=":";
		list($cookie_value,$value_signature) = explode($str,$cookie);
		
		echo verify_signature_with_secret($cookie_value,$value_signature);
		return verify_signature_with_secret($cookie_value,$value_signature);
	}
	
	function generate_cookies($username) // username:signature
	{	$str=":";
		$cookie_value = $username;
		$value_signature = generate_signature_with_secret($cookie_value);
		
		$cookie_value = $cookie_value.$str.$value_signature;
		
		setcookie($username,$cookie_value,time()+3600*24*30);
		return true;
	}
	// TWO STEP VERIFICATION FUNCTIONS
	function generate_2step_verification_hash($username){ // 5min duration
		$str=":";
		$random_nbr= rand(10,60);
		$expire_in = time()+60*5;
		session_start();
		$_SESSION['expire_token'] = $expire_in;
		$pre_signature = $username.$str.$expire_in.$str.$random_nbr;
		
		$signature = generate_signature_with_secret($pre_signature);
		
		$hash = substr($signature,$random_nbr,5).$random_nbr;
		return $hash;
	}
	
	function verify_2step_verification_hash($username,$hash)
	{
		$str=":";$hash_size = strlen($hash);
		$random_nbr = substr($hash,$hash_size-2,2);
		$signature = substr($hash,0,$hash_size-2);
		$expire_in=0;
		if(isset($_SESSION['expire_token']))
		{
			$expire_in = $_SESSION['expire_token'];
		}
		
		$pre_signature = $username.$str.$expire_in.$str.$random_nbr;
		$ver_signature = generate_signature_with_secret($pre_signature);
		$ver_signature = substr($ver_signature,$random_nbr,5);
		
		return ($ver_signature == $signature) && (time()<= $expire_in);
	}

?>