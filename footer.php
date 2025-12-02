			<br clear="all"></div> <!--container-->

			<footer>
			
				<nav>
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
				</nav>
				
				<p id="copyright">
				&copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ) ?>. All Rights Reserved.
				</p>
			</footer>

		</div> <!--wrapper-->

		<?php wp_footer(); ?>
		
	</body>

</html>