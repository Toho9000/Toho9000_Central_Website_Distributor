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
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/css/general.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table align="center">
<tr>
<td>
<div id="MainBody" align="center">
	<div id="Header">
    	<div id="HeaderBanner"><br />
    	  <br />
   	    <img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/images/bubblecmslite-logo.jpg" width="478" height="58" alt="Bubble CMS Lite - Manage Multiple Websites" /></div>
      <div id="MainMenu">
        <div id="MainMenuCenter"><? include($app_data['MODULEBASEDIR']."menu/horizontal.php");?></div>
            <div id="DivClear"></div>
      </div>
        <div id="BelowMainMenu">
        	<div id="BelowMainMenuLeft">
           	  <img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/images/belowmenuleft.jpg" alt="Multiple domain website management" />
            </div>
        	<div id="BelowMainMenuRight"><img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/images/belowmenuright.jpg" width="4" height="15" alt="manage multiple domains from one administration" />
            
            </div>
            <div id="DivClear"></div>
        </div>
    </div>
    <div id="DivClear"></div>
    <div id="MainTextBody">
    	<div id="MainBodyTopLeft">
        	<img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/images/mainbodypic.jpg" width="652" height="289" alt="Manage multiple languages and websites from a single place" />
        </div>
        <div id="MainBodyTopRight">
            <div id="MainBodyTopRightNewsTop">
            	<img src="<?php print $app_data['asset-sever']; ?>bcms/templates/bcmsl/images/newstopgreyrightcorner.jpg" width="5" height="14" alt="bubble cms with news and member modules" />
            </div>
            <div id="DivClear"></div>
            <div id="NewsHeading">
           	  <strong>Latest News</strong>
          </div>
            <div id="NewsBody">
            	<? include($app_data['MODULEBASEDIR']."news/list-items.php");?>
            </div>
        </div>
        <div id="DivClear">
        </div>
        <div id="MainBodyText">
        	<h1 class="PageTitle">
				<?php print $content_data['Title'];?>
            </h1>
            <div>
			<? include($app_data['MODULEBASEDIR']."content/display.php");?>     
             </div>
             
        </div>
        <div id="DivClear">
    </div>
    <div id="FooterTop">
        <div id="MainMenu">
            <div  id="MainMenuCenter">
                <strong>
                    <span  id="FooterText" style="color:#FFF;">
                        &copy; Creative Web Logic Network 
                    </span>
                    | <a href="http://creativeweblogic.net/" >Website Design Development Programming Promotion</a>
                    | <a href="http://cpanel-hosting.info/" >Hosting</a>
                    | <a href="http://smoothbuild.website/" >Website Builder</a>
                </strong>
            </div>
        </div>
    </div>
    <div id="DivClear">
    </div>
      
</div>
</td>
</tr>
<tr>
<td>

</td>
</tr>
</table>

<?php print $domain_data['Analytics']?>
</body>
</html>
