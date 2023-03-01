<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/corporate/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
  <h1><?php print $content_data['Meta_Title'];?><br />
    </h1>
</div>
<div id="menu">
  <?php include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
</div>
<div id="content">
  <div id="left">
    <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    <hr id="border-top" />
    
  
</div>
<div id="footer">
  <div id="link-menu-container">
		<br>&nbsp;&nbsp;&nbsp;<a href="http://creativeweblogic.net">Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div>
</div>
</body>
</html>
