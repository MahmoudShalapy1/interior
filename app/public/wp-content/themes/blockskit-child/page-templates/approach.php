<?php
/**
 * Template Name: Luxury Approach & Investment Page
 * Description: Section 8.5: Architectural Turnkey Philosophy, Engagement Tiers & Investment Clarity.
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
	<section class="luxe-hero" id="approach-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_joinery_detail.jpg' ); ?>" alt="<?php echo $is_en ? 'Approach & Executive Investment Governance — INTERIOR' : 'فلسفة المنهج والاستثمار — إنتيريور'; ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title" data-i18n="app_hero_title">
					الاستثمار في <span class="luxe-accent-serif">المسؤولية الكاملة</span> وليس مجرد الديكور.
				</h1>

				<p class="luxe-hero__lead" data-i18n="app_hero_lead">
					لا نؤمن بالمقاولات المجزأة التي تشتت المسؤولية وتستنزف أعصاب المالك. منهجيتنا مبنية على عقد شامل يحمي وقتك وميزانيتك، ويضمن خروج قصرك كتحفة معمارية خالدة دون أوامر تغيير عشوائية.
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span data-i18n="app_hero_cta_brief">طلب دراسة معمارية خاصة</span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#tiers" class="luxe-btn--text">
						<span data-i18n="app_hero_cta_tiers">استكشف فئات الارتباط الثلاث</span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. Turnkey Philosophy: لماذا نرفض تجزئة المقاولات؟ (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="philosophy">
		<div class="luxe-container">
			<div style="display: grid; grid-template-columns: 1fr 1.1fr; gap: clamp(3rem, 6vw, 7rem); align-items: center;">
				
				<div>
					<span class="luxe-meta-latin" data-i18n="app_phil_tag" style="display: block; margin-bottom: 0.75rem;">فلسفة السيادة والمسؤولية الكاملة</span>
					<h2 data-i18n="app_phil_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.5rem;">
						لماذا نرفض <span class="luxe-accent-serif">تجزئة المقاولات</span> في القصور الكبرى؟
					</h2>
					<p data-i18n="app_phil_p1" style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted); margin-bottom: 1.5rem;">
						في معظم المشاريع التقليدية، يتعاقد المالك مع مصمم، ثم مقاول عظم، ثم مقاول تشطيب، ثم مورد رخام، ثم شركة تكييف، وورشة نجارة. عندما يحدث خطأ في الارتفاع أو تسريب أو عيب في المفاصل، يتبرأ الجميع ويلوم كل طرف الآخر.
					</p>
					<div data-i18n="app_phil_quote" style="font-family: var(--font-heading); font-size: 1.4rem; color: var(--interior-brass-light); border-inline-start: 2px solid var(--interior-brass); padding-inline-start: 1.75rem; margin: 2rem 0; line-height: 1.6;">
						"التجزئة تصنع وهم التوفير الأولي، لكنها تكلف المالك لاحقاً أضعاف السعر في إصلاح العيوب وتأخير السكن."
					</div>
					<p data-i18n="app_phil_p2" style="font-size: var(--text-base); line-height: 1.9; color: var(--interior-text-muted);">
						منهجنا قائم على تولي كافة الطبقات تحت سقف واحد: دراسة معمارية متكاملة، توريد مباشر من المقالع، إشراف يومي مقيم، وتسليم مفتاح جاهز للسكن بضمان واحد لا يقبل اللبس.
					</p>
				</div>

				<div style="border: 1px solid var(--interior-hairline); background: var(--interior-charcoal); padding: clamp(2rem, 4vw, 3.5rem);">
					<span class="luxe-meta-latin" data-i18n="app_contract_tag" style="display: block; margin-bottom: 1.5rem;">ما يشمله العقد الشامل لدينا</span>
					<ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.5rem;">
						<li style="display: flex; gap: 1rem; align-items: flex-start;">
							<span style="color: var(--interior-brass); font-family: var(--font-mono); font-size: 1.1rem; line-height: 1;">&#10003;</span>
							<div>
								<h3 data-i18n="app_ci1_title" style="font-family: var(--font-heading); font-size: 1.25rem; color: var(--interior-bone); margin-bottom: 0.25rem;">مخططات كهروميكانيكية وإنشائية متكاملة</h3>
								<p data-i18n="app_ci1_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">مطابقة الكود السعودي ودراسات أحمال التكييف المخفي بالمليمتر.</p>
							</div>
						</li>
						<li style="display: flex; gap: 1rem; align-items: flex-start;">
							<span style="color: var(--interior-brass); font-family: var(--font-mono); font-size: 1.1rem; line-height: 1;">&#10003;</span>
							<div>
								<h3 data-i18n="app_ci2_title" style="font-family: var(--font-heading); font-size: 1.25rem; color: var(--interior-bone); margin-bottom: 0.25rem;">استيراد مباشر للرخام والأخشاب النادرة</h3>
								<p data-i18n="app_ci2_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">فحص جيولوجي وشحن مباشر من أوروبا دون وسطاء تجاريين.</p>
							</div>
						</li>
						<li style="display: flex; gap: 1rem; align-items: flex-start;">
							<span style="color: var(--interior-brass); font-family: var(--font-mono); font-size: 1.1rem; line-height: 1;">&#10003;</span>
							<div>
								<h3 data-i18n="app_ci3_title" style="font-family: var(--font-heading); font-size: 1.25rem; color: var(--interior-bone); margin-bottom: 0.25rem;">إشراف استشاري مقيم بالموقع يومياً</h3>
								<p data-i18n="app_ci3_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">تدقيق مستمر لـ 34 نقطة فحص جودة مع تقارير رقمية للمالك.</p>
							</div>
						</li>
						<li style="display: flex; gap: 1rem; align-items: flex-start;">
							<span style="color: var(--interior-brass); font-family: var(--font-mono); font-size: 1.1rem; line-height: 1;">&#10003;</span>
							<div>
								<h3 data-i18n="app_ci4_title" style="font-family: var(--font-heading); font-size: 1.25rem; color: var(--interior-bone); margin-bottom: 0.25rem;">ضمان هيكلي وإنشائي شامل لمدة 10 سنوات</h3>
								<p data-i18n="app_ci4_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); margin: 0;">التزام قانوني وخدمة صيانة دورية حصرية لأصحاب القصور.</p>
							</div>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</section>

	<!-- 03. 3 Engagement Tiers: فئات الارتباط الثلاث (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal" id="tiers">
		<div class="luxe-container">
			<div style="text-align: center; max-width: 800px; margin-inline: auto;">
				<span class="luxe-meta-latin" data-i18n="app_tiers_tag" style="display: block; margin-bottom: 0.75rem;">خيارات التعاقد والمسارات المعمارية</span>
				<h2 data-i18n="app_tiers_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
					فئات الارتباط المعماري <span class="luxe-accent-serif">مع الاستوديو</span>
				</h2>
				<p data-i18n="app_tiers_desc" style="color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.85; margin-top: 1rem;">
					نقدم ثلاثة مسارات واضحة تلائم تطلعاتك ومستوى الإشراف والمسؤولية المطلوب لمشروعك.
				</p>
			</div>

			<div class="luxe-tiers-grid">
				
				<!-- Tier I: Design Vision -->
				<div class="luxe-tier-card">
					<div class="luxe-tier-card__num" data-i18n="app_t1_num">المستوى الأول // 01</div>
					<h3 class="luxe-tier-card__title" data-i18n="app_t1_title">الرؤية المعمارية والتصميم</h3>
					<p class="luxe-tier-card__desc" data-i18n="app_t1_desc">
						مناسب للملاك الذين يمتلكون جهازاً تنفيذياً خاصاً أو مقاولاً معتمداً، ويبحثون عن صياغة فراغية استثنائية ومخططات تنفيذية تفصيلية لا تدع مجالاً للتأويل.
					</p>
					<ul class="luxe-tier-card__features">
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t1_f1">دراسات توزيع الفراغات وحركة الضوء ثلاثية الأبعاد</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t1_f2">مخططات تنفيذية معمارية وكهروميكانيكية كاملة</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t1_f3">جداول كميات وتوصيف دقيق للمواد النبيلة</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t1_f4">جلسات مراجعة وتعديل مع كبير المعماريين</span>
						</li>
					</ul>
					<div class="luxe-tier-card__cta">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-editorial-link">
							<span data-i18n="app_t1_btn">طلب دراسة تصميم</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>
				</div>

				<!-- Tier II: Design & Supervision -->
				<div class="luxe-tier-card">
					<div class="luxe-tier-card__num" data-i18n="app_t2_num">المستوى الثاني // 02</div>
					<h3 class="luxe-tier-card__title" data-i18n="app_t2_title">التصميم والإشراف التنفيذي</h3>
					<p class="luxe-tier-card__desc" data-i18n="app_t2_desc">
						صياغة التصميم بالكامل مع تولي الإشراف الهندسي الصارم والتدقيق اليومي على مقاولك المنفذ لضمان الالتزام الصارم بالمعايير دون أي تهاون.
					</p>
					<ul class="luxe-tier-card__features">
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t2_f1">كافة مخرجات الفئة الأولى للتصميم</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t2_f2">زيارات ميدانية دورية من الاستشاري المشرف</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t2_f3">اعتماد عينات المواد ومطابقتها للمواصفات</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t2_f4">تقارير جودة شهرية مستقلة لمالك المشروع</span>
						</li>
					</ul>
					<div class="luxe-tier-card__cta">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-editorial-link">
							<span data-i18n="app_t2_btn">طلب تصميم وإشراف</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>
				</div>

				<!-- Tier III: Full Turnkey (RECOMMENDED) -->
				<div class="luxe-tier-card is-recommended">
					<span class="luxe-tier-card__badge" data-i18n="app_t3_badge">الأكثر طلباً بين عملائنا (92٪)</span>
					<div class="luxe-tier-card__num" data-i18n="app_t3_num">المستوى الثالث // 03</div>
					<h3 class="luxe-tier-card__title" data-i18n="app_t3_title">تسليم المفتاح السيادي الكامل</h3>
					<p class="luxe-tier-card__desc" data-i18n="app_t3_desc">
						المسؤولية السيادية الشاملة: من المخطط الأول على الورق، استيراد الرخام، النجارة الخاصة، الإشراف اليومي، حتى تسليم القصر مؤثثاً وجاهزاً للسكن الفوري.
					</p>
					<ul class="luxe-tier-card__features">
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t3_f1">تصميم معماري وداخلي ولاندسكيب متكامل</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t3_f2">استيراد مباشر للرخام والأخشاب من أوروبا</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t3_f3">مهندس استشاري مقيم بالموقع يومياً</span>
						</li>
						<li class="luxe-tier-card__feature-item">
							<span class="luxe-tier-card__feature-dot"></span>
							<span data-i18n="app_t3_f4">عقد بمبلغ مقطوع ثابت وضمان شامل 10 سنوات</span>
						</li>
					</ul>
					<div class="luxe-tier-card__cta">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid" style="width: 100%; text-align: center;">
							<span data-i18n="app_t3_btn">اختيار تسليم المفتاح الكامل</span>
							<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
						</a>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- 04. Investment Baseline Pillar: توضيح السعة والحد الاستثماري (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" style="text-align: center;">
		<div class="luxe-container">
			<div style="max-width: 820px; margin-inline: auto; border: 1px solid var(--interior-hairline); padding: clamp(2.5rem, 5vw, 4.5rem); background: var(--interior-charcoal);">
				<span class="luxe-meta-latin" data-i18n="app_cap_tag" style="display: block; margin-bottom: 0.75rem;">الوضوح الاستثماري وتحديد السعة</span>
				<h2 data-i18n="app_cap_title" style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--interior-bone); margin-bottom: 1.25rem;">
					معايير قبول المشاريع في الاستوديو
				</h2>
				<p data-i18n="app_cap_desc" style="font-size: var(--text-base); color: var(--interior-text-muted); line-height: 1.9; margin-bottom: 2.25rem;">
					للحفاظ على الدقة الحرفية وتواجد كبار المعماريين شخصياً في الموقع، نقبل <strong>أربعة قصور فقط سنوياً</strong>. تبدأ ميزانيات مشاريع التنفيذ الشاملة لدينا من نطاق استثماري يضمن استيراد المواد النبيلة وتطبيق الكود الهندسي الأرقى دون أي مساومة.
				</p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
					<span data-i18n="app_cap_btn">التحقق من توفر السعة لمشروعك</span>
					<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
				</a>
			</div>
		</div>
	</section>

	<!-- 05. Investment FAQs: أسئلة الاستثمار والميزانيات (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal">
		<div class="luxe-container">
			<div style="max-width: 820px; margin-inline: auto;">
				<div style="text-align: center; margin-bottom: 4rem;">
					<span class="luxe-meta-latin" data-i18n="app_gov_tag" style="display: block; margin-bottom: 0.75rem;">حوكمة التكاليف والشفافية</span>
					<h2 data-i18n="app_gov_title" style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--interior-bone); line-height: 1.25;">
						حوكمة التكاليف <span class="luxe-accent-serif">وحماية الميزانية</span>
					</h2>
				</div>

				<div class="luxe-faq-accordion">
					
					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="app_q1_title">لماذا يعتبر العقد الشامل أوفر للمالك من تجزئة المقاولين؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="app_q1_ans">
								لأن التجزئة ينتج عنها دائماً فاقد وأخطاء تعديل. على سبيل المثال: إذا وضع مقاول العظم منسوب الأرضيات بخطأ 3 سم، يضطر مقاول الرخام لتكسير أو زيادة مونة التسوية بتكلفة باهظة. في العقد الشامل، يتحمل إنتيريور كافة هذه المواءمات ويتحمل مسؤوليتها دون تحميل المالك ريالاً واحداً إضافياً.
							</p>
						</div>
					</div>

					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="app_q2_title">كيف يتم توزيع الدفعات المالية أثناء سير المشروع؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="app_q2_ans">
								ترتبط كافة الدفعات المالية بمراحل إنجاز ملموسة على أرض الواقع معتمدة بتقرير استشاري مصور، وليس بمواعيد زمنية مجردة. لا تستحق أي دفعة إلا بعد اجتياز مرحلتها بنجاح ومطابقتها للمواصفات الفنية.
							</p>
						</div>
					</div>

					<div class="luxe-faq-item">
						<button type="button" class="luxe-faq-header">
							<span class="luxe-faq-question" data-i18n="app_q3_title">ماذا يحدث إذا رغبت في تعديل مخطط أو خامة أثناء التنفيذ؟</span>
							<span class="luxe-faq-toggle-icon">+</span>
						</button>
						<div class="luxe-faq-body">
							<p class="luxe-faq-answer" data-i18n="app_q3_ans">
								نتبع نظام أوامر التغيير الشفافة المعتمدة؛ حيث يقدم الاستوديو دراسة تفصيلية للأثر المالي والزمني لأي تعديل مقترح قبل تنفيذه، ولا يُعتمد أي تغيير إلا بموافقة خطية واضحة من المالك.
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
