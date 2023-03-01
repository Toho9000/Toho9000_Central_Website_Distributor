<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			
			<div class="post-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<h3>Posted on <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></h3>
			</div>

			<div class="post-content">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div>
			
			<?php comments_template(); ?>
		</div>

	<?php endwhile; else: ?>

		<?php fourOhFour(); ?>

<?php endif; ?>

	</div>
	
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
