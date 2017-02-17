<?php
/**
 * Template Name: Club
 */


get_header();

$club_session = new Club_Session();
$club_session->redirectIfNoSession(); ?>

<div class="c-page-block">

  <h1 class="u-text--center"><?php esc_html_e('Account', 'ccw_countries'); ?></h1>

  <div class="c-grid">
    <div class="c-col c-col--3">
    <?php get_template_part('template-parts/club/club-navigation'); ?>
      <?php defined(RESOURCES_FILE_URL) ? get_template_part('template-parts/club/club-materials') : ''; ?>
    </div>
    <div class="c-col c-col--9">
      <?php get_template_part('template-parts/club/show-club'); ?>
    </div>

  </div>
</div>