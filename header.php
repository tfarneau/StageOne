<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package stageone
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	<!--[if lt IE 7]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header class="l-header noCopy">
	    <h1>
	        <a href="#">
	            <i>XXXXXX</i>
	        </a>
	    </h1>
	    <div class="search">
	        <div class="bar">
	            <label for="search-stage">
	                <i class="fa fa-search"></i>
	            </label>
	            <input type="search" id="search-stage" placeholder="Entrez un domaine">
	            <a href="#" class="toggle-dropdown">
	                <i class="fa fa-chevron-down"></i>
	            </a>
	        </div>
	        <div class="dropdown inner">
	            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos illum nesciunt, sed laboriosam consequuntur repellat officiis accusamus porro eius deleniti voluptatibus possimus reprehenderit exercitationem, velit, obcaecati. Fugit itaque fuga dolores, minima delectus tempora quaerat molestias necessitatibus aperiam quam cumque expedita excepturi adipisci doloremque nesciunt. Odit aspernatur sequi pariatur non laudantium error dolore nemo, officia distinctio facere vitae perspiciatis beatae dignissimos iusto eos numquam facilis quam reprehenderit delectus. Voluptate nihil adipisci dolores magnam cum fuga amet, a deleniti ullam. Minus enim aliquid tenetur laudantium deleniti dolore consectetur nulla repudiandae, fuga temporibus, maxime qui alias id tempora natus! Tempora consequatur, maxime!
	        </div>
	    </div>
	    <div class="add-stage">
	        <a href="">
	            <i class="fa fa-plus"></i>
	        </a>
	    </div>
	</header>

	<?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

	<div class="l-main">
