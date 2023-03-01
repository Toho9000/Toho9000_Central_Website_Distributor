<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php print $content_data['Meta_Title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
    <meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
    <meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
    <?php print $domain_data['GSiteMapMeta'];?>
    <meta name="robots" content="all" />
    <meta name="generator" content="Bubble CMS Lite" />
	<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/LoadFoO/css/style.css" media="screen" />
	<link rel="shortcut icon" href="<?php print $app_data['asset-sever']; ?>bcms/templates/LoadFoO/favicon.ico" />
	<script type="text/javascript" src="<?php print $app_data['asset-sever']; ?>bcms/templates/LoadFoO/js/textsizer.js"></script>
	<script type="text/javascript" src="<?php print $app_data['asset-sever']; ?>bcms/templates/LoadFoO/js/rel.js"></script>
</head>

<body>
<div id="wrap">
<div id="top">
<h2><a href="/" title="Back to main page"><?php print $domain_data['SiteTitle']; ?></a></h2>
<div id="menu">
<ul>
<? include($app_data['MODULEBASEDIR']."menu/li.php");?>
</ul>
</div>
</div>
<div id="content">
  <div id="left">
  <h2><?php print $content_data['Title'];?></h2>
<p><? include($app_data['MODULEBASEDIR']."content/display.php");?></p>
</div>
<div id="right">
  <div class="box">
		<h2 style="margin-top:17px">Recent News</h2>
		<? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
	</div>
</div>
<div id="clear"></div></div>
<div id="footer">
<p>Template Designed by <a href="http://loadfoo.org/" rel="external">LoadFoO</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a><br />
  <a href="http://creativeweblogic.info/">Website Design Development Promotion CreativeWebLogic.Net </a><br />
</p>
</div>
</div>
<?php print $domain_data['Analytics']?>
</body>
</html>