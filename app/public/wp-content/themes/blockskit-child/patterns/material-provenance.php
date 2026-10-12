<?php
/**
 * Title: INTERIOR — مصادر الخامات الحصرية (Material Provenance)
 * Slug: blockskit-child/material-provenance
 * Categories: interior-execution
 * Keywords: materials, marble, travertine, bronze, walnut, provenance, luxury
 * Description: مكتبة الخامات النادرة ومصادر التوريد المباشرة من المحاجر والمصاهر الأوروبية
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.10: Material Provenance & Rare Slabs -->
<section class="luxe-materials-section" id="materials">
	<div class="luxe-container">
		<!-- Section Header -->
		<div style="max-width: 820px;">
			<span class="luxe-meta-latin" data-i18n="mat_tag" style="display: block; margin-bottom: 0.75rem;">07 · مكتبة الخامات والمصادر الحصرية النادرة</span>
			<h2 data-i18n="mat_title" style="font-size: var(--text-3xl); color: var(--interior-bone); margin-bottom: 1.25rem;">
				أصالة الخامة: لا نستخدم البدائل المصنّعة.
			</h2>
			<p data-i18n="mat_desc" style="font-size: var(--text-base); color: var(--interior-text-muted); line-height: 1.8; margin: 0;">
				الفخامة السيادية لا تولد من التقليد أو البدائل التجارية؛ بل من كتل حجرية تستخرج خصيصاً لمشروعك من جبال توسكانا، أو خشب جوز معتّق بعناية. نحن نسافر إلى المحاجر ونختار ألواح الرخام لوحاً بلوح قبل التوريد.
			</p>
		</div>

		<!-- 4 Materials Grid -->
		<div class="luxe-materials-grid">
			<?php
			$materials_query = new WP_Query( array(
				'post_type'      => 'material',
				'posts_per_page' => 4,
				'post_status'    => 'publish',
				'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
			) );

			if ( $materials_query->have_posts() ) :
				$m_idx = 1;
				while ( $materials_query->have_posts() ) :
					$materials_query->the_post();
					$mat_id     = get_the_ID();
					$mat_name   = interior_get_material_name( $mat_id );
					$mat_origin = interior_get_material_origin( $mat_id );
					$mat_desc   = interior_get_material_desc( $mat_id );
					$mat_img    = interior_get_material_image( $mat_id );
					?>
					<div class="luxe-material-card">
						<div class="luxe-material-media">
							<img src="<?php echo esc_url( $mat_img ); ?>" alt="<?php echo esc_attr( $mat_name ); ?>" loading="lazy" decoding="async">
						</div>
						<div class="luxe-material-body">
							<div>
								<span class="luxe-material-origin" data-i18n="mat_m<?php echo $m_idx; ?>_origin"><?php echo esc_html( $mat_origin ); ?></span>
								<h3 class="luxe-material-name" data-i18n="mat_m<?php echo $m_idx; ?>_name"><?php echo esc_html( $mat_name ); ?></h3>
								<p class="luxe-material-desc" data-i18n="mat_m<?php echo $m_idx; ?>_desc">
									<?php echo esc_html( $mat_desc ); ?>
								</p>
							</div>
						</div>
					</div>
					<?php
					$m_idx++;
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<!-- Fallback Material 1 -->
				<div class="luxe-material-card">
					<div class="luxe-material-media">
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_mat_calacatta_viola.jpg' ); ?>" alt="رخام كالاكاتا فيولا الإيطالي" loading="lazy">
					</div>
					<div class="luxe-material-body">
						<div>
							<span class="luxe-material-origin" data-i18n="mat_m1_origin">محاجر كرارا · توسكانا، إيطاليا</span>
							<h3 class="luxe-material-name" data-i18n="mat_m1_name">رخام كالاكاتا فيولا</h3>
							<p class="luxe-material-desc" data-i18n="mat_m1_desc">تعريقات نبيذية نادرة على خلفية بيضاء نقية، مقطوعة بنمط الفراشة المتناظر.</p>
						</div>
					</div>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
