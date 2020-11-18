$(document).ready(function(){
'use strict';
$("#nisa_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/nisa/back_step/',
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
});

$("#nisa_index").on("change", ".dob_day, .dob_month, .dob_year", function(){
	var day = $(".dob_day").val();
	var month = $(".dob_month").val();
	var year = $(".dob_year").val();
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + '/nisa/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year},
			success: function (response) {
				if (!response.status) {
					salert('error', response.msg, '');
				}else{
					salert('warning', "Age Warning", response.data, '');
				}
			}
		});
	}
});

$("body").on('click', '#next2', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmyourdetails").validate({
		rules: {
			title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			phone: { required: true,  },
			email: { required: true },
			cemail: { required: true },
			NI5: { required: true },
		},
		 messages: {
                title: "Please select your title",
                first_name: "Please enter your first name(s)",
                last_name: "Please enter your last name",
				dob_year: "Please select your date of birth",
				phone: "Please enter your phone number",
				email: "Please enter your email ID",
				cemail: "Confirm email ID shuold be same as email ID",
				NI5: "Please enter your National Insurance number",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter your postcode",
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
				url: base_url + 'nisa/nisa_form_submit/' + d_step,
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
						
						if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
							
						if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
								
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


$("body").on('click', '#next3', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmpaymentoption").validate({
		rules: {
			monthly_innvest_amount: { required: true, min:50},
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true,  },
			lumpsum_innvest_amount: { required: true, min:500, max:20000},
			full_transfer_amount: { required: true, min:500},
		},
		 messages: {
			monthly_innvest_amount: "Please enter investment amount from £50 up to £333",
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
			lumpsum_innvest_amount: "Please enter lumpsum investment amount",
			full_transfer_amount: "Please enter transfer amount",
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
				url: base_url + 'nisa/nisa_form_submit/' + d_step,
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

$("#nisa_index").on("click", ".edit_summary", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/nisa/edit_summary/',
		type: 'POST',
		dataType: 'json',
		data: {step: steps, page: type},
		success: function (response) {
			if (!response.status) {
				salert('error', response.msg, '', response.loc);
			}else{
				$(".edit_personal_section").html(response.data);
				$(".edit_personal_section").removeClass("hide");
				$(".summary_personal_section").addClass("hide");
			}
		}
	});
});

$("body").on('click', '#update_your_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmupdate_yourdetails").validate({
		rules: {
			title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			phone: { required: true,  },
			email: { required: true },
			cemail: { required: true },
			NI5: { required: true },
		},
		 messages: {
                title: "Please select your title",
                first_name: "Please enter your first name(s)",
                last_name: "Please enter your last name",
				dob_year: "Please select your date of birth",
				phone: "Please enter your phone number",
				email: "Please enter your email ID",
				cemail: "Confirm email ID shuold be same as email ID",
				NI5: "Please enter your National Insurance number",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter your postcode",
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
			blockUI($("#frmupdate_yourdetails"));
			$.ajax({
				url: base_url + 'nisa/update_your_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_yourdetails"));
					} else {
						$(".summary_personal_section").html(response.data.personal_details_view);
						$(".summary_personal_section").removeClass("hide");
						$(".edit_personal_section").addClass("hide");
						unblockUI($("#frmupdate_yourdetails"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmupdate_yourdetails"));
				}
			});
		}
	});

});


$("#nisa_index").on("click", ".edit_payment", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	var curObj = $(this);
	$.ajax({
		url : base_url + 'nisa/edit_payment/',
		type: 'POST',
		dataType: 'json',
		data: {step: steps, page: type},
		success: function (response) {
			if (!response.status) {
				salert('error', response.msg, '', response.loc);
			}else{
				$(".edit_payment_options").html(response.data);
				$(".edit_payment_options").removeClass("hide");
				$(".summary_payment_options").addClass("hide");;
			}
		}
	});
});

$("body").on('click', '#update_payment_options', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmupdate_paymentoption").validate({
		rules: {
			monthly_innvest_amount: { required: true, min:50, max:333},
			monthly_account_holder_name: { required: true },
			monthly_account_number: { required: true },
			monthly_account_sort_code: { required: true,  },
			lumpsum_innvest_amount: { required: true, min:500, max:4000},
			full_transfer_amount: { required: true, min:500},
		},
		 messages: {
			monthly_innvest_amount: "Please enter investment amount from &pound;50 up to &pound;333",
			monthly_account_holder_name: "Please enter Account holder name",
			monthly_account_number: "Please enter Account number",
			monthly_account_sort_code: "Please enter Account sort code",
			lumpsum_innvest_amount: "Please enter lumpsum investment amount from &pound;500 up to &pound;4000",
			full_transfer_amount: "Please enter transfer amount minimum &pound;500",
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
				url: base_url + 'nisa/update_your_details/',
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

$("#nisa_index").on("click", "#next5", function(){
	$("#frmsummary").validate({
		submitHandler: function (form) {
			$.ajax({
				url : base_url + 'nisa/submit_application/',
				type: 'POST',
				dataType: 'json',
				data: {step: 4},
				success: function (response) {
					if (!response.status) {
						salert('error', response.msg, '', response.loc);
					}else{
						$("#pgbar").html(response.data.progressbar);
						$("#summary_section").addClass("hide");
						$("#customer_ref_number").text(response.data.customer_app_id);
						$("#confirmation_section").removeClass("hide");
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
})

$("body").on("click", "input[name='old_address_change']", function(){
	if($(this).val() == 1){
		$(".old_address").show();
		$("#postcode_additional").addClass("required");
	}else{
		$(".old_address").hide();
		$("#postcode_additional").removeClass("required");
	}
})

$("body").on("click", ".add_old_address_manually", function(){
	$(".add_old_add_manually").slideToggle(300);											
})

$("body").on("change", ".HeardAboutUs", function(){
 	var current_val = $(this).val();
 	if(current_val == 'Introducer'){
		$(".HeardAboutUs_extra").show();
		$(".HeardAboutUs_extra").attr("Placeholder","Please enter the Introducer number, which should start with INT");
	}else if(current_val == 'Other'){
		$(".HeardAboutUs_extra").show();
		$(".HeardAboutUs_extra").attr("Placeholder","Please enter Other name");
	}else{
		$(".HeardAboutUs_extra").val('');
		$(".HeardAboutUs_extra").hide();
		$(".HeardAboutUs_extra").next(".error").hide();
	}
 });

$("body").on("click", "#monthly_payment", function(){
	if($(this).is(":checked")){
		$(".monthly_payment_box").slideDown(500);
		$(this).next(".badge").text("-");
		$('html, body').animate({
			scrollTop: $("#monthly_payment").offset().top
		}, 2000);
	}else{
		$(".monthly_payment_box").slideUp(500);
		$(this).next(".badge").text("+");
	}								   
});

$("body").on("click", "#lumpsum_payment", function(){
	if($(this).is(":checked")){
		$(".lumpsum_payment_box").slideDown(500);
		$(this).next(".badge").text("-");
		$('html, body').animate({
			scrollTop: $("#lumpsum_payment").offset().top
		}, 2000);
	}else{
			$(".lumpsum_payment_box").slideUp(500);
			$(this).next(".badge").text("+");
		}
});

$("body").on("click", "#transfer_payment", function(){
	if($(this).is(":checked")){
		$(".transfer_payment_box").slideDown(500);
		$(this).next(".badge").text("-");
		$('html, body').animate({
			scrollTop: $("#transfer_payment").offset().top
		}, 2000);
	}else{
		$(".transfer_payment_box").slideUp(500);
		$(this).next(".badge").text("+");
	}							   
});
$("body").on("click", ".payment_transfer_option", function(){
		if($(this).val() == 0)	
			$(".transfer_box span.label-text").text("Approximate value");
		else if($(this).val() == 1)	
			$(".transfer_box span.label-text").text("Amount to transfer");	
})
	
});


