<?php
// On inclut la page de paramètre de connection.
include('conf.php');

	// Insertion des données dans la table 'pid' à l'aide d'une requête préparée
	$req = $bdd->prepare('UPDATE pid SET country=:country,price=:price,pixel=:pixel,color_code=:color_code WHERE id=:id');
	$req->execute(array(
		'id' => $_POST['name'],
		'country' => $_POST['country'],
		'price' => $_POST['price'],
		'pixel' => stripslashes($_POST['pixel']),
		'color_code' => $_POST['colorpicker']
		));
		echo "<p align=center style='color:#04B404;text-decoration:underline;font-weight:bold;margin-top:50px'>Le pid a bien &eacute;t&eacute; modifi&eacute; !</p>";
		echo "<p align=center>Vous pouvez en modifier un autre en cliquant <a href='update_pid.php'>ici</a>.</p>";
	// On termine le traitement de la requête
	$req->closeCursor();
	?>