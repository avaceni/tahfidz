$(document).ready(function() {
    $("div.menu-bar a").on("click", function() {
        $(this).toggleClass("active");
        $(".main-menu").toggleClass("show");
    });
    $(".setting").on("click", function(event) {
        event.stopPropagation();
        $("#dialog").fadeIn(200);
    });
    $(".close").on("click", function() {
        $("#dialog").fadeOut(200);
    });
    $("div.menu-consultation a").on("click", function() {
        $(this).toggleClass("active");
        $(".body .question-list").toggleClass("show");
    });


//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk melihat detail pertanyaan pada halaman ustadz
    $('#question-list').live('click', function() {
        $(this).addClass('active');
        var url = baseUrl + '/front/akun/DetailQuestion';
        var key = $(this).attr('key');
        $.ajax({
            url: url,
            data: {
                key: key
            },
            success: function(response) {
                $('.question-answer-box').html(response);
            }
        });
    });

//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk mengirim jawaban ustadz
    $('#send-answer').live('click', function() {
        var url = baseUrl + '/front/akun/send';
        $.ajax({
            url: url,
            data: $('#answer-form').serialize(),
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                $('.question-answer-box').html(response.html);
                if (response.type == 1)
                    $('.answer-form').slideUp();
            }
        });
    });
//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk menampilkan form edit
    $('#edit-answer').live('click', function(){
        $('.answer-form').slideDown();
    });
//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk filter pertanyaan berdasarkan kategori
    $('#answer-search').live('change', function(){
        var url = baseUrl+'/front/akun/FilterByCategory';
        var id = $(this).val();
        $.ajax({
            url : url,
            data:{
                id: id
            },
            type: 'get',
            success: function(response){
                $('#question-list-box').html(response);
            }
        });
        
    });
//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk menghapus pertanyaan
    $('.question-list-box i.icon-trash').live('click', function(){
        var url = baseUrl+'/front/akun/remove';
        var key = $(this).parent('a').parent('li').attr('key');
        $.ajax({
            url : url,
            data:{
                key: key
            },
            type: 'get',
            success: function(response){
                $('#question-list-box').html(response);
            }
        });
    });
//    dibuat oleh rizqi, 23-04-2014
//    digunakan untuk update akun ustad
    $('#submit-account-form').live('click', function(){
        var url = baseUrl+'/front/akun/SaveAccount';
        var key = $(this).parent('a').parent('li').attr('key');
        $.ajax({
            url : url,
            data:$('#account-form').serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response){
                $('#account-box').html(response.html);
                if(response.type == 1)
                    window.location.reload();
            }
        });
    });

});