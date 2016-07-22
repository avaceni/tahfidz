$(function(){
    $(".open-actiondialog").click(function(){
        $(".actiondialog-box").show(0, function(){
            if($('.actiondialog-box').contents().length == 1)
                $("#loading-dialog-overlay").show(0);
        });
        $('#dialog-overlay').fadeTo("normal", 0.4);
    });
    $(".close-actiondialog").click(function(){
        closeActionDialog();
    });
});
function closeActionDialog(){
    $('#dialog-overlay').fadeOut(0, function(){
        $(".actiondialog-box").hide(0, function(){
        });
    });
}

function hideLoading(){
    $("#loading-dialog-overlay").hide();
}