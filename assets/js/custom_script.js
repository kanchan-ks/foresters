(function ($) {
    "use strict";


    jQuery.extend(
    jQuery.expr[':'].containsi = function (a, i, m) {
        //-- faster than jQuery(a).text()
        var sText = (a.textContent || a.innerText || "");
        var zRegExp = new RegExp(m[3], 'i');
        return zRegExp.test(sText);
    });

    /*===================================================================================*/
    /*  WOW 
    /*===================================================================================*/

    $(document).ready(function () {

        $('.order-section').on('click', '.torequest, .toapprove', function (e) {
            //$('#approversModal').modal('show');
            $('#placeOrderModal').modal('show');
        });

        $(document).on('keydown', '.numericonly', function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 32]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
                (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    });

    /*===================================================================================*/
    /*  CUSTOM CONTROLS
    /*===================================================================================*/

    $(document).ready(function () {

        // Select Dropdown
        //if ($('.le-select').length > 0) {
        //    $('.le-select select').customSelect({ customClass: 'le-select-in' });
        //}

        if ($('select').length > 0) {
            $('select').select2({ width: '100%' });
        }

        // Checkbox
        //if ($('.le-checkbox').length > 0) {
        //    $('.le-checkbox').after('<i class="fake-box"></i>');
        //}

        //Radio Button
        //if ($('.le-radio').length > 0) {
        //    $('.le-radio').after('<i class="fake-box"></i>');
        //}

        // Buttons
        //$('.le-button.disabled').click(function (e) {
        //    e.preventDefault();
        //});

        // Quantity Spinner
        $('body').on('blur focusout', '.spinner input', function (e) {
            e.preventDefault();
            var ths = $(this).val().trim();
            if (ths == '')
                $(this).val('0');
        });

        var timeoutId = 0;
        var mouseStillDown = false;
        $('body').on('mousedown', '.spinner .input-group-addon', function (e) {
            timeoutId = 0;
            e.preventDefault();
            mouseStillDown = true;
            var ths = $(this);
            qtyspinner(ths);
            process_spinner(ths);
        }).on('mouseup mouseleave', '.spinner .input-group-addon', function (e) {
            e.stopPropagation();
            clearInterval(timeoutId);
        });

        function process_spinner(obj) {
            if (!mouseStillDown) { return; }
            if (mouseStillDown) {
                timeoutId = setInterval(function () {
                    qtyspinner(obj)
                }, 100);
            }
        }

        function qtyspinner(obj) {
            var qtyObj = obj.parent().find('input');
            var maxqty = qtyObj.attr('max');
            if (typeof maxqty === "undefined")
                maxqty = 999999;

            var minqty = qtyObj.attr('data-min');
            if (typeof minqty === "undefined")
                minqty = 1;

            var currentQty = qtyObj.val();

            if (currentQty == '')
                currentQty = minqty;

            currentQty = parseInt(currentQty);

            if (obj.hasClass('minus')) {
                var computed = minqty;
                if (currentQty > minqty) {
                    computed = parseInt(currentQty) - 1;
                } else if (currentQty == 0) {
                    computed = minqty;
                }
                qtyObj.val(computed);
            } else {
                if (obj.hasClass('plus')) {
                    var newQty = parseInt(currentQty, 10) + 1;
                    if (newQty <= maxqty && maxqty)
                        qtyObj.val(newQty).prop('disabled', false);
                }
            }
            qtyObj.trigger('change');

        }

        // Data Placeholder for custom controls

        $('[data-placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('data-placeholder')) {
                input.val('');

            }
        }).blur(function () {
            var input = $(this);
            if (input.val() === '' || input.val() == input.attr('data-placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('data-placeholder'));
            }
        }).blur();

        $('[data-placeholder]').parents('form').submit(function () {
            $(this).find('[data-placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('data-placeholder')) {
                    input.val('');
                }
            });
        });

        tooltip();

        $('.top-drop-menu').change(function () {
            var loc = ($(this).find('option:selected').val());
            window.location = loc;
        });

        $('#toggleList').click(function () {
            $('.pro-button-list').addClass("active");
            $('.pro-button-grid').removeClass("active");
            $('#product-search').addClass("list-view").removeClass('grid-view');
        });
        $('#toggleGrid').click(function () {
            $('.pro-button-list').removeClass("active");
            $('.pro-button-grid').addClass("active");
            $('#product-search').addClass("grid-view").removeClass("list-view");
        });

        $('.sidemenu-holder .side-menu nav ul.nav > li.dropdown').hover(function () {
            var menuTop = $('.sidemenu-holder .side-menu nav ul.nav > li:nth-child(1n) > ul.mega-menu');
            var nthTop = 30 * ($(this).index() + 1); /* find current nth:child */
            var ulTop = -(nthTop - 29);
            menuTop.css('top', ulTop + 'px');
            /*alert($(this).index('.sidemenu-holder .side-menu nav ul.nav > li') + 1);*/
            /*alert(parseInt(menuTop.css('top')));*/
        });


        /*===================================================================================*/
        /*  CONTROL WIDTH OF THE COMPARE TABLE TD DEPENDING ON THE TD-COUNT
        /*===================================================================================*/
        var num;
        var $tds;
        $(".compare-list.techtable.table").each(function (i, t) {
            $tds = $("td", t);
            num = $tds.length;

            if (num % 3 == 0) {
                $tds.eq(0).css("width", "25%").end()
                    .eq(1).css("width", "25%").end()
                    .eq(2).css("width", "25%");
            }
            else if ((num % 2 == 0)) {
                $tds.eq(0).css("width", "37.5%").end()
                    .eq(1).css("width", "37.5%");
            }
            else {
                $tds.css("width", "75%");
            }
        });
    });


    var formedit = false;
    $('input, select, textarea').on('change', function () {
        formedit = true;
    });
    $(".btnCancelEdit").on('click', function () {
        if (formedit) {
            var msg = 'Any changes made will be lost, do you still want to proceed?';
            bootbox.confirm({
                closeButton: false,
                title: 'Confirm',
                message: msg,
                buttons: { 'cancel': { label: 'Abort', }, 'confirm': { label: 'Yes, Proceed!', } },
                callback: function (result) {
                    if (result) {
                        iniForm(false);
                        formedit = false;
                    }
                }
            });
        } else {
            iniForm(false);
        }
    });

})(jQuery);

$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
    if (jqxhr.status == 404) {
        location.href = location.href;
    }
});

function sconfirm(title, msg, action, close_on_confirm) {

    close_on_confirm = (typeof close_on_confirm === "undefined" || close_on_confirm == '') ? false : close_on_confirm;

    swal({
        title: title,
        text: msg,
        type: "warning",
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        allowEscapeKey: false,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        closeOnConfirm: close_on_confirm
    },
             function () {
                 if (action != '') {
                     eval(action);
                 } else {
                     swal('Success', 'Action completed successfully', "success");
                 }
             });
}

function alertbox(title, msg, size, url, type) {
    $('.modal').modal('hide');
    title = (title == undefined || title == null || title == "") ? 'OK' : title;
    url = (url == undefined || url == null || url == "") ? false : url;
    type = (type == undefined || type == null || type == "") ? 'info' : type;
    
    swal({
        title: title,
        text: msg,
        type: type,
        html: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        allowEscapeKey: false,
        allowOutsideClick: false,
        showLoaderOnConfirm: false,
        closeOnConfirm: false
    },
             function () {
                 if (url)
                     loc(url);
             });
}
var spromptval = '';
function sprompt(title, msg, action, close_on_confirm) {

    close_on_confirm = (typeof close_on_confirm === "undefined" || close_on_confirm == '') ? false : close_on_confirm;
    spromptval = '';
    swal({
        title: title,
        text: msg,
        html: true,
        type: "input",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        allowEscapeKey: false,
        allowOutsideClick: false,
        inputPlaceholder: msg,
        closeOnConfirm: close_on_confirm
    },
             function (inputvalue) {
                 if (inputvalue === false) return false;
                 if (inputvalue === "") {
                     swal.showInputError("Field cannot be left blank!");
                     return false;
                 }
                 spromptval = inputvalue;

                 if (action != '') {
                     eval(action);
                 }
             });
}

function load_modal(obj, modal_data) {
    //modal_data = (modal_data == undefined || modal_data == null || modal_data == "") ? $.ajaxSetup()['data'] : modal_data + '&' + Object.keys($.ajaxSetup()['data'])[0] + '=' + $.ajaxSetup()['data'][Object.keys($.ajaxSetup()['data'])[0]];
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
                alertbox("Error", html.msg);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {

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

function delconfirm(msg, title) {
    title = (title == undefined || title == null) ? "Delete" : title;
    msg = (msg == undefined || msg == null) ? "Are you sure you want to delete?" : msg;
    bootbox.dialog({
        message: msg, title: title, size: 'medium', buttons: {
            danger: {
                label: "Cancel", className: "btn-danger", callback: function () { return 0; }
            }, success: { label: "OK", className: "le-button", callback: function () { return 1; } },
        }
    });
}

function swalloc(ty, msg, url, title) {
    title = (title == undefined || title == null || title == "") ? 'OK' : title;
    swal({
        title: title,
        text: msg,
        type: ty,
        closeOnConfirm: true
    },
             function () {
                 loc(url);
             });

}


function alertLoc(title, msg, url, type) {
   // $('.modal').modal('hide');
    title = (title == undefined || title == null || title == "") ? 'OK' : title;
    url = (url == undefined || url == null || url == "") ? false : url;
    type = (type == undefined || type == null || type == "") ? "info" : type;
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

function loadCompareKey(keys) {
    $('.addToCompare').prop("checked", false);
    $.each(keys, function (i, key) {
        $("input[data-img=\"" + keys[i] + "\"].addToCompare").prop("checked", true);
    });
}


function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax = arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
function trunc(str, max_length, suffix, margin) {
    max_length = max_length | 0;
    margin = margin | 0;
    if (max_length <= 0 || str.length <= max_length + margin)
        return str;
    if (undefined === suffix || null === suffix)
        suffix = '';
    return str.slice(0, max_length) + suffix;
}

function zoomPhoto() {
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
    if (w > 480) {
        if ($('a[data-rel="prettyphoto"] img').length > 0) {
            $('a[data-rel="prettyphoto"] img').elevateZoom({ borderSize: 2, zoomWindowWidth: 350, zoomWindowHeight: 350, scrollZoom: true, easing: true, responsive: true });
        }
        $('a[data-rel="prettyphoto"]').click(function (e) {
            e.preventDefault();
        });
    } else {
        prettyPhoto();
    }
}
function prettyPhoto() {
    if ($('a[data-rel="prettyphoto"]').length > 0) {
        $('a[data-rel="prettyphoto"]').prettyPhoto({
            social_tools: false
        });
    }
}
function tooltip() {
    $('[data-toggle="tooltip"]').tooltip();
}

function trim(val) {
    return $.trim(val);
}
function selcValue(obj, val) {
    $(obj).val(trim(val)).trigger('change.customSelect');
}
function iniForm(shd) {
    if (shd) {
        $("#dataList").slideUp('fast');
        $("#editScreen").fadeIn();
        $('.orderstatustabs, #companystatustabs').hide();
    } else {
        $("#editScreen").fadeOut();
        $("#dataList").slideDown('fast');
        $('.orderstatustabs, #companystatustabs').show();
        clearForm("#editScreen");
    }
    App.initAjax();
    $.uniform.update();
}

function clearForm(scrn) {
    $(".tooltip").remove();
    $(scrn + ' input').not(':button, :submit, :hidden, :reset, :checkbox, :radio, .noclear').val('');
    $(scrn + ' textarea').not(':button, :submit, :hidden, :reset, :checkbox, :radio, .noclear').val('');
    $(':checkbox.unsel, :radio.unsel').prop('checked', false);
    //$(scrn + " select.select2-hidden-accessible").select2('val', '');
    $('.defhid').hide();
}

function pad(str, max) {
    str = str.toString();
    var ret = str.length < max ? pad("0" + str, max) : str;
    return ret;
}

function formatisodate(isodate) {
    var dateParts = isodate.split("-");
    var myDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0, 2));

    var dd = myDate.getDate();
    var mm = myDate.getMonth() + 1; //January is 0!

    var yyyy = myDate.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    var newdate = dd + '/' + mm + '/' + yyyy;

    return newdate;
}

function stripHTML(dirtyString) {
    var regex = /(<([^>]+)>)/ig
    var body = dirtyString;
    var result = body.replace(regex, "");

    return result;
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '')
      .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function (n, prec) {
          var k = Math.pow(10, prec);
          return '' + (Math.round(n * k) / k)
            .toFixed(prec);
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
      .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
      .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
          .join('0');
    }
    return s.join(dec);
}

function validateDecimal(e) {
    var val = e;
    var ret = 0.00;

    var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?[0-9]?|[0-9])/g;
    val = re1.exec(val);
    //console.log(val);
    if (val) {
        ret = val[0];
    }

    return ret;
}

