var unsaved = false;
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var soundPlaying = false;
var aud = new Audio();
var idPlaying = "";
var jsmap;
$(document).ready(function () {
    $(window).on('load',function () { $.unblockUI(); });
    setTimeout(function () {
        $.unblockUI();
    }, 10000);
    $.ajaxSetup({
        data: {
            csrf_token_cc: $("#csrf_token_cc").val()
        }
    });
});

function loc_confirm(l) {
    if (unsaved == true) {
        sconfirm(JS_FORM_CHANGE_ALERT_TITLE, JS_FORM_CHANGE_ALERT_MSG, "loc('" + l + "');");
    } else {
        loc(l);
    }
}

function loc(l) {
    if (l == 'current') {
        location.href = location.href;
    } else {
        location.href = l;
    }
}
function nofunction() {
    return;
}
function initDataTable(objname, def_sort, sort_order, nosort_cols, row_limit) {
    if (jQuery().DataTable) {
        nosort_cols = typeof nosort_cols !== 'undefined' && nosort_cols !== '' ? nosort_cols : '';
        sort_order = typeof sort_order !== 'undefined' && nosort_cols !== '' ? sort_order : 'asc';
        def_sort = typeof def_sort !== 'undefined' && nosort_cols !== '' ? def_sort : 0;
		row_limit = typeof row_limit !== 'undefined' && row_limit !== '' ? row_limit : 25;

 
        return $('#' + objname).DataTable({
            order: [[def_sort, sort_order]],
            lengthMenu: [25, 50, 100, 150, 200],
            pageLength: row_limit,
            columnDefs: [{ orderable: false, targets: nosort_cols }],
            autoWidth: true,
            responsive: true,
            destroy: true,
			stateSave: true,
            
        });
    }
}
function addTableAction(objname, btnid, btnlable) {
    if (btnid != null) excel
    $("#" + objname + "_wrapper div.table-toolbar").html('<div class="row"><div class="col-md-12"><div class="btn-group"><button type="button" class="btn red-mint" id="' + btnid + '">' + btnlable + '</button></div></div></div>');
}

function process_form(formId) {
    $("#" + formId).validate({
        onkeyup: false,
        focusCleanup: true,
        onsubmit: true,
        submitHandler: function (form) {
            blockUI($(".ldcont"));
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
                    if (!response.status) {
                        salert(response.type, response.title, response.msg);
                        unblockUI($(".ldcont"));
                    } else {
                        if (typeof response.alert != 'undefined') {
                            salert(response.type, response.title, response.msg, response.loc);
                        } else {
                            loc(response.loc);
                        }
                    }
                }
            });
        }
    });
}


function initDatePicker() {
    if (jQuery().datepicker) {
        $('input.date').datepicker({ setDate: new Date(), autoclose: true, 'format': 'dd/mm/yyyy' });
    }
    if (typeof jQuery.fn.datepicker != "undefined") {

        $('.input-group.withpast.date').datepicker({
            beforeShowDay: function (date) {
                return date.valueOf() <= now.valueOf();
            },
            autoclose: true,
            todayHighlight: true,
            format: "dd-M-yyyy"
        });

        $('.input-group.nopast.date').datepicker({
            beforeShowDay: function (date) {
                return date.valueOf() >= now.valueOf();
            },
            autoclose: true,
            startDate: 0,
            todayHighlight: true,
            format: "dd-M-yyyy",
            orientation: 'auto bottom'
        });
        var curdate = new Date();
        $(".input-group.date").datepicker();
        $(".input-group.nopast.date").datepicker("setStartDate", curdate);
        $(".input-group.nopast.withEndDate.date").on('click', function () {
            $("#DurationEnd_EndDate").attr('checked', 'checked');
        });

    };
    if (typeof jQuery.fn.timepicker != "undefined") {
        $('.timepicker-24').timepicker({
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false,
            disableMousewheel: false
        });
    }
}
function bindselect(data, obj) {
    var option = '';
    $.each(data, function (i, item) {
        option += '<option value="' + i + '">' + item + '</option>';
    });
    obj.empty().append(option).removeAttr('disabled');
    obj.trigger('chnage');
}

function sconfirm(title, msg, action, close_on_confirm, Oktext, type) {

    close_on_confirm = (typeof close_on_confirm === "undefined" || close_on_confirm == '') ? false : close_on_confirm;
    Oktext = (typeof Oktext === "undefined" || Oktext == '') ? "OK" : Oktext;
	 alert_type = (typeof type === "undefined" || type == '') ? "warning" : type;

    swal({
        title: title,
        text: msg,
        type: alert_type,
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: Oktext,
        allowEscapeKey: false,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        closeOnConfirm: close_on_confirm
    },
             function () {
                 if (action != '') {
                     eval(action);
                 } else {
                     swal(JS_LBL_SUCCESS, JS_MSG_ACTION_COMPLETED, "success");
                 }
             });
}

function delconfirm(action, title, msg) {
    title = (typeof title === "undefined" || title == '') ? DELETE_CONFIRMATION_TITLE : title;
    msg = (typeof msg === "undefined" || msg == '') ? DELETE_CONFIRMATION_MSG : msg;

    swal({
        title: title,
        text: msg,
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Yes',
        closeOnConfirm: false,
        allowEscapeKey: false,
        allowOutsideClick: false
    },
          function () {
              eval(action);
          });

}


function blockUI(el, msg, delay) {
    msg = (typeof msg === "undefined" || msg == '') ? "" : msg;
    delay = (typeof delay === "undefined" || delay == '') ? 0 : delay;

    setTimeout(function () {
        if (msg == '') {
            App.blockUI({ target: el, iconOnly: true });
        } else {
            App.blockUI({ target: el, message: msg });
        }
    }, delay);

}

function unblockUI(el) {
    App.unblockUI(el);
}

function salert(type, title, msg, url) {
    title = (title == undefined || title == null || title == "") ? 'OK' : title;
    url = (url == undefined || url == null || url == "") ? false : url;
    swal({
        title: title,
        text: msg,
        type: type,
        html: true,
        showCancelButton: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        closeOnConfirm: true
    },
             function () {
                 if (url)
                     loc(url);
             });

}


function formatResult(item) {
    var itemsval = item.text.split("|");
    var itemtext = itemsval[0];
    var usrcnt = itemsval[1];
    if (!item.id) {
        return itemtext + ' <span class="badge">' + usrcnt + '</span>';
    }
    return itemtext + ' <span class="badge">' + usrcnt + '</span>';
}

function formatSelection(item) {
    var itemsval = item.text.split("|");
    var itemtext = itemsval[0];
    var usrcnt = itemsval[1];
    return itemtext;
}


function isdcode(data) {
    return data.id;
}

function initFilterSelect() {
    $('select.iniFilter').select2({
        templateResult: formatResult,
        templateSelection: formatSelection,
        width: '100%',
        closeOnSelect: false,
        dropdownAutoWidth: true,
        escapeMarkup: function (m) {
            return m;
        }
    });
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function check_session(rsp) {
    if (rsp.status == 403) {
        salert('warning', "Session Timed out", "To protect your personal information and for your security, this application has timed out.<br>We apologise for any inconvenience, please click OK to re-start your application.", location.href);
    } else if (rsp.status == 404) {
        salert('warning', "Alert", "The page you are looking for is not found");
    } else if (rsp.status == 500) {
        salert('error', "Alert", "There was an application error, please contact administrator", current_url);
    } else if (rsp.status != 200) {
        location.href = current_url;
    }
}

function load_modal(obj, modal_data) {
    modal_data = (modal_data == undefined || modal_data == null || modal_data == "") ? $.ajaxSetup()['data'] : modal_data + '&' + Object.keys($.ajaxSetup()['data'])[0] + '=' + $.ajaxSetup()['data'][Object.keys($.ajaxSetup()['data'])[0]];
	var modal_url = obj.attr('data-href');
	$.ajax({
        type: "POST",
        url: modal_url,
        dataType: "json",
        data: modal_data,
        success: function (html) {
            if (html.status) {
                create_modal(html.dlg);
            } else {
                salert(html.type, html.title, html.msg);
            }
            //unblockUI($('body'));
        },
        error: function (xhr, ajaxOptions, thrownError) {
          //  check_session(xhr);
            //unblockUI($('body'));
        }
    });
}

function create_modal(dlg) {
    $('body').append(dlg);
    var modalId = $(dlg).first().attr('id');
    $('#' + modalId).modal('show');
    $('#' + modalId).on('hidden.bs.modal', function (e) {
        $('#' + modalId).remove();
    });
}

function newguid() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x7 | 0x8)).toString(16);
    });
    return uuid;
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
}


function validate_phone(val, abc) {
    if ((val.charAt(0) == '0' || val.charAt(0) == 0) && val.trim() != '') {
        return false;
    } else {
        return true;
    }
}
function clearForm(scrn) {
    $(".tooltip").remove();
    $(scrn + ' input').not(':button, :submit, :hidden, :reset, :checkbox, :radio, .noclear').val('');
    //$(':checkbox, :radio').prop('checked', false);
    //$(scrn)[0].reset();
}

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}
function nltobr(string) {
    if ($.trim(string) != '') {
        return string.replace(/\r\n|\n|\r/g, '<br>').replace('"', '&quot;');
    } else {
        return "";
    }
}

function htmlDecode(value) {
    return $('<div/>').html(value).text();
}

function readonly_select(objs, action) {
    if (action === true)
        objs.prepend('<div class="disabled-select"></div>');
    else
        $(".disabled-select", objs).remove();
}

