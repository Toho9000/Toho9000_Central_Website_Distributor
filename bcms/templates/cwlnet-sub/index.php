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
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/cwlnet-sub/css/general.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="MainBodyCentered">
    	<div id="CompleteHeader">
        	<div id="MainMenu">
            	<?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
            </div>
        </div>
        <div id="BodyContent">
        	<div id="LeftBodyContent">
            	<div id="LeftBodyContentHeader">
                	<div id="NewsTitle">
                    	Latest News
            		</div>
            	</div>
                <div id="LeftBodyContentBody">
                  <?php include($app_data['MODULEBASEDIR']."news/list-items.php");?>
                </div>
            	<div id="LeftBodyContentFooter">
            
            	</div>
        
        	</div>
            <div id="RightBodyContent">
            <h2><?php print $content_data['Title'];?></h2>
                <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
            
            </div>
            <div id="ClearBoth">
            </div>
        
        </div>
		<div id="FooterHolder">
        	<div id="FooterMenu">
            	<div id="FooterMenuLeft">
                <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a></div>
                <div id="FooterMenuRight">
                <a href="http://creativeweblogic.info/">Copyright &copy; Creative Web Logic.Net</a></div>
                
            </div>
        </div>
	</div>
 	<?php print $domain_data['Analytics']?>
</body>
</html>
