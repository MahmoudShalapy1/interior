<?php
/**
 * Title: INTERIOR — معرض المشاريع المختارة (Curated Runway RTL)
 * Slug: blockskit-child/horizontal-runway
 * Categories: interior-projects
 * Keywords: runway, horizontal, projects, gallery, rtl
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.6: Horizontal Curated Runway RTL -->
<section class="luxe-runway-section" id="runway">
	<div class="luxe-container luxe-runway-header">
		<div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 2rem;">
			<div>
				<span class="luxe-meta-latin" data-i18n="runway_tag" style="margin-bottom: 0.75rem;">الأعمال المختارة · مسار المشاريع السيادية</span>
				<h2 data-i18n="runway_title" style="font-size: var(--text-3xl); color: var(--interior-bone); margin: 0;">أعمالٌ لا تُنسخ.</h2>
			</div>
			<div style="display: flex; align-items: center; gap: 1.5rem;">
				<span class="luxe-meta-latin" data-i18n="runway_drag_hint" style="color: var(--interior-text-muted);">اسحب للتنقل الأفقي ←</span>
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" data-i18n="runway_all_btn" class="luxe-btn luxe-btn--ghost">كافة المشاريع</a>
			</div>
		</div>
	</div>

	<!-- Horizontal Viewport -->
	<div class="luxe-runway-viewport" data-cursor="explore">
		<div class="luxe-runway-track">
			<?php
			$runway_query = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => 6,
				'post_status'    => 'publish',
				'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'DESC' ),
			) );

			$item_classes = array(
				'luxe-runway-item--panoramic',
				'luxe-runway-item--portrait',
				'luxe-runway-item--square',
				'luxe-runway-item--cinematic',
				'luxe-runway-item--portrait',
				'luxe-runway-item--square',
			);

			if ( $runway_query->have_posts() ) :
				$idx = 0;
				while ( $runway_query->have_posts() ) :
					$runway_query->the_post();
					$r_id    = get_the_ID();
					$r_cls   = $item_classes[ $idx % count( $item_classes ) ];
					$r_title = interior_get_project_title( $r_id );
					$r_loc   = interior_get_project_location( $r_id );
					$r_year  = interior_get_project_year( $r_id );
					$r_area  = interior_get_project_area( $r_id );
					$r_scope = interior_get_project_scope( $r_id );
					$r_img   = interior_get_project_image( $r_id, 'hero' );
					$r_link  = get_permalink( $r_id );
					?>
					<article class="luxe-runway-item <?php echo esc_attr( $r_cls ); ?>">
						<a href="<?php echo esc_url( $r_link ); ?>" style="text-decoration: none; color: inherit; display: block;">
							<div class="luxe-runway-media">
								<img src="<?php echo esc_url( $r_img ); ?>" alt="<?php echo esc_attr( $r_title ); ?>" loading="lazy">
							</div>
							<div class="luxe-runway-meta-row">
								<h3 class="luxe-runway-title"><?php echo esc_html( $r_title ); ?></h3>
								<span class="luxe-meta-latin luxe-runway-meta"><?php echo esc_html( $r_loc . ' · ' . $r_year ); ?></span>
							</div>
							<div class="luxe-meta-latin luxe-runway-desc">
								<span class="luxe-runway-area"><?php echo esc_html( $r_area ); ?></span>
								<span class="luxe-runway-sep">·</span>
								<span class="luxe-runway-scope"><?php echo esc_html( $r_scope ); ?></span>
							</div>
						</a>
					</article>
					<?php
					$idx++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>
