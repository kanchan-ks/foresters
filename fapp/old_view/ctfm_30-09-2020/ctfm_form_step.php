<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);


				
?>
	<div class="container-fluid">
        <div class="row">
            <div class="title-content d-none d-md-block">
                <h3>Child Trust Fund Choices form</h3>
            </div>
        </div>
    </div>
    <div class="tabbable" id="pgbar">
        <?=$progressbar?>
    </div>
    <div class="page">
     	<section id="uniqueid_section" class="your_choice ">
        <form name="frmyourchoice" id="frmyourchoice" action="" method="post">
        <input type="hidden" name="data_type" value="your_choice">
        <input type="hidden" name="step" value="1">
        	<div class="row progressbar mb-2">
            	<div class="col-md-12 bg-limegreen">Unique ID</div>
            </div> 
     	   	<div class="row">
        	<div class="col-md-12">
            <h3 class="head_title">Unique ID</h3>
            <hr>
                
                <h4 class="mb-3 mt-3">Please enter your unique Child Trust Fund ID number and date of birth:</h4>
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Unique ID number</label></div>
                    <div class="col-md-4">
                        <input type="text" name="uniqueID" id="uniqueID" value="" class="form-control required" required autocomplete="OFF" maxlength="5">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
             
                <div class="row form-row mb-2">
                    <div class="col-md-3 text-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-md-1  mb-2">
                        <select name="fdob_day" id="fdob_day" class="form-control dob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'>".$d."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-md-2  mb-2">
						<?=form_dropdown('fdob_month',$month,'','class="form-control select2 fdob_month" placeholder="Month" id="fdob_month"')?>
                    </div>
                    <div class="col-md-1  mb-2">
                        <select name="fdob_year" id="fdob_year" required class="form-control select2 required fdob_year"   placeholder="Year">
                        <option value="">Year</option>
                        <?php 
						$back_year = date('Y', strtotime("-17 years"));
						$last_year = date('Y', strtotime("-20 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'>".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-md-5"></div>
                    
                    </div>
                	<div class="row">
                        <div class="col-md-12">
                            <p class="mb-3">Your unique ID number is the code which is provided in the letter you’ll have received from Foresters confirming your Child Trust Fund value and maturity date. If you do not have your code please call us on 0800 988 2418.</p>
                        </div>
                    </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right find_data" id="next1" data-step="1">Continue</button>
            </div>
        </div>
       		
            <div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Your details</div>
            </div>
             <div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Your Choice</div>
            </div>
            <div class="row progressbar">
                <div class="col-md-12 bg-lightprogress">Your Identity</div>
            </div> 
            <div class="row progressbar">
                <div class="col-md-12 bg-lightprogress">Declaration</div>
            </div>
            <div class="row progressbar">
                <div class="col-md-12 bg-lightprogress">Confirmation</div>
            </div>
             </form>
        </section>
        <section id="personal_profile_section" class="your_details">
        	<span class="view_personal_details_section"></span>
        </section>
       
        <section id="your_choice_section" class="your_details hide">
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
					<div class="col-md-12 font-weight-bold"><label for="reinvest_all_money" class="btn-payment-option">Reinvest all of your CTF <input type="radio" id="reinvest_all_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="1"><span class="badge">&check;</span></label>
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
								   <label for="invest_all_in_lifetime" class="btn-summary-terms"><input type="checkbox" id="invest_all_in_lifetime" name="invest_all_in_lifetime" value="1" class="badgebox invest_all_in_lifetime"><span class="badge">&check;</span></label><p class="mt-3">I wish to reinvest in Lifetime ISA</p>
								 
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
								  <input type="text" name="invest_all_lifetimeisa" id="invest_all_lifetimeisa" aria-label="Lifetime ISA Amount" class="form-control invest_all_lifetimeisa " readonly="readonly"  autocomplete="off" >
								   <div class="input-group-prepend">
									<span class="input-group-text">into a Lifetime ISA and the remaining balance into a Stocks & Shares ISA </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_all_ssisa" id="invest_all_ssisa" aria-label="Stocks & Shares ISA Amount" class="form-control invest_all_ssisa" readonly="readonly" autocomplete="off">
								</div>
						 </div> 
					 </div>
				   </div>
				
				
				<div class="row form-row  mb-3">
					<div class="col-md-12 font-weight-bold"><label for="reinvest_some_money" class="btn-payment-option">Reinvest some, Take some <input type="radio" id="reinvest_some_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="2"><span class="badge">&check;</span></label>
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
								  <input type="text" name="invest_some_lifetimeisa" id="invest_some_lifetimeisa" aria-label="Lifetime ISA Amount" class="form-control invest_some_lifetimeisa " readonly="readonly"  autocomplete="off" >
								   <div class="input-group-prepend">
									<span class="input-group-text">some into a Lifetime ISA and some balance into a Stocks & Shares ISA </span><span class="input-group-text">&pound;</span>
								  </div>
								  <input type="text" name="invest_some_ssisa" id="invest_some_ssisa" aria-label="Stocks & Shares ISA Amount" class="form-control invest_some_ssisa" readonly="readonly"  autocomplete="off">
								</div>
						 </div> 
					 </div>
					 
					 <div class="row form-row mt-3 mb-2">
						<div class="col-md-1"></div>
						<div class="col-md-7">
							   <label for="accept_some_invest_consent" class="pay-transfer-option"><input type="checkbox" id="accept_some_invest_consent" name="accept_some_invest_consent" value="1" class="badgebox accept_some_invest_consent "><span class="badge">&check;</span>I understand that the remaining balance will be paid out to me.</label><p class="font-weight-bold">Please ensure you complete your bank details as requested on next page.</p>
							 
						</div>
					</div>
				 </div>
				<div class="row form-row  mb-3">
					<div class="col-md-12 font-weight-bold"><label for="reinvest_take_money" class="btn-payment-option">Take the money <input type="radio" id="reinvest_take_money" class="badgebox ctfm_pay_option" name="reinvest_all_money" value="3"><span class="badge">&check;</span></label>
					</div>
				</div>
				
				<div class="reinvest_take_money_box hide">
					<div class="row form-row mt-2 mb-2">
						<div class="col-md-1"></div>
						<div class="col-md-7">
							   <label for="accept_takemoney_invest_consent" class="pay-transfer-option"><input type="checkbox" id="accept_takemoney_invest_consent" name="accept_takemoney_invest_consent" value="1" class="badgebox accept_takemoney_invest_consent "><span class="badge">&check;</span>I confirm I would like to receive the full maturity amount</label><p class="font-weight-bold">Please ensure you complete your bank details as requested on the next page.</p>
							 
						</div>
					</div>
				 </div>
                 
                 <div class="mt-4 summary_investment_terms hide">
                        <div class="col-md-12">
                               <label for="summary_accept_terms" class="btn-summary-terms font-weight-bold mt-1"><input type="checkbox" id="summary_accept_terms" name="summary_accept_terms_lisa" value="1" class="badgebox  required" required><span class="badge">&check;</span></label><p class="mt-2">By submitting this application, I confirm I have read and understood the Lifetime ISA <a href="https://www.forestersfriendlysociety.co.uk/" target="_blank" class="view_declaration">declaration</a>, <a href="https://www.forestersfriendlysociety.co.uk/privacy-policy/" target="_blank" class="view_declaration">privacy policy</a> and the product information provided. I also confirm that I have read and understood the <a href="https://www.forestersfriendlysociety.co.uk/wp-content/uploads/2020/04/Lifetime_ISA_Important_Information_Foresters_Friendly_Society.pdf" target="_blank" class="view_declaration">Important Information</a> and <a href="https://www.forestersfriendlysociety.co.uk/wp-content/uploads/2020/04/Lifetime_ISA_KID_Foresters_Friendly_Society.pdf" target="_blank" class="view_declaration">Key Information</a> Documents.</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 summary_investment_terms_ssisa hide">
                        <div class="col-md-12">
                               <label for="summary_accept_terms_ssisa" class="btn-summary-terms font-weight-bold mt-1"><input type="checkbox" id="summary_accept_terms_ssisa" name="summary_accept_terms_ssisa" value="1" class="badgebox  required" required><span class="badge">&check;</span></label><p class="mt-2">By submitting this application, I confirm I have read and understood the Stocks & Shares ISA <a href="https://www.forestersfriendlysociety.co.uk/" target="_blank" class="view_declaration">declaration</a>, <a href="https://www.forestersfriendlysociety.co.uk/privacy-policy/" target="_blank" class="view_declaration">privacy policy</a> and the product information provided. I also confirm that I have read and understood the <a href="https://www.forestersfriendlysociety.co.uk/wp-content/uploads/2020/04/Lifetime_ISA_Important_Information_Foresters_Friendly_Society.pdf" target="_blank" class="view_declaration">Important Information</a> and <a href="https://www.forestersfriendlysociety.co.uk/wp-content/uploads/2020/04/Lifetime_ISA_KID_Foresters_Friendly_Society.pdf" target="_blank" class="view_declaration">Key Information</a> Documents.</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 mb-4 summary_investment_terms summary_investment_terms_ssisa hide">
                   		 <div class="col-md-12">
                            <p style="display:inline-flex;">For your own benefit and protection you should read the declaration carefully before proceeding as this is Foresters Friendly Society’s standard client agreement upon which we intend to rely. If you do not understand any point please ask for further information.</p>
                        </div>
                    </div>
				 
					<div class="col-md-12 mt-5">
						<button type="submit" name="continue" class="btn pull-right" id="next3" data-step="3">Continue</button>
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
        </section>
        
		<section id="payment_option_section" class="your_details hide">
			<form name="frmpaymentoption" id="frmpaymentoption" action="" method="post">
			<input type="hidden" name="data_type" value="your_choice">
			<input type="hidden" name="step" value="4">
			<input type="hidden" name="uid" class="uid" value="">
			
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Unique ID</div>
			</div> 
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your detail</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your choice</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Payment details</div>
			</div>
			<div class="row">
			<div class="col-md-12">
			<h3>Payment details</h3>
			<hr>
				 	<div class="row form-row mt-3 mb-3">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-11">Payment can only be made to a UK bank account in your name. Payment will be sent via BACS and will take 3-5 working days following your 18th birthday or receipt of this form, whichever is the later date. Please provide your details here:</div>
						
					</div>
					
					<div class="row form-row">
						<div class="col-md-1"></div>
						<div class="col-md-5 font-weight-bold">
							<div class="form-container active">
									<input placeholder="Account holder name" type="text" name="account_holder_name" id="account_holder_name"  class="form-control  mb-3  requried" requried  autocomplete='OFF' maxlength="30" >
									<input placeholder="Account number" type="text" name="account_number" id="account_number" class="form-control mb-3 requried account_number" requried autocomplete='OFF' maxlength="8">
									<input placeholder="Sort code" type="text" name="account_sort_code" id="account_sort_code"  class="form-control  mt-2 mb-3 requried cvv_sort_code" requried  autocomplete='OFF'  maxlength="8">
                                    <input placeholder="Building Society Ref/Roll number (if you have one)" type="text" name="building_society_number" id="building_society_number"  class="form-control  mt-2 mb-3  building_society_number" autocomplete='OFF'  maxlength="25">
                                    
							</div>
						</div>
						<div class="col-md-5"></div> 
					</div>
				   <div class="row form-row mt-3 mb-3">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-11">If you wish the money to be paid into an overseas bank account, please call us on 0800 988 2418 so we can arrange this for you.</div>
						
					</div>
					<div class="col-md-12 mt-5">
						<button type="submit" name="continue" class="btn pull-right" id="update_payment_details" data-step="4">Continue</button>
						<button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="3">Back</button>
					</div>
				</div> 	
			</div>
			<div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Your Choice</div>
            </div>
			<div class="row progressbar mt-2">
				<div class="col-md-12 bg-lightprogress">Summary</div>
			</div>
			<div class="row progressbar">
				<div class="col-md-12 bg-lightprogress">Confirmation</div>
			</div>
			</form>
		</section>
		
		<section id="your_identity_section" class="your_details hide">
			<form name="frmyouridentity" id="frmyouridentity" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="data_type" value="your_identity">
			<input type="hidden" name="step" value="5">
			<input type="hidden" name="uid" class="uid" value="">
			
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Unique ID</div>
			</div> 
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your detail</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your choice</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Payment details</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your identity</div>
			</div>
			<div class="row">
			<div class="col-md-12">
			<h3>Your identity</h3>
			<hr>
				 	<div class="row form-row mt-3 mb-3">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-11"><p>To be able to carry out your instructions, we need to verify your identity. You will need to provide 1 form of identification from each of the following lists - <strong>"List A - your identity"</strong> and <strong>"List B - your address"</strong>. </p>
<p>Please scan or photograph one/two of the following documents and upload them using the links below <strong>(accepted file formats: jpeg/jpg, png, pdf)</strong> </p>
<p>Your documents should be certified by someone you consider responsible, but who is not a member of your family. The certifier must write on the front of each photocopy, <strong>'I confirm that this is a true copy of the original document'</strong>, then sign, date and print their name, address and telephone number on it.</p>
<p>Personal details must match those on this form.</p>
					</div>
					</div>
                    
                    <div class="row form-row mb-3">
                        <div class="col-md-3 text-right font-weight-bold"><label>ID Proof type</label></div>
                        <div class="col-md-4">
                            <?=form_dropdown('id_proof_type',$list_id_proof_type,'','class="form-control select2 id_proof_type" placeholder="Select ID Proof" id="id_proof_type"')?>
                        </div>
                        <div class="col-md-5"><i class="fa fa-question-circle  list_class_a_help mt-2"  title="Click to View List A - your identity"  aria-hidden="true"></i></div> 
                    </div>
                        <div class=" hide list_a_documents">
                            <div class="row form-row mt-1 mb-3">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 font-weight-bold pb-2 pt-2">List A – your identity</div>	
                                <div class="col-md-7 font-weight-bold pb-2 pt-2">Validity guidelines</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">UK Passport</div>	
                                <div class="col-md-7 pt-1">Passport must be valid and have a future expiry date</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">EU/EEA Passport</div>	
                                <div class="col-md-7 pt-1">Personal details, including signature, must match those on this form</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">Non UK/Non EU Passport </div>	
                                <div class="col-md-7 pt-1">Temporary passports are not acceptable</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">Photocard Provisional/Full  Driving Licence</div>	
                                <div class="col-md-7 pt-1">Personal details, including signature, must match those on this form</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">Photocard Motorcycle Licence</div>	
                                <div class="col-md-7 pt-1">If the address does not match, a reasonable explanation should be supplied</div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-3 pt-1">PASS Card<br />(Card must have a 'PASS' hologram on it)</div>	
                                <div class="col-md-7 pt-1">Citizen Card<br />Validate UK Card</div>
                            </div>
                        </div>
                     <div class="row form-row mb-3">
                        <div class="col-md-3 text-right font-weight-bold"><label>Upload ID Proof</label></div>
                        <div class="col-md-4">
                            <input type="file" name="id_proof_file" class="form-control">
                        </div>
                        <div class="col-md-5"></div> 
                    </div>
                    
                    <div class="row form-row mb-3">
                        <div class="col-md-3 text-right font-weight-bold"><label>Address Proof type</label></div>
                        <div class="col-md-4">
                            <?=form_dropdown('address_proof_type',$list_address_proof_type,'','class="form-control select2 address_proof_type" placeholder="Select Address Proof" id="address_proof_type"')?>
                        </div>
                        <div class="col-md-5"><i class="fa fa-question-circle  list_class_b_help mt-2" title="Click to View List B - your address" aria-hidden="true"></i></div> 
                    </div>
                     <div class=" hide list_b_documents">
                    	<div class="row form-row mt-1 mb-3">
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 font-weight-bold pb-2 pt-2">List B – your address</div>	
                            <div class="col-md-7 font-weight-bold pb-2 pt-2">Validity guidelines</div>
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 pt-1">UK Birth/Adoption Certificate</div>	
                            <div class="col-md-7 pt-1">Full or Abbreviated Birth Certificate<br />A Birth Certificate registered at an overseas Embassy, consulate of Military Barracks</div>
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 pt-1">Bank/Building Society Statement</div>	
                            <div class="col-md-7 pt-1">Must be dated within the last 3 months</div>
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 pt-1">Utility Bill</div>	
                            <div class="col-md-7 pt-1">Must be dated within the last 3 months<br />We can accept mobile phone bills</div>
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 pt-1">College/University Letter</div>	
                            <div class="col-md-7 pt-1">Must be dated within the last 3 months<br />Must be on headed paper from the College/University</div>
                            <div class="col-md-2 pt-1">&nbsp;</div>
                            <div class="col-md-3 pt-1">National Insurance Card</div>	
                            <div class="col-md-7 pt-1">Details must match those on this form</div>
						</div>
                    </div>
                     <div class="row form-row mb-3">
                        <div class="col-md-3 text-right font-weight-bold"><label>Upload Address Proof</label></div>
                        <div class="col-md-4">
                            <input type="file" name="address_proof_file" class="form-control">
                        </div>
                        <div class="col-md-5"></div> 
                    </div>
                    
                        
						
					<div class="row form-row mt-3 mb-3 hide show_hide_lifetimeinvestment">
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-11 font-weight-bold">If you are reinvesting some or all of your CTF in a Lifetime ISA.</div>
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-11"><p class=" font-weight-bold mb-1 mt-3">Before applying, please remember:</p>
									- You must be aged 18-39 to open a Lifetime ISA (LISA)<br>
									- It can only be used by a first time buyer to purchase a home under &pound450,000 or for retirement from age 60<br>
									- There is a government  penalty for withdrawing funds for any other purpose<br>
									- If using your LISA for retirement, you should be self-employed or already maximising contributions to a workplace scheme, otherwise you could miss out on employer contributions<br>
									- LISA savings could affect your entitlement to means-tested benefits<br>
									- This is a medium to long term investment so if you intend to purchase your first home within the next 3 years, you should consider whether a cash LISA may be more suitable<br>
									- Direct Debits or lump sum investment must be paid from a UK bank account<br>
						</div>
					</div>
					
					
					<div class="row form-row mt-3 mb-3 hide show_hide_lifetimeinvestment">
                        <div class="col-md-1"></div>
						<div class="col-md-10">
                               <label for="summary_accept_lisa_terms" class="btn-summary-terms font-weight-bold"><input type="checkbox" id="summary_accept_lisa_terms" name="summary_accept_lisa_terms" value="1" class="badgebox  required" required><span class="badge">&check;</span></label><p class="mt-3">I have read and understood the above information about the Lifetime ISA.</p>
                             
                        </div>
                    </div>
                    
				   <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="continue" class="btn pull-right" id="update_identity_details" data-step="5">Continue</button>
                            <button type="button" name="back" class="btn pull-left m-0 bg-light backbtn" data-step="4">Back</button>
                        </div>
                   </div> 
				</div> 	
			</div>
			<div class="row progressbar mt-2">
                <div class="col-md-12 bg-lightprogress">Your Choice</div>
            </div>
			<div class="row progressbar mt-2">
				<div class="col-md-12 bg-lightprogress">Summary</div>
			</div>
			<div class="row progressbar">
				<div class="col-md-12 bg-lightprogress">Confirmation</div>
			</div>
			</form>
		</section>
			
        <section id="summary_section" class="your_details hide">
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Unique ID</div>
			</div>
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Your details</div>
			</div> 
			<div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Your choice</div>
			</div> 
            <div class="row progressbar">
				<div class="col-md-12 bg-limegreen">Payment details</div>
			</div> 
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Your identity</div>
			</div>
			<div class="row progressbar mb-2">
				<div class="col-md-12 bg-limegreen">Declaration</div>
			</div>

            <div class="row">
                <div class="col-md-12">
                	<h3>Declaration</h3>
	                <hr>
                     <h4>Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your application.</h4>
                        
                        <div class="mt-4 summarybox">
                            <h4 class="summary_heading pull-left">Your details</h4>
                           <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_summary" data-type="personal_profile_section" data-step="2"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-12 summary_personal_section"></div>
                        
                         <div class="mt-5 summarybox">
                            <h4 class="summary_heading pull-left">Your choice</h4>
                           <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_choice" data-type="your_choice_section" data-step="3"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-12 summary_your_choice_section"></div>
                        
                        
                        <div class="mt-5 summarybox summary_payment_box hide">
                           <h4 class="summary_heading pull-left">Payment details</h4>
                                <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_payment" data-type="payment_option_section" data-step="4"><i class="fa fa-pencil"></i> Edit</a>
                            
                        </div>
                      <div class="col-md-12 summary_payment_options hide"></div> 
                      
                      <div class="mt-5 summarybox">
                            <h4 class="summary_heading pull-left">Your identity</h4>
                           <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_idenity" data-type="your_identity_section" data-step="5"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-12 summary_your_identity_section"></div>
                </div> 
			  
			  
              <form name="frmsummary" id="frmsummary" action="" method="post">
                <input type="hidden" name="data_type" value="data_summary">
                <input type="hidden" name="step" value="5">
                	
                 <div class="row">
                	<div class="col-md-12">
                    <div class="mt-4">
                       <div class="col-md-12"><p>Once we receive your details via this form, depending on the option/s you have chosen, you'll receive a policy pack for your new (L)ISA and/or payment will be made to your bank account.</p><p>If we require any additional information we will contact you using the contact details provided, so please ensure your details are correct.</p><p>
If you have any questions or are unsure about how to complete this form please call 0800 101 8312 (lines open Monday – Friday, 9am – 5pm), or email us at <a href="mailto:claims@forestersfriendlysociety.co.uk">claims@forestersfriendlysociety.co.uk</a> and we'll be happy to help.</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                       <div class="col-md-12">
                               <label for="summary_accept_maturity_terms" class="btn-summary-terms font-weight-bold  mt-1"><input type="checkbox" id="summary_accept_maturity_terms" name="summary_accept_maturity_terms" value="1" class="badgebox required valid" required=""><span class="badge">✓</span></label><p class="mt-2">I understand that the maturity amount is the total proceeds arising from the policy, which is in accordance with the policy conditions.<br>I understand that the payment of the maturity amount releases Foresters Friendly Society from all claims arising under this policy.</p>
                        </div>
                    </div>
             		
                    
                    </div>
        
                    
                    <div class="col-md-12">
                        <button type="submit" name="continue" class="btn pull-right" id="next5">Submit Application</button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="5">Back</button>
                    </div>
                   
                  </div>  
                   </form>
                    <div class="row progressbar m2-2">
                        <div class="col-md-12 bg-lightprogress">Confirmation</div>
                    </div>
            
			</div> 
        </section> 
       
        
        
        <section id="confirmation_section" class="your_details hide">
         <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Unique ID</div>
            </div> 
            <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Your details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Make your choice</div>
            </div>
			 <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Payment details</div>
            </div>
             <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Your identity</div>
            </div>
             <div class="row progressbar mb-2">
                <div class="col-md-12 bg-limegreen">Declaration</div>
            </div>
           
     	   <div class="row">
        	<div class="col-md-12">
            <h3>Thank you</h3>
           
            <hr>
            <h4>Your CTF Maturities online portal application has been submitted.</h4>
            
            <div class="row form-row">
                       <div class="col-md-12"><p><strong>Reference number: <span id="customer_ref_number">FFS1023702</span></strong><br>

                            This reference number will be emailed to you but you can also print this page. Please quote this reference number whenever you talk to us about your CTF Maturities online portal.<br><br>
                            
                            <strong>What happens next?</strong><br>
                            
                            You will receive your CTF Maturities online portal pack in the post within 5 working days. Please keep it in a safe place.<br><br>
                            
                            
                            If you have any questions, please contact our Member Services team:<br>
                            
                            Email: <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a><br>
                            
                            Telephone: 0800 988 2418<br><br>
                            
                            <strong>Or write to:</strong><br>
                            
                            Foresters Friendly Society<br>Foresters House<br>29/33 Shirley Road<br>Southampton<br>SO15 3EW<br><br>
                            
                            Thank you for choosing us as the provider of your CTF Maturities online portal.<br>
                            
                            <a href="https://www.forestersfriendlysociety.co.uk/foresters-customers/foresters-extras" target="_blank">Now you're a member, don't forget about your free member benefits</a> </p>
                        </div>
                        
                    </div>
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<a href="<?=base_url('ctfm/close_application')?>" class="btn pull-right closebtn">Close this window</a>
            </div>
        </div>
        </section>
        
    </div>
