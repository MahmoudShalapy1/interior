<?php
/**
 * Title: INTERIOR — دقة التحول والتنفيذ (3-Stage Realization Slider)
 * Slug: blockskit-child/before-after-stage
 * Categories: interior-execution
 * Keywords: compare, slider, before, after, bim, reality, concrete
 * Description: مقارنة تفاعلية ثلاثية المراحل: الهيكل الخرساني، المخطط التنفيذي BIM، والواقع النهائي المسلّم
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.8: 3-Stage Architectural Realization Slider -->
<section class="luxe-compare-section" id="compare">
	<div class="luxe-container">
		<!-- Section Header -->
		<div class="luxe-compare-header">
			<div class="luxe-compare-header-lead">
				<span class="luxe-meta-latin" data-i18n="compare_tag">05 · دقة التحول والتنفيذ المعماري</span>
				<h2 data-i18n="compare_title">من الهيكل الخرساني إلى الواقع المسلّم.</h2>
				<p data-i18n="compare_desc">ما نلتزم به في المخططات ونمذجة البناء الرقمية الدقيقة هو ذاته ما يتسلمه العميل على أرض الواقع—بدون مفاجآت، بدون تأخيرات، وبأدق المعايير الهندسية الصارمة.</p>
			</div>

			<div class="luxe-compare-instruction">
				<span data-i18n="compare_instruction">اسحب المقابض للمقارنة الثلاثية</span>
				<span aria-hidden="true">&larr;&rarr;</span>
			</div>
		</div>

		<!-- 3-Stage Interactive Viewport -->
		<div class="luxe-compare-viewport" id="luxe-compare-viewport">
			<!-- Layer 1: Stage 1 Raw Concrete -->
			<div class="luxe-compare-layer luxe-compare-layer--stage1" id="luxe-layer-stage1">
				<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_stage1_concrete.jpg' ); ?>" alt="الموقع الإنشائي الخرساني الخام" loading="lazy" decoding="async">
			</div>

			<!-- Layer 2: Stage 2 3D BIM Model -->
			<div class="luxe-compare-layer luxe-compare-layer--stage2" id="luxe-layer-stage2">
				<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_stage2_bim.jpg' ); ?>" alt="المخطط المعماري ونموذج المحاكاة التنفيذي BIM" loading="lazy" decoding="async">
			</div>

			<!-- Layer 3: Stage 3 Delivered Reality -->
			<div class="luxe-compare-layer luxe-compare-layer--stage3" id="luxe-layer-stage3">
				<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_stage3_delivered.jpg' ); ?>" alt="الواقع المسلّم النهائي المفروش" loading="lazy" decoding="async">
			</div>

			<!-- Draggable Handles -->
			<div class="luxe-compare-handles-wrapper">
				<div class="luxe-compare-handle" id="luxe-compare-handle-1" style="left: 33.33%;" aria-label="مقبض المقارنة الأول" role="slider" aria-valuenow="33" aria-valuemin="5" aria-valuemax="95">
					<div class="luxe-compare-handle__line"></div>
					<div class="luxe-compare-handle__knob">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="8 15 5 12 8 9"></polyline>
							<polyline points="16 9 19 12 16 15"></polyline>
							<line x1="5" y1="12" x2="19" y2="12"></line>
						</svg>
					</div>
				</div>

				<div class="luxe-compare-handle" id="luxe-compare-handle-2" style="left: 66.66%;" aria-label="مقبض المقارنة الثاني" role="slider" aria-valuenow="66" aria-valuemin="5" aria-valuemax="95">
					<div class="luxe-compare-handle__line"></div>
					<div class="luxe-compare-handle__knob">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="8 15 5 12 8 9"></polyline>
							<polyline points="16 9 19 12 16 15"></polyline>
							<line x1="5" y1="12" x2="19" y2="12"></line>
						</svg>
					</div>
				</div>
			</div>

			<!-- Stage Indicator Pills -->
			<div class="luxe-compare-pill luxe-compare-pill--stage1" data-i18n="compare_s1_pill">
				01 · الموقع الإنشائي والخرسانات
			</div>
			<div class="luxe-compare-pill luxe-compare-pill--stage2" data-i18n="compare_s2_pill">
				02 · المخططات ثلاثية الأبعاد BIM
			</div>
			<div class="luxe-compare-pill luxe-compare-pill--stage3" data-i18n="compare_s3_pill">
				03 · الواقع الحي المسكون والمفروش
			</div>
		</div>

		<!-- Explanatory Architectural Triad Footer -->
		<div class="luxe-compare-footer">
			<div>
				<span class="luxe-meta-latin luxe-compare-card-tag" data-i18n="compare_f1_tag" style="color: var(--interior-text-muted);">المرحلة 01 · فحص الموقع الإنشائي</span>
				<h3 class="luxe-compare-card-title" data-i18n="compare_f1_title">الموقع الإنشائي والخرسانات</h3>
				<p class="luxe-compare-card-desc" data-i18n="compare_f1_desc">
					فحص شامل لسلامة الهياكل وتطابق المناسيب الإنشائية مع الواقع، وتحديد مسارات التأسيس المخفية قبل بدء أي أعمال معمارية.
				</p>
			</div>

			<div>
				<span class="luxe-meta-latin luxe-compare-card-tag" data-i18n="compare_f2_tag" style="color: var(--interior-brass-light);">المرحلة 02 · النمذجة الرقمية المعتمدة</span>
				<h3 class="luxe-compare-card-title" data-i18n="compare_f2_title">المخططات ثلاثية الأبعاد الدقيقة</h3>
				<p class="luxe-compare-card-desc" data-i18n="compare_f2_desc">
					مخططات تفصيلية بمقياس 1:1، وتنسيق دقيق لكل مليمتر في مجاري التكييف والإضاءة والرخام لضمان انعدام أي تعارضات ميدانية.
				</p>
			</div>

			<div>
				<span class="luxe-meta-latin luxe-compare-card-tag" data-i18n="compare_f3_tag" style="color: var(--interior-bone);">المرحلة 03 · التسليم النهائي الشامل</span>
				<h3 class="luxe-compare-card-title" data-i18n="compare_f3_title">الواقع الحي المسكون والمفروش</h3>
				<p class="luxe-compare-card-desc" data-i18n="compare_f3_desc">
					تسليم مفتاح متكامل ومطابق بنسبة 100٪ للتصميم الأصلي، مع إنهاء كافة تفاصيل الأثاث والإضاءة والضمانات دون أي نقص.
				</p>
			</div>
		</div>
	</div>
</section>
