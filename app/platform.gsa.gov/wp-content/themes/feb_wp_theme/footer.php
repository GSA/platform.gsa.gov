<?php
/**
 * The Footer for our theme.
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

?>
                </div> <!--col-md-12 column -->
            </div> <!--row clearfix -->
         </div> <!--container -->

    <footer id="footer" class="clearfix">
        <?php wp_footer();?>
        <div class="container text-center">
		  	<?php
                $footer_page = new WP_Query("pagename=Footer");
                while($footer_page->have_posts()) : $footer_page->the_post();
                   the_content();
                endwhile;
                wp_reset_postdata();
            ?>
        </div>
    </footer>
    </body>
</html>