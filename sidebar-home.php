<aside id="sidebar">
<?php if ( is_active_sidebar('home-sidebar') ) : ?>
  <div id="primary" class="widget-area">
    <ul class="sidebar-widgets">
      <?php dynamic_sidebar('home-sidebar'); ?>
    </ul>
  </div>
<?php endif; ?>
</aside>
