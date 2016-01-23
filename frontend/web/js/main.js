$(function() {
    
    //Clic sur change-avatar // Affichage du popup modal
    $('#change-avatar').on('click', function() {
        $('#modal').modal('show')
                   .find('#picture-popup')
                   .load($(this).attr('value'));
    });
    


    

	var previousScroll = 0,
	    headerOrgOffset = $('#w0').height();

	//$('#w0').height($('#w0 > .container').height());

	$(window).scroll(function () {

	    var currentScroll = $(this).scrollTop();
	    if (currentScroll > headerOrgOffset) {
	        if (currentScroll > previousScroll) {
	        	console.log('up');
	            $('#w0').hide('slow');
	        } else {
	        	console.log('down souris');
	            $('#w0').show('slow');
	        }
	    } else {
	    		console.log('down');
	            $('#w0').slideDown(1000);
	    }
	    previousScroll = currentScroll;
	});    


});

