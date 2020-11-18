$(document).ready(function(){
'use strict';

var investment_value = 0;
var lifetime_max_investment_value = 4000;//4000 Max for Lifetime ISA
var check_limit_exceed = true;
var check_some_limit_exceed = true;
	
	
$('body').on('keypress', 'input[type="text"]', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9@.#,_+=/')( \-\]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

$('body').on('keypress', '.building_society_number', function (e) {
    var regex = new RegExp("^[a-zA-Z0-9.,/ \-\]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

$("#ctfm_index").on("keypress, keyup", '#phone',function(i, val) {
	$(this).attr('maxlength', '13');
    $(this).val($(this).val().replace(/^(\d{5})(\d{6})/, "$1 $2"));
});

$('select').change(function(){
	var tool_id = $(this).attr("aria-describedby");
	
    if ($(this).val()!="")
    {
		$("#" + tool_id).hide();
    }
});

$('input[type="file"]').change(function(){
	var tool_id = $(this).attr("aria-describedby");
	
    if ($(this).val()!="")
    {
		$("#" + tool_id).hide();
    }
});

$("#personal_profile_section").on("keypress keyup", ".ni-segment", function(){
	niValidation();
});

$('select').each(function () {
	$(this).select2({
	  theme: 'bootstrap4',
	  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
	  placeholder: $(this).attr('placeholder'),
	  allowClear: Boolean($(this).data('allow-clear')),
	});
});

$.validator.addMethod("maxval", function (val, ele, arg) {
		
		if($(".invest_all_in_ssisa").is(":checked")){
			var ssisa_val = $("#invest_all_ssisa").val();
			var lisa_val = $("#invest_all_lifetimeisa").val();
			var max_lifetime_isa_ssisa = parseFloat(val) - 500;

			if(lisa_val > 4000)
				return false;
				
			if(ssisa_val == false || parseFloat(ssisa_val) < 500)
				return false;
			
			if((parseFloat(val) + parseFloat(ssisa_val)) > parseFloat(arg))
				return false;
		}
		
		if(parseFloat(val) > arg){ return false;}
		
return true;
}, function(val, arg) {
	var invest_all_lifetimeisa = $("#invest_all_lifetimeisa").val();
	
	if($(".invest_all_in_ssisa").is(":checked")){
			var ssisa_val = $("#invest_all_ssisa").val();
			var max_lifetime_isa_ssisa = parseFloat(val) - 500;
			var lisa_val = $("#invest_all_lifetimeisa").val();
			
			if(lisa_val > 4000)
				return "Please enter an amount up to \u00A34000, which is the maximum investment per tax year for this product";
			
			if(ssisa_val == false || parseFloat(invest_all_lifetimeisa) < 500)
				return "<span style='color:green !important;'>Please ensure the amount you enter leaves at least the minimum investment amount for the Stocks & Shares ISA. If you need any help, please call us on 0800 988 2418.</span>";
			
			if((parseFloat(ssisa_val) + parseFloat(lisa_val)) > parseFloat(val))
				return "Please enter an amount up to \u00A3"+ parseFloat(val).toLocaleString(undefined, { minimumFractionDigits: 2 }) +", which is the maximum investment per tax year for this product";
				
		}else{
			return "Please enter an amount up to \u00A3"+ parseFloat(val).toLocaleString() +", which is the maximum investment per tax year for this product";
		}
	}
);

var minval='';	
var entered_val='';
$.validator.addMethod("minval", function (val, ele, arg) {
	entered_val = val.replace(",","");	
	if (!$("#frmchoiceoption #invest_all_in_lifetime").is(":checked") || !$("#frmchoiceoption #invest_all_in_ssisa").is(":checked")) { minval = arg[1];}else{ minval = arg[0];}
	
	//var minvalue = minval.replace(",","");
			if(parseFloat(entered_val) < parseFloat(minval) ){ return false;}
	return true;
}, function(val, arg) {
	
	if (!$("#frmchoiceoption #invest_all_in_lifetime").is(":checked") || !$("#frmchoiceoption #invest_all_in_ssisa").is(":checked")) { var min_val = val[1];}else{ var min_val = arg[0];}
		if(parseFloat(entered_val) < 500){
			min_val = 500;
			var err_msg = "Please ensure the amount you are investing is at least \u00A3500, which is the minimum lump sum amount for each type of ISA";
		}else{
			var err_msg ='The amount you have entered is less than the value of your Child Trust Fund which is \u00A3' + parseFloat(min_val).toLocaleString();
		}
		
    return err_msg;
});


$.validator.addMethod("minval_some_investment", function (val, ele, arg) {
		var min_val_some_invest = val.replace(",","");
		if(parseFloat(min_val_some_invest) < 500){ return false;}
return true;
}, "Please enter an amount from \u00A3500, which is the minimum investment for this product");

$.validator.addMethod("maxval_some_investment", function (val, ele, arg) {
		var min_val_some_invest = val.replace(",","");
		if(parseFloat(min_val_some_invest) > 4000){ return false;}
return true;
}, "Please enter Lifetime investment amount from \u00A3500 up to \u00A34000");

$.validator.addMethod("requiredReinvestLifetime", function (val, ele, arg) {
    if ($("#frmchoiceoption #invest_some_in_lifetime").is(":checked") && ($.trim(val) == '')) { return false; }
    return true;
}, "Please enter Lifetime ISA amount");

$.validator.addMethod("requiredReinvestSSISA", function (val, ele, arg) {
    if ($("#frmchoiceoption #invest_some_in_ssisa").is(":checked") && ($.trim(val) == '')) { return false; }
    return true;
}, "Please enter Stocks & Shares ISA amount");

$.validator.addMethod("requiredInvestAllLifetime", function (val, ele, arg) {
    if ($("#frmchoiceoption #invest_all_in_lifetime").is(":checked") && ($.trim(val) == '')) { return true; }
    return true;
}, "Please enter Lifetime ISA amount");

$.validator.addMethod("requiredInvestAllSSISA", function (val, ele, arg) {
    if ($("#frmchoiceoption #invest_all_in_ssisa").is(":checked") && ($.trim(val) == '')) { return false; }
    return true;
}, "Please enter Stocks & Shares ISA amount");



$("#uniqueid_section").on("click", ".find_data", function(){
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	$("#frmyourchoice").validate({
		rules: {
			uniqueID: { required: true },
			fdob_year: { required:true},
		},
		 messages: {
                uniqueID: "Please enter unique ID",
				fdob_year: "Please select your date of birth",
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
			blockUI($("#frmyourchoice"));
			$.ajax({
				url: base_url + 'ctfm/get_data/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert('warning', 'No Record found!', response.msg);
						unblockUI($("#frmyourchoice"));
					} else {
						//load_modal(obj);
						//salert("Success", response.msg, '', 'current', 'success');
						$("#pgbar").html(response.data.progressbar);
						
						$(".view_personal_details_section").html(response.data.edit_customer_detail);
						
						curObj.parents("section").addClass("hide");
						curObj.parents("section").next("section").removeClass("hide");
						
						$('select').each(function () {
							$(this).select2({
							  theme: 'bootstrap4',
							  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
							  placeholder: $(this).attr('placeholder'),
							  allowClear: Boolean($(this).data('allow-clear')),
							});
						});
						unblockUI($("#frmyourchoice"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmyourchoice"));
				}
			});
		}
	});
	
														
})



$("#ctfm_index").on("click", ".backbtn", function(){
	var steps = $(this).attr("data-step");
	var curObj = $(this);
	$.ajax({
		url : base_url + '/ctfm/back_step/',
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
				if(steps == 3)
					$("#your_choice_section").removeClass("hide");
				else
					curObj.parents("section").prev("section").removeClass("hide");	
				//curObj.parents("section").prev("section").css("display","block");
			}
			$("div[id^='tooltip']").hide();
		}
	});
});



$("body").on('click', '#update_your_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	
	$("#frmupdate_yourdetails").validate({
		errorElement: "span",
		rules: {
			title: { required: true },
			first_name: { required: true },
			last_name: { required: true },
			phone: { required: true,  },
			email: { required: true },
			cemail: { required: true, equalTo: '#email' },
			NI5: { checkAllNI: ['NI1','NI2','NI3','NI4','NI5'] },
		},
		 messages: {
                title: "Please select your title",
                first_name: "Please enter your first name(s)",
                last_name: "Please enter your last name",
				dob_year: "Please select your date of birth",
				phone: "Please enter your phone number",
				email: "Please enter a valid email address",
				cemail: "Please check your email address matches",
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
				url: base_url + 'ctfm/update_your_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", response.msg, '', 'current', 'error');
						unblockUI($("#frmupdate_yourdetails"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						$("#personal_profile_section").addClass("hide");
						$("#your_choice_section").removeClass("hide");
						$(".summary_personal_section").html(response.data.peronal_detail_summary_view);
						
						investment_value = response.data.investment_value;
						
						$("#your_choice_section .your_choice_value_label")	.html(" \u00A3"+ parseFloat(response.data.investment_value).toLocaleString(undefined, {minimumFractionDigits: 2}) + ", as at " + response.data.investment_date);	
						
						lifetime_max_investment_value = response.data.investment_value;
						if(parseFloat(investment_value) > 4000)
							lifetime_max_investment_value = 4000;
						
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

$("body").on('click', '#update_identity_details', function (e) {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	$("#frmyouridentity").validate({
		errorElement: "span",
		rules: {
			id_proof_type: { required: true },
			id_proof_file: { required: true, extension:"jpg|jpeg|png|pdf"},
			address_proof_type: { required: true },
			address_proof_file: { required: true, extension:"jpg|jpeg|png|pdf"},
			//summary_accept_lisa_terms: { required: true },
		},
		 messages: {
                id_proof_type: "Please select ID proof type",
                id_proof_file: "Please upload a valid ID proof",
                address_proof_type: "Please select Address proof type",
				address_proof_file: "Please upload a valid Address proof",
				//summary_accept_lisa_terms: "Please tick you have read and undertood the above information about the Lifetime ISA",
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
			blockUI($("#frmyouridentity"));
			var formData = new FormData(form);
			$.ajax({
				url: base_url + 'ctfm/update_identity_details/',
				type: 'POST',
				async: true,
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					if (!response.status) {
						salert("error", "Error", response.msg);
						unblockUI($("#frmyouridentity"));
					} else {
						$("#pgbar").html(response.data.progressbar);
						$("#your_identity_section").addClass("hide");
						$("#summary_section").removeClass("hide");
						
						$(".summary_your_identity_section").html(response.data.summary_your_identity_view);
						
						unblockUI($("#frmyouridentity"));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					check_session(xhr);
					unblockUI($("#frmyouridentity"));
				}
			});
		}
	});
	
});
var check_if_box_checked;
$("body").on("click", ".ctfm_pay_option", function(){
	var box_option = $(this).attr('id');
	if($(this).is(":checked")){
		
		if(box_option != "reinvest_all_money"){
			$(".reinvest_all_money_box").slideUp(500);
			$(".reinvest_all_money_box").find("input[type='text']").val('');
			$(".reinvest_all_money_box").find("input").prop('checked', false);
			$(".show_hide_lifetimeinvestment").addClass("hide");
			$("#summary_accept_lisa_terms").prop('checked', false);
		}
		
		
		if(box_option != "reinvest_some_money"){
			$(".reinvest_some_money_box").slideUp(500);
			$(".reinvest_some_money_box").find("input[type='text']").val('');
			$(".reinvest_some_money_box").find("input").prop('checked', false);
			$(".show_hide_lifetimeinvestment").addClass("hide");
			$("#summary_accept_lisa_terms").prop('checked', false);
		}
		
		if(box_option != "reinvest_take_money")	{
			$(".reinvest_take_money_box").slideUp(500);
			$(".reinvest_take_money_box").find("input[type='text']").prop('checked', false);
		}
		if(box_option == "reinvest_take_money"){	
			$(".summary_investment_terms, .summary_investment_terms_ssisa").addClass("hide");	
		}
		
		if(box_option == "reinvest_some_money"){	
			$(".summary_investment_terms, .summary_investment_terms_ssisa").find("input").prop('checked', false);	
			$(".summary_investment_terms, .summary_investment_terms_ssisa").addClass("hide");
		}
		
		if(box_option == "reinvest_all_money"){	
			$(".summary_investment_terms, .summary_investment_terms_ssisa").find("input").prop('checked', false);
			$(".summary_investment_terms, .summary_investment_terms_ssisa").addClass("hide");
		}
		
		$("." + box_option + "_box").slideToggle(500);
	}else{
		$("." + box_option + "_box").slideUp(500);
	}
	
	if (check_if_box_checked === this) {
		this.checked = false;
		check_if_box_checked = null;
		$(".summary_investment_terms, .summary_investment_terms_ssisa").addClass("hide");
		$(".summary_investment_terms, .summary_investment_terms_ssisa").find("input").prop('checked', false);
		$("." + box_option + "_box").find("input[type='text']").val('');
		$("." + box_option + "_box").find("input").prop('checked', false);

	} else {
		check_if_box_checked = this;
	}
	
	$("div[id^='tooltip']").hide();
});


$("body").on("click", ".invest_all_in_lifetime", function(){
	var tooltipid =	$(".invest_all_lifetimeisa").attr("aria-describedby");
	var lisa_summary_tooltipid =	$("#summary_accept_terms").attr("aria-describedby");
	if($(this).is(":checked")){
		$(".lisa_ssisa_all_investment_text").text("into a Lifetime ISA");
		
		$("#your_choice_section .show_hide_lifetimeinvestment").removeClass("hide");
		$("#summary_section .summary_investment_terms").removeClass("hide");
		if($(".invest_all_in_ssisa").is(":checked")){
			$(".reinvest_all_value_box").removeClass("hide");
			$(".lisa_ssisa_all_investment_text").text("into a Lifetime ISA and the remaining balance into a Stocks & Shares ISA");
			$(".invest_all_lifetimeisa").attr("readonly", false);
			
			if(investment_value > lifetime_max_investment_value){
				
				var sisa_value = parseFloat(investment_value) - parseFloat(lifetime_max_investment_value);
				$(".invest_all_ssisa").val(sisa_value);
			}else{
				$(".invest_all_ssisa").val('');
			}
			$("#summary_section .summary_investment_terms_ssisa").removeClass("hide");
		}else{
			$(".invest_all_lifetimeisa").attr("readonly", true);
			$(".invest_all_lifetimeisa").val(lifetime_max_investment_value);
				
		}
		
		
		//$(".invest_all_lifetimeisa").attr("readonly", false);
		$(".invest_all_lifetimeisa").attr("required", true);
		$(".invest_all_lifetimeisa").addClass("required");
		
		//if($(".invest_all_lifetimeisa").val() <= 0)
			$(".invest_all_lifetimeisa").val(lifetime_max_investment_value);
		//$(".invest_all_lifetimeisa").attr("required", true);
		//$(".invest_all_lifetimeisa").attr("id", "invest_all_lifetimeisa");
	}else{
		$(".reinvest_all_value_box").addClass("hide");
		$("#your_choice_section .show_hide_lifetimeinvestment").addClass("hide");
		$("#summary_section .summary_investment_terms").addClass("hide");
		if($(".invest_all_in_ssisa").is(":checked")){
			
			//if($(".invest_all_ssisa").val() <= 0)
				$(".invest_all_ssisa").val(investment_value);
				
			$("#summary_section .summary_investment_terms_ssisa").removeClass("hide");
		}
		$(".invest_all_lifetimeisa").val('');
		$(".invest_all_lifetimeisa").attr("readonly", true);
		$(".invest_all_lifetimeisa").attr("required", false);
		$(".invest_all_lifetimeisa").removeClass("required");
		$("#" + tooltipid).hide();
		$(".invest_all_lifetimeisa").rules("remove");
		//$(".invest_all_lifetimeisa").attr("required", false);
		//$(".invest_all_lifetimeisa").attr("id", "");
	}
});

$("body").on("click", ".invest_all_in_ssisa", function(){
	var tooltipid =	$(".invest_all_ssisa").attr("aria-describedby");		
	var ssisa_summary_tooltipid =	$("#summary_accept_terms_ssisa").attr("aria-describedby");
	if($(this).is(":checked")){
		//$("#your_choice_section .show_hide_lifetimeinvestment").removeClass("hide");
		
		$("#summary_section .summary_investment_terms_ssisa").removeClass("hide");
		if($(".invest_all_in_lifetime").is(":checked")){
			$(".invest_all_ssisa").attr("readonly", true);
			$(".invest_all_lifetimeisa").attr("readonly", false);
			$(".reinvest_all_value_box").removeClass("hide");
			$(".lisa_ssisa_all_investment_text").text("into a Lifetime ISA and the remaining balance into a Stocks & Shares ISA");
			
			if($(".invest_all_lifetimeisa").val() <= 0)
				$(".invest_all_lifetimeisa").val(lifetime_max_investment_value);
				
			if(investment_value > lifetime_max_investment_value){
				
				var sisa_value = parseFloat(investment_value) - parseFloat(lifetime_max_investment_value);
				$(".invest_all_ssisa").val(sisa_value);
			}else{
				$(".invest_all_ssisa").val('');
			}
			
		}else{
			$(".invest_all_ssisa").attr("readonly", true);
			$(".invest_all_lifetimeisa").attr("readonly", true);
			
			//if($(".invest_all_ssisa").val() <= 0)
				$(".invest_all_ssisa").val(investment_value);
		}
		$(".invest_all_ssisa").attr("required", true);
		$(".invest_all_ssisa").addClass("required");
		$(".invest_all_ssisa").attr("id", "invest_all_ssisa");
		}else{
			$(".reinvest_all_value_box").addClass("hide");
			$(".lisa_ssisa_all_investment_text").text("into a Lifetime ISA");
			//$("#your_choice_section .show_hide_lifetimeinvestment").addClass("hide");
			$("#summary_section .summary_investment_terms_ssisa").addClass("hide");
			if($(".invest_all_in_lifetime").is(":checked")){
				$(".invest_all_lifetimeisa").attr("readonly", true);
				$(".invest_all_lifetimeisa").val(lifetime_max_investment_value);
					
				$("#summary_section .summary_investment_terms").removeClass("hide");
				$(this).parents(".reinvest_all_money_box").find(".error").css("display","none");
			}
			$(".invest_all_ssisa").val('');
			$(".invest_all_ssisa").attr("readonly", true);
			$(".invest_all_ssisa").attr("required", false);
			$(".invest_all_ssisa").removeClass("required");
			$("#" + tooltipid).hide();
			$(".invest_all_ssisa").rules("remove");
			//$(".invest_all_ssisa").attr("required", false);
			//$(".invest_all_ssisa").attr("id", "");
		}
	
});

$("body").on("keypress keyup paste", ".invest_all_lifetimeisa", function(){
	var lifetime_val = $(".invest_all_lifetimeisa").val();
	var ssisa_val = $(".invest_all_ssisa").val();
	
	lifetime_val = lifetime_val.replace(",","");
	ssisa_val = ssisa_val.replace(",","");
	
	if(lifetime_val == false)
		lifetime_val = 0;
	
	if(ssisa_val == false)
		ssisa_val = 0;
	
	if($(".invest_all_in_ssisa").is(":checked") && lifetime_val >= 0){
			var left_ssisa_val = parseFloat(investment_value) - parseFloat(lifetime_val);
			if(left_ssisa_val <= 0)
				left_ssisa_val = 0;
				
			$(".invest_all_ssisa").val(left_ssisa_val.toFixed(2));
	}
	
	
});


$("body").on("click", ".invest_some_in_lifetime", function(){
		var tooltipid =	$(".invest_some_lifetimeisa").attr("aria-describedby");
		if($(this).is(":checked")){
			$("#your_choice_section .show_hide_lifetimeinvestment").removeClass("hide");
			$("#summary_section .summary_investment_terms").removeClass("hide");
			$(".invest_some_lifetimeisa").attr("readonly", false);
		}else{
			$("#" + tooltipid).hide();
			$("#your_choice_section .show_hide_lifetimeinvestment").addClass("hide");
			$("#summary_section .summary_investment_terms").addClass("hide");
			$(".invest_some_lifetimeisa").val('');
			$(".invest_some_lifetimeisa").attr("readonly", true);	
		}
	
});

$("body").on("click", ".invest_some_in_ssisa", function(){
		var tooltipid =	$(".invest_some_ssisa").attr("aria-describedby");
		if($(this).is(":checked")){
			//$("#your_choice_section .show_hide_lifetimeinvestment").removeClass("hide");
			$("#summary_section .summary_investment_terms_ssisa").removeClass("hide");
			$(".invest_some_ssisa").attr("readonly", false);
		}else{
			$("#" + tooltipid).hide();
			//$("#your_choice_section .show_hide_lifetimeinvestment").addClass("hide");
			$("#summary_section .summary_investment_terms_ssisa").addClass("hide");
			$(".invest_some_ssisa").val('');
			$(".invest_some_ssisa").attr("readonly", true);	
		}
	
});

$("body").on("click", "#reinvest_all_money, #reinvest_some_money", function(){
		$("#summary_section .summary_investment_terms_hr").addClass("hide");
});

$("body").on("click", ".badgebox", function(){
		if(($("#your_choice_section #invest_all_in_lifetime").is(":checked")) || ($("#your_choice_section #invest_all_in_ssisa").is(":checked"))){
			$("#summary_section .summary_investment_terms_hr").removeClass("hide");
		}else if(($("#your_choice_section .invest_some_in_lifetime").is(":checked")) || ($("#your_choice_section .invest_some_in_ssisa").is(":checked"))){
			$("#summary_section .summary_investment_terms_hr").removeClass("hide");
		}else{
			$("#summary_section .summary_investment_terms_hr").addClass("hide");
		}
	
});




$("body").on('click', '#next3', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	var invest_all_in_lifetime = $("#invest_all_in_lifetime").val();
	/*if($("#reinvest_all_money").is(":checked") && check_limit_exceed == true)
	{
		var max_investment_amount = parseFloat(investment_value) * 2.1;
		
		var invest_all_lifetime_amount = $("#invest_all_lifetimeisa").val();
		var invest_all_ssisa_amount = $("#invest_all_ssisa").val();
		
		invest_all_lifetime_amount = invest_all_lifetime_amount.replace(",","");
		invest_all_ssisa_amount = invest_all_ssisa_amount.replace(",","");
		
		invest_all_lifetime_amount = $.isNumeric(invest_all_lifetime_amount)? parseFloat(invest_all_lifetime_amount) : 0;
		invest_all_ssisa_amount = $.isNumeric(invest_all_ssisa_amount)? parseFloat(invest_all_ssisa_amount) : 0;
		
		
		var total_investment_amount = invest_all_lifetime_amount + invest_all_ssisa_amount;
		if((total_investment_amount > max_investment_amount) && check_limit_exceed == true)
		{
				
				check_limit_exceed = false;
				salert("warning", "CTF value exceeded", "The amount you have entered is higher than the current maturity value of your policy. It is possible that additional funds will be added at the last minute. If you know this to be the case you may proceed, otherwise please check that the amounts you have entered are correct and do not exceed \u00A3"+ parseFloat(investment_value).toLocaleString());
				return false;
		}
	}*/
	
	/*if($("#reinvest_all_money").is(":checked") && ($("#invest_all_in_lifetime").is(":checked") && $("#invest_all_in_ssisa").is(":checked")))
	{
		var invest_all_lifetime_amount = $("#invest_all_lifetimeisa").val();
		var invest_all_ssisa_amount = $("#invest_all_ssisa").val();
		
		invest_all_lifetime_amount = invest_all_lifetime_amount.replace(",","");
		invest_all_ssisa_amount = invest_all_ssisa_amount.replace(",","");
		
		invest_all_lifetime_amount = $.isNumeric(invest_all_lifetime_amount)? parseFloat(invest_all_lifetime_amount) : 0;
		invest_all_ssisa_amount = $.isNumeric(invest_all_ssisa_amount)? parseFloat(invest_all_ssisa_amount) : 0;
		
		
		var total_investment_amount = invest_all_lifetime_amount + invest_all_ssisa_amount;
		if(total_investment_amount < investment_value)
		{
				
				salert("warning", "CTF value limit", "The amount you have entered is less than the value of your Child Trust Fund which is \u00A3"+ parseFloat(investment_value).toLocaleString());
				return false;
		}
	}*/
		
	if($("#reinvest_some_money").is(":checked") && check_some_limit_exceed == true)
	{
		var invest_some_lifetime_amount = $("#invest_some_lifetimeisa").val();
		var invest_some_ssisa_amount = $("#invest_some_ssisa").val();
		
		invest_some_lifetime_amount = invest_some_lifetime_amount.replace(",","");
		invest_some_ssisa_amount = invest_some_ssisa_amount.replace(",","");
		
		var total_reinvestment_amount = parseFloat(invest_some_lifetime_amount) + parseFloat(invest_some_ssisa_amount);
		if(total_reinvestment_amount > investment_value)
		{
			check_some_limit_exceed = false;
			salert("warning", "CTF value exceeded", "The amount you have entered is higher than the current maturity value of your policy. It is possible that additional funds will be added at the last minute. If you know this to be the case you may proceed, otherwise please check that the amounts you have entered are correct and do not exceed \u00A3"+ parseFloat(investment_value).toLocaleString());
			return false;	
		}	
		
	}

	$("#frmchoiceoption").validate({
		rules: {
			reinvest_all_money:{required: true},
			invest_all_in_lifetime: {required: function(e){ return !$("#invest_all_in_ssisa").is(":checked");}},
			invest_all_lifetimeisa: { requiredInvestAllLifetime: true, minval:500, maxval: investment_value},//, 
			invest_all_in_ssisa: {required: function(e){ return !$("#invest_all_in_lifetime").is(":checked");}},
			invest_all_ssisa: { requiredInvestAllSSISA: true},
			invest_some_in_lifetime: {required: function(e){ return !$("#invest_some_in_ssisa").is(":checked");}},
			invest_some_in_ssisa: {required: function(e){ return !$("#invest_some_in_lifetime").is(":checked");}},
			invest_some_lifetimeisa: { requiredReinvestLifetime: true, minval_some_investment:500, maxval_some_investment:4000},
			invest_some_ssisa: { requiredReinvestSSISA: true, minval_some_investment:500 },
			accept_some_invest_consent: { required: true},
			accept_takemoney_invest_consent: {required: true},
			summary_accept_lisa_terms: { required: true },

			//summary_accept_terms_lisa: { required: true},
			//summary_accept_terms_ssisa: { required: true},
		},
		 messages: {
			reinvest_all_money: "Please tick one of the sections",
			invest_all_in_lifetime: "Please tick if you wish to reinvest in Lifetime ISA",
			invest_all_in_ssisa: "Please tick if you wish to reinvest in Stocks & Shares ISA",
			invest_all_lifetimeisa: 'Please enter an amount up to \u00A3'+ parseInt(lifetime_max_investment_value).toLocaleString() + ", which is the maximum investment per tax year for this product.",
			invest_all_ssisa: "Please enter valid amount between \u00A3500 up to \u00A3" + parseInt(investment_value).toLocaleString(),
			invest_some_in_lifetime: "Please tick this box to reinvest in Lifetime ISA",
			invest_some_lifetimeisa: "Please enter valid amount between \u00A3500 up to \u00A34,000",// + parseInt(lifetime_max_investment_value).toLocaleString(),
			invest_some_in_ssisa: "Please tick this box to reinvest in Stocks & Shares ISA",
			invest_some_ssisa: "Please enter an amount from \u00A3500, which is the minimum investment for this product",// up to \u00A3" + parseInt(investment_value).toLocaleString(),
			accept_some_invest_consent: "Please tick you have undertood that the remaining balance will be paid out to me",
			accept_takemoney_invest_consent : "Please tick to confirm to receive the full maturity amount",
			summary_accept_lisa_terms: "Please tick you have read and undertood the above information about the Lifetime ISA",
			
			//summary_accept_terms_lisa: "Please read and tick to confirm you have understood the Lifetime ISA declaration and documents provided",
			//summary_accept_terms_ssisa: "Please read and tick to confirm you have understood the Stocks & Shares ISA declaration and documents provided",
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
				url: base_url + 'ctfm/update_choice_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("warning", "Error", response.msg);
						unblockUI($("#frmyourdetails"));
					} else {
						
						$("#pgbar").html(response.data.progressbar);
						
						$("#your_choice_section").addClass("hide");
						if(response.data.step == 4){
							$("#payment_option_section").removeClass("hide");
							$(".summary_payment_box, .summary_payment_options").removeClass("hide");
						}else{
							$(".summary_payment_box, .summary_payment_options").addClass("hide");
							$("#your_identity_section").removeClass("hide");
							$("#your_identity_section .backbtn").attr("data-step", 3);
							$("#your_identity_section .backbtn").attr("skip-payment", 1);
						}
						
						$(".summary_your_choice_section").html(response.data.summary_your_choice_view);
						
						
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
	
	if($("#invest_all_in_lifetime").is(":checked")){
		 var min_amount_lisa = 500;
		 var lisa_alert_msg = "Please enter an amount from \u00A3500, which is the minimum investment for this product.";
		if($("#invest_all_in_ssisa").is(":checked")){
			min_amount_lisa = 500;
		}else{
			min_amount_lisa = lifetime_max_investment_value;
			lisa_alert_msg = "The amount you have entered is less than the value of your Child Trust Fund which is \u00A3" + parseFloat(lifetime_max_investment_value).toLocaleString() + " but this value may go up if last minute payments are made to your policy";
		}
		$(".invest_all_lifetimeisa").rules("add", { 
		  required:{},
		  minval: [500, lifetime_max_investment_value],
		  maxval: investment_value,
		  messages: {
					required: lisa_alert_msg
				},
				
		});
	}

	if($("#invest_all_in_ssisa").is(":checked")){
		var min_amount_lisa = 500;
		 var lisa_alert_msg = "Please enter an amount from \u00A3500, which is the minimum investment for this product.";
		if($("#invest_all_in_lifetime").is(":checked")){
			min_amount_lisa = 500;
		}else{
			min_amount_lisa = investment_value;
			lisa_alert_msg = "The amount you have entered is less than the value of your Child Trust Fund which is \u00A3" + parseFloat(investment_value).toLocaleString() + " but this value may go up if last minute payments are made to your policy";
		}
		$(".invest_all_ssisa").rules("add", { 
		  required:{},
		  minval: [500, investment_value],
		  messages: {
					required: lisa_alert_msg
				},
				
		});
	}
	
	var invest_some_lifetimeisa_tool_id = $(".invest_some_lifetimeisa").attr("aria-describedby");
	if($("#invest_some_in_lifetime").is(":checked")){
		$(".invest_some_lifetimeisa").rules("add", { 
		  required:true,
		  minval_some_investment:500,
		  maxval_some_investment: 4000,
		  messages: {
					required: "Please enter Lifetime investment amount from \u00A3500 up to \u00A34000"
				},
				
		});
	}else{
		$(".invest_some_lifetimeisa").rules("add", { 
		  required:false, 
		});
		
		$("#" + invest_some_lifetimeisa_tool_id).hide();
	}
	
	var invest_some_ssisa_tool_id = $(".invest_some_ssisa").attr("aria-describedby");
	if($(".invest_some_in_ssisa").is(":checked")){
		$(".invest_some_ssisa").rules("add", { 
		  required:true, 
		 minval_some_investment:500,
		   messages: {
					required: "Please enter an amount from \u00A3500, which is the minimum investment for this product"
				},
				
		});
	}else{
		$(".invest_some_ssisa").rules("add", { 
		  required:false, 
		});
		
		$("#" + invest_some_ssisa_tool_id).hide();
	}
	

});

$("body").on('click', '#update_payment_details', function () {
	var curObj = $(this);
	var d_step = $(this).attr('data-step');
	
	$("#frmpaymentoption").validate({
		rules: {
			account_holder_name: { required: true},
			account_number: { required: true},
			account_sort_code: { required: true},
		},
		 messages: {
			account_holder_name: "Please enter account holder name",
			account_number: "Please enter account number",
			account_sort_code: "Please enter sort code",
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
				url: base_url + 'ctfm/update_payment_details/',
				type: 'POST',
				dataType: 'json',
				data: $(form).serialize(),
				success: function (response) {
					if (!response.status) {
						salert("Error", "Error", response.msg);
						unblockUI($("#frmpaymentoption"));
					} else {
						
						$("#pgbar").html(response.data.progressbar);
						
						$("#payment_option_section").addClass("hide");
						$("#your_identity_section").removeClass("hide");
						$("#your_identity_section .backbtn").attr("data-step", 4);
						
						$(".summary_payment_box").removeClass("hide");
						$(".summary_payment_options").removeClass("hide");
						$(".summary_payment_options").html(response.data.summary_payment_options_view);
						
						$('html, body').animate({
							scrollTop: $("body").offset().top
						}, 2000);
						
						unblockUI($("#frmpaymentoption"));
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

$("#ctfm_index").on("click", ".summary_edit", function(){
	var steps = $(this).attr("data-step");
	var type = $(this).attr("data-type");
	$.ajax({
		url : base_url + 'ctfm/edit_summary/',
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




$("body").on("click", "#next5", function(){
	$("#frmsummary").validate({
		rules: {
			summary_accept_maturity_terms: { required: true},
			summary_accept_terms_lisa: { required: true},
			summary_accept_terms_ssisa: { required: true},
		},
		 messages: {
			summary_accept_maturity_terms: "Please tick before submitting your application",
			summary_accept_terms_lisa: "Please read and tick to confirm you have understood the Lifetime ISA declaration and documents provided",
			summary_accept_terms_ssisa: "Please read and tick to confirm you have understood the Stocks & Shares ISA declaration and documents provided",

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
		//	blockUI("#summary_section");
			$.ajax({
				url : base_url + 'ctfm/submit_application/',
				type: 'POST',
				dataType: 'json',
				data: {step: 4},
				success: function (response) {
					if (!response.status) {
						salert('error', response.msg, '', response.loc);
						unblockUI("#summary_section");
					}else{
						if(response.payment){
							sconfirm("Re-directing to payment page","You will be redirected to WorldPay Online payment gateway.", "worldpay_redirect()", "","","success");
							
						}else{
							$("#pgbar").html(response.data.progressbar);
							$("#summary_section").addClass("hide");
							$("#customer_ref_number").text(response.data.customer_app_id);
							$("#confirmation_section").removeClass("hide");
							unblockUI("#summary_section");
						}
					}
				}
			});
		}
	});	
});

$("body").on("click", ".list_class_a_help", function(){
	$(".list_a_documents").slideToggle(500);
});

$("body").on("click", ".list_class_b_help", function(){
	$(".list_b_documents").slideToggle(500);
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
		$(".HeardAboutUs_extra").attr("Placeholder","Please tell us where");
	}else{
		$(".HeardAboutUs_extra").val('');
		$(".HeardAboutUs_extra").hide();
		$(".HeardAboutUs_extra").next(".error").hide();
	}
 });



});

function check_payment_limit()
{
		salert("warning", "Fund Limit", "As you have chosen more than one payment option, please make sure the overall amount does not exceed the annual ISA limit. <span style='color: #f4b600'>This includes transfers, and for the LISA applies even if the funds being transferred were invested in a previous tax year.</span><br>Click 'OK' to close this message and continue your application.");
		return false;

}

function worldpay_redirect()
{
	location.href = base_url + "ctfm/submit_worldPay";
}



