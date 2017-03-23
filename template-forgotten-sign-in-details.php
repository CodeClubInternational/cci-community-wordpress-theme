<?php
/**
 * Template Name: Forgotten Sign In Details
 */

get_header(); ?>

<div class="c-page-block">

	<h1 class="u-text--center"><?php esc_html_e( 'Forgotten Sign In Details', 'ccw_countries' ) ?></h1>

	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--6">
	  <div class="c-content-panel">
		<?php get_template_part( 'template-parts/club/sign-in/form', 'forgotten-sign-in-details' ); ?>
	  </div>
	</div>
	</div>

</div>
