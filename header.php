<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CCW_Countries
 */

// required to successfully perform header-based redirect after submission of forms (eg. club creation form)
ob_start();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<script src="https://use.typekit.net/hos3npy.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" sizes="32x32">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
</head>

<body <?php body_class(); ?>>

<?php DISPLAY_ERRORS ? display_php_errors() : '' ?>

<header class="o-nav">
	<div class="o-nav__container u-clearfix">
		<div class="c-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-logo__link">
				<img alt="Code Club Logo" class="c-logo__image" src="<?php echo get_template_directory_uri(); ?>/bower_components/code-club/dist/images/code-club-logo.svg">
				<div class="c-logo__appendix"><?php bloginfo( 'name' ); ?></div>
			</a>
		</div>

		<input class="o-nav__toggle-input" id="off-canvas-nav-toggle-input" type="checkbox">
		<label class="o-nav__toggle-label" for="off-canvas-nav-toggle-input"><span></span></label>

		<nav class="o-nav__list-container">
		<?php
		if ( has_nav_menu( 'primary_navigation' ) ) :
			wp_nav_menu( [
				'theme_location' => 'primary_navigation',
				'menu_class' => 'o-nav__list',
				'container' => false,
			] );
		endif;
		?>
		</nav>
	</div>
</header>

<main class="o-main">
<?php

$flash_message = new Flash_Message();
$flash_message->display();
?>
