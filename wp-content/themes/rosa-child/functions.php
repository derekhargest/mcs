<?php
  update_option('siteurl','localhost:8888/mcs');
  update_option('home','localhost:8888/mcs');

/*
 * ===== Theme Translation =====
 * Load the translations from the child theme if present
 */
add_action( 'before_wpgrade_core', 'rosa_child_theme_setup' );
function rosa_child_theme_setup() {
	load_child_theme_textdomain( 'rosa_txtd', get_stylesheet_directory() . '/languages' );
}

/**
 * ===== Loading Resources =====
 * Add all the extra static resources of the child theme - right now only the style.css file
 */

function rosa_child_enqueue_styles() {
	// Here we are adding the child style.css while still retaining all of the parents assets (style.css, JS files, etc)
	wp_enqueue_style( 'rosa-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array('rosa-main-style') //make sure the the child's style.css comes after the parents so you can overwrite rules
	);
}

$args = array(
	'name'          => sprintf( __( 'Reservations Page Sidebar' ), $i ),
	'id'            => "sidebar-reservations",
	'description'   => '',
	'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => "</li>\n",
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => "</h2>\n",
);

function mcs_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'mcs_favicon');

register_sidebar( $args );

add_action( 'wp_enqueue_style', 'rosa-child-style' );

add_action( 'wp_enqueue_scripts', 'rosa_child_enqueue_styles' );
