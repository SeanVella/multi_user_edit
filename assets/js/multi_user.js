jQuery(document).ready(function($) {

	//get User info
	id = $('#session li').eq(1).find('a').attr('accesskey');
	name = $('#session li').eq(0).find('a').text();
	entry = document.URL.match(/\/([^\/]+)\/?$/)[1];


	//send User info
	console.log('test');

	var ajaxURL = Symphony.Context.get('symphony') + '/extension/multi_user_edit/multi_user/';

	$.ajax({
	    method: 'GET',
	    url: ajaxURL,
	    data: {
	      id: id,
	      name: name,
	      entry: entry
	    }
	  }).done(function(response){ // after the request has been loaded...
	    $('#results').html(response); // put the response in the div
  	});



});