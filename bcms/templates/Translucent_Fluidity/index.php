<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
    <meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
    <meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
    <link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
    <?php print $domain_data['GSiteMapMeta'];?>
    <meta name="robots" content="all" />
    <meta name="generator" content="Bubble CMS Lite" />
<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/Translucent_Fluidity/style.css" />
</head>
<body>
<!-- begin header -->
<div id="header">
<h1><?php print $domain_data['SiteTitle']; ?> </h1>
</div>
<!-- end header -->

<!-- begin top tabbed menu -->
<ul id="nav">
<? include($app_data['MODULEBASEDIR']."menu/li.php");?>
</ul>
<!--  end top menu -->
<div id="container">
<div id="content">
<!-- begin editing main content -->
<h2><?php print $content_data['Title'];?></h2>
<p><? include($app_data['MODULEBASEDIR']."content/display.php");?></p>
<!-- end editing content -->
</div>
<!-- begin footer -->
<div id="footer">
<p>Copyright&copy; 2009 <a href="http://creativeweblogic.info/">Website Design Development Promotion Creative Web Logic</a><br /><br /><br />
  <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a> |&nbsp;Website Builder <a href="http://smoothbuild.website" target="_blank">Smooth Build</a></p>
</div>
<!-- end footer -->
</div>
<?php print $domain_data['Analytics']?>
</body>
</html>