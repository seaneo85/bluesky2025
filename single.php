<?php get_header(); ?>

<!-- POST -->
<?php include('advanced-search.php'); ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	
	

<div id="property-image-container">



	

</div>



<article id="content">



	<?php the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		
	
	
		<div class="entry-content">
			<?php echo do_shortcode('[wpv-post-body view_template="Single Listing Page"]'); ?>
			
			
			<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>') ?>
		</div>
	
	</div><!-- post-ID -->
	

	
</article>
<aside id="gallery">
	
</aside>

<?php get_sidebar(); ?>
<?php get_footer(); ?>