<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Aqueous</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['GSiteMapMeta'];?>
<link rel="stylesheet" href="<?php print $app_data['asset-sever']; ?>bcms/templates/aqueous/css/1.css" type="text/css" media="screen,projection" />
</head>
<body>
<div id="wrapper">
  <div id="innerwrapper">
    <div id="header">
      <form action="#">
        <input value="Search" />
      </form>
      <h1><a href="#">Online Business</a></h1>
      <h2> Keep Coming Back</h2>
      <? include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
    </div>
    <div id="sidebar">
    
    </div>
    
    <div id="content">
    <h2><?php print $content_data['Title'];?></h2>
                <? include($app_data['MODULEBASEDIR']."content/display.php");?>
    </div>
    <div id="footer">
      <a href="http://bubblecms.biz/">Bubble CMS</a>
       <a href="http://smoothbuild.website/">Website Builder</a>
        <a href="http://creativeweblogic.info/">Website Design Development Promotion</a>
        
      
    </div>
  </div>
</div>
</body>
</html>
