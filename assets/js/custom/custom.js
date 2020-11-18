$(document).ready(function(){

var IDLE_TIMEOUT = 900; //seconds
var _idleSecondsTimer = null;
var _idleSecondsCounter = 0;

document.onclick = function() {
    _idleSecondsCounter = 0;
};

document.onmousemove = function() {
    _idleSecondsCounter = 0;
};

document.onkeypress = function() {
    _idleSecondsCounter = 0;
};

_idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
     _idleSecondsCounter++;
     var oPanel = document.getElementById("SecondsUntilExpire");
     if (oPanel)
         oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        window.clearInterval(_idleSecondsTimer);
        salert('warning', "Session Timed out", "To protect your personal information and for your security, this application has timed out.<br>We apologise for any inconvenience, please click OK to re-start your application.", location.href);
    }
}


$('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });

$('.select2').change(function(){
	if($(this).hasClass('dob_day') || $(this).hasClass('dob_month') || $(this).hasClass('dob_year'))
	{
		if($('.dob_day').val() !="" && $('.dob_month').val() !="" && $('.dob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('cdob_day') || $(this).hasClass('cdob_month') || $(this).hasClass('cdob_year'))
	{
		if($('.cdob_day').val() !="" && $('.cdob_month').val() !="" && $('.cdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('pdob_day') || $(this).hasClass('pdob_month') || $(this).hasClass('pdob_year'))
	{
		if($('.pdob_day').val() !="" && $('.pdob_month').val() !="" && $('.pdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('fdob_day') || $(this).hasClass('fdob_month') || $(this).hasClass('fdob_year'))
	{
		if($('.fdob_day').val() !="" && $('.fdob_month').val() !="" && $('.fdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('apl_dob_day') || $(this).hasClass('apl_dob_month') || $(this).hasClass('apl_dob_year'))
	{
		if($('.apl_dob_day').val() !="" && $('.apl_dob_month').val() !="" && $('.apl_dob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else{
		$(this).parent().find('.error').hide();
	}
});

$('#personal_profile_section, #child_profile_section, #beneficiary_profile_section').on("change",".select2", function(){
	if($(this).hasClass('dob_day') || $(this).hasClass('dob_month') || $(this).hasClass('dob_year'))
	{
		if($('.dob_day').val() !="" && $('.dob_month').val() !="" && $('.dob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('cdob_day') || $(this).hasClass('cdob_month') || $(this).hasClass('cdob_year'))
	{
		if($('.cdob_day').val() !="" && $('.cdob_month').val() !="" && $('.cdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('pdob_day') || $(this).hasClass('pdob_month') || $(this).hasClass('pdob_year'))
	{
		if($('.pdob_day').val() !="" && $('.pdob_month').val() !="" && $('.pdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('apl_dob_day') || $(this).hasClass('apl_dob_month') || $(this).hasClass('apl_dob_year'))
	{
		if($('.apl_dob_day').val() !="" && $('.apl_dob_month').val() !="" && $('.apl_dob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else if($(this).hasClass('bdob_day') || $(this).hasClass('bdob_month') || $(this).hasClass('bdob_year'))
	{
		if($('.bdob_day').val() !="" && $('.bdob_month').val() !="" && $('.bdob_year').val() !="")
		{
			$(this).parent().find('.error').hide();	
		}
			
	}else{
		$(this).parent().find('.error').hide();
	}
});

$('#payment_option_section').on("change",".EmployementStatus, .money_investment_source ", function(){
		$(this).parent().find('.error').hide();
});

$("body").on("change", "select[name='title']", function(){
	if($(this).val() == "Other")
		$(".other_title").removeClass("hide");
	else
		$(".other_title").addClass("hide");
});

$("#summary_section").on("change", ".title", function(){
	if($(this).val() == "Other")
		$(".other_title").removeClass("hide");
	else
		$(".other_title").addClass("hide");
});

$("#child_profile_section").on("change", ".parent_title", function(){
	if($(this).val() == "Other")
		$(".parent_other_title").removeClass("hide");
	else
		$(".parent_other_title").addClass("hide");
});

$(".view_applicant_section").on("change", "select[name='applicant_title']", function(){
	if($(this).val() == "Other")
		$(".applicant_other_title").removeClass("hide");
	else
		$(".applicant_other_title").addClass("hide");
});

$("#beneficiary_profile_section").on("change", ".beneficiary_title", function(){
	if($(this).val() == "Other")
		$(".beneficiary_other_title").removeClass("hide");
	else
		$(".beneficiary_other_title").addClass("hide");
});

$("#payment_option_section").on("change", ".third_party_title", function(){
	if($(this).val() == "Other")
		$(".third_party_other_title").removeClass("hide");
	else
		$(".third_party_other_title").addClass("hide");
});

$('body').on("keypress keyup", "#phone, .phone",function(e) {
	$(this).attr('minlength', '10');
	$(this).attr('maxlength', '12');
	e = e || window.event;
	var charCode = typeof e.which === "undefined" ? e.keyCode : e.which;
	var charStr = String.fromCharCode(charCode);
	if (/[0-9]/.test(charStr)) {
		$(this).val($(this).val().replace(/^(\d{5})(\d{6})/, "$1 $2"));
		return true;
	}
	return false;
    
});

$(".ni-segment").on("keypress keyup",  function(){
	niValidation();
});

$('body').on('blur', '#monthly_innvest_amount, #lumpsum_innvest_amount, #beneficiary_amount',function(e){
	var t = $(this).val();
  	var entered_amount = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + ".00") : t; //t.substr(t.indexOf("."), 3)
   	$(this).val(entered_amount);
});



$('body').on('keypress', '.account_number', function (e) {
    var regex = new RegExp("^[0-9/]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
});

$('body').on('keypress keyup','.cvv_sort_code',function(e) {
	var regex = new RegExp("^[0-9]{1,8}$");
		var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(strigChar)) {
    		format_sort_code(this);
			return true;
		}
	return false;	
});


$("#payment_option_section").on("click", "#accept_account_holder_terms", function(){

	if($(this).is(":checked"))
	{
		$("#payment_option_section .third_party_box").removeClass("hide");
	}else{
		$("#payment_option_section .third_party_box").addClass("hide");
	}
});

/*$("#summary_accept_terms").on("click", function(){

		if ($(this).is(":checked")) {
			$('#next5').prop('disabled', false);
        } else {
			$('#next5').prop('disabled', true);
        }	
})*/

$("#summary_product_guid_terms").on("click", function(){
	if($(this).is(":checked")){
		$('#next4').prop('disabled', false);
		$('#next5').prop('disabled', false);
	}else
	{
		$('#next4').prop('disabled', true);
		$('#next5').prop('disabled', true);

		}
});



$('.radio-group .radio').click(function(){
$('.selected .fa').removeClass('fa-check');
$('.selected .fa').addClass('fa-circle');
$('.radio').removeClass('selected');
$(this).addClass('selected');
$('.selected .fa').removeClass('fa-circle');
$('.selected .fa').addClass('fa-check');
});

$("#next6").click(function (){
	$("li#done").addClass("active");
})

$('[data-toggle="tooltip"]').tooltip();
  

$.validator.addMethod("check_min_date_of_birth", function(value, element, params) {
	var day = params[0];
    var month = params[1];
    var year = params[2];
    var minage =  params[3];
	var maxage =  params[4];
	
	
    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);

    var minAge = new Date();
    minAge.setFullYear(minAge.getFullYear() - minage);
	
	var maxAge = new Date();
    maxAge.setFullYear(maxAge.getFullYear() - maxage);

	if(minAge < mydate)
		return false;
	else if(maxAge > mydate)
		return false;
	else
		return true;

}, "You must be 18-39 to apply for the Lifetime ISA.");

$.validator.addMethod("check_tesp_date_of_birth", function(value, element, params) {
	var day = params[0];
    var month = params[1];
    var year = params[2];
    var minage =  params[3];
	var maxage =  params[4];
	
	
    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);

    var minAge = new Date();
    minAge.setFullYear(minAge.getFullYear() - minage);
	
	var maxAge = new Date();
    maxAge.setFullYear(maxAge.getFullYear() - maxage);

	if(minAge < mydate)
		return false;
	else if(maxAge > mydate)
		return false;
	else
		return true;

}, "You must be 18-80 to apply for the TESP ISA.");

$.validator.addMethod("check_ctesp_child_date_of_birth", function(value, element, params) {
	var day = params[0];
    var month = params[1];
    var year = params[2];
    var minage =  params[3];
	
	
    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);

    var minAge = new Date();
    minAge.setFullYear(minAge.getFullYear() - minage);

	if(minAge > mydate)
		return false;
	else
		return true;

}, "The child must be under 16 to apply for the Child Tax Exempt Savings Plan");

$.validator.addMethod("check_min_maturity_terms", function(value, element, params) {
	var terms_years = params[0];
	var day = params[1];
    var month = params[2];
    var year = params[3];
    var minage =  params[4];
	var maxage =  params[5];
	
	
    var mydate = new Date();
	var today_date = mydate.getDate();
	
	mydate.setFullYear(year, month-1, day);

	var minAge = new Date();
    minAge.setFullYear(minAge.getFullYear() + minage);

	var maxAge = new Date();
    maxAge.setFullYear(maxAge.getFullYear() + maxage);

	if(terms_years == false){
		if(minAge > mydate)
			return false;
		else if(maxAge < mydate)
			return false;
		else
			return true;
	}else
		return true;

}, "Please select a specific maturity date between 10 years to 25 years"); 

$.validator.addMethod("tesp_min_maturity_terms", function(value, element, params) {
	var terms_years = params[0];
	var day = params[1];
    var month = params[2];
    var year = params[3];
    var minage =  params[4];
	var maxage =  params[5];
	
	
    var mydate = new Date();
	var today_date = mydate.getDate();
	
	mydate.setFullYear(year, month-1, day);
	
    var minAge = new Date();
	if(today_date <= 15)
    	minAge.setFullYear(minAge.getFullYear() + minage, minAge.getMonth() + 1, 1);
	else	
		minAge.setFullYear(minAge.getFullYear() + minage, minAge.getMonth() + 2, 1);	
		
	console.log(minAge);
	
	var maxAge = new Date();
	if(today_date <= 15)
    	maxAge.setFullYear(maxAge.getFullYear() + maxage, minAge.getMonth(), 0);
	else
		maxAge.setFullYear(maxAge.getFullYear() + maxage, minAge.getMonth(), 0);
		
	console.log(maxAge);	

	if(terms_years == false){
		if(minAge > mydate)
			return false;
		else if(maxAge < mydate)
			return false;
		else
			return true;
	}else
		return true;

}, "Please select a specific maturity date between 10 years to 25 years");

$.validator.addMethod("check_maturity_date", function(value, element, params) {
    var year = params[0];
    var min_year =  params[1];
	var max_year =  params[2];
	
	
    var mydate = new Date();
    mydate.setFullYear(year);

    var minYear = new Date();
    minYear.setFullYear(minYear.getFullYear() - min_year);
	
	var maxYear = new Date();
    maxYear.setFullYear(maxYear.getFullYear() - max_year);

	if(minYear < mydate)
		return false;
	else if(maxYear > mydate)
		return false;
	else
		return true;

}, "Please select valid date."); 
$.validator.addMethod("ctesp_min_maturity_terms", function(value, element, params) {
	var terms_years = params[0];
	var day = params[1];
    var month = params[2];
    var year = params[3];
    var minage =  params[4];
	var maxage =  params[5];
	
	
    var mydate = new Date();
	var today_date = new Date();
	
	mydate.setFullYear(year, month-1, day);
	var minAge = new Date(minage);
	
	var get_maturity_year_diff = date_diff(minage, today_date);
    minAge.setFullYear(minAge.getFullYear());
	var maxAge = new Date();
    maxAge.setFullYear(maxAge.getFullYear() + maxage);

	if(terms_years == false){
		if(minAge > mydate)
			return false;
		else if(maxAge < mydate)
			return false;
		else
			return true;
	}else
		return true;

}, "Please select a specific maturity date between 10 years to 25 years"); 

$.validator.methods.min = function (value, element, param)
{
	var globalizedValue = value.replace(",", "");
	return this.optional(element) || globalizedValue >= param;
}

$.validator.methods.max = function (value, element, param) {
	var globalizedValue = value.replace(",", "");
	return this.optional(element) || globalizedValue <= param;
} 

$.validator.addMethod('checkAllNI', function(value, element, params) {
    var field_1 = $('input[name="' + params[0] + '"]').val(),
     field_2 = $('input[name="' + params[1] + '"]').val(),
		field_3 = $('input[name="' + params[2] + '"]').val(),
		field_4 = $('input[name="' + params[3] + '"]').val(),
		field_5 = $('input[name="' + params[4] + '"]').val();
    if(field_1 == "" || field_2 == "" || field_3 == "" || field_4 == "" || field_5 == "")
		return false;
	else if(field_1.length < 2 || field_2 < 2 || field_3 < 2 || field_4 < 2)
		return false;
	else
		return true;
		
}, "Please enter your National Insurance number");

$.validator.addMethod('checkChildNI', function(value, element, params) {
    var field_1 = $('#child_profile_section input[name="' + params[0] + '"]').val(),
     field_2 = $('#child_profile_section input[name="' + params[1] + '"]').val(),
		field_3 = $('#child_profile_section input[name="' + params[2] + '"]').val(),
		field_4 = $('#child_profile_section input[name="' + params[3] + '"]').val(),
		field_5 = $('#child_profile_section input[name="' + params[4] + '"]').val();
    if(field_1 == "" || field_2 == "" || field_3 == "" || field_4 == "" || field_5 == "")
		return false;
	else
		return true;
		
}, "Please enter your National Insurance number");

$.validator.addMethod('checkdateofbirth', function(value, element, params) {
    var dob_day = $('select[name="' + params[0] + '"]').val(),
     dob_month = $('select[name="' + params[1] + '"]').val(),
		dob_year = $('select[name="' + params[2] + '"]').val();
    if(dob_day == "" || dob_month == "" || dob_year == "")
		return false;
	else
		return true;
		
}, "Please select your date of birth");

$.validator.addMethod('checkChilddateofbirth', function(value, element, params) {
    var dob_day = $('#child_profile_section select[name="' + params[0] + '"]').val(),
     dob_month = $('#child_profile_section select[name="' + params[1] + '"]').val(),
		dob_year = $('#child_profile_section select[name="' + params[2] + '"]').val();
    if(dob_day == "" || dob_month == "" || dob_year == "")
		return false;
	else
		return true;
		
}, "Please select child's date of birth");

$.validator.addMethod('checkBeneficiarydateofbirth', function(value, element, params) {
    var dob_day = $('#beneficiary_profile_section select[name="' + params[0] + '"]').val(),
     dob_month = $('#beneficiary_profile_section select[name="' + params[1] + '"]').val(),
		dob_year = $('#beneficiary_profile_section select[name="' + params[2] + '"]').val();
    if(dob_day == "" || dob_month == "" || dob_year == "")
		return false;
	else
		return true;
		
}, "Please select beneficiary's date of birth");

$.validator.addMethod('checkMaturityTermYear', function(value, element, params) {
	var mt_terms = $('#frmplandetails select[name="' + params[0] + '"]').val(),
	mt_day = $('#frmplandetails select[name="' + params[1] + '"]').val(),
	mt_month = $('#frmplandetails select[name="' + params[2] + '"]').val(),
	mt_year = $('#frmplandetails select[name="' + params[3] + '"]').val();
    if((mt_terms == false) && (mt_day == false || mt_month == false || mt_year == false)){
		return false;
	}else if((mt_terms != false) && (mt_day != false && mt_month != false && mt_year != false)){
		return false;
	}else{
		return true;
	}
}, "Please select a Term in years OR a specific maturity date");



$.validator.addMethod('check_heard_aboutus_introducer', function(value) {
	var match_val = value.substr(0,3);
	var match_val_upper = match_val.toUpperCase();
	
	if(match_val_upper == "INT"){
		return true;
	}else {
		return false;
	}
}, "Introducer number must start with INT");

$.validator.addMethod('check_heard_child_trust_fund_top_up', function(value, element, params) {
	var match_val = value.substr(0,4);
	var number_val = value.substr(4,11);
	var match_val_upper = match_val.toUpperCase();
	if((match_val_upper == "CTFE" || match_val_upper == "CTF0")  && (number_val.length==7 && !isNaN(number_val))){
		return true;
	}else{
		return false;
	}
}, "Introducer number must start with CTFE, CTF0 then have a seven digit number.");

});

function format_sort_code (element) {
	var codeVal = $(element).val().split('-').join('');
	var finalVal = codeVal.match(/.{1,2}/g).join('-'); 
	$(element).val(finalVal);
}
	
function check_required()
{
	 var empty_flds = 0;
	  $("#frmyourdetails .required").each(function() {
		if(!$.trim($(this).val())) {
			empty_flds++;
		}    
	  });
	  if (empty_flds) {
		$('#next2').prop("disabled", true);	
	  } else {
		$('#next2').prop("disabled", false);	
	  }	

}

function niValidation() {
        $('body').on('keypress keyup', '#NI1', function (e) {
            e = e || window.event;
            var charCode = typeof e.which === "undefined" ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            if (/[a-zA-Z]/.test(charStr)) {
                return true;
            }

            return false;
        });

        $('body').on('keyup', '#NI1', function (e) {
            switch (e.keyCode) {
                case 9:
                case 16:
                    return false;
                default:
                    if ($(this).val().length === 2) {
                        $('#NI2').focus();
                    }
                    break;
            }
        });
        $('body').on('keyup', '#NI2', function (e) {
            switch (e.keyCode) {
                case 9:
                case 16:
                    return false;
                default:
                    if ($(this).val().length === 2) {
                        $('#NI3').focus();
                    }
                    break;
            }
        });
        $('body').on('keyup', '#NI3', function (e) {
            switch (e.keyCode) {
                case 9:
                case 16:
                    return false;
                default:
                    if ($(this).val().length === 2) {
                        $('#NI4').focus();
                    }
                    break;
            }
        });
        $('body').on('keyup', '#NI4', function (e) {
            switch (e.keyCode) {
                case 9:
                case 16:
                    return false;
                default:
                    if ($(this).val().length === 2) {
                        $('#NI5').focus();
                    }
                    break;
            }
        });

        $('body').on('keypress', '#NI5', function (e) {
            e = e || window.event;
            var charCode = typeof e.which === "undefined" ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            switch (e.keyCode) {
                case 16:
                case 9:
                    return false;
                default:
                    if (/[a-dA-D]/.test(charStr)) {
                        return true;
                    }
                    return false;
            }
        });

        $('body').on('keypress', '#NI2, #NI3, #NI4', function (e) {

            e = e || window.event;
            var charCode = typeof e.which === "undefined" ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            if (/\d/.test(charStr)) {
                return true;
            }

            return false;
        });
    }
	
/*afdOptions = {
    id: "1757",
    token: "+aE2pGiR7oRpArZdgmqlz7EOHhxBWitByjEHO+d9Rzg=ht",
	pceUrl: "http://apps.afd.co.uk/json"
};*/

afdOptions = {
  pceUrl: typeof pceUrl === 'undefined' ? 'https://apps.afd.co.uk/json' : pceUrl,
		id: "1757",
		token: "+aE2pGiR7oRpArZdgmqlz7EOHhxBWitByjEHO+d9Rzg=ht",
        nativeValidationMessages: false,       
		typeahead: {
            maxItems: 5,
            pushUp: true,
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
			containers: ['#new_address','#old_address', '#child_address_area', '#parent_address_area', '#applicant_address_area', '#beneficiary_address_area']
        },
        lookup: {
            prefetch: true,
            pushUp:true,
            parentClass: 'afd-input-group',
            hideEmpties: false,
            beforeHideResults: false,
            afterRetrieveHideResultsList: true,
            manualInputButton: false,
            postcodeFirst: true
        }
};


function init_select_box()
{
	$('select').each(function () {
	$(this).select2({
	  theme: 'bootstrap4',
	  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
	  placeholder: $(this).attr('placeholder'),
	  allowClear: Boolean($(this).data('allow-clear')),
	});
  });	
}

function date_diff(dt1, dt2) {
 var diff =(dt2.getTime() - dt1.getTime()) / 1000;
   diff /= (60 * 60 * 24);
  return Math.abs(Math.floor(diff/365));
}

