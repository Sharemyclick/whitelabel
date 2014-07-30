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
    
    $reqForm = $bdd->prepare('INSERT INTO form (name, h1, text) VALUES (:name, :h1, :text)');
	// We execute the request by transmitting the parameter list
	$reqForm->execute(array(
		'name' => $_POST['name'],
		'h1' => $_POST['h1'],
                'text' => $_POST['text']
            
		)) or die(print_r($reqForm->errorInfo())); // It tracks  the error if there is one
                 $id_form = $bdd->lastInsertId();
	// The request processing is terminated
	$reqForm->closeCursor();
        
        foreach ($_POST['idField'] as $selectedField)
        {
            $reqFormField = $bdd->prepare('INSERT INTO form_fields (form_id, fields_id) VALUES (:form_id, :fields_id)');
            // We execute the request by transmitting the parameter list
            $reqFormField->execute(array(
		'form_id' => $id_form,
		'fields_id' => $selectedField
            
		)) or die(print_r($reqFormField->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqFormField->closeCursor();
            
        }
        
        foreach ($_POST['idQuestion'] as $selectedOption)
        {
            $reqForm = $bdd->prepare('INSERT INTO form_answers_questions (form_id, questions_id) VALUES (:form_id, :questions_id)');
            // We execute the request by transmitting the parameter list
            $reqForm->execute(array(
		'form_id' => $id_form,
		'questions_id' => $selectedOption
            
		)) or die(print_r($reqForm->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqForm->closeCursor();
            
        }
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
        	<h1>Create User</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new form.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                         ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The form has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="create-form.php" >
                                        <button type="button" name="create_another_form" id="create_another_form" class="btn btn-primary" >Create another form </button>
                                      </a>
                                     <a href="view-form.php" >
                                        <button type="button" name="view_all_form" id="view_all_form" class="btn btn-primary" >View all forms </button>
                                      </a>
                                </p>           
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Form information</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                        <p>
                            <label>Form name *</label>
                            <span class="field"><input type="text" name="name" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>h1 - Text description *</label>
                            <span class="field"><input type="text" name="h1" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Text *</label>
                            <span class="field"><input type="text" name="text" class="input-xxlarge" required="required" /></span>
                        </p>

                        <p>
                            <label>Select field(s)</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idField[]" multiple size="12" >
                                    <?php
                                    $reqField = $bdd->query("SELECT * FROM fields ");
                                    while ($field = $reqField->fetch())
                                    {
                                        ?>
                                        <option value="<?php echo $field['id']; ?>" > <?php echo $field['id'].' -- '.$field['label'].'  -- Type:  '.$field['type'];?></option>
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
                        
                        <p>
                            <label>Select question(s)</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idQuestion[]" multiple size="12" >
                                    <?php
                                    $reqQuestion = $bdd->query("SELECT * FROM questions ");
                                    while ($question = $reqQuestion->fetch()){
                                        $reqAnswer = $bdd->query("SELECT * FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id=".$question['id']);
                                        ?>
                                        <option value="<?php echo $question['id']; ?>"><?php echo $question['id'].' -- '.$question['text'];  while ($answer = $reqAnswer->fetch()){ echo '  //  '.$answer['text'];}?></option>
                                    <?php }?>
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
