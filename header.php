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

<script src="https://unpkg.com/htmx.org@1.9.10" 
	integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" 
	crossorigin="anonymous"></script>
<script src="https://unpkg.com/htmx.org/dist/ext/head-support.js"></script>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>  hx-ext="head-support">

<div class="header">
<?php wp_nav_menu( $args = array('menu'=>'header-top') ); ?>
</div>
