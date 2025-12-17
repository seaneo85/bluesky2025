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
function bluesky_enqueue_scripts()
{
  // Google Fonts
  wp_enqueue_style('bluesky-google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), null);

  // Main theme stylesheet
  wp_enqueue_style('bluesky-style', get_stylesheet_uri(), array('bluesky-google-fonts'), '1.0.0');

  // Shortcodes stylesheet
  wp_enqueue_style('bluesky-shortcodes', get_template_directory_uri() . '/shortcodes.css', array('bluesky-style'), '1.0.0');

  wp_enqueue_script('swiper-js', get_template_directory_uri() . '/scripts/external/swiper/swiper-bundle.min.js', array(), '12.0.3', true);
  wp_enqueue_style('swiper-css', get_template_directory_uri() . '/scripts/external/swiper/swiper-bundle.min.css', array(), '12.0.3');

  // Custom scripts
  wp_enqueue_script('bluesky-custom', get_template_directory_uri() . '/scripts/scripts.js', array('swiper-js'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'bluesky_enqueue_scripts');

/**
 * Add preconnect for Google Fonts for better performance
 */
function bluesky_add_google_fonts_preconnect()
{
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'bluesky_add_google_fonts_preconnect', 1);

/**
 * Theme setup
 */
function bluesky_theme_setup()
{
  // Load theme textdomain for translations
  load_theme_textdomain('bluesky2025', get_template_directory() . '/languages');

  // Add theme support
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag'); // Let WordPress handle the title tag
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script'
  ));

  // Add responsive image support
  add_theme_support('responsive-embeds');

  // Register navigation menus
  register_nav_menus(array(
    'main-menu' => __('Main Menu', 'bluesky2025')
  ));
}
add_action('after_setup_theme', 'bluesky_theme_setup');

/**
 * Add favicon to head
 */
function bluesky_add_favicon()
{
  $favicon_url = get_template_directory_uri() . '/favicon.ico';
  if (file_exists(get_template_directory() . '/favicon.ico')) {
    echo '<link rel="shortcut icon" href="' . esc_url($favicon_url) . '" type="image/x-icon">' . "\n";
    echo '<link rel="icon" href="' . esc_url($favicon_url) . '" type="image/x-icon">' . "\n";
  }
}
add_action('wp_head', 'bluesky_add_favicon');

// ==============================================
// ADMIN CUSTOMIZATION
// ==============================================

/**
 * Force dashboard to single column layout
 */
function bluesky_dashboard_single_column()
{
  return 1;
}
add_filter('get_user_option_screen_layout_dashboard', 'bluesky_dashboard_single_column');
add_filter('screen_layout_columns', function ($columns) {
  $columns['dashboard'] = 1;
  return $columns;
});

/**
 * Add custom dashboard widget with documentation
 */
function bluesky_add_dashboard_widget()
{
  wp_add_dashboard_widget(
    'bluesky_documentation',
    'Blue Sky Website Documentation',
    'bluesky_dashboard_widget_content'
  );
}
add_action('wp_dashboard_setup', 'bluesky_add_dashboard_widget');

function bluesky_dashboard_widget_content()
{
  echo '<div class="documentation-widget">';
  echo '<p>Website documentation and instructions:</p>';
  echo '<p><a href="https://docs.google.com/document/d/1XQ1OyRR0CjJ8L30YDJZBnE62vayP2VRTKVXeTquPNyA/edit" target="_blank" class="button button-primary">View Documentation</a></p>';
  echo '<p><em>Opens in a new window for better readability</em></p>';
  echo '</div>';
}

/**
 * Remove default dashboard widgets
 */
function bluesky_remove_dashboard_widgets()
{
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
function bluesky_restrict_admin_menus()
{
  if (!current_user_can('manage_options')) {
    remove_menu_page('tools.php');
    remove_menu_page('edit-comments.php');
  }
}
add_action('admin_menu', 'bluesky_restrict_admin_menus');

/**
 * Remove content template options for non-administrators (Toolset Views)
 */
function bluesky_remove_toolset_templates()
{
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
function bluesky_widgets_init()
{
  register_sidebar(array(
    'name' => 'Primary Widget Area',
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
add_action('widgets_init', 'bluesky_widgets_init');

// ==============================================
// SEARCH & FILTERING
// ==============================================

/**
 * Modify main query for filtering by custom fields
 * Only handles one filter at a time: search takes priority, then property type, then county
 */
function bluesky_modify_main_query($query)
{
  // Only on the main query and on the front-end
  if (!$query->is_main_query() || is_admin()) {
    return;
  }

  // Only on home/index page
  if (is_home() || is_front_page()) {
    $meta_query = array();

    // Priority order: search, property type, county (only one active at a time)
    if (isset($_GET['s']) && !empty($_GET['s'])) {
      // Let WordPress handle the search query naturally
      // No meta query needed for keyword search
    } elseif (isset($_GET['listing-type']) && !empty($_GET['listing-type'])) {
      // Handle property type filtering
      $property_type_url = sanitize_text_field($_GET['listing-type']);

      // Get the database mapping
      $db_mapping = bluesky_get_property_type_db_mapping();

      // Convert user-friendly URL to database integer
      if (isset($db_mapping[$property_type_url])) {
        $db_value = $db_mapping[$property_type_url];

        // For checkbox fields, use exact matching
        $meta_query[] = array(
          'key' => 'wpcf-property-type-s',
          'value' => $db_value,
          'compare' => '='
        );
      }
    } elseif (isset($_GET['county']) && !empty($_GET['county'])) {
      // Handle county filtering  
      $county = sanitize_text_field($_GET['county']);
      $meta_query[] = array(
        'key' => 'wpcf-county',
        'value' => $county,
        'compare' => 'LIKE' // Use LIKE for case-insensitive matching due to inconsistent data entry
      );
    }

    // Apply meta query if we have filters
    if (!empty($meta_query)) {
      $query->set('meta_query', $meta_query);
    }

    $query->set('post_type', 'post');
  }
}
add_action('pre_get_posts', 'bluesky_modify_main_query');

/**
 * Get property types for dropdown with user-friendly URLs
 */
function bluesky_get_property_types()
{
  $property_types = array(
    'prime-building-lot' => 'Prime building lot(s) for sale',
    'camp-lot' => 'Camp lot(s) for sale',
    'mobile-home-lot' => 'Mobile home lot for rent',
    'commercial-lot' => 'Commercial lot for sale',
    'acreage' => 'Acreage for sale',
    'house' => 'House for sale',
    'storage-garage' => 'Storage garage for rent',
    'commercial-site' => 'Commercial site for rent',
    'other' => 'Other'
  );

  return $property_types;
}

/**
 * Map user-friendly property type URLs to database integer values
 */
function bluesky_get_property_type_db_mapping()
{
  $mapping = array(
    'prime-building-lot' => '7',
    'camp-lot' => '5',
    'mobile-home-lot' => '8',
    'commercial-lot' => '2',
    'acreage' => '10',
    'house' => '4',
    'storage-garage' => '3',
    'commercial-site' => '11',
    'other' => '13'
  );

  return $mapping;
}

/**
 * Get counties for dropdown
 */
function bluesky_get_counties()
{
  $counties = array(
    'armstrong' => 'Armstrong',
    'beaver' => 'Beaver',
    'blair' => 'Blair',
    'cambria' => 'Cambria',
    'cameron' => 'Cameron',
    'centre' => 'Centre',
    'clarion' => 'Clarion',
    'clearfield' => 'Clearfield',
    'clinton' => 'Clinton',
    'crawford' => 'Crawford',
    'elk' => 'Elk',
    'forest' => 'Forest',
    'indiana' => 'Indiana',
    'jefferson' => 'Jefferson',
    'lycoming' => 'Lycoming',
    'mckean' => 'McKean',
    'mercer' => 'Mercer',
    'potter' => 'Potter',
    'tioga' => 'Tioga',
    'venango' => 'Venango',
    'warren' => 'Warren',
    'westmoreland' => 'Westmoreland'
  );

  return $counties;
}

/**
 * Debug function to display property type values from database
 * Add ?debug_property_types=1 to URL to see actual database values
 */
function bluesky_debug_property_types()
{
  if (isset($_GET['debug_property_types']) && current_user_can('manage_options')) {
    $posts = get_posts(array(
      'post_type' => 'post',
      'posts_per_page' => 20,
      'meta_query' => array(
        array(
          'key' => 'wpcf-property-type-s',
          'compare' => 'EXISTS'
        )
      )
    ));

    echo '<div style="background: white; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
    echo '<h3>Debug: Property Type Values</h3>';

    foreach ($posts as $post) {
      $property_type_value = get_post_meta($post->ID, 'wpcf-property-type-s', true);
      echo '<p><strong>' . $post->post_title . '</strong>: ' . var_export($property_type_value, true) . '</p>';
    }

    echo '</div>';
  }
}
add_action('wp_head', 'bluesky_debug_property_types');

// ==============================================
// INCLUDES
// ==============================================

// Load shortcodes
require_once get_template_directory() . '/shortcodes.php';