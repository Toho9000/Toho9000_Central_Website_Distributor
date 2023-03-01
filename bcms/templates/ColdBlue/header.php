<?php require_once('functions.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?><?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" type="text/css" media="screen" />
<!--[if lte IE 6]>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/legacy.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>
<body>

	<div id="header"><div class="inner clear">
		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		<ul id="navigation">
			<?php wp_list_pages('title_li=&depth=1'); ?>
			<li><a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a></li>
		</ul>
	</div></div>
	
	<div id="search"><div class="inner clear">
		<a id="rss-link" href="<?php bloginfo('rss2_url'); ?>"><strong>Subscribe to the RSS Feed</strong></a>
		<a id="technorati-link" href="http://technorati.com/faves?add=<?php bloginfo('url'); ?>"><strong>Add to your Favorites</strong></a>
		<?php include ($template_data['TEMPLATEPATH'] . '/searchform.php'); ?>
	</div></div>
	
	<div id="wrapper" class="clear">