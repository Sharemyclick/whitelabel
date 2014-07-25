<?php
// On inclut la page de paramÃ¨tre de connection.
include('conf.php');


$id=$_GET['id'];

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
        	<h1> Question & Answer(s)</h1> <span><?php echo $_SESSION['login']; ?> , here you can modify the data.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit_update'])){
        $bdd->exec('UPDATE admin SET login="'.$_POST['login'].'" , password="'.$_POST['password'].'" , email="'.$_POST['email'].' ", name = "'.$_POST['name'].'", company = "'.$_POST['company'].'", address = "'.$_POST['address'].'", postal_code ="'.$_POST['postal_code'].'", city = "'.$_POST['city'].'", telephone="'.$_POST['telephone'].'", iban="'.$_POST['iban'].'", swift_bic="'.$_POST['swift_bic'].'", vat = "'.$_POST['vat'].'", admin_rights_id="'.$_POST['admin_rights_id'].'" WHERE id='.$id);

                         
                         ?>   <h4 class='confirmation' style="text-align: center" ">Informations have been updated. </h4> </br> 
                
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
                                $i=1;
                                while ($answer = $reqAnswer->fetch())
                                    {   
                                         ?>  <input type="text" value="<?php echo $answer['text'];?>" name="answer<?php echo $i; ?>" class="input-xxlarge" /> 
                                         <input type="text" value="" name="ref<?php echo $b; ?>" placeholder="Reference" /> </br> </br>  
  <?php
                                    }

                                if(isset($_POST['generate']))
                                {
                                    for ($a=1; $a<=$_POST['nb_answer'];$a++)
                                    {
                                           $b=$a+$i;
                                             ?> 
                                         
                                         <input type="text" value="" name="answer<?php echo $b; ?>" class="input-xxlarge" /> 
                                        <input type="text" value="" name="ref<?php echo $b; ?>" placeholder="Reference"  /> </br> </br>  <?php

                                         
                                    }
                                    unset($_POST['generate']);
                                }
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
