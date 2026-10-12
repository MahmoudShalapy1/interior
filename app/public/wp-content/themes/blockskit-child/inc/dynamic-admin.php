<?php
/**
 * Dynamic Admin Management & Studio Sovereign Settings
 * Enables complete dynamic dashboard control over projects, services, metrics, and studio specs.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ------------------------------------------------------------------------
 * 1. STUDIO SOVEREIGN SETTINGS (إعدادات الاستوديو الفاخر)
 * ------------------------------------------------------------------------
 */
function interior_register_studio_settings_page() {
	add_menu_page(
		__( 'إعدادات الاستوديو الفاخر', 'blockskit-child' ),
		__( 'إعدادات الاستوديو', 'blockskit-child' ),
		'manage_options',
		'interior-studio-settings',
		'interior_render_studio_settings_page',
		'dashicons-building',
		3
	);
}
add_action( 'admin_menu', 'interior_register_studio_settings_page' );

/**
 * Render Studio Sovereign Settings Page in WP-Admin
 */
function interior_render_studio_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Handle Save
	$updated = false;
	if ( isset( $_POST['interior_settings_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['interior_settings_nonce'] ), 'interior_save_studio_settings' ) ) {
		$fields = array(
			'interior_stat_palaces',
			'interior_stat_palaces_en',
			'interior_stat_value',
			'interior_stat_value_en',
			'interior_stat_ontime',
			'interior_stat_ontime_en',
			'interior_stat_awards',
			'interior_stat_awards_en',
			'interior_phone',
			'interior_whatsapp',
			'interior_email',
			'interior_address_ar',
			'interior_address_en',
			'interior_license_ar',
			'interior_license_en',
			'interior_est_year',
			'interior_hero_lead_ar',
			'interior_hero_lead_en',
			'interior_about_lead_ar',
			'interior_about_lead_en',
		);

		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_option( $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
		$updated = true;
	}

	// Retrieve current values with defaults
	$stat_palaces    = get_option( 'interior_stat_palaces', '+140' );
	$stat_palaces_en = get_option( 'interior_stat_palaces_en', '+140 Palaces' );
	$stat_value      = get_option( 'interior_stat_value', '+850 مليون $' );
	$stat_value_en   = get_option( 'interior_stat_value_en', '$850M+ Realized Value' );
	$stat_ontime     = get_option( 'interior_stat_ontime', '100%' );
	$stat_ontime_en  = get_option( 'interior_stat_ontime_en', '100% On-Time Turnkey' );
	$stat_awards     = get_option( 'interior_stat_awards', '18' );
	$stat_awards_en  = get_option( 'interior_stat_awards_en', '18 International Citations' );

	$phone           = get_option( 'interior_phone', '+966 11 480 0000' );
	$whatsapp        = get_option( 'interior_whatsapp', '+966 50 123 4567' );
	$email           = get_option( 'interior_email', 'executive@interior.sa' );
	$address_ar      = get_option( 'interior_address_ar', 'حي الهدا · المربع الدبلوماسي، الرياض، المملكة العربية السعودية' );
	$address_en      = get_option( 'interior_address_en', 'Al-Hada District · Diplomatic Quarter, Riyadh, Kingdom of Saudi Arabia' );
	$license_ar      = get_option( 'interior_license_ar', 'ترخيص الهيئة السعودية للمهندسين رقم 7402 / س.ت 1010349281' );
	$license_en      = get_option( 'interior_license_en', 'Saudi Council of Engineers License #7402 / CR 1010349281' );
	$est_year        = get_option( 'interior_est_year', '2009' );
	$hero_lead_ar    = get_option( 'interior_hero_lead_ar', 'استوديو العمارة والتنفيذ السيادي للمشاريع الخاصة والقصور الملكية. نتحمّل المسؤولية الهندسية والتنفيذية المطلقة من أول خط على الورق حتى تسليم المفتاح.' );
	$hero_lead_en    = get_option( 'interior_hero_lead_en', 'The sovereign architecture and turnkey fit-out atelier for private estates and royal residences. We assume absolute engineering and execution stewardship from initial sketch to final handover.' );
	$about_lead_ar   = get_option( 'interior_about_lead_ar', 'لسنا مجرد مرسم تصميم أو شركة مقاولات ديكور؛ نحن استوديو معماري وتنفيذي متكامل يُؤتمن على صياغة القصور والمساكن الخاصة الاستثنائية من الخط الأول على الورق حتى تسليم المفتاح النهائي.' );
	$about_lead_en   = get_option( 'interior_about_lead_en', 'We are not merely a decorative drafting studio or retail fit-out subcontractor; we are an integrated architectural and turnkey atelier entrusted with crafting peerless private palaces from initial sketch to final sovereign key handover.' );
	?>
	<div class="wrap" style="max-width: 1050px; margin-top: 25px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;">
		<div style="background: #111417; color: #FAF8F5; padding: 28px 36px; border-radius: 8px; border-left: 4px solid #C5A059; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
			<h1 style="color: #FAF8F5; margin: 0 0 10px 0; font-size: 26px; font-weight: 600; display: flex; align-items: center; gap: 12px;">
				<span class="dashicons dashicons-building" style="font-size: 28px; width: 28px; height: 28px; color: #C5A059;"></span>
				لوحة التحكم السيادية — إعدادات استوديو إنتيريور المعماري
			</h1>
			<p style="color: #A3A3A3; margin: 0; font-size: 14px; line-height: 1.6;">
				تحكم ديناميكي كامل في كافة الأرقام والإحصائيات، بيانات التواصل، والتراخيص المعتمدة التي تظهر في الواجهة الأمامية للموقع بالعربية والإنجليزية مباشرة.
			</p>
		</div>

		<?php if ( $updated ) : ?>
			<div class="notice notice-success is-dismissible" style="padding: 12px 18px; border-left-color: #C5A059; background: #fff;">
				<p style="font-size: 15px; font-weight: 600; color: #1c7430; margin: 0;">✓ تم حفظ وتحديث كافة بيانات الاستوديو السيادية بنجاح وتفعيلها في الواجهة الأمامية فوراً.</p>
			</div>
		<?php endif; ?>

		<form method="post" action="" style="background: #ffffff; padding: 32px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
			<?php wp_nonce_field( 'interior_save_studio_settings', 'interior_settings_nonce' ); ?>

			<h2 style="font-size: 18px; border-bottom: 2px solid #C5A059; padding-bottom: 10px; margin-top: 0; color: #111417;">
				1. مؤشرات القوة والحجم المعماري (Key Performance Metrics)
			</h2>
			<table class="form-table" role="presentation" style="margin-bottom: 30px;">
				<tr>
					<th scope="row"><label for="interior_stat_palaces">عدد القصور المنجزة (عربي)</label></th>
					<td><input name="interior_stat_palaces" type="text" id="interior_stat_palaces" value="<?php echo esc_attr( $stat_palaces ); ?>" class="regular-text" style="font-weight: 600;" /></td>
					<th scope="row"><label for="interior_stat_palaces_en">Palaces Count (English)</label></th>
					<td><input name="interior_stat_palaces_en" type="text" id="interior_stat_palaces_en" value="<?php echo esc_attr( $stat_palaces_en ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_stat_value">القيمة التراكمية (عربي)</label></th>
					<td><input name="interior_stat_value" type="text" id="interior_stat_value" value="<?php echo esc_attr( $stat_value ); ?>" class="regular-text" style="font-weight: 600;" /></td>
					<th scope="row"><label for="interior_stat_value_en">Portfolio Value (English)</label></th>
					<td><input name="interior_stat_value_en" type="text" id="interior_stat_value_en" value="<?php echo esc_attr( $stat_value_en ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_stat_ontime">الالتزام الزمني (عربي)</label></th>
					<td><input name="interior_stat_ontime" type="text" id="interior_stat_ontime" value="<?php echo esc_attr( $stat_ontime ); ?>" class="regular-text" style="font-weight: 600;" /></td>
					<th scope="row"><label for="interior_stat_ontime_en">On-Time Handover (English)</label></th>
					<td><input name="interior_stat_ontime_en" type="text" id="interior_stat_ontime_en" value="<?php echo esc_attr( $stat_ontime_en ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_stat_awards">الجوائز والاستشهادات (عربي)</label></th>
					<td><input name="interior_stat_awards" type="text" id="interior_stat_awards" value="<?php echo esc_attr( $stat_awards ); ?>" class="regular-text" style="font-weight: 600;" /></td>
					<th scope="row"><label for="interior_stat_awards_en">Citations & Honors (English)</label></th>
					<td><input name="interior_stat_awards_en" type="text" id="interior_stat_awards_en" value="<?php echo esc_attr( $stat_awards_en ); ?>" class="regular-text" /></td>
				</tr>
			</table>

			<h2 style="font-size: 18px; border-bottom: 2px solid #C5A059; padding-bottom: 10px; color: #111417;">
				2. قنوات التواصل المعتمدة والتراخيص الرسمية (Executive Channels & Licensing)
			</h2>
			<table class="form-table" role="presentation" style="margin-bottom: 30px;">
				<tr>
					<th scope="row"><label for="interior_phone">الهاتف السيادي الموحد</label></th>
					<td><input name="interior_phone" type="text" id="interior_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" dir="ltr" /></td>
					<th scope="row"><label for="interior_whatsapp">رقم الواتساب الخاص المباشر</label></th>
					<td><input name="interior_whatsapp" type="text" id="interior_whatsapp" value="<?php echo esc_attr( $whatsapp ); ?>" class="regular-text" dir="ltr" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_email">البريد الإلكتروني للديوان التنفيذي</label></th>
					<td colspan="3"><input name="interior_email" type="email" id="interior_email" value="<?php echo esc_attr( $email ); ?>" class="large-text" dir="ltr" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_address_ar">المقر الرئيسي بالرياض (عربي)</label></th>
					<td colspan="3"><input name="interior_address_ar" type="text" id="interior_address_ar" value="<?php echo esc_attr( $address_ar ); ?>" class="large-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_address_en">Headquarters Address (English)</label></th>
					<td colspan="3"><input name="interior_address_en" type="text" id="interior_address_en" value="<?php echo esc_attr( $address_en ); ?>" class="large-text" dir="ltr" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_license_ar">الترخيص والسجل الهندسي (عربي)</label></th>
					<td colspan="3"><input name="interior_license_ar" type="text" id="interior_license_ar" value="<?php echo esc_attr( $license_ar ); ?>" class="large-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_license_en">Engineering License (English)</label></th>
					<td colspan="3"><input name="interior_license_en" type="text" id="interior_license_en" value="<?php echo esc_attr( $license_en ); ?>" class="large-text" dir="ltr" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_est_year">سنة التأسيس (Year Established)</label></th>
					<td colspan="3"><input name="interior_est_year" type="text" id="interior_est_year" value="<?php echo esc_attr( $est_year ); ?>" class="small-text" dir="ltr" /></td>
				</tr>
			</table>

			<h2 style="font-size: 18px; border-bottom: 2px solid #C5A059; padding-bottom: 10px; color: #111417;">
				3. النصوص والبيانات الافتتاحية (Hero & Manifesto Leads)
			</h2>
			<table class="form-table" role="presentation" style="margin-bottom: 30px;">
				<tr>
					<th scope="row"><label for="interior_hero_lead_ar">النص الافتتاحي للرئيسية (عربي)</label></th>
					<td><textarea name="interior_hero_lead_ar" id="interior_hero_lead_ar" rows="3" class="large-text"><?php echo esc_textarea( $hero_lead_ar ); ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_hero_lead_en">Homepage Hero Lead (English)</label></th>
					<td><textarea name="interior_hero_lead_en" id="interior_hero_lead_en" rows="3" class="large-text" dir="ltr"><?php echo esc_textarea( $hero_lead_en ); ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_about_lead_ar">البيان التأسيسي لصفحة عن الاستوديو (عربي)</label></th>
					<td><textarea name="interior_about_lead_ar" id="interior_about_lead_ar" rows="3" class="large-text"><?php echo esc_textarea( $about_lead_ar ); ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><label for="interior_about_lead_en">About Page Monograph Lead (English)</label></th>
					<td><textarea name="interior_about_lead_en" id="interior_about_lead_en" rows="3" class="large-text" dir="ltr"><?php echo esc_textarea( $about_lead_en ); ?></textarea></td>
				</tr>
			</table>

			<p class="submit" style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="حفظ وتحديث الإعدادات فوراً" style="background: #111417; border-color: #C5A059; color: #FAF8F5; padding: 6px 24px; height: auto; font-size: 15px; font-weight: 600; cursor: pointer; border-radius: 4px;" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * ------------------------------------------------------------------------
 * 2. NATIVE META BOXES FOR PROJECTS (المشاريع السيادية)
 * ------------------------------------------------------------------------
 */
function interior_add_project_meta_boxes() {
	add_meta_box(
		'interior_project_specs',
		__( 'المواصفات الهندسية للمشروع السيادي (Architectural Project Specifications)', 'blockskit-child' ),
		'interior_render_project_specs_metabox',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_project_meta_boxes' );

function interior_render_project_specs_metabox( $post ) {
	wp_nonce_field( 'interior_save_project_specs', 'interior_project_nonce' );

	$location      = get_post_meta( $post->ID, '_project_location', true );
	$location_en   = get_post_meta( $post->ID, '_project_location_en', true );
	$area          = get_post_meta( $post->ID, '_project_area', true );
	$year          = get_post_meta( $post->ID, '_project_year', true );
	$duration      = get_post_meta( $post->ID, '_project_duration', true );
	$scope         = get_post_meta( $post->ID, '_project_scope', true );
	$scope_en      = get_post_meta( $post->ID, '_project_scope_en', true );
	$materials     = get_post_meta( $post->ID, '_project_materials', true );
	$materials_en  = get_post_meta( $post->ID, '_project_materials_en', true );
	$title_en      = get_post_meta( $post->ID, '_project_title_en', true );
	$desc_en       = get_post_meta( $post->ID, '_project_desc_en', true );
	$layout_card   = get_post_meta( $post->ID, '_project_card_layout', true ) ?: 'wide';
	$nda_status    = get_post_meta( $post->ID, '_project_nda_status', true ) ?: 'public';
	$challenge_ar  = get_post_meta( $post->ID, '_project_challenge_ar', true );
	$challenge_en  = get_post_meta( $post->ID, '_project_challenge_en', true );
	$solution_ar   = get_post_meta( $post->ID, '_project_solution_ar', true );
	$solution_en   = get_post_meta( $post->ID, '_project_solution_en', true );
	$hero_image    = get_post_meta( $post->ID, '_project_hero_image', true );
	$detail_image  = get_post_meta( $post->ID, '_project_detail_image', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 10px;">
		<div>
			<p>
				<label><strong>العنوان بالإنجليزية (English Project Title):</strong></label><br>
				<input type="text" name="_project_title_en" value="<?php echo esc_attr( $title_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>الموقع الجغرافي بالعربي (e.g. حطين، الرياض):</strong></label><br>
				<input type="text" name="_project_location" value="<?php echo esc_attr( $location ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>المساحة المبنية (Built Area e.g. 3,850 م²):</strong></label><br>
				<input type="text" name="_project_area" value="<?php echo esc_attr( $area ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>سنة التسليم (Delivery Year e.g. 2025):</strong></label><br>
				<input type="text" name="_project_year" value="<?php echo esc_attr( $year ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>مدة التنفيذ (Duration e.g. 18 شهراً):</strong></label><br>
				<input type="text" name="_project_duration" value="<?php echo esc_attr( $duration ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>نطاق المسؤولية (Scope of Work بالعربي):</strong></label><br>
				<input type="text" name="_project_scope" value="<?php echo esc_attr( $scope ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>الخامات الحصرية بالعربي (Rare Materials Palette):</strong></label><br>
				<input type="text" name="_project_materials" value="<?php echo esc_attr( $materials ); ?>" style="width: 100%;" />
			</p>
		</div>

		<div>
			<p>
				<label><strong>الوصف بالإنجليزية (English Short Narrative):</strong></label><br>
				<textarea name="_project_desc_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $desc_en ); ?></textarea>
			</p>
			<p>
				<label><strong>الموقع بالإنجليزية (Location in English):</strong></label><br>
				<input type="text" name="_project_location_en" value="<?php echo esc_attr( $location_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>نطاق العمل بالإنجليزي (Scope in English):</strong></label><br>
				<input type="text" name="_project_scope_en" value="<?php echo esc_attr( $scope_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>الخامات بالإنجليزي (Materials in English):</strong></label><br>
				<input type="text" name="_project_materials_en" value="<?php echo esc_attr( $materials_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>تنسيق البطاقة في الأرشيف (Grid Card Format):</strong></label><br>
				<select name="_project_card_layout" style="width: 100%;">
					<option value="wide" <?php selected( $layout_card, 'wide' ); ?>>عريض (Wide - 8 أعمدة)</option>
					<option value="tall" <?php selected( $layout_card, 'tall' ); ?>>طولي (Tall - 4 أعمدة)</option>
					<option value="medium" <?php selected( $layout_card, 'medium' ); ?>>متوسط (Medium - 6 أعمدة)</option>
				</select>
			</p>
			<p>
				<label><strong>درجة السرية والتوثيق (NDA Status):</strong></label><br>
				<select name="_project_nda_status" style="width: 100%;">
					<option value="public" <?php selected( $nda_status, 'public' ); ?>>موثق للعرض العام (Public Monograph)</option>
					<option value="confidential_nda" <?php selected( $nda_status, 'confidential_nda' ); ?>>سري بموجب اتفاقية NDA (Confidential Estate)</option>
				</select>
			</p>
		</div>
	</div>

	<hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
		<div>
			<p>
				<label><strong>التحدي الفراغي والهندسي (The Spatial Challenge - AR):</strong></label><br>
				<textarea name="_project_challenge_ar" rows="3" style="width: 100%;"><?php echo esc_textarea( $challenge_ar ); ?></textarea>
			</p>
			<p>
				<label><strong>The Spatial Challenge (EN):</strong></label><br>
				<textarea name="_project_challenge_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $challenge_en ); ?></textarea>
			</p>
			<p>
				<label><strong>رابط الصورة الرئيسية (Hero Image URL):</strong></label><br>
				<input type="text" name="_project_hero_image" value="<?php echo esc_attr( $hero_image ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
		<div>
			<p>
				<label><strong>المعالجة المعمارية والتنفيذية (The Architectural Solution - AR):</strong></label><br>
				<textarea name="_project_solution_ar" rows="3" style="width: 100%;"><?php echo esc_textarea( $solution_ar ); ?></textarea>
			</p>
			<p>
				<label><strong>The Architectural Solution (EN):</strong></label><br>
				<textarea name="_project_solution_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $solution_en ); ?></textarea>
			</p>
			<p>
				<label><strong>رابط صورة التفاصيل الحرفية (Craft Detail Image URL):</strong></label><br>
				<input type="text" name="_project_detail_image" value="<?php echo esc_attr( $detail_image ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
	</div>
	<?php
}

function interior_save_project_specs_meta( $post_id ) {
	if ( ! isset( $_POST['interior_project_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['interior_project_nonce'] ), 'interior_save_project_specs' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'_project_title_en',
		'_project_desc_en',
		'_project_location',
		'_project_location_en',
		'_project_area',
		'_project_year',
		'_project_duration',
		'_project_scope',
		'_project_scope_en',
		'_project_materials',
		'_project_materials_en',
		'_project_card_layout',
		'_project_nda_status',
		'_project_challenge_ar',
		'_project_challenge_en',
		'_project_solution_ar',
		'_project_solution_en',
		'_project_hero_image',
		'_project_detail_image',
	);

	foreach ( $keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_project', 'interior_save_project_specs_meta' );

/**
 * ------------------------------------------------------------------------
 * 3. NATIVE META BOXES FOR SERVICES (الخدمات المعمارية)
 * ------------------------------------------------------------------------
 */
function interior_add_service_meta_boxes() {
	add_meta_box(
		'interior_service_specs',
		__( 'محددات وبنود الخدمة المعمارية (Service Specifications)', 'blockskit-child' ),
		'interior_render_service_specs_metabox',
		'service',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_service_meta_boxes' );

function interior_render_service_specs_metabox( $post ) {
	wp_nonce_field( 'interior_save_service_specs', 'interior_service_nonce' );

	$index         = get_post_meta( $post->ID, '_service_index', true ) ?: '01';
	$title_en      = get_post_meta( $post->ID, '_service_title_en', true );
	$sub_ar        = get_post_meta( $post->ID, '_service_subtitle_ar', true );
	$sub_en        = get_post_meta( $post->ID, '_service_subtitle_en', true );
	$desc_en       = get_post_meta( $post->ID, '_service_desc_en', true );
	$scope_ar      = get_post_meta( $post->ID, '_service_scope_items_ar', true );
	$scope_en      = get_post_meta( $post->ID, '_service_scope_items_en', true );
	$preview_img   = get_post_meta( $post->ID, '_service_preview_image', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 10px;">
		<div>
			<p>
				<label><strong>الرقم التسلسلي للخدمة (e.g. 01):</strong></label><br>
				<input type="text" name="_service_index" value="<?php echo esc_attr( $index ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>العنوان الفرعي بالعربي (Arabic Subtitle):</strong></label><br>
				<input type="text" name="_service_subtitle_ar" value="<?php echo esc_attr( $sub_ar ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>بنود النطاق التنفيذي بالعربي (سطر لكل بند):</strong></label><br>
				<textarea name="_service_scope_items_ar" rows="5" style="width: 100%;"><?php echo esc_textarea( $scope_ar ); ?></textarea>
			</p>
		</div>
		<div>
			<p>
				<label><strong>العنوان بالإنجليزية (English Service Title):</strong></label><br>
				<input type="text" name="_service_title_en" value="<?php echo esc_attr( $title_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>English Subtitle:</strong></label><br>
				<input type="text" name="_service_subtitle_en" value="<?php echo esc_attr( $sub_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>الوصف بالإنجليزية (English Description):</strong></label><br>
				<textarea name="_service_desc_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $desc_en ); ?></textarea>
			</p>
			<p>
				<label><strong>Scope Items in English (one per line):</strong></label><br>
				<textarea name="_service_scope_items_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $scope_en ); ?></textarea>
			</p>
			<p>
				<label><strong>رابط صورة المعاينة (Hover Preview Image URL):</strong></label><br>
				<input type="text" name="_service_preview_image" value="<?php echo esc_attr( $preview_img ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
	</div>
	<?php
}

function interior_save_service_specs_meta( $post_id ) {
	if ( ! isset( $_POST['interior_service_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['interior_service_nonce'] ), 'interior_save_service_specs' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'_service_index',
		'_service_title_en',
		'_service_subtitle_ar',
		'_service_subtitle_en',
		'_service_desc_en',
		'_service_scope_items_ar',
		'_service_scope_items_en',
		'_service_preview_image',
	);

	foreach ( $keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_service', 'interior_save_service_specs_meta' );

/**
 * ------------------------------------------------------------------------
 * 4. ADMIN COLUMN ENHANCEMENTS FOR PROJECTS & SERVICES
 * ------------------------------------------------------------------------
 */
// Projects columns
function interior_project_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']          = $columns['cb'];
	$new_columns['title']       = __( 'اسم المشروع', 'blockskit-child' );
	$new_columns['location']    = __( 'الموقع الجغرافي', 'blockskit-child' );
	$new_columns['area']        = __( 'المساحة', 'blockskit-child' );
	$new_columns['year']        = __( 'السنة', 'blockskit-child' );
	$new_columns['typology']    = __( 'التصنيف المعماري', 'blockskit-child' );
	$new_columns['date']        = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_project_posts_columns', 'interior_project_admin_columns' );

function interior_project_custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'location':
			echo esc_html( get_post_meta( $post_id, '_project_location', true ) ?: '—' );
			break;
		case 'area':
			echo esc_html( get_post_meta( $post_id, '_project_area', true ) ?: '—' );
			break;
		case 'year':
			echo esc_html( get_post_meta( $post_id, '_project_year', true ) ?: '—' );
			break;
		case 'typology':
			$terms = get_the_terms( $post_id, 'project_typology' );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$names = wp_list_pluck( $terms, 'name' );
				echo esc_html( implode( ', ', $names ) );
			} else {
				echo '—';
			}
			break;
	}
}
add_action( 'manage_project_posts_custom_column', 'interior_project_custom_columns_content', 10, 2 );

/**
 * ------------------------------------------------------------------------
 * 5. CONFIDENTIAL BRIEFS MANAGEMENT & AJAX/REST SUBMISSION (الأضابير الخاصة)
 * ------------------------------------------------------------------------
 */
// Brief Admin Columns
function interior_brief_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']             = $columns['cb'];
	$new_columns['title']          = __( 'رمز الأضبارة / العنوان', 'blockskit-child' );
	$new_columns['client_name']    = __( 'العميل الكريم', 'blockskit-child' );
	$new_columns['client_phone']   = __( 'رقم الهاتف', 'blockskit-child' );
	$new_columns['typology']       = __( 'نوع المنشأة', 'blockskit-child' );
	$new_columns['scale']          = __( 'المساحة التقديرية', 'blockskit-child' );
	$new_columns['location']       = __( 'موقع المشروع', 'blockskit-child' );
	$new_columns['date']           = __( 'تاريخ الإيداع', 'blockskit-child' );
	return $new_columns;
}
add_filter( 'manage_brief_posts_columns', 'interior_brief_admin_columns' );

function interior_brief_custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'client_name':
			echo '<strong>' . esc_html( get_post_meta( $post_id, '_brief_client_name', true ) ?: '—' ) . '</strong>';
			break;
		case 'client_phone':
			$phone = get_post_meta( $post_id, '_brief_client_phone', true );
			echo ! empty( $phone ) ? '<a href="tel:' . esc_attr( $phone ) . '" dir="ltr">' . esc_html( $phone ) . '</a>' : '—';
			break;
		case 'typology':
			echo esc_html( get_post_meta( $post_id, '_brief_property_type', true ) ?: '—' );
			break;
		case 'scale':
			echo esc_html( get_post_meta( $post_id, '_brief_property_scale', true ) ?: '—' );
			break;
		case 'location':
			echo esc_html( get_post_meta( $post_id, '_brief_client_location', true ) ?: '—' );
			break;
	}
}
add_action( 'manage_brief_posts_custom_column', 'interior_brief_custom_columns_content', 10, 2 );

// Brief Meta Box
function interior_add_brief_meta_box() {
	add_meta_box(
		'interior_brief_details_meta',
		__( 'بيانات ومواصفات الأضبارة الاستشارية المشفرة (Confidential Dossier)', 'blockskit-child' ),
		'interior_render_brief_details_metabox',
		'brief',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_brief_meta_box' );

function interior_render_brief_details_metabox( $post ) {
	$name     = get_post_meta( $post->ID, '_brief_client_name', true );
	$phone    = get_post_meta( $post->ID, '_brief_client_phone', true );
	$type     = get_post_meta( $post->ID, '_brief_property_type', true );
	$scale    = get_post_meta( $post->ID, '_brief_property_scale', true );
	$scope    = get_post_meta( $post->ID, '_brief_property_scope', true );
	$location = get_post_meta( $post->ID, '_brief_client_location', true );
	$timeline = get_post_meta( $post->ID, '_brief_client_timeline', true );
	?>
	<table class="form-table" role="presentation">
		<tr>
			<th scope="row">اللقب والاسم الكريم:</th>
			<td><strong style="font-size: 16px;"><?php echo esc_html( $name ?: '—' ); ?></strong></td>
			<th scope="row">رقم الهاتف / الواتساب:</th>
			<td><strong style="font-size: 16px;" dir="ltr"><a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>" target="_blank"><?php echo esc_html( $phone ?: '—' ); ?></a></strong></td>
		</tr>
		<tr>
			<th scope="row">التصنيف المعماري:</th>
			<td><?php echo esc_html( $type ?: '—' ); ?></td>
			<th scope="row">المساحة التقديرية:</th>
			<td><?php echo esc_html( $scale ?: '—' ); ?></td>
		</tr>
		<tr>
			<th scope="row">نطاق العمل المطلوب:</th>
			<td><?php echo esc_html( $scope ?: '—' ); ?></td>
			<th scope="row">الموقع الجغرافي:</th>
			<td><?php echo esc_html( $location ?: '—' ); ?></td>
		</tr>
		<tr>
			<th scope="row">الموعد المستهدف للبدء:</th>
			<td colspan="3"><span style="background: #f0f4f8; padding: 4px 10px; border-radius: 4px; font-weight: 600;"><?php echo esc_html( $timeline ?: '—' ); ?></span></td>
		</tr>
	</table>
	<?php
}

// REST Route & AJAX Submission Handler for Briefs
function interior_register_brief_rest_route() {
	register_rest_route( 'interior/v1', '/submit-brief', array(
		'methods'             => 'POST',
		'callback'            => 'interior_handle_brief_submission_rest',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'interior_register_brief_rest_route' );

function interior_handle_brief_submission_rest( $request ) {
	$params = $request->get_params();

	$client_name     = sanitize_text_field( $params['client_name'] ?? '' );
	$client_phone    = sanitize_text_field( $params['client_phone'] ?? '' );
	$property_type   = sanitize_text_field( $params['property_type'] ?? 'قصر سيادي مستقل' );
	$property_scale  = sanitize_text_field( $params['property_scale'] ?? '3,000 م² — 5,000 م²' );
	$property_scope  = sanitize_text_field( $params['property_scope'] ?? 'تسليم مفتاح شامل' );
	$client_location = sanitize_text_field( $params['client_location'] ?? 'الرياض' );
	$client_timeline = sanitize_text_field( $params['client_timeline'] ?? 'بدء فوري' );

	if ( empty( $client_name ) && empty( $client_phone ) ) {
		return new WP_Error( 'missing_fields', 'يرجى تقديم الاسم ورقم الهاتف على الأقل', array( 'status' => 400 ) );
	}

	$title = 'أضبارة: ' . ( ! empty( $client_name ) ? $client_name : 'عميل خاص' ) . ' — ' . $property_type;

	$post_id = wp_insert_post( array(
		'post_type'    => 'brief',
		'post_title'   => $title,
		'post_status'  => 'publish',
		'post_content' => sprintf(
			"العميل: %s\nالهاتف: %s\nالنوع: %s\nالمساحة: %s\nالنطاق: %s\nالموقع: %s\nالموعد: %s",
			$client_name, $client_phone, $property_type, $property_scale, $property_scope, $client_location, $client_timeline
		),
	) );

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	update_post_meta( $post_id, '_brief_client_name', $client_name );
	update_post_meta( $post_id, '_brief_client_phone', $client_phone );
	update_post_meta( $post_id, '_brief_property_type', $property_type );
	update_post_meta( $post_id, '_brief_property_scale', $property_scale );
	update_post_meta( $post_id, '_brief_property_scope', $property_scope );
	update_post_meta( $post_id, '_brief_client_location', $client_location );
	update_post_meta( $post_id, '_brief_client_timeline', $client_timeline );

	return array(
		'success'  => true,
		'message'  => 'تم تسجيل الأضبارة وتأكيد التشفير بنجاح',
		'brief_id' => $post_id,
	);
}

/**
 * ------------------------------------------------------------------------
 * 6. NATIVE META BOXES & ADMIN COLUMNS FOR TEAM MEMBERS (فريق الاستوديو)
 * ------------------------------------------------------------------------
 */
function interior_add_team_meta_boxes() {
	add_meta_box(
		'interior_team_specs',
		__( 'بيانات القيادة المعمارية ومواصفات الشريك (Architectural Leader Profile)', 'blockskit-child' ),
		'interior_render_team_specs_metabox',
		'team',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_team_meta_boxes' );

function interior_render_team_specs_metabox( $post ) {
	wp_nonce_field( 'interior_save_team_specs', 'interior_team_nonce' );

	$name_en       = get_post_meta( $post->ID, '_team_name_en', true );
	$role_ar       = get_post_meta( $post->ID, '_team_role_ar', true );
	$role_en       = get_post_meta( $post->ID, '_team_role_en', true );
	$tag_ar        = get_post_meta( $post->ID, '_team_tag_ar', true );
	$tag_en        = get_post_meta( $post->ID, '_team_tag_en', true );
	$cred_ar       = get_post_meta( $post->ID, '_team_cred_ar', true );
	$cred_en       = get_post_meta( $post->ID, '_team_cred_en', true );
	$bio_ar        = get_post_meta( $post->ID, '_team_bio_ar', true );
	$bio_en        = get_post_meta( $post->ID, '_team_bio_en', true );
	$photo         = get_post_meta( $post->ID, '_team_photo', true );
	$is_principal  = get_post_meta( $post->ID, '_team_is_principal', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 10px;">
		<div>
			<p>
				<label><strong>الاسم بالإنجليزية (English Full Name):</strong></label><br>
				<input type="text" name="_team_name_en" value="<?php echo esc_attr( $name_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>المسمى والصفة القيادية بالعربي (Role in Arabic):</strong></label><br>
				<input type="text" name="_team_role_ar" value="<?php echo esc_attr( $role_ar ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>Role in English (e.g. Co-Founder & Principal Architect):</strong></label><br>
				<input type="text" name="_team_role_en" value="<?php echo esc_attr( $role_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>شارة الشريك بالعربي (e.g. الشريك المؤسس / شريك تنفيذي):</strong></label><br>
				<input type="text" name="_team_tag_ar" value="<?php echo esc_attr( $tag_ar ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>Partner Tag in English (e.g. Founding Partner):</strong></label><br>
				<input type="text" name="_team_tag_en" value="<?php echo esc_attr( $tag_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p style="margin-top: 15px;">
				<label>
					<input type="checkbox" name="_team_is_principal" value="1" <?php checked( $is_principal, '1' ); ?> />
					<strong>تمييز كشريك قيادي رئيسي (Principal Leader Card Highlight)</strong>
				</label>
			</p>
		</div>

		<div>
			<p>
				<label><strong>المؤهلات والاعتمادات الرسمية بالعربي (Credentials & Memberships - AR):</strong></label><br>
				<input type="text" name="_team_cred_ar" value="<?php echo esc_attr( $cred_ar ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>Credentials & Honors in English:</strong></label><br>
				<input type="text" name="_team_cred_en" value="<?php echo esc_attr( $cred_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>النبذة المهنية بالعربي (Executive Biography - AR):</strong></label><br>
				<textarea name="_team_bio_ar" rows="4" style="width: 100%;"><?php echo esc_textarea( $bio_ar ); ?></textarea>
			</p>
			<p>
				<label><strong>Executive Biography in English:</strong></label><br>
				<textarea name="_team_bio_en" rows="4" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $bio_en ); ?></textarea>
			</p>
			<p>
				<label><strong>رابط الصورة الشخصية المعمارية (Portrait Photo URL):</strong></label><br>
				<input type="text" name="_team_photo" value="<?php echo esc_attr( $photo ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
	</div>
	<?php
}

function interior_save_team_specs_meta( $post_id ) {
	if ( ! isset( $_POST['interior_team_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['interior_team_nonce'] ), 'interior_save_team_specs' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'_team_name_en',
		'_team_role_ar',
		'_team_role_en',
		'_team_tag_ar',
		'_team_tag_en',
		'_team_cred_ar',
		'_team_cred_en',
		'_team_bio_ar',
		'_team_bio_en',
		'_team_photo',
	);

	foreach ( $keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}

	$is_principal = isset( $_POST['_team_is_principal'] ) ? '1' : '0';
	update_post_meta( $post_id, '_team_is_principal', $is_principal );
}
add_action( 'save_post_team', 'interior_save_team_specs_meta' );

function interior_team_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']          = $columns['cb'];
	$new_columns['photo']       = __( 'الصورة', 'blockskit-child' );
	$new_columns['title']       = __( 'الاسم', 'blockskit-child' );
	$new_columns['role']        = __( 'المسمى القيادي', 'blockskit-child' );
	$new_columns['partner_tag'] = __( 'الصفة', 'blockskit-child' );
	$new_columns['order']       = __( 'الترتيب', 'blockskit-child' );
	$new_columns['date']        = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_team_posts_columns', 'interior_team_admin_columns' );

function interior_team_custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'photo':
			$photo = get_post_meta( $post_id, '_team_photo', true );
			if ( ! empty( $photo ) ) {
				echo '<img src="' . esc_url( $photo ) . '" style="width: 44px; height: 56px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;" />';
			} else {
				echo '—';
			}
			break;
		case 'role':
			echo esc_html( get_post_meta( $post_id, '_team_role_ar', true ) ?: '—' );
			break;
		case 'partner_tag':
			$tag = get_post_meta( $post_id, '_team_tag_ar', true );
			if ( ! empty( $tag ) ) {
				echo '<span style="background: #111417; color: #C5A059; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html( $tag ) . '</span>';
			} else {
				echo '—';
			}
			break;
		case 'order':
			$post = get_post( $post_id );
			echo esc_html( $post->menu_order );
			break;
	}
}
add_action( 'manage_team_posts_custom_column', 'interior_team_custom_columns_content', 10, 2 );

/**
 * ------------------------------------------------------------------------
 * 7. NATIVE META BOXES & ADMIN COLUMNS FOR MATERIALS (مكتبة الخامات الحصرية)
 * ------------------------------------------------------------------------
 */
function interior_add_material_meta_boxes() {
	add_meta_box(
		'interior_material_specs',
		__( 'مواصفات الخامة الجيولوجية ومصدر التوريد (Exclusive Material Provenance)', 'blockskit-child' ),
		'interior_render_material_specs_metabox',
		'material',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_material_meta_boxes' );

function interior_render_material_specs_metabox( $post ) {
	wp_nonce_field( 'interior_save_material_specs', 'interior_material_nonce' );

	$index       = get_post_meta( $post->ID, '_material_index', true ) ?: '01';
	$title_en    = get_post_meta( $post->ID, '_material_title_en', true );
	$origin_ar   = get_post_meta( $post->ID, '_material_origin_ar', true );
	$origin_en   = get_post_meta( $post->ID, '_material_origin_en', true );
	$desc_ar     = get_post_meta( $post->ID, '_material_desc_ar', true );
	$desc_en     = get_post_meta( $post->ID, '_material_desc_en', true );
	$image       = get_post_meta( $post->ID, '_material_image', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 10px;">
		<div>
			<p>
				<label><strong>الرقم التسلسلي للخامة (e.g. 01):</strong></label><br>
				<input type="text" name="_material_index" value="<?php echo esc_attr( $index ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>اسم الخامة بالإنجليزية (English Material Name):</strong></label><br>
				<input type="text" name="_material_title_en" value="<?php echo esc_attr( $title_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
			<p>
				<label><strong>المحجر وبلد المصدر بالعربي (Quarry / Origin - AR):</strong></label><br>
				<input type="text" name="_material_origin_ar" value="<?php echo esc_attr( $origin_ar ); ?>" style="width: 100%;" />
			</p>
			<p>
				<label><strong>Origin & Quarry in English:</strong></label><br>
				<input type="text" name="_material_origin_en" value="<?php echo esc_attr( $origin_en ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>

		<div>
			<p>
				<label><strong>الوصف الجيولوجي والمواصفات بالعربي (Description - AR):</strong></label><br>
				<textarea name="_material_desc_ar" rows="4" style="width: 100%;"><?php echo esc_textarea( $desc_ar ); ?></textarea>
			</p>
			<p>
				<label><strong>Geological Description in English:</strong></label><br>
				<textarea name="_material_desc_en" rows="4" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $desc_en ); ?></textarea>
			</p>
			<p>
				<label><strong>رابط صورة الخامة الفائقة (High-Res Material Photo URL):</strong></label><br>
				<input type="text" name="_material_image" value="<?php echo esc_attr( $image ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
	</div>
	<?php
}

function interior_save_material_specs_meta( $post_id ) {
	if ( ! isset( $_POST['interior_material_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['interior_material_nonce'] ), 'interior_save_material_specs' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'_material_index',
		'_material_title_en',
		'_material_origin_ar',
		'_material_origin_en',
		'_material_desc_ar',
		'_material_desc_en',
		'_material_image',
	);

	foreach ( $keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_material', 'interior_save_material_specs_meta' );

function interior_material_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']     = $columns['cb'];
	$new_columns['photo']  = __( 'معاينة الخامة', 'blockskit-child' );
	$new_columns['index']  = __( 'الرقم', 'blockskit-child' );
	$new_columns['title']  = __( 'اسم الخامة', 'blockskit-child' );
	$new_columns['origin'] = __( 'المصدر والمحجر', 'blockskit-child' );
	$new_columns['date']   = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_material_posts_columns', 'interior_material_admin_columns' );

function interior_material_custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'photo':
			$photo = get_post_meta( $post_id, '_material_image', true );
			if ( ! empty( $photo ) ) {
				echo '<img src="' . esc_url( $photo ) . '" style="width: 56px; height: 42px; object-fit: cover; border-radius: 3px; border: 1px solid #ddd;" />';
			} else {
				echo '—';
			}
			break;
		case 'index':
			echo '<span style="font-family: monospace; font-weight: bold;">' . esc_html( get_post_meta( $post_id, '_material_index', true ) ?: '01' ) . '</span>';
			break;
		case 'origin':
			echo esc_html( get_post_meta( $post_id, '_material_origin_ar', true ) ?: '—' );
			break;
	}
}
add_action( 'manage_material_posts_custom_column', 'interior_material_custom_columns_content', 10, 2 );

/**
 * ------------------------------------------------------------------------
 * 8. NATIVE META BOXES & ADMIN COLUMNS FOR MONOGRAPHS / ARTICLES (المقالات والدراسات)
 * ------------------------------------------------------------------------
 */
function interior_add_post_monograph_meta_boxes() {
	add_meta_box(
		'interior_post_monograph_details',
		__( 'بيانات المونوغراف المعماري والترجمة الإنجليزية (Architectural Monograph & Bilingual Details)', 'blockskit-child' ),
		'interior_render_post_monograph_metabox',
		'post',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'interior_add_post_monograph_meta_boxes' );

function interior_render_post_monograph_metabox( $post ) {
	wp_nonce_field( 'interior_save_post_monograph', 'interior_post_monograph_nonce' );

	$title_en       = get_post_meta( $post->ID, '_article_title_en', true );
	$excerpt_en     = get_post_meta( $post->ID, '_article_excerpt_en', true );
	$content_en     = get_post_meta( $post->ID, '_article_content_en', true );
	$category_ar    = get_post_meta( $post->ID, '_article_category_ar', true );
	$category_en    = get_post_meta( $post->ID, '_article_category_en', true );
	$read_time_ar   = get_post_meta( $post->ID, '_article_read_time_ar', true ) ?: '6 دقائق قراءة';
	$read_time_en   = get_post_meta( $post->ID, '_article_read_time_en', true ) ?: '6 min read';
	$hero_img       = get_post_meta( $post->ID, '_article_hero_img', true );
	$author_name_ar = get_post_meta( $post->ID, '_article_author_name', true );
	$author_name_en = get_post_meta( $post->ID, '_article_author_name_en', true );
	$author_role_ar = get_post_meta( $post->ID, '_article_author_role', true );
	$author_role_en = get_post_meta( $post->ID, '_article_author_role_en', true );
	$author_img     = get_post_meta( $post->ID, '_article_author_img', true );
	?>
	<div style="background: #fafafa; border: 1px solid #ddd; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
		<h4 style="margin: 0 0 10px 0; color: #2271b1;"><?php esc_html_e( 'النسخة الإنجليزية الكاملة (English Monograph Content)', 'blockskit-child' ); ?></h4>
		<p>
			<label><strong><?php esc_html_e( 'عنوان المقال بالإنجليزية (English Monograph Title):', 'blockskit-child' ); ?></strong></label><br>
			<input type="text" name="_article_title_en" value="<?php echo esc_attr( $title_en ); ?>" style="width: 100%;" dir="ltr" />
		</p>
		<p>
			<label><strong><?php esc_html_e( 'الملخص / الاقتباس الافتتاحي بالإنجليزية (English Abstract / Lead Excerpt):', 'blockskit-child' ); ?></strong></label><br>
			<textarea name="_article_excerpt_en" rows="3" style="width: 100%;" dir="ltr"><?php echo esc_textarea( $excerpt_en ); ?></textarea>
		</p>
		<p>
			<label><strong><?php esc_html_e( 'المحتوى الكامل للمقال بالإنجليزية (English Full Content):', 'blockskit-child' ); ?></strong></label><br>
			<textarea name="_article_content_en" rows="8" style="width: 100%; font-family: monospace;" dir="ltr"><?php echo esc_textarea( $content_en ); ?></textarea>
		</p>
	</div>

	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
		<div style="background: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 4px;">
			<h4 style="margin: 0 0 10px 0; color: #135e96;"><?php esc_html_e( 'التصنيف وزمن القراءة (Category & Read Time)', 'blockskit-child' ); ?></h4>
			<p>
				<label><strong><?php esc_html_e( 'التصنيف المعماري بالعربي (Category AR):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_category_ar" value="<?php echo esc_attr( $category_ar ); ?>" style="width: 100%;" placeholder="مثال: الهندسة المعمارية" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'التصنيف بالإنجليزية (Category EN):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_category_en" value="<?php echo esc_attr( $category_en ); ?>" style="width: 100%;" dir="ltr" placeholder="e.g. Architectural Engineering" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'زمن القراءة بالعربي (أرقام غربية 0-9):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_read_time_ar" value="<?php echo esc_attr( $read_time_ar ); ?>" style="width: 100%;" placeholder="6 دقائق قراءة" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'Read Time in English:', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_read_time_en" value="<?php echo esc_attr( $read_time_en ); ?>" style="width: 100%;" dir="ltr" placeholder="6 min read" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'رابط صورة الغلاف الفائقة (Hero Image URL):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_hero_img" value="<?php echo esc_attr( $hero_img ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>

		<div style="background: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 4px;">
			<h4 style="margin: 0 0 10px 0; color: #135e96;"><?php esc_html_e( 'بيانات الكاتب / المعماري المشرف (Author / Principal)', 'blockskit-child' ); ?></h4>
			<p>
				<label><strong><?php esc_html_e( 'اسم الكاتب بالعربي (Author Name AR):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_author_name" value="<?php echo esc_attr( $author_name_ar ); ?>" style="width: 100%;" placeholder="م. خالد الفيصل" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'اسم الكاتب بالإنجليزية (Author Name EN):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_author_name_en" value="<?php echo esc_attr( $author_name_en ); ?>" style="width: 100%;" dir="ltr" placeholder="Arch. Khaled Al-Faisal" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'الرتبة والمسؤولية بالعربي (Author Role AR):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_author_role" value="<?php echo esc_attr( $author_role_ar ); ?>" style="width: 100%;" placeholder="كبير المعماريين والشريك المؤسس" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'Author Role in English:', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_author_role_en" value="<?php echo esc_attr( $author_role_en ); ?>" style="width: 100%;" dir="ltr" placeholder="Principal Architect & Partner" />
			</p>
			<p>
				<label><strong><?php esc_html_e( 'رابط صورة الكاتب الشخصية (Author Avatar URL):', 'blockskit-child' ); ?></strong></label><br>
				<input type="text" name="_article_author_img" value="<?php echo esc_attr( $author_img ); ?>" style="width: 100%;" dir="ltr" />
			</p>
		</div>
	</div>

	<?php
	$faqs_ar = get_post_meta( $post->ID, '_article_faqs_ar', true );
	if ( ! is_array( $faqs_ar ) ) {
		$faqs_ar = array();
	}
	$faqs_en = get_post_meta( $post->ID, '_article_faqs_en', true );
	if ( ! is_array( $faqs_en ) ) {
		$faqs_en = array();
	}
	?>
	<div style="background: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 4px; margin-top: 16px;">
		<h4 style="margin: 0 0 12px 0; color: #135e96;"><?php esc_html_e( 'الأسئلة الشائعة للمقال (Article FAQ Accordion — Schema.org FAQPage)', 'blockskit-child' ); ?></h4>
		<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
			<div>
				<p style="margin-top:0;"><strong><?php esc_html_e( 'الأسئلة الشائعة (بالعربية):', 'blockskit-child' ); ?></strong></p>
				<?php for ( $i = 0; $i < 5; $i++ ) :
					$q_ar = isset( $faqs_ar[ $i ]['q'] ) ? $faqs_ar[ $i ]['q'] : '';
					$a_ar = isset( $faqs_ar[ $i ]['a'] ) ? $faqs_ar[ $i ]['a'] : '';
				?>
					<div style="background: #f9f9f9; border: 1px solid #e5e5e5; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
						<label style="font-size:12px; font-weight:600;">سؤال #<?php echo (int) ( $i + 1 ); ?>:</label>
						<input type="text" name="_article_faqs_ar[<?php echo (int) $i; ?>][q]" value="<?php echo esc_attr( $q_ar ); ?>" style="width:100%; margin-bottom:6px;" placeholder="أدخل السؤال بالعربية..." />
						<label style="font-size:12px; font-weight:600;">الإجابة:</label>
						<textarea name="_article_faqs_ar[<?php echo (int) $i; ?>][a]" rows="2" style="width:100%;" placeholder="أدخل الإجابة التفصيلية..."><?php echo esc_textarea( $a_ar ); ?></textarea>
					</div>
				<?php endfor; ?>
			</div>
			<div dir="ltr">
				<p style="margin-top:0;"><strong><?php esc_html_e( 'Frequently Asked Questions (English):', 'blockskit-child' ); ?></strong></p>
				<?php for ( $i = 0; $i < 5; $i++ ) :
					$q_en = isset( $faqs_en[ $i ]['q'] ) ? $faqs_en[ $i ]['q'] : '';
					$a_en = isset( $faqs_en[ $i ]['a'] ) ? $faqs_en[ $i ]['a'] : '';
				?>
					<div style="background: #f9f9f9; border: 1px solid #e5e5e5; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
						<label style="font-size:12px; font-weight:600;">Question #<?php echo (int) ( $i + 1 ); ?>:</label>
						<input type="text" name="_article_faqs_en[<?php echo (int) $i; ?>][q]" value="<?php echo esc_attr( $q_en ); ?>" style="width:100%; margin-bottom:6px;" placeholder="Enter question in English..." />
						<label style="font-size:12px; font-weight:600;">Answer:</label>
						<textarea name="_article_faqs_en[<?php echo (int) $i; ?>][a]" rows="2" style="width:100%;" placeholder="Enter detailed answer..."><?php echo esc_textarea( $a_en ); ?></textarea>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
	<?php
}

function interior_save_post_monograph_meta( $post_id ) {
	if ( ! isset( $_POST['interior_post_monograph_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['interior_post_monograph_nonce'] ), 'interior_save_post_monograph' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_keys = array(
		'_article_title_en',
		'_article_category_ar',
		'_article_category_en',
		'_article_read_time_ar',
		'_article_read_time_en',
		'_article_hero_img',
		'_article_author_name',
		'_article_author_name_en',
		'_article_author_role',
		'_article_author_role_en',
		'_article_author_img',
	);

	foreach ( $text_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}

	$textarea_keys = array(
		'_article_excerpt_en',
		'_article_content_en',
	);

	foreach ( $textarea_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, wp_kses_post( wp_unslash( $_POST[ $key ] ) ) );
		}
	}

	foreach ( array( '_article_faqs_ar', '_article_faqs_en' ) as $faq_key ) {
		if ( isset( $_POST[ $faq_key ] ) && is_array( $_POST[ $faq_key ] ) ) {
			$clean_faqs = array();
			foreach ( wp_unslash( $_POST[ $faq_key ] ) as $faq_item ) {
				$q = isset( $faq_item['q'] ) ? sanitize_text_field( $faq_item['q'] ) : '';
				$a = isset( $faq_item['a'] ) ? sanitize_textarea_field( $faq_item['a'] ) : '';
				if ( ! empty( $q ) && ! empty( $a ) ) {
					$clean_faqs[] = array(
						'q' => $q,
						'a' => $a,
					);
				}
			}
			update_post_meta( $post_id, $faq_key, $clean_faqs );
		}
	}
}
add_action( 'save_post_post', 'interior_save_post_monograph_meta' );

// Custom Admin Columns for Posts
function interior_posts_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb']        = $columns['cb'];
	$new_columns['hero']      = __( 'الغلاف المعماري', 'blockskit-child' );
	$new_columns['title']     = $columns['title'];
	$new_columns['cat_badge'] = __( 'التصنيف', 'blockskit-child' );
	$new_columns['read_time'] = __( 'زمن القراءة', 'blockskit-child' );
	$new_columns['author_col'] = __( 'المعماري المشرف', 'blockskit-child' );
	$new_columns['date']      = $columns['date'];
	return $new_columns;
}
add_filter( 'manage_posts_columns', 'interior_posts_admin_columns' );

function interior_posts_custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		case 'hero':
			$hero = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $post_id ) : get_the_post_thumbnail_url( $post_id, 'thumbnail' );
			if ( ! empty( $hero ) ) {
				echo '<img src="' . esc_url( $hero ) . '" style="width: 56px; height: 38px; object-fit: cover; border-radius: 3px; border: 1px solid #ccc;" />';
			} else {
				echo '—';
			}
			break;
		case 'cat_badge':
			$cat = function_exists( 'interior_get_article_category' ) ? interior_get_article_category( $post_id ) : '';
			echo '<span style="background: #eef2f5; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; color: #2271b1;">' . esc_html( $cat ) . '</span>';
			break;
		case 'read_time':
			$time = function_exists( 'interior_get_article_read_time' ) ? interior_get_article_read_time( $post_id ) : '';
			echo '<span style="font-family: monospace; font-size: 12px;">' . esc_html( $time ) . '</span>';
			break;
		case 'author_col':
			$name = function_exists( 'interior_get_article_author_name' ) ? interior_get_article_author_name( $post_id ) : '';
			$role = function_exists( 'interior_get_article_author_role' ) ? interior_get_article_author_role( $post_id ) : '';
			echo '<strong>' . esc_html( $name ) . '</strong><br><span style="color: #666; font-size: 11px;">' . esc_html( $role ) . '</span>';
			break;
	}
}
add_action( 'manage_posts_custom_column', 'interior_posts_custom_columns_content', 10, 2 );


