<?php
/**
 * The Template for displaying Single Architectural Monographs / Articles (Posts)
 * UX Architecture modeled after high-converting editorial authority layout,
 * tailored to INTERIOR's sovereign dark luxury identity.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'luxury-dark-theme single-monograph-body' ); ?>>
<?php wp_body_open(); ?>

<!-- Top Reading Progress Bar -->
<div class="article-progress" aria-hidden="true">
	<span class="article-progress__bar" id="luxe-reading-progress"></span>
</div>

<?php get_template_part( 'template-parts/header-luxury' ); ?>

<main id="main-content" class="site-main article-detail-page">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id        = get_the_ID();
		$is_en          = ( function_exists( 'interior_get_current_lang' ) && 'en' === interior_get_current_lang() );
		$article_title  = function_exists( 'interior_get_article_title' ) ? interior_get_article_title( $post_id ) : get_the_title();
		$article_lead   = function_exists( 'interior_get_article_excerpt' ) ? interior_get_article_excerpt( $post_id ) : get_the_excerpt();
		$article_cat    = function_exists( 'interior_get_article_category' ) ? interior_get_article_category( $post_id ) : 'دراسات معمارية';
		$read_time      = function_exists( 'interior_get_article_read_time' ) ? interior_get_article_read_time( $post_id ) : ( $is_en ? '6 min read' : '6 دقائق قراءة' );
		$author_name    = function_exists( 'interior_get_article_author_name' ) ? interior_get_article_author_name( $post_id ) : 'م. خالد الفيصل';
		$author_role    = function_exists( 'interior_get_article_author_role' ) ? interior_get_article_author_role( $post_id ) : 'كبير المعماريين';
		$author_img     = function_exists( 'interior_get_article_author_img' ) ? interior_get_article_author_img( $post_id ) : ( get_stylesheet_directory_uri() . '/assets/images/luxe_team_khaled_alfaisal.jpg' );
		$hero_img       = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $post_id ) : ( get_stylesheet_directory_uri() . '/assets/images/luxe_joinery_detail.jpg' );
		$raw_content    = function_exists( 'interior_get_article_content' ) ? interior_get_article_content( $post_id ) : get_the_content();
		$faqs           = function_exists( 'interior_get_article_faqs' ) ? interior_get_article_faqs( $post_id ) : array();
		$current_url    = function_exists( 'interior_get_article_permalink' ) ? interior_get_article_permalink( $post_id ) : get_permalink( $post_id );

		// Western Arabic Numerals (0-9) Date formatting
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
		$day_num      = get_the_date( 'j', $post_id );
		$month_num    = (int) get_the_date( 'n', $post_id );
		$year_num     = get_the_date( 'Y', $post_id );
		$date_display = $is_en
			? ( $day_num . ' ' . ( $en_months[ $month_num ] ?? '' ) . ' ' . $year_num )
			: ( $day_num . ' ' . ( $ar_months[ $month_num ] ?? '' ) . ' ' . $year_num );
		$iso_date     = get_the_date( 'c', $post_id );
		$mod_date     = get_the_modified_date( 'c', $post_id );

		// Process content headings to build automatic Table of Contents (TOC) with anchor IDs
		$toc_items     = array();
		$heading_index = 0;
		$processed_content = preg_replace_callback(
			'/<h([23])([^>]*)>(.*?)<\/h\1>/is',
			function ( $matches ) use ( &$toc_items, &$heading_index ) {
				$heading_index++;
				$level = (int) $matches[1];
				$attrs = $matches[2];
				$inner = $matches[3];
				$clean = trim( wp_strip_all_tags( $inner ) );

				if ( preg_match( '/id=["\']([^"\']+)["\']/i', $attrs, $id_match ) ) {
					$anchor_id = $id_match[1];
				} else {
					$anchor_id = 'article-section-' . $heading_index;
					$attrs    .= ' id="' . esc_attr( $anchor_id ) . '"';
				}

				if ( ! empty( $clean ) && 2 === $level ) {
					$toc_items[] = array(
						'id'    => $anchor_id,
						'level' => $level,
						'title' => $clean,
					);
				}

				return '<h' . $level . $attrs . '>' . $inner . '</h' . $level . '>';
			},
			$raw_content
		);

		$faq_heading_text = $is_en ? 'Frequently Asked Questions' : 'أسئلة شائعة';
		if ( ! empty( $faqs ) ) {
			$toc_items[] = array(
				'id'    => 'article-faq-section',
				'level' => 2,
				'title' => $faq_heading_text,
			);
		}

		// Structured Data: BlogPosting + BreadcrumbList + FAQPage
		$article_schema = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'@id'              => $current_url . '#article',
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $current_url,
			),
			'headline'         => $article_title,
			'description'      => wp_strip_all_tags( $article_lead ),
			'image'            => array( $hero_img ),
			'datePublished'    => $iso_date,
			'dateModified'     => $mod_date,
			'inLanguage'       => $is_en ? 'en-US' : 'ar-SA',
			'articleSection'   => $article_cat,
			'author'           => array(
				'@type'    => 'Person',
				'name'     => $author_name,
				'jobTitle' => $author_role,
				'image'    => $author_img,
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => 'INTERIOR Architectural Studio',
				'url'   => home_url( '/' ),
			),
		);

		$breadcrumb_schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => $is_en ? 'Home' : 'الرئيسية',
					'item'     => function_exists( 'interior_url' ) ? interior_url( '/' ) : home_url( '/' ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => $is_en ? 'Articles' : 'المقالات',
					'item'     => home_url( '/articles/' ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 3,
					'name'     => $article_title,
					'item'     => $current_url,
				),
			),
		);

		$faq_entities = array();
		foreach ( $faqs as $faq_item ) {
			$faq_entities[] = array(
				'@type'          => 'Question',
				'name'           => $faq_item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $faq_item['a'],
				),
			);
		}
		?>
		<script type="application/ld+json"><?php echo wp_json_encode( $article_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
		<script type="application/ld+json"><?php echo wp_json_encode( $breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
		<?php if ( ! empty( $faq_entities ) ) : ?>
			<script type="application/ld+json"><?php echo wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_entities ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
		<?php endif; ?>

		<article class="article-detail" id="post-<?php echo esc_attr( $post_id ); ?>">
			<!-- 1. Unified Atmospheric Hero -->
			<header class="article-detail__hero">
				<div class="container">
					<!-- Breadcrumbs -->
					<nav class="breadcrumbs" aria-label="<?php echo esc_attr( $is_en ? 'Breadcrumb' : 'مسار التنقل' ); ?>">
						<ol class="breadcrumbs__list">
							<li class="breadcrumbs__item">
								<a class="breadcrumbs__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php echo esc_html( $is_en ? 'Home' : 'الرئيسية' ); ?>
								</a>
							</li>
							<li class="breadcrumbs__item">
								<a class="breadcrumbs__link" href="<?php echo esc_url( home_url( '/articles/' ) ); ?>">
									<?php echo esc_html( $is_en ? 'Articles' : 'المقالات' ); ?>
								</a>
							</li>
							<li class="breadcrumbs__item">
								<span class="breadcrumbs__current" aria-current="page"><?php echo esc_html( $article_title ); ?></span>
							</li>
						</ol>
					</nav>

					<!-- Centered H1 & Hero Meta Strip -->
					<div class="article-detail__hero-content">
						<div class="article-detail__hero-main">
							<h1 class="article-detail__title"><?php echo esc_html( $article_title ); ?></h1>

							<div class="article-meta article-meta--hero" aria-label="<?php echo esc_attr( $is_en ? 'Article Details' : 'بيانات المقال' ); ?>">
								<div class="article-meta__author">
									<img class="article-meta__avatar" src="<?php echo esc_url( $author_img ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" width="44" height="44" loading="lazy" decoding="async">
									<div class="article-meta__author-copy">
										<span class="article-meta__author-name"><?php echo esc_html( $author_name ); ?></span>
									</div>
								</div>

								<div class="article-meta__item">
									<span class="article-meta__icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
											<rect x="3" y="4" width="18" height="18" rx="2"></rect>
											<path d="M16 2v4M8 2v4M3 10h18"></path>
										</svg>
									</span>
									<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $post_id ) ); ?>"><?php echo esc_html( $date_display ); ?></time>
								</div>

								<div class="article-meta__item">
									<span class="article-meta__icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
											<circle cx="12" cy="12" r="9"></circle>
											<path d="M12 7v5l3 2"></path>
										</svg>
									</span>
									<span><?php echo esc_html( $read_time ); ?></span>
								</div>

								<div class="article-meta__item">
									<span class="article-meta__icon" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
											<path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z"></path>
										</svg>
									</span>
									<span><?php echo esc_html( $article_cat ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<!-- 2. Floating Overlapping 16:9 Cover Image -->
			<div class="article-floating-cover">
				<div class="container">
					<figure class="article-cover article-cover--floating">
						<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( $article_title ); ?>" width="1200" height="675" fetchpriority="high" decoding="async">
					</figure>
				</div>
			</div>

			<!-- 3. Centered Reading Frame + Sticky Share Rail -->
			<div class="article-detail__reading">
				<div class="container">
					<div class="article-detail__frame">
						<!-- Column 1: Sticky Vertical Social Share Rail -->
						<aside class="article-share" aria-label="<?php echo esc_attr( $is_en ? 'Share Article' : 'مشاركة المقال' ); ?>">
							<a class="article-share__button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( $current_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $is_en ? 'Share on Facebook' : 'مشاركة على فيسبوك' ); ?>" title="<?php echo esc_attr( $is_en ? 'Share on Facebook' : 'مشاركة على فيسبوك' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7h2.4l.4-3h-2.8V9.2c0-.9.3-1.5 1.6-1.5H16V5.1c-.3 0-1.2-.1-2.2-.1-2.2 0-3.8 1.3-3.8 3.9V11H7.5v3H10v7h3.5z" fill="currentColor"></path></svg>
							</a>
							<a class="article-share__button" href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( $current_url ); ?>&text=<?php echo rawurlencode( $article_title ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $is_en ? 'Share on X' : 'مشاركة على إكس' ); ?>" title="<?php echo esc_attr( $is_en ? 'Share on X' : 'مشاركة على إكس' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 4H21l-4.6 5.3L21.8 20h-4.2l-3.3-6.4L8.8 20H6.7l5-5.7L2.4 4h4.3l3 5.8L14.9 4h4zm-1.5 14.3h1.2L6.4 5.6H5.1l12.3 12.7z" fill="currentColor"></path></svg>
							</a>
							<a class="article-share__button" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( $current_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $is_en ? 'Share on LinkedIn' : 'مشاركة على لينكدإن' ); ?>" title="<?php echo esc_attr( $is_en ? 'Share on LinkedIn' : 'مشاركة على لينكدإن' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.9 8.5a1.9 1.9 0 1 1 0-3.8 1.9 1.9 0 0 1 0 3.8zM5.3 10h3.2v9H5.3v-9zm5.2 0h3.1v1.2h.1c.4-.8 1.5-1.5 3.1-1.5 3.3 0 3.9 2.1 3.9 4.9V19h-3.2v-3.9c0-.9 0-2.1-1.3-2.1s-1.5 1-1.5 2V19h-3.2v-9z" fill="currentColor"></path></svg>
							</a>
							<a class="article-share__button" href="https://api.whatsapp.com/send?text=<?php echo rawurlencode( $article_title . ' - ' . $current_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $is_en ? 'Share on WhatsApp' : 'مشاركة عبر واتساب' ); ?>" title="<?php echo esc_attr( $is_en ? 'Share on WhatsApp' : 'مشاركة عبر واتساب' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11.9A8 8 0 0 0 6.2 6.3a7.9 7.9 0 0 0-1.1 8.9L4 20l4.9-1.1a8 8 0 0 0 11.1-7zm-8 6.5a6.6 6.6 0 0 1-3.4-.9l-.2-.1-2.9.6.6-2.8-.2-.3a6.5 6.5 0 1 1 6.1 3.5zm3.6-4.9c-.2-.1-1.2-.6-1.4-.7-.2-.1-.3-.1-.5.1l-.6.7c-.1.2-.2.2-.4.1a5.3 5.3 0 0 1-2.6-2.3c-.2-.3 0-.3.1-.5l.5-.6c.1-.2.1-.3 0-.5l-.6-1.4c-.2-.3-.3-.3-.5-.3h-.4a.8.8 0 0 0-.6.3 2.4 2.4 0 0 0-.7 1.8c0 1 .7 2.1.8 2.2.1.2 1.4 2.2 3.5 3 .5.2.9.3 1.2.4.5.2 1 .1 1.3.1.4-.1 1.2-.5 1.4-1 .2-.4.2-.8.1-.9-.1-.1-.2-.2-.4-.3z" fill="currentColor"></path></svg>
							</a>
							<button class="article-share__button" type="button" data-copy-link="<?php echo esc_url( $current_url ); ?>" aria-label="<?php echo esc_attr( $is_en ? 'Copy Link' : 'نسخ رابط المقال' ); ?>" title="<?php echo esc_attr( $is_en ? 'Copy Link' : 'نسخ رابط المقال' ); ?>">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M10 13a5 5 0 0 0 7.1 0l2.8-2.8a5 5 0 0 0-7.1-7.1L11.2 4.7"></path>
									<path d="M14 11a5 5 0 0 0-7.1 0l-2.8 2.8a5 5 0 1 0 7.1 7.1l1.6-1.6"></path>
								</svg>
							</button>
						</aside>

						<!-- Column 2: Main Article Elevated Card -->
						<div class="article-main-content">
							<!-- A. Collapsible Table of Contents -->
							<?php if ( ! empty( $toc_items ) ) : ?>
								<details class="article-toc">
									<summary>
										<span class="article-toc__title">
											<span class="article-toc__title-icon" aria-hidden="true">
												<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
													<path d="M8 6h13M8 12h13M8 18h13"></path>
													<circle cx="4" cy="6" r="1"></circle>
													<circle cx="4" cy="12" r="1"></circle>
													<circle cx="4" cy="18" r="1"></circle>
												</svg>
											</span>
											<span><?php echo esc_html( $is_en ? 'Table of Contents' : 'محتويات المقال' ); ?></span>
										</span>
										<span class="article-toc__toggle-icon" aria-hidden="true"></span>
									</summary>
									<ol class="article-toc__list">
										<?php foreach ( $toc_items as $toc ) : ?>
											<li class="article-toc__item article-toc__item--level-<?php echo (int) $toc['level']; ?>">
												<a href="#<?php echo esc_attr( $toc['id'] ); ?>"><?php echo esc_html( $toc['title'] ); ?></a>
											</li>
										<?php endforeach; ?>
									</ol>
								</details>
							<?php endif; ?>

							<!-- B. Rich Prose Content -->
							<div class="article-prose">
								<?php if ( ! empty( $article_lead ) ) : ?>
									<p class="article-prose__lead"><?php echo esc_html( $article_lead ); ?></p>
								<?php endif; ?>

								<?php echo wp_kses_post( $processed_content ); ?>
							</div>

							<!-- C. Interactive FAQ Accordion -->
							<?php if ( ! empty( $faqs ) ) : ?>
								<section class="article-faq" id="article-faq-section" aria-labelledby="article-faq-title">
									<div class="article-faq__head">
										<h2 class="article-faq__title" id="article-faq-title">
											<?php echo esc_html( $faq_heading_text ); ?>
										</h2>
									</div>
									<div class="accordion article-faq__accordion">
										<?php foreach ( $faqs as $idx => $faq ) :
											$faq_id      = 'faq-panel-' . $post_id . '-' . ( $idx + 1 );
											$trigger_id  = 'faq-trigger-' . $post_id . '-' . ( $idx + 1 );
											$is_expanded = ( 0 === $idx );
										?>
											<div class="accordion__item <?php echo $is_expanded ? 'is-open' : ''; ?>">
												<h3 class="accordion__header">
													<button class="accordion__trigger" type="button" id="<?php echo esc_attr( $trigger_id ); ?>" aria-expanded="<?php echo $is_expanded ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $faq_id ); ?>">
														<span class="accordion__title"><?php echo esc_html( $faq['q'] ); ?></span>
														<span class="accordion__icon" aria-hidden="true"></span>
													</button>
												</h3>
												<div class="accordion__panel" id="<?php echo esc_attr( $faq_id ); ?>" role="region" aria-labelledby="<?php echo esc_attr( $trigger_id ); ?>" <?php echo $is_expanded ? '' : 'hidden'; ?>>
													<div class="accordion__content">
														<p><?php echo esc_html( $faq['a'] ); ?></p>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</section>
							<?php endif; ?>

							<!-- D. Author Card Footer -->
							<footer class="article-author-card" aria-label="<?php echo esc_attr( $is_en ? 'Article Author' : 'كاتب المقال' ); ?>">
								<img class="article-author-card__avatar" src="<?php echo esc_url( $author_img ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" width="64" height="64" loading="lazy">
								<div class="article-author-card__body">
									<span class="article-author-card__eyebrow"><?php echo esc_html( $is_en ? 'Written by' : 'بقلم' ); ?></span>
									<h2 class="article-author-card__name"><?php echo esc_html( $author_name ); ?></h2>
									<p class="article-author-card__role"><?php echo esc_html( $author_role ); ?></p>
								</div>
							</footer>
						</div>
					</div>
				</div>
			</div>
		</article>

		<!-- 4. Related Articles Grid (3 Cards) -->
		<?php
		$related_query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post__not_in'   => array( $post_id ),
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );
		if ( $related_query->have_posts() ) :
		?>
			<section class="section article-related" aria-labelledby="related-articles-title">
				<div class="container">
					<header class="section-header">
						<h2 class="section-title" id="related-articles-title">
							<?php echo esc_html( $is_en ? 'Related Articles' : 'مقالات ذات صلة' ); ?>
						</h2>
					</header>

					<div class="article-related__grid">
						<?php
						while ( $related_query->have_posts() ) :
							$related_query->the_post();
							$rel_id       = get_the_ID();
							$rel_title    = function_exists( 'interior_get_article_title' ) ? interior_get_article_title( $rel_id ) : get_the_title();
							$rel_excerpt  = function_exists( 'interior_get_article_excerpt' ) ? interior_get_article_excerpt( $rel_id ) : get_the_excerpt();
							$rel_cat      = function_exists( 'interior_get_article_category' ) ? interior_get_article_category( $rel_id ) : 'دراسات معمارية';
							$rel_time     = function_exists( 'interior_get_article_read_time' ) ? interior_get_article_read_time( $rel_id ) : '6 دقائق قراءة';
							$rel_img      = function_exists( 'interior_get_article_hero_img' ) ? interior_get_article_hero_img( $rel_id ) : '';
							$rel_author   = function_exists( 'interior_get_article_author_name' ) ? interior_get_article_author_name( $rel_id ) : 'م. خالد الفيصل';
							$rel_url      = function_exists( 'interior_get_article_permalink' ) ? interior_get_article_permalink( $rel_id ) : get_permalink( $rel_id );

							$r_day        = get_the_date( 'j', $rel_id );
							$r_month      = (int) get_the_date( 'n', $rel_id );
							$r_year       = get_the_date( 'Y', $rel_id );
							$rel_date_str = $is_en
								? ( $r_day . ' ' . ( $en_months[ $r_month ] ?? '' ) . ' ' . $r_year )
								: ( $r_day . ' ' . ( $ar_months[ $r_month ] ?? '' ) . ' ' . $r_year );
						?>
							<article class="article-card">
								<a class="article-card__media" href="<?php echo esc_url( $rel_url ); ?>">
									<img src="<?php echo esc_url( $rel_img ); ?>" alt="<?php echo esc_attr( $rel_title ); ?>" width="640" height="360" loading="lazy" decoding="async">
								</a>
								<div class="article-card__body">
									<div class="article-card__meta">
										<span class="badge"><?php echo esc_html( $rel_cat ); ?></span>
										<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $rel_id ) ); ?>"><?php echo esc_html( $rel_date_str ); ?></time>
										<span><?php echo esc_html( $rel_time ); ?></span>
									</div>
									<h3 class="article-card__title">
										<a href="<?php echo esc_url( $rel_url ); ?>"><?php echo esc_html( $rel_title ); ?></a>
									</h3>
									<p class="article-card__excerpt"><?php echo esc_html( wp_trim_words( $rel_excerpt, 20, '...' ) ); ?></p>
									<div class="article-card__footer">
										<span class="article-card__author">
											<?php echo esc_html( ( $is_en ? 'By ' : 'بقلم ' ) . $rel_author ); ?>
										</span>
										<a class="article-card__link" href="<?php echo esc_url( $rel_url ); ?>">
											<?php echo esc_html( $is_en ? 'Read More →' : 'اقرأ المزيد ←' ); ?>
										</a>
									</div>
								</div>
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	<?php endwhile; ?>
</main>

<script>
(function() {
	if (window.InteriorArticleFaq && typeof window.InteriorArticleFaq.init === 'function') {
		window.InteriorArticleFaq.init();
		return;
	}

	// Reading Progress Bar
	var bar = document.getElementById('luxe-reading-progress');
	if (bar) {
		window.addEventListener('scroll', function() {
			var docHeight = document.documentElement.scrollHeight - window.innerHeight;
			if (docHeight > 0) {
				var pct = Math.min(100, Math.max(0, (window.scrollY / docHeight) * 100));
				bar.style.width = pct + '%';
			}
		}, { passive: true });
	}

	// Delegated FAQ Accordion click
	document.addEventListener('click', function(e) {
		var btn = e.target.closest('.article-faq .accordion__trigger');
		if (!btn) return;
		e.preventDefault();

		var item = btn.closest('.accordion__item');
		var container = btn.closest('.article-faq__accordion');
		var panelId = btn.getAttribute('aria-controls');
		var panel = panelId ? document.getElementById(panelId) : (item ? item.querySelector('.accordion__panel') : null);
		var isOpen = btn.getAttribute('aria-expanded') === 'true';

		if (!isOpen && container) {
			container.querySelectorAll('.accordion__item').forEach(function(other) {
				if (other !== item) {
					other.classList.remove('is-open');
					var obtn = other.querySelector('.accordion__trigger');
					if (obtn) obtn.setAttribute('aria-expanded', 'false');
					var opanelId = obtn ? obtn.getAttribute('aria-controls') : null;
					var opanel = opanelId ? document.getElementById(opanelId) : other.querySelector('.accordion__panel');
					if (opanel) opanel.setAttribute('hidden', '');
				}
			});
		}

		btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
		if (item) item.classList.toggle('is-open', !isOpen);
		if (panel) {
			if (isOpen) {
				panel.setAttribute('hidden', '');
			} else {
				panel.removeAttribute('hidden');
			}
		}
	});

	// Copy Article Link Button
	document.addEventListener('click', function(e) {
		var copyBtn = e.target.closest('[data-copy-link]');
		if (!copyBtn) return;
		var url = copyBtn.getAttribute('data-copy-link') || window.location.href;
		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(url).then(function() {
				copyBtn.classList.add('is-copied');
				setTimeout(function() { copyBtn.classList.remove('is-copied'); }, 2000);
			});
		}
	});
})();
</script>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
<?php wp_footer(); ?>
</body>
</html>
