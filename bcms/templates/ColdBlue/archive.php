<?php get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h3>

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3>Archive for <?php the_time('F jS, Y'); ?></h3>

	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3>Archive for <?php the_time('F, Y'); ?></h3>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3>Archive for <?php the_time('Y'); ?></h3>

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3>Author Archive</h3>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3>Blog Archives</h3>

		<?php } ?>


		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			<div class="post-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<h3>Posted on <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></h3>
			</div>

			<div class="post-content">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div>
			
		</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<?php fourOhFour(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
