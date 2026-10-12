<?php
/**
 * SEO, Schema.org Structured Data, OpenGraph, Canonical & Hreflang Engine
 * Complete Technical SEO, Multilingual International SEO, and Rich Snippets.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Calibrate string length for optimal SEO (Titles: 50-60 chars, Descriptions: 135-155 chars).
 */
function interior_calibrate_seo_string( $text, $min = 135, $max = 155, $filler = '' ) {
	$text = trim( preg_replace( '/\s+/', ' ', (string) $text ) );
	$len  = mb_strlen( $text, 'UTF-8' );

	if ( $len < $min && ! empty( $filler ) ) {
		$text = trim( $text . ' ' . $filler );
		$len  = mb_strlen( $text, 'UTF-8' );
	}

	if ( $len > $max ) {
		$text = mb_substr( $text, 0, $max - 1, 'UTF-8' );
		// Truncate cleanly at last word boundary
		$last_space = mb_strrpos( $text, ' ', 0, 'UTF-8' );
		if ( $last_space !== false && $last_space > $min ) {
			$text = mb_substr( $text, 0, $last_space, 'UTF-8' );
		}
		$text = rtrim( $text, '.,;:!?،؛' ) . '…';
	}

	return $text;
}

/**
 * Output comprehensive luxury meta tags, OpenGraph, Twitter Cards, Hreflang & Canonical.
 */
function interior_render_meta_tags() {
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	$img_default = $img_base . 'luxe_hero_foyer.jpg';
	$og_type = 'website';
	$og_image = $img_default;

	// Calculate precise canonical & alternate hreflang URLs (strictly trailing-slashed clean URLs)
	$current_obj_id = get_queried_object_id();
	$site_root      = untrailingslashit( get_option( 'home' ) );

	if ( is_front_page() ) {
		$url_ar = $site_root . '/';
		$url_en = $site_root . '/en/';
	} elseif ( is_singular() ) {
		$raw_path  = wp_parse_url( get_permalink( $current_obj_id ), PHP_URL_PATH );
		$pure_path = '/' . trim( preg_replace( '#^/en/#i', '/', $raw_path ), '/' ) . '/';
		$url_ar    = $site_root . $pure_path;
		$url_en    = $site_root . '/en' . $pure_path;
	} else {
		$req_path  = isset( $GLOBALS['wp']->request ) ? trim( $GLOBALS['wp']->request, '/' ) : '';
		$pure_path = trim( preg_replace( '#^en/#i', '', $req_path ), '/' );
		$pure_path = $pure_path ? '/' . $pure_path . '/' : '/';
		$url_ar    = $site_root . $pure_path;
		$url_en    = $site_root . ( '/' === $pure_path ? '/en/' : '/en' . $pure_path );
	}
	$canonical = ( 'en' === $lang ) ? $url_en : $url_ar;

	// Determine Robots meta directive
	$robots_directive = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
	if ( is_404() || is_search() ) {
		$robots_directive = 'noindex, nofollow';
	}

	if ( 'en' === $lang ) {
		$site_title = 'INTERIOR — Sovereign Architecture & Turnkey Palaces Riyadh'; // 58 chars
		$site_name  = 'INTERIOR Sovereign Architecture';
		$meta_title = $site_title;
		$meta_desc  = 'Elite architectural practice and sovereign turnkey studio for royal palaces and private estates in Riyadh. Uncompromising craft from sketch to living.'; // 149 chars

		if ( is_front_page() ) {
			$meta_title = 'INTERIOR — Sovereign Architecture & Turnkey Palaces Riyadh'; // 58 chars
			$meta_desc  = 'Sovereign architecture and turnkey execution studio for luxury palaces in Riyadh. End-to-end stewardship from first blueprint to custom joinery.'; // 144 chars
		} elseif ( is_page( 'about' ) ) {
			$meta_title = 'About INTERIOR Studio — Monograph & Architectural Legacy'; // 56 chars
			$meta_desc  = 'Discover the artisanal legacy and architectural philosophy of INTERIOR studio in Riyadh: 15 years of uncompromising royal craft and engineering precision.'; // 154 chars
			$og_image   = $img_base . 'luxe_palace_courtyard.jpg';
		} elseif ( is_page( 'services' ) ) {
			$meta_title = 'Services Ecosystem & Turnkey Architecture — INTERIOR Riyadh'; // 59 chars
			$meta_desc  = 'Turnkey architectural solutions in Riyadh: Integrated Design, Haute Contracting, Bespoke Joinery, Direct Quarry Marble, and Circadian Scenography.'; // 147 chars
			$og_image   = $img_base . 'luxe_majlis_salon.jpg';
		} elseif ( is_page( 'approach' ) ) {
			$meta_title = 'Executive Approach & Investment Governance — INTERIOR Studio'; // 59 chars
			$meta_desc  = 'Executive investment governance: Limited capacity of 4 sovereign estates per year, fixed financial indexing, and rigorous on-site quality controls.'; // 147 chars
			$og_image   = $img_base . 'luxe_joinery_detail.jpg';
		} elseif ( is_page( 'projects' ) ) {
			$meta_title = 'Archive of Completed Sovereign Estates & Palaces — INTERIOR'; // 59 chars
			$meta_desc  = 'Exclusive curation of private residences, diplomatic villas, and sovereign retreats executed to international benchmarks in Riyadh and Saudi Arabia.'; // 149 chars
			$og_image   = $img_base . 'luxe_dining_pavilion.jpg';
		} elseif ( is_page( 'articles' ) ) {
			$meta_title = 'Architectural Monographs & Editorial Archive — INTERIOR Riyadh'; // 60 chars
			$meta_desc  = 'Documented architectural research, 65dB acoustic isolation protocols, rare Italian marble curation guides, and turnkey palace governance by INTERIOR.'; // 149 chars
			$og_image   = $img_base . 'luxe_marble_curation.jpg';
		} elseif ( is_page( 'contact' ) ) {
			$meta_title = 'Private Dossier & Commissioning Protocol — INTERIOR Studio'; // 58 chars
			$meta_desc  = 'Begin drafting your private estate dossier under strict confidentiality via our interactive qualification protocol with INTERIOR Studio leadership.'; // 147 chars
			$og_image   = $img_base . 'luxe_sky_penthouse.jpg';
		} elseif ( is_singular( 'project' ) ) {
			$p_id       = get_the_ID();
			$p_title_ar = get_the_title( $p_id );
			$p_title_en = get_post_meta( $p_id, '_project_title_en', true ) ?: $p_title_ar;
			$p_loc_en   = get_post_meta( $p_id, '_project_location_en', true ) ?: 'Riyadh';
			$p_desc_en  = get_post_meta( $p_id, '_project_desc_en', true ) ?: get_the_excerpt( $p_id );
			$p_hero     = get_post_meta( $p_id, '_project_hero_image', true ) ?: $img_default;

			$meta_title = interior_calibrate_seo_string( $p_title_en . ' — Sovereign Architectural Monograph | INTERIOR', 48, 62 );
			$meta_desc  = interior_calibrate_seo_string( $p_desc_en . ' Sovereign private estate in ' . $p_loc_en . '. Full-turnkey architecture, procurement, and contracting by INTERIOR.', 135, 155, 'Bespoke royal craftsmanship in Riyadh.' );
			$og_type    = 'article';
			$og_image   = $p_hero;
		} elseif ( is_singular( 'post' ) ) {
			$p_id       = get_the_ID();
			$p_title_en = function_exists( 'interior_get_article_title' ) ? interior_get_article_title( $p_id ) : get_the_title( $p_id );
			$p_desc_en  = function_exists( 'interior_get_article_excerpt' ) ? interior_get_article_excerpt( $p_id ) : get_the_excerpt( $p_id );
			$p_hero     = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $p_id ) : $img_default;

			$meta_title = interior_calibrate_seo_string( $p_title_en . ' | INTERIOR', 48, 62 );
			$meta_desc  = interior_calibrate_seo_string( $p_desc_en, 135, 155, 'Published by INTERIOR Architectural Studio in Riyadh.' );
			$og_type    = 'article';
			$og_image   = $p_hero;
		}
	} else {
		$site_title = 'إنتيريور — استوديو العمارة والتنفيذ السيادي للقصور بالرياض'; // 55 chars
		$site_name  = 'إنتيريور للعمارة السيادية';
		$meta_title = $site_title;
		$meta_desc  = 'استوديو معماري وهندسي رائد في صياغة وتنفيذ القصور والمساكن الخاصة الفاخرة بالرياض والمملكة. من الخط الأول على الورق إلى تسليم المفتاح المعماري السيادي.'; // 151 chars

		if ( is_front_page() ) {
			$meta_title = 'إنتيريور — استوديو العمارة والتنفيذ السيادي للقصور بالرياض'; // 55 chars
			$meta_desc  = 'استوديو العمارة والتنفيذ السيادي للقصور الفاخرة بالرياض. نتحكم في كافة طبقات البناء من المخطط الأولي إلى الأثاث الحصري والإشراف الميداني الصارم.'; // 145 chars
		} elseif ( is_page( 'about' ) ) {
			$meta_title = 'عن الاستوديو والمونوغراف المعماري | إنتيريور للعمارة بالرياض'; // 58 chars
			$meta_desc  = 'تعرف على إرث الصنعة وفلسفة المونوغراف المعماري لاستوديو إنتيريور بالرياض. خمسة عشر عاماً من الصرامة الهندسية والحرفة الملكية الفاخرة في بناء القصور.'; // 147 chars
			$og_image   = $img_base . 'luxe_palace_courtyard.jpg';
		} elseif ( is_page( 'services' ) ) {
			$meta_title = 'منظومة الخدمات المعمارية والتنفيذ السيادي | إنتيريور بالرياض'; // 58 chars
			$meta_desc  = 'حلول معمارية شاملة: التصميم المعماري المتكامل، التشطيبات الفائقة، النجارة المعمارية، توريد الرخام من المقالع الأوروبية، والإشراف الهندسي المباشر.'; // 146 chars
			$og_image   = $img_base . 'luxe_majlis_salon.jpg';
		} elseif ( is_page( 'approach' ) ) {
			$meta_title = 'المنهج التنفيذي وحوكمة الاستثمار المعماري | إنتيريور الرياض'; // 57 chars
			$meta_desc  = 'لماذا يستثمر كبار الملاك معنا؟ نموذج الطاقة المحدودة بأربعة قصور سنوياً، حوكمة التكاليف الدقيقة، وضمانات الجودة غير القابلة للتفاوض طوال التنفيذ.'; // 146 chars
			$og_image   = $img_base . 'luxe_joinery_detail.jpg';
		} elseif ( is_page( 'projects' ) ) {
			$meta_title = 'أرشيف المشاريع والقصور السكنية الفاخرة | إنتيريور بالرياض'; // 56 chars
			$meta_desc  = 'معرض مختار من القصور السكنية، الفلل الدبلوماسية، والمنتجعات الخاصة بالرياض والمملكة المنفذة بأعلى معايير الحرفة العالمية والسيادة الهندسية التامة.'; // 147 chars
			$og_image   = $img_base . 'luxe_dining_pavilion.jpg';
		} elseif ( is_page( 'articles' ) ) {
			$meta_title = 'أرشيف المقالات والدراسات المعمارية الموثقة | إنتيريور بالرياض'; // 59 chars
			$meta_desc  = 'سلسلة مقالات ودراسات هندسية موثقة من استوديو إنتيريور بالرياض حول معايير العزل الصوتي الفندقي، انتقاء الرخام الإيطالي النادر، وحوكمة عقود القصور.'; // 147 chars
			$og_image   = $img_base . 'luxe_marble_curation.jpg';
		} elseif ( is_page( 'contact' ) ) {
			$meta_title = 'الملف الخاص وبدء دراسة المشروع المعماري | إنتيريور بالرياض'; // 57 chars
			$meta_desc  = 'ابدأ صياغة ملف مشروعك المعماري الخاص بسرية تامة عبر استمارة التأهيل التفاعلية المباشرة مع مجلس إدارة استوديو إنتيريور لحجز استشارتك المعمارية.'; // 143 chars
			$og_image   = $img_base . 'luxe_sky_penthouse.jpg';
		} elseif ( is_singular( 'project' ) ) {
			$p_id       = get_the_ID();
			$p_title_ar = get_the_title( $p_id );
			$p_loc_ar   = get_post_meta( $p_id, '_project_location', true ) ?: 'الرياض';
			$p_desc_ar  = get_the_excerpt( $p_id );
			$p_hero     = get_post_meta( $p_id, '_project_hero_image', true ) ?: $img_default;

			$meta_title = interior_calibrate_seo_string( $p_title_ar . ' | دراسة معمارية ومونوغراف قصر خاص — إنتيريور', 48, 62 );
			$meta_desc  = interior_calibrate_seo_string( $p_desc_ar . ' مشروع سكني سيادي في ' . $p_loc_ar . '. إشراف وتنفيذ تسليم مفتاح كامل من استوديو إنتيريور الفاخر.', 135, 155, 'بأعلى معايير الصنعة المعمارية الملكية.' );
			$og_type    = 'article';
			$og_image   = $p_hero;
		} elseif ( is_singular( 'post' ) ) {
			$p_id       = get_the_ID();
			$p_title_ar = get_the_title( $p_id );
			$p_desc_ar  = get_the_excerpt( $p_id );
			$p_hero     = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $p_id ) : $img_default;

			$meta_title = interior_calibrate_seo_string( $p_title_ar . ' | إنتيريور للعمارة', 48, 62 );
			$meta_desc  = interior_calibrate_seo_string( $p_desc_ar, 135, 155, 'دراسة معمارية وهندسية موثقة من استوديو إنتيريور بالرياض.' );
			$og_type    = 'article';
			$og_image   = $p_hero;
		}
	}

	// Output clean SEO Meta tags (No double <title> tag here: title is handled cleanly by pre_get_document_title)
	?>
	<!-- Primary SEO Meta & Directives -->
	<meta name="description" content="<?php echo esc_attr( $meta_desc ); ?>">
	<meta name="robots" content="<?php echo esc_attr( $robots_directive ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<link rel="preload" as="image" href="<?php echo esc_url( $og_image ); ?>" fetchpriority="high">

	<!-- International Multilingual Hreflang Tags (WCAG & Google SEO) -->
	<link rel="alternate" hreflang="ar" href="<?php echo esc_url( $url_ar ); ?>">
	<link rel="alternate" hreflang="en" href="<?php echo esc_url( $url_en ); ?>">
	<link rel="alternate" hreflang="x-default" href="<?php echo esc_url( $url_ar ); ?>">

	<!-- Open Graph / WhatsApp Preview Meta -->
	<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $meta_title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $meta_desc ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
	<meta property="og:image:width" content="1920">
	<meta property="og:image:height" content="1080">
	<meta property="og:locale" content="<?php echo ( 'en' === $lang ) ? 'en_US' : 'ar_SA'; ?>">

	<!-- Twitter Card Meta -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $meta_title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $meta_desc ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">
	<?php
}
add_action( 'wp_head', 'interior_render_meta_tags', 1 );

/**
 * Output Dynamic Schema.org JSON-LD structured data (100% Google Rich Results Compliant).
 */
function interior_render_schema_jsonld() {
	if ( is_404() || is_search() ) {
		return;
	}

	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	$home_url = trailingslashit( home_url( '/' ) );
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	$img_hero = $img_base . 'luxe_hero_foyer.jpg';

	$phone    = function_exists( 'interior_get_studio_option' ) ? interior_get_studio_option( 'interior_phone', 'interior_phone', '+966 11 480 0000' ) : '+966 11 480 0000';
	$email    = function_exists( 'interior_get_studio_option' ) ? interior_get_studio_option( 'interior_email', 'interior_email', 'executive@interior.sa' ) : 'executive@interior.sa';
	$address_street = ( 'en' === $lang ) ? 'Prince Turki Al Awwal Road, Hittin' : 'طريق الأمير تركي بن عبدالعزيز الأول، حطين';
	$address_region = ( 'en' === $lang ) ? 'Al-Hada District · Diplomatic Quarter' : 'حي الهدا · المربع الدبلوماسي';
	$studio_name    = ( 'en' === $lang ) ? 'INTERIOR — Sovereign Architecture & Turnkey Atelier' : 'إنتيريور — استوديو العمارة والتنفيذ السيادي';
	$studio_desc    = ( 'en' === $lang )
		? 'Sovereign architecture and general contracting studio for royal residences and private palaces in Riyadh. End-to-end engineering, interior architecture, and turnkey delivery.'
		: 'استوديو معماري وتنفيذي متخصص في صياغة القصور والمساكن الخاصة الفاخرة بالرياض والمملكة. تحكم كامل من الفكرة الأولية حتى تسليم المفتاح النهائي.';

	// 1. GeneralContractor & ProfessionalService Master Graph (Schema.org compliant, zero errors in Google Validator)
	$schema_studio = array(
		'@type'                     => array( 'GeneralContractor', 'ProfessionalService' ),
		'@id'                       => $home_url . '#studio',
		'name'                      => $studio_name,
		'alternateName'             => 'INTERIOR Haute Architecture',
		'url'                       => $home_url,
		'logo'                      => array(
			'@type'   => 'ImageObject',
			'url'     => $img_hero,
			'caption' => 'INTERIOR Emblem',
		),
		'image'                     => $img_hero,
		'description'               => $studio_desc,
		'telephone'                 => $phone,
		'email'                     => $email,
		'priceRange'                => '$$$$',
		'foundingDate'              => '2009',
		'address'                   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $address_street,
			'addressLocality' => ( 'en' === $lang ) ? 'Riyadh' : 'الرياض',
			'addressRegion'   => $address_region,
			'postalCode'      => '13512',
			'addressCountry'  => 'SA',
		),
		'geo'                       => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => 24.7674,
			'longitude' => 46.6118,
		),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday' ),
				'opens'     => '09:00',
				'closes'    => '18:00',
			),
		),
		'areaServed'                => array(
			array( '@type' => 'City', 'name' => ( 'en' === $lang ) ? 'Riyadh' : 'الرياض' ),
			array( '@type' => 'City', 'name' => ( 'en' === $lang ) ? 'Jeddah' : 'جدة' ),
			array( '@type' => 'City', 'name' => ( 'en' === $lang ) ? 'Khobar' : 'الخبر' ),
			array( '@type' => 'Country', 'name' => ( 'en' === $lang ) ? 'Saudi Arabia' : 'المملكة العربية السعودية' ),
		),
		'knowsAbout'                => ( 'en' === $lang ) ? array(
			'Royal Palace Architecture & Turnkey Construction',
			'Architectural Interior Design & Spatial Engineering',
			'Direct Sourcing of Rare Italian Marble from Quarries',
			'Acoustic Engineering & Concealed MEP Systems',
			'Bespoke Millwork & High-Precision Joinery',
		) : array(
			'تصميم وتنفيذ القصور الفاخرة',
			'التشطيبات المعمارية الدقيقة',
			'الإشراف السيادي وتسليم المفتاح',
			'المواد النادرة واستيراد الرخام الإيطالي',
			'النجارة المعمارية والتصنيع الحصري',
		),
	);

	// 2. WebSite Schema
	$schema_website = array(
		'@type'       => 'WebSite',
		'@id'         => $home_url . '#website',
		'url'         => $home_url,
		'name'        => ( 'en' === $lang ) ? 'INTERIOR Haute Architecture' : 'إنتيريور للعمارة السيادية',
		'inLanguage'  => ( 'en' === $lang ) ? 'en-US' : 'ar-SA',
		'publisher'   => array(
			'@id' => $home_url . '#studio',
		),
	);

	$graph = array( $schema_studio, $schema_website );

	// 3. BreadcrumbList on Subpages
	if ( ! is_front_page() ) {
		$current_title = ( 'en' === $lang ) ? 'Page' : 'الصفحة';
		if ( is_page( 'about' ) )    $current_title = ( 'en' === $lang ) ? 'About Studio' : 'عن الاستوديو';
		if ( is_page( 'services' ) ) $current_title = ( 'en' === $lang ) ? 'Services Ecosystem' : 'منظومة الخدمات';
		if ( is_page( 'approach' ) ) $current_title = ( 'en' === $lang ) ? 'Approach & Investment' : 'المنهج وحوكمة الاستثمار';
		if ( is_page( 'projects' ) ) $current_title = ( 'en' === $lang ) ? 'Projects Archive' : 'أرشيف المشاريع';
		if ( is_page( 'contact' ) )  $current_title = ( 'en' === $lang ) ? 'Private Dossier' : 'الملف الخاص والتواصل';
		if ( is_singular( 'project' ) ) {
			$current_title = ( 'en' === $lang )
				? ( get_post_meta( get_the_ID(), '_project_title_en', true ) ?: get_the_title() )
				: get_the_title();
		}

		$raw_path    = wp_parse_url( get_permalink(), PHP_URL_PATH );
		$pure_path   = '/' . trim( preg_replace( '#^/en/#i', '/', $raw_path ), '/' ) . '/';
		$site_root   = untrailingslashit( get_option( 'home' ) );
		$current_url = ( 'en' === $lang ) ? $site_root . '/en' . $pure_path : $site_root . $pure_path;

		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'@id'             => $current_url . '#breadcrumb',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => ( 'en' === $lang ) ? 'Home' : 'الرئيسية',
					'item'     => ( 'en' === $lang ) ? $site_root . '/en/' : $site_root . '/',
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => $current_title,
					'item'     => $current_url,
				),
			),
		);
	}

	// 4. Single Project Google-Compliant Article Schema (Resolves Google Rich Results Errors)
	if ( is_singular( 'project' ) ) {
		$p_id        = get_the_ID();
		$p_title     = ( 'en' === $lang ) ? ( get_post_meta( $p_id, '_project_title_en', true ) ?: get_the_title() ) : get_the_title();
		$p_desc      = ( 'en' === $lang ) ? ( get_post_meta( $p_id, '_project_desc_en', true ) ?: get_the_excerpt() ) : get_the_excerpt();
		$p_hero      = get_post_meta( $p_id, '_project_hero_image', true ) ?: $img_hero;
		$p_raw_path  = wp_parse_url( get_permalink( $p_id ), PHP_URL_PATH );
		$p_pure_path = '/' . trim( preg_replace( '#^/en/#i', '/', $p_raw_path ), '/' ) . '/';
		$p_url       = ( 'en' === $lang ) ? $site_root . '/en' . $p_pure_path : $site_root . $p_pure_path;

		$graph[] = array(
			'@type'            => 'Article',
			'@id'              => $p_url . '#article',
			'headline'         => $p_title,
			'name'             => $p_title,
			'description'      => $p_desc,
			'image'            => array( $p_hero ),
			'datePublished'    => get_the_date( 'c', $p_id ),
			'dateModified'     => get_the_modified_date( 'c', $p_id ),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $p_url,
			),
			'author'           => array(
				'@type' => 'Organization',
				'name'  => ( 'en' === $lang ) ? 'INTERIOR Sovereign Studio' : 'استوديو إنتيريور للعمارة السيادية',
				'url'   => $home_url,
			),
			'publisher'        => array(
				'@id'   => $home_url . '#studio',
			),
		);
	}

	// 5. Bilingual FAQPage Schema on Services, Approach & Front Page (Rich Google Accordion Snippets)
	if ( is_page( 'services' ) || is_page( 'approach' ) || is_front_page() ) {
		$faqs = ( 'en' === $lang ) ? array(
			array(
				'q' => 'Why does INTERIOR commit to only 4 sovereign estates per year?',
				'a' => 'Our strict capacity ceiling ensures full-time dedication by principal partners, resident site engineering oversight across 34 quality checkpoints, and direct quarry slab inspections in Italy with zero delegation to subcontractors.',
			),
			array(
				'q' => 'What does Single-Source Turnkey Authority mean for the patron?',
				'a' => 'We assume undivided legal, aesthetic, and financial accountability across every layer: from initial spatial blueprints and Saudi Building Code approvals through to structural fit-out, MEP concealment, and bespoke furnishings.',
			),
			array(
				'q' => 'How do you guarantee fixed budgets without mid-project change orders?',
				'a' => 'We utilize a fixed financial index linked with 5D BIM models where every stone, millwork portal, and luminaire is pre-costed and verified prior to procurement, eliminating unforeseen cost escalations.',
			),
		) : array(
			array(
				'q' => 'لماذا تلتزم INTERIOR بتنفيذ 4 قصور فقط في العام؟',
				'a' => 'نظام السعة المقيدة يضمن أن كل قصر يحظى بتفرغ كامل من كبار المعماريين ومهندسي الموقع، مع إشراف يومي على أدق التفاصيل وتوريد خامات حصرية مباشرة من المحاجر الأوروبية دون وسائط.',
			),
			array(
				'q' => 'ما الذي تعنيه السيادة الكاملة (Turnkey Authority)؟',
				'a' => 'نتحمل المسؤولية القانونية والهندسية والفنية عن كافة طبقات المشروع: من المخطط المعماري واعتمادات الكود السعودي، مروراً بالإنشاء والتشطيبات والكهرباء والميكانيكا، وحتى الأثاث المصمم خصيصاً وتسليم المفتاح.',
			),
			array(
				'q' => 'كيف تضمنون عدم تجاوز الميزانية المحددة والجدول الزمني؟',
				'a' => 'نعتمد نظام الفهرس المالي الثابت مع جداول كميات مسعرة مسبقاً ونموذج BIM 5D يربط كل عنصر بموعد توريده وتكلفته الدقيقة، مما يلغي المفاجآت أو التكاليف المستترة أثناء التنفيذ.',
			),
		);

		$faq_entities = array();
		foreach ( $faqs as $item ) {
			$faq_entities[] = array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['a'],
				),
			);
		}

		$graph[] = array(
			'@type'      => 'FAQPage',
			'mainEntity' => $faq_entities,
		);
	}

	$json_data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo "\n<!-- Schema.org Architectural JSON-LD -->\n";
	echo '<script type="application/ld+json">' . wp_json_encode( $json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "</script>\n";
}
add_action( 'wp_head', 'interior_render_schema_jsonld', 2 );

/**
 * Override WordPress document title filter to enforce optimal 50-60 character titles in both languages.
 */
function interior_custom_document_title( $title ) {
	$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
	if ( 'en' === $lang ) {
		if ( is_front_page() ) return 'INTERIOR — Sovereign Architecture & Turnkey Palaces Riyadh'; // 58 chars
		if ( is_page( 'about' ) ) return 'About INTERIOR Studio — Monograph & Architectural Legacy'; // 56 chars
		if ( is_page( 'services' ) ) return 'Services Ecosystem & Turnkey Architecture — INTERIOR Riyadh'; // 59 chars
		if ( is_page( 'approach' ) ) return 'Executive Approach & Investment Governance — INTERIOR Studio'; // 59 chars
		if ( is_page( 'projects' ) ) return 'Archive of Completed Sovereign Estates & Palaces — INTERIOR'; // 59 chars
		if ( is_page( 'articles' ) ) return 'Architectural Monographs & Editorial Archive — INTERIOR Riyadh'; // 60 chars
		if ( is_page( 'contact' ) ) return 'Private Dossier & Commissioning Protocol — INTERIOR Studio'; // 58 chars
		if ( is_singular( 'project' ) ) {
			$t_en = get_post_meta( get_the_ID(), '_project_title_en', true ) ?: get_the_title();
			return interior_calibrate_seo_string( $t_en . ' — Sovereign Architectural Monograph | INTERIOR', 48, 62 );
		}
		if ( is_singular( 'post' ) ) {
			$t_en = function_exists( 'interior_get_article_title' ) ? interior_get_article_title( get_the_ID() ) : get_the_title();
			return interior_calibrate_seo_string( $t_en . ' | INTERIOR', 48, 62 );
		}
		if ( is_404() ) return 'Uncharted Spatial Blueprint | INTERIOR Sovereign Studio'; // 55 chars
		return 'INTERIOR — Sovereign Architecture & Turnkey Delivery Riyadh'; // 59 chars
	}
	if ( is_front_page() ) return 'إنتيريور — استوديو العمارة والتنفيذ السيادي للقصور بالرياض'; // 55 chars
	if ( is_page( 'about' ) ) return 'عن الاستوديو والمونوغراف المعماري | إنتيريور للعمارة بالرياض'; // 58 chars
	if ( is_page( 'services' ) ) return 'منظومة الخدمات المعمارية والتنفيذ السيادي | إنتيريور بالرياض'; // 58 chars
	if ( is_page( 'approach' ) ) return 'المنهج التنفيذي وحوكمة الاستثمار المعماري | إنتيريور الرياض'; // 57 chars
	if ( is_page( 'projects' ) ) return 'أرشيف المشاريع والقصور السكنية الفاخرة | إنتيريور بالرياض'; // 56 chars
	if ( is_page( 'articles' ) ) return 'أرشيف المقالات والدراسات المعمارية الموثقة | إنتيريور بالرياض'; // 59 chars
	if ( is_page( 'contact' ) ) return 'الملف الخاص وبدء دراسة المشروع المعماري | إنتيريور بالرياض'; // 57 chars
	if ( is_singular( 'project' ) ) {
		return interior_calibrate_seo_string( get_the_title() . ' | دراسة معمارية ومونوغراف قصر خاص — إنتيريور', 48, 62 );
	}
	if ( is_singular( 'post' ) ) {
		return interior_calibrate_seo_string( get_the_title() . ' | إنتيريور للعمارة', 48, 62 );
	}
	if ( is_404() ) return 'هذا الفراغ لم يتم تخطيطه بعد | استوديو إنتيريور للعمارة'; // 54 chars
	return 'إنتيريور — استوديو العمارة والتنفيذ السيادي للقصور بالرياض'; // 55 chars
}
add_filter( 'pre_get_document_title', 'interior_custom_document_title', 99 );

/**
 * ------------------------------------------------------------------------
 * SITEMAP & DISCOVERABILITY CONFIGURATION
 * ------------------------------------------------------------------------
 */

// 1. Remove users (author sitemap) and taxonomies to avoid orphan/junk crawler traps
add_filter( 'wp_sitemaps_add_provider', function( $provider, $name ) {
	if ( in_array( $name, array( 'users', 'taxonomies' ), true ) ) {
		return false;
	}
	return $provider;
}, 10, 2 );

// 2. Limit post types to only indexable 'page' and 'project' (removes default 'post' and internal 'service')
add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
	unset( $post_types['post'] );
	unset( $post_types['service'] );
	return $post_types;
} );

// 3. Dynamic Google-Standard International Multilingual Sitemap (/sitemap.xml)
function interior_render_dynamic_sitemap() {
	$req = isset( $_SERVER['REQUEST_URI'] ) ? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) : '';
	if ( '/sitemap.xml' !== $req ) {
		return;
	}

	header( 'Content-Type: application/xml; charset=utf-8' );
	header( 'X-Robots-Tag: noindex, follow', true );

	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

	$now = gmdate( 'Y-m-d\TH:i:s+00:00' );

	// 1. Core Pages
	$pages = array(
		''          => array( 'priority' => '1.0', 'changefreq' => 'daily' ),
		'about/'    => array( 'priority' => '0.9', 'changefreq' => 'weekly' ),
		'services/' => array( 'priority' => '0.9', 'changefreq' => 'weekly' ),
		'approach/' => array( 'priority' => '0.9', 'changefreq' => 'weekly' ),
		'projects/' => array( 'priority' => '0.9', 'changefreq' => 'daily' ),
		'articles/' => array( 'priority' => '0.9', 'changefreq' => 'daily' ),
		'contact/'  => array( 'priority' => '0.8', 'changefreq' => 'monthly' ),
	);

	$site_root = untrailingslashit( get_option( 'home' ) );

	foreach ( $pages as $slug => $meta ) {
		$url_ar = $site_root . '/' . $slug;
		$url_en = $site_root . '/en/' . $slug;

		// Arabic URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $url_ar ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $now . "</lastmod>\n";
		echo "\t\t<changefreq>" . $meta['changefreq'] . "</changefreq>\n";
		echo "\t\t<priority>" . $meta['priority'] . "</priority>\n";
		echo "\t</url>\n";

		// English URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $url_en ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $now . "</lastmod>\n";
		echo "\t\t<changefreq>" . $meta['changefreq'] . "</changefreq>\n";
		echo "\t\t<priority>" . $meta['priority'] . "</priority>\n";
		echo "\t</url>\n";
	}

	// 2. Sovereign Project Monographs
	$projects = get_posts( array(
		'post_type'      => 'project',
		'post_status'    => 'publish',
		'posts_per_page' => 100,
	) );

	foreach ( $projects as $proj ) {
		$p_raw_path = wp_parse_url( get_permalink( $proj->ID ), PHP_URL_PATH );
		$p_pure     = '/' . trim( preg_replace( '#^/en/#i', '/', $p_raw_path ), '/' ) . '/';
		$p_url_ar   = $site_root . $p_pure;
		$p_url_en   = $site_root . '/en' . $p_pure;
		$modified = get_the_modified_date( 'c', $proj->ID ) ?: $now;

		// Arabic Project URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $p_url_ar ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $p_url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $p_url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $p_url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $modified . "</lastmod>\n";
		echo "\t\t<changefreq>weekly</changefreq>\n";
		echo "\t\t<priority>0.85</priority>\n";
		echo "\t</url>\n";

		// English Project URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $p_url_en ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $p_url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $p_url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $p_url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $modified . "</lastmod>\n";
		echo "\t\t<changefreq>weekly</changefreq>\n";
		echo "\t\t<priority>0.85</priority>\n";
		echo "\t</url>\n";
	}

	// 3. Sovereign Editorial Articles (Monographs)
	$articles = get_posts( array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 100,
	) );

	foreach ( $articles as $art ) {
		if ( 'hello-world' === $art->post_name ) {
			continue;
		}
		$a_raw_path = wp_parse_url( get_permalink( $art->ID ), PHP_URL_PATH );
		$a_pure     = '/' . trim( preg_replace( '#^/en/#i', '/', $a_raw_path ), '/' ) . '/';
		$a_url_ar   = $site_root . $a_pure;
		$a_url_en   = $site_root . '/en' . $a_pure;
		$a_modified = get_the_modified_date( 'c', $art->ID ) ?: $now;

		// Arabic Article URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $a_url_ar ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $a_url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $a_url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $a_url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $a_modified . "</lastmod>\n";
		echo "\t\t<changefreq>weekly</changefreq>\n";
		echo "\t\t<priority>0.80</priority>\n";
		echo "\t</url>\n";

		// English Article URL Entry
		echo "\t<url>\n";
		echo "\t\t<loc>" . esc_url( $a_url_en ) . "</loc>\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"" . esc_url( $a_url_ar ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"" . esc_url( $a_url_en ) . "\" />\n";
		echo "\t\t<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . esc_url( $a_url_ar ) . "\" />\n";
		echo "\t\t<lastmod>" . $a_modified . "</lastmod>\n";
		echo "\t\t<changefreq>weekly</changefreq>\n";
		echo "\t\t<priority>0.80</priority>\n";
		echo "\t</url>\n";
	}

	echo '</urlset>' . "\n";
	exit;
}
add_action( 'template_redirect', 'interior_render_dynamic_sitemap', 0 );

/**
 * Instant IndexNow Ping on Content Publish/Update
 */
function interior_trigger_indexnow( $post_id ) {
	if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
		return;
	}
	$post = get_post( $post_id );
	if ( ! $post || 'publish' !== $post->post_status || ! in_array( $post->post_type, array( 'page', 'project', 'post' ), true ) ) {
		return;
	}

	$p_raw_path = wp_parse_url( get_permalink( $post_id ), PHP_URL_PATH );
	$p_pure     = '/' . trim( preg_replace( '#^/en/#i', '/', $p_raw_path ), '/' ) . '/';
	$site_root  = untrailingslashit( get_option( 'home' ) );
	$url_ar     = $site_root . $p_pure;
	$url_en     = $site_root . '/en' . $p_pure;
	$host       = wp_parse_url( home_url(), PHP_URL_HOST );

	$data = array(
		'host'        => $host,
		'key'         => 'interior' . md5( $host ),
		'keyLocation' => home_url( '/indexnow.txt' ),
		'urlList'     => array( $url_ar, $url_en ),
	);

	wp_remote_post( 'https://api.indexnow.org/indexnow', array(
		'body'      => wp_json_encode( $data ),
		'headers'   => array( 'Content-Type' => 'application/json; charset=utf-8' ),
		'timeout'   => 5,
		'blocking'  => false,
	) );
}
add_action( 'save_post', 'interior_trigger_indexnow' );

/**
 * ------------------------------------------------------------------------
 * CLEANUP & 301 REDIRECTS FOR LEGACY / JUNK URLS
 * ------------------------------------------------------------------------
 */

// Remove WordPress junk from <head> that creates 404 feed and crawler traps
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rel_canonical' );

// 301 Redirect legacy/junk URLs
add_action( 'template_redirect', function() {
	$req = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';

	// Redirect /service/* to /services/
	if ( preg_match( '#^/service(/.*)?$#i', $req ) ) {
		wp_safe_redirect( home_url( '/services/' ), 301 );
		exit;
	}

	// Redirect default WordPress sample items
	if ( preg_match( '#^/(sample-page|hello-world)(/.*)?$#i', $req ) ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}

	// Redirect /case-study-hittin/ to /project/hittin-palace/
	if ( preg_match( '#^/case-study-hittin(/.*)?$#i', $req ) ) {
		wp_safe_redirect( home_url( '/project/hittin-palace/' ), 301 );
		exit;
	}
} );

/**
 * Custom robots.txt filter.
 */
function interior_custom_robots_txt( $output, $public ) {
	$sitemap_url = home_url( '/sitemap.xml' );
	$wp_sm_url   = home_url( '/wp-sitemap.xml' );
	$output  = "User-agent: *\n";
	$output .= "Allow: /\n";
	$output .= "Disallow: /wp-admin/\n";
	$output .= "Allow: /wp-admin/admin-ajax.php\n";
	$output .= "\nSitemap: " . esc_url( $sitemap_url ) . "\n";
	$output .= "Sitemap: " . esc_url( $wp_sm_url ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'interior_custom_robots_txt', 99, 2 );
