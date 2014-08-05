<?php
// it includes parameters connection
include('conf.php');

    
//Delete from table, in globalview page
if(isset($_POST) && !empty($_POST)){
    foreach($_POST as $indPost => $valPost){
        if(strpos($indPost,'delete') !== false)
        {
            $bdd->exec('DELETE FROM display WHERE id='.$_POST['id']);
            $bdd->exec('DELETE FROM categories_display WHERE display_id='.$_POST['id']); 
        }
    }
}

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
        
        jQuery('[id^=delete]').click(function() {
            var id = jQuery(this).attr('id').substring(6);
            jQuery( "#form-delete-" + id ).submit();
        });
        
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
        	<h1>Modify Display</h1> <span><strong><?php echo ucfirst($_SESSION['login']); ?></strong> , please choose the display to modify. </span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
        	<div class="contentinner content-dashboard">
			
            <table class="table table-bordered" id="dbase">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
 
                    <thead>
                        <tr>
                            <th class="centeralign">Name</th>
                            <th class="centeralign">image</th>
                            <th class="centeralign">type</th>
                            <th class="centeralign">text</th>
                            <th class="centeralign">href </th>
                            <th class="centeralign">script</th>
                            <th class="centeralign">Status</th>
                            <th class="centeralign">intern link</th>
                            <th class="centeralign">Categories</th>
                            <th class="centeralign">Update</th>
                            <th class="centeralign">Delete</th>
                    </thead>
                    <tbody>
					
					<?php
					// Request for data from questions
					$reqDisplay = $bdd->query('SELECT * FROM display ORDER BY display.name ASC') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                        while ($display = $reqDisplay->fetch())
						{?>
                        <tr>
                        <form class="stdform" method="post" action="update-display-information.php?id=<?php echo $display['id'];?>">

                            <td class="centeralign" > 
                                <b>
                                    <p align="center">
                                        <a href="update-display.php?id=<?php echo $display['id']; ?>" > 
                                        <?php echo $display['name'] ?>
                                        </a>
                                    </p>
                                </b>

                            </td>
                                                        
                            <td>
                                <p align="center"> <img  src="<?php echo 'http://localhost/white_label/admin/img/display/'.$display['image'] ?>" height="92" width="52" >  </p>
                            </td>
                                                        
                             <td class="centeralign" style="text-align: left">
                                 <p align="center"> 
                                     <?php echo $display['type'] ?>
                                 </p>
                            </td>
                            
                            <td>
                                 <p align="center"> 
                                    <?php echo $display['text'] ?>
                                 </p>
                               
                            </td>
                            
                            <td>
                                 <p align="center"> 
                                    <?php echo $display['href'] ?>
                                 </p>
                               
                            </td>
                            
                            <td>
                                 <p align="center"> 
                                    <?php echo $display['script'] ?>
                                 </p>
                               
                            </td>
                            <td>
                                 <p align="center"> 
                                     
                                     <?php 
                                            if ($display['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Active">
                                                   
                                                <?php ;
                                            
                                            }
                                            if  ($display['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Non-active"  > 
                                               
                                                <?php ;
                                            }
                                            
                                        ?>
                                 </p>
                            </td>
                            
                            <td>
                                <p align="center" > <a>
                                    <?php
                                     $length= strlen($display['intern_link']);
                                    if ($length<=30)
                                    {echo $display['intern_link'];}
                                    else
                                    {echo substr($display['intern_link'], 0, -20).'...';}
                                    
                                    ?>
                                    </a>
                                </p>
                               
                            </td>
                               
                            <td>
                                 <p align="left">
                                    <?php 
                                    $reqCategoriesList = $bdd->query('SELECT * FROM categories_display LEFT JOIN categories ON categories_display.categories_id=categories.id WHERE categories_display.display_id='.$display['id']) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                                        while ($categoriesList = $reqCategoriesList->fetch())
						{?>
                                    <span> 
                                        <i class="iconfa-th-list"></i><a href="view-category-information.php?id=<?php echo $categoriesList['id']; ?>" > <?php echo $categoriesList['name'];?> </a></br>
                                    </span>
                                    
                                            
                                       
                                    <?php }?>
                                </p>
                            </td>
                            <td class="centeralign"> <a href="update-display.php?id=<?php echo $display['id'] ?>" ><input type="button" class="btn btn-success" name="update" value="Update"> </a>
                            </td>
                          <!--'LEFT JOIN answers_questions ON answers_questions.questions_id=questions.id LEFT JOIN answers ON answers.id=answers_questions.answers_id '-->
                      
                        </form>
                            <td class="centeralign" >
                                <form  id="form-delete-<?php echo $display['id']; ?>" name="form-delete-<?php echo $display['id']; ?>" method="post" action="">
                                  <a href="#"  class="deleterowcustomized"><span id="delete<?php echo $display['id']; ?>" class="icon-trash"></span></a>
                                  <input type="hidden" name="hidden_delete<?php echo $display['id']; ?>" value="" >
                                  <input type="hidden" name="id" value="<?php echo $display['id']; ?>" >

                                </form>
                            </td>
                            
                       
                        </tr>				
                           <?php }
					?>
                    </tbody>
				</table>
				<script type="text/javascript">
				// dynamic table
				jQuery('#dbase').dataTable({
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
        
        
        
        