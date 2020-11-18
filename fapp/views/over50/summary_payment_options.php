<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
			 <?php if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1){?>
            <div class="row bg-light">
                <div class="col-md-3"><label>Account holder name</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_holder_name']?></label></div>
                <div class="col-md-3"><label>Account number</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_number']?></label></div>
                <div class="col-md-3"><label>Sort Code</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['monthly_account_sort_code']?></label></div>
                 <?php if(isset($payment_options['accept_account_holder_terms']) && @$payment_options['accept_account_holder_terms'] == 1){?>
                 <div class="col-md-3"><label>Third party payer</label></div>
                <div class="col-md-9 font-weight-bold"><i class="fa fa-check mt-2"></i></div>
                <div class="col-md-3"><label>Name</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=($payment_options['third_party_title']=="Other")?$payment_options['third_party_other_title']:$payment_options['third_party_title'];?> <?=$payment_options['third_party_first_name']?> <?=$payment_options['third_party_last_name']?></label></div>
                <div class="col-md-3"><label>Phone</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['third_party_phone']?></label></div>
                <div class="col-md-3"><label>Email</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options['third_party_email']?></label></div>
                <?php }?>
                 <div class="col-md-3">&nbsp;</div>
                <div class="col-md-9 font-weight-bold">
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>  
                </div>
            </div>  
            <?php }?>
           