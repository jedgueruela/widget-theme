<?php

/**
 * Register custom navigation walker.
 */
function register_navwalker() {
    if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
        return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
    } else {
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    }
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Enqueue and load styles.
 */
function load_styles() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '4.0', 'all' );

    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array( 'bootstrap' ), '1.0', 'all' );

    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts', 'load_styles');

/**
 * Enqueue and load scripts.
 */
function load_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-slim.min.js', false, 3.2, true );

        wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', false, 1.0, true );

        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery', 'popper' ), 4.0, true );
    }
}
add_action('wp_enqueue_scripts', 'load_scripts');

/**
 * Register nav menus
 */
function register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu')
    ) );
}
add_action('init', 'register_menus');

/**
 * Register a custom post type for carousel.
 */
function bootstrap_carousel_post_type() {
    $labels = array(
        'name'               => _x( 'Sliders', 'post type general name'),
        'singular_name'      => _x( 'Slide', 'post type singular name'),
        'menu_name'          => _x( 'Bootstrap Slider', 'admin menu'),
        'name_admin_bar'     => _x( 'Slide', 'add new on admin bar'),
        'add_new'            => _x( 'Add New', 'Slide'),
        'add_new_item'       => __( 'Add Slider'),
        'new_item'           => __( 'New Slide'),
        'edit_item'          => __( 'Edit Slide'),
        'view_item'          => __( 'View Slide'),
        'all_items'          => __( 'All Slides'),
        'featured_image'     => __( 'Featured Image', 'text_domain' ),
        'search_items'       => __( 'Search Slide'),
        'parent_item_colon'  => __( 'Parent Slide:'),
        'not_found'          => __( 'No Slide found.'),
        'not_found_in_trash' => __( 'No Slide found in trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-star-half',
        'description'        => __( 'Description.'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'sliders', $args );
}
add_action( 'init', 'bootstrap_carousel_post_type' );

/**
 * Register a custom post type for projects.
 */
function project_post_type() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name'),
        'singular_name'      => _x( 'Project', 'post type singular name'),
        'menu_name'          => _x( 'Projects', 'admin menu'),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar'),
        'add_new'            => _x( 'Add New', 'Project'),
        'add_new_item'       => __( 'Add Project'),
        'new_item'           => __( 'New Project'),
        'edit_item'          => __( 'Edit Project'),
        'view_item'          => __( 'View Project'),
        'all_items'          => __( 'All Projects'),
        'featured_image'     => __( 'Featured Image', 'text_domain' ),
        'search_items'       => __( 'Search Project'),
        'parent_item_colon'  => __( 'Parent Project:'),
        'not_found'          => __( 'No project found.'),
        'not_found_in_trash' => __( 'No project found in trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'menu_icon'          => 'dashicons-star-half',
        'description'        => __( 'Description.'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'project_post_type' );

/**
 * Add office address configuration in customizer.
 */
function customizer_settings($wp_customize) {
    $wp_customize->add_setting( 'office_address', array(
        'capability' => 'edit_theme_options',
        'default' => 'New York, New York, USA',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'office_address', array(
        'type' => 'textarea',
        'section' => 'title_tagline',
        'label' => __( 'Office Address' ),
        'description' => __( 'Enter your office address' ),
    ) );
}
add_action('customize_register', 'customizer_settings');

/**
 * Register widget areas
 */
function register_widget_areas() {
 
    register_sidebar( array(
        'name'          => 'Footer Column 2',
        'id'            => 'footer-column-2',
        'before_widget' => '<div class="footer-column-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 3',
        'id'            => 'footer-column-3',
        'before_widget' => '<div class="footer-column-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 4',
        'id'            => 'footer-column-4',
        'before_widget' => '<div class="footer-column-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer Column 5',
        'id'            => 'footer-column-5',
        'before_widget' => '<div class="footer-column-5">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ) );
 
}
add_action( 'widgets_init', 'register_widget_areas' );

/**
 * Add post thumbnails support.
 */
add_theme_support( 'post-thumbnails' );
