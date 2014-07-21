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
            	<div class="dropdown notification">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">
                    	<span class="iconsweets-globe iconsweets-white"></span>
                    </a>
                    
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
        </div><!--breadcrumbs-->
        <div class="pagetitle">
        	<h1>Users informations</h1> <span></span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
                
			<h4 class="widgettitle">List of all users & their respective permissions</h4>
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
                        	
                            <th class="centeralign">Login</th>
                            <th class="centeralign">Password</th>
                            <th class="centeralign">Email</th>
							<th class="centeralign">Company</th>
                            <th class="centeralign">Permission</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					// On récupère tout le contenu de la table 'client'
					$reponse = $bdd->query('SELECT admin.*, r.descr as user_right FROM admin INNER JOIN admin_rights r ON admin.right_id = r.id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					// On affiche chaque entrée une à une et celà tant qu'il y en a
					while ($donnees = $reponse->fetch())
						{
                        echo '<tr>';
                            echo '<td class="centeralign">'.$donnees['id'].'</td>';
                            echo '<td class="centeralign">'.$donnees['login'].'</td>';
                            echo '<td class="centeralign">'.$donnees['password'].'</td>';
							echo '<td class="centeralign">'.$donnees['email'].'</td>';
							echo '<td class="centeralign">'.$donnees['company'].'</td>';
							echo '<td class="centeralign">'.$donnees['user_right'].'</td>';
                        echo '</tr>';
						}
					?>
                    </tbody>
                </table>
                
                <div class="divider15"></div>

                </div><!--widgetcontent-->
			
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
