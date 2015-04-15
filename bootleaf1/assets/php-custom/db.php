<?php 

	# Connect to MySQL database
	$db = parse_ini_file('cti.ini');
	$dsn = $db['driver'].":host=".$db['host'].";dbname=".$db['dbname'];
	$conn = new PDO($dsn, $db['user'], $db['password']);

?>