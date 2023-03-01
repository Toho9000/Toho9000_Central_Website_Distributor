<?php
$log->general("-ax Inside Template->",3);
//print_r($domain_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print $content_data['db']['Meta_Title'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['db']['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['db']['Meta_Description'];?>" />
<meta name="keywords" content="<?php //print $content_data['db']['Meta_Keywords'];?>" />
<?php print $domain_data['db']['GSiteMapMeta'];?>
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/bubblelite/css/general.css" rel="stylesheet" type="text/css" />
<link REL="SHORTCUT ICON" HREF="<?php print $app_data['asset-sever']; ?>bcms/templates/bubblelite/favicon.ico">
</head>

<body>
	<div id="MainBodyCentered">
    	<div id="HeaderHolder">
            <div id="HeaderLogo">
        
            </div>
            <div id="MainMenu">
        		<div id="navigation">
                <?php
                $menu_file=$app_data['MODULEBASEDIR']."menu/horizontal-rounded.php";
                $log->general("6 Loading Current Templates->".$menu_file,3);
                include($menu_file);
                ?>
                </div>
            </div>
            <div id="HeaderImage">
        
            </div>
        </div>
        <div id="ContentHolder">
    		<div id="ContentBody">
            	<div id="LeftColumn">
            	  <h2><?php print $content_data['db']['Title'];?></h2>{{test}}{{menu}}
                <?php
                    //$display_file=$app_data['MODULEBASEDIR']."content/display.php";
                    $display_file=$app_data['MODULEBASEDIR']."content/display.php";
                    //$display_file="";
                    print $display_file;
                    if(file_exists($display_file)){
                      $log->general("10 Loading Current Content->".$display_file,3);
                      include($display_file);
                    }else{

                      print "Error No File";
                    }
                 ?>
              
    			</div>  
              <div id="RightColumn">
              <?php
                include($app_data['MODULEBASEDIR']."news/list-items.php");
                ?>
              </div>
                <div style="clear:both"></div>
    		</div>
            <div id="ContentFooter">
    
    		</div>
    	</div>
        <div id="FooterHolder">
        	<div id="FooterContent">
        		<div id="FooterLinks">
       			<a href="http://creativeweblogic.info/">Website Design Development Promotion CreativeWebLogic</a>
                </div>
                
        	</div>
        </div>
    </div>
    <?php print $domain_data['Analytics']?>
</body>
</html>
