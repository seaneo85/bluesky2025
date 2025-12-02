<?php get_header(); ?>

<!-- INDEX -->

<?php include('advanced-search.php'); ?>

<h1 class="page-title"><titile>All Real Estate Listings</title></h1>

<div id="content">





	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
		<div id="nav-above" class="navigation">
			<?php wp_pagenavi(); ?>
		</div> <!-- End nav-above-->
	<?php } ?>



	<?php while ( have_posts() ) : the_post() ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Read', 'blankslate'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="entry-meta">
		
			<span class="meta-prep meta-prep-author"><?php _e('By ', 'blankslate'); ?></span>
			<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( 'View all articles by %s', 'blankslate' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
			<span class="meta-sep"> | </span>
			<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'blankslate'); ?></span>
			<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
	<?php edit_post_link( __( 'Edit', 'blankslate' ), "<span class=\"meta-sep\"> | </span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
	
		</div> <!-- end entry-meta -->
	
		<div class="entry-content">
			
			<?php the_content( __( 'continue reading <span class="meta-nav">&raquo;</span>', 'blankslate' )  ); ?>
			<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>') ?>
			
		</div> <!-- entry-content -->
	
	</div> <!-- post -->
	
	<?php endwhile; ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
	
	<div id="nav-below" class="navigation">
	<?php wp_pagenavi(); ?>
	</div>
	
	<?php } ?>
	
</div> <!-- CONTENT -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>