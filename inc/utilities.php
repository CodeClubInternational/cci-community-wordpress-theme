<?php
/**
 * WordPress Utility functions
 */
function get_nav_menu_by_location( $location ) {
	$locations = get_nav_menu_locations();
	$menu_id = $locations[ $location ] ;
	return wp_get_nav_menu_object( $menu_id );
}

function nav_menu_name_by_location( $location ) {
	$nav_menu = get_nav_menu_by_location( $location );
	echo $nav_menu->name;
}

function get_codeclub_asset_uri() {
	return esc_url( get_template_directory_uri() ) . '/bower_components/code-club/dist';
}


/**
 * General Utility functions
 */

/**
 * @param string $h  HTTP headers as a string
 * @param string $url optional base URL to resolve relative URLs
 * @return array $rels rel values as indices to arrays of URLs, empty array if no rels at all
 */
function http_rels( $h, $url = '' ) {
	$h = preg_replace( "/(\r\n|\r)/", "\n", $h );
	$h = explode( "\n", preg_replace( "/(\n)[ \t]+/", ' ', $h ) );
	$rels = array();
	foreach ( $h as $f ) {
		$links = explode( ', ', $f );
		foreach ( $links as $link ) {
			$hrefandrel = explode( '; ', $link );
			$href = trim( $hrefandrel[0], '<>' );
			$relarray = '';
			foreach ( $hrefandrel as $p ) {
				if ( ! strncmp( $p, 'rel=', 4 ) ) {
					$relarray = explode( ' ', trim( substr( $p, 4 ), '"\'' ) );
					break;
				}
			}
			if ( $relarray !== '' ) { // ignore Link: headers without rel
				foreach ( $relarray as $rel ) {
					$rel = strtolower( trim( $rel ) );
					if ( $rel != '' ) {
						if ( ! array_key_exists( $rel, $rels ) ) {
							$rels[ $rel ] = array();
						}
						if ( $url ) {
							$href = get_absolute_uri( $href, $url );
						}
						if ( ! in_array( $href, $rels[ $rel ] ) ) {
							$rels[ $rel ][] = $href;
						}
					}
				}
			}
		}
	}
	return $rels;
}
