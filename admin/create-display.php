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
        	<h1>Create Display</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new display.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                         
//---------------------------------------------//
//test for image
            $dossier = 'C:/xampp/htdocs/white_label/admin/img/display/';//TODO remove local part when upload to server !!
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 300000;
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

                        
//---------------------- INSERT THEMES ---------------------------------------------------------------------
        $reqThemes = $bdd->prepare('INSERT INTO display (name, image, type, text, href, script, status, intern_link)'.
        'VALUES (:name, :image, :type, :text, :href, :script, :status, :intern_link)');
// We execute the request by transmitting the parameter list
	$reqThemes->execute(array(
                'name' => $_POST['name'],
		'image' => $_FILES['image']['name'],
                'type' => $_POST['type'],
                'text' => $_POST['text'],
                'href' => $_POST['href'],
                'script' => $_POST['script'],
                'status' => $_POST['status'],
                'intern_link' => $_POST['intern_link']
                
		)) or die(print_r($reqThemes->errorInfo())); // Oit tracks error if there is one
                $id_display = $bdd->lastInsertId();
                // The request processing is terminated
                $reqThemes->closeCursor();
        
        foreach ($_POST['idCategories'] as $selectedField)
        {
            $reqFormField = $bdd->prepare('INSERT INTO categories_display (display_id, categories_id) VALUES (:display_id, :categories_id)');
            // We execute the request by transmitting the parameter list
            $reqFormField->execute(array(
		'display_id' => $id_display,
		'categories_id' => $selectedField
            
		)) or die(print_r($reqFormField->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqFormField->closeCursor();
            
        }               
                         
             ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The display has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="create-display.php" >
                                        <button type="button" name="create_another_display" id="create_another_display" class="btn btn-primary" >Create another display </button>
                                      </a>
                                     <a href="view-category-globalview.php" >
                                        <button type="button" name="view_all_display" id="view_all_display" class="btn btn-primary" >View all displays </button>
                                      </a>
                
                                </p>   
                
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Display</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                           <label>Image <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><input type="file" name="image" id="image" /></span>
                        </p>
                        
                        <p>
                            <label>type  *</label>
                            <span class="field">
                                <input type="text" name="type" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>href *</label>
                            <span class="field">
                                <input type="text" name="href" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Script *</label>
                            <span class="field">
                                <input type="text" name="script" class="input-xxlarge" required="required" />
                            </span>
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
                            <label>Intern link *</label>
                            <span class="field">
                                <input type="text" name="intern_link" class="input-xxlarge" required="required" />
                            </span>
                        </p>

                        <p>
                            <label>Select Category</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idCategories[]" multiple size="12" >
                                    <?php
                                    $reqCategories = $bdd->query("SELECT * FROM categories ");
                                    while ($categoriesList = $reqCategories->fetch())
                                    {
                                        ?>
                                        <option value="<?php echo $categoriesList['id']; ?>" > <?php echo $categoriesList['name'];?></option>
                                    <?php 
                                    }?>
                                </select>
                                <span class="ds_arrow" style="display:none;">
                                	<button class="btn ds_prev"><i class="icon-chevron-left"></i></button><br />
                                    <button class="btn ds_next"><i class="icon-chevron-right"></i></button>
                                </span>
                                <select name="select4[]" multiple style="display:none;" size="10">
                                    <option value=""></option>
                                </select>
                            </span>
                        </p>
                                                             
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Create </button>
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
