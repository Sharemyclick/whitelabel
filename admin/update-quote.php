<?php
// it includes parameters connetion
include('conf.php');

$id_quote=$_GET['id'];

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
        	<h1>Modify Quote</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to modify the quote.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                             

//-----------------------------------------------------------------------------------// 
        //UPDATE DEVIS table
        $bdd->exec(' UPDATE devis SET name="'.$_POST['name'].'" WHERE id='.$id_quote);

//---------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------//
        //DELETE AND INSERT form_devis
        
        $bdd->exec('DELETE FROM form_devis WHERE devis_id='.$id_quote); 

         foreach ($_POST['idForm'] as $selectedForm)
        {
            $reqFormQuote = $bdd->prepare('INSERT INTO form_devis (form_id, devis_id) VALUES (:form_id, :devis_id)');
            // We execute the request by transmitting the parameter list
            $reqFormQuote->execute(array(
		'form_id' => $selectedForm,
		'devis_id' => $id_quote
            
		)) or die(print_r($reqFormQuote->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqFormQuote->closeCursor();
        }
        
        //DELETE AND INSERT domain_devis
        $bdd->exec('DELETE FROM domain_devis WHERE devis_id='.$id_quote); 

        foreach ($_POST['idDomain'] as $selectedDomain)
        {
            $reqDomain = $bdd->prepare('INSERT INTO domain_devis (devis_id, domain_id) VALUES (:devis_id, :domain_id)');
            // We execute the request by transmitting the parameter list
            $reqDomain->execute(array(
		'devis_id' => $id_quote,
		'domain_id' => $selectedDomain
            
		)) or die(print_r($reqDomain->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqDomain->closeCursor();
        }
        //DELETE AND INSERT devis_admin
        $bdd->exec('DELETE FROM devis_admin WHERE devis_id='.$id_quote); 
        
        foreach ($_POST['idAdmin'] as $selectedAdmin)
        {
            $reqAdmin = $bdd->prepare('INSERT INTO devis_admin (devis_id, admin_id) VALUES (:devis_id, :admin_id)');
            // We execute the request by transmitting the parameter list
            $reqAdmin->execute(array(
		'devis_id' => $id_quote,
		'admin_id' => $selectedAdmin
            
		)) or die(print_r($reqAdmin->errorInfo())); // It tracks  the error if there is one
            // The request processing is terminated
            $reqAdmin->closeCursor();
            
        }
        
//---------------------------------------------------------------------------------------//
                             
                             
                             
                         ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The quote has been updated </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                        <a href="update-quote-globalview.php" >
                                        <button type="button" name="update_another_quote" id="update_another_quote" class="btn btn-primary" >Update another quote </button>
                                      </a>
                                     <a href="view-quote.php" >
                                        <button type="button" name="view_all_quote" id="view_all_quote" class="btn btn-primary" >View all quote </button>
                                      </a>
                                </p>           
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Quote information</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        <?php
                            $reqQuote = $bdd->query('SELECT * FROM devis WHERE id='.$id_quote) or die(print_r($bdd->errorInfo())); 
                        while ($quote = $reqQuote->fetch())
						{
                        ?>
                        
                        <p>
                            <label>Quote name *</label>
                            <span class="field"><input type="text" name="name" class="input-xxlarge" value="<?php echo $quote['name']?>" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Form name *</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idForm[]" multiple size="12" >
                                    <?php
                                    $reqForm = $bdd->query("SELECT * FROM form ");
                                    while ($form = $reqForm->fetch())
                                    {
                                        $reqQuoteForm = $bdd->query("SELECT * FROM form_devis WHERE devis_id=".$quote['id']);
                                        ?>
                                        <option value="<?php echo $form['id']; ?>" <?php while ($quoteForm = $reqQuoteForm->fetch()){ if($quoteForm['form_id'] == $form['id'] ){ echo 'selected'; }} ?> > <?php echo $form['name']; ?></option>
                                    <?php }?>
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
                        
                        <p>
                            <label>Company name *</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idAdmin[]" multiple size="12" >
                                    <?php
                                    $reqAdmin = $bdd->query("SELECT * FROM admin ");
                                    while ($admin = $reqAdmin->fetch())
                                    {
                                         $reqQuoteAdmin = $bdd->query("SELECT * FROM devis_admin WHERE devis_id=".$quote['id']);
                                        ?>
                                        <option value="<?php echo $admin['id']; ?>" <?php while ($quoteAdmin = $reqQuoteAdmin->fetch()){ if($quoteAdmin['admin_id'] == $admin['id'] ){ echo 'selected'; }} ?> > <?php echo $admin['company']; ?></option>
                                    <?php }?>
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
                        
                        <p>
                            <label>Domain name *</label>
                            <span id="dualselect" class="dualselect">
                            	<select class="uniformselect"  name="idDomain[]" multiple size="12" >
                                    <?php
                                    $reqDomain = $bdd->query("SELECT * FROM domain ");
                                    while ($domain = $reqDomain->fetch())
                                    {
                                         $reqQuoteDomain = $bdd->query("SELECT * FROM domain_devis WHERE devis_id=".$quote['id']);
                                        ?>
                                        <option value="<?php echo $domain['id']; ?>" <?php while ($quoteDomain = $reqQuoteDomain->fetch()){ if($quoteDomain['domain_id'] == $domain['id'] ){ echo 'selected'; }} ?> > <?php echo $domain['name']; ?></option>
                                    <?php }?>
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
                </div><!--contentinner--> <?php }}; ?>
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
