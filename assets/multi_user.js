jQuery(document).ready(function($) {

	//get User info
	id = $('#session li').eq(1).find('a').attr('accesskey');
	name = $('#session li').eq(0).find('a').text();
	entry = document.URL.match(/\/([^\/]+)\/?$/)[1];


	//send User info
	console.log('test');

	$.ajax({
	    method: 'GET',
	    url: '/web/extensions/multi_user_edit/content/multi_user.php',
	    data: {
	      id: id,
	      name: name,
	      entry: entry
	    }
	  }).done(function(response){ // after the request has been loaded...
	    $('#results').html(response); // put the response in the div
  	});



});