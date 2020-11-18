<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
//echo "test<pre>";
//print_r($payment_options);
?>

<form name="frmupdate_paymentoption" id="frmupdate_paymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
     	   <div class="row">
        	<div class="col-md-12">
            	 <hr>
				<h4>Please complete the monthly Direct Debit section below.<input type="hidden" id="monthly_payment" class="badgebox ctesp_pay_option" name="choose_payment_option_monthly" value="1"></h4>
                
                <?php if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1){?>
                           
           
               
                 <div class="monthly_payment_box <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>">
                 <div class="row form-row mt-3 mb-3">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-9"><p>Contributions are set at &pound;25 per month.<input type="hidden" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" required readonly="readonly" value="25"></label></div>
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
                    <div class="row form-row mt-3 mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10"><label>Your first payment will be collected on or immediately after 1st <?=get_first_day_of_next_month()?>.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-11"><label>All information relating to your Direct Debit will be confirmed in writing within 5 working days of your application.</label></div>
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><label>Please note that this Direct Debit, whilst being set up online, will still be covered by the standard Direct Debit safeguards and guarantees under the Direct Debit Scheme.</label></div>
                       
                    </div>
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-md-1"></div>
                        <div class="col-md-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>
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
       