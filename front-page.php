<?php get_header(); ?>

<div id="map"></div>

<div class="first-step">
    <div class="content">
        <h2>StageOne</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, unde.</p>
        <button class="btn btn-color2">Trouver un stage</button>
        <span class="close fa fa-close"></span>
    </div>
</div>

<div class="l-container left">
    <div class="content">
        <ul class="stages">
            
        </ul>
        <span class="close fa fa-arrow-right"></span>
    </div>
    <div class="content detail">
        <div class="inner">
            <h3>Titre du stage</h3>
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda adipisci, enim sapiente accusamus aliquam, minima possimus consequatur suscipit vel obcaecati recusandae necessitatibus odio amet autem magni modi maxime. Distinctio veritatis inventore pariatur, aperiam explicabo, blanditiis et consequuntur perspiciatis natus fugit adipisci minima! Exercitationem aliquam rerum neque nesciunt hic minus, debitis ipsum quidem voluptas reiciendis soluta eligendi, iusto quo alias eveniet commodi sed repellat totam vel, illum! Autem quidem voluptatibus blanditiis sequi. Nesciunt aperiam vero eum rem, neque natus esse repudiandae eos at cumque! Quae corporis dolorum ad adipisci quisquam, non laborum, eos obcaecati, ut, odit saepe deserunt voluptates officiis exercitationem.</p>
            </div>
            <a href="mailto:tuveuxquoi@gmail.com" class="btn btn-color4">Contacter</a><a href="#" class="btn btn-color2">Voir le site</a>
        </div>
        <span class="close-detail fa fa-close"></span>
    </div>
</div>

<div class="l-container right">
    <div class="content">
        <div class="inner">
            <h4>Ajouter un stage</h4>

            <div id="postbox">

				<form id="new_stage" name="new_stage" method="post" action="<?= get_home_url(); ?>/ajax_addstage">
				
				<div class="poststatus">
					
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

        </div>
        <span class="close fa fa-arrow-right"></span>
    </div>
</div>

<div class="news">
    <div class="content inner">
        <h5>Sortie du site</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque velit quia debitis, expedita facere, atque inventore voluptate aliquid illo odio omnis aliquam, non voluptas praesentium ipsa libero reprehenderit accusantium. Nihil!</p>
        <span class="close-news fa fa-close"></span>
    </div>
</div>

<?php get_footer(); ?>
