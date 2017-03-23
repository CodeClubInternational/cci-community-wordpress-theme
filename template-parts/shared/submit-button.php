<?php
	$class = 'c-button c-button--green';
	$disabled = isset( $disabled );

if ( $disabled ) {
	$class .= ' c-button--disabled';
}

?>

<p class="u-text--center">
<button
<?php
	echo "class='" . $class . "' ";
	echo "type='submit' ";
foreach ( $attributes as $key => $value ) {
	echo $key . "='" . $value . "' ";
}
?>
><?php echo isset( $title ) ? $title : __( 'Submit', 'ccw_countries' ) ?></button>
</p>
