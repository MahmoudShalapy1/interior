<?php
/**
 * Template Name: Luxury About Page
 * Description: Section 8.1: Architectural Studio Monograph, Founding Heritage, Principles & Leadership.
 * Derived from and aligned with the Front Page aesthetic rhythm.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/header-luxury' );
$img_dir = get_stylesheet_directory_uri() . '/assets/images/';
$is_en   = ( 'en' === ( function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar' ) );
?>

<main class="luxe-main" id="main-content" tabindex="-1" role="main">

	<!-- 01. Architectural Page Hero (Fullscreen 100vh, Vertically Centered) -->
	<section class="luxe-hero" id="about-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_palace_courtyard.jpg' ); ?>" alt="<?php echo $is_en ? 'Legacy of Architectural Mastery — INTERIOR' : 'إرث الإتقان — استوديو إنتيريور'; ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title" data-i18n="about_hero_title">
					إرث من <span class="luxe-accent-serif">الصنعة المعمارية</span> والسيادة المكانية.
				</h1>

				<?php
				$about_lead = interior_get_studio_option(
					'interior_about_lead_ar',
					'interior_about_lead_en',
					'لسنا مجرد مرسم تصميم أو شركة مقاولات ديكور؛ نحن استوديو معماري وتنفيذي متكامل يُؤتمن على صياغة القصور والمساكن الخاصة الاستثنائية من الخط الأول على الورق حتى تسليم المفتاح النهائي.'
				);
				?>
				<p class="luxe-hero__lead" data-i18n="about_hero_lead">
					<?php echo esc_html( $about_lead ); ?>
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span data-i18n="about_hero_cta_brief">طلب دراسة معمارية خاصة</span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#founding-story" class="luxe-btn--text">
						<span data-i18n="about_hero_cta_story">قصة التأسيس وفلسفة الاستوديو</span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. Founding Narrative: قصة التأسيس وتكامل الطبقات (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="founding-story">
		<div class="luxe-container">
			<div style="display: grid; grid-template-columns: 1.1fr 1fr; gap: clamp(3rem, 6vw, 7rem); align-items: center;">
				
				<div style="position: relative;">
					<div style="border: 1px solid var(--interior-hairline); padding: 1.25rem; background: var(--interior-charcoal);">
						<img src="<?php echo esc_url( $img_dir . 'luxe_marble_curation.jpg' ); ?>" alt="<?php echo $is_en ? 'Genesis of Sovereign Architecture — Rare Marble Curation' : 'سردية التأسيس المعماري — انتقاء الرخام النادر'; ?>" style="width: 100%; height: clamp(420px, 50vw, 620px); object-fit: cover; display: block;" loading="lazy" decoding="async" />
					</div>
					<div style="position: absolute; bottom: -1.75rem; right: -1.75rem; background: var(--interior-ink); border: 1px solid var(--interior-brass); padding: 1.5rem 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
						<span data-i18n="about_badge_years" style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--interior-brass-light);">خمسة عشر عاماً من الصرامة</span>
						<div class="luxe-meta-latin" data-i18n="about_badge_estates" style="font-size: 10px; margin-top: 0.25rem;"><?php echo esc_html( interior_get_studio_option( 'interior_stat_palaces', 'interior_stat_palaces_en', '+140' ) ); ?> قصراً وصرحاً منجزاً</div>
					</div>
				</div>

				<div>
					<span class="luxe-meta-latin" data-i18n="about_genesis_tag" style="display: block; margin-bottom: 0.75rem;">قصة التأسيس والسيادة المعمارية</span>
					<h2 data-i18n="about_genesis_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.5rem;">
						تأسس الاستوديو لإنهاء <span class="luxe-accent-serif">تشتت المقاولات</span> في المشاريع الكبرى
					</h2>
					<p data-i18n="about_genesis_p1" style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted); margin-bottom: 1.75rem;">
						لاحظنا على مدار عقد كامل أن المشكلة الجوهرية التي تواجه أصحاب القصور في العالم العربي ليست نقص المصممين، بل الفجوة القاتلة بين المخطط الجميل والتنفيذ الواقعي؛ حيث يتنازع المقاولون الفرعيون، وتضيع المسؤولية، ويتحمل المالك وحده تكلفة الأخطاء والتأخير.
					</p>
					<div data-i18n="about_genesis_quote" style="font-family: var(--font-heading); font-size: 1.45rem; color: var(--interior-brass-light); border-inline-start: 2px solid var(--interior-brass); padding-inline-start: 1.75rem; margin: 2.5rem 0; line-height: 1.6; font-style: italic;">
						"إننا لا نبيع استشارات هندسية مجردة، بل نتحمل المسؤولية السيادية والضمان الحرفي الكامل لكل تفصيلة تسكنها."
					</div>
					<p data-i18n="about_genesis_p2" style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted);">
						من هذا المبدأ، بنينا استوديو يجمع تحت مظلة واحدة: كبار معماريي التخطيط، ومهندسي الإنشاء، وخبراء الرخام الإيطالي، وأساتذة النجارة الدقيقة، ليعيش العميل تجربة واحدة سلسة خالية من المفاجآت.
					</p>
				</div>

			</div>
		</div>
	</section>

	<!-- 03. The Triad of Principles: المبادئ الثلاثة الحاكمة (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal">
		<div class="luxe-container">
			<div style="max-width: 800px; margin-bottom: 5rem;">
				<span class="luxe-meta-latin" data-i18n="about_const_tag" style="display: block; margin-bottom: 0.75rem;">دستور الممارسة المعمارية</span>
				<h2 data-i18n="about_const_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.25rem;">
					ثلاثة مبادئ تحكم كل مليمتر <span class="luxe-accent-serif">نخطه ونبنيه</span>
				</h2>
				<p data-i18n="about_const_desc" style="color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.85; margin: 0;">
					معايير ثابتة لا تقبل التفاوض، تفسر لماذا نرفض المشاريع التجارية السريعة ونركز حصراً على القصور الخاصة الاستثنائية.
				</p>
			</div>

			<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: clamp(2rem, 3vw, 4rem); border-top: 1px solid var(--interior-hairline); padding-top: 4rem;">
				
				<!-- Principle 1: Singular Sovereign Responsibility -->
				<div>
					<span class="luxe-meta-latin" data-i18n="about_pr1_num" style="color: var(--interior-brass); display: block; margin-bottom: 1rem;">01 // السيطرة والمحاسبية الكاملة</span>
					<h3 data-i18n="about_pr1_title" style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--interior-bone); margin-bottom: 1rem; line-height: 1.35;">
						عقد واحد، مسؤولية واحدة، ولا مقاولين متفرقين
					</h3>
					<p data-i18n="about_pr1_desc" style="font-size: var(--text-sm); line-height: 1.85; color: var(--interior-text-muted); margin: 0;">
						نتحمل المسؤولية القانونية والهندسية من المخطط الأولي حتى تسليم المفتاح. لا مجال لإلقاء اللوم بين المصمم والمقاول؛ نحن مسؤولون عن النتيجة النهائية بالكامل.
					</p>
				</div>

				<!-- Principle 2: Empirical Proof Over Promises -->
				<div>
					<span class="luxe-meta-latin" data-i18n="about_pr2_num" style="color: var(--interior-brass); display: block; margin-bottom: 1rem;">02 // الإثبات المادي والصرامة الهندسية</span>
					<h3 data-i18n="about_pr2_title" style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--interior-bone); margin-bottom: 1rem; line-height: 1.35;">
						مخططات تنفيذية، وفحص موقعي، وشهادات منشأ موثقة
					</h3>
					<p data-i18n="about_pr2_desc" style="font-size: var(--text-sm); line-height: 1.85; color: var(--interior-text-muted); margin: 0;">
						لا نعتمد على الوعود الشفهية. كل قطعة رخام لها شهادة منشأ من محاجرها، وكل نظام إنشائي يوثق بمخططات الواقع المنفذ وتقارير فحص دورية تسلم للمالك.
					</p>
				</div>

				<!-- Principle 3: Absolute Discretion -->
				<div>
					<span class="luxe-meta-latin" data-i18n="about_pr3_num" style="color: var(--interior-brass); display: block; margin-bottom: 1rem;">03 // الخصوصية والسيادة المطلقة</span>
					<h3 data-i18n="about_pr3_title" style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--interior-bone); margin-bottom: 1rem; line-height: 1.35;">
						مشاريع تحت اتفاقيات سرية تامة، وأرشيف محفوظ بعناية
					</h3>
					<p data-i18n="about_pr3_desc" style="font-size: var(--text-sm); line-height: 1.85; color: var(--interior-text-muted); margin: 0;">
						اتفاقيات سرية صارمة تحمي هوية الملاك ومخططات قصورهم. تفاصيل أثاثك ورسوماتك المعمارية ملكية حصرية لك، ولا يُعاد استخدامها في أي قصر آخر على الإطلاق.
					</p>
				</div>

			</div>
		</div>
	</section>

	<!-- 04. Studio Leadership: فريق القيادة المعمارية والشركاء (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="leadership">
		<div class="luxe-container">
			<div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 2rem; margin-bottom: 5rem;">
				<div>
					<span class="luxe-meta-latin" data-i18n="about_team_tag" style="display: block; margin-bottom: 0.75rem;">القيادة المعمارية والشركاء</span>
					<h2 data-i18n="about_team_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
						عقول هندسية <span class="luxe-accent-serif">وحرفية عالمية</span>
					</h2>
				</div>
				<div data-i18n="about_team_desc" style="max-width: 440px; font-size: var(--text-sm); color: var(--interior-text-muted); line-height: 1.85;">
					فريق قيادي يجمع بين خريجي كبرى جامعات العمارة العالمية وخبرات تنفيذية راكمت عقوداً في أعتى قصور المنطقة.
				</div>
			</div>

			<div class="luxe-team-grid">
				<?php
				$team_query = new WP_Query( array(
					'post_type'      => 'team',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
				) );

				if ( $team_query->have_posts() ) :
					$t_idx = 1;
					while ( $team_query->have_posts() ) :
						$team_query->the_post();
						$t_id         = get_the_ID();
						$t_name       = interior_get_team_name( $t_id );
						$t_role       = interior_get_team_role( $t_id );
						$t_tag        = interior_get_team_tag( $t_id );
						$t_cred       = interior_get_team_cred( $t_id );
						$t_bio        = interior_get_team_bio( $t_id );
						$t_photo      = interior_get_team_photo( $t_id );
						$is_principal = interior_get_team_is_principal( $t_id );
						$card_class   = $is_principal ? 'luxe-team-card is-principal' : 'luxe-team-card';
						?>
						<div class="<?php echo esc_attr( $card_class ); ?>">
							<div class="luxe-team-photo-wrap">
								<?php if ( ! empty( $t_tag ) ) : ?>
									<span class="luxe-team-partner-tag" data-i18n="about_t<?php echo $t_idx; ?>_tag"><?php echo esc_html( $t_tag ); ?></span>
								<?php endif; ?>
								<img src="<?php echo esc_url( $t_photo ); ?>" alt="<?php echo esc_attr( $t_name . ' — ' . $t_role ); ?>" class="luxe-team-photo" loading="lazy" decoding="async" />
							</div>
							<div class="luxe-team-meta">
								<span class="luxe-team-role" data-i18n="about_t<?php echo $t_idx; ?>_role"><?php echo esc_html( $t_role ); ?></span>
								<h3 class="luxe-team-name" data-i18n="about_t<?php echo $t_idx; ?>_name"><?php echo esc_html( $t_name ); ?></h3>
								<?php if ( ! empty( $t_cred ) ) : ?>
									<span class="luxe-team-credentials" data-i18n="about_t<?php echo $t_idx; ?>_cred"><?php echo esc_html( $t_cred ); ?></span>
								<?php endif; ?>
								<p class="luxe-team-bio" data-i18n="about_t<?php echo $t_idx; ?>_bio">
									<?php echo esc_html( $t_bio ); ?>
								</p>
							</div>
						</div>
						<?php
						$t_idx++;
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<!-- Default Fallback Leader 1 -->
					<div class="luxe-team-card is-principal">
						<div class="luxe-team-photo-wrap">
							<span class="luxe-team-partner-tag" data-i18n="about_t1_tag">الشريك المؤسس</span>
							<img src="<?php echo esc_url( $img_dir . 'luxe_team_khaled_alfaisal.jpg' ); ?>" alt="م. خالد الفيصل" class="luxe-team-photo" loading="lazy" decoding="async" />
						</div>
						<div class="luxe-team-meta">
							<span class="luxe-team-role" data-i18n="about_t1_role">الشريك المؤسس &bull; كبير المعماريين</span>
							<h3 class="luxe-team-name" data-i18n="about_t1_name">م. خالد الفيصل</h3>
							<span class="luxe-team-credentials" data-i18n="about_t1_cred">ماجستير العمارة من جامعة هارفارد</span>
							<p class="luxe-team-bio" data-i18n="about_t1_bio">قاد تخطيط وتنفيذ أكثر من 60 قصراً رئاسياً وخاصاً في الرياض والخليج على مدار 18 عاماً.</p>
						</div>
					</div>
					<?php
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- 05. Slow Marquee: تحالفات التوريد والمصانع العالمية -->
	<section class="luxe-marquee-section">
		<div style="text-align: center; margin-bottom: 2.5rem;">
			<span class="luxe-meta-latin" data-i18n="about_guilds_tag">دور الصناعة الأوروبية المعتمدة والتوريد الحصري</span>
		</div>
		<div class="luxe-marquee">
			<div class="luxe-marquee__track">
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g1_name">محاجر رخام كرارا</span>
					<span class="luxe-marquee__origin" data-i18n="g1_loc">توسكانا، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g2_name">أنظمة شوكو المعمارية</span>
					<span class="luxe-marquee__origin" data-i18n="g2_loc">بيليفيلد، ألمانيا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g3_name">أنظمة بولثاوب الفاخرة</span>
					<span class="luxe-marquee__origin" data-i18n="g3_loc">آيخ، ألمانيا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g4_name">أحجار سالفاتوري الطبيعية</span>
					<span class="luxe-marquee__origin" data-i18n="g4_loc">كويرشيتا، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g5_name">أنظمة بوليفورم المخصصة</span>
					<span class="luxe-marquee__origin" data-i18n="g5_loc">إنفيريجو، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g6_name">إضاءة فلوس المعمارية</span>
					<span class="luxe-marquee__origin" data-i18n="g6_loc">بوفيتزو، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g7_name">أخشاب ليستون جوردانو</span>
					<span class="luxe-marquee__origin" data-i18n="g7_loc">بيروجيا، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
				<div class="luxe-marquee__item">
					<span class="luxe-marquee__name" data-i18n="g8_name">زجاج ريماديسيو الإيطالي</span>
					<span class="luxe-marquee__origin" data-i18n="g8_loc">جيوسانو، إيطاليا</span>
					<span class="luxe-marquee__dot"></span>
				</div>
			</div>
		</div>
	</section>

	<!-- 06. Honors & Awards: الجوائز والتكريمات المعمارية (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal">
		<div class="luxe-container">
			<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: clamp(3rem, 6vw, 6rem);">
				<div>
					<span class="luxe-meta-latin" data-i18n="about_awards_tag" style="display: block; margin-bottom: 0.75rem;">الاعتراف المعماري والجوائز الموثقة</span>
					<h2 data-i18n="about_awards_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
						تكريمات توثق <span class="luxe-accent-serif">النزاهة الحرفية</span>
					</h2>
					<p data-i18n="about_awards_desc" style="color: var(--interior-text-muted); font-size: var(--text-base); margin-top: 1.25rem; line-height: 1.85;">
						الجوائز بالنسبة لنا ليست للتفاخر، بل شهادة مستقلة تثبت أن المعايير التي نطبقها في الرياض تواكب أرقى معايير العمارة العالمية.
					</p>
				</div>

				<div style="display: flex; flex-direction: column; border-top: 1px solid var(--interior-hairline);">
					
					<div style="display: flex; justify-content: space-between; align-items: baseline; padding: 2rem 0; border-bottom: 1px solid var(--interior-hairline);">
						<div>
							<h3 data-i18n="about_aw1_title" style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--interior-bone); margin-bottom: 0.25rem;">جائزة فرساي الدولية للتميز المعماري</h3>
							<p data-i18n="about_aw1_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted);">تكريم التميز في دمج التراث المعماري مع التصميم الفندقي الفاخر &bull; باريس</p>
						</div>
						<span data-i18n="about_aw1_year" style="font-family: var(--font-mono); font-size: 12px; color: var(--interior-brass);">2024</span>
					</div>

					<div style="display: flex; justify-content: space-between; align-items: baseline; padding: 2rem 0; border-bottom: 1px solid var(--interior-hairline);">
						<div>
							<h3 data-i18n="about_aw2_title" style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--interior-bone); margin-bottom: 0.25rem;">جوائز العقارات الدولية — أفضل إقامة سكنية خاصة</h3>
							<p data-i18n="about_aw2_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted);">جائزة أفضل قصر سكني خاص في منطقة الشرق الأوسط &bull; لندن</p>
						</div>
						<span data-i18n="about_aw2_year" style="font-family: var(--font-mono); font-size: 12px; color: var(--interior-brass);">2023</span>
					</div>

					<div style="display: flex; justify-content: space-between; align-items: baseline; padding: 2rem 0; border-bottom: 1px solid var(--interior-hairline);">
						<div>
							<h3 data-i18n="about_aw3_title" style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--interior-bone); margin-bottom: 0.25rem;">الهيئة السعودية للمهندسين — وسام الإتقان التنفيذي</h3>
							<p data-i18n="about_aw3_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted);">درع التميز في الدقة الإنشائية ومطابقة الكود السعودي للمقاولات الفاخرة &bull; الرياض</p>
						</div>
						<span data-i18n="about_aw3_year" style="font-family: var(--font-mono); font-size: 12px; color: var(--interior-brass);">2022</span>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- 07. Call to Action Strip (Derived from Front Page CTA Language) -->
	<section class="luxe-section luxe-section--ink" style="text-align: center; padding-block: clamp(6rem, 10vw, 10rem);">
		<div class="luxe-container">
			<span class="luxe-meta-latin" data-i18n="about_cta_tag" style="display: block; margin-bottom: 0.75rem;">مكتب الاستكشاف والتكليف الخاص</span>
			<h2 data-i18n="about_cta_title" style="font-family: var(--font-heading); font-size: var(--text-4xl); margin-bottom: 1.5rem; color: var(--interior-bone);">
				دعنا نصيغ <span class="luxe-accent-serif">قصرك القادم</span> بمعايير السيادة
			</h2>
			<p data-i18n="about_cta_desc" style="max-width: 680px; margin: 0 auto 3.5rem; color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.9;">
				نلتقي بأصحاب المشاريع الجادة في استوديونا الخاص بالرياض، أو عبر جلسة استشارية مرئية مغلقة مع الشريك المؤسس.
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
				<span data-i18n="about_cta_btn">تقديم الملف المعماري الخاص</span>
				<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
			</a>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
