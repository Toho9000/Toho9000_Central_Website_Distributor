<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/city-nightlife/images/style.css" type="text/css" />
</head>
<body>
<div class="content">
  <h1><?php print $content_data['Title'];?></h1>
  <div class="left">
  <div style="text-align:right"><?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?></div>
    <div class="left_content">
      <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
   
  </div>
 
</div>
<div class="footer">
  <div id="link-menu-container">
		<a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div>
</div>
</body>
</html>
