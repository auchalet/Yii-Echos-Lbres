$(function() {   
    
    console.log('ok');
    //Clic sur change-avatar // Affichage du popup modal
    $('#update-user').on('click', function() {
        $('#modal-user').modal('show')
                   .find('#user-popup')
                   .load($(this).attr('value'));
    });    
    
});


