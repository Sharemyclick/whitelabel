<?php
// On inclut la page de paramÃ¨tre de connection.
include('conf.php');

// On vÃ©rifie que le user est connectÃ© sinon on le renvoie Ã  la page de connection
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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
jQuery(document).ready(function (){
	jQuery('[id=li-dashboard]').removeClass('active');
	//jQuery('[id=li-view-coreg]').addClass('active');
	jQuery('[id=li-users]').addClass('active');
});
</script>
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
        	<h1>Leads Table</h1> <span>This is a sample description for the page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
                
			<h4 class="widgettitle">List of all leads in the DB</h4>		
				<table class="table table-bordered" id="leads">
                        <colgroup>
                        
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
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>PID ID</th>
                            <th>Devis ID</th>
                            <th>Form ID</th>
                            <th>Address</th>
                            <th>Postal Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>regdate</th>
							
                        </tr>
                    </thead>
                    
					<tbody>
						<?php
					// On rÃ©cupÃ¨re tout le contenu de la table 'client'
					$reqLeads = $bdd->query('SELECT * FROM leads LEFT JOIN leads_pid ON leads.id=leads_pid.leads_id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					// On affiche chaque entrÃ©e une Ã  une et celÃ  tant qu'il y en a
					while ($leads = $reqLeads->fetch())
						{?>
                                            
                       <tr>
                            <td class="centeralign"></td>
                                    <td class="centeralign"></td>                         
                                    <td class="centeralign"></td>							
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>
                                    <td class="centeralign"></td>							echo '<td class="centeralign">'.$donnees['jeux_concours_id'].'</td>';
                        </tr>
						<?php }
					?>
                    </tbody>
				</table>
				<script type="text/javascript">
				// dynamic table
				jQuery('#leads').dataTable({
				   "sPaginationType": "full_numbers",
				   "aaSortingFixed": [[0,'asc']],
				   "fnDrawCallback": function(oSettings) {
					  jQuery.uniform.update();
				   }
				});
				</script>
                
                <div class="divider15"></div>
			
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
