<?php
/**
 * Luxury Header Partial
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,400;0,500;1,400&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
	<script>
		/* Instant zero-flicker language sync based strictly on URL pathname */
		(function() {
			try {
				localStorage.removeItem('interior_lang');
				document.cookie = 'interior_lang=; path=/; max-age=0; SameSite=Lax';
			} catch(e) {}
			var isEn = (window.location.pathname.indexOf('/en/') === 0 || window.location.pathname === '/en');
			document.documentElement.setAttribute('lang', isEn ? 'en-US' : 'ar');
			document.documentElement.setAttribute('dir', isEn ? 'ltr' : 'rtl');
			if (isEn) {
				document.documentElement.classList.add('ltr');
				document.documentElement.classList.remove('rtl');
			} else {
				document.documentElement.classList.add('rtl');
				document.documentElement.classList.remove('ltr');
			}
		})();
	</script>
</head>
<body <?php body_class( 'luxe-landing-body' ); ?>>
<?php wp_body_open(); ?>

	<!-- Accessibility: Skip to Main Content Link (WCAG 2.1 AA) -->
	<a href="#main-content" class="luxe-skip-link" data-i18n="skip_to_content">
		<?php echo ( function_exists( 'interior_get_current_lang' ) && 'en' === interior_get_current_lang() ) ? 'Skip to main content' : 'تخطي إلى المحتوى الرئيسي'; ?>
	</a>

	<!-- Ambient Spotlight Torch -->
	<div id="luxe-ambient-spotlight" aria-hidden="true"></div>

	<!-- Custom Magnetic Cursor (Desktop) -->
	<div id="luxe-cursor-dot" aria-hidden="true"></div>
	<div id="luxe-cursor-ring" aria-hidden="true"></div>

	<!-- Scroll Progress Bar -->
	<div id="luxe-scroll-progress" aria-hidden="true"></div>

	<!-- Minimalist Luxury Navbar -->
	<?php $is_en = ( 'en' === interior_get_current_lang() ); ?>
	<header class="luxe-header">
		<div class="luxe-container luxe-header-inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="luxe-brand" aria-label="<?php echo $is_en ? 'INTERIOR — Sovereign Architecture & Luxury Fit-Out' : 'إنتيريور — العمارة والتنفيذ السيادي'; ?>">
				<span class="luxe-brand-logo" data-i18n="brand_logo"><?php echo $is_en ? 'INTERIOR' : 'إنتيريور'; ?></span>
				<span class="luxe-meta-latin" data-i18n="brand_sub"><?php echo $is_en ? 'Sovereign Architecture' : 'العمارة السيادية'; ?></span>
			</a>

			<nav class="luxe-nav" aria-label="<?php echo $is_en ? 'Main Navigation' : 'التنقل الرئيسي'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="luxe-nav-link <?php echo is_front_page() ? 'is-active' : ''; ?>" data-i18n="nav_home"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="luxe-nav-link <?php echo is_page( 'about' ) ? 'is-active' : ''; ?>" data-i18n="nav_about"><?php echo $is_en ? 'About Studio' : 'عن الاستوديو'; ?></a>
				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="luxe-nav-link <?php echo is_page( 'services' ) ? 'is-active' : ''; ?>" data-i18n="nav_services"><?php echo $is_en ? 'Services Ecosystem' : 'منظومة الخدمات'; ?></a>
				<a href="<?php echo esc_url( home_url( '/approach/' ) ); ?>" class="luxe-nav-link <?php echo is_page( 'approach' ) ? 'is-active' : ''; ?>" data-i18n="nav_approach"><?php echo $is_en ? 'Approach & Investment' : 'المنهج والاستثمار'; ?></a>
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="luxe-nav-link <?php echo is_page( 'projects' ) ? 'is-active' : ''; ?>" data-i18n="nav_projects"><?php echo $is_en ? 'Projects Archive' : 'أرشيف المشاريع'; ?></a>
				<a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" class="luxe-nav-link <?php echo ( is_page( 'articles' ) || is_singular( 'post' ) ) ? 'is-active' : ''; ?>" data-i18n="nav_journal"><?php echo $is_en ? 'Monographs' : 'المقالات'; ?></a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-nav-link <?php echo is_page( 'contact' ) ? 'is-active' : ''; ?>" data-i18n="nav_contact"><?php echo $is_en ? 'Private Dossier' : 'الملف الخاص'; ?></a>
			</nav>

			<!-- Header Actions: CTA + Language Switcher + Menu Trigger -->
			<div class="luxe-header-actions">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--ghost luxe-btn-ghost luxe-header-cta" data-i18n="nav_cta"><?php echo $is_en ? 'Book Private Study' : 'حجز استشارة خاصة'; ?></a>
				<?php interior_render_lang_switcher(); ?>

				<!-- Architectural Two-Line Menu Button -->
				<button type="button" class="luxe-mobile-toggle" id="luxe-menu-trigger" aria-label="<?php echo $is_en ? 'Open Navigation Menu' : 'فتح القائمة الرئيسية'; ?>" aria-expanded="false" aria-controls="luxe-curtain-menu">
					<span style="display:block; width:20px; height:1.5px; background:currentColor; margin-bottom:5px;"></span>
					<span style="display:block; width:14px; height:1.5px; background:currentColor;"></span>
				</button>
			</div>
		</div>

		<!-- Fullscreen Curtain Architectural Menu -->
		<div class="luxe-curtain-menu" id="luxe-curtain-menu" role="dialog" aria-modal="true" aria-label="<?php echo $is_en ? 'Editorial Architectural Monograph' : 'القائمة التحريرية الكاملة'; ?>">
			<div class="luxe-curtain-menu__header">
				<div class="luxe-meta-latin" data-i18n="curtain_header"><?php echo $is_en ? 'Architectural Monograph Index' : 'فهرس المونوغراف المعماري'; ?></div>
				<div style="display: flex; align-items: center; gap: 1rem;">
					<?php interior_render_lang_switcher(); ?>
					<button type="button" class="luxe-curtain-menu__close" aria-label="<?php echo $is_en ? 'Close Menu' : 'إغلاق القائمة'; ?>" data-i18n="curtain_close"><?php echo $is_en ? 'Close [Esc]' : 'إغلاق [خروج]'; ?></button>
				</div>
			</div>

			<!-- Giant Serif Nav Links -->
			<nav class="luxe-curtain-nav" aria-label="<?php echo $is_en ? 'Monograph Links' : 'روابط المونوغراف'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_hero_foyer.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_1"><?php echo $is_en ? '01' : '01'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_home"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_palace_courtyard.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_2"><?php echo $is_en ? '02' : '02'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_about"><?php echo $is_en ? 'About Studio' : 'عن الاستوديو'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_majlis_salon.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_3"><?php echo $is_en ? '03' : '03'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_services"><?php echo $is_en ? 'Services Ecosystem' : 'منظومة الخدمات'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/approach/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_joinery_detail.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_4"><?php echo $is_en ? '04' : '04'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_approach"><?php echo $is_en ? 'Approach & Investment' : 'المنهج والاستثمار'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_dining_pavilion.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_5"><?php echo $is_en ? '05' : '05'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_projects"><?php echo $is_en ? 'Projects Archive' : 'أرشيف المشاريع'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_marble_curation.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_6"><?php echo $is_en ? '06' : '06'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_journal"><?php echo $is_en ? 'Architectural Journal' : 'المقالات والمعارف'; ?></span>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-curtain-nav__item" data-preview="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_sky_penthouse.jpg' ); ?>">
					<span class="luxe-curtain-nav__num" data-i18n="curtain_num_7"><?php echo $is_en ? '07' : '07'; ?></span>
					<span class="luxe-curtain-nav__title" data-i18n="nav_contact"><?php echo $is_en ? 'Private Dossier & Contact' : 'الملف الخاص والتواصل'; ?></span>
				</a>
			</nav>

			<!-- Floating Hover Image Preview -->
			<div class="luxe-curtain-preview" id="luxe-curtain-preview">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/luxe_hero_foyer.jpg' ); ?>" alt="معاينة" loading="lazy">
			</div>

			<div class="luxe-curtain-menu__footer">
				<div>
					<span class="luxe-meta-latin" data-i18n="curtain_desk" style="display: block; margin-bottom: 0.5rem;">
						<?php echo $is_en ? 'Studio Bureau' : 'مكتب الاستوديو'; ?>
					</span>
					<span data-i18n="curtain_addr"><?php echo esc_html( interior_get_studio_option( 'interior_address_ar', 'interior_address_en', 'حي الهدا · المربع الدبلوماسي، الرياض' ) ); ?></span>
				</div>
				<div>
					<span class="luxe-meta-latin" data-i18n="curtain_line" style="display: block; margin-bottom: 0.5rem;">
						<?php echo $is_en ? 'Direct Concierge' : 'الخط المباشر'; ?>
					</span>
					<span data-i18n="curtain_line_val"><span dir="ltr"><?php echo esc_html( interior_get_studio_option( 'interior_phone', 'interior_phone', '+966 11 480 0000' ) ); ?></span><br><?php echo $is_en ? 'Executive Correspondence Bureau' : 'مكتب المراسلات المعتمد'; ?></span>
				</div>
				<div>
					<span class="luxe-meta-latin" data-i18n="curtain_hours_label" style="display: block; margin-bottom: 0.5rem;">
						<?php echo $is_en ? 'Private Sessions' : 'جلسات سرية خاصة'; ?>
					</span>
					<span data-i18n="curtain_hours_val"><?php echo $is_en ? 'Sun – Thu: 9:00 AM – 6:00 PM<br>Confidential Private Appointments' : 'الأحد - الخميس: 9:00 ص - 6:00 م<br>جلسات استشارية بخصوصية مطلقة'; ?></span>
				</div>
				<div>
					<span class="luxe-meta-latin" data-i18n="curtain_palette" style="display: block; margin-bottom: 0.5rem;">
						<?php echo $is_en ? 'Atmosphere Palette' : 'لوحة الأجواء المعمارية'; ?>
					</span>
					<div class="luxe-theme-switcher-wrap">
						<button type="button" class="luxe-theme-btn is-active" data-theme-target="noir" data-i18n="theme_noir" title="<?php echo $is_en ? 'Ink Noir Palette' : 'نمط الحبر الداكن'; ?>"><?php echo $is_en ? 'Ink Noir' : 'حبر داكن'; ?></button>
						<button type="button" class="luxe-theme-btn" data-theme-target="limestone" data-i18n="theme_limestone" title="<?php echo $is_en ? 'Limestone Palette' : 'نمط الحجر الجيري'; ?>"><?php echo $is_en ? 'Limestone' : 'حجر جيري'; ?></button>
						<button type="button" class="luxe-theme-btn" data-theme-target="bronze" data-i18n="theme_bronze" title="<?php echo $is_en ? 'Gulf Bronze Palette' : 'نمط البرونز الخليجي'; ?>"><?php echo $is_en ? 'Gulf Bronze' : 'برونز'; ?></button>
					</div>
				</div>
			</div>
		</div>
	</header>
