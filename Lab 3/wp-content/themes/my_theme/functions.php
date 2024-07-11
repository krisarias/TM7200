<?php
if(!defined('ABSPATH'))exit;

// Enqueue styles and scripts
function my_theme_styles() {
    wp_enqueue_style('my-styles', get_stylesheet_directory_uri() . '/styles/css/styles.css', array());
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function my_theme_scripts() {
    wp_enqueue_script('slickNavScript',"https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.0/jquery.slicknav.js", array(), null, true);
    wp_enqueue_style('slickNavStyles',"https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.0/slicknav.min.css", array(), null, true);
   
    wp_enqueue_script('my_script', get_stylesheet_directory_uri() . '/scripts/my_script.js', array('slickNavScript'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

// Register menus
register_nav_menus(array(
    'main-menu' => esc_html__('Main Menu', 'my_theme'),
    'footer-menu' => esc_html__('Footer Menu', 'my_theme'),
    'social-menu' => esc_html__('Social Menu', 'my_theme')
));

// Theme support for custom logo
function my_theme_logo_setup() {
    $defaults = array(
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'my_theme_logo_setup');

// Remove width and height attributes from custom logo
function my_theme_logo_class($html) {
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}
add_filter('get_custom_logo', 'my_theme_logo_class');