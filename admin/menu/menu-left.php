<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="admin.php"</script>';  
  exit;  
}
?>
    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">
    	
        <div class="logopanel">
        	<h1><a href="dashboard.php">Sharemyclick <span>v1.0</span></a></h1>
        </div><!--logopanel-->
        
        <div class="datewidget">Today is
			<?php // Prints something like: Monday 8th of August 2005 03:12:46 PM
			echo date('l jS \of F Y'); ?>
		</div>
    
    	<div class="searchwidget">
        	<form action="results.html" method="post">
            	<div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Search here...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div><!--searchwidget-->
        <?php if($_SESSION['admin_rights'] <= 2){?>
        <div class="plainwidget">
			<small style="text-decoration:underline;">MONTHLY TARGET</small><br />
        </div><!--plainwidget-->
        <?php }?>
		
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
                <li id="li-dashboard" class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
				<?php if($_SESSION['admin_rights'] <= 2){?>
				<li id="li-quizz" class="dropdown"><a href=""><span class="icon-barcode"></span> QUIZZES</a>
                	<ul>
                    	<li><a href="#">View all quizzes</a></li>
                        <?php if($_SESSION['admin_rights'] <= 3 || $_SESSION['admin_rights'] == 6){?>
						<li><a href="#">Create quizz</a></li>
						<li><a href="#">Modify quizz</a></li>
						<?php }?>
						<li><a href="#">Quizz rentability</a></li>
                    </ul>
                </li>
				<?php }
				$req_menu = $bdd->query("SELECT  * FROM permissions WHERE menu = 'view_rentability' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_menu->rowCount() > 0){?>
				<li id="li-rent" class="dropdown"><a href=""><span class="iconsweets-money"></span> GLOBAL RENTABILITY</a>
                	<ul>
                    	<li><a href="admin-rentability.php">View rentability</a></li>
                    </ul>
                </li>
				<?php }
				$req_menu = $bdd->query("SELECT  * FROM permissions WHERE (menu = 'view_pid' OR menu = 'create_pid' OR menu = 'modify_pid' OR menu = 'renta_pid') and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_menu->rowCount() > 0){
				?>
                <li id="li-pid" class="dropdown"><a href=""><span class="iconsweets-tag"></span> PID</a>
                	<ul>
						<?php $req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'view_pid' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="view-pid.php">View all pid</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'create_pid' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                        <li><a href="pid.php">Create pid</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'modify_pid' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="update-pid.php">Modify pid</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'renta_pid' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="renta-pid.php">Pid rentability</a></li>
						<?php }?>
                    </ul>
                </li>
			
				<?php }
				$req_menu = $bdd->query("SELECT  * FROM permissions WHERE (menu = 'view_coreg' OR menu = 'create_coreg' OR menu = 'modify_coreg' OR menu = 'renta_coreg') and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_menu->rowCount() > 0){?>
				<li id="li-coreg" class="dropdown"><a href=""><span class="iconsweets-cart"></span> COREG</a>
                	<ul>
						<?php $req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'view_coreg' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                    	<li id="li-view-coreg"><a href="view-coreg.php">View all coreg</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'create_coreg' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                        <li><a href="coreg.php">Create coreg</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'modify_coreg' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="update-coreg.php">Modify coreg</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'renta_coreg' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="renta-coreg.php">Coreg rentability</a></li>
						<?php }?>
                    </ul>
                </li>
				<?php }
				if($_SESSION['admin_rights'] <= 2){?>
                <li id="li-questions" class="dropdown"><a href=""><span class="iconsweets-alarm2"></span> QUESTIONS</a>
                    <ul>
                        <li><a href="view-questions.php">View all questions</a></li>
                        <li><a href="questions.php">Create question</a></li>
                        <li><a href="update-questions.php">Modify question</a></li>
                    </ul>
                </li>
                <li id="li-answers" class="dropdown"><a href=""><span class="iconsweets-lightbulb"></span> ANSWERS</a>
                    <ul>
                        <li><a href="view-answers.php">View all answers</a></li>
                        <li><a href="answers.php">Create answer</a></li>
                        <li><a href="update-answers.php">Modify answer</a></li>
                    </ul>
                </li>
				<?php }
				$req_menu = $bdd->query("SELECT  * FROM permissions WHERE (menu = 'view_sponsor' OR menu = 'create_sponsor' OR menu = 'modify_sponsor' OR menu = 'renta_sponsor') and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_menu->rowCount() > 0){?>
				<li id="li-sponsor" class="dropdown"><a href=""><span class="iconsweets-cart2"></span> SPONSOR</a>
                	<ul>
						<?php $req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'view_sponsor' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                    	<li id="li-view-sponsor"><a href="view-sponsor.php">View all sponsor</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'create_sponsor' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                        <li><a href="sponsor.php">Create sponsor</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'modify_sponsor' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="update-sponsor.php">Modify sponsor</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'renta_sponsor' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="renta-sponsor.php">Sponsor rentability</a></li>
						<?php }?>
                    </ul>
                </li>
				<?php }
				$req_menu = $bdd->query("SELECT  * FROM permissions WHERE (menu = 'view_prize' OR menu = 'create_prize' OR menu = 'modify_prize') and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_menu->rowCount() > 0){?>
				
				<li id="li-prizes" class="dropdown"><a href=""><span class="iconsweets-cart3"></span> 2ND PRIZES</a>
                	<ul>
						<?php $req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'view_prize' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                    	<li><a href="view-prizes.php">View all prizes</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'create_prize' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
                        <li><a href="prizes.php">Create prizes</a></li>
						<?php }
						$req_admin_rightss = $bdd->query("SELECT  * FROM permissions WHERE menu = 'modify_prize' and admin_rights_id = ".$_SESSION['admin_rights']);
						if($req_admin_rightss->rowCount() > 0){?>
						<li><a href="update-prizes.php">Modify prizes</a></li>
						<?php }?>
                    </ul>
                </li>
				<?php   }
				if($_SESSION['admin_rights'] <= 2){?>
				<li id="li-ws" class="dropdown"><a href=""><span class="iconsweets-globe"></span> WEBSERVICE</a>
                	<ul>
                    	<li><a href="view-webservice.php">View all webservice</a></li>
                        <li><a href="webservice.php">Create webservice</a></li>
						<li><a href="update-webservice.php">Modify webservice</a></li>
						<li><a href="webservice_params.php">Manage webservice parameters</a></li>
						<li><a href="webservice_fields.php">Manage webservice fields</a></li>
						<li><a href="test_ws.php">Test webservices coregs</a></li>
						<li><a href="test_ws2.php">Test webservices sponsors</a></li>
						<li><a href="easyvoyage.php">Easyvoyage</a></li>
						<li><a href="travelbird.php">Travelbird</a></li>
                    </ul>
                </li>
				<li id="li-registers" class="dropdown"><a href=""><span class="iconsweets-users"></span> LEADS</a>
                	<ul>
                    	<li><a href="view-user.php">View all registers</a></li>
						<li><a href="blacklist.php">Manage blacklist</a></li>
                    </ul>
                </li>
				<li id="li-users" class="dropdown"><a href=""><span class="iconsweets-vcard"></span> USER PERMISSIONS</a>
                	<ul>
                    	<li><a href="view-users.php">View all users</a></li>
                        <li><a href="create-user.php">Create user</a></li>
						<li><a href="update-user.php">Modify user</a></li>
						<li><a href="edit-permissions.php">Edit permissions</a></li>
                    </ul>
                </li>
				<?php } if($_SESSION['admin_rights'] <= 2){?>
				<li id="li-email" class="dropdown"><a href=""><span class="iconsweets-speech4"></span> EMAIL INVITE</a>
                	<ul>
                    	<li><a href="view-emails.php">View all emails</a></li>
                        <li><a href="create-email.php">Create email</a></li>
						<li><a href="update-email.php">Modify email</a></li>
                    </ul>
                </li>
				<?php } if($_SESSION['admin_rights'] <= 2){?>
				<li id="li-email" class="dropdown"><a href=""><span class="iconsweets-settings"></span> GOOGLE ANALYTICS</a>
                	<ul>
                    	<li><a href="view-tags.php">View all google tags</a></li>
                        <li><a href="tags.php">Create google tag</a></li>
						<li><a href="update-tags.php">Modify google tag</a></li>
                    </ul>
                </li>
				<li style="height:50px;border-bottom:none;"><a href="settings.php"><img src="img/gemicon/settings.png" alt="" style="width:32px;height:32px;display:inline-block;" />
				<span style="padding-top:4px;padding-left:4px;">Settings</span></a></li>
				<?php }?>
            </ul>
        </div><!--leftmenu-->
        
    </div><!--mainleft-->
    <!-- END OF LEFT PANEL -->