<?php
//It includes the page parameter connection.
include('conf.php');
$id_display=$_GET['id'];

//ACTIVATION AND DESACTIVATION of the status
if(isset($_POST['deactivate']))
{
    $bdd->exec('UPDATE display SET status = "non-active" WHERE id='.$id_display);
}
if(isset($_POST['activate']))
{
    $bdd->exec('UPDATE display SET status = "active" WHERE id='.$id_display);
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
        	<h1>Modify Display</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to update a new display.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                         
//---------------------------------------------//
            
//-----------------------------------------------------------------------------------// 
        //UPDATE FORM
        $bdd->exec(' UPDATE display SET name="'.$_POST['name'].'" , type="'.$_POST['type'].'", text="'.$_POST['text'].'", href="'.$_POST['href'].'", script="'.$_POST['script'].'", intern_link="'.$_POST['intern_link'].'"  WHERE id='.$id_display);
//---------------------------------------------------------------------------------------//
        //DELETE AND INSERT form_answers_questions
        $bdd->exec('DELETE FROM categories_display WHERE display_id='.$id_display); 
        
        foreach ($_POST['idCategories'] as $selectedOption)
        {
            $reqCategoriesDisplay = $bdd->prepare('INSERT INTO categories_display (categories_id, display_id) VALUES (:categories_id, :display_id)');
            // We execute the request by transmitting the parameter list
            $reqCategoriesDisplay->execute(array(
		'categories_id' => $selectedOption,
		'display_id' => $id_display
            
		)) or die(print_r($reqCategoriesDisplay->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqCategoriesDisplay->closeCursor();
            
        }
        
//---------------------------------------------------------------------------------------//
             ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;"> The display has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                        <a href="update-display-globalview.php" >
                                        <button type="button" name="create_another_display" id="create_another_display" class="btn btn-primary" >Modify another display </button>
                                      </a>
                                     <a href="view-display-globalview.php" >
                                        <button type="button" name="view_all_display" id="view_all_display" class="btn btn-primary" >View all displays </button>
                                      </a>
                
                                </p>   
                
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Display</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        <?php
					// Request for data from display
					$reqDisplay = $bdd->query('SELECT * FROM display WHERE id='.$id_display) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                        while ($display = $reqDisplay->fetch())
						{?>
                        <p>
                            <label>Name *</label>
                            <span class="field">
                                <input type="text" name="name" value="<?php echo $display['name']; ?>" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                           <label>Image <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><img  src="<?php echo 'http://localhost/white_label/admin/img/display/'.$display['image'] ?>" height="184" width="104" ></span>
                        </p>
                        
                        <p>
                            <label>type  *</label>
                            <span class="field">
                                <input type="text" name="type" value="<?php echo $display['type']; ?>" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field">
                                <input type="text" id="text"  name="text" value="<?php echo $display['text']; ?>" class="input-xxlarge" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>href *</label>
                            <span class="field">
                                <input type="text" name="href" class="input-xxlarge" value="<?php echo $display['href']; ?>" required="required" />
                            </span>
                        </p>
                        
                        <p>
                            <label>Script *</label>
                            <span class="field">
                                <input type="text" name="script" class="input-xxlarge" value="<?php echo $display['script']; ?>" required="required" />
                            </span>
                        </p>
                       
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <?php 
                                            if ($display['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate the status'> 
                                                <?php ;
                                            
                                            }
                                            if  ($display['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate the status'>
                                                <?php ;
                                            }
                                            
                                        ?>
                            </span>
                        </p>
                        
                        <p>
                            <label>Intern link *</label>
                            <span class="field">
                                <input type="text" name="intern_link" class="input-xxlarge"  value="<?php echo $display['intern_link']; ?>" required="required" />
                            </span>
                        </p>

                        <p>
                            <label>Select Category</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idCategories[]" multiple size="12" >
                                    <?php
                                    $reqCategoriesList = $bdd->query("SELECT * FROM categories ");
                                    while ($categoriesList = $reqCategoriesList->fetch())
                                    {
                                    $reqCategoriesSelected = $bdd->query("SELECT * FROM categories_display WHERE display_id=".$id_display);
                                        ?>
                                        <option value="<?php echo $categoriesList['id']; ?>" <?php while ($categoriesSelected = $reqCategoriesSelected->fetch()){if( $categoriesSelected['categories_id'] === $categoriesList['id']) {echo 'selected';} } ?> > <?php echo $categoriesList['name'];?></option>
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
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update </button>
                        </p>
                        
                        </form>
                    </div>				
                </div><!--contentinner--> <?php }}; ?>
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
