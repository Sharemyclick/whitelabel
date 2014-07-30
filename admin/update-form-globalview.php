<?php
// it includes parameters connection
include('conf.php');

    
//Delete from table, in globalview page
if(isset($_POST) && !empty($_POST)){
    foreach($_POST as $indPost => $valPost){
        if(strpos($indPost,'delete') !== false)
        {
            echo 'coucou';
            $bdd->exec('DELETE FROM form WHERE id='.$_POST['id']);
            $bdd->exec('DELETE FROM form_answers_questions WHERE form_id='.$_POST['id']); 
        }
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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
jQuery(document).ready(function (){
	jQuery('[id=li-dashboard]').removeClass('active');
	//jQuery('[id=li-view-coreg]').addClass('active');
	jQuery('[id=li-users]').addClass('active');
        
        jQuery('[id^=delete]').click(function() {
            var id = jQuery(this).attr('id').substring(6);
            jQuery( "#form-delete-" + id ).submit();
        });
        
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
          
        </div><!--breadcrumbwidget-->
      <div class="pagetitle">
        	<h1>Modify Form</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please see all the forms and their informations. </span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
        	<div class="contentinner content-dashboard">
			
            <table class="table table-bordered" id="dbase">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
 
                    <thead>
                        <tr>
                            <th class="centeralign">Name</th>
                            <th class="centeralign">h1</th>
                            <th class="centeralign">Text</th>
                            <th class="centeralign">Fields</th>
                            <th class="centeralign">Fields type</th>
                            <th class="centeralign">Questions/Answers</th>
                            <th class="centeralign">Update</th>
                            <th class="centeralign">Delete</th>
                    </thead>
                    <tbody>
					
					<?php
					// Request for data from questions
					$reqForm = $bdd->query('SELECT * FROM form ORDER BY name ASC') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					while ($form = $reqForm->fetch())
						{?>
                        <tr>
                        <form class="stdform" method="post" action="update-form.php?id=<?php echo $form['id'];?>">

                            <td class="centeralign" >
                                <p align="center"> <?php echo $form['name'] ?> </p>
                            </td>
                            
                            <td>
                                <p align="center"> <?php echo $form['h1'] ?> </p>
                            </td>
                            
                            <td>
                                <p align="center"> <?php echo $form['text'] ?> </p>
                            </td>
                            
                            <td>
                                <p align="center"> <?php echo $form['fields'] ?> </p>
                            </td>
                            
                            <td>
                                <p align="center"> 
                                    <?php
                                    if($form['field_type_id'] === '1') 
                                    {
                                        echo 'type: input';
                                    }
                                    elseif ($form['field_type_id'] === '2') 
                                    {
                                        echo 'type: select';
                                    } 
                                    elseif ($form['field_type_id'] === '3') 
                                    {
                                        echo 'type: textarea';
                                    }
                                    elseif ($form['field_type_id'] === '4') 
                                    {
                                        echo 'type: checkbox';
                                    }
                                    elseif ($form['field_type_id'] === '5') 
                                    {
                                        echo 'type: radio';
                                    }
                                    elseif ($form['field_type_id'] === '6') 
                                    {
                                        echo 'type: datepicker';
                                    }
                                    ?>
                                </p>
                            </td>
                            
                            <td class="centeralign" style="text-align: left">
                                <?php 
                                $reqQuestionForm = $bdd->query('SELECT * FROM form_answers_questions '
                                        . 'LEFT JOIN questions ON form_answers_questions.questions_id=questions.id '
                                        . 'WHERE form_answers_questions.form_id='.$form['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                        
                                while ($question = $reqQuestionForm->fetch())
                                {
                               echo '<span><i class="iconfa-circle-arrow-right"></i>        '.$question['text'].'</span>';
                               echo '<span style="border-top: black;"></br>';
                                    //if question type is input
                                if($question['type'] === 'Input text')
                                {
                                    //echo 'Input text'; ?> 
                                <input type="text" >
                                  <?php 
                               
                                }
                                //if question type is select
                                if($question['type'] === 'Select')
                                {
                                    //echo 'Select';
                                    ?><select name="answers" id="answers" class="status"> <?php
                                   $reqAnswer = $bdd->query('SELECT answers.text AS answer, answers.ref AS ref FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<option value="'.$answer['answer'].'">'.$answer['answer'].'<i> --- Reference : '.$answer['ref'].'</i></option>';
                                    }
                                    ?> </select> <?php
                                    
                                }
                                //if question type is radio
                                 if($question['type'] === 'Radio')
                                {
                                    //echo 'Radio';
                                     $reqAnswer = $bdd->query('SELECT answers.text AS answer, answers.ref AS ref  FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<INPUT type= "radio" name="rqdio" value="'.$answer['answer'].'">'.$answer['answer'].'<i> --- Reference : '.$answer['ref'].'</i></br>';
                                    }
                                }
                                //if question type is checkbox
                                 if($question['type'] === 'Checkbox')
                                {
                                   // echo 'Checkbox';
                                     $reqAnswer = $bdd->query('SELECT answers.text AS answer, answers.ref AS ref  FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<INPUT type= "checkbox" name="checkbox" value="'.$answer['answer'].'">'.$answer['answer'].'<i> --- Reference : '.$answer['ref'].'</i></br>';
                                              
                                    }
                                }
                                //if question type is textarea
                                 if($question['type'] === 'Textarea')
                                {
                                     
                                       echo ' <textarea rows="1" cols="4"></textarea>        ';
                                }
                                echo '</span></br></br>';
                                }
                                
                                ?>
                            </td>
                            <td class="centeralign"> <a href="update-form.php?id=<?php echo $form['id']; ?>" > <input type="button" class="btn btn-success" name="update" value="Update"> </a>
                            </td>
                        </form>
                            <td class="centeralign" >
                                <form  id="form-delete-<?php echo $form['id']; ?>" name="form-delete-<?php echo $form['id']; ?>" method="post" action="">
                                  <a href="#"  class="deleterowcustomized"><span id="delete<?php echo $form['id']; ?>" class="icon-trash"></span></a>
                                  <input type="hidden" name="hidden_delete<?php echo $form['id']; ?>" value="" >
                                  <input type="hidden" name="id" value="<?php echo $form['id']; ?>" >

                                </form>
                            </td>
                            
                       
                        </tr>				
                           <?php }
					?>
                    </tbody>
				</table>
				<script type="text/javascript">
				// dynamic table
				jQuery('#dbase').dataTable({
				   "sPaginationType": "full_numbers",
				   "aaSortingFixed": [[0,'asc']],
				   "fnDrawCallback": function(oSettings) {
					  jQuery.uniform.update();
				   }
				});
				</script>
				
            </div><!--contentinner-->
			
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
	
    <div style="height:80px;"></div>
	
    <div class="footer">
    	<div class="footerleft">Sharemyclick dashboard v1.0</div>
    	<div class="footerright">&copy; Sharemyclick with Themepixels - <a href="https://twitter.com/sharemyclick"><span class="iconsweets-twitter"></a> - <a href="https://www.facebook.com/sharemyclick"><span class="iconsweets-facebook"></a> - <a href="https://www.linkedin.com/company/sharemyclick">Followus on Linkedin</a></div>
    </div><!--footer-->
 
</div><!--mainwrapper-->

</body>
</html>
        
        
        
        