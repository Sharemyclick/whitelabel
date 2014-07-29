<?php
try
{
	// On se connecte � la base de donn�es.
	$bdd = new PDO('mysql:host=localhost;dbname=white_label', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	// En cas d'erreur, on affiche un message et on arr�te tout
	die('Erreur : '.$e->getMessage());
}


switch($_GET['action']){
	case "getUsers":
		$arUsers = array();
		$i = 0;
		$req_pid = $bdd->query("SELECT id FROM admin WHERE login = '".$_GET['login']."'");
		$res_pid = $req_pid->fetch();
		if($res_pid['id'] != 0){
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as reg_date, count(*) as total FROM user INNER JOIN user_pid ON user.id = user_pid.user_id
		where source <> 'webrivage' AND regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_pid.id = ".$res_pid['id']." 
		GROUP BY reg_date ORDER BY reg_date DESC");
		}else{
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as reg_date, count(*) as total FROM user where source <> 'webrivage' AND regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) 
		GROUP BY reg_date ORDER BY reg_date DESC");
		}
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['reg_date']] = $val_users['total'];
		}

	break;
	case "getRealTimeUsers":
		$arUsers = array();
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%H:%i')  as reg_date_temp, count(*) as total 
			FROM user where source <> 'webrivage' 
			AND regdate > DATE_SUB(NOW(), INTERVAL 1 HOUR) 
			GROUP BY reg_date_temp ORDER BY reg_date_temp DESC");
		
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['reg_date_temp']] = $val_users['total'];
		}

	break;
	case "getImpressions":
		$arImpressions = array();
		$i = 0;
		$req_impressions = $bdd->query("SELECT DATE_FORMAT(date, '%Y/%m/%d') as date, count(*) as total FROM impressions where date > DATE_SUB(NOW(), INTERVAL 31 DAY) 
		GROUP BY date ORDER BY date DESC");
		while ($val_impressions = $req_impressions->fetch()){
			$arUsers[$val_impressions['date']] = $val_impressions['total'];
		}
	break;
	case "getQuizzUsers":
		$arUsers = array();
		$i = 0;
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as reg_date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id
		AND user_jc.jc_id = ".$_GET['quizz']."
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) 
		GROUP BY reg_date ORDER BY reg_date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['reg_date']] = $val_users['total'];
		}

	break;
	case "getQuizzUsersStep1":
		$arUsers = array();
		$i = 0;
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id 
		AND user_jc.jc_id = ".$_GET['quizz']." 
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_jc.step = 1
		GROUP BY date ORDER BY date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['date']] = $val_users['total'];
		}
	break;
	case "getQuizzUsersStep2":
		$arUsers = array();
		$i = 0;
		$req_users =  $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id 
		AND user_jc.jc_id = ".$_GET['quizz']." 
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_jc.step = 2
		GROUP BY date ORDER BY date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['date']] = $val_users['total'];
		}
	break;
	case "getQuizzUsersStep3":
		$arUsers = array();
		$i = 0;
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id 
		AND user_jc.jc_id = ".$_GET['quizz']." 
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_jc.step = 3
		GROUP BY date ORDER BY date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['date']] = $val_users['total'];
		}
	break;
	case "getQuizzUsersStep4":
		$arUsers = array();
		$i = 0;
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id 
		AND user_jc.jc_id = ".$_GET['quizz']." 
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_jc.step = 4
		GROUP BY date ORDER BY date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['date']] = $val_users['total'];
		}
	break;
	case "getQuizzUsersStep5":
		$arUsers = array();
		$i = 0;
		$req_users = $bdd->query("SELECT DATE_FORMAT(regdate, '%Y/%m/%d') as date, count(*) as total FROM user INNER JOIN user_jc ON user_jc.user_id = user.id 
		AND user_jc.jc_id = ".$_GET['quizz']." 
		where regdate > DATE_SUB(NOW(), INTERVAL 31 DAY) AND user_jc.step = 5
		GROUP BY date ORDER BY date DESC");
		while ($val_users = $req_users->fetch()){
			$arUsers[$val_users['date']] = $val_users['total'];
		}
	break;
	case "deletePid":
		$req = $bdd->prepare("DELETE FROM pid WHERE id =:pid");
		$req->execute(array(
						'pid' => $_GET['pid']))or die(print_r($req->errorInfo()));
	break;
	case "deleteCoreg":
		$req = $bdd->prepare("DELETE FROM coreg WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
	break;
	case "deleteSponsor":
		$req = $bdd->prepare("DELETE FROM sponsor WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
	break;
	case "updateCoreg":
		$req = $bdd->prepare("SELECT * from coreg WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['price'] = $val['coreg_price'];
			$arUsers['text'] = $val['coreg_text'];
			$arUsers['status'] = $val['status'];
		}
	break;
	case "updateCoregQuestions":
		$req = $bdd->prepare("SELECT q.id as qid, q.questions_text from coreg INNER JOIN coreg_questions cq ON cq.coreg_id = coreg.id 
		INNER JOIN questions q ON q.id = cq.question_id WHERE coreg.id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		$i = 0;
		while ($val = $req->fetch()){
			$arUsers[$i]['qid'] = $val['qid'];
			$arUsers[$i]['qtext'] = $val['questions_text'];
			$i++;
		}
	break;
	case "updateSponsor":
		$req = $bdd->prepare("SELECT * from sponsor WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['price'] = $val['sponsor_price'];
			$arUsers['text'] = $val['sponsor_text'];
			$arUsers['status'] = $val['status'];
		}
	break;
	case "updatePid":
		$req = $bdd->prepare("SELECT * from pid WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['price'] = $val['price'];
			$arUsers['country'] = $val['country'];
			$arUsers['pixel'] = $val['pixel'];
			$arUsers['color'] = $val['color_code'];
		}
	break;
	case "updateEmail":
		$req = $bdd->prepare("SELECT * from emails WHERE jc_id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['email'] = $val['email'];
		}
	break;
	case "updateTags":
		$req = $bdd->prepare("SELECT * from tags WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['text'] = $val['tag_text'];
			$arUsers['status'] = $val['status'];
		}
	break;
	case "updatePrize":
		$req = $bdd->prepare("SELECT * from secondary_prizes WHERE id =:id");
		$req->execute(array(
						'id' => $_GET['id']))or die(print_r($req->errorInfo()));
		while ($val = $req->fetch()){
			$arUsers['text'] = $val['prizes_text'];
			$arUsers['url'] = $val['prizes_url'];
		}
	break;
	case "getDailySponsors":
		$req_sponsors = $bdd->query("SELECT id,sponsor_name,sponsor_target FROM `sponsor`  "); /*WHERE status = '1'*/
							$arUsers = array();
							//$arUsers[$_GET['date']]['total'] = 0;
							while ($sponsors = $req_sponsors->fetch()){
							// On affiche les sponsors validees pour ce pid
							//$req1 = $bdd->prepare('SELECT COUNT(*) AS nb_sponsor_val, sponsor_id FROM user_sponsor WHERE validated=1 AND id=:id AND reg_date2=:reg_date2');
						
							$req1 = $bdd->prepare("SELECT COUNT(*) AS nb_sponsor_val, uc.sponsor_id FROM user_sponsor uc 
							INNER JOIN sponsor c ON c.id = uc.sponsor_id 
							INNER JOIN user u ON u.id = uc.user_id 
							INNER JOIN webservice ws ON ws.id = c.sponsor_ws
							INNER JOIN webservice_logs l ON l.input like CONCAT('', ws.url ,'%')  AND l.input like CONCAT('%email=', REPLACE(u.email,'@','%40') ,'%')
							WHERE 
							validated=1  AND reg_date2=:reg_date2 
							AND c.id = ".$sponsors['id']."
							AND l.output NOT LIKE '%ko%'
                            AND l.output NOT LIKE '%KO%'	
							AND l.output NOT LIKE '%error%'	AND l.output NOT LIKE '%Error%'	AND l.output NOT LIKE '%does not%' AND l.output NOT LIKE '%repetido%' 
							AND uc.user_id IN (SELECT id from user where 1 ".stripslashes($sponsors['sponsor_target'])." )");
						
										$req1-> execute(array(
										'reg_date2' => $_GET['date'])) or die(print_r($req1(errorInfo())));
							
							
							while ($donnees = $req1->fetch())
							{
							//$arUsers/*[$_GET['date']]*/['total'] = $arUsers/*[$_GET['date']]*/['total'] + $donnees['nb_sponsor_val'];
							$arUsers/*[$_GET['date']]*/[$sponsors['sponsor_name']] = $donnees['nb_sponsor_val'];
							}
							}
	break;
	case "getDailyCoregs":
		$req_coregs = $bdd->query("SELECT id,coreg_name,coreg_target FROM `coreg`  "); /*WHERE status = '1'*/
							$arUsers = array();
							//$arUsers[$_GET['date']]['total'] = 0;
							while ($coregs = $req_coregs->fetch()){
							// On affiche les coregs validees pour ce pid
							//$req1 = $bdd->prepare('SELECT COUNT(*) AS nb_sponsor_val, sponsor_id FROM user_sponsor WHERE validated=1 AND id=:id AND reg_date2=:reg_date2');
						
							$req1 = $bdd->prepare("SELECT COUNT(*) AS nb_coreg_val, uc.coreg_id FROM user_coreg uc 
							INNER JOIN coreg c ON c.id = uc.coreg_id 
							INNER JOIN user u ON u.id = uc.user_id 
							INNER JOIN webservice ws ON ws.id = c.coreg_ws
							INNER JOIN webservice_logs l ON l.input like CONCAT('', ws.url ,'%')  AND l.input like CONCAT('%', u.email ,'%')
							WHERE 
							validated=1 AND reg_date2=:reg_date2 
							AND c.id = ".$coregs['id']."
							AND l.output NOT LIKE '%ko%'
                            AND l.output NOT LIKE '%KO%'		
							AND uc.user_id IN (SELECT id from user where 1 ".stripslashes($coregs['coreg_target'])." )");
						
										$req1-> execute(array(
										'reg_date2' => $_GET['date'])) or die(print_r($req1(errorInfo())));
							
							
							while ($donnees = $req1->fetch())
							{
							//$arUsers/*[$_GET['date']]*/['total'] = $arUsers/*[$_GET['date']]*/['total'] + $donnees['nb_sponsor_val'];
							$arUsers/*[$_GET['date']]*/[$coregs['coreg_name']] = $donnees['nb_coreg_val'];
							}
							}
	break;
	case "getPidsStep1":
		$arUsers = array();
		$i = 0;		
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];	
		$req_users = $bdd->prepare("SELECT COUNT(id) as total, id, user.regdate2, pid.name, pid.color_code FROM `user_pid`
		INNER JOIN user on user.id = user_pid.user_id
		INNER JOIN user_jc ON user_jc.user_id = user.id
		LEFT JOIN pid ON pid.id = user_pid.id
		WHERE user.regdate2 >= :date1 AND user.regdate <= :date2 AND user_jc.step = 1 GROUP BY id");
		$req_users-> execute(array(
										'date1' => $date1, 'date2' => $date2));
		while ($val_users = $req_users->fetch()){
			if($val_users['id'] == 99999){	
				$val_users['name'] = 'Sharemyclick';
				$val_users['color_code'] = 'pink';
			}
				$arUsers[$i]['label'] = $val_users['name'];
				$arUsers[$i]['data'] = intval($val_users['total']);
				$arUsers[$i]['color'] = $val_users['color_code'];
			
			$i++;
		}
		if($i == 1){
			$arUsers[$i]['label'] = 'Other';
			$arUsers[$i]['data'] = 0;
			$arUsers[$i]['color'] = 'black';
		}
	break;
	case "getPidsStep2":
		$arUsers = array();
		$i = 0;		
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];	
		$req_users = $bdd->prepare("SELECT COUNT(id) as total, id, user.regdate2, pid.name, pid.color_code FROM `user_pid`
		INNER JOIN user on user.id = user_pid.user_id
		INNER JOIN user_jc ON user_jc.user_id = user.id
		LEFT JOIN pid ON pid.id = user_pid.id
		WHERE user.regdate2 >= :date1 AND user.regdate <= :date2 AND user_jc.step = 2 GROUP BY id");
		$req_users-> execute(array(
										'date1' => $date1, 'date2' => $date2));
		while ($val_users = $req_users->fetch()){
			if($val_users['id'] == 99999){	
				$val_users['name'] = 'Sharemyclick';
				$val_users['color_code'] = 'pink';
			}
				$arUsers[$i]['label'] = $val_users['name'];
				$arUsers[$i]['data'] = intval($val_users['total']);
				$arUsers[$i]['color'] = $val_users['color_code'];
			
			$i++;
		}
		if($i == 1){
			$arUsers[$i]['label'] = 'Other';
			$arUsers[$i]['data'] = 0;
			$arUsers[$i]['color'] = 'black';
		}
	break;
	case "getPidsStep3":
		$arUsers = array();
		$i = 0;		
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];	
		$req_users = $bdd->prepare("SELECT COUNT(id) as total, id, user.regdate2, pid.name, pid.color_code FROM `user_pid`
		INNER JOIN user on user.id = user_pid.user_id
		INNER JOIN user_jc ON user_jc.user_id = user.id
		LEFT JOIN pid ON pid.id = user_pid.id
		WHERE user.regdate2 >= :date1 AND user.regdate <= :date2 AND user_jc.step = 3 GROUP BY id");
		$req_users-> execute(array(
										'date1' => $date1, 'date2' => $date2));
		while ($val_users = $req_users->fetch()){
			if($val_users['id'] == 99999){	
				$val_users['name'] = 'Sharemyclick';
				$val_users['color_code'] = 'pink';
			}
				$arUsers[$i]['label'] = $val_users['name'];
				$arUsers[$i]['data'] = intval($val_users['total']);
				$arUsers[$i]['color'] = $val_users['color_code'];
			
			$i++;
		}
		if($i == 1){
			$arUsers[$i]['label'] = 'Other';
			$arUsers[$i]['data'] = 0;
			$arUsers[$i]['color'] = 'black';
		}
	break;
	case "getPidsStep4":
		$arUsers = array();
		$i = 0;		
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];	
		$req_users = $bdd->prepare("SELECT COUNT(id) as total, id, user.regdate2, pid.name, pid.color_code FROM `user_pid`
		INNER JOIN user on user.id = user_pid.user_id
		INNER JOIN user_jc ON user_jc.user_id = user.id
		LEFT JOIN pid ON pid.id = user_pid.id
		WHERE user.regdate2 >= :date1 AND user.regdate <= :date2 AND user_jc.step = 4 GROUP BY id");
		$req_users-> execute(array(
										'date1' => $date1, 'date2' => $date2));
		while ($val_users = $req_users->fetch()){
			if($val_users['id'] == 99999){	
				$val_users['name'] = 'Sharemyclick';
				$val_users['color_code'] = 'pink';
			}
				$arUsers[$i]['label'] = $val_users['name'];
				$arUsers[$i]['data'] = intval($val_users['total']);
				$arUsers[$i]['color'] = $val_users['color_code'];
			
			$i++;
		}
		if($i == 1){
			$arUsers[$i]['label'] = 'Other';
			$arUsers[$i]['data'] = 0;
			$arUsers[$i]['color'] = 'black';
		}
	break;
	case "getPidsStep5":
		$arUsers = array();
		$i = 0;		
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];	
		$req_users = $bdd->prepare("SELECT COUNT(id) as total, id, user.regdate2, pid.name, pid.color_code FROM `user_pid`
		INNER JOIN user on user.id = user_pid.user_id
		INNER JOIN user_jc ON user_jc.user_id = user.id
		LEFT JOIN pid ON pid.id = user_pid.id
		WHERE user.regdate2 >= :date1 AND user.regdate <= :date2 AND user_jc.step = 5 GROUP BY id");
		$req_users-> execute(array(
										'date1' => $date1, 'date2' => $date2));
		while ($val_users = $req_users->fetch()){
			if($val_users['id'] == 99999){	
				$val_users['name'] = 'Sharemyclick';
				$val_users['color_code'] = 'pink';
			}
				$arUsers[$i]['label'] = $val_users['name'];
				$arUsers[$i]['data'] = intval($val_users['total']);
				$arUsers[$i]['color'] = $val_users['color_code'];
			
			$i++;
		}
		if($i == 1){
			$arUsers[$i]['label'] = 'Other';
			$arUsers[$i]['data'] = 0;
			$arUsers[$i]['color'] = 'black';
		}
	break;
	case "getDailyPids":
		$regdate = explode(' - ',$_GET['date']);
		$firstdate = explode('/',$regdate[0]);
		$lastdate = explode('/',$regdate[1]);
		$date1 = $firstdate[2]."-".$firstdate[0]."-".$firstdate[1];
		$date2 = $lastdate[2]."-".$lastdate[0]."-".$lastdate[1];
			$req3 = $bdd->prepare('SELECT * FROM pid');
							$req3->execute(array('id' => $_POST['id'])) or die(print_r($req3(errorInfo())));
							$leads = 0;
							$total = 0;
							$cpt = 0;
							$check = false;
							while ($pids = $req3->fetch()){
							
							if(!$check){
								$req4 = $bdd->prepare("SELECT SUM( nb_lead_recu ) AS nb_lead_recu, reg_date2
										FROM (

										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u
										INNER JOIN user_coreg uc ON u.id = uc.user_id
										WHERE id = :id
										AND reg_date2 >= :date1 AND reg_date2 <= :date2
										GROUP BY reg_date2, user_id
										UNION
										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u2
										INNER JOIN user_sponsor us ON u2.id = us.user_id
										WHERE id = :id
										AND reg_date2 >= :date1 AND reg_date2 <= :date2
										GROUP BY reg_date2, user_id
										)temp
										GROUP BY reg_date2");
								$req4-> execute(array('id' => 99999,
													  'date1' => $date1,
													  'date2' => $date2)) or die(print_r($req4(errorInfo())));
								while ($donnees2 = $req4->fetch())
								{
								$leads_ += $donnees2['nb_lead_recu'];
								}
								$arUsers[$cpt]['label'] = 'Sharemyclick';
								$arUsers[$cpt]['data'] = floor($leads_*0.7);
								$arUsers[$cpt]['color'] = 'pink';
								$cpt++;		
							}
							$check = true;
							$price = $pids['price'];
							// On récupère le nombre de leads reçus par ce pid sur le jour en question et on lui attribut une variable
							$req4 = $bdd->prepare("SELECT SUM( nb_lead_recu ) AS nb_lead_recu, reg_date2
										FROM (

										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u
										INNER JOIN user_coreg uc ON u.id = uc.user_id
										WHERE id = :id
										AND reg_date2 >= :date1 AND reg_date2 <= :date2
										GROUP BY reg_date2, user_id
										UNION
										SELECT COUNT( DISTINCT user_id ) AS nb_lead_recu, reg_date2, user_id
										FROM user u2
										INNER JOIN user_sponsor us ON u2.id = us.user_id
										WHERE id = :id
										AND reg_date2 >= :date1 AND reg_date2 <= :date2
										GROUP BY reg_date2, user_id
										)temp
										GROUP BY reg_date2");
							$req4-> execute(array('id' => $pids['id'],
												  'date1' => $date1,
													  'date2' => $date2)) or die(print_r($req4(errorInfo())));
							while ($donnees2 = $req4->fetch())
							{
							$leads += $donnees2['nb_lead_recu'];
							}
							//$arUsers/*[$_GET['date']]*/[$pids['name']] += $price*floor($leads*0.7);//echo($pids['name']." -- ".$leads." -- ".$price." **** ");
							$arUsers[$cpt]['label'] = $pids['name'];
							$arUsers[$cpt]['data'] = $price*floor($leads*0.7);
							$arUsers[$cpt]['color'] = $pids['color_code'];
							$total += $arUsers[$cpt]['data'];
							$leads = 0;
							$cpt++;					  }
			/*foreach($arUsers_ as $indUser => $valUser){
				$arUsers[$indUser] = 100*round($valUser/$total,2);
			}*/
	break;
}



echo json_encode($arUsers);

?>