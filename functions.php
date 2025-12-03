<?php
/**
 * Blue Sky 2025 Theme Functions
 * 
 * @package BlueSkye2025
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// ==============================================
// THEME SETUP & ENQUEUES
// ==============================================

/**
 * Enqueue theme scripts and styles
 */
function bluesky_enqueue_scripts() {
    wp_register_script('bluesky-custom', get_template_directory_uri() . '/scripts.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('bluesky-custom');
}
add_action('wp_enqueue_scripts', 'bluesky_enqueue_scripts');

/**
 * Theme setup
 */
function bluesky_theme_setup() {
    // Load theme textdomain for translations
    load_theme_textdomain('bluesky2025', get_template_directory() . '/languages');
    
    // Add theme support
    add_theme_support('automatic-feed-links');
    
    // Register navigation menus
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'bluesky2025')
    ));
}
add_action('after_setup_theme', 'bluesky_theme_setup');

// ==============================================
// ADMIN CUSTOMIZATION
// ==============================================

/**
 * Force dashboard to single column layout
 */
function bluesky_dashboard_single_column() {
    return 1;
}
add_filter('get_user_option_screen_layout_dashboard', 'bluesky_dashboard_single_column');
add_filter('screen_layout_columns', function($columns) {
    $columns['dashboard'] = 1;
    return $columns;
});

/**
 * Add custom dashboard widget with documentation
 */
function bluesky_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'bluesky_documentation',
        'Blue Sky Website Documentation',
        'bluesky_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'bluesky_add_dashboard_widget');

function bluesky_dashboard_widget_content() {
    echo '<div class="documentation-widget">';
    echo '<p>Website documentation and instructions:</p>';
    echo '<p><a href="https://docs.google.com/document/d/1XQ1OyRR0CjJ8L30YDJZBnE62vayP2VRTKVXeTquPNyA/edit" target="_blank" class="button button-primary">View Documentation</a></p>';
    echo '<p><em>Opens in a new window for better readability</em></p>';
    echo '</div>';
}

/**
 * Remove default dashboard widgets
 */
function bluesky_remove_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_activity', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('wp_dashboard_setup', 'bluesky_remove_dashboard_widgets');

// ==============================================
// USER PERMISSIONS & RESTRICTIONS
// ==============================================

/**
 * Remove admin menu items for non-administrators
 */
function bluesky_restrict_admin_menus() {
    if (!current_user_can('manage_options')) {
        remove_menu_page('tools.php');
        remove_menu_page('edit-comments.php');
    }
}
add_action('admin_menu', 'bluesky_restrict_admin_menus');

/**
 * Remove content template options for non-administrators (Toolset Views)
 */
function bluesky_remove_toolset_templates() {
    if (!current_user_can('manage_options') && class_exists('WPV_Templates')) {
        global $WPV_templates;
        if (isset($WPV_templates)) {
            remove_action('admin_head', array($WPV_templates, 'post_edit_template_options'));
        }
    }
}
add_action('admin_init', 'bluesky_remove_toolset_templates');

// ==============================================
// WIDGETS & SIDEBARS
// ==============================================

/**
 * Register theme widget areas
 */
function bluesky_widgets_init() {
    register_sidebar(array(
        'name'          => 'Primary Widget Area',
        'id'            => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'bluesky_widgets_init');

// ==============================================
// INCLUDES
// ==============================================

// Load shortcodes
require_once get_template_directory() . '/shortcodes.php';