<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $content_data["db"]['meta_title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data["db"]['meta_title'];?>" />
<meta name="description" content="<?php print $content_data["db"]['meta_description'];?>" />
<meta name="keywords" content="<?php print $content_data["db"]['meta_keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data["db"]['gsitemapmeta'];?>
<link rel="stylesheet" type="text/css" href="<?php print $app_data['asset-sever']; ?>bcms/templates/dualdiagnosis_main/css/style.css" />
</head>

<body>
<div id="container">
  <div id="head_navbar">
    	<ul>
        	<li></li>
   	      
    </ul>
  </div>
  <div id="company_name"><a href="/"><?php print $domain_data["db"]['sitetitle']; ?></div>
  <div id="content_container">
    <div id="menu"><?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?> </div>
    <div id="main">
      
      <div id="first_post">
        <h1>
          <?php print $content_data["db"]['title'];?>
        </h1>
         <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
      </div>
    </div>
    <div id="right">
     	<div id="categories">
        <h1>Latest <span class="b">News</span></h1>
        <?php include($app_data['MODULEBASEDIR']."news/list-items.php");?>
      </div>
    
    </div>
  </div>
  <div id="footer">
  <div id="footer_left">
    <p><a href="http://bubblecms.biz/" >Powered By Bubble CMS Lite</a> </p>
    <p><a href="http://creativeweblogic.net/">Website Design Development Programming Promotion - Creative Web Logic.net</a></p>
    
  </div>
  <div id="footer_right"><a href="http://cpanel-hosting.info/">CPanel Hosting</a></div>
  </div>  
</div>
<?php print $domain_data["db"]['analytics']?>
</body>
</html>
