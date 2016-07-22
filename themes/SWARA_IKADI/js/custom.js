$(document).ready(function() {

    $("body").addClass("jsready");
    $("li.article").clone().appendTo(".menu-box.article ul.dropdown-box");
    $(".clone").clone().appendTo(".sidebarmenu ul.menu-list");
    /* var styles = {
     text-decoration : "none",
     color : '#333'
     }*/
    $("a.author[href=''],.author a[href='']").removeAttr("href").css({'text-decoration': 'none', color: '#333'}).hover(function() {
        $(this).css("color", "inherit")
    });
    /*feature & news slider*/
    $("#featureSlider").bxSlider({
        auto: true,
        startAuto: true,
        stopAuto: false,
        autoControls: false,
        pause: 3000,
        autoHover: true
    });

    $(".detail-info-box a").fancybox();
    $(".various").fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: true,
        openEffect: 'none',
        closeEffect: 'none'
    });

    $("#newsSlider").bxSlider({
        auto: true,
        stopAuto: false,
        autoControls: false,
        controls: false,
        pause: 10000,
        autoHover: true,
        pagerCustom: '#slide-control'
    });

    /*dropdown menu*/
    $(".sidebarmenu .menu-drop").click(function() {
        $(this).toggleClass("active");
        $(this).parent(".menu-box").find("ul.dropdown-box").slideToggle(80);
    });

    /*more menu button*/
    $(".more-button").click(function() {
        $(this).toggleClass("active");
        $(".sidebarmenu").show();
        timeout = setTimeout(function() {
            $(".sidebarmenu").toggleClass("active");
        }, 2);
    });

    /*tabmenu*/
    $(".tabmenu a").click(function() {
        status = $(this).attr("id");
        $(".tabmenu a").removeClass("active");
        $(this).addClass("active");
        $("ul.tab-content").hide();
        $(this).parents(".popular-news").find("ul.tab-content." + status).show();
    });

    /*search & go top button*/
    var header = $("header");
    var search = $(".search a");
    var gotop = $(".gotop a");
    search.click(function() {
        $("#search").focus();
        $("body,html").animate({
            scrollTop: 0
        }, 200);
        return false;
    });
    gotop.click(function() {
        $("body,html").animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

    /*scrolling*/
    $(window).scroll(function() {
        if ($(this).scrollTop() > 94) {
            header.addClass("scroll");
            if ($(this).scrollTop() > 144) {
                header.addClass("scrolling");
            }
        } else {
            header.removeClass("scrolling");
            header.removeClass("scroll");
        }
    });

    /*show ask form*/
    $(".show-ask").click(function() {
        $(this).toggleClass("active");
        $("#ask-form").slideToggle(100);
        $("#ask-form").find("li:first-child input").focus();
    });

    /*show ask form*/
    $("#comment").click(function() {
        $(this).toggleClass("active");
        $("#comment-form").slideToggle(100);
        $("#comment-form").find("li:first-child input").focus();
    });

    /*demo whathappen*/
    $(".button-box.loader a").click(function() {
        $(this).addClass("loading");
        load_times = $(".load-times").attr("id");
        page_type = $(".page-type").attr("id");
        var url = baseUrl + "/front/page/ajaxcontentmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'load_times': load_times,
                'content_type_id': page_type
            },
            dataType: "json",
            success: function(response) {
                $(".article-box").append(response);
                $(".button-box.loader a").removeClass("loading");
                if (response.length == 0) {
                    $(".button-box").css("display", "none");
                }
                ;
                load_next = parseFloat(load_times) + 1;
                $(".load-times").attr("id", load_next);
            }
        });
    });

    $(".button-box.download-loader a").click(function() {
        $(this).addClass("loading");
        select_option = $(".select-option").attr("id");
        select_keyword = $(".select-keyword").attr("id");
        last_offset = $(".last-offset").attr("id");
        var url = baseUrl + "/front/page/ajaxdownloadmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'select_option': select_option,
                'select_keyword': select_keyword,
                'last_offset': last_offset
            },
            dataType: "json",
            success: function(response) {
                $(".table-box table").append(response.list);
                $(".button-box.loader a").removeClass("loading");
                if (response.length == 0) {
                    $(".button-box").css("display", "none");
                }
                ;
                $(".last-offset").attr("id", response.next_offset);
            }
        });
    });

    $(".button-box.comment-loader a").click(function() {
        $(this).addClass("loading");
        content_id = $(".content_id").attr("id");
        content_type = $(".content_type").attr("id");
        last_offset = $(".last-offset").attr("id");
        var url = baseUrl + "/front/page/ajaxcommentmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'content_id': content_id,
                'content_type': content_type,
                'last_offset': last_offset
            },
            dataType: "json",
            success: function(response) {
                $(".comment-box ul.comment-list").append(response.list);
                $(".button-box.comment-loader a").removeClass("loading");
                if (response.list.length == 0) {
                    $(".button-box").css("display", "none");
                }
                ;
                $(".last-offset").attr("id", response.next_offset);
            }
        });
    });

    $(".button-box.search-loader a").click(function() {
        $(this).addClass("loading");
        search_timestamp = $(".search-timestamp").attr("id");
        search_keyword = $(".search-keyword").attr("id");
        search_last_offset = $(".search-last-offset").attr("id");
        var url = baseUrl + "/front/page/ajaxsearchmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'search_timestamp': search_timestamp,
                'search_keyword': search_keyword,
                'search_last_offset': search_last_offset
            },
            dataType: "json",
            success: function(response) {
                $(".result-area ul.search-list").append(response.list);
                $(".button-box.search-loader a").removeClass("loading");
                if (response.list.length == 0) {
                    $(".button-box").css("display", "none");
                }
                ;
                $(".search-last-offset").attr("id", response.offset);
            }
        });
    });

//    dibuat oleh rizqi, 26-03-2014
//     untuk load more event pada halaman info kajian
    $("#event-more").click(function() {
        $(this).addClass("loading");
        var last_offsets = $("#new_event_last_offset").attr("value");
        var url = baseUrl + "/front/page/ajaxeventmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'last_offset': last_offsets
            },
            dataType: "json",
            success: function(response) {
                $("#event-list").append(response.list);
                $("#event-more").removeClass("loading");
                if (response.list == "")
                    $("#event-more").remove();
                else
                    $("#new_event_last_offset").val(response.next_offset);
            }
        });
    });

//    dibuat oleh rizqi, 26-03-2014
//     untuk load more konsultasi pada halaman konsultasi
    $(".button-box.consultation-loader a").click(function() {
        $(this).addClass("loading");
        last_offset = $("#newconsultation_last_offset").val();
        var url = baseUrl + "/front/page/ajaxconsultationmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'last_offset': last_offset
            },
            dataType: "json",
            success: function(response) {
                $("#newConsultation").append(response.list);
                $(".button-box a").removeClass("loading");
                if (response.list == "")
                    $("#event-more").remove();
                else
                    $("#newconsultation_last_offset").val(response.next_offset);
            }
        });
    });


//    dibuat oleh rizqi, 08-04-2014
//     untuk load more pada halaman komentar detail konsultasi 
    $("#btn_consultationcomment_loadmore").click(function() {
        $(this).addClass("loading");
        last_offset = $("#consultationcomment_last_offset").val();
        var url = baseUrl + "/front/page/ajaxconsultationmore";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'last_offset': last_offset
            },
            dataType: "json",
            success: function(response) {
                $("#consultationcomment").append(response.list);
                $("#btn_consultationcomment_loadmore a").removeClass("loading");
                $("#consultationcomment_last_offset").val(response.next_offset);
            }
        });
    });

    scaleTextareas();    
});


/*dynamic all textarea height*/
function scaleTextareas() {
    $('textarea').each(function(i, t) {
        var m = 0;
        $($(t).val().split("\n")).each(function(i, s) {
            m += (s.length / (t.offsetWidth / 10)) + 1;
        });
        t.style.height = Math.floor(m + 5) + 'em';
    });
    setTimeout(scaleTextareas, 800);
}
;

function sendComment() {
    var data = $('#com-form').serialize();
    $('ul.form-format li .data').removeClass('error');
    $('ul.form-format li .data span.errorMessage').html('');
    $.ajax({
        type: 'POST',
        url: baseUrl + "/front/page/detailberita",
        data: data,
        success: function(data) {
            if (data.success == 1) {
                $('.comment-list').prepend(data.message);
                $('#com-form')[0].reset();
            }
            else {
                for (var i in data.message) {
                    $('ul.form-format li .data.' + i).addClass('error');
                    $('ul.form-format li .data span.errorMessage.' + i).html(data.message[i]);
                }
            }
        },
        error: function(data) { // if error occured
            alert('Error occured.please try again');
        },
        dataType: 'json'
    });
}
;

function searchDownload() {
    var data = $('#com-form-download').serialize();
    $.ajax({
        type: 'POST',
        url: baseUrl + "/front/page/download",
        data: data,
        dataType: 'json',
        success: function(response) {
            $('#download .table-box').html(response.list);
            $(".select-option").attr("id", response.option);
            $(".select-keyword").attr("id", response.keyword);
            $(".last-offset").attr("id", response.offset);
            if (response.exist != 1) {
                $(".button-box").css("display", "none");
            }
        },
        error: function(data) { // if error occured
            alert('Error occured.please try again');
        }
    });
}
;

function countDownload(id) {
    $.ajax({
        type: 'POST',
        url: baseUrl + "/front/page/countdownload",
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(response) {
        }
    });
}
;
