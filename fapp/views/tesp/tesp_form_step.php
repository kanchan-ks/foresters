<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

				
?>
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <div class="title-content">
                <h3>Tax Exempt Savings Plan</h3>
            </div>
            </div>
        </div>
    </div>
    <div class="tabbable" id="pgbar">
        <?=$progressbar?>
    </div>
    <div class="page">
     	
        <section id="personal_profile_section" class="your_details">
        <form name="frmyourdetails" id="frmyourdetails" action="" method="post">
        <input type="hidden" name="data_type" value="personal_details">
        <input type="hidden" name="step" value="1">
        	<div class="row progressbar mb-2">
            	<div class="col-lg-12 bg-limegreen">Your Details</div>
            </div> 
     	   	<div class="row">
        	<div class="col-lg-12">
            <h3 class="head_title">Your details</h3>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Title</label></div>
                    <div class="col-lg-4">
                    	<?=form_dropdown('title',$list_title,'','class="required select2  form-control" placeholder="Title"')?>
                        <input type="text" name="other_title" id="other_title" value="" class="form-control hide mt-2 other_title" placeholder='Please enter your title'>
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>First name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="first_name" id="first_name" value="" class="form-control required" required autocomplete="OFF" maxlength="20">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="last_name" id="last_name" value="" class="form-control required" required autocomplete="OFF" maxlength="20">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-2" id="user_dob">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-lg-4  mb-2">
                        <select name="dob_day" id="dob_day" class="form-control dob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'>".$d."</option>";
							}
						?>
                        </select>
                   <!-- </div>
                    <div class="col-lg-2  mb-2">-->
						<?=form_dropdown('dob_month',$month,'','class="form-control select2 dob_month" placeholder="Month" id="dob_month"')?>
                    <!--</div>
                    <div class="col-lg-1  mb-2">-->
                        <select name="dob_year" id="dob_year" required class="form-control select2 required dob_year"   placeholder="Year" data-max="<?php if(get_session('set_topup') == true){ echo 50;}else{ echo 40;}?>">
                        <option value="">Year</option>
                        <?php 
						$back_year = date('Y', strtotime("-16 years"));
						$last_year = date('Y', strtotime("-81 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'>".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-xl-5"></div>
                    
                    </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>National Insurance number</label></div>
                    <div class="col-lg-4 d-flex d-lg-flex justify-content-between flex-wrap"><input type="text" name="NI1" id="NI1" maxlength="2" class="form-control ni-segment"  autocomplete="OFF"> <input type="text" name="NI2" id="NI2" maxlength="2" class="form-control ni-segment" autocomplete="OFF"> <input type="text" name="NI3" id="NI3" maxlength="2" class="form-control ni-segment" autocomplete="OFF"> <input type="text" name="NI4" id="NI4" maxlength="2" class="form-control ni-segment" autocomplete="OFF"> <input type="text" name="NI5" id="NI5" maxlength="1" class="form-control ni-segment required ni-segment-last float-right" autocomplete="OFF" required></div>
                    <div class="col-lg-4"></div> 
                </div>
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Phone</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="phone" id="phone" value="" class="form-control required phone" required  autocomplete="OFF">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Email</label></div>
                    <div class="col-lg-4">
                        <input type="email" name="email" id="email" value="" class="form-control required" required autocomplete="OFF" maxlength="50">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                 <div class="row form-row mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Confirm email</label></div>
                    <div class="col-lg-4">
                        <input type="email" name="cemail" id="cemail" value="" class="form-control required" required  autocomplete="OFF" maxlength="50">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                     <div class="form-group">
                        <h3>Your address</h3>
                        
                        
                        <hr>
                             <div class="form-group" id="new_address">
                                 <div class=" afd-typeahead-container afd-form-control row form-row mb-3 ">
                                    <div class="col-lg-4 text-lg-right"><label class=" font-weight-bold">Postcode</label></div>
                                    <div class="afd-typeahead-field col-lg-4  afd-typeahead-query">
                                        <div class="afd-typeahead-query"><input type="text" name="postcode" id="postcode" value="" class="form-control postcode" placeholder="Eg SO15 3EW" autocomplete="off" data-afd-control="typeahead"></div>
                                        <div class="afd-search-again" style="display:none">Search Again</div>
                                        <div class="afd-manual-input-button" style="display:none">Manual Input</div>
                                        <div class="afd-manual-input-search-button" style="display:none">Address Search</div>
                                        </div>
                                        <div class="afd-typeahead-result"></div>
                                        <div class="col-lg-6"></div> 
                                    
                                </div>
                            <!--<div class="row form-row mb-3 afd-form-control">
                                <div class="col-lg-4 text-lg-right">&nbsp;</div>
                                <div class="col-lg-4">
                                   <select class="custom-select form-control select2 postcode_lookup_address_list" data-afd-control="lookupResultsList"></select>
                                </div>
                               <div class="col-lg-6"><span class="address-lines"></span></div> 
                                
                            </div>-->
                            <div class="row form-row mb-3">
                                <div class="col-lg-4"></div><div class="col-lg-4">Please type your address or postcode and select from the list.</div><div class="col-lg-4"></div>
                                <div class="col-lg-4"></div><div class="col-lg-4"><a href="javascript:;" class="add_address_manually">Enter your address manually</a></div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="form-group extra_add hide  mt-3">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Address 1</label></div>
                                    <div class="col-lg-4">
                                        <input type="text" name="address1" id="address1" value="" class="form-control" required data-afd-result="Property" maxlength="50"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group extra_add hide">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Address 2</label></div>
                                    <div class="col-lg-4">
                                        <input type="text" name="address2" id="address2" value="" class="form-control" data-afd-result="Street" maxlength="50"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group extra_add hide">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Town/City</label></div>
                                    <div class="col-lg-4">
                                        <input type="text" name="town" id="town" value="" class="form-control" required data-afd-result="Town" maxlength="50"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group extra_add hide mb-3">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>County</label></div>
                                    <div class="col-lg-4">
                                        <input type="text" name="county" id="county" value="" class="form-control" required data-afd-result="TraditionalCounty" maxlength="50"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group extra_add hide mb-5">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Postcode</label></div>
                                    <div class="col-lg-4">
                                        <input type="text" name="postcode_box" id="postcode_box" value="" class="form-control" required data-afd-result="Postcode" maxlength="10"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="col-lg-12 text-center mb-3 font-weight-bold">Have you changed address in the last 3 months?</div>
                        </div>-->
                        <div class="form-row mt-5">
                            <div class="col-lg-4 font-weight-bold">Have you changed address in the last 3 months?</div>
                                <div class="col-lg-4">
                                    <div class="toggle">
                                        <input type="radio" name="old_address_change" value="1" id="old_address_change_yes" class="yes_box required"/>
                                        <label for="old_address_change_yes">Yes</label>
                                        <input type="radio" name="old_address_change" value="0" id="old_address_change_no" class="no_box required"/>
                                        <label for="old_address_change_no">No</label>
                                    </div>
                               </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div class="form-group hide mt-2 old_address" id="old_address">
                            <div class="row form-row mb-3 afd-typeahead-container afd-form-control">
                                <div class="col-lg-4 text-lg-right"><label class=" font-weight-bold">Postcode</label></div>
                                    <div class="col-lg-4  afd-typeahead-field">
                                        <div class="afd-typeahead-query">
                                        <input type="text" name="postcode_additional" id="postcode_additional" value="" class="form-control"  placeholder="Eg SO15 3EW"  autocomplete="off" data-afd-control="typeahead">
                                        </div>
                                    </div>
                                    <div class="afd-search-again" style="display:none">Search Again</div>
                                    <div class="afd-manual-input-button" style="display:none">Manual Input</div>
                                    <div class="afd-manual-input-search-button" style="display:none">Address Search</div>
                                <!--<div class="col-lg-2  text-lg-right  no-padding">
                                    <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                                </div>-->
                                <div class="col-lg-4"></div> 
                                
                            </div>
                            <div class="row form-row mt-2 mb-3">
                                <div class="col-lg-4"></div><div class="col-lg-6">Please type your previous address or postcode and select from the list.</div><div class="col-lg-2"></div>
                                <div class="col-lg-4"></div><div class="col-lg-6"><a href="javascript:;" class="add_old_address_manually">Enter your address manually</a></div><div class="col-lg-2"></div>
                            </div>
                            
                            <div class="form-group add_old_add_manually hide">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Address 1</label></div>
                                    <div class="afd-input-group col-lg-4">
                                        <input type="text" name="additional_address1" id="additional_address1" value="" class="form-control" required maxlength="50" data-afd-result="Property"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group add_old_add_manually hide">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Address 2</label></div>
                                    <div class="afd-input-group col-lg-4">
                                        <input type="text" name="additional_address2" id="additional_address2" value="" class="form-control"  maxlength="50" data-afd-result="Street"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group add_old_add_manually hide">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Town/City</label></div>
                                    <div class="afd-input-group col-lg-4">
                                        <input type="text" name="additional_town_city" id="additional_town_city" value="" class="form-control" required maxlength="50" data-afd-result="Town"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                            <div class="form-group add_old_add_manually hide  mb-3">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>County</label></div>
                                    <div class="afd-input-group col-lg-4">
                                        <input type="text" name="additional_county" id="additional_county" value="" class="form-control" required maxlength="50" data-afd-result="TraditionalCounty"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>  
                            <div class="form-group add_old_add_manually hide  mb-5">
                                <div class="row form-row mb-3">
                                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Postcode</label></div>
                                    <div class="afd-input-group col-lg-4">
                                        <input type="text" name="additional_postcode_box" id="additional_postcode_box" value="" class="form-control" required maxlength="10"  data-afd-result="Postcode"></div>
                                    <div class="col-lg-4"></div> 
                                </div>
                            </div>
                        </div>
                    </div>

                <div  class="form-group mt-5">
                	<h3 class="use_data_title">How we will use your data</h3>
                    <hr>
                        <div class="col-lg-12 no-padding use_data_content">
                        <p>The information that you provide on this form will be held by Foresters Friendly Society for the purposes of providing a high quality customer experience and to keep you informed of products and services that may interest you. The ways in which we will use your data is laid out in our Privacy Policy. We will never share your data with any other companies for their marketing purposes.</p>
                        <p>We will always respect your preferences as to the information you receive from us and we will tell you how you can opt out in every communication we send you. If you would like to opt out at any time, you can do so by calling 0800 783 4162, emailing <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a>, completing the <a href="https://www.forestersfriendlysociety.co.uk/form-page/contact-preferences-form" target="_blank">online form</a> or writing to us at: Foresters Friendly Society, 29-33 Shirley Road, Southampton SO15 3EW</p>
                        <p>Please note that we will always send you contractual information, such as your annual bonus statement.</p>
                        <p>Where an application is made via a Financial Adviser (FA), you agree to your details being disclosed to that FA until you instruct us otherwise.</p>
                     </div> 
                     
                     <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>How did you hear about us? (Optional)</label></div>
                    <div class="col-lg-4">
                    <?=form_dropdown('HeardAboutUs',$list_how_did_you_hear_aboutus,'','class="form-control HeardAboutUs" placeholder="Please Select" id="HeardAboutUs"')?>
                        
                        <input type="text" name="HeardAboutUs_extra" id="HeardAboutUs_extra" value="" class="form-control hide mt-2 HeardAboutUs_extra required" placeholder='Please enter Introducer number' required maxlength="15" autocomplete="off">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-lg-right font-weight-bold"><label>Offer code (Optional)</label></div>
                    <div class="col-lg-4">
                       <input type="text" name="offer_code" id="offer_code" value="" class="form-control" maxlength="4"></div>
                    <div class="col-lg-4"></div> 
                </div>
               
                 </div>  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next2" data-step="1">Continue</button>
            </div>
        </div>
       
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Plan details</div>
            </div>
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Payment details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
             </form>
        </section>
        
        <section id="plan_profile_section" class="plan_details hide">
        <form name="frmplandetails" id="frmplandetails" action="" method="post">
        <input type="hidden" name="data_type" value="plan_details">
        <input type="hidden" name="step" value="2">
        	<div class="row progressbar mb-2">
            	<div class="col-lg-12 bg-limegreen">Your Details</div>
            </div> 
            <div class="row progressbar mb-2">
            	<div class="col-lg-12 bg-limegreen">Plan Details</div>
            </div> 
     	   	<div class="row">
        	<div class="col-lg-12">
           
              
                
                <div class="form-group">
                	<h3>Monthly contributions</h3>
                   
                    <div class="row form-row mb-2">
                        <div class="col-lg-3 text-left"><label class="font-weight-bold">Contributions are set at &pound;25 per month</label></div>
                    </div>
                    <p class="head_title">Tell us how you want to set up your plan and click 'Continue'.</p>  
                    <hr>
                   <h3>Savings term</h3>
                   
                     <div class="row form-row mb-3">
                     <div class="col-lg-1"></div>
                        <div class="col-lg-8"><p>This Tax Exempt Savings Plan can only mature a minimum of 10 years from today.</p>
                        <p>You can select a term in years or choose a specific maturity date.</p></div>
                    </div> 
                    
               
                    <div class="row form-row mb-3">
                    
                    	<div class="col-lg-3 text-lg-right font-weight-bold"><label>Term in years</label></div>
                        	<div class="col-lg-4" id="terms_years_box">
                                <select name="terms_in_years" id="terms_in_years" class="form-control terms_in_years matuarity_plan select2" placeholder="Years"> 
                                    <option value=" ">Years</option>
                                    <?php for($d=10; $d <= 25; $d++){
                                   			 echo "<option value='".$d."'>".$d." Years</option>";
											}
                                    ?>
                                </select>
                               </div>
                    </div> 
                    <div class="row form-row mb-3">
                    	<div class="col-lg-4 text-lg-right">OR</div>
                    </div>
                    <div class="row form-row mb-2" id="specific_matuarity_date_box">
                        <div class="col-lg-3 text-lg-right font-weight-bold"><label>Specific maturity date</label></div>
                        <div class="col-lg-4  mb-2">
                            <select name="specific_matuarity_day" id="specific_matuarity_day" class="form-control select2 specific_matuarity_day" placeholder="Day">
                            <option value=" ">Day</option>
                            <?php for($d=1; $d <= 31; $d++){
                                echo "<option value='".$d."'>".$d."</option>";
                                }
                            ?>
                            </select>
                           <?=form_dropdown('specific_matuarity_month',$list_maturity_month,'','class="form-control select2 specific_matuarity_month" placeholder="Month" id="specific_matuarity_month"')?>
                           <select name="specific_matuarity_year" id="specific_matuarity_year" class="form-control select2 specific_matuarity_year matuarity_plan"   placeholder="Year">
                            <option value=" ">Year</option>
                            <?php 
                            $maturity_year = date('Y', strtotime("+10 years"));
                            $maturity_next_year = date('Y', strtotime("+25 years"));
                            for($maturity_year; $maturity_year <= $maturity_next_year; $maturity_year++){
                                echo "<option value='".$maturity_year."'>".$maturity_year."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-lg-5"></div>
                    
                    </div>
                </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next_plan_details" data-step="3">Continue</button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="1">Back</button>
            </div>
        </div>
       
            <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Payments</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Summary</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
             </form>
        </section>
       
        <section id="payment_option_section" class="your_details hide">
        <span class="view_payment_option_section"></span>
        <?php //$this->view('tesp/view_payment_options'); ?>
        </section>
        
        <section id="summary_section" class="your_details hide">

        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Your details</div>
        </div>
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Plan details</div>
        </div> 
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Payment details</div>
        </div> 
        <div class="row progressbar mb-2">
            <div class="col-lg-12 bg-limegreen">Summary</div>
        </div>

            <div class="row">
                <div class="col-lg-12">
                <h3>Summary</h3>
                
                <hr>
                     <h4>Please check your details. If you need to make changes, click 'Edit'. When you have finished, click 'Submit Application' to complete your application.</h4>
                        
                        <div class="mt-5 summarybox">
                            <h4 class="summary_heading pull-left">Your details</h4>
                           <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_summary" data-type="personal_profile_section" data-step="1"><i class="fa fa-pencil"></i> Edit</a>
                            
                        </div>
                        <span class="edit_personal_section"></span>
                        <div class="col-lg-12 summary_personal_section"></div>
                        
                        <div class="mt-5 summarybox">
                            <h4 class="summary_heading pull-left">Plan details</h4>
                           <a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_plan" data-type="plan_profile_section" data-step="2"><i class="fa fa-pencil"></i> Edit</a>
                            
                        </div>
                        <span class="edit_plan_section"></span>
                        <div class="col-lg-12 summary_plan_section"></div>
                        
                        <div class="mt-5 summarybox">
                           <h4 class="summary_heading pull-left">Payments</h4>
                            	<a href="javascript:;" class="summary_edit btn btn-sm btn-warning edit_payment" data-type="payment_option_section" data-step="3"><i class="fa fa-pencil"></i> Edit</a>
                            
                        </div>
                       <span class="edit_payment_options"></span>
                        <div class="col-lg-12 summary_payment_options"></div> 
                    
              	
              <form name="frmsummary" id="frmsummary" action="" method="post">
                <input type="hidden" name="data_type" value="data_summary">
                <input type="hidden" name="step" value="3">
              		<div class="mt-5 mb-3">
                        <div class="col-lg-12">
                            
                               <label for="summary_accept_terms" class="btn-summary-terms font-weight-bold mt-1"><input type="checkbox" id="summary_accept_terms" name="summary_accept_terms" value="1" class="badgebox  required" required><span class="badge">&check;</span></label><p>By submitting this application, I confirm I have read and understood the <a href="https://www.forestersfriendlysociety.co.uk/online-application-tesp-declaration" target="_blank" class="view_declaration">declaration</a>, <a href="https://www.forestersfriendlysociety.co.uk/privacy-policy" target="_blank" class="view_declaration">privacy policy</a> and the product information provided. I also confirm that I have read and understood the <a href="https://www.forestersfriendlysociety.co.uk/tesp-important-information" target="_blank" class="view_declaration">Important Information</a> and <a href="https://www.forestersfriendlysociety.co.uk/tesp-key-information-document" target="_blank" class="view_declaration">Key Information</a> Documents.</p>
                             
                        </div>
                    </div>
                    
                    <div class="mb-3">
                   		 <div class="col-lg-12">
                            <p style="display:inline-flex;">For your own benefit and protection you should read the declaration carefully before proceeding as this is Foresters Friendly Society’s standard client agreement upon which we intend to rely. If you do not understand any point please ask for further information.</p>
                        </div>
                    </div>
                    <div class="mt-3  mb-3 bg-light lumpsum_account_verify_text hide">
                   		 <div class="col-lg-12 	">
                            <h4 class="font-weight-bold">Making your lump sum payment</h4>
<p>Once you submit this form you will be redirected to the WorldPay secure website to make your payment. Please note that payment can only be made via debit card and the account must be in your name.</p>

<p>Once your payment is confirmed, your Tax Exempt Savings Plan application will be submitted to Foresters Friendly Society.</p>


                        </div>
                    </div>
                    
           

            <div class="row mt-3">
                <div class="col-lg-12">
                    <!--<button type="submit" name="continue" class="btn pull-right" id="next4" data-step="3">Submit Application</button>--> <button type="submit" name="continue" class="btn pull-right" id="next5">Submit Application</button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="3">Back</button>
                </div>
            </div>
            
            <div class="row progressbar m2-2">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
            </div>
             </form>
              </div>  
            </div>  
        </section> 
       
        <section id="lumpsum_payment_section" class="your_details hide">
         <form name="frmlumpsum" id="frmlumpsum" action="" method="post">
          <input type="hidden" name="data_type" value="payment_lumpsum">
          <input type="hidden" name="step" value="4">
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Your Details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Payments</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Summary</div>
            </div>
             <div class="row progressbar mb-2">
                <div class="col-lg-12 bg-limegreen">Credit Card</div>
            </div>
     	   <div class="row">
        	<div class="col-lg-12">
            <h3>Make a lump sum payment</h3>
           
            <hr>
                 <h4>Please note that payment can only be made via debit card and the card must be in your name</h4>
                
               <div class="row form-row">
               			<div class="col-lg-4"></div>
               			<div class="col-lg-5"><div class="card-wrapper-payment"></div></div> 
                        <div class="col-lg-12 font-weight-bold mt-3">
                            <div class="row form-container-payment active">
                                    <div class="col-lg-3"><label>Enter your card number</label></div>
                                    <div class="col-lg-5"><input id="lumpsum_card_number" placeholder="**** **** **** ****" type="tel" name="number" class="form-control mb-3 requried lumpsum_pay" requried autocomplete='OFF'></div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-3"><label>Enter your name as appear on card</label></div>
                                    <div class="col-lg-5"><input placeholder="Full Name" type="text"  name="name"  id="lumpsum_card_name"  class="form-control  mb-3  requried lumpsum_pay" requried  autocomplete='OFF'></div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-3"><label>Expiry date</label></div>
                                    <div class="col-lg-2"><input placeholder="MM/YY" type="text"  name="expiry"  id="lumpsum_card_expiry" class="form-control  mb-3  requried lumpsum_pay" requried  autocomplete='OFF' maxlength="7"></div>
                                    <div class="col-lg-1"><label>CVV</label></div>
                                    <div class="col-lg-2"><input placeholder="***" type="text"   name="cvc"  id="lumpsum_card_cvv" class="form-control mb-3 requried lumpsum_pay" requried  autocomplete='OFF'></div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-3"><label>Lump sum payment</label></div>
                           			<div class="col-lg-5 font-weight-bold"><label>&pound;350</label></div>
                                    <div class="col-lg-4"></div>
                            </div>
                        </div>
                        
                    </div>
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next8" disabled>Submit Application</button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="3">Back</button>
            </div>
        </div>
         <div class="row progressbar mt-2">
                <div class="col-lg-12 bg-lightprogress">Confirmation</div>
          </div>
          </form>
        </section>
        
        <section id="confirmation_section" class="your_details hide">
         	<div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Your Details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Payments</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Summary</div>
            </div>
            <div class="row progressbar mb-2">
                <div class="col-lg-12 bg-limegreen">Confirmation</div>
            </div>
     	   <div class="row">
			<div class="col-lg-12">
			<h3>Thank you</h3>
			
			<hr>
				 <h4>Your Tax Exempt Savings Plan application has been submitted.</h4>
				
			   <div class="row form-row">
						<div class="col-lg-12"><label>Your monthly contribution by Direct Debit has now been set up. The first payment will be collected on or around 1st <?=get_first_day_of_next_month()?>.</label></div>
				</div> 
					   <div class="row form-row">
						   <div class="col-lg-12"><p><strong>Reference number: <span id="customer_ref_number">FFS1023702</span></strong><br>
				
				This reference number will be emailed to you but you can also print this page. Please quote this reference number whenever you talk to us about your Tax Exempt Savings Plan.<br><br>
				
				<strong>What happens next?</strong><br>
				
				You will receive your Tax Exempt Savings Plan pack in the post within 5 working days. Please keep it in a safe place.<br><br>
				
				
				If you have any questions, please contact our Member Services team:<br>
				
				Email: <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a><br>
				
				Telephone: 0800 988 2418<br><br>
				
				<strong>Or write to:</strong><br>
				
				Foresters Friendly Society<br>Foresters House<br>29/33 Shirley Road<br>Southampton<br>SO15 3EW<br><br>
				
				Thank you for choosing us as the provider of your Tax Exempt Savings Plan.</p>
				
				<p class="font-weight-bold"><a href="https://www.forestersfriendlysociety.co.uk/foresters-customers/foresters-extras" target="_blank">Now you're a member, don't forget about your free member benefits. </a></p>
						</div>
				</div>
			</div>
                        
            </div> 
        <div class="row">
        	<div class="col-lg-12">
            	<a href="<?=base_url('tesp/close_application')?>" class="btn pull-right closebtn">Close this window</a>
            </div>
        </div>
        </section>
        
    </div>
