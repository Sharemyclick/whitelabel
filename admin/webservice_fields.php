<?php
// On inclut la page de paramètre de connection.
include('conf.php');
// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}
if(isset($_POST['newField'])){
	$req = $bdd->prepare('INSERT INTO webservice_fields (name) VALUES(:name)');
	$sql = $req->execute(array(
					'name' => $_POST['newField']
					)) or die(print_r($req->errorInfo()));
}
$req_wsp = $bdd->query("SELECT * FROM webservice_fields");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Katniss Premium Admin Template</title>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="prettify/prettify.css" type="text/css" />
<link rel="stylesheet" href="css/modal.css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src="js/validation.js"></script>
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
        	<h1>WebServices Fields</h1> <span>Manage our specific fields</span>
        </div>		<div class="maincontent">        	<div class="contentinner">			
		<?php while ($val_wp = $req_wsp->fetch()){?>
		<div class="form-group">
			<div style="display:inline-block;float:left;" class="col-lg-3">				<span class="label label-info" style="text-align:center;display:inline-block;float:left;margin:2px 2px 0px 0px;width:150px;"><?php echo $val_wp['name'];?></span>
				<!--<input style="width:150px;text-align:center;margin:2px 2px 0px 0px	;" type="text" value="<?php //echo $val_wp['name'];?>" readonly class="form-control" name="field<?php //echo $val_wp['id'];?>" id="field<?php //echo $val_wp['id'];?>" />-->			</div>					
		</div>
		<?php }?>		<div class="divider15"></div>				<h4 class="widgettitle nomargin shadowed">Enter new fields</h4>				<div class="widgetcontent bordered shadowed nopadding">					<form class="stdform stdform2" role="form" method="POST" action="webservice_fields.php">						<p>							<label>Enter new field</label>							<span class="field"><input type="text" name="newField" id="newField" placeholder="Enter a new field"></span>						</p>						<p class="stdformbutton">							<button class="btn btn-success" name="submitws" id="submitws">Create new field</button>						</p>					</form>				</div>			</div>		</div>

    <div class="clearfix"></div>
    </div>
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
</div><!--mainwrapper-->
</body>
</html>
