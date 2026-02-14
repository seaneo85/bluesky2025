<?php
//[sectionbreak]
function sectionbreak()
{
  return '<div class="section-break"></div>';
}

add_shortcode('sectionbreak', 'sectionbreak');

//[clearfloats]
function clearfloats()
{
  return '<br clear="all" />';
}

add_shortcode('clearfloats', 'clearfloats');

//[button][/button]
//Shortcode to produce a styled button

function button_shortcode($atts, $content = null)
{

  /*
  Supported Attributes
  size    =>  large, medium, small
  color   =>  gold, black, blue, green, grey, orange, pink, red, white
  target  =>  _self, _blank
  */

  extract(shortcode_atts(array(
    'size' => 'medium',
    'color' => 'blue',
    'url' => '#',
    'target' => '_self',
    'rel' => ''
  ), $atts));

  return '<a target="' . $target . '" class="button button-' . $size . ' button-' . $color . '" href="' . $url . '"' . $rel . '>' . $content . '</a>';
}

add_shortcode('button', 'button_shortcode');

//[textbox][/textbox]
//box shortcode

add_shortcode('box', 'box_shortcode');

function box_shortcode($atts, $content = null)
{

  /*
    Supported Attributes
        style   =>  blue, green, grey, red, tan, yellow	-> creates boxes using only those colors
      OR
        style   =>  alert, comment, download, info, tip	-> boxes with the corresponding icon to the left of the text
  */

  extract(shortcode_atts(array(
    'style' => 'blue',
  ), $atts));

  return '<div class="box box-' . $style . '">' . '<p class="box-content">' . $content . '</p></div>';
} //end box shortcode

//[one-half],[one-third],[two-thirds],[one-fourth],[two-fourths],[three-fourths],[one-fifth],[two-fifths],[three-fifths],[four-fifths]
//columns shortcode

add_shortcode('one-half', 'one_half_shortcode');
add_shortcode('one-third', 'one_third_shortcode');
add_shortcode('two-thirds', 'two_thirds_shortcode');
add_shortcode('one-fourth', 'one_fourth_shortcode');
add_shortcode('two-fourths', 'two_fourths_shortcode');
add_shortcode('three-fourths', 'three_fourths_shortcode');
add_shortcode('one-fifth', 'one_fifth_shortcode');
add_shortcode('two-fifths', 'two_fifths_shortcode');
add_shortcode('three-fifths', 'three_fifths_shortcode');
add_shortcode('four-fifths', 'four_fifths_shortcode');
add_shortcode('container', 'columns_container_shortcode');
add_shortcode('columns', 'columns_container_shortcode');

function columns_container_shortcode($atts, $content)
{
  // Extract shortcode attributes
  extract(shortcode_atts(array(
    'type' => '',
    'class' => ''
  ), $atts));
  
  // Build CSS classes
  $css_classes = 'columns-container';
  
  // Add grid type if specified
  if (!empty($type)) {
    $css_classes .= ' grid-' . esc_attr($type);
  }
  
  // Add custom classes if specified
  if (!empty($class)) {
    $css_classes .= ' ' . esc_attr($class);
  }
  
  return '<div class="' . $css_classes . '">' . do_shortcode($content) . '</div>';
}

function one_half_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-one-half">' . remove_wpautop($content) . '</div>';

  return $return;
}


//Shortcode to display a 1/3 column    

function one_third_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-one-third">' . remove_wpautop($content) . '</div>';

  return $return;
}


//Shortcode to display a 2/3 column

function two_thirds_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-two-thirds">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 1/4 column

function one_fourth_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-one-fourth">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 2/4 column

function two_fourths_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-two-fourths">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 3/4 column

function three_fourths_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-three-fourths">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 1/5 column

function one_fifth_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-one-fifth">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 2/5 column

function two_fifths_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-two-fifths">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 3/5 column

function three_fifths_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-three-fifths">' . remove_wpautop($content) . '</div>';

  return $return;
}

//Shortcode to display a 4/5 column

function four_fifths_shortcode($atts, $content)
{
  extract(shortcode_atts(array('last' => ''), $atts));

  // Note: 'last' attribute is maintained for backward compatibility but not used
  $return = '<div class="column-four-fifths">' . remove_wpautop($content) . '</div>';

  return $return;
}


//[post_display]
//Shortcode to display post title and content within a loop

add_shortcode('post_display', 'post_display_shortcode');

function post_display_shortcode($atts, $content = null)
{

  /*
  Supported Attributes
    show_title   =>  true, false (default: true)
    show_excerpt =>  true, false (default: false) - shows excerpt instead of full content
    title_tag    =>  h1, h2, h3, h4, h5, h6 (default: h2)
    wrapper      =>  div, article, section (default: div)
    class        =>  custom CSS classes for the wrapper
    show_meta    =>  true, false (default: false) - for future expansion
  */

  // Extract shortcode attributes
  extract(shortcode_atts(array(
    'show_title' => 'true',
    'title_tag' => 'h2',
    'wrapper' => 'div',
    'class' => 'post-display',
    'show_meta' => 'false',
    'show_excerpt' => 'false'
  ), $atts));

  // Ensure we're in the loop
  if (!in_the_loop() || !is_object($GLOBALS['post'])) {
    return '<!-- post_display shortcode must be used within a WordPress loop -->';
  }

  $property_types = types_render_field('property-type-s', array("separator" => ", "));
  $featured_image = types_render_field('property-image', array("size" => "large", "index" => 0));
  $price = types_render_field('property-price', array());
  $county = types_render_field('county', array());
  $address = types_render_field('property-address', array());
  $city = types_render_field('city', array());
  $excerpt = get_the_excerpt();

  $output = '';

  // Start wrapper
  $wrapper_classes = $class;
  $output .= '<' . $wrapper . ' class="' . esc_attr($wrapper_classes) . '">';

  // Display featured image if available
  if ($featured_image) {
    $output .= '<div class="post-display-image">';
    $output .= '<a href="' . get_permalink() . '">';
    $output .= $featured_image;
    $output .= '</a>';
    $output .= '</div>';
  }

  $output .= '<div class="content-wrapper">';

  // Display title
  if ($show_title === 'true') {
    $title = get_the_title();
    if ($title) {
      $output .= '<' . $title_tag . ' class="post-display-title">';
      $output .= '<a href="' . get_permalink() . '">' . esc_html($title) . '</a>';
      $output .= '</' . $title_tag . '>';
    }
  }

  $output .= '<div class="post-display-price">$' . esc_html($price) . '</div>';

  // Future expansion: Post meta display
  if ($show_meta === 'true') {
    $output .= '<div class="post-display-meta">';
      // This will be expanded later to show custom post meta
      $output .= '<!-- Post meta will be displayed here -->';
      $output .= '<ul>';

      if ( $property_types ) {
        $output .= '<li><strong>Property Types:</strong> ' . esc_html($property_types) . '</li>';
      }

      if ($county) {
        $output .= '<li><strong>County:</strong> ' . esc_html($county) . '</li>';
      }

      if ($address) {
        $output .= '<li><strong>Address:</strong> ' . esc_html($address) . '</li>';
      }

      if ($city) {
        $output .= '<li><strong>City:</strong> ' . esc_html($city) . '</li>';
      }

      $output .= '</ul>';

    $output .= '</div>'; // .post-display-meta
  }

    if ($show_excerpt === 'true' && $excerpt) {
      // Ensure excerpt is wrapped in paragraph tags
      $output .= '<p class="post-display-excerpt">' . wp_kses_post($excerpt) . '</p>';
    }

  $output .= '</div>'; // .content-wrapper

  // End wrapper
  $output .= '</' . $wrapper . '>';

  return $output;
}

/******************************************************
 *  Helper Functions
 ******************************************************/

/* Remove the wpautop from shortcodes */
function remove_wpautop($content)
{
  $content = do_shortcode(shortcode_unautop($content));
  $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
  return $content;
}



?>