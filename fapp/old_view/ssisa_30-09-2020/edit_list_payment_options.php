<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
if(get_session('valid_dob') == false){
	if(get_session('set_topup') == true){
		$lumpsum_pay_amount_min = SSISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = SSISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
	}else{
		$lumpsum_pay_amount_min = SSISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = SSISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS;
	}	
}else
{
	$lumpsum_pay_amount_min = SSISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS;
	$lumpsum_pay_amount_max = SSISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS;
}
?>

<form name="frmupdate_paymentoption" id="frmupdate_paymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
     	   <div class="row">
        	<div class="col-md-12">
            	 <hr>
				<h4>How would you like to add money to your Stocks & Shares ISA?</h4>
                 <h4 class="mt-4">Please update the expanding sections below.</h4>
                <?php if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1){?>
                           
           
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox ssisa_pay_option" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
                    </div>
                </div>
                 <div class="monthly_payment_box <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>">
                     <div class="row form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control monthly_innvest_amount required" placeholder="" value="<?=$payment_options['monthly_innvest_amount']?>" required data-min="<?=SSISA_MONTHLY_MIN_AMOUNT?>" data-max="<?=SSISA_MONTHLY_MAX_AMOUNT?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div> 
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-9"><p>The monthly contribution that you can pay into your Stocks & Shares ISA is from &pound;<?=SSISA_MONTHLY_MIN_AMOUNT?> up to &pound;<?=@number_format(SSISA_MONTHLY_MAX_AMOUNT,0,'',',');?> in the current tax year.</p><label class="font-weight-bold">Please provide your bank account details:</label></div>
                        <div class="col-md-2"></div> 
                    </div>
                    <div class="row form-row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5 font-weight-bold">
                            <div class="form-container active">
                                    <input placeholder="Account holder name" type="text" name="monthly_account_holder_name" id="monthly_account_holder_name"  class="form-control  mb-3  requried" requried  autocomplete='OFF' value="<?=$payment_options['monthly_account_holder_name']?>" >
                                    <input placeholder="Account number" type="text" name="monthly_account_number" id="monthly_account_number" class="form-control mb-3 requried account_number" requried autocomplete='OFF' maxlength="8" value="<?=$payment_options['monthly_account_number']?>">
                                    <input placeholder="Sort code" type="text" name="monthly_account_sort_code" id="monthly_account_sort_code"  class="form-control  mt-2 mb-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8" value="<?=$payment_options['monthly_account_sort_code']?>">
                            </div>
                        </div>
                        <div class="col-md-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    <div class="row form-row mt-1 mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10"><label>Your first payment will be collected on or immediately after 1st <?=date("F Y", strtotime("+38 days"))?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-11"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your application.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-2">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
					<div class="row form-row mb-2">
	                    <div class="col-md-1"></div>
                        <div class="col-md-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="javascript:;">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                    <div class="row form-row mb-1 <?=($payment_options['EmployementStatus'] == "" && $payment_options['money_investment_source'] == "")?"hide":"";?> show_monthly_high_value_text">
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><p><strong>Money laundering checks</strong> will take place if you invest a lump sum of &pound;10,000 or more, and as you your contributions reach that amount, we need to ask you to complete two additional questions.</p>
<p>Anti-money laundering checks are required by law for all financial services providers before they are allowed to handle money from customers. The checks are made to make sure you are genuinely who you say you are and that the money has not been acquired illegally.</p>
<p>We may verify your identity by carrying out an online check with a credit agency who will add a note to your reference file to show that an identity check has been made.  We may pass information to third parties for the prevention of crime or detection of fraud or where required by law
.</p></div>
                    </div>
                     <div class="col-md-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-md-1"></div>
                            <div class="col-md-2 text-left font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-md-4">
                                    <?=form_dropdown('EmployementStatus',$employement_status,$payment_options['EmployementStatus'],'class="form-control EmployementStatus required" placeholder="Please Select" id="EmployementStatus" required')?>
                                    
                                    <input type="text" name="EmployementStatus_extra" id="EmployementStatus_extra" value="<?=$payment_options['EmployementStatus_extra']?>" class="form-control <?=($payment_options['EmployementStatus_extra'] == "")?"hide":"";?>  mt-2 EmployementStatus_extra required" placeholder='Please enter other employement status' required>
                                </div>
                            	<div class="col-md-5"></div> 
                        </div>
                     </div>  
                     
                     <div class="col-md-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-md-1"></div>
                            <div class="col-md-2 text-right font-weight-bold"><label>The source of the money you are investing:</label></div>
                                <div class="col-md-4">
                                    <?=form_dropdown('money_investment_source',$money_investment_source,$payment_options['money_investment_source'],'class="form-control money_investment_source required" placeholder="Please Select" id="money_investment_source" required')?>
                                    
                                    <input type="text" name="money_investment_source_extra" id="money_investment_source_extra" value="<?=$payment_options['money_investment_source_extra']?>" class="form-control <?=($payment_options['money_investment_source_extra'] == "")?"hide":"";?>  mt-2 money_investment_source_extra required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-md-5"></div> 
                        </div>
                     </div>
                          
                    </div>
                    
                    
                    
                   </div>
                <?php }?>
                
                
                <?php if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){?>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox ssisa_pay_option" name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
                    </div>
                </div>
                <div class="lumpsum_payment_box <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"":"hide";?>">
                    <div class="row form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control lumpsum_innvest_amount" placeholder="" value="<?=$payment_options['lumpsum_innvest_amount']?>" required autocomplete="OFF"  data-min="<?=$lumpsum_pay_amount_min?>" data-max="<?=$lumpsum_pay_amount_max?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div> 
                        <?php if(get_session('valid_dob') == true){?>
                        <div class="col-md-1"></div>
                        <div class="col-md-11 mt-3"><p>Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;<?=$lumpsum_pay_amount_min?> rather than the usual &pound;<?=$lumpsum_pay_amount_max?>.</p></div>
                        <?php }?>
                        <?php if(get_session('set_topup') == true){?>
                         <div class="col-md-1"></div>
                        <div class="col-md-10 mt-3"><p>You can top-up your ISA from &pound;<?=$lumpsum_pay_amount_min?> to &pound;<?=@number_format($lumpsum_pay_amount_max,0,'',',');?> in the current tax year.  Don't forget to deduct any payments already made this tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }else{?>
                         <div class="col-md-1"></div>
                        <div class="col-md-10 mt-3"><p>The amount that you can pay into your Stocks & Shares ISA is from &pound;<?=$lumpsum_pay_amount_min?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,0,'',',');?> in the current tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }?>
                        
                        <div class="row form-row mb-1 <?=($payment_options['lumpsumEmployementStatus'] == "" && $payment_options['lumpsum_money_investment_source'] == "")?"hide":"";?> show_lumpsum_high_value_text">
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><p><strong>Money laundering checks</strong> will take place if you invest a lump sum of &pound;10,000 or more, and as you your contributions reach that amount, we need to ask you to complete two additional questions. If you have answered these in the monthly payment section above there is no need to complete here.</p>
<p>Anti-money laundering checks are required by law for all financial services providers before they are allowed to handle money from customers. The checks are made to make sure you are genuinely who you say you are and that the money has not been acquired illegally.</p>
<p>We may verify your identity by carrying out an online check with a credit agency who will add a note to your reference file to show that an identity check has been made.  We may pass information to third parties for the prevention of crime or detection of fraud or where required by law.</p></div>
                    </div>
                     <div class="col-md-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-md-1"></div>
                            <div class="col-md-2 font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-md-4">
                                    <?=form_dropdown('lumpsumEmployementStatus',$employement_status,$payment_options['lumpsumEmployementStatus'],'class="form-control lumpsumEmployementStatus required" placeholder="Please Select" id="lumpsumEmployementStatus" required')?>
                                    
                                    <input type="text" name="lumpsumEmployementStatus_extra" id="lumpsumEmployementStatus_extra" value="<?=$payment_options['lumpsumEmployementStatus_extra']?>" class="form-control <?=($payment_options['lumpsumEmployementStatus_extra'] == "")?"hide":"";?> mt-2 lumpsumEmployementStatus_extra required" placeholder='Please enter other employement status' required>
                                </div>
                            	<div class="col-md-5"></div> 
                        </div>
                     </div>  
                     
                     <div class="col-md-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-md-1"></div>
                            <div class="col-md-2 font-weight-bold">The source of the money you are investing:</div>
                                <div class="col-md-4">
                                    <?=form_dropdown('lumpsum_money_investment_source',$money_investment_source,$payment_options['lumpsum_money_investment_source'],'class="form-control lumpsum_money_investment_source required" placeholder="Please Select" id="lumpsum_money_investment_source" required')?>
                                    
                                    <input type="text" name="lumpsum_money_investment_source_extra" id="lumpsum_money_investment_source_extra" value="<?=$payment_options['lumpsum_money_investment_source_extra']?>" class="form-control <?=($payment_options['lumpsum_money_investment_source_extra'] == "")?"hide":"";?> mt-2 lumpsum_money_investment_source_extra required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-md-5"></div> 
                        </div>
                     </div>
                          
                    </div>
                    </div>
                 </div>
                 
                 <?php }?>
                 
                  <?php if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){?>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card  <input type="checkbox" id="transfer_payment" class="badgebox ssisa_pay_option" name="choose_payment_option_transfer" value="1" <?=($payment_options['choose_payment_option_transfer'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
                    <input type="hidden" name="ISA_transfer_option" value="1">
                    </div>
                </div>
                <div class="lumpsum_payment_box <?=($payment_options['choose_payment_option_transfer'] == 1)?"":"hide";?>">
                    <div class="row form-row mt-2 mb-2">
                     	<div class="col-md-1"></div>
                        <div class="col-md-6">
                               <label for="ISA_transfer_option" class="pay-transfer-option">Transfer in from another provider <i class="fa fa-check"></i></label>
                             
                        </div>
                    </div>
                 </div>
                 
                 <?php }?>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_payment_options" data-step="2">Update</button>
            </div>
        </div>
         
           
        </form>
       