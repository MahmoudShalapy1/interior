<?php
/**
 * Title: INTERIOR — خزنة المشاريع السرية (Confidential Vault)
 * Slug: blockskit-child/confidential-vault
 * Categories: interior-projects
 * Keywords: vault, confidential, nda, private, palaces
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<!-- Section 7.5: Confidential Vault — Wow #3 -->
<section class="luxe-vault-section" id="vault">
	<div class="luxe-container">
		<div class="luxe-vault-header">
			<div>
				<span class="luxe-meta-latin" data-i18n="vault_header_tag" style="margin-bottom: 0.75rem;">الأرشيف المصنف · الخزنة السرية</span>
				<h2 data-i18n="vault_title" style="font-size: var(--text-3xl); color: var(--interior-bone); margin-bottom: 0.75rem;">
					مشاريع تحت اتفاقيات سرية مشددة.
				</h2>
				<p data-i18n="vault_desc" style="color: var(--interior-text-muted); font-size: var(--text-base); max-width: 54ch; margin: 0; line-height: 1.8;">
					أكثر من 60٪ من قصورنا المنفذة تخضع لاتفاقيات عدم إفصاح صارمة ومحمية قانونياً احتراماً لخصوصية العائلات الملكية والشخصيات السيادية.
				</p>
			</div>
			<div>
				<a href="#funnel" class="luxe-btn luxe-btn--ghost">
					<span data-i18n="vault_cta">طلب استعراض خاص في جلسة مغلقة</span>
					<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;">←</span>
				</a>
			</div>
		</div>

		<!-- 3 Classified Sovereign Project Cards -->
		<div class="luxe-vault-grid">
			<!-- Classified Card 1 -->
			<div class="luxe-vault-card">
				<div class="luxe-vault-frame">
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_master_suite.jpg' ); ?>" alt="مشروع قصر ملكي سري" loading="lazy">
					
					<div class="luxe-vault-tape luxe-vault-tape--1" data-i18n="vault_c1_tape1">
						سري للغاية · إقامة سيادية · درجة سرية فائقة
					</div>
					<div class="luxe-vault-tape luxe-vault-tape--2" data-i18n="vault_c1_tape2">
						مواصفات مصنفة ومحمية · الرياض
					</div>

					<div class="luxe-vault-overlay">
						<svg class="luxe-vault-lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
							<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
						</svg>
						<span class="luxe-vault-status-pill" data-i18n="vault_status">الحالة: ملف مصنف</span>
						<div class="luxe-vault-notice" data-i18n="vault_notice">متاح للعرض في جلسة استشارية خاصة ومغلقة</div>
					</div>
				</div>
				<div class="luxe-vault-info">
					<h3 class="luxe-vault-name" data-i18n="vault_c1_name">قصر خاص — الرياض</h3>
					<div class="luxe-vault-meta" data-i18n="vault_c1_meta">4,200 م² · تسليم مفتاح شامل · إنجاز 2024</div>
				</div>
			</div>

			<!-- Classified Card 2 -->
			<div class="luxe-vault-card">
				<div class="luxe-vault-frame">
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_palace_courtyard.jpg' ); ?>" alt="مشروع إقامة سيادية سرية" loading="lazy">
					
					<div class="luxe-vault-tape luxe-vault-tape--1" data-i18n="vault_c2_tape1">
						سري للغاية · قصر خاص · درجة سرية فائقة
					</div>
					<div class="luxe-vault-tape luxe-vault-tape--2" data-i18n="vault_c2_tape2">
						مواصفات مصنفة ومحمية · دبي
					</div>

					<div class="luxe-vault-overlay">
						<svg class="luxe-vault-lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
							<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
						</svg>
						<span class="luxe-vault-status-pill" data-i18n="vault_status">الحالة: ملف مصنف</span>
						<div class="luxe-vault-notice" data-i18n="vault_notice">متاح للعرض في جلسة استشارية خاصة ومغلقة</div>
					</div>
				</div>
				<div class="luxe-vault-info">
					<h3 class="luxe-vault-name" data-i18n="vault_c2_name">إقامة سيادية — دبي</h3>
					<div class="luxe-vault-meta" data-i18n="vault_c2_meta">6,800 م² · تصميم معماري وتنفيذ متكامل · 2025</div>
				</div>
			</div>

			<!-- Classified Card 3 -->
			<div class="luxe-vault-card">
				<div class="luxe-vault-frame">
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/luxe_sky_penthouse.jpg' ); ?>" alt="مشروع بنتهاوس ملكي سري" loading="lazy">
					
					<div class="luxe-vault-tape luxe-vault-tape--1" data-i18n="vault_c3_tape1">
						سري للغاية · بنتهاوس سيادي · درجة سرية فائقة
					</div>
					<div class="luxe-vault-tape luxe-vault-tape--2" data-i18n="vault_c3_tape2">
						مواصفات مصنفة ومحمية · لندن
					</div>

					<div class="luxe-vault-overlay">
						<svg class="luxe-vault-lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
							<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
						</svg>
						<span class="luxe-vault-status-pill" data-i18n="vault_status">الحالة: ملف مصنف</span>
						<div class="luxe-vault-notice" data-i18n="vault_notice">متاح للعرض في جلسة استشارية خاصة ومغلقة</div>
					</div>
				</div>
				<div class="luxe-vault-info">
					<h3 class="luxe-vault-name" data-i18n="vault_c3_name">بنتهاوس حصري — لندن</h3>
					<div class="luxe-vault-meta" data-i18n="vault_c3_meta">3,100 م² · تأثيث وتشطيب مخصص · 2025</div>
				</div>
			</div>
		</div>
	</div>
</section>
