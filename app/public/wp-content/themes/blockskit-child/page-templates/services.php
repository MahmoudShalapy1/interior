<?php
/**
 * Template Name: Luxury Services Page
 * Description: Section 8.2: Editorial Architectural Services Directory, Floating Preview, Scope Matrix & FAQs.
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
	<section class="luxe-hero" id="services-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_majlis_salon.jpg' ); ?>" alt="<?php echo $is_en ? 'Architectural Services Ecosystem — INTERIOR' : 'الخدمات المعمارية الشاملة — إنتيريور'; ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title" data-i18n="srv_hero_title">
					من المخطط الأول حتى <span class="luxe-accent-serif">تسليم المفتاح</span> السيادي.
				</h1>

				<p class="luxe-hero__lead" data-i18n="srv_hero_lead">
					لا نترك تفصيلة واحدة للصدفة أو لاجتهاد مقاولي الباطن. نقدم منظومة متكاملة تلغي تجزئة المقاولات وتمنح صاحب القصر شريكاً واحداً يتحمل المسؤولية الهندسية والجمالية والمالية بالكامل.
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span data-i18n="srv_hero_cta_brief">طلب دراسة معمارية خاصة</span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#services-list" class="luxe-btn--text">
						<span data-i18n="srv_hero_cta_explore">استكشف محاور المنظومة الخمسة</span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. 01–05 Massive Vertical Editorial Directory with Floating Cursor Preview (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="services-list">
		<div class="luxe-container">
			<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem; flex-wrap: wrap; gap: 2rem;">
				<div>
					<span class="luxe-meta-latin" data-i18n="srv_list_tag" style="display: block; margin-bottom: 0.75rem;">محاور المنظومة والسيطرة الشاملة</span>
					<h2 data-i18n="srv_list_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
						خمس ركائز تصنع <span class="luxe-accent-serif">العمارة الخالدة</span>
					</h2>
				</div>
				<div data-i18n="srv_list_desc" style="max-width: 440px; font-size: var(--text-sm); color: var(--interior-text-muted); line-height: 1.85;">
					مرر المؤشر فوق أي خدمة لمعاينة لقطات التنفيذ الحقيقية من مشاريعنا المنجزة.
				</div>
			</div>

			<div class="luxe-services-directory">
				<?php
				$services_query = new WP_Query( array(
					'post_type'      => 'service',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
				) );

				$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';

				if ( $services_query->have_posts() ) :
					$i = 1;
					while ( $services_query->have_posts() ) :
						$services_query->the_post();
						$s_id       = get_the_ID();
						$s_index    = get_post_meta( $s_id, '_service_index', true ) ?: sprintf( '%02d', $i );
						if ( 'en' === $lang ) {
							$s_index = str_replace(
								array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
								array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
								$s_index
							);
						}

						$srv_titles_fallback = array(
							'التصميم المعماري والدراسات الفراغية السيادية' => 'Architectural Interior Design & Spatial Engineering',
							'المقاولات التخصصية وتسليم المفتاح المتكامل' => 'Turnkey Fit-Out & General Contracting',
							'النجارة المعمارية والتصنيع الحصري للأخشاب' => 'Architectural Millwork & Bespoke Joinery',
							'انتقاء وتوريد الرخام النادر من المحاجر مباشرة' => 'Direct Quarry Marble & Natural Stone Curation',
							'سينوغرافيا الإضاءة والأتمتة الذكية المتوارية' => 'Lighting Scenography & Concealed Smart Automation',
						);
						$raw_title  = get_the_title( $s_id );
						$s_title    = ( 'en' === $lang ) ? ( get_post_meta( $s_id, '_service_title_en', true ) ?: ( isset( $srv_titles_fallback[ $raw_title ] ) ? $srv_titles_fallback[ $raw_title ] : $raw_title ) ) : $raw_title;
						$s_sub      = ( 'en' === $lang ) ? get_post_meta( $s_id, '_service_subtitle_en', true ) : get_post_meta( $s_id, '_service_subtitle_ar', true );
						$s_desc     = ( 'en' === $lang ) ? get_post_meta( $s_id, '_service_desc_en', true ) : get_the_excerpt( $s_id );
						$s_preview  = get_post_meta( $s_id, '_service_preview_image', true ) ?: ( $img_dir . 'luxe_hero_foyer.jpg' );
						?>
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-service-row" data-preview="<?php echo esc_url( $s_preview ); ?>">
							<div class="luxe-service-row__num"><?php echo esc_html( $s_index ); ?></div>
							<div>
								<h3 class="luxe-service-row__title"><?php echo esc_html( $s_title ); ?></h3>
								<?php if ( ! empty( $s_sub ) ) : ?>
									<span class="luxe-service-row__subtitle"><?php echo esc_html( $s_sub ); ?></span>
								<?php endif; ?>
							</div>
							<p class="luxe-service-row__desc">
								<?php echo esc_html( $s_desc ); ?>
							</p>
							<div class="luxe-service-row__action">
								<span class="luxe-arrow-icon">←</span>
							</div>
						</a>
						<?php
						$i++;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- 03. Scope Matrix: مصفوفة المسؤولية وتبرير القيمة (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal">
		<div class="luxe-container">
			<div style="max-width: 820px; margin-bottom: 3.5rem;">
				<span class="luxe-meta-latin" data-i18n="srv_mat_tag" style="display: block; margin-bottom: 0.75rem;">مصفوفة المسؤولية وتبرير القيمة</span>
				<h2 data-i18n="srv_mat_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.25rem;">
					لماذا يكلف عقدنا أكثر؟ <span class="luxe-accent-serif">ولماذا يوفر عليك ثروة</span>
				</h2>
				<p data-i18n="srv_mat_desc" style="color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.85; margin: 0;">
					في المقاولات المجزأة، يدفع العميل سعراً ظاهرياً أقل في البداية، ثم يخسر 30٪ إلى 50٪ إضافية بسبب أخطاء التنسيق، وهدر المواد، وتأخير التسليم لسنة كاملة. إليك الفارق الجوهري:
				</p>
			</div>

			<div class="luxe-scope-matrix">
				<div class="luxe-scope-matrix__header">
					<div class="luxe-scope-col-head" data-i18n="srv_th_item">البند المعماري والتعاقدي</div>
					<div class="luxe-scope-col-head" data-i18n="srv_th_trad">المقاولات التقليدية المجزأة</div>
					<div class="luxe-scope-col-head is-highlight" data-i18n="srv_th_int">العقد الشامل لدى إنتيريور</div>
				</div>

				<div class="luxe-scope-row">
					<div class="luxe-scope-cell is-feature">
						<span data-i18n="srv_r1_title">المسؤولية القانونية والفنية</span>
						<span class="luxe-scope-feature-desc" data-i18n="srv_r1_desc">من يحاسب عند وجود عيب أو خطأ تنفيذي؟</span>
					</div>
					<div class="luxe-scope-cell is-traditional">
						<span class="luxe-scope-mark is-cross">&#10005;</span>
						<span data-i18n="srv_r1_trad">تشتت المسؤولية؛ المصمم يلوم المنفذ، والمنفذ يلوم المورد.</span>
					</div>
					<div class="luxe-scope-cell is-interior">
						<span class="luxe-scope-mark is-check">&#10003;</span>
						<span data-i18n="srv_r1_int">مسؤولية أحادية كاملة؛ إنتيريور مسؤول قانونياً وفنياً عن كل مليمتر.</span>
					</div>
				</div>

				<div class="luxe-scope-row">
					<div class="luxe-scope-cell is-feature">
						<span data-i18n="srv_r2_title">ضبط التكلفة والميزانية</span>
						<span class="luxe-scope-feature-desc" data-i18n="srv_r2_desc">هل تتغير التكلفة أثناء سير العمل؟</span>
					</div>
					<div class="luxe-scope-cell is-traditional">
						<span class="luxe-scope-mark is-cross">&#10005;</span>
						<span data-i18n="srv_r2_trad">أوامر تغيير مستمرة ترفع التكلفة الأصلية بنسبة 35٪ إلى 60٪.</span>
					</div>
					<div class="luxe-scope-cell is-interior">
						<span class="luxe-scope-mark is-check">&#10003;</span>
						<span data-i18n="srv_r2_int">عقد ثابت ملزم بعد دراسة المخططات؛ لا مفاجآت مالية على المالك.</span>
					</div>
				</div>

				<div class="luxe-scope-row">
					<div class="luxe-scope-cell is-feature">
						<span data-i18n="srv_r3_title">سلاسل توريد الرخام والخامات</span>
						<span class="luxe-scope-feature-desc" data-i18n="srv_r3_desc">مصدر المواد وطريقة فحصها</span>
					</div>
					<div class="luxe-scope-cell is-traditional">
						<span class="luxe-scope-mark is-cross">&#10005;</span>
						<span data-i18n="srv_r3_trad">شراء من مستودعات محلية غير متجانسة بأسعار وسطاء مضاعفة.</span>
					</div>
					<div class="luxe-scope-cell is-interior">
						<span class="luxe-scope-mark is-check">&#10003;</span>
						<span data-i18n="srv_r3_int">استيراد مباشر من المقالع بإيطاليا مع اختيار ومطابقة كتل الرخام شخصياً.</span>
					</div>
				</div>

				<div class="luxe-scope-row">
					<div class="luxe-scope-cell is-feature">
						<span data-i18n="srv_r4_title">الوجود الهندسي في الموقع</span>
						<span class="luxe-scope-feature-desc" data-i18n="srv_r4_desc">كفاءة الرقابة وتكرار الزيارات</span>
					</div>
					<div class="luxe-scope-cell is-traditional">
						<span class="luxe-scope-mark is-cross">&#10005;</span>
						<span data-i18n="srv_r4_trad">زيارة سريعة أسبوعية للمهندس، وعمالة غير مدربة تنفذ باجتهادها.</span>
					</div>
					<div class="luxe-scope-cell is-interior">
						<span class="luxe-scope-mark is-check">&#10003;</span>
						<span data-i18n="srv_r4_int">مهندس استشاري مقيم بالموقع يومياً للإشراف على 34 نقطة جودة.</span>
					</div>
				</div>

				<div class="luxe-scope-row">
					<div class="luxe-scope-cell is-feature">
						<span data-i18n="srv_r5_title">التسليم والضمان النهائي</span>
						<span class="luxe-scope-feature-desc" data-i18n="srv_r5_desc">خدمة ما بعد السكن</span>
					</div>
					<div class="luxe-scope-cell is-traditional">
						<span class="luxe-scope-mark is-cross">&#10005;</span>
						<span data-i18n="srv_r5_trad">تنتهي العلاقة فور التسليم، وصعوبة التواصل للصيانة لاحقاً.</span>
					</div>
					<div class="luxe-scope-cell is-interior">
						<span class="luxe-scope-mark is-check">&#10003;</span>
						<span data-i18n="srv_r5_int">ضمان هيكلي وإنشائي شامل لمدة 10 سنوات، وخدمة دعم خاصة دورية.</span>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- 04. Interactive FAQ Accordion: أسئلة شائعة حول الاستثمار (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink">
		<div class="luxe-container">
			<div style="max-width: 820px; margin-inline: auto;">
				<div style="text-align: center; margin-bottom: 4rem;">
					<span class="luxe-meta-latin" data-i18n="srv_faq_tag" style="display: block; margin-bottom: 0.75rem;">الشفافية الهندسية والمعمارية</span>
					<h2 data-i18n="srv_faq_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
						إجابات مباشرة على <span class="luxe-accent-serif">تساؤلات الاستثمار</span>
					</h2>
				</div>

				<div class="luxe-faq-accordion">
					
					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="srv_q1_title">هل يمكنني التعاقد معكم على مرحلة التصميم فقط دون التنفيذ؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="srv_q1_ans">
								نعم، عبر فئة "الرؤية المعمارية والتصميم المخصص". نقدم في هذه الفئة دراسة متكاملة ومخططات تنفيذية تفصيلية وجداول كميات معتمدة. ومع ذلك، نوصي دائماً بإسناد الإشراف أو تسليم المفتاح الكامل للاستوديو؛ لأن 90٪ من جمالية التصميم تعتمد على دقة المطابقة الحرفية أثناء البناء.
							</p>
						</div>
					</div>

					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="srv_q2_title">كيف تضمنون عدم زيادة التكلفة بعد توقيع العقد؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="srv_q2_ans">
								نبدأ بدراسة هندسية مستفيضة تستغرق من 4 إلى 8 أسابيع لفحص المخططات، والتربة، وتفاصيل الكهروميكانيك، وسلاسل التوريد. بناءً على هذه الدراسة، نقدم عقداً بمبلغ مقطوع ومحدد متضمناً كافة المواصفات بدقة متناهية، ونلتزم بتسليم القصر دون أي مطالبة إضافية ما لم يطلب المالك بنفسه تعديلاً جوهرياً في نطاق العمل.
							</p>
						</div>
					</div>

					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="srv_q3_title">ما هي المدة الزمنية المعتادة لتسليم قصر أو فيلا متكاملة؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="srv_q3_ans">
								تتراوح المدة التنفيذية عادة بين 12 إلى 18 شهراً للفلل الكبرى، وبين 18 إلى 24 شهراً للقصور الملكية الشاملة للاندسكيب والمسطحات المائية. نضع جدولاً زمنياً دقيقاً بنظام المسار الحرج ونلتزم بمواعيد التسليم تعاقدياً مع غرامات تأخير ملزمة لنا في حال حدوث أي تقصير غير مبرر.
							</p>
						</div>
					</div>

					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="srv_q4_title">هل تشمل خدماتكم استيراد المواد النادرة من الخارج مباشرة؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="srv_q4_ans">
								نعم، هذا أحد أهم مزايانا التنافسية. لدينا قنوات استيراد مباشرة مع كبرى مقالع الرخام الإيطالي في إيطاليا، ومصانع الأخشاب ومعدات الإضاءة الأوروبية. يقوم خبراؤنا بالسفر وفحص المواد وتصويرها للمالك قبل الشحن، مما يوفر تكلفة الوسطاء ويضمن أعلى درجات النقاء للمواد النبيلة.
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- 05. Call to Action Strip (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal" style="text-align: center; padding-block: clamp(6rem, 10vw, 10rem);">
		<div class="luxe-container">
			<span class="luxe-meta-latin" data-i18n="srv_cta_tag" style="display: block; margin-bottom: 0.75rem;">الخطوة القادمة · بدء التكليف</span>
			<h2 data-i18n="srv_cta_title" style="font-family: var(--font-heading); font-size: var(--text-4xl); margin-bottom: 1.5rem; color: var(--interior-bone);">
				هل ترغب في دراسة <span class="luxe-accent-serif">مشروعك الخاص</span>؟
			</h2>
			<p data-i18n="srv_cta_desc" style="max-width: 680px; margin: 0 auto 3.5rem; color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.9;">
				نستقبل عدداً محدوداً من المشاريع سنوياً لضمان أعلى درجات الإشراف والسيادة الحرفية. تواصل معنا للبدء في دراسة ملفك.
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
				<span data-i18n="srv_cta_btn">حجز جلسة استشارية معمارية</span>
				<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
			</a>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
