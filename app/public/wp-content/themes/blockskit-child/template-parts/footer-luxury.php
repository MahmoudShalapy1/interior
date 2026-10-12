<?php
/**
 * Luxury Footer Partial
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<!-- Luxury Footer -->
	<?php
	$is_en        = ( 'en' === ( function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar' ) );
	$studio_phone = interior_get_studio_option( 'interior_phone', 'interior_phone', '+966 11 480 0000' );
	$studio_addr  = interior_get_studio_option( 'interior_address_ar', 'interior_address_en', 'طريق الملك فهد، العليا، الرياض' );
	$license_info = interior_get_studio_option( 'interior_license_ar', 'interior_license_en', 'ترخيص معتمد للعمارة والتنفيذ السيادي' );
	?>
	<footer class="luxe-footer">
		<div class="luxe-container">

			<div class="luxe-footer-grid">
				<div class="luxe-footer-brand luxe-reveal luxe-reveal-up">
					<h2 data-i18n="brand_logo"><?php echo $is_en ? 'INTERIOR' : 'إنتيريور'; ?></h2>
					<p data-i18n="footer_brand_desc" style="max-width: 480px; font-size: var(--text-sm); line-height: 1.85; color: var(--interior-text-muted);">
						<?php echo $is_en ? 'A premier architectural studio specializing in sovereign luxury, bespoke palaces, and turn-key construction with single-point accountability.' : 'استوديو هندسي معماري رائد متخصص في صياغة الفخامة المعمارية وتنفيذ التحف السكنية والقصور الخاصة، مع تحمل كامل ومطلق للمسؤولية الهندسية والتنفيذية.'; ?>
					</p>
					<div style="display: flex; gap: 0.75rem; align-items: center; margin-top: 1.5rem;">
						<span style="display: inline-block; width: 6px; height: 6px; background: var(--interior-brass); border-radius: 50%;"></span>
						<span class="luxe-meta-latin" data-i18n="footer_badge" style="font-size: 11px; color: var(--interior-brass-light);">
							<?php echo esc_html( $license_info ); ?>
						</span>
					</div>
				</div>

				<div class="luxe-footer-col luxe-reveal luxe-reveal-up" data-luxe-delay="100">
					<h3 data-i18n="footer_hq_title"><?php echo $is_en ? 'Headquarters' : 'المقر الرئيسي'; ?></h3>
					<p data-i18n="footer_hq_desc" style="font-size: 0.95rem; line-height: 2.1;">
						<?php echo esc_html( $studio_addr ); ?><br>
						<?php echo $is_en ? 'Studio Dossiers: Direct private submission' : 'مراسلات الاستوديو: متاحة عبر الملف الخاص المعتمد'; ?><br>
						<span dir="ltr"><?php echo esc_html( $studio_phone ); ?></span>
					</p>
				</div>

				<div class="luxe-footer-col luxe-reveal luxe-reveal-up" data-luxe-delay="200">
					<h3 data-i18n="footer_nav_title"><?php echo $is_en ? 'Studio Archive' : 'أقسام الموقع'; ?></h3>
					<ul class="luxe-footer-links">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-i18n="nav_home"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" data-i18n="nav_about"><?php echo $is_en ? 'About Studio' : 'عن الاستوديو'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" data-i18n="nav_services"><?php echo $is_en ? 'Services Ecosystem' : 'منظومة الخدمات'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/approach/' ) ); ?>" data-i18n="nav_approach"><?php echo $is_en ? 'Approach & Investment' : 'المنهج والاستثمار'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" data-i18n="nav_projects"><?php echo $is_en ? 'Projects Archive' : 'أرشيف المشاريع'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" data-i18n="nav_journal"><?php echo $is_en ? 'Architectural Monographs' : 'المقالات والأبحاث'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" data-i18n="nav_contact"><?php echo $is_en ? 'Private Dossier & Contact' : 'الملف الخاص والتواصل'; ?></a></li>
					</ul>
				</div>

				<!-- Sovereign Architectural Monographs Dofollow Links (High-Authority Internal Architecture) -->
				<div class="luxe-footer-col luxe-reveal luxe-reveal-up" data-luxe-delay="250">
					<h3 data-i18n="footer_monographs_title"><?php echo $is_en ? 'Sovereign Monographs' : 'المونوغرافات المعمارية'; ?></h3>
					<ul class="luxe-footer-links">
						<?php
						$footer_projects = get_posts( array(
							'post_type'      => 'project',
							'post_status'    => 'publish',
							'posts_per_page' => 6,
							'orderby'        => 'date',
							'order'          => 'DESC',
						) );
						foreach ( $footer_projects as $fp ) :
							$fp_title_ar = get_the_title( $fp->ID );
							$fp_title_en = get_post_meta( $fp->ID, '_project_title_en', true ) ?: $fp_title_ar;
							$fp_url      = get_permalink( $fp->ID );
						?>
							<li><a href="<?php echo esc_url( $fp_url ); ?>" title="<?php echo esc_attr( $is_en ? $fp_title_en : $fp_title_ar ); ?>"><?php echo esc_html( $is_en ? $fp_title_en : $fp_title_ar ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="luxe-footer-col luxe-reveal luxe-reveal-up" data-luxe-delay="300">
					<h3 data-i18n="footer_hours_title"><?php echo $is_en ? 'Private Protocol' : 'ساعات الاستقبال الخاصة'; ?></h3>
					<p data-i18n="footer_hours_desc" style="font-size: 0.95rem; line-height: 2;">
						<?php echo $is_en ? 'Sunday – Thursday: 9:00 AM – 6:00 PM<br>Private sessions require pre-arranged scheduling to guarantee absolute client discretion.' : 'الأحد - الخميس: 9:00 ص - 6:00 م<br>جلسات الاستشارة الخاصة تتطلب حجزاً مسبقاً لضمان الخصوصية التامة.'; ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" data-i18n="footer_vip_btn" class="luxe-btn luxe-btn-ghost" style="padding: 0.6rem 1.4rem; font-size: 0.85rem; margin-top: 1rem;">
						<?php echo $is_en ? 'Schedule Private Consultation' : 'حجز موعد استشاري خاص'; ?>
					</a>
				</div>
			</div>

			<div class="luxe-footer-bottom">
				<div data-i18n="footer_copyright">
					<?php echo $is_en
						? 'All rights reserved &copy; ' . esc_html( date( 'Y' ) ) . ' INTERIOR Architecture & Luxury Fit-Out.'
						: 'جميع الحقوق محفوظة &copy; ' . esc_html( date( 'Y' ) ) . ' إنتيريور للعمارة والتشطيب الفاخر.'; ?>
				</div>
				<div style="display: flex; gap: 1.5rem;">
					<a href="<?php echo esc_url( home_url( '/approach/#standards' ) ); ?>" data-i18n="footer_privacy" style="color: inherit; text-decoration: none;">
						<?php echo $is_en ? 'Privacy Charter' : 'سياسة الخصوصية'; ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/approach/#standards' ) ); ?>" data-i18n="footer_terms" style="color: inherit; text-decoration: none;">
						<?php echo $is_en ? 'Quality Charter & Warranty' : 'ميثاق الجودة والضمان'; ?>
					</a>
				</div>
			</div>
		</div>
	</footer>

	<?php
	$wa_num = preg_replace( '/[^0-9]/', '', interior_get_studio_option( 'interior_whatsapp', 'interior_whatsapp', '966501234567' ) );
	$wa_msg = ( 'en' === ( function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar' ) ) ? 'Hello, I would like to request a private architectural consultation with INTERIOR Studio.' : 'مرحباً، أود حجز استشارة خاصة لدى استوديو إنتيريور المعماري';
	?>
	<!-- Mobile Sticky Luxury Action Bar (Section 9) -->
	<aside class="luxe-mobile-action-bar" aria-label="<?php echo $is_en ? 'Mobile Quick Action Bar' : 'إجراءات التواصل السريع على الموبايل'; ?>">
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid luxe-mobile-btn">
			<span data-i18n="mobile_brief_btn"><?php echo $is_en ? 'Commission Study' : 'طلب دراسة خاصة'; ?></span>
			<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
		</a>
		<a href="https://wa.me/<?php echo esc_attr( $wa_num ); ?>?text=<?php echo rawurlencode( $wa_msg ); ?>" target="_blank" rel="nofollow noopener noreferrer" class="luxe-btn luxe-btn--ghost luxe-mobile-btn" style="border-color: #25D366; color: #25D366;">
			<span data-i18n="mobile_wa_btn"><?php echo $is_en ? 'Studio Concierge' : 'واتساب الإدارة'; ?></span>
		</a>
	</aside>

	<!-- Floating Concierge WhatsApp Action Button -->
	<a href="https://wa.me/<?php echo esc_attr( $wa_num ); ?>?text=<?php echo rawurlencode( $wa_msg ); ?>" target="_blank" rel="nofollow noopener noreferrer" class="luxe-whatsapp-float" aria-label="<?php echo $is_en ? 'Confidential WhatsApp Consultation' : 'استشارة خاصة عبر واتساب'; ?>">
		<div class="luxe-whatsapp-float__icon">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
			</svg>
		</div>
		<span class="luxe-whatsapp-float__text" data-i18n="whatsapp_label"><?php echo $is_en ? 'Confidential WhatsApp Concierge' : 'استشارة خاصة عبر واتساب'; ?></span>
	</a>

	<?php wp_footer(); ?>
</body>
</html>
