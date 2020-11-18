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

$('body').on('keypress', 'input[type="text"]', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9@.#,_+=/')( \-\]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
});

$('body').on("change", "select",function(){
	var tool_id = $(this).attr("aria-describedby");
    if ($(this).val()!="")
    {
		$("#" + tool_id).hide();
    }
});

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

$("body").on("click", ".personal_details_relation_to_child", function(){
	if($(this).val() == "Other"){
		$(".personal_details_relation_other").removeClass("hide");
		$(".personal_details_relation_other").attr("required", true);
	}else{
		$(".personal_details_relation_other").addClass("hide");
		$(".personal_details_relation_other").attr("required", false);
	}
});

$("#edit_personal_section").on("click", ".personal_details_relation_to_child", function(){
	if($(this).val() == "Other"){
		$(".personal_details_relation_other").removeClass("hide");
		$(".personal_details_relation_other").attr("required", true);
	}else{
		$(".personal_details_relation_other").addClass("hide");
		$(".personal_details_relation_other").attr("required", false);
	}
})

$('#frmupdate_childdetails').on('blur, change','.required',function() {
	  var empty_flds = 0;
	  $("#frmupdate_childdetails .required").each(function() {
		if(!$.trim($(this).val())) {
			empty_flds++;
		}    
	  });
	  
});


$('body').on('keypress', '.toptup_policy_number', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9/]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

$("#ctesp_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/ctesp/back_step/',
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
			$("div[id^='tooltip']").hide();
		}
		
		
	});
});

$("#frmyourdetails").on("change", ".dob_day, .dob_month, .dob_year", function(){
																							
	var day = $(".dob_day").val();
	var month = $(".dob_month").val();
	var year = $(".dob_year").val();

	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'ctesp/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year, child:true},
			success: function (response) {
				if (!response.status) {
					$(".dob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
				}
			}
		});
	}
});



$("body").on("change", " #frmupdate_childdetails .cdob_day,  #frmupdate_childdetails .cdob_month,  #frmupdate_childdetails .cdob_year", function(){
																							
	var add_day = $(".cdob_day").val();
	var add_month = $(".cdob_month").val();
	var add_year = $(".cdob_year").val();
	
	var edit_day = $("#frmupdchilddetails .cdob_day").val();
	var edit_month = $("#frmupdchilddetails .cdob_month").val();
	var edit_year = $("#frmupdchilddetails .cdob_year").val();
	
	if(edit_day === undefined){ var day = add_day;}else{ var day = edit_day;}
	if(edit_month === undefined){ var month = add_month;}else{ var month = edit_month;}
	if(edit_year === undefined){ var year = add_year;}else{ var year = edit_year;}
	
	if(day !="" && month!="" && year !="")
	{
		$.ajax({
			url : base_url + 'ctesp/check_dob/',
			type: 'POST',
			dataType: 'json',
			data: {days: day, months: month, years: year, child:true},
			success: function (response) {
				if (!response.status) {
					$(".cdob_day").val('');
					init_select_box();
					salert('warning', "Date Warning", response.msg, '');
				}else{
				}
			}
		});
	}
});

$("body").on("change", "#frmupdchilddetails .cdob_day, #frmupdchilddetails .cdob_month, #frmupdchilddetails .cdob_year", function(){
	var day = $("#frmupdchilddetails .cdob_day").val();
	var month = $("#frmupdchilddetails .cdob_month").val();
	var year = $("#frmupdchilddetails .cdob_year").val();
	if(day !="" && month!="" && year !="")
	{
		var age = 15;
		var mydate = new Date();
		mydate.setFullYear(year, month-1, day);
	
		var currdate = new Date();
		currdate.setFullYear(currdate.getFullYear() - age);
		if ((currdate - mydate) >= 0){
			//$("#next_child_details").attr("disabled", true);
			salert('warning', "Age Warning", "Child age should be below 16 years", '');
		}
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
			dob_year: { checkdateofbirth: ['dob_day', 'dob_month', 'dob_year'], check_tesp_date_of_birth:
				function(element) {
					return [$(".dob_day").val(), $(".dob_month").val(), $(".dob_year").val(), 18, 100, "Child Tax Exempt Savings Plan"];
				}},
			phone: { required: true},
			email: { required: true },
			cemail: { required: true, equalTo: '#email' },
			personal_details_relation_to_child: { required: true },
			postcode: {required: function(element){ return $("#postcode_box").val()==""; }},
			old_address_change: {required:true},
			postcode_additional: {required: function(element){ return $("#additional_postcode_box").val()==""; }},
			HeardAboutUs_extra: {required:true},
		},
		 messages: {
                title: "Please select your title",
				other_title: "Please enter your title",
                first_name: "Please enter your first name(s)",
                last_name: "Please enter your last name",
				dob_year: {
							required: "Please select your date of birth",
							check_tesp_date_of_birth: "You must be above 16 to apply for the Child Tax Exempt Savings Plan",
						  },
				phone: "Please enter your phone number (eg: 01234 567890)",
				email: "Please enter a valid email address",
				cemail: "Please check your email address matches",
				personal_details_relation_to_child: "Please tell us the relationship between you and the child",
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
				url: base_url + 'ctesp/ctesp_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmyourdetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						
						$(".view_child_option_section").html(response.data.view_child_opt);
						
						//if(response.data.view_payment_option)
						$(".view_payment_option_section").html(response.data.view_payment_opt);
						
						
						
						if(response.data.view_summary_personal_details)
							$(".summary_personal_section").html(response.data.personal_details_view);
						
						if(response.data.view_summary_child_details)
							$(".summary_child_details").html(response.data.child_details_view);	
						
						if(response.data.view_summary_plan_details)
							$(".summary_plan_section").html(response.data.plan_details_view);
							
						if(response.data.view_summary_payment_options)
							$(".summary_payment_options").html(response.data.payment_options_view);
							
						//if(response.data.valid_dob)
							//$(".summary_personal_section").html(response.data.personal_details_view);	
						
						
						$('select').each(function () {
							$(this).select2({
							  theme: 'bootstrap4',
							  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
							  placeholder: $(this).attr('placeholder'),
							  allowClear: Boolean($(this).data('allow-clear')),
							});
						  });
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						unblockUI($("#frmyourdetails"));
						
						$('[data-afd-control="typeahead"]').afd('typeahead');
						
						$('html, body').animate({
							scrollTop: $("body").offset().top
						}, 1000);

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
					required: "Please enter your postcode"
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
		$("#HeardAboutUs_extra").rules("add", { 
		  required:true,
		  check_heard_aboutus_introducer:true,
		  messages: {
					required: "Please enter the Introducer number, which should start with INT",
					
				},
				
		});
	}
	
});
var child_dob_day = "";
var child_dob_month = "";
var child_dob_year = "";
var term_year = '';
var specific_mat_year = '';
var child_birth_date = new Date();
var parse_child_birth_year = new Date();
var parse_child_birth_date = new Date();
var get_year_diff = 0;
var less_than_child_age = 0;
var year_start_from = 10;
$("body").on('click', '#next_child_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	$("#frmupdate_childdetails").validate({
		rules: {
			title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			cdob_year: { checkChilddateofbirth: ['cdob_day', 'cdob_month', 'cdob_year']},
			postcode: {required: function(element){ return $("#child_profile_section #postcode_box").val()==""; }},
			parent_title: { required: true },
			parent_other_title:{required: true},
			parent_first_name: { required: true },
			parent_last_name: { required: true },
			parent_phone: { required: true,  },
			parent_email: { required: true },
			parent_cemail: { required: true, equalTo: '#parent_email' },
			parent_postcode: {required: function(element){ return $("#child_profile_section #parent_postcode_box").val()==""; }},
			parent_accept_terms:{required:true},
		},
		 messages: {
                title: "Please select Child's title",
                first_name: "Please enter Child's first name",
               	last_name: "Please enter Child's last name",
				cdob_year: "Please select child's date of birth",
				postcode: "Please enter your postcode",
				address1: "Please enter your address",
				town: "Please enter your town",
				county: "Please enter your county",
				postcode_box: "Please enter child's postcode",
				parent_title: "Please select parent's title",
				parent_other_title: "Please enter parent's title",
                parent_first_name: "Please enter parent's first name",
                parent_last_name: "Please enter parent's last name",
				parent_phone: "Please enter parent's phone number (eg: 01234 567890)",
				parent_email: "Please enter parent's valid email address",
				parent_cemail: "Please check parent's email address matches",
				parent_postcode_box: "Please enter parents's postcode",
				parent_address1: "Please enter parent's address",
				parent_town: "Please enter parent's town",
				parent_county: "Please enter parent's county",
				parent_postcode_box: "Please enter parent's postcode",
				parent_accept_terms: "Please tick this box to proceed"
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
			blockUI($("#frmupdate_childdetails"));
			$.ajax({
				url: base_url + 'ctesp/ctesp_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_childdetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						$(".childs_name_on_maturity").text(response.data.child_details.first_name);
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						
						
						 child_dob_day = $("#child_profile_section .cdob_day").val();
						 child_dob_month = $("#child_profile_section .cdob_month").val();
						 child_dob_year = $("#child_profile_section .cdob_year").val();
						
						//reset all maturity plan
						$("#plan_profile_section select#terms_in_years").val(' ');
						$("#plan_profile_section select#specific_matuarity_day").val(' ');
						$("#plan_profile_section select#specific_matuarity_month").val(' ');
						$("#plan_profile_section select#specific_matuarity_year").val(' ');
						
						
						child_birth_date.setFullYear(child_dob_year, child_dob_month-1, child_dob_day);
						
						var today_date = new Date();
						get_year_diff = date_diff(child_birth_date, today_date);
						
						var i;
						var s;
						term_year = '<option value=" ">Years</option>';
						specific_mat_year = '<option value=" ">Year</option>';
						
						if((parseInt(get_year_diff) + 10) <= 16){

							 less_than_child_age = 7 - (parseInt(get_year_diff) + 1);
							 year_start_from = 10 + less_than_child_age;
							//alert(parse_child_birth_year.getFullYear() +"==="+ less_than_child_age + "===" + year_start_from);
							parse_child_birth_date.setFullYear(parse_child_birth_year.getFullYear() + parseInt(year_start_from), child_dob_month-1, child_dob_day);
							
							
							for (i = year_start_from; i <= 25; i++) {
							  term_year += '<option value="'+ i +'">'+ i +' Years</option>';
							} 
							
							$("#plan_profile_section select#terms_in_years").html(term_year);
							
							var matuty_year = new Date();
							var matu_year_start = matuty_year.getFullYear() + (10 + parseInt(less_than_child_age));
							console.log(matu_year_start);
							var matu_year_end = matuty_year.getFullYear() + 25;
							console.log(matu_year_end);
							for (s = matu_year_start; s <= matu_year_end; s++) {
							  specific_mat_year += '<option value="'+ s +'">'+ s +'</option>';
							} 
							
							$("#plan_profile_section select#specific_matuarity_year").html(specific_mat_year);
							
						}else{
							for (i = 10; i <= 25; i++) {
							  term_year += '<option value="'+ i +'">'+ i +' Years</option>';
							} 
							
							$("#plan_profile_section select#terms_in_years").html(term_year);
							
							parse_child_birth_date.setFullYear(parse_child_birth_year.getFullYear(), child_dob_month-1, child_dob_day);
							var matuty_year = new Date();
							var matu_year_start = matuty_year.getFullYear() + 10;
							var matu_year_end = matuty_year.getFullYear() + 25;
							for (s = matu_year_start; s <= matu_year_end; s++) {
							  specific_mat_year += '<option value="'+ s +'">'+ s +'</option>';
							}  
							
							$("#plan_profile_section select#specific_matuarity_year").html(specific_mat_year);
							}
							init_select_box();
						
						//console.log(child_dob_day + "========"+ child_dob_month +"===========" + child_dob_year);
						//console.log(child_birth_date);
						//console.log(get_year_diff);
						unblockUI($("#frmupdate_childdetails"));
					}
					
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmupdate_childdetails"));
				}
				
				
			});
		}
	});
	
	if($("#child_profile_section #postcode_box").val() == ""){
		$("#child_profile_section #postcode").val('');
		$("#child_profile_section #postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your postcode"
				},
				
		});
	}
	
	if($("#child_profile_section #parent_postcode_box").val() == ""){
		$("#child_profile_section #parent_postcode").val('');
		$("#child_profile_section #parent_postcode_box").rules("add", { 
		  required:true,
		  messages: {
					required: "Please enter your postcode"
				},
				
		});
	}
	
	$("#child_profile_section .cdob_year").rules("add", { 
		  check_ctesp_child_date_of_birth:
				function(element) {
					return [$("#frmupdate_childdetails .cdob_day").val(), $("#frmupdate_childdetails .cdob_month").val(), $("#frmupdate_childdetails .cdob_year").val(), 16, "Child Tax Exempt Savings Plan"];
				},
		  messages: {
					required: "Please select child's date of birth"
				},
				
		});
	
});

var terms_years_selected = false;
$("body").on("change", "#frmplandetails .terms_in_years, #frmplandetails .specific_matuarity_month, #frmplandetails .specific_matuarity_day, #frmplandetails .specific_matuarity_year", function(){
	var terms_in_years = $("#frmplandetails .terms_in_years").val();

	var terms_in_years = $("#frmplandetails .terms_in_years").val();
	var specific_matuarity_day = $("#frmplandetails .specific_matuarity_day").val();
	var specific_matuarity_month = $("#frmplandetails .specific_matuarity_month").val();
	var specific_matuarity_year = $("#frmplandetails .specific_matuarity_year").val();
	
	var error_msg = "Please select a Term in years OR a specific maturity date";
	
	if(terms_in_years!=false){ terms_years_selected = true;}else{ terms_years_selected = false;}
	
	if(specific_matuarity_day !=false || specific_matuarity_month !=false || specific_matuarity_year!=false)
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
	
	if(specific_matuarity_day!=false || specific_matuarity_month!=false || specific_matuarity_year!=false)
	{
		$.ajax({
			url : base_url + 'ctesp/check_maturity_date/',
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
		salert('warning', "Maturity Date Warning", "Please select a Term in years OR a specific maturity date.", '');	
		return false;
	}*/
	
	
	$("#frmplandetails").validate({
		ignore: "",						  
		rules: {
			terms_in_years: {checkMaturityTermYear:['terms_in_years','specific_matuarity_day','specific_matuarity_month','specific_matuarity_year']},              
            specific_matuarity_year: {checkMaturityTermYear:['terms_in_years','specific_matuarity_day','specific_matuarity_month','specific_matuarity_year'], 
			ctesp_min_maturity_terms:
				function(element) {
					return [$("#frmplandetails .terms_in_years").val(), $("#frmplandetails .specific_matuarity_day").val(), $("#frmplandetails .specific_matuarity_month").val(), $("#frmplandetails .specific_matuarity_year").val(), parse_child_birth_date, 25, "Specific maturity date"];
				}
			}
		},
		 messages: {
			 terms_in_years : "Please select a Term in years OR a specific maturity date",
			 specific_matuarity_year : {
							required: "Please select a Term in years OR a specific maturity date",
							ctesp_min_maturity_terms: "Please select a specific maturity date that is at least 10 years from today, and after the child's 16th birthday"
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
				url: base_url + 'ctesp/ctesp_form_submit/' + d_step,
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
			monthly_account_sort_code: { required: true },
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
			blockUI($("#frmyourdetails"));
			$.ajax({
				url: base_url + 'ctesp/ctesp_form_submit/' + d_step,
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmyourdetails"));
					} else {
							$("#pgbar").html(response.data.progressbar);
						
							$(".summary_personal_section").html(response.data.personal_details_view);
							$(".summary_child_details").html(response.data.child_details_view);	
							$(".summary_plan_section").html(response.data.plan_details_view);
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





$("body").on("click", ".same_address_child", function(){
	if($(this).is(":checked")){										
		$(".same_as_prev_address").removeClass("hide");
		$(".show_postcode, .extra_add").hide();
	}else
	{
		$(".same_as_prev_address").addClass("hide");
		$("div[id^='tooltip']").hide();
		$(".show_postcode").show();
	}

	if($("#parent_same_address_child").is(":checked")){	
		$(".parent_same_as_prev_address").addClass("hide");
		$(".parent_show_postcode").show();
		$("#parent_same_address_child").prop("checked",false);
	}
	
	$("div[id^='tooltip']").hide();
})

$("body").on("click", ".parent_same_address_child", function(){
	if($(this).is(":checked")){	
	
		var child_address1 = $(".extra_child_add  #address1").val();
		var child_postcode_box = $(".extra_child_add  #postcode_box").val();
	
		if((child_address1 == false || child_postcode_box == false) && (!$("#same_address_child").is(":checked")))
		{
			salert("warning", "Missing Child Address", "Please add child address first.");
			return false;
		}
	
		$(".parent_same_as_prev_address").removeClass("hide");
		if($("#same_address_child").is(":checked")){
			var child_address1 = $(".same_as_prev_address .disabled_address1").val();
			var child_address2 = $(".same_as_prev_address .disabled_address2").val();
			var child_address_town = $(".same_as_prev_address .disabled_town").val();
			var child_address_county = $(".same_as_prev_address .disabled_county").val();
			var child_address_postcode_box = $(".same_as_prev_address .disabled_postcode_box").val();
		}else{
			var child_address1 = $(".extra_child_add #address1").val();
			var child_address2 = $(".extra_child_add #address2").val();
			var child_address_town = $(".extra_child_add #town").val();
			var child_address_county = $(".extra_child_add #county").val();
			var child_address_postcode_box = $(".extra_child_add #postcode_box").val();
		}
		if(child_address1 !="" || child_address2 !="" || child_address_town !="" || child_address_county !="" || child_address_postcode_box !="")
		{
			$(".parent_same_as_prev_address .disabled_address1").val(child_address1);
			$(".parent_same_as_prev_address .disabled_address2").val(child_address2);
			$(".parent_same_as_prev_address .disabled_town").val(child_address_town);
			$(".parent_same_as_prev_address .disabled_county").val(child_address_county);
			$(".parent_same_as_prev_address .disabled_postcode_box").val(child_address_postcode_box);
			
			$(".parent_same_as_prev_address .parent_hidden_address1").val(child_address1);
			$(".parent_same_as_prev_address .parent_hidden_address2").val(child_address2);
			$(".parent_same_as_prev_address .parent_hidden_town_city").val(child_address_town);
			$(".parent_same_as_prev_address .parent_hidden_county").val(child_address_county);
			$(".parent_same_as_prev_address .parent_hidden_postcode").val(child_address_postcode_box);
		}
		
		$(".parent_show_postcode, .parent_extra_add").hide();
	}else
	{
		$("div[id^='tooltip']").hide();
		$(".parent_same_as_prev_address").addClass("hide");
		$(".parent_show_postcode").show();
	}
})

$("#ctesp_index").on("click", ".summary_edit", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	$.ajax({
		url : base_url + 'ctesp/edit_summary/',
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



$("#ctesp_index").on("click", "#next5", function(){
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
				url : base_url + 'ctesp/submit_application/',
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
							$("#confirmation_section").removeClass("hide");
							$("#customer_ref_number").text(response.data.customer_app_id);
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


$("body").on("click", ".add_child_address_manually", function(){
	$(".extra_child_add").slideToggle(300);
	$(".extra_child_add").find('input').val('');
	$("div[id^='tooltip']").hide();
});

$("body").on("click", ".add_parent_address_manually", function(){
	$(".extra_parent_add").slideToggle(300);
	$(".extra_parent_add").find('input').val('');
	$("div[id^='tooltip']").hide();
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

$("#child_profile_section").on("click", "#child_address_area .afd-typeahead-result li.afd-typeahead-item", function(){
	$("#child_profile_section .extra_add").show();			
});

$("#child_profile_section").on("click", "#parent_address_area .afd-typeahead-result li.afd-typeahead-item", function(){
	$("#child_profile_section .extra_parent_add").show();			
});



$("body").on("click", "input[name='old_address_change']", function(){
	var old_address_tooltip_id = $(this).attr("aria-describedby");
																   
	if($(this).val() == 1){
		$(".old_address").show();
	}else{
		$(".old_address").hide();
	}
	
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


function worldpay_redirect()
{
	location.href = base_url + "ctesp/submit_worldPay";
}


