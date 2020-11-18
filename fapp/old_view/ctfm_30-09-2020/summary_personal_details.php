<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";
if($personal_details->address1 !="")
	$address .= $personal_details->address1;

if($personal_details->address2 !="")
	$address .= "<br>".$personal_details->address2;
	
if($personal_details->town !="")
	$address .= "<br>".$personal_details->town;

if($personal_details->county !="")
	$address .= "<br>".$personal_details->county;
	
if($personal_details->postcode !="")
	$address .= "<br>".$personal_details->postcode;

if(isset($personal_details->ni_number)){
		$ni_number = @explode(" ",@$personal_details->ni_number);
	}
	
if(isset($personal_details->dob)){
		$dob = @explode("-",@$personal_details->dob);
	}
	
?>
                <div class="row bg-light">      
                    <div class="col-md-3"><label>Name</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$personal_details->title;?> <?=$personal_details->first_name?> <?=$personal_details->last_name?></label></div>
                    <div class="col-md-3"><label>Date of birth</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($dob[2].'-'.$dob[1].'-'.$dob[0]))?></label></div>
                    <div class="col-md-3"><label>National Insurance number</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=strtoupper(@$personal_details->ni_number)?></label></div>
                    <div class="col-md-3"><label>Phone</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$personal_details->phone?></label></div>
                    <div class="col-md-3"><label>Email</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$personal_details->email?></label></div>
                    <div class="col-md-3"><label>Child Trust Fund Unique Reference Number</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$personal_details->uniqueID?></label></div>
                    <div class="col-md-3"><label>Foresters Friendly Society Child Trust Fund policy number</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$personal_details->policy_number?></label></div>
                    <div class="col-md-3"><label>Address</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                </div>