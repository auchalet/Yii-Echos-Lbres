$(function() {   
    //Clic sur change-avatar // Affichage du popup modal
    $('.update-user').on('click', function() {
        $('#modal-user').modal('show')
                   .find('#user-popup')
                   .load($(this).attr('value'));
    });    
    
});


$(document).ready(function() {
   console.log('ok'); 
   $('.open-sidebar').click(function(){
        if($(this).hasClass('fa-arrow-right')) {
            $('.sidebar').removeClass('col-md-1');
            $('.sidebar').addClass('col-md-2');
            $(this).removeClass('fa-arrow-right');
            $(this).addClass('fa-arrow-left');
            console.log('echo droite');
            
        } else if($(this).hasClass('fa-arrow-left')){
//            $('.sidebar').hide('slow');
            $('.sidebar').removeClass('col-md-2');
            $('.sidebar').addClass('col-md-1');
            $(this).removeClass('fa-arrow-left');
            $(this).addClass('fa-arrow-right');            
        }
   });
});


