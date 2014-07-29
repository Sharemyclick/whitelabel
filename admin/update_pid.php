<?php
// It includes parameters connection
 
include('conf.php');

	// Insertion of data in the table pid
	$req = $bdd->prepare('UPDATE pid SET country=:pid_country, price=:pid_price, pixel=:pid_pixel, color_code=:pid_color_code WHERE id=:id');
	
        $req->execute(array(
		'id' => $_POST['pid_name'],
		'pid_country' => $_POST['pid_country'],
		'pid_price' => $_POST['pid_price'],
		'pid_pixel' => stripslashes($_POST['pid_pixel']),
		'pid_color_code' => $_POST['colorpicker']
		)) or die(print_r($req->errorInfo())); // it tracks error if there is one
	// processing of the request
	$req->closeCursor();
        header('location:update-pid.php');
       
	?>