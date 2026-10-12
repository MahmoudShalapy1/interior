<?php
/**
 * Title: INTERIOR — من الخط إلى المكان (From Line to Living Pinned Story)
 * Slug: blockskit-child/line-to-living
 * Categories: interior-execution
 * Keywords: line to living, story, stages, pinned, architecture
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.3: From Line to Living — Pinned 4-Stage Story (Wow #2) -->
<section class="luxe-story-pinned" id="story" style="min-height: 350vh;">
	<div class="luxe-story-viewport">
		<div class="luxe-container">
			<div class="luxe-story-grid">
				<!-- Column A: Master Architectural Frame with 4 Overlapping Stages -->
				<div>
					<div class="luxe-story-stage-viewport">
						<!-- Stage 01: The Concept Sketch -->
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/img05.jpg' ); ?>" alt="الفكرة — الاسكتش المعماري" class="luxe-story-stage-img is-active" data-stage="0" loading="lazy" decoding="async">

						<!-- Stage 02: CAD & BIM Engineering -->
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/img09.jpg' ); ?>" alt="الهندسة — المخططات التنفيذية" class="luxe-story-stage-img" data-stage="1" loading="lazy" decoding="async">

						<!-- Stage 03: 3D Volumetric & Material Shaders -->
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/img11.jpg' ); ?>" alt="النموذج — مطابقة الخامات" class="luxe-story-stage-img" data-stage="2" loading="lazy" decoding="async">

						<!-- Stage 04: Delivered Turnkey Palace -->
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_master_suite.jpg' ); ?>" alt="التسليم — قصر مسكون ومؤثث" class="luxe-story-stage-img" data-stage="3" loading="lazy" decoding="async">
					</div>
					<div style="display: flex; justify-content: flex-start; align-items: center; margin-top: 1rem;">
						<span class="luxe-meta-latin" data-i18n="story_spec_chamber">الجناح 01 · الفكرة والاسكتش المعماري</span>
					</div>
				</div>

				<!-- Column B: Dynamic Stage Information Panel -->
				<div class="luxe-story-details">
					<span class="luxe-meta-latin" data-i18n="story_narrative_tag" style="margin-bottom: 0.75rem;">السردية السيادية · من الخط إلى المكان</span>
					
					<!-- Stage Number Indicator & Progress Fill Bar -->
					<div class="luxe-story-indicator">
						<div class="luxe-story-number" data-i18n="story_num_current">01</div>
						<div class="luxe-story-progress-bar">
							<div class="luxe-story-progress-fill"></div>
						</div>
						<span class="luxe-meta-latin" data-i18n="story_stage_total">المرحلة 04</span>
					</div>

					<!-- Content Item 01 -->
					<div class="luxe-story-content-item is-active" data-stage="0">
						<span class="luxe-story-badge" data-i18n="story_s1_badge">المرحلة 01 · الفكرة والاسكتش المعماري</span>
						<h2 class="luxe-story-title" data-i18n="story_s1_title">أول خط قلم على الورق.</h2>
						<p class="luxe-story-desc" data-i18n="story_s1_desc">
							مئات القرارات الحاسمة المتعلقة بمسار الشمس والرياح وتوزيع الكتل المعمارية تُحسم في الاسكتش الأول قبل وضع حجر واحد في الموقع.
						</p>
						<ul class="luxe-story-deliverables">
							<li data-i18n="story_s1_d1">الاسكتشات المعمارية اليدوية للمساقط والواجهات</li>
							<li data-i18n="story_s1_d2">دراسة التوجيه المناخي والإضاءة الطبيعية</li>
							<li data-i18n="story_s1_d3">الرؤية التوجيهية الحصرية للمشروع</li>
						</ul>
						<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="luxe-btn--text">
							<span data-i18n="story_s1_link">اكتشف خدمة التصميم المعماري</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>

					<!-- Content Item 02 -->
					<div class="luxe-story-content-item" data-stage="1">
						<span class="luxe-story-badge" data-i18n="story_s2_badge">المرحلة 02 · الهندسة والمخططات التنفيذية</span>
						<h2 class="luxe-story-title" data-i18n="story_s2_title">تحويل الإلهام إلى هندسة دقيقة.</h2>
						<p class="luxe-story-desc" data-i18n="story_s2_desc">
							نمذجة كاملة بنظام رقمي متقدم لدمج الأنظمة الكهروميكانيكية والإنشائية بدقة مليمترية، تمنع أي تعارضات أو أوامر تغيير مكلفة أثناء البناء.
						</p>
						<ul class="luxe-story-deliverables">
							<li data-i18n="story_s2_d1">المخططات الإنشائية والمعمارية المعتمدة بنمذجة رقمية</li>
							<li data-i18n="story_s2_d2">جداول الكميات وحساب الأحمال بدقة متناهية</li>
							<li data-i18n="story_s2_d3">المطابقة التامة لكود البناء السعودي والمعايير الدولية</li>
						</ul>
						<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="luxe-btn--text">
							<span data-i18n="story_s2_link">اكتشف خدمة الإشراف الهندسي</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>

					<!-- Content Item 03 -->
					<div class="luxe-story-content-item" data-stage="2">
						<span class="luxe-story-badge" data-i18n="story_s3_badge">المرحلة 03 · النموذج واختبار الخامات الحقيقية</span>
						<h2 class="luxe-story-title" data-i18n="story_s3_title">اختبار المادة قبل التوريد.</h2>
						<p class="luxe-story-desc" data-i18n="story_s3_desc">
							محاكاة واقعية فائقة الدقة ومحاكاة فيزيائية لسقوط الضوء على ألواح الرخام الإيطالي وخشب الجوز والبرونز الخام الموردة مباشرة من محاجرها.
						</p>
						<ul class="luxe-story-deliverables">
							<li data-i18n="story_s3_d1">عينات خامات حقيقية بشهادات المنشأ الموثقة</li>
							<li data-i18n="story_s3_d2">محاكاة إضاءة واقعية لأوقات اليوم المختلفة</li>
							<li data-i18n="story_s3_d3">لوحات مطابقة الألوان والتشطيبات الحصرية</li>
						</ul>
						<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="luxe-btn--text">
							<span data-i18n="story_s3_link">اكتشف توريد الخامات النبيلة</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>

					<!-- Content Item 04 -->
					<div class="luxe-story-content-item" data-stage="3">
						<span class="luxe-story-badge" data-i18n="story_s4_badge">المرحلة 04 · التسليم السيادي الكامل</span>
						<h2 class="luxe-story-title" data-i18n="story_s4_title">قصرٌ حي ومؤثث بالكامل.</h2>
						<p class="luxe-story-desc" data-i18n="story_s4_desc">
							تسليم المفتاح لقصر متكامل وجاهز للعيش الفوري، مع أثاث مخصص، وأنظمة تشغيل ذكية مختبرة، وضمان شامل تحت سقف مسؤول واحد.
						</p>
						<ul class="luxe-story-deliverables">
							<li data-i18n="story_s4_d1">تسليم مفتاح متكامل وجاهز للسكن الفوري</li>
							<li data-i18n="story_s4_d2">عقد ضمان ممتد على الهيكل والتشطيبات والأثاث</li>
							<li data-i18n="story_s4_d3">كتيب الصيانة والدعم المستمر بعد التسليم</li>
						</ul>
						<a href="#funnel" class="luxe-btn luxe-btn--solid" style="margin-top: 1rem;">
							<span data-i18n="story_s4_btn">حجز استشارة خاصة لمشروعك</span>
							<span class="luxe-arrow-icon">←</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
