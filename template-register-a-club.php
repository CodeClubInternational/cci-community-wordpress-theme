<?php
/**
 * Template Name: Register a Club
 */

get_header(); ?>

<div class="c-page-block">
	<h1 class="u-text--center"><?php esc_html_e( 'Register a Club', 'ccw_countries' ); ?></h1>

	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--8">
	  <div class="c-content-panel">
		<?php get_template_part( 'template-parts/club/form', 'register-a-club' ); ?>
	  </div>
	</div>
	</div>
</div>

