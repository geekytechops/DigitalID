$('input').focus(function(){
    alert();
    $(this).parent('div').find('.error-message').hide();
    $(this).removeClass('invalid-feed');
})