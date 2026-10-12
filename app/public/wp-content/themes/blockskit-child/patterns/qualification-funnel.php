<?php
/**
 * Title: INTERIOR — استمارة التأهيل والدراسة المعمارية المغلقة (Qualification Funnel)
 * Slug: blockskit-child/qualification-funnel
 * Categories: interior-conversion
 * Keywords: contact, funnel, consultation, qualify, brief, form, luxury
 * Description: استمارة التأهيل وحجز الجلسة الاستشارية المغلقة لدراسة المشاريع السيادية
 *
 * @package Blockskit_Child
 */
?>

<!-- Section 7.14: The Architectural Brief Funnel -->
<section class="luxe-funnel-section" id="funnel">
	<div class="luxe-container">
		<div class="luxe-funnel-wrapper">
			<div class="luxe-funnel-header">
				<span class="luxe-meta-latin" data-i18n="funnel_tag" style="display: block; margin-bottom: 0.75rem;">10 · بروتوكول طلب الدراسة المعمارية المغلقة</span>
				<h2 data-i18n="funnel_title" style="font-size: var(--text-2xl); color: var(--interior-bone); margin-bottom: 1rem;">
					طلب دراسة معمارية ومفاضلة فنية مغلقة.
				</h2>
				<p data-i18n="funnel_desc" style="font-size: var(--text-sm); color: var(--interior-text-muted); max-width: 600px; margin: 0 auto; line-height: 1.8;">
					تفضل بتحديد معالم مشروعك ليقوم مكتب كبير المعماريين بدراسة الأهلية والتواصل المباشر مع سعادتكم لترتيب جلسة استشارية خاصة.
				</p>
			</div>

			<!-- Form Container -->
			<form id="luxe-qualification-form" class="luxe-funnel-form" method="post" action="#">
				<!-- Step 1: Property Type Pills -->
				<div class="luxe-funnel-form-group">
					<label class="luxe-funnel-label" data-i18n="funnel_step1_label">01 · نوع المنشأة العقارية</label>
					<div class="luxe-funnel-pills" data-target-input="funnel-property-type">
						<button type="button" class="luxe-funnel-pill is-active" data-value="قصر سيادي مستقل" data-i18n="funnel_p_palace">قصر سيادي مستقل</button>
						<button type="button" class="luxe-funnel-pill" data-value="فيلا ملكية خاصة" data-i18n="funnel_p_villa">فيلا ملكية خاصة</button>
						<button type="button" class="luxe-funnel-pill" data-value="سكاي بنتهاوس فاخر" data-i18n="funnel_p_penthouse">سكاي بنتهاوس فاخر</button>
						<button type="button" class="luxe-funnel-pill" data-value="إقامة دبلوماسية / مجمع" data-i18n="funnel_p_compound">إقامة دبلوماسية / مجمع</button>
					</div>
					<input type="hidden" id="funnel-property-type" name="property_type" value="قصر سيادي مستقل">
				</div>

				<!-- Step 2: Estimated Scale Pills -->
				<div class="luxe-funnel-form-group">
					<label class="luxe-funnel-label" data-i18n="funnel_step2_label">02 · المساحة الإجمالية التقديرية للمشروع</label>
					<div class="luxe-funnel-pills" data-target-input="funnel-property-scale">
						<button type="button" class="luxe-funnel-pill is-active" data-value="1,500 م² - 3,000 م²" data-i18n="funnel_scale_1">1,500 م² — 3,000 م²</button>
						<button type="button" class="luxe-funnel-pill" data-value="3,000 م² - 5,000 م²" data-i18n="funnel_scale_2">3,000 م² — 5,000 م²</button>
						<button type="button" class="luxe-funnel-pill" data-value="+5,000 م² فأكثر" data-i18n="funnel_scale_3">+5,000 م² فأكثر</button>
					</div>
					<input type="hidden" id="funnel-property-scale" name="property_scale" value="1,500 م² - 3,000 م²">
				</div>

				<!-- Step 3: Required Scope Pills -->
				<div class="luxe-funnel-form-group">
					<label class="luxe-funnel-label" data-i18n="funnel_step3_label">03 · نطاق العمل والمسؤولية المطلوبة</label>
					<div class="luxe-funnel-pills" data-target-input="funnel-property-scope">
						<button type="button" class="luxe-funnel-pill is-active" data-value="تسليم مفتاح شامل (تصميم + تشطيب + تأثيث)" data-i18n="funnel_scope_turnkey">تسليم مفتاح شامل (تصميم + تشطيب + تأثيث)</button>
						<button type="button" class="luxe-funnel-pill" data-value="تشطيب فاخر وتأثيث حصري" data-i18n="funnel_scope_fitout">تشطيب فاخر وتأثيث حصري</button>
						<button type="button" class="luxe-funnel-pill" data-value="تصميم معماري وداخلي وإشراف سيادي" data-i18n="funnel_scope_design">تصميم معماري وداخلي وإشراف سيادي</button>
					</div>
					<input type="hidden" id="funnel-property-scope" name="property_scope" value="تسليم مفتاح شامل (تصميم + تشطيب + تأثيث)">
				</div>

				<!-- Step 4: Contact Details (Two-column layout) -->
				<div class="luxe-funnel-row">
					<div class="luxe-funnel-form-group">
						<label class="luxe-funnel-label" for="client-name" data-i18n="funnel_name_label">اللقب والاسم الكريم *</label>
						<input type="text" id="client-name" name="client_name" class="luxe-funnel-input" placeholder="سعادة / أستاذ..." data-i18n-placeholder="funnel_name_ph" required>
					</div>
					<div class="luxe-funnel-form-group">
						<label class="luxe-funnel-label" for="client-phone" data-i18n="funnel_phone_label">رقم الهاتف (واتساب مشفر) *</label>
						<input type="tel" id="client-phone" name="client_phone" class="luxe-funnel-input" placeholder="+966 5..." data-i18n-placeholder="funnel_phone_ph" required>
					</div>
				</div>

				<div class="luxe-funnel-row">
					<div class="luxe-funnel-form-group">
						<label class="luxe-funnel-label" for="client-location" data-i18n="funnel_loc_label">موقع المشروع (المدينة والحي)</label>
						<input type="text" id="client-location" name="client_location" class="luxe-funnel-input" placeholder="الرياض، حطين / النرجس..." data-i18n-placeholder="funnel_loc_ph">
					</div>
					<div class="luxe-funnel-form-group">
						<label class="luxe-funnel-label" for="client-timeline" data-i18n="funnel_time_label">الموعد المستهدف للبدء</label>
						<select id="client-timeline" name="client_timeline" class="luxe-funnel-select">
							<option value="فوري" data-i18n="funnel_time_now">بدء فوري خلال هذا الشهر</option>
							<option value="خلال 3 أشهر" data-i18n="funnel_time_3m">خلال 3 أشهر (الربع القادم)</option>
							<option value="خلال 6 أشهر" data-i18n="funnel_time_6m">خلال 6 أشهر</option>
						</select>
					</div>
				</div>

				<!-- Discretion Note -->
				<div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; color: var(--interior-text-muted); font-size: var(--text-xs);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink: 0; color: var(--interior-brass);">
						<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
						<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
					</svg>
					<span data-i18n="funnel_discretion_note">بيانات مشروعكم مشفرة ومحمية ببروتوكول السرية المهنية واتفاقية عدم الإفصاح المسبقة المصونة قانونياً.</span>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="luxe-btn luxe-btn--primary" style="width: 100%; justify-content: center; padding-block: 1.25rem;">
					<span data-i18n="funnel_submit_btn">إرسال طلب الدراسة المغلقة</span>
					<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 13px;">←</span>
				</button>

				<div class="luxe-funnel-footer" style="margin-top: 1.5rem; text-align: center;">
					<span class="luxe-meta-latin" data-i18n="funnel_security_ref" style="font-size: 11px; color: var(--interior-text-muted);">
						ملف التكليف السري #سجل-2026-المعتمد
					</span>
				</div>
			</form>

			<!-- Success Confirmation Card -->
			<div id="luxe-qualification-success" style="display: none; text-align: center; padding: 3.5rem 2rem; background: rgba(197, 160, 89, 0.04); border: 1px solid rgba(197, 160, 89, 0.25); border-radius: 4px; margin-top: 1rem;">
				<div style="width: 56px; height: 56px; margin: 0 auto 1.5rem; border-radius: 50%; background: rgba(197, 160, 89, 0.15); display: flex; align-items: center; justify-content: center; color: var(--interior-brass);">
					<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
				</div>
				<h3 data-i18n="funnel_success_title" style="font-size: var(--text-xl); color: var(--interior-bone); margin-bottom: 0.75rem;">
					تم قيد الأضبارة وتأكيد التشفير المعماري بنجاح
				</h3>
				<p data-i18n="funnel_success_desc" style="color: var(--interior-text-muted); font-size: var(--text-sm); max-width: 540px; margin: 0 auto 1.75rem; line-height: 1.9;">
					تم تسجيل تفاصيل مشروعكم بصيغة مشفرة لدى مكتب الإدارة الهندسية والشريك المؤسس. سيقوم كبير المعماريين بالتواصل المباشر مع سعادتكم لترتيب الجلسة الاستشارية الخاصة.
				</p>
				<div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.25rem; border: 1px dashed rgba(197, 160, 89, 0.35); font-family: var(--font-mono); font-size: 12px; color: var(--interior-brass); background: rgba(0, 0, 0, 0.2);">
					<span data-i18n="funnel_success_ref">كود المتابعة السيادي:</span>
					<strong id="luxe-qualification-ref-code"><?php echo ( function_exists( 'interior_get_current_lang' ) && 'en' === interior_get_current_lang() ) ? '#DOSSIER-2026-VERIFIED' : '#ملف-2026-معتمد'; ?></strong>
				</div>
			</div>
		</div>
	</div>
</section>
