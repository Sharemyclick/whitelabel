<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}

if(isset($_POST['paramid']) && $_POST['paramid'] != ''){
	switch($_POST['command']){
		case "edit":
			if(substr($_POST['fieldedit'],0,3) == "qu_"){
				$req = $bdd->prepare('UPDATE webservice_params SET param=:param,question_id=:question_id WHERE id=:id');
				$req->execute(array(
						'param' => $_POST['paramedit'],
						'question_id' => $_POST['fieldedit'],
						'id' => $_POST['paramid']
						));
			}else{
				$req = $bdd->prepare('UPDATE webservice_params SET param=:param,field_id=:field_id WHERE id=:id');
				$req->execute(array(
						'param' => $_POST['paramedit'],
						'field_id' => $_POST['fieldedit'],
						'id' => $_POST['paramid']
						));
			}
		break;
		case "add":
			if(substr($_POST['fieldedit'],0,3) == "qu_"){
				$req = $bdd->prepare('INSERT INTO webservice_params(param,question_id) VALUES(:param,:question_id)');
				$req->execute(array(
						'param' => $_POST['paramedit'],
						'question_id' => substr($_POST['fieldedit'],3)
						));
			}else{
				$req = $bdd->prepare('INSERT INTO webservice_params(param,field_id) VALUES(:param,:field_id)');
				$req->execute(array(
						'param' => $_POST['paramedit'],
						'field_id' => $_POST['fieldedit']
						));
			}
		break;
		case "del":
			$req = $bdd->prepare('DELETE FROM webservice_params WHERE id=:id');
			$req->execute(array(
					'id' => $_POST['paramid']
					));
			$req = $bdd->prepare('DELETE FROM webservice_urls_params WHERE param_id=:id');
			$req->execute(array(
					'id' => $_POST['paramid']
					));
		break;
 }}

$req_wsp = $bdd->query("SELECT * FROM webservice_params");



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
		<div class="headerpanel">        	<a href="" class="showmenu"></a>            <div class="headerright">
    			<div class="dropdown userinfo">                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, ThemePixels! <b class="caret"></b></a>                    <ul class="dropdown-menu">                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>                        <li class="divider"></li>                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>                        <li class="divider"></li>                        <li><a href="index.html"><span class="icon-off"></span> Sign Out</a></li>                    </ul>                </div><!--dropdown-->            </div><!--headerright-->    	</div><!--headerpanel-->
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
        	<h1>WebServices Parameters</h1> <span>Manage parameters</span>
        </div>
		<div style="margin-top:20px;">
		<center>
			<form name="formWs" id="formWs" class="form-horizontal" role="form" method="POST" action="webservice_params.php">
				<input type="hidden" name="command" id="command" value="" />
				<input type="hidden" name="paramid" id="paramid" value="" />
				<input type="hidden" name="paramedit" id="paramedit" value="" />
				<input type="hidden" name="fieldedit" id="fieldedit" value="" />
				<?php while ($val_wp = $req_wsp->fetch()){
					if($val_wp['field_id'] && $val_wp['field_id'] != 0 && $val_wp['field_id'] != null){
						$req_ws_fields = $bdd->query("SELECT name FROM webservice_fields WHERE id = ".$val_wp['field_id']);
					}else{
						$req_ws_fields = $bdd->query("SELECT questions_text as name FROM questions WHERE id = ".$val_wp['question_id']);
					}
						$res_ws_fields = $req_ws_fields->fetch(); 
				?>
							<div class="" style=" display: inline-block;float:left;">
								<label for="inputWsparam1" class="col-lg-2 control-label" style="width:100px;" >Param</label>
									<div style="float:left;margin-right:20px;" class="col-lg-3">
										<input style="width:210px;" type="text" value="<?php echo $val_wp['param'];?>" readonly class="form-control" name="param<?php echo $val_wp['id'];?>" id="param<?php echo $val_wp['id'];?>" />
									</div>
								<label for="inputWsparam1" class="col-lg-2 control-label" style="width:140px;" >Linked to field : </label>
									<div style="float:left;margin-right:60px;" class="col-lg-3">
										<input style="width:210px;" type="text" value="<?php echo $res_ws_fields['name'];?>" readonly class="form-control" name="field<?php echo $val_wp['id'];?>" id="field<?php echo $val_wp['id'];?>" />
									</div>
								<div style="float:left;margin-right:10px;" class=""><img id="opener<?php echo $val_wp['id'];?>" src="img/icon/edit.png" /></div>
								<div style="float:left;margin-right:10px;" class=""><img id="del_opener<?php echo $val_wp['id'];?>" src="img/icon/delete.png" /></div>
								<div style="float:left;" class=""><img id="add_opener<?php echo $val_wp['id'];?>" src="img/icon/add.png" /></div>
							</div>		
							<div id="dialog<?php echo $val_wp['id'];?>" title="<?php echo $val_wp['param'];?>" >	
							<p>									
							<label  class="col-lg-2 control-label" style="width:100px;" >Param</label>										
							<div style="display:inline-block;float:left;" class="col-lg-3">											
							<input style="width:210px;" type="text" value="<?php echo $val_wp['param'];?>"  class="form-control" name="param_<?php echo $val_wp['id'];?>" id="param_<?php echo $val_wp['id'];?>" />		
							</div>									
							<label for="inputWsparam1" class="col-lg-2 control-label" style="width:180px;" >Linked to field : </label>	
							<div style="display:inline-block;float:left;" class="col-lg-3">											
							<select name="field_<?php echo $val_wp['id'];?>" id="field_<?php echo $val_wp['id'];?>" style="width:210px;" class="form-control" >		
							<?php $req_wsf = $bdd->query("SELECT * FROM webservice_fields");	
							$req_current_wsf = $bdd->query("SELECT field_id FROM webservice_params WHERE id = ".$val_wp['id']);	
							$res_current_wsf = $req_current_wsf->fetch(); 
							while ($val_wf = $req_wsf->fetch()){?>												
							<option value="<?php echo $val_wf['id'];?>" <?php if($val_wf['id'] == $res_current_wsf['field_id']){?> selected <?php }?> ><?php echo $val_wf['name'];?> </option>
							<?php }
							$req_q = $bdd->query("SELECT * FROM questions");
												while ($val_q = $req_q->fetch()){?>
												<option value="<?php echo "qu_".$val_q['id'];?>"  ><?php echo $val_q['questions_text'];?> </option>
												<?php }?>							
							</select>											<input type="submit" id="submitEditPopup<?php echo $val_wp['id'];?>" name="submitEditPopup<?php echo $val_wp['id'];?>" value="Validate"></input>										</div>								</p>							</div>
							<div id="add_dialog<?php echo $val_wp['id'];?>" title="<?php echo $val_wp['param'];?>" >
								<p>
									<label  class="col-lg-2 control-label" style="width:100px;" >Param</label>
										<div style="display:inline-block;float:left;" class="col-lg-3">
											<input style="width:210px;" type="text" value=""  class="form-control" name="new_param_<?php echo $val_wp['id'];?>" id="new_param_<?php echo $val_wp['id'];?>" />
										</div>
									<label for="inputWsparam1" class="col-lg-2 control-label" style="width:180px;" >Linked to field : </label>
										<div style="display:inline-block;float:left;" class="col-lg-3">
											<select name="new_field_<?php echo $val_wp['id'];?>" id="new_field_<?php echo $val_wp['id'];?>" style="width:210px;" class="form-control" >
												<?php $req_wsf = $bdd->query("SELECT * FROM webservice_fields");
												$req_current_wsf = $bdd->query("SELECT field_id FROM webservice_params WHERE id = ".$val_wp['id']);
												$res_current_wsf = $req_current_wsf->fetch(); 
												while ($val_wf = $req_wsf->fetch()){?>
												<option value="<?php echo $val_wf['id'];?>"  ><?php echo $val_wf['name'];?> </option>
												<?php }
												$req_q = $bdd->query("SELECT * FROM questions");
												while ($val_q = $req_q->fetch()){?>
												<option value="<?php echo "qu_".$val_q['id'];?>"  ><?php echo $val_q['questions_text'];?> </option>
												<?php }?>
											</select>
											<input type="submit" id="submitAddPopup<?php echo $val_wp['id'];?>" name="submitAddPopup<?php echo $val_wp['id'];?>" value="Validate"></input>
										</div>
								</p>
							</div>
							<div id="del_dialog<?php echo $val_wp['id'];?>" title="<?php echo $val_wp['param'];?>" >
								<p>Are you sure to delete this param ?<input type="submit" id="submitDelPopup<?php echo $val_wp['id'];?>" name="submitDelPopup<?php echo $val_wp['id'];?>" value="Yes"></input></p>
							</div>
				<?php }?>
			</form>
		</center>		</div>
    </div>
    <div class="clearfix"></div>
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
</div><!--mainwrapper-->
<script>
jQuery('[id^=dialog]').dialog({ autoOpen: false });
jQuery('[id^=opener]').click(function() {
var id = jQuery(this).attr('id').substring(6);
jQuery('[id=dialog' + id +']').dialog( "open" );
jQuery('[id=dialog' + id +']').dialog( "option", "height", 280 );
jQuery('[id=dialog' + id +']').dialog( "option", "width", 700 );
});
jQuery('[id^=add_dialog]').dialog({ autoOpen: false });
jQuery('[id^=add_opener]').click(function() {
var id = jQuery(this).attr('id').substring(10);
jQuery('[id=add_dialog' + id +']').dialog( "open" );
jQuery('[id=add_dialog' + id +']').dialog( "option", "height", 280 );
jQuery('[id=add_dialog' + id +']').dialog( "option", "width", 700 );
});
jQuery('[id^=del_dialog]').dialog({ autoOpen: false });
jQuery('[id^=del_opener]').click(function() {
var id = jQuery(this).attr('id').substring(10);
jQuery('[id=del_dialog' + id +']').dialog( "open" );
jQuery('[id=del_dialog' + id +']').dialog( "option", "height", 280 );
jQuery('[id=del_dialog' + id +']').dialog( "option", "width", 700 );
});
</script>
</body>
</html>
