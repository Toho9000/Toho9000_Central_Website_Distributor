<?php get_header(); ?>

<!-- Side ContentWrapper START -->
<div id="ContentWrapper">

<!-- Side SC START -->
<div class="SC">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Post START -->
<div class="Post">

<div class="PostHead">
 <h1><?php the_title(); ?></h1>
 <p class="PostDate">
   <strong class="day"><?php the_time('d'); ?></strong>
   <strong class="month"><?php the_time('M'); ?></strong>
 </p>
  <p class="PostInfo"><?php edit_post_link('Edit', ''); ?>  Posted by: <?php the_author() ?> in: <?php the_category(', ') ?></p>
</div>
  
<div class="PostContent">
  <?php the_content('Read the rest of this entry &raquo;'); ?>
</div>

<?php comments_template(); ?>
<?php endwhile; ?>
		
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center"><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>

<?php endif; ?> 
</div>
<!-- Post END -->
</div>
<!--  Side SC END -->
</div>
<!--  Side ContentWrapper END -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
