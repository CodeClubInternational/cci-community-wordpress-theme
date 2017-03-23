<?php
/**
 * Template Name: Download Resources
 */


$club_session = new Club_Session();
$club_session->redirectIfNoSession();

$file = RESOURCES_FILE_URL;

header( 'Content-Description: File Transfer' );
header( 'Content-Type: application/octet-stream' );
header( 'Content-Disposition: attachment; filename=' . basename( $file ) );
header( 'Expires: 0' );
header( 'Cache-Control: must-revalidate' );
header( 'Pragma: public' );
header( 'Content-Length: ' . filesize( $file ) );
ob_clean();
flush();
readfile( $file );
