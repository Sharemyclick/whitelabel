<?php
//It includes the page parameter connection.
include('conf.php');
$id_category=$_GET['id'];

//ACTIVATION AND DESACTIVATION of the status
if(isset($_POST['deactivate']))
{
 
    $bdd->exec('UPDATE categories SET status = "non-active" WHERE id='.$id_category);

}
if(isset($_POST['activate']))
{

    $bdd->exec('UPDATE categories SET status = "active" WHERE id='.$id_category);
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
        	<h1>Update category informations </h1> <span><?php echo $_SESSION['login']; ?> , Please see category's information .</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
               
			<div class="widgetcontent">
			
            	
					
                
                    <?php if(isset($_POST['submit']))
                    {
//-----------------------------------------------------------------------------------// 
//UPDATE themes table
        $bdd->exec(' UPDATE categories SET parent_id="'.$_POST['parent_id'].'", name="'.$_POST['name'].'", image="'.$_POST['image'].'", picto="'.$_POST['picto'].'", themes_id="'.$_POST['themes_id'].'" WHERE id='.$id_category);
//---------------------------------------------------------------------------------------//
        
//-----------------------------------------------------------------------------------// 
//UPDATE template_themes table
        $bdd->exec(' UPDATE template_categories SET url="'.$_POST['url'].'", meta="'.$_POST['meta'].'", title="'.$_POST['title'].'", text="'.$_POST['text'].'", alt="'.$_POST['alt'].'", link="'.$_POST['link'].'", h1="'.$_POST['h1'].'" WHERE categories_id='.$id_category);
//---------------------------------------------------------------------------------------//
                        
                    ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The category has been updated </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                        <a href="update-category-globalview.php" >
                                        <button type="button" name="update_another_category" id="update_another_category" class="btn btn-primary" >Update another category </button>
                                      </a>
                                        <a href="view-category-globalview.php" >
                                        <button type="button" name="view_all_category" id="view_all_category" class="btn btn-primary" >View all categories </button>
                                      </a>
                                </p>           
                <?php }
                    
                    Else{?>
                                <div class="widgetcontent bordered shadowed nopadding">
                                <h4 class="widgettitle nomargin shadowed">Theme</h4>
                    <form name="form_user" class="stdform stdform2" method="post" action="update-category.php?id=<?php echo $id_category; ?>" enctype="multipart/form-data">
                        <?php 
                        $reqCategory = $bdd->query('SELECT * FROM categories LEFT JOIN template_categories ON template_categories.categories_id=categories.id WHERE categories.id='.$id_category) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
				while ($category = $reqCategory->fetch())
						{ ?>
                        <p>
                            <label>Parent Name *</label>
                            <span class="field">
                                <select id="parent_id" name="parent_id">
                                    <option value="" <?php if($category['parent_id']==='0'){echo 'selected';} ?>> No parent category </option>
                                    <?php 
                                    $reqCategories = $bdd->query('SELECT * FROM categories') or die(print_r($bdd->errorInfo()));

                                    while ($listCategories = $reqCategories->fetch())
                                        {?>
                                        <option value="<?php echo $listCategories['id']; ?>" <?php if ($listCategories['id']===$category['parent_id']){echo 'selected';} ?>><?php echo $listCategories['name']; ?></option>
                                    <?php }?>
                                </select>                            
                            </span>
                        </p>
                        
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" class="input-xxlarge" value="<?php echo $category['name'] ?>" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Image *</label>
                            <span class="field">
                                <input type="text" name="image" class="input-xxlarge" value="<?php echo $category['image'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Picto *</label>
                            <span class="field">
                                <input type="text" name="picto" class="input-xxlarge" value="<?php echo $category['picto'] ?>" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                 <?php 
                                            if ($category['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate the theme'> 
                                                <?php ;
                                            
                                            }
                                            if  ($category['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate the theme'>
                                                <?php ;
                                            }
                                            
                                        ?>
                            </span>
                        </p>
                        
                        <p>
                            <label>Theme *</label>
                            <span class="field">
                                <select id="themes_id" name="themes_id" required="required" >
                                    <option value="" <?php if($category['themes_id']==='0'){echo 'selected';} ?> > No theme defined </option>

                                <?php 
                                $reqThemes = $bdd->query('SELECT * FROM themes') or die(print_r($bdd->errorInfo()));

                                while ($theme = $reqThemes->fetch())
                                    {?>
                                    <option value="<?php echo $theme['id']; ?>" <?php if($theme['id']===$category['themes_id']){echo 'selected';} ?>>  <?php echo $theme['name']; ?></option>
                                <?php }?>
                                </select>
                            </span>
                        </p>
                        <h4 class="widgettitle nomargin shadowed">Template Theme</h4>
                        
                        <p>
                            <label>URL *</label>
                            <span class="field">
                                <input type="url" name="url" class="input-xxlarge" value="<?php echo $category['url'] ?>" required="required"  />
                            </span>
                        </p>

                        <p>
                            <label>Meta  *</label>
                            <span class="field">
                                <input type="text" name="meta" class="input-xxlarge" value="<?php echo $category['meta'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Title  *</label>
                            <span class="field">
                                <input type="text" name="title" class="input-xxlarge" value="<?php echo $category['title'] ?>" required="required" " />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" class="input-xxlarge" value="<?php echo $category['text'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>Alt *</label>
                            <span class="field">
                                <input type="text" id="alt"  name="alt" class="input-xxlarge" value="<?php echo $category['alt'] ?>" required="required"  />
                            </span>
                        </p>
                        <p>
                            <label>Link *</label>
                            <span class="field">
                                <input type="text" id="link"  name="link" class="input-xxlarge" value="<?php echo $category['link'] ?>" required="required"  />
                            </span>
                        </p>
                        
                        <p>
                            <label>h1 *</label>
                            <span class="field">
                                <input type="text" id="h1"  name="h1" class="input-xxlarge" value="<?php echo $category['h1'] ?>" required="required"  />
                            </span>
                        </p>
                                                                   
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update </button>
                            <?php 
                                            if ($category['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate the theme'> 
                                                <?php ;
                                            
                                            }
                                            if  ($category['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate the theme'>
                                                <?php ;
                                            }
                                            
                                        ?>
                            
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
