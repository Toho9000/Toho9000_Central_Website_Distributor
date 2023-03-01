<?php
	function fourOhFour() {
		echo
		"<h2>Not Found</h2>\n
		<p>Sorry, but you are looking for something that isn't here. Try searching for what you were looking for, or checking the archives.</p>";
	}
	
	if(function_exists('register_sidebar')) { register_sidebar(); }
?>