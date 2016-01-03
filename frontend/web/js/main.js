$(function() {
    
    //Clic sur change-avatar
    $('#change-avatar').on('click', function() {
        $('#modal').modal('show')
                   .find('#picture-popup')
                   .load($(this).attr('value'));
    });

});

