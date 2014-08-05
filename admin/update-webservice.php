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
	$req = $bdd->prepare('UPDATE webservice SET url=:ws_url, descr=:ws_descr WHERE id=:ws_id');
			$req->execute(array(
					'ws_url' => $_POST['ws_url'],
					'ws_descr' => $_POST['ws_descr'],
					'ws_id' => $_POST['ws_id']
					));
	$req = $bdd->prepare('DELETE FROM webservice_urls_params WHERE ws_id=:ws_id');
	$req->execute(array('ws_id' => $_POST['ws_id']));
	foreach($_POST as $indPost => $valPost){
		$checkpos = strpos($indPost, "ws_param");
		if($checkpos !== false){
			if(is_numeric($valPost)){
			$req = $bdd->prepare('INSERT INTO webservice_urls_params(ws_id,param_id) VALUES(:ws_id,:param_id)');
			$req->execute(array(
					'ws_id' => $_POST['ws_id'],
					'param_id' => $valPost
					));
					}else{
					$req_p = $bdd->query("SELECT id FROM webservice_params WHERE param = '".$valPost."'");
					$res_p = $req_p->fetch(); 
					$req = $bdd->prepare('INSERT INTO webservice_urls_params(ws_id,param_id) VALUES(:ws_id,:param_id)');
					$req->execute(array(
					'ws_id' => $_POST['ws_id'],
					'param_id' => $res_p['id']
					));
					}
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
        	<h1>WebService Update</h1> <span>Edit webservice and affect parameters</span>
        </div>				<div class="maincontent">			<div class="contentinner">
			<?php if(isset($_REQUEST['ws']) && $_REQUEST['ws'] != ''){
			$req_ws = $bdd->query("SELECT url,descr FROM webservice WHERE id = ".$_REQUEST['ws']);
			$res_ws = $req_ws->fetch(); 
			$req_wsp = $bdd->query("SELECT ws.*, wp.param as param FROM webservice ws INNER JOIN webservice_urls_params wup ON ws.id = wup.ws_id AND ws.id = ".$_REQUEST['ws']." INNER JOIN webservice_params wp ON wp.id = wup.param_id ");
			?>
			<h4 class="widgettitle nomargin shadowed">Finalize update</h4>				<div class="widgetcontent bordered shadowed nopadding">
					<form class="stdform stdform2" role="form" method="POST" action="">							<span class="field"><input type="hidden" name="ws_id" id="ws_id" value="<?php echo $_REQUEST['ws'];?>" /></span>
							<span class="field"><input type="hidden" name="ws_id" id="ws_id" value="<?php echo $_REQUEST['ws'];?>" /></span>						<p>
							<label for="inputWsname">URL (without parameters)</label>
							<span class="field"><input type="text" value="<?php echo $res_ws['url'];?>" class="form-control" name="ws_url" id="ws_url"></span>						</p>						<p>
							<label for="inputWsname">Description</label>
							<span class="field"><input type="text" value="<?php echo $res_ws['descr'];?>" class="form-control" name="ws_descr" id="ws_descr"></span>
						</p>
						<p>							
						<div id="paramdiv">
						<label for="inputWsname">Params :</label>
						<?php 
						$i = 1;
						while ($val_wsp = $req_wsp->fetch()){?>
						<p><div id="ws_div<?php echo $i;?>">							<span class="field"><input type="text" value="<?php echo $val_wsp['param'];?>" class="form-control" readonly name="ws_param<?php echo $i;?>" id="ws_param<?php echo $i;?>"></span>							</div>
						</p>
						<?php $i ++;}?>	
						</div>		
						</p>
						<p class="stdformbutton">							<button class="btn btn-success" name="submitws" id="submitws">Save Webservice</button>							<button type="button" class="btn btn-default" name="addparam" id="addparam<?php echo ($i > 1)?$i-1:1;?>" value="Add new param">Add new param</button>							<button type="button" class="btn btn-danger" name="delparam" id="delparam<?php echo ($i > 1)?$i-1:1;?>" value="Delete last param" <?php if($i < 2){?> style="display:none;" <?php }?>>Delete last param</button>						</p>
					</form>				</div>
			<?php }else{ 
			$req_ws = $bdd->query("SELECT * FROM webservice ");
			?>
			<h4 class="widgettitle nomargin shadowed">Select webservice you want to update</h4>
				<div class="widgetcontent bordered shadowed nopadding">					<form class="stdform stdform2" method="post" action="">
						<p>							<label>Select Webservice</label>							<span class="field">
							<select name="ws" id="ws" class="uniformselect">
								<option value="">------Choose------</option>
								<?php while ($val_ws = $req_ws->fetch()){?>
								<option value="<?php echo $val_ws['id'];?>"><?php echo $val_ws['descr']." ---- ".$val_ws['url'];?></option>
								<?php }?>							</select>							</span>						</p>						<p class="stdformbutton">							<button class="btn btn-primary" id="addparam1">Update Webservice</button>						</p>
					</form>				</div>
			<?php }?>
			</div>
		</div>	</div>	
    <div class="clearfix"></div>
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
</div><!--mainwrapper-->
</body>
</html>