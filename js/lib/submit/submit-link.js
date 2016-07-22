$(document).ready(function(){
    $('.submit-link').click(function(e) {
        $('form#form-admin').attr('action', $(this).attr('url'));
        document.getElementById('form-admin').submit();
    });
});