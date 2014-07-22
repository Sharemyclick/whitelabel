<?php
// On inclut la page de paramètre de connection.
include('conf.php');


$req_admin_rights = $bdd->query('SELECT * FROM admin_rights') or die(print_r($bdd->errorInfo()));

if(isset($_POST['submit'])){
    
    if(empty($sponsor_image))
            {
            $dossier = 'C:/xampp/htdocs/white_label/admin/img/logo/';//TODO remove local part when upload to server !!
            $fichier = basename($_FILES['logo']['name']);
            $taille_maxi = 300000;
            $taille = filesize($_FILES['logo']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG', '.JPEG', '.GIF', '.PNG');
            $extension = strrchr($_FILES['logo']['name'], '.'); 
    // Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) // Si l'extension n'est pas dans le tableau
            {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg ...';
            }
    if($taille>$taille_maxi)
            {
        $erreur = 'l\'image est trop lourde. Maximum de 500ko...';
            }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
            // On formate le nom du fichier ici...
            $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

            if(move_uploaded_file($_FILES['logo']['tmp_name'], $dossier . $fichier)) // Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {

                    foreach($_POST as $indPost => $valPost){
                            $checkpos = strpos($indPost, "result_");
                            if($checkpos !== false)
                                    $result .= $valPost;
                    }
                }
            }

    

	$req = $bdd->prepare('INSERT INTO admin(login, password, email, name, status, company, logo, address, postal_code, city, telephone, iban, swift_bic, vat,  admin_rights_id)'.
                'VALUES (:login, :password, :email, :name, :status, :company, :logo, :address, :postal_code, :city, :telephone, :iban, :swift_bic, :vat,  :admin_rights_id)');
// On execute la requête en lui transmettant la liste des paramètres
	$req->execute(array(
		'login' => $_POST['login'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'status' => $_POST['status'],
                'company' => $_POST['company'],
                'logo' => $_FILES['logo']['name'],    
                'address' => $_POST['address'],
                'postal_code' => $_POST['postal_code'],
                'city' => $_POST['city'],
		'telephone' => $_POST['telephone'],
		'iban' =>  $_POST['iban'],
                'swift_bic' =>  $_POST['swift_bic'],
		'vat' =>  $_POST['vat'],
		'admin_rights_id' =>  $_POST['admin_rights_id']
                
		)) or die(print_r($req->errorInfo())); // On traque l'erreur s'il y en a une
}}
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
        	<h1>Create User</h1> <span><?php echo $_SESSION['login']; ?> , Please fill in the form to create a new user.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
		
            <div class="contentinner">
                
                <?php
                     if(isset($_POST['submit'])){
                         ?>   
                
                         <h4 class='confirmation' style="text-align: center; background:#1FC63D; opacity:0.8;">The User has been created </h4> </br>
                                    <p class="stdformbutton" style="text-align: center" >
                                      <a href="create-user.php" >
                                        <button type="button" name="create_another_user" id="create_another_advertiser" class="btn btn-primary" >Create another advertiser </button>
                                      </a>
                                     <a href="view-users.php" >
                                        <button type="button" name="view_all_user" id="view_all_advertiser" class="btn btn-primary" >View all advertisers </button>
                                      </a>
                                </p>           
                <?php ;}
                Else {?>
			<div class="widgetcontent">
			
            	<h4 class="widgettitle nomargin shadowed">User's informations</h4>
					
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="form_user" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">
                        
                        <p>
                            <label>Login *</label>
                            <span class="field"><input type="text" name="login" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Password *</label>
                            <span class="field"><input type="text" name="password" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Email *</label>
                            <span class="field"><input type="email" name="email" class="input-xxlarge" required="required" /></span>
                        </p>

                        <p>
                            <label>Full Name *</label>
                            <span class="field"><input type="text" name="name" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Status *</label>
                            <span class="field">
                                <select name="status" id="status" class="status">
                                        <option value="active"> Active</option>
                                        <option value="non-active"> Non-active</option>
                                </select>  
                            </span>
                        </p>
                        
                        <p>
                            <label>Company *</label>
                        <span class="field"><input type="text" id="company"  name="company" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Logo <span style="color: red"> (nom sans espace)</span></label>
                           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                           <span class="field"><input type="file" name="logo" id="logo" /></span>
			</p>

                        <p>
                            <label>Address *</label>
                        <span class="field"><input type="text" id="address"  name="address" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Postal Code *</label>
                        <span class="field"><input type="text" id="postal_code"  name="postal_code" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                         <p>
                            <label>City *</label>
                        <span class="field"><input type="text" id="city"  name="city" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>Telephone </label>
                        <span class="field"><input type="text" name="telephone" class="input-xxlarge" /></span>
                        </p>

                        <p>
                            <label>IBAN *</label>
                            <span class="field"><input type="text" name="iban" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>SWIFT BIC *</label>
                            <span class="field"><input type="text" name="swift_bic" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>VAT *</label>
                            <span class="field"><input type="text" name="vat" class="input-xxlarge" required="required" /></span>
                        </p>
                        
                        <p>
                            <label>User Right *</label>
                            <span class="field">
                                <select id="admin_rights_id" name="admin_rights_id">
							<?php while ($donnees = $req_admin_rights->fetch())
							{?>
							<option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['descr']; ?></option>
							<?php }?>
                                </select>
                            </span>
                        </p>
                                             
                        <p class="stdformbutton" style="text-align: center">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Create </button>
                            <button type="reset" class="btn">Reset </button>
                        </p>
                        
                        </form>
                    </div>				
                </div><!--contentinner--> <?php }; ?>
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
