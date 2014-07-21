<?php
try
{
	// On se connecte � la base de donn�es.
	//$bdd = new PDO('mysql:host=mysql51-129.perso;dbname=mondevislt', 'mondevislt', 'j66rYSGmzKzb',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        // On se connecte � la base de donn�es.
	$bdd = new PDO('mysql:host=localhost;dbname=whitelabel', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	// En cas d'erreur, on affiche un message et on arr�te tout
	die('Erreur : '.$e->getMessage());
}
?>