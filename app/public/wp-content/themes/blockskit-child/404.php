<?php
/**
 * The template for displaying 404 pages (Not Found)
 * Section 8.6: Architectural 404 Blueprint Room.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/header-luxury' );
?>

	<!-- Section 8.6: Architectural 404 Empty Room -->
	<div class="luxe-404-canvas">
		<div class="luxe-404-grid-lines"></div>
		
		<!-- Coordinate crosshairs -->
		<div data-i18n="404_coords" style="position: absolute; top: 15%; right: 10%; font-family: var(--font-mono); font-size: 11px; color: rgba(80,120,160,0.5);">
			الإحداثيات: 24°42′42″ شمالاً • 46°40′30″ شرقاً
		</div>
		<div data-i18n="404_scale" style="position: absolute; bottom: 15%; left: 10%; font-family: var(--font-mono); font-size: 11px; color: rgba(80,120,160,0.5);">
			المنسوب: ±0.00 م • مقياس الرسم: 1:100
		</div>

		<div class="luxe-404-content">
			<div class="luxe-subtitle" style="color: #7db0dd; justify-content: center; margin-bottom: 0.5rem;">
				<span data-i18n="404_err_tag">خطأ // 404 • فراغ غير مخطط</span>
			</div>
			<div class="luxe-404-code" data-i18n="404_code">404</div>
			<h1 data-i18n="404_title" style="font-family: var(--font-heading); font-size: clamp(2rem, 3.5vw, 3rem); color: var(--interior-bone); line-height: 1.25; margin-bottom: 1.5rem;">
				هذا الفراغ <em>لم يتم تخطيطه بعد</em>
			</h1>
			<p data-i18n="404_desc" style="font-size: var(--text-base); color: var(--interior-text-secondary); line-height: 1.8; margin-bottom: 2.75rem;">
				يبدو أن الإحداثيات التي طلبتها خارج المخطط المعماري المعتمد. يمكنك العودة إلى البهو الرئيسي أو استعراض أرشيف الأعمال المنجزة.
			</p>
			<div style="display: flex; gap: 1.25rem; justify-content: center; flex-wrap: wrap;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="luxe-btn">
					<span data-i18n="404_btn_home">العودة للرئيسية</span>
					<span class="luxe-arrow-icon">←</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="luxe-btn" style="background: transparent; border-color: var(--interior-hairline); color: var(--interior-bone);">
					<span data-i18n="404_btn_archive">أرشيف المشاريع</span>
				</a>
			</div>
		</div>
	</div>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
