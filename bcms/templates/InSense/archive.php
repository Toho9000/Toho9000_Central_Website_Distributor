<?php get_header(); ?>

<!-- Side ContentWrapper START -->
<div id="ContentWrapper">

<!-- Side SC START -->
<div class="SC">

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="pagetitle">Archive for the &#8216;<?php echo single_cat_title(); ?>&#8217; Category</h2>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2 class="pagetitle">Author Archive</h2>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="pagetitle">Blog Archives</h2>
<?php } ?>


<div class="Nav" style="margin-bottom: 20px;">
<?php posts_nav_link('','','<span class="Prev">Previous Entries</span>') ?>
<?php posts_nav_link('','<span class="Next">Next Entries</span>','') ?>
</div>

<?php while (have_posts()) : the_post(); ?>
<div class="Post" style="padding-bottom: 50px;">

<div class="PostHead">
 <h1><a href="#"></a><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
 <p class="PostDate">
   <strong class="day"><?php the_time('d'); ?></strong>
   <strong class="month"><?php the_time('M'); ?></strong>
 </p>
  <p class="PostInfo"><?php edit_post_link('Edit', ''); ?> Posted by: <?php the_author() ?> in: <?php the_category(', ') ?> <?php edit_post_link('Edit', ''); ?></p>
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
<?php include ($template_data['TEMPLATEPATH'] . '/searchform.php'); ?>

<?php endif; ?> 
</div>
<!--  Side SC END -->

</div>
<!--  Side ContentWrapper END -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
