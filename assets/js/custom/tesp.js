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

$('select').change(function(){
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

/*$('body').on("click", '.tesp_pay_option', function(){
	if($("input.tesp_pay_option:checked").length > 0)
		$("#next3").prop("disabled", false);
	else
		$("#next3").prop("disabled", true);
});*/

$('#frmpaymentoption').on('blur','.required',function() {
	  var empty_flds = 0;
	  $("#frmpaymentoption .required").each(function() {
		if(!$.trim($(this).val())) {
			empty_flds++;
		}    
	  });
	  if (empty_flds) {
		$('#next3').prop("disabled", true);	
	  } else {
		$('#next3').prop("disabled", false);	
	  }
});



$('body').on('keypress', '.toptup_policy_number', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9/]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

$("#tesp_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/tesp/back_step/',
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
			}
		}
	});
	$("div[id^='tooltip']").hide();
});

$("body #frmyourdetails").on("change", ".dob_day, .dob_month, .dob_year", function(){
	var day = $("#frmyourdetails .dob_day").val();
	var month = $("#frmyourdetails .dob_month").val();
	var year = $("#frmyourdetails .dob_year").val();
	
	var year_tooltip_id = $("#frmyourdetails .dob_year").attr("aria-describedby");
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'tesp/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year},
			success: function (response) {
				if (!response.status) {
					$(".dob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
					//salert('warning', "Age Warning", response.data, '');
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

	$("#frmyourdetails").validate({
		rules: {
			title: { required: true },
			other_title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			dob_year: { checkdateofbirth: ['dob_day', 'dob_month', 'dob_year'], check_min_date_of_birth:
				function(element) {
					return [$(".dob_day").val(), $(".dob_month").val(), $(".dob_year").val(), 16, 80, "Tax Exempt Savings Plan"];
				}},
			phone: { required: true},
			email: { required: true },
			cemail: { required: true, equalTo: '#email' },
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
							check_min_date_of_birth: "You must be 16-80 to apply for the Tax Exempt Savings Plan",
						  },
				phone: "Please enter your phone number (eg: 01234 567890)",
				email: "Please enter a valid email address",
				cemail: "Please check your email address matches",
				NI5: "Please enter National Insurance number",
				postcode: "Please enter your postcode",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter your postcode",
				old_address_change: "Please tell us if you have changed address in the last 3 months",
				postcode_additional: "Please enter your postcode",
				additional_address1: "Please enter your address",
				additional_town_city: "Please enter your town",
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
				url: base_url + 'tesp/tesp_form_submit/' + d_step,
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
						
						//if(response.data.view_payment_option)
							$(".view_payment_option_section").html(response.data.view_payment_opt);
						
						if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
						
						if(response.data.view_summary_plan_details)
							$(".summary_plan_section").html(response.data.plan_details_view);
							
						if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
							
						if(response.data.valid_dob)
							$(".summary_personal_section").html(response.data.personal_details_view);	
								
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
	
	if($("#additional_postcode_box").val() == ""){
		$("#postcode_additional").val('');
		$("#additional_postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your postcode"
				},
				
		});
	}
	
	if(HeardAboutUs == "Other"){
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

var terms_years_selected = false;
$("body").on("change", "#frmplandetails .terms_in_years, #frmplandetails .specific_matuarity_month, #frmplandetails .specific_matuarity_day, #frmplandetails .specific_matuarity_year", function(){
	
	var terms_in_years = $("#frmplandetails .terms_in_years").val();
	
	var specific_matuarity_day = $("#frmplandetails .specific_matuarity_day").val();
	var specific_matuarity_month = $("#frmplandetails .specific_matuarity_month").val();
	var specific_matuarity_year = $("#frmplandetails .specific_matuarity_year").val();
	
	var error_msg = "Please select a Term in years OR a specific maturity date";
	
	if(terms_in_years!=false){ terms_years_selected = true;}else{ terms_years_selected = false;}
	
	if(specific_matuarity_day!=false || specific_matuarity_month!=false || specific_matuarity_year!=false)
	{
		if(terms_years_selected == true){
			if(!$(this).parent().hasClass("error")){
				$( "<label class='error'>" + error_msg + "</label>" ).appendTo($(this).parent().last('.select2-container'));
				//$(this).parent().find('.error').show();
			}
			$(this).val(' ');
			init_select_box();
		}
			
	}
	
	/*if(terms_in_years!=false && (specific_matuarity_day!=false || specific_matuarity_month!=false || specific_matuarity_year!=false))
	{
		salert('warning', "Maturity Date Warning", "You can only select either Terms in year OR Specific maturity date.", '');	
		return false;
	}*/
	
	if(specific_matuarity_day!=false || specific_matuarity_month!=false || specific_matuarity_year!=false)
	{
		$.ajax({
			url : base_url + 'tesp/check_maturity_date/',
			type: 'POST',
			dataType: 'json',
			data: {days: specific_matuarity_day, months: specific_matuarity_month, years: specific_matuarity_year},
			success: function (response) {
				if (!response.status) {
					$("#frmplandetails .specific_matuarity_day").val(' ');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
					//salert('warning', "TEST", response.data, '');
				}
			}
		});
	}
	
});

$("body").on('click', '#next_plan_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	var terms_in_years = $("#frmplandetails .terms_in_years").val();
	var specific_matuarity_day = $("#frmplandetails .specific_matuarity_day").val();
	var specific_matuarity_month = $("#frmplandetails .specific_matuarity_month").val();
	var specific_matuarity_year = $("#frmplandetails .specific_matuarity_year").val();
	
	/*if(terms_in_years!=false && (specific_matuarity_day!=false || specific_matuarity_month!=false || specific_matuarity_year!=false))
	{
		salert('warning', "Maturity Date Warning", "You can only select either Terms in year OR Specific maturity date.", '');	
		return false;
	}
	*/
	
	$("#frmplandetails").validate({
		ignore: "",						  
		rules: {
			terms_in_years: {checkMaturityTermYear:['terms_in_years','specific_matuarity_day','specific_matuarity_month','specific_matuarity_year']},              
            specific_matuarity_year: {checkMaturityTermYear:['terms_in_years','specific_matuarity_day','specific_matuarity_month','specific_matuarity_year'], 
			check_min_maturity_terms:
				function(element) {
					return [$("#frmplandetails .terms_in_years").val(), $("#frmplandetails .specific_matuarity_day").val(), $("#frmplandetails .specific_matuarity_month").val(), $("#frmplandetails .specific_matuarity_year").val(), 10, 25, "Specific maturity date"];
				}
			}
		},
		 messages: {
			 terms_in_years : "Please select a Term in years OR a specific maturity date",
			 specific_matuarity_year : {
							required: "Please select a Term in years OR a specific maturity date",
							check_min_maturity_terms: "Please select a specific maturity date between 10 years to 25 years"
						  }
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
			blockUI($("#frmplandetails"));
			$.ajax({
				url: base_url + 'tesp/tesp_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmplandetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmplandetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmplandetails"));
				}
			});
		}
	});
});




$("body").on('click', '#next3', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	var monthly_val = $("#monthly_innvest_amount").val();
	
	var monthly_min = $("#monthly_innvest_amount").attr('data-min');
	var monthly_max = $("#monthly_innvest_amount").attr('data-max');

	$("#frmpaymentoption").validate({
		rules: {
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true,  },
		},
		 messages: {
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
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
				url: base_url + 'tesp/tesp_form_submit/' + d_step,
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
							
							$(".summary_plan_section").html(response.data.plan_details_view);
							
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
	



});

$("body").on("click", ".tesp_pay_option", function(){
	if($(this).is(":checked") && $(".tesp_pay_option:checked").length > 1){										
		check_payment_limit();
	}
	$("div[id^='tooltip']").hide();
})

$("#tesp_index").on("click", ".summary_edit", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	$.ajax({
		url : base_url + 'tesp/edit_summary/',
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

$("body").on('click', '#update_payment_options', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmupdate_paymentoption").validate({
		rules: {
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true,  },
		},
		 messages: {
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
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
			blockUI($("#frmupdate_paymentoption"));
			$.ajax({
				url: base_url + 'tesp/update_your_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_paymentoption"));
					} else {
						$(".summary_payment_options").html(response.data.payment_options_view);
						$(".summary_payment_options").removeClass("hide");
						$(".edit_payment_options").addClass("hide");
						unblockUI($("#frmupdate_paymentoption"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmupdate_paymentoption"));
				}
			});
		}
	});

});

$("#tesp_index").on("click", ".edit_plan", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	var curObj = $(this);
	$.ajax({
		url : base_url + 'tesp/edit_plan/',
		type: 'POST',
		dataType: 'json',
		data: {step: steps, page: type},
		success: function (response) {
			if (!response.status) {
				salert('error', response.msg, '', response.loc);
			}else{
				$(".edit_plan_section").html(response.data);
				$(".edit_plan_section").removeClass("hide");
				$(".summary_plan_section").addClass("hide");
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

$("body").on('click', '#update_paln_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	blockUI($("#frmupdate_plandetails"));
	$("#frmupdate_plandetails").validate({
		submitHandler: function (form) {
			blockUI($("#frmupdate_plandetails"));
			$.ajax({
				url: base_url + 'tesp/update_your_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_plandetails"));
					} else {
						$(".summary_plan_section").html(response.data.plan_details_view);
						$(".summary_plan_section").removeClass("hide");
						$(".edit_plan_section").addClass("hide");
						unblockUI($("#frmupdate_plandetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmupdate_plandetails"));
				}
			});
		}
	});

});

$("#tesp_index").on("click", "#next5", function(){
	
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
			blockUI($("#summary_section"));
			$.ajax({
				url : base_url + 'tesp/submit_application/',
				type: 'POST',
				dataType: 'json',
				data: {step: 5},
				success: function (response) {
					if (!response.status) {
						salert('error', response.msg, '', response.loc);
						unblockUI($("#summary_section"));
					}else{
							$("#pgbar").html(response.data.progressbar);
							$("#summary_section").addClass("hide");
							$("#customer_ref_number").text(response.data.customer_app_id);
							$("#confirmation_section").removeClass("hide");
							unblockUI($("#summary_section"));
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
	//check_required();
	$("#" + hear_tool_id).hide();
	$("#" + hear_extra_tool_id).hide();
 });
	
});

function check_payment_limit()
{
		salert("warning", "Fund Limit", "As you have chosen more than one payment option, please make sure the overall amount does not exceed the annual ISA limit. <span style='color: #4e84a6'>This includes transfers, and for the JISA applies even if the funds being transferred were invested in a previous tax year.</span><br>Click 'OK' to close this message and continue your application.");
		return false;

}

function worldpay_redirect()
{
	location.href = base_url + "tesp/submit_worldPay";
}


