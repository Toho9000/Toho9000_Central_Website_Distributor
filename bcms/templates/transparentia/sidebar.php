<div class="sidenav">

		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>


<h1><?php _e("Main"); ?></h1>
<ul>
	<li><a href="<?php bloginfo('url');?>">Home</a></li>
<?php wp_list_pages('title_li=');?>
</ul>

<?php

$today = current_time('mysql', 1);

if ( $recentposts = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_date_gmt < '$today' AND post_type = 'post' ORDER BY post_date DESC LIMIT 8")):

?>

<h1><?php _e("Recent Posts"); ?></h1>

<ul>

<?php

foreach ($recentposts as $post) {

if ($post->post_title == '')

$post->post_title = sprintf(__('Post #%s'), $post->ID);

echo "<li><a href='".get_permalink($post->ID)."'>";

the_title();

echo '</a></li>';

}

?>

</ul>

<?php endif; ?>






		<h1><?php _e('Categories:'); ?></h1>

		<ul>

		<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>

		</ul>

		<?php if ( is_home() ) { ?>

		<h1><?php _e('Blogroll'); ?></h1>

		<ul>

		<?php wp_list_bookmarks('title_li=&categorize=0'); ?>

		</ul>

		<?php } ?>

		<h1><?php _e('Archives:'); ?></h1>

		<ul>

		<?php wp_get_archives('type=monthly'); ?>
		</ul>

		<h1><?php _e('Search:'); ?></h1>

		<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input type="submit" id="sidebarsubmit" value="Search" />

		</form>


	
		<h1><?php _e('Meta:'); ?></h1>

		<ul>

		<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>

		<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>

		<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>

		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>

		<?php wp_meta(); ?>

		</ul>

		
<?php endif; ?>

		</div>
	
		<div class="clearer"><span></span></div>

