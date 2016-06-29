<footer role="contentinfo">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo"><?php bloginfo( 'name' ); ?></a>
		<div class="footer-details">
			<div class="org-info">
				<?php echo ot_get_option('footer_about'); ?>
				<ul class="social">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
			<div class="footer-nav">
				<?php
	                $args = array(
						'menu' => 'Main Nav',
	                    'container' => 'false',
	                    'items_wrap' => '<ul>%3$s</ul>',
	                    );
	                wp_nav_menu($args);
	            ?>
			</div>
			<div class="org-info location">
				<p><i class="fa fa-map-marker"></i>734 N. Highland Ave NE, Suite 7<br />Atlanta, GA 30306</p>
				<p><i class="fa fa-phone"></i>(470) 363-3839</p>
				<p><i class="fa fa-paper-plane"></i><a href="mailto:info@deltaleadership.com">info@deltaleadership.com</a></p>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script src="<?php echo bloginfo('template_directory'); ?>/assets/js/scripts.min.js"></script>

<?php if ( is_singular() ) wp_print_scripts( 'comment-reply' ); ?>
</body>
</html>
