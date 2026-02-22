<div class="advancedsearch">
	<h3 class="sr-only">Search Properties</h3>

	<div class="text-search-wrapper filters-search-wrapper">
		<h4>Keyword Search:</h4>
		<?php get_search_form(array(
			'id_suffix' => 'advanced',
			'placeholder' => 'Search by keyword(s)',
			'aria_label' => 'Search properties by keyword(s)'
		)); ?>
	</div>

	<div class="filters-search-wrapper">
		<h4>Or Search By:</h4>
		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>" class="wpv-filter-form">
				<div class="search-inputs select-inputs">
					<div class="drop">
						<label for="wpv_control_select_property-type" class="sr-only">Select Property Type</label>
						<select name="listing-type" id="wpv_control_select_property-type" class="wpcf-form-select form-select select" onchange="handlePropertyTypeChange(this)" aria-describedby="property-type-help">
							<option value="">Property Type</option>
							<?php 
							$property_types = bluesky_get_property_types();
							$current_type = isset($_GET['listing-type']) ? $_GET['listing-type'] : '';

							echo '<option value="hunting-properties" ' . ($current_type === 'hunting-properties' ? 'selected="selected"' : '') . '>Hunting Properties</option>';
							
							foreach ($property_types as $value => $label) {
									$selected = ($current_type === $value) ? 'selected="selected"' : '';
									echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</form>
		</div>

		<script>
		function handlePropertyTypeChange(select) {
			if (select.value === 'hunting-properties') {
				window.location.href = '<?php echo home_url('/hunting-properties'); ?>';
			} else if (select.value !== '') {
				select.form.submit();
			}
		}
		</script>

		<div class="search-category">
			<form method="get" action="<?php echo home_url('/listings'); ?>">
				<div class="search-inputs select-inputs">
					<div class="drop">
						<label for="county-select" class="sr-only">Select County</label>
						<select name="county" id="county-select" onchange="this.form.submit()" aria-describedby="county-help">
							<option value="">County</option>
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
				</div>
			</form>
		</div><!--search category-->
	</div><!--filters search-->
</div><!-- advancedsearch -->
