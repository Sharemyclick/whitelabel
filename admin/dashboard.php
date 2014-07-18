<?php
// On inclut la page de paramètre de connection.
include('conf.php');

// On vérifie que le user est connecté sinon on le renvoie à la page de connection
session_start();  
if(!isset($_SESSION['login'])) {  
  echo '<script>document.location.href="dashboard.php"</script>';  
  exit;  
}

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sharemyclick admin platform V1.0</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="prettify/prettify.css" type="text/css" />
 <STYLE type="text/css">

#bargraph3 .tickLabels .xAxis div.tickLabel { 
    /* Rotate Axis Labels */
    transform: translateX(60%) rotate(90deg); /* CSS3 */
    transform-origin: 0 0;

    -ms-transform: translateX(60%) rotate(90deg); /* IE */
    -ms-transform-origin: 0 0;

    -moz-transform: translateX(60%) rotate(90deg); /* Firefox */
    -moz-transform-origin: 0 0;

    -webkit-transform: translateX(60%) rotate(90deg); /* Safari and Chrome */
    -webkit-transform-origin: 0 0;

    -o-transform: translateX(60%) rotate(90deg); /* Opera */
    -o-transform-origin: 0 0;
	
	text-align: left;
}

  </STYLE>

<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot.pie.resize_update.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="js/jquery.flot.time.js"></script>    
<script type="text/javascript" src="js/jshashtable-2.1.js"></script>
<script type="text/javascript" src="js/jquery.numberformatter-1.2.4.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.symbol.js"></script>
<script type="text/javascript" src="js/jquery.flot.axislabels.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
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
                        <li><a href="editprofile.php"><span class="icon-edit"></span> Edit Profile</a></li>
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
        	<h1>Dashboard</h1> <span>This is your private dashboard.</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
            	<div class="alert alert-info" style="height:20px;">
					<MARQUEE DIRECTION="left" SCROLLAMOUNT="2" style="float:left;" >
                    <strong>Welcome <?php echo ucfirst($_SESSION['login']); ?>!</strong> to your Sharemyclick Dashboard.
					</MARQUEE>
					<button type="button" class="close" data-dismiss="alert" style="float:right;margin-top:-10px;" >×</button>
                </div><!--alert-->
                
                <div class="row-fluid">
                	<div class="span8">
						<?php if($_SESSION['right'] <= "2"){/*?>
                    	
						<ul class="widgeticons row-fluid">
                        	<!--<li class="one_fifth"><a href=""><img src="img/gemicon/location.png" alt="" /><span>Maps</span></a></li>-->
                            <!--<li class="one_fifth"><a href=""><img src="img/gemicon/image.png" alt="" /><span>Media</span></a></li>-->
                            <!--<li class="one_fifth"><a href="reports.php"><img src="img/gemicon/reports.png" alt="" /><span>Reports</span></a></li>-->
                            <!--<li class="one_fifth"><a href=""><img src="img/gemicon/edit.png" alt="" /><span>New Article</span></a></li>-->
                            <!--<li class="one_fifth last"><a href=""><img src="img/gemicon/mail.png" alt="" /><span>Check Mail</span></a></li>-->
                        	<!--<li class="one_fifth"><a href=""><img src="img/gemicon/calendar.png" alt="" /><span>Events</span></a></li>-->
                            <!--<li class="one_fifth"><a href="manage-user.php"><img src="img/gemicon/users.png" alt="" /><span>Manage Users</span></a></li>-->
							<!--<li class="one_fifth"><a href=""><img src="img/gemicon/settings.png" alt="" /><span>Settings</span></a></li>-->
                            <!--<li class="one_fifth"><a href=""><img src="img/gemicon/archive.png" alt="" /><span>Archives</span></a></li>-->
                            <!--<li class="one_fifth last"><a href=""><img src="img/gemicon/notify.png" alt="" /><span>Notifications</span></a></li>-->
                        </ul>
                        
                        <br />
						
                        <?php */}?>
                        <h4 class="widgettitle">Report Summary<span style="font-size:10px;"><i> &nbsp;(Total impressions and registrations for every quizz)</i></span></h4>
                        <div class="widgetcontent">
                        	<div id="chartplace2" style="height:300px;"></div>
                        </div><!--widgetcontent-->  
						<h4 class="widgettitle">Report Summary <span style="font-size:10px;"><i> &nbsp;(Where users leave the quiz)</i></span></h4>
						 <div class="widgetcontent">
                        	<div id="chartplace1" style="height:300px;"></div>
                        </div><!--widgetcontent-->  
						<h4 class="widgettitle">Real-time Report <span style="font-size:10px;"><i> &nbsp;(Live registrations)</i></span></h4>
						 <div class="widgetcontent">
                        	<div id="chartplace3" style="height:300px;"></div>
                        </div><!--widgetcontent-->  
                    </div><!--span8-->
					
                    <div class="span4">
                    	<!--<h4 class="widgettitle nomargin">Please meet your account manager</h4>
                        <div class="widgetcontent bordered">
                        	<div class="row-fluid">
							<div class="span4"><img src="img/630.jpg" title="Jeremy Skelland" alt="Jeremy Skelland" class="text-center"/></div>
							<div class="span8">
								<!-- Here we can put dynamically the name of the employee who will be responsible for the account -->
								<!--<p><small><strong>Firstname:</strong> Jeremy<br />
								<strong>Lastname:</strong> Skelland<br />
								<strong>Email:</strong> jeremy@sharemyclick.com<br />
								<strong>Phone:</strong> +34 663180744<br />
								<strong>Skype:</strong> jeremy.sharemyclick</small></p>
							</div>
							</div>
                        </div>--><!--widgetcontent-->
                        <?php if($_SESSION['right'] <= "2"){?>
                        <h4 class="widgettitle">Sponsors Validated per day</h4>
                        <div class="widgetcontent">
                        	<div id="bargraph2" style="height:200px;"></div>
							
							Select day :
							<span class="field"><input type="text" name="pickerSponsor" id="datepicker1" style="width:100px;" value="<?php echo date('Y-m-d');?>" required="required" /></span>
							<input type="button" name="submitSponsors" id="submitSponsors" value="Go!" />
							
                        </div><!--widgetcontent-->
						
						<h4 class="widgettitle">Coregs Validated per day</h4>
                        <div class="widgetcontent">
                        	<div id="bargraph3" style="height:200px;"></div>
							
								
                        </div><!--widgetcontent-->
						<div style="margin-top:160px;">
						Select day :
							<span class="field"><input type="text" name="pickerCoreg" id="datepicker2" style="width:100px;" value="<?php echo date('Y-m-d');?>" required="required" /></span>
							<input type="button" name="submitCoregs" id="submitCoregs" value="Go!" />
						</div>
						
						<h4 class="widgettitle" style="margin-top:16px;" >Pids Leads Validation per day</h4>
                        <div class="widgetcontent">
                        	<div id="piegraph" style="height:200px;"></div>
							
								
                        </div><!--widgetcontent-->
						<div style="margin-top:180px;">
						Select day :
							<span class="field"><input type="text" name="pickerPid" id="datepicker3" style="width:100px;" value="<?php echo date('Y-m-d');?>" required="required" /></span>
							<input type="button" name="submitPids" id="submitPids" value="Go!"  />
						</div>
                        <?php }?>
                    </div><!--span4-->
                </div><!--row-fluid-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <div style="height:80px;">
	 </div>
    <div class="footer">
    	<div class="footerleft">Sharemyclick dashboard v1.0</div>
    	<div class="footerright">&copy; Sharemyclick with Themepixels - <a href="https://twitter.com/sharemyclick"><span class="iconsweets-twitter"></a> - <a href="https://www.facebook.com/sharemyclick"><span class="iconsweets-facebook"></a> - <a href="https://www.linkedin.com/company/sharemyclick">Followus on Linkedin</a></div>
    </div><!--footer-->

    
</div><!--mainwrapper-->

</body>
</html>
