<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Katniss Premium Admin Template</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="prettify/prettify.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('[id=li-dashboard]').removeClass('active');
		jQuery('[id=li-pid]').addClass('active');
		});
</script>

<!--------------- DATEPICKER STARTS --------------->
<script>
	jQuery(document).ready(function() {
	jQuery("#datepicker").datepicker({showOn: "focus",showAnim: "fold",dateFormat: 'yyyy-mm-dd',altField: "#actualDate"});
	});
</script>
<script>
	jQuery(document).ready(function() {
	jQuery("#datepicker2").datepicker({showOn: "focus",showAnim: "fold",dateFormat: 'yyyy-mm-dd',altField: "#actualDate"});
	});
</script>
<!--------------- DATEPICKER ENDS --------------->
</head>

<body>

<div class="mainwrapper">
	
    <?php include ('./menu/menu-left.php');?>
    
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
    	<div class="headerpanel">
        	<a href="" class="showmenu"></a>
            
            <div class="headerright">
            	<div class="dropdown notification">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">
                    	<span class="iconsweets-globe iconsweets-white"></span>
                    </a>
                    <ul class="dropdown-menu">
                    	<li class="nav-header">Notifications</li>
                        <li>
                        	<a href="">
                        	<strong>3 people viewed your profile</strong><br />
                            <img src="img/thumbs/thumb1.png" alt="" />
                            <img src="img/thumbs/thumb2.png" alt="" />
                            <img src="img/thumbs/thumb3.png" alt="" />
                            </a>
                        </li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="icon-user"></span> <strong>Bruce</strong> is now following you <small class="muted"> - 2 days ago</small></a></li>
                        <li class="viewmore"><a href="">View More Notifications</a></li>
                    </ul>
                </div><!--dropdown-->
                
    			<div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, <?php echo $_SESSION['login']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>
                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="icon-off"></span> Sign Out</a></li>
                    </ul>
                </div><!--dropdown-->
    		
            </div><!--headerright-->
            
    	</div><!--headerpanel-->
        <div class="breadcrumbwidget">
        	<ul class="skins">
                <li><a href="default" class="skin-color default"></a></li>
                <li><a href="orange" class="skin-color orange"></a></li>
                <li><a href="dark" class="skin-color dark"></a></li>
                <li>&nbsp;</li>
                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
                <li class="wide"><a href="" class="skin-layout wide"></a></li>
            </ul><!--skins-->
        	<ul class="breadcrumb">
                <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
                <li><a href="table-static.html">Tables</a> <span class="divider">/</span></li>
                <li class="active">Static Table</li>
            </ul>
        </div><!--breadcrumbs-->
        <div class="pagetitle">
        	<h1>Pid Rentability</h1> <span>This is a sample description for the page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
              
			<h4 class="widgettitle nomargin shadowed">Pid statistcs table</h4>
                <div class="widgetcontent bordered shadowed nopadding">
                    <form class="stdform stdform2" name="form" method="post">
							<p>
                                <label>Date Start</label>
                                <span class="field"><input type="date" name="datepicker" id="datepicker" class="input-xxlarge" required="required" /></span>
                            </p>
							<p>
                                <label>Date End</label>
                                <span class="field"><input type="date" name="datepicker2" id="datepicker2" class="input-xxlarge" required="required" /></span>
                            </p>
                            <p>
                                <label>Select Pid</label>
                                <span class="field">
									<select name="pid_id" id="pid_id" class="uniformselect">
										<option>ALL</option> 
										<?php
										// On récupère tout le contenu de la table 'pid'
										
										$reqPid = $bdd->query('SELECT * FROM pid ORDER BY id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
										// On affiche chaque entrée une à une et celà tant qu'il y en a
										while ($pid = $reqPid->fetch()){
										echo '<option value="'.$pid['id'].'">'.$pid['name'].'</option>';
											}
											?> 	<option value="99999">99999</option> <?php
												
										?>		
									</select>
								</span>
                            </p>
							<p>
                                <label>Select Quote</label>
                                <span class="field">
									<select name="quote_id" id="quote_id" class="uniformselect">
									
										<option value="ALL">ALL</option> 
										<?php
										// On récupère tout le contenu de la table 'jc'
										$reqQuote = $bdd->query('SELECT * FROM devis ORDER BY id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
										// On affiche chaque entrée une à une et celà tant qu'il y en a
										while ($quote = $reqQuote->fetch()){
										echo '<option value="'.$quote['id'].'">'.$quote['name'].'</option>';
											}
											?> 	
									</select>
								</span>
                            </p> 		
                            
                            <p>
                                <label>Select Form</label>
                                <span class="field">
									<select name="form_id" id="form_id" class="uniformselect">
									
										<option value="ALL">ALL</option> 
										<?php
										// On récupère tout le contenu de la table 'jc'
										$reqForm = $bdd->query('SELECT * FROM form ORDER BY id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
										// On affiche chaque entrée une à une et celà tant qu'il y en a
										while ($form = $reqForm->fetch()){
										echo '<option value="'.$form['id'].'">'.$form['name'].'</option>';
											}
											?> 	
									</select>
								</span>
                            </p> 		
                            
                            <p class="stdformbutton">
                                <button class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn">Reset Button</button>
                            </p>
                        </form>
                </div><!--widgetcontent-->
			
			<div class="divider15"></div>			
			<h4 class="widgettitle">PID Rentability</h4>
            	<table class="table table-bordered">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="centeralign">Date</th>
                            <th class="centeralign">Leads generated</th>
                            <th class="centeralign">Lead 70%</th>
                            <th class="centeralign">Lead price</th>
                            <th class="centeralign">Total net publisher</th>
							<th class="centeralign">Total gross publisher</th>
							<th class="centeralign">Margin</th>
                        </tr>
                    </thead>
					<!--------------- START PRINT LEADS IN TBODY--------------->
				<tbody>
					<tr>
					<?php
					// Calcul du volume de lead pour le pid séléctionné + calcul des 70% (avec un arrondi à l'unité inférieur).
					//$nbleads = array();
					//$req_coregs = $bdd->query("SELECT id,coreg_target FROM `coreg`  "); /*WHERE status = '1'*/
						/*	
							while ($coregs = $req_coregs->fetch()){
							
								$req = $bdd->prepare("SELECT SUM( nb_lead_recu) AS nb_lead_recu, reg_date2
										FROM (
										SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id
										FROM user u
										INNER JOIN user_coreg uc ON u.id = uc.user_id
										INNER JOIN coreg c ON c.id = uc.coreg_id 
										INNER JOIN webservice ws ON ws.id = c.coreg_ws
										INNER JOIN webservice_logs l ON l.input like CONCAT('', ws.url ,'%')  AND l.input like CONCAT('%', u.email ,'%')
										WHERE validated=1 AND pid_id =:pid_id
										AND reg_date2 >=:date_start
										AND reg_date2 <= :date_end
										AND c.id = ".$coregs['id']."
										AND l.output NOT LIKE '%ko%'
										AND l.output NOT LIKE '%KO%'		
										AND uc.user_id IN (SELECT id from user where 1 ".stripslashes($coregs['coreg_target'])." )
										GROUP BY reg_date2, user_id)temp GROUP BY reg_date2");
										$req-> execute(array('pid_id' => $_POST['pid_id'],
										 'date_start' => $_POST['datepicker'],
										 'date_end' => $_POST['datepicker2']));
										 while ($donnees = $req->fetch()){
										 $nbleads[$donnees['reg_date2']] += $donnees['nb_lead_recu'];
										 }
							}
					$req_sponsors = $bdd->query("SELECT id,sponsor_target FROM `sponsor`  ");
							
							while ($sponsors = $req_sponsors->fetch()){
							
								$req = $bdd->prepare("SELECT SUM( nb_lead_recu) AS nb_lead_recu, reg_date2
										FROM (
										SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id
										FROM user u
										INNER JOIN user_sponsor uc ON u.id = uc.user_id
										INNER JOIN sponsor c ON c.id = uc.sponsor_id 
										INNER JOIN webservice ws ON ws.id = c.sponsor_ws
										INNER JOIN webservice_logs l ON l.input like CONCAT('', ws.url ,'%')  AND l.input like CONCAT('%email=', REPLACE(u.email,'@','%40') ,'%')
										WHERE validated=1 AND pid_id =:pid_id
										AND reg_date2 >=:date_start
										AND reg_date2 <= :date_end
										AND c.id = ".$sponsors['id']."
										AND l.output NOT LIKE '%ko%'
										AND l.output NOT LIKE '%KO%'	
										AND l.output NOT LIKE '%error%'	AND l.output NOT LIKE '%Error%'	AND l.output NOT LIKE '%does not%' AND l.output NOT LIKE '%repetido%' 		
										AND uc.user_id IN (SELECT id from user where 1 ".stripslashes($sponsors['sponsor_target'])." )
										GROUP BY reg_date2, user_id)temp GROUP BY reg_date2");
										$req-> execute(array('pid_id' => $_POST['pid_id'],
										 'date_start' => $_POST['datepicker'],
										 'date_end' => $_POST['datepicker2']));
										 while ($donnees2 = $req->fetch()){
										 $nbleads[$donnees2['reg_date2']] += $donnees2['nb_lead_recu'];
										 }
							}
					*/				
					if($_POST['jc_id'] == 'ALL'){
						$req = $bdd->prepare("SELECT SUM( nb_lead_recu) AS nb_lead_recu, reg_date2, source
											FROM (
											SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id, source
											FROM user u
											INNER JOIN user_coreg uc ON u.id = uc.user_id
											WHERE pid_id =:pid_id
											AND first_jc_id <> ''
											AND reg_date2 >=:date_start
											AND reg_date2 <= :date_end
											GROUP BY reg_date2, user_id, source
											UNION
											SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id, source
											FROM user u2
											INNER JOIN user_sponsor us ON u2.id = us.user_id
											WHERE pid_id =:pid_id
											AND first_jc_id <> ''
											AND reg_date2 >=:date_start
											AND reg_date2 <= :date_end
											GROUP BY reg_date2, user_id, source
											)temp
											GROUP BY reg_date2, source");
						$req-> execute(array('pid_id' => $_POST['pid_id'],
											 'date_start' => $_POST['datepicker'],
											 'date_end' => $_POST['datepicker2']));
					}else{
												$req = $bdd->prepare("SELECT SUM( nb_lead_recu) AS nb_lead_recu, reg_date2
											FROM (
											SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id
											FROM user u
											INNER JOIN user_coreg uc ON u.id = uc.user_id
											WHERE pid_id =:pid_id
											AND first_jc_id =:jc_id
											AND reg_date2 >=:date_start
											AND reg_date2 <= :date_end
											GROUP BY reg_date2, user_id
											UNION
											SELECT COUNT(DISTINCT user_id) AS nb_lead_recu, reg_date2, user_id
											FROM user u2
											INNER JOIN user_sponsor us ON u2.id = us.user_id
											WHERE pid_id =:pid_id
											AND first_jc_id =:jc_id
											AND reg_date2 >=:date_start
											AND reg_date2 <= :date_end
											GROUP BY reg_date2, user_id
											)temp
											GROUP BY reg_date2");
						$req-> execute(array('pid_id' => $_POST['pid_id'],
											 'jc_id' => $_POST['jc_id'],
											 'date_start' => $_POST['datepicker'],
											 'date_end' => $_POST['datepicker2']));

						}
										 
										 
										 
										  while ($donnees2 = $req->fetch()){
										 $nbleads[$donnees2['reg_date2']] += $donnees2['nb_lead_recu'];
										 if($_POST['jc_id'] == 'ALL')
										 $leadspid[$donnees2['reg_date2']][$donnees2['source']] = $donnees2['nb_lead_recu'];
										 }
					//while ($donnees = $req->fetch())
					$nbleadstotal = 0;
					$nbleadstotalbysweepstake = array();
					foreach($nbleads as $indLead => $valLead)
					{
					$lead_70 = floor(/*$donnees['nb_lead_recu']*/$valLead*0.7);
					$nbleadstotal += $valLead;
					?>
						<td><?php echo $indLead/*$date = $donnees['reg_date2']*/; ?></td>
						<td>					
						<?php foreach($leadspid[$indLead] as $indleadpid => $valleadpid){
						echo $indleadpid." : <span class='badge'>".$valleadpid."</span><br />";
						$nbleadstotalbysweepstake[$indleadpid] +=  $valleadpid;
						}
						echo $valLead/*$donnees['nb_lead_recu']*/; 
						?>
						</td>
						<td><?php echo floor(/*$donnees['nb_lead_recu']*/$valLead*0.7); ?></td><!-- On arrondi à l'unité inférieur avec le "floor" -->
						<td><?php
							// On affiche le prix du lead pour ce pid
							$req1 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req1->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req1(errorInfo())));
							while ($donnees = $req1->fetch()){
							echo $donnees['pid_price'];}
							if($_POST['pid_id'] == 99999){$donnees['pid_price'] = 1;echo $donnees['pid_price'];}
							?> &euro;
						</td>
						<td><?php
							// On lance le calcul du prix payé au pid séléctionné + marge faite sur le prix
							$req2 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req2->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req2(errorInfo())));
							//while ($donnees = $req2->fetch())
							//{
							?>
							<?php
							// On récupère le prix que l'on paie le pid et on lui attribut une variable
							$req3 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req3->execute(array('pid_id' => $_POST['pid_id'])) or die(print_r($req3(errorInfo())));
							while ($donnees = $req3->fetch()){
							$price = $donnees['pid_price'];}
							if($_POST['pid_id'] == 99999)$price = 1;
							
							// On récupère le nombre de leads reçus par ce pid sur le jour en question et on lui attribut une variable
							if($_POST['jc_id'] == 'ALL'){
								$req4 = $bdd->prepare("SELECT SUM( nb_lead_recu ) AS nb_lead_recu, reg_date2, source
											FROM (

											SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id, source
											FROM user u
											INNER JOIN user_coreg uc ON u.id = uc.user_id
											WHERE pid_id = :pid_id
											AND first_jc_id <> ''
											AND reg_date2 = :reg_date2
											GROUP BY reg_date2, user_id, source
											UNION
											SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id, source
											FROM user u2
											INNER JOIN user_sponsor us ON u2.id = us.user_id
											WHERE pid_id = :pid_id
											AND first_jc_id <> ''
											AND reg_date2 = :reg_date2
											GROUP BY reg_date2, user_id, source
											)temp
											GROUP BY reg_date2, source");
								$req4-> execute(array('pid_id' => $_POST['pid_id'],
													  'reg_date2' => $date)) or die(print_r($req4(errorInfo())));
							}else{
								$req4 = $bdd->prepare("SELECT SUM( nb_lead_recu ) AS nb_lead_recu, reg_date2
										FROM (

										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u
										INNER JOIN user_coreg uc ON u.id = uc.user_id
										WHERE pid_id = :pid_id
										AND first_jc_id = :jc_id
										AND reg_date2 = :reg_date2
										GROUP BY reg_date2, user_id
										UNION
										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u2
										INNER JOIN user_sponsor us ON u2.id = us.user_id
										WHERE pid_id = :pid_id
										AND first_jc_id = :jc_id
										AND reg_date2 = :reg_date2
										GROUP BY reg_date2, user_id
										)temp
										GROUP BY reg_date2");
							$req4-> execute(array('pid_id' => $_POST['pid_id'],'jc_id' => $_POST['jc_id'],
												  'reg_date2' => $date)) or die(print_r($req4(errorInfo())));
								}
							while ($donnees = $req4->fetch()){
							$total = $donnees['nb_lead_recu'];}
							// On multiplie le prix * le nombre de leads reçu en comptant les 70% et on arrondi à l'unité inférieur avec le "floor"
							echo $price * floor(/*$total*/$valLead*0.7); 
							?> &euro;
						</td>
						<td><?php echo /*$total*/$valLead*$price; ?>&euro;</td><!-- On calcul ce qu'on devrait payer le pid sans les 70% -->
						<td><?php echo /*$total*/(($valLead*$price) - ($price * floor(/*$total*/$valLead*0.7))) ; ?> </td>
					</tr>
					<?php
					}//}
					?>
					<tr class="danger" style="font-weight:bolder;font-style:italic;">
						<td class="danger">Total</td>
						<td class="danger"><?php
						// Calcul du volume de lead généré par le pid au total.
						/*$req5 = $bdd->prepare('SELECT COUNT(*) AS nbr_lead_sponsor FROM user u INNER JOIN user_coreg uc ON u.id = uc.user_id where pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
						$req5-> execute(array('pid_id' => $_POST['pid_id'],
										'date_start' => $_POST['datepicker'],
										'date_end' => $_POST['datepicker2']));
							 while ($donnees = $req5->fetch())
							{
							echo $donnees['nbr_lead_sponsor'];
							}*/
							foreach($nbleadstotalbysweepstake as $indleadpidbysweepstake => $valleadpidbysweepstake){
								echo $indleadpidbysweepstake." : <span class='badge'>".$valleadpidbysweepstake."</span><br />";
							}
							echo $nbleadstotal;
						?>
						</td>		
						<td class="danger"><?php
						// On calcul du volume de lead généré par le pid auquel on retire 30%.
						/*$req6 = $bdd->prepare('SELECT COUNT(*) AS nbr_lead_sponsor_70 FROM user u INNER JOIN user_coreg uc ON u.id = uc.user_id where pid_id=:pid_id  AND reg_date2>=:date_start AND reg_date2<=:date_end');
						$req6-> execute(array('pid_id' => $_POST['pid_id'],
										'date_start' => $_POST['datepicker'],
										'date_end' => $_POST['datepicker2']));
							 while ($donnees = $req6->fetch())
							{
							echo floor($donnees['nbr_lead_sponsor_70']*0.70);
							}*/
							echo floor(/*$donnees['nb_lead_recu']*/$nbleadstotal*0.7);
						?>
						</td>
						<td class="danger"><?php
							// On affiche le prix du lead pour ce pid
							$req7 = $bdd->prepare('SELECT id,pid_price FROM pid WHERE id=:pid_id');
							$req7->execute(array('pid_id' => $_POST['pid_id']));
							while ($donnees = $req7->fetch()){
							echo $donnees['pid_price'];}
							if($_POST['pid_id'] == 99999){$donnees['pid_price'] = 1;echo $donnees['pid_price'];}
							?> &euro;
						</td>
						<td class="danger">
						<?php
							// On calcul le prix que l'on doit payé le publisher avec les 30% de descomptes.
							/*$req8 = $bdd->prepare('SELECT COUNT(*) AS total_lead_recu_70 FROM user u INNER JOIN user_coreg uc ON u.id = uc.user_id WHERE pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
							$req8-> execute(array('pid_id' => $_POST['pid_id'],
												  'date_start' => $_POST['datepicker'],
												  'date_end' => $_POST['datepicker2']));
							while ($donnees = $req8->fetch())
							{
							$total70 = $donnees['total_lead_recu_70'];
							// On multiplie le prix * le nombre de leads reçu en comptant les 70% et on arrondi à l'unité inférieur avec le "floor"
							echo $total_70= $price * floor($total70*0.7);*/
							echo $total_70 = $price * floor(/*$total*/$nbleadstotal*0.7); 
							//}
							?> &euro;
						</td>
						<td class="danger">
						<?php
							// On calcul le prix que l'on devrait payé le publisher sans les 30% de descomptes.
							/*$req9 = $bdd->prepare('SELECT COUNT(*) AS total_lead_recu FROM user u INNER JOIN user_coreg uc ON u.id = uc.user_id WHERE pid_id=:pid_id AND reg_date2>=:date_start AND reg_date2<=:date_end');
							$req9-> execute(array('pid_id' => $_POST['pid_id'],
												  'date_start' => $_POST['datepicker'],
												  'date_end' => $_POST['datepicker2']));
							while ($donnees = $req9->fetch())
							{
							$total100 = $donnees['total_lead_recu'];
							echo $total_100= $price * $total100;
							}*/
							echo $total_100=/*$total*/$nbleadstotal*$price;
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
			
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>
