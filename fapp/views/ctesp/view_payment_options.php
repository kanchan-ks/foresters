<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
 
        <form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
        <input type="hidden" name="step" value="4">
        
       <div class="row progressbar">
            <div class="col-md-12 bg-limegreen">Your details</div>
        </div>
        <div class="row progressbar">
            <div class="col-md-12 bg-limegreen">Child details</div>
        </div>
        <div class="row progressbar">
            <div class="col-md-12 bg-limegreen">Plan details</div>
        </div> 
        <div class="row progressbar">
            <div class="col-md-12 bg-limegreen">Payment details</div>
        </div> 
     	   <div class="row">
        	<div class="col-md-12">
            <h3>Payment details</h3>
            <hr>
                 <h4>Please complete the monthly Direct Debit section below.</h4>
                 
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><input type="hidden" id="monthly_payment" class="badgebox tesp_pay_option" name="choose_payment_option_monthly" value="1">
                    </div>
                </div>
                 <div class="monthly_payment_box">
                     
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-9"><p>Contributions are set at &pound;<?=TESP_MONTHLY_MIN_AMOUNT?> per month.<input type="hidden" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" required readonly="readonly" value="<?=TESP_MONTHLY_MIN_AMOUNT?>"></label></div>
                        <div class="col-md-1"></div> 
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
                            
                               <label for="accept_account_holder_terms" class="btn-summary-terms font-weight-bold mt-1"><input type="checkbox" id="accept_account_holder_terms" name="accept_account_holder_terms" value="1" class="badgebox "  <?=(isset($payment_options['accept_account_holder_terms']) && $payment_options['accept_account_holder_terms'] == 1)?"checked":"";?>><span class="badge">&check;</span></label><p class="pt-1">Please tick here if payments will be made from a bank account belonging to someone other than yourself.</p>
                             
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
                            <div class="col-lg-7">If the payer does not have an email address, you can leave this section blank. However this may increase the time it takes us to contact them to set the Direct Debit up.</div>
                            <div class="col-lg-3"></div> 
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-1">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-10"><label>Your first payment will be collected on or immediately after 1st <?=get_first_day_of_next_month()?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-10"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your application.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-2"></div>
                        <div class="col-md-10"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-2"></div>
                        <div class="col-md-10"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'. Additionally, by continuing, you confirm this account is in the name provided, and the account holder is the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-md-2"></div>
                        <div class="col-md-10 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                   </div>
                
             
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next3" data-step="4">Continue</button>
                <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="3">Back</button>
            </div>
        </div>
         
            <div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-md-12 bg-lightprogress">Confirmation</div>
            </div>
        </form>
