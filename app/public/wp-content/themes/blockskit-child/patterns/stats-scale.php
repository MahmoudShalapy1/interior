<?php
/**
 * Title: INTERIOR — مقاييس الإنجاز وحجم المشاريع (Stats & Scale)
 * Slug: blockskit-child/stats-scale
 * Categories: interior-narrative
 * Keywords: stats, scale, metrics, numbers
 *
 * @package Blockskit_Child
 */
?>

<?php
$stat_palaces = interior_get_studio_option( 'interior_stat_palaces', 'interior_stat_palaces_en', '+140' );
$stat_value   = interior_get_studio_option( 'interior_stat_value', 'interior_stat_value_en', '4,200' );
$stat_ontime  = interior_get_studio_option( 'interior_stat_ontime', 'interior_stat_ontime_en', '100%' );
$stat_awards  = interior_get_studio_option( 'interior_stat_awards', 'interior_stat_awards_en', '18' );
?>
<!-- Section 7.4: Monumental Stats & Scale -->
<section class="luxe-stats-section" id="scale">
	<div class="luxe-container">
		<div class="luxe-stats-grid">
			<!-- Metric 1: Palaces & Estates -->
			<div class="luxe-stat-card">
				<span class="luxe-stat-card__tag" data-i18n="stat_m1_tag">المعيار 01 سجل الإنجازات</span>
				<div class="luxe-stat-card__value">
					<span data-counter="140" data-prefix="+" data-i18n="stat_m1_num"><?php echo esc_html( $stat_palaces ); ?></span>
				</div>
				<div class="luxe-stat-card__label" data-i18n="stat_m1_label">
					قصراً وفيلا سيادية ملكية منجزة بأرقى المعايير العالمية في المملكة والخليج.
				</div>
			</div>

			<!-- Metric 2: Value & Scale -->
			<div class="luxe-stat-card">
				<span class="luxe-stat-card__tag" data-i18n="stat_m2_tag">المعيار 02 مساحة المشروع</span>
				<div class="luxe-stat-card__value">
					<span data-counter="4200" data-i18n="stat_m2_num"><?php echo esc_html( $stat_value ); ?></span>
				</div>
				<div class="luxe-stat-card__label" data-i18n="stat_m2_label">
					متوسط المسطحات المعمارية للمشروع الواحد مع السيطرة الإنشائية والتأثيث المتكامل.
				</div>
			</div>

			<!-- Metric 3: Budget Integrity (Justifying Price) -->
			<div class="luxe-stat-card">
				<span class="luxe-stat-card__tag" data-i18n="stat_m3_tag">المعيار 03 ضمان التكلفة والشفافية</span>
				<div class="luxe-stat-card__value">
					<span data-counter="100" data-suffix="%" data-i18n="stat_m3_num"><?php echo esc_html( $stat_ontime ); ?></span>
				</div>
				<div class="luxe-stat-card__label" data-i18n="stat_m3_label">
					التزام مالي صارم؛ صفر أوامر تغيير مفاجئة وصفر تكاليف غير محسوبة في العقد الشامل.
				</div>
			</div>

			<!-- Metric 4: Citations & Awards -->
			<div class="luxe-stat-card">
				<span class="luxe-stat-card__tag" data-i18n="stat_m4_tag">المعيار 04 استمرارية العملاء</span>
				<div class="luxe-stat-card__value">
					<span data-counter="18" data-i18n="stat_m4_num"><?php echo esc_html( $stat_awards ); ?></span>
				</div>
				<div class="luxe-stat-card__label" data-i18n="stat_m4_label">
					تكريماً دولياً واستشهاداً معمارياً في بينالي العمارة والمجلات المتخصصة.
				</div>
			</div>
		</div>
	</div>
</section>
