<?php
/**
 * Plugin Name:     Youtube Shortcode
 * Plugin URI:      https://lucasbonomo.com/
 * Description:     Display YouTube videos in posts with a shortcode [youtube-shortcode id="VIDEO_ID"] or [youtube-shortcode url="VIDEO_URL"]
 * Author:          Lucas Bonomo
 * Author URI:      https://lucasbonomo.com/
 * Text Domain:     youtube-shortcode-lb
 * Domain Path:     /languages
 * Version:         2.0.0
 * Requires at least: 4.5
 * Requires PHP:    7.2
 * License:         GPLv2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         Youtube_Shortcode_LB
 */

// Exit if accessed directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define plugin constants
 */
define( 'YSLB_PLUGIN_NAME', 'Youtube Shortcode' );
define( 'YSLB_PLUGIN_VERSION', '2.0.0' );
define( 'YSLB_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'YSLB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'YSLB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'YSLB_YOUTUBE_ID_LENGTH', 11 );
define( 'YSLB_YOUTUBE_ID_PATTERN', '/^[a-zA-Z0-9_-]{11}$/' );


/**
 * Extract YouTube video ID from various URL formats
 *
 * @param string $url YouTube URL.
 * @return string|false Video ID or false if invalid.
 */
function yslb_extract_video_id( $url ) {
	// Patterns for different YouTube URL formats.
	$patterns = array(
		'/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/' => 1,
		'/youtu\.be\/([a-zA-Z0-9_-]{11})/'             => 1,
		'/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/'   => 1,
		'/youtube\.com\/v\/([a-zA-Z0-9_-]{11})/'       => 1,
	);

	foreach ( $patterns as $pattern => $group ) {
		if ( preg_match( $pattern, $url, $matches ) ) {
			return $matches[ $group ];
		}
	}

	return false;
}

/**
 * Validate YouTube video ID
 *
 * @param string $id YouTube video ID.
 * @return bool True if valid, false otherwise.
 */
function yslb_is_valid_video_id( $id ) {
	return (bool) preg_match( YSLB_YOUTUBE_ID_PATTERN, $id );
}

/**
 * Build iframe HTML with security and accessibility attributes
 *
 * @param string $id      YouTube video ID.
 * @param array  $options Optional parameters (width, height, autoplay, etc).
 * @return string HTML iframe element.
 */
function yslb_build_iframe( $id, $options = array() ) {
	$defaults = array(
		'width'      => '100%',
		'height'     => 'auto',
		'autoplay'   => false,
		'controls'   => true,
		'modestbranding' => true,
		'rel'        => false,
		'title'      => __( 'YouTube video player', 'youtube-shortcode-lb' ),
	);

	$options = wp_parse_args( $options, $defaults );

	// Build iframe attributes.
	$iframe_attrs = array(
		'class'             => 'yslb-iframe',
		'src'               => esc_url( 'https://www.youtube.com/embed/' . $id . '?' . yslb_build_query_string( $options ) ),
		'width'             => absint( preg_replace( '/[^0-9]/', '', $options['width'] ) ) ?: 100,
		'height'            => 'auto' === $options['height'] ? 'auto' : absint( preg_replace( '/[^0-9]/', '', $options['height'] ) ),
		'frameborder'       => '0',
		'allow'             => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
		'allowfullscreen'   => true,
		'loading'           => 'lazy',
		'title'             => sanitize_text_field( $options['title'] ),
	);

	$attr_html = '';
	foreach ( $iframe_attrs as $key => $value ) {
		if ( true === $value ) {
			$attr_html .= ' ' . $key;
		} elseif ( false !== $value ) {
			$attr_html .= ' ' . $key . '="' . esc_attr( $value ) . '"';
		}
	}

	return '<iframe' . $attr_html . '></iframe>';
}

/**
 * Build YouTube embed query string
 *
 * @param array $options Video options.
 * @return string Query string for YouTube embed.
 */
function yslb_build_query_string( $options ) {
	$params = array();

	if ( $options['autoplay'] ) {
		$params['autoplay'] = 1;
	}

	if ( ! $options['controls'] ) {
		$params['controls'] = 0;
	}

	if ( $options['modestbranding'] ) {
		$params['modestbranding'] = 1;
	}

	if ( ! $options['rel'] ) {
		$params['rel'] = 0;
	}

	return http_build_query( $params );
}

/**
 * Render with video ID.
 *
 * @param string $id      YouTube video ID.
 * @param array  $options Optional parameters.
 * @return string HTML output.
 */
function yslb_render_id( $id, $options = array() ) {
	// Sanitize and validate ID.
	$id = sanitize_text_field( $id );

	if ( ! yslb_is_valid_video_id( $id ) ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				sprintf(
					__( '[YouTube Shortcode] Invalid video ID format: %s', 'youtube-shortcode-lb' ),
					$id
				)
			);
		}
		return yslb_render_help();
	}

	$iframe = yslb_build_iframe( $id, $options );

	return '<div class="yslb-container">' . $iframe . '</div>';
}


/**
 * Render with video URL.
 *
 * @param string $url     YouTube video URL.
 * @param array  $options Optional parameters.
 * @return string HTML output.
 */
function yslb_render_url( $url, $options = array() ) {
	// Sanitize and validate URL.
	$url = esc_url_raw( $url );

	if ( ! wp_http_validate_url( $url ) ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				sprintf(
					__( '[YouTube Shortcode] Invalid URL format: %s', 'youtube-shortcode-lb' ),
					$url
				)
			);
		}
		return yslb_render_help();
	}

	// Try to extract video ID from URL.
	$video_id = yslb_extract_video_id( $url );

	if ( ! $video_id ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				sprintf(
					__( '[YouTube Shortcode] Could not extract video ID from URL: %s', 'youtube-shortcode-lb' ),
					$url
				)
			);
		}
		return yslb_render_help();
	}

	// Use extracted video ID to render iframe.
	return yslb_render_id( $video_id, $options );
}

/**
 * Render help message with usage examples.
 *
 * @return string HTML error message.
 */
function yslb_render_help() {
	$help_html = '<div class="yslb-container-error" role="alert">';
	$help_html .= '<h3>' . esc_html__( 'YouTube Video Error', 'youtube-shortcode-lb' ) . '</h3>';
	$help_html .= '<p>' . esc_html__( 'Please use one of the following formats:', 'youtube-shortcode-lb' ) . '</p>';
	$help_html .= '<ul>';
	$help_html .= '<li><code>[youtube-shortcode id="f1nxZBAMpUs"]</code></li>';
	$help_html .= '<li><code>[youtube-shortcode url="https://www.youtube.com/watch?v=f1nxZBAMpUs"]</code></li>';
	$help_html .= '<li><code>[youtube-shortcode url="https://youtu.be/f1nxZBAMpUs"]</code></li>';
	$help_html .= '<li><code>[youtube-shortcode id="f1nxZBAMpUs" width="560" height="315" autoplay="true"]</code></li>';
	$help_html .= '</ul>';
	$help_html .= '<p><small>' . esc_html__( 'Supported attributes: width, height, autoplay, controls, modestbranding, rel', 'youtube-shortcode-lb' ) . '</small></p>';
	$help_html .= '</div>';

	return $help_html;
}

/**
 * Main shortcode handler.
 *
 * Processes [youtube-shortcode] shortcode with various parameters:
 * - id: YouTube video ID (e.g., "f1nxZBAMpUs")
 * - url: YouTube video URL (e.g., "https://www.youtube.com/watch?v=f1nxZBAMpUs")
 * - width: iframe width (default: 100%)
 * - height: iframe height (default: auto)
 * - autoplay: Enable autoplay (true/false, default: false)
 * - controls: Show video controls (true/false, default: true)
 * - modestbranding: Minimal YouTube branding (true/false, default: true)
 * - rel: Show related videos (true/false, default: false)
 *
 * @param array  $atts    Shortcode attributes.
 * @param string $content Shortcode content (unused).
 * @return string Rendered HTML or error message.
 */
function yslb_shortcode( $atts, $content = '' ) {
	// Normalize attributes.
	$atts = shortcode_atts(
		array(
			'id'               => '',
			'url'              => '',
			'width'            => '100%',
			'height'           => 'auto',
			'autoplay'         => false,
			'controls'         => true,
			'modestbranding'   => true,
			'rel'              => false,
		),
		$atts,
		'youtube-shortcode'
	);

	// Validate that either 'id' or 'url' is provided.
	if ( empty( $atts['id'] ) && empty( $atts['url'] ) ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				__( '[YouTube Shortcode] Neither "id" nor "url" attribute provided', 'youtube-shortcode-lb' )
			);
		}
		return yslb_render_help();
	}

	// Prevent both attributes from being used simultaneously.
	if ( ! empty( $atts['id'] ) && ! empty( $atts['url'] ) ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log(
				__( '[YouTube Shortcode] Both "id" and "url" attributes provided. Use only one.', 'youtube-shortcode-lb' )
			);
		}
		return yslb_render_help();
	}

	// Prepare options for iframe rendering.
	$options = array(
		'width'            => $atts['width'],
		'height'           => $atts['height'],
		'autoplay'         => filter_var( $atts['autoplay'], FILTER_VALIDATE_BOOLEAN ),
		'controls'         => filter_var( $atts['controls'], FILTER_VALIDATE_BOOLEAN ),
		'modestbranding'   => filter_var( $atts['modestbranding'], FILTER_VALIDATE_BOOLEAN ),
		'rel'              => filter_var( $atts['rel'], FILTER_VALIDATE_BOOLEAN ),
	);

	// Enqueue stylesheet.
	wp_enqueue_style(
		'youtube-shortcode-lb',
		YSLB_PLUGIN_URL . 'youtube-shortcode-lb.css',
		array(),
		YSLB_PLUGIN_VERSION,
		'all'
	);

	// Route to appropriate render function.
	if ( ! empty( $atts['id'] ) ) {
		return yslb_render_id( $atts['id'], $options );
	} else {
		return yslb_render_url( $atts['url'], $options );
	}
}


/**
 * Load plugin text domain for translations.
 *
 * @return void
 */
function yslb_load_textdomain() {
	load_plugin_textdomain(
		'youtube-shortcode-lb',
		false,
		dirname( YSLB_PLUGIN_BASENAME ) . '/languages'
	);
}

/**
 * Hook: Register shortcode and load text domain.
 */
add_shortcode( 'youtube-shortcode', 'yslb_shortcode' );
add_action( 'init', 'yslb_load_textdomain' );
