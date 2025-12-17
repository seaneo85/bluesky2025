<div class="advancedsearch">
	<h3>Search Properties</h3>
	<div class="search-category">
		<?php get_search_form(array(
			'id_suffix' => 'advanced',
			'placeholder' => 'Search properties...',
			'aria_label' => 'Search Properties'
		)); ?>
	</div>

	<div class="filters-search">
		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>" class="wpv-filter-form">
				<p>Search listings by category:</p>
				<div class="drop">
					<select name="listing-type" id="wpv_control_select_property-type" class="wpcf-form-select form-select select" onchange="this.form.submit()">
						<option value="">Choose a Category</option>
						<?php 
						$property_types = bluesky_get_property_types();
						$current_type = isset($_GET['listing-type']) ? $_GET['listing-type'] : '';
						
						foreach ($property_types as $value => $label) {
								$selected = ($current_type === $value) ? 'selected="selected"' : '';
								echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="go"><input type="submit" value="Go" name="wpv_filter_submit"></div>
			</form>
		</div>
		
		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>">
				<p>Search listings by county:</p>
				<div class="drop">
					<select name="county" onchange="this.form.submit()">
						<option value="">Choose a County</option>
						<?php 
						$counties = bluesky_get_counties();
						$current_county = isset($_GET['county']) ? $_GET['county'] : '';
						
						foreach ($counties as $value => $label) {
								$selected = ($current_county === $value) ? 'selected="selected"' : '';
								echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="go"><input type="submit" value="Go"></div>
			</form>
		</div><!--search category-->
	</div><!--filters search-->
</div><!-- advancedsearch -->
