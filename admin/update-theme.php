<?php
//It includes the page parameter connection.
include('conf.php');
$id_theme=$_GET['id'];

//ACTIVATION AND DESACTIVATION of the status
if(isset($_POST['deactivate']))
{
 
    $bdd->exec('UPDATE themes SET status = "non-active" WHERE id='.$id_theme);

}
if(isset($_POST['activate']))
{

    $bdd->exec('UPDATE themes SET status = "active" WHERE id='.$id_theme);
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
        	<h1>Update theme informations </h1> <span><?php echo $_SESSION['login']; ?> , Please see theme's information .</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
               
			<div class="widgetcontent">
			
            	
					
                
                    <?php if(isset($_POST['submit']))
                    {
//-----------------------------------------------------------------------------------// 
//UPDATE themes table
        $bdd->exec(' UPDATE themes SET name="'.$_POST['name'].'", image="'.$_POST['image'].'", picto="'.$_POST['picto'].'",  admin_id="'.$_POST['admin_id'].'" WHERE id='.$id_theme);
//---------------------------------------------------------------------------------------//
        
//-----------------------------------------------------------------------------------// 
//UPDATE template_themes table
        $bdd->exec(' UPDATE template_themes SET url="'.$_POST['url'].'", meta="'.$_POST['meta'].'", title="'.$_POST['title'].'", text="'.$_POST['text'].'", alt="'.$_POST['alt'].'", link="'.$_POST['link'].'", h1="'.$_POST['h1'].'" WHERE themes_id='.$id_theme);
//---------------------------------------------------------------------------------------//
                        
                    ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The theme has been updated </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                        <a href="update-theme-globalview.php" >
                                        <button type="button" name="update_another_theme" id="update_another_quote" class="btn btn-primary" >Update another theme </button>
                                      </a>
                                        <a href="view-theme-globalview.php" >
                                        <button type="button" name="view_all_theme" id="view_all_quote" class="btn btn-primary" >View all themes </button>
                                      </a>
                                </p>           
                <?php }
                    
                    Else{?>
                                <div class="widgetcontent bordered shadowed nopadding">
                                <h4 class="widgettitle nomargin shadowed">Theme</h4>
                    <form name="form_user" class="stdform stdform2" method="post" action="update-theme.php?id=<?php echo $id_theme; ?>" enctype="multipart/form-data">
                        <?php 
                        $reqTheme = $bdd->query('SELECT * FROM themes LEFT JOIN template_themes ON template_themes.themes_id=themes.id WHERE themes.id='.$id_theme) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					while ($theme = $reqTheme->fetch())
						{?>
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" class="input-xxlarge" value="<?php echo $theme['name'] ?>" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Image *</label>
                            <span class="field">
                                <input type="text" name="image" class="input-xxlarge" value="<?php echo $theme['image'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Picto *</label>
                            <span class="field">
                                <input type="text" name="picto" class="input-xxlarge" value="<?php echo $theme['picto'] ?>" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <?php 
                                            if ($theme['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate the theme'> 
                                                <?php ;
                                            
                                            }
                                            if  ($theme['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate the theme'>
                                                <?php ;
                                            }
                                            
                                        ?>
                                </select>  
                            </span>
                        </p>
                        
                        <p>
                            <label>Admin *</label>
                            <span class="field">
                                <select id="admin_id" name="admin_id" required="required" >
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
                                <input type="url" name="url" class="input-xxlarge" value="<?php echo $theme['url'] ?>" required="required"  />
                            </span>
                        </p>

                        <p>
                            <label>Meta  *</label>
                            <span class="field">
                                <input type="text" name="meta" class="input-xxlarge" value="<?php echo $theme['meta'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Title  *</label>
                            <span class="field">
                                <input type="text" name="title" class="input-xxlarge" value="<?php echo $theme['title'] ?>" required="required" " />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" class="input-xxlarge" value="<?php echo $theme['text'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Alt *</label>
                            <span class="field">
                                <input type="text" id="alt"  name="alt" class="input-xxlarge" value="<?php echo $theme['alt'] ?>" required="required"  />
                            </span>
                        </p>
                        <p>
                            <label>Link *</label>
                            <span class="field">
                                <input type="text" id="link"  name="link" class="input-xxlarge" value="<?php echo $theme['link'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>h1 *</label>
                            <span class="field">
                                <input type="text" id="h1"  name="h1" class="input-xxlarge" value="<?php echo $theme['h1'] ?>" required="required"  />
                            </span>
                        </p>
                                                                   
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update </button>
                           
                            
                        </p>
                        
                                                </form> <?php }}?>
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
