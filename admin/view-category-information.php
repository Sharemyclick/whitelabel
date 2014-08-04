<?php
//It includes the page parameter connection.
include('conf.php');
$id_category=$_GET['id'];
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
        	<h1>Create Category</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new category.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">

                <div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Category</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="update-category.php?id=<?php echo $id_category ; ?>" enctype="multipart/form-data">
                         <?php 
                        $reqCategory = $bdd->query('SELECT * FROM categories LEFT JOIN template_categories ON template_categories.categories_id=categories.id WHERE categories.id='.$id_category) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					while ($category = $reqCategory->fetch())
						{?>  
                        
                        
                         <p>
                            <label>Parent Name *</label>
                            <span class="field">
                                <select id="parent_id" name="parent_id" readonly="readonly">
                                    <option value=""> No parent category </option>
                                    <?php 
                                    $reqCategories = $bdd->query('SELECT * FROM categories') or die(print_r($bdd->errorInfo()));

                                    while ($categoriesList = $reqCategories->fetch())
                                        {?>
                                        <option value="<?php echo $categoriesList['id']; ?>" <?php if($categoriesList['id']===$category['parent_id']){ echo 'selected';} ?>><?php echo $categoriesList['name']; ?></option>
                                    <?php }?>
                                </select>                            
                            </span>
                        </p>
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" value="<?php echo $category['name']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                           <label>Image <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><img  src="<?php echo 'http://localhost/white_label/admin/img/categories/'.$category['image'] ?>" height="184" width="104" ></span>
                        </p>
                        
                        <p>
                            <label>Picto <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><img  src="<?php echo 'http://localhost/white_label/admin/img/categories/'.$category['picto'] ?>" height="184" width="104" ></span>
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <?php 
                                            if ($category['status']=='active')
                                            {
                                                ?>
                                <input type="button" class="btn btn-success" value="Status : Active">
                                                <?php ;
                                            
                                            }
                                            if  ($category['status']=='non-active')
                                            {
                                                ?>
                                <input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                <?php ;
                                            }
                                            
                                        ?>
                            </span>
                        </p>
                        
                        <p>
                            <label>Theme *</label>
                            <span class="field">
                                <select id="themes_id" name="themes_id" readonly="readonly">
                                <?php 
                                $reqThemes = $bdd->query('SELECT * FROM themes') or die(print_r($bdd->errorInfo()));

                                while ($theme = $reqThemes->fetch())
                                    {?>
                                    <option value="<?php echo $theme['id']; ?>" <?php if($theme['id']===$category['themes_id']){ echo 'selected';} ?> ><?php echo $theme['name']; ?></option>
                                <?php }?>
                                </select>
                            </span>
                        </p>
                        <h4 class="widgettitle nomargin shadowed">Template category</h4>
                        
                        <p>
                            <label>URL *</label>
                            <span class="field">
                                <input type="url" name="url" value="<?php echo $category['url']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>

                        <p>
                            <label>Meta  *</label>
                            <span class="field">
                                <input type="text" name="meta" value="<?php echo $category['meta']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Title  *</label>
                            <span class="field">
                                <input type="text" name="title" value="<?php echo $category['title']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" value="<?php echo $category['text']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Alt *</label>
                            <span class="field">
                                <input type="text" id="alt"  name="alt" value="<?php echo $category['alt']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        <p>
                            <label>Link *</label>
                            <span class="field">
                                <input type="text" id="link"  name="link" value="<?php echo $category['link']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                        
                        <p>
                            <label>h1 *</label>
                            <span class="field">
                                <input type="text" id="h1"  name="h1" value="<?php echo $category['h1']; ?>" class="input-xxlarge" readonly="readonly" />
                            </span>
                        </p>
                                                                   
                        <p class="stdformbutton" style="text-align: center">
                            <a href="update-category.php?id=<?php echo $id_category; ?>" ><button type="button" name="update" id="submit" class="btn btn-primary">Update </button> </a>
                        </p>
                        
                                                </form> <?php } ?>
                    </div>				
                </div><!--contentinner--> 
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
