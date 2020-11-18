<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
                <div class="row bg-light">
                <?php if($your_choice_details->reinvest_all == 1){?>
                	<div class="col-md-3 font-weight-bold">Reinvest all of your CTF </div> 
                    <div class="col-md-9"></div>  
                    <?php if($your_choice_details->reinvest_all_in_lifetimeisa == 1){?>
                    <?php if($your_choice_details->reinvest_all_in_ssisa == 1){?>
                    	<div class="col-md-3"><label>I wish to reinvest some into a Lifetime ISA</label></div>
                    <?php }else{?>
                   		<div class="col-md-3"><label>I wish to reinvest all in Lifetime ISA</label></div>
                    <?php }?>
                    <div class="col-md-9 font-weight-bold"><label><?=($your_choice_details->reinvest_all_in_lifetimeisa == 1)?'<i class="fa fa-check"></i>':"";?></label></div>
                    <div class="col-md-3"><label>Lifetime ISA value</label></div>
                    <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format($your_choice_details->reinvest_all_lifetime_value,"2",".",",");?></label></div>
                    <?php }?> 
                    <?php if($your_choice_details->reinvest_all_in_ssisa == 1){?>
                    <?php if($your_choice_details->reinvest_all_in_lifetimeisa == 1){?>
                    	<div class="col-md-3"><label>I wish to reinvest some into a Stocks & Shares ISA</label></div>
                    <?php }else{?>
                   		<div class="col-md-3"><label>I wish to reinvest all in Stocks & Shares ISA</label></div>
                    <?php }?>    
                    <div class="col-md-9 font-weight-bold"><label><?=($your_choice_details->reinvest_all_in_ssisa == 1)?'<i class="fa fa-check"></i>':"";?></label></div>
                    <div class="col-md-3"><label>Stocks & Shares ISA value</label></div>
                    <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format($your_choice_details->reinvest_all_ssisa_value,"2",".",",");?></label></div>
                    
                   <?php }?> 
                   <?php }?> 
                   <?php if($your_choice_details->reinvest_some == 1){?>
                    <hr>
                   	<div class="col-md-3 mt-3"><h4 class="font-weight-bold">Reinvest some, Take some</h4></div>
                    <div class="col-md-9"></div>  
                    <?php if($your_choice_details->reinvest_some_in_lifetimeisa == 1){?>
                    <?php if($your_choice_details->reinvest_some_in_ssisa == 1){?>
                    	<div class="col-md-3"><label>I wish to reinvest some into a Lifetime ISA</label></div>
                    <?php }else{?>
                        <div class="col-md-3"><label>I wish to reinvest into a Lifetime ISA</label></div>
                    <?php }?> 
                    <div class="col-md-9 font-weight-bold"><label><?=($your_choice_details->reinvest_some_in_lifetimeisa == 1)?'<i class="fa fa-check"></i>':"";?></label></div>
                    <div class="col-md-3"><label>Lifetime ISA value</label></div>
                    <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format($your_choice_details->reinvest_some_in_lifetime_value,"2",".",",");?></label></div>
                    <?php }?>
                    <?php if($your_choice_details->reinvest_some_in_ssisa == 1){?>
                     <?php if($your_choice_details->reinvest_some_in_lifetimeisa == 1){?>
                    	<div class="col-md-3"><label>I wish to reinvest some into a Stocks & Shares ISA</label></div>
                    <?php }else{?>
                        <div class="col-md-3"><label>I wish to reinvest into a Stocks & Shares ISA</label></div>
                    <?php }?>
                    <div class="col-md-9 font-weight-bold"><label><?=($your_choice_details->reinvest_some_in_ssisa == 1)?'<i class="fa fa-check"></i>':"";?></label></div>
                    <div class="col-md-3"><label>Stocks & Shares ISA value</label></div>
                    <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format($your_choice_details->reinvest_some_in_ssisa_value,"2",".",",");?></label></div>
                    <?php }?>
                    <div class="col-md-12 font-weight-bold"><label>The remaining balance will be paid out</label></div>
                    <?php }?> 
                    <?php if($your_choice_details->take_the_money == 1){?>
                     <hr>
                   	<div class="col-md-3 font-weight-bold">Take the money</div> 
                    <div class="col-md-9"></div>
                    <div class="col-md-3"><label>I confirm I would like to receive the full maturity amount</label></div>
                    <div class="col-md-9 font-weight-bold"><label><?=($your_choice_details->take_the_money_terms == 1)?'<i class="fa fa-check"></i>':"";?></label></div>
                     <?php }?> 
                    
                </div>