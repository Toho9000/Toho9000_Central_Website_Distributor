<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<?php print $domain_data['GSiteMapMeta'];?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />


<meta name="robots" content="all" />
<meta name="generator" content="Bubble CMS Lite" />
<link rel="stylesheet" href="/<?php print $template_data['TEMPLATEDIR'];?>/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/<?php 
	print $template_data['TEMPLATEDIR'];
?>/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/<?php print $template_data['TEMPLATEDIR'];?>/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/<?php print $template_data['TEMPLATEDIR'];?>/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/<?php print $template_data['TEMPLATEDIR'];?>/css/style.css" type="text/css" media="screen" />

</head>
<body>

	<div id="header"><div class="inner clear">
		<h1><a href="/">
		  <?php print stripslashes($domain_data['SiteTitle']); ?>
		</a></h1>
		<ul id="navigation">
		  <li>
		  <?php include($app_data['MODULEBASEDIR']."menu/li.php");?> 
		</li>
		</ul>
	</div></div>
	
	<div id="search"><div class="inner clear"><br />
</div></div>
	
	<div id="wrapper" class="clear">

	<div id="content">
	  <div class="post" id="post-">
				
	  <div class="post-title">
					<h2><span class="PageTitle">
					  <?php print stripslashes($content_data['Title']);?>
					</span></h2>
			<h3>&nbsp;</h3>
				</div>

				<div class="post-content"><span class="entry">
				  <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
</span></div>

			</div>
	  <div class="post-navigation">
    <div class="left"></div>
			<div class="right"></div>
		</div>
	</div>
	<?php include($app_data['MODULEBASEDIR']."news/list-items.php");?>
	</div>

<div id="footer">
	<p id="blog-name">Theme by <a href="http://webrevolutionary.com/">WebRevolutionary</a> - <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a></p>
</div>

<?php print $domain_data['Analytics']?>
</body>
</html>
