<?php

$templates = new League\Plates\Engine( get_template_directory() . '/template-parts/shared' );

$class = 'c-form__input';
$has_error = isset( $error );

if ( $has_error ) {
	$class .= ' c-form__input--error';
}

?>

<?php
if ( isset( $title ) ) {
	echo $templates->render('label', [
		'title' => $title,
		'error' => $has_error ? $error : null,
		'for' => $attributes['id'],
		'required' => isset( $attributes['required'] ),
	]);
}?>

<input
	<?php
	echo "class='" . $class . "' ";
	foreach ( $attributes as $key => $value ) {
		echo $key . "='" . $value . "' ";
	}
	if ( ! isset( $attributes['name'] ) & isset( $attributes['id'] ) ) {
		echo "name='" . $attributes['id'] . "' ";
	}
	if ( ! isset( $attributes['type'] ) ) {
		echo "type='checkbox' ";
	}
	if ( $attributes['checked'] ) {
		echo ' checked ';
	}
	?>
/>
