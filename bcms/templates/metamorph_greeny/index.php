<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php print $content_data["db"]['Meta_Title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
    <meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
    <meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
	<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
    <?php print $domain_data['GSiteMapMeta'];?>
    <meta name="robots" content="all" />
    <meta name="generator" content="Bubble CMS Lite" />
	<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/metamorph_greeny/styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="content">
<div id="back">
<!-- header begins -->
<div id="header"> 
	<div id="logo">
		<h1><a href="/"><?php print $domain_data['SiteTitle']; ?></a></h1>
		<h2>&nbsp;</h2>
	</div>
  <div id="menu">
		<ul>
			<? include($app_data['MODULEBASEDIR']."menu/li.php");?>
		</ul>
  </div>
</div>

<!-- header ends -->
<!-- content begins -->
 <div id="main">
	<div id="right">	
		  			
			
		<div class="title_back"> </div>
			<h3>Company News</h3>
			<div class="title_back">
			<? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
		  </div>
	</div>
	<div id="left">		
				<div class="left_box">
			<h2><?php print $content_data['Title'];?></h2>
			<p><? include($app_data['MODULEBASEDIR']."content/display.php");?>
			</p>
<p class="date">&nbsp;</p>
				</div>
	</div>
	<div style="clear: both;">&nbsp;</div>
<!--content ends -->
<!--footer begins -->
	</div>

<div id="footer">
<p>Copyright &copy; 2008. Template by <a href="http://www.metamorphozis.com/" title="Free Templates">Free Templates</a> | <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a></p>
<p><a href="http://creativeweblogic.info/">Website Design Development Promotion Creative Web Logic</a><a href="http://jigsaw.w3.org/css-validator/check/referer" title="This page validates as CSS"><abbr title="Cascading Style Sheets"></abbr></a></p>
	</div>
</div>
</div>
<?php print $domain_data['Analytics']?>
</body>
</html>