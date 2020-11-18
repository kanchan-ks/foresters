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
                 <div class="col-md-3">&nbsp;</div>
                <div class="col-md-9 font-weight-bold">
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="https://www.forestersfriendlysociety.co.uk/direct-debit-guarantee"  target="_blank">View and print the Direct Debit Guarantee &raquo;</a></p>  
                </div>
            </div>  
            <?php }?>
           