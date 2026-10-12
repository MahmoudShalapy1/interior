<?php
/**
 * Block Pattern Categories and Loader
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom block pattern categories
 */
function interior_register_pattern_categories() {
	$categories = array(
		'interior-hero' => array(
			'label' => __( 'INTERIOR — الافتتاحية المعمارية (Hero & Reveal)', 'blockskit-child' ),
		),
		'interior-narrative' => array(
			'label' => __( 'INTERIOR — السرد والمعايير (Narrative & Manifesto)', 'blockskit-child' ),
		),
		'interior-projects' => array(
			'label' => __( 'INTERIOR — المشاريع الفاخرة (Runway & Gallery)', 'blockskit-child' ),
		),
		'interior-execution' => array(
			'label' => __( 'INTERIOR — التنفيذ والسيطرة (Execution & Standards)', 'blockskit-child' ),
		),
		'interior-conversion' => array(
			'label' => __( 'INTERIOR — التأهيل والحجز (Brief Funnel & Qualification)', 'blockskit-child' ),
		),
		'interior-footer' => array(
			'label' => __( 'INTERIOR — التوقيع والفوتر (Architectural Signature)', 'blockskit-child' ),
		),
	);

	foreach ( $categories as $slug => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $slug ) ) {
			register_block_pattern_category( $slug, $properties );
		}
	}
}
add_action( 'init', 'interior_register_pattern_categories' );

/**
 * Register all patterns in patterns/ directory
 */
function interior_register_theme_patterns() {
	$pattern_files = glob( get_stylesheet_directory() . '/patterns/*.php' );

	if ( empty( $pattern_files ) ) {
		return;
	}

	foreach ( $pattern_files as $file ) {
		$headers = get_file_data(
			$file,
			array(
				'title'       => 'Title',
				'slug'        => 'Slug',
				'categories'  => 'Categories',
				'keywords'    => 'Keywords',
				'description' => 'Description',
			)
		);

		if ( empty( $headers['slug'] ) ) {
			$headers['slug'] = 'blockskit-child/' . basename( $file, '.php' );
		}

		if ( empty( $headers['title'] ) ) {
			$headers['title'] = basename( $file, '.php' );
		}

		$categories = ! empty( $headers['categories'] ) ? array_map( 'trim', explode( ',', $headers['categories'] ) ) : array( 'interior-narrative' );
		$keywords   = ! empty( $headers['keywords'] ) ? array_map( 'trim', explode( ',', $headers['keywords'] ) ) : array();

		// Capture pattern rendered content
		ob_start();
		include $file;
		$content = ob_get_clean();

		// Strip PHP opening comment header from rendered output
		$content = preg_replace( '#<\?php[\s\S]*?\?>#', '', $content, 1 );

		register_block_pattern(
			$headers['slug'],
			array(
				'title'       => $headers['title'],
				'categories'  => $categories,
				'keywords'    => $keywords,
				'description' => $headers['description'],
				'content'     => $content,
			)
		);
	}
}
add_action( 'init', 'interior_register_theme_patterns', 20 );
