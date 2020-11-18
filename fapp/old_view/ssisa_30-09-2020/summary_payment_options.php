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
                <div class="col-md-3"><label>Monthly contributions</label></div>
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
                <?php if($payment_options['EmployementStatus'] != "" || $payment_options['money_investment_source'] != ""){?>
                <div class="col-md-3"><label>Employement status</label></div>
                
                <?php if($payment_options['EmployementStatus'] == "Other"){?>
				<div class="col-md-9 font-weight-bold"><label><?=$payment_options['EmployementStatus_extra']?></label></div>
				<?php }else{?>
				<div class="col-md-9 font-weight-bold"><label><?=$payment_options['EmployementStatus']?></label></div>
				<?php }?>
                <div class="col-md-3"><label>The source of the money you are investing</label></div>
                
               <?php if($payment_options['money_investment_source'] == "Other"){?>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['money_investment_source_extra']?></label></div>
                <?php }else{?>
				<div class="col-md-9 font-weight-bold"><label><?=$payment_options['money_investment_source']?></label></div>
				<?php }?>
                <?php }?>
            </div>  
			
            <?php }?>
            <?php if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){?>
           	<div class="row bg-light">      
                <div class="col-md-3"><label>Lump sum payment</label></div>
                <div class="col-md-9 font-weight-bold"><label>&pound;<?=$payment_options['lumpsum_innvest_amount']?></label></div>
                
                <?php if($payment_options['lumpsumEmployementStatus'] != "" || $payment_options['lumpsum_money_investment_source'] != ""){?>
                    <div class="col-md-3"><label>Employement status</label></div>
                    
                    <?php if($payment_options['lumpsumEmployementStatus'] == "Other"){?>
                    	<div class="col-md-9 font-weight-bold"><label><?=$payment_options['lumpsumEmployementStatus_extra']?></label></div>
                    <?php }else{?>
                    	<div class="col-md-9 font-weight-bold"><label><?=$payment_options['lumpsumEmployementStatus']?></label></div>
                    <?php }?>
                    	<div class="col-md-3"><label>The source of the money you are investing</label></div>
                    <?php if($payment_options['lumpsum_money_investment_source'] == "Other"){?>
                    	<div class="col-md-9 font-weight-bold"><label><?=$payment_options['lumpsum_money_investment_source_extra']?></label></div>
                    <?php }else{?>
                   		<div class="col-md-9 font-weight-bold"><label><?=$payment_options['lumpsum_money_investment_source']?></label></div>
                    <?php }?>
                <?php }?>
            </div> 
            <?php }?>
            <?php if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){?>
                <div class="row bg-light">      
                                <div class="col-md-3"><label>Transfer in from another ISA provider</label></div>
                                <div class="col-md-9 font-weight-bold"><label><i class="fa fa-check mt-1"></i></label></div>
                            </div> 
              <?php }?>