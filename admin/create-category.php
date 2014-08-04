<?php
//It includes the page parameter connection.
include('conf.php');

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
                
                <?php
                     if(isset($_POST['submit'])){
                         
//---------------------------------------------//
//test for image
            $dossier = 'C:/xampp/htdocs/white_label/admin/img/categories/';//TODO remove local part when upload to server !!
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 3000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG', '.JPEG', '.GIF', '.PNG');
            $extension = strrchr($_FILES['image']['name'], '.'); 
    // Start safety checks ...
    if(!in_array($extension, $extensions)) // If the extension is not in the table
            {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg ...';
            }
    if($taille>$taille_maxi)
            {
        $erreur = 'l\'image est trop lourde. Maximum de 500ko...';
            }
    if(!isset($erreur)) //if error=null, upload the picture
            {
            // It formats the file name 
            $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

            $return = move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier); // If the function returns TRUE, it worked
              
            }
    
            
//---------------------------------------------//
//test for picto
            $dossier2 = 'C:/xampp/htdocs/white_label/admin/img/categories/';//TODO remove local part when upload to server !!
            $fichier2 = basename($_FILES['picto']['name']);
            $taille_maxi2 = 3000000;
            $taille2 = filesize($_FILES['picto']['tmp_name']);
            $extensions2 = array('.png', '.gif', '.jpg', '.jpeg', '.JPG', '.JPEG', '.GIF', '.PNG');
            $extension2 = strrchr($_FILES['picto']['name'], '.'); 
    // Start safety checks ...
    if(!in_array($extension2, $extensions2)) // If the extension is not in the table
            {
        $erreur2 = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg ...';
            }
    if($taille2>$taille_maxi2)
            {
        $erreur2 = 'l\'image est trop lourde. Maximum de 500ko...';
            }
    if(!isset($erreur2)) //if error=null, upload the picture
            {
            // It formats the file name 
            $fichier2 = strtr($fichier2, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier2 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier2);

            $return2 = move_uploaded_file($_FILES['picto']['tmp_name'], $dossier2 . $fichier2); // If the function returns TRUE, it worked
              
            }
                        
//---------------------- INSERT THEMES ---------------------------------------------------------------------
        $reqThemes = $bdd->prepare('INSERT INTO categories (parent_id, name, image, picto, status, themes_id)'.
        'VALUES (:parent_id, :name, :image, :picto, :status, :themes_id)');
// We execute the request by transmitting the parameter list
	$reqThemes->execute(array(
                'parent_id' => $_POST['parent_id'],
		'name' => $_POST['name'],
                'image' => $_FILES['image']['name'],
                'picto' => $_FILES['picto']['name'],
                'status' => $_POST['status'],
                'themes_id' => $_POST['themes_id']
                
		)) or die(print_r($reqThemes->errorInfo())); // Oit tracks error if there is one
                $id_category = $bdd->lastInsertId();
                // The request processing is terminated
                $reqThemes->closeCursor();
                         
//---------------------- INSERT TEMPLATE_THEMES ---------------------------------------------------------------------
        $reqThemesTemplate = $bdd->prepare('INSERT INTO template_categories (url, meta, title, text, alt, link, h1, categories_id)'.
        'VALUES (:url, :meta, :title, :text, :alt, :link, :h1, :categories_id)');
// We execute the request by transmitting the parameter list
	$reqThemesTemplate->execute(array(
		'url' => $_POST['url'],
                'meta' => $_POST['meta'],
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'alt' => $_POST['alt'],
                'link' => $_POST['link'],
                'h1' => $_POST['h1'],
                'categories_id' => $id_category
		)) or die(print_r($reqThemesTemplate->errorInfo())); // Oit tracks error if there is one
                // The request processing is terminated
                $reqThemesTemplate->closeCursor();                    
                         
             ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The category has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="create-category.php" >
                                        <button type="button" name="create_another_category" id="create_another_category" class="btn btn-primary" >Create another category </button>
                                      </a>
                                     <a href="view-category-globalview.php" >
                                        <button type="button" name="view_all_category" id="view_all_category" class="btn btn-primary" >View all categories </button>
                                      </a>
                
                                </p>   
                
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Category</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                         <p>
                            <label>Parent Name *</label>
                            <span class="field">
                                <select id="parent_id" name="parent_id">
                                    <option value=""> No parent category </option>
                                    <?php 
                                    $reqCategories = $bdd->query('SELECT * FROM categories') or die(print_r($bdd->errorInfo()));

                                    while ($categories = $reqCategories->fetch())
                                        {?>
                                        <option value="<?php echo $categories['id']; ?>"><?php echo $categories['name']; ?></option>
                                    <?php }?>
                                </select>                            
                            </span>
                        </p>
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                           <label>Image <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                           <span class="field"><input type="file" name="image" id="image" /></span>
                        </p>
                        
                        <p>
                            <label>Picto <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><input type="file" name="picto" id="picto" /></span>
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
                        
                        <p>
                            <label>Theme *</label>
                            <span class="field">
                                <select id="themes_id" name="themes_id">
                                <?php 
                                $reqThemes = $bdd->query('SELECT * FROM themes') or die(print_r($bdd->errorInfo()));

                                while ($theme = $reqThemes->fetch())
                                    {?>
                                    <option value="<?php echo $theme['id']; ?>"><?php echo $theme['name']; ?></option>
                                <?php }?>
                                </select>
                            </span>
                        </p>
                        <h4 class="widgettitle nomargin shadowed">Template category</h4>
                        
                        <p>
                            <label>URL *</label>
                            <span class="field">
                                <input type="url" name="url" class="input-xxlarge" required="required" />
                            </span>
                        </p>

                        <p>
                            <label>Meta  *</label>
                            <span class="field">
                                <input type="text" name="meta" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Title  *</label>
                            <span class="field">
                                <input type="text" name="title" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Alt *</label>
                            <span class="field">
                                <input type="text" id="alt"  name="alt" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        <p>
                            <label>Link *</label>
                            <span class="field">
                                <input type="text" id="link"  name="link" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>h1 *</label>
                            <span class="field">
                                <input type="text" id="h1"  name="h1" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                                                                   
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Create </button>
                            <button type="reset" class="btn">Reset </button>
                        </p>
                        
                        </form>
                    </div>				
                </div><!--contentinner--> <?php }; ?>
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
