<?
	global $content_data,$domain_data;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php if ( is_home() ) { ?><? bloginfo('name'); ?>&nbsp;<?php bloginfo('description'); } else { wp_title('&nbsp;'); ?>&nbsp;by&nbsp;<? bloginfo('name'); } ?></title> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
<link rel="shorcut icon" type="image/x-ico" href="<?php print $app_data['asset-sever']; ?>bcms/templates/InSense/favicon.ico" />
<?php print $domain_data['GSiteMapMeta'];?>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/InSense/wp-layout-normal.css" title="normal"/>
<link rel="alternate stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/InSense/wp-layout-large.css" title="large" />
<script type="text/javascript" src="<?php print $app_data['asset-sever']; ?>bcms/templates/InSense/javascript/imghover.js"> </script>
<script type="text/javascript" src="<?php print $app_data['asset-sever']; ?>bcms/templates/InSense/javascript/styleswitcher.js"> </script>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<?php wp_head(); ?>
</head> 
<body>

<!-- bgcontain & bgcontainIn START -->
<div id="bgcontain"><div id="bgcontainIn">

<!-- Header START -->
<div class="HeaderBG">
 <div class="Header">
 <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
 <div class="TagLine"><?php bloginfo('description'); ?></div>
 <div class="CornerLeft"></div><div class="CornerRight"></div>
 
   <div class="TopMenu">
    <ul>
      <li><a href="#Content">Skip to Content</a></li><li><a href="<?php echo get_option('home'); ?>">Home</a></li><li><?php wp_loginout(); ?></li>
    </ul>
  </div>
 
   <div class="WidthSize">
   Options:
    <ul>
      <li><a href="#" onclick="setActiveStyleSheet('normal'); return false;">Normal</a></li><li><a href="#" onclick="setActiveStyleSheet('large'); return false;">Large</a></li>
    </ul>
  </div>
</div> 
<!-- Header END -->

<!-- Menu START -->
<div class="Menu">
  <div class="MainMenu">
   <ul>
    <?php wp_list_pages('title_li='); ?> 
   </ul>
  </div>
  
  <div class="MainSyn">
  <ul>
   <li><a href="<?php bloginfo('rss2_url'); ?>"><span>Entries RSS</span></a></li>
   <li><a href="<?php bloginfo('comments_rss2_url'); ?>"><span>Comments RSS</span></a></li>
  </ul>
  </div>
  
</div>
 
</div> 
<!-- Menu END -->


<!-- Content START -->
<div id="Content">
