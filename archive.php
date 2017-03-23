<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CCW_Countries
 */

get_header(); ?>


	<?php if ( have_posts() ) : ?>

		<?php get_template_part( 'template-parts/page-header' ); ?>

		<div class="c-page-block c-page-block--alt-block">
			<div class="c-grid c-grid--h-center">
				<div class="c-col c-col--8">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation(); ?>

				</div>
			</div>
		</div>

	<?php else :
		get_template_part( 'template-parts/content', 'none' );
	endif; ?>

<?php
get_footer();
