<?php
/**
 * Title: INTERIOR — الافتتاحية وعدسة المخطط المعمارية (Hero Reveal Lens)
 * Slug: blockskit-child/hero-reveal
 * Categories: interior-hero
 * Keywords: hero, lens, blueprint, luxury, architecture
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- 1. Opening Architectural Preloader (Once per session) -->
<div id="luxe-preloader" aria-hidden="true">
	<svg class="luxe-preloader__blueprint" viewBox="0 0 100 80">
		<rect class="luxe-preloader__stroke" x="10" y="10" width="80" height="60"/>
		<line class="luxe-preloader__stroke" x1="10" y1="40" x2="90" y2="40"/>
		<line class="luxe-preloader__stroke" x1="50" y1="10" x2="50" y2="70"/>
		<circle class="luxe-preloader__stroke" cx="50" cy="40" r="12"/>
	</svg>
	<div class="luxe-preloader__brand" data-i18n="brand_logo">إنتيريور</div>
	<div class="luxe-preloader__meta">
		<span data-i18n="hero_preloader_cities">الرياض · دبي · لندن</span>
		<span>·</span>
		<span data-i18n="hero_preloader_est">تأسس عام 2009</span>
	</div>
	<button type="button" class="luxe-preloader__skip" data-i18n="hero_skip_preloader">تخطي الشاشة [تخطي]</button>
</div>

<!-- 2. Architectural Hero Section with Blueprint Reveal Lens (Wow #1) -->
<section class="luxe-hero" id="hero">
	<!-- Dual-Layer Viewport -->
	<div class="luxe-hero__viewport">
		<!-- Layer A: Luxury Real Photo -->
		<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_hero_foyer.jpg' ); ?>" alt="قصر ملكي فخم — استوديو إنتيريور" class="luxe-hero__bg" fetchpriority="high" decoding="async">

		<!-- Layer B: Blueprint Wireframe CAD Layer (Clipped via Circle) -->
		<div class="luxe-hero__wireframe">
			<svg class="luxe-hero__wireframe-svg" viewBox="0 0 1920 1080" preserveAspectRatio="xMidYMid slice" fill="none">
				<!-- Perspective Architectural Grid Lines -->
				<line x1="0" y1="0" x2="960" y2="540" stroke="#B59A6A" stroke-width="0.75" stroke-dasharray="6 6"/>
				<line x1="1920" y1="0" x2="960" y2="540" stroke="#B59A6A" stroke-width="0.75" stroke-dasharray="6 6"/>
				<line x1="0" y1="1080" x2="960" y2="540" stroke="#B59A6A" stroke-width="0.75" stroke-dasharray="6 6"/>
				<line x1="1920" y1="1080" x2="960" y2="540" stroke="#B59A6A" stroke-width="0.75" stroke-dasharray="6 6"/>

				<!-- Room Structural Elevations -->
				<rect x="360" y="240" width="1200" height="600" stroke="#B59A6A" stroke-width="1"/>
				<rect x="480" y="320" width="960" height="440" stroke="#B59A6A" stroke-width="0.8"/>
				<line x1="360" y1="540" x2="1560" y2="540" stroke="#B59A6A" stroke-width="0.5" stroke-dasharray="4 4"/>
				<line x1="960" y1="240" x2="960" y2="840" stroke="#B59A6A" stroke-width="0.5" stroke-dasharray="4 4"/>

				<!-- Dimension Annotations & Coordinates in Pure Arabic (or English in LTR) -->
				<text class="luxe-cad-text-dim" data-i18n="cad_hero_dim" x="380" y="270" fill="#B59A6A" font-family="'DM Mono', 'IBM Plex Sans Arabic', monospace" font-size="12">الأبعاد: 24.50م × 16.80م · الارتفاع: 6.40م</text>
				<text class="luxe-cad-text-axis" data-i18n="cad_hero_axis" x="1320" y="270" fill="#B59A6A" font-family="'DM Mono', 'IBM Plex Sans Arabic', monospace" font-size="12">المحور الإنشائي: أ-14</text>
				<text class="luxe-cad-text-load" data-i18n="cad_hero_load" x="380" y="820" fill="#B59A6A" font-family="'DM Mono', 'IBM Plex Sans Arabic', monospace" font-size="12">سعة التحمل: خرسانة مسلحة عيار 40/50 · فاصل الربط 0.25 مم</text>
			</svg>
		</div>

		<!-- Interactive Lens Ring Follower -->
		<div class="luxe-hero__lens-ring">
			<span class="luxe-hero__lens-badge" data-i18n="hero_lens_badge">عدسة المخطط الهندسية</span>
		</div>
	</div>

	<!-- Hero Editorial Content -->
	<div class="luxe-container" style="position: relative; z-index: 10;">
		<div class="luxe-hero__content">
			<h1 class="luxe-hero__title" data-i18n="hero_title">
				صياغة معمارية <span class="luxe-accent-serif">تتجاوز</span> المألوف.
			</h1>

			<?php
			$hero_lead = interior_get_studio_option(
				'interior_hero_lead_ar',
				'interior_hero_lead_en',
				'استوديو العمارة والتنفيذ السيادي للمشاريع الخاصة والقصور الملكية. نتحمّل المسؤولية الهندسية والتنفيذية المطلقة من أول خط على الورق حتى تسليم المفتاح.'
			);
			?>
			<p class="luxe-hero__lead" data-i18n="hero_lead">
				<?php echo esc_html( $hero_lead ); ?>
			</p>

			<div class="luxe-hero__actions">
				<a href="#funnel" class="luxe-btn luxe-btn--solid">
					<span data-i18n="hero_cta_brief">طلب دراسة معمارية خاصة</span>
					<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
				</a>
				<a href="#story" class="luxe-btn--text">
					<span data-i18n="hero_cta_philosophy">استكشف فلسفة التنفيذ</span>
					<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
				</a>
			</div>
		</div>
	</div>
</section>
