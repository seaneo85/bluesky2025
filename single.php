<?php get_header(); ?>

<!-- SINGLE.PHP -->
<?php include('advanced-search.php'); ?>


<div class="page-content-wrapper">
	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="content-sidebar-wrapper">
		<div id="content">
			<?php while ( have_posts() ) : the_post() ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php echo do_shortcode('[wpv-post-body view_template="Single Listing Page"]'); ?>
					</div>
				</article>
			
			<?php endwhile; ?>
		</div> <!-- CONTENT -->

		<?php get_sidebar('Primary Widget Area'); ?>
	</div>
</div> <!-- PAGE CONTENT WRAPPER -->
<?php get_footer(); ?>