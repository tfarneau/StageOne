<?php
	/*
	Template Name: AJAX Ajouter stage
	*/

	get_header('json');
?>

<?php
	
	function clean_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


	if ( isset( $_POST['add_stage'] ) && '1' == $_POST['add_stage'] ) {

		// Form verification
		$errors = array();

		$title=clean_input($_POST['title']);
		if (empty($_POST['title'])){
			array_push($errors,"Aucun titre n'est renseigné");
		}

		$description=clean_input($_POST['description']);
		if (empty($_POST['description'])){
			array_push($errors,"Aucune description n'est renseignée");
		}

		$company_name=clean_input($_POST['company_name']);
		if (empty($_POST['company_name'])){
			array_push($errors,"Aucun company_name n'est renseigné");
		}

		$localisation=clean_input($_POST['localisation']);
		if (empty($_POST['localisation'])){
			array_push($errors,"Aucun localisation n'est renseigné");
		}

		$duration=clean_input($_POST['duration']);
		if (empty($_POST['duration'])){
			array_push($errors,"Aucun duration n'est renseigné");
		}

		$begin=clean_input($_POST['begin']);
		if (empty($_POST['begin'])){
			array_push($errors,"Aucun begin n'est renseigné");
		}

		$salary=clean_input($_POST['salary']);
		if (empty($_POST['salary'])){
			array_push($errors,"Aucun salary n'est renseigné");
		}

		$contact_phone=clean_input($_POST['contact_phone']);
		if (empty($_POST['contact_phone'])){
			array_push($errors,"Aucun contact_phone n'est renseigné");
		}

		$contact_mail=clean_input($_POST['contact_mail']);
		if (empty($_POST['contact_mail'])){
			array_push($errors,"Aucun contact_mail n'est renseigné");
		}

		$domaine=clean_input($_POST['domaine']);
		if (empty($_POST['domaine'])){
			array_push($errors,"Aucun domaine n'est renseigné");
		}

		$competences=clean_input($_POST['competences']);



		if(count($errors)>0){
			$res = array(
				'status' => 'error',
				'data' => $errors);

			die(json_encode($res));
		}

		// Verifications
		$my_post = array(
		    'post_title' => $title,
		    'post_content' => $description,
		    'post_status' => 'publish',
		    'post_type' => 'stage'
		);
		$the_post_id = wp_insert_post( $my_post );

		// Insert meta
		__update_post_meta( $the_post_id, 'company_name', $company_name );
		__update_post_meta( $the_post_id, 'localisation', $localisation );
		__update_post_meta( $the_post_id, 'duration', $duration );
		__update_post_meta( $the_post_id, 'begin', $begin );
		__update_post_meta( $the_post_id, 'salary', $salary );
		__update_post_meta( $the_post_id, 'contact_phone', $contact_phone );
		__update_post_meta( $the_post_id, 'contact_mail', $contact_mail );

		// Insert terms
		wp_set_post_terms( $the_post_id, $domaine, 'domaine', false);
		wp_set_post_terms( $the_post_id, explode(",",$competences), 'skill', true);

		if($the_post_id){
			$res = array('status' => 'success');
			die(json_encode($res));
		}

	}

?>
