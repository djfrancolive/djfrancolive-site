<?php
/**
 * DJ Franco theme bootstrap.
 *
 * A full-site-editing block theme. Most presentation is handled by
 * theme.json + templates/ + parts/ + patterns/. This file only wires up
 * enqueues, pattern categories, and a handful of supports.
 *
 * @package DJFranco
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DJFRANCO_VERSION', '1.0.0' );
define( 'DJFRANCO_DIR', get_stylesheet_directory() );
define( 'DJFRANCO_URI', get_stylesheet_directory_uri() );

/**
 * Theme supports. Most are opt-in via theme.json but a few still need PHP.
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus( [
		'primary' => __( 'Primary', 'djfranco' ),
		'footer'  => __( 'Footer',  'djfranco' ),
		'social'  => __( 'Social',  'djfranco' ),
	] );
} );

/**
 * Front-end enqueues. Theme stylesheet is the WP-required style.css (mostly
 * empty — real styling lives in theme.json + assets/css/theme.css).
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'djfranco-style',
		get_stylesheet_uri(),
		[],
		DJFRANCO_VERSION
	);

	wp_enqueue_style(
		'djfranco-theme',
		DJFRANCO_URI . '/assets/css/theme.css',
		[ 'djfranco-style' ],
		DJFRANCO_VERSION
	);

	wp_enqueue_script(
		'djfranco-theme',
		DJFRANCO_URI . '/assets/js/theme.js',
		[],
		DJFRANCO_VERSION,
		true
	);
}, 20 );

/**
 * Register pattern categories so our patterns show up grouped in the inserter.
 */
add_action( 'init', function () {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}
	register_block_pattern_category( 'djfranco-hero', [
		'label'       => __( 'DJ Franco · Hero', 'djfranco' ),
		'description' => __( 'Hero sections for DJ Franco Live.', 'djfranco' ),
	] );
	register_block_pattern_category( 'djfranco-section', [
		'label'       => __( 'DJ Franco · Sections', 'djfranco' ),
		'description' => __( 'Reusable content sections.', 'djfranco' ),
	] );
	register_block_pattern_category( 'djfranco-page', [
		'label'       => __( 'DJ Franco · Pages', 'djfranco' ),
		'description' => __( 'Full-page patterns.', 'djfranco' ),
	] );
} );

/**
 * Expose the site logo URL known from the WP media library as a fallback,
 * in case a site logo hasn't been set in the Customizer yet.
 */
add_filter( 'djfranco_fallback_logo_url', function ( $url ) {
	if ( $url ) {
		return $url;
	}
	return home_url( '/wp-content/uploads/2023/04/DJFrancoLogo.png' );
} );

/**
 * Helper: output the site logo URL (custom logo if set, else media fallback).
 *
 * @return string
 */
function djfranco_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $src ) {
			return $src[0];
		}
	}
	return apply_filters( 'djfranco_fallback_logo_url', '' );
}

/**
 * Auto-load all patterns in /patterns/ so we can keep them as PHP files with
 * richer templating than .html block templates allow.
 */
add_action( 'init', function () {
	$dir = DJFRANCO_DIR . '/patterns';
	if ( ! is_dir( $dir ) ) {
		return;
	}
	// WordPress core auto-registers PHP files in /patterns/ since 6.0,
	// but we also give them a cache-busting filter hook for future use.
} );

/**
 * Tiny accessibility helper: skip-link target.
 */
add_action( 'wp_body_open', function () {
	echo '<a class="skip-link screen-reader-text" href="#wp--skip-link--target">' . esc_html__( 'Skip to content', 'djfranco' ) . '</a>';
} );
