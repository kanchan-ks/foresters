<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";


if(isset($beneficiary_details['same_address_beneficiary']) && $beneficiary_details['same_address_beneficiary'] ==1)	{
if(isset($beneficiary_details['beneficiary_hidden_address1']) && $beneficiary_details['beneficiary_hidden_address1']!="")
	$address .= $beneficiary_details['beneficiary_hidden_address1'];

if(isset($beneficiary_details['beneficiary_hidden_address2']) && $beneficiary_details['beneficiary_hidden_address2'] !="")
	$address .= "<br>".$beneficiary_details['beneficiary_hidden_address2'];
	
if(isset($beneficiary_details['beneficiary_hidden_town_city']) && $beneficiary_details['beneficiary_hidden_town_city'] !="")
	$address .= "<br>".$beneficiary_details['beneficiary_hidden_town_city'];

if(isset($beneficiary_details['beneficiary_hidden_county']) && $beneficiary_details['beneficiary_hidden_county'] !="")
	$address .= "<br>".$beneficiary_details['beneficiary_hidden_county'];
	
if(isset($beneficiary_details['beneficiary_hidden_postcode']) && $beneficiary_details['beneficiary_hidden_postcode'] !="")
	$address .= "<br>".$beneficiary_details['beneficiary_hidden_postcode'];	
}else{
if(isset($beneficiary_details['address1']) && $beneficiary_details['address1'] !="")
	$address .= $beneficiary_details['address1'];

if(isset($beneficiary_details['address2']) &&  $beneficiary_details['address2']!="")
	$address .= "<br>".$beneficiary_details['address2'];
	
if(isset($beneficiary_details['town']) && $beneficiary_details['town'] !="")
	$address .= "<br>".$beneficiary_details['town'];

if(isset($beneficiary_details['county']) && $beneficiary_details['county'] !="")
	$address .= "<br>".$beneficiary_details['county'];
	
if(isset($beneficiary_details['postcode_box']) && $beneficiary_details['postcode_box'] !="")
	$address .= "<br>".$beneficiary_details['postcode_box'];

}

?>
<div class="row bg-light">      
                                 <div class="col-md-3"><label>Nominated beneficiary</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=($beneficiary_details['nominate_benificiary'] == 1)?"Yes":"No";?></label></div>
                                <?php if($beneficiary_details['nominate_benificiary'] == 1){?>
                                <div class="col-md-3"><label>Name</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=($beneficiary_details['beneficiary_title']=="Other")?$beneficiary_details['beneficiary_other_title']:$beneficiary_details['beneficiary_title'];?> <?=$beneficiary_details['first_name']?> <?=$beneficiary_details['last_name']?></label></div>
                                <div class="col-md-3"><label>Date of birth</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($beneficiary_details['bdob_month'].'/'.$beneficiary_details['bdob_day'].'/'.$beneficiary_details['bdob_year']))?></label></div>
                              
                                <div class="col-md-3"><label>Address</label></div>
                                <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                                
                                <div class="col-md-3"><label>Amount your beneficiary will receive</label></div>
                                <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format(str_replace(",","",$beneficiary_details['beneficiary_amount']),'0','.',',')?></label></div>
                                
                                <?php }?>
                            </div>