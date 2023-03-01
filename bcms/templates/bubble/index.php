<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<?php print $domain_data['GSiteMapMeta'];?>
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/bubble/style.css" rel="stylesheet" type="text/css" />
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/bubble/menu.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>
<style type="text/css" media="screen">
#menuh{float:none;}
body{behavior:url(csshover.htc); font-size:73%;}
#menuh ul li{float:left; width: 100%;}
#menuh a{height:1%;font:bold 1em/1.4em "lucida sans", helvetica, "Trebuchet MS", arial, sans-serif;}
</style>
<![endif]-->
</head>
<body>
<div id="container">
  <div id="top">
    <h1><a href="/">Homepage</a></h1>
    <div id="menuh-container">
      <div>
        
         <?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
      </div>
    </div>
  </div>
  
  <div id="content">
    <h1><?php print $content_data['Title'];?></h1>
      <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
  </div>
  <div id="footer"> 
	  <div id="link-menu-container">
		<a href="http://creativeweblogic.net">Creative Web Logic - Website Design Development Programming Promotion</a> | 
		<a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a>
	  </div>
  </div>
</div>
</body>
</html>
