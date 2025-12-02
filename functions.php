<?php



// Register Script
function custom_scripts() {
	wp_register_script( 'custom', get_template_directory_uri() . '/scripts.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom' );
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_scripts' );


include 'shortcodes.php'; 

//force one column in dashboard

function so_screen_layout_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );

function so_screen_layout_dashboard() {
    return 1;
}
add_filter( 'get_user_option_screen_layout_dashboard', 'so_screen_layout_dashboard' );

//only enable h3,h4,h5,p

function wpa_45815($arr){
    $arr['theme_advanced_blockformats'] = 'p,h3,h4,h5';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'wpa_45815');

//remove the windows from the edit page/post screen

function remove_page_excerpt_field() {
	remove_meta_box( 'authordiv' , 'page' , 'normal' ); 
	remove_meta_box( 'authordiv' , 'post' , 'normal' );
	remove_meta_box( 'categorydiv' , 'page' , 'normal' ); 
	remove_meta_box( 'categorydiv' , 'page' , 'side' ); 
	remove_meta_box( 'categorydiv' , 'post' , 'normal' );
	remove_meta_box( 'categorydiv' , 'post' , 'side' );
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); 
	remove_meta_box( 'commentsdiv' , 'post' , 'normal' ); 
	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); 
	remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' ); 
	remove_meta_box( 'pageparentdiv', 'page', 'normal' );
	remove_meta_box( 'pageparentdiv', 'page', 'side' );
	remove_meta_box( 'pageparentdiv', 'post', 'normal' );
	remove_meta_box( 'pageparentdiv', 'post', 'side' );
	remove_meta_box( 'postcustom' , 'hunting-properties', 'normal' );
	remove_meta_box( 'postcustom' , 'page' , 'normal' ); 
	remove_meta_box( 'postcustom' , 'post' , 'normal' );
	remove_meta_box( 'postexcerpt' , 'page' , 'normal' ); 
	remove_meta_box( 'postexcerpt' , 'post' , 'normal' );;
	remove_meta_box( 'revisionsdiv' , 'page' , 'normal' ); 
	remove_meta_box( 'revisionsdiv' , 'post' , 'normal' );
	remove_meta_box( 'slugdiv' , 'page' , 'normal' ); 
	remove_meta_box( 'slugdiv' , 'post' , 'normal' );
	remove_meta_box( 'tagsdiv-post_tag' , 'page' , 'normal' ); 
	remove_meta_box( 'tagsdiv-post_tag' , 'page' , 'side' ); 
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' );
	remove_meta_box( 'trackbacksdiv' , 'page' , 'normal' ); 
	remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); 
	remove_meta_box( 'wpseo_meta', 'hunting-properties', 'normal' );
	remove_meta_box( 'wpseo_meta', 'hunting-properties', 'side' );
	remove_meta_box( 'wpseo_meta', 'page', 'normal' );
	remove_meta_box( 'wpseo_meta', 'page', 'side' );
	remove_meta_box( 'wpseo_meta', 'post', 'normal' );
	remove_meta_box( 'wpseo_meta', 'post', 'side' );
}

if (!current_user_can('manage_options')) {
      add_action( 'admin_head' , 'remove_page_excerpt_field' );
}

add_action( 'after_setup_theme', function(){
    // this removes the feature image panel from all your post types 
    // including 'post'
    remove_theme_support( 'post-thumbnails' );

}, 11 );


if ( !current_user_can('manage_options') ) {
add_action('init', 'remove_content_template');
function remove_content_template() {
 global $WPV_templates;
 remove_action('admin_head', array($WPV_templates,'post_edit_template_options'));            
}
}



//Removes menu options for Editors (or anyone that is not an admin)

function remove_menus () {
global $menu;
	$restricted = array(__('Links'),__('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}

if (!current_user_can('manage_options')) {
       add_action('admin_menu', 'remove_menus');
}


function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo "<p>The following is basic instructions for running the website. Enjoy! :)<br>You can view the document directly to print at: <a href=\"https://docs.google.com/document/d/1XQ1OyRR0CjJ8L30YDJZBnE62vayP2VRTKVXeTquPNyA/edit\">LINK</a></p><iframe src=\"https://docs.google.com/document/pub?id=1XQ1OyRR0CjJ8L30YDJZBnE62vayP2VRTKVXeTquPNyA&amp;embedded=true\" width=\"100%\" height=\"700px\"></iframe>";
} 

// Create the function use in the action hook
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'Blue Sky Website Documentation', 'example_dashboard_widget_function');
}
// Hoook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );



// disable default dashboard widgets
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) )
require_once($locale_file);
function blankslate_get_page_number() {
if (get_query_var('paged')) {
print ' | ' . __( 'Page ' , 'blankslate') . get_query_var('paged');
}
}
add_action( 'after_setup_theme', 'blankslate_theme_setup' );
function blankslate_theme_setup() {
add_theme_support( 'automatic-feed-links' );
}
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
}

function blankslate_register_menus() {
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ))
);
}
add_action( 'init', 'blankslate_register_menus' );
function blankslate_theme_widgets_init() {
register_sidebar( array (
'name' => 'Primary Widget Area',
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'init', 'blankslate_theme_widgets_init' );
$preset_widgets = array (
'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
if ( isset( $_GET['activated'] ) ) {
update_option( 'sidebars_widgets', $preset_widgets );
}
function blankslate_cats($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}
function blankslate_tags($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}
function blankslate_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function blankslate_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;


?>


<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php blankslate_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep"> | </span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'blankslate'),
get_comment_date(),
get_comment_time(),
'#comment-' . get_comment_ID() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'blankslate') ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','blankslate'),
'login_text' => __('Log in to reply.','blankslate'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function blankslate_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'blankslate'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'blankslate') ?>
<div class="comment-content">
<?php comment_text() ?>
</div>



<?php }