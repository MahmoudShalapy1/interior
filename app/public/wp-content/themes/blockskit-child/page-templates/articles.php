<?php
/**
 * Template Name: Luxury Articles Page
 * Description: Dedicated Editorial Archive & Architectural Monographs Page (/articles/ & /en/articles/).
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/header-luxury' );
$img_dir = get_stylesheet_directory_uri() . '/assets/images/';
$is_en   = ( 'en' === ( function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar' ) );

$ar_months = array(
	1  => 'يناير',
	2  => 'فبراير',
	3  => 'مارس',
	4  => 'أبريل',
	5  => 'مايو',
	6  => 'يونيو',
	7  => 'يوليو',
	8  => 'أغسطس',
	9  => 'سبتمبر',
	10 => 'أكتوبر',
	11 => 'نوفمبر',
	12 => 'ديسمبر',
);
$en_months = array(
	1  => 'January',
	2  => 'February',
	3  => 'March',
	4  => 'April',
	5  => 'May',
	6  => 'June',
	7  => 'July',
	8  => 'August',
	9  => 'September',
	10 => 'October',
	11 => 'November',
	12 => 'December',
);
?>

<main class="luxe-main" id="main-content" tabindex="-1" role="main">

	<!-- 01. Architectural Page Hero (Fullscreen 100vh, Vertically Centered) -->
	<section class="luxe-hero" id="articles-hero">
		<div class="luxe-hero__viewport">
			<img src="<?php echo esc_url( $img_dir . 'luxe_marble_curation.jpg' ); ?>" alt="<?php echo esc_attr( $is_en ? 'Architectural Monographs & Editorial Archive — INTERIOR' : 'المقالات والأبحاث المعمارية — إنتيريور' ); ?>" class="luxe-hero__bg" fetchpriority="high" decoding="async" />
		</div>

		<div class="luxe-container" style="position: relative; z-index: 10;">
			<div class="luxe-hero__content">
				<h1 class="luxe-hero__title">
					<?php echo $is_en
						? 'Editorial Archive & <span class="luxe-accent-serif">Architectural Monographs</span>.'
						: 'أرشيف <span class="luxe-accent-serif">المقالات والدراسات</span> المعمارية.'; ?>
				</h1>

				<p class="luxe-hero__lead">
					<?php echo $is_en
						? 'An authoritative series of architectural monographs documenting acoustic isolation protocols, rare Italian quarry curation, concealed shadow-gap detailing, and single-source turnkey governance.'
						: 'سلسلة معرفية وهندسية موثقة تضيء على أسرار التنفيذ السيادي، ومعايير العزل الصوتي الفندقي، ودلائل انتقاء الرخام الإيطالي النادر من المحاجر، وحوكمة عقود تسليم المفتاح.'; ?>
				</p>

				<div class="luxe-hero__actions">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
						<span><?php echo $is_en ? 'Commission Private Architectural Study' : 'طلب دراسة معمارية خاصة'; ?></span>
						<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;"><?php echo $is_en ? '→' : '←'; ?></span>
					</a>
					<a href="#articles-archive" class="luxe-btn--text">
						<span><?php echo $is_en ? 'Browse All Published Articles' : 'تصفح جميع المقالات والدراسات'; ?></span>
						<span style="font-family: var(--font-mono); font-size: 11px;">↓</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 02. Editorial Filter & Articles Grid (Tone: Ink) -->
	<section class="luxe-section luxe-section--ink" id="articles-archive">
		<div class="luxe-container">

			<div class="luxe-portfolio-controls" style="margin-bottom: clamp(2.5rem, 4vw, 3.5rem);">
				<div class="luxe-filter-pills" id="articles-filter-pills">
					<button type="button" class="luxe-portfolio-filter-btn is-active" data-article-filter="all">
						<?php echo $is_en ? 'All Monographs' : 'جميع المقالات'; ?>
					</button>
					<button type="button" class="luxe-portfolio-filter-btn" data-article-filter="arch">
						<?php echo $is_en ? 'Architectural Engineering' : 'الهندسة المعمارية'; ?>
					</button>
					<button type="button" class="luxe-portfolio-filter-btn" data-article-filter="materials">
						<?php echo $is_en ? 'Material Provenance' : 'مصادر الخامات'; ?>
					</button>
					<button type="button" class="luxe-portfolio-filter-btn" data-article-filter="acoustics">
						<?php echo $is_en ? 'Executive Engineering' : 'الهندسة التنفيذية'; ?>
					</button>
					<button type="button" class="luxe-portfolio-filter-btn" data-article-filter="governance">
						<?php echo $is_en ? 'Investment Governance' : 'حوكمة الاستثمار'; ?>
					</button>
				</div>
			</div>

			<?php
			$articles_query = new WP_Query( array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );
			?>

			<div class="article-related__grid" id="articles-archive-grid">
				<?php
				if ( $articles_query->have_posts() ) :
					while ( $articles_query->have_posts() ) :
						$articles_query->the_post();
						$art_id      = get_the_ID();
						$art_title   = function_exists( 'interior_get_article_title' ) ? interior_get_article_title( $art_id ) : get_the_title();
						$art_excerpt = function_exists( 'interior_get_article_excerpt' ) ? interior_get_article_excerpt( $art_id ) : get_the_excerpt();
						$art_cat     = function_exists( 'interior_get_article_category' ) ? interior_get_article_category( $art_id ) : 'دراسات معمارية';
						$art_cat_ar  = get_post_meta( $art_id, '_article_category_ar', true );
						$art_read    = function_exists( 'interior_get_article_read_time' ) ? interior_get_article_read_time( $art_id ) : '6 دقائق قراءة';
						$art_hero    = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $art_id ) : '';
						$art_author  = function_exists( 'interior_get_article_author_name' ) ? interior_get_article_author_name( $art_id ) : 'م. خالد الفيصل';
						$art_role    = function_exists( 'interior_get_article_author_role' ) ? interior_get_article_author_role( $art_id ) : 'كبير المعماريين';
						$art_avatar  = function_exists( 'interior_get_article_author_img' ) ? interior_get_article_author_img( $art_id ) : '';
						$art_url     = function_exists( 'interior_get_article_permalink' ) ? interior_get_article_permalink( $art_id ) : get_permalink( $art_id );

						$a_day       = get_the_date( 'j', $art_id );
						$a_month     = (int) get_the_date( 'n', $art_id );
						$a_year      = get_the_date( 'Y', $art_id );
						$art_date    = $is_en
							? ( $a_day . ' ' . ( $en_months[ $a_month ] ?? '' ) . ' ' . $a_year )
							: ( $a_day . ' ' . ( $ar_months[ $a_month ] ?? '' ) . ' ' . $a_year );

						$filter_key  = 'arch';
						if ( false !== strpos( $art_cat_ar, 'خامات' ) ) {
							$filter_key = 'materials';
						} elseif ( false !== strpos( $art_cat_ar, 'تنفيذ' ) ) {
							$filter_key = 'acoustics';
						} elseif ( false !== strpos( $art_cat_ar, 'حوكمة' ) || false !== strpos( $art_cat_ar, 'استثمار' ) ) {
							$filter_key = 'governance';
						}
						?>
						<article class="article-card" data-article-cat="<?php echo esc_attr( $filter_key ); ?>">
							<a class="article-card__media" href="<?php echo esc_url( $art_url ); ?>">
								<img src="<?php echo esc_url( $art_hero ); ?>" alt="<?php echo esc_attr( $art_title ); ?>" width="640" height="360" loading="lazy" decoding="async">
							</a>
							<div class="article-card__body">
								<div class="article-card__meta">
									<span class="badge"><?php echo esc_html( $art_cat ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $art_id ) ); ?>"><?php echo esc_html( $art_date ); ?></time>
									<span><?php echo esc_html( $art_read ); ?></span>
								</div>
								<h2 class="article-card__title">
									<a href="<?php echo esc_url( $art_url ); ?>"><?php echo esc_html( $art_title ); ?></a>
								</h2>
								<p class="article-card__excerpt"><?php echo esc_html( wp_trim_words( $art_excerpt, 24, '...' ) ); ?></p>
								<div class="article-card__footer">
									<div style="display: inline-flex; align-items: center; gap: 0.65rem;">
										<img src="<?php echo esc_url( $art_avatar ); ?>" alt="<?php echo esc_attr( $art_author ); ?>" width="34" height="34" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--interior-brass);" loading="lazy">
										<div style="display: flex; flex-direction: column;">
											<span style="font-size: 0.85rem; font-weight: 700; color: var(--interior-bone);"><?php echo esc_html( $art_author ); ?></span>
											<span style="font-size: 0.75rem; color: var(--interior-text-muted);"><?php echo esc_html( $art_role ); ?></span>
										</div>
									</div>
									<a class="article-card__link" href="<?php echo esc_url( $art_url ); ?>">
										<?php echo esc_html( $is_en ? 'Read Article →' : 'اقرأ المقال ←' ); ?>
									</a>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>

		</div>
	</section>

	<!-- 03. Call to Action Strip (Tone: Charcoal) -->
	<section class="luxe-section luxe-section--charcoal" style="text-align: center; padding-block: clamp(6rem, 10vw, 10rem);">
		<div class="luxe-container">
			<span class="luxe-meta-latin" style="display: block; margin-bottom: 0.75rem;">
				<?php echo $is_en ? 'Bespoke Advisory · Sovereign Engineering' : 'الاستشارات الهندسية الخاصة · دقة تنفيذية مطلقة'; ?>
			</span>
			<h2 style="font-family: var(--font-heading); font-size: var(--text-4xl); margin-bottom: 1.5rem; color: var(--interior-bone);">
				<?php echo $is_en
					? 'Ready to Transform Your <span class="luxe-accent-serif">Architectural Vision</span> Into Reality?'
					: 'هل تخطط لتنفيذ <span class="luxe-accent-serif">مشروعك السكني السيادي</span> بأعلى المعايير؟'; ?>
			</h2>
			<p style="max-width: 680px; margin: 0 auto 3.5rem; color: var(--interior-text-muted); font-size: var(--text-base); line-height: 1.9;">
				<?php echo $is_en
					? 'Schedule a confidential consultation with our founding partners and principal engineers to discuss the spatial, acoustic, and material specifications of your residence.'
					: 'احجز جلسة استشارية خاصة مع الشركاء المؤسسين وكبار المهندسين لمناقشة المتطلبات المعمارية والصوتية واختيارات الخامات النادرة لقصر المستقبل.'; ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="luxe-btn luxe-btn--solid">
				<span><?php echo $is_en ? 'Book a Private Studio Consultation' : 'حجز جلسة استشارية خاصة'; ?></span>
				<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px;"><?php echo $is_en ? '→' : '←'; ?></span>
			</a>
		</div>
	</section>
</main>

<script>
(function() {
	var btns = document.querySelectorAll('[data-article-filter]');
	var cards = document.querySelectorAll('[data-article-cat]');
	if (!btns.length || !cards.length) return;

	btns.forEach(function(btn) {
		btn.addEventListener('click', function() {
			var filter = btn.getAttribute('data-article-filter');
			btns.forEach(function(b) { b.classList.remove('is-active'); });
			btn.classList.add('is-active');

			cards.forEach(function(card) {
				if (filter === 'all' || card.getAttribute('data-article-cat') === filter) {
					card.style.display = '';
				} else {
					card.style.display = 'none';
				}
			});
		});
	});
})();
</script>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
