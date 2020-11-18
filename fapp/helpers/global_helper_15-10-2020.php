<?php
/**
 * global_helper short summary.
 *
 * global_helper description.
 *
 * @version 1.0
 * @author Kanchan
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function personal_details()
{
	$personal_details = array();
	$personal_details['address1'] = '';
	$personal_details['address2'] = '';
	$personal_details['town'] = '';
	$personal_details['county'] = '';
	$personal_details['postcode_box'] = '';
	$personal_details['old_address_change'] = '';
	$personal_details['additional_address1'] = '';
	$personal_details['additional_address2'] = '';
	$personal_details['additional_town_city'] = '';
	$personal_details['additional_county'] = '';
	$personal_details['additional_postcode_box'] = '';
	$personal_details['HeardAboutUs_extra']='';
	$personal_details['toptup_policy_number']='';
	return $personal_details;
}

function payment_options()
{
	$payment_options = array();
	$payment_options['choose_payment_option'] = '';
	$payment_options['monthly_innvest_amount'] = '';
	$payment_options['monthly_account_holder_name'] = '';
	$payment_options['monthly_account_number'] = '';
	$payment_options['monthly_account_sort_code'] = '';
	$payment_options['choose_payment_option'] = '';
	$payment_options['lumpsum_innvest_amount'] = '';
	$payment_options['choose_payment_option_monthly'] = 0;
	$payment_options['choose_payment_option_lumpsum'] = 0;
	$payment_options['choose_payment_option_transfer'] = 0;
	$payment_options['ISA_transfer_option'] = 0;
	$payment_options['transfer_name_existing_provider'] = '';
	$payment_options['transfer_postcode'] = '';
	$payment_options['transfer_address1'] = '';
	$payment_options['transfer_address2'] = '';
	$payment_options['transfer_city'] = '';
	$payment_options['transfer_county'] = '';
	$payment_options['transfer_postcode_box'] = '';
	$payment_options['transfer_account_number'] = '';
	$payment_options['transfer_accont_sort_code'] = '';
	$payment_options['transfer_account_reference'] = '';
	$payment_options['type_of_ISA'] = '';
	$payment_options['hmrc_lisa_registration_number'] = '';
	$payment_options['payment_transfer_option'] = '';
	$payment_options['full_transfer_amount'] = '';
	$payment_options['EmployementStatus'] = '';
	$payment_options['EmployementStatus_extra'] = '';
	$payment_options['money_investment_source'] = '';
	$payment_options['money_investment_source_extra'] = '';
	$payment_options['lumpsumEmployementStatus'] = '';
	$payment_options['lumpsumEmployementStatus_extra'] = '';
	$payment_options['lumpsum_money_investment_source'] = '';
	$payment_options['lumpsum_money_investment_source_extra'] = '';
	return $payment_options;
}

function child_details()
{
	$child_details = array();
	$child_details['title'] = '';
	$child_details['first_name'] = '';
	$child_details['last_name'] = '';
	$child_details['cdob_day'] = '';
	$child_details['cdob_month'] = '';
	$child_details['cdob_year'] = '';
	$child_details['NI1'] = '';
	$child_details['NI2'] = '';
	$child_details['NI3'] = '';
	$child_details['NI4'] = '';
	$child_details['NI5'] = '';
	$child_details['address1'] = '';
	$child_details['address2'] = '';
	$child_details['town'] = '';
	$child_details['county'] = '';
	$child_details['postcode_box'] = '';
	$child_details['postcode'] = '';
	$child_details['parent_title'] = '';
	$child_details['parent_other_title'] = '';
	$child_details['parent_first_name'] = '';
	$child_details['parent_last_name'] = '';
	$child_details['parent_phone'] = '';
	$child_details['parent_email'] = '';
	$child_details['parent_cemail'] = '';
	$child_details['parent_accept_terms'] = 0;
	$child_details['parent_address1'] = '';
	$child_details['parent_address2'] = '';
	$child_details['parent_town'] = '';
	$child_details['parent_county'] = '';
	$child_details['parent_postcode'] = '';
	$child_details['parent_postcode_box'] = '';
	
	return $child_details;
}

function applicant_details()
{
	$applicant_details = array();
	$applicant_details['applicant_title'] = '';
	$applicant_details['applicant_other_title'] = '';
	$applicant_details['first_name'] = '';
	$applicant_details['last_name'] = '';
	$applicant_details['apl_dob_day'] = '';
	$applicant_details['apl_dob_month'] = '';
	$applicant_details['apl_dob_year'] = '';
	$applicant_details['applicant2_phone'] = '';
	$applicant_details['applicant2_email'] = '';
	$applicant_details['applicant2_cemail'] = '';
	$applicant_details['address1'] = '';
	$applicant_details['address2'] = '';
	$applicant_details['town'] = '';
	$applicant_details['county'] = '';
	$applicant_details['postcode_box'] = '';
	$applicant_details['postcode'] = '';

	
	return $applicant_details;
}

function plan_details()
{
	$plan_details = array();
	$plan_details['specific_matuarity_year'] = '';
	$plan_details['terms_in_years'] = '';
	$plan_details['specific_matuarity_day'] = '';
	$plan_details['specific_matuarity_month'] = '';
	return $plan_details;
}

function policy_type_details()
{
	$policy_type = array();
	$policy_type['policy_type'] = '';
	return $policy_type;
}

function list_title()
{
	return array(""=>"Title", "Mr"=>"Mr", "Mrs"=>"Mrs", "Ms"=>"Ms", "Miss"=>"Miss", "Dr"=>"Dr", "Other"=>"Other");
}

function ctfm_list_title()
{
	return array(""=>"Title", "Mr"=>"Mr", "Mrs"=>"Mrs", "Ms"=>"Ms", "Miss"=>"Miss", "Master"=>"Master", "Dr"=>"Dr", "Other"=>"Other");
}

function list_month()
{
	return array(""=> "Month", 1=>"January", 2=>"February", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October",11=>"November", 12=>"December");
}

function list_maturity_month()
{
	return array(" "=> "Month", 1=>"January", 2=>"February", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October",11=>"November", 12=>"December");
}

function list_how_did_you_hear_aboutus()
{
	return array(""=> "Please select", "Mailing"=>"Foresters mailing", "EME"=>"I am an existing member", "Press"=>"Press article/advert", "Search Engine"=>"Search engine (eg. Google)", "Court Ref"=>"Referral from a Foresters Branch", "Referral"=>"Referral from a Foresters Member", "Introducer"=>"Introducer", "SocMe"=>"Social Media", "Other"=>"Other", "Website Other"=>"Other Website");
}

function get_how_did_you_hear_aboutus($value)
{
	$list_value = list_how_did_you_hear_aboutus();
	
	if(array_key_exists($value, $list_value))
		return $list_value[$value];
	else
		return $value;	
}



function get_introducer_value($value = "")
{
	$initial_value = substr($value, 0, 5);
	if(strtoupper($initial_value) == "INTPR")
		return "INT";
	elseif(strtoupper($initial_value) == "INTEM")
		return "EMINT";
	elseif(strtoupper($initial_value) == "INTBR")
		return "BR-INT";
	else
		return '';	
				
}

function get_marketing_source_code($value, $extra_value = "")
{
	if($value == "Introducer")
		return get_introducer_value($extra_value);
	else
		return $value;	
}

function employement_status()
{
	return array(""=>"Please select", "Employed"=>"Employed", "Self Employed"=>"Self Employed", "Unemployed"=>"Unemployed", "Other"=>"Other");
}

function money_investment_source()
{
	return array(""=>"Please select", "Inheritance"=>"Inheritance", "Divorce Settlement"=>"Divorce Settlement", "Property Sale"=>"Property Sale", "Other"=>"Other");
}

function list_id_proof_type()
{
	return array(""=> "ID Proof","UK Passport"=> "UK Passport", "EU/EEA Passport"=>"EU/EEA Passport", "Non UK/Non EU Passport"=>"Non UK/Non EU Passport", "Photocard Provisional / Full  Driving Licence"=>"Photocard Provisional / Full  Driving Licence", "Photocard Motorcycle Licence"=>"Photocard Motorcycle Licence", "PASS Card"=>"PASS Card");
}

function list_address_proof_type()
{
	return array(""=> "Address Proof","UK Birth/Adoption Certificate"=> "UK Birth/Adoption Certificate", "Bank/Building Society Statement"=>"Bank/Building Society Statement", "Utility Bill"=>"Utility Bill", "College/University Letter"=>"College/University Letter", "National Insurance Card"=>"National Insurance Card");
}

function lisa_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish active"><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function ssisa_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish active"><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function jisa_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 5){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish active"><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function tesp_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="plan_details"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish "><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}elseif($step == 5){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="finish active"><a href="#finish" data-toggle="tab" aria-expanded="true">Confirmation</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function ctesp_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
        				<li class="child_details"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
						<li class="plan_details"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
                        <li class="plan_details"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
                        <li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
                        <li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}elseif($step == 5){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
                        <li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}elseif($step == 6){
		$steps_html .= '<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="child_details active"><a href="#child_details" data-toggle="tab" aria-expanded="false" >Child details</a></li>
                        <li class="plan_details active"><a href="#plan_details" data-toggle="tab" aria-expanded="false" >Plan details</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment options</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}


function ctfm_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}elseif($step == 5){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity active"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}elseif($step == 6){
		$steps_html .= '<li class="your_details active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Unique ID</a></li>
        				<li class="child_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="your_choice active"><a href="#your_choice" data-toggle="tab" aria-expanded="false" >Make your choice</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="your_identity active"><a href="#your_identity" data-toggle="tab" aria-expanded="false">Your identity</a></li>
						<li class="summary active"><a href="#declaration" data-toggle="tab" aria-expanded="false">Declaration</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function bond_steps_pregressbar($step=1)
{
	$steps_html = '<ul class="nav nav-tabs wizard" id="progressbar">';
	if($step == 1){
		$steps_html .= '<li class="policy_type active"><a href="#policy_type" data-toggle="tab" aria-expanded="false" >Policy type</a></li>
						<li class="your_details"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="applicant_details"><a href="#applicant_details" data-toggle="tab" aria-expanded="false" >Applicant</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="confirmation"><a href="#confirmation" data-toggle="tab" aria-expanded="false">Confirmation</a></li>';
	}elseif($step == 2){
		$steps_html .= '<li class="policy_type active"><a href="#policy_type" data-toggle="tab" aria-expanded="false" >Policy type</a></li>
						<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="applicant_details"><a href="#applicant_details" data-toggle="tab" aria-expanded="false" >Applicant</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="confirmation"><a href="#confirmation" data-toggle="tab" aria-expanded="false">Confirmation</a></li>';
	}elseif($step == 3){
		$steps_html .= '<li class="policy_type active"><a href="#policy_type" data-toggle="tab" aria-expanded="false" >Policy type</a></li>
						<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="applicant_details active"><a href="#applicant_details" data-toggle="tab" aria-expanded="false" >Applicant</a></li>
						<li class="payment_option"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="confirmation"><a href="#confirmation" data-toggle="tab" aria-expanded="false">Confirmation</a></li>';
	}elseif($step == 4){
		$steps_html .= '<li class="policy_type active"><a href="#policy_type" data-toggle="tab" aria-expanded="false" >Policy type</a></li>
						<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="applicant_details active"><a href="#applicant_details" data-toggle="tab" aria-expanded="false" >Applicant</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="summary"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="confirmation"><a href="#confirmation" data-toggle="tab" aria-expanded="false">Confirmation</a></li>';
	}elseif($step == 5){
		$steps_html .= '<li class="policy_type active"><a href="#policy_type" data-toggle="tab" aria-expanded="false" >Policy type</a></li>
						<li class="your_details active"><a href="#your_details" data-toggle="tab" aria-expanded="false" >Your details</a></li>
						<li class="applicant_details active"><a href="#applicant_details" data-toggle="tab" aria-expanded="false" >Applicant</a></li>
						<li class="payment_option active"><a href="#payment_option" data-toggle="tab" aria-expanded="false">Payment details</a></li>
						<li class="summary active"><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
						<li class="confirmation active"><a href="#confirmation" data-toggle="tab" aria-expanded="false">Confirmation</a></li>';
	}
	$steps_html .= '</ul>';
	
	return $steps_html;
}

function generate_xml($xml_data=array(), $form_name, $filename)
{
	$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
				<ForestersForms>
					<Forms_'.$form_name.'Applications>' 
					. $xml_data .'
					</Forms_'.$form_name.'Applications>
				</ForestersForms>';	
	
	$filepath = CUSTOMER_XML_PATH.DIRECTORY_SEPARATOR.$filename;
	
	if(is_file_exists($filepath))
		@unlink($filepath);
		
	$fp = fopen($filepath,'x');
	fwrite($fp, $xml);
	fclose($fp);	
					
	return $filepath;						
}

function generate_pdf($html, $form_name, $filename, $password="") {
	$CI =& get_instance();
	$CI->load->helper('pdf_helper');
	tcpdf();
	$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	//if($password !="")
		//$obj_pdf->SetProtection(array('print', 'copy', 'modify'), $password, $password, 0, null);
		
		$obj_pdf->SetProtection(array('print', 'copy', 'modify'), PDF_OPEN_PASSWORD, PDF_OPEN_PASSWORD, 0, null);
		
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->SetMargins(10, 10, 10, true);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = $form_name;

	$obj_pdf->AddPage();
	//$content = $CI->load->view('customerpdf/customer_pdf', $html, true);
	$filepath = CUSTOMER_PDF_PATH.DIRECTORY_SEPARATOR.$filename;
	if(isset($filepath) && file_exists($filepath))
		@unlink($filepath);

	
	$obj_pdf->writeHTML($html, true, false, true, false, '');
	$obj_pdf->Output($filepath, 'F');
	
		
	return $filepath;
}

function submit_worldPayGlobal($params, $product_desc="LISA(Lump Sum Investment)", $product_type="LISALUMPSUM", $product_short_desc="LISA lump sum application", $referer_url = WORLD_PAY_LISA_REFER_URL){

		$customer_title = (strtolower($params['personal_details']['title']) =="other")? $params['personal_details']['other_title'] : $params['personal_details']['title'];
		
		$customer_name = $customer_title .' '. $params['personal_details']['first_name'] .' '. $params['personal_details']['last_name'];
		
		echo '<form method="post" action="https://secure-test.worldpay.com/wcc/purchase" id="makePayment" name="fmrWordlPay">
					<input type="hidden" name="testMode" value="100">
					<input type="hidden" name="instId" value="'.WORLDPAY_ACCCONT_ID.'">
					<input type="hidden" name="cartId" value="'.$params['customer_id'].'">
					<input type="hidden" name="amount" value="'.str_replace(",","",$params['payment_details']['lumpsum_innvest_amount']).'">
					<input type="hidden" name="currency" value="GBP">
				
					<input type="hidden" name="desc" value="'. $product_desc .' '.$params['customer_id'].'">
				
					<input type="hidden" name="name" value="'.$customer_name.'">
					<input type="hidden" name="address1" value="'.$params['personal_details']['address1'].'">
					<input type="hidden" name="address2" value="'.$params['personal_details']['address2'].'">
					<input type="hidden" name="town" value="'.$params['personal_details']['town'].'">
					<input type="hidden" name="region" value="'.$params['personal_details']['county'].'">
					<input type="hidden" name="postcode" value="'.$params['personal_details']['postcode_box'].'">
					<input type="hidden" name="country" value="GB">
					<input type="hidden" name="tel" value="'.$params['personal_details']['phone'].'">
					<input type="hidden" name="email" value="'.$params['personal_details']['email'].'">
				
					<input type="hidden" name="MC_UniqueProductID" value="'.$params['customer_id'].'">
					<input type="hidden" name="MC_ProductType" value="'.$product_type.'">
					<input type="hidden" name="MC_ProductShortDesc" value="'.$product_short_desc.'">
					<input type="hidden" name="MC_ReferURL" value="'.base_url($referer_url).'">
					<input type="hidden" name="hideCurrency" value="true">
					<input type="hidden" name="lang" value="en">
					<input type="hidden" name="noLanguageMenu" value="true"></form>
					<script> document.fmrWordlPay.submit();</script>';	
}

function get_age_diff($dob)
{
	$date1 = DateTime::createFromFormat('d/m/Y', $dob);
	$date2 = new DateTime();
	
	$diff = $date1->diff($date2, true);
	return $diff->format('%a');
}

function get_min_age_diff($year=39, $add_days=true, $add_number_of_days=304)
{
	$min_age = date("d/m/Y", strtotime("-$year years"));
	$date1 = DateTime::createFromFormat('d/m/Y', $min_age);
	$date2 = new DateTime();
	
	$diff = $date1->diff($date2, true);
	if($add_days)
		return $diff->format('%a') + $add_number_of_days; // adding 304 days extra to total days
	else
		return $diff->format('%a')	;
}

function get_max_age_diff($year=40)
{
	$min_age = date("d/m/Y", strtotime("-$year years"));
	$date1 = DateTime::createFromFormat('d/m/Y', $min_age);
	$date2 = new DateTime();
	
	$diff = $date1->diff($date2, true);
	return $diff->format('%a');
}