<?php
/**
 * Theme Helper Utilities
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Format Arabic numerals or retain western digits cleanly.
 *
 * @param int|string $number
 * @return string
 */
function interior_format_number( $number ) {
	return number_format_i18n( (float) $number );
}

/**
 * Render an inline SVG icon with consistent stroke and accessibility.
 *
 * @param string $icon Name of the icon.
 * @param array  $attrs Additional HTML attributes.
 * @return string
 */
function interior_get_svg( $icon, $attrs = array() ) {
	$class = isset( $attrs['class'] ) ? esc_attr( $attrs['class'] ) : 'luxe-svg-icon';
	$width = isset( $attrs['width'] ) ? esc_attr( $attrs['width'] ) : '20';
	$height = isset( $attrs['height'] ) ? esc_attr( $attrs['height'] ) : '20';

	$icons = array(
		'arrow-left' => '<svg class="' . $class . '" width="' . $width . '" height="' . $height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
		'arrow-right' => '<svg class="' . $class . '" width="' . $width . '" height="' . $height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
		'check' => '<svg class="' . $class . '" width="' . $width . '" height="' . $height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>',
		'compass' => '<svg class="' . $class . '" width="' . $width . '" height="' . $height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>',
		'shield' => '<svg class="' . $class . '" width="' . $width . '" height="' . $height . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
	);

	return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Custom ACF JSON Save Point (Section 14 Local JSON)
 */
function interior_acf_json_save_point( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'interior_acf_json_save_point' );

/**
 * Custom ACF JSON Load Point
 */
function interior_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'interior_acf_json_load_point' );

/**
 * ------------------------------------------------------------------------
 * Dynamic Localized Data Helpers
 * ------------------------------------------------------------------------
 */

/**
 * Get localized studio option
 */
function interior_get_studio_option( $key_ar, $key_en = '', $default = '' ) {
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang && ! empty( $key_en ) ) {
		$val = get_option( $key_en );
		if ( ! empty( $val ) ) {
			return $val;
		}
	}
	$val = get_option( $key_ar );
	return ! empty( $val ) ? $val : $default;
}

/**
 * Get localized project title
 */
function interior_get_project_title( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_title = get_post_meta( $post_id, '_project_title_en', true );
		if ( ! empty( $en_title ) ) {
			return $en_title;
		}
	}
	return get_the_title( $post_id );
}

/**
 * Get localized project excerpt/narrative
 */
function interior_get_project_excerpt( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_desc = get_post_meta( $post_id, '_project_desc_en', true );
		if ( ! empty( $en_desc ) ) {
			return $en_desc;
		}
	}
	return get_the_excerpt( $post_id );
}

/**
 * Get localized project location
 */
function interior_get_project_location( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$loc = get_post_meta( $post_id, '_project_location_en', true );
		if ( ! empty( $loc ) ) {
			return $loc;
		}
	}
	return get_post_meta( $post_id, '_project_location', true ) ?: 'الرياض';
}

/**
 * Get localized project area
 */
function interior_get_project_area( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$area = get_post_meta( $post_id, '_project_area_en', true );
		if ( ! empty( $area ) ) {
			return $area;
		}
	}
	return get_post_meta( $post_id, '_project_area', true ) ?: '3,850 م²';
}

/**
 * Get localized project year
 */
function interior_get_project_year( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$year = get_post_meta( $post_id, '_project_year_en', true );
		if ( ! empty( $year ) ) {
			return $year;
		}
	}
	return get_post_meta( $post_id, '_project_year', true ) ?: '2025';
}

/**
 * Get localized project scope
 */
function interior_get_project_scope( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$scope = get_post_meta( $post_id, '_project_scope_en', true );
		if ( ! empty( $scope ) ) {
			return $scope;
		}
	}
	return get_post_meta( $post_id, '_project_scope', true ) ?: 'تسليم مفتاح كامل شامل';
}

/**
 * Get localized project materials
 */
function interior_get_project_materials( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$mats = get_post_meta( $post_id, '_project_materials_en', true );
		if ( ! empty( $mats ) ) {
			return $mats;
		}
	}
	return get_post_meta( $post_id, '_project_materials', true ) ?: 'رخام إيطالي · خشب جوز';
}

/**
 * Get project hero image URL
 */
function interior_get_project_image( $post_id = 0, $type = 'hero' ) {
	$post_id = $post_id ?: get_the_ID();
	$meta_key = ( 'detail' === $type ) ? '_project_detail_image' : '_project_hero_image';
	$img = get_post_meta( $post_id, $meta_key, true );
	if ( ! empty( $img ) ) {
		return $img;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'full' );
	}
	return get_stylesheet_directory_uri() . '/assets/images/luxe_hero_foyer.jpg';
}

/**
 * ------------------------------------------------------------------------
 * Dynamic Team Helpers
 * ------------------------------------------------------------------------
 */
function interior_get_team_name( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_name = get_post_meta( $post_id, '_team_name_en', true );
		if ( ! empty( $en_name ) ) {
			return $en_name;
		}
	}
	return get_the_title( $post_id );
}

function interior_get_team_role( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$role = get_post_meta( $post_id, '_team_role_en', true );
		if ( ! empty( $role ) ) {
			return $role;
		}
	}
	return get_post_meta( $post_id, '_team_role_ar', true ) ?: '';
}

function interior_get_team_tag( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$tag = get_post_meta( $post_id, '_team_tag_en', true );
		if ( ! empty( $tag ) ) {
			return $tag;
		}
	}
	return get_post_meta( $post_id, '_team_tag_ar', true ) ?: '';
}

function interior_get_team_cred( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$cred = get_post_meta( $post_id, '_team_cred_en', true );
		if ( ! empty( $cred ) ) {
			return $cred;
		}
	}
	return get_post_meta( $post_id, '_team_cred_ar', true ) ?: '';
}

function interior_get_team_bio( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$bio = get_post_meta( $post_id, '_team_bio_en', true );
		if ( ! empty( $bio ) ) {
			return $bio;
		}
	}
	return get_post_meta( $post_id, '_team_bio_ar', true ) ?: get_the_excerpt( $post_id );
}

function interior_get_team_photo( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$photo = get_post_meta( $post_id, '_team_photo', true );
	if ( ! empty( $photo ) ) {
		return $photo;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'full' );
	}
	return get_stylesheet_directory_uri() . '/assets/images/luxe_team_khaled_alfaisal.jpg';
}

function interior_get_team_is_principal( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	return ( '1' === (string) get_post_meta( $post_id, '_team_is_principal', true ) );
}

/**
 * ------------------------------------------------------------------------
 * Dynamic Material Helpers
 * ------------------------------------------------------------------------
 */
function interior_get_material_name( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_title = get_post_meta( $post_id, '_material_title_en', true );
		if ( ! empty( $en_title ) ) {
			return $en_title;
		}
	}
	return get_the_title( $post_id );
}

function interior_get_material_origin( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$origin = get_post_meta( $post_id, '_material_origin_en', true );
		if ( ! empty( $origin ) ) {
			return $origin;
		}
	}
	return get_post_meta( $post_id, '_material_origin_ar', true ) ?: '';
}

function interior_get_material_desc( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$desc = get_post_meta( $post_id, '_material_desc_en', true );
		if ( ! empty( $desc ) ) {
			return $desc;
		}
	}
	return get_post_meta( $post_id, '_material_desc_ar', true ) ?: get_the_excerpt( $post_id );
}

function interior_get_material_image( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$img = get_post_meta( $post_id, '_material_image', true );
	if ( ! empty( $img ) ) {
		return $img;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'full' );
	}
	return get_stylesheet_directory_uri() . '/assets/images/luxe_mat_calacatta_viola.jpg';
}

function interior_get_material_index( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	return get_post_meta( $post_id, '_material_index', true ) ?: '01';
}

/**
 * ------------------------------------------------------------------------
 * Dynamic Article / Monograph Helpers
 * ------------------------------------------------------------------------
 */
function interior_get_article_title( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_title = get_post_meta( $post_id, '_article_title_en', true );
		if ( ! empty( $en_title ) ) {
			return $en_title;
		}
	}
	return get_the_title( $post_id );
}

function interior_get_article_excerpt( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_exc = get_post_meta( $post_id, '_article_excerpt_en', true );
		if ( ! empty( $en_exc ) ) {
			return $en_exc;
		}
	}
	return get_the_excerpt( $post_id );
}

function interior_get_article_category( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$cat = get_post_meta( $post_id, '_article_category_en', true );
		if ( ! empty( $cat ) ) {
			return $cat;
		}
	}
	$cat = get_post_meta( $post_id, '_article_category_ar', true );
	if ( ! empty( $cat ) ) {
		return $cat;
	}
	$terms = get_the_category( $post_id );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		return $terms[0]->name;
	}
	return 'دراسات معمارية';
}

function interior_get_article_read_time( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		return get_post_meta( $post_id, '_article_read_time_en', true ) ?: '6 min read';
	}
	return get_post_meta( $post_id, '_article_read_time_ar', true ) ?: '6 دقائق قراءة';
}

function interior_get_article_author_name( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$name = get_post_meta( $post_id, '_article_author_name_en', true );
		if ( ! empty( $name ) ) {
			return $name;
		}
	}
	return get_post_meta( $post_id, '_article_author_name', true ) ?: get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) );
}

function interior_get_article_author_role( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$role = get_post_meta( $post_id, '_article_author_role_en', true );
		if ( ! empty( $role ) ) {
			return $role;
		}
	}
	return get_post_meta( $post_id, '_article_author_role', true ) ?: 'كبير المعماريين';
}

function interior_get_article_author_img( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$img = get_post_meta( $post_id, '_article_author_img', true );
	if ( ! empty( $img ) ) {
		return $img;
	}
	return get_stylesheet_directory_uri() . '/assets/images/luxe_team_khaled_alfaisal.jpg';
}

function interior_get_article_hero_img( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$img = get_post_meta( $post_id, '_article_hero_img', true );
	if ( ! empty( $img ) ) {
		return $img;
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'full' );
	}
	return get_stylesheet_directory_uri() . '/assets/images/luxe_joinery_detail.jpg';
}

function interior_get_article_content( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		$en_content = get_post_meta( $post_id, '_article_content_en', true );
		if ( ! empty( $en_content ) ) {
			return $en_content;
		}
	}
	return get_post_field( 'post_content', $post_id );
}

function interior_get_article_faqs( $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$lang    = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	$meta_key = ( 'en' === $lang ) ? '_article_faqs_en' : '_article_faqs_ar';
	$faqs     = get_post_meta( $post_id, $meta_key, true );

	if ( is_string( $faqs ) && ! empty( $faqs ) ) {
		$decoded = json_decode( $faqs, true );
		if ( is_array( $decoded ) ) {
			$faqs = $decoded;
		}
	}

	if ( is_array( $faqs ) && ! empty( $faqs ) ) {
		$valid = array();
		foreach ( $faqs as $item ) {
			if ( ! empty( $item['q'] ) && ! empty( $item['a'] ) ) {
				$valid[] = array(
					'q' => $item['q'],
					'a' => $item['a'],
				);
			}
		}
		if ( ! empty( $valid ) ) {
			return $valid;
		}
	}

	if ( 'en' === $lang ) {
		return array(
			array(
				'q' => 'How does INTERIOR ensure precision between architectural blueprints and final turnkey execution?',
				'a' => 'We utilize BIM LOD 500 shop drawings, laser spatial scanning, and dry-lay factory inspections before any stone or bespoke joinery arrives on site.',
			),
			array(
				'q' => 'What acoustic rating is targeted for private sovereign suites and majlis spaces?',
				'a' => 'Our residential and hospitality standards mandate a minimum of STC 62 to STC 65 across party walls, floors, and mechanical plenums.',
			),
			array(
				'q' => 'Are all natural stones and rare timbers sourced directly from their quarries of origin?',
				'a' => 'Yes. Our curators personally inspect and reserve monolithic blocks in Carrara, Pietrasanta, and European timber mills to guarantee uninterrupted vein book-matching.',
			),
		);
	}

	return array(
		array(
			'q' => 'كيف يضمن استوديو إنتريور تطابق المخططات الهندسية مع التنفيذ الفعلي في الموقع؟',
			'a' => 'نعتمد مخططات تنفيذية تفصيلية دقيقة مع المسح الليزري ثلاثي الأبعاد والفرز المسبق للرخام والأخشاب في المصنع قبل التوريد للموقع.',
		),
		array(
			'q' => 'ما هو معيار العزل الصوتي المعتمد في الأجنحة الخاصة والمجالس السيادية؟',
			'a' => 'نلتزم بتحقيق معيار عزل صوتي لا يقل عن 62 إلى 65 ديسيبل عبر الحوائط المزدوجة المعزولة ومخمدات التكييف المخفية.',
		),
		array(
			'q' => 'هل يتم استيراد الأحجار الطبيعية والأخشاب النادرة مباشرة من المحاجر العالمية؟',
			'a' => 'نعم، يقوم خبراؤنا بمعاينة وحجز الكتل الصخرية مباشرة من محاجر إيطاليا واليونان لضمان استمرارية العروق الطبيعية المتناظرة دون أي تفاوت لوني.',
		),
	);
}
