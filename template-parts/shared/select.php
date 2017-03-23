<?php

	$templates = new League\Plates\Engine( get_template_directory() . '/template-parts/shared' );

	$class = 'c-form__select';
	$has_error = isset( $error );

if ( $has_error ) {
	$class += ' c-form__input--error';
}

if ( isset( $title ) ) {
	echo $templates->render('label', [
		'title' => $title,
		'error' => $has_error ? $error : null,
		'for' => isset( $attributes['name'] ) ? $attributes['name'] : '',
		'required' => isset( $attributes['required'] ),
	]);
}

	echo '<select ';
	echo "class='" . $class . "' ";

foreach ( $attributes as $key => $value ) {
	echo $key . "='" . $value . "' ";
}

if ( ! isset( $attributes['name'] ) & isset( $attributes['id'] ) ) {
	echo "name='" . $attributes['id'] . "' ";
}

	echo '>';
if ( isset( $include_blank ) ) {
	echo "<option value=''>--</option>";
}

foreach ( $options as $key => $text ) {
	echo "<option value='" . $key . "' " . ($text == $selected ? 'selected' : '') . '>' . $text . '</option>';
}

	echo '</select>';

