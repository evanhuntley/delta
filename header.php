<?php ?>
<!DOCTYPE html>
<html>
<head>
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );
	?>
</title>
<meta name="description" content="<?php if ( is_single() ) {
	single_post_title('', true);
	} else {
	bloginfo('name'); echo " - "; bloginfo('description');
	}
?>" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="ClearType" content="true" />

<!-- The little things -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo bloginfo('template_directory'); ?>/favicon.png">
	<link rel="apple-touch-icon" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-precomposed.png"/>
<!-- The little things -->

<!-- Stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:400,600" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/assets/css/style.css" />
<!-- Stylesheets -->

<!-- Load scripts quick smart -->

<!-- Load scripts quick smart -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">
	<div class="access-nav">
		<div class="container">
			<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart"></i><span><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></a>
			<ul class="user-links">
				<li><a href="/register">Register</a></li>
				<?php if ( rcp_is_active()) : ?>
					<li><a href="<?php echo wp_logout_url( home_url() ); ?> ">Logout</a></li>
				<?php else : ?>
					<li><a href="/login">Login</a></li>	
				<?php endif; ?>
			</ul>
			<ul class="social">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="/feed"><i class="fa fa-rss"></i></a></li>
			</ul>
			<?php
				$args = array(
					'menu' => 'Access Nav',
					'container' => false,
					'items_wrap' => '<ul>%3$s</ul>',
					);
				wp_nav_menu($args);
			?>
		</div>
	</div>
    <header role="banner">
		<div class="container">
	        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo"><?php bloginfo( 'name' ); ?></a>
			<a class="nav-toggle" href="#"><span></span></a>
	        <nav role="navigation">
	            <?php
	                $args = array(
						'menu' => 'Main Nav',
	                    'container' => false,
	                    'items_wrap' => '<ul>%3$s</ul>',
	                    );
	                wp_nav_menu($args);
	            ?>
	        </nav>
	        <?php //get_search_form(); ?>
		</div>
    </header>
