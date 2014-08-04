<?php
//It includes the page parameter connection.
include('conf.php');
$id_theme=$_GET['id'];
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
<script type="text/javascript">
jQuery(document).ready(function (){
	jQuery('[id=li-dashboard]').removeClass('active');
	//jQuery('[id=li-view-coreg]').addClass('active');
	jQuery('[id=li-users]').addClass('active');
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
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hi, <?php echo $_SESSION['login']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><span class="icon-off"></span> Sign Out</a></li>
                    </ul>
                </div><!--dropdown-->
    		
            </div><!--headerright-->
            
    	</div><!--headerpanel-->
        <div class="breadcrumbwidget">
            <ul class="skins">
                <li><a href="default" class="skin-color default"></a></li>
                <li><a href="orange" class="skin-color orange"></a></li>
		<li><a href="green" class="skin-color green"></a></li>
                <li><a href="dark" class="skin-color dark"></a></li>
                <li>&nbsp;</li>
                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
                <li class="wide"><a href="" class="skin-layout wide"></a></li>
            </ul><!--skins-->
            
        </div><!--breadcrumbwidget-->
        <div class="pagetitle">
        	<h1>View theme informations </h1> <span><?php echo $_SESSION['login']; ?> , Please see theme's information .</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
               
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Theme</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="update-theme.php?id=<?php echo $id_theme; ?>" enctype="multipart/form-data">
                        <?php 
                        $reqTheme = $bdd->query('SELECT * FROM themes LEFT JOIN template_themes ON template_themes.themes_id=themes.id WHERE themes.id='.$id_theme) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					while ($theme = $reqTheme->fetch())
						{?>
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" class="input-xxlarge" value="<?php echo $theme['name'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Image *</label>
                            <span class="field" style="text-align: center">
                                <img  src="<?php echo 'http://localhost/white_label/admin/img/themes/'.$theme['image'] ?>" height="184" width="104" >
                            </span>
                        </p>
                        
                        <p>
                            <label>Picto *</label>
                            <span class="field">
                                <img  src="<?php echo 'http://localhost/white_label/admin/img/themes/'.$theme['picto'] ?>" height="184" width="104" >                            </span>
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <select name="status" id="status" class="status" readonly="readonly">
                                        <option value="active" <?php if($theme['status']==='active'){echo 'selected';} ?> > Active</option>
                                        <option value="non-active" <?php if($theme['status']==='non-active'){echo 'selected';} ?>> Non-active</option>
                                </select>  
                            </span>
                        </p>
                        
                        <p>
                            <label>Admin *</label>
                            <span class="field">
                                <select id="admin_id" name="admin_id" readonly="readonly">
                                <?php 
                                $reqAdmin = $bdd->query('SELECT * FROM admin') or die(print_r($bdd->errorInfo()));

                                while ($admin = $reqAdmin->fetch())
                                    {?>
                                    <option value="<?php echo $admin['id']; ?>" <?php if($admin['id']===$theme['admin_id']){echo 'selected';} ?>>  <?php echo $admin['company']; ?></option>
                                <?php }?>
                                </select>
                            </span>
                        </p>
                        <h4 class="widgettitle nomargin shadowed">Template Theme</h4>
                        
                        <p>
                            <label>URL *</label>
                            <span class="field">
                                <input type="url" name="url" class="input-xxlarge" value="<?php echo $theme['url'] ?>" readonly="readonly" />
                            </span>
                        </p>

                        <p>
                            <label>Meta  *</label>
                            <span class="field">
                                <input type="text" name="meta" class="input-xxlarge" value="<?php echo $theme['meta'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Title  *</label>
                            <span class="field">
                                <input type="text" name="title" class="input-xxlarge" value="<?php echo $theme['title'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" class="input-xxlarge" value="<?php echo $theme['text'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Alt *</label>
                            <span class="field">
                                <input type="text" id="alt"  name="alt" class="input-xxlarge" value="<?php echo $theme['alt'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        <p>
                            <label>Link *</label>
                            <span class="field">
                                <input type="text" id="link"  name="link" class="input-xxlarge" value="<?php echo $theme['link'] ?>" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>h1 *</label>
                            <span class="field">
                                <input type="text" id="h1"  name="h1" class="input-xxlarge" value="<?php echo $theme['h1'] ?>" readonly="readonly" />
                            </span>
                        </p>
                                                                   
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update </button>
                        </p>
                        
                                                </form> <?php }?>
                    </div>				
                </div><!--contentinner--> 
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>
