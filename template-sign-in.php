<?php
/**
 * Template Name: Sign in
 */

get_header(); ?>

<div class="c-page-block">
	<h1 class="u-text--center"><?php esc_html_e( 'Sign In', 'ccw_countries' ) ?></h1>

	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--6">
	  <div class="c-content-panel">
		<?php get_template_part( 'template-parts/club/sign-in/form', 'sign-in' ); ?>
	  </div>
	</div>
	</div>
</div>

