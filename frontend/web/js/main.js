$(function() {
    
    //Clic sur change-avatar // Affichage du popup modal
    $('#change-avatar').on('click', function() {
        $('#modal').modal('show')
                   .find('#picture-popup')
                   .load($(this).attr('value'));
    });
    
    


});

