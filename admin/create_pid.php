<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="admin.php"</script>';  
  exit;  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head> 
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--------------- DATEPICKER STARTS --------------->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
	$(document).ready(function() {
	$("#datepicker").datepicker({showOn: "focus",showAnim: "fold",dateFormat: 'yyyy-mm-dd',altField: "#actualDate"});
	});
</script>
<script>
	$(document).ready(function() {
	$("#datepicker2").datepicker({showOn: "focus",showAnim: "fold",dateFormat: 'yyyy-mm-dd',altField: "#actualDate"});
	});
</script>
<!--------------- DATEPICKER ENDS --------------->

<!--------------- STYLE STARTS --------------->
<link rel="stylesheet" href="css/datepicker.css">
<link rel="stylesheet" href="css/modal.css">
<link rel="stylesheet" href="css/stickyfooter.css">
<link rel="stylesheet" href="css/sharemyclick.min.css">
<link rel="stylesheet" href="css/sharemyclick.css">
<link rel="stylesheet" href="css/sharemyclick-responsive.css">
<!--------------- STYLE ENDS --------------->

<!--------------- JAVASCRIPT STARTS --------------->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<!--------------- JAVASCRIPT ENDS --------------->
	

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http:///js/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<div id="wrap">
<?php include ('menu.php'); ?>
<br><br><br>
<?php
// On récupère tout le contenu de la table "pid"
$req = $bdd->prepare('INSERT INTO `pid` (pid_name,pid_price,pid_country) VALUES(:pid_name,:pid_price,:pid_country)');
// On execute la requête en lui transmettant la liste des paramètres
	$req->execute(array(
		'pid_name' => $_POST['pid_name'],
		'pid_price' => $_POST['pid_price'],
		'pid_country' => $_POST['pid_country']
		)) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
			echo '<center><p style="color: #94b829;">Le pid a &eacute;t&eacute; cr&eacute;e avec succ&egrave;s.<br /></p></center>';
			echo '<center><p style="color: #000;">Pour cr&eacute;er un autre PID<br /><a href="pid.php">cliquez ici</a>.</p></center>';
// On termine le traitement de la requête
$req->closeCursor();
?>
<div id="footer">
    <div class="container">
        <p class="muted credit text-center">Leadgen Concept <strong>Gregory Adam</strong> and <strong>Jeremy Skelland</strong>.</p>
	</div>
</div>
</body>
</html>