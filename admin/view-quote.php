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
        	<h1>View Quote</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please see all the quotes. </span>
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
                    </colgroup>
 
                    <thead>
                        <tr>
                            <th class="centeralign">Quote name</th>
                            <th class="centeralign">Domain name</th>
                            <th class="centeralign">Form name</th>
                            <th class="centeralign">Company </th>
                            <th class="centeralign">Update</th>
                    </thead>
                    
                    <tbody>
					<?php
					// Request for data from questions
					$reqQuote = $bdd->query('SELECT * FROM devis ORDER BY id ASC') or die(print_r($bdd->errorInfo())); 
					while ($quote = $reqQuote->fetch())
						{?>
                        <tr>
                        <form class="stdform" method="post" action="update-form.php?id=<?php echo $quote['id'];?>">

                            <td class="centeralign" >
                                <p align="center"> <?php echo $quote['name'] ?> </p>
                            </td>
                            
                            <td>
                                <p align="left">
                              <?php  $reqDomain = $bdd->query('SELECT * FROM domain LEFT JOIN domain_devis ON domain.id=domain_devis.domain_id WHERE domain_devis.devis_id='.$quote['id']) or die(print_r($bdd->errorInfo())); 
					while ($domain = $reqDomain->fetch())
						{?>
                                    <span><i class="icon-home"></i> <?php echo $domain['name'] ?>   </span></br>
                                <?php } ?>
                                </p>
                            </td>
                            <td>
                            <p align="left">
                              <?php  $reqForm = $bdd->query('SELECT * FROM form LEFT JOIN form_devis ON form.id=form_devis.form_id WHERE form_devis.devis_id='.$quote['id']) or die(print_r($bdd->errorInfo())); 
					while ($form = $reqForm->fetch())
						{?>
                                    <span><i class=" icon-file"></i> <?php echo $form['name'] ?>   </span></br>
                                <?php } ?> 
                            </p>
                            </td>
                            
                            <td>
                            <p align="left">
                              <?php  $reqAdmin = $bdd->query('SELECT * FROM admin LEFT JOIN devis_admin ON devis_admin.admin_id=admin.id WHERE devis_admin.devis_id='.$quote['id']) or die(print_r($bdd->errorInfo())); 
					while ($admin = $reqAdmin->fetch())
						{?>
                                    <span><i class="icon-folder-close"></i> <?php echo $admin['company'] ?>   </span></br>
                                <?php } ?>
                            </p>
                            </td>
                            
                            
                            
                            <td class="centeralign"> <a href="update-quote.php?id=<?php echo $quote['id'] ?>" ><input type="button" class="btn btn-success" name="update" value="Update"> </a>
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
        
        
        
        