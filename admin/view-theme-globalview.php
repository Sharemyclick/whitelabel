<?php
// it includes parameters connection
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
        	<h1>View Themes</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please see all the forms. </span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
        	<div class="contentinner content-dashboard">
			
            <table class="table table-bordered" id="leads">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
 
                    <thead>
                        <tr>
                            <th class="centeralign">Name</th>
                            <th class="centeralign">Image</th>
                            <th class="centeralign">Picto</th>
                            <th class="centeralign">Status </th>
                            <th class="centeralign">Admin</th>
                            <th class="centeralign">Update</th>
                    </thead>
                    
                    <tbody>
					<?php
					// Request for data from questions
					$reqTheme = $bdd->query('SELECT * FROM themes LEFT JOIN template_themes ON template_themes.themes_id=themes.id ORDER BY themes.name ASC') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					while ($theme = $reqTheme->fetch())
						{?>
                        <tr>
                        <form class="stdform" method="post" action="update-theme.php?id=<?php echo $theme['id'];?>">

                            <td class="centeralign" ><a href="view-theme-information.php?id=<?php echo $theme['id'];?>">
                                                        <p align="center"> <?php echo $theme['name'] ?> </p></a>
                            </td>
                            
                            <td>
                                <p align="center"> <img  src="<?php echo 'http://localhost/white_label/admin/img/themes/'.$theme['image'] ?>" height="92" width="52" >  </p>
                            </td>
                            
                            <td>
                                <p align="center"> <img  src="<?php echo 'http://localhost/white_label/admin/img/themes/'.$theme['picto'] ?>" height="92" width="52" >   </p>
                            </td>
                            
                            <td>
                                 <p align="center"> 
                                 
                                     <?php 
                                            if ($theme['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Active">
                                                   
                                                <?php ;
                                            
                                            }
                                            if  ($theme['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Non-active"  > 
                                               
                                                <?php ;
                                            }
                                            
                                        ?>
                                 
                                 </p>
                               
                            </td>
                            
                            
                            
                            <td class="centeralign" style="text-align: left">
                                 <p align="center">
                                <?php 
                                $reqAdmin = $bdd->query('SELECT * FROM admin WHERE id='.$theme['admin_id']) or die(print_r($bdd->errorInfo())); // it tracks error if there is one
                                
                                while ($admin= $reqAdmin->fetch())
						{
                                                    echo $admin['company'];
                                                }
                                ?></p>
                            </td>
                            <td class="centeralign"> <a href="update-theme.php?id=<?php echo $theme['id'] ?>" ><input type="button" class="btn btn-success" name="update" value="Update"> </a>
                            </td>
                          <!--'LEFT JOIN answers_questions ON answers_questions.questions_id=questions.id LEFT JOIN answers ON answers.id=answers_questions.answers_id '-->
                      
                        </form>
                        </tr>				
                           <?php }
					?>
                    </tbody>
				</table>
				<script type="text/javascript">
				// dynamic table
				jQuery('#leads').dataTable({
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
        
        
        
        