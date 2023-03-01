<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $content_data['Meta_Title'];?></title>
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel="alternate" type="application/rss+xml" title="<?php print $domain_data['rss_title']?>" href="/rss/" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />
<?php print $domain_data['GSiteMapMeta'];?>

<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/periscope/css/general.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="BodyContainer">
		<div id="ContentContainer">
            <div id="HeaderContainer<?=rand(1,4);?>">
            	<div id="MainMenu">
                	<? include($app_data['MODULEBASEDIR']."/menu/horizontal.php");?>
                </div>
            </div>
            <div id="BodyText">
            	<div id="LeftColumnText">
                	<h1 class="HeadingText"><?php print $content_data['Title'];?></h1>
           		  	<? include($app_data['MODULEBASEDIR']."/content/display.php");?>
                </div>
                <div id="RightColumnText">
                
                	<?
                        if(count($sidebar_data)>0){
                            ?>
                                <div id="SideBar" >
                                
                                <? include($app_data['MODULEBASEDIR']."/content/sidebar.php");?>
                                </div>
                            <?
                        }
                    ?>
              	</div>
                <div style="clear:both">
                    </div>
            </div>
            <div id="FooterContainer">
             	<div id="CreationLinks">
                	<div id="LeftSideLinks">
                    	<a href="http://bubblecms.biz/" target="_blank">Powered By Bubble CMS Lite</a> | <a href="http://creativeweblogic.info/" target="_blank">Website Development Creative Web Logic</a>  | <a href="http://idahodesign.com/" target="_blank">Graphic Design Idaho Design</a>
                    </div>
                    <div id="RightSideLinks">
                    <span class="LightGreen">
                	© 2009 Copyright Periscope Consulting | 
                    </span>
                    <span class="LightRed">
                      <a href="/privacy-policy/">Please view our Privacy &amp; Disclaimer Agreements</a> </span>
                </div>
                    <div style="clear:both">
                    </div>
                </div>
                
             </div>
            <div id="FooterBottom">
            
            </div>
		</div>
	</div>
    <?php print $domain_data['Analytics']?>
</body>
</html>