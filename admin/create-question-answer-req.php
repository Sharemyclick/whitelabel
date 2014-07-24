<?php //require ('conf.php');
include('conf.php');
	//if(isset($_POST[]))
	//	{
	//extract($_POST);

	$reqQuestion = $bdd->prepare('INSERT INTO questions (text,type) VALUES (:text,:type)');
	// On execute la requête en lui transmettant la liste des paramètres
	$reqQuestion->execute(array(
		'text' => $_POST['question'],
		'type' => $_POST['type']
		)) or die(print_r($reqQuestion->errorInfo())); // On traque l'erreur s'il y en a une
                 $id_question = $bdd->lastInsertId();
	// On termine le traitement de la requête
	$reqQuestion->closeCursor();
        
        for ($i=1; $i<= $_POST['number_answer']; $i++)
            {
                $reqAnswer = $bdd->prepare('INSERT INTO answers (text,ref) VALUES (:text,:ref)');
                // On execute la requête en lui transmettant la liste des paramètres
                $reqAnswer->execute(array(
                        'text' => $_POST['answer'.$i],
                        'ref' => $_POST['ref'.$i]
                        )) or die(print_r($reqAnswer->errorInfo())); // On traque l'erreur s'il y en a une
                         $id_answer = $bdd->lastInsertId();
                // On termine le traitement de la requête
                $reqAnswer->closeCursor();
                
                $reqQuestionAnswer = $bdd->prepare('INSERT INTO answers_questions (answers_id,questions_id) VALUES (:answers_id,:questions_id)');
                // On execute la requête en lui transmettant la liste des paramètres
                $reqQuestionAnswer->execute(array(
                        'answers_id' => $id_answer,
                        'questions_id' => $id_question
                        )) or die(print_r($reqQuestionAnswer->errorInfo())); // On traque l'erreur s'il y en a une
                         //$id_answer = $this->bdd->lastInsertId();
                // On termine le traitement de la requête
                $reqQuestionAnswer->closeCursor();
                
            }
            //$_SESSION['req']=1;
	//}

	// Redirection du visiteur vers la page suivante  
        header("location:create-question-answer.php");
?>
