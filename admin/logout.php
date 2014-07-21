<?php  
include('conf.php');

// On active les sessions :
	session_start();

// Suppression des variables de session et de la session
$_SESSION = Array();
session_destroy;

// On redirige le visiteur vers la page désirée :
	header('Location: index.php');
	exit();
?>