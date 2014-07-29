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
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/colorpicker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function (){
jQuery('[id=li-dashboard]').removeClass('active');
		jQuery('[id=li-pid]').addClass('active');
		});
jQuery(document).ready(function(){
jQuery( "#pid_name" ).change(function() {
	if(jQuery(this).val() != 0){
	var pid_id =  jQuery(this).val();
	jQuery.ajax({
				  type: 'GET', 
				  contentType: "application/json",
				  url: 'http://127.0.0.1/white_label/admin/commandRequest.php', 
				  dataType : 'json',
				  data: {
					action: 'updatePid',
					id : pid_id
				  }, 
				  success: function(data, textStatus, jqXHR) {
					jQuery( "#pid_price" ).val(data['price']);
					jQuery( "#pid_country" ).val(data['country']);
					jQuery( "#pid_pixel" ).val(data['pixel']);
					jQuery( "#divColor" ).css("background-color",data['color']);
					jQuery( "#divColor" ).css("color",data['color']);
					// La reponse du serveur est contenu dans data
					// On peut faire ce qu'on veut avec ici
				  },
				  error: function(jqXHR, textStatus, errorThrown) {
					// Une erreur s'est produite lors de la requete
				  }
			 });
		}else{
				jQuery( "#pid_price" ).val('');
					jQuery( "#pid_country" ).val('');
					jQuery( "#pid_pixel" ).val('');
					jQuery( "#divColor" ).css("background-color","white");
					jQuery( "#divColor" ).css("color","white");
		}
	});
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
                <li><a href="forms.html">Forms</a> <span class="divider">/</span></li>
                <li class="active">Wizard Form</li>
            </ul>
        </div><!--breadcrumbs-->
        <div class="pagetitle">
        	<h1>Update Pid</h1> <span>This is a sample description for form styles page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
            	<h4 class="widgettitle nomargin shadowed">Update pid</h4>
                <div class="widgetcontent bordered shadowed nopadding">
                    <form class="stdform stdform2" method="post" action="update_pid.php">
							<p>
                                <label>Select one pid</label>
                                <span class="field">
								<select name="pid_name" id="pid_name" class="uniformselect">
									<option value="0">Choose : ----</option>
                                    <?php
									// On récupère tout le contenu de la table 'pid'
									$reponse = $bdd->query('SELECT * FROM pid ORDER BY `id`') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
									// On affiche chaque entrée une à une et celà tant qu'il y en a
									while ($row = $reponse->fetch()){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
									}?>
                                </select>
								</span>
                            </p>  
							<p>
                                <label>Modify pid price</label>
                                <span class="field"><input type="text" name="pid_price" id="pid_price" class="input-xxlarge" required="required" /></span>
                            </p>
							<p>
                                <label>Modify pid country</label>
                                <span class="field"><input type="text" name="pid_country" id="pid_country" class="input-xxlarge" required="required" /></span>
                            </p>
							<p>
                                <label>Modify pid pixel</label>
                                <span class="field"><textarea name="pid_pixel" id="pid_pixel" class="input-xxlarge" required="required"></textarea></span>
                            </p>
							<p>
                                <label>Modify pid color (for graphs)</label>
                                <span class="field">
								    <input type="text" name="colorpicker" class="input-mini" id="colorpicker" />
								<span id="colorSelector" class="colorselector">
								<span></span>
								</span>
								</span>
									<span class="field">Currently : <span id="divColor" style="width:80px;height:20px;">text</span></span>
                            </p>							
                            <p class="stdformbutton">
                                <button class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn">Reset Button</button>
                            </p>
                        </form>
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
		// Smart Wizard 	
      	jQuery('#wizard2').smartWizard({onFinish: onFinishCallback});

		function onFinishCallback(){
			alert('The PID has been created');
                        jQuery('form').submit();
		}
		
		jQuery(".inline").colorbox({inline:true, width: '60%', height: '500px'});
		
		jQuery('input:checkbox').uniform();
		
		    jQuery('#colorSelector').ColorPicker({
    onShow: function (colpkr) {
    jQuery(colpkr).fadeIn(500);
    return false;
    },
    onHide: function (colpkr) {
    jQuery(colpkr).fadeOut(500);
    return false;
    },
    onChange: function (hsb, hex, rgb) {
    jQuery('#colorSelector span').css('backgroundColor','#'+hex);
    jQuery('#colorpicker').val('#'+hex);
    }
    });
		
	});
</script>
</body>
</html>
