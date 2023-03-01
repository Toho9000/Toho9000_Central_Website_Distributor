<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title><?php print $content_data['Meta_Title'];?></title>

   
		<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
		<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
		<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
		<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
		<meta name="robots" content="all" />
		<meta name="generator" content="Bubble CMS Lite" />
		<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/style.css" type="text/css" media="screen" />
		

		<!-- Loading third party fonts -->
		<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/fonts/novecento-font/novecento-font.css" rel="stylesheet" type="text/css">
		<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />

		<!-- Loading main css file -->
		<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->
		<?php print $domain_data['GSiteMapMeta'];?>
	</head>


	<body>
		<div class="site-content">
			<header class="site-header">
				<div class="container">
					<a href="#" class="branding">
						<img src="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/logo.png" alt="" class="logo">
						<h1 class="site-title"><?php print $content_data['Meta_Title'];?></h1>
					</a>

					<div class="main-navigation">
						<button class="menu-toggle"><i class="fa fa-bars"></i> Menu</button>
						<ul class="menu">
							<? include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
							<!--
							<li class="menu-item current-menu-item"><a href="index.html">Homepage <small>Lorem ipsum</small></a></li>
							<li class="menu-item"><a href="#">Pastors <small>Cupidatat non proident</small></a></li>
							<li class="menu-item"><a href="seremons.html">Seremons <small>Laboris nisi aliquip</small></a></li>
							<li class="menu-item"><a href="events.html">Events <small>Sunt in culpa</small></a></li>
							<li class="menu-item"><a href="families.html">Families <small>Aute irure</small></a></li>
							<li class="menu-item"><a href="#">Contact <small>lorem ipsum</small></a></li>
							-->
						</ul>
					</div>

					<div class="mobile-navigation"></div>
				</div>
			</header> <!-- .site-header -->

			<div class="hero">
				<div class="slides">
					

					<li data-bg-image="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/maquarie_church_1.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Maquarie Church</small>
								<h2 class="slide-title">Place with a real love</h2>

								<a href="#" class="button">See our families</a>
							</div>
						</div>
					</li>
					<li data-bg-image="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/maquarie_church_2.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Maquarie Church</small>
								<h2 class="slide-title">Place with a real love</h2>

								<a href="#" class="button">See our families</a>
							</div>
						</div>
					</li>
					<li data-bg-image="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/maquarie_church_3.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Maquarie Church</small>
								<h2 class="slide-title">Place with a real love</h2>

								<a href="#" class="button">See our families</a>
							</div>
						</div>
					</li>
					<li data-bg-image="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/maquarie_church_4.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Maquarie Church</small>
								<h2 class="slide-title">Place with a real love</h2>

								<a href="#" class="button">See our families</a>
							</div>
						</div>
					</li>
					<li data-bg-image="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/images/maquarie_church_5.jpg">
						<div class="container">
							<div class="slide-content">
								<small class="slide-subtitle">Maquarie Church</small>
								<h2 class="slide-title">Place with a real love</h2>

							</div>
						</div>
					</li>
				</div>
			</div>

			<main class="main-content">
				
		
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<h2 class="section-title">Upcoming events</h2>
								<? include($app_data['MODULEBASEDIR']."content/display.php");?>
							</div>
							<div >
								<? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
							</div>
						</div> <!-- .row -->
					</div> <!-- .container -->
					
				</div> <!-- section -->
				
			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="widget">
								<a href="http://bubblecms.biz/">Bubble CMS</a>
       							
        						
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
							<a href="http://smoothbuild.website/">Website Builder</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
							<a href="http://creativeweblogic.info/">Website Design Development Promotion</a>
							</div>
						</div>
					</div> <!-- .row -->

				</div><!-- .container -->
			</footer> <!-- .site-footer -->

		</div>
		

		<script src="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/js/jquery-1.11.1.min.js"></script>
		<script src="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/js/plugins.js"></script>
		<script src="<?php print $app_data['asset-sever']; ?>bcms/templates/true_church/js/app.js"></script>
		<?php print $domain_data['Analytics']?>
	</body>

</html>