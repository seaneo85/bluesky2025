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
											<div class="swiper-slide">
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

						<?php echo do_shortcode('[wpv-post-body view_template="Single Listing Page"]'); ?>
					</div>
				</article>
			
			<?php endwhile; ?>
		</div> <!-- CONTENT -->

		<?php get_sidebar('Primary Widget Area'); ?>
	</div>
</div> <!-- PAGE CONTENT WRAPPER -->
<?php get_footer(); ?>