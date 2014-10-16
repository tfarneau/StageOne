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

	<header class="l-header">
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
	        	<?php

	        		$domaines = get_terms('domaine', array(
					 	'orderby'    => 'count',
					 	'hide_empty' => 0
					));
	        	?>
				
				<span class="domaine" data-action="seeall" style="margin:5px;line-height:20px;background-color:blue;color:#FFF; padding: 5px; border-radius:5px;">Voir tout</span>
	        	<?php foreach($domaines as $v): ?>
					<span class="domaine" style="margin:5px;line-height:20px;background-color:blue;color:#FFF; padding: 5px; border-radius:5px;" data-slug="<?php echo $v->slug; ?>"><?php echo $v->name; ?></span>
	        	<?php endforeach; ?>

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
