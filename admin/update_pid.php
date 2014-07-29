<?php
// On inclut la page de paramètre de connection.
 
include('conf.php');

	// Insertion des données dans la table 'pid' à l'aide d'une requête préparée
	$req = $bdd->prepare('UPDATE pid SET country=:pid_country, price=:pid_price, pixel=:pid_pixel, color_code=:pid_color_code WHERE id=:id');
	
        $req->execute(array(
		'id' => $_POST['pid_name'],
		'pid_country' => $_POST['pid_country'],
		'pid_price' => $_POST['pid_price'],
		'pid_pixel' => stripslashes($_POST['pid_pixel']),
		'pid_color_code' => $_POST['colorpicker']
		)) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
	// On termine le traitement de la requête
	$req->closeCursor();
        //die('dfg');
        header('location:update-pid.php');
       
	?>