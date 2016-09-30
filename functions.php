<?php

add_theme_support( 'menus' );

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name'          => __( 'Sidebar 1'),
		'id'			=> 'sidebar-1',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'          => __( 'Shop'),
		'id'			=> 'shop',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

add_post_type_support('page', 'excerpt');

function post_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>

			<p class="comment-meta">
				<?php printf( __( '%s' ), sprintf( '%s', get_comment_author_link() ) ); ?>

                <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php printf( __( '%1$s' ), get_comment_date() ); ?>
                </a>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                <?php endif; ?>
            </p>
		</div>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>

	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
	<?php

		break;
	endswitch;
}

// Custom functions

// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security

add_theme_support('post-thumbnails');

// REMOVE EXTRANEOUS CLASSES FROM WORDPRESS MENUS - siteart.co.uk/remove-extraneous-classes-from-wordpress-menus
function custom_wp_nav_menu($var) {
        return is_array($var) ? array_intersect($var, array(
                // List of useful classes to keep
                'current_page_item',
                'current_page_parent',
                'current_page_ancestor'
                )
        ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');

// REPLACE "current_page_" WITH CLASS "active"
function current_to_active($text){
        $replace = array(
                // List of classes to replace with "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<article class="shop">' .
  '<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">' .
	  '<div class="container">';
	  if(function_exists('bcn_display'))
		  {
			  bcn_display();
		  }
	  echo '</div>' .
  '</div><div class="primary container">';
}

function my_theme_wrapper_end() {
  echo '</div></article>';
}

// Menu Meta Box
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
			<p><strong>Menu</strong></p>
            <label class="screen-reader-text" for="meta-box-dropdown">Menu</label>
            <select name="meta-box-dropdown">
				<option>-- Inherit --</option>
				<?php
					$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

					foreach ( $menus as $menu ) {

						if ( $menu->name == get_post_meta($object->ID, "meta-box-dropdown", true))
						{
						    ?>
						        <option selected><?php echo $menu->name; ?></option>
						    <?php
						}
						else {
							?>
						        <option><?php echo $menu->name; ?></option>
						    <?php
						}
					}
				?>
				<option>-- None --</option>
            </select>
        </div>
    <?php
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Subnavigation", "custom_meta_box_markup", "page", "side", "low", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "page";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_dropdown_value = "";

    if(isset($_POST["meta-box-dropdown"]))
    {
        $meta_box_dropdown_value = $_POST["meta-box-dropdown"];
    }
    update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_filter( 'gform_init_scripts_footer', '__return_true' );


/*
 * Return a new number of maximum columns for shop archives
 * @param int Original value
 * @return int New number of columns
 */
function wc_loop_shop_columns( $number_columns ) {
	return 3;
}
add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );

?>
