<aside id="sidebar">
<?php if ( is_active_sidebar('hunting-properties-sidebar') ) : ?>
  <div id="primary" class="widget-area">
    <ul class="sidebar-widgets">
      <?php dynamic_sidebar('hunting-properties-sidebar'); ?>
    </ul>
  </div>
<?php endif; ?>
</aside>