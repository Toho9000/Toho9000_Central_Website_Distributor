<!-- Side Right - START -->
<div class="SR">

<!-- START Search -->
<div class="Search">
 <h3>Search</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
     <input type="text" name="s" class="keyword" style="width: 198px;" />
    </form>
 <div class="SearchCorner"></div>
</div>
<!-- END Search -->
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
<!-- START Categories -->  
  <div class="Categories">
   <h3>Categories</h3>
    <ul>
      <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?> 
   </ul>
   <div class="CategoriesCorner"></div>
   </div>
<!-- END Categories -->

<!-- START General -->
<div class="General Archives">   
 <h3>Archives</h3>
  <ul>
   <?php wp_get_archives('type=monthly'); ?>
  </ul>
 <div class="GeneralCorner"></div>
</div>
<!-- END General -->
   
<!-- START Links -->   
  <div class="General Links">
   <h3>Links</h3>
    <ul>
     <?php get_links('-1', '<li>', '</li>', '', FALSE, 'id', FALSE, 
FALSE, -1, FALSE); ?>

    </ul>
	<div class="GeneralCorner"></div>
   </div>
<!-- END Links -->


<!-- START Links -->   
  <div class="General Calendar">
   <h3>Calendar</h3>
     <?php get_calendar(daylength); ?>
	<div class="GeneralCorner"></div>
   </div>
<!-- END Links -->
<?php endif; ?>
</div> 
<!-- Side Right - END -->
