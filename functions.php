<?php

define("BN_ADS", "adsense");
//define("BN_ADS", "dfp");

$content_width = 728;
add_image_size('main-slider', 728, 336, true);

/* headers custom post type */
register_post_type('headers', array(	'label' => 'Headers','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => 'headers'),'query_var' => true,'has_archive' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'labels' => array (
  'name' => 'Headers',
  'singular_name' => 'Header',
  'menu_name' => 'Headers',
  'add_new' => 'Add Header',
  'add_new_item' => 'Add New Header',
  'edit' => 'Edit',
  'edit_item' => 'Edit Header',
  'new_item' => 'New Header',
  'view' => 'View Header',
  'view_item' => 'View Header',
  'search_items' => 'Search Headers',
  'not_found' => 'No Headers Found',
  'not_found_in_trash' => 'No Headers Found in Trash',
  'parent' => 'Parent Header',
),) );


/***
 * Returns header graphic, either for today, or in the case of single posts for the post's date.
 */
function bn_get_header() {


//	$wp_query->post->ID;

	// get timestamp of current post, or of current moment
	global $post; 

	if( ('headers' == get_post_type( $post )) ) {
		$header = $post;		
	} else {

		if( ('post' == get_post_type( $post )) ) {
			$dateTime = DateTime::createfromformat( 'Y-m-d H:i:s',$post->post_date);
			$timestamp = $dateTime->getTimeStamp();
		} else {
			$timestamp = time();
		}
		
		$date = getdate ( $timestamp );
		$args = array(
			'post_type' => 'headers',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'date_query' => array(
					array(
						'before'    => array(
							'year'  => $date['year'],
							'month' => $date['mon'],
							'day'   => $date['mday'],
						
						),
						'inclusive' => true,
					),		
				)
		);

		$loop = new WP_Query( $args );

		$header = $loop->posts[0];
	}
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $header->ID ), 'single-post-thumbnail' );
		
	$strHeaderImage = $image[0];	
	$strDescription = $header->post_title;

	$strHeaderLink = get_post_meta($header->ID, 'header_link', true );
	
	if( $strHeaderLink != '' ) {
		$strLink = $strHeaderLink;
		$strHeaderNoLink = 1;
		
	} else {
		$strLink = get_permalink( $header->ID);
		$strHeaderNoLink = get_post_meta($post->ID, 'header_no_link', true );
	}
		
	$data = array(
		'img_src' => $strHeaderImage,
		'description' => $strDescription,
		'link' => $strLink, 
		'no_link' => $strHeaderNoLink,
		'comment_count' => $header->comment_count
	);	
				
					
	return(	$data );
}

/* management */

// http://yoast.com/custom-post-type-snippets/

// Change the columns for the edit Headers screen
function change_columns( $cols ) {
  $cols = array(
    'cb'       => '<input type="checkbox" />',
    'title'      => __( 'Title',      'trans' ),
    'image' => __( 'Image', 'trans' ),
	'comments'	=> __( 'Comments',      'trans' ),
	'published-time'	=> __( 'Published',      'trans' ),
  );
  return $cols;
}
add_filter( "manage_headers_posts_columns", "change_columns" );

function custom_columns( $column, $post_id ) {
    global $post;

	switch ( $column ) {
		case "image":
		echo wp_get_attachment_image( get_post_thumbnail_id( $post_ID ), array( 250, 100 ) );
		break;

	}
}

add_action( "manage_posts_custom_column", "custom_columns", 10, 2 );

// Get URL of first image in a post
function first_image_src($post) {

	$content = $post->post_content;
//	return $content;

	$output = preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/', $post->post_content, $matches);
	$first_img = $matches[1][0];

	// no image found display default image instead
	if(empty($first_img)){
		$first_img = "http://www.blendernation.com/wp-content/themes/twentyeleven-bn/images/blendernation-logo.png";
	}
	return $first_img;
}


/* vimeo hotfix */
function fix_vimeo_oembed_providers( $providers ) {
	$providers['#http://(www\.)?vimeo\.com/.*#i'] = array( 'http://vimeo.com/api/oembed.{format}', true  );
	return $providers;
}
add_filter('oembed_providers', 'fix_vimeo_oembed_providers');


/* change search order back to date */
function my_search_query( $query ) {
	// not an admin page and is the main query
	if ( !is_admin() && $query->is_main_query() ) {
		if ( is_search() ) {
			$query->set( 'orderby', 'date' );
		}
	}
}
add_action( 'pre_get_posts', 'my_search_query' );

/**
 * I want to use the basic 2012 theme but don't want TinyMCE to create
 * unwanted HTML. By removing editor-style.css from the $editor_styles
 * global, this code effectively undoes the call to add_editor_style()
 */
add_action( 'after_setup_theme', 'foobar_setup', 11 );
function foobar_setup() {
  global $editor_styles;
  $editor_styles = array();
}
?>
