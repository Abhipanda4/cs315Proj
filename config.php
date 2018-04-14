<?php

/**
 *  * Configuration for database connection
 *   *
 *    */

$host       = "172.24.33.188";
$username   = "apanda";
$password   = "abc";
$dbname     = "cs315"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
	                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			        );
