$(".breadcrumbs a").hover(function() {

});

$(document).ready(function() {
//    awal tabview
    $(".tabview > ul > li").live("click", function() {
        $(".tabview > ul > li").removeClass("active");
        $(this).addClass("active");
        $(".tabview-pane").removeClass("active");
        $(".tabview-pane:eq(" + $(this).index() + ")").addClass("active");
    });
//    akhir tabview
    
// show hide left pannel
//    $(".menu-toggle a").live("click",function(){
//        if($('body').hasClass('left-panel-collapsed'))
//            $('body').removeClass('left-panel-collapsed');
//        else if(!$('body').hasClass('left-panel-collapsed'))
//            $('body').addClass('left-panel-collapsed');
//    });
//    akhir show hide left pannel
    
//    awal side ul.drop-down
    $('.left-pannel-inner > ul > li').live('click', function() {
        if ((!$(this).children('ul.drop-down').hasClass('active')) && (!$(this).hasClass('active'))) {
            $('.left-pannel-inner > ul > li').removeClass('active');
            $('.left-pannel-inner > ul > li').children('ul.dropdown-menu').slideUp();
            $(this).addClass('active');
            $(this).children('ul.dropdown-menu').slideDown();
        } else {
            $(this).children('.left-pannel-inner ul.drop-down').removeClass('active');
            $(this).removeClass('active');
        }
    });
//    akhir side ul.drop-down

    //    header-bar
    $('.header-bar > ul > li').live('click', function() {
        if (!$(this).hasClass('active')) {
            $('.header-bar > ul > li').removeClass('active');
            $(this).addClass('active');
        } else {
            $('.header-bar > ul > li').removeClass('active');
        }

    });
    $('.left-pannel-inner ul > li ').each(function() {
        var child = $(this).find('ul.dropdown-menu');
        var isCurrent = false;
        child.each(function() {
            if ($(this).find('li').hasClass('current')) {
                isCurrent = true;
            }
        });
        if (isCurrent) {
            $(this).addClass('current');
            $(this).find('ul.dropdown-menu').show();
        }
    });
//    akhir menu
    
//    awal alert-close
    $('[class^="alert-"] > .close').live('click', function() {
        $(this).parent('[class^="alert-"]').remove();
    });
//    akhir alert-close

//    awal modal close
//    
//    akhir modal close 
   $('[class^="modal-"] > .close').live('click', function() {
        $(this).parents('.modal').fadeOut();
    });
//    awal treeview
    $('.treeview > ul > li > a > input[type="checkbox"]').live('click', function() {
        if ($(this).attr("checked") == "checked")
            $(this).parents('li').find("ul.child input[type='checkbox']").attr("checked", "checked");
        else
            $(this).parents('li').find("ul.child input[type='checkbox']").removeAttr("checked");
    });
    $('.treeview ul > li > a > i').live('click', function() {
        var element = $(this).parent('a').parent('li').children('ul');
        if(element.hasClass('close')){
            if($(this).hasClass('icon-folder-o')){
                $(this).removeClass('icon-folder-o');
                $(this).addClass('icon-folder-open-o');
            }
            element.removeClass('close');
        }else if(!element.hasClass('close')){
            if($(this).hasClass('icon-folder-open-o')){
                $(this).removeClass('icon-folder-open-o');
                $(this).addClass('icon-folder-o');
            }
            element.addClass('close');
        }
    });
//    akhir treeview

//    awal untuk preview image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageInput").change(function() {
        readURL(this);
    });
//    akhir image preview
});
//$(".breadcrumbs a").dialog("open");