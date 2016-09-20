		<footer class="main-footer">
			<div class="container">
		        <div class="row footer-widgets-row">
		            <div class="col-sm-3">
		                <div class="widget-foot">
		                    <?php if (is_active_sidebar( 'footer_box_1' )) { ?>
		                        <?php dynamic_sidebar( 'footer_box_1' ); ?>
		                    <?php }?>
		                </div>
		            </div>
		            <div class="col-sm-3">
		                <div class="widget-foot">
		                    <?php if (is_active_sidebar( 'footer_box_2' )) { ?>
		                        <?php dynamic_sidebar( 'footer_box_2' ); ?>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="col-sm-3">
		                <div class="widget-foot">
		                    <?php if (is_active_sidebar( 'footer_box_3' )) { ?>
		                        <?php dynamic_sidebar( 'footer_box_3' ); ?>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="col-sm-3">
		                <div class="widget-foot">
		                    <?php if (is_active_sidebar( 'footer_box_4' )) { ?>
		                        <?php dynamic_sidebar( 'footer_box_4' ); ?>
		                    <?php } ?>
		                </div>
		            </div>
		        </div>
		        <p class="credit">Venture <?php _e('by', 'venture-lite' );?> <a href="http://www.nimbusthemes.com/">Nimbus Themes</a> <?php _e('powered by', 'venture-lite' );?> <a href="https://wordpress.org/">WordPress</a>
			</div>
		</footer>	
		<?php wp_footer(); ?>
	</body>
</html>
