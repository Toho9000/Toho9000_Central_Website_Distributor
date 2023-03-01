<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/chesspiece-2/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div id="wrap">
  <div id="masthead">
    <h1><?php print $content_data['Meta_Title'];?></h1>
    <div id="menucontainer">
      <div id="menunav">
        <?php include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
      </div>
    </div>
  </div>
  <div id="container">
    
    <div id="content">
      <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
  </div>
</div>
<div id="footer"> <div id="link-menu-container">
		<a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div> </div>
</body>
</html>
