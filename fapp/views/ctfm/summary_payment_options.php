<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

?>
			
            <div class="row bg-light">
                <div class="col-md-3"><label>Account holder name</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options->account_holder_name?></label></div>
                <div class="col-md-3"><label>Account number</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options->account_number?></label></div>
                <div class="col-md-3"><label>Sort Code</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options->sort_code?></label></div>
                <div class="col-md-3"><label>Building Society Ref/Roll number (if you have one)</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$payment_options->building_society_number?></label></div>
            </div>  