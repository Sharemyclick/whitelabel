<?php
// it includes connection parameters
include('conf.php');
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sharemyclick admin platform V1.0</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="prettify/prettify.css" type="text/css" />
<link rel="stylesheet" href="css/ui.jqgrid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-editable.css" type="text/css" />
<link rel="stylesheet" href="css/daterangepicker-bs3.css" type="text/css" media="all" />

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/bootstrap-editable.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script src="js/main.js"></script>
</head>

<body>

<div class="mainwrapper">
	
	<?php include ('./menu/menu-left.php');?>
    
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
    	<div class="headerpanel">
        	<a href="" class="showmenu"></a>
            
            <div class="headerright">
                
    			<div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, <?php echo $_SESSION['login']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><span class="icon-off"></span> Sign Out</a></li>
                    </ul>
                </div><!--dropdown-->
    		
            </div><!--headerright-->
            
    	</div><!--headerpanel-->
        <div class="breadcrumbwidget">
        	<ul class="skins">
                <li><a href="default" class="skin-color default"></a></li>
                <li><a href="orange" class="skin-color orange"></a></li>
				<li><a href="green" class="skin-color green"></a></li>
                <li><a href="dark" class="skin-color dark"></a></li>
                <li>&nbsp;</li>
                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
                <li class="wide"><a href="" class="skin-layout wide"></a></li>
            </ul><!--skins-->
        	<ul class="breadcrumb">
                <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
                <li class="active">Dashboard</li>
            </ul>
        </div><!--breadcrumbwidget-->
      <div class="pagetitle">
        	<h1>View leads</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please see all the leads</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
        	<div class="contentinner content-dashboard">
			
			<div class="row-fluid">
                	<div class="span12">
						<h4 class="widgettitle nomargin shadowed">You will be able to select the leads you want from here</h4>
                    	<div class="widgetcontent bordered shadowed nopadding">
							<form name="myForm" id="myForm" class="stdform stdform2" method="POST" action="#">

								
									
									
									<select name="partner_name" id="selection2" class="select">
									<option value="">Select your Devis</option>
										<?php 
									$reqQuote = $bdd->query("SELECT * FROM devis");
									while ($quote = $reqQuote->fetch()){?>
									<option value="<?php echo $quote['id']; ?>"<?php if($quote['name'] == $_POST['partner_name']){?> selected <?php } ?>><?php echo $quote['name']; ?></option>
									<?php }?>
									</select>
								
									
									
									<select name="payout_affiliate" id="selection2" class="select">
									<option value="">Select your payout for Affiliate</option>
										<?php 
									$req_jc = $bdd->query("SELECT * FROM campaign_management");
									while ($val_jc = $req_jc->fetch()){?>
									<option value="<?php echo $val_jc['payout_affiliate']; ?>"<?php if($val_jc['payout_affiliate'] == $_POST['payout_affiliate']){?> selected <?php } ?> ><?php echo $val_jc['payout_affiliate']; ?></option>
									<?php }?>
									</select>
								
									
									
									<select name="payout_smc" id="selection2" class="select">
									<option value="">Select your payout for SMC</option>
										<?php 
									$req_jc = $bdd->query("SELECT * FROM campaign_management");
									while ($val_jc = $req_jc->fetch()){?>
									<option value="<?php echo $val_jc['payout_smc']; ?>"<?php if($val_jc['payout_smc'] == $_POST['payout_smc']){?> selected <?php } ?>><?php echo $val_jc['payout_smc']; ?></option>
									<?php }?>
									</select>
								
									
									
									<select name="type_payout_management" id="selection2" class="select">
									<option value=""<?php if($_POST['type_payout_management']==''){ echo 'selected';}  ?>>Select your type of payout </option>
									<option value="CPC"<?php if($_POST['type_payout_management']=='CPC'){ echo 'selected';}  ?>> CPC</option>
                                                                         <option value="CPM"<?php if($_POST['type_payout_management']=='CPM'){ echo 'selected';}  ?>> CPM</option>
                                                                        <option value="CPL"<?php if($_POST['type_payout_management']=='CPL'){ echo 'selected';}  ?>>CPL</option>
                                                                         <option value="CPA"<?php if($_POST['type_payout_management']=='CPA'){ echo 'selected';}  ?>>CPA</option>
                                                                         <option value="C2L"<?php if($_POST['type_payout_management']=='C2L'){ echo 'selected';}  ?>>C2L</option>
                                                                        <option value="CPV"<?php if($_POST['type_payout_management']=='CPV'){ echo 'selected';}  ?>>CPV</option>	
									</select>
								
									
									
									<select name="country" id="selection2" class="select">
									<option value="">Select your country</option>
										<?php 
									$req_country = $bdd->query("SELECT * FROM country");
									while ($val_country = $req_country->fetch()){?>
									<option value="<?php echo $val_country['name_country']; ?>"<?php if($val_country['name_country'] == $_POST['country']){?> selected <?php } ?>><?php echo $val_country['name_country']; ?></option>
									<?php }?>
									</select>
								
                           
                           <select name="allowed" id="type_payout" class="select">
                                    <option value=""<?php if($_POST['allowed']===''){ echo 'selected';}  ?>>Select your choice of incentive</option>
                                        <option value=" Not Allowed"<?php if($_POST['allowed']==='Not Allowed'){ echo 'selected';}  ?>> Not Allowed</option>
                                        <option value="Allowed"<?php if($_POST['allowed']==='Allowed'){ echo 'selected';}  ?>> Allowed</option>
                                        <option value="Could be allowed in DOI"<?php if($_POST['allowed']==='Could be allowed in DOI'){ echo 'selected';}  ?>>Could be allowed in DOI</option>
                                        

                                </select> 
                       
                            <select name="conversion" id="type_payout" class="select">
                                    <option value=""<?php if($val_jc['conversion']===''){ echo 'selected';}  ?>>Select your conversion</option>
                                        <option value="On Purchase"<?php if($_POST['conversion']=='On Purchase'){ echo ' selected';}  ?>> On Purchase</option>
                                        <option value="Single Optin"<?php if($_POST['conversion']=='Single Optin'){ echo ' selected';}  ?>> Single Optin</option>
                                        <option value="Double Optin"<?php if($_POST['conversion']=='Double Optin'){ echo ' selected';}  ?>>Double Optin</option>
                                          <option value="Single or Double Optin"<?php if($_POST['conversion']=='Single or Double Optin'){ echo ' selected';}  ?>> Single or Double Optin</option>

                                </select> 
                        
                        
                           
                           <select name="device" id="type_payout" class="select">
                                    <option value=""<?php if($_POST['device']===''){ echo 'selected';}  ?>>Select your device</option>
                                        <option value="Desktop"<?php if($_POST['device']==='Desktop'){ echo 'selected';}  ?>> Desktop</option>
                                        <option value="Mobile"<?php if($_POST['device']==='Mobile'){ echo 'selected';}  ?>> Mobile</option>
                                        <option value="Both"<?php if($_POST['device']==='Both'){ echo 'selected';}  ?>>Both</option>
                                        

                                </select> 
                       
			<p class="stdformbutton">
			<button type="submit" name="filterCampaigns" id="filterCampaigns" class="btn btn-info">See results</button>
			<!--<button type="submit" name="export" id="export" onclick="$('#myForm').get(0).setAttribute('action', '');" class="btn btn-success">Export Excel</button>-->
			<button type="reset" class="btn">Reset</button>
								</p>
							</form>
						</div>
                    </div><!--span12-->
            </div><!--row-fluid-->
			<?php if(isset($_POST['filterCampaigns'])) { ?>
            <table class="table table-bordered" id="list">
					<colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <!--<col class="con1" />-->
						<col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
						<col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
						<col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
						<col class="con0" />
						<col class="con1" />
                        <!--<col class="con0" />-->
                    </colgroup>
					<thead>
                        <tr>
							<th class="centeralign">Campaign</th>
							<th class="centeralign">Advertiser</th>
							<th class="centeralign">Payout Advertiser</th>
							<th class="centeralign">Payout SMC</th>
							<th class="centeralign">Type Payout</th>
							<!--<th class="centeralign">Time</th>-->
							<th class="centeralign">Country</th>
							<th class="centeralign">Allowed</th>
							<th class="centeralign">Conversion</th>
							<th class="centeralign">Device</th>
							<th class="centeralign">Thumbnail</th>
							<!--<th class="centeralign">Clicks</th>
							<th class="centeralign">Clicks %</th>
							<th class="centeralign">Bounced</th>
							<th class="centeralign">Bounced %</th>
							<th class="centeralign">Compl.</th>
							<th class="centeralign">Compl. %</th>
							<th class="centeralign">Unsubs.</th>
							<th class="centeralign">Unsubs. %</th>
							<th class="centeralign">Leads</th>
							<th class="centeralign">CR %</th>
							<th class="centeralign">Revenue</th>
							<th class="centeralign">Ecpm</th>
							<th class="centeralign">Ecpc</th>
							<th class="centeralign">Database</th> 
							<th class="centeralign">Approval</th>-->
						</tr>
                    </thead>
                    
					<tbody style="font-size:10px;">
						<?php
						
                                                $cond1 = "1";
                                                $cond2 = "";
                                                $cond3 = "";
                                                $cond4 = "";
                                                $cond5 = "";
                                                $cond6 = "";
                                                $cond7 = "";
                                                $cond8 = "";
						
						if(isset($_POST['partner_name']) && $_POST['partner_name'] != ''){
							$cond1 .= " AND cm.id_campaign_management = ".$_POST['partner_name'];
						}
						if(isset($_POST['payout_affiliate']) && $_POST['payout_affiliate'] != '' ){
							$cond2 .= " AND cm.payout_affiliate = '".$_POST['payout_affiliate']."'";
						}
						if(isset($_POST['payout_smc']) && $_POST['payout_smc'] != ''){
							$cond3 .= " AND cm.payout_smc = '".$_POST['payout_smc']."'";
						}
						if(isset($_POST['type_payout_management']) && $_POST['type_payout_management'] != ''){
							$cond4 .= " AND cm.type_payout_management = '".$_POST['type_payout_management']."'";
						}
                                                if(isset($_POST['country']) && $_POST['country'] != ''){
							$cond5 .= " AND c.name_country = '".$_POST['country']."'";
						}
                                                if(isset($_POST['allowed']) && $_POST['allowed'] != ''){
							$cond6 .= " AND cm.allowed = '".$_POST['allowed']."'";
						}
                                                if(isset($_POST['conversion']) && $_POST['conversion'] != ''){
							$cond7 .= " AND cm.conversion = '".$_POST['conversion']."'";
						}
                                                if(isset($_POST['device']) && $_POST['device'] != ''){
							$cond8 .= " AND cm.device = '".$_POST['device']."'";
						}
                                                
					// On recupere tout le contenu de la table 'campaigns'
					$reponse = $bdd->query('SELECT * FROM campaign_management cm LEFT JOIN country c ON c.id_country=cm.id_country LEFT JOIN campaign_management_category cmc ON cmc.id_campaigns_management=cm.id_campaign_management LEFT JOIN category_product cp ON cp.id_category_product=cmc.id_category LEFT JOIN advertiser adv ON adv.id_advertiser=cm.id_advertiser WHERE '.$cond1.$cond2.$cond3.$cond4.$cond5.$cond6.$cond7.$cond8) or die(print_r($bdd->errorInfo())); 
					// On affiche chaque entree une a  une et cela  tant qu'il y en a
				
					while ($donnees = $reponse->fetch())
						{
						
                        echo '<tr>';
                            echo '<td class="centeralign">'.$donnees['name'].'</td>';
                              echo '<td class="centeralign">'.$donnees['company_name'].'</td>';
                                echo '<td class="centeralign">'.$donnees['payout_affiliate'].'</td>';
                                  echo '<td class="centeralign">'.$donnees['payout_smc'].'</td>';
                                    echo '<td class="centeralign">'.$donnees['type_payout_management'].'</td>';
                                      echo '<td class="centeralign">'.$donnees['name_country'].'</td>';
                                        echo '<td class="centeralign">'.$donnees['allowed'].'</td>';
                                          echo '<td class="centeralign">'.$donnees['conversion'].'</td>';
                                            echo '<td class="centeralign">'.$donnees['device'].'</td>';
                                              echo '<td class="centeralign">'.$donnees['thumbnail'].'</td>';
                                            
							/*echo '<td class="centeralign"><a href="#" id="type_name'.$donnees['id'].'" data-type="select" data-title="Enter Acquisition Type">'.$donnees['type_name_'].'</a></td>';
                            echo '<td class="centeralign"><a href="#" id="partner_name'.$donnees['id'].'" data-type="select" data-title="Select Partner Name">'.$donnees['partner_name_'].'</a></td>';
							echo '<td class="centeralign"><a href="#" id="price'.$donnees['id'].'" data-type="text" data-title="Enter Price">'.$donnees['price'].'</a> €</td>';
							echo '<td class="centeralign">'.$donnees['sending_date'].'</td>';
							echo '<td class="centeralign"><a href="#" id="sending_time'.$donnees['id'].'" data-type="time" data-title="Enter Time">'.$donnees['sending_time'].'</a></td>';
							echo '<td class="centeralign">'.$donnees['volume'].'</td>';
							echo '<td class="centeralign">'.$donnees['volume_delivered'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['volume_delivered']/$donnees['volume'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['opens'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['opens']/$donnees['volume_delivered'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['clicks'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['clicks']/$donnees['volume_delivered'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['bounced'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['bounced']/$donnees['volume_delivered'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['complaints'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['complaints']/$donnees['volume_delivered'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['unsubs'].'</td>';
							echo '<td class="centeralign">'.round (($donnees['unsubs']/$donnees['volume_delivered'])*100, 2).' %</td>';
							echo '<td class="centeralign"><a href="#" id="leads'.$donnees['id'].'" data-type="text" data-title="Enter Leads">'.$donnees['leads'].'</a></td>';
							echo '<td class="centeralign">'.round (($donnees['leads']/$donnees['clicks'])*100, 2).' %</td>';
							echo '<td class="centeralign">'.$donnees['leads']*$donnees['price'].' €</td>';
							echo '<td class="centeralign"><span '.$span_ecpm.' >'.$ecpm.' €</span></td>';
							echo '<td class="centeralign"><span '.$span_ecpc.' >'.$ecpc.' €</span></td>';
							echo '<td class="centeralign"><a href="#" id="db_name'.$donnees['id'].'" data-type="select" data-title="Select Database Name">'.$donnees['db_name_'].'</a></td>';
							echo '<td class="centeralign"><a href="#" id="approval_name'.$donnees['id'].'" data-type="select" data-title="Select Validation Status">'.$donnees['approval_name'].'</a></td>';*/
                        echo '</tr>';
						}
					?>
                    </tbody>
					
				</table>
			<?php } ?>	
            </div><!--contentinner-->
			
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
	
    <div style="height:80px;"></div>
	
    <div class="footer">
    	<div class="footerleft">Sharemyclick dashboard v1.0</div>
    	<div class="footerright">&copy; Sharemyclick with Themepixels - <a href="https://twitter.com/sharemyclick"><span class="iconsweets-twitter"></a> - <a href="https://www.facebook.com/sharemyclick"><span class="iconsweets-facebook"></a> - <a href="https://www.linkedin.com/company/sharemyclick">Followus on Linkedin</a></div>
    </div><!--footer-->
 
</div><!--mainwrapper-->

</body>
</html>