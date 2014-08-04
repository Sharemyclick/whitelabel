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
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'assign-pid' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="assign-affiliate-pid.php">Assign PID to an affiliate</a></li>
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
                            <li><a href="update-quote-globalview.php">Modify quote</a></li>
                            <?php }?>
                        </ul>
                    </li>   
                    
                    <li id="li-quote" class="dropdown"><a href=""><span class="icon-home"></span> DOMAIN</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-domain' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-domain.php">View domain</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-domain' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-domain.php">Create domain</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-domain' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-domain-globalview.php">Modify domain</a></li>
                            <?php }?>
                        </ul>
                    </li>   
                    
                    
                    <li id="li-form" class="dropdown"><a href=""><span class="icon-folder-close"></span> FORM</a>
                        <ul>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-form.php">View form</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-form.php">Create form</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-form' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-form-globalview.php">Modify form</a></li>
                            <?php }?>
                            
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-field' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-field.php">View field</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-field' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-field.php">Create field</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-field' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-field-globalview.php">Modify field</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-question" class="dropdown"><a href=""><span class=" icon-question-sign"></span> QUESTIONS & ANSWER</a>
                        <ul>
                            
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-question-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-question-answer.php">View question & answer</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-question-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-question-answer.php">Create question & answer</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-question-answer' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-question-answer-globalview.php">Modify question & answer</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-theme" class="dropdown"><a href=""><span class=" icon-th-large"></span> THEMES</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-theme-globalview.php">View themes</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-theme.php">Create theme</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-theme' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-theme-globalview.php">Modify theme</a></li>
                            <?php }?>
                        </ul>
                    </li>  
                    
                    <li id="li-category" class="dropdown"><a href=""><span class="icon-tasks"></span> CATEGORIES</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-categories' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-categories.php">View categories</a></li>
                            <?php }?>
                             <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'create-category' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="create-category.php">Create category</a></li>
                            <?php }?>
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'update-category' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="update-category.php">Modify category</a></li>
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
                        </ul>
                    </li> 
                    
                    
                    <li id="li-leads" class="dropdown"><a href=""><span class="iconsweets-chart8"></span> LEADS</a>
                        <ul>
                           
                            <?php
                            $req_menu = $bdd->query("SELECT * FROM permissions WHERE menu = 'view-leads' and admin_rights_id = ".$_SESSION['right']);
                            if($req_menu->rowCount() > 0){?>
                            <li><a href="view-leads.php">View all registers</a></li> <!-- renvoie sur view-user.php normalement -->
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
