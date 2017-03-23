<div class="o-hero">
    <div class="o-hero__bg c-grid c-grid--h-center c-grid--v-center">
        <div class="c-col--8">
            <div class="o-hero__body">
                <?php if ( get_field( 'page_title' ) ) : ?>
					<h1 class="o-hero__title"><?php the_field( 'page_title' ); ?></h1>
				<?php else : ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php endif; ?>

				<?php if ( get_field( 'page_intro' ) ) : ?>
					<p class="o-hero__subtitle c-lede"><?php the_field( 'page_intro' ); ?></p>
				<?php endif; ?>

				<?php if ( have_rows( 'page_action_buttons' ) ) : ?>
					<ul class="o-hero__list">
						<?php while ( have_rows( 'page_action_buttons' ) ) : the_row(); ?>
							<li class="o-hero__item">
							  <a href="<?php the_sub_field( 'action_url' ) ?>"
								 class="c-button c-button--hollow c-button--white">
								<?php the_sub_field( 'action_text' ) ?>
							  </a>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
