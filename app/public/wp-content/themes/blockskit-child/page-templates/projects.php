<?php
/**
 * Template Name: Luxury Projects Page
 * Description: Section 8.3: Asymmetric Architectural Masonry, Category Filter & Editorial List Switcher.
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
	<section class="luxe-hero" id="projects-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_hero_foyer.jpg' ); ?>" alt="<?php echo $is_en ? 'Archive of Architectural Masterpieces — INTERIOR' : 'أرشيف التحف المعمارية — إنتيريور'; ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title" data-i18n="proj_hero_title">
					<?php echo $is_en
						? 'Archive of <span class="luxe-accent-serif">Architectural Masterpieces</span> & Sovereign Palaces.'
						: 'أرشيف <span class="luxe-accent-serif">التحف المعمارية</span> والقصور السيادية.'; ?>
				</h1>

				<p class="luxe-hero__lead" data-i18n="proj_hero_lead">
					<?php echo $is_en
						? 'An exclusive curation of private residences and grand palaces executed to seven-star hotel hospitality standards in premier Riyadh and Gulf districts. Timeless estates, engineered to endure.'
						: 'مجموعة حصرية من المساكن الخاصة والقصور الكبرى المنفذة بأعلى معايير الإتقان الفندقي في أرقى أحياء الرياض والخليج العربي. مشاريع لا تتكرر، صُممت وبُنيت لتخلد.'; ?>
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span data-i18n="proj_hero_cta_brief"><?php echo $is_en ? 'Commission Private Architectural Study' : 'طلب دراسة معمارية خاصة'; ?></span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
					</a>
					<a href="#projects-grid" class="luxe-btn--text">
						<span data-i18n="proj_hero_cta_explore"><?php echo $is_en ? 'Explore Completed Archive' : 'تصفح الأرشيف والمشاريع المنجزة'; ?></span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. Portfolio Controls & Asymmetric Masonry Grid (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="projects-grid">
		<div class="luxe-container">
			
			<div class="luxe-portfolio-controls">
				<div class="luxe-filter-pills">
					<button type="button" class="luxe-portfolio-filter-btn is-active" data-filter="all" data-i18n="proj_filter_all"><?php echo $is_en ? 'All' : 'الكل'; ?></button>
					<button type="button" class="luxe-portfolio-filter-btn" data-filter="palace" data-i18n="proj_filter_palace"><?php echo $is_en ? 'Private Palaces' : 'قصور خاصة'; ?></button>
					<button type="button" class="luxe-portfolio-filter-btn" data-filter="villa" data-i18n="proj_filter_villa"><?php echo $is_en ? 'Architectural Villas' : 'فلل معمارية'; ?></button>
					<button type="button" class="luxe-portfolio-filter-btn" data-filter="penthouse" data-i18n="proj_filter_penthouse"><?php echo $is_en ? 'Sky Penthouses' : 'بنتهاوس'; ?></button>
					<button type="button" class="luxe-portfolio-filter-btn" data-filter="commercial" data-i18n="proj_filter_hospitality"><?php echo $is_en ? 'Hospitality Pavilions' : 'أجنحة ضيافة'; ?></button>
				</div>

				<div class="luxe-view-toggle-wrap">
					<button type="button" class="luxe-view-btn is-active" data-view="grid" title="<?php echo $is_en ? 'Architectural Grid View' : 'عرض الشبكة المعمارية'; ?>">
						<svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor">
							<rect x="1" y="1" width="6" height="6"/>
							<rect x="9" y="1" width="6" height="6"/>
							<rect x="1" y="9" width="6" height="6"/>
							<rect x="9" y="9" width="6" height="6"/>
						</svg>
						<span data-i18n="proj_view_grid"><?php echo $is_en ? 'Grid' : 'شبكة'; ?></span>
					</button>
					<button type="button" class="luxe-view-btn" data-view="list" title="<?php echo $is_en ? 'Technical List View' : 'عرض القائمة التحريرية'; ?>">
						<svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor">
							<rect x="1" y="2" width="14" height="2"/>
							<rect x="1" y="7" width="14" height="2"/>
							<rect x="1" y="12" width="14" height="2"/>
						</svg>
						<span data-i18n="proj_view_list"><?php echo $is_en ? 'Index List' : 'قائمة'; ?></span>
					</button>
				</div>
			</div>

			<?php
			$projects_query = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'DESC' ),
			) );
			?>

			<!-- Asymmetric Masonry Grid View -->
			<div class="luxe-portfolio-grid">
				<?php
				if ( $projects_query->have_posts() ) :
					while ( $projects_query->have_posts() ) :
						$projects_query->the_post();
						$p_id         = get_the_ID();
						$terms        = get_the_terms( $p_id, 'project_typology' );
						$cat_slug     = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'palace';
						$layout       = get_post_meta( $p_id, '_project_card_layout', true ) ?: 'wide';
						$p_title      = interior_get_project_title( $p_id );
						$p_loc        = interior_get_project_location( $p_id );
						$p_area       = interior_get_project_area( $p_id );
						$p_mats       = interior_get_project_materials( $p_id );
						$p_year       = interior_get_project_year( $p_id );
						$p_img        = interior_get_project_image( $p_id, 'hero' );
						$p_link       = get_permalink( $p_id );
						?>
						<a href="<?php echo esc_url( $p_link ); ?>" class="luxe-portfolio-card is-<?php echo esc_attr( $layout ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
							<div class="luxe-portfolio-card__img-wrap">
								<img src="<?php echo esc_url( $p_img ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="luxe-portfolio-card__img" loading="lazy" decoding="async" />
								<div class="luxe-portfolio-card__overlay">
									<span class="luxe-portfolio-card__badge"><?php echo esc_html( $p_loc ); ?></span>
									<h2 class="luxe-portfolio-card__title"><?php echo esc_html( $p_title ); ?></h2>
									<div class="luxe-portfolio-card__meta">
										<span><?php echo esc_html( $p_area ); ?></span>
										<span>&bull;</span>
										<span><?php echo esc_html( $p_mats ); ?></span>
										<span>&bull;</span>
										<span><?php echo esc_html( $p_year ); ?></span>
									</div>
								</div>
							</div>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>

			<!-- Tabular Editorial List View -->
			<div class="luxe-portfolio-list">
				<?php
				if ( $projects_query->have_posts() ) :
					while ( $projects_query->have_posts() ) :
						$projects_query->the_post();
						$p_id     = get_the_ID();
						$terms    = get_the_terms( $p_id, 'project_typology' );
						$cat_slug = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'palace';
						$p_title  = interior_get_project_title( $p_id );
						$p_loc    = interior_get_project_location( $p_id );
						$p_area   = interior_get_project_area( $p_id );
						$p_year   = interior_get_project_year( $p_id );
						$p_scope  = interior_get_project_scope( $p_id );
						$p_link   = get_permalink( $p_id );
						?>
						<a href="<?php echo esc_url( $p_link ); ?>" class="luxe-list-row" data-category="<?php echo esc_attr( $cat_slug ); ?>">
							<span class="luxe-list-row__title"><?php echo esc_html( $p_title ); ?></span>
							<span class="luxe-list-row__cell"><?php echo esc_html( $p_loc ); ?></span>
							<span class="luxe-list-row__cell"><?php echo esc_html( $p_area ); ?></span>
							<span class="luxe-list-row__cell"><?php echo esc_html( $p_year . ' · ' . $p_scope ); ?></span>
							<span class="luxe-list-row__arrow luxe-arrow-icon">←</span>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>

		</div>
	</section>

	<!-- 03. Call to Action Strip (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal" style="text-align: center; padding-block: clamp(6rem, 10vw, 10rem);">
		<div class="luxe-container">
			<span class="luxe-meta-latin" data-i18n="proj_cta_tag" style="display: block; margin-bottom: 0.75rem;">
				<?php echo $is_en ? 'Confidential Private Archive · Protected under Strict NDAs' : 'الخزنة السرية للمشاريع الخاصة · مشاريع محمية باتفاقيات سرية'; ?>
			</span>
			<h2 data-i18n="proj_cta_title" style="font-family: var(--font-heading); font-size: var(--text-4xl); margin-bottom: 1.5rem; color: var(--interior-bone);">
				<?php echo $is_en
					? 'Would you like to review our <span class="luxe-accent-serif">Confidential Palace Archive</span>?'
					: 'هل ترغب بالاطلاع على <span class="luxe-accent-serif">أرشيف المشاريع السرية</span>؟'; ?>
			</h2>
			<p data-i18n="proj_cta_desc" style="max-width: 680px; margin: 0 auto 3.5rem; color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.9;">
				<?php echo $is_en
					? 'We preserve over 40 presidential estates and private palaces that cannot be exhibited publicly out of discretion. Curation samples can be presented during your private studio consultation.'
					: 'نحتفظ بأكثر من 40 مشروعاً وقصراً رئاسياً لا يمكن نشرها علناً احتراماً لخصوصية الملاك. يمكن استعراض نماذج منها أثناء لقائك الخاص بالاستوديو.'; ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
				<span data-i18n="proj_cta_btn"><?php echo $is_en ? 'Request Access to Confidential Archive' : 'طلب استعراض الأرشيف السري'; ?></span>
				<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
			</a>
		</div>
	</section>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
