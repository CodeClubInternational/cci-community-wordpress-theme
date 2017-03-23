<?php
/**
 * Template Name: Register
 */

get_header(); ?>

<div class="c-page-block">
	<h1 class="u-text--center"><?php esc_html_e( 'Register', 'ccw_countries' ); ?></h1>

	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--4 c-card">
	  <img alt="" width="100%" src="https://www.codeclubworld.org/app/themes/code-club-world/assets/images/reusable/card-getinvolved-startclub.png">
	  <div class="c-card__body">
		<h3><?php esc_html_e( 'Register an active Code Club', 'ccw_countries' ); ?></h3>
		Explanation
		<div class="button-container">
		  <a class="c-button block-button c-button--green c-button--hollow"
			 href="/register/register-a-club/"><?php esc_html_e( 'Register', 'ccw_countries' ); ?></a>
		</div>
	  </div>
	</div>
	<div class="c-col c-col--4 c-card">
	  <img alt="" width="100%" src="https://www.codeclubworld.org/app/themes/code-club-world/assets/images/reusable/card-getinvolved-startclub.png">
	  <div class="c-card__body">
		<h3><?php esc_html_e( 'Register a Venue', 'ccw_countries' ); ?></h3>
		<?php esc_html_e( 'Explanation', 'ccw_countries' ); ?>
		<div class="button-container">
		  <a class="c-button block-button c-button--green c-button--hollow"
			 href="/register/register-a-venue/">
			<?php esc_html_e( 'Register', 'ccw_countries' ); ?>
		  </a>
		</div>
	  </div>
	</div>
	</div>

</div>

