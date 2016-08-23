<?php
	require_once(get_stylesheet_directory().'/custom/shortcodes.php'); 
	require_once(get_stylesheet_directory().'/custom/language.php'); 
	add_action('after_setup_theme', ea_setup);

	add_image_size('reach_featured_image', 750, 450, false);
	add_image_size( 'facebook_share', 1200, 630, true );
	function ea_setup() {
	/**  ea_setup
	*  init stuff that we have to init after the main theme is setup.
	* 
	*/
		add_filter( 'image_size_names_choose', 'my_custom_sizes' );
	}
 
	function my_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'reach_featured_image' => __( 'Reach Blog Featured' ),
	    ) );
	}
	add_filter('wpseo_opengraph_image_size', 'mysite_opengraph_image_size');
	function mysite_opengraph_image_size($val) {
		return 'facebook_share';
	}

	require_once(get_stylesheet_directory().'/custom/reach-testimonials.php');
	function filter_media_comment_status( $open, $post_id ) {
		$post = get_post( $post_id );
		if( $post->post_type == 'attachment' ) {
			return false;
		}
		return $open;
	}
	add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

		/* short code to only display content if mobile */
	add_shortcode('mobile_only', 'zig_is_mobile');
	function zig_is_mobile($atts, $content) {
		if (wp_is_mobile()) {
			return $content;
		} else {
			return "";
		}
	}

	/* short code to only display content if desktop (really, not mobile) */
	add_shortcode('desktop_only', 'zig_is_desktop');
	function zig_is_desktop($atts, $content) {
		if (!wp_is_mobile()) {
			return $content;
		} else {
			return "";
		}
	}

	// enqueue font awesome css
	add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
	function prefix_enqueue_awesome() {
		wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
	}

?>
