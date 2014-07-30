<?php
// it includes parameters connetion
include('conf.php');

if(isset($_POST['submit'])){
    
    /*echo $_POST['name'].'</br>';
    echo $_POST['h1'].'</br>';
    echo $_POST['text'].'</br>';
    echo $_POST['field_type'].'</br>';
    echo $_POST['field'].'</br>';
    foreach ($_POST['idQuestion'] as $selectedOption)
    echo $selectedOption."\n</br>";*/
    
    $reqForm = $bdd->prepare('INSERT INTO fields (type, label) VALUES (:type, :label)');
	// We execute the request by transmitting the parameter list
	$reqForm->execute(array(
		'type' => $_POST['type'],
		'label' => $_POST['label']
		)) or die(print_r($reqForm->errorInfo())); // It tracks  the error if there is one
                 $id_form = $bdd->lastInsertId();
	// The request processing is terminated
	$reqForm->closeCursor();
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
        	<h1>Create field</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new field.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                         ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The field has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="create-field.php" >
                                        <button type="button" name="create_another_field" id="create_another_field" class="btn btn-primary" >Create another field </button>
                                      </a>
                                     <a href="view-field.php" >
                                        <button type="button" name="view_all_field" id="view_all_field" class="btn btn-primary" >View all fields </button>
                                      </a>
                                </p>           
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Field information</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_field" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                        <p>
                            <label>Field Type*</label>
                            <span class="field">
                                <select  name="type" id="field_type_id" class="status" >
                                    <option value=""></option>
                                    <?php 
                                        $reqField = $bdd->query("SELECT * FROM field_type");
                                        while ($field = $reqField->fetch())
                                        {
                                            ?>
                                    <option value="<?php echo $field['id']; ?>"> <?php echo $field['name']; ?> </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </span>
                        </p>
                        
                        <p>
                            <label>Fields *</label>
                            <span class="field"><input type="text" name="label" class="input-xxlarge" required="required" /></span>

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
