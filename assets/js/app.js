$(document).ready(function () {
    if (typeof validator != 'undefined') {
        $.validator.addMethod("selectone", function (value, elem, param) {
            if ($(".selectone:checkbox:checked").length > 0) {
                return true;
            } else {
                return false;
            }
        }, "You must select at least one option!");

        $.validator.addMethod("decimal", function (value, element) {
            return this.optional(element) || /^[1-9]\d*(.\d+)?$/.test(value);
        }, "Please enter a decimal value");
    }

    



    $('#userForm, #engineerForm, #tuserForm').on("click", "#chkChngPwd", function () {
        if ($(this).prop('checked')) {
            $('#Password').prop('readonly', false);
        } else {
            $('#Password').prop('readonly', true);
        }
    });

    //Use the same billing address as company main address
    $('#companyForm').on("click", "#chkchangebilling", function () {
        if ($(this).prop('checked')) {
            enableBilling(false);
        } else {
            enableBilling(true);
        }
    });

    $('#filetoupload').on('change', function (e) {
        $('.uploadedfilename').val('');
        $('.img_container').hide();
        var filetype = $(this).data('filetype');
        ajaxfileupload(filetype, 'filetoupload');
    });

    $("#role_approver").click(function (e) {
        if ($(this).prop("checked"))
            $('#ALimit').prop('readonly', false);
        else
            $('#ALimit').prop('readonly', true);
    });


    initDatePicker();
    initDateTimePicker();


    //$('.dropdown-menu').parent().on('shown.bs.dropdown', function () {
    //    var $menu = $("ul", this);
    //    offset = $menu.offset();
    //    position = $menu.position();
    //    $('body').append($menu);
    //    $menu.show();
    //    $menu.css('position', 'absolute');
    //    $menu.css('top', (offset.top) + 'px');
    //    $menu.css('left', (offset.left) + 'px');
    //    $(this).data("outerdropdown", $menu);
    //});
    //$('.dropdown-menu').parent().on('hide.bs.dropdown', function () {
    //    $(this).append($(this).data("outerdropdown"));
    //    $(this).data("outerdropdown").removeAttr('style');

    //});

    $('input.date').on('change', function () {
        $('.datepicker').hide();
    });

    $("#clone_order_modal").on('loaded.bs.modal', function () {
        var delcutoff = new Date(cutoff);
        $("#DeliveryDate").datepicker({ startDate: delcutoff, format: 'dd-M-yyyy', autoclose: true });
        App.initAjax();
        $("#reorderForm").validate({
            submitHandler: function (form) {
                blockUI($("#reorderForm"));
                $.ajax({
                    url: form.action,
                    type: form.method,
                    dataType: 'json',
                    data: $(form).serialize(),
                    success: function (rsp) {
                        if (!rsp.status) {
                            $("#clone_order_modal").modal('hide');
                            alertbox("Error", rsp.msg);
                        } else {
                            $("#clone_order_modal").modal('hide');
                            alertLoc("Success", rsp.msg,'noref');
                        }
                        unblockUI($("#reorderForm"));
                    },
                    error: function () {
                        unblockUI($("#reorderForm"));
                    }
                });
            }
        });
    });


    //Tree view checkbox.
    $('#sectree input[type="checkbox"]').change(checkboxChanged);

});


function initDataTable(objname, btnid, btnlabel,newdom) {
    if (jQuery().DataTable) {
        newdom = (newdom == 'undefined' || newdom == '' || newdom == null ? "<'row'<'col-md-6 col-sm-6'l><'col-md-6 col-sm-6'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-5'i><'col-md-7 col-sm-7'p>>" : newdom);
        $('#' + objname).DataTable({
            dom: newdom, autoWidth: false,
            stateSave: true,
            responsive: true,
            destroy: true,
        });
        addTableAction(objname, btnid, btnlabel);
        tooltip();
    }
}

function addTableAction(objname, btnid, btnlable) {
    if (btnid != null)
        $("#" + objname + "_wrapper div.table-toolbar").html('<div class="row"><div class="col-md-12"><div class="btn-group"><button type="button" class="btn red-mint" id="' + btnid + '">' + btnlable + '</button></div></div></div>');
}

function ajaxpost(url, data, lockobj, rdloc) {
    lockobj = (lockobj == 'undefined' || lockobj == '' || lockobj == null ? 'dataList' : lockobj);
    rdloc = (rdloc == 'undefined' || rdloc == '' || rdloc == null ? location.href : rdloc);
    var ret;
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        async: false,
        success: function (response) {
            if (!response.status) {
                alertbox("Error", response.msg);
            } else {
                ret = response;
                if (rdloc != 'noref')
                    alertLoc("Success", response.msg, rdloc);
            }
            unblockUI($("#" + lockobj));
        }
    });
    return ret;
}

function commonFormSave(formId, loc) {
    loc = (loc == 'undefined' || loc == '' || loc == null ? location.href : loc);
    $("#" + formId).validate({
        submitHandler: function (form) {
            blockUI($("#" + formId));
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (response) {
                    if (!response.status) {
                        alertbox("Error", response.msg);
                    } else {
                        alertLoc("Success", response.msg, loc);
                    }
                    unblockUI($("#" + formId));
                }
            });
        }
    });
}

function ajaxfileupload(filetype, fileid) {
    $.ajaxFileUpload({
        url: jssite + 'settings/upload_file/',
        enctype: 'multipart/form-data',
        secureuri: false,
        fileElementId: fileid,
        dataType: 'json',
        data: {
            'filetype': filetype
        },
        success: function (data, status) {
            //alert(data.status + ' -- ' + data.msg);
            if (data.status == 'success') {
                $('.uploadedfilename').val(data.msg);
                showimgpreview(filetype, data.imgpath);
            }
            else {
                $('.uploadedfilename').val('');
                alertbox('File Upload Error', data.msg);
            }

        }
    });
    return false;
}
function showimgpreview(filetype, imgpath) {
    $('.img_container img').attr('src', imgpath);
    $('.img_container').show();
}
function getAbsoluteImgPath(path) {
    var dot = path.substr(0, 1);
    if (dot == '.')
        path = path.substr(1);
    return jssite + path;
}
function userimagepath(image) {
    return jssite + 'assets/images/user/thumbs/' + image;
}
function companylogopath(image) {
    return jssite + 'assets/images/company/thumbs/' + image;
}
function enableBilling(setenb) {
    $('#BillingAddress').prop('readonly', setenb);
    $('#BillingCity').prop('readonly', setenb);
    $('#BillingCountry').prop('readonly', setenb);
    $('#BillingPostCode').prop('readonly', setenb);
    $.uniform.update();
}
function loc(l) {
    location.href = l;
}
if ((typeof sessionTimeout != 'undefined')) {
    var SessionTimeout = function () {

        var handlesessionTimeout = function () {
            $.sessionTimeout({
                title: 'Session Timeout Notification',
                message: 'Your session is about to expire.',
                keepAliveUrl: jssite + 'welcome/index',
                redirUrl: jssite + 'account/logoff',
                logoutUrl: jssite + 'account/logoff',
                warnAfter: 850000, //warn after 5 seconds
                redirAfter: 900000, //redirect after 10 secons,
                countdownMessage: 'Redirecting in {timer} seconds.',
                countdownBar: false
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handlesessionTimeout();
            }
        };

    }();

    jQuery(document).ready(function () {
        SessionTimeout.init();
    });
}
function bindSearchEvents(form) {
    $(document).find("#" + form + " #Category").on('change', function () {
        //if ($(this).val() > 0) {
        //    $("#" + form + " #ProductId").prop('disabled', false).removeAttr('disabled').select2('val', '');
        //} else {
        //    $("#" + form + " #ProductId").prop('disabled', true).attr('disabled', 'disabled').select2('val', '');
        //}
        $("#prdAttributeHolder").empty();
    });

    $(document).find("#" + form + " #ProductId").select2({
        ajax: {
            url: admsite + '/catalogue/findproducts',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                    catid: $("#" + form + " #Category").val()
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items,
                };
            },
            cache: false,
        },
        minimumInputLength: 2,
        width: '100%'
    }).on('change', function (e) {
        var ProductId = $(this).val();
        var ord_companyId = $("#OrdCompanyId").val();
        if (ProductId > 0) {
            blockUI($("#" + form));
            $.ajax({
                url: admsite + '/catalogue/getProductAttribute/' + ProductId + '/' + ord_companyId,
                type: 'post',
                dataType: 'json',
                success: function (rsp) {
                    $("#prdAttributeHolder").html(rsp.html);
                    $("#warehouse_details").html(rsp.warehouse);
                    $("#store_at_warehouse").html(rsp.store_at_warehouse);
                    
                    $("#" + form + " .modal-btn-ok").prop('disabled', false).removeClass('disabled');
                    initSelect();
                    App.initAjax();
                    unblockUI($("#" + form));
                },
                error: function () {
                    unblockUI($("#" + form));
                }
            });
        } else {
           // $("#" + form + " .modal-btn-ok").prop('disabled', true).addClass('disabled');
        }
    });
}
function initSelect(obj) {
    obj = (obj == 'undefined' || obj == '' || obj == null ? '' : obj);
    $(obj+" select:not(.nochange)").select2({ width: '100%' });
}
function initDatePicker() {
    if (jQuery().datepicker) {
        $('input.date').datepicker({ setDate: new Date(), autoclose: true, 'format': 'dd/mm/yyyy' });
    }
}


function initDateTimePicker() {
    if (jQuery().datetimepicker) {
        $("input.datetime").datetimepicker({
            format: "dd-MM-yyyy hh:ii", autoclose: 1,
            pickerPosition: "bottom-right", minuteStep: 5
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
function checkboxChanged() {
    var $this = $(this),
        checked = $this.prop("checked"),
        container = $this.closest('li'),
        siblings = container.siblings();
    container.find('input[type="checkbox"]')
    .prop({
        indeterminate: false,
        checked: checked
    })
    .siblings('label')
    .removeClass('custom-checked custom-unchecked custom-indeterminate')
    .addClass(checked ? 'custom-checked' : 'custom-unchecked');

    checkSiblings(container, checked);
}

function checkSiblings($el, checked) {
    var parent = $el.parent().parent(),
        all = true,
        indeterminate = false;

    $el.siblings().each(function () {
        return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
    });

    if (all && checked) {
        parent.children('input[type="checkbox"]')
        .prop({
            checked: checked
        })
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass(checked ? 'custom-checked' : 'custom-unchecked');

        checkSiblings(parent, checked);
    }
    else if (all && !checked) {
        indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

        parent.children('input[type="checkbox"]')
        .prop("checked", checked)
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

        checkSiblings(parent, checked);
    }
    else {
        $el.parents("li").children('input[type="checkbox"]')
        .prop({
            checked: true
        })
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass('custom-indeterminate');
    }
}