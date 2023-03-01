<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
    'after_widget' => '',
 'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));


// WP-Trasparentia Pages Box 	
	function widget_Trasparentia_pages() {
?>

<h1><?php _e('Pages'); ?></h1>
   <ul>
<li class="page_item"><a href="<?php bloginfo('url'); ?>">Home</a></li>

<?php wp_list_pages('title_li='); ?>

 </ul>

<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Pages'), 'widget_Trasparentia_pages');


// WP-Trasparentia Search Box 	
	function widget_Trasparentia_search() {
?>
   
 <ul>
<li>
   <h1><?php _e('Search Posts'); ?></h1>
   <form id="searchform" method="get" action="<?php bloginfo('url'); ?>/index.php">
		
            <input type="text" name="s" size="18" /><br>

       
            <input type="submit" id="submit" name="Submit" value="Search" />
        
       
	</form>
 
</li>
</ul>

<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_Trasparentia_search');

// WP-Trasparentia Blogroll 	
	function widget_Trasparentia_blogroll() {
?>

<h1><?php _e('Blogroll'); ?></h1>

<ul>

<?php get_links(-1, '<li>', '</li>', '', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>

</ul>



<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Blogroll'), 'widget_Trasparentia_blogroll');
 


?>