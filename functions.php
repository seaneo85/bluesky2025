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

  register_sidebar(array(
    'name' => 'Hunting Properties Sidebar',
    'id' => 'hunting-properties-sidebar',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'name' => 'Homepage Sidebar',
    'id' => 'home-sidebar',
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
    // 1. Safety Checks: Only run on the frontend and the main query
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // 2. Targeted Pages: Only run on Home, Front Page, or Search Results
    if ($query->is_home() || $query->is_front_page() || $query->is_search()) {
        
        $meta_query = array();

        // 3. SET POST TYPES: This is the critical fix.
        // If it's a search (or has search parameter), we want both. Otherwise, default to standard posts.
        if ($query->is_search() || !empty($query->get('s'))) {
            $query->set('post_type', array('post', 'hunting-properties'));
        } else {
            $query->set('post_type', array('post'));
        }

        // 4. HANDLE FILTERS (Prioritizing Search > Listing Type > County)
        // Note: Using $_GET directly to determine which specific filter logic to apply.
        if (($query->is_search() || !empty($query->get('s'))) && !empty(get_search_query() ?: $query->get('s'))) {
            // Standard search logic - WP handles the keywords automatically 
            // since we already set the post_types above.
        } 
        elseif (isset($_GET['listing-type']) && !empty($_GET['listing-type'])) {
            // Handle Property Type Filtering
            $property_type_url = sanitize_text_field($_GET['listing-type']);
            $db_mapping = bluesky_get_property_type_db_mapping();

            if (isset($db_mapping[$property_type_url])) {
                $db_value = $db_mapping[$property_type_url];

                // Toolset checkbox fields are serialized; LIKE "%"value"%" is the standard way to find them
                $meta_query[] = array(
                    'key'     => 'wpcf-property-type-s',
                    'value'   => '"' . $db_value . '"',
                    'compare' => 'LIKE'
                );
            }
        } 
        elseif (isset($_GET['county']) && !empty($_GET['county'])) {
            // Handle County Filtering
            $county = sanitize_text_field($_GET['county']);
            $meta_query[] = array(
                'key'     => 'wpcf-county',
                'value'   => $county,
                'compare' => 'LIKE' 
            );
        }

        // 5. APPLY META QUERY: If any filters were added, attach them to the query.
        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
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
    'hunting-properties' => 'Hunting properties for sale',
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

/**
 * Shortcode: [property_type_links base="/YOUR-LISTINGS-PAGE/" param="listing-type" separator=", "]
 * - Toolset checkbox field stores integer IDs (e.g. 5, 10, 13)
 * - Converts IDs -> slugs using bluesky_get_property_type_db_mapping()
 * - Uses labels from bluesky_get_property_types()
 * - Outputs comma-separated links to base + ?listing-type=slug
 */
add_shortcode('property_type_links', function($atts) {
    $atts = shortcode_atts([
        'base'      => '/YOUR-LISTINGS-PAGE/',
        'param'     => 'listing-type',
        'separator' => ', ',
        'meta_key'  => 'wpcf-property-type-s',
        'skip_unknown' => true, // set false to show unknown IDs as-is
    ], $atts);

    $post_id = get_the_ID();
    if (!$post_id) return '';

    $raw = get_post_meta($post_id, $atts['meta_key'], true);
    if (empty($raw)) return '';

    // Normalize meta to a flat list of scalar values (IDs)
    $ids = [];
    $push_id = function($item) use (&$ids) {
        if (is_scalar($item)) {
            $s = trim((string)$item);
            if ($s !== '') $ids[] = $s;
            return;
        }
        if (is_array($item)) {
            if (isset($item['value']) && is_scalar($item['value'])) {
                $s = trim((string)$item['value']);
                if ($s !== '') $ids[] = $s;
                return;
            }
            if (isset($item[0]) && is_scalar($item[0])) {
                $s = trim((string)$item[0]);
                if ($s !== '') $ids[] = $s;
                return;
            }
        }
    };

    if (is_array($raw)) {
        foreach ($raw as $item) $push_id($item);
    } else {
        $raw = trim((string)$raw);
        foreach (array_map('trim', explode(',', $raw)) as $item) $push_id($item);
    }

    if (!$ids) return '';

    // slug => db_id
    $slug_to_id = function_exists('bluesky_get_property_type_db_mapping')
        ? bluesky_get_property_type_db_mapping()
        : [];

    if (!$slug_to_id) return '';

    // db_id => slug
    $id_to_slug = array_flip($slug_to_id);

    // slug => label
    $slug_to_label = function_exists('bluesky_get_property_types')
        ? bluesky_get_property_types()
        : [];

    $base_url = home_url($atts['base']);

    $links = [];
    foreach ($ids as $id) {
        if (!isset($id_to_slug[$id])) {
            if (!$atts['skip_unknown']) {
                // Fall back: show ID and pass it through (not recommended if filter expects slugs)
                $url = add_query_arg($atts['param'], $id, $base_url);
                $links[] = sprintf('<a href="%s">%s</a>', esc_url($url), esc_html($id));
            }
            continue;
        }

        $slug = $id_to_slug[$id];

        // Use your label map; fall back to prettified slug
        $text = $slug_to_label[$slug] ?? ucwords(str_replace('-', ' ', $slug));

        $url = add_query_arg($atts['param'], $slug, $base_url);

        $links[] = sprintf('<a href="%s">%s</a>', esc_url($url), esc_html($text));
    }

    return implode($atts['separator'], $links);
});

/**
 * Shortcode: [county_link base="/YOUR-LISTINGS-PAGE/" param="county" meta_key="wpcf-county" icon_class="fas fa-map-marker-alt"]
 * Outputs a single linked county label using bluesky_get_counties() mapping.
 */
add_shortcode('county_link', function($atts) {
    $atts = shortcode_atts([
        'base'       => '/listings/',
        'param'      => 'county',            // <-- change to your actual filter param if different
        'meta_key'   => 'wpcf-county',        // <-- change to your Toolset select field meta key
        'icon_class' => '',                  // optional
    ], $atts);

    $post_id = get_the_ID();
    if (!$post_id) return '';

    $raw = get_post_meta($post_id, $atts['meta_key'], true);
    if ($raw === '' || $raw === null) return '';

    $raw = is_scalar($raw) ? trim((string)$raw) : '';
    if ($raw === '') return '';

    $counties = function_exists('bluesky_get_counties') ? bluesky_get_counties() : [];
    if (!$counties) return '';

    // Determine slug + label
    if (isset($counties[$raw])) {
        // Stored value is already the slug (ideal)
        $slug  = $raw;
        $label = $counties[$raw];
    } else {
        // Stored value might be a label like "Clearfield" or something else
        $candidate = sanitize_title($raw); // "Clearfield" -> "clearfield"
        if (isset($counties[$candidate])) {
            $slug  = $candidate;
            $label = $counties[$candidate];
        } else {
            // Last resort: use slugified raw with raw as label
            $slug  = $candidate;
            $label = $raw;
        }
    }

    $base_url = home_url($atts['base']);
    $url = add_query_arg($atts['param'], $slug, $base_url);

    $icon = $atts['icon_class']
        ? sprintf('<i class="%s"></i> ', esc_attr($atts['icon_class']))
        : '';

    return sprintf('%s<a href="%s">%s</a>', $icon, esc_url($url), esc_html($label));
});






// ==============================================
// INCLUDES
// ==============================================

// Load shortcodes
require_once get_template_directory() . '/shortcodes.php';