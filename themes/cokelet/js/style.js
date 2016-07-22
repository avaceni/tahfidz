$(".breadcrumbs a").hover(function() {

});
$(document).ready(function() {

    $(".tabview > ul > li").live("click", function() {
        $(".tabview > ul > li").removeClass("active");
        $(this).addClass("active");
        $(".tabview-pane").removeClass("active");
        $(".tabview-pane:eq(" + $(this).index() + ")").addClass("active");
    });
//    awal alert-close
    $('[class^="alert-"] > .close').live('click', function() {
        $(this).parent('[class^="alert-"]').remove();
    });
//    akhir alert-close

//    awal modal close
//    
//    akhir modal close
    $('[class^="modal-"] .close').live('click', function() {
        $(this).parents('.modal').hide();
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
        if (element.hasClass('close')) {
            if ($(this).hasClass('icon-folder-o')) {
                $(this).removeClass('icon-folder-o');
                $(this).addClass('icon-folder-open-o');
            }
            element.removeClass('close');
        } else if (!element.hasClass('close')) {
            if ($(this).hasClass('icon-folder-open-o')) {
                $(this).removeClass('icon-folder-open-o');
                $(this).addClass('icon-folder-o');
            }
            element.addClass('close');
        }
    });
    $('.treeview ul > li > a > span').live('click', function() {
        if ($(this).hasClass('is-selected')) {
            $(this).removeClass('is-selected');
            $(this).children('i.icon-check').remove();
        } else {
//            menghilangkan 
            $(this).parent('a').parent('li').parent('ul').parents('.treeview').find('span.is-selected').children('i.icon-check').remove();
            $(this).parent('a').parent('li').parent('ul').parents('.treeview').find('span.is-selected').removeClass('is-selected');

//            manambahkan
            $(this).addClass('is-selected');
            $(this).append('<i class="icon-check"></i>');
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

//awal modal
    $('.popup-show-button').live('click', function() {
        var
                url = $(this).attr('url'),
                size = $(this).attr('size'),
                modal = $('#ajax-modal').children('.modal-dialog').children('.modal-content');
        $('.modal').addClass('fade');
        $('.modal').addClass('in');
        $('.modal').children('.modal-dialog').addClass(size);
        $('.modal').show();
        $.ajax({
            url: url,
            type: 'POST',
            success: function(response) {
                modal.html(response);
            }
        });
    });
    $('.popup-show-data-button').live('click', function() {
        var
                url = $(this).attr('url'),
                size = $(this).attr('size'),
                modal = $('.modal').children('.modal-dialog').children('.modal-content'),
                data = $(this).parents('form').serialize();
        $('.modal').addClass('fade');
        $('.modal').addClass('in');
        $('.modal').children('.modal-dialog').addClass(size);
        $('.modal').show();
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                modal.html(response);
            }
        });
    });
//akhir modal
});
//awal fungsi dialog
function showDialog(url, size, data) {
    var
            url = url,
            size = size,
            modal = $('.modal').children('.modal-dialog').children('.modal-content'),
            data = data;
    $('.modal').addClass('fade');
    $('.modal').addClass('in');
    $('.modal').children('.modal-dialog').removeClass('modal-dialog-sm');
    $('.modal').children('.modal-dialog').removeClass('modal-dialog-lg');
    $('.modal').children('.modal-dialog').addClass(size);
    $('.modal').show();
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response) {
            modal.html(response);
        }
    });
}

function showAlertDialog(title, text) {
    var
            modal = $('.modal').children('.modal-dialog').children('.modal-content');
    $('.modal').addClass('fade');
    $('.modal').addClass('in');
    $('.modal').children('.modal-dialog').addClass('modal-dialog-sm');
    $('.modal').show();
    modal.html('<div class="panel panel-warning"> <div class="panel-heading"> <i class="icon-times right close"></i> <h3 class="panel-title">' + title + '</h3></div> <div class="panel-body">' + text + '</div> </div>');
}
//akhir fungsi dialog