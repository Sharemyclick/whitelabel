<?php// It includes the page parameter connection.include('conf.php');?><!DOCTYPE html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Katniss Premium Admin Template</title><link rel="stylesheet" href="css/style.default.css" type="text/css" /><link rel="stylesheet" href="prettify/prettify.css" type="text/css" /><script type="text/javascript" src="prettify/prettify.js"></script><script type="text/javascript" src="js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script><script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script><script type="text/javascript" src="js/bootstrap.min.js"></script><script type="text/javascript" src="js/jquery.uniform.min.js"></script><script type="text/javascript" src="js/jquery.colorbox-min.js"></script><script type="text/javascript" src="js/jquery.smartWizard.min.js"></script><script type="text/javascript" src="js/jquery.cookie.js"></script><script type="text/javascript" src="js/custom.js"></script><script type="text/javascript">jQuery(document).ready(function (){jQuery('[id=li-dashboard]').removeClass('active');		jQuery('[id=li-pid]').addClass('active');                jQuery("#number_answer").blur(function(){    jQuery('#answers').empty();    var nb_answers = jQuery(this).val();    var count = 0;    for(i = 1; i <= nb_answers; i++){            jQuery('#answers').append('</br>Answer ' + i +' : <input type="text" name="answer' + i + '" value="" /> <input type="text" name="ref' + i + '" value="" placeholder="Reference" /></br>');        }      }        )/*    jQuery("#resume").fadeIn(function(){    var question = jQuery('#question').val();    var type = jQuery('#type').val();    var nb_answers = jQuery(this).val();        jQuery('#resume').append('</br> Question : ' + question + '</br>');    jQuery('#resume').append('Question type : ' + type + '</br>');        /*for(i = 1; i <= nb_answers; i++)    {         jQuery('#resume').append('</br>Answer ' + i +' : <input type="text" name="answer' + i + '" value="" /> </br>');    }   }        )*/    		});</script></head><body><div class="mainwrapper">		<?php include ('./menu/menu-left.php');?>        <!-- START OF RIGHT PANEL -->    <div class="rightpanel">    	<div class="headerpanel">        	<a href="" class="showmenu"></a>                        <div class="headerright">            	<div class="dropdown notification">                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">                    	<span class="iconsweets-globe iconsweets-white"></span>                    </a>             </div><!--dropdown-->    		            </div><!--headerright-->                	</div><!--headerpanel-->        <div class="breadcrumbwidget">        	<ul class="skins">                <li><a href="default" class="skin-color default"></a></li>                <li><a href="orange" class="skin-color orange"></a></li>                <li><a href="dark" class="skin-color dark"></a></li>                <li>&nbsp;</li>                <li class="fixed"><a href="" class="skin-layout fixed"></a></li>                <li class="wide"><a href="" class="skin-layout wide"></a></li>                    </div><!--breadcrumbs-->        <div class="pagetitle">        	<h1>Create Question ans Answers</h1> <span>Please, fill the form to create a question and associated answers</span>        </div><!--pagetitle-->                <div class="maincontent">        	<div class="contentinner">            	<h4 class="widgettitle">Create Question & Answers Form</h4>                <div class="widgetcontent">    .                                        <!-- START OF TABBED WIZARD -->                    <form class="stdform" method="post" action="create-question-answer-req.php">                    <div id="wizard2" class="wizard tabbedwizard">                        <ul class="tabbedmenu">                            <li>                            	<a href="#wiz1step2_1">                                	<span class="h2">STEP 1</span>                                    <span class="label">Enter the question and the type</span>                                </a>                            </li>                            <li>                            	<a href="#wiz1step2_2">                                	<span class="h2">STEP 2</span>                                    <span class="label">Enter the number of answer </span>                                </a>                            </li>                            <li>                            	<a href="#wiz1step2_3">                                	<span class="h2">STEP 3</span>                                    <span class="label">Enter answers</span>                                </a>                            </li>                        </ul>                        	                        <div id="wiz1step2_1" class="formwiz">                        	<h4>Enter the question</h4>                                <p>                                    <label>Question</label>                                    <span class="field"><input type="text" value="" name="question" id="question" class="input-xxlarge" required="required" /></span>                                </p>                                <h4>Enter the type</h4>                                <p>                                    <label>Type</label>                                    <span class="field">                                        <select name="type" id="type" class="status">                                            <option value="Input text">Input text</option>                                            <option value="Select">Select</option>                                            <option value="Radio">Radio</option>                                            <option value="Checkbox">Checkbox</option>                                            <option value="Textarea">Textarea</option>                                        </select>                                    </span>                                </p>                        </div><!--#wiz1step2_1-->                                                <div id="wiz1step2_2" class="formwiz">                        	<h4>Enter Number of answers</h4>                                 <p>                                    <label>Number of answers </label>                                    <span class="field"><input type="number" name="number_answer" id="number_answer" class="input-xxlarge" required="required" /></span>                                </p>                        </div><!--#wiz1step2_2-->                                                <div id="wiz1step2_3">                        	<h4> Enter answers</h4>                                <div id="answers"> </div>                                                        </div><!--#wiz1step2_3-->                                                                   </div><!--#wizard-->                    </form>                                <!-- END OF TABBED WIZARD -->                                    </div><!--widgetcontent-->                            </div><!--contentinner-->        </div><!--maincontent-->            </div><!--mainright-->    <!-- END OF RIGHT PANEL -->        <div class="clearfix"></div>        <div class="footer">    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>    	<div class="footerright">&copy; ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>    </div><!--footer-->    </div><!--mainwrapper--><script type="text/javascript">	jQuery(document).ready(function(){		// Smart Wizard 	      	jQuery('#wizard2').smartWizard({onFinish: onFinishCallback});		function onFinishCallback(){			alert('The question has been created');                        jQuery('form').submit();		}				jQuery(".inline").colorbox({inline:true, width: '60%', height: '500px'}); 				jQuery('select, input:checkbox').uniform();	});</script></body></html>