<?php
/**
 * Title: INTERIOR — ركائز السيطرة والخدمات المعمارية (Services Pillars)
 * Slug: blockskit-child/services-pillars
 * Categories: interior-execution
 * Keywords: services, architecture, fit-out, interior, turnkey, design
 * Description: الركائز الثلاث للسيطرة المعمارية والتنفيذ الشامل من الخط إلى المفتاح
 *
 * @package Blockskit_Child
 */
?>

<!-- Section 7.9: Services Deep Dive & Turnkey Pillars -->
<section class="luxe-pillars-section" id="services">
	<div class="luxe-container">
		<!-- Section Header -->
		<div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 2rem;">
			<div style="max-width: 760px;">
				<span class="luxe-meta-latin" data-i18n="services_tag" style="display: block; margin-bottom: 0.75rem;">06 · السيطرة الشاملة والمسؤولية الكاملة</span>
				<h2 data-i18n="services_title" style="font-size: var(--text-3xl); color: var(--interior-bone); margin-bottom: 1rem;">
					منظومة واحدة، مسؤولية مطلقة.
				</h2>
				<p data-i18n="services_desc" style="font-size: var(--text-base); color: var(--interior-text-muted); line-height: 1.8; margin: 0;">
					السبب الذي يجعل مشاريعنا خالية من التشوهات هو أننا لا نجزئ العمل. نحن نتحمل كامل المسؤولية الفنية والزمنية والمالية عبر ثلاث ركائز لا تنفصل.
				</p>
			</div>

			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" data-i18n="services_guide_btn" class="luxe-btn luxe-btn--ghost">
				دليل الخدمات الكامل
			</a>
		</div>

		<!-- 3 Pillars Grid -->
		<div class="luxe-pillars-grid">
			<?php
			$pillars_query = new WP_Query( array(
				'post_type'      => 'service',
				'posts_per_page' => 3,
				'post_status'    => 'publish',
				'orderby'        => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
			) );

			$lang = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
			$pillar_tags = array(
				1 => array( 'ar' => 'الركيزة الأولى · التصميم المعماري والداخلي', 'en' => 'Pillar 01 · Sovereign Architecture & Spatial Planning' ),
				2 => array( 'ar' => 'الركيزة الثانية · المقاولات والتشطيب الفاخر', 'en' => 'Pillar 02 · Turnkey General Contracting & Fit-Out' ),
				3 => array( 'ar' => 'الركيزة الثالثة · التوريد الحصري والتأثيث', 'en' => 'Pillar 03 · Bespoke Millwork & Art Curation' ),
			);

			if ( $pillars_query->have_posts() ) :
				$p_idx = 1;
				while ( $pillars_query->have_posts() ) :
					$pillars_query->the_post();
					$s_id    = get_the_ID();
					$s_title = ( 'en' === $lang ) ? ( get_post_meta( $s_id, '_service_title_en', true ) ?: get_the_title( $s_id ) ) : get_the_title( $s_id );
					$s_desc  = ( 'en' === $lang ) ? ( get_post_meta( $s_id, '_service_desc_en', true ) ?: get_the_excerpt( $s_id ) ) : get_the_excerpt( $s_id );
					$tag_str = ( 'en' === $lang ) ? ( $pillar_tags[ $p_idx ]['en'] ?? 'Pillar 0' . $p_idx ) : ( $pillar_tags[ $p_idx ]['ar'] ?? 'الركيزة 0' . $p_idx );
					?>
					<div class="luxe-pillar-card">
						<div class="luxe-pillar-header">
							<span class="luxe-pillar-num" data-i18n="pillar_<?php echo $p_idx; ?>_num"><?php echo esc_html( $tag_str ); ?></span>
							<h3 class="luxe-pillar-title" data-i18n="pillar_<?php echo $p_idx; ?>_title"><?php echo esc_html( $s_title ); ?></h3>
							<p class="luxe-pillar-desc" data-i18n="pillar_<?php echo $p_idx; ?>_desc">
								<?php echo esc_html( $s_desc ); ?>
							</p>
						</div>
					</div>
					<?php
					$p_idx++;
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<!-- Fallback Pillar I -->
				<div class="luxe-pillar-card">
					<div class="luxe-pillar-header">
						<span class="luxe-pillar-num" data-i18n="pillar_1_num">الركيزة الأولى · التصميم المعماري والداخلي</span>
						<h3 class="luxe-pillar-title" data-i18n="pillar_1_title">التصميم المعماري والداخلي السيادي</h3>
						<p class="luxe-pillar-desc" data-i18n="pillar_1_desc">
							توزيع فراغي دقيق، دراسات كتلية وسينوغرافيا إضاءة متطورة، ومخططات تنفيذية تفصيلية.
						</p>
					</div>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
