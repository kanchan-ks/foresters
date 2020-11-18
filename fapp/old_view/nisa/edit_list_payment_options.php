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
				<h4>How would you like to add money to your Stocks & Shares ISA?</h4>
                 <h4 class="mt-4">Please update the expanding sections below.</h4>
                <?php if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1){?>
                           
           
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="monthly_payment" class="btn-payment-option">Set up a monthly payment by Direct Debit <input type="checkbox" id="monthly_payment" class="badgebox nisa_pay_option" name="choose_payment_option_monthly" value="1" <?=($payment_options['choose_payment_option_monthly'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
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
                                  <input type="text" name="monthly_innvest_amount" id="monthly_innvest_amount" class="form-control required" placeholder="" value="<?=$payment_options['monthly_innvest_amount']?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div> 
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-row mt-3 mb-3">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-9"><p>The monthly contribution that you can pay into your Stocks & Shares ISA is from &pound;50 up to &pound;333 in the current tax year.</p><label class="font-weight-bold">Please provide your bank account details:</label></div>
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
                    <div class="row form-row mb-1">
                    <div class="col-md-1"></div>
                        <div class="col-md-11"><label>By continuing, you confirm that you understand your monthly Direct Debit will be taken from this account on the 1st of each month and will appear on bank statements as 'Ancient Order of Foresters Friendly Society Ltd'.  Additionally, by continuing, you confirm this account is in your name, and you are the only signatory required to authorise payments from this account.</label></div>
                    </div>
                    
                    
                    <div class="row form-row mb-2">
	                    <div class="col-md-1"></div>
                        <div class="col-md-11 font-weight-bold text-left">
                        <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="javascript:;">View and print the Direct Debit Guarantee &raquo;</a></p>
                        </div>
                    </div>
                    
                   </div>
                <?php }?>
                
                
                <?php if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){?>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="lumpsum_payment" class="btn-payment-option">Make a lump sum payment by debit card <input type="checkbox" id="lumpsum_payment" class="badgebox nisa_pay_option" name="choose_payment_option_lumpsum" value="1" <?=($payment_options['choose_payment_option_lumpsum'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
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
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control" placeholder="" value="<?=$payment_options['lumpsum_innvest_amount']?>" required autocomplete="OFF">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div> 
                        <div class="col-md-1"></div>
                        <div class="col-md-11 mt-5"><p>The amount that you can pay into your Stocks & Shares ISA is from &pound;500 up to &pound;4,000 in the current tax year.<br>Your lump sum payment will be taken at the end of your application.</p></div>
                    </div>
                 </div>
                 
                 <?php }?>
                 
              
                 <?php if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){?>
            <hr>
             <div class="row form-row  mb-3">
                    <div class="col-md-12 font-weight-bold"><label for="transfer_payment" class="btn-payment-option">Make a transfer in from another ISA provider <input type="checkbox" id="transfer_payment" class="badgebox nisa_pay_option" name="choose_payment_option_transfer" value="1" <?=($payment_options['choose_payment_option_transfer'] == 1)?"checked":"";?>><span class="badge">&plus;</span></label>
                    </div>
                </div>
                <div class="transfer_payment_box <?=($payment_options['choose_payment_option_transfer'] == 1)?"":"hide";?>">
                     <div class="row form-row">
                        <div class="col-md-1"></div>
                            <div class="col-md-5 font-weight-bold">
                                <div class="form-container active">
                                        <input placeholder="Name of existing provider" type="text" name="transfer_name_existing_provider"  class="form-control  mb-3  requried" requried autocomplete="OFF" value="<?=$payment_options['transfer_name_existing_provider']?>">
                                </div>
                            </div>
                        	<div class="col-md-6"></div> 
                    </div>
                    
                    <div class="row form-row mb-3">
                    <div class="col-md-1"></div>
                    <div class="col-md-5 font-weight-bold">Please provide address of existing provider:</div>
                    </div>
                    <div class="row form-row mb-3">
                    <div class="col-md-1"></div>
                        <div class="col-md-1 text-left"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-md-2">
                            <input type="text" name="transfer_postcode" id="transfer_postcode" value="" class="form-control required postcode" required  autocomplete="OFF" placeholder="Eg SO15 3EW" value="<?=$payment_options['transfer_postcode']?>">
                            </div>
                        <div class="col-md-2  text-right  no-padding">
                            <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                        </div>
                        <div class="col-md-6"><span class="address-lines"></span></div> 
                        
                    </div>
                    <div class="row form-row mb-5">
                    	<div class="col-md-1"></div><div class="col-md-6">Please enter the provider's postcode and click find address.</div><div class="col-md-5"></div>
                        <div class="col-md-1"></div><div class="col-md-6"><a href="javascript:;" class="add_address_manually">Enter address manually</a></div><div class="col-md-5"></div>
                    </div>
                    <div class="form-group extra_add hide  mt-5">
                        <div class="row form-row mb-3">
                             <div class="col-md-1"></div>
                        	<div class="col-md-1 text-left font-weight-bold"><label>Address 1</label></div>
                            <div class="col-md-4">
                                <input type="text" name="transfer_address1" id="transfer_address1" value="" class="form-control" required value="<?=$payment_options['transfer_address1']?>"></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add hide">
                        <div class="row form-row mb-3">
                             <div class="col-md-1"></div>
                        		<div class="col-md-1 text-left font-weight-bold"><label>Address 2</label></div>
                            <div class="col-md-4">
                                <input type="text" name="transfer_address2" id="transfer_address2" value="" class="form-control" required value="<?=$payment_options['transfer_address2']?>"></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add hide">
                        <div class="row form-row mb-3">
                            <div class="col-md-1"></div>
                        <div class="col-md-1 text-left font-weight-bold"><label>Town/City</label></div>
                            <div class="col-md-4">
                                <input type="text" name="transfer_city" id="transfer_city" value="" class="form-control" required value="<?=$payment_options['transfer_city']?>"></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add hide mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-md-1"></div>
                        <div class="col-md-1 text-left font-weight-bold"><label>County</label></div>
                            <div class="col-md-4">
                                <input type="text" name="transfer_county" id="transfer_county" value="" class="form-control" required value="<?=$payment_options['transfer_county']?>"></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add hide mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-1"></div>
                        <div class="col-md-1 text-left font-weight-bold"><label>Postcode</label></div>
                            <div class="col-md-4">
                                <input type="text" name="transfer_postcode_box" id="transfer_postcode_box" value="" class="form-control" required value="<?=$payment_options['transfer_postcode_box']?>"></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="row form-row">
                        <div class="col-md-1"></div>
                            <div class="col-md-5 font-weight-bold">
                                <div class="form-container active">
                                       <input placeholder="Account number" type="text" name="transfer_account_number" id="transfer_account_number" class="form-control mb-3 requried account_number" requried  maxlength="8" value="<?=$payment_options['transfer_account_number']?>">
                                        <input placeholder="Sort code" type="text" name="transfer_accont_sort_code" id="transfer_accont_sort_code"  class="form-control mb-3 requried cvv_sort_code" requried  maxlength="8" value="<?=$payment_options['transfer_accont_sort_code']?>">
                                        <input placeholder="Account reference (if applicable)" type="text" name="transfer_account_reference" id="transfer_account_reference"  class="form-control  mb-3" value="<?=$payment_options['transfer_account_reference']?>">
                                        
                                </div>
                            </div>
                        	<div class="col-md-6"></div> 
                    </div>
                    <div class="row form-row mt-3 mb-2 ">
                        <div class="col-md-1"></div>
                            <div class="col-md-11 font-weight-bold">Type of ISA</div>
                     </div>
                     <div class="row form-row mt-2 mb-2">
                     	<div class="col-md-1"></div>
                        <div class="col-md-2">
                               <label for="type_of_ISA_stock_shares" class="pay-transfer-option"><input type="radio" id="type_of_ISA_stock_shares" name="type_of_ISA" value="Stocks & Shares" class="badgebox type_of_ISA " <?=($payment_options['type_of_ISA'] == "Stocks & Shares")?"checked":"";?>><span class="badge">&check;</span>Stocks & Shares</label>
                             
                        </div>
                        <div class="col-md-2 mb-2">
                               <label for="type_of_ISA_cash" class="pay-transfer-option"><input type="radio" id="type_of_ISA_cash" name="type_of_ISA" value="Cash" class="badgebox type_of_ISA" <?=($payment_options['type_of_ISA'] == "Cash")?"checked":"";?>><span class="badge">&check;</span>Cash</label>
                             
                        </div>
                        <div class="col-md-2">
                               <label for="type_of_ISA_help_to_buy" class="pay-transfer-option"><input type="radio" id="type_of_ISA_help_to_buy" name="type_of_ISA" value="Help To Buy" class="badgebox type_of_ISA" <?=($payment_options['type_of_ISA'] == "Help To Buy")?"checked":"";?>><span class="badge">&check;</span>Help To Buy</label>
                             
                        </div>
                        <div class="col-md-2 mb-2">
                               <label for="type_of_ISA_nisa" class="pay-transfer-option"><input type="radio" id="type_of_ISA_nisa" name="type_of_ISA" value="Stocks & Shares ISA" class="badgebox type_of_ISA" <?=($payment_options['type_of_ISA'] == "Stocks & Shares ISA")?"checked":"";?>><span class="badge">&check;</span>Stocks & Shares ISA</label>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-3 mb-2 <?=($payment_options['type_of_ISA'] == "Stocks & Shares ISA")?"":"hide";?> hmrc_nisa_registration_number_box">
                        	<div class="col-md-1">&nbsp;</div>
                            <div class="col-md-5"><input placeholder="HMRC Stocks & Shares ISA Registration Number (if known)" type="text" name="hmrc_nisa_registration_number"  class="form-control  mb-3" value="<?=$payment_options['hmrc_nisa_registration_number']?>"></div>
                            <div class="col-md-6"></div> 
                    </div>
                     
                    <div class="row form-row mt-3 mb-2 ">
                        <div class="col-md-1"></div>
                            <div class="col-md-11">You can transfer all or part of an existing ISA to Foresters. If you have added funds to the ISA you are transferring in this tax year, please note under HM Revenue & Customs ISA regulations, only whole transfers of current tax year subscriptions can be accepted.</div>
                         </div>
                     <div class="row form-row mt-2 mb-2">
                     	<div class="col-md-1"></div>
                        <div class="col-md-2">
                               <label for="full_transfer_option" class="pay-transfer-option"><input type="radio" id="full_transfer_option" name="payment_transfer_option" value="0" class="badgebox payment_transfer_option" <?=($payment_options['payment_transfer_option'] == "0")?"checked":"";?>><span class="badge">&check;</span>Full Transfer</label>
                             
                        </div>
                        <div class="col-md-2 mb-2">
                               <label for="part_transfer_option" class="pay-transfer-option"><input type="radio" id="part_transfer_option" name="payment_transfer_option" value="1" class="badgebox payment_transfer_option" <?=($payment_options['payment_transfer_option'] == "1")?"checked":"";?>><span class="badge">&check;</span>Part Transfer</label>
                             
                        </div>
                    </div>
                     <div class="row form-row mb-2">
                            <div class="col-md-1">&nbsp;</div>
                                <div class="col-md-5">
                                	<div class="input-group transfer_box">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text label-text">Approximate value</span>
                                        <span class="input-group-text">&pound;</span>
                                      </div>
                                      <input type="text" name="full_transfer_amount" id="full_transfer_amount" class="form-control" placeholder="" value="<?=$payment_options['full_transfer_amount']?>">
                                    </div>
                                </div>
                               <div class="col-md-6 mt-2">The minimum transfer amount is &pound;500</div>     
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