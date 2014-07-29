<?php 
include('conf.php');
	if(isset($_POST) )
		{
	//extract($_POST);

	// recovering the entire contents of the table "pid"
	$req = $bdd->prepare('INSERT INTO pid (name, price, country, color_code, pixel) VALUES(:name,:price,:country,:color_code,:pixel)');
	//We execute the request by transmitting the parameter list
	$req->execute(array(
		'name' => $_POST['name'],
		'price' => $_POST['price'],
		'country' => $_POST['country'],
		'color_code' => $_POST['colorpicker'],
                'pixel' => $_POST['pixel']
		)
		) or die(print_r($req->errorInfo())); // It tracks the error if there is one
                // The request processing is completed
	$req->closeCursor();
	}

	// Redirect the visitor to the next page
       header("location:pid.php");
?>