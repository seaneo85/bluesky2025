</div> <!--container-->

</div> <!--wrapper-->

<footer>
	<div class="footer-container">
		<div class="content-container">
			<div class="footer-content">
				<nav class="footer-nav">
					<?php wp_nav_menu( array( 
						'theme_location' => 'main-menu',
						'container' => false,
						'items_wrap' => '<ul>%3$s</ul>'
					) ); ?>
				</nav>
				<div class="footer-info">
					<div class="footer-contact">
						<span><i class="fas fa-phone"></i> <a href="tel:814-894-2471">(814) 894-2471</a></span>
						<span><i class="fas fa-envelope"></i> <a href="mailto:sales@blueskyland.net">sales@blueskyland.net</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="content-container">
			<p>&copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ) ?>. All Rights Reserved.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>