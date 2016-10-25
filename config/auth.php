<?php
defined('ADMIN_USERNAME') or define('ADMIN_USERNAME','admin'); 	// Admin Username
defined('ADMIN_PASSWORD') or define('ADMIN_PASSWORD','admin');  // Admin Password
if (!isset($_SERVER['PHP_AUTH_USER']) 
    || !isset($_SERVER['PHP_AUTH_PW']) 
    || isset($_GET['reset']) 
    || $_SERVER['PHP_AUTH_USER'] != ADMIN_USERNAME 
    || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
	header("WWW-Authenticate: Basic realm=\"Admin Auth\"");
	header("HTTP/1.0 401 Unauthorized");  
    die ("Not authorized");
}
