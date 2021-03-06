<?php
// it includes parameter connection
include('conf.php');



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
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/colorpicker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function (){
jQuery('[id=li-dashboard]').removeClass('active');
		jQuery('[id=li-pid]').addClass('active');
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
        	<h1>Create Pid</h1> <span>This is a sample description for form styles page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
            	<h4 class="widgettitle">Create Pid Form</h4>
                <div class="widgetcontent">              	
                    <!-- START OF TABBED WIZARD -->
                    <form class="stdform" method="post" action="create-pid.php">
                    <div id="wizard2" class="wizard tabbedwizard">
                        <ul class="tabbedmenu">
                            <li>
                            	<a href="#wiz1step2_1">
                                	<span class="h2">STEP 1</span>
                                    <span class="label">Enter Pid name</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step2_2">
                                	<span class="h2">STEP 2</span>
                                    <span class="label">Enter Pid price</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step2_3">
                                	<span class="h2">STEP 3</span>
                                    <span class="label">Enter Pid country</span>
                                </a>
                            </li>
							<li>
                            	<a href="#wiz1step2_4">
                                	<span class="h2">STEP 4</span>
                                    <span class="label">Enter Pid color (for graphs)</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step2_5">
                                	<span class="h2">STEP 5</span>
                                    <span class="label">Enter the Pixel </span>
                                </a>
                            </li>
                        </ul>
                        	
                        <div id="wiz1step2_1" class="formwiz">
                        	<h4>Step 1: Enter Pid name</h4>
                                <p>
                                    <label>Pid name</label>
                                    <span class="field"><input type="text" name="name" class="input-xxlarge" required="required" /></span>
                                </p>
                                <p>
                            <label>Status *</label>
                            <span class="field">
                                <select name="status" id="status" class="status">
                                        <option value="active"> Active</option>
                                        <option value="non-active"> Non-active</option>
                                </select>  
                            </span>
                        </p>
                        </div><!--#wiz1step2_1-->
                        
                        <div id="wiz1step2_2" class="formwiz">
                        	<h4>Step 2: Enter Pid price</h4> 
                                <p>
                                    <label>Pid price</label>
                                    <span class="field"><input type="text" name="price" class="input-xxlarge" required="required" /></span>
                                </p>
                        </div><!--#wiz1step2_2-->
                        
                        <div id="wiz1step2_3">
                        	<h4>Step 3: Enter Pid country</h4>
								<p>
                                    <label>Pid country</label>
                                    <span class="field"><input type="text" name="country" class="input-xxlarge" required="required" /></span>
                                </p>
                        </div><!--#wiz1step2_3-->
						
						<div id="wiz1step2_4">
                        	<h4>Step 4: Enter Pid color (for graphs)</h4>
								<p>
                                    <label>Pid color</label>
                                    <span class="field">
									<input type="text" name="colorpicker" class="input-mini" id="colorpicker" />
									<span id="colorSelector" class="colorselector">
									<span></span>
									</span>
									</span>
									<br /><span class="field">Already assigned :<br />
									<?php $req_pids = $bdd->query("SELECT name, color_code FROM pid");
									while($res_pids = $req_pids->fetch()){?>
									<?php echo $res_pids['name']; ?> : <span style="color:<?php echo $res_pids['color_code']; ?>;background-color:<?php echo $res_pids['color_code']; ?>;">text</span><br />
									<?php }?>
									</span>
                                </p>
                        </div><!--#wiz1step2_4-->
                        
                         <div id="wiz1step2_5">
                        	<h4>Step 5: Enter the Pixel </h4>
                                <p>
                                    <label>Pixel</label>
                                    <span class="field"><textarea name="pixel" rows="4" cols="8"></textarea>   </span>
                                </p>
                        </div>
                        
                    </div><!--#wizard-->
                    </form>               
                    <!-- END OF TABBED WIZARD -->
                    
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
		
		jQuery('select, input:checkbox').uniform();
		
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
