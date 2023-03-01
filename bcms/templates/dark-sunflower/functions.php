<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<div class="menu">', // Removes <li>
		'after_widget' => '</div>', // Removes </li>
		'before_title' => '<h2 class="menu-header">', // Replaces <h2>
		'after_title' => '</h2>', // Replaces </h2>
	));
?>