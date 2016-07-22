function showPreview(file){
    $('#imgAvatar').attr('src', file.value); // for IE
    if (file.files && file.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgAvatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(file.files[0]);
    }
}
$(document).ready(function(){
    
});