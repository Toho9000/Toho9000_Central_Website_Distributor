<?
	function get_header(){
		include(TEMPLATEPATH."/header.php");
	}
	$post_count=0;
	function have_posts(){
		global $post_count;
		$post_count++;
		if($post_count<3){
			return true;
		}else{
			return false;	
		}
	}
	function the_post(){
		include(MODULEBASEDIR."content/display.php");
	}
	
	function the_title(){
		
	}
	function wp_title(){
		
	}
	function wp_get_archives(){
		
	}
	function comments_template(){
		
	}
	function next_posts_link(){
		
	}
	function previous_posts_link(){
		
	}
	
	function the_permalink(){
		
	}
	function the_time($date_string){
		return date($date_string);
	}
	function the_author(){
		
	}
	function the_category($divider){
		
	}
	function edit_post_link($command, $extra){
		
	}
	$paged=1;
	function is_home(){
		return true;
	}
	function is_search(){
		
	}
	function is_single(){
		
	}
	function is_page(){
		return true;
	}
	function the_content($variable){
		
	}
	function the_excerpt(){
		
	}
	function comments_popup_link($text){
		
	}
	function posts_nav_link($var0,$var1,$var2){
		
	}
	function _e($errorText){
		
	}
	function get_sidebar(){
		
	}
	function get_footer(){
		include(TEMPLATEPATH."/footer.php");
	}
	function wp_footer(){
		
	}
	function bloginfo($varname){
		switch ($varname){
			case 'template_url':
				print TEMPLATEDIR;
			break;
			case 'stylesheet_url':
				print TEMPLATEDIR."/style.css";
			break;
			default:
				print "";
			break;
		};
	}
	function get_option($optionname){
		return "";	
	}
	function wp_head(){
		
	}
	function wp_loginout(){
		
	}
	function wp_list_pages(){
		global $r;
		include(MODULEBASEDIR."menu/li.php");
	}

?>