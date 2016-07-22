$(document).ready(function() {

//    awal submit-ajax
    $(".submit-ajax").live('click', function() {
        var
                ajaxData = $(this).parents('form').serialize(),
                ajaxType = $(this).attr('ajaxType'),
                ajaxUrl = ($(this).attr('ajaxUrl').length > 0) ? $(this).attr('ajaxUrl') : $(this).parents('form').attr('action'),
                ajaxDataType = $(this).attr('ajaxDataType')
                ;
        var data = $(this);
//        $(this).append('<i class="icon-refresh icon-spin"></i>');
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

    $('#treeview-menulist ul > li > a > span').live('click', function() {
        if ($(this).hasClass('is-selected'))
            $('#Menu_parent_id').val($(this).parent('a').find('input[type="checkbox"]').val());
        else
            $('#Menu_parent_id').val(0);
    });

//    filter pada group menu
    $('#group-menu-filter').live('change', function() {
        var id = $(this).val();
        $.ajax({
            url: baseUrl + '/GroupMenu/ajaxfiltergroup',
            data: {
                id: id
            },
            success: function(response) {
                $('#group-menu-list').html(response);
                $('#group-id').val(id);
            }
        });
    });
//awal ajax pada menu manager
//
//pada access, untuk menampilkan controller
    $('#access-treeview-module-list li a > span').live('click', function() {
        var url = baseUrl + '/access/SearchController';
        $.ajax({
            url: url,
            type: 'get',
            data: {
                'module_id': $(this).parent('a').parent('li').attr('key')
            },
            success: function(response) {
                $('#access-treeview-controller-list').html(response);
                $('#access-treeview-action-list').html('No controller selected');
            }
        });
    });
//pada access, untuk menampilkan action
    $('#access-treeview-controller-list li a > span').live('click', function() {
        var url = baseUrl + '/access/SearchAction',
                module_name = $('#access-treeview-module-list li a span.is-selected').parent('a').parent('li').attr('name'),
                module_id = $('#access-treeview-module-list li a span.is-selected').parent('a').parent('li').attr('key'),
                controller_name = $(this).parent('a').parent('li').attr('key'),
                group_id = $('#group_id').val();

//        alert(module_name);
        $.ajax({
            url: url,
            type: 'get',
            data: {
                'module_name': module_name,
                'controller_name': controller_name,
                'group_id': group_id
            },
            success: function(response) {
                $('#access_module_id').val(module_id);
                $('#access_controller').val(controller_name);
                $('#access_group_id').val(group_id);
                $('#access-treeview-action-list').html(response);
            }
        });
    });

    //pada navigation, untuk menampilkan controller.
    $('#navigation-treeview-module-list li a > span').live('click', function() {
        var url = baseUrl + '/navigation/SearchController',
                module_id = $(this).parent('a').parent('li').attr('key');
        $.ajax({
            url: url,
            type: 'get',
            data: {
                'module_id': module_id
            },
            success: function(response) {
                $('#navigation-treeview-controller-list').html(response);
                $('#navigation-treeview-action-list').html('No controller selected');
            }
        });
    });

    //pada navigation, untuk menampilkan navigasi.
    $('#navigation-treeview-controller-list li a > span').live('click', function() {
        var url = baseUrl + '/navigation/SearchNavigation',
                module_name = $('#navigation-treeview-module-list li a span.is-selected').parent('a').parent('li').attr('name'),
                module_id = $('#navigation-treeview-module-list li a span.is-selected').parent('a').parent('li').attr('key'),
                controller_name = $(this).parent('a').parent('li').attr('key'),
                group_id = $('#navigation-group-filter').val();

//        alert(module_name);
        $.ajax({
            url: url,
            type: 'get',
            data: {
                'module_id': module_id,
                'controller_name': controller_name,
                'group_id': group_id
            },
            success: function(response) {
                $('#navigation-list').html(response);
                $('#controller-name').val(controller_name);
            }
        });
    });
//    pada navigation, untuk filter contoller
    $('#Navigation_moduleUrl').live('change', function() {
        $.ajax({
            url: baseUrl + '/menu/AjaxControllerList',
            data: {
                module: $(this).val()
            },
            success: function(controllers) {
                $('#Navigation_controllerUrl').html(controllers);
                $.ajax({
                    url: baseUrl + '/menu/AjaxActionList',
                    data: {
                        module: $('#Navigation_moduleUrl').val(),
                        controller: $('#Navigation_controllerUrl').val()
                    },
                    success: function(actions) {
                        $('#Navigation_actionUrl').html(actions);
                    }
                });
            }
        });
    });
//    pada navigation, untuk filter action
    $('#Navigation_controllerUrl').live('change', function() {
        $.ajax({
            url: baseUrl + '/menu/AjaxActionList',
            data: {
                module: $('#Navigation_moduleUrl').val(),
                controller: $('#Navigation_controllerUrl').val()
            },
            success: function(actions) {
                $('#Navigation_actionUrl').html(actions);
            }
        });
    });

//    pada navigation untuk menampilkan form tambah
    $('#navigation-create').live('click', function() {
        var url = $(this).attr('url'),
                data = {
                    group_id: $('#navigation-group-filter').val(),
                    module_id: $('#navigation-treeview-module-list span.is-selected').parent('a').parent('li').attr('key'),
                    controller_name: $('#navigation-treeview-controller-list span.is-selected').parent('a').parent('li').attr('key')
                };
        if ((data['group_id'] != "") && (data['controller_name'] != "")) {
            showDialog(url, 'modal-dialog-lg', data);
        } else {
            showAlertDialog('Peringatan', 'Maaf anda belum memilih group, module atau controller.');
        }
    });

//    pada navigation untuk menampilkan form update
    $('#navigation-update').live('click', function() {
        var url = $(this).attr('url'),
                data = {
                    id: $('#navigation-list span.is-selected').parent('a').parent('li').attr('key')
                };
        if ((data['id'] != "")) {
            showDialog(url, 'modal-dialog-lg', data);
        } else {
            showAlertDialog('Peringatan', 'Maaf anda belum memilih group, module atau controller.');
        }
    });

//akhir action
});