<div class="advancedsearch">
	<h3>Search Properties</h3>

	<div class="text-search-wrapper">
		<?php get_search_form(array(
			'id_suffix' => 'advanced',
			'placeholder' => 'Search properties...',
			'aria_label' => 'Search Properties'
		)); ?>
	</div>

	<div class="filters-search-wrapper">
		<h4>Filter By:</h4>
		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>" class="wpv-filter-form">
				<div class="search-inputs select-inputs">
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
					<button type="submit" class="search-submit">
						<span class="sr-only"><?php _e('Search by Property Type', 'bluesky2025'); ?></span>
						<svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg>
					</button>
				</div>
			</form>
		</div>
		
		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>">
				<div class="search-inputs select-inputs">
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
					<button type="submit" class="search-submit">
						<span class="sr-only"><?php _e('Search by County', 'bluesky2025'); ?></span>
						<svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg>
					</button>
				</div>
			</form>
		</div><!--search category-->
	</div><!--filters search-->
</div><!-- advancedsearch -->
