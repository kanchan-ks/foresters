<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";

if(isset($applicant_details['same_address_applicant']) && $applicant_details['same_address_applicant'] ==1)	{
if(isset($applicant_details['applicant_hidden_address1']) && $applicant_details['applicant_hidden_address1']!="")
	$address .= $applicant_details['applicant_hidden_address1'];

if(isset($applicant_details['applicant_hidden_address2']) && $applicant_details['applicant_hidden_address2'] !="")
	$address .= "<br>".$applicant_details['applicant_hidden_address2'];
	
if(isset($applicant_details['applicant_hidden_town_city']) && $applicant_details['applicant_hidden_town_city'] !="")
	$address .= "<br>".$applicant_details['applicant_hidden_town_city'];

if(isset($applicant_details['applicant_hidden_county']) && $applicant_details['applicant_hidden_county'] !="")
	$address .= "<br>".$applicant_details['applicant_hidden_county'];
	
if(isset($applicant_details['applicant_hidden_postcode']) && $applicant_details['applicant_hidden_postcode'] !="")
	$address .= "<br>".$applicant_details['applicant_hidden_postcode'];	
}else{
if(isset($applicant_details['address1']) && $applicant_details['address1'] !="")
	$address .= $applicant_details['address1'];

if(isset($applicant_details['address2']) &&  $applicant_details['address2']!="")
	$address .= "<br>".$applicant_details['address2'];
	
if(isset($applicant_details['town']) && $applicant_details['town'] !="")
	$address .= "<br>".$applicant_details['town'];

if(isset($applicant_details['county']) && $applicant_details['county'] !="")
	$address .= "<br>".$applicant_details['county'];
	
if(isset($applicant_details['postcode_box']) && $applicant_details['postcode_box'] !="")
	$address .= "<br>".$applicant_details['postcode_box'];

}

?>
<div class="row bg-light">      
                                <div class="col-md-3"><label>Name</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=($applicant_details['applicant_title']=="Other")?$applicant_details['applicant_other_title'] : $applicant_details['applicant_title'];?> <?=$applicant_details['first_name']?> <?=$applicant_details['last_name']?></label></div>
                                <div class="col-md-3"><label>Date of birth</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($applicant_details['apl_dob_month'].'/'.$applicant_details['apl_dob_day'].'/'.$applicant_details['apl_dob_year']))?></label></div>
                               	<div class="col-md-3"><label>Telephone</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$applicant_details['applicant2_phone']?></label></div>
                                <div class="col-md-3"><label>Email</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$applicant_details['applicant2_email']?></label></div>
                                
                                <div class="col-md-3"><label>Address</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                                
                                 <?php 
								 	if(isset($payment_options)){
										if(($payment_options['lumpsumEmployementStatus_joint'] != "" || $payment_options['lumpsum_money_investment_source_joint'] != "")  && ($payment_options['lumpsum_innvest_amount'] >= 10000)){?>
										<div class="col-lg-3"><label>Employment status</label></div>
										
										<?php if($payment_options['lumpsumEmployementStatus_joint'] == "Other"){?>
											<div class="col-lg-9 font-weight-bold"><label><?=$payment_options['lumpsumEmployementStatus_extra_joint']?></label></div>
										<?php }else{?>
											<div class="col-lg-9 font-weight-bold"><label><?=$payment_options['lumpsumEmployementStatus_joint']?></label></div>
										<?php }?>
											<div class="col-lg-3"><label>The source of the money you are investing</label></div>
										<?php if($payment_options['lumpsum_money_investment_source_joint'] == "Other"){?>
											<div class="col-lg-9 font-weight-bold"><label><?=$payment_options['lumpsum_money_investment_source_extra_joint']?></label></div>
										<?php }else{?>
											<div class="col-lg-9 font-weight-bold"><label><?=$payment_options['lumpsum_money_investment_source_joint']?></label></div>
										<?php }?>
									<?php }?>
                                  <?php }?>  
                                
                            </div>