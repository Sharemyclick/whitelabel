<?php
// On inclut la page de paramÃ¨tre de connection.
include('conf.php');

// On vÃ©rifie que le user est connectÃ© sinon on le renvoie Ã  la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}

if(isset($_POST['submitChanges'])){

	$req = $bdd->prepare('DELETE FROM permissions');
	$req->execute();
	foreach($_POST as $indPost => $valPost){
            if(strpos($indPost,"|") !== false){
        	$postArray = explode("|",$indPost);
		$req_rights = $bdd->prepare("INSERT INTO permissions(menu,admin_rights_id) VALUES(:menu,:admin_rights_id)");
		$sql = $req_rights->execute(array(
                    'menu' => $postArray[0],
                    'admin_rights_id' => $postArray[1]
                    )) or die(print_r($req->errorInfo())); 
		}
            }
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
        	<h1>Users Permissions</h1> <span>Here you can edit permissions for each user.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
                
			<h4 class="widgettitle">Edit Permissions</h4>
			<form name="submitRights" id="submitRights" method="post" action="" >
            	<table class="table table-bordered">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="centeralign"><i>Menus</i></th>
                            <th class="centeralign">SuperAdmin</th>
                            <th class="centeralign">Admin</th>
                            <th class="centeralign">Advertiser</th>
                            <th class="centeralign">Affiliate</th>
                            <th class="centeralign">Intern User</th>
                            <th class="centeralign">Demo</th>
                        </tr>
                    </thead>
                    <tbody>
			
                        <tr>
                        <td colspan="9" class="leftalign"><strong>USER PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View user</td>
                            <td class="centeralign"><input type="checkbox" name="view-users|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-users|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-users|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-users|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-users|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-users|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-users' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create user</td>
                            <td class="centeralign"><input type="checkbox" name="create-user|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-user|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-user|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-user|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-user|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-user|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-user' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update user</td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-globalview-user|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-globalview-user' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Edit user permission</td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="edit-permissions|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='edit-permissions' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
					   	
                       <tr>
				
                    </tbody>
                </table>
				<input type="submit" name="submitChanges" id="submitChanges" value="Save" />
            </form>   
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