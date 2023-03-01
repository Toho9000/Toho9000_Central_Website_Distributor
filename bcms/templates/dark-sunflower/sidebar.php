<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>

<div class="menu">
<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div>
<input class="sidebar-search" type="text" name="s" id="s" value="Search the Blog..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><br />
<input class="sidebar-submit" type="submit" id="sidebar-submit" value="Go" />
</div>
</form>
</div>

<!-- uncomment this to add an about section
<div class="menu">
<h2 class="menu-header"><?php _e('About'); ?></h2>
<p>This is the area where you can write a description of yourself or your blog.</p>
</div>
-->

<!-- uncomment this to add the calendar to your sidebar
<div class="menu">
<h2 class="menu-header"><?php _e('Calendar'); ?></h2>
<?php get_calendar(); ?>
</div>
--> 

<div class="menu">
<h2 class="menu-header"><?php _e('Subscribe'); ?></h2>
<ul class="menu-feed">
<li><a href="<?php bloginfo('rss_url'); ?>" title="Subscribe To This Feed (RSS 2.0)">Subscribe now with RSS</a> to receive a regular dosage of blog from <?php bloginfo('name'); ?>.</li>
</ul>
</div>

<div class="menu">
<h2 class="menu-header"><?php _e('Categories'); ?></h2>
<ul>
<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&title_li='); ?>
</ul>
</div>

<div class="menu">
<h2 class="menu-header"><?php _e('Meta'); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://validator.w3.org/check/referer" title="Check The Validity Of This Site's XHTML"><abbr title="eXtensible HyperText Markup Language">XHTML 1.1</abbr></a></li>
<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php bloginfo('url'); ?>" title="Check The Validity Of This Site's CSS" rel="external">CSS</a></li>
<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
<?php wp_meta(); ?>
</ul>
</div>

<?php endif; ?>