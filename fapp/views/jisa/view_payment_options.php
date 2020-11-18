<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

if(get_session('valid_dob') == false){
	if(get_session('set_topup') == true){
		$lumpsum_pay_amount_min = JISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = JISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS;
	}else{
		$lumpsum_pay_amount_min = JISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS;
		$lumpsum_pay_amount_max = JISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS;
	}	
}else
{
	$lumpsum_pay_amount_min = JISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS;
	$lumpsum_pay_amount_max = JISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS;
}	

?>
 
        <form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
        <input type="hidden" name="step" value="3">
        
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
                 <h4>How would you like to add money to your Junior ISA?</h4>
                 <h4 class="mt-2">Please select and complete one or more of the expanding sections below.</h4>
                 <?php if(get_session('set_topup') == true){?>
                 <h4 class="mt-2">Don't forget to factor in any payments already made this tax year when working out how much you can top up your Junior ISA by.</h4>
                 <?php }?>
                  <?php if(get_session('valid_dob') == true){ echo '<h4 class="mt-4">'.MAX_DOB_WARNING_MESSAGE_JISA.'</h4>';}?>
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox jisa_pay_option jisa_monthly_payment" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                 <div class="monthly_payment_box  <?=($payment_options['choose_payment_option_monthly'] == 1)?"":"hide";?>">
                     <div class="row form-group">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" required data-min="<?=JISA_MONTHLY_MIN_AMOUNT?>" data-max="<?=JISA_MONTHLY_MAX_AMOUNT?>" value="<?=$payment_options['monthly_innvest_amount']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5"></div> 
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-9"><p>The monthly contribution that you can pay into your Junior ISA is from &pound;<?=JISA_MONTHLY_MIN_AMOUNT?> up to &pound;<?=JISA_MONTHLY_MAX_AMOUNT?> in the current tax year.</p>
                        <?php if(get_session('set_topup') == true){?>
                 			<p>Don't forget to deduct any payments already made this tax year when working out your monthly payment.</p>
						 <?php }?>
                         <label class="font-weight-bold">Please provide your bank account details:</label></div>
                        <div class="col-lg-1"></div> 
                    </div>
                    <div class="row form-row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            <div class="form-container active">
                                    <input placeholder="Account holder name" type="text" name="monthly_account_holder_name" id="monthly_account_holder_name"  class="form-control  mb-3  requried" requried  autocomplete='OFF' value="<?=$payment_options['monthly_account_holder_name']?>"  maxlength="50">
                            </div>
                        </div>
                        <div class="col-lg-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    
                    <div class="row form-row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            
                               <label for="accept_account_holder_terms" class="btn-summary-terms font-weight-bold mt-1"><input type="checkbox" id="accept_account_holder_terms" name="accept_account_holder_terms" value="1" class="badgebox  "  <?=(isset($payment_options['accept_account_holder_terms']) && $payment_options['accept_account_holder_terms'] == 1)?"checked":"";?>><span class="badge">&check;</span></label><p class="pt-1">Please tick here if payments will be made from a bank account belonging to someone other than yourself.</p>
                             
                        </div>
                        <div class="col-lg-5"></div>
                    </div>
                    
                    
                    <div class="row form-row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            <div class="form-container active">
                                  
                                    <input placeholder="Account number" type="text" name="monthly_account_number" id="monthly_account_number" class="form-control mb-3 requried account_number" requried autocomplete='OFF' maxlength="8" value="<?=$payment_options['monthly_account_number']?>">
                                    <input placeholder="Sort code" type="text" name="monthly_account_sort_code" id="monthly_account_sort_code"  class="form-control  mt-2 mb-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8" value="<?=$payment_options['monthly_account_sort_code']?>">
                            </div>
                        </div>
                        <div class="col-lg-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    
                    <div class="third_party_box <?=(isset($payment_options['accept_account_holder_terms']) && $payment_options['accept_account_holder_terms'] == 1)?"":"hide";?>">
                    	<div class="row form-row  mb-3">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">Please provide the details of the person making the payments. We will contact them to complete the Direct Debit mandate required to set up payments from their account.</div>
                            <div class="col-lg-4"></div> 
                        </div>
                    
                    	<div class="row form-row  mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>Title</label></div>
                            <div class="col-lg-5">
                                <?=form_dropdown('third_party_title',$list_title,$payment_options['third_party_title'],'class="required select2 form-control third_party_title" placeholder="Title"')?>
                                <input type="text" name="third_party_other_title" id="third_party_other_title" value="<?=$payment_options['third_party_other_title']?>" class="form-control <?=($payment_options['third_party_title']=="Other")?"":"hide"?> mt-2 third_party_other_title" placeholder='Please enter your title'>
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                        
                        <div class="row form-row mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>First name</label></div>
                            <div class="col-lg-5">
                                <input type="text" name="third_party_first_name" id="third_party_first_name" value="<?=$payment_options['third_party_first_name']?>" class="form-control required" required autocomplete="OFF" maxlength="20">
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                        
                        <div class="row form-row mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>Last name</label></div>
                            <div class="col-lg-5">
                                <input type="text" name="third_party_last_name" id="third_party_last_name" value="<?=$payment_options['third_party_last_name']?>" class="form-control required" required autocomplete="OFF" maxlength="20">
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                        
                        <div class="row form-row mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>Phone</label></div>
                            <div class="col-lg-5">
                                <input type="text" name="third_party_phone" id="third_party_phone" value="<?=$payment_options['third_party_phone']?>" class="form-control required phone" required  autocomplete="OFF">
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                        <div class="row form-row mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>Email</label></div>
                            <div class="col-lg-5">
                                <input type="email" name="third_party_email" id="third_party_email" value="<?=$payment_options['third_party_email']?>" class="form-control" autocomplete="OFF" maxlength="50">
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                         <div class="row form-row mb-3">
                            <div class="col-lg-2 text-lg-right text-left font-weight-bold"><label>Confirm email</label></div>
                            <div class="col-lg-5">
                                <input type="email" name="third_party_cemail" id="third_party_cemail" value="<?=$payment_options['third_party_cemail']?>" class="form-control"   autocomplete="OFF" maxlength="50">
                            </div>
                            <div class="col-lg-5"></div> 
                        </div>
                        <div class="row form-row  mb-3">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-5">If the payer does not have an email address, you can leave this section blank. However this may increase the time it takes us to contact them to set the Direct Debit up.</div>
                            <div class="col-lg-5"></div> 
                        </div>
                    </div>
                    
                    
                    
                    <div class="row form-row mb-1">
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-10"><label>Your first payment will be collected on or immediately after 1st <?=get_first_day_of_next_month()?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your <span class="application_to_topup">application</span>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-lg-2"></div>
                        <div class="col-lg-10"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-lg-2"></div>
                        <div class="col-lg-10"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'. Additionally, by continuing, you confirm this account is in the name provided, and the account holder is the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-lg-2"></div>
                        <div class="col-lg-10 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                   </div>
                
                
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox jisa_pay_option jisa_lumpsum_payment" name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"checked":"";?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                
                <div class="lumpsum_payment_box   <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"":"hide";?>">
                    <div class="row form-group">
                        <div class="col-lg-2"></div>
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
                        <div class="col-lg-5"></div>
                        <?php if(get_session('valid_dob') == true){?>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10 mt-3"><p>Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> rather than the usual &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?>.</p></div>
                        <?php }?>
                        
                        <?php if(get_session('set_topup') == true){?>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10 mt-3"><p>You can top up your Junior ISA from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?>  in the current tax year.  Don't forget to deduct any payments already made this tax year.<br>Your lump sum payment will be taken at the end of this form.</p></div>
                        <?php }else{?>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10 mt-3"><p>The amount that you can pay into your Junior ISA is from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> in the current tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }?>
                        
                        
                       
                    </div>
                 </div>
                 <?php if(get_session('set_topup') == false){?>
                <div class="row form-row  mb-3">
                    <div class="col-lg-12 font-weight-bold"><label for="transfer_payment" class="btn-payment-option">Make a transfer in from another ISA provider <input type="checkbox" id="transfer_payment" class="badgebox jisa_pay_option jisa_transfer_payment" name="choose_payment_option_transfer" value="1" <?=($payment_options['choose_payment_option_transfer'] == 1)?'checked="checked"':'';?>><span class="badge">&check;</span></label>
                    </div>
                </div>
                
                <div class="transfer_payment_box <?=($payment_options['choose_payment_option_transfer'] == 1)?'':'hide';?>">
                	
                    <div class="row form-row mb-3">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                    <p>To transfer to a Stocks & Shares Junior ISA with Foresters, please complete the transfer form below. If you cannot print, please telephone us and we'll be happy to post you a Transfer form.  Otherwise, click the link below to open the pdf form. The form already includes the details you've provided in this application. If you are transferring into an existing Foresters Junior ISA, please add your policy number on the form.</p>
                    
                    <p>Please print, complete, sign and return to us at the Freepost address provided.  We will set up your Junior ISA, and begin the transfer process as soon as we receive your Transfer form.  We will contact you to confirm when the funds are received from your existing provider.</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="<?=base_url('jisa/transfer_form')?>" class="font-weight-bold" target="_blank">Your Junior ISA Transfer form &raquo;</a></p></div>
                    </div>
                 </div>
                  <?php }?>
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12 pl-2">
            	<button type="submit" name="continue" class="btn pull-right" id="next3" data-step="3">Continue</button>
                <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn ml-2" data-step="2">Back</button>
            </div>
        </div>
         
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
        </form>
