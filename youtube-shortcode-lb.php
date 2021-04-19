<?php
/**
 * Plugin Name:     Youtube Shortcode
 * Plugin URI:      https://lucasbonomo.com/
 * Description:     Just show a Youtube vidio in a Post (with a shortcode [youtube-shortcode])
 * Author:          Lucas Bonomo
 * Author URI:      https://lucasbonomo.com/
 * Text Domain:     youtube-shortcode-lb
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Youtube_Shortcode_LB
 */

// Your code starts here.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Requirements:
// The following requirements must be met to consider this code challenge completed.
//  - The shortcode must be able to receive a YouTube Video ID (f1nxZBAMpUs) as an attribute. If this attribute is present, the shortcode will display a YouTube Video Player in the post.
//  - The shortcode must be able to receive a Video URL (https://www.youtube.com/watch?v=f1nxZBAMpUs) as one of its attributes. When this attribute is present, the shortcode will display an HTML5 Video Player in the post.
//  - In both scenarios, the passed attribute is used as source for the Video Players.

function yslb_render_ID($id) {
	// Validate ID (string)
	if ( 11 === strlen($id) ) {
		return '<div class="yslb-container"> '
		. sprintf('<iframe class="yslb-iframe" src="https://www.youtube.com/embed/%s"></iframe>', $id)
		. '</div>';
	} else {
		if ( WP_DEBUG ) { error_log(__( "Youtube video ID incorrect size", "youtube-shortcode-lb" )); }
		return yslb_render_help();
	}
}

function yslb_render_URL($url) {
	// Validate URL.
	if ( wp_http_validate_url( $url ) ) {
		return '<div class="yslb-container">' . wp_video_shortcode( array('src' => $url ) ) . '</div>';
	} else {
		if ( WP_DEBUG ) { error_log(__( "URL parameter is incorrect", "youtube-shortcode-lb" )); }
		return yslb_render_help();
	}
}

function yslb_render_help() {
	return '<div class="yslb-container-error">
<h3>Error</h3>
	<p> ' . __( "For example:", "youtube-shortcode-lb" ) . '
		<ul>
			<li>[youtube-shortcode id="f1nxZBAMpUs"]</li>
			<li>[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]</li>
		</ul>
	</p>
</div>';
}

// function yslb_register_shortcode( $atts ) {
function yslb_shortcode( $atts ) {

	// Checked the number of parameters.
	if ( is_array($atts) ) {
		if (1 !== sizeof($atts)) {
			if ( WP_DEBUG ) { error_log(__( "Incorrect number of parameters", "youtube-shortcode-lb" )); }
			return yslb_render_help();
		} else {
			$valid_attributes = array('url', 'id');
			if ( ! ( array_key_exists('url', $atts) ||  array_key_exists('id', $atts) ) ) {
				if ( WP_DEBUG ) { error_log(__( "Incorrect name of parameter", "youtube-shortcode-lb" )); }
				return yslb_render_help();
			}
		}
	} else {
		if ( WP_DEBUG ) { error_log(__( "Without parameter", "youtube-shortcode-lb" )); }
		return yslb_render_help();
	}

	// Enqueue style.
	wp_enqueue_style( 'youtube-shortcode-lb', plugin_dir_url( __FILE__ ) . '/youtube-shortcode-lb.css', array(), '1.0.0', 'all' );
	
	switch (array_keys($atts)[0]) {
		case 'url':
			return yslb_render_URL($atts['url']);
		case 'id':
			return yslb_render_ID($atts['id']);
	}
}


add_action( 'init', 'yslb_register_shortcode' );
function yslb_register_shortcode() {
	add_shortcode( 'youtube-shortcode', 'yslb_shortcode' );
}