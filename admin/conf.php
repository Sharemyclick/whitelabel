<?php
try
{
	// On se connecte à la base de données.
	$bdd = new PDO('mysql:host=mysql51-129.perso;dbname=mondevislt', 'mondevislt', 'j66rYSGmzKzb',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}
?>