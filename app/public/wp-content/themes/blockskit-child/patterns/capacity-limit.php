<?php
/**
 * Annual Capacity Limit - DISABLED per user request.
 */
return;
?>
	<div class="luxe-container">
		<div class="luxe-capacity-box">
			<div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 2rem;">
				<div style="max-width: 680px;">
					<span class="luxe-meta-latin" data-i18n="cap_tag" style="display: block; margin-bottom: 0.75rem; color: var(--interior-brass-light);">
						10 · سياسة السعة الحصرية السنوية
					</span>
					<h2 data-i18n="cap_title" style="font-size: var(--text-2xl); color: var(--interior-bone); margin-bottom: 1rem;">
						نقبل فقط 4 مشاريع كبرى سنوياً.
					</h2>
					<p data-i18n="cap_desc" style="font-size: var(--text-base); color: var(--interior-text-muted); line-height: 1.8; margin: 0;">
						الجودة الاستثنائية لا تقبل التوسع الكمي. لضمان تواجد الشركاء المؤسسين وكبير المعماريين شخصياً في موقع مشروعك أسبوعياً، نلتزم بسقف صارم لا يتجاوز أربعة قصور ومشاريع في العام الواحد.
					</p>
				</div>

				<div style="text-align: end;">
					<span class="luxe-meta-latin" data-i18n="cap_status_label" style="display: block; color: var(--interior-brass-light); margin-bottom: 0.25rem;">حالة السعة والشاغر السنوي</span>
					<span data-i18n="cap_year" style="font-family: var(--font-mono); font-size: 1.25rem; color: var(--interior-bone);">سنة 2026 التقديرية</span>
				</div>
			</div>

			<!-- 4 Quarters Status Grid -->
			<div class="luxe-capacity-quarters">
				<!-- Q1 -->
				<div class="luxe-quarter-card is-closed">
					<div>
						<span class="luxe-quarter-tag" data-i18n="cap_q1_tag">الربع الأول</span>
						<div class="luxe-quarter-status">
							<span class="luxe-status-dot luxe-status-dot--red"></span>
							<span data-i18n="cap_closed">مغلق بالكامل</span>
						</div>
					</div>
					<span data-i18n="cap_q1_project" style="font-family: var(--font-mono); font-size: 10px; color: var(--interior-text-muted); margin-top: 1rem;">قصر اليمامة · الرياض</span>
				</div>

				<!-- Q2 -->
				<div class="luxe-quarter-card is-closed">
					<div>
						<span class="luxe-quarter-tag" data-i18n="cap_q2_tag">الربع الثاني</span>
						<div class="luxe-quarter-status">
							<span class="luxe-status-dot luxe-status-dot--red"></span>
							<span data-i18n="cap_closed">مغلق بالكامل</span>
						</div>
					</div>
					<span data-i18n="cap_q2_project" style="font-family: var(--font-mono); font-size: 10px; color: var(--interior-text-muted); margin-top: 1rem;">إقامة السفراء · الرياض</span>
				</div>

				<!-- Q3 -->
				<div class="luxe-quarter-card">
					<div>
						<span class="luxe-quarter-tag" data-i18n="cap_q3_tag">الربع الثالث</span>
						<div class="luxe-quarter-status">
							<span class="luxe-status-dot luxe-status-dot--amber"></span>
							<span data-i18n="cap_review">قيد المفاضلة الفنية</span>
						</div>
					</div>
					<span data-i18n="cap_q3_project" style="font-family: var(--font-mono); font-size: 10px; color: var(--interior-brass); margin-top: 1rem;">ملفان تحت دراسة الجدوى</span>
				</div>

				<!-- Q4 -->
				<div class="luxe-quarter-card is-available">
					<div>
						<span class="luxe-quarter-tag" data-i18n="cap_q4_tag">الربع الرابع</span>
						<div class="luxe-quarter-status">
							<span class="luxe-status-dot luxe-status-dot--green"></span>
							<span data-i18n="cap_avail" style="color: var(--interior-brass-light); font-weight: 500;">شاغر أخير متاح</span>
						</div>
					</div>
					<span data-i18n="cap_apply_now" style="font-family: var(--font-mono); font-size: 10px; color: var(--interior-brass-light); margin-top: 1rem;">متاح للتقديم الآن</span>
				</div>
			</div>

			<div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--interior-hairline); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
				<span data-i18n="cap_note" style="font-size: var(--text-xs); color: var(--interior-text-muted);">
					* تخضع كافة الملفات المقدمة لدراسة الأهلية والتوافق المعماري من قبل لجنة الاستوديو الفنية.
				</span>
				<a href="#funnel" data-i18n="cap_cta_btn" class="luxe-btn luxe-btn--primary" style="padding: 0.65rem 1.6rem; font-size: 0.85rem;">
					تقديم ملف مشروعك للربع الرابع
				</a>
			</div>
		</div>
	</div>
</section>
