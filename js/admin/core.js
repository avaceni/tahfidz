/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $(document).on('click', '.c-top-reciters li a', function() {
        var parentLi = $(this).parent('li');
        parentLi.addClass('active');
        parentLi.siblings().removeClass('active');
        var grade = $(this).attr('data-grade');
        var parentReciter = $(this).parents('.panel-body').find('.tab-content').find('.' + grade);
        parentReciter.addClass('active');
        parentReciter.siblings().removeClass('active');
    });
    
    var dashboardGraphicChart = $(document).find('#chart');
    if(dashboardGraphicChart.length > 0){    
        d3.json(baseUrl + '/adminck/financechart', function(error, data) {
            (function() {
                nv.addGraph(function() {
                    var chart = nv.models.lineChart().useInteractiveGuideline(true);
                    chart.xAxis
                            .axisLabel("Tanggal").tickFormat(function(d) {
                        return d3.time.format("%d/%m/%Y")(new Date(d))
                    });
                    ;
                    var formatAxis = d3.format('.3s');
                    chart.yAxis
                            .tickFormat(function(val) {
                                return formatAxis(val).replace('.', ',').replace('k', ' k').replace('M', ' Juta').replace('G', ' M');
                            })
                    d3.select("svg")
                            .datum(data)
                            .call(chart);
                    nv.utils.windowResize(chart.update);
                    return chart;
                });
            })();
        });
    }

    $(document).on('click', '.c-step', function() {
        if (!$(this).hasClass('disable')) {
            if ($(this).hasClass('edit')) {
                var attr = $(this).attr('data-tab');
                if ($(this).parent('ul').hasClass('stepy-header')) {
                    var activeClass = 'stepy-active';
                }
                else {
                    var activeClass = 'active';
                }
                $(this).addClass(activeClass);
                $(this).siblings().removeClass(activeClass);
                var stepy = $(this).parents('.panel-body').find("fieldset.stepy-step[data-tab='" + attr + "']");
                stepy.removeClass('hide');
                stepy.siblings('fieldset').addClass('hide');
                sessionStorage.setItem("c-santri-step", attr);
            }
            else {
                //validate active stepy
                var activeStepy = $(this).parents('.panel-body').find('fieldset').not('.hide');
                var form = activeStepy.find('form').not('.dont-validate').first();
                var trigger = 'li';
                var thisIs = $(this);
                validateForms(activeStepy, form, trigger, thisIs, function() {
                });
            }
        }
    });

    $(document).on('click', '.c-btn-edit', function() {
        $(this).addClass('hide');
        $(this).siblings('.c-btn-save').removeClass('hide');
        $(this).siblings('.c-btn-cancel').removeClass('hide');

        var fieldset = $(this).parents('fieldset');
        fieldset.find('.c-detail-view').addClass('hide');
        fieldset.find('.c-form-edit').removeClass('hide');
        recallDateForm();
        return false;
    });

    $(document).on('click', '.c-btn-cancel', function() {
        $(this).addClass('hide');
        $(this).siblings('.c-btn-save').addClass('hide');
        $(this).siblings('.c-btn-edit').removeClass('hide');

        var fieldset = $(this).parents('fieldset');
        fieldset.find('.c-detail-view').removeClass('hide');
        fieldset.find('.c-form-edit').addClass('hide');
        return false;
    });

    $(document).on('click', '.c-santri-delete', function() {
        var parentLabel = $(this).parents('.c-form-label');
        var nextForm = parentLabel.next();
        if (nextForm.hasClass('c-new-form')) {
            nextForm.remove();
            parentLabel.remove();
        }
        else {
            var action = nextForm.attr('data-url-delete');
            var id = nextForm.attr('data-id');
            var model = nextForm.attr('data-model');
            $.ajax({
                type: 'POST',
                url: action,
                dataType: 'json',
                data: {id: id, model: model},
                success: function(data) {
                    if (data.success == 1) {
                        nextForm.remove();
                        parentLabel.remove();
                    }
                },
                error: function(data) { // if error occured
                    alert('Error occured.please try again');
                },
            });
        }
        return false;
    });

    $(document).on('click', '.c-santri-save', function() {
        var trigger = $(this);
        var formData = {};
        var parentForms = $(this).parents('fieldset');
        var forms = parentForms.find('form');
        forms.find('.has-error').removeClass('has-error');
        forms.find('.c-error-field').remove();
        var action = parentForms.find('form').first().attr('action');
        var forms = parentForms.find('form');
        forms.each(function(index, value) {
            var o = {};
            var a = $(this).serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            formData[index] = o;
        });

        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            dataType: 'json',
            success: function(data) {
                if (data.success == true) {
                    parentForms.html(data.fieldset);
//                    var input = parentForms.find('input');
//                    $.each(input, function() {
//                        var value = $(this).val();
//                        $(this).parents('.form-group').find('.c-detail-view').find('a').text(value);
//                    });
//                    trigger.siblings('.c-btn-cancel').trigger('click');
                }
                else {
                    $.each(data, function(index, value) {
                        if (index != 'success' && index != 'fieldset') {
                            $.each(value, function(formEq, message) {
                                if (message.success != 1) {
                                    $.each(message.message, function(field, error) {
                                        var form = forms.eq(parseInt(formEq));
                                        parentInput = form.find("[id*=" + field + "]").parents('.form-group');
                                        parentInput.addClass('has-error');
                                        var error = $("<div class='col-md-3 c-error-field'>" + error + "</div>");
                                        error.appendTo(parentInput);
                                    });
                                }
                            });
                        }
                    });
                }
            },
            error: function(data) { // if error occured
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    $(document).on('click', '.c-btn-multi', function() {
        $(this).siblings('.c-btn-save').removeClass('hide');
        $(this).siblings('.c-btn-cancel').removeClass('hide');
        var fieldset = $(this).parents('fieldset');
        var dataTab = fieldset.attr('data-tab');
        var number = fieldset.find('h4').last().find('span').text();
        if (fieldset.find('h4').last().length <= 0) {
            var number = 0;
        }
        var data = {
            number: parseInt(number) + 1,
        };

        var multiTemplate = $(document).find('#' + dataTab).html();
        var fragment = $(Mustache.render(multiTemplate, data));
        var findLastForm = fieldset.find('form').last();
        if (findLastForm.length > 0) {
            findLastForm.after(fragment);
        }
        else {
            $(this).parents('.panel-ctrls').after(fragment);
        }
//        $.getScript(baseUrl+'/js/lib/datepicker/bootstrap-datetimepicker.id.js');
        recallDateForm();
//        fragment.appendTo(fieldset);
        return false;
    });

    function recallDateForm() {
        $('.form_date').datetimepicker({
            language: 'id',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    }

    $(document).on('click', '.c-validate-form', function() {
        var form = $(this).parents('form');
        var attr = form.parent('fieldset').attr('data-tab');
        var data = form.serialize();
        var action = form.attr('action');
        $(form).find('.has-error').removeClass('has-error');
        $(form).find('.c-error-field').remove();
        $.ajax({
            type: 'POST',
            url: action,
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                }
                else {
                    for (var i in data.messages) {
//                        console.log(data.messages[i]);
                        parentInput = form.find("[id*=" + i + "]").parents('.form-group');
                        parentInput.addClass('has-error');
                        var error = $("<div class='col-md-3 c-error-field'>" + data.messages[i] + "</div>");
                        error.appendTo(parentInput);
                    }
                }
            },
            error: function(data) { // if error occured
                alert('Error occured.please try again');
            },
        });
//        event.preventDefault();
    });

    $(document).on('click', '.c-stepy-next', function() {
        //find first form;
        var fieldset = $(this).parents('fieldset');
        var trigger = 'next';
        //find first form;
        var form = fieldset.find('form').not('.dont-validate').first();
        var thisIs = $(this);
        validateForms(fieldset, form, trigger, thisIs, function() {
        });
        event.preventDefault();
    });

    $(document).on('click', '.c-stepy-back', function() {
        var fieldset = $(this).parents('fieldset');
        var dataTab = fieldset.attr('data-tab');
        var prevLi = fieldset.parents('.c-combined-form').find("li.c-step[data-tab='" + dataTab + "']").prev();
        prevLi.removeClass('disable').trigger('click');
        event.preventDefault();
    });

    function validateForms(fieldset, form, trigger, thisIs, callback) {
        var data = form.serialize();
        var action = form.attr('action');
        $(form).find('.has-error').removeClass('has-error');
        $(form).find('.c-error-field').remove();
        if (data.length > 0) {
            $.ajax({
                type: 'POST',
                url: action,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (data.success == 1) {
//                    alert('sukses');
                        var forms = fieldset.find('form');
                        var idx = forms.index(form);
                        var nextForm = forms.eq(idx + 1);
                        nextForm.addClass('selanjutnya');
                        if (nextForm.length > 0) {
//                            console.log('ada form lagi');
                            validateForms(fieldset, nextForm, trigger, thisIs, function() {
                            });
                        }
                        else {
//                            console.log('form terakhir');
                            //find li with same data-tab with field
                            if (trigger == 'next') {
                                var dataTab = fieldset.attr('data-tab');
                                var nextLi = fieldset.parents('.c-combined-form').find("li.c-step[data-tab='" + dataTab + "']").next();
                                nextLi.removeClass('disable').trigger('click');
                            }
                            else {
                                var attr = thisIs.attr('data-tab');
                                if (thisIs.parent('ul').hasClass('stepy-header')) {
                                    var activeClass = 'stepy-active';
                                }
                                else {
                                    var activeClass = 'active';
                                }
                                thisIs.addClass(activeClass);
                                thisIs.siblings().removeClass(activeClass);
                                var stepy = thisIs.parents('.panel-body').find("fieldset.stepy-step[data-tab='" + attr + "']");
                                stepy.removeClass('hide');
                                stepy.siblings('fieldset').addClass('hide');
                                sessionStorage.setItem("c-santri-step", attr);
                            }
                        }
                    }
                    else {
                        for (var i in data.messages) {
//                        console.log(data.messages[i]);
                            parentInput = form.find("[id*=" + i + "]").parents('.form-group');
                            parentInput.addClass('has-error');
                            var error = $("<div class='col-md-3 c-error-field'>" + data.messages[i] + "</div>");
                            error.appendTo(parentInput);
                        }
                    }
                },
                error: function(data) { // if error occured
                    alert('Error occured.please try again');
                },
            });
        }
        else {
            if (trigger == 'next') {
                var dataTab = fieldset.attr('data-tab');
                var nextLi = fieldset.parents('.c-combined-form').find("li.c-step[data-tab='" + dataTab + "']").next();
                nextLi.removeClass('disable').trigger('click');
            }
            else {
                var attr = thisIs.attr('data-tab');
                if (thisIs.parent('ul').hasClass('stepy-header')) {
                    var activeClass = 'stepy-active';
                }
                else {
                    var activeClass = 'active';
                }
                thisIs.addClass(activeClass);
                thisIs.siblings().removeClass(activeClass);
                var stepy = thisIs.parents('.panel-body').find("fieldset.stepy-step[data-tab='" + attr + "']");
                stepy.removeClass('hide');
                stepy.siblings('fieldset').addClass('hide');
                sessionStorage.setItem("c-santri-step", attr);
            }
        }
        if (callback && typeof (callback) === "function") {
            callback();
        }
    }

    $('.form_date').datetimepicker({
        language: 'id',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    $(document).on('click', '#c-create-santri', function() {
        var formData = {};
        var parentForms = $(this).parents('.c-combined-form');
        var action = $(this).attr('data-url');
        var forms = parentForms.find('form').not('.dont-validate');
        forms.each(function(index, value) {
            var o = {};
            var a = $(this).serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            formData[index] = o;
        });

        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            dataType: 'json',
            success: function(data) {
                forms.each(function(index, value) {
                    $(this).trigger("reset");
                });
                parentForms.find('#crop-photo-id').val('null');
                parentForms.find('img[data-target="#avatar-modal"]').attr('src', baseUrl + "/images/resource/no-profile-image-2x3.jpg");
                parentForms.find('li.c-step').not('.c-step-first').addClass('disable');
            },
            error: function(data) { // if error occured
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    function tesAlert(alertMe) {
        alert(alertMe);
    }

    $('.c-santri-register').on('click', function() {
        var action = $(this).attr('data-url');
        var registerModal = $(document).find('#register-modal');
        $.ajax({
            type: 'GET',
            url: action,
            success: function(data) {
                registerModal.find('.modal-body').html(data);
                var form = registerModal.find('form');
                $('.c-registration-delete').on('click', function() {
                    $.ajax({
                        type: 'GET',
                        url: $(this).attr('href'),
                        success: function(data) {
                            if(data.success == '1'){
                                
                            }
                        },
                        error: function(data) {
                            alert('Error occured.please try again');
                        },
                    });
                    event.preventDefault();
                });
                $('.c-registration-graduate').on('click', function() {
                    $.ajax({
                        type: 'GET',
                        url: $(this).attr('href'),
                        success: function(data) {
                            var alert = registerModal.find('.c-success-alert').html();
                            form.prepend(alert);
                        },
                        error: function(data) {
                            alert('Error occured.please try again');
                        },
                    });
                    event.preventDefault();
                });                
                $('#register-modal').modal('show');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    $('.c-registration-save').on('click', function() {
        var registerModal = $(this).parents('#register-modal');
        var form = registerModal.find('form');
        var action = form.attr('action');
        $.ajax({
            type: 'POST',
            url: action,
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                var alert = $(document).find('.c-success-alert').html();
                form.prepend(alert);
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });
    
    $(document).find("form[id*=search-santri]").submit(function() {
        var grid = $(this).attr('data-grid');
        $.fn.yiiGridView.update(grid, {
            data: $(this).serialize(),
        });
        return false;
    });

    $(document).find('.c-gender-filter').on('click', function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $(this).siblings("[id*=gender]").val($(this).attr('data-id'));
        searchSantri($(this).attr('data-url'), $(this).parents('form'));
        return false;
    });

    function searchSantri(url, form) {
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                var panels = form.parent().siblings('.c-filter-info-panel');
                panels.find('#c-filter-count-putra').html(' '+data.count_putra+' ');
                panels.find('#c-filter-count-putri').html(' '+data.count_putri+' ');
                panels.find('.c-filter-count-total').html(' '+(parseInt(data.count_putra)+parseInt(data.count_putri))+' ');
                panels.find('#c-filter-quarters-name').html(' '+data.quarters_name+' ');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        $.fn.yiiGridView.update(form.attr('data-grid'), {
            type: 'GET',
            data: form.serialize(),
        });
    }

    $(document).find('.c-santri-filter').change(function() {
        var form = $(this).parents('form');
        var url = $(this).attr('data-url');
        searchSantri(url, form);
        return false;
    });

    $(document).find('#add-hafalan-form').submit(function() {
        thisIs = $(this);
        $(this).find('.has-error').removeClass('has-error');
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update('add-hafalan-grid');
                    thisIs.trigger("reset");
                }
                else {
                    for (var i in data.messages) {
                        thisIs.find("[id*=" + i + "]").parent().addClass('has-error');
                    }
                }
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        return false;
    });

    $('.c-recitation-save').on('click', function() {
        //".c-data-tab[data-tab='" + dataTab + "']"
        var save = $(this);
        var recitationModal = $(this).parents('.modal');
        var form = recitationModal.find('form');
        var action = form.attr('action');
        form.find('.has-error').removeClass('has-error');
        form.find('.c-error-field').remove();
        $.ajax({
            type: 'POST',
            url: action,
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update(save.attr('data-grid'));
                    var alert = $(document).find('.c-success-alert').html();
                    form.prepend(alert);
                    if(!save.hasClass('no-reset')){
                        form.trigger('reset');
                    }
                    form.find('.c-finded-santri-image').attr('src', baseUrl + "/images/resource/no-profile-image-2x3.jpg");
                }
                else {
                    for (var i in data.messages) {
                        parentInput = form.find("[id*=" + i + "]").parents('.form-group');
                        parentInput.addClass('has-error');
                        var error = $("<div class='col-md-3 c-error-field'>" + data.messages[i] + "</div>");
                        error.appendTo(parentInput);
                    }
                }
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    var listSantriSearch = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
//        prefetch: '../data/films/post_1960.json',
        remote: {
            url: baseUrl + '/hafalan/data/searchsantri?query=%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('.c-search-santri').typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1
            },
    {
        name: 'search-santri',
        display: 'name',
        source: listSantriSearch,
        updater: function(item) {
//            console.log(item);
        },
        templates: {
            empty: [
                '<div class="empty-message">',
                'nama tidak ditemukan',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile(
                    '<div class="pull-left">\n\
                        <div style="float:left;">\n\
                            <img src="{{photo}}" width="32" height="32" class="img-circle">\n\
                        </div>\n\
                        <div style="float:left; padding:7px 0 0 10px;"><strong>{{name}}</strong></div>\n\
                    </div>'
                    )
        }
    }).on('typeahead:selected', function(e, datum) {
        var bindedTypeaheadId = $(document).find('#bindedTypeaheadsantri');
        bindedTypeaheadId.val(datum.id);
        var bindedImage = $(document).find('#bindedImagesantri');
        bindedImage.attr('src', datum.photo);
        url = bindedTypeaheadId.attr('data-url');
        santri_id = datum.id;
        var ustadz = bindedTypeaheadId.parents('form').find('.c-ustadz');
        $.ajax({
            type: 'POST',
            url: url,
            data: {santri_id:santri_id},
            dataType: 'json',
            success: function(data) {
                ustadz.html(data.ustadz_option);
            },
            error: function(data) {
                //alert('Error occured.please try again');
            },
        });
    });
    
    var listUstadzSearch = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
//        prefetch: '../data/films/post_1960.json',
        remote: {
            url: baseUrl + '/hafalan/data/searchustadz?query=%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('.c-search-ustadz').typeahead(
    {
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'search-santri',
        display: 'name',
        source: listUstadzSearch,
        updater: function(item) {
//            console.log(item);
        },
        templates: {
            empty: [
                '<div class="empty-message">',
                'nama tidak ditemukan',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile(
                    '<div class="pull-left">\n\
                        <div style="float:left;">\n\
                            <img src="{{photo}}" width="32" height="32" class="img-circle">\n\
                        </div>\n\
                        <div style="float:left; padding:7px 0 0 10px;"><strong>{{name}}</strong></div>\n\
                    </div>'
                    )
        }
    }).on('typeahead:selected', function(e, datum) {
        var bindedTypeaheadId = $(document).find('#bindedTypeaheadustadz');
        bindedTypeaheadId.val(datum.id);
        var bindedImage = $(document).find('#bindedImageustadz');
        bindedImage.attr('src', datum.photo);
    });

    $('.c-grid-deleteall').on('click', function() {
        var url = $(this).attr('data-url');
        var grid = $(this).attr('data-grid');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url,
            data: $('form.' + grid).serialize(),
            success: function(response) {
                if (response.total_delete > 0) {
                    $.fn.yiiGridView.update(grid);
                } else {

                }
            }
        });
    });

    $(document).find('#add-halaqoh-form').submit(function() {
        var form = $(this);
        $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                var alert = $(document).find('.c-success-alert').html();
                form.prepend(alert);
                $.fn.yiiGridView.update('halaqoh-list-grid');
                form.trigger('reset');
            },
        });
        return false;
    });

    $('.c-group-edit').on('click', function() {
        var action = $(this).attr('data-url');
        var registerModal = $(document).find('#group-modal');
        $.ajax({
            type: 'GET',
            url: action,
            success: function(data) {
                registerModal.find('.modal-body').html(data);
                $('#group-modal').modal('show');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    $('.c-halaqoh-save').on('click', function() {
        var form = $(document).find('#group-update-form');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    var alert = $(document).find('.c-success-alert').html();
                    form.prepend(alert);
                }
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    $('#add-santri-halaqoh-form').submit(function() {
        var form = $(this);
        $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update('santri-group-member-grid');
                    console.log('for2', $(this));
                    var alert = $(document).find('.c-success-alert').html();
                    form.prepend(alert);
                    form.trigger('reset');
                }
            }
        });
        return false;
    });

    $('.c-simple-add-form').submit(function() {
        var form = $(this);
        form.find('.has-error').removeClass('has-error');
        $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            url: form.attr('action'),
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update(form.attr('data-grid'));
//                    form.prepend(alert);
                    form.trigger('reset');
                }
                else {
                    for (var i in data.messages) {
                        form.find("[id*=" + i + "]").parent().addClass('has-error');
                    }
                }
            }
        });
        return false;
    });

    $('.c-simple-update').on('click', function() {
        var action = $(this).attr('data-url');
        var modal = $(this).attr('data-modal-id');
        if(typeof modal != typeof undefined){
            var modalElement = '#'+modal;
        }
        else{
            var modalElement = '.simple-update-modal';
        }
        var updateModal = $(document).find(modalElement);
        $.ajax({
            type: 'GET',
            url: action,
            success: function(data) {
                updateModal.find('.modal-body').html(data);
                $(modalElement).modal('show');
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        return false;
    });

    $('.c-simple-update-modal').on('click', function() {
        var modal = $(this).parents('.modal');
        var form = modal.find('form');
        var action = form.attr('action');
        form.find('.has-error').removeClass('has-error');
        form.find('.c-error-field').remove();
        $.ajax({
            type: 'POST',
            url: action,
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update(form.attr('data-grid'));
                    var alert = $(document).find('.c-success-alert').html();
                    form.prepend(alert);
                }
                else {
                    for (var i in data.messages) {
                        parentInput = form.find("[id*=" + i + "]").parents('.form-group');
                        parentInput.addClass('has-error');
                        var error = $("<div class='col-md-3 c-error-field'>" + data.messages[i] + "</div>");
                        error.appendTo(parentInput);
                    }
                }
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });

    $(document).on('click', '.c-tab', function() {
        var dataTab = $(this).attr('data-tab');
        var parentPanel = $(this).parents('panel');
        var allDataTab = parentPanel.find('.c-data-tab');
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        allDataTab.addClass('hide');
        parentPanel.find(".c-data-tab[data-tab='" + dataTab + "']").removeClass('hide')
    });
    
    $(document).find('.c-absent-type').change(function() {
        var nonAbsent = $(document).find('.c-non-absent');
        if($(this).val() != 1){
            nonAbsent.addClass('hide');
        }
        else{
            nonAbsent.removeClass('hide');
        }
        return false;
    });
    
    $(document).find('.c-filter-recitation').change(function() {
        var monthFilter = $(this).parents('.form-group').siblings('.c-recitation-filter-month');
        if($(this).val() == 'all' && $(this).parents('.form-group').hasClass('c-recitation-filter-year')){
            monthFilter.addClass('hide');
        }
        else{
            monthFilter.removeClass('hide');
        }
        var form = $(this).parents('form');
        filterRecitation(form);
        return false;
    });
    
    function filterRecitation(form) {
        $.fn.yiiGridView.update(form.attr('data-grid'), {
            type: 'GET',
            data: form.serialize(),
        });
    }

    $(document).on('click', '.c-create-link', function() {
        window.location = $(this).attr('data-url');
        return false;
    });
    
//    $('.nailthumb-icon').nailthumb({
//        width:30,height:30
//    });
    
    $(document).find('.c-recitation-type').change(function() {
        var type = $(this).val();
        var santri_id = $(this).parents('form').find('.c-my-santri-id').val();
        var juz = $(this).parents('form').find('.c-get-my-juz');
        var url = $(this).attr('data-url');
        var page = $(this).parents('form').find('.c-halaman');
        // console.log('type', type);
        // console.log('santri_id', santri_id);
        // console.log('url', url);
        $.ajax({
            type: 'POST',
            url: url,
            data: {santri_id:santri_id,type:type},
            dataType: 'json',
            success: function(data) {
                juz.html(data.juz_option);
                if(data.juz < 0){
                    page.addClass('hide');
                }
                else{
                    page.removeClass('hide');
                }
            },
            error: function(data) {
                //alert('Error occured.please try again');
            },
        });
        return false;
    });
    
    $('.c-admin-save').on('click', function() {
        //".c-data-tab[data-tab='" + dataTab + "']"
        var save = $(this);
        var recitationModal = $(this).parents('.modal');
        var form = recitationModal.find('form');
        var action = form.attr('action');
        form.find('.has-error').removeClass('has-error');
        form.find('.c-error-field').remove();
        $.ajax({
            type: 'POST',
            url: action,
            data: form.serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success == 1) {
                    $.fn.yiiGridView.update(save.attr('data-grid'));
                    var alert = $(document).find('.c-success-alert').html();
                    form.prepend(alert);
                    form.trigger('reset');
                }
                else {
                    for (var i in data.messages) {
                        parentInput = form.find("[id*=" + i + "]").parents('.form-group');
                        parentInput.addClass('has-error');
                        var error = $("<div class='col-md-3 c-error-field'>" + data.messages[i] + "</div>");
                        error.appendTo(parentInput);
                    }
                }
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        event.preventDefault();
    });
    
    $('.c-recitation-summary').on('click', function() {
        var action = $(this).attr('data-url');
        var registerModal = $(this).attr('data-modal-id');
        $('#'+registerModal).modal('show');
    });
    
    $('.c-filter-summary-recitation').change(function() {
        var form = $(this).parents('form');
        var registerModal = form.attr('data-modal-id');
        var url = form.attr('action');
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            url: url,
            dataType: 'json',
            success: function(data) {
                $('#'+registerModal).find('#summary-table').html(data.table);
                $('#c-month-recite').html(data.month);
                $('#c-year-recite').html(data.year);
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
    });
    
    $(document).find('.c-filter-donation').change(function() {
        var form = $(this).parents('form');        
        if($(this).val() == 'all' && $(this).parent().hasClass('c-donation-year')){
            var monthFilter = $(this).parent().siblings('.c-donation-month');
            monthFilter.addClass('hide');
            console.log('ada');
        }
        else{
            var monthFilter = $(this).parent().siblings('.c-donation-month');
            monthFilter.removeClass('hide');
            console.log('tidak');
        }
        filterDonation(form);
        return false;
    });
    
    function filterDonation(form) {
        $.fn.yiiGridView.update(form.attr('data-grid'), {
            type: 'GET',
            data: form.serialize(),
        });
    }
    
    $(document).on('click', '.c-btn-pdf', function() {
        var form = $(this).parents('form');
        var url = $(this).attr('href');
        var param = $.param(form.serializeArray());
//        thisA.attr('href',url+'?'+param);
        window.open(url+'?'+param);
        return false;
    });

    $(document).find('.c-filter-donation').change(function() {
        var form = $(this).parents('form');
        var url = $(this).attr('data-url');
        filterFinance(url, form);
        return false;
    });

    function filterFinance(url, form) {
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            url: url,
            success: function(data) {
                $(document).find('.c-total-finance-month').text(data);
            },
            error: function(data) {
                alert('Error occured.please try again');
            },
        });
        // $.fn.yiiGridView.update(form.attr('data-grid'), {
        //     type: 'GET',
        //     data: form.serialize(),
        // });
    }    
    
});