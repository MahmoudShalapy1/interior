<?php
/**
 * Realistic Database Seeder for Luxury Projects & Services
 * Populates authentic, elite architectural projects and turnkey services.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Seed or update database content
 */
function interior_seed_database_content( $force = false ) {
	$already_seeded = get_option( 'interior_seeded_v3', false );
	if ( $already_seeded && ! $force ) {
		return;
	}

	$img_url_base = get_stylesheet_directory_uri() . '/assets/images/';

	// -------------------------------------------------------------------------
	// 1. SEED DEFAULT STUDIO SETTINGS
	// -------------------------------------------------------------------------
	update_option( 'interior_stat_palaces', '+140' );
	update_option( 'interior_stat_palaces_en', '+140 Palaces' );
	update_option( 'interior_stat_value', '+850 مليون $' );
	update_option( 'interior_stat_value_en', '$850M+ Realized Value' );
	update_option( 'interior_stat_ontime', '100٪' );
	update_option( 'interior_stat_ontime_en', '100% On-Time Turnkey' );
	update_option( 'interior_stat_awards', '18' );
	update_option( 'interior_stat_awards_en', '18 International Citations' );

	update_option( 'interior_phone', '+966 11 480 0000' );
	update_option( 'interior_whatsapp', '+966 50 123 4567' );
	update_option( 'interior_email', 'executive@interior.sa' );
	update_option( 'interior_address_ar', 'حي الهدا · المربع الدبلوماسي، الرياض، المملكة العربية السعودية' );
	update_option( 'interior_address_en', 'Al-Hada District · Diplomatic Quarter, Riyadh, Kingdom of Saudi Arabia' );
	update_option( 'interior_license_ar', 'ترخيص الهيئة السعودية للمهندسين رقم 7402 / س.ت 1010349281' );
	update_option( 'interior_license_en', 'Saudi Council of Engineers License #7402 / CR 1010349281' );
	update_option( 'interior_est_year', '2009' );

	// -------------------------------------------------------------------------
	// 2. REGISTER TYPOLOGY TAXONOMY TERMS
	// -------------------------------------------------------------------------
	$tax_terms = array(
		'palace'     => array( 'قصور خاصة', 'Private Palaces' ),
		'villa'      => array( 'فلل معمارية', 'Architectural Villas' ),
		'penthouse'  => array( 'بنتهاوس', 'Sky Penthouses' ),
		'commercial' => array( 'أجنحة ضيافة وقاعات', 'Hospitality Pavilions' ),
	);

	foreach ( $tax_terms as $slug => $labels ) {
		if ( ! term_exists( $slug, 'project_typology' ) ) {
			wp_insert_term( $labels[0], 'project_typology', array( 'slug' => $slug ) );
		}
	}

	// -------------------------------------------------------------------------
	// 3. SEED REALISTIC ULTRA-LUXURY PROJECTS
	// -------------------------------------------------------------------------
	$projects = array(
		array(
			'slug'          => 'hittin-palace',
			'title_ar'      => 'قصر الأفق والسكينة الكلاسيكية',
			'title_en'      => 'The Horizon & Classical Sanctuary Palace',
			'typology'      => 'palace',
			'location_ar'   => 'حطين · الرياض',
			'location_en'   => 'Hittin · Riyadh',
			'area_ar'       => '3,850 م²',
			'area_en'       => '3,850 m²',
			'year_ar'       => '2025',
			'year_en'       => '2025',
			'duration_ar'   => '18 شهراً',
			'duration_en'   => '18 Months',
			'scope_ar'      => 'تسليم مفتاح كامل شامل العمارة والتنفيذ والتأثيث الحصري',
			'scope_en'      => 'Full Turnkey Scope: Architecture, Fit-Out & Bespoke Furnishing',
			'materials_ar'  => 'رخام كلكتا فيولا · خشب جوز إيطالي معتق · برونز فرنسي',
			'materials_en'  => 'Calacatta Viola Marble · Antiqued Italian Walnut · French Patinated Bronze',
			'card_layout'   => 'wide',
			'hero_image'    => $img_url_base . 'luxe_hero_foyer.jpg',
			'detail_image'  => $img_url_base . 'luxe_majlis_salon.jpg',
			'excerpt_ar'    => 'صياغة معمارية ملكية في حي حطين تجمع الأسقف الشاهقة بارتفاع 9 أمتار مع الرخام الإيطالي النادر وإخفاء تام لكافة التجهيزات الكهروميكانيكية داخل فواصل الظل.',
			'excerpt_en'    => 'A sovereign royal residence in Hittin uniting 9-meter double-height volumes with rare Italian marble and complete concealed shadow-gap engineering.',
			'challenge_ar'  => 'معالجة الفراغات المزدوجة الشاهقة وتأمين أقصى درجات العزل الصوتي والراحة المناخية مع إخفاء مجاري الهواء وفتحات الإضاءة بالكامل داخل التجويف النحتي.',
			'challenge_en'  => 'Mastering monumental double-height spaces while ensuring acoustic serenity and thermal balance with zero visible grilles or fixtures.',
			'solution_ar'   => 'تصنيع نظام جداري متكامل من خشب الجوز بمسافات ظل 3 مم، مع دمج ألواح الرخام الإيطالي بتقنية الفراشة المتناظرة وضبط إضاءة غير مباشرة بدرجة حرارة 2700 كلفن.',
			'solution_en'   => 'Engineering a bespoke 3mm shadow-gap fluted walnut envelope integrated with bookmatched Calacatta Viola slabs and concealed 2700K indirect illumination.',
		),
		array(
			'slug'          => 'olaya-sky-penthouse',
			'title_ar'      => 'سكاي بنتهاوس 360° والأفق البانورامي',
			'title_en'      => 'Sky Penthouse 360° & The Panoramic Horizon',
			'typology'      => 'penthouse',
			'location_ar'   => 'أبراج العليا · الرياض',
			'location_en'   => 'Olaya Towers · Riyadh',
			'area_ar'       => '920 م²',
			'area_en'       => '920 m²',
			'year_ar'       => '2025',
			'year_en'       => '2025',
			'duration_ar'   => '12 شهراً',
			'duration_en'   => '12 Months',
			'scope_ar'      => 'عمارة داخلية سيادية وتأثيث وتشطيب عالي الدقة',
			'scope_en'      => 'Sovereign Interior Architecture, Turnkey Fit-Out & Bespoke Furnishing',
			'materials_ar'  => 'ترافرتين نافونا · قواطع برونزية مفرغة · قماش بوكليه عاجي',
			'materials_en'  => 'Navona Travertine · Fluted Bronze Screens · Natural Ivory Bouclé',
			'card_layout'   => 'tall',
			'hero_image'    => $img_url_base . 'luxe_sky_penthouse.jpg',
			'detail_image'  => $img_url_base . 'luxe_joinery_detail.jpg',
			'excerpt_ar'    => 'ملاذ معلق في سماء الرياض يتميز بواجهات زجاجية بانورامية 360 درجة وأثاث عضوي منحنٍ ينساب بتناغم هادئ مع أفق المدينة المتلألئ عند الغسق.',
			'excerpt_en'    => 'A high-altitude sanctuary floating above Riyadh featuring 360-degree glass curtain walls, organic curved seating, and dusk city vistas.',
			'challenge_ar'  => 'السيطرة على التحديات البصرية والحرارية للارتفاعات الشاهقة ووهج شمس الرياض دون حجب المشهد البانورامي لأبراج المركز المالي.',
			'challenge_en'  => 'Controlling extreme high-altitude solar exposure without obscuring iconic panoramic city horizons.',
			'solution_ar'   => 'استخدام زجاج ذكي متعدد الطبقات مع قواطع شاقولية من البرونز المسحوب وأرضيات من الترافرتين المصقول غير العاكس للضوء.',
			'solution_en'   => 'Integrating smart low-emissivity glazing, fluted vertical bronze fins, and honed non-reflective travertine flooring.',
		),
		array(
			'slug'          => 'al-malqa-travertine-residence',
			'title_ar'      => 'فيلا الترافرتين والملاذ المائي الخاص',
			'title_en'      => 'The Travertine Residence & Water Sanctuary',
			'typology'      => 'villa',
			'location_ar'   => 'حي الملقا · الرياض',
			'location_en'   => 'Al-Malqa · Riyadh',
			'area_ar'       => '1,750 م²',
			'area_en'       => '1,750 m²',
			'year_ar'       => '2024',
			'year_en'       => '2024',
			'duration_ar'   => '14 شهراً',
			'duration_en'   => '14 Months',
			'scope_ar'      => 'تسليم مفتاح كامل ودمج الفناء المائي الداخلي',
			'scope_en'      => 'Complete Turnkey Handover & Indoor-Outdoor Courtyard Integration',
			'materials_ar'  => 'ترافرتين روماني نخب أول · خشب ساج معالج · أحواض مياه هادئة',
			'materials_en'  => 'First-Choice Roman Travertine · Weathered Teak · Mirror Water Basin',
			'card_layout'   => 'tall',
			'hero_image'    => $img_url_base . 'luxe_palace_courtyard.jpg',
			'detail_image'  => $img_url_base . 'luxe_joinery_detail.jpg',
			'excerpt_ar'    => 'فيلا معمارية هادئة تعيد صياغة علاقة السكن بالطبيعة عبر فناء مركزي مائي وشجرة زيتون معمرة وجدران من الترافرتين الروماني المحفور.',
			'excerpt_en'    => 'A serene architectural villa redefining indoor-outdoor living around a central reflecting pool, ancient olive tree, and monolithic travertine walls.',
			'challenge_ar'  => 'تأمين الخصوصية العائلية التامة مع الحفاظ على الانفتاح البصري الكامل للصالات الداخلية نحو الفناء الخارجي على مدار فصول السنة.',
			'challenge_en'  => 'Delivering absolute privacy while maintaining seamless transparency towards the central courtyard across all seasons.',
			'solution_ar'   => 'تصميم كتل معمارية متراجعة وزجاج ألماني عازل للصوت والحرارة مع مقاعد حجرية غائرة بإضاءة دافئة مدمجة تحتها.',
			'solution_en'   => 'Employing recessed architectural volumes, high-performance triple glazing, and cantilevered stone benches with integrated linear illumination.',
		),
		array(
			'slug'          => 'diriyah-banquet-pavilion',
			'title_ar'      => 'جناح المأدبة الملكي وبافيليون الضيافة',
			'title_en'      => 'The Sovereign Banquet Pavilion & Royal Reception',
			'typology'      => 'commercial',
			'location_ar'   => 'الدرعية التاريخية · الرياض',
			'location_en'   => 'Diriyah · Riyadh',
			'area_ar'       => '2,400 م²',
			'area_en'       => '2,400 m²',
			'year_ar'       => '2024',
			'year_en'       => '2024',
			'duration_ar'   => '16 شهراً',
			'duration_en'   => '16 Months',
			'scope_ar'      => 'عمارة داخلية متكاملة، خزائن أونيكس مضيئة، وطاولات مآدب مونوثية',
			'scope_en'      => 'Interior Architecture, Monolithic Nero Marquina Table & Backlit Onyx Cellar',
			'materials_ar'  => 'رخام نيرو ماركينا الإسباني · أونيكس عسلي مضيء · خشب جوز مقلم',
			'materials_en'  => 'Spanish Nero Marquina Marble · Backlit Honey Onyx · Fluted Walnut Joinery',
			'card_layout'   => 'wide',
			'hero_image'    => $img_url_base . 'luxe_dining_pavilion.jpg',
			'detail_image'  => $img_url_base . 'luxe_marble_curation.jpg',
			'excerpt_ar'    => 'صالة مآدب سيادية تتسع لـ 16 ضيفاً تتمحور حول طاولة مونوثية من رخام نيرو ماركينا وخزانة عرض من حجر الأونيكس المضاء المنحوت.',
			'excerpt_en'    => 'A sovereign 16-seat private dining pavilion anchored by a monolithic Nero Marquina table and an architectural backlit onyx display vault.',
			'challenge_ar'  => 'تصنيع ونقل وتركيب لوح رخام مونوثي وزنه يتجاوز 1,800 كجم دون أي وصلات ظاهرة وتأمين التوازن الإنشائي مع قواعد البرونز.',
			'challenge_en'  => 'Manufacturing, maneuvering, and installing a monolithic single-piece 1,800kg marble top with zero visible seams on custom bronze pedestals.',
			'solution_ar'   => 'هندسة هيكل تدعيم داخلي من ألياف الكربون وتثبيت ميكانيكي بالليزر مع نظام إضاءة سينوغرافي يخفف الظلال على وجوه الضيوف.',
			'solution_en'   => 'Engineering internal carbon-fiber substructures with laser alignment and a glare-free architectural chandelier casting flattering indirect light.',
		),
		array(
			'slug'          => 'al-khozama-private-sanctuary',
			'title_ar'      => 'ملاذ الأجنحة الملكية والسكينة الداخلية',
			'title_en'      => 'The Royal Sanctuary Master Suite & Private Spa',
			'typology'      => 'palace',
			'location_ar'   => 'حي الخزامى · الرياض',
			'location_en'   => 'Al-Khozama · Riyadh',
			'area_ar'       => '1,450 م²',
			'area_en'       => '1,450 m²',
			'year_ar'       => '2025',
			'year_en'       => '2025',
			'duration_ar'   => '12 شهراً',
			'duration_en'   => '12 Months',
			'scope_ar'      => 'تشطيب فندقي سيادي، عزل صوتي فائق 55 ديسيبل، وسينوغرافيا ليلية',
			'scope_en'      => 'Sovereign Presidential Suite Fit-Out, 55dB Acoustic Isolation & Night Scenography',
			'materials_ar'  => 'كتان وكشمير معالج · رخام أرابيسكاتو إيطالي · أرضيات باركيه فرنسي',
			'materials_en'  => 'Cashmere Wall Panels · Italian Arabescato Marble · French Chevron Parquet',
			'card_layout'   => 'medium',
			'hero_image'    => $img_url_base . 'luxe_master_suite.jpg',
			'detail_image'  => $img_url_base . 'luxe_joinery_detail.jpg',
			'excerpt_ar'    => 'جناح رئيسي سيادي يجمع الدفء اللمسي للأقمشة الطبيعية مع السكينة المطلقة وعزل الضجيج الخارجي بنسبة 100٪.',
			'excerpt_en'    => 'A sovereign presidential master suite combining tactile natural cashmere, serene silence, and complete acoustic decoupling.',
			'challenge_ar'  => 'عزل الضوضاء الحضرية كلياً وتحقيق هدوء فندقي من فئة السبع نجوم بمعدل أقل من 25 ديسيبل داخل غرف النوم الرئيسية.',
			'challenge_en'  => 'Eliminating all urban noise and vibration, achieving seven-star hotel stillness below 25dB in the private master sanctuary.',
			'solution_ar'   => 'تنفيذ نظام عزل صوتي مزدوج للجدران والأسقف مع أبواب مصفحة مخفية بنظام كتم هيدروليكي وشترات معتمة مدمجة في الألمنيوم.',
			'solution_en'   => 'Executing double-envelope acoustic wall decoupling, concealed hydraulic sound-damped doors, and integrated smart blackout blinds.',
		),
		array(
			'slug'          => 'sovereign-royal-majlis',
			'title_ar'      => 'ديوان الوجاهة ومجلس الاستقبال السيادي',
			'title_en'      => 'The Sovereign Majlis & Grand Protocol Salon',
			'typology'      => 'palace',
			'location_ar'   => 'حي الهدا · الرياض',
			'location_en'   => 'Al-Hada · Riyadh',
			'area_ar'       => '2,100 م²',
			'area_en'       => '2,100 m²',
			'year_ar'       => '2025',
			'year_en'       => '2025',
			'duration_ar'   => '14 شهراً',
			'duration_en'   => '14 Months',
			'scope_ar'      => 'عمارة نجدية معاصرة مجردة، رخام استثنائي، وإضاءة مخفية',
			'scope_en'      => 'Contemporary Najdi Spatial Philosophy, Bespoke Low Seating & Rare Stone',
			'materials_ar'  => 'رخام بيانكو سيلاس · برونز مفرغ بتقنية النقش النبيل · سجاد صوف يدوي',
			'materials_en'  => 'Bianco Sivec Marble · Laser-Sculpted Bronze Screens · Hand-Knotted Silk Rugs',
			'card_layout'   => 'medium',
			'hero_image'    => $img_url_base . 'luxe_majlis_salon.jpg',
			'detail_image'  => $img_url_base . 'luxe_marble_curation.jpg',
			'excerpt_ar'    => 'تجسيد حديث للضيافة النجدية العريقة بأبعاد فخمة وجلسات مخصصة ونوافذ مطلة على مسطحات مائية هادئة تعكس ضوء الرياض الذهبي.',
			'excerpt_en'    => 'A grand contemporary interpretation of noble hospitality featuring bespoke low-profile seating, water reflections, and warm golden light.',
			'challenge_ar'  => 'تحقيق الهيبة والوقار المعماري التقليدي دون الوقوع في الزخرفة المفرطة أو المساس بالروح الحداثية الصارمة للاستوديو.',
			'challenge_en'  => 'Honoring sovereign dignity and hospitality heritage without visual clutter, maintaining strict modern architectural purity.',
			'solution_ar'   => 'اعتماد خطوط تناظر نقية مع ألواح خشب البلوط المضلع وبرونز مطفأ، وتوزيع مسارات إضاءة ليزرية تبرز أصالة الخامات الطبيعية.',
			'solution_en'   => 'Implementing pure axial symmetry with fluted white oak, patinated bronze, and precision micro-spotlights highlighting raw stone textures.',
		),
	);

	foreach ( $projects as $proj_data ) {
		$existing_post = get_page_by_path( $proj_data['slug'], OBJECT, 'project' );

		$post_id = 0;
		if ( $existing_post ) {
			$post_id = $existing_post->ID;
			wp_update_post( array(
				'ID'           => $post_id,
				'post_title'   => $proj_data['title_ar'],
				'post_excerpt' => $proj_data['excerpt_ar'],
				'post_content' => $proj_data['excerpt_ar'],
				'post_status'  => 'publish',
			) );
		} else {
			$post_id = wp_insert_post( array(
				'post_name'    => $proj_data['slug'],
				'post_title'   => $proj_data['title_ar'],
				'post_excerpt' => $proj_data['excerpt_ar'],
				'post_content' => $proj_data['excerpt_ar'],
				'post_type'    => 'project',
				'post_status'  => 'publish',
			) );
		}

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			wp_set_object_terms( $post_id, $proj_data['typology'], 'project_typology' );

			update_post_meta( $post_id, '_project_title_en', $proj_data['title_en'] );
			update_post_meta( $post_id, '_project_desc_en', $proj_data['excerpt_en'] );
			update_post_meta( $post_id, '_project_location', $proj_data['location_ar'] );
			update_post_meta( $post_id, '_project_location_en', $proj_data['location_en'] );
			update_post_meta( $post_id, '_project_area', $proj_data['area_ar'] );
			update_post_meta( $post_id, '_project_area_en', $proj_data['area_en'] );
			update_post_meta( $post_id, '_project_year', $proj_data['year_ar'] );
			update_post_meta( $post_id, '_project_year_en', $proj_data['year_en'] );
			update_post_meta( $post_id, '_project_duration', $proj_data['duration_ar'] );
			update_post_meta( $post_id, '_project_duration_en', $proj_data['duration_en'] );
			update_post_meta( $post_id, '_project_scope', $proj_data['scope_ar'] );
			update_post_meta( $post_id, '_project_scope_en', $proj_data['scope_en'] );
			update_post_meta( $post_id, '_project_materials', $proj_data['materials_ar'] );
			update_post_meta( $post_id, '_project_materials_en', $proj_data['materials_en'] );
			update_post_meta( $post_id, '_project_card_layout', $proj_data['card_layout'] );
			update_post_meta( $post_id, '_project_nda_status', 'public' );
			update_post_meta( $post_id, '_project_challenge_ar', $proj_data['challenge_ar'] );
			update_post_meta( $post_id, '_project_challenge_en', $proj_data['challenge_en'] );
			update_post_meta( $post_id, '_project_solution_ar', $proj_data['solution_ar'] );
			update_post_meta( $post_id, '_project_solution_en', $proj_data['solution_en'] );
			update_post_meta( $post_id, '_project_hero_image', $proj_data['hero_image'] );
			update_post_meta( $post_id, '_project_detail_image', $proj_data['detail_image'] );
		}
	}

	// -------------------------------------------------------------------------
	// 4. SEED REALISTIC ARCHITECTURAL SERVICES
	// -------------------------------------------------------------------------
	$services = array(
		array(
			'slug'          => 'architectural-interior-design',
			'index'         => '01',
			'title_ar'      => 'التصميم المعماري والدراسات الفراغية السيادية',
			'title_en'      => 'Architectural Interior Design & Spatial Engineering',
			'sub_ar'        => 'تخطيط معماري ومحاكاة ثلاثية الأبعاد متقدمة',
			'sub_en'        => 'Master Planning & Hyper-Realistic Digital Simulation',
			'desc_ar'       => 'تخطيط فراغي سيادي لقصور وفلل النخبة يعيد رسم حركة الضوء الطبيعي وتوزيع المساحات، مع محاكاة بصرية فائقة الدقة تطابق الواقع بنسبة 100٪ قبل وضع حجر واحد في الموقع.',
			'desc_en'       => 'Sovereign spatial planning for palaces and high-end residences, engineering natural light orientation and ultra-precise BIM simulation matching final execution with zero margin of error.',
			'scope_ar'      => "التخطيط المعماري العام وتوزيع الفراغات\nالمخططات التنفيذية التفصيلية بمقياس 1:1 (Shop Drawings)\nمحاكاة سينوغرافيا الإضاءة ودراسة الظلال\nنماذج BIM متطورة خالية من تضاربات الكهروميكانيك",
			'scope_en'      => "Master Spatial Planning & Volumetric Studies\n1:1 Architectural Shop Drawings & Technical Details\nLighting Scenography & Shadow Simulation\nBIM Coordination with Zero MEP Clashes",
			'preview_image' => $img_url_base . 'luxe_hero_foyer.jpg',
		),
		array(
			'slug'          => 'turnkey-construction-fitout',
			'index'         => '02',
			'title_ar'      => 'المقاولات التخصصية وتسليم المفتاح المتكامل',
			'title_en'      => 'Turnkey Fit-Out & General Contracting',
			'sub_ar'        => 'تنفيذ هندسي صارم بمعايير الفنادق العالمية',
			'sub_en'        => 'Sovereign Construction & Absolute Turnkey Stewardship',
			'desc_ar'       => 'تنفيذ هندسي شامل يبدأ من الهياكل والعزل والأنظمة الكهروميكانيكية المخفية بالكامل داخل فواصل الظل، مروراً بتركيب أندر قطع الرخام والنجارة المعمارية المخصصة.',
			'desc_en'       => 'Comprehensive engineering execution from structural reinforcement, concealed shadow-gap MEP, and 55dB acoustic decoupling to master stone masonry and bespoke millwork.',
			'scope_ar'      => "إخفاء وتكامل شبكات التكييف والتهوية والإطفاء الذكي\nمعالجة العزل الصوتي والحراري بمعايير الأجنحة الرئاسية\nتركيب الرخام بتقنيات الفراشة المتناظرة والدعامات الميكانيكية\nإدارة الموقع بمهندسين مقيمين وتطبيق صارم لمواصفات الكود السعودي",
			'scope_en'      => "Concealed Architectural MEP Integration\nPresidential Suite Acoustic Isolation (55dB+)\nMechanical Cladding of Rare Bookmatched Slabs\nOn-Site Resident Senior Architects & Saudi Code Compliance",
			'preview_image' => $img_url_base . 'luxe_majlis_salon.jpg',
		),
		array(
			'slug'          => 'bespoke-architectural-joinery',
			'index'         => '03',
			'title_ar'      => 'النجارة المعمارية والتصنيع الحصري للأخشاب',
			'title_en'      => 'Architectural Millwork & Bespoke Joinery',
			'sub_ar'        => 'أعمال خشبية وتكسيات جدارية مصنعة خصيصاً',
			'sub_en'        => 'Custom Veneers, Shadow Gaps & Concealed Pivot Architecture',
			'desc_ar'       => 'ورش نجارة مخصصة لإنتاج تكسيات الجدران، الأبواب المتوارية ذات المفصلات المخفية، وخزائن العرض المدمجة من أفخر أخشاب الجوز والرماد الأوروبي المعتق.',
			'desc_en'       => 'Dedicated joinery atelier crafting architectural wall paneling, flush concealed pivot doors with 3mm bronze shadow gaps, and integrated display vitrines.',
			'scope_ar'      => "تكسيات جدارية من خشب الجوز المدخن والرماد الأوروبي\nأبواب محورية متوارية بمفصلات ألمانية مدمجة بدون إطارات ظاهرة\nوحدات تخزين وغرف ملابس مصفحة بجلود طبيعية وإضاءة ليزرية\nفواصل وظلال من البرونز والستانلس ستيل المسحوب يدوياً",
			'scope_en'      => "Smoked European Walnut & Fluted Ash Wall Paneling\nFlush Frameless Pivot Doors with Hidden German Hardware\nWalk-in Wardrobes with Leather Interiors & Micro-Optics\nHand-Drawn Patinated Bronze Shadow Gaps",
			'preview_image' => $img_url_base . 'luxe_joinery_detail.jpg',
		),
		array(
			'slug'          => 'rare-marble-quarry-curation',
			'index'         => '04',
			'title_ar'      => 'انتقاء وتوريد الرخام النادر من المحاجر مباشرة',
			'title_en'      => 'Direct Quarry Marble & Natural Stone Curation',
			'sub_ar'        => 'فحص واختيار ألواح كلكتا واستاتوريو في إيطاليا',
			'sub_en'        => 'Carrara, Tuscany & Verona Direct Selection Protocols',
			'desc_ar'       => 'نسافر مباشرة إلى محاجر كرارا وتوسكانا وفيرونا لانتقاء الكتل الحجرية الأندر وفحص العروق الطبيعية لوحاً بلوح، لضمان استمرارية النمط والفرادة المطلقة لكل قصر.',
			'desc_en'       => 'Direct procurement expeditions to Carrara and Tuscany quarries, inspecting raw blocks and dry-laying slabs to achieve seamless vein continuity.',
			'scope_ar'      => "انتقاء مباشر للألواح من محاجر كرارا وفيرونا بإيطاليا\nمطابقة العروق الجافة (Dry-Lay Inspection) قبل الشحن الجوي أو البحري\nمعالجات مانعة للبقع بأحدث تقنيات النانو غير المرئية\nتقطيع دقيق بتقنية Waterjet بمطابقة هندسية لأبعاد الفراغ",
			'scope_en'      => "Direct Quarry Sourcing in Carrara & Verona\nDry-Lay Vein Matching & Pre-Shipment Inspection\nInvisible Nano Sealant Penetration Protection\nCNC Waterjet Precision Cutting with Zero Margin of Error",
			'preview_image' => $img_url_base . 'luxe_marble_curation.jpg',
		),
		array(
			'slug'          => 'lighting-scenography-smart-automation',
			'index'         => '05',
			'title_ar'      => 'سينوغرافيا الإضاءة والأتمتة الذكية المتوارية',
			'title_en'      => 'Lighting Scenography & Concealed Smart Automation',
			'sub_ar'        => 'هندسة الضوء والتحكم البيئي غير المرئي',
			'sub_en'        => 'Architectural Micro-Optics & Invisible Building Intelligence',
			'desc_ar'       => 'تصميم سينوغرافيا ضوئية متطورة باستخدام وحدات إضاءة متناهية الصغر تخفي مصدر الضوء بالكامل وتبرز جمال المواد، متصلة بنظام أتمتة عالمي متكامل بنقرة واحدة.',
			'desc_en'       => 'Advanced lighting scenography using trimless micro-optics that conceal the light source while dramatizing texture, fully integrated into intuitive KNX and Lutron systems.',
			'scope_ar'      => "عدسات ومسارات مغناطيسية متوارية بدون إطارات (Trimless Micro-Optics)\nسيناريوهات إضاءة متغيرة تتكيف مع ساعات النهار وسكينة المساء\nدمج كامل لأنظمة لوترون (Lutron) وكي إن إكس (KNX)\nمفاتيح جدارية مخصصة من النحاس المعتق بشعارات محفورة بالليزر",
			'scope_en'      => "Trimless Magnetic Architectural Micro-Track Systems\nCircadian Rhythm Scenes Synchronized with Dawn & Dusk\nFull Lutron & KNX Sovereign Automation Integration\nCustom Patinated Brass Keypads & Touch Interfaces",
			'preview_image' => $img_url_base . 'luxe_dining_pavilion.jpg',
		),
	);

	foreach ( $services as $srv_data ) {
		$existing_post = get_page_by_path( $srv_data['slug'], OBJECT, 'service' );

		$post_id = 0;
		if ( $existing_post ) {
			$post_id = $existing_post->ID;
			wp_update_post( array(
				'ID'           => $post_id,
				'post_title'   => $srv_data['title_ar'],
				'post_excerpt' => $srv_data['desc_ar'],
				'post_content' => $srv_data['desc_ar'],
				'post_status'  => 'publish',
			) );
		} else {
			$post_id = wp_insert_post( array(
				'post_name'    => $srv_data['slug'],
				'post_title'   => $srv_data['title_ar'],
				'post_excerpt' => $srv_data['desc_ar'],
				'post_content' => $srv_data['desc_ar'],
				'post_type'    => 'service',
				'post_status'  => 'publish',
			) );
		}

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_service_index', $srv_data['index'] );
			update_post_meta( $post_id, '_service_title_en', $srv_data['title_en'] );
			update_post_meta( $post_id, '_service_subtitle_ar', $srv_data['sub_ar'] );
			update_post_meta( $post_id, '_service_subtitle_en', $srv_data['sub_en'] );
			update_post_meta( $post_id, '_service_desc_en', $srv_data['desc_en'] );
			update_post_meta( $post_id, '_service_scope_items_ar', $srv_data['scope_ar'] );
			update_post_meta( $post_id, '_service_scope_items_en', $srv_data['scope_en'] );
			update_post_meta( $post_id, '_service_preview_image', $srv_data['preview_image'] );
		}
	}

	// -------------------------------------------------------------------------
	// 5. SEED CONFIDENTIAL CLIENT DOSSIERS (الأضابير الخاصة)
	// -------------------------------------------------------------------------
	$brief_count = wp_count_posts( 'brief' );
	if ( empty( $brief_count->publish ) || $force ) {
		$sample_briefs = array(
			array(
				'title'    => 'أضبارة: صاحب السمو الأمير م. ع. آل سعود — قصر سيادي مستقل',
				'name'     => 'صاحب السمو الأمير م. ع. آل سعود',
				'phone'    => '+966 50 512 3456',
				'type'     => 'قصر سيادي مستقل',
				'scale'    => '4,500 م²',
				'scope'    => 'تسليم مفتاح شامل (تصميم + تشطيب + تأثيث)',
				'location' => 'حي الهدا · المربع الدبلوماسي، الرياض',
				'timeline' => 'بدء فوري خلال هذا الشهر',
			),
			array(
				'title'    => 'أضبارة: معالي د. عبد العزيز بن سلطان — سكاي بنتهاوس فاخر',
				'name'     => 'معالي د. عبد العزيز بن سلطان',
				'phone'    => '+966 55 498 7654',
				'type'     => 'سكاي بنتهاوس فاخر',
				'scale'    => '950 م²',
				'scope'    => 'تشطيب فاخر وتأثيث حصري',
				'location' => 'أبراج العليا · الرياض',
				'timeline' => 'خلال 3 أشهر (الربع القادم)',
			),
			array(
				'title'    => 'أضبارة: سعادة الشيخ عبد الله التميمي — فيلا ملكية خاصة',
				'name'     => 'سعادة الشيخ عبد الله التميمي',
				'phone'    => '+966 50 633 2211',
				'type'     => 'فيلا ملكية خاصة',
				'scale'    => '2,800 م²',
				'scope'    => 'تصميم معماري وداخلي وإشراف سيادي',
				'location' => 'حي حطين النموذجي · الرياض',
				'timeline' => 'خلال 6 أشهر',
			),
		);

		foreach ( $sample_briefs as $sb ) {
			$existing_briefs = get_posts( array(
				'title'          => $sb['title'],
				'post_type'      => 'brief',
				'post_status'    => 'any',
				'posts_per_page' => 1,
			) );
			$existing_brief  = ! empty( $existing_briefs ) ? $existing_briefs[0] : null;
			if ( ! $existing_brief ) {
				$b_id = wp_insert_post( array(
					'post_title'   => $sb['title'],
					'post_type'    => 'brief',
					'post_status'  => 'publish',
					'post_content' => sprintf(
						"العميل: %s\nالهاتف: %s\nالنوع: %s\nالمساحة: %s\nالنطاق: %s\nالموقع: %s\nالموعد: %s",
						$sb['name'], $sb['phone'], $sb['type'], $sb['scale'], $sb['scope'], $sb['location'], $sb['timeline']
					),
				) );
				if ( $b_id && ! is_wp_error( $b_id ) ) {
					update_post_meta( $b_id, '_brief_client_name', $sb['name'] );
					update_post_meta( $b_id, '_brief_client_phone', $sb['phone'] );
					update_post_meta( $b_id, '_brief_property_type', $sb['type'] );
					update_post_meta( $b_id, '_brief_property_scale', $sb['scale'] );
					update_post_meta( $b_id, '_brief_property_scope', $sb['scope'] );
					update_post_meta( $b_id, '_brief_client_location', $sb['location'] );
					update_post_meta( $b_id, '_brief_client_timeline', $sb['timeline'] );
				}
			}
		}
	}

	// -------------------------------------------------------------------------
	// 6. SEED ARCHITECTURAL LEADERSHIP & PARTNERS (فريق الاستوديو)
	// -------------------------------------------------------------------------
	$team_members = array(
		array(
			'slug'         => 'khaled-alfaisal',
			'title_ar'     => 'م. خالد الفيصل',
			'title_en'     => 'Arch. Khaled Al-Faisal',
			'role_ar'      => 'الشريك المؤسس • كبير المعماريين',
			'role_en'      => 'Co-Founder • Principal Architect',
			'tag_ar'       => 'الشريك المؤسس',
			'tag_en'       => 'Founding Partner',
			'cred_ar'      => 'ماجستير العمارة من جامعة هارفارد • عضو الهيئة السعودية للمهندسين',
			'cred_en'      => 'M.Arch Harvard University • Saudi Council of Engineers',
			'bio_ar'       => 'قاد تخطيط وتنفيذ أكثر من 60 قصراً رئاسياً وخاصاً في الرياض والخليج على مدار 18 عاماً. يؤمن بأن العمارة السيادية تستحضر السكينة دون ضجيج بصري.',
			'bio_en'       => 'Steered the architectural planning and turnkey execution of over 60 royal residences and private palaces across Riyadh and the Gulf over 18 years.',
			'photo'        => $img_url_base . 'luxe_team_khaled_alfaisal.jpg',
			'is_principal' => '1',
			'order'        => 1,
		),
		array(
			'slug'         => 'tariq-nabulsi',
			'title_ar'     => 'م. طارق النابلسي',
			'title_en'     => 'Arch. Tariq Al-Nabulsi',
			'role_ar'      => 'الشريك التنفيذي • مدير الصياغة المكانية',
			'role_en'      => 'Executive Partner • Spatial Design Director',
			'tag_ar'       => 'شريك تنفيذي',
			'tag_en'       => 'Executive Partner',
			'cred_ar'      => 'مدرسة العمارة (AA) بلندن • نقابة المهندسين الأردنيين',
			'cred_en'      => 'Architectural Association (AA) London • Jordan Engineers Association',
			'bio_ar'       => 'متخصص في هندسة الفراغات النحتية ودراسات الضوء المعماري ودمج المواد النبيلة. قاد تصميم كبرى الإقامات والقصور الخاصة في الرياض وعمّان.',
			'bio_en'       => 'Specialist in sculptural spatial flow, architectural daylight engineering, and rare material integration across premier private estates in Riyadh and Amman.',
			'photo'        => $img_url_base . 'luxe_team_tariq_nabulsi.jpg',
			'is_principal' => '1',
			'order'        => 2,
		),
		array(
			'slug'         => 'hazem-abdelsalam',
			'title_ar'     => 'د. م. حازم عبد السلام',
			'title_en'     => 'Dr. Eng. Hazem Abdel-Salam',
			'role_ar'      => 'رئيس قطاع الهندسة الإنشائية والتنفيذ',
			'role_en'      => 'Director of Structural Engineering & Turnkey Fit-Out',
			'tag_ar'       => '',
			'tag_en'       => '',
			'cred_ar'      => 'دكتوراه الهندسة الإنشائية • جامعة القاهرة • استشاري إدارة المشاريع (PMP)',
			'cred_en'      => 'Ph.D. Structural Engineering, Cairo University • Certified Project Management Professional (PMP)',
			'bio_ar'       => 'يشرف على فرق المهندسين المقيمين في الموقع ويقود بروتوكول الجودة والتحكم الإنشائي الصارم المكون من 34 نقطة تفتيش هندسية أسبوعية.',
			'bio_en'       => 'Directs resident on-site engineering teams and enforces an uncompromising 34-checkpoint weekly structural quality protocol.',
			'photo'        => $img_url_base . 'luxe_team_hazem_abdelsalam.jpg',
			'is_principal' => '0',
			'order'        => 3,
		),
		array(
			'slug'         => 'nasser-alqahtani',
			'title_ar'     => 'م. ناصر القحطاني',
			'title_en'     => 'Eng. Nasser Al-Qahtani',
			'role_ar'      => 'مدير المقاولات التخصصية وإدارة المشاريع',
			'role_en'      => 'Director of Specialist Contracting & Site Operations',
			'tag_ar'       => '',
			'tag_en'       => '',
			'cred_ar'      => 'بكالوريوس الهندسة المدنية • جامعة الملك فهد للبترول والمعادن (KFUPM)',
			'cred_en'      => 'B.Sc. Civil Engineering, King Fahd University of Petroleum & Minerals (KFUPM)',
			'bio_ar'       => 'يمتلك 15 عاماً من الخبرة في قيادة المواقع الكبرى المعقدة وإدارة فرق الحرفيين التخصصيين لضمان تسليم المفتاح بأعلى دقة قياسية.',
			'bio_en'       => '15 years of rigorous leadership across monumental construction sites, steering master craftsmen to guarantee turnkey precision.',
			'photo'        => $img_url_base . 'luxe_team_nasser_alqahtani.jpg',
			'is_principal' => '0',
			'order'        => 4,
		),
		array(
			'slug'         => 'yasmine-elsherif',
			'title_ar'     => 'م. ياسمين الشريف',
			'title_en'     => 'Eng. Yasmine El-Sherif',
			'role_ar'      => 'رئيسة سلاسل التوريد وانتقاء المواد الحصرية',
			'role_en'      => 'Director of Rare Materials & Sovereign Procurement',
			'tag_ar'       => '',
			'tag_en'       => '',
			'cred_ar'      => 'ماجستير التصميم البيئي والجيولوجيا المعمارية',
			'cred_en'      => 'M.Sc. Environmental Design & Architectural Geology',
			'bio_ar'       => 'تتولى الفحص الجيولوجي المباشر لألواح الرخام في مقالع إيطاليا وانتقاء كتل الترافرتين والبرونز النادر لقصور الرياض قبل شحنها.',
			'bio_en'       => 'Conducts direct quarry inspections in Carrara and Verona, hand-selecting monolithic travertine and architectural bronze for Riyadh estates.',
			'photo'        => $img_url_base . 'luxe_team_yasmine_elsherif.jpg',
			'is_principal' => '0',
			'order'        => 5,
		),
	);

	foreach ( $team_members as $tm ) {
		$existing_tm = get_page_by_path( $tm['slug'], OBJECT, 'team' );
		$t_id = 0;
		if ( $existing_tm ) {
			$t_id = $existing_tm->ID;
			wp_update_post( array(
				'ID'           => $t_id,
				'post_title'   => $tm['title_ar'],
				'post_excerpt' => $tm['bio_ar'],
				'post_content' => $tm['bio_ar'],
				'post_status'  => 'publish',
				'menu_order'   => $tm['order'],
			) );
		} else {
			$t_id = wp_insert_post( array(
				'post_name'    => $tm['slug'],
				'post_title'   => $tm['title_ar'],
				'post_excerpt' => $tm['bio_ar'],
				'post_content' => $tm['bio_ar'],
				'post_type'    => 'team',
				'post_status'  => 'publish',
				'menu_order'   => $tm['order'],
			) );
		}

		if ( $t_id && ! is_wp_error( $t_id ) ) {
			update_post_meta( $t_id, '_team_name_en', $tm['title_en'] );
			update_post_meta( $t_id, '_team_role_ar', $tm['role_ar'] );
			update_post_meta( $t_id, '_team_role_en', $tm['role_en'] );
			update_post_meta( $t_id, '_team_tag_ar', $tm['tag_ar'] );
			update_post_meta( $t_id, '_team_tag_en', $tm['tag_en'] );
			update_post_meta( $t_id, '_team_cred_ar', $tm['cred_ar'] );
			update_post_meta( $t_id, '_team_cred_en', $tm['cred_en'] );
			update_post_meta( $t_id, '_team_bio_ar', $tm['bio_ar'] );
			update_post_meta( $t_id, '_team_bio_en', $tm['bio_en'] );
			update_post_meta( $t_id, '_team_photo', $tm['photo'] );
			update_post_meta( $t_id, '_team_is_principal', $tm['is_principal'] );
		}
	}

	// -------------------------------------------------------------------------
	// 7. SEED EXCLUSIVE MATERIALS (مكتبة الخامات الحصرية)
	// -------------------------------------------------------------------------
	$materials = array(
		array(
			'slug'      => 'calacatta-viola-marble',
			'index'     => '01',
			'title_ar'  => 'رخام كالاكاتا فيولا',
			'title_en'  => 'Calacatta Viola Marble',
			'origin_ar' => 'محاجر كرارا · توسكانا، إيطاليا',
			'origin_en' => 'Carrara Quarries · Tuscany, Italy',
			'desc_ar'   => 'تعريقات نبيذية نادرة على خلفية بيضاء نقية، مقطوعة بنمط الفراشة المتناظر لجدران المجالس الرئيسية والبهو الملكي.',
			'desc_en'   => 'Rare cabernet veins upon a pristine ivory backdrop, precision bookmatched for sovereign salons and double-height foyers.',
			'image'     => $img_url_base . 'luxe_mat_calacatta_viola.jpg',
			'order'     => 1,
		),
		array(
			'slug'      => 'french-walnut',
			'index'     => '02',
			'title_ar'  => 'خشب الجوز المعتق',
			'title_en'  => 'Aged French Walnut',
			'origin_ar' => 'غابات بورغندي · فرنسا',
			'origin_en' => 'Burgundy Forests · France',
			'desc_ar'   => 'ألياف متراصة مشبعة بزيوت طبيعية عضوية تبرز عمق اللون البني الداكن وتمنع التمدد في الأجواء الصحراوية.',
			'desc_en'   => 'Dense grain saturated with organic oils, accentuating deep mocha tones and preventing dimensional shifting in desert climates.',
			'image'     => $img_url_base . 'luxe_mat_french_walnut.jpg',
			'order'     => 2,
		),
		array(
			'slug'      => 'patinated-bronze',
			'index'     => '03',
			'title_ar'  => 'البرونز المؤكسد يدوياً',
			'title_en'  => 'Hand-Patinated Bronze',
			'origin_ar' => 'مسابك الحرفيين · فلورنسا، إيطاليا',
			'origin_en' => 'Artisan Foundries · Florence, Italy',
			'desc_ar'   => 'سبائك صلبة مؤكسدة كيميائياً بطبقة حماية طبيعية عتيقة تمنح المقابض والفواصل المعدنية عمراً يمتد لعقود.',
			'desc_en'   => 'Heavy solid bronze alloys chemically oxidised with a living tactile patina, ensuring ironmongery and reveals endure for generations.',
			'image'     => $img_url_base . 'luxe_mat_patinated_bronze.jpg',
			'order'     => 3,
		),
		array(
			'slug'      => 'roman-travertine',
			'index'     => '04',
			'title_ar'  => 'الترافرتين الروماني',
			'title_en'  => 'First-Choice Roman Travertine',
			'origin_ar' => 'محاجر تيفولي · روما، إيطاليا',
			'origin_en' => 'Tivoli Quarries · Rome, Italy',
			'desc_ar'   => 'حجر كلاسيكي دافئ بمسام طبيعية معالجة بالراتنج الشفاف العاكس، ذات الحجر المعتمد في أرقى معالم العمارة العالمية.',
			'desc_en'   => 'Monolithic warm stone with natural cellular pores sealed in transparent resin, the exact geological quarry powering classical architecture.',
			'image'     => $img_url_base . 'luxe_mat_roman_travertine.jpg',
			'order'     => 4,
		),
	);

	foreach ( $materials as $mat ) {
		$existing_mat = get_page_by_path( $mat['slug'], OBJECT, 'material' );
		$m_id = 0;
		if ( $existing_mat ) {
			$m_id = $existing_mat->ID;
			wp_update_post( array(
				'ID'           => $m_id,
				'post_title'   => $mat['title_ar'],
				'post_excerpt' => $mat['desc_ar'],
				'post_content' => $mat['desc_ar'],
				'post_status'  => 'publish',
				'menu_order'   => $mat['order'],
			) );
		} else {
			$m_id = wp_insert_post( array(
				'post_name'    => $mat['slug'],
				'post_title'   => $mat['title_ar'],
				'post_excerpt' => $mat['desc_ar'],
				'post_content' => $mat['desc_ar'],
				'post_type'    => 'material',
				'post_status'  => 'publish',
				'menu_order'   => $mat['order'],
			) );
		}

		if ( $m_id && ! is_wp_error( $m_id ) ) {
			update_post_meta( $m_id, '_material_index', $mat['index'] );
			update_post_meta( $m_id, '_material_title_en', $mat['title_en'] );
			update_post_meta( $m_id, '_material_origin_ar', $mat['origin_ar'] );
			update_post_meta( $m_id, '_material_origin_en', $mat['origin_en'] );
			update_post_meta( $m_id, '_material_desc_ar', $mat['desc_ar'] );
			update_post_meta( $m_id, '_material_desc_en', $mat['desc_en'] );
			update_post_meta( $m_id, '_material_image', $mat['image'] );
		}
	}

	flush_rewrite_rules( false );
	update_option( 'interior_seeded_v3', 'yes' );
}

/**
 * Trigger seed on init if not seeded or if requested via ?interior_reseed=1
 */
function interior_check_seed_trigger() {
	if ( ! get_option( 'interior_articles_page_seeded' ) ) {
		$articles_page = get_page_by_path( 'articles', OBJECT, 'page' );
		if ( ! $articles_page ) {
			$art_page_id = wp_insert_post( array(
				'post_name'   => 'articles',
				'post_title'  => 'المقالات والدراسات المعمارية',
				'post_type'   => 'page',
				'post_status' => 'publish',
			) );
		} else {
			$art_page_id = $articles_page->ID;
		}
		if ( $art_page_id && ! is_wp_error( $art_page_id ) ) {
			update_post_meta( $art_page_id, '_wp_page_template', 'page-templates/articles.php' );
		}
		flush_rewrite_rules( false );
		update_option( 'interior_articles_page_seeded', 'yes' );
	}

	if ( isset( $_GET['interior_reseed'] ) && '1' === $_GET['interior_reseed'] ) {
		flush_rewrite_rules( false );
		interior_seed_database_content( true );
		if ( is_admin() ) {
			wp_safe_redirect( admin_url( 'admin.php?page=interior-studio-settings&reseeded=1' ) );
			exit;
		}
	} elseif ( ! get_option( 'interior_seeded_v3' ) ) {
		interior_seed_database_content( false );
	}
}
add_action( 'init', 'interior_check_seed_trigger', 20 );
