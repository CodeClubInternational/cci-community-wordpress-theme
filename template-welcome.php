<?php
/**
 * Template Name: Welcome
 */

get_header(); ?>

<div class="c-page-block">
	<h1 class="u-text--center"><?php esc_html_e( 'Welcome, ', 'ccw_countries' );
	echo $_GET['username']; ?></h1>
	<p class="u-text--center c-lede">
	<?php the_field( 'page_intro' ); ?>
	</p>

	<div class="c-grid c-grid--h-center">
	<div class="c-col c-col--6">
	  <div class="c-content-panel">
		<?php
		$templates = new League\Plates\Engine( get_template_directory() . '/template-parts/shared' );
		echo $templates->render('info', [
			'message' => __( 'Your username is ', 'ccw_countries' ) . '<span class="u-color--yellow">'
			. $_GET['username'] . '</span>.' . __( 'You will need this and your password to log in to access your club details.', 'ccw_countries' ),
		]);
		?>
		<?php get_template_part( 'template-parts/club/sign-in/form', 'first-password' ); ?>
	  </div>
	</div>
	</div>
</div>
