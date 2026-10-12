<?php
/**
 * Single Project Template: Sovereign Case Study Monograph
 * Fully dynamic from WordPress dashboard and custom post meta.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/header-luxury' );

$post_id   = get_the_ID();
$lang      = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
$img_dir   = get_stylesheet_directory_uri() . '/assets/images/';

$p_title    = interior_get_project_title( $post_id );
$p_excerpt  = interior_get_project_excerpt( $post_id );
$p_loc      = interior_get_project_location( $post_id );
$p_area     = interior_get_project_area( $post_id );
$p_year     = interior_get_project_year( $post_id );
$p_duration = ( 'en' === $lang ) ? ( get_post_meta( $post_id, '_project_duration_en', true ) ?: '14 Months' ) : ( get_post_meta( $post_id, '_project_duration', true ) ?: '14 شهراً' );
$p_scope    = interior_get_project_scope( $post_id );
$p_mats     = interior_get_project_materials( $post_id );
$p_hero     = interior_get_project_image( $post_id, 'hero' );
$p_detail   = interior_get_project_image( $post_id, 'detail' );

$p_chal = ( 'en' === $lang ) ? get_post_meta( $post_id, '_project_challenge_en', true ) : get_post_meta( $post_id, '_project_challenge_ar', true );
$p_sol  = ( 'en' === $lang ) ? get_post_meta( $post_id, '_project_solution_en', true ) : get_post_meta( $post_id, '_project_solution_ar', true );

if ( empty( $p_chal ) ) {
	$p_chal = ( 'en' === $lang )
		? 'Resolving monumental double-height volumes while achieving acoustic perfection and complete MEP concealment within recessed architectural reveals.'
		: 'معالجة الفراغات المزدوجة الشاهقة وتأمين أقصى درجات العزل الصوتي والراحة المناخية مع إخفاء مجاري الهواء وفتحات الإضاءة بالكامل داخل التجويف النحتي.';
}

if ( empty( $p_sol ) ) {
	$p_sol = ( 'en' === $lang )
		? 'Engineering a bespoke 3mm shadow-gap fluted walnut envelope integrated with bookmatched marble slabs and concealed 2700K indirect illumination.'
		: 'تصنيع نظام جداري متكامل من خشب الجوز بمسافات ظل 3 مم، مع دمج ألواح الرخام الإيطالي بتقنية الفراشة المتناظرة وضبط إضاءة غير مباشرة بدرجة حرارة 2700 كلفن.';
}

// Next project
$next_post = get_adjacent_post( false, '', false );
if ( ! $next_post ) {
	// Loop back to the first published project
	$first_query = new WP_Query( array(
		'post_type'      => 'project',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
		'orderby'        => 'ID',
		'order'          => 'ASC',
	) );
	if ( $first_query->have_posts() ) {
		$next_post = $first_query->posts[0];
	}
}
?>

<main class="luxe-main" id="main-content" tabindex="-1" role="main">

	<!-- 01. Fullscreen Monumental Hero (Fullscreen 100vh, Vertically Centered) -->
	<section class="luxe-hero" id="casestudy-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $p_hero ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content" style="max-width: 960px;">
				<h1 class="luxe-hero__title">
					<?php echo esc_html( $p_title ); ?>
				</h1>

				<p class="luxe-hero__lead">
					<?php echo esc_html( $p_excerpt ); ?>
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span><?php echo ( 'en' === $lang ) ? 'Commission a Private Feasibility Study' : 'طلب دراسة معمارية خاصة لمشروعك'; ?></span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#narrative" class="luxe-btn--text">
						<span><?php echo ( 'en' === $lang ) ? 'Explore Spatial Challenge & Plates' : 'استكشف تفاصيل التنفيذ والمخططات'; ?></span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. Technical Metadata Strip بخط Mono -->
	<div class="luxe-technical-spec-strip">
		<div class="luxe-container">
			<div class="luxe-spec-grid">
				<div class="luxe-spec-item">
					<span class="luxe-spec-label"><?php echo ( 'en' === $lang ) ? 'Geographic Location' : 'الموقع الجغرافي'; ?></span>
					<span class="luxe-spec-val"><?php echo esc_html( $p_loc ); ?></span>
				</div>
				<div class="luxe-spec-item">
					<span class="luxe-spec-label"><?php echo ( 'en' === $lang ) ? 'Built-Up Area' : 'المساحة المبنية'; ?></span>
					<span class="luxe-spec-val"><?php echo esc_html( $p_area ); ?></span>
				</div>
				<div class="luxe-spec-item">
					<span class="luxe-spec-label"><?php echo ( 'en' === $lang ) ? 'Execution Timeline' : 'المدة الزمنية'; ?></span>
					<span class="luxe-spec-val"><?php echo esc_html( $p_duration ); ?></span>
				</div>
				<div class="luxe-spec-item">
					<span class="luxe-spec-label"><?php echo ( 'en' === $lang ) ? 'Handover Year' : 'سنة التسليم'; ?></span>
					<span class="luxe-spec-val"><?php echo esc_html( $p_year ); ?></span>
				</div>
				<div class="luxe-spec-item">
					<span class="luxe-spec-label"><?php echo ( 'en' === $lang ) ? 'Stewardship Scope' : 'نطاق المسؤولية'; ?></span>
					<span class="luxe-spec-val" style="color: var(--interior-brass-light);"><?php echo esc_html( $p_scope ); ?></span>
				</div>
			</div>
		</div>
	</div>

	<!-- 03. التحدي الفراغي والمعالجة المعمارية (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="narrative">
		<div class="luxe-container">
			<div class="luxe-case-narrative-grid">
				
				<!-- The Challenge -->
				<div style="border-inline-end: 1px solid var(--interior-hairline); padding-inline-end: clamp(1.5rem, 3vw, 3rem);">
					<span class="luxe-meta-latin" style="display: block; margin-bottom: 0.75rem;">
						<?php echo ( 'en' === $lang ) ? 'Spatial Engineering Challenge · 01' : 'التحدي الفراغي والهندسي · 01'; ?>
					</span>
					<h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--interior-bone); line-height: 1.3; margin-bottom: 1.5rem;">
						<?php echo ( 'en' === $lang ) ? 'Monumental Scale without <span class="luxe-accent-serif">Spatial Coldness</span>' : 'احتواء المساحة الشاسعة دون <span class="luxe-accent-serif">برود مكاني</span> أو ضجيج'; ?>
					</h2>
					<p style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted); margin-bottom: 1.25rem;">
						<?php echo esc_html( $p_chal ); ?>
					</p>
					<p style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted);">
						<?php echo ( 'en' === $lang ) ? 'Material Palette: ' . esc_html( $p_mats ) : 'لوحة الخامات الحصرية المعتمدة: ' . esc_html( $p_mats ); ?>
					</p>
				</div>

				<!-- The Resolution -->
				<div style="padding-inline-start: clamp(1.5rem, 3vw, 3rem);">
					<span class="luxe-meta-latin" style="display: block; margin-bottom: 0.75rem;">
						<?php echo ( 'en' === $lang ) ? 'Sovereign Execution Protocol · 02' : 'المعالجة المعمارية الصارمة · 02'; ?>
					</span>
					<h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--interior-bone); line-height: 1.3; margin-bottom: 1.5rem;">
						<?php echo ( 'en' === $lang ) ? 'Concealed Acoustics & <span class="luxe-accent-serif">Direct Quarry Curation</span>' : 'هندسة صوتية مخفية <span class="luxe-accent-serif">وتوريد مباشر</span> من مقالع إيطاليا'; ?>
					</h2>
					<p style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted); margin-bottom: 1.25rem;">
						<?php echo esc_html( $p_sol ); ?>
					</p>
					<p style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted);">
						<?php echo ( 'en' === $lang )
							? 'Every element was coordinated in full 1:1 BIM shop drawings with zero tolerance for on-site execution deviations.'
							: 'جرت مراجعة واعتماد كافة التفاصيل عبر نمذجة رقمية ثلاثية الأبعاد خالية من أي تضارب بين الكهروميكانيك والديكور المعماري.'; ?>
					</p>
				</div>

			</div>
		</div>
	</section>

	<!-- 04. معرض اللقطات الكبرى بإيقاع متبدل (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal">
		<div class="luxe-container">
			
			<!-- Image 1: Hero Detail Panorama -->
			<div style="border: 1px solid var(--interior-hairline); margin-bottom: clamp(3rem, 5vw, 5rem); overflow: hidden;">
				<img src="<?php echo esc_url( $p_detail ); ?>" alt="<?php echo esc_attr( $p_title . ' — ' . ( ( 'en' === $lang ) ? 'Plate 01 Architectural Panorama' : 'لوحة 01 الفضاء المعماري' ) ); ?>" style="width: 100%; height: clamp(450px, 60vw, 750px); object-fit: cover; display: block;" loading="lazy" decoding="async" />
				<div style="padding: 1.25rem 2rem; background: var(--interior-ink); display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--interior-hairline);">
					<span class="luxe-meta-latin">
						<?php echo ( 'en' === $lang ) ? 'Plate 01 // Architectural Space & Noble Proportions' : 'لوحة 01 // الفضاء المعماري والتناسب النبيل'; ?>
					</span>
					<span style="font-family: var(--font-mono); font-size: 10px; color: var(--interior-text-muted);">
						<?php echo esc_html( $p_loc ); ?>
					</span>
				</div>
			</div>

			<!-- Image 2 & 3: Diptych (Two side-by-side) -->
			<div style="display: grid; grid-template-columns: 1fr 1fr; gap: clamp(1.5rem, 3vw, 3rem); margin-bottom: clamp(3rem, 5vw, 5rem);">
				<div style="border: 1px solid var(--interior-hairline); overflow: hidden;">
					<img src="<?php echo esc_url( $img_dir . 'luxe_joinery_detail.jpg' ); ?>" alt="<?php echo esc_attr( ( 'en' === $lang ) ? 'Plate 02 Bespoke Joinery & 3mm Bronze Reveal' : 'لوحة 02 تفاصيل النجارة المعمارية وفواصل الظل' ); ?>" style="width: 100%; height: clamp(360px, 45vw, 540px); object-fit: cover; display: block;" loading="lazy" decoding="async" />
					<div style="padding: 1rem 1.5rem; background: var(--interior-ink); border-top: 1px solid var(--interior-hairline);">
						<span class="luxe-meta-latin">
							<?php echo ( 'en' === $lang ) ? 'Plate 02 // 3mm Bronze Reveal & Fluted Walnut' : 'لوحة 02 // فاصل ظل برونزي 3 مم وخشب جوز مقلم'; ?>
						</span>
					</div>
				</div>
				<div style="border: 1px solid var(--interior-hairline); overflow: hidden;">
					<img src="<?php echo esc_url( $img_dir . 'luxe_marble_curation.jpg' ); ?>" alt="<?php echo esc_attr( ( 'en' === $lang ) ? 'Plate 03 Rare Bookmatched Calacatta Marble Slabs' : 'لوحة 03 ألواح الرخام الإيطالي المتناظر' ); ?>" style="width: 100%; height: clamp(360px, 45vw, 540px); object-fit: cover; display: block;" loading="lazy" decoding="async" />
					<div style="padding: 1rem 1.5rem; background: var(--interior-ink); border-top: 1px solid var(--interior-hairline);">
						<span class="luxe-meta-latin">
							<?php echo ( 'en' === $lang ) ? 'Plate 03 // Rare Bookmatched Quarry Selection' : 'لوحة 03 // انتقاء ألواح كلكتا واستاتوريو المتناظرة'; ?>
						</span>
					</div>
				</div>
			</div>

			<!-- Image 4 + Editorial Quotation -->
			<div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: clamp(2rem, 5vw, 5rem); align-items: center;">
				<div style="border: 1px solid var(--interior-hairline); overflow: hidden;">
					<img src="<?php echo esc_url( $img_dir . 'luxe_palace_courtyard.jpg' ); ?>" alt="<?php echo esc_attr( ( 'en' === $lang ) ? 'Plate 04 Travertine Water Courtyard & Private Pavilion' : 'لوحة 04 الملاذ المائي وفناء الترافرتين' ); ?>" style="width: 100%; height: clamp(350px, 40vw, 500px); object-fit: cover; display: block;" loading="lazy" decoding="async" />
				</div>
				<div style="padding-inline: 1rem;">
					<span class="luxe-meta-latin" style="display: block; margin-bottom: 0.75rem;">
						<?php echo ( 'en' === $lang ) ? 'Client Testament & Confidential Provenance' : 'شهادة إتقان وتوثيق المالك'; ?>
					</span>
					<blockquote style="font-family: var(--font-heading); font-size: clamp(1.4rem, 2.2vw, 2.1rem); color: var(--interior-bone); line-height: 1.5; margin: 0 0 1.5rem 0;">
						<?php echo ( 'en' === $lang )
							? '"The precision exceeded every expectation. We had one accountable partner and zero sub-contractor discrepancies throughout."'
							: '"التنفيذ فاق كل توقعاتي؛ لم أشعر يوماً بقلق تأخير أو خلاف بين مقاولين، استلمت قصر أحلامي قبل الموعد بأسبوعين."'; ?>
					</blockquote>
					<div class="luxe-meta-latin" style="color: var(--interior-brass-light);">
						<?php echo ( 'en' === $lang )
							? 'Private Residence Owner · Riyadh (Identity Protected under NDA)'
							: 'مالك القصر · الرياض (بيانات محمية بموجب بروتوكول السرية NDA)'; ?>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- 05. خلف الكواليس والمخططات الهندسية (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink">
		<div class="luxe-container">
			<div style="max-width: 800px; margin-bottom: 4rem;">
				<span class="luxe-meta-latin" style="display: block; margin-bottom: 0.75rem;">
					<?php echo ( 'en' === $lang ) ? 'CAD Blueprints Archive · Execution Rigor' : 'أرشيف المخططات الهندسية · الصرامة التنفيذية'; ?>
				</span>
				<h2 style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.25rem;">
					<?php echo ( 'en' === $lang ) ? 'Behind the Scenes: <span class="luxe-accent-serif">Millimeter Precision</span>' : 'خلف الكواليس: <span class="luxe-accent-serif">الدقة الهندسية بالمليمتر</span>'; ?>
				</h2>
				<p style="color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.85; margin: 0;">
					<?php echo ( 'en' === $lang )
						? 'We never rely on improvisation; every marble slab, pivot hinge, and indirect light channel is engineered in 1:1 shop drawings prior to on-site installation.'
						: 'لا نعتمد على العفوية؛ كل لوح رخام، وكل مفصل خزانة، وكل مجرى إضاءة مخفي يسبقه مخطط تنفيذي تفصيلي يُعتمد هندسياً قبل بدء القص والتركيب.'; ?>
				</p>
			</div>

			<!-- Blueprint Blueprint Box -->
			<div class="luxe-blueprint-drawer">
				<div style="position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
					
					<div>
						<div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
							<span style="font-family: var(--font-mono); font-size: 11px; color: #7db0dd; letter-spacing: 0.2em; border: 1px solid rgba(80,120,160,0.5); padding: 0.2rem 0.6rem;">
								<?php echo ( 'en' === $lang ) ? 'SHOP DRAWING // SEC 08-B' : 'مخطط تنفيذي // قطاع 08-ب'; ?>
							</span>
							<span style="font-family: var(--font-mono); font-size: 11px; color: rgba(255,255,255,0.6);">
								<?php echo ( 'en' === $lang ) ? 'TOLERANCE: ±0.5mm' : 'نسبة التفاوت: ±0.5 مم'; ?>
							</span>
						</div>
						<h3 style="font-family: var(--font-heading); font-size: 1.85rem; color: #fff; margin-bottom: 1.25rem;">
							<?php echo ( 'en' === $lang ) ? 'Tectonic Symmetry & Structural Joint Detail' : 'مخطط التناظر التكتوني والربط الهيكلي'; ?>
						</h3>
						<p style="font-size: var(--text-sm); line-height: 1.8; color: #9bbbd8; margin-bottom: 1.5rem;">
							<?php echo ( 'en' === $lang )
								? 'Technical section illustrating dry mechanical stone anchors with elastomeric expansion isolation dampers.'
								: 'المقطع التنفيذي يوضح طريقة تثبيت ألواح الرخام الكبيرة بنظام التثبيت الميكانيكي الجاف مع عوازل امتصاص التمدد والاهتزازات.'; ?>
						</p>
						<div class="luxe-meta-latin" style="color: #c49a5b;">
							<?php echo ( 'en' === $lang ) ? '• 24 Inspection Hold Points • Lab Pressure Certifications' : '• 24 نقطة فحص قبل اعتماد التركيب • اختبارات ضغط معملية'; ?>
						</div>
					</div>

					<div style="border: 1px solid rgba(80,120,160,0.4); background: rgba(11,17,23,0.85); padding: 2rem;">
						<svg viewBox="0 0 400 240" fill="none" style="width: 100%; height: auto; display: block;">
							<line x1="20" y1="20" x2="380" y2="20" stroke="rgba(80,120,160,0.3)" stroke-width="0.8"/>
							<line x1="20" y1="220" x2="380" y2="220" stroke="rgba(80,120,160,0.3)" stroke-width="0.8"/>
							<line x1="20" y1="20" x2="20" y2="220" stroke="rgba(80,120,160,0.3)" stroke-width="0.8"/>
							<line x1="380" y1="20" x2="380" y2="220" stroke="rgba(80,120,160,0.3)" stroke-width="0.8"/>
							<rect x="50" y="50" width="300" height="140" stroke="#7db0dd" stroke-width="1.5" fill="none"/>
							<rect x="70" y="70" width="120" height="100" stroke="rgba(80,120,160,0.6)" stroke-width="1" stroke-dasharray="4,4"/>
							<rect x="210" y="70" width="120" height="100" stroke="rgba(80,120,160,0.6)" stroke-width="1" stroke-dasharray="4,4"/>
							<line x1="200" y1="35" x2="200" y2="205" stroke="#c49a5b" stroke-width="1"/>
							<circle cx="200" cy="120" r="12" stroke="#c49a5b" stroke-width="1" fill="none"/>
							<line x1="185" y1="120" x2="215" y2="120" stroke="#c49a5b" stroke-width="1"/>
							<text class="luxe-cad-text-axis" x="50" y="42" fill="#7db0dd" font-family="'IBM Plex Sans Arabic', monospace" font-size="9">
								<?php echo ( 'en' === $lang ) ? 'AXIS A: 14,200 mm' : 'المحور أ: 14,200 مم'; ?>
							</text>
							<text class="luxe-cad-text-bookmatch" x="210" y="42" fill="#c49a5b" font-family="'IBM Plex Sans Arabic', monospace" font-size="9">
								<?php echo ( 'en' === $lang ) ? 'BOOKMATCH AXIS' : 'محور تقابل الفراشة'; ?>
							</text>
							<text class="luxe-cad-text-wall" x="55" y="180" fill="rgba(255,255,255,0.6)" font-family="'IBM Plex Sans Arabic', monospace" font-size="8">
								<?php echo ( 'en' === $lang ) ? 'WALL SECTION — H: 7.8M' : 'تفصيلة الجدار — ارتفاع 7.8 م'; ?>
							</text>
						</svg>
					</div>

				</div>
			</div>

		</div>
	</section>

	<?php if ( $next_post ) :
		$next_id    = $next_post->ID;
		$next_title = interior_get_project_title( $next_id );
		$next_loc   = interior_get_project_location( $next_id );
		$next_area  = interior_get_project_area( $next_id );
		$next_link  = get_permalink( $next_id );
	?>
	<!-- 06. المشروع التالي: انتقال تحريري تلقائي (Next Case Study Bottom Advance) -->
	<a href="<?php echo esc_url( $next_link ); ?>" class="luxe-next-case-teaser">
		<div class="luxe-next-case-teaser__bg">
			<img src="<?php echo esc_url( $next_img ); ?>" alt="<?php echo esc_attr( $next_title ); ?>" loading="lazy" decoding="async" />
		</div>
		<div style="position: relative; z-index: 2; padding: 2rem;">
			<div class="luxe-meta-latin" style="color: var(--interior-brass-light); margin-bottom: 1rem;">
				<?php echo ( 'en' === $lang ) ? 'Next Project in Architectural Monograph' : 'المشروع التالي في الأرشيف المونوغرافي'; ?>
			</div>
			<h2 style="font-family: var(--font-heading); font-size: clamp(2.5rem, 5vw, 4.5rem); color: var(--interior-bone); line-height: 1.2; margin-bottom: 1.5rem;">
				<?php echo esc_html( $next_title ); ?> <span class="luxe-arrow-icon">←</span>
			</h2>
			<div class="luxe-meta-latin">
				<?php echo esc_html( $next_loc . ' • ' . $next_area . ' • ' . ( ( 'en' === $lang ) ? 'Explore Case Study' : 'استكشاف دراسة الحالة' ) ); ?>
			</div>
		</div>
	</a>
	<?php endif; ?>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
