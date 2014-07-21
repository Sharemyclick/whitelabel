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
<script type="text/javascript" src="prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
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
        	<h1>Dashboard</h1> <span>This is a sample description for dashboard page...</span>
        </div><!--pagetitle-->
        
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
            	<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Welcome!</strong> This alert needs your attention, but it's not super important.
                </div><!--alert-->
                
                <div class="row-fluid">
                	<div class="span8">
                    	<ul class="widgeticons row-fluid">
                        	<!--<li class="one_fifth"><a href=""><img src="img/gemicon/location.png" alt="" /><span>Maps</span></a></li>-->
                            <li class="one_fifth"><a href=""><img src="img/gemicon/image.png" alt="" /><span>Media</span></a></li>
                            <li class="one_fifth"><a href=""><img src="img/gemicon/reports.png" alt="" /><span>Reports</span></a></li>
                            <!--<li class="one_fifth"><a href=""><img src="img/gemicon/edit.png" alt="" /><span>New Article</span></a></li>-->
                            <li class="one_fifth last"><a href=""><img src="img/gemicon/mail.png" alt="" /><span>Check Mail</span></a></li>
                        	<!--<li class="one_fifth"><a href=""><img src="img/gemicon/calendar.png" alt="" /><span>Events</span></a></li>-->
                            <li class="one_fifth"><a href="manage-user.php"><img src="img/gemicon/users.png" alt="" /><span>Manage Users</span></a></li>
                            <li class="one_fifth"><a href=""><img src="img/gemicon/settings.png" alt="" /><span>Settings</span></a></li>
                            <!--<li class="one_fifth"><a href=""><img src="img/gemicon/archive.png" alt="" /><span>Archives</span></a></li>-->
                            <!--<li class="one_fifth last"><a href=""><img src="img/gemicon/notify.png" alt="" /><span>Notifications</span></a></li>-->
                        </ul>
                        
                        <br />
                        
                        <h4 class="widgettitle">Report Summary</h4>
                        <div class="widgetcontent">
                        	<div id="chartplace2" style="height:300px;"></div>
                        </div><!--widgetcontent-->  
                    </div><!--span8-->
					
                    <div class="span4">
                    	<h4 class="widgettitle nomargin">Please meet your account manager</h4>
                        <div class="widgetcontent bordered">
                        	<div class="row-fluid">
							<div class="span4"><img src="img/630.jpg" title="Jeremy Skelland" alt="Jeremy Skelland" class="text-center"/></div>
							<div class="span8">
								<!-- Here we can put dynamically the name of the employee who will be responsible for the account -->
								<p><small><strong>Firstname:</strong> Jeremy<br />
								<strong>Lastname:</strong> Skelland<br />
								<strong>Email:</strong> jeremy@sharemyclick.com<br />
								<strong>Phone:</strong> +34 663180744<br />
								<strong>Skype:</strong> jeremy.sharemyclick</small></p>
							</div>
							</div>
                        </div><!--widgetcontent-->
                        
                        <h4 class="widgettitle">Site Impressions</h4>
                        <div class="widgetcontent">
                        	<div id="bargraph2" style="height:200px;"></div>
                        </div><!--widgetcontent-->
                        
                    </div><!--span4-->
                </div><!--row-fluid-->
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
<script type="text/javascript">

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

jQuery(document).ready(function(){
//url: 'http://sharemydeal.net/admin/serviceRequest.php', 
var tab_users = new Object();
jQuery.ajax({
			  type: 'GET', 
			  contentType: "application/json",
			  url: 'http://sharemydeal.net/admin/commandRequest.php', 
			  dataType : 'json',
			  data: {
				action: 'getUsers'
			  }, 
			  success: function(data, textStatus, jqXHR) {
				var jsonObj = jQuery.parseJSON(JSON.stringify(data));
				jQuery.each(jsonObj, function( index, value ) {
				tab_users[index] = value;
				});
				arraysManagement();
			
				// La reponse du serveur est contenu dans data
				// On peut faire ce qu'on veut avec ici
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
				// Une erreur s'est produite lors de la requete
			  }
		 });
		

			
function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}			
			
function arraysManagement(){
	var date_array = new Array();
	var tab_users_reset = new Array();
	for(i=1;i<=31;i++){
		var newdate = new Date();
		newdate.setDate(newdate.getDate() - i);
		var d = new Date(newdate);
		var month = d.getMonth()+1;
		var day = d.getDate();

		var output = d.getFullYear() + '-' +
			(month<10 ? '0' : '') + month + '-' +
			(day<10 ? '0' : '') + day;
		date_array[i-1] = output;
		// check tab_users to set in all dates are set
		if(tab_users[output]){
			tab_users_reset[i-1] = tab_users[output];
		}else {tab_users_reset[i-1] = 0;}
	}
	date_array.reverse();
	tab_users_reset.reverse();
	
		// basic chart
		var Leads = [[0, 200], [1, 600], [2,300], [3, 800], [4, 500], [5, 130], [6, 800], [7, 800]];
		var Impressions = [[0, 150], [1, 300], [2, 230], [3, 540], [4, 845], [5, 100], [6, 965], [7, 800]];
		for(i = 8 ;i < 31; i++){
			Leads[i] = new Array();
			Leads[i] = [i, parseInt(Math.random() * 300)];
			Impressions[i] = new Array();
			Impressions[i] = [i, parseInt(Math.random() * 300)];
		}
		var Users = new Array();
		for(i = 0 ;i < 31; i++){
			Users[i] = new Array();
			Users[i] = [i, parseInt(tab_users_reset[i])];
		}
	
	
	
			
		var plot = jQuery.plot(jQuery("#chartplace2"),
			   [ { data: Leads, label: "Leads(x)", color: "#fb6409"}, { data: Impressions, label: "Impressions(x)", color: "#096afb"},
			   { data: Users, label: "Users registered", color: "green"}], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#ccc', borderWidth: 1, labelMargin: 10 },
				   yaxis: { min: 0, max: 1000 },
				   xaxis: {tickFormatter: function (val, axis) {           
					return date_array[val];
					}}
				 });
		
		var previousPoint = null;
		jQuery("#chartplace2").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.dataIndex,
					y = item.datapoint[1];
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " for " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace2").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});


		// bar graph
		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);
			
		var stack = 0, bars = true, lines = false, steps = false;
		jQuery.plot(jQuery("#bargraph2"), [ d2 ], {
			series: {
				stack: stack,
				lines: { show: lines, fill: true, steps: steps },
				bars: { show: bars, barWidth: 0.6 }
			},
			grid: { hoverable: true, clickable: true, borderColor: '#bbb', borderWidth: 1, labelMargin: 10 },
			colors: ["#06c"]
		});
		
		// calendar
		jQuery('#calendar').datepicker();

}
});
</script>
</body>
</html>
