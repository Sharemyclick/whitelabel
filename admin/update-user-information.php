<?php
// it includes parameters connection
include('conf.php');

$id=$_GET['id'];

if(isset($_POST['deactivate']))
{
 
    $bdd->exec('UPDATE admin SET status = "non-active" WHERE id='.$id);

}
if(isset($_POST['activate']))
{

    $bdd->exec('UPDATE admin SET status = "active" WHERE id='.$id);
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
            	<div class="dropdown notification">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">
                    	<span class="iconsweets-globe iconsweets-white"></span>
                    </a>
            </div><!--headerright-->
            
    	</div><!--headerpanel-->
        <div class="breadcrumbwidget">
        	<ul class="skins">
                <li><a href="default" class="skin-color default"></a></li>
                <li><a href="orange" class="skin-color orange"></a></li>
                <li><a href="dark" class="skin-color dark"></a></li>
                <li>&nbsp;</li>
                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
                <li class="wide"><a href="" class="skin-layout wide"></a></li>
        </div><!--breadcrumbs-->
        <div class="pagetitle">
        	<h1>Update User informations</h1> <span></span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-editprofile">
            	<h4 class="widgettitle nomargin">Edit Profile</h4>
                <div class="widgetcontent bordered">
                	<div class="row-fluid">
                    	<div class="span3 profile-left">
                            
                            <?php
                            
                            //IF SUBMIT --------> UPDATE DATABASE
                     if(isset($_POST['submit'])){
                         $bdd->exec('UPDATE admin SET login="'.$_POST['login'].'" , password="'.$_POST['password'].'" , email="'.$_POST['email'].' ", name = "'.$_POST['name'].'", company = "'.$_POST['company'].'", address = "'.$_POST['address'].'", postal_code ="'.$_POST['postal_code'].'", city = "'.$_POST['city'].'", telephone="'.$_POST['telephone'].'", iban="'.$_POST['iban'].'", swift_bic="'.$_POST['swift_bic'].'", vat = "'.$_POST['vat'].'", admin_rights_id="'.$_POST['admin_rights_id'].'" WHERE id='.$id);
                         
                         
                         ?>   
                            <span class="field" style="text-align: center">
                                 <p class="stdformbutton" style="text-align: center">

                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The User has been created </h4> </br>
                                    
                                      <a href="update-globalview-user.php" ><button type="button" name="update_another_user" id="update_another_user" class="btn btn-primary" >Update another user </button></a>
                                      <a href="view-users.php" ><button type="button" name="view_all_user" id="view_all_advertiser" class="btn btn-primary" >View all users </button>
                                      </a>
                                </p>   
                                
                                         </span>
                                
                <?php ;}
                Else {?>
                            
                            <?php
					// it recovers the contents from the table ADMIN AND ADMIN_RIGHT
					$reponse = $bdd->query('SELECT admin.* , admin_rights.descr FROM admin, admin_rights WHERE admin.id='.$id.' AND admin.admin_rights_id=admin_rights.id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					// On affiche chaque entrée une à une et celà tant qu'il y en a
					while ($donnees = $reponse->fetch())
						{?>
                        
                        	<h4>Company's logo</h4>
                            
                            <div class="profilethumb">
                                <img src="<?php echo 'http://localhost/white_label/admin/img/logo/'.$donnees['logo']; ?>" alt="" class="img-polaroid" />
                            </div><!--profilethumb-->
                                                      
                        </div><!--span3-->
                        <div class="span9">
                            <form action="" class="editprofileform" method="post">
                            	<h4>Login Information</h4>
                                <p>
                                	<label>Login</label>
                                	<input type="text" name="login" class="input-xlarge" value="<?php echo $donnees['login']; ?>" />
                                </p>
                                <p>
                                	<label>Email</label>
                                        <input type="text" name="email" class="input-xlarge" value="<?php echo $donnees['email']; ?>" />
                                </p>
                                <p>
                                	<label style="padding:0">Password</label>
                                        <input type="text" name="password" class="input-xlarge" value="<?php echo $donnees['password']; ?>" />

                                </p>
                                
                                 <p>
                                    <label>User Right *</label>
                                    <span class="field">
                                        <select id="admin_rights_id" name="admin_rights_id">
                                                                <?php 
                                                                $req_admin_rights = $bdd->query('SELECT * FROM admin_rights') or die(print_r($bdd->errorInfo()));
                                                                while ($donnees_rights = $req_admin_rights->fetch())
                                                                { //echo $donnees_rights['id'].'donnees rights["id"]    '.$donnees['admin_rights_id'].'donnees[adminrightsid]';?> 
                                                                <option value="<?php echo $donnees_rights['id'];?>" <?php if ($donnees_rights['id']==$donnees['admin_rights_id']) {echo ' selected ';} ?>> <?php echo $donnees_rights['descr'];  ?></option>
                                                                <?php }?>
                                        </select>
                                    </span>
                                </p>
                                
                                <br />
                                
                                <h4>Personal Information</h4>
                                <p>
                                	<label>Full Name</label>
                                	<input type="text" name="name" class="input-xlarge" value="<?php echo $donnees['name']; ?>" />
                                </p>
                                <p>
                                	<label>Company</label>
                                    <input type="text" name="company" class="input-xlarge" value="<?php echo $donnees['company']; ?>" />
                                </p>
                                <p>
                                	<label>Address</label>
                                    <input type="text" name="address" class="input-xlarge" value="<?php echo $donnees['address']; ?>" />
                                </p>
                                <p>
                                	<label>Postal Code</label>
                                    <input type="text" name="postal_code" class="input-xlarge" value="<?php echo $donnees['postal_code']; ?>" />
                                </p>
                                <p>
                                	<label>City</label>
                                    <input type="text" name="city" class="input-xlarge" value="<?php echo $donnees['city']; ?>" />
                                </p>
                                <p>
                                	<label>Telephone</label>
                                    <input type="text" name="telephone" class="input-xlarge" value="<?php echo $donnees['telephone']; ?>" />
                                </p>
                                
                                <h4>Bank Account</h4>
                                
                                <p>
                                	<label>IBAN</label>
                                    <input type="text" name="iban" class="input-xlarge" value="<?php echo $donnees['iban']; ?>" />
                                </p>
                                
                                <p>
                                	<label>SWIFT_BIC</label>
                                    <input type="text" name="swift_bic" class="input-xlarge" value="<?php echo $donnees['swift_bic']; ?>" />
                                </p>
                                <p>
                                	<label>VAT</label>
                                    <input type="text" name="vat" class="input-xlarge" value="<?php echo $donnees['vat']; ?>" />
                                </p>
                                
                                
                                <br />
                                
                                <h4>Notifications</h4>
                                <p>
                                	<input type="checkbox" /> Email me when someone mentions me... <br />
                                	<input type="checkbox" /> Email me when someone follows me...
                                </p>
                                
                                <br />
                                <p>
                                    <button type="submit" class="btn btn-primary" name="submit" >Update Profile</button> &nbsp; 
                                        <?php 
                                        
                                        //ACTIVATE AND DESACTIVATE THE STATUS
                                            if ($donnees['status']=='active')
                                            {
                                                ?><input type="button" class="btn btn-success" value="Status : Active">
                                                    &nbsp;  <input  type="submit" class="btn" name="deactivate" value='Deactivate your account'> 
                                                <?php ;
                                            
                                            }
                                            if  ($donnees['status']=='non-active')
                                            {
                                                ?><input type="button" class="btn btn-danger" value="Status : Non-active"  > 
                                                &nbsp;  <input  type="submit" class="btn" name="activate" value='Activate your account'>
                                                <?php ;
                                            }
                                            
                                        ?>
                                                
                                </p>
                          
                            
                <?php }} ?>
                            </form>
                        </div><!--span9-->
                    </div><!--row-fluid-->
                </div><!--widgetcontent-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>
