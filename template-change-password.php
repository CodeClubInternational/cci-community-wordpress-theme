<?php
/**
 * Template Name: Change Password
 */

get_header();
?>

<div class="c-page-block">

	<div class="c-grid">
	<div class="c-col c-col--3">
		<?php get_template_part( 'template-parts/club/club-navigation' ); ?>
		<?php defined( RESOURCES_FILE_URL ) ? get_template_part( 'template-parts/club/club-materials' ) : ''; ?>
	</div>
	<div class="c-col c-col--9">
	  <div class="c-content-panel">
		<?php get_template_part( 'template-parts/club/sign-in/form', 'change-password' ); ?>
	  </div>
	</div>
	</div>
</div>
