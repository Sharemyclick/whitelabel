<?php 
include('conf.php');
	if(isset($_POST) )
		{
	//extract($_POST);

	// On récupère tout le contenu de la table "pid"
	$req = $bdd->prepare('INSERT INTO pid (name, price, country, color_code, pixel) VALUES(:name,:price,:country,:color_code,:pixel)');
	// On execute la requête en lui transmettant la liste des paramètres
	$req->execute(array(
		'name' => $_POST['name'],
		'price' => $_POST['price'],
		'country' => $_POST['country'],
		'color_code' => $_POST['colorpicker'],
                'pixel' => $_POST['pixel']
		)
		) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
	// On termine le traitement de la requête
	$req->closeCursor();
	}

	// Redirection du visiteur vers la page suivante  
       header("location:pid.php");
?>