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
 
        <form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
        <input type="hidden" name="step" value="2">
        
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Your Details</div>
        </div> 
        <div class="row progressbar mb-2">
            <div class="col-lg-12 bg-limegreen">Payment Options</div>
        </div>
     	   <div class="row">
        	<div class="col-lg-12">
            <h3>Payment options</h3>
            <hr>
                 <h4>How would you like to add money to your Stocks & Shares ISA?</h4>
                 <h4 class="mt-2">Please select and complete one or more of the expanding sections below.</h4>
                 <?php if(get_session('set_topup') == true){?>
                 <h4 class="mt-2">Don't forget to factor in any payments already made this tax year when working out how much you can top up your ISA by.</h4>
                 <?php }?>
                  <?php if(get_session('valid_dob') == true){ echo '<h4 class="mt-4">'.MAX_DOB_WARNING_MESSAGE_SSISA.'</h4>';}?>
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox ssisa_pay_option ssisa_monthly_payment" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                 <div class="monthly_payment_box <?=($payment_options['choose_payment_option_monthly'] == 1)?"":"hide";?>">
                     <div class="row form-group">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required monthly_innvest_amount" placeholder="" required data-min="<?=SSISA_MONTHLY_MIN_AMOUNT?>" data-max="<?=SSISA_MONTHLY_MAX_AMOUNT?>" autocomplete="off" value="<?=$payment_options['monthly_innvest_amount']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div> 
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-9"><p>The monthly contribution that you can pay into your Stocks & Shares ISA is from &pound;<?=SSISA_MONTHLY_MIN_AMOUNT?> up to &pound;<?=@number_format(SSISA_MONTHLY_MAX_AMOUNT,0,'',',');?> in the current tax year.</p> 
						<?php if(get_session('set_topup') == true){?>
                 			<p>Don't forget to deduct any payments already made this tax year when working out your monthly payment.</p>
						 <?php }?>
                         <label class="font-weight-bold">Please provide your bank account details:</label></div>
                        <div class="col-lg-2"></div> 
                    </div>
                    <div class="row form-row mb-3">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-container active">
                                    <input placeholder="Account holder name" type="text" name="monthly_account_holder_name" id="monthly_account_holder_name"  class="form-control   requried" requried  autocomplete='OFF' maxlength="50" value="<?=$payment_options['monthly_account_holder_name']?>">
                                    <input placeholder="Account number" type="text" name="monthly_account_number" id="monthly_account_number" class="form-control mt-3 requried account_number" requried autocomplete='OFF' maxlength="8" value="<?=$payment_options['monthly_account_number']?>">
                                    <input placeholder="Sort code" type="text" name="monthly_account_sort_code" id="monthly_account_sort_code"  class="form-control  mt-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8" value="<?=$payment_options['monthly_account_sort_code']?>">
                            </div>
                        </div>
                        <div class="col-lg-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    <div class="row form-row mt-1 mb-1">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-10"><label>Your first payment will be collected on or immediately after 1st <?=get_first_day_of_next_month()?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-lg-1">&nbsp;</div>
                        <?php if(get_session('set_topup') == true){?>
                        <div class="col-lg-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of you completing this form.</label></div>
                        <?php }else{?>
                        <div class="col-lg-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your application.</label></div>
                        <?php }?>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-10"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-2">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-10"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
					<div class="row form-row mb-2">
	                    <div class="col-lg-1"></div>
                        <div class="col-lg-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                    <div class="row form-row mb-1 <?=($payment_options['EmployementStatus'] == "" && $payment_options['money_investment_source'] == "")?"hide":"";?> show_monthly_high_value_text">
                    <div class="row form-row mb-1">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-11"><p><strong>Anti-money laundering checks</strong> will take place if you invest a lump sum of &pound;10,000 or more, and as your contributions reach that amount, we need to ask you to complete two additional questions.</p>
<p>Anti-money laundering checks are required by law for all financial services providers before they are allowed to handle money from customers. The checks are made to make sure you are genuinely who you say you are and that the money has not been acquired illegally.</p>
<p>We may verify your identity by carrying out an online check with a credit agency who will add a note to your reference file to show that an identity check has been made.  We may pass information to third parties for the prevention of crime or detection of fraud or where required by law
.</p></div>
                    </div>
                     <div class="col-lg-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 text-left font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('EmployementStatus',$employement_status,$payment_options['EmployementStatus'],'class="form-control select2 EmployementStatus required" placeholder="Please Select" id="EmployementStatus" required')?>
                                    
                                    <input type="text" name="EmployementStatus_extra" id="EmployementStatus_extra" value="<?=$payment_options['EmployementStatus_extra']?>" class="form-control <?=($payment_options['EmployementStatus_extra'] == "")?"hide":"";?>  mt-2 EmployementStatus_extra required" placeholder='Please enter other employement status' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>  
                     
                     <div class="col-lg-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 text-left font-weight-bold"><label class="mt-0">The source of the money you are investing:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('money_investment_source',$money_investment_source,$payment_options['money_investment_source'],'class="form-control money_investment_source required select2" placeholder="Please Select" id="money_investment_source" required')?>
                                    
                                    <input type="text" name="money_investment_source_extra" id="money_investment_source_extra" value="<?=$payment_options['money_investment_source_extra']?>" class="form-control <?=($payment_options['money_investment_source_extra'] == "")?"hide":"";?>  mt-2 money_investment_source_extra required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>
                          
                    </div>
                    
                    
                    
                    
                   </div>
                
                
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox ssisa_pay_option ssisa_lumpsum_payment" name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"checked":"";?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                
                <div class="lumpsum_payment_box <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"":"hide";?>">
                    <div class="row form-group">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control lumpsum_innvest_amount" placeholder="" required autocomplete="OFF" data-min="<?=$lumpsum_pay_amount_min?>" data-max="<?=$lumpsum_pay_amount_max?>" value="<?=$payment_options['lumpsum_innvest_amount']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                        <?php if(get_session('valid_dob') == true){?>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 mt-3"><p>Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;<?=$lumpsum_pay_amount_min?> rather than the usual &pound;<?=@number_format($lumpsum_pay_amount_max,0,'',',');?>.</p></div>
                        <?php }?>
                        <?php if(get_session('set_topup') == true){?>
                         <div class="col-lg-1"></div>
                        <div class="col-lg-10 mt-3"><p>You can top up your ISA from &pound;<?=$lumpsum_pay_amount_min?> to &pound;<?=@number_format($lumpsum_pay_amount_max,0,'',',');?> in the current tax year.  Don't forget to deduct any payments already made this tax year.<br>Your lump sum payment will be taken at the end of this form.</p></div>
                        <?php }else{?>
                         <div class="col-lg-1"></div>
                        <div class="col-lg-10 mt-3"><p>The amount that you can pay into your Stocks & Shares ISA is from &pound;<?=$lumpsum_pay_amount_min?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,0,'',',');?> in the current tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }?>
                        
                        
                        
                        <div class="row form-row mb-1 <?=($payment_options['lumpsumEmployementStatus'] == "" && $payment_options['lumpsum_money_investment_source'] == "")?"hide":"";?> show_lumpsum_high_value_text">
                    <div class="row form-row mb-1">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-11"><p><strong>Anti-money laundering checks</strong> will take place if you invest a lump sum of &pound;10,000 or more, and as your contributions reach that amount, we need to ask you to complete two additional questions.</p>
<p>Anti-money laundering checks are required by law for all financial services providers before they are allowed to handle money from customers. The checks are made to make sure you are genuinely who you say you are and that the money has not been acquired illegally.</p>
<p>We may verify your identity by carrying out an online check with a credit agency who will add a note to your reference file to show that an identity check has been made.  We may pass information to third parties for the prevention of crime or detection of fraud or where required by law.</p></div>
                    </div>
                     <div class="col-lg-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('lumpsumEmployementStatus',$employement_status,$payment_options['lumpsumEmployementStatus'],'class="form-control lumpsumEmployementStatus required select2" placeholder="Please Select" id="lumpsumEmployementStatus" required')?>
                                    
                                    <input type="text" name="lumpsumEmployementStatus_extra" id="lumpsumEmployementStatus_extra" value="<?=$payment_options['lumpsumEmployementStatus_extra']?>" class="form-control <?=($payment_options['lumpsumEmployementStatus_extra'] == "")?"hide":"";?> mt-2 lumpsumEmployementStatus_extra required" placeholder='Please enter other employement status' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>  
                     
                     <div class="col-lg-12">
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 text-left font-weight-bold"><label class="mt-0">The source of the money you are investing:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('lumpsum_money_investment_source',$money_investment_source,$payment_options['lumpsum_money_investment_source'],'class="form-control lumpsum_money_investment_source select2 required" placeholder="Please Select" id="lumpsum_money_investment_source" required')?>
                                    
                                    <input type="text" name="lumpsum_money_investment_source_extra" id="lumpsum_money_investment_source_extra" value="<?=$payment_options['lumpsum_money_investment_source_extra']?>" class="form-control <?=($payment_options['lumpsum_money_investment_source_extra'] == "")?"hide":"";?> mt-2 lumpsum_money_investment_source_extra required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>
                          
                    </div>
                    
                    
                       
                    </div>
                 </div>
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="transfer_payment" class="btn-payment-option">Make a transfer in from another ISA provider <input type="checkbox" id="transfer_payment" class="badgebox ssisa_pay_option ssisa_transfer_payment" name="choose_payment_option_transfer" value="1" <?=($payment_options['choose_payment_option_transfer'] == 1)?"checked":"";?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                
                <div class="transfer_payment_box <?=($payment_options['choose_payment_option_transfer'] == 1)?"":"hide";?>">
                	<!--<div class="row form-row mt-2 mb-2">
                     	<div class="col-lg-1"></div>
                        <div class="col-lg-10">
                               <label for="ISA_transfer_option" class="pay-transfer-option"><input type="checkbox" id="ISA_transfer_option" name="ISA_transfer_option" value="1" class="badgebox ISA_transfer_option "><span class="badge">&check;</span>Tick this box if you want to transfer an existing ISA to a Foresters Stocks & Shares ISA.</label>
                             
                        </div>
                    </div>-->
                    <div class="row form-row mb-3">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                    <p>To transfer to a Stocks & Shares ISA with Foresters, please complete the transfer form below. If you cannot print, please telephone us and we'll be happy to post you a Transfer form.  Otherwise, click the link below to open the pdf form. The form already includes the details you've provided in this <span class="application_to_form">application</span>. If you are transferring into an existing Foresters Stocks & Shares ISA, please add your policy number on the form.</p>
                    
                    <p>Please print, complete, sign and return to us at the Freepost address provided.  We will set up your Stocks & Shares ISA, and begin the transfer process as soon as we receive your Transfer form.  We will contact you to confirm when the funds are received from your existing provider.</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="<?=base_url('ssisa/transfer_form')?>" class="font-weight-bold" target="_blank">Your Stocks & Shares ISA Transfer form &raquo;</a></p></div>
                    </div>
                 </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next3" data-step="2">Continue</button>
                <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="1">Back</button>
            </div>
        </div>
         
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
        </form>
