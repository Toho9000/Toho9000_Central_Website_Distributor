<?php get_header(); ?>

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" class="post">
<h2><span class="date"><?php the_time("m.d.y") ?></span> | <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<h4><?php _e('Posted in'); ?> <?php the_category(', ') ?> <?php _e('at'); ?> <?php the_time(); ?> <?php _e('by'); ?> <?php the_author_link(); ?></h4>

<div class=”entry”>
<?php the_excerpt(); ?>
</div><!-- entry -->

<p class="postmetadata">
<?php _e('Filed under&#58;'); ?> <?php the_category(', ') ?> 
<?php edit_post_link('Edit', ' &#124; ', ''); ?> | 
<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> 
</p>

</div><!-- post -->

<?php endwhile; ?>

<div class=”navigation”>
<?php posts_nav_link(); ?>
</div>

<?php endif; ?>

<?php get_footer(); ?>