<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/cool-web/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="maintopPan">
  <div id="maintopPanOne">
    <div id="topHeaderPan"> 
      <?php include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
    </div>
    
  </div>
</div>
<div id="bodyPan">
  <div id="main-content">
    <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
   </div> 
  
  
</div>
<div id="footermainPan">
  
    <div id="link-menu-container">
		<a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div>
  
</div>
</body>
</html>
