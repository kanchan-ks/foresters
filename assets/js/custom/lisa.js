$(document).ready(function(){
'use strict';
$('body').on('keypress', 'input[type="text"]', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9@.#,_+=/')( \-\]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });


$('body').on('keypress', '.toptup_policy_number', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9/]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });



$("#lisa_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/lisa/back_step/',
		type: 'POST',
		dataType: 'json',
		data: {step: steps},
		success: function (response) {
			if (!response.status) {
				salert('error', response.msg, '', response.loc);
			}else{
				$("#pgbar").html(response.data.progressbar);	
				curObj.parents("section").addClass("hide");
				//curObj.parents("section").css("display","none");
				curObj.parents("section").prev("section").removeClass("hide");	
				//curObj.parents("section").prev("section").css("display","block");
				
				$('select').each(function () {
					$(this).select2({
					  theme: 'bootstrap4',
					  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
					  placeholder: $(this).attr('placeholder'),
					  allowClear: Boolean($(this).data('allow-clear')),
					});
				  });
			}
			
			$("div[id^='tooltip']").hide();
		}
	});
});



$("body #frmyourdetails").on("change", ".dob_day, .dob_month, .dob_year", function(){
	var day = $("#frmyourdetails .dob_day").val();
	var month = $("#frmyourdetails .dob_month").val();
	var year = $("#frmyourdetails .dob_year").val();
	
	var year_tooltip_id = $("#frmyourdetails .dob_year").attr("aria-describedby");
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'lisa/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year},
			success: function (response) {
				if (!response.status) {
					$(".dob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
					salert('warning', "Age Warning", response.data, '');
				}
			}
		});
		$("#" + year_tooltip_id).hide();
	}
});

$("body").on('click', '#next2', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	var HeardAboutUs = $("#HeardAboutUs").val();
	var max_dob = $(".dob_year").attr('data-max');
	
	var dob_msg = "";
	if(max_dob == 40)
		dob_msg = "You must be 18-39 to apply for the Lifetime ISA.";
	else
		dob_msg = "You must be 18-50 to top-up your Lifetime ISA.";
	
	
	$("#frmyourdetails").validate({
		rules: {
			title: { required: true },
			other_title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			dob_year: { checkdateofbirth: ['dob_day', 'dob_month', 'dob_year'], check_min_date_of_birth:
				function(element) {
					return [$(".dob_day").val(), $(".dob_month").val(), $(".dob_year").val(), "18", max_dob, "Lifetime"];
				}
			},
			phone: { required: true},
			email: { required: true },
			cemail: { required: true, equalTo: '#email' },
			toptup_policy_number: { required: true},
			NI5: { checkAllNI: ['NI1','NI2','NI3','NI4','NI5'] },
			postcode: {required: function(element){ return $("#postcode_box").val()==""; }},
			old_address_change: {required:true},
			postcode_additional: {required: function(element){ return $("#additional_postcode_box").val()==""; }},
			//HeardAboutUs: {required:true},
			HeardAboutUs_extra: {required:true},
		},
		 messages: {
                title: "Please select your title",
				other_title: "Please enter your title",
                first_name: "Please enter your first name(s)",
                last_name: "Please enter your last name",
				dob_year: {
							required: "Please select your date of birth",
							check_min_date_of_birth: dob_msg
						  },
				phone: "Please enter your phone number (eg: 01234 567890)",
				email: "Please enter a valid email address",
				cemail: "Please check your email address matches",
				toptup_policy_number: "Please enter your existing Lifetime ISA policy number",
				NI5: "Please enter National Insurance number",
				postcode: "Please enter your postcode",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter your postcode",
				old_address_change: "Please tell us if you have changed address in the last 3 months",
				postcode_additional: "Please enter your postcode",
				additional_address1: "Please enter your address",
				additional_town: "Please enter your town",
				additional_county: "Please enter your county",
				additional_postcode_box: "Please enter your postcode",
				//HeardAboutUs : "Please tell us how did you hear about us",
				HeardAboutUs_extra: "",
		},
		highlight: function (element, errorClass, validClass) {
        $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).parents('.form-control').removeClass('has-error').addClass('has-success');
		},
		errorPlacement: function (error, element) {
			if(element.hasClass('select2') && element.next('.select2-container').length) {
				error.insertAfter(element.next('.select2-container'));
			} else if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}
			else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
				error.insertAfter(element.parent().parent());
			}
			else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
				error.appendTo(element.parent().parent());
			}
			else {
				error.insertAfter(element);
			}
		},		
		submitHandler: function (form) {
			blockUI($("#frmyourdetails"));
			$.ajax({
				url: base_url + 'lisa/lisa_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert('warning', "Error", response.msg, '');
						unblockUI($("#frmyourdetails"));
					} else {
						//load_modal(obj);
						//salert("Success", response.msg, '', 'current', 'success');
						$("#pgbar").html(response.data.progressbar);
						
						//if(response.data.view_payment_option)
							$(".view_payment_option_section").html(response.data.view_payment_opt);
						
						if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
							
							
						if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
							
						if(response.data.valid_dob)
							$(".summary_personal_section").html(response.data.personal_details_view);	
						
						
						if(response.data.type == true){
							$(".summary_heading_lbl").html("Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your top-up.");
							$(".application_to_topup").text("top-up");
							$(".application_to_form").text("form");
							$(".application_to_none").text(" top-up ");
						}else{
							$(".summary_heading_lbl").html("Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your application.");
							$(".application_to_topup").text("application");
							$(".application_to_form").text("application");
							$(".application_to_none").text("");
						}
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmyourdetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmyourdetails"));
				}
			});
		}
	});
	
	
	if($("#postcode_box").val() == ""){
		$("#postcode").val('');
		$("#postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your address"
				},
				
		});
	}
	
	if($("#postcode_additional_box").val() == ""){
		$("#postcode_additional").val('');
		$("#postcode_additional_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your address"
				},
				
		});
	}
	
	//var heard_about_msg = "";
	if(HeardAboutUs == "Other"){
		//var heard_about_msg = "Please tell us where you heard about us";
		$("#HeardAboutUs_extra").rules("add", { 
		  required:true,
		  messages: {
					required: "Please tell us where you heard about us"
				},
				
		});
	}
	if(HeardAboutUs == "Introducer"){
		$("#HeardAboutUs_extra").rules("add", { 
		  required:true,
		  check_heard_aboutus_introducer:true,
		  messages: {
					required: "Please enter the Introducer number, which should start with INT",
					
				},
				
		});
	}
	
//	alert(heard_about_msg);

});


$("body").on('click', '#next3', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	var monthly_val = $("#monthly_innvest_amount").val();
	var lumpsum_val = $("#lumpsum_innvest_amount").val();
	
	
	
	var monthly_min = $("#monthly_innvest_amount").attr('data-min');
	var monthly_max = $("#monthly_innvest_amount").attr('data-max');
	
	var lumpsum_min = $("#lumpsum_innvest_amount").attr('data-min');
	var lumpsum_max = $("#lumpsum_innvest_amount").attr('data-max');
	
	var currency_name = '';

	$("#frmpaymentoption").validate({
		rules: {
			choose_payment_option_monthly: {required: function(element) {
					return (!$(".lisa_lumpsum_payment").is(":checked") &&  !$(".lisa_transfer_payment").is(":checked"));
				}
			},
			choose_payment_option_lumpsum: {required: function(element) {
					return (!$(".lisa_monthly_payment").is(":checked") &&  !$(".lisa_transfer_payment").is(":checked"));
				}
			},
			choose_payment_option_transfer: {required: function(element) {
					return (!$(".lisa_monthly_payment").is(":checked") &&  !$(".lisa_lumpsum_payment").is(":checked"));
				}
			},	
			monthly_innvest_amount: { required: true, pattern: /^[0-9,]*([.][0]{2}|)$/, min:monthly_min, max:monthly_max},
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true,  },
			lumpsum_innvest_amount: { required: true, pattern: /^[0-9,]*([.][0]{2}|)$/, min:lumpsum_min, max:lumpsum_max},
			//ISA_transfer_option: {required: true},
			//full_transfer_amount: { required: true, min:500},
		},
		 messages: {
			choose_payment_option_monthly: "Please tick if you want to set up a monthly payment by Direct Debit",
			choose_payment_option_lumpsum: "Please tick if you want to make a lump sum payment by debit card",
			choose_payment_option_transfer: "Please tick if you want to make a transfer in from another ISA provider",
			monthly_innvest_amount: 'Please enter a monthly contribution from \u00A3'+ parseInt(monthly_min).toLocaleString() + ' up to \u00A3'+ parseInt(monthly_max).toLocaleString() + " in whole pounds",
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
			lumpsum_innvest_amount: "Please enter a lump sum amount from \u00A3" + parseInt(lumpsum_min).toLocaleString()  +" up to \u00A3" + parseInt(lumpsum_max).toLocaleString() + " in whole pounds",
			//ISA_transfer_option: "Please tick this box to transfer an existing ISA to a Foresters LISA",
			//full_transfer_amount: "Please enter transfer amount",
		},highlight: function (element, errorClass, validClass) {
        $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).parents('.form-control').removeClass('has-error').addClass('has-success');
		},
		errorPlacement: function (error, element) {
			if(element.hasClass('select2') && element.next('.select2-container').length) {
				error.insertAfter(element.next('.select2-container'));
			} else if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}
			else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
				error.insertAfter(element.parent().parent());
			}
			else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
				error.appendTo(element.parent().parent());
			}
			else {
				error.insertAfter(element);
			}
		},		
		submitHandler: function (form) {
			blockUI($("#frmyourdetails"));
			$.ajax({
				url: base_url + 'lisa/lisa_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmyourdetails"));
					} else {
						
						$("#pgbar").html(response.data.progressbar);
						
						//if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
							
						//if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
							
							
							if(response.data.type == true){
							$(".summary_heading_lbl").html("Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your top-up.");
							$(".application_to_topup").text("top-up");
							$(".application_to_form").text("form");
							$(".application_to_none").text(" top-up ");
						}else{
							$(".summary_heading_lbl").html("Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your application.");
							$(".application_to_topup").text("application");
							$(".application_to_form").text("application");
							$(".application_to_none").text("");
						}
							
							
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmyourdetails"));
							$('html, body').animate({
								scrollTop: $("body").offset().top
							}, 2000);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmyourdetails"));
				}
			});
		}
	});
	



});

$("body").on("click", ".lisa_pay_option", function(){
	var paymnt_option = $(this).is(":checked") && $(".lisa_pay_option:checked").length;
	if(paymnt_option > 1 && paymnt_option < 3){										
		check_payment_limit();
	}
	$("div[id^='tooltip']").hide();
})

$("#lisa_index").on("click", ".summary_edit", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	$.ajax({
		url : base_url + 'lisa/edit_summary/',
		type: 'POST',
		dataType: 'json',
		data: {step: steps},
		success: function (response) {
			if (!response.status) {
				salert('error', 'Error', response.msg);
			}else{
					$("#pgbar").html(response.data.progressbar);
					$("#summary_section").addClass('hide');
					$("#" + type).removeClass('hide');
					
					$('html, body').animate({
						scrollTop: $("#" + type).offset().top
					}, 2000);
				
			}
		}
	});
	$("div[id^='tooltip']").hide();
});

$("#lisa_index").on("click", "#next5", function(){
	$("#frmsummary").validate({
		rules: {
			summary_accept_terms: { required: true},
		},
		 messages: {
			summary_accept_terms: "Please read and tick before submitting your application.",
		},highlight: function (element, errorClass, validClass) {
        $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).parents('.form-control').removeClass('has-error').addClass('has-success');
		},
		errorPlacement: function (error, element) {
			if(element.hasClass('select2') && element.next('.select2-container').length) {
				error.insertAfter(element.next('.select2-container'));
			} else if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}
			else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
				error.insertAfter(element.parent().parent());
			}
			else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
				error.appendTo(element.parent().parent());
			}
			else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form) {
			$.ajax({
				url : base_url + 'lisa/submit_application/',
				type: 'POST',
				dataType: 'json',
				data: {step: 4},
				success: function (response) {
					if (!response.status) {
						salert('error', response.msg, '', response.loc);
					}else{
						if(response.payment){
							sconfirm("Re-directing to payment page","You will be redirected to WorldPay Online payment gateway.", "worldpay_redirect()", "","","success");
							
						}else{
							$("#pgbar").html(response.data.progressbar);
							$("#summary_section").addClass("hide");
							$("#customer_ref_number").text(response.data.customer_app_id);
							$("#confirmation_section").removeClass("hide");
						}
					}
				}
			});
		}
	});	
});

$.validator.addMethod('ValidDoB', function (value, element, params) {

            var dob = $('input[name="' + params[0] + '"]').val();

            if (dob === "0001-01-01")
                return false;

            if (!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(dob)) {
                return false;
            }

            var split = dob.replace(/\//g, "-").split("-");
            var year = parseInt(split[0]);
            var month = parseInt(split[1]) - 1;
            var day = parseInt(split[2]);

            if (!moment([year, month, day]).isValid())
                return false;

            var eldest = params[1];

            var age = calculateAge(dob);

            if (isNaN(age)) {
                return false;
            }
            return true;

        });



$("body").on("click", ".add_address_manually", function(){
	$(".extra_add").slideToggle(300);
	$(".extra_add").find('input').val('');
	//var manual_address_field = $(".extra_add").find("input").length;
	$("div[id^='tooltip']").hide();
});

$("body").on("click", "#new_address .afd-typeahead-result li.afd-typeahead-item", function(){
	$(".extra_add").show();			
});

$("body").on("change", ".afd-form-control .postcode_lookup_address_list", function(){
	$(".extra_add").show();			
});

$("body").on("click", "input[name='old_address_change']", function(){
	var old_address_tooltip_id = $(this).attr("aria-describedby");
																   
	if($(this).val() == 1){
		$(".old_address").show();
		//$("#postcode_additional").addClass("required");
	}else{
		$(".old_address").hide();
		//$("div[id^='tooltip']").hide();
		//$("#postcode_additional").removeClass("required");
	}
	$("div[id^='tooltip']").hide();
	$("#" + old_address_tooltip_id).hide();
	
});

$("body").on("click", ".add_old_address_manually", function(){
	$(".add_old_add_manually").slideToggle(300);	
	$(".add_old_add_manually").find('input').val('');
	$("div[id^='tooltip']").hide();
});

$("body").on("click", "#old_address .afd-typeahead-result li.afd-typeahead-item", function(){
	$(".add_old_add_manually").show();											
});

$("body").on("change", ".HeardAboutUs", function(){
 	var current_val = $(this).val();
	var hear_tool_id = $(this).attr("aria-describedby");
	var hear_extra_tool_id = $(".HeardAboutUs_extra").attr("aria-describedby");
 	if(current_val == 'Introducer'){
		$(".HeardAboutUs_extra").show();
		$(".HeardAboutUs_extra").addClass("required");
		$(".HeardAboutUs_extra").attr("Placeholder","Please enter the Introducer number, which should start with INT");
	}else if(current_val == 'Other'){
		$(".HeardAboutUs_extra").show();
		$(".HeardAboutUs_extra").addClass("required");
		$(".HeardAboutUs_extra").attr("Placeholder","Please tell us where");
	}else{
		$(".HeardAboutUs_extra").val('');
		$(".HeardAboutUs_extra").hide();
		$(".HeardAboutUs_extra").next(".error").hide();
		$(".HeardAboutUs_extra").removeClass("required");
	}
 });

$("body").on("click", "#monthly_payment", function(){
	if($(this).is(":checked")){
		$(".monthly_payment_box").slideDown(500);
		
	}else{
		$(".monthly_payment_box").slideUp(500);
	}
});

$("body").on("click", "#lumpsum_payment", function(){
	if($(this).is(":checked")){
		$(".lumpsum_payment_box").slideDown(500);
		
	}else{
			$(".lumpsum_payment_box").slideUp(500);
		}
});

$("body").on("click", "#transfer_payment", function(){
	if($(this).is(":checked")){
		$(".transfer_payment_box").slideDown(500);
		//$(".ISA_transfer_option").addClass("required");
		//$(".ISA_transfer_option").attr("required", true);
	}else{
		$(".transfer_payment_box").slideUp(500);
		//$(".ISA_transfer_option").removeClass("required");
		//$(".ISA_transfer_option").attr("required", false);

	}							   
});

$("body").on("click", ".payment_transfer_option", function(){
		if($(this).val() == 0)	
			$(".transfer_box span.label-text").text("Approximate value");
		else if($(this).val() == 1)	
			$(".transfer_box span.label-text").text("Amount to transfer");	
});
	
});

function check_payment_limit()
{
		salert("warning", "Fund Limit", "As you have chosen more than one payment option, please make sure the overall amount does not exceed the annual ISA limit. This includes transfers, and for the LISA applies even if the funds being transferred were invested in a previous tax year.<br>Click 'OK' to close this message and continue your application.");
		return false;

}

function worldpay_redirect()
{
	location.href = base_url + "lisa/submit_worldPay";
}
/*
afdOptions = {
  pceUrl: typeof pceUrl === 'undefined' ? 'https://apps.afd.co.uk/json' : pceUrl,
		id: "1757",
		token: "+aE2pGiR7oRpArZdgmqlz7EOHhxBWitByjEHO+d9Rzg=ht",
        nativeValidationMessages: false,       
		typeahead: {
            maxItems: 5,
            pushUp: false,
            afterHideTypeahead: false,
            searchAgain: true,
            afterClearTypeahead:  true,
            beforeHideResults: false,
            manualInputButton: false,
            fewResultsManualInput: true,
            fewResultsManualInputText: 'Can\'t see your address? Enter it manually',
            hideEmpties: false,
            minLength: 2,
            matchPositions: false,
            postcodeFirst: true,
            parentClass: 'afd-input-group',
            enableReverseGeocode: false,
			containers: ['#new_address','#old_address']
        },
        lookup: {
            prefetch: true,
            pushUp:false,
            parentClass: 'afd-input-group',
            hideEmpties: false,
            beforeHideResults: false,
            afterRetrieveHideResultsList: true,
            manualInputButton: false,
            postcodeFirst: true
        }
};*/

