<?php
// On inclut la page de paramètre de connection.
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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
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
          
        </div><!--breadcrumbwidget-->
      <div class="pagetitle">
        	<h1>View Users</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please see all the questions and associated answers. </span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
        	<div class="contentinner content-dashboard">
			
            <table class="table table-bordered" id="dbase">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
 
                    <thead>
                        <tr>
                            <th class="centeralign">Question</th>
                            <th class="centeralign">Answer</th>
                            <th class="centeralign"></th>
							
                    </thead>
                    <tbody>
					<?php
					// On récupère tout le contenu de la table 'client'
					$reqQuestion = $bdd->query('SELECT * FROM questions ') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					// On affiche chaque entrée une à une et celà tant qu'il y en a
					while ($question = $reqQuestion->fetch())
						{?>
                        <tr>
                        <form class="stdform" method="post" action="update-question-answer.php?id=<?php echo $question['id'];?>">

                            <td class="centeralign" >
                                  <p align="center"> <?php echo $question['text'] ?>
                            </td>
                            <td class="centeralign" style="text-align: left">
                                <?php 
                                if($question['type'] === 'Input text')
                                {
                                    //echo 'Input text'; ?> 
                                <input type="text" >
                                <?php
                                }
                                if($question['type'] === 'Select')
                                {
                                    //echo 'Select';
                                    ?><select name="answers" id="answers" class="status"> <?php
                                   $reqAnswer = $bdd->query('SELECT answers.text AS answer FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<option value="'.$answer['answer'].'">'.$answer['answer'].'</option>';
                                              
                                    }?> </select> <?php
                                    
                                }
                                 if($question['type'] === 'Radio')
                                {
                                    //echo 'Radio';
                                     $reqAnswer = $bdd->query('SELECT answers.text AS answer FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<INPUT type= "radio" name="rqdio" value="'.$answer['answer'].'">'.$answer['answer'].'</br>';
                                                                                     
                                    }
                                }
                                 if($question['type'] === 'Checkbox')
                                {
                                   // echo 'Checkbox';
                                     $reqAnswer = $bdd->query('SELECT answers.text AS answer FROM answers LEFT JOIN answers_questions ON answers_questions.answers_id=answers.id WHERE answers_questions.questions_id='.$question['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                    while ($answer = $reqAnswer->fetch())
                                    {
                                        echo '<INPUT type= "checkbox" name="checkbox" value="'.$answer['answer'].'">'.$answer['answer'].'</br>';
                                                                                     
                                    }
                                }
                                 if($question['type'] === 'Textarea')
                                {
                                    //echo 'Textarea';
                                    echo' <textarea rows="1" cols="4"></textarea>
';
                                }?>
                            </td>
                            <td class="centeralign"> <a href="update-question-answer.php?id=<?php echo $question['id'] ?>" ><input type="button" class="btn btn-success" name="update" value="Update"> </a>
                            </td>
                        </form>
                        </tr>				
                           <?php }
					?>
                    </tbody>
				</table>
				<script type="text/javascript">
				// dynamic table
				jQuery('#dbase').dataTable({
				   "sPaginationType": "full_numbers",
				   "aaSortingFixed": [[4,'asc']],
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
        
        
        
        