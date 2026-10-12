<?php
/**
 * Title: INTERIOR — بيان الاستوديو (Studio Manifesto)
 * Slug: blockskit-child/statement-manifesto
 * Categories: interior-narrative
 * Keywords: manifesto, statement, philosophy, limestone
 *
 * @package Blockskit_Child
 */

$theme_uri = get_stylesheet_directory_uri();
?>

<section class="luxe-manifesto luxe-section--limestone" id="manifesto">
	<div class="luxe-container">
		<div class="luxe-manifesto__inner">
			<!-- Text Column with Word-by-Word Scroll Illumination -->
			<div>
				<span class="luxe-manifesto__tag" data-i18n="manifesto_tag">02 · بيان الفلسفة المعمارية السيادية</span>

				<blockquote class="luxe-manifesto__statement" data-i18n="manifesto_statement" style="margin: 0 0 2.5rem; padding: 0; border: none;">
					<span class="luxe-word">لا</span>
					<span class="luxe-word">نزيّن</span>
					<span class="luxe-word">المساحات.</span>
					<span class="luxe-word">نصمّم</span>
					<span class="luxe-word">الطريقة</span>
					<span class="luxe-word">التي</span>
					<span class="luxe-word">تُعاش</span>
					<span class="luxe-word">بها.</span>
					<br>
					<span class="luxe-word">السيطرة</span>
					<span class="luxe-word">الهندسية</span>
					<span class="luxe-word">الكاملة</span>
					<span class="luxe-word">تعني</span>
					<span class="luxe-word">أنك</span>
					<span class="luxe-word">لا</span>
					<span class="luxe-word">تشتري</span>
					<span class="luxe-word">ديكوراً،</span>
					<span class="luxe-word">بل</span>
					<span class="luxe-word">تشتري</span>
					<span class="luxe-word">راحة</span>
					<span class="luxe-word">البال</span>
					<span class="luxe-word">المطلقة</span>
					<span class="luxe-word">من</span>
					<span class="luxe-word">المخطط</span>
					<span class="luxe-word">الأول</span>
					<span class="luxe-word">حتى</span>
					<span class="luxe-word">تسليم</span>
					<span class="luxe-word">المفتاح.</span>
				</blockquote>

				<div class="luxe-hairline" style="border-color: rgba(13, 12, 10, 0.15); margin-block: 2rem;"></div>

				<div style="display: flex; gap: 3rem; align-items: baseline;">
					<div>
						<span class="luxe-meta-latin" data-i18n="manifesto_p1_label" style="color: #7A5F35; display: block; margin-bottom: 0.35rem;">المبدأ الأول</span>
						<div data-i18n="manifesto_p1_text" style="font-weight: 500; color: var(--interior-ink);">عقد موحد ومسؤولية واحدة</div>
					</div>
					<div>
						<span class="luxe-meta-latin" data-i18n="manifesto_p2_label" style="color: #7A5F35; display: block; margin-bottom: 0.35rem;">المبدأ الثاني</span>
						<div data-i18n="manifesto_p2_text" style="font-weight: 500; color: var(--interior-ink);">صفر تشتت بين المقاولين</div>
					</div>
				</div>
			</div>

			<!-- Visual Column: Architectural Crop Specimen -->
			<div>
				<div class="luxe-manifesto__frame">
					<div class="luxe-manifesto__crop-mark luxe-manifesto__crop-mark--tl"></div>
					<div class="luxe-manifesto__crop-mark luxe-manifesto__crop-mark--tr"></div>
					<div class="luxe-manifesto__crop-mark luxe-manifesto__crop-mark--bl"></div>
					<div class="luxe-manifesto__crop-mark luxe-manifesto__crop-mark--br"></div>

					<img src="<?php echo esc_url( $theme_uri . '/assets/images/img07.jpg' ); ?>" alt="تفاصيل العمارة الحجرية الفاخرة" loading="lazy">
					
					<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
						<span class="luxe-meta-latin" data-i18n="manifesto_specimen_label" style="color: #7A5F35; font-size: 10px;">عينة الخامات المعمارية · 01</span>
						<span class="luxe-meta-latin" data-i18n="manifesto_specimen_mat" style="color: #7A5F35; font-size: 10px;">الحجر الجيري والبرونز</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
