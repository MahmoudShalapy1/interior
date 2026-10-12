<?php
/**
 * Title: INTERIOR — دراسة الضوء والمسار الشمسي (Architectural Light Study)
 * Slug: blockskit-child/light-study
 * Categories: interior-execution
 * Keywords: light, study, circadian, daylight, sun, lighting
 * Description: محاكي الضوء المعماري وتأثير المسار الشمسي على الفراغات من الفجر إلى الليل (Wow #4)
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.7: Architectural Light Study (Wow #4) -->
<section class="luxe-light-section" id="light-study">
	<div class="luxe-container">
		<!-- Section Header -->
		<div class="luxe-light-header">
			<div class="luxe-light-header-lead">
				<span class="luxe-meta-latin" data-i18n="light_tag">04 · محاكي الضوء المعماري وحركة الشمس</span>
				<h2 data-i18n="light_title">هندسة الضوء والمسار الشمسي.</h2>
			</div>
			<p class="luxe-light-header-desc" data-i18n="light_desc">
				الفراغ المعماري كائن حي يتنفس مع حركة الشمس. نحن لا نضع وحدات إضاءة عشوائية؛ بل نصمم فتحات الواجهات وزوايا الانكسار ومستويات الانعكاس لتتبدل روح المكان وتتدرج شاعريته بانتظام مع تعاقب أوقات اليوم.
			</p>
		</div>

		<!-- Interactive Viewport Frame -->
		<div class="luxe-light-frame">
			<!-- Layer 1: Dawn (06:00) -->
			<img class="luxe-light-layer luxe-light-layer--dawn is-active" data-phase="dawn" src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_light_dawn.jpg' ); ?>" alt="ضوء الفجر المعماري" loading="lazy">

			<!-- Layer 2: Noon (12:00) -->
			<img class="luxe-light-layer luxe-light-layer--noon" data-phase="noon" src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_light_noon.jpg' ); ?>" alt="ضوء الظهيرة المعماري" loading="lazy">

			<!-- Layer 3: Sunset (18:00) -->
			<img class="luxe-light-layer luxe-light-layer--sunset" data-phase="sunset" src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_light_sunset.jpg' ); ?>" alt="ضوء الغروب الذهبي المعماري" loading="lazy">

			<!-- Layer 4: Night (22:00) -->
			<img class="luxe-light-layer luxe-light-layer--night" data-phase="night" src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_light_night.jpg' ); ?>" alt="سينوغرافيا الإضاءة الليلية" loading="lazy">

			<!-- Ambient Color Overlay Filter -->
			<div class="luxe-light-tint"></div>

			<!-- Live Architectural Lux Sensor Overlay Tag -->
			<div class="luxe-cad-light-sensor" data-i18n="light_sensor_tag">
				محاكي الإضاءة · ديناميكية حركة المسار الشمسي
			</div>
		</div>

		<!-- Time Controls & Editorial Atmospheric Description -->
		<div class="luxe-light-controls">
			<div class="luxe-light-tabs" role="tablist" aria-label="أوقات دراسة الضوء المعماري">
				<button type="button" class="luxe-light-tab is-active" data-phase="dawn" role="tab" aria-selected="true">
					<span data-i18n="light_tab_dawn">06:00 · الفجر</span>
				</button>
				<button type="button" class="luxe-light-tab" data-phase="noon" role="tab" aria-selected="false">
					<span data-i18n="light_tab_noon">12:00 · الظهيرة</span>
				</button>
				<button type="button" class="luxe-light-tab" data-phase="sunset" role="tab" aria-selected="false">
					<span data-i18n="light_tab_sunset">18:00 · الغروب</span>
				</button>
				<button type="button" class="luxe-light-tab" data-phase="night" role="tab" aria-selected="false">
					<span data-i18n="light_tab_night">22:00 · سكون الليل</span>
				</button>
			</div>

			<p class="luxe-light-quote" data-i18n="light_quote_text" style="font-family: var(--font-heading); font-size: var(--text-base); color: var(--interior-bone); margin: 0; max-width: 52ch; line-height: 1.6;">
				الفجر 06:00 · ضوء شاحب هادئ يوقظ الخطوط المعمارية بانكسار ناعم وبلا قسوة.
			</p>
		</div>
	</div>
</section>
