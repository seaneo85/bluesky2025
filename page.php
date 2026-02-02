<?php get_header(); ?>

<!-- PAGE -->

<?php if (!is_front_page()) { ?>   <?php include('advanced-search.php'); ?><?php } ?>

<?php if (is_front_page()) { ?>
  <div class="featured-slider-container">
    <h2 class="sr-only">Featured Properties</h2>

    <?php
    $slider = array(
      "id" => "8961",
    );
    echo (render_view($slider)); ?>
  </div>

  <?php include('advanced-search.php'); ?>
<?php } ?>

<div class="page-content-wrapper">
  <h1 class="entry-title"><?php the_title(); ?></h1>

  <div class="content-sidebar-wrapper">
    <article id="content">
      <?php the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'blankslate') . '&after=</div>') ?>
        </div>
      </div>
    </article>
    <?php get_sidebar(); ?>
  </div>
</div> <!-- PAGE CONTENT WRAPPER -->

<?php get_footer(); ?>