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
<!DOCTYPE html>
<html>
<head> 
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--------------- STYLE STARTS --------------->
<link rel="stylesheet" href="css/datepicker.css">
<link rel="stylesheet" href="css/modal.css">
<link rel="stylesheet" href="css/stickyfooter.css">
<link rel="stylesheet" href="css/sharemyclick.min.css">
<link rel="stylesheet" href="css/sharemyclick.css">
<link rel="stylesheet" href="css/sharemyclick-responsive.css">
<!--------------- STYLE ENDS --------------->

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http:///js/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<div id="wrap">
<!--------------- MENU STARTS --------------->
<?php include ('menu.php'); ?>
<!--------------- MENU ENDS --------------->

<!--------------- MENU PID STARTS --------------->
<?php include ('./menu/menu-pid.php'); ?>
<!--------------- MENU PID ENDS --------------->

	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-condensed">
				<thead>
					<tr class="active">
						<th style="width:20px">Date</th>
						<th style="width:80px">Leads re&ccedil;us</th>
						<th style="width:10px">Leads 70%</th>
						<th style="width:10px">Lead price</th>
						<th style="width:100px">Total net publisher</th>
						<th style="width:100px">Total brut publisher</th>
						<th style="width:10px">Diff&eacute;rence</th>
					</tr>
				</thead>
				<!--------------- START PRINT LEADS IN TBODY--------------->
				<tbody>
					<tr>
					<?php
					// Calcul du volume de lead pour le pid séléctionné + calcul des 70% (avec un arrondi à l'unité inférieur).
					$req = $bdd->prepare('SELECT COUNT(*) AS nb_lead_recu, reg_date2 FROM user WHERE pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end GROUP BY reg_date2');
					$req-> execute(array('pid_id' => $_POST['pid_id'],
										 'date_start' => $_POST['datepicker'],
										 'date_end' => $_POST['datepicker2'])) or die(print_r($req(errorInfo())));
					while ($donnees = $req->fetch())
					{
					$lead_70 = floor($donnees['nb_lead_recu']*0.7);
					?>
						<td><?php echo $date = $donnees['reg_date2']; ?></td>
						<td><?php echo $donnees['nb_lead_recu']; ?></td>
						<td><?php echo floor($donnees['nb_lead_recu']*0.7); ?></td><!-- On arrondi à l'unité inférieur avec le "floor" -->
						<td><?php
							// On affiche le prix du lead pour ce pid
							$req1 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req1->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req1(errorInfo())));
							while ($donnees = $req1->fetch())
							echo $donnees['pid_price'];
							?> &euro;
						</td>
						<td><?php
							// On lance le calcul du prix payé au pid séléctionné + marge faite sur le prix
							$req2 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req2->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req2(errorInfo())));
							while ($donnees = $req2->fetch())
							{
							?>
							<?php
							// On récupère le prix que l'on paie le pid et on lui attribut une variable
							$req3 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req3->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req3(errorInfo())));
							while ($donnees = $req3->fetch())
							$price = $donnees['pid_price'];
							?>
							<?php
							// On récupère le nombre de leads reçus par ce pid sur le jour en question et on lui attribut une variable
							$req4 = $bdd->prepare('SELECT COUNT(*) AS nb_lead_recu, reg_date2 FROM user WHERE pid_id=:pid_id AND reg_date2=:reg_date2');
							$req4-> execute(array('pid_id' => $_POST['pid_id'],
												  'reg_date2' => $date)) or die(print_r($req4(errorInfo())));
							while ($donnees = $req4->fetch())
							$total = $donnees['nb_lead_recu'];
							// On multiplie le prix * le nombre de leads reçu en comptant les 70% et on arrondi à l'unité inférieur avec le "floor"
							echo $price * floor($total*0.7); 
							?> &euro;
						</td>
						<td><?php echo $total*$price ?>&euro;</td><!-- On calcul ce qu'on devrait payer le pid sans les 70% -->
						<td></td>
					</tr>
					<?php
					}}
					?>
					<tr class="danger" style="font-weight:bolder;font-style:italic;">
						<td class="danger">Total</td>
						<td class="danger"><?php
						// Calcul du volume de lead généré par le pid au total.
						$req5 = $bdd->prepare('SELECT COUNT(*) AS nbr_lead_sponsor FROM user where pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
						$req5-> execute(array('pid_id' => $_POST['pid_id'],
										'date_start' => $_POST['datepicker'],
										'date_end' => $_POST['datepicker2'])) or die(print_r($req5(errorInfo())));
							 while ($donnees = $req5->fetch())
							{
							echo $donnees['nbr_lead_sponsor'];
							}
						?>
						</td>		
						<td class="danger"><?php
						// On calcul du volume de lead généré par le pid auquel on retire 30%.
						$req6 = $bdd->prepare('SELECT COUNT(*) AS nbr_lead_sponsor_70 FROM user where pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
						$req6-> execute(array('pid_id' => $_POST['pid_id'],
										'date_start' => $_POST['datepicker'],
										'date_end' => $_POST['datepicker2'])) or die(print_r($req6(errorInfo())));
							 while ($donnees = $req6->fetch())
							{
							echo floor($donnees['nbr_lead_sponsor_70']*0.70);
							}
						?>
						</td>
						<td class="danger"><?php
							// On affiche le prix du lead pour ce pid
							$req7 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req7->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req7(errorInfo())));
							while ($donnees = $req7->fetch())
							echo $donnees['pid_price'];
							?> &euro;
						</td>
						<td class="danger">
						<?php
							// On calcul le prix que l'on doit payé le publisher avec les 30% de descomptes.
							$req8 = $bdd->prepare('SELECT COUNT(*) AS total_lead_recu_70 FROM user WHERE pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
							$req8-> execute(array('pid_id' => $_POST['pid_id'],
												  'date_start' => $_POST['datepicker'],
												  'date_end' => $_POST['datepicker2'])) or die(print_r($req8(errorInfo())));
							while ($donnees = $req8->fetch())
							{
							$total70 = $donnees['total_lead_recu_70'];
							// On multiplie le prix * le nombre de leads reçu en comptant les 70% et on arrondi à l'unité inférieur avec le "floor"
							echo $total_70= $price * floor($total70*0.7);
							}
							?> &euro;
						</td>
						<td class="danger">
						<?php
							// On calcul le prix que l'on devrait payé le publisher sans les 30% de descomptes.
							$req9 = $bdd->prepare('SELECT COUNT(*) AS total_lead_recu FROM user WHERE pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
							$req9-> execute(array('pid_id' => $_POST['pid_id'],
												  'date_start' => $_POST['datepicker'],
												  'date_end' => $_POST['datepicker2'])) or die(print_r($req9(errorInfo())));
							while ($donnees = $req9->fetch())
							{
							$total100 = $donnees['total_lead_recu'];
							echo $total_100= $price * $total100;
							}
							?> &euro;
						</td>
						<td><?php 
						// On calcul la différence entre ce que paie et ce qu'on devrait payé
						echo $total_100 - $total_70;
						?> &euro;
						</td>
					</tr>
				</tbody>
				<!--------------- END PRINT LEADS IN TBODY--------------->
			</table>
		</div>
	</div>
</div>

</body>
</html>