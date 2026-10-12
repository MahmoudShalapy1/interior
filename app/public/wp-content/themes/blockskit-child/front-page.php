<?php
/**
 * Front Page Template
 *
 * @package Blockskit_Child
 */

get_template_part( 'template-parts/header-luxury' );
?>

<main class="luxe-main" id="main-content" tabindex="-1" role="main">
	<?php
	get_template_part( 'patterns/hero-reveal' );
	get_template_part( 'patterns/statement-manifesto' );
	get_template_part( 'patterns/line-to-living' );
	get_template_part( 'patterns/stats-scale' );
	get_template_part( 'patterns/confidential-vault' );
	get_template_part( 'patterns/horizontal-runway' );
	get_template_part( 'patterns/light-study' );
	get_template_part( 'patterns/before-after-stage' );
	get_template_part( 'patterns/services-pillars' );
	get_template_part( 'patterns/material-provenance' );
	get_template_part( 'patterns/why-cost-more' );
	get_template_part( 'patterns/execution-process' );
	get_template_part( 'patterns/editorial-journal' );
	get_template_part( 'patterns/qualification-funnel' );
	?>
</main>

<?php
get_template_part( 'template-parts/footer-luxury' );
