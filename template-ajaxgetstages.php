<?php
	/*
	Template Name: AJAX get stages
	*/

	get_header('json');
	

	function clean_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$limit=1;
	$offset=0;

	$domaine=null;
	$skill=null;

	if(isset($_GET['limit'])){ $limit=clean_input($_GET['limit']); }
	if(isset($_GET['offset'])){ $offset=clean_input($_GET['offset']); }
	if(isset($_GET['domaine'])){ $domaine=clean_input($_GET['domaine']); }
	if(isset($_GET['skill'])){ $skill=clean_input($_GET['skill']); }

	$args = array(
		'posts_per_page'   => $limit,
		'offset'           => $offset,
		'category'         => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'stage',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);

	$tax=array();

	if($domaine!=null){

		$tax2=array(
			'taxonomy' => 'domaine',
			'field' => 'slug',
			'terms' => $domaine
		);

		array_push($tax,$tax2);
	}

	if($skill!=null){

		$tax2 = array(
			'taxonomy' => 'skill',
			'field' => 'slug',
			'terms' => $skill
		);

		array_push($tax,$tax2);
	}

	if(count($tax)>0)
		$args['tax_query']=$tax;

	// die(print_r($args));

	$data = get_posts($args);

	foreach($data as $k => $v){
		// print_r(get_post_meta($v->ID));
		$data[$k]->meta=get_post_meta($v->ID);
		$data[$k]->domaine=wp_get_post_terms($v->ID,'domaine');
		$data[$k]->skills=wp_get_post_terms($v->ID,'skill');
	}

	// global $wpdb;
 //    echo "<pre>";
 //    print_r( "Nombre de requetes : ".count($wpdb->queries)." / Nombre de stages recup : ".count($data) );
 //    echo "</pre>";
 //    echo "<pre>";
 //    print_r($wpdb->queries);
 //    echo "</pre>";

	die(json_encode($data));

?>
