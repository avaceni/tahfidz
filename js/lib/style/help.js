var animation;
function showLoading(parent, animationImage){
    var url = baseUrl+"/images/resource/"+animationImage;
    animation = "<div class='content-loading'><img src='"+url+"'></div>";
    $(parent).html(animation);
    $('.content-loading').css({
        "margin":"0 41%"
    });
}