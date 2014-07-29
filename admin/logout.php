<?php  
include('conf.php');

// Session activation
	session_start();

// Destroy variables session and the session
$_SESSION = Array();
session_destroy;

// redirecting to the page:
	header('Location: index.php');
	exit();
?>