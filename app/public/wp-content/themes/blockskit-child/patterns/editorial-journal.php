<?php
/**
 * Title: INTERIOR — المونوغرافات والرؤى المعمارية (Editorial Journal & Monographs)
 * Slug: blockskit-child/editorial-journal
 * Categories: interior-editorial
 * Keywords: journal, monographs, articles, architecture, research, luxury, insights
 * Description: قسم المقالات والمونوغرافات التحريرية الموثقة بأعلى معايير Architectural Digest
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = function_exists( 'interior_get_current_lang' ) ? interior_get_current_lang() : 'ar';
$is_en = ( 'en' === $lang );
?>

<!-- Section 13: Architectural Monographs & Insights -->
<section class="luxe-journal-section" id="journal" aria-labelledby="journal-heading">
	<div class="luxe-container">
		<!-- Section Header -->
		<div class="luxe-journal-header luxe-reveal luxe-reveal-up">
			<div class="luxe-journal-header__main">
				<span class="luxe-meta-latin" data-i18n="journal_tag" style="display: block; margin-bottom: 0.75rem;">
					<?php echo $is_en ? '13 · Architectural Monographs & Research' : '13 · المونوغرافات والرؤى المعمارية'; ?>
				</span>
				<h2 id="journal-heading" class="luxe-journal-title" data-i18n="journal_title">
					<?php echo $is_en ? 'Documented Architectural Research: Detailing & Estate Governance.' : 'أبحاث معمارية موثقة: هندسة التفاصيل وحوكمة القصور.'; ?>
				</h2>
				<p class="luxe-journal-desc" data-i18n="journal_desc">
					<?php echo $is_en
						? 'In-depth monograph series illuminating sovereign fit-out secrets, concealed MEP systems, rare stone provenance, and turnkey budget governance.'
						: 'سلسلة مونوغرافات تحريرية متعمقة تضيء على أسرار التنفيذ الفائق، وهندسة فواصل الظل، ودلائل انتقاء الرخام النادر، وحوكمة الميزانيات السيادية.'; ?>
				</p>
			</div>
			<div class="luxe-journal-header__meta" style="display: flex; align-items: center; gap: 1.25rem;">
				<a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" class="luxe-btn luxe-btn-ghost" style="padding: 0.65rem 1.35rem; font-size: 0.85rem;">
					<span><?php echo $is_en ? 'Browse All Articles' : 'تصفح جميع المقالات'; ?></span>
					<span class="luxe-arrow-icon" style="font-family: var(--font-mono); font-size: 11px; margin-inline-start: 0.4rem;"><?php echo $is_en ? '→' : '←'; ?></span>
				</a>
			</div>
		</div>

		<!-- Monographs Grid -->
		<div class="luxe-journal-grid">
			<?php
			$journal_query = new WP_Query( array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 4,
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );

			if ( $journal_query->have_posts() ) :
				$j_idx = 1;
				while ( $journal_query->have_posts() ) :
					$journal_query->the_post();
					$art_id      = get_the_ID();
					$art_title   = interior_get_article_title( $art_id );
					$art_excerpt = interior_get_article_excerpt( $art_id );
					$art_cat     = interior_get_article_category( $art_id );
					$art_read    = interior_get_article_read_time( $art_id );
					$art_hero    = interior_get_article_hero_img( $art_id );
					$art_author  = interior_get_article_author_name( $art_id );
					$art_role    = interior_get_article_author_role( $art_id );
					$art_avatar  = interior_get_article_author_img( $art_id );
					$art_url     = get_permalink( $art_id );
					$art_date    = $is_en ? gmdate( 'j F Y', strtotime( get_post_field( 'post_date', $art_id ) ) ) : get_the_date( 'j F Y', $art_id );
					?>
					<article class="luxe-journal-card luxe-reveal luxe-reveal-up" data-luxe-delay="<?php echo esc_attr( $j_idx * 100 ); ?>" itemscope itemtype="https://schema.org/BlogPosting">
						<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c', $art_id ) ); ?>" />
						<meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( 'c', $art_id ) ); ?>" />
						
						<!-- Media Plate -->
						<a href="<?php echo esc_url( $art_url ); ?>" class="luxe-journal-card__media" tabindex="-1" aria-hidden="true">
							<img src="<?php echo esc_url( $art_hero ); ?>" alt="<?php echo esc_attr( $art_title ); ?>" loading="lazy" decoding="async" itemprop="image">
							<div class="luxe-journal-card__badges">
								<span class="luxe-journal-badge luxe-journal-badge--cat"><?php echo esc_html( $art_cat ); ?></span>
								<span class="luxe-journal-badge luxe-journal-badge--time"><?php echo esc_html( $art_read ); ?></span>
							</div>
						</a>

						<!-- Card Content -->
						<div class="luxe-journal-card__content">
							<div class="luxe-journal-card__meta">
								<span class="luxe-journal-date" style="font-family: var(--font-mono); font-size: 11px; color: var(--interior-text-muted);">
									<?php echo esc_html( $art_date ); ?>
								</span>
								<span class="luxe-journal-num" style="font-family: var(--font-mono); font-size: 11px; color: var(--interior-brass-light);">
									<?php echo sprintf( '%02d', $j_idx ); ?>
								</span>
							</div>

							<h3 class="luxe-journal-card__title" itemprop="headline">
								<a href="<?php echo esc_url( $art_url ); ?>">
									<?php echo esc_html( $art_title ); ?>
								</a>
							</h3>

							<p class="luxe-journal-card__excerpt" itemprop="description">
								<?php echo esc_html( wp_trim_words( $art_excerpt, 22, '...' ) ); ?>
							</p>

							<!-- Author Monograph Footnote -->
							<div class="luxe-journal-card__footer">
								<div class="luxe-journal-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
									<img src="<?php echo esc_url( $art_avatar ); ?>" alt="<?php echo esc_attr( $art_author ); ?>" class="luxe-journal-author__avatar" loading="lazy">
									<div class="luxe-journal-author__info">
										<span class="luxe-journal-author__name" itemprop="name"><?php echo esc_html( $art_author ); ?></span>
										<span class="luxe-journal-author__role"><?php echo esc_html( $art_role ); ?></span>
									</div>
								</div>

								<a href="<?php echo esc_url( $art_url ); ?>" class="luxe-journal-card__link" aria-label="<?php echo esc_attr( ( $is_en ? 'Read Monograph: ' : 'قراءة مونوغراف: ' ) . $art_title ); ?>">
									<span class="luxe-arrow-icon"><?php echo $is_en ? '→' : '←'; ?></span>
								</a>
							</div>
						</div>
					</article>
					<?php
					$j_idx++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>
