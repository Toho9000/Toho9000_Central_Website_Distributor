<!DOCTYPE html>
<!--
Template Name: Academic Education V2
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html>
<head>
<title><?php print $content_data['Meta_Title'];?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="DC.Title" content="<?php print $content_data['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/assets/favicon.ico' />

<?php print $domain_data['GSiteMapMeta'];?>
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/academic-education/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <nav>
      <ul>
        <li><a href="http://bubblecms.biz/">Bubble CMS</a></li>
        <li><a href="http://smoothbuild.website/">Website Builder</a></li>
        <li><a href="http://creativeweblogic.info/">Website Design Development Promotion</a></li>
        
      </ul>
    </nav>
    <!-- ################################################################################################ --> 
  </div>
</div>

  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      
    </div>
    <div class="fl_right">
      <form class="clear" method="post" action="#">
        <fieldset>
          <legend>Search:</legend>
          <input type="text" value="" placeholder="Search Here">
          <button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
        </fieldset>
      </form>
    </div>
    <!-- ################################################################################################ --> 
  </header>
</div>

<div class="wrapper row2">
  <div class="rounded">
    <nav id="mainav" class="clear" style="align:left;"> 
      <!-- ################################################################################################ -->
      
        <? include($app_data['MODULEBASEDIR']."menu/li-menu.php");?>
        
      <!-- ################################################################################################ --> 
    </nav>
  </div>
</div>

<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
      <div class="group btmspace-30"> 
        <!-- Left Column -->
        
        <!-- / Left Column --> 
        <!-- Middle Column -->
        <div class="one_half"> 
          <!-- ################################################################################################ -->
          <h2><?php print $content_data['Title'];?></h2>
                <? include($app_data['MODULEBASEDIR']."content/display.php");?>
          <!-- ################################################################################################ --> 
        </div>
        <!-- / Middle Column --> 
        <!-- Right Column -->
        <div class="one_quarter sidebar"> 
          <!-- ################################################################################################ -->
          <?
                        if(count($sidebar_data)>0){
                            ?>
                                <div id="SideBar" >
                                
                                <? include($app_data['MODULEBASEDIR']."/content/sidebar.php");?>
                                </div>
                            <?
                        }
                    ?>
          <!-- ################################################################################################ --> 
        </div>
        <!-- / Right Column --> 
      </div>
      
      <div class="clear"></div>
    </main>
  </div>
</div>

<div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="http://creativeweblogic.net">Website Design Develop Host Promotion</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.bubblecms.biz" title="Free Website Builder">Bubble CMS</a></p>
    <!-- ################################################################################################ --> 
  </div>
</div>
<!-- JAVASCRIPTS --> 
<script src="layout/scripts/jquery.min.js"></script> 
<script src="layout/scripts/jquery.fitvids.min.js"></script> 
<script src="layout/scripts/jquery.mobilemenu.js"></script> 
<script src="layout/scripts/tabslet/jquery.tabslet.min.js"></script>
</body>
</html>