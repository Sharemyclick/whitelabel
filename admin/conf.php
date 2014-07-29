<?php
session_start(); 

$url_temp = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
if($url_temp == 'connect.php')$_SESSION['first_log'] = true;
try
{
	// On se connecte � la base de donn�es.
	$bdd = new PDO('mysql:host=localhost;dbname=white_label', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	// En cas d'erreur, on affiche un message et on arr�te tout
	die('Erreur : '.$e->getMessage());
}

if($_SERVER['REMOTE_ADDR'] != '127.0.0.1'){

if(!isset($_SESSION['first_log']) || $_SESSION['first_log'] === false){
$file_url = str_replace(".php","",$url_temp);
        $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = '".$file_url."' and admin_rights_id = ".$_SESSION['right']);
        if($req_menu->rowCount() == 0){
            session_destroy();        
            header('location:index.php');
        }/*else{
            header("location:".$url_temp);
        }*/
}
//$_SESSION['first_log'] = false;
}
?>
