<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1){
$investment_amount = @number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',');
?>
			
            <?php if(isset($payment_options['lumpsum_innvest_amount']) && $investment_amount > 0){?>
           	<div class="row bg-light">      
                <div class="col-lg-3"><label>Lump sum payment</label></div>
                <div class="col-lg-9 font-weight-bold"><label>&pound;<?=$investment_amount?></label></div>
                
               
            </div> 
            <?php }?>
<?php }?>
           