<?php
// It includes the page parameter connection.
include('conf.php');


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
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
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
                        <td colspan="9" class="leftalign"><strong>PID PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View PID</td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-pid|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-pid' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create PID</td>
                            <td class="centeralign"><input type="checkbox" name="pid|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="pid|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="pid|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="pid|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="pid|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="pid|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='pid' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update PID</td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-pid|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-pid' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">PID Rentability</td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="renta-pid|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='renta-pid' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Assign PID to an affiliate</td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="assign-pid|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='assign-pid' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
					   	
                       <tr>
                        <td colspan="9" class="leftalign"><strong>QUOTE PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View quotes</td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-quote|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-quote' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create quote</td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-quote|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-quote' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update quotes</td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-quote|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-quote' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <td colspan="9" class="leftalign"><strong>DOMAIN PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View domain</td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-domain|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-domain' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create domain</td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-domain|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-domain' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update domain</td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-domain|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-domain' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>FORM PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View form</td>
                            <td class="centeralign"><input type="checkbox" name="view-form|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-form|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-form|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-form|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-form|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-form|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-form' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create form</td>
                            <td class="centeralign"><input type="checkbox" name="create-form|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-form|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-form|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-form|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-form|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-form|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-form' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update form</td>
                            <td class="centeralign"><input type="checkbox" name="update-form|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-form|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-form|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-form|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-form|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-form|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-form' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                            <td class="centeralign">View field</td>
                            <td class="centeralign"><input type="checkbox" name="view-field|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-field|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-field|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-field|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-field|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-field|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-field' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create field</td>
                            <td class="centeralign"><input type="checkbox" name="create-field|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-field|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-field|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-field|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-field|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-field|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-field' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update field</td>
                            <td class="centeralign"><input type="checkbox" name="update-field|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-field|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-field|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-field|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-field|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-field|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-field' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>QUESTION & ANSWER PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View question & answer</td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-question-answer|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-question-answer' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create question & answer</td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-question-answer|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-question-answer' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create question & answer</td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-question-answer|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-question-answer' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>THEME PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View theme</td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-theme|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-theme' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create theme</td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-theme|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-theme' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update theme</td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-theme|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-theme' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>CATEGORIE PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View categories</td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-categories|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-categories' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create category</td>
                            <td class="centeralign"><input type="checkbox" name="create-category|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-category|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-category|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-category|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-category|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-category|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-category' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update category</td>
                            <td class="centeralign"><input type="checkbox" name="update-category|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-category|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-category|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-category|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-category|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-category|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-category' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>WEBSERVICE PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View webservices</td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-webservice|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-webservice' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create webservices</td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-webservice|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-webservice' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Modify webservices</td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-webservice|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-webservice' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                            <td class="centeralign"> Manage webservice parameters</td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_params|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_params' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Manage webservice fields</td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="webservice_fields|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='webservice_fields' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Test webservices coregs</td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Test webservices sponsors</td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="test_ws2|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='test_ws2' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>LEADS PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View leads</td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-leads|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-leads' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Blacklist</td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="blacklist|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='blacklist' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        <tr>
                        <td colspan="9" class="leftalign"><strong>TAGS PERMISSIONS</strong></td>
                        </tr>	
                        
                        <tr>
                            <td class="centeralign">View categories</td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="view-tags|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='view-tags' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Create category</td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="create-tags|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='create-tags' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        <tr>
                            <td class="centeralign">Update category</td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|1" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 1");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|2" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 2");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|3" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 3");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|4" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 4");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|5" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 5");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                            <td class="centeralign"><input type="checkbox" name="update-tags|6" <?php  $req = $bdd->query("SELECT * FROM permissions WHERE menu='update-tags' AND admin_rights_id = 6");if($req->rowCount() > 0){ ?> checked <?php }?> /></td>
                        </tr>
                        
                        
				
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