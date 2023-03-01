<?php get_header(); ?>

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" class="post">
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div class="entry">
<?php the_content(); ?>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
<?php edit_post_link('Edit', '<p>', '</p>'); ?>
</div><!-- entry -->

</div><!-- post -->

<?php endwhile; ?>

<div id="comments-template">
<?php comments_template(); ?>
</div>

<?php endif; ?>

<?php get_footer(); ?>