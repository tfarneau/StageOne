jQuery(function($) {

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*							GOOGLE MAP						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

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

	// First-step click
	$('.first-step button, .first-step .close').click(function(){
		$('.first-step').fadeOut();
		$('#search-stage').focus();
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
	$('.search .toggle-dropdown').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.search .dropdown').toggleClass('open');
		$('#search-stage').focus();
	});

	// Stop propagation body
	$('.search .dropdown').click(function(e){
		e.stopPropagation();
	});

	// Body click
	$('body').click(function(){
		if($('.search .dropdown').hasClass('open')){
			$('.search .dropdown').removeClass('open');
		}
	});

	// Click on stage
	$('.show-stage, .close-detail').click(function(e){
		e.preventDefault();
		$('.l-container .detail').toggleClass('open');
	});

	$('.close-news').click(function(e){
		e.preventDefault();
		$('.news').css('right', '-400px');
	});

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*							FUNCTIONS						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	// Toggle visibility for left & right container
	function toggleContainer(container){
		$('.l-container.open').not(container).removeClass('open');
		container.toggleClass('open');
	}

	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/
	/*						AJAX						*/
	/*\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/*/

	// Get stages

	var limit=12;
	var offset=0;

	function showStages(data){
		console.log(data);
		for(var i in data){

			var s = data[i];

			var stage = '<li><a href="" class="show-stage">';
			stage    += "<h3>"+s.post_title+"</h3>";
			stage    += '<div class="description">';
			stage+="<p>"+s.domaine[0].name;

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

	function getStages(){

		$.get( "http://localhost/hetic_devwp/wp/ajax_getstages/",{limit:limit,offset:offset})
		.done(function(data) {
			var data = JSON.parse(data);
			if(data.length==0)
				alert('no more');
			showStages(data);
		});

		offset+=limit;

	}

	getStages();

	$('.loadmorestages').on('click',function(e){
		e.preventDefault();
		getStages();
	})

	// Add stage

	function showMessage(msg){
		$('.poststatus').html(msg);
	}

	$('#new_stage').submit(function(e){

		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");

		$.ajax({
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{	
			    var data = JSON.parse(data);

			    if(data.status=="success"){
			    	showMessage('Votre stage a été enregistré et sera examiné sous peu');
			    	$('input[type=submit]').attr('disabled','disabled');
			    }else if(data.status=="error"){
			    	showMessage("Erreur : <br/>"+data.data.join("<br/>"));
			    }
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
			    //if fails      
			}
		});

		e.preventDefault(); //STOP default action
		// e.unbind(); //unbind. to stop multiple form submit.
	})
});