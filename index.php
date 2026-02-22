<?php get_header(); ?>

<!-- INDEX -->

<?php include('advanced-search.php'); ?>

<?php
$page_title = 'All Listings';
$hunting_title = 'Hunting Properties';
$current_type = isset($_GET['listing-type']) ? sanitize_text_field($_GET['listing-type']) : '';
$current_county = isset($_GET['county']) ? sanitize_text_field($_GET['county']) : '';
$current_search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$post_type = get_query_var('post_type');

// Only show one filter at a time - priority: search, then property type, then county
if (!empty($current_search)) {
	$page_title = 'Search Results for "' . esc_html($current_search) . '"';
} elseif (!empty($current_type)) {
	$property_types = bluesky_get_property_types();
	if (isset($property_types[$current_type])) {
		$page_title = esc_html($property_types[$current_type]);
	}
} elseif (!empty($current_county)) {
	$counties = bluesky_get_counties();
	if (isset($counties[$current_county])) {
		$page_title = 'Properties in ' . esc_html($counties[$current_county]) . ' County';
	}
}
?>

<div class="page-content-wrapper">
	<h1 class="page-title">
		<?php if ( !have_posts() ) : ?>
				No Listings Found:
		<?php endif; ?>

		<?php
			if ($post_type === 'hunting-properties') :
				$page_title = $hunting_title;
			endif;

			echo $page_title;
		?>
	</h1>

	<?php
	// Display pagination at top (only if there are multiple pages and not hunting properties)
	if ($post_type !== 'hunting-properties') {
		global $wp_query;
		if ($wp_query->max_num_pages > 1) {
			$pagination_args = array(
				'mid_size' => 2,
				'prev_text' => '&laquo; Previous',
				'next_text' => 'Next &raquo;',
				'screen_reader_text' => 'Posts navigation',
			);
			the_posts_pagination($pagination_args);
		}
	}
	?>

	<main id="content">
		<?php 
		// Check if this is a hunting properties archive
		$post_type = get_query_var('post_type');
		if ($post_type === 'hunting-properties') :
			// Hunting properties grouped by county
			$counties = bluesky_get_counties();
			
			foreach ($counties as $county_slug => $county_name) :
				// Query hunting properties for this county
				$county_query = new WP_Query(array(
					'post_type' => 'hunting-properties',
					'posts_per_page' => -1, // Get all properties for this county
					'meta_query' => array(
						array(
							'key' => 'wpcf-county',
							'value' => $county_slug,
							'compare' => '='
						)
					),
					'post_status' => 'publish'
				));
				
				if ($county_query->have_posts()) : ?>
					<section class="county-section">
						<h2 class="county-heading"><?php echo esc_html($county_name); ?> County</h2>
						
						<div class="county-properties">
							<?php while ($county_query->have_posts()) : $county_query->the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('county-property'); ?>>
									<?php
									// Use the post_display shortcode to show post details
									echo do_shortcode('[post_display show_title="true" title_tag="h3" wrapper="div" class="listing-wrapper" show_meta="true"]');
									?>
								</article>
							<?php endwhile; ?>
						</div>
					</section>
				<?php 
				endif;
				wp_reset_postdata();
			endforeach;
		elseif (!empty($current_search)) :
			// Keyword search - WordPress query should include hunting properties via functions.php
			if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post() ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						// Use the post_display shortcode to show post details
						echo do_shortcode('[post_display show_title="true" title_tag="h2" wrapper="div" class="listing-wrapper" show_meta="true"]');
						?>
					</article>
				<?php endwhile; ?>
				
				<?php
				// Pagination for search results
				if ($wp_query->max_num_pages > 1) {
					$pagination_args = array(
						'mid_size' => 2,
						'prev_text' => '&laquo; Previous',
						'next_text' => 'Next &raquo;',
						'screen_reader_text' => 'Posts navigation',
					);
					the_posts_pagination($pagination_args);
				}
				?>
			<?php else : ?>
				<p style="font-size: 1.1rem;">No properties found for your search. Please try different keywords or browse all listings.</p>
				<a class="button button-medium button-blue" href="/listings">View All Properties</a>
			<?php endif;
		elseif (!empty($current_county)) :
			// County search - include both regular properties and hunting properties in one query
			$county_search_query = new WP_Query(array(
				'post_type' => array('post', 'hunting-properties'),
				'posts_per_page' => get_option('posts_per_page'),
				'paged' => get_query_var('paged'),
				'meta_query' => array(
					array(
						'key' => 'wpcf-county',
						'value' => $current_county,
						'compare' => '='
					)
				),
				'post_status' => 'publish'
			));
			
			if ($county_search_query->have_posts()) : ?>
				<?php while ($county_search_query->have_posts()) : $county_search_query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						echo do_shortcode('[post_display show_title="true" title_tag="h2" wrapper="div" class="listing-wrapper" show_meta="true"]');
						?>
					</article>
				<?php endwhile; ?>
				
				<?php
				// Pagination for county search
				if ($county_search_query->max_num_pages > 1) {
					$pagination_args = array(
						'mid_size' => 2,
						'prev_text' => '&laquo; Previous',
						'next_text' => 'Next &raquo;',
						'screen_reader_text' => 'Posts navigation',
					);
					the_posts_pagination($pagination_args);
				}
				?>
			<?php else : ?>
				<p style="font-size: 1.1rem;">We're sorry, but we currently do not have properties available in this county. Please try a different county or browse all listings.</p>
				<a class="button button-medium button-blue" href="/listings">View All Properties</a>
			<?php endif;
			wp_reset_postdata();
		else :
			// Regular listings loop
			if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post() ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						// Use the post_display shortcode to show post details
						echo do_shortcode('[post_display show_title="true" title_tag="h2" wrapper="div" class="listing-wrapper" show_meta="true"]');
						?>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<p style="font-size: 1.1rem;">We're sorry, but we currently do not have properties of this type available. Please retry your search or browse all listings.</p>

				<a class="button button-medium button-blue" href="/listings">View All Properties</a>
			<?php endif; ?>

			<?php
			// Display pagination for regular listings
			$pagination_args = array(
				'mid_size' => 2,
				'prev_text' => '&laquo; Previous',
				'next_text' => 'Next &raquo;',
				'screen_reader_text' => 'Posts navigation',
			);
			the_posts_pagination($pagination_args);
		endif; ?>

	</main> <!-- CONTENT -->

	<?php // get_sidebar('Primary Widget Area'); ?>
</div> <!-- PAGE CONTENT WRAPPER -->
<?php get_footer(); ?>