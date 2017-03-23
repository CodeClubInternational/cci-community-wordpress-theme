<?php
/**
 * Template Name: Home
 *
 * @package CCW_Countries
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/page', 'header' ); ?>

	<div class="c-page-block">
	  <div class="c-grid c-grid--h-center">
		<div class="c-col--8 u-text--center">
			<?php the_field( 'primary_text' ); ?>
		</div>
	  </div>
	</div>

	<div class="c-page-block c-page-block--action-block">
	  <div class="c-grid c-grid--h-center">
		<div class="c-col--8 u-text--center">
			<?php the_field( 'driver_text' ); ?>
		  <p><a class="c-button c-button--action-button" href="<?php the_field( 'driver_link' ); ?>"><?php the_field( 'driver_link_text' ); ?></a></p>
		</div>
	  </div>
	</div>

	<div class="c-page-block">
	  <div class="c-grid">
		<div class="c-col c-col--6">
			<?php the_field( 'secondary_text' ); ?>
		  <a class="c-button c-button--hollow c-button--green" href="<?php the_field( 'secondary_link' ); ?>"><?php the_field( 'secondary_link_text' ); ?></a>
		</div>
		<div class="c-col c-col--6">
		  <img width="100%" src="<?php bloginfo( 'template_directory' ); ?>/images/placeholder-wide.png">
		</div>
	  </div>
	</div>

<?php
get_footer();
