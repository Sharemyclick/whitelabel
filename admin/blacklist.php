<?php
include('conf.php');
if(isset($_POST['submitTest']) && !empty($_POST['blk_param']) && $_POST['blk_param'] != '' ){
	$reqLeads = $bdd->query("SELECT  * FROM leads"); /*where regdate >= SUBTIME(NOW(), '0 2:00:00') and regdate <= NOW()*/
	$reqLeads_blacklisted = $bdd->query("SELECT  * FROM leads_blacklist");
	$blacklist = array();
	if($reqLeads_blacklisted->rowCount() > 0){
		while ($leads_blacklisted = $reqLeads_blacklisted->fetch()){
			$blacklist[] = $leads_blacklisted['email'];
		}	
	}
	while ($leads = $reqLeads->fetch()){
		if(stripos($leads[$_POST['blk_field']],$_POST['blk_param']) !== false){
			if(empty($blacklist) || !in_array($leads['email'],$blacklist)){
				$req = $bdd->prepare('INSERT INTO leads_blacklist SELECT * FROM user WHERE id =:id');
				// On execute la requête en lui transmettant la liste des paramètres
				$sql = $req->execute(array(
						'id' => $leads['id']
						)) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
		  }
		  $req = $bdd->prepare('DELETE FROM user WHERE id =:id');
				// On execute la requête en lui transmettant la liste des paramètres
				$sql = $req->execute(array(
						'id' => $leads['id']
						)) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
					
		}
	}

}
?>

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
jQuery(document).ready(function (){
	jQuery('[id=li-dashboard]').removeClass('active');
	//jQuery('[id=li-view-coreg]').addClass('active');
	jQuery('[id=li-ws]').addClass('active');
});
</script>
</head>

<body>

<div class="mainwrapper">
	
    <?php include ('./menu/menu-left.php');?>
    
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
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, ThemePixels! <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>
                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="index.html"><span class="icon-off"></span> Sign Out</a></li>
                    </ul>
                </div><!--dropdown-->
    		
            </div><!--headerright-->
            
    	</div><!--headerpanel-->
		<div>
		
		<br /><br /><br />
		Set blacklist criteria :
		<form action="" method="post">
		<select id="blk_field" name="blk_field" >
			<option value="firstname">Firstname</option>
			<option value="lastname">Lastname</option>
			<option value="email">Email</option>
		</select>
		LIKE
		<span class="field"><input type="text" name="blk_param" id="blk_param" class="input-xxlarge" placeholder="test"  required="required" /></span>
		<br /><br /><br />
		<input type="submit"name="submitTest" id="submitTest" />
		</form>
	
		<?php 
		//if(isset($_POST['submitTest'])){
			/*if(empty($_POST['blk_param']) || $_POST['blk_param'] == '' ){
				echo "<span style='color:red;' >Please fill the fields.</span>";
				}else{*/
					//$reqLeads_blacklisted = $bdd->query("SELECT  * FROM user_blacklist WHERE ".$_POST['blk_field']." LIKE '%".$_POST['blk_param']."%'");
					$reqLeads_blacklisted = $bdd->query("SELECT  * FROM leads_blacklist");
					$blacklist = array();
						?>
						<table class="table table-bordered" >
								<tr>
									<td>Firstname</td>
									<td>Lastname</td>
									<td>Email</td>
									<td>Address</td>
									<td>IP</td>
								</tr>
						<?php						
						while ($leads_blacklisted = $reqLeads_blacklisted->fetch()){?>
								<tr>
									<td><?php echo $leads_blacklisted['firstname'];?></td>
									<td><?php echo $leads_blacklisted['lastname'];?></td>
									<td><?php echo $leads_blacklisted['email'];?></td>
									<td><?php echo $leads_blacklisted['address'];?></td>
									<td><?php echo $leads_blacklisted['ip'];?></td>
								</tr>
							
						<?php	//$blacklist[] = $leads_blacklisted['email'];
						}	
			//	}
	//	}
		?>
		</table>
		</div>
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>