<?php

	$db_host = 'localhost';
	//$db_user = 'wahoo';
	//$db_pass = 'iwued4_afiver';
	
	$db_user = 'root';
	$db_pass = 'root';
	
	$db_base = 'wahoo_accounts';

	$mysqli=mysqli_connect($db_host,$db_user,$db_pass,$db_base) or die("Database Error");

?>