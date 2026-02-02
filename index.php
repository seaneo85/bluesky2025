<?php get_header(); ?>

<!-- INDEX -->

<?php include('advanced-search.php'); ?>

<?php
$page_title = 'All Listings';
$current_type = isset($_GET['listing-type']) ? sanitize_text_field($_GET['listing-type']) : '';
$current_county = isset($_GET['county']) ? sanitize_text_field($_GET['county']) : '';
$current_search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

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
	<h1 class="page-title"><?php echo $page_title; ?></h1>

	<div class="content-sidebar-wrapper">
		<div id="content">
			<?php while ( have_posts() ) : the_post() ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					// Use the post_display shortcode to show post details
					echo do_shortcode('[post_display show_title="true" title_tag="h2" wrapper="div" class="listing-wrapper" show_meta="true"]');
					?>
				</article>
			
			<?php endwhile; ?>
		</div> <!-- CONTENT -->

		<?php get_sidebar('Primary Widget Area'); ?>
	</div>
</div> <!-- PAGE CONTENT WRAPPER -->
<?php get_footer(); ?>