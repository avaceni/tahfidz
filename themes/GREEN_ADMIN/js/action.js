$(document).ready(function() {

//    awal submit-ajax
    $(".submit-ajax").live('click', function() {
        var
                ajaxData = $(this).parents('form').serialize(),
                ajaxType = $(this).attr('ajaxType'),
                ajaxUrl = $(this).attr('ajaxUrl'),
                ajaxDataType = $(this).attr('ajaxDataType')
                ;
        var data = $(this);
//        success = new Function($(this).attr('success'))
        $.ajax({
            url: ajaxUrl,
            data: ajaxData,
            type: ajaxType,
            dataType: ajaxDataType,
            success: function(response) {
                var success = eval(data.attr('ajaxSuccess'));
                success;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var error = eval(data.attr('ajaxError'));
                error;
            }
        });
    });
//    akhir submit-ajax

//    awal chage-ajax
    $(".change-ajax").live('change', function() {
        var
                ajaxData = $(this).attr('ajaxData'),
                ajaxType = $(this).attr('ajaxType'),
                ajaxUrl = $(this).attr('ajaxUrl'),
                ajaxDataType = $(this).attr('ajaxDataType')
                ;
        var data = $(this);
        $.ajax({
            url: ajaxUrl,
            data: ajaxData,
            type: ajaxType,
            dataType: ajaxDataType,
            success: function(response) {
                var success = eval(data.attr('ajaxSuccess'));
                success;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var error = eval(data.attr('ajaxError'));
                error;
            }
        });
    });
//    akhir change-ajax  

//awal action

//awal ajax pada menu manager
    $('#Menu_moduleUrl').live('change', function() {
        $.ajax({
            url: baseUrl + '/menu/AjaxControllerList',
            data: {
                module: $(this).val()
            },
            success: function(controllers) {
                $('#Menu_controllerUrl').html(controllers);
                $.ajax({
                    url: baseUrl + '/menu/AjaxActionList',
                    data: {
                        module: $('#Menu_moduleUrl').val(),
                        controller: $('#Menu_controllerUrl').val()
                    },
                    success: function(actions) {
                        $('#Menu_actionUrl').html(actions);
                    }
                });
            }
        });
    });
    $('#Menu_controllerUrl').live('change', function() {
        $.ajax({
            url: baseUrl + '/menu/AjaxActionList',
            data: {
                module: $('#Menu_moduleUrl').val(),
                controller: $('#Menu_controllerUrl').val()
            },
            success: function(actions) {
                $('#Menu_actionUrl').html(actions);
            }
        });
    });
//awal ajax pada menu manager
//akhir action
});