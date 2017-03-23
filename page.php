<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CCW_Countries
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/page', 'header' ); ?>

	<div class="c-page-block">
		<div class="c-grid c-grid--h-center">
			<div class="c-col--8">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</div>
		</div>
	</div>

<?php
get_footer();
