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
        <input type="hidden" name="step" value="2">
        
        <div class="row progressbar">
            <div class="col-md-12 bg-limegreen">Your Details</div>
        </div> 
        <div class="row progressbar mb-2">
            <div class="col-md-12 bg-limegreen">Payment Options</div>
        </div>
     	   <div class="row">
        	<div class="col-md-12">
            <h3>Payment options</h3>
            <hr>
                 <h4>How would you like to add money to your Junior ISA?</h4>
                 <h4 class="mt-2">Please complete one or more of the expanding sections below.</h4>
                 <?php if(get_session('set_topup') == true){?>
                 <h4 class="mt-2">Don't forget to factor in any payments already made this tax year when working out how much you can top-up your Junior ISA by.</h4>
                 <?php }?>
                  <?php if(get_session('valid_dob') == true){ echo '<h4 class="mt-4">'.MAX_DOB_WARNING_MESSAGE_JISA.'</h4>';}?>
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox jisa_pay_option" name="choose_payment_option_monthly" value="1"><span class="badge">&plus;</span></label>
                    </div>
                </div>
                 <div class="monthly_payment_box hide">
                     <div class="row form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" required data-min="<?=JISA_MONTHLY_MIN_AMOUNT?>" data-max="<?=JISA_MONTHLY_MAX_AMOUNT?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div> 
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-9"><p>The monthly contribution that you can pay into your Junior ISA is from &pound;<?=JISA_MONTHLY_MIN_AMOUNT?> up to &pound;<?=JISA_MONTHLY_MAX_AMOUNT?> in the current tax year.</p>
                        <?php if(get_session('set_topup') == true){?>
                 			<p>Don't forget to deduct any payments already made this tax year when working out your monthly payment.</p>
						 <?php }?>
                         <label class="font-weight-bold">Please provide your bank account details:</label></div>
                        <div class="col-md-2"></div> 
                    </div>
                    <div class="row form-row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5 font-weight-bold">
                            <div class="form-container active">
                                    <input placeholder="Account holder name" type="text" name="monthly_account_holder_name" id="monthly_account_holder_name"  class="form-control  mb-3  requried" requried  autocomplete='OFF' >
                                    <input placeholder="Account number" type="text" name="monthly_account_number" id="monthly_account_number" class="form-control mb-3 requried account_number" requried autocomplete='OFF' maxlength="8">
                                    <input placeholder="Sort code" type="text" name="monthly_account_sort_code" id="monthly_account_sort_code"  class="form-control  mt-2 mb-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8">
                            </div>
                        </div>
                        <div class="col-md-5"><!--<div class="card-wrapper"></div>--></div> 
                    </div>
                    <div class="row form-row mt-3 mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10"><label>Your first payment will be collected on or immediately after 1st <?=date("F Y", strtotime("+38 days"))?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your application.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-10"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-10"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-md-1"></div>
                        <div class="col-md-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="javascript:;">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                   </div>
                
                
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox jisa_pay_option" name="choose_payment_option_lumpsum" value="1"><span class="badge">&plus;</span></label>
                    </div>
                </div>
                
                <div class="lumpsum_payment_box hide">
                    <div class="row form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">How much would you like to invest?</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control" placeholder="" required autocomplete="OFF" data-min="<?=$lumpsum_pay_amount_min?>" data-max="<?=$lumpsum_pay_amount_max?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <?php if(get_session('valid_dob') == true){?>
                        <div class="col-md-1"></div>
                        <div class="col-md-10 mt-3"><p>Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> rather than the usual &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?>.</p></div>
                        <?php }?>
                        
                        <?php if(get_session('set_topup') == true){?>
                        <div class="col-md-1"></div>
                        <div class="col-md-10 mt-3"><p>You can top-up your Junior ISA from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?>  in the current tax year.  Don't forget to deduct any payments already made this tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }else{?>
                        <div class="col-md-1"></div>
                        <div class="col-md-10 mt-3"><p>The amount that you can pay into your Junior ISA is from &pound;<?=@number_format($lumpsum_pay_amount_min,'0','',',');?> up to &pound;<?=@number_format($lumpsum_pay_amount_max,'0','',',');?> in the current tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                        <?php }?>
                        
                        
                       
                    </div>
                 </div>
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="transfer_payment" class="btn-payment-option">Make a transfer in from another ISA provider <input type="checkbox" id="transfer_payment" class="badgebox jisa_pay_option" name="choose_payment_option_transfer" value="1"><span class="badge">&plus;</span></label>
                    </div>
                </div>
                
                <div class="transfer_payment_box hide">
                	<div class="row form-row mt-2 mb-2">
                     	<div class="col-md-1"></div>
                        <div class="col-md-8">
                               <label for="ISA_transfer_option" class="pay-transfer-option"><input type="checkbox" id="ISA_transfer_option" name="ISA_transfer_option" value="1" class="badgebox ISA_transfer_option "><span class="badge">&check;</span>Tick this box if you want to transfer an existing JISA or Child Trust Fund to a Foresters JISA.</label>
                             
                        </div>
                    </div>
                    <div class="row form-row mb-3">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                    <p>To transfer to a Stocks & Shares JISA with Foresters, please complete the transfer form below. If you cannot print, please telephone us and we'll be happy to post you a Transfer form.  Otherwise, click the link below to open the pdf form. The form already includes the details you've provided in this application. If you are transferring into an existing Foresters JISA, please add your policy number on the form.</p>
                    
                    <p>Please print, complete, sign and return to us at the Freepost address provided.  We will set up your JISA, and begin the transfer process as soon as we receive your Transfer form.  We will contact you to confirm when the funds are received from your existing provider.</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="<?=base_url('jisa/transfer_form')?>" target="_blank">Your Junior ISA Transfer form &raquo;</a></p></div>
                    </div>
                 </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next3" disabled  data-step="3">Continue</button>
                <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="2">Back</button>
            </div>
        </div>
         
            <div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-md-12 bg-lightprogress">Confirmation</div>
            </div>
        </form>
