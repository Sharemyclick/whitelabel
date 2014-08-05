<?php
// it includes parameters connetion
include('conf.php');

$id_tags=$_GET['id'];

//ACTIVATION AND DESACTIVATION of the status
if(isset($_POST['deactivate']))
{
    $bdd->exec('UPDATE tags SET status = "non-active" WHERE id='.$id_tags);
}
if(isset($_POST['activate']))
{
    $bdd->exec('UPDATE tags SET status = "active" WHERE id='.$id_tags);
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
            </ul><!--skins-->
            
        </div><!--breadcrumbwidget-->
        <div class="pagetitle">
        	<h1>Modify tags</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new tags.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
//-----------------------------------------------------------------------------------// 
        //UPDATE FORM
        $bdd->exec(' UPDATE tags SET text="'.$_POST['text'].'" , url="'.$_POST['url'].'"  WHERE id='.$id_tags);
//---------------------------------------------------------------------------------------//
        //DELETE AND INSERT form_answers_questions
        $bdd->exec('DELETE FROM domain_tags WHERE tags_id='.$id_tags); 
        
        foreach ($_POST['idDomain'] as $selectedField)
        {
            $reqDomainTags = $bdd->prepare('INSERT INTO domain_tags (domain_id, tags_id) VALUES (:domain_id, :tags_id)');
            // We execute the request by transmitting the parameter list
            $reqDomainTags->execute(array(
		'domain_id' => $selectedField,
		'tags_id' => $id_tags
            
		)) or die(print_r($reqDomainTags->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqDomainTags->closeCursor();
        }
        
//---------------------------------------------------------------------------------------//
                         
                         
                         
                         ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The tag has been modified </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="update-tags.php" >
                                        <button type="button" name="update_another_tag" id="update_another_tag" class="btn btn-primary" >Modify another tag </button>
                                      </a>
                                     <a href="view-tags.php" >
                                        <button type="button" name="view_all_tags" id="view_all_tags" class="btn btn-primary" >View all tags </button>
                                      </a>
                                </p>           
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Tags informations</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                    <?php
                    // Request for data from questions
                    $reqTags = $bdd->query('SELECT * FROM tags WHERE id='.$id_tags) or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
                    while ($tags = $reqTags->fetch())
                            {?>
                        <p>
                            <label>Google Analytics tag *</label>
                            <span class="field"><textarea name="text" class="input-xxlarge" required="required" /><?php echo $tags['text'];?> </textarea> </span>
                        </p>
                        
                        <p>
                             <label>Status *</label>
                            <span class="field">
                                <?php 
                                            if ($tags['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate the status'> 
                                                <?php ;
                                            }
                                            if  ($tags['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate the status'>
                                                <?php ;
                                            }
                                        ?>
                            </span>
                        </p>
                        <p>
                            <label> URL *</label>
                            <span class="field"><input type="url" name="url" value="<?php echo $tags['url'];?>" class="input-xxlarge" required="required" /></span>
                        </p>

                        <p>
                            <label>Select Domain(s)</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idDomain[]" multiple size="12" >
                                    <?php
                                    $reqDomain = $bdd->query("SELECT * FROM domain ");
                                    while ($domain = $reqDomain->fetch())
                                    {                                    
                                        $reqDomainSelected = $bdd->query("SELECT * FROM domain_tags LEFT JOIN domain ON domain_tags.domain_id=domain.id WHERE domain_tags.tags_id=".$tags['id']);
                                        ?>
                                    <option value="<?php echo $domain['id']; ?>" <?php while ($domainSelected = $reqDomainSelected->fetch()){if($domainSelected['domain_id'] === $domain['id']){echo 'selected';}}?>  > <?php echo $domain['name'];?></option>
                                    <?php 
                                    }?>
                                </select>
                                <span class="ds_arrow" style="display:none;">
                                	<button class="btn ds_prev"><i class="icon-chevron-left"></i></button><br />
                                    <button class="btn ds_next"><i class="icon-chevron-right"></i></button>
                                </span>
                                <select name="select4[]" multiple style="display:none;" size="10">
                                    <option value=""></option>
                                </select>
                            </span>
                        </p>
                        
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update </button>
                        </p>
                        
                        </form>
                    </div>				
                </div><!--contentinner--> <?php }} ?>
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>
