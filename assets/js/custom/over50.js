$(document).ready(function(){
'use strict';

$('select').each(function () {
	$(this).select2({
	  theme: 'bootstrap4',
	  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
	  placeholder: $(this).attr('placeholder'),
	  allowClear: Boolean($(this).data('allow-clear')),
	});
  });

$('#frmupdate_beneficiarydetails').on('blur, change','.required',function() {
	  var empty_flds = 0;
	  $("#frmupdate_beneficiarydetails .required").each(function() {
		if(!$.trim($(this).val())) {
			empty_flds++;
		}    
	  });
});

$("#beneficiary_profile_section").on("keypress keyup", ".ni-segment", function(){
	niValidation();
});

$("body").on("keyup", ".ni-segment", function(){
	var maxlength = $(this).attr("maxlength");
	if($(this).val().length >= maxlength){
		$(this).next('input').focus();
	}
});


$('body').on("change", "select",function(){
	var tool_id = $(this).attr("aria-describedby");
    if ($(this).val()!="")
    {
		$("#" + tool_id).hide();
    }
});

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

$("#over50_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/over50/back_step/',
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
				if(steps == 1)
					$("#personal_profile_section").removeClass("hide");
				else	
					curObj.parents("section").prev("section").removeClass("hide");	
				
				$('select').each(function () {
					$(this).select2({
					  theme: 'bootstrap4',
					  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
					  placeholder: $(this).attr('placeholder'),
					  allowClear: Boolean($(this).data('allow-clear')),
					});
				  });
			}
		}
	});
});

$("body #frmyourdetails").on("change", ".dob_day, .dob_month, .dob_year", function(){
	var day = $("#frmyourdetails .dob_day").val();
	var month = $("#frmyourdetails .dob_month").val();
	var year = $("#frmyourdetails .dob_year").val();
	var year_tooltip_id = $("#frmyourdetails .dob_year").attr("aria-describedby");
	var cur_selection = $(this);
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'over50/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year},
			success: function (response) {
				if (!response.status) {
					$(".dob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}
			}
		});
		$("#" + year_tooltip_id).hide();
	}
});

$("body").on("change", ".bdob_day, .bdob_month, .bdob_year", function(){
																							
	var add_day = $(".bdob_day").val();
	var add_month = $(".bdob_month").val();
	var add_year = $(".bdob_year").val();
	
	var edit_day = $("#frmupdbeneficiarydetails .bdob_day").val();
	var edit_month = $("#frmupdbeneficiarydetails .bdob_month").val();
	var edit_year = $("#frmupdbeneficiarydetails .bdob_year").val();
	
	if(edit_day === undefined){ var day = add_day;}else{ var day = edit_day;}
	if(edit_month === undefined){ var month = add_month;}else{ var month = edit_month;}
	if(edit_year === undefined){ var year = add_year;}else{ var year = edit_year;}
	
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'over50/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year, beneficiary:true},
			success: function (response) {
				if (!response.status) {
					$(".beneficiary_nin").addClass("hide");
					$(".bdob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
					if(response.beneficiary_valid)
					{
						$(".beneficiary_below_nin").removeClass("hide");	
						$(".beneficiary_below_nin").find("#NI5").attr("required", true);
					}else{
						$(".beneficiary_below_nin").addClass("hide");
						$(".beneficiary_below_nin").find("#NI5").attr("required", false);
						//$("#beneficiary_profile_section").detach();
						//salert('warning', "Age Warning", response.data, '');
					}
				}
			}
		});
	}
});



$("body #frmupdate_yourdetails").on("change", ".dob_day, .dob_month, .dob_year", function(){
	var day = $("#frmupdate_yourdetails .dob_day").val();
	var month = $("#frmupdate_yourdetails .dob_month").val();
	var year = $("#frmupdate_yourdetails .dob_year").val();
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'over50/check_beneficiary_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year},
			success: function (response) {
				if (!response.status) {
					salert('error', response.msg, '');
				}else{
					//salert('warning', "Age Warning", response.data, '');
				}
			}
		});
	}
});

$("body").on('click', '#next2', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	var HeardAboutUs = $("#HeardAboutUs").val();
	var max_dob = $(".dob_year").attr('data-max');

	$("#frmyourdetails").validate({
		rules: {
			title: { required: true },
			other_title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			dob_year: { checkdateofbirth: ['dob_day', 'dob_month', 'dob_year'], check_min_date_of_birth:
				function(element) {
					return [$(".dob_day").val(), $(".dob_month").val(), $(".dob_year").val(), 50, 80, "Over50 Life Cover"];
				}
			},
			phone: { required: true},
			gender: { required: true},
			email: { required: true },
			cemail: { required: true, equalTo: '#email' },
			nominate_benificiary:{ required: true},
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
							check_min_date_of_birth: "You must be 50-80 to apply for Over 50s Life Cover"
						  },
				phone: "Please enter your phone number (eg: 01234 567890)",
				gender: "Please select your gender",
				email: "Please enter a valid email address",
				cemail: "Please check your email address matches",
				nominate_benificiary: "Please select if you wish to nominate a beneficiary",
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
				//HeardAboutUs_extra: heard_about_msg,
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
				url: base_url + 'over50/over50_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmyourdetails"));
					} else {
						//load_modal(obj);
						//salert("Success", response.msg, '', 'current', 'success');
						$("#pgbar").html(response.data.progressbar);
						
						$(".view_payment_option_section").html(response.data.view_payment_opt);
						
						$(".view_beneficiary_option_section").html(response.data.view_beneficiary_opt);

						if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
							
						if(response.data.view_summary_premium_details)
							$(".summary_premium_details").html(response.data.premium_details_view);	
							
						//if(response.data.personal_details.nominate_benificiary == 1)
							$(".summary_beneficiary_details").html(response.data.beneficiary_details_view);	
							
						if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
							
						//if(response.data.valid_dob)
							//$(".summary_personal_section").html(response.data.personal_details_view);	
								
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						
						/*if(response.data.personal_details.nominate_benificiary == 0){
							$("#beneficiary_premium_section").removeClass("hide");
							$("#beneficiary_premium_section").find(".backbtn").attr("data-step",1);
							$(".summary_beneficiary_box").addClass("hide");
							$(".edit_beneficiary_section").addClass("hide");
							$(".summary_beneficiary_details").addClass("hide");
							
						}else{
							curObj.parents("section").next("section").removeClass("hide");
							$("#beneficiary_premium_section").find(".backbtn").attr("data-step",2);
							$(".summary_beneficiary_box").removeClass("hide");
							$(".edit_beneficiary_section").removeClass("hide");
							$(".summary_beneficiary_details").removeClass("hide");
						}*/
						
						$('[data-afd-control="typeahead"]').afd('typeahead');
						
						$('select').each(function () {
							$(this).select2({
							  theme: 'bootstrap4',
							  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
							  placeholder: $(this).attr('placeholder'),
							  allowClear: Boolean($(this).data('allow-clear')),
							});
						  });
						
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
	
	if($("#postcode_box").val() == ""){
		$("#postcode").val('');
		$("#postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your address"
				},
				
		});
	}
	
	if($("#additional_postcode_box").val() == ""){
		$("#postcode_additional").val('');
		$("#additional_postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your postcode"
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
		//var heard_about_msg = "Please enter the Introducer number, which should start with INT";	
		$("#HeardAboutUs_extra").rules("add", { 
		  required:true,
		  check_heard_aboutus_introducer:true,
		  messages: {
					required: "Please enter the Introducer number, which should start with INT"
				},
				
		});
	}

});

$("#beneficiary_profile_section").on("click", ".nominate_benificiary", function(){
	if($(this).is(":checked") && $(this).val() == 1)	
		$(".beneficiary_details_area").removeClass("hide");
	else
		$(".beneficiary_details_area").addClass("hide");
});

$("#beneficiary_profile_section").on('click', '#next_beneficiary_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmupdate_beneficiarydetails").validate({
		rules: {
			beneficiary_title: { required: true },
			beneficiary_other_title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			bdob_year: { checkBeneficiarydateofbirth: ['bdob_day', 'bdob_month', 'bdob_year']},
			postcode: {required: function(element){ return $("#beneficiary_profile_section #postcode_box").val()==""; }},
			beneficiary_amount: {required: true, pattern: /^[0-9,]*([.][0]{2}|)$/, min:1, max:5000},
		},
		 messages: {
                beneficiary_title: "Please select beneficiary's title",
				beneficiary_other_title: "Please enter beneficiary's title",
                first_name: "Please enter beneficiary's first name(s)",
                last_name: "Please enter beneficiary's last name",
				bdob_year: "Please select beneficiary's date of birth",
				postcode: "Please enter your postcode",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter your postcode",
				beneficiary_amount: "Please enter an amount in whole pounds (maximum \u00A35,000) that you would like the beneficiary to receive",
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
			blockUI($("#frmupdate_beneficiarydetails"));
			$.ajax({
				url: base_url + 'over50/over50_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_beneficiarydetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						
						$(".summary_beneficiary_details").html(response.data.beneficiary_details_view);	
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmupdate_beneficiarydetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmupdate_beneficiarydetails"));
				}
			});
		}
	});
	
	if($("#beneficiary_profile_section #postcode_box").val() == ""){
		$("#beneficiary_profile_section #postcode").val('');
		$("#beneficiary_profile_section #postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your address"
				},
				
		});
	}
});


$("#beneficiary_premium_section").on('click', '#next_premium_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmpremiumdetails").validate({
		rules: {
			pay_premium: { required: true },
		},
		 messages: {
                pay_premium: "Please select monthly premium",
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
			blockUI($("#frmpremiumdetails"));
			$.ajax({
				url: base_url + 'over50/over50_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmpremiumdetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						
						$(".summary_premium_details").html(response.data.premium_details_view);	
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmpremiumdetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmpremiumdetails"));
				}
			});
		}
	});
	
});

$("body").on('click', '#next3', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	


$("#frmpaymentoption").validate({
		rules: {
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true},
			third_party_title: { required: true },
			third_party_other_title: { required: true },
			third_party_first_name: { required: true },
			third_party_last_name: { required: true },
			third_party_phone: { required: true},
		},
		 messages: {
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
			third_party_title: "Please select payer's title",
			third_party_other_title: "Please enter payer's title",
			third_party_first_name: "Please enter payer's first name",
			third_party_last_name: "Please enter payer's last name",
			third_party_phone: "Please enter payer's phone number (eg: 01234 567890)",
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
			blockUI($("#frmpaymentoption"));
			$.ajax({
				url: base_url + 'over50/over50_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmpaymentoption"));
					} else {
						
						$("#pgbar").html(response.data.progressbar);
						
							$(".summary_personal_section").html(response.data.personal_details_view);
							
							$(".summary_payment_options").html(response.data.payment_options_view);
							
							
							
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmpaymentoption"));
						$('html, body').animate({
							scrollTop: $("body").offset().top
						}, 2000);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmpaymentoption"));
				}
			});
		}
	});
	
});


$("body").on("click", ".same_address_beneficiary", function(){
	if($(this).is(":checked")){										
		$("#beneficiary_profile_section .same_as_prev_address").removeClass("hide");
		$("#beneficiary_profile_section .show_postcode").find("input").val('');
		$("#beneficiary_profile_section .show_postcode, #beneficiary_profile_section .extra_add").hide();
	}else
	{
		$("#beneficiary_profile_section .same_as_prev_address").addClass("hide");
		$("#beneficiary_profile_section .show_postcode").show();
	}
})

$("#over50_index").on("click", ".summary_edit", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	$.ajax({
		url : base_url + 'over50/edit_summary/',
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
						scrollTop: $("body").offset().top
					}, 2000);
				
			}
		}
	});
});


$("#over50_index").on("click", "#next5", function(){
	$("#frmsummary").validate({
		rules: {
			summary_accept_terms: { required: true},
		},
		 messages: {
			summary_accept_terms: "Please read and tick before submitting your application.",
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
			$.ajax({
				url : base_url + 'over50/submit_application/',
				type: 'POST',
				dataType: 'json',
				data: {step: 5},
				success: function (response) {
					if (!response.status) {
						salert('error', response.msg, '', response.loc);
					}else{
						if(response.payment){
							sconfirm("Re-directing to payment page","You will be redirected to WorldPay Online payment gateway.", "worldpay_redirect()", "","","success");
							
						}else{
							$("#pgbar").html(response.data.progressbar);
							$("#summary_section").addClass("hide");
							$("#confirmation_section").removeClass("hide");
							$("#confirmation_section #customer_ref_number").text(response.data.customer_app_id);
							
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

$("#personal_profile_section").on("click", ".add_address_manually", function(){
	$("#personal_profile_section .extra_add").slideToggle(300);
	$("#personal_profile_section .extra_add").find('input').val('');
});

$("#beneficiary_profile_section").on("click", ".add_address_manually", function(){
	$("#beneficiary_profile_section .extra_add").slideToggle(300);
	$("#beneficiary_profile_section .extra_add").find('input').val('');
});

$("body").on("click", "#new_address .afd-typeahead-result li.afd-typeahead-item", function(){
	$(".extra_add").show();			
});

$("#beneficiary_profile_section").on("click", ".afd-typeahead-result li.afd-typeahead-item", function(){
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

	
});

function worldpay_redirect()
{
	location.href = base_url + "over50/submit_worldPay";
}




