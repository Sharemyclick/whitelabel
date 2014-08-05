<?php
// it includes parameters of connection
include('conf.php');
if(isset($_POST['unassign']))
{
        $bdd->exec('DELETE FROM admin_pid WHERE pid_id='.$_POST['pid_id'].' AND admin_id='.$_POST['admin_id']); 
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
		jQuery('[id=li-pid]').addClass('active');
		
		if(jQuery('.deleterowcustomized').length > 0) {
		jQuery('.deleterowcustomized').click(function(){
			var conf = confirm('Continue delete?');
			if(conf){
				var id = jQuery(this).attr('id').substring(6);
				jQuery.ajax({
					  type: 'GET', 
					  url: 'http://sharemydeal.net/admin/commandRequest.php', 
					  dataType : 'json',
					  data: {
					  action : 'deletePid',
					  pid: id, 
					  }, 
					  success: function(data, textStatus, jqXHR) {
					  },
					  error: function(jqXHR, textStatus, errorThrown) {
						// error occured during the request
					  }
				 });
				jQuery(this).parents('tr').fadeOut(function(){
					jQuery(this).remove();
					// do some other stuff here
				});
				 }
			return false;
		});	
	}

		
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
                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>
                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="icon-off"></span> Sign Out</a></li>
                    </ul>
                </div><!--dropdown-->
    		
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
        	<h1>Pid Table</h1> <span></span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner">
                
			<h4 class="widgettitle">List of all pids</h4><small>Please make sure you replace the <strong><span style="color:red;">"xxxxx"</span></strong> by the name of the quizz. You have the choice between <span style="color:green;">"iphone5c"</span>, <span style="color:green;">"minibarsmeg"</span> or <span style="color:green;">"nespressocitiz"</span></small>
            	<table class="table table-bordered">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="centeralign">Pid Name</th>
                            <th class="centeralign">Affiliate company</th>
                            <th class="centeralign">Un-assign</th>
                        </tr>
                    </thead>
                    <tbody>

					<?php
					// data from table pid
					$reqPid = $bdd->query('SELECT pid_id, admin_id, pid.name, admin.company FROM admin_pid LEFT JOIN pid ON admin_pid.pid_id = pid.id LEFT JOIN admin ON admin_pid.admin_id = admin.id ORDER BY admin_pid.pid_id') or die(print_r($bdd->errorInfo())); // On traque l'erreur s'il y en a une
					
					while ($pid = $reqPid->fetch())
						{?>
                        <tr>
                            <form name="form_pid" class="stdform stdform2" method="post" action="" enctype="multipart/form-data">

                                <td class="centeralign"> <?php echo $pid['name']; ?> <input type="hidden" name="pid_id" value="<?php echo $pid['pid_id'];?>"> </td>
                                <td class="centeralign"> <?php echo $pid['company']; ?> <input type="hidden" name="admin_id" value="<?php echo $pid['admin_id'];?>"> </td>
                                <td class="centeralign"> 
                                
                                    <span class="field">
                                        <input type="submit" class="btn btn-danger" value="Un-assign" name="unassign"> 
                                    </span>
                                </td>
                            </form>                  
                        </tr>      
  
						<?php }
					?>
                    </tbody>                               

                </table>
                
                <div class="divider15"></div>
			
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
    <div class="footer">
    	<div class="footerleft">Sharemyclick Plateform v1.1</div>
    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/sharemyclick">Follow us on Twitter</a> - <a href="https://www.facebook.com/sharemyclick">Follow us on Facebook</a></div>
    </div><!--footer-->
    
</div><!--mainwrapper-->

</body>
</html>
