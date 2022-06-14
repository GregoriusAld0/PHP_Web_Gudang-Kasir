<?php
	session_start();
	@ob_start();
	error_reporting(-1);
	ini_set('display_errors', 1);

	$configdb = array();
	$configdb['db'] = "merbabu1_CE";
	$configdb['host'] = "localhost";
	$configdb['user'] = "root";
	$configdb['pass'] = "";

	$con;

	try {
	    $con = new PDO("mysql:host=".$configdb['host'].";dbname=".$configdb['db'].";charset=utf8;", $configdb['user'], $configdb['pass']);
	    
	    if ($con) {
	        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } else {
	        die("Failed connect db");
	    }
	} catch (Exception $e) {
	    die("Failed connect db : " .$e->getMessage());
	}
?>