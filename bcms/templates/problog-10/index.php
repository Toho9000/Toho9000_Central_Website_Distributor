
<?php get_header(); ?>	
	<div id="wrapper">
	
		<div id="content-wrapper">
		
			<div id="content">
			
			
			
				<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>

		
				<div class="post-wrapper">
				

					<div class="date">
						<span class="month"><?php the_time('M') ?></span>
						<span class="day"><?php the_time('j') ?></span>
					</div>

					<div style="float: right; width: 410px; clear: right; margin-top: 15px; margin-bottom: 15px; padding-top: 10px;">
			<span class="titles"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></span>
</div>

			<div class="post">

			<?php the_content('Read the rest of this entry &raquo;'); ?>

			</div>
			
			

			</div>

			

			<?php endwhile; ?>

			   <p class="pagination"><?php next_posts_link('&laquo; Previous Entries') ?> <?php previous_posts_link('Next Entries &raquo;') ?></p>

			<?php else : ?>

			<h2 align="center">Not Found</h2>

			<p align="center">Sorry, but you are looking for something that isn't here.</p>

			<?php endif; ?>
			
			
	
			</div>
		
		</div>
		<?php get_sidebar(); ?>    
		<div id="footer">
 
 <p>Template by: <a href="http://www.makequick.com">Website Builder</a> | <a href="http://bubblecms.biz/">Powered By Bubble CMS Lite</a> | <a href="http://creativeweblogic.info/">Solution By Creative Web Logic</a></p> 
        </div>

		</div>
	<?php print $domain_data['Analytics']?>
</body>
</html>