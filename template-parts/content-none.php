<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CCW_Countries
 */

?>

<div class="o-hero">
	<div class="o-hero__bg c-grid c-grid--h-center c-grid--v-center">
		<div class="c-col--8">
			<div class="o-hero__body">
				<h1 class="o-hero__title"><?php esc_html_e( 'Nothing Found', 'ccw_countries' ); ?></h1>
				<p class="o-hero__subtitle c-lede"><?php esc_html_e( 'Sorry but we couldn\'t find the content you were looking for', 'ccw_countries' ); ?></p>
			</div>
		</div>
	</div>
</div>

<div class="c-page-block c-page-block--alt-block u-text--center">
	<div class="c-grid">
		<div class="c-col c-col--12">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ccw_countries' ), array(
					'a' => array(
					'href' => array(),
					),
				) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ccw_countries' ); ?></p>
				<?php
					get_search_form();

			else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ccw_countries' ); ?></p>
				<?php
					get_search_form();

			endif; ?>
		</div>
	</div>
</div>
