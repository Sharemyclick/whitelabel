<?php
// it includes parameters connection
include('conf.php');

$id=$_GET['id'];
//request from tables questions and answers
$reqQuestion = $bdd->query('SELECT * FROM questions WHERE id='.$id) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
$reqAnswer = $bdd->query('SELECT * FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$id) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sharemyclick admin platform V1.0</title>
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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
</head>

<body>


	
	<?php include ('./menu/menu-left.php');
        ?>
    
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
        	<h1> Modify Question & Answer(s)</h1> <span><?php echo $_SESSION['login']; ?> , here you can modify the data.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit_update'])){
        $reqDeleteAnswer = $bdd->query('SELECT answers.id FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$id);
             
        //DELETE FROM JOINED TABLE
        $bdd->exec('DELETE FROM answers_questions WHERE answers_questions.questions_id='.$id);
        //echo 'delete from answers_questions <br>';
        
//---------------------------------------------------------------------------------//
        //DELETE FROM ANSWER 
        while ($answer = $reqDeleteAnswer->fetch())
            { 
            $bdd->exec('DELETE FROM answers WHERE id='.$answer['id']);      
            }
        //echo 'delete from answers <br>';
        
//-----------------------------------------------------------------------------------// 
        //UPDATE QUESTIONS
        $bdd->exec('UPDATE questions SET text="'.$_POST['question'].'" , type="'.$_POST['type'].'" WHERE id='.$id);
        //echo 'update question </br>';
        
//---------------------------------------------------------------------------------------//
        //INSERT NEW DATA INTO ANSWERS
       // echo '<pre>'.var_dump($_POST).'</pre>';
        for ($ans = 0; $ans<$_POST['nb_answer_insert']; $ans++)
        {
            $reqInsertAnswer = $bdd->prepare('INSERT INTO answers(text, ref) VALUES (:text, :ref)');
// We execute the request by transmitting the parameter list
	$reqInsertAnswer->execute(array(
		'text' => $_POST['answer'.$ans],
                'ref' => $_POST['ref'.$ans]
                
		)) or die(print_r($reqInsertAnswer->errorInfo()));
        $idAnswer= $bdd->lastInsertId();
        
        //echo 'answer num'.$ans.' inseree dans answer </br>';
        
        $reqInsertAnswerQuestion = $bdd->prepare('INSERT INTO answers_questions (answers_id, questions_id) VALUES (:answers_id, :questions_id)');
// We execute the request by transmitting the parameter list
	$reqInsertAnswerQuestion->execute(array(
		'answers_id' => $idAnswer,
                'questions_id' => $id
                
		)) or die(print_r($req->errorInfo()));
       // echo 'insert into join table answer_question /br>';

        }
     
               ?>
                <h4 class='confirmation' style="text-align: center" ">Informations have been updated. </h4> </br> 
                
                         <span class="field" >
                             <div class="widgetcontent">
                                
                                 <p class="stdformbutton" style="text-align: center">
                                     <a href="update-question-answer-globalview.php" >
                                        <button type="button" name="return_to_update" id="return_to_update" class="btn btn-primary" >Update another question/answers </button>
                                      </a>
                                     <a href="view-question-answer.php." >
                                        <button type="button" name="view_all" id="view_all" class="btn btn-primary" >View all question/answers </button>
                                      </a>
                                </p>
                                
                                
                                 
                            </div>
                         </span>
                <?php ;}
                else {while ($question = $reqQuestion->fetch())
						{?>
                
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Question & Answers</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_affiliate_company" class="stdform stdform2" method="post" action="update-question-answer.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <p>
                            <label>Question</label>
                            <span class="field"><input type="text" value="<?php echo $question['text'];?>" name="question" class="input-xxlarge" /></span>
                        </p>
                               
                        <p>
                            <label>Type of question</label>
                            <span class="field">
                                        <select name="type" id="type" class="status">
                                            <option value="Input text"  <?php if ($question['type']=="Input text") {echo ' selected ';} ?>>Input text</option>
                                            <option value="Select" <?php if ($question['type']=="Select") {echo ' selected ';} ?>>Select</option>
                                            <option value="Radio" <?php if ($question['type']=="Radio") {echo ' selected ';} ?>>Radio</option>
                                            <option value="Checkbox" <?php if ($question['type']=="Checkbox") {echo ' selected ';} ?>>Checkbox</option>
                                            <option value="Textarea" <?php if ($question['type']=="Textarea") {echo ' selected ';} ?>>Textarea</option>
                                        </select>
                                    </span>
                        </p>

                        <p>
                            <label>Number of answer to add *</label>
                            <span class="field">
                                <input type="number" min="1" step="1" id="nb_answer"  name="nb_answer"  value="" />
                                <a href="update-question-answer.php?id=<?php echo $id; ?>" > <input type="submit" name="generate" class="btn" value="Generate fields"> </a>
                            </span>
                            
                        </p>
                        
                        <p>
                            <label> Answer(s)</label>
                            
                            <span class="field">
                                <?php
                                $i=0;
                                //FOR EXISTING ANSWERS
                                while ($answer = $reqAnswer->fetch())
                                    {   
                                         ?>  <input type="text" value="<?php echo $answer['text'];?>" name="answer<?php echo $i; ?>" class="input-xxlarge" /> 
                                         <input type="text" value="<?php echo $answer['ref'];?>" name="ref<?php echo $i; ?>" placeholder="Reference" /> </br> </br>  
  <?php $i=$i+1;
                                    }
                                    $nb=$i;
                                // FOR NEWS ANSWERS GENERATED
                                if(isset($_POST['generate']))
                                {
                                    for ($a=1; $a<=$_POST['nb_answer'];$a++)
                                    {
                                           $b=$a+($i-1);
                                             ?> 
                                         
                                         <input type="text" value="" name="answer<?php echo $b; ?>" class="input-xxlarge" /> 
                                        <input type="text" value="<?php echo $answer['ref'];?>" name="ref<?php echo $b; ?>" placeholder="Reference"  /> </br> </br>  <?php

                                    }
                                    unset($_POST['generate']);
                                    $nb=$b+1;
                                }
                                ?>
                                        <input type="hidden" name="nb_answer_insert" value="<?php echo $nb; ?>">
                                        <?php
                                                ?>
                            </span>
                            
                        </p>
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit_update" id="submit_update" class="btn btn-primary"> Update informations</button>
                        </p>
                <?php }}; ?>
                                        
                        </form>
                    </div>				
                </div><!--contentinner-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
	

	
    <div class="footer">
    	<div class="footerleft">Sharemyclick dashboard v1.0</div>
    	<div class="footerright">&copy; Sharemyclick with Themepixels - <a href="https://twitter.com/sharemyclick"><span class="iconsweets-twitter"></a> - <a href="https://www.facebook.com/sharemyclick"><span class="iconsweets-facebook"></a> - <a href="https://www.linkedin.com/company/sharemyclick">Followus on Linkedin</a></div>
    </div><!--footer-->
 


</body>
</html>
