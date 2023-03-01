<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
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
<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/dark-sunflower/style.css" type="text/css" media="screen" />


</head>
<body>
<div id="body-container">
<div id="nav1-container">
<div id="nav1">
  <? include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
</div>
</div>
<div id="header">
<h1><div><a href="/"><?php print $domain_data['SiteTitle']; ?>
</a></div></h1>
</div>
<div id="container">
<div id="sidebar">
  <? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
</div>
<div id="content">
  <div id="post" class="post">
  <h2><span class="PageTitle">
    <?php print $content_data['Title'];?>
  </span></h2>

<h4>&nbsp;</h4>

<div class="entry">
  <? include($app_data['MODULEBASEDIR']."content/display.php");?>
  </div><!-- entry -->
</div>
</div>
<!-- content --></div><!-- container -->
<div id="footer">
  <p>
    <a href="http://smoothbuild.website/">Website Builder</a> - Powered By <a href="http://bubblecms.biz/">Bubble CMS Lite</a> -    <a href="http://creativeweblogic.info/">Solution Creative Web Logic</a></p>
</div>
</div>
<?php print $domain_data['Analytics']?>
</body>
</html>