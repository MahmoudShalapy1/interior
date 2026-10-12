<?php
/**
 * Template Name: Luxury Interior Landing Page
 * Description: Architectural Digest caliber editorial landing page with dramatic Amiri typography and hairline minimalism.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/header-luxury' );
?>

<main class="luxe-main" id="main-content" tabindex="-1" role="main">
	<!-- 01. Hero Section with Blueprint Reveal Lens (Section 7.1 — Wow #1) -->
	<?php get_template_part( 'patterns/hero-reveal' ); ?>

	<!-- 02. Studio Manifesto Section (Section 7.2) — Warm Limestone Rhythm -->
	<?php get_template_part( 'patterns/statement-manifesto' ); ?>

	<!-- 03. From Line to Living — 4-Stage Pinned Story (Section 7.3 — Wow #2) -->
	<?php get_template_part( 'patterns/line-to-living' ); ?>

	<!-- 04. Monumental Stats & Scale (Section 7.4) -->
	<?php get_template_part( 'patterns/stats-scale' ); ?>

	<!-- 05. Confidential Vault (Section 7.5 — Wow #3) -->
	<?php get_template_part( 'patterns/confidential-vault' ); ?>

	<!-- 06. Curated Runway RTL (Section 7.6) -->
	<?php get_template_part( 'patterns/horizontal-runway' ); ?>

	<!-- 07. Architectural Light Study (Section 7.7 — Wow #4) -->
	<?php get_template_part( 'patterns/light-study' ); ?>

	<!-- 08. 3-Stage Architectural Realization Slider (Section 7.8) -->
	<?php get_template_part( 'patterns/before-after-stage' ); ?>

	<!-- 09. Services Deep Dive & Turnkey Pillars (Section 7.9) -->
	<?php get_template_part( 'patterns/services-pillars' ); ?>

	<!-- 10. Material Provenance & Rare Slabs (Section 7.10) -->
	<?php get_template_part( 'patterns/material-provenance' ); ?>

	<!-- 11. Why We Cost More — Editorial Juxtaposition (Section 7.11) -->
	<?php get_template_part( 'patterns/why-cost-more' ); ?>

	<!-- 12. The 6-Step Turnkey Protocol (Section 7.12) -->
	<?php get_template_part( 'patterns/execution-process' ); ?>

	<!-- 13. Architectural Monographs & Journal (Section 7.13) -->
	<?php get_template_part( 'patterns/editorial-journal' ); ?>

	<!-- 14. Architectural Qualification Funnel (Section 7.14) -->
	<?php get_template_part( 'patterns/qualification-funnel' ); ?>
</main>

<?php get_template_part( 'template-parts/footer-luxury' ); ?>
