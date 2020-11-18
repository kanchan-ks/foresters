<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$lumpsum_pay_amount_min = FCTF_MIN_LUMPSUM_AMOUNT;
$lumpsum_pay_amount_max = FCTF_MAX_LUMPSUM_AMOUNT;
?>
        <form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
        <input type="hidden" name="step" value="4">
        
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
                 <h4 class="mt-4">How would you like to add money to your Child Trust Fund?</h4>
                 <h4 class="mt-3">Please select and complete one or more of the expanding sections below.</h4>
                 
           
                <div class="row form-row  mb-3 mt-3">
                    <div class="col-lg-12"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox fctf_pay_option fctf_monthly_payment" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge"><?=($payment_options['choose_payment_option_monthly'] == 1)?"&check;":"&check;";?></span></label>
                    </div>
                </div>
                 <div class="monthly_payment_box <?=($payment_options['choose_payment_option_monthly'] == 1)?"":"hide";?>">
                     <div class="row form-group">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to save each month</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" value="<?=$payment_options['monthly_innvest_amount']?>" required data-min="<?=FCTF_MONTHLY_MIN_AMOUNT?>" data-max="<?=FCTF_MONTHLY_MAX_AMOUNT?>" autocomplete='OFF'>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div> 
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-9"><p>The monthly contribution that you can pay into a Child Trust Fund is from &pound;<?=FCTF_MONTHLY_MIN_AMOUNT?> up to &pound;<?=FCTF_MONTHLY_MAX_AMOUNT?> in the current tax year.</p>
                         <label class="font-weight-bold">Please provide your bank account details:</label></div>
                        <div class="col-lg-2"></div> 
                    </div>
                    <div class="row form-row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-container active">
                                    <input placeholder="Account holder name" type="text" name="monthly_account_holder_name" id="monthly_account_holder_name"  class="form-control  mb-3  requried" requried  autocomplete='OFF' value="<?=$payment_options['monthly_account_holder_name']?>"  maxlength="50">
                                    <input placeholder="Account number" type="text" name="monthly_account_number" id="monthly_account_number" class="form-control mb-3 requried account_number" requried autocomplete='OFF' maxlength="8" value="<?=$payment_options['monthly_account_number']?>">
                                    <input placeholder="Sort code" type="text" name="monthly_account_sort_code" id="monthly_account_sort_code"  class="form-control  mt-2 mb-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8" value="<?=$payment_options['monthly_account_sort_code']?>">
                            </div>
                        </div>
                        <div class="col-lg-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-10"><label>Your first payment will be collected on or immediately after 1st <?=get_first_day_of_next_month()?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of you completing this form.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-10"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-lg-1"></div>
                        <div class="col-lg-10"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-lg-1"></div>
                        <div class="col-lg-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                   </div>
                <div class="row form-row  mb-3">
                    <div class="col-lg-12"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox fctf_pay_option fctf_lumpsum_payment"  name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"checked":"";?>><span class="badge"><?=($payment_options['choose_payment_option_lumpsum'] == 1)?"&check;":"&check;";?></span></label>
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
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control" placeholder="" required autocomplete="OFF" data-min="<?=$lumpsum_pay_amount_min?>" data-max="<?=$lumpsum_pay_amount_max?>" value="<?=$payment_options['lumpsum_innvest_amount']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"></div> 
                        <div class="col-lg-1"></div>
                        <div class="col-lg-11 mt-3">
                      
                        <p>The lump sum amount that you can pay into a Child Trust Fund is from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> in the current tax year.</p>                        
                       
                        <p>Your lump sum payment will be taken at the end of this form.</p>
                        </div>
                    </div>
                 </div>
                 
                
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right mr-0" id="next3"  data-step="4">Continue</button>
                <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="3">Back</button>
            </div>
        </div>
         
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
        </form>
