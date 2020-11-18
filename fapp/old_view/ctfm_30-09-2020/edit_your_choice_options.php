<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>

<form name="frmchoiceoption" id="frmchoiceoption" action="" method="post">
			<input type="hidden" name="data_type" value="your_choice">
			<input type="hidden" name="step" value="3">
			<input type="hidden" name="uid" class="uid" value="">
			
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Unique ID</div>
			</div> 
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your detail</div>
			</div>
			<div class="row">
			<div class="col-md-12">
			<h3>Your choice</h3>
			<hr>
				<h4 class="mt-2 mt-3">Please complete one of the expanding sections below</h4>
				  
				<div class="row form-row  mb-3">
					<div class="col-md-12 font-weight-bold"><label for="reinvest_all_money" class="btn-payment-option">Reinvest all of your CTF <input type="checkbox" id="reinvest_all_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="1"><span class="badge">&check;</span></label>
					</div>
				</div>
				 <div class="reinvest_all_money_box hide">
					<div class="row form-row mt-3 mb-3">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-9"><p>You can choose one or more products below.</p>
						 <label class="font-weight-bold">Please note a maximum of &pound;4,000 can be reinvested into a Lifetime ISA.</label></div>
						<div class="col-md-2"></div> 
					</div>
					
					
						<div class="row form-row mt-2 mb-2">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								   <label for="invest_all_in_lifetime" class="btn-summary-terms"><input type="checkbox" id="invest_all_in_lifetime" name="invest_all_in_lifetime" value="1" class="badgebox invest_all_in_lifetime "><span class="badge">&check;</span></label><p class="mt-3">I wish to reinvest in Lifetime ISA</p>
								 
							</div>
						</div>
						
						<div class="row form-row mt-2 mb-2">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								   <label for="invest_all_in_ssisa" class="btn-summary-terms"><input type="checkbox" id="invest_all_in_ssisa" name="invest_all_in_ssisa" value="1" class="badgebox invest_all_in_ssisa "><span class="badge">&check;</span></label><p class="mt-3">I wish to reinvest in Stocks & Shares ISA</p>
								 
							</div>
						</div>
					 
					
					<div  class="row form-row mt-3 mb-5">
						<div class="col-md-1"></div>
						<div class="col-md-10">
								<div class="input-group">
								  <div class="input-group-prepend">
									<span class="input-group-text">I wish to invest </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_all_lifetimeisa" id="invest_all_lifetimeisa" aria-label="Lifetime ISA Amount" class="form-control invest_all_lifetimeisa " readonly="readonly" >
								   <div class="input-group-prepend">
									<span class="input-group-text">into a Lifetime ISA and the remaining balance into a Stocks & Shares ISA </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_all_ssisa" id="invest_all_ssisa" aria-label="Stocks & Shares ISA Amount" class="form-control invest_all_ssisa" readonly="readonly">
								</div>
						 </div> 
					 </div>
				   </div>
				
				
				<div class="row form-row  mb-3">
					<div class="col-md-12 font-weight-bold"><label for="reinvest_some_money" class="btn-payment-option">Reinvest some, Take some <input type="checkbox" id="reinvest_some_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="2"><span class="badge">&check;</span></label>
					</div>
				</div>
				
				<div class="reinvest_some_money_box hide">
					<div class="row form-row mt-3 mb-3">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-9"><p>You can choose one or more products below.</p>
						 <label class="font-weight-bold">Please note a maximum of &pound;4,000 can be reinvested into a Lifetime ISA.</label></div>
						<div class="col-md-2"></div> 
					</div>
					
					<div class="row form-row mt-2 mb-2">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								   <label for="invest_some_in_lifetime" class="btn-summary-terms"><input type="checkbox" id="invest_some_in_lifetime" name="invest_some_in_lifetime" value="1" class="badgebox invest_some_in_lifetime "><span class="badge">&check;</span></label><p class="mt-3">I wish to invest some in Lifetime ISA</p>
								 
							</div>
						</div>
						
						<div class="row form-row mt-2 mb-2">
							<div class="col-md-1"></div>
							<div class="col-md-7">
								   <label for="invest_some_in_ssisa" class="btn-summary-terms"><input type="checkbox" id="invest_some_in_ssisa" name="invest_some_in_ssisa" value="1" class="badgebox invest_some_in_ssisa "><span class="badge">&check;</span></label><p class="mt-3">I wish to invest some in Stocks & Shares ISA</p>
								 
							</div>
						</div>
					 
					
					<div  class="row form-row mt-3 mb-5">
						<div class="col-md-1"></div>
						<div class="col-md-10">
								<div class="input-group">
								  <div class="input-group-prepend">
									<span class="input-group-text">I wish to invest </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_some_lifetimeisa" id="invest_some_lifetimeisa" aria-label="Lifetime ISA Amount" class="form-control invest_some_lifetimeisa " readonly="readonly" >
								   <div class="input-group-prepend">
									<span class="input-group-text">some into a Lifetime ISA and some balance into a Stocks & Shares ISA </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_some_ssisa" id="invest_some_ssisa" aria-label="Stocks & Shares ISA Amount" class="form-control invest_some_ssisa" readonly="readonly">
								</div>
						 </div> 
					 </div>
					 
					 <div class="row form-row mt-3 mb-2">
						<div class="col-md-1"></div>
						<div class="col-md-7">
							   <label for="accept_some_invest_consent" class="pay-transfer-option"><input type="checkbox" id="accept_some_invest_consent" name="accept_some_invest_consent" value="1" class="badgebox accept_some_invest_consent "><span class="badge">&check;</span>I understand that the remaining balance will be paid out to me.</label><p class="font-weight-bold">Please ensure you complete your bank details as requested below.</p>
							 
						</div>
					</div>
				 </div>
				<div class="row form-row  mb-3">
					<div class="col-md-12 font-weight-bold"><label for="reinvest_take_money" class="btn-payment-option">Take the money <input type="checkbox" id="reinvest_take_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="3"><span class="badge">&check;</span></label>
					</div>
				</div>
				
				<div class="reinvest_take_money_box hide">
					<div class="row form-row mt-2 mb-2">
						<div class="col-md-1"></div>
						<div class="col-md-7">
							   <label for="accept_takemoney_invest_consent" class="pay-transfer-option"><input type="checkbox" id="accept_takemoney_invest_consent" name="accept_takemoney_invest_consent" value="1" class="badgebox accept_takemoney_invest_consent "><span class="badge">&check;</span>I confirm I would like to receive the full maturity amount</label><p class="font-weight-bold">Please ensure you complete your bank details as requested below.</p>
							 
						</div>
					</div>
				 </div>
				 
					<div class="col-md-12 mt-5">
						<button type="submit" name="continue" class="btn pull-right" id="next3" disabled  data-step="3">Continue</button>
						<button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="2">Back</button>
					</div>
				</div> 	
			</div>
			<div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Payment details</div>
            </div>
			<div class="row progressbar mt-2">
				<div class="col-md-12 bg-lightprogress">Declaration</div>
			</div>
			<div class="row progressbar">
				<div class="col-md-12 bg-lightprogress">Confirmation</div>
			</div>
			</form>
       