<?php get_header(); ?>

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" class="post">
<h2><span class="date"><?php the_time("m.d.y") ?></span> | <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<h4><?php _e('Posted in'); ?> <?php the_category(', ') ?> <?php _e('at'); ?> <?php the_time(); ?></h4>

<div class="entry">
<?php the_content(); ?>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
</div><!-- entry -->

<p class="postmetadata">
<?php _e('Filed under&#58;'); ?> <?php the_category(', ') ?> 
<?php edit_post_link('Edit', ' &#124; ', ''); ?>
</p>

</div><!-- post -->

<?php endwhile; ?>

<div id="comments-template">
<?php comments_template(); ?>
</div>

<div class="navigation">
<span class="previous"><?php previous_post_link('&laquo; %link'); ?></span>
<span class="next"><?php next_post_link(' %link &raquo;'); ?></span>
</div>

<?php endif; ?>

<?php get_footer(); ?>