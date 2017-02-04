jQuery(document).ready(function($) {

	function saveUser(id, entry, ajaxURL){
		$.ajax({
		    method: 'GET',
		    url: ajaxURL,
		    data: {
		      id: id,
		      entry: parseInt(entry)
		    }
	  	})
	}

	//get info
	id = parseInt($('#session li').eq(0).find('a').attr('href').match(/\/([^\/]+)\/?$/)[1]);
	// name = $('#session li').eq(0).find('a').text();
	entry = document.URL.match(/\/([^\/]+)\/?$/)[1];
	ajaxURL = Symphony.Context.get('symphony') + '/extension/multi_user_edit/multi_user/';

	//Check if the entry is being used by another author
	$.ajax({
	    method: 'GET',
	    url: ajaxURL,
	    data: {
	      entry: parseInt(entry)
	    },
	    success: function(response){
	    	response = $(response);
	    	if(response.hasClass('locked')){
	    		//if locked, get difference in minutes
	    		$diff = response.find('#diff').text();
	    		if($diff > 5){
	    			//Gain access to the article as author is taking too long.
	    			console.log('Exceeded 5 minutes; Updated log.')
	    			saveUser(id, entry, ajaxURL);
	    		}
	    		else{
	    			console.log(response.find('.show').text());
	    			console.log((5 - $diff).toFixed(2) + ' minute/s to go.');
	    		}
	    	}
	    	else{
		    	//Save User info
				saveUser(id, entry, ajaxURL);
			}
	    }
	  }).done(function(response){
	  	//code..
  	});


});