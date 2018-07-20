<?php
/**
 * The template for displaying the footer.
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */
 
?>
			

        
        <!-- FOOTER -->
        <div id="outerfooter">
        	<div id="footercontainer">
                <div class="container">
                    <div class="row">
						<footer id="footer">
                        <div class="twelve columns">
                            <div class="copyright">
                                <?php esc_html_e( 'Copyright', 'minibuzzts'); echo ' &copy; ';
                                echo date_i18n(esc_html__('Y','minibuzzts')) . ' <a href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo('name') .'</a>.';
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    	</footer>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER -->
        
	</div><!-- end outercontainer -->
</div><!-- end bodychild -->


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
