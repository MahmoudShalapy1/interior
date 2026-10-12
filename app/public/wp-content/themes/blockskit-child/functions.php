<?php
/**
 * Blockskit Child Theme functions and definitions
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// 1. Hide WordPress Admin Bar for all visitors and preview
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Enqueue parent and child theme styles and luxury landing assets.
 */
function blockskit_child_enqueue_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	$deps = array();
	// Standalone & Child Theme Dual Compatibility (Section 14 & Phase 11)
	if ( get_template_directory() !== get_stylesheet_directory() && file_exists( get_template_directory() . '/style.css' ) ) {
		wp_enqueue_style(
			'blockskit-parent-style',
			get_template_directory_uri() . '/style.css'
		);
		$deps[] = 'blockskit-parent-style';
	}

	// Enqueue main theme stylesheet
	wp_enqueue_style(
		'blockskit-child-style',
		get_stylesheet_uri(),
		$deps,
		$theme_version
	);

	// 1. Core Architectural Design Tokens
	wp_enqueue_style(
		'interior-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		array( 'blockskit-child-style' ),
		$theme_version
	);

	// 2. Editorial Typography & Arabic Ligature Protection
	wp_enqueue_style(
		'interior-typography',
		get_stylesheet_directory_uri() . '/assets/css/typography.css',
		array( 'interior-tokens' ),
		$theme_version
	);

	// 3. Architectural Layout Engine & Grids
	wp_enqueue_style(
		'interior-layout',
		get_stylesheet_directory_uri() . '/assets/css/luxury-layout.css',
		array( 'interior-typography' ),
		$theme_version
	);

	// 4. Architectural UI Components
	wp_enqueue_style(
		'interior-components',
		get_stylesheet_directory_uri() . '/assets/css/components.css',
		array( 'interior-layout' ),
		$theme_version
	);

	// 5. Architectural Micro-Interactions & Animations
	wp_enqueue_style(
		'interior-interactions',
		get_stylesheet_directory_uri() . '/assets/css/interactions.css',
		array( 'interior-components' ),
		$theme_version
	);

	// 6. Luxury Core Page Styles
	wp_enqueue_style(
		'luxury-core-css',
		get_stylesheet_directory_uri() . '/assets/css/luxury-core.css',
		array( 'interior-interactions' ),
		$theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/css/luxury-core.css' )
	);

	// 7. Architectural Section Patterns Styles
	wp_enqueue_style(
		'interior-patterns',
		get_stylesheet_directory_uri() . '/assets/css/patterns.css',
		array( 'luxury-core-css' ),
		$theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/css/patterns.css' )
	);

	// 8. Sovereign Bilingual Architecture Styles
	wp_enqueue_style(
		'interior-i18n-style',
		get_stylesheet_directory_uri() . '/assets/css/i18n.css',
		array( 'interior-patterns' ),
		$theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/css/i18n.css' )
	);

	// --- VENDOR SCRIPTS (Local) ---
	wp_enqueue_script(
		'interior-lenis',
		get_stylesheet_directory_uri() . '/assets/js/vendor/lenis.min.js',
		array(),
		'1.1.18',
		true
	);

	wp_enqueue_script(
		'interior-gsap',
		get_stylesheet_directory_uri() . '/assets/js/vendor/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	wp_enqueue_script(
		'interior-scrolltrigger',
		get_stylesheet_directory_uri() . '/assets/js/vendor/ScrollTrigger.min.js',
		array( 'interior-gsap' ),
		'3.12.5',
		true
	);

	// --- CORE FRAMEWORK ---
	wp_enqueue_script(
		'interior-core-js',
		get_stylesheet_directory_uri() . '/assets/js/core.js',
		array( 'interior-lenis', 'interior-gsap', 'interior-scrolltrigger' ),
		$theme_version,
		true
	);

	// --- INTERACTIVE MODULES ---
	wp_enqueue_script(
		'interior-header-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/header.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-curtain-menu-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/curtain-menu.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-cursor-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/cursor.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-minimap-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/minimap.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-whatsapp-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/whatsapp.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-transitions-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/transitions.js',
		array( 'interior-core-js' ),
		$theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/js/modules/transitions.js' ),
		true
	);

	wp_enqueue_script(
		'interior-hero-lens-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/hero-lens.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-manifesto-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/manifesto.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-scroll-story-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/scroll-story.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-counter-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/counter.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-runway-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/horizontal-runway.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-light-study-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/light-study.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-compare-slider-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/compare-slider.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-funnel-qualification-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/funnel-qualification.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-portfolio-filter-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/portfolio-filter.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-faq-accordion-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/faq-accordion.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-services-preview-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/services-preview.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-private-brief-wizard-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/private-brief-wizard.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-theme-switcher-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/theme-switcher.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-demo-mode-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/demo-mode.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'interior-i18n-js',
		get_stylesheet_directory_uri() . '/assets/js/modules/i18n.js',
		array( 'interior-core-js' ),
		$theme_version,
		true
	);

	// --- MASTER ORCHESTRATOR ---
	wp_enqueue_script(
		'interior-main-js',
		get_stylesheet_directory_uri() . '/assets/js/main.js',
		array(
			'interior-core-js',
			'interior-header-js',
			'interior-curtain-menu-js',
			'interior-cursor-js',
			'interior-minimap-js',
			'interior-whatsapp-js',
			'interior-transitions-js',
			'interior-hero-lens-js',
			'interior-manifesto-js',
			'interior-scroll-story-js',
			'interior-counter-js',
			'interior-runway-js',
			'interior-light-study-js',
			'interior-compare-slider-js',
			'interior-funnel-qualification-js',
			'interior-portfolio-filter-js',
			'interior-faq-accordion-js',
			'interior-services-preview-js',
			'interior-private-brief-wizard-js',
			'interior-theme-switcher-js',
			'interior-demo-mode-js',
			'interior-i18n-js',
		),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'blockskit_child_enqueue_styles' );
// Include modular theme components
require_once get_stylesheet_directory() . '/inc/helpers.php';
require_once get_stylesheet_directory() . '/inc/post-types.php';
require_once get_stylesheet_directory() . '/inc/patterns-loader.php';
require_once get_stylesheet_directory() . '/inc/seo.php';
require_once get_stylesheet_directory() . '/inc/i18n.php';
require_once get_stylesheet_directory() . '/inc/dynamic-admin.php';
require_once get_stylesheet_directory() . '/inc/seed-data.php';

/**
 * Setup Child Theme features
 */
function blockskit_child_setup() {
	// Add editor styles support
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/luxury-core.css' );

	// Block theme enhancements
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'blockskit_child_setup' );

/**
 * Performance Optimization: Defer Non-Critical Frontend Scripts (Core Web Vitals)
 */
function interior_defer_non_critical_scripts( $tag, $handle, $src ) {
	if ( is_admin() ) {
		return $tag;
	}
	// Defer all theme scripts to guarantee strict HTML-order execution
	if ( 0 === strpos( $handle, 'interior-' ) && false === strpos( $tag, 'defer' ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'interior_defer_non_critical_scripts', 10, 3 );

/**
 * Direct Template Routing for Singular Posts and Projects
 */
function interior_custom_singular_templates( $template ) {
	if ( is_page( 'articles' ) ) {
		$articles_page = get_stylesheet_directory() . '/page-templates/articles.php';
		if ( file_exists( $articles_page ) ) {
			return $articles_page;
		}
	}
	if ( is_singular( 'post' ) ) {
		$single_post = get_stylesheet_directory() . '/single.php';
		if ( file_exists( $single_post ) ) {
			return $single_post;
		}
	}
	if ( is_singular( 'project' ) ) {
		$single_project = get_stylesheet_directory() . '/single-project.php';
		if ( file_exists( $single_project ) ) {
			return $single_project;
		}
	}
	return $template;
}
add_filter( 'template_include', 'interior_custom_singular_templates', 99 );

/**
 * Performance & Core Web Vitals: Remove Unused WordPress Frontend Bloat
 */
function interior_clean_wp_frontend_bloat() {
	if ( is_admin() ) {
		return;
	}
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'interior_clean_wp_frontend_bloat' );

function interior_dequeue_unused_block_styles() {
	if ( is_admin() ) {
		return;
	}
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'interior_dequeue_unused_block_styles', 100 );

/**
 * Best Practices & Security Headers
 */
function interior_send_best_practice_headers() {
	if ( is_admin() || headers_sent() ) {
		return;
	}
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'X-Frame-Options: SAMEORIGIN' );
}
add_action( 'send_headers', 'interior_send_best_practice_headers' );

/**
 * Core Web Vitals & Accessibility HTML Optimizer:
 * Automatically ensures every <img> has explicit width, height, decoding="async", and loading="lazy" (for non-LCP images).
 */
function interior_optimize_rendered_html( $html ) {
	if ( empty( $html ) || false === strpos( $html, '<img' ) ) {
		return $html;
	}

	static $img_dims_cache = null;
	if ( null === $img_dims_cache ) {
		$img_dims_cache = array();
		$img_dir_path   = get_stylesheet_directory() . '/assets/images/';
		if ( is_dir( $img_dir_path ) ) {
			foreach ( glob( $img_dir_path . '*.{jpg,jpeg,png,webp}', GLOB_BRACE ) as $file ) {
				$size = @getimagesize( $file );
				if ( $size && ! empty( $size[0] ) && ! empty( $size[1] ) ) {
					$img_dims_cache[ basename( $file ) ] = array( (int) $size[0], (int) $size[1] );
				}
			}
		}
	}

	$html = preg_replace_callback( '/<img\b([^>]*)>/i', function ( $matches ) use ( $img_dims_cache ) {
		$attrs = $matches[1];
		$is_self_closing = ( '/' === substr( rtrim( $attrs ), -1 ) );
		if ( $is_self_closing ) {
			$attrs = rtrim( substr( rtrim( $attrs ), 0, -1 ) );
		}

		// 1. Add width & height if missing (prevents CLS)
		if ( ! preg_match( '/\bwidth\s*=/i', $attrs ) || ! preg_match( '/\bheight\s*=/i', $attrs ) ) {
			$w = 1600;
			$h = 1000;
			if ( preg_match( '/\bsrc\s*=\s*["\']([^"\']+)["\']/i', $attrs, $src_m ) ) {
				$filename = basename( wp_parse_url( $src_m[1], PHP_URL_PATH ) );
				if ( isset( $img_dims_cache[ $filename ] ) ) {
					$w = $img_dims_cache[ $filename ][0];
					$h = $img_dims_cache[ $filename ][1];
				}
			}
			if ( ! preg_match( '/\bwidth\s*=/i', $attrs ) ) {
				$attrs .= ' width="' . $w . '"';
			}
			if ( ! preg_match( '/\bheight\s*=/i', $attrs ) ) {
				$attrs .= ' height="' . $h . '"';
			}
		}

		// 2. Add decoding="async" if missing
		if ( ! preg_match( '/\bdecoding\s*=/i', $attrs ) ) {
			$attrs .= ' decoding="async"';
		}

		// 3. Add loading="lazy" to non-LCP images
		$is_lcp = ( false !== stripos( $attrs, 'fetchpriority="high"' ) || false !== stripos( $attrs, 'luxe-hero__bg' ) );
		if ( ! $is_lcp && ! preg_match( '/\bloading\s*=/i', $attrs ) ) {
			$attrs .= ' loading="lazy"';
		}

		return '<img' . $attrs . '>';
	}, $html );

	return $html;
}

function interior_start_html_optimizer_buffer() {
	if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}
	$req = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) : '';
	if ( '/sitemap.xml' === $req || '/robots.txt' === $req ) {
		return;
	}
	ob_start( 'interior_optimize_rendered_html' );
}
add_action( 'template_redirect', 'interior_start_html_optimizer_buffer', 2 );

