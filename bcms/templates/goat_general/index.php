<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $content_data['Meta_Title'];?></title>
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['GSiteMapMeta'];?>
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/goat_general/css/general.css" rel="stylesheet" type="text/css" />
<script src="<?php print $app_data['asset-sever']; ?>bcms/templates/goat_general/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="<?php print $app_data['asset-sever']; ?>bcms/templates/goat_general/Scripts/function.js" type="text/javascript"></script>
<style>
body {
	background-image: url(<?php print $app_data['asset-sever']; ?>bcms/templates/goat_general/images/bg.jpg);
	background-repeat: repeat-x;
	background-color:#d6d7d6;
	margin:0px;
	text-align:center;
}
</style>
</head>

<body>

<div id="MainBody" align="center">
	<div id="WhiteHeader">
        <div id="HeaderTop">      
            <div class="HeaderMenu">
                <? include("modules/language/dropdown.php");?>
            </div>
        </div>
        <div id="HeaderBanner">
	  <? include($template_data['TEMPLATEPATH']."includes/header.php");?>
      </div>
    </div>
    <div id="MenuHolder">
    	<div id="MainMenu">
  		<? include($app_data['MODULEBASEDIR']."menu/horizontal.php");?>
   	  </div>
         
    </div>
    <div id="MainBodyHolder">
		<div id="LeftPanel">
    		<div id="LeftPanelHeader">
        
        	</div>
            <div id="LeftPanelTitleHolder">
            	<div id="LeftPanelTitleBGBlack">
                &nbsp;
                </div>
                <div id="LeftPanelTitleBGGrey">
                <?php print $template_defs['news_title'];?>
                </div>
            </div>
            <div id="LeftPanelBodyHolder">
                <div id="LeftPanelBodyBG">
                	<div id="LeftPanelBodyBGGrey">
                		<? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
                	</div>
                </div>
            </div>
    	</div>
   	  <div id="RightPanelHolder">
            <div id="RightPanel">
        		<span class="MainTitle">
                	<?php print $template_defs['welcome'];?><br />
                </span>
                <span class="SubTitle">
                	<?php print $content_data['Title'];?>
                </span>
                <p class="MainText">
                	<? include(MODULEBASEDIR."content/display.php");?>
                </p>
            </div>
      </div>
   	
        <div id="ClearBody">
        
        </div>
        <div id="FooterHolder">
            <div id="FooterBGWhite">
                <div id="FooterBGGrey">
                  <div id="FooterTextLeft">
               	  <a href="http://bubblecms.biz/" target="_blank">Powered By Bubble CMS Lite</a>              </div>
                  <div id="FooterTextRight">
                  	<a href="http://creativeweblogic.info/" target="_blank"> Development  Creative Web Logic</a> 
                  </div>
                </div>
          </div>
        </div>
    </div>
    <div id="LanguageMap">
    	<? include("modules/language/sitemap.php");?>
    </div>
</div>
<?php print $domain_data['Analytics']?>
</body>
</html>
