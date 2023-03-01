<ul>
<!-- This menu uses Dynamic Menu Highlighting.  To learn more, go to http://codex.wordpress.org/Dynamic_Menu_Highlighting -->

<!-- To show "current" on the home page -->
<li<?php if (is_home()) { echo " id=\"current\""; } ?>>
<a href="<?php bloginfo('url'); ?>" title="<?php _e('Home Page'); ?>"><span><?php _e('Home'); ?></span></a></li>

<!-- To show "current" on the About Page -->
<li<?php if (is_page('About')) { echo " id=\"current\""; } ?>>
<a href="<?php echo get_permalink(2); ?>" title="<?php _e('About This Site &amp; Justin Tadlock'); ?>"><span><?php _e('About'); ?></span></a></li> 

<!-- To show "current" on the Archives Page, individual posts, categories -->
<!-- uncomment and add the permalink number to your archives page
<li<?php if (is_page('Archives') || is_single() || is_archive()) { echo " id=\"current\""; } ?>>
<a href="<?php echo get_permalink(364); ?>" title="<?php _e('Browse The Blog Archives'); ?>"><span><?php _e('Archives'); ?></span></a></li>
--> 
</ul>