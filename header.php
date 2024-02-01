<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
	if ( is_front_page() || is_home() ) {
		bloginfo( 'name' );
	} else {
		echo wp_title( '' );    }
	?></title>

<script src="https://unpkg.com/htmx.org" crossorigin="anonymous"></script>
<?php wp_head(); ?>
</head>
<body>


<?php wp_nav_menu( $args = array('menu'=>'header-top') ); ?>

