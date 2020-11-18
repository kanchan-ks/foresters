<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$lumpsum_pay_amount_min = BOND_MIN_LUMPSUM_AMOUNT;
$lumpsum_pay_amount_max = BOND_MAX_LUMPSUM_AMOUNT;
?>
 
        <form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
        <input type="hidden" name="data_type" value="payment_options">
        <input type="hidden" name="step" value="4">
        <input type="hidden" name="choose_payment_option_transfer" value="1">
        
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Policy type</div>
        </div> 
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Your details</div>
        </div> 
        <div class="row progressbar mb-2">
            <div class="col-lg-12 bg-limegreen">Applicant</div>
        </div>
        <div class="row progressbar mb-2">
            <div class="col-lg-12 bg-limegreen">Payment options</div>
        </div>
      	<div class="row">
        	<div class="col-lg-12">
            <h3>Lump sum investment</h3>
            <hr>
                 <h4>You can invest a lump sum of between &pound;<?=@number_format(BOND_MIN_LUMPSUM_AMOUNT,'0','',',');?> and &pound;<?=@number_format(BOND_MAX_LUMPSUM_AMOUNT,'0','',',');?> into your Investment Bond.</h4>
                 
                <div class="lumpsum_payment_box mt-5">
                    <div class="row form-group">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <div class="row form-row">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">Please enter the amount you want to invest</span>
                                    <span class="input-group-text">&pound;</span>
                                  </div>
                                  <input type="text" name="lumpsum_innvest_amount" id="lumpsum_innvest_amount" class="form-control lumpsum_innvest_amount" placeholder="" required autocomplete="OFF" data-min="<?=$lumpsum_pay_amount_min?>" data-max="<?=$lumpsum_pay_amount_max?>" value="<?=$payment_options['lumpsum_innvest_amount']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5"></div>
                        
                        <div class=" mb-1 mt-4 <?=($payment_options['lumpsumEmployementStatus'] == "" && $payment_options['lumpsum_money_investment_source'] == "")?"hide":"";?> show_lumpsum_high_value_text">
                    <div class="col-lg-12">
                        <div class="row form-row  mb-3">
                            <div class="col-lg-1"></div>
                                <div class="col-lg-11"><p><strong>Anti-money laundering checks</strong> will take place if you invest a lump sum of &pound;10,000 or more, and as your contributions reach that amount, we need to ask you to complete two additional questions.</p>
        <p>Anti-money laundering checks are required by law for all financial services providers before they are allowed to handle money from customers. The checks are made to make sure you are genuinely who you say you are and that the money has not been acquired illegally.</p>
        <p>We may verify your identity by carrying out an online check with a credit agency who will add a note to your reference file to show that an identity check has been made.  We may pass information to third parties for the prevention of crime or detection of fraud or where required by law.</p></div>
                            </div>
                        </div> 
                        
                       
                     <div class="col-lg-12">
                     
                     	<div class="row form-row  mb-2  antimoney_laundring_box_joint hide">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 font-weight-bold"><h3>First applicant</h3></div>
                                <div class="col-lg-4"></div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     	
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('lumpsumEmployementStatus',$employement_status,$payment_options['lumpsumEmployementStatus'],'class="form-control lumpsumEmployementStatus select2 required" placeholder="Please Select" id="lumpsumEmployementStatus" required')?>
                                    
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
                                    <?=form_dropdown('lumpsum_money_investment_source',$money_investment_source,$payment_options['lumpsum_money_investment_source'],'class="form-control select2 lumpsum_money_investment_source required" placeholder="Please Select" id="lumpsum_money_investment_source" required')?>
                                    
                                    <input type="text" name="lumpsum_money_investment_source_extra" id="lumpsum_money_investment_source_extra" value="<?=$payment_options['lumpsum_money_investment_source_extra']?>" class="form-control <?=($payment_options['lumpsum_money_investment_source_extra'] == "")?"hide":"";?> mt-2 lumpsum_money_investment_source_extra required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>
                     
                     
                     
                     <div class="col-lg-12 antimoney_laundring_box_joint hide">
                     <hr>
                     <div class="row form-row  mb-2">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 font-weight-bold"><h3 class="antimoney_laundring_box_joint hide">Second applicant</h3> </div>
                                <div class="col-lg-4"></div>
                            	<div class="col-lg-5"></div> 
                        </div>
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 font-weight-bold"><label>Employment status:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('lumpsumEmployementStatus_joint',$employement_status,$payment_options['lumpsumEmployementStatus_joint'],'class="form-control lumpsumEmployementStatus_joint select2 required" placeholder="Please Select" id="lumpsumEmployementStatus_joint" required')?>
                                    
                                    <input type="text" name="lumpsumEmployementStatus_extra_joint" id="lumpsumEmployementStatus_extra_joint" value="<?=$payment_options['lumpsumEmployementStatus_extra_joint']?>" class="form-control <?=($payment_options['lumpsumEmployementStatus_extra_joint'] == "")?"hide":"";?> mt-2 lumpsumEmployementStatus_extra_joint required" placeholder='Please enter other employement status' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>  
                     
                     <div class="col-lg-12 antimoney_laundring_box_joint hide">
                        <div class="row form-row  mb-3">
                        	<div class="col-lg-1"></div>
                            <div class="col-lg-2 text-left font-weight-bold"><label class="mt-0">The source of the money you are investing:</label></div>
                                <div class="col-lg-4">
                                    <?=form_dropdown('lumpsum_money_investment_source_joint',$money_investment_source,$payment_options['lumpsum_money_investment_source_joint'],'class="form-control select2 lumpsum_money_investment_source_joint required" placeholder="Please Select" id="lumpsum_money_investment_source_joint" required')?>
                                    
                                    <input type="text" name="lumpsum_money_investment_source_extra_joint" id="lumpsum_money_investment_source_extra_joint" value="<?=$payment_options['lumpsum_money_investment_source_extra_joint']?>" class="form-control <?=($payment_options['lumpsum_money_investment_source_extra_joint'] == "")?"hide":"";?> mt-2 lumpsum_money_investment_source_extra_joint required" placeholder='Please enter other source' required>
                                </div>
                            	<div class="col-lg-5"></div> 
                        </div>
                     </div>
                     
                          
                    </div>
                    
                    
                       
                    </div>
                 </div>
                
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next3" data-step="4">Continue</button>
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
