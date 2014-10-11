jQuery(function($) {

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

	// Get stages
	
	

});