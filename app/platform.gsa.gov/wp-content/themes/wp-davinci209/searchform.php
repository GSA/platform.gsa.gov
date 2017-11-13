<?php 

if ( !function_exists('sites_search_footer') ) :

	function sites_search_footer()
	{
		$search_option = get_blog_option(null, 'sites-select-search');
		?>
		<script type="text/javascript">
		//<![CDATA[
	      var usasearch_config = { siteHandle:"<?php echo $search_option['sites-select-search-id'];?>" };

	      var script = document.createElement("script");
	      script.type = "text/javascript";
	      script.src = "//search.usa.gov/javascripts/remote.loader.js";
	      document.getElementsByTagName("head")[0].appendChild(script);

		//]]>
		</script>
		<?php
	}

endif;

if(function_exists('sites_dashboard_select_search_install')):
	$search_option = get_blog_option(null, 'sites-select-search');
	if( $search_option['sites-select-search-status'] == 'digitalgov' && !empty($search_option['sites-select-search-id'])): ?>
	    <form accept-charset="UTF-8" action="http://find.digitalgov.gov/search" id="search_form" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
	        <input id="affiliate" name="affiliate" type="hidden" value="<?php echo $search_option['sites-select-search-id'];?>" />
	        <label for="query">Enter Search Term(s):</label>
	        <input autocomplete="off" class="usagov-search-autocomplete" id="query" name="query" type="text" />
	        <input name="commit" type="submit" value="Search" />
	    </form>
		<?php
		add_action('wp_footer','sites_search_footer');
		static $footer_include;
		if ($footer_include === NULL)
			return false;
		else
			$footer_include = true;
	else: 
		?>
		<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/" ><input type="text" value="<?php _e("Enter Search Terms", "solostream"); ?>" onfocus="if (this.value == '<?php _e("Enter Search Terms", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Enter Search Terms", "solostream"); ?>';}" size="18" maxlength="50" name="s" id="searchfield" /><input type="submit" value="<?php _e("search", "solostream"); ?>" id="submitbutton" /></form>
		<?php
	endif;
else: 
	?>
	<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/" ><input type="text" value="<?php _e("Enter Search Terms", "solostream"); ?>" onfocus="if (this.value == '<?php _e("Enter Search Terms", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Enter Search Terms", "solostream"); ?>';}" size="18" maxlength="50" name="s" id="searchfield" /><input type="submit" value="<?php _e("search", "solostream"); ?>" id="submitbutton" /></form>
	<?php
endif;
?>