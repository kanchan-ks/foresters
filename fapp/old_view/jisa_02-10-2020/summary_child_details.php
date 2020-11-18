<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);


$address = "";
if(isset($child_details['address1']) && $child_details['address1'] !="")
	$address .= $child_details['address1'];

if(isset($child_details['address2']) &&  $child_details['address2']!="")
	$address .= "<br>".$child_details['address2'];
	
if(isset($child_details['town']) && $child_details['town'] !="")
	$address .= "<br>".$child_details['town'];

if(isset($child_details['county']) && $child_details['county'] !="")
	$address .= "<br>".$child_details['county'];
	
if(isset($child_details['postcode_box']) && $child_details['postcode_box'] !="")
	$address .= "<br>".$child_details['postcode_box'];
	
if(isset($child_details['child_hidden_address1']) && $child_details['child_hidden_address1']!="")
	$address .= $child_details['child_hidden_address1'];

if(isset($child_details['child_hidden_address2']) && $child_details['child_hidden_address2'] !="")
	$address .= "<br>".$child_details['child_hidden_address2'];
	
if(isset($child_details['child_hidden_town_city']) && $child_details['child_hidden_town_city'] !="")
	$address .= "<br>".$child_details['child_hidden_town_city'];

if(isset($child_details['child_hidden_county']) && $child_details['child_hidden_county'] !="")
	$address .= "<br>".$child_details['child_hidden_county'];
	
if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode'] !="")
	$address .= "<br>".$child_details['child_hidden_postcode'];	


?>
<div class="row bg-light">      
                                <div class="col-md-3"><label>Name</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$child_details['title']?> <?=$child_details['first_name']?> <?=$child_details['last_name']?></label></div>
                                <div class="col-md-3"><label>Date of birth</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($child_details['cdob_month'].'/'.$child_details['cdob_day'].'/'.$child_details['cdob_year']))?></label></div>
                                <?php if(get_session('child_dob_nin')==true){?>
                                <div class="col-md-3"><label>National Insurance number</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=strtoupper($child_details['NI1'] .' '. $child_details['NI2'].' '. $child_details['NI3'].' '.$child_details['NI4'].' '.$child_details['NI5'])?></label></div>
                                <?php }?>
                                <div class="col-md-3"><label>Address</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                                
                            </div>