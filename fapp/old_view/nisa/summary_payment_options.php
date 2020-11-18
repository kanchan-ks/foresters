<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";
if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){

if($payment_options['transfer_address1'] !="")
	$address .= $payment_options['transfer_address1'];

if($payment_options['transfer_address2'] !="")
	$address .= "<br>".$payment_options['transfer_address2'];
	
if($payment_options['transfer_city'] !="")
	$address .= "<br>".$payment_options['transfer_city'];

if($payment_options['transfer_county'] !="")
	$address .= "<br>".$payment_options['transfer_county'];
	
if($payment_options['transfer_postcode_box'] !="")
	$address .= "<br>".$payment_options['transfer_postcode_box'];
	
}
?>
			 <?php if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1){?>
            <div class="row bg-light">
                <div class="col-md-3"><label>Monthly contributios</label></div>
                <div class="col-md-9 font-weight-bold"><label>&pound;<?=$payment_options['monthly_innvest_amount']?></label></div>
                <div class="col-md-3"><label>Account holder name</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_holder_name']?></label></div>
                <div class="col-md-3"><label>Account number</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_number']?></label></div>
                <div class="col-md-3"><label>Sort Code</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_sort_code']?></label></div>
                 <div class="col-md-3">&nbsp;</div>
                <div class="col-md-9 font-weight-bold">
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="javascript:;">View and print the Direct Debit Guarantee &raquo;</a></p>  
                </div>
            </div>  
            <?php }?>
            <?php if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){?>
            <hr>
            <div class="row bg-light">      
                <div class="col-md-3"><label>Lump sum payment</label></div>
                <div class="col-md-9 font-weight-bold"><label>&pound;<?=$payment_options['lumpsum_innvest_amount']?></label></div>
            </div> 
            <?php }?>
            <?php if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){?>
            <hr>
             <div class="row bg-light">      
                <div class="col-md-3"><label>Name of existing provider</label></div>
                <div class="col-md-9 font-weight-bold"><label>&pound;<?=$payment_options['transfer_name_existing_provider']?></label></div>
                <div class="col-md-3"><label>Please provide address of existing provider</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
                <div class="col-md-3"><label>Account number</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['transfer_account_number']?></label></div>
                <div class="col-md-3"><label>Sort Code</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['transfer_accont_sort_code']?></label></div>
                <div class="col-md-3"><label>Account reference</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['transfer_account_reference']?></label></div>
                <div class="col-md-3"><label>Type of ISA</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['type_of_ISA']?></label></div>
                <div class="col-md-3"><label>Registration Number</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['hmrc_nisa_registration_number']?></label></div>
                <div class="col-md-3"><label>Transfer type</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=($payment_options['payment_transfer_option']==1)?"Full Transfer":"Half Transfer";?></label></div>
                <div class="col-md-3"><label>Amount to transfer</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['full_transfer_amount']?></label></div>
                
                
            </div>
            <?php }?>