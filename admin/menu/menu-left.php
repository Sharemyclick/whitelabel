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
        <div class="plainwidget">
            <small style="text-decoration:underline;">MONTHLY TARGET</small><br />
        </div><!--plainwidget-->
	
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
                <li id="li-dashboard" class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
                    
                    <li id="li-users" class="dropdown"><a href=""><span class="icon-user"></span> USER PERMISSIONS</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-users' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-users.php">View all users</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-user' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-user.php">Create user</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-globalview-user' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-globalview-user.php">Modify user</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'edit-permissions' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="edit-permissions.php">Edit permissions</a></li>
                            <?php }?>
                        </ul>
                    </li>
                
                   <li id="li-pid" class="dropdown"><a href=""><span class=" iconsweets-link2"></span> PID</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-pid' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-pid.php">View all pid</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'pid' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="pid.php">Create pid</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-pid' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-pid.php">Modify pid</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'renta-pid' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="renta-pid.php">Pid rentability</a></li>
                            <?php }?>
                        </ul>
                    </li> 
                    
                    
                 <li id="li-quote" class="dropdown"><a href=""><span class="icon-file"></span> QUOTE</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-quote' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-quote.php">View quote</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-quote' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-quote.php">Create quote</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-quote' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-quote.php">Modify quote</a></li>
                            <?php }?>
                        </ul>
                    </li>   
                    
                    
                    <li id="li-form" class="dropdown"><a href=""><span class="icon-folder-close"></span> FORM</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-form.php">View quote</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-form.php">Create quote/a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-form.php">Modify quote</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-question" class="dropdown"><a href=""><span class=" icon-question-sign"></span> QUESTIONS</a>
                        <ul>
                            
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-question' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-question.php">Create pid</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-question' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-question.php">View all pid</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-question' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-question.php">Modify pid</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-answer" class="dropdown"><a href=""><span class=" iconsweets-arrowright"></span> ANSWERS</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-answer.php">View answers</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-answer.php">Create answer</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-answer.php">Modify answer</a></li>
                            <?php }?>
                        </ul>
                    </li>  

             <li id="li-theme" class="dropdown"><a href=""><span class=" icon-th-large"></span> THEMES</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-theme.php">View themes</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-theme.php">Create theme</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-theme.php">Modify theme</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-categorie" class="dropdown"><a href=""><span class="icon-tasks"></span> CATEGORIES</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-categorie' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-categorie.php">View categories</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-categorie' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-categorie.php">Create categorie</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-categorie' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-categorie.php">Modify categorie</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-webservice" class="dropdown"><a href=""><span class="icon-wrench"></span> WEBSERVICE</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-webservice' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-webservice.php">View all webservice</a></li>
                             <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-webservice' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-webservice.php">Create webservice</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-webservice' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                           <li><a href="update-webservice.php">Modify webservice</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'webservice_params' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="webservice_params.php">Manage webservice parameters</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'webservice_fields' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="webservice_fields.php">Manage webservice fields</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'test_ws' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="test_ws.php">Test webservices coregs</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'test_ws2' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="test_ws2.php">Test webservices sponsors</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'easyvoyage' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="easyvoyage.php">Easyvoyage</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'travelbird' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                           <li><a href="travelbird.php">Travelbird</a></li>                        
                            <?php }?>
                        </ul>
                    </li> 
                    
                    
                    <li id="li-leads" class="dropdown"><a href=""><span class="iconsweets-chart8"></span> LEADS</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-user' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-user.php">View all registers</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'blacklist' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="blacklist.php">Manage blacklist</a></li>
                            <?php }?>
                        </ul>
                    </li> 
               
		
		<li id="li-tags" class="dropdown"><a href=""><span class="icon-tag"></span> TAGS</a>
                    <ul>
                        <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-tags' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-tags.php">View all google tags</a></li>                            
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-tags' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-tags.php">Create google tag</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-tags' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-tags.php">Modify google tag</a></li>
                            <?php }?>
                        
                    	
                    </ul>
                </li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!--mainleft-->
    <!-- END OF LEFT PANEL -->
