<?php
// Get arguments passed to get_search_form()
$args = wp_parse_args($args ?? array(), array(
  'id_suffix' => '',
  'placeholder' => __('Search...', 'bluesky2025'),
  'aria_label' => __('Search', 'bluesky2025')
));

$unique_id = 'search-field' . ($args['id_suffix'] ? '-' . $args['id_suffix'] : '');
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/listings')); ?>">
  <label for="<?php echo esc_attr($unique_id); ?>" class="sr-only"><?php _e('Search for:', 'bluesky2025'); ?></label>
  <div class="search-inputs">
    <input type="search"
      class="search-field"
      id="<?php echo esc_attr($unique_id); ?>" 
      name="s" 
      placeholder="<?php echo esc_attr($args['placeholder']); ?>"
      value="<?php echo get_search_query(); ?>"
      aria-label="<?php echo esc_attr($args['aria_label']); ?>" />
    <button type="submit" class="search-submit">
      <span class="sr-only"><?php _e('Search', 'bluesky2025'); ?></span>
      <svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
  </div>
</form>