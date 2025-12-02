<div class="advancedsearch">

	<div class="search-category mag-glass">
		<form action="https://blueskyparealestate.com/search-results/" method="get" class="wpv-filter-form">
			<p>Search listings by category:</p><div class="drop">
				<select onchange="window.open(this.options[this.selectedIndex].value,'_top')" selected="selected" id="wpv_control_select_property-type" name="property-type[]" style="" class="wpcf-form-select form-select select wpcf-default-value-input">
				<option value="" class="wpcf-form-option form-option option">Choose a Category</option>
				<option value="<?php echo get_site_url(); ?>/prime-building-lots-real-estate/" class="wpcf-form-option form-option option">Prime building lot(s) for sale</option>
				<option value="<?php echo get_site_url(); ?>/listings-camp-lots-sale/" class="wpcf-form-option form-option option">Camp lot(s) for sale</option>
				<option value="<?php echo get_site_url(); ?>/listings-mobile-home-lots/" class="wpcf-form-option form-option option">Mobile home lot for rent</option>
				<option value="<?php echo get_site_url(); ?>/listings-commercial-lots/" class="wpcf-form-option form-option option">Commercial lot for sale</option>
				<option value="<?php echo get_site_url(); ?>/listings-acreage-sale/" class="wpcf-form-option form-option option">Acreage for sale</option>
				<option value="<?php echo get_site_url(); ?>/listings-houses-sale/" class="wpcf-form-option form-option option">House for sale</option>
				<option value="<?php echo get_site_url(); ?>/listings-storage-garages/" class="wpcf-form-option form-option option">Storage garage for rent</option>
				<option value="<?php echo get_site_url(); ?>/listings-commercial-sites-rent/" class="wpcf-form-option form-option option">Commercial site for rent</option>
				<option value="<?php echo get_site_url(); ?>/hunting-properties-2/" class="wpcf-form-option form-option option">Hunting properties for lease</option>
				<option value="<?php echo get_site_url(); ?>/listings-miscellaneous" class="wpcf-form-option form-option option">Other</option>
				</select>
				</div>
				<!--<div class="go"><input type="submit" value="Go" name="wpv_filter_submit"></div>-->
			</form>
	</div>
	
	<div class="search-category">
		<script language="JavaScript"><!--
		function gotoURL() {
		  var Current =
			document.formName5.selectName5.selectedIndex;
		  window.location.href =
		  document.formName5.selectName5.options[Current].value;
		  return false;
		}
		//--></script>


		<p>Search listings by county:</p>
		<form name="formName5">

		<div class="drop"><select onchange="window.open(this.options[this.selectedIndex].value,'_top')" name="selectName5">
		<option value="">Choose a County</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=armstrong">Armstrong</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=beaver">Beaver</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=blair">Blair</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=cambria">Cambria</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=cameron">Cameron</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=centre">Centre</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=clarion">Clarion</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=clearfield">Clearfield</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=clinton">Clinton</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=crawford">Crawford</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=huntington">Huntington</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=elk">Elk</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=forest">Forest</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=indiana">Indiana</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=jefferson">Jefferson</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=lycoming">Lycoming</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=mckean">McKean</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=mercer">Mercer</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=potter">Potter</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=tioga">Tioga</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=venango">Venango</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=warren">Warren</option>
		<option value="<?php echo get_site_url(); ?>/listings/?s=westmoreland">Westmoreland</option>
		</select></div>
		<noscript><div class="go"><input
		  name="submitName5"
		  type="submit"
		  value="Go"
		  onClick="return gotoURL()"
		></div></noscript>
		</form>
	</div><!--search category-->

	<div class="search-category">
		<p>Search listings by keyword(s):</p>

		<form method="get" action="<?php echo home_url( '/' ); ?>">
			<div class="drop"><input type="text" class="keyword-search" value="Search" name="s" onFocus="this.value=''" /></div>
			<div class="go"><input type="submit" alt="search" value="Go" /></div>
		</form>
	</div>
</div><!-- advancedsearch -->
