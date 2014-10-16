jQuery(function($) {

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*							GOOGLE MAP						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	var _stages = [];

	var stages = [
		['Paris', 48.8566140, 2.3522219, 4],
		['Lyon', 45.7640430, 4.8356590, 5],
		['Nantes', 47.2183710, -1.5536210, 3],
		['Chambery', 45.5646010, 5.9177810, 2],
		['Londres', 51.5073509, -0.1277583, 2],
		['Montreuil', 48.8638120, 2.4484510, 1]
	];

	// Ajout des stages sur la carte
	function setMarkers(map, locations) {

		var image = {
		url: 'http://localhost/hetic_devwp/wp/wp-content/themes/stageone/img/marker.png',
			size: new google.maps.Size(40, 60),
			origin: new google.maps.Point(0,0),
			scaledSize: new google.maps.Size(20, 30),
			anchor: new google.maps.Point(0, 32)
		};

		for (var i = 0; i < locations.length; i++) {
			var stage = locations[i];
			var myLatLng = new google.maps.LatLng(stage[1], stage[2]);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				icon: image,
				title: stage[0],
				zIndex: stage[3]
			});
		}
	}

	var myOptions = {
	    zoom: 5,
	    maxZoom: 11,
  		minZoom: 3,
	    center: new google.maps.LatLng(48.8566140, 2.3522219),
	    mapTypeId: google.maps.MapTypeId.ROADMAP,
	    disableDefaultUI: true,
	    styles: [{"featureType":"water","elementType":"all","stylers":[{"color":"#193a70"},{"visibility":"on"}]},{"featureType":"road","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#2c5ca5"}]},{"featureType":"poi","stylers":[{"color":"#2c5ca5"}]},{"elementType":"labels","stylers":[{"visibility":"off"}]}]
	};

	var map = new google.maps.Map(document.getElementById('map'), myOptions);

	setMarkers(map, stages);

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*							ACTIONS							*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	function showStage(data){
		// console.log(data);
	}

	// First-step click
	$('.first-step button, .first-step .close').click(function(){
		$('.first-step').fadeOut();
		// $('#search-stage').focus();
		toggleContainer($('.l-container.left'));
	});

	// Close container
	$('.l-container .close').click(function(){
		toggleContainer($(this).parents('.l-container'));
	});

	// Add stage
	$('.add-stage').click(function(e){
		e.preventDefault();
		toggleContainer($('.l-container.right'));
	});

	// Search dropdown
	$('#search-stage').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		$('.search .dropdown').addClass('open');
	});

	// Stop propagation body
	$('.search .dropdown').click(function(e){
		e.stopPropagation();
	});

	// Body click
	$('body').click(function(e){
		if($('.search .dropdown').hasClass('open')){
			$('.search .dropdown').removeClass('open');
		}
	});

	// Click on stage
	$('.show-stage, .close-detail').on('click', function(e){
		e.preventDefault();
		$('.l-container .detail').toggleClass('open');
	});

	$( ".stages" ).delegate( ".show-stage", "click", function(e) {
		e.preventDefault();
		showStage($(this).attr('data-id'));
		$('.l-container .detail').toggleClass('open');
	});


	$('.close-news').click(function(e){
		e.preventDefault();
		$('.news').css('right', '-400px');
	});

	$('.first-step .btn-color2').trigger('click');

	///////////////////////////
	// DEBUT CODE DE TRISTAN //
	///////////////////////////

	// Fonction appelée quand on clique sur un domaine
	function selectDomaine(domaine,domainshow){

		$('#search-stage').val(domainshow); // On change la valeur de l'input
		$('body').trigger('click'); // On enlève le focus

		selectedDomain=domaine; // Variable qui définit le domaine séléctionné
		getStages({},true); // On régupère les stages en ajax (le true indique qu'on remet l'offset à zero)

	}

	// Evenement de quand on clique sur un domaine
	$('.search .dropdown .domaine').on('click',function(e){
		e.preventDefault();
		if($(this).attr('data-action')=="seeall"){ // Si no clique sur 'voir tout' le comportement est pas le meme
			selectDomaine("",""); // On envoi des variables vides
			return;
		}
		selectDomaine($(this).attr('data-slug'),$(this).text()); // Sinon on récupère le slug et le texte
	})

	$("#search-stage").keyup(function (e){ // Quand on tape un truc dans la barre de recherche

		$('#search-stage').trigger('click'); // 

		var s = $(this).val(); // On récupère ce qu'écrit le bonhomme
		s=s.toLowerCase(); // Minuscule sisi

		var count = $('.dropdown .domaine').length; // On regarde combien on a de domaines affichés

		$('.dropdown .domaine').each(function(i,el){

			var text = $(el).text(); // On récupère le texte
			text=text.toLowerCase(); // Minuscule sisi

			if(text.indexOf(s)==-1){ // Si ce que tape l'utilisateur n'est pas dans le domaine on le cache
				$(el).hide();
				count--;
			}else{ // Sinon on l'affiche
				$(el).show();
			}

		});

	    if (e.keyCode == 13) { // Si on tape entrée
	        if(count==1) // Et si on a qu'un seul domaine affiché
	        	selectDomaine($('.dropdown .domaine:visible').attr('data-slug'),$('.dropdown .domaine:visible').text()); // On séléctionne le seul domaine visible
	    }

	    /////////////////////////
		// FIN CODE DE TRISTAN //
		/////////////////////////

	 });

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*							FUNCTIONS						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	// Toggle visibility for left & right container

	function toggleContainer(container){
		$('.l-container.open').not(container).removeClass('open');
		container.toggleClass('open');
	}

	///////////////////////////
	// DEBUT CODE DE TRISTAN //
	///////////////////////////


	
//    ,
// _,,)\.~,,._
// (()`  ``)\))),,_
//  |     \ ''((\)))),,_          ____
//  |6`   |   ''((\())) "-.____.-"    `-.-,
//  |    .'\    ''))))'                  \)))
//  |   |   `.     ''                     ((((
//  \, _)     \/                          |))))
//   `'        |                          (((((
//             \                  |       ))))))
//              `|    |           ,\     /((((((
//               |   / `-.______.<  \   |  )))))
//               |   |  /         `. \  \  ((((
//               |  / \ |           `.\  | (((
//               \  | | |             )| |  ))
//                | | | |            / | |  '
//                | | /_(           /_(/ /
//                /_(/__]           \_/_(
//               /__]                /__]



	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*						AJAX						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	// Get stages

	var limit=4; // Combien de stages sont récup par requete AJAX
	var offset=0; // Offset de départ
	var selectedDomain=""; // Domaine séléctionné

	function showStages(data){ // Fonction bien crade qui affiche les stages (pas besoin d'expliquer)
		for(var i in data){

			var s = data[i];

			var stage = '<li><a href="#" class="show-stage" data-id="'+data[i].ID+'">';
			stage    += "<h3>"+s.post_title+"</h3>";
			stage    += "<div class='description'>";
			stage    += "<p>"+s.domaine[0].name;

			var skills="";
			for(var j in s.skills){
				skills+=" "+s.skills[j].name;
			}

			if(skills.length>0)
				stage+=" /"+skills+"</p>";

			stage+="<p>"+s.post_content+"</p>";

			stage+="</div></a></li>";

			$('ul.stages').append(stage);
		}
	}

	function getStages(params,first){ // Fonction qui récup les stages, params c'est les parametres (peut être qu'on en aura pas besoin), first indique si c'est la première requete de ce type (pour savoir si on remet l'offset à zéro uo non)

		if(first){ // Si c'est le premier
			$('ul.stages').html(""); // On clean la div
			offset=0; // Et on remet l'offset à zero
		}

		var url = "http://localhost/hetic_devwp/wp/ajax_getstages/"; // Base de l'url de la requete AJAx
		var data = {limit:limit,offset:offset}; // Data a envoyer à l'url

		if(selectedDomain.length>0){ // Si il y a un truc dans selectedDomain
			data.domaine=selectedDomain; // On met dans le data
		}

		$.get(url,data) // On fait la requete AJAX
		.done(function(data) {

			var data = JSON.parse(data);
			if(data.length==0)
				console.log('ended'); // On a rien trouvé
			showStages(data); // On affiche les stages

		});

		offset+=limit;

	}

	getStages({},true); // Requete AJAX de base

	$('.loadmore').on('click',function(e){ // Si on veut en charger plus
		e.preventDefault();
		getStages({},false); // le 'first' est à false parce qu'on veut juste update
	})



//       ,~.
//    ,-'__ `-,
//   {,-'  `. }              ,')
//  ,( a )   `-.__         ,',')~,
// <=.) (         `-.__,==' ' ' '}
//   (   )                      /)
//    `-'\   ,                    )
//        |  \        `~.        /
//        \   `._        \      /
//         \     `._____,'    ,'
//          `-.             ,'
//             `-._     _,-'
//                 77jj'
//                //_||
//             __//--'/`          
//           ,--'/`  '



	// Add stage

	function showMessage(msg){ // Afficher un message pour le formulaire
		$('.poststatus').html(msg); 
	}

	$('#new_stage').submit(function(e){ // Ajout d'un stage

		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");

		$.ajax({
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR)  // Yeah
			{	
			    var data = JSON.parse(data);

			    _stages.push(data);

			    if(data.status=="success"){
			    	showMessage('Votre stage a été enregistré et sera examiné sous peu');
			    	$('input[type=submit]').attr('disabled','disabled');
			    }else if(data.status=="error"){
			    	showMessage("Erreur : <br/>"+data.data.join("<br/>"));
			    }
			},
			error: function(jqXHR, textStatus, errorThrown) // Outch
			{
			    //if fails      
			}
		});

		e.preventDefault(); //STOP default action
		// e.unbind(); //unbind. to stop multiple form submit.
	})
});