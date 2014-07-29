<?php //require ('conf.php');
include('conf.php');
	//if(isset($_POST[]))
	//	{
	//extract($_POST);

	$reqQuestion = $bdd->prepare('INSERT INTO questions (text,type) VALUES (:text,:type)');
	// We execute the request by transmitting the parameter list
	$reqQuestion->execute(array(
		'text' => $_POST['question'],
		'type' => $_POST['type']
		)) or die(print_r($reqQuestion->errorInfo())); // It tracks  the error if there is one
                 $id_question = $bdd->lastInsertId();
	// The request processing is terminated
	$reqQuestion->closeCursor();
        
        for ($i=1; $i<= $_POST['number_answer']; $i++)
            {
                $reqAnswer = $bdd->prepare('INSERT INTO answers (text,ref) VALUES (:text,:ref)');
	// We execute the request by transmitting the parameter list
                $reqAnswer->execute(array(
                        'text' => $_POST['answer'.$i],
                        'ref' => $_POST['ref'.$i]
                        )) or die(print_r($reqAnswer->errorInfo())); // It tracks  the error if there is one
                         $id_answer = $bdd->lastInsertId();
                // The request processing is terminated
                $reqAnswer->closeCursor();
                
                $reqQuestionAnswer = $bdd->prepare('INSERT INTO answers_questions (answers_id,questions_id) VALUES (:answers_id,:questions_id)');
	// We execute the request by transmitting the parameter list
                $reqQuestionAnswer->execute(array(
                        'answers_id' => $id_answer,
                        'questions_id' => $id_question
                        )) or die(print_r($reqQuestionAnswer->errorInfo())); // It tracks  the error if there is one
                         //$id_answer = $this->bdd->lastInsertId();
                // The request processing is terminated
                $reqQuestionAnswer->closeCursor();
                
            }
            //$_SESSION['req']=1;
	//}

	// Redirect the visitor to the next page
        header("location:create-question-answer.php");
?>
