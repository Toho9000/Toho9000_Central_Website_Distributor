<?
	global $content_data,$domain_data;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['GSiteMapMeta'];?>

<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/problog-10/style.css" type="text/css" media="screen" />
	
	
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_get_archives('type=monthly&format=link'); ?>

<?php wp_head(); ?>

</head>

<body>
<div id="wrapper2">

	<div id="header">
	       
         	<h1><a href="/"><?php print $domain_data['SiteTitle']; ?></a></h1>
			<div class="slogan"><?php bloginfo('description'); ?></div>
			
	</div>
	
	<div id="navigation">
	  <ul>

	<?php wp_list_pages('depth=1&title_li='); ?>
	
         </ul>
	
	
</div>