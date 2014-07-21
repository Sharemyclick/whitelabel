<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
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
                    	<li class="nav-header skinshead">Skins</li>
                        <li class="changeskins">
                        	<a href="default" class="skins default"></a>
                        	<a href="default" class="skins grey"></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>
                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>
                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="index.html"><span class="icon-off"></span> Sign Out</a></li>
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
                <li class="active">Edit Profile</li>
            </ul>
        </div><!--breadcrumbs-->
        <div class="pagetitle">
        	<h1>Edit Profile</h1> <span>This is a sample description for edit profile page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-editprofile">
            	<h4 class="widgettitle nomargin">Edit Profile</h4>
                <div class="widgetcontent bordered">
                	<div class="row-fluid">
                    	<div class="span3 profile-left">
                        
                        	<h4>Your Profile Photo</h4>
                            
                            <div class="profilethumb">
                            	<a href="">Change Thumbnail</a>
                                <img src="img/profilethumb.png" alt="" class="img-polaroid" />
                            </div><!--profilethumb-->
                            
                            
                            <h4>Tags</h4>
                            
                            <ul class="taglist">
                            	<li><a href="">HTML5 <span class="icon-remove"></span></a></li>
                                <li><a href="">CSS <span class="icon-remove"></span></a></li>
                                <li><a href="">PHP <span class="icon-remove"></span></a></li>
                                <li><a href="">jQuery <span class="icon-remove"></span></a></li>
                                <li><a href="">Java <span class="icon-remove"></span></a></li>
                                <li><a href="">GWT <span class="icon-remove"></span></a></li>
                                <li><a href="">CodeNgniter <span class="icon-remove"></span></a></li>
                                <li><a href="">Bootstrap <span class="icon-remove"></span></a></li>
                            </ul>
                            <a href="" style="display:block;margin-top:10px">+ Add Tag</a>
                            
                        </div><!--span3-->
                        <div class="span9">
                            <?php 
                            // On récupère tout le contenu de la table "user"
                            $req = $bdd->prepare('SELECT * FROM admin WHERE login = :login');
                            // On execute la requête en lui transmettant la liste des paramètres;
                            $req->execute(array(
                                'login' => $_SESSION['login']));
                            while($donnees = $req->fetch())
                                {
                            ?>
                            <form action="#" class="editprofileform" method="POST">
                            	<h4>Login Information</h4>
                                <p>
                                	<label>Username:</label>
                                	<input type="text" name="login" class="input-xlarge" value="<?php echo $donnees['login'];?>" />
                                </p>
                                <p>
                                	<label>Email:</label>
                                    <input type="email" name="email" class="input-xlarge" value="<?php echo $donnees['email'];?>" />
                                </p>
                                <p>
                                	<label style="padding:0">Password</label>
                                    <input type="text" name="password" class="input-xlarge" value="<?php echo $donnees['password'];?>" />
                                    <a href="">Change Password?</a>
                                </p>
                                
                                <br />
                                
                                <h4>Personal Information</h4>
                                <p>
                                	<label>Firstname:</label>
                                	<input type="text" name="firstname" class="input-xlarge" value="<?php echo $donnees['firstname'];?>" />
                                </p>
                                <p>
                                	<label>Lastname:</label>
                                    <input type="text" name="lastname" class="input-xlarge" value="<?php echo $donnees['lastname'];?>" />
                                </p>
                                <p>
                                	<label>Company:</label>
                                    <input type="text" name="company" class="input-xlarge" value="<?php echo $donnees['company'];?>" />
                                </p>
                                <p>
                                	<label>Address:</label>
                                    <input type="text" name="address" class="input-xlarge" value="<?php echo $donnees['address'];?>" />
                                </p>
                                <p>
                                	<label>Your Website:</label>
                                    <input type="text" name="website" class="input-xlarge" value="http://themepixels.com/" />
                                </p>
                                <p>
                                	<label>About You:</label>
                                    <textarea name="about" class="span8"></textarea>
                                </p>
                                
                                <br />
                                
                                <h4>Notifications</h4>
                                <p>
                                	<input type="checkbox" /> Email me when someone mentions me... <br />
                                	<input type="checkbox" /> Email me when someone follows me...
                                </p>
                                
                                <br />
                                <p>
                                	<button type="submit" class="btn btn-primary">Update Profile</button> &nbsp; <a href="">Deactivate your account</a>
                                </p>
                            </form>
                            <?php };?>
                        </div><!--span9-->
                    </div><!--row-fluid-->
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
<script type="text/javascript">
jQuery(document).ready(function(){

	jQuery('.profilethumb').hover(function(){
		jQuery(this).find('a').fadeIn();
	},function(){
		jQuery(this).find('a').fadeOut();
	});
	
	jQuery('.taglist a').click(function(){
		return false;
	});
	jQuery('.taglist a span').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
	
});
</script>
</body>
</html>
