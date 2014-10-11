<?php
	/*
	Template Name: Ajouter stage
	*/

	get_header();

?>

<h1>Ajouter un stage</h1>

<!-- New Post Form -->
<div id="postbox">

	<form id="new_stage" name="new_stage" method="post" action="<?= get_home_url(); ?>/ajax_addstage">
	
	<div class="poststatus" style="padding:30px 0;">
		
	</div>

	<p>
		<label for="title">Nom du stage</label><br />
		<input type="text" id="title" value="" tabindex="1" size="20" name="title" />
	</p>

	<p>
		<label for="description">Description du stage</label><br />
		<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
	</p>

	<p>
		<label for="company_name">Nom de l'entreprise</label><br />
		<input type="text" id="company_name" value="" tabindex="1" size="20" name="company_name" />
	</p>

	<p>
		<label for="localisation">Localisation</label><br />
		<input type="text" id="localisation" value="" tabindex="1" size="20" name="localisation" />
	</p>

	<p>
		<label for="duration">Durée</label><br />
		<input type="text" id="duration" value="" tabindex="1" size="20" name="duration" />
	</p>

	<p>
		<label for="begin">Début</label><br />
		<input type="text" id="begin" value="" tabindex="1" size="20" name="begin" />
	</p>

	<p>
		<label for="salary">Rémunération</label><br />
		<input type="text" id="salary" value="" tabindex="1" size="20" name="salary" />
	</p>

	<p>
		<label for="contact_phone">Contact téléphone</label><br />
		<input type="text" id="contact_phone" value="" tabindex="1" size="20" name="contact_phone" />
	</p>

	<p>
		<label for="contact_mail">Contact mail</label><br />
		<input type="text" id="contact_mail" value="" tabindex="1" size="20" name="contact_mail" />
	</p>



	<p>
		<label>Domaines</label>
		<?php wp_dropdown_categories( 'show_option_none=Domaines&taxonomy=domaine&hide_empty=0&name=domaine' ); ?>
	</p>

	<p>
		<label for="competences">Compétences</label>
		<input type="text" value="" tabindex="5" size="16" name="competences" id="competences" />
	</p>



	<input type="submit" value="Publier le stage" tabindex="6" id="submit" name="submit" />
	<input type="hidden" name="add_stage" value="1" />

	<?php // wp_nonce_field( 'new-post' ); ?>

	</form>

</div>

<!--// New Post Form -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>