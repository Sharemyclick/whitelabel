<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
	echo '<script>document.location.href="dashboard.php"</script>';  
	exit;  
}

if(isset($_POST['submitws'])){
	foreach($_POST as $indPost => $valPost){
		$checkpos = strpos($indPost, "ws_param");
		if($checkpos !== false){
			$req = $bdd->prepare('INSERT INTO webservice_urls_params(ws_id,param_id) VALUES(:ws_id,:param_id)');
			$req->execute(array(
				'ws_id' => $_POST['ws_id'],
				'param_id' => $valPost
				));
				}
	}
	header("location:update-webservice.php?ws=".$_POST['ws_id']."");
}else{
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
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
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
        	<h1>WebService Creation</h1> <span>Enter webservice basic info</span>
        </div>
		<div class="maincontent">
        	<div class="contentinner">

<?php 
if(isset($_GET['edit']) && $_GET['edit'] == 'details'){
$req_ws = $bdd->query("SELECT url FROM webservice WHERE id = ".$_GET['ws']);
$res_ws = $req_ws->fetch(); 
$req_wsp = $bdd->query("SELECT * FROM webservice_params");
?>

<h4 class="widgettitle nomargin shadowed">Edit WebService URL</h4>
<div class="widgetcontent bordered shadowed nopadding">
        <form class="stdform stdform2" method="post" action="">
			<p>
				<span class="field"><input type="hidden" name="ws_id" id="ws_id" value="<?php echo $_GET['ws'];?>" /></span>
            </p>
			<p>
                <label>URL (without parameters)</label>
                <span class="field"><input type="text" value="<?php echo $res_ws['url'];?>" readonly name="ws_url" id="ws_url" class="input-xxlarge" placeholder="WebService description" required="required" /></span>
            </p>
			<p>
                <div id="paramdiv">
					<div id="ws_div1" class="form-group">
				<label>Param 1</label>
                    <span class="field">
						<select name="ws_param1" id="ws_param1" >
                        <option value="">------Choose------</option>
                        <?php while ($val_wsp = $req_wsp->fetch()){?>
						<option value="<?php echo $val_wsp['id'];?>"><?php echo $val_wsp['param'];?></option>
						<?php }?>
						</select>
					</span>
					</div></div>
            </p>
            <p class="stdformbutton">
                <button type="button" class="btn btn-primary" id="addparam1">Add new param</button>
				<button type="button" class="btn btn-warning" id="delparam1">Delete last param</button>
				<button  class="btn btn-success" name="submitws" id="submitws">Save Webservice</button>
            </p>
        </form>
    </div><!--widgetcontent-->
<?php /*
<!--<div id="container">
	<center>
		<form class="stdform stdform2" role="form" method="POST" action="">
			<input type="hidden" name="ws_id" id="ws_id" value="<?php //echo $_GET['ws'];?>" />
				<div class="">
					<label for="inputWsname" class="col-lg-2 control-label">URL (without parameters)</label>
						<div class="col-lg-3">
							<input type="text" value="<?php //echo $res_ws['url'];?>" class="form-control"readonly name="ws_url" id="ws_url">
						</div>
				</div>
				<div id="paramdiv">
					<div id="ws_div1" class="form-group">
						<label for="inputWsparam1" class="col-lg-2 control-label">Param 1</label>
							<div class="col-lg-3">
								<select name="ws_param1" id="ws_param1">
									<option value="">------Choose------</option>
										<?php //while ($val_wsp = $req_wsp->fetch()){?>
										<option value="<?php //echo $val_wsp['id'];?>"><?php //echo $val_wsp['param'];?></option>										<?php }?>
								</select>
							</div>
					</div>
				</div>
				<div>
					<input type="button" id="addparam1" value="Add new param" />
					<input type="button" id="delparam1" value="Delete last param" style="display:none;" />
				</div>
				<div>
					<input type="submit" name="submitws" id="submitws" value="Save" />
				</div>
		</form>
	</center>
</div>-->*/
 }else{ ?>
<!--<div id="container">	
	<div class="well well-lg">
		<h1 style="text-align:center;">Create WebService basic URL</h1>
	</div>
		<center><form class="form-horizontal" role="form" method="POST" action="create_ws.php">
			<div >
				<label for="inputWsname" class="col-lg-2 control-label">URL (without parameters)</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" name="ws_url" id="ws_url" placeholder="Ex : https://api.vipresponse.nl/add?">
					</div>
			</div>
			<div ">
				<label for="inputWscountry" class="col-lg-2 control-label">Description</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" name="ws_text" id="ws_text" placeholder="WebService description">
					</div>
			</div>
			<div class="form-group" style="padding-top:36px;">
				<div class="col-lg-offset-2 col-lg-3">
					<button type="submit" class="btn btn-default">Create WebService</button>
				</div>
			</div>
		</form></center>
</div>-->

<h4 class="widgettitle nomargin shadowed">Create WebService basic URL</h4>
    <div class="widgetcontent bordered shadowed nopadding">
        <form class="stdform stdform2" method="post" action="create_ws.php">
			<p>
                <label>URL (without parameters)</label>
				<span class="field"><input type="text" name="ws_url" id="ws_url" class="input-xxlarge" placeholder="Ex : https://api.vipresponse.nl/add?" required="required" /></span>
            </p>
			<p>
                <label>Description</label>
                <span class="field"><input type="text" name="ws_text" id="ws_text" class="input-xxlarge" placeholder="WebService description" required="required" /></span>
            </p>
            <p class="stdformbutton">
                <button class="btn btn-primary">Create Webservice</button>
            </p>
        </form>
    </div><!--widgetcontent-->

<?php }?>
<br />

   </div>
   </div> 
</div>
    <div class="clearfix"></div>
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
</div><!--mainwrapper-->
</body>
</html>
<?php }?>