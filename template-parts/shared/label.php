<?php

	$class = 'c-form__label';
	$has_error = isset( $error );

if ( $has_error ) {
	$class .= ' c-form__label--error';
}

?>

<label class="<?php echo $class ?>" for="<?php echo $for ?>">
	<?php echo esc_html_e( $title ) ?>
	<span class="c-form__optional"><?php echo $required ? __( '(required)', 'ccw_countries' ) : '' ?></span>
</label>

<?php if ( $has_error ) : ?>
	<div class="c-alert c-alert--error c-alert--inline">
	<span class="c-icon c-icon--small c-icon--error c-icon--white"></span>
	<?php echo $error ?>
	</div>
<?php endif; ?>
