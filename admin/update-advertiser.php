<?php
// On inclut la page de paramÃ¨tre de connection.
include('conf.php');
include('class/advertiser.class.php');
include('class/categoryproduct.class.php');
include('class/country.class.php');


// On vÃ©rifie que le user est connectÃ© sinon on le renvoie Ã  la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}
$filters['field'] = 'id_advertiser';
if(isset($_POST['id_advertiser']) || isset($_GET['id']))
$filters['value'] = (isset($_GET['id']))?$_GET['id']:$_POST['id_advertiser'];
/*
 if($_GET['id']) 
    $filters['value'] = $_GET['id'];
 else
  $filters['value'] = $_POST['id'];
 */
$viewAdvertiser = new Advertiser(); //objet = instance de classe
$viewAdvertiser->getAdvertisers($filters);
$_SESSION['advertiser'] = $viewAdvertiser->advertisers;

$objCategoryProduct = new CategoryProduct();
$result = $objCategoryProduct->getCategoriesList();
 
$objCountry = new Country();
$resultCountry = $objCountry->getCountryList();

 if(isset($_POST['submit_update'])){
     
     $viewAdvertiser= new Advertiser();
    $viewAdvertiser->createAdvertiserHistorical($_SESSION['advertiser']);
     
     $arPost = array();
    foreach($_POST as $ind => $val){
        $arPost[$ind] = $val;
    }
    if(isset($_FILES['logo']) && !empty($_FILES['logo']['name']))
    {
        $arPost['logo'] = $_FILES['logo'];
        $arPost['ready_to_upload'] = false;
    }else
    {
        $arPost['logo']['name'] = $_POST['path'];
        $arPost['ready_to_upload'] = true;
    }
     $viewAdvertiser->updateAdvertiser($arPost);
 }


?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sharemyclick admin platform V1.0</title>
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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
</head>

<body>


	
	<?php include ('./menu/menu-left.php');
        if(isset($_POST['submit_advertiser'])){
        echo  "Result : ".$message;
     }
        ?>
    
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
            <ul class="breadcrumb">
                <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
                <li class="active">Dashboard</li>
            </ul>
        </div><!--breadcrumbwidget-->
        <div class="pagetitle">
        	<h1> Advertiser's information</h1> <span><?php echo $_SESSION['login']; ?> , here the informations of the company.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit_update'])){
                         ?>   <h4 class='confirmation' style="text-align: center" ">Informations have been updated. </h4> </br> 
                
                         <span class="field" >
                             <div class="widgetcontent">
                                 
                                 <p class="stdformbutton" style="text-align: center">
                                      <a href="update-advertiser-globalview.php" >
                                        <button type="button" name="return_all_advertiser" id="return_all_advertiser" class="btn btn-primary" >Update another advertiser </button>
                                      </a>
                                     <a href="view-advertiser.php" >
                                        <button type="button" name="view_all_advertiser" id="view_all_advertiser" class="btn btn-primary" >View all advertisers </button>
                                      </a>
                                </p>
                                
                                
                                 
                            </div>
                         </span>
                <?php ;}
                else {?>
                
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">Advertiser informations</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_advertiser" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        <p>
                            <label>Company name *</label>
                             <input type="hidden" name="id_advertiser" value="<?php echo (isset($_GET['id']))?$_GET['id']:$_POST['id_advertiser'];?>" />
                             <span class="field"><input type="text" value="<?php echo $viewAdvertiser->advertisers[0]['company_name']; ?>" name="company_name" class="input-xxlarge" /></span>
                        </p>

                        <p>
                            <label>Address *</label>
                        <span class="field"><input type="text" id="address"  name="address" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['address']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Telephone Company</label>
                        <span class="field"><input type="text" name="telephone_company" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['telephone_company']; ?>" /></span>
                        </p>

                        <p>
                            <label>Country *</label>
                            
                            <span class="field">
                                
                               <select name="country" id="country" class="status">
                                        <?php 
                                        foreach($objCountry->countryselect as $indCountry => $valCountry){?>
                                        
                                    <option value="<?php echo $valCountry['id_country']; ?>" <?php if($viewAdvertiser->advertisers[0]['country'] == $valCountry['name_country']){?> selected <?php } ?>  ><?php echo $valCountry['name_country']; ?> </option>
                                            </option>
                                <?php } ?>
                                </select>
                            </span>
                            
                        </p>
                            
                                                            
                        <p>
                            <label> Website *</label>
                            <span class="field"><input type="url" name="websites" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['websites']; ?>" /></span>
                        </p>
                        
                        <p>
                           <label>Logo</label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                           <span class="field"><img src="<?php echo 'http://localhost/campaigns/img/logo/'.$viewAdvertiser->advertisers[0]['logo']; ?>" height="180" width="98"></span>
                           <span class="field"><input type="file" name="logo" id="logo" /></span>
                           <input type="hidden" name="path" id="path" value="<?php echo $viewAdvertiser->advertisers[0]['logo']; ?>" />	
                           
                        <p>
                            <label> Company type</label>
                                <span class="field"><input name="company_type" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['company_type']; ?>" /></span>
                            </span>  
                        </p>
                        
						<p>
                            <label>Category Product</label>
                            
                            <span class="field">
                                <select name="id_category_product" id="id_category_product" class="status">
                                        <?php foreach($objCategoryProduct->categories_list as $indCat => $valCat){?>
                                <option value="<?php echo $indCat; ?>" <?php if($viewAdvertiser->advertisers[0]['id_category_product'] == $indCat){?> selected <?php } ?> ><?php echo $valCat['name']; ?></option>
                                <?php } ?>
                                </select>
                            </span>  
                            
                        </p>
                        
                                               
                        <h4 class="widgettitle nomargin shadowed"> Stats validation </h4>
                        
                        <p>
                            <label>URL of the platform *</label>
                            <span class="field"><input type="url" name="url" id="url" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['url']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Username *</label>
                            <span class="field"><input type="text" name="username" id="username" class="input-xxlarge"  value="<?php echo $viewAdvertiser->advertisers[0]['username']; ?>" /></span>
                        </p>
							
                        <p>
                            <label>Password *</label>
                            <span class="field"><input type="text" name="password" id="password" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['password']; ?>" /></span>
                        </p>
                        
                         <p>
                            <label>Validation delay</label>
                            <span class="field"><input type="text" name="validation_delay" id="validation_delay" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['validation_delay']; ?>" /></span>
                        </p>
						
                        <h4 class="widgettitle nomargin shadowed">Invoice contact </h4>
						
                        <p>
                            <label>Name</label>
                            <span class="field"><input type="text" name="name_invoice_contact" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['invoice_name']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Email</label>
                            <span class="field"><input type="email" name="email_invoice_contact" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['invoice_email']; ?>"  /></span>
                        </p>
                        
                        <p>
                            <label>VAT *</label>
                            <span class="field"><input type="text" name="vat" class="input-xxlarge" /></span>
                        </p>
                        
                        <p>
                            <label>IBAN *</label>
                            <span class="field"><input type="text" name="iban" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['iban']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>SWIFT *</label>
                            <span class="field"><input type="text" name="swift" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['swift']; ?>"  /></span>
                        </p>
                        
                        <p>
                            <label>Invoicing period *</label>    
                            
                            <span class="field">
                                <select name="invoicing_contact" id="invoicing_contact" class="status" >
                                        <option value="15" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 15){?> selected <?php } ?>  > 15</option>
                                        <option value="30" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 30){?> selected <?php } ?>  > 30</option>
                                        <option value="45" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 45){?> selected <?php } ?> > 45</option>
                                        <option value="60" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 60){?> selected <?php } ?> > 60</option>
                                        <option value="75" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 75){?> selected <?php } ?> > 75</option>
                                        <option value="90" <?php if($viewAdvertiser->advertisers[0]['invoicing_contact'] == 90){?> selected <?php } ?> > 90</option>
                                </select>
                            </span>  
                            
                        </p>
                        
                        <h4 class="widgettitle nomargin shadowed">Management contact</h4>
                        
                        
                        <p>
                            <label>Name *</label>
                            <span class="field"><input type="text" name="name_management_contact" class="input-xxlarge"value="<?php echo $viewAdvertiser->advertisers[0]['management_name']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Email *</label>
                            <span class="field"><input type="email" name="email_management_contact" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['management_email']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Telephone Management contact *</label>
                            <span class="field"><input type="tel" name="telephone" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['telephone']; ?>" /></span>
                        </p>
                        
                        <p>
                            <label>Skype</label>
                            <span class="field"><input type="text" name="skype" class="input-xxlarge" value="<?php echo $viewAdvertiser->advertisers[0]['skype']; ?>"                                                                                                                                                                                                                                                               /></span>
                        </p>
                        
                        <p>
                            <label>Language</label>
                           
                            
                            <span class="field">
                                    <select name="conversation_language" id="conversation_language" class="status">
                                        <option value="English" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'English'){?> selected <?php } ?>  > English</option>
                                        <option value="French" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'French'){?> selected <?php } ?>  > French</option>
                                        <option value="German" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'German'){?> selected <?php } ?> > German</option>
                                        <option value="Spanish" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'Spanish'){?> selected <?php } ?> > Spanish</option>
                                        <option value="Italian" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'Italian'){?> selected <?php } ?> > Italian</option>
                                        <option value="Portuguese" <?php if($viewAdvertiser->advertisers[0]['conversation_language'] == 'Portuguese'){?> selected <?php } ?> > Portuguese</option>
                                    </select>
                            </span> 
                            
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <select name="status" id="status" class="status" >
                                     <option value="Active" <?php if($viewAdvertiser->advertisers[0]['status'] == 'Active'){?> selected <?php } ?>  > Active</option>
                                     <option value="Non active" <?php if($viewAdvertiser->advertisers[0]['status'] == 'Non active'){?> selected <?php } ?>  > Non active</option>
                                      <option value="Prospect adviser" <?php if($viewAdvertiser->advertisers[0]['status'] == 'Prospect adviser'){?> selected <?php } ?>  > Prospect adviser</option>
                                      
                                </select>
                            </span>                            
                        </p>
                            
                        <p class="stdformbutton">
                            <button type="submit" name="submit_update" id="submit_advertiser" class="btn btn-primary"> Update informations</button>
 <?php }?>
                        </p>
                        
                        </form>
                    </div>				
                </div><!--contentinner-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
	

	
    <div class="footer">
    	<div class="footerleft">Sharemyclick dashboard v1.0</div>
    	<div class="footerright">&copy; Sharemyclick with Themepixels - <a href="https://twitter.com/sharemyclick"><span class="iconsweets-twitter"></a> - <a href="https://www.facebook.com/sharemyclick"><span class="iconsweets-facebook"></a> - <a href="https://www.linkedin.com/company/sharemyclick">Followus on Linkedin</a></div>
    </div><!--footer-->
 


</body>
</html>
