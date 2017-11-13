<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

<div class="sixteen columns homeHero">
    <div class="row">
        <div class="eight columns alpha">
            <h2>Pursuant to Executive Order 13639, the Presidential Commission on Election Administration has submitted its Report and Recommendations to the President.</h2>
            <div class="row action-buttons">
                <a href="https://www.supportthevoter.gov/files/2014/01/Amer-Voting-Exper-final-draft-01-09-14-508.pdf" target="_blank" class="button blue-button call-to-action">Download the Full Report</a>
                <a href="#" id="anchor-link" class="button red-button omega call-to-action">See the Toolkit</a>
            </div>
        </div>
        <div class="eight columns omega">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/book-cover.png" alt="Book Cover">
        </div>
    </div>
</div>

<div class="sixteen columns bannerStripe">
	<div id='banner-slider'>
		<div class='swipe-wrap'>
			<?php query_posts('tag=homepage-banner&posts_per_page=3&order=ASC'); ?>
			<?php if ( have_posts() ) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div id="slide-post-<?php the_ID();?>">
						<a href="<?php echo get_the_content(); ?>" title="Click to Read More">
							<h3><?php the_title();?></h3> 
							<?php $cc = get_the_content();
								if($cc != '') { ?>
									<span class="rd-more-button">Read more</span>
								<?php } ?>	
						</a>
					</div>
				<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>	
		</div>
	</div>
</div>
<div class="sixteen columns section sectionBlue guidingPrinciples">
<h2>The Commission's key recommendations call for:</h2>
    <div class="row">
        <div class="eight columns alpha recommendation">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon1.png">
            <p>Modernization of the registration process through continued expansion of online voter registration and expanded state collaboration in improving the accuracy of voter lists</p>
        </div>
        <div class="eight columns omega recommendation">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon3.png">
            <p>Measures to improve access to the polls through multiple opportunities to vote before the traditional Election Day and the selection of suitable, well-equipped polling place facilities, such as schools</p>
        </div>
    </div>
    <div class="row">
        <div class="eight columns alpha recommendation">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon4.png">
            <p>State-of-the-art techniques to assure efficient management of polling places,
                including tools the Commission is publicizing and recommending for the efficient allocation of
                polling place resources</p>
        </div>
        <div class="eight columns omega recommendation">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon2.png">
            <p>Reforms of the standard-setting and certification process for new voting technology to address soon-to-be antiquated voting machines and to encourage innovation and the adoption of widely available off-the-shelf technologies</p>
        </div>
    </div>
    <div class="row action-buttons">
        <a href="https://www.supportthevoter.gov/files/2014/01/Amer-Voting-Exper-final-draft-01-09-14-508.pdf" target="_blank" class="button white-button call-to-action">Download the Full Report</a>
        <a href="https://supportthevoter.gov/appendix/" class="button white-button omega call-to-action">View the Appendix</a>
    </div>
</div>

<div class="sixteen columns section sectionRed bottomHero">
    <h2>Election Toolkit</h2>
    <p class="intro-text">Tools that can assist local election officials allocate Election Day resources to avoid long
        lines at the
        polling place and transition to online voter registration.</p>
    <div class="row">
        <div class="eight columns alpha">
            <div class="tool-group">
                <h3> Calculators</h3>
                <ul>
                    <li><a href="http://web.mit.edu/vtp/calc1.html" target="_blank">Line Optimization and Poll Worker Management<span></span></a></li>
                    <li><a href="http://web.mit.edu/vtp/calc2.html" target="_blank">Poll Worker and Machine Optimization<span></span></a></li>
                    <li><a href="http://web.mit.edu/vtp/calc3.html" target="_blank">Line Optimization<span></span></a></li>
                </ul>
            </div>
        </div>
        <div class="eight columns omega">
            <div class="tool-group">
                <h3>Online Voter Registration</h3>
                <ul>
                    <li><a href="http://web.mit.edu/vtp/ovr1.html" target="_blank">OVR Tools<span></span></a></li>
                    <li><a href="http://web.mit.edu/vtp/ovr2.html" target="_blank">Platform for Designated Partners<span></span> </a></li>
                    <li><a href="http://web.mit.edu/vtp/ovr3.html" target="_blank">Open Source Voter Registration Software<span></span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row action-buttons" id="bottomAction">
        <a href="http://web.mit.edu/vtp/" target="_blank" class="button white-button call-to-action">Visit the Voting
        Technology Project</a>
    </div>
</div>
 
  
<?php get_footer(); ?>