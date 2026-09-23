<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const VINEYARD_SETTINGS = 'site-settings';

/**
 * Google Fonts offered in Site Settings → Typography: label => [css family, CSS query].
 */
const VINEYARD_FONTS = [
	'heading' => [
		'Fraunces'         => [ '"Fraunces", Georgia, serif', 'Fraunces:ital,wght@0,900;1,700' ],
		'Playfair Display' => [ '"Playfair Display", Georgia, serif', 'Playfair+Display:ital,wght@0,900;1,700' ],
		'Lora'             => [ '"Lora", Georgia, serif', 'Lora:ital,wght@0,700;1,700' ],
		'DM Serif Display' => [ '"DM Serif Display", Georgia, serif', 'DM+Serif+Display:ital@0;1' ],
	],
	'body'    => [
		'Nunito'  => [ '"Nunito", "Segoe UI", sans-serif', 'Nunito:wght@600;700' ],
		'Inter'   => [ '"Inter", "Segoe UI", sans-serif', 'Inter:wght@500;700' ],
		'Lato'    => [ '"Lato", "Segoe UI", sans-serif', 'Lato:wght@400;700' ],
		'Poppins' => [ '"Poppins", "Segoe UI", sans-serif', 'Poppins:wght@500;600' ],
	],
];

const VINEYARD_DEFAULTS = [
	'color_primary'    => '#105742',
	'color_accent'     => '#a4d866',
	'color_stripe'     => '#56b099',
	'color_background' => '#ffffff',
	'font_heading'     => 'Fraunces',
	'font_body'        => 'Nunito',
	'footer_copyright' => '© {year} Famous Vineyards. All rights reserved.',
];

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'vineyard' ),
		'footer'  => __( 'Footer Menu', 'vineyard' ),
		'legal'   => __( 'Footer Legal Links', 'vineyard' ),
	] );
} );

// Header, footer, colours and typography live on one options page instead of on each page.
add_action( 'acf/init', function () {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => __( 'Site Settings', 'vineyard' ),
			'menu_title' => __( 'Site Settings', 'vineyard' ),
			'menu_slug'  => VINEYARD_SETTINGS,
			'post_id'    => VINEYARD_SETTINGS,
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-admin-customizer',
			'position'   => 59,
			'autoload'   => true,
		] );
	}
} );

/**
 * Read a global setting, falling back to the design default.
 */
function vineyard_setting( string $name ) {
	$value = function_exists( 'get_field' ) ? get_field( $name, VINEYARD_SETTINGS ) : null;
	return ( $value === null || $value === '' || $value === false ) ? ( VINEYARD_DEFAULTS[ $name ] ?? null ) : $value;
}

function vineyard_font( string $role ): array {
	$choice = vineyard_setting( 'font_' . $role );
	$fonts  = VINEYARD_FONTS[ $role ];
	return $fonts[ $choice ] ?? reset( $fonts );
}

add_action( 'wp_enqueue_scripts', function () {
	$families = array_unique( [ vineyard_font( 'heading' )[1], vineyard_font( 'body' )[1] ] );
	wp_enqueue_style( 'vineyard-fonts', 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $families ) . '&display=swap', [], null );
	wp_enqueue_style( 'vineyard', get_stylesheet_uri(), [ 'vineyard-fonts' ], wp_get_theme()->get( 'Version' ) );

	$vars = [];
	foreach ( [ 'primary', 'accent', 'stripe', 'background' ] as $key ) {
		$color = sanitize_hex_color( (string) vineyard_setting( 'color_' . $key ) );
		if ( $color ) {
			$vars[] = "--color-{$key}: {$color};";
		}
	}
	$vars[] = '--font-heading: ' . vineyard_font( 'heading' )[0] . ';';
	$vars[] = '--font-body: ' . vineyard_font( 'body' )[0] . ';';
	wp_add_inline_style( 'vineyard', ':root{' . implode( '', $vars ) . '}' );
} );

// Page content lives in the ACF "Page Sections" field, so pages use the classic screen without the content editor.
add_filter( 'use_block_editor_for_post_type', function ( $use, $post_type ) {
	return 'page' === $post_type ? false : $use;
}, 10, 2 );
add_action( 'init', function () {
	remove_post_type_support( 'page', 'editor' );
} );

/**
 * Site logo from Site Settings, falling back to the logo shipped with the theme.
 */
function vineyard_logo( string $class = '' ): void {
	$logo_id = vineyard_setting( 'site_logo' );
	$alt     = get_bloginfo( 'name' );
	if ( $logo_id ) {
		echo wp_get_attachment_image( (int) $logo_id, 'medium_large', false, [ 'class' => $class, 'alt' => $alt ] );
		return;
	}
	printf( '<img class="%s" src="%s" alt="%s" width="316" height="135">', esc_attr( $class ), esc_url( get_theme_file_uri( 'assets/images/logo.svg' ) ), esc_attr( $alt ) );
}

/**
 * Print an inline SVG from assets/icons so it inherits colour and needs no extra request.
 */
function vineyard_icon( string $name, string $class = '' ): void {
	$file = get_theme_file_path( 'assets/icons/' . sanitize_file_name( $name ) . '.svg' );
	if ( ! is_readable( $file ) ) {
		return;
	}
	$svg = (string) file_get_contents( $file );
	$svg = preg_replace( '/<svg\b/', '<svg aria-hidden="true" focusable="false"' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ), $svg, 1 );
	echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput -- trusted theme asset.
}

/**
 * Paragraph whose opening sentence is set in the bold-italic serif, as the design does throughout.
 */
function vineyard_lead_text( $lead, $text, string $class ): void {
	if ( ! $lead && ! $text ) {
		return;
	}
	echo '<p class="' . esc_attr( $class ) . '">';
	if ( $lead ) {
		echo '<span class="lead">' . esc_html( $lead ) . '</span> ';
	}
	echo esc_html( (string) $text );
	echo '</p>';
}

/**
 * Render an ACF link field as a button.
 */
function vineyard_button( $link, string $class = 'btn' ): void {
	if ( empty( $link['url'] ) ) {
		return;
	}
	printf(
		'<a class="%s" href="%s"%s>%s</a>',
		esc_attr( $class ),
		esc_url( $link['url'] ),
		! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"' : '',
		esc_html( $link['title'] ?: $link['url'] )
	);
}
