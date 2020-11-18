<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";
if($personal_details['address1'] !="")
	$address .= $personal_details['address1'];

if($personal_details['address2'] !="")
	$address .= "<br>".$personal_details['address2'];
	
if($personal_details['town'] !="")
	$address .= "<br>".$personal_details['town'];

if($personal_details['county'] !="")
	$address .= "<br>".$personal_details['county'];
	
if($personal_details['postcode_box'] !="")
	$address .= "<br>".$personal_details['postcode_box'];

$old_address = "";	
$old_address_change = "No";
if(isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == "1"){
	$old_address_change = "Yes";
	
$old_address .= '<div class="col-md-3"><label>Old Address</label></div>
                                <div class="col-md-9 font-weight-bold"><label>';
								
if($personal_details['additional_address1'] !="")
	$old_address .= $personal_details['additional_address1'];

if($personal_details['additional_address2'] !="")
	$old_address .= "<br>".$personal_details['additional_address2'];
	
if($personal_details['additional_town_city'] !="")
	$old_address .= "<br>".$personal_details['additional_town_city'];

if($personal_details['additional_county'] !="")
	$old_address .= "<br>".$personal_details['additional_county'];
	
if($personal_details['additional_postcode_box'] !="")
	$old_address .= "<br>".$personal_details['additional_postcode_box'];	

$old_address .= '</label></div>';		
}


?>
<div class="row bg-light">      
                                <div class="col-md-3"><label>Name</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=($personal_details['title']=="Other")?$personal_details['other_title']:$personal_details['title'];?> <?=$personal_details['first_name']?> <?=$personal_details['last_name']?></label></div>
                                <div class="col-md-3"><label>Date of birth</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($personal_details['dob_day'].'-'.$personal_details['dob_month'].'-'.$personal_details['dob_year']))?></label></div>
                                <div class="col-md-3"><label>National Insurance number</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=strtoupper($personal_details['NI1'] .' '. $personal_details['NI2'].' '. $personal_details['NI3'].' '.$personal_details['NI4'].' '.$personal_details['NI5'])?></label></div>
                                <div class="col-md-3"><label>Phone</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$personal_details['phone']?></label></div>
                                <div class="col-md-3"><label>Email</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$personal_details['email']?></label></div>
                                <?php if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){?>
                                <div class="col-md-3"><label>Existing Tax Exempt Savings Plan Policy Number</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$personal_details['toptup_policy_number']?></label></div>
                                <?php }?>
                                <div class="col-md-3"><label>Address</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                                <div class="col-md-3"><label>Have you changed address in the last 3 months?</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$old_address_change?></label></div>
                                <?=$old_address?>
                                <div class="col-md-3"><label>How did you hear about us? (Optional)</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=pois_get_how_did_you_hear_aboutus($personal_details['HeardAboutUs'])?><?=($personal_details['HeardAboutUs_extra'] != "")?"<br>" . $personal_details['HeardAboutUs_extra']:"";?></label></div>
                                <div class="col-md-3"><label>Offer code (Optional)</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$personal_details['offer_code']?></label></div>
                                
                            </div>