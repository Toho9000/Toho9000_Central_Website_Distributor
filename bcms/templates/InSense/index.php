<?php get_header(); ?>

<!-- Side ContentWrapper START -->
<div id="ContentWrapper">

<!-- Side SC START -->
<div class="SC">
<?php $countervariable=1; if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<div class="Post" style="padding-bottom: 50px;">

<div class="PostHead">
 <h1><a href="#"></a><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
 <p class="PostDate">
   <strong class="day"><?php the_time('d'); ?></strong>
   <strong class="month"><?php the_time('M'); ?></strong>
 </p>
  <p class="PostInfo">Posted by: <?php the_author() ?> in: <?php the_category(', ') ?> <?php edit_post_link('Edit', ''); ?></p>
</div>
  
<div class="PostContent">

<? if (is_home() && (!$paged || $paged == 1) || is_search() || is_single() || is_page()): ?> 
<?php the_content('Read the rest of this entry &raquo;'); ?>
<? else: ?><?php the_excerpt() ?><? endif; ?>
 </div>
 
<ul class="PostCom">
 <li><?php comments_popup_link('<strong>0</strong> Comments', '<strong>1</strong> Comment', '<strong>%</strong> Comments'); ?></li>
</ul>

</div>
<!-- Post END -->


<?php endwhile; ?>
<div class="Nav">
<?php posts_nav_link('','','<span class="Prev">Previous Entries</span>') ?>
<?php posts_nav_link('','<span class="Next">Next Entries</span>','') ?>
</div>
<?php else : ?>

<h2 class="center">Not Found</h2>
<p class="center"><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>

<?php endif; ?> 
</div>
<!--  Side SC END -->

</div>
<!--  Side ContentWrapper END -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
