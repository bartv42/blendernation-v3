<?php

/***
 * Linkblock formatting 
 */
function links_shortcode( $atts, $content = null ) {
	
	/* count number of <li> elements to determine number of included links */
	$links = substr_count( $content, '<li>');

	$title = $links==1?'Link':'Links';	
	return '<div class="links_block"><h3>' . $title . ' <i class="fa fa-external-link-square"></i></h3>' . $content . '</div>';
}

add_shortcode( 'links', 'links_shortcode' );	
	
?>