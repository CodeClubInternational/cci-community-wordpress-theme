<?php
/**
 * Template Name: Contact Form
 *
 * @package CCW_Countries
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<div class="c-page-block">
	<h1 class="u-text--center"><?php esc_html_e( 'Contact', 'ccw_countries' ); ?></h1>
	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--8">
		<?php get_template_part( 'template-parts/form', 'contact' ); ?>
	</div>
	</div>
</div>

<?php
get_footer();
