<?php
/**
 * Template Name: Luxury Contact Page
 * Description: Section 8.6 — Wow #4: Private Brief Multi-Step Interactive Funnel & Studio Desk HQ.
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
	<section class="luxe-hero" id="contact-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_sky_penthouse.jpg' ); ?>" alt="<?php echo $is_en ? 'Confidential Architectural Consultation & Private Dossier — INTERIOR' : 'استشارة معمارية خاصة — إنتيريور'; ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title" data-i18n="cnt_hero_title">
					الملف الخاص <span class="luxe-accent-serif">وبروتوكول الاعتماد</span> المعماري.
				</h1>

				<p class="luxe-hero__lead" data-i18n="cnt_hero_lead">
					تجربة تأهيل معمارية تفاعلية مخصصة لأصحاب القصور والمشاريع السكنية الكبرى. نلتزم بأعلى درجات السرية والخصوصية التامة في كافة مراحل دراسة مشروعك.
				</p>

				<div class="luxe-hero__actions">
					<a href="#brief-funnel" class="luxe-btn luxe-btn--solid">
						<span data-i18n="cnt_hero_cta_brief">البدء في تعبئة الملف الخاص</span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#studio-desk" class="luxe-btn--text">
						<span data-i18n="cnt_hero_cta_desk">بيانات مقر الاستوديو المباشرة</span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. The Private Brief Funnel & Studio Desk HQ Grid (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="brief-funnel">
		<div class="luxe-container">
			<div style="display: grid; grid-template-columns: 1.35fr 1fr; gap: clamp(3rem, 6vw, 6.5rem); align-items: start;">
				
				<!-- Column A: Multi-Step Interactive Funnel (Wow #4) -->
				<div>
					<div class="luxe-wizard-container">
						
						<!-- Wizard Progress Header -->
						<div class="luxe-wizard-header">
							<div class="luxe-wizard-step-indicator" data-i18n="wiz_step_indicator">الخطوة 1 من 6</div>
							<div class="luxe-wizard-latin-title" data-i18n="wiz_title">ملف التأهيل والاعتماد المعماري</div>
						</div>

						<!-- Progress Bar -->
						<div class="luxe-wizard-progress-bar">
							<div class="luxe-wizard-progress-fill"></div>
						</div>

						<form id="luxe-private-brief-form" onsubmit="return false;">
							
							<!-- Step 1: Typology Cards -->
							<div class="luxe-wizard-step is-active" data-step="1">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q1_title">ما نوع المنشأة المعمارية المستهدفة؟</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q1_sub">اختر التصنيف الأنسب لنطاق مشروعك للبدء في معايرة المتطلبات الهندسية.</p>

								<div class="luxe-wizard-cards-grid">
									
									<div class="luxe-wizard-card" data-typology="قصر ملكي">
										<div class="luxe-wizard-card__check">&#10003;</div>
										<div class="luxe-wizard-card__img-wrap">
											<img src="<?php echo esc_url( $img_dir . 'luxe_hero_foyer.jpg' ); ?>" alt="<?php echo $is_en ? 'Royal Palace Estate' : 'قصر ملكي'; ?>" loading="lazy" decoding="async" />
										</div>
										<div class="luxe-wizard-card__label">
											<h3 class="luxe-wizard-card__title" data-i18n="wiz_c1_title">قصر ملكي</h3>
											<span class="luxe-wizard-card__sub" data-i18n="wiz_c1_sub">صرح سكني مستقل</span>
										</div>
									</div>

									<div class="luxe-wizard-card" data-typology="فيلا معمارية">
										<div class="luxe-wizard-card__check">&#10003;</div>
										<div class="luxe-wizard-card__img-wrap">
											<img src="<?php echo esc_url( $img_dir . 'luxe_palace_courtyard.jpg' ); ?>" alt="<?php echo $is_en ? 'Architectural Private Villa' : 'فيلا معمارية'; ?>" loading="lazy" decoding="async" />
										</div>
										<div class="luxe-wizard-card__label">
											<h3 class="luxe-wizard-card__title" data-i18n="wiz_c2_title">فيلا معمارية</h3>
											<span class="luxe-wizard-card__sub" data-i18n="wiz_c2_sub">فيلا خاصة فاخرة</span>
										</div>
									</div>

									<div class="luxe-wizard-card" data-typology="سكاي بنتهاوس">
										<div class="luxe-wizard-card__check">&#10003;</div>
										<div class="luxe-wizard-card__img-wrap">
											<img src="<?php echo esc_url( $img_dir . 'luxe_sky_penthouse.jpg' ); ?>" alt="<?php echo $is_en ? 'Sky Penthouse Residence' : 'سكاي بنتهاوس'; ?>" loading="lazy" decoding="async" />
										</div>
										<div class="luxe-wizard-card__label">
											<h3 class="luxe-wizard-card__title" data-i18n="wiz_c3_title">سكاي بنتهاوس</h3>
											<span class="luxe-wizard-card__sub" data-i18n="wiz_c3_sub">إقامة علوية بانورامية</span>
										</div>
									</div>

									<div class="luxe-wizard-card" data-typology="بافيليون ضيافة">
										<div class="luxe-wizard-card__check">&#10003;</div>
										<div class="luxe-wizard-card__img-wrap">
											<img src="<?php echo esc_url( $img_dir . 'luxe_dining_pavilion.jpg' ); ?>" alt="<?php echo $is_en ? 'Hospitality & Banquet Pavilion' : 'بافيليون ضيافة'; ?>" loading="lazy" decoding="async" />
										</div>
										<div class="luxe-wizard-card__label">
											<h3 class="luxe-wizard-card__title" data-i18n="wiz_c4_title">بافيليون ضيافة</h3>
											<span class="luxe-wizard-card__sub" data-i18n="wiz_c4_sub">مجلس وجاهة وضيافة</span>
										</div>
									</div>
								</div>
							</div>

							<!-- Step 2: Location -->
							<div class="luxe-wizard-step" data-step="2">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q2_title">أين يقع المشروع جغرافياً؟</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q2_sub">حدد المدينة أو الحي المعتمد لبدء دراسة التضاريس والاشتراطات البلدية.</p>

								<div style="margin-bottom: 1.5rem;">
									<input type="text" id="luxe-wizard-location" class="luxe-funnel-input" aria-label="<?php echo $is_en ? 'Project Geographic Location' : 'موقع المشروع الجغرافي'; ?>" placeholder="اكتب المدينة أو الحي (مثال: الرياض، حي حطين)" data-i18n-placeholder="wiz_loc_ph" style="font-size: 1.1rem; padding: 1.25rem 1.5rem;" />
								</div>

								<div class="luxe-meta-latin" data-i18n="wiz_q2_options_tag" style="margin-bottom: 0.5rem;">اختيارات جغرافية شائعة</div>
								<div class="luxe-city-pills">
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_1">الرياض (حطين / الخزامى)</button>
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_2">الرياض (النرجس / الياسمين)</button>
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_3">الدرعية التاريخية</button>
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_4">جدة (أبحر / الشاطئ)</button>
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_5">المنطقة الشرقية (الخبر)</button>
									<button type="button" class="luxe-city-pill" data-i18n="wiz_cp_6">دبي / الدوحة</button>
								</div>
							</div>

							<!-- Step 3: Area Range Slider -->
							<div class="luxe-wizard-step" data-step="3">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q3_title">ما هي المساحة الإجمالية التقديرية؟</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q3_sub">حرك المنزلق لتحديد مساحة البناء الإجمالية بالمتر المربع (مسطحات مبنية).</p>

								<div class="luxe-slider-wrap">
									<div class="luxe-slider-val" id="luxe-wizard-area-val" data-i18n="wiz_area_val">3,500 م²</div>
									<input type="range" id="luxe-wizard-area-range" class="luxe-range-slider" aria-label="<?php echo $is_en ? 'Estimated Built-Up Area in Square Meters' : 'المساحة الإجمالية التقديرية بالمتر المربع'; ?>" min="500" max="10000" step="250" value="3500" />
									<div class="luxe-slider-limits">
										<span data-i18n="wiz_scale_min">500 م²</span>
										<span data-i18n="wiz_scale_mid">5,000 م²</span>
										<span data-i18n="wiz_scale_max">+10,000 م²</span>
									</div>
								</div>
							</div>

							<!-- Step 4: Scope of Services -->
							<div class="luxe-wizard-step" data-step="4">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q4_title">ما نطاق التكليف المعماري المطلوب؟</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q4_sub">يمكنك اختيار أكثر من بند لتحديد حجم التدخل الهندسي والتنفيذي.</p>

								<div class="luxe-scope-grid">
									
									<div class="luxe-scope-item is-selected" data-scope="تصميم معماري وتخطيط 3D">
										<div class="luxe-scope-checkbox">&#10003;</div>
										<div>
											<h3 data-i18n="wiz_sc1_title" style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--interior-bone); margin-bottom: 0.25rem;">التصميم المعماري والدراسات ثلاثية الأبعاد</h3>
											<p data-i18n="wiz_sc1_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">مخططات كهروميكانيكية وفراغية ومحاكاة واقعية.</p>
										</div>
									</div>

									<div class="luxe-scope-item is-selected" data-scope="مقاولات تسليم مفتاح كامل">
										<div class="luxe-scope-checkbox">&#10003;</div>
										<div>
											<h3 data-i18n="wiz_sc2_title" style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--interior-bone); margin-bottom: 0.25rem;">المقاولات الفائقة وتسليم المفتاح</h3>
											<p data-i18n="wiz_sc2_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">تنفيذ شامل مع توريد الرخام وضمان 10 سنوات.</p>
										</div>
									</div>

									<div class="luxe-scope-item" data-scope="تأثيث ونجارة مخصصة">
										<div class="luxe-scope-checkbox">&#10003;</div>
										<div>
											<h3 data-i18n="wiz_sc3_title" style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--interior-bone); margin-bottom: 0.25rem;">النجارة المعمارية والأثاث الحصري</h3>
											<p data-i18n="wiz_sc3_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">تفصيل غرف الملابس، المطابخ، والأبواب الشاهقة.</p>
										</div>
									</div>

									<div class="luxe-scope-item" data-scope="لاندسكيب ومسطحات مائية">
										<div class="luxe-scope-checkbox">&#10003;</div>
										<div>
											<h3 data-i18n="wiz_sc4_title" style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--interior-bone); margin-bottom: 0.25rem;">هندسة اللاندسكيب والمسطحات المائية</h3>
											<p data-i18n="wiz_sc4_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">حدائق معزولة صوتياً ومجالس خارجية متناغمة.</p>
										</div>
									</div>

								</div>
							</div>

							<!-- Step 5: Investment Tiers -->
							<div class="luxe-wizard-step" data-step="5">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q5_title">ما هي الشريحة الاستثمارية المتوقعة؟</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q5_sub">تحديد الميزانية التقديرية يتيح لنا تخصيص فريق العمل المناسب وتحديد مصادر المواد النبيلة.</p>

								<div class="luxe-investment-grid">
									
									<div class="luxe-investment-card" data-investment="3M — 5M SAR">
										<div class="luxe-investment-range" data-i18n="wiz_inv1_rng">3 — 5 ملايين ريال</div>
										<p class="luxe-investment-desc" data-i18n="wiz_inv1_desc">مناسب للفلل المعمارية المستقلة والتأثيث الفاخر عالي المستوى.</p>
									</div>

									<div class="luxe-investment-card is-selected" data-investment="5M — 10M SAR">
										<div class="luxe-investment-range" data-i18n="wiz_inv2_rng">5 — 10 ملايين ريال</div>
										<p class="luxe-investment-desc" data-i18n="wiz_inv2_desc">مناسب للقصور المتوسطة والتشطيب الفندقي الشامل للرخام الإيطالي.</p>
									</div>

									<div class="luxe-investment-card" data-investment="10M — 25M SAR">
										<div class="luxe-investment-range" data-i18n="wiz_inv3_rng">10 — 25 مليون ريال</div>
										<p class="luxe-investment-desc" data-i18n="wiz_inv3_desc">مناسب للقصور الكبرى والتحف السكنية متعددة الأجنحة واللاندسكيب.</p>
									</div>

									<div class="luxe-investment-card" data-investment="+25M SAR (قصور سيادية)">
										<div class="luxe-investment-range" data-i18n="wiz_inv4_rng">+25 مليون ريال</div>
										<p class="luxe-investment-desc" data-i18n="wiz_inv4_desc">القصور الملكية والمشاريع السيادية ذات المواصفات الخاصة والسرية التامة.</p>
									</div>

								</div>
							</div>

							<!-- Step 6: Contact & Preferred Channel -->
							<div class="luxe-wizard-step" data-step="6">
								<h2 class="luxe-wizard-question" data-i18n="wiz_q6_title">بيانات التواصل والوسيلة المفضلة</h2>
								<p class="luxe-wizard-subtext" data-i18n="wiz_q6_sub">نلتزم بسرية تامة ومطلقة بموجب بروتوكول الخصوصية المعتمد لدينا.</p>

								<div class="luxe-funnel-row" style="margin-bottom: 1.5rem;">
									<div class="luxe-funnel-form-group" style="margin: 0;">
										<label class="luxe-funnel-label" for="luxe-wizard-name" data-i18n="wiz_name_label">اللقب والاسم الكريم *</label>
										<input type="text" id="luxe-wizard-name" class="luxe-funnel-input" placeholder="سعادة / أستاذ..." data-i18n-placeholder="wiz_name_ph" required />
									</div>
									<div class="luxe-funnel-form-group" style="margin: 0;">
										<label class="luxe-funnel-label" for="luxe-wizard-phone" data-i18n="wiz_phone_label">رقم الهاتف المباشر (مع رمز الدولة) *</label>
										<input type="tel" id="luxe-wizard-phone" class="luxe-funnel-input" placeholder="+966 50 ..." data-i18n-placeholder="wiz_phone_ph" required />
									</div>
								</div>

								<div class="luxe-funnel-form-group" style="margin-bottom: 2rem;">
									<label class="luxe-funnel-label" for="luxe-wizard-email" data-i18n="wiz_email_label">البريد الإلكتروني المعتمد</label>
									<input type="email" id="luxe-wizard-email" class="luxe-funnel-input" placeholder="contact@domain.com" />
								</div>

								<div class="luxe-meta-latin" data-i18n="wiz_channel_tag" style="margin-bottom: 0.75rem;">وسيلة التواصل المفضلة</div>
								<div class="luxe-city-pills" style="margin-bottom: 1rem;">
									<button type="button" class="luxe-city-pill luxe-channel-pill is-active" data-channel="واتساب مشفر" data-i18n="wiz_ch_wa">واتساب مشفر (مشرف المراسم)</button>
									<button type="button" class="luxe-city-pill luxe-channel-pill" data-channel="اتصال هاتفي مباشر" data-i18n="wiz_ch_call">اتصال هاتفي مباشر مع الشريك</button>
									<button type="button" class="luxe-city-pill luxe-channel-pill" data-channel="لقاء شخصي بمقر الاستوديو" data-i18n="wiz_ch_visit">لقاء خاص بمقر الاستوديو بالرياض</button>
								</div>
							</div>

							<!-- Navigation Bar -->
							<div class="luxe-wizard-nav">
								<button type="button" class="luxe-wizard-btn-prev" data-i18n="wiz_btn_prev">السابق</button>
								<button type="button" class="luxe-btn luxe-btn--solid luxe-wizard-btn-next">
									<span data-i18n="wiz_btn_next">متابعة الخطوة التالية</span>
									<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
								</button>
							</div>

						</form>

						<!-- Success Monograph Screen -->
						<div class="luxe-wizard-success">
							<div class="luxe-wizard-success-blueprint">
								<svg width="40" height="40" viewBox="0 0 40 40" fill="none">
									<path d="M10 20L18 28L30 12" stroke="var(--interior-brass-light)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>

							<span class="luxe-meta-latin" data-i18n="wiz_succ_tag" style="display: block; margin-bottom: 0.5rem; color: var(--interior-brass-light);">تم استلام الملف واعتماده</span>
							<h3 data-i18n="wiz_succ_title" style="font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 2.8rem); color: var(--interior-bone); margin-bottom: 1rem;">
								تم تسجيل ملف مشروعك المعماري بنجاح
							</h3>
							<p data-i18n="wiz_succ_desc" style="font-size: var(--text-base); color: var(--interior-text-muted); max-width: 580px; margin: 0 auto 2.5rem; line-height: 1.9;">
								سيتواصل مكتب كبير المعماريين مع سعادتكم مباشرة خلال 24 ساعة لترتيب موعد الجلسة الاستشارية الخاصة وفقاً للوسيلة المفضلة.
							</p>

							<div id="luxe-wizard-summary-text" style="background: var(--interior-ink); border: 1px solid var(--interior-hairline); padding: 1.5rem; max-width: 540px; margin: 0 auto 2.5rem; text-align: start; font-size: var(--text-sm); line-height: 2; color: var(--interior-bone);">
								<!-- Populated by JavaScript -->
							</div>

							<div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
								<a id="luxe-wizard-whatsapp-btn" href="https://wa.me/966501234567" target="_blank" rel="nofollow noopener noreferrer" class="luxe-btn luxe-btn--solid" style="background: #25D366; border-color: #25D366; color: #fff;">
									<span data-i18n="wiz_succ_wa_btn">إرسال نسخة فورية عبر واتساب الإدارة</span>
									<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
								</a>
								<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="luxe-btn luxe-btn--ghost">
									<span data-i18n="wiz_succ_archive_btn">تصفح أرشيف المشاريع</span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<!-- Column B: Architectural Studio Desk HQ Card & Blueprint Map -->
				<div id="studio-desk">
					<div class="luxe-studio-desk-card">
						<span class="luxe-meta-latin" data-i18n="desk_tag" style="display: block; margin-bottom: 0.75rem;">المقر الرئيسي للاستوديو</span>
						<h3 data-i18n="desk_title" style="font-family: var(--font-heading); font-size: 2rem; color: var(--interior-bone); margin-bottom: 1.5rem;">
							مرسم الرياض السيادي
						</h3>
						
						<p data-i18n="desk_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); line-height: 1.85; margin-bottom: 2rem;">
							نستقبل أصحاب المشاريع والعملاء في استوديونا الخاص بالرياض لعقد الجلسات المغلقة وعرض ألواح الرخام الطبيعي والمخططات ثلاثية الأبعاد.
						</p>

						<!-- Dark Blueprint Architectural Map -->
						<div class="luxe-blueprint-map-box">
							<!-- Vector Blueprint Grid & Compass -->
							<svg viewBox="0 0 300 200" fill="none" style="width: 100%; height: 100%; display: block;">
								<line x1="20" y1="100" x2="280" y2="100" stroke="rgba(80,120,160,0.4)" stroke-width="1"/>
								<line x1="150" y1="20" x2="150" y2="180" stroke="rgba(80,120,160,0.4)" stroke-width="1"/>
								<circle cx="150" cy="100" r="45" stroke="#c49a5b" stroke-width="1.2" stroke-dasharray="3 3"/>
								<circle cx="150" cy="100" r="6" fill="#c49a5b"/>
								
								<text class="luxe-cad-map-hq" data-i18n="cad_map_hq" x="160" y="95" fill="#c49a5b" font-family="'IBM Plex Sans Arabic', monospace" font-size="10" font-weight="bold">المقر // الرياض</text>
								<text class="luxe-cad-map-coords" data-i18n="cad_map_coords" x="30" y="40" fill="#7db0dd" font-family="'IBM Plex Sans Arabic', monospace" font-size="9">الإحداثيات: 24°42′42″ش 46°40′30″ق</text>
								<text class="luxe-cad-map-elev" data-i18n="cad_map_elev" x="30" y="170" fill="rgba(255,255,255,0.5)" font-family="'IBM Plex Sans Arabic', monospace" font-size="8">الارتفاع: +624م · المنطقة أ-1</text>
							</svg>
						</div>

						<?php
						$desk_addr  = interior_get_studio_option( 'interior_address_ar', 'interior_address_en', 'طريق الملك فهد، العليا، برج المراجعة، الرياض' );
						$desk_phone = interior_get_studio_option( 'interior_phone', 'interior_phone', '+966 11 480 0000' );
						$desk_wa    = interior_get_studio_option( 'interior_whatsapp', 'interior_whatsapp', '+966 50 123 4567' );
						?>
						<div style="border-top: 1px solid var(--interior-hairline); padding-top: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem;">
							<div>
								<span class="luxe-meta-latin" data-i18n="desk_addr_label" style="font-size: 10px; display: block; margin-bottom: 0.25rem;">العنوان المعتمد</span>
								<div data-i18n="desk_addr_val" style="font-size: var(--text-sm); color: var(--interior-bone);"><?php echo esc_html( $desk_addr ); ?></div>
							</div>
							<div>
								<span class="luxe-meta-latin" data-i18n="desk_phone_label" style="font-size: 10px; display: block; margin-bottom: 0.25rem;">الخط الهاتفي المباشر</span>
								<div style="font-family: var(--font-mono); font-size: var(--text-sm); color: var(--interior-brass-light); direction: ltr; text-align: start;"><?php echo esc_html( $desk_phone ); ?></div>
							</div>
							<div>
								<span class="luxe-meta-latin" data-i18n="desk_wa_label" style="font-size: 10px; display: block; margin-bottom: 0.25rem;">واتساب الإدارة المشفر</span>
								<div style="font-family: var(--font-mono); font-size: var(--text-sm); color: var(--interior-brass-light); direction: ltr; text-align: start;"><?php echo esc_html( $desk_wa ); ?></div>
							</div>
							<div>
								<span class="luxe-meta-latin" data-i18n="desk_nda_label" style="font-size: 10px; display: block; margin-bottom: 0.25rem;">ميثاق السرية التامة</span>
								<div data-i18n="desk_nda_val" style="font-size: 11px; color: var(--interior-text-muted); line-height: 1.7;">كافة الجلسات الاستشارية والمخططات مشمولة باتفاقية السرية المتبادلة المصونة قانونياً.</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
