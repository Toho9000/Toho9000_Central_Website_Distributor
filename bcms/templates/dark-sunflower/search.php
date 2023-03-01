<?php get_header(); ?>

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" class="post">
<h2><span class="date"><?php the_time("m.d.y") ?></span> | <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<h4><?php _e('Posted in'); ?> <?php the_category(', ') ?> <?php _e('at'); ?> <?php the_time(); ?></h4>

<div class=�entry�>
<?php the_excerpt(); ?>
</div><!-- entry -->

<p class="postmetadata">
<?php _e('Filed under&#58;'); ?> <?php the_category(', ') ?> 
<?php edit_post_link('Edit', ' &#124; ', ''); ?> | 
<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> 
</p>

</div><!-- post -->

<?php endwhile; ?>

<?php else : ?>
<div class="post">
<h2><?php _e('Not Found'); ?></h2>
<div class="entry">
<p><?php _e('Sorry, but you are looking for something that isn&#39;t here.'); ?></p>
<?php include ($template_data['TEMPLATEPATH'] . '/searchform.php'); ?>
</div>
</div>

<?php endif; ?>

<?php get_footer(); ?>