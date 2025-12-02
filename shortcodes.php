<?php




  
//[sectionbreak]
function sectionbreak()
{
	return '<div class="section-break"></div>';
}

add_shortcode('sectionbreak', 'sectionbreak');

//[clearfloats]
function clearfloats()
{
	return '<br clear="all" />';
}

add_shortcode('clearfloats', 'clearfloats');

//[button][/button]
//Shortcode to produce a styled button
    
function button_shortcode( $atts, $content = null ) {
    
/*
Supported Attributes
size    =>  large, medium, small
color   =>  gold, black, blue, green, grey, orange, pink, red, white
target  =>  _self, _blank
*/
	
	extract( shortcode_atts( array(
		'size' => 'medium',
		'color' => 'gold',
		'url' => '#',
        'target' => '_self',
        'rel' => ''
	), $atts ) );   
     
return '<a target="' . $target . '" class="button button-'. $size .' button-'. $color .'" href="'. $url .'"' . $rel . '>'. $content .'</a>';
    }
    
add_shortcode('button', 'button_shortcode');

//[textbox][/textbox]
//box shortcode

add_shortcode('box', 'box_shortcode');

function box_shortcode( $atts, $content = null ) {

/*
	Supported Attributes
	    style   =>  blue, green, grey, red, tan, yellow	-> creates boxes using only those colors
		OR
	    style   =>  alert, comment, download, info, tip	-> boxes with the corresponding icon to the left of the text
*/

extract( shortcode_atts( array(
		'style' => 'blue',		
	), $atts ) );

	return '<div class="box box-' . $style . '">' . '<p class="box-content">' . $content .'</p></div>';
} //end box shortcode

//[one-half],[one-third],[two-thirds],[one-fourth],[two-fourths],[three-fourths],[one-fifth],[two-fifths],[three-fifths],[four-fifths]
//columns shortcode
     
add_shortcode('one-half', 'one_half_shortcode');
add_shortcode('one-third', 'one_third_shortcode');
add_shortcode('two-thirds', 'two_thirds_shortcode');
add_shortcode('one-fourth', 'one_fourth_shortcode');
add_shortcode('two-fourths', 'two_fourths_shortcode');
add_shortcode('three-fourths', 'three_fourths_shortcode');
add_shortcode('one-fifth', 'one_fifth_shortcode');
add_shortcode('two-fifths', 'two_fifths_shortcode');
add_shortcode('three-fifths', 'three_fifths_shortcode');
add_shortcode('four-fifths', 'four_fifths_shortcode');
     
    function one_half_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-one-half'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

    
//Shortcode to display a 1/3 column    
  
    function one_third_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-one-third'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }


//Shortcode to display a 2/3 column
  
    function two_thirds_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-two-thirds'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 1/4 column
  
    function one_fourth_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-one-fourth'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 2/4 column
  
    function two_fourths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-two-fourths'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 3/4 column
  
    function three_fourths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-three-fourths'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 1/5 column
  
    function one_fifth_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-one-fifth'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 2/5 column
  
    function two_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-two-fifths'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 3/5 column
  
    function three_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-three-fifths'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }

//Shortcode to display a 4/5 column
  
    function four_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' column-last'; }

	$return = '<div class="column-four-fifths'. $last .'">'. remove_wpautop( $content ) . '</div>';

	return $return;
    }
    

    
/******************************************************
     *  Helper Functions
     ******************************************************/

    /* Remove the wpautop from shortcodes */
    function remove_wpautop( $content ) {
	$content = do_shortcode( shortcode_unautop( $content ) );
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
	return $content;
    }

?>