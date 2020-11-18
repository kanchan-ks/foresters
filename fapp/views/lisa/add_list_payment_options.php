<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

if(get_session('valid_dob') == false){
	if(get_session('set_topup') == true){
		$lumpsum_pay_amount_min = LISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = LISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
	}else{
		$lumpsum_pay_amount_min = LISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = LISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS;
	}	
}else
{
	$lumpsum_pay_amount_min = LISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS;
	$lumpsum_pay_amount_max = LISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS;
}	
$button = "disabled";
if($payment_options['choose_payment_option_monthly'] == 1 || $payment_options['choose_payment_option_lumpsum'] == 1 || $payment_options['choose_payment_option_transfer'] == 1)
{
	$button = "";
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
                 <h4 class="mt-4">How would you like to add money to your Lifetime ISA?</h4>
                 <h4 class="mt-3">Please select and complete one or more of the expanding sections below.</h4>
                 <?php if(get_session('set_topup') == true){?>
                 <h4 class="mt-3">Don't forget to factor in any payments already made this tax year when working out how much you can top up your Lifetime ISA by.</h4>
                 <?php }?>
                  <?php if(get_session('valid_dob') == true){ echo '<h4 class="mt-3">'.MAX_DOB_WARNING_MESSAGE_LISA.'</h4>';}?>
           
                <div class="row form-row  mb-3 mt-3">
                    <div class="col-lg-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox lisa_pay_option lisa_monthly_payment" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge"><?=($payment_options['choose_payment_option_monthly'] == 1)?"&check;":"&check;";?></span></label>
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
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" value="<?=$payment_options['monthly_innvest_amount']?>" required data-min="<?=LISA_MONTHLY_MIN_AMOUNT?>" data-max="<?=LISA_MONTHLY_MAX_AMOUNT?>" autocomplete='OFF'>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div> 
                        <div class="col-lg-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-9"><p>The monthly contribution that you can pay into your Lifetime ISA is from &pound;<?=LISA_MONTHLY_MIN_AMOUNT?> up to &pound;<?=LISA_MONTHLY_MAX_AMOUNT?> in the current tax year.</p>
                        <?php if(get_session('set_topup') == true){?>
                 			<p>Don't forget to deduct any payments already made this tax year when working out your monthly payment.</p>
						 <?php }?>
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
                <?php //}?>
                
                
                <?php //if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){?>
           		
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <?php if(get_session('valid_dob') == false){?><input type="checkbox" id="<?php if(get_session('valid_dob') == false){ echo 'lumpsum_payment';}?>" class="badgebox lisa_pay_option lisa_lumpsum_payment"  name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1 || get_session('valid_dob') == true)?"checked":"";?>><?php }?><span class="badge"><?=($payment_options['choose_payment_option_lumpsum'] == 1 || get_session('valid_dob') == true)?"&check;":"&check;";?></span></label>
                    </div>
                </div>
                <div class="lumpsum_payment_box <?=($payment_options['choose_payment_option_lumpsum'] == 1 || get_session('valid_dob') == true)?"":"hide";?>">
                <?php if(get_session('valid_dob') == true){?><input type="checkbox" id="<?php if(get_session('valid_dob') == false){ echo 'lumpsum_payment';}?>" class="badgebox lisa_pay_option lisa_lumpsum_payment"  name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1 || get_session('valid_dob') == true)?"checked":"";?>><?php }?>
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
                       <?php if(get_session('valid_dob') == true){?>
                        <p>Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> rather than the usual &pound;500.</p>
                        <?php }?>
                        <?php if(get_session('set_topup') == true){?>
                        <p>You can top up your Lifetime ISA from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> in the current tax year.  Don't forget to deduct any payments already made this tax year.</p>
                        <?php }else{?>
                        <p>The amount that you can pay into your Lifetime ISA is from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> in the current tax year.</p>                        
                        <?php }?>
                        <p>Your lump sum payment will be taken at the end of your application.</p>
                        </div>
                    </div>
                 </div>
                 
                 <?php //}?>
                 
                  <?php //if(isset($payment_options['ISA_transfer_option']) && $payment_options['ISA_transfer_option'] == 1){?>
            	
                 
                 <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="transfer_payment" class="btn-payment-option">Make a transfer in from another ISA provider <input type="checkbox" id="transfer_payment" class="badgebox lisa_pay_option lisa_transfer_payment" name="choose_payment_option_transfer" value="1" <?=($payment_options['choose_payment_option_transfer'] == 1)?'checked="checked"':'';?> ><span class="badge"><?=($payment_options['choose_payment_option_transfer'] == 1)?"&check;":"&check;";?></span></label>
                    </div>
                </div>
                
                <div class="transfer_payment_box <?=($payment_options['choose_payment_option_transfer'] == 1)?"":"hide";?>">
                	<!--<div class="row form-row mt-2 mb-2">
                     	<div class="col-lg-1"></div>
                        <div class="col-lg-6">
                               <label for="ISA_transfer_option" class="pay-transfer-option"><input type="checkbox" id="ISA_transfer_option" name="ISA_transfer_option" value="1" class="badgebox ISA_transfer_option mx-2" <?=($payment_options['ISA_transfer_option'] == 1)?"checked":"";?>><span class="badge">&check;</span>Tick this box if you want to transfer an existing ISA to a Foresters Lifetime ISA.</label>
                             
                        </div>
                    </div>-->
                    <div class="row form-row mb-3">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                    <p>If you are transferring in from another type of ISA, you can transfer a maximum of &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> into a Lifetime ISA this tax year.  If you are transferring from an existing Lifetime ISA, you can transfer more than &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> as this will include subscriptions from a previous tax year/s.</p>
                    <p>To transfer to a Stocks & Shares Lifetime ISA with Foresters, please complete the transfer form below. If you cannot print, please telephone us and we'll be happy to post you a Transfer form.  Otherwise, click the link below to open the pdf form. The form already includes the details you've provided in this form. If you are transferring into an existing Foresters Lifetime ISA, please add your policy number on the form.</p>
                    
                    <p>Please print, complete, sign and return to us at the Freepost address provided.  We will set up your Lifetime ISA, and begin the transfer process as soon as we receive your Transfer form.  We will contact you to confirm when the funds are received from your existing provider.</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="<?=base_url('lisa/transfer_form')?>" class="font-weight-bold" target="_blank">Your Lifetime ISA Transfer form &raquo;</a></p></div>
                    </div>
                 </div>
                 
                 <?php //}?>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right mr-0" id="next3"  data-step="2">Continue</button>
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
