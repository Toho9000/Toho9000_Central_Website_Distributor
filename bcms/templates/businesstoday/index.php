<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: BusinessToday
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/businesstoday/layout/styles/layout.css" type="text/css" />
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><?php print $domain_data['SiteTitle']; ?></h1>
    </div>
    
    <br class="clear" />
  </div>
</div>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
       <?php include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
    </div>
    <div id="search">
      
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col3">
  
</div>

<div class="wrapper col5">
  <div id="container">
    <div id="content">
      <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
    
    <br class="clear" />
  </div>
</div>

<div class="wrapper col7">
  <div id="copyright">
    	  <div id="link-menu-container">
		<a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div>
    <br class="clear" />
  </div>
</div>
</body>
</html>