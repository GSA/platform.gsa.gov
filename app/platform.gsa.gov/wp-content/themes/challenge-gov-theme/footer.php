<?php st_before_footer();?>

<?php wp_footer();?>

<?php st_after_footer();?>


<!-- start challenge gov template -->

    <!--Tweet Posts Area-->
<div class="clearfix">
	<div class="row-fluid text-center">
		<div class="tweetposts">
		    <div class="twitter-bird">	        
		    </div>
		<div class="col-md-8 tweetposts-display">
		   <?php //do_shortcode('[twitter-timeline id=585531672814350336 username=challengegov]'); ?>
		   <?php get_sidebar('challenge-footer'); ?>
		</div>
		<div class="col-md-2 social-accounts">
		    <p class="txt-railway">Connect With Us:</p>        
		        <a href="https://www.facebook.com/ChallengeGov"><i id="social" class="fa fa-facebook-square fa-3x social-fb"></i><span class="sr-only">Follow us on facebook</span></a>
			    <a href="https://twitter.com/ChallengeGov"><i id="social" class="fa fa-twitter-square fa-3x social-tw"></i><span class="sr-only">Follow us on Twitter</span></a>
			    <a href="mailto:challenge@gsa.gov"><i id="social" class="fa fa-envelope-square fa-3x social-em"></i><span class="sr-only">Email us</span></a>
	    </div>
	</div>
	</div>
</div>
	<footer>
	    <ul>
	        <li><a href="<?php echo site_url('privacy-policy'); ?>">Privacy</a></li>
	        <li><a href="<?php echo site_url('accessibility'); ?>">Accessibility</a></li>
	    </ul>
         <div><a href="<?php echo site_url('terms-of-use'); ?>/" title="Challenge.gov Terms of Use" style="font-size:1em;font-weight:bold;">Terms of Use - Challenge.gov</a></div>
	    <div>Challenge.gov is an official U.S. government website, administered by the U.S. General Services Administration</div>
	</footer>
	<?php
	if(strpos(get_site_url('http'), "https://staging.platform") !== false)
	{
	?>
		<script type="text/javascript">
		  jQuery( document ).ready(function( $ ) {
		      var year = 0;
		      var month = 0;
		      $("img").each(function() {
		          if($(this).attr('src').indexOf("/blogs.dir///files/") > -1) {
		              var rep = false;
		              var timeStart = $(this).attr('src').indexOf("/blogs.dir///files/") + 29;
		              
		              year = parseInt($(this).attr('src').substring(timeStart, timeStart + 4));
		              month = parseInt($(this).attr('src').substring(timeStart + 5, timeStart + 7));
		              
		              if(year < 2015) rep = true;
		              if(year == 2015 && month < 8) rep = true;
		              
		              if(rep)
		                  $(this).attr('src', $(this).attr('src').replace('/blogs.dir///files/', '/uploads'));
		          }
		      });
		  });
		</script>
	<?php
	}
	?>
	<!-- end challenge gov template -->

</body>
</html>
