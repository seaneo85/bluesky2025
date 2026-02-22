<?php get_header(); ?>

<!-- SINGLE.PHP -->
<?php include('advanced-search.php'); ?>

<?php
  $post_type = get_post_type();
  $is_hunting_property = ($post_type === 'hunting-properties');
  // Strings
  $price = types_render_field('property-price', array());
  $property_types = types_render_field('property-type-s', array("separator" => ", "));
  $basement = types_render_field('basement', array()); // returns "Yes" or "No"
  $garage = types_render_field('garage', array()); // returns "Yes" or "No"
  $address = types_render_field('property-address', array());
  $city = types_render_field('city', array());
  $zip_code = types_render_field('zip_code', array());
  $county = types_render_field('county', array());

  // Integers
  $acres = types_render_field('acres', array());
  $lot_size = types_render_field('lot_size', array());
  $square_footage = types_render_field('square-feet', array());
  $bathrooms = types_render_field('bathrooms', array());

  // Other
  $google_maps_iframe = types_render_field('google_map2', array());
  $leased_date = types_render_field('leased-date', array());
?>

<div class="page-content-wrapper">
  <h1 class="entry-title"><?php the_title(); ?></h1>

  <?php
    if ( $leased_date ) {
      echo '<div class="leased-status"><strong><i class="fas fa-calendar-check"></i> Leased Until: ' . esc_html($leased_date) . '</strong></div>';
    }
  ?>

  <div class="content-sidebar-wrapper">
    <div id="content">
      <?php while ( have_posts() ) : the_post() ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
            <?php 
            $images = get_post_meta(get_the_ID(), 'wpcf-property-image', false);
            if (!empty($images) && is_array($images)) : 
              // Filter out empty image URLs
              $images = array_filter($images, function($image) {
                return !empty(trim($image));
              });
            ?>
              <?php if (!empty($images)) : ?>
                <div class="listing-page-swiper swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($images as $image) : ?>
                      <div class="swiper-slide property-image-wrapper">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                      </div>
                    <?php endforeach; ?>
                  </div>
                  
                  <?php if (count($images) > 1) : ?>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>

            <div class="single-property-details">
              <?php if ($price) : ?>
                <div class="property-price">
                  <strong>Price:</strong> $<?php echo esc_html($price); ?>
                </div>
              <?php endif; ?>

              <?php if ($property_types) : ?>
                <div class="property-types">
                  <strong>Property Type:</strong> <?php echo esc_html($property_types); ?>
                </div>
              <?php endif; ?>

              <?php if ($address) : ?>
                <div class="property-address">
                  <strong>Address:</strong> <?php echo esc_html($address); ?>
                  <?php if ($city) : ?>, <?php echo esc_html($city); ?><?php endif; ?>
                  <?php if ($zip_code) : ?> <?php echo esc_html($zip_code); ?><?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if ($county) : ?>
                <div class="property-county">
                  <strong>County:</strong> <?php echo esc_html($county); ?>
                </div>
              <?php endif; ?>

              <?php if ($acres) : ?>
                <div class="property-acres">
                  <strong>Acreage:</strong> <?php echo esc_html($acres); ?> acres
                </div>
              <?php endif; ?>

              <?php if ($square_footage) : ?>
                <div class="property-sqft">
                  <strong>Square Footage:</strong> <?php echo esc_html(number_format((float)$square_footage)); ?> sq ft
                </div>
              <?php endif; ?>

              <?php if ($lot_size) : ?>
                <div class="property-lot-size">
                  <strong>Lot Size:</strong> <?php echo esc_html($lot_size); ?>
                </div>
              <?php endif; ?>

              <?php if ($bathrooms) : ?>
                <div class="property-bathrooms">
                  <strong>Bathrooms:</strong> <?php echo esc_html($bathrooms); ?>
                </div>
              <?php endif; ?>

              <?php if ($basement && $basement !== 'No') : ?>
                <div class="property-basement">
                  <strong>Basement:</strong> <?php echo esc_html($basement); ?>
                </div>
              <?php endif; ?>

              <?php if ($garage && $garage !== 'No') : ?>
                <div class="property-garage">
                  <strong>Garage:</strong> <?php echo esc_html($garage); ?>
                </div>
              <?php endif; ?>

              <?php if ($leased_date) : ?>
                <div class="property-leased">
                  <strong>Leased Until:</strong> <?php echo esc_html($leased_date); ?>
                </div>
              <?php endif; ?>
            </div>

            <?php echo do_shortcode('[wpv-post-body view_template="None"]'); ?>

            <?php if ($google_maps_iframe) : ?>
              <div class="property-map">
                <h2>Map:</h2>
                <div class="google-map-wrapper">
                  <?php echo $google_maps_iframe; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </article>
      
      <?php endwhile; ?>
    </div> <!-- CONTENT -->

    <?php if ($is_hunting_property) {
      get_sidebar('hunting');
    } else {
      get_sidebar('Primary Widget Area');
    } ?>
  </div>
</div> <!-- PAGE CONTENT WRAPPER -->
<?php get_footer(); ?>