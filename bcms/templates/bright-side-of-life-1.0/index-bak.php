<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bright Side of Life</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php print $content_data['Meta_Title'];?></title>
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['GSiteMapMeta'];?>
<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/bright-side-of-life-1.0/images/BrightSide.css" media="screen"/>
</head>
<body>
<div id="wrap">
  <div id="header">
    <h1 id="logo"><?php print $content_data['Meta_Title'];?></h1>
    <h2 id="slogan"><?php print $content_data['Meta_Title'];?></h2>
    <form method="post" class="searchform" action="#">
      <p>
        <input type="text" name="search_query" class="textbox" />
        <input type="submit" name="search" class="button" value="Search" />
      </p>
    </form>
    <?php include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
      
  </div>
  <div id="content-wrap"> <img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bright-side-of-life-1.0/images/headerphoto.jpg" width="820" height="120" alt="headerphoto" class="no-border" />
    
    <div id="main"> <a name="TemplateInfo"></a>
      <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
    
  </div>
  <div id="footer">
    <div class="footer-left">
      <a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a>
    </div>
    <div class="footer-right">
      <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
    </div>
  </div>
</div>
</body>
</html>
