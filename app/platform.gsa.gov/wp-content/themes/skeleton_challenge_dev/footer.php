<?php st_before_footer();?>

<?php wp_footer();?>

<?php st_after_footer();?>
<footer id="challenge-footer-container">
	<div id="challenge-footer">
	
	
	  <div>
	    <div class="challenge-footer-column">
		  <h3>About</h3>
		  <ul>
		    <li><a href="<?php echo site_url('about');?>">About Challenge.gov</a></li>
		    <li><a href="<?php echo site_url('info');?>">How Challenge.gov Works</a></li>
		  </ul>
		</div>

		<div class="challenge-footer-column">
		  <h3>Challenges</h3>
		  <ul>
		  	<?php
		  		//$new_challenge_link = '';
		  		//if(is_user_logged_in() && (current_user_can('create_users') || OMBMax::isAuthenticated()))
		  		//	$new_challenge_link = '<li><a href="/create-new-challenge">Create New Challenge</a></li>';
		  	?>
		    <li><a href="<?php echo site_url('post-challenges');?>">Post a Challenge</a><br></li>
		    <?php //echo $new_challenge_link; ?><li>
		    <a href="<?php echo site_url('login');?>">Admin Area</a></li>
		  </ul>
		</div>

		<div class="challenge-footer-column">
		  <h3>Legal</h3>
		  <ul>
		    <li><a href="<?php echo site_url('privacy');?>">Privacy Policy</a><br></li>
		    <li><a href="<?php echo site_url('accessibility');?>">Accessibility</a></li>
		  </ul>
		</div>

		<div class="challenge-footer-column">
		  <h3>Connect</h3>
		  <ul>
		    <li><a href="mailto:challenge@gsa.gov">Contact Us</a></li>
		    <li><a href="http://twitter.com/challengegov">Follow @ChallengeGov Twitter</a></li>
		    <li><a href="http://facebook.com/challengegov">Connect with us on Facebook</a></li>
		  </ul>
		</div>
	  </div>
	  
	  <br/>
	  <a href="http://sites.usa.gov/about/terms-policies/">Sites.Usa.Gov Terms of Use</a><br/><br/>
	  <?php
	  /*
	  if(is_user_logged_in())
	  {
	  	?>
		  	<div class="challenge-footer-column" style="width:50%;text-align:center;">
			  <h3>Challenge.Sites.Usa.Gov Agency Administrator Options</h3>
			  <ul>
			    <li><a href="/create-new-challenge">Create New Challenge</a></li>
			  </ul>
			</div>
	  	<?php
	  }
	  */
	  ?>
	  <div class="challenge-footer-info">
	      <center><p class="small">
	        Challenge.gov is an official website of the U.S. government administrated by the U.S. General Services Administration.
	      </p></center>
	  </div>
	</div>
</footer>

</body>
</html>