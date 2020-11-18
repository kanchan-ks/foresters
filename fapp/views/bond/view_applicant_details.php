<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$previous_address = "";	
if(!empty($personal_details)){
								
if($personal_details['address1'] !="")
	$previous_address .= '<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address line 1:</label></div><div class="col-lg-4"><input type="text" disabled="disabled" class="form-control mt-2" value="'.$personal_details['address1'].'"></div><div class="col-lg-4  mb-3"></div>';

if($personal_details['address2'] !="")
	$previous_address .= '<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address line 2:</label></div><div class="col-lg-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$personal_details['address2'].'"></div><div class="col-lg-4 mb-3"></div>';
	
if($personal_details['town'] !="")
	$previous_address .= '<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Town:</label></div><div class="col-lg-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$personal_details['town'].'"></div><div class="col-lg-4  mb-3"></div>';

if($personal_details['county'] !="")
	$previous_address .= '<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>County:</label></div><div class="col-lg-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$personal_details['county'].'"></div><div class="col-lg-4  mb-3"></div>';
	
if($personal_details['postcode_box'] !="")
	$previous_address .= '<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Postcode:</label></div><div class="col-lg-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$personal_details['postcode_box'].'"></div><div class="col-lg-4  mb-3"></div>';	

$previous_address .= '<input name="applicant_hidden_address1" type="hidden" value="'.$personal_details['address1'].'">
<input name="applicant_hidden_address2" type="hidden" value="'.$personal_details['address2'].'">
<input name="applicant_hidden_town_city" type="hidden" value="'.$personal_details['town'].'">
<input name="applicant_hidden_county" type="hidden" value="'.$personal_details['county'].'">
<input name="applicant_hidden_postcode" type="hidden" value="'.$personal_details['postcode_box'].'">';		
}
?>
<form name="frmupdate_applicantdetails" id="frmupdate_applicantdetails" action="" method="post">
        <input type="hidden" name="data_type" value="applicant_details">
        <input type="hidden" name="step" value="3">
        	 
     	   	<div class="row">
            
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Policy type</div>
            </div>
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Your details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-lg-12 bg-limegreen">Applicant</div>
            </div> 
            
            
        	<div class="col-lg-12">
            <h3>Second applicant</h3>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Title</label></div>
                    <div class="col-lg-4">
                    	<?=form_dropdown('applicant_title',$list_title,$applicant_details['applicant_title'],'class="required form-control select2" placeholder="Title"')?>
                       <input type="text" name="applicant_other_title" id="applicant_other_title" value="" class="form-control hide mt-2 applicant_other_title" placeholder='Please enter applicant title'>
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>First name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="first_name" id="first_name" value="<?=$applicant_details['first_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="last_name" id="last_name" value="<?=$applicant_details['last_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-2" id="user_dob">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-lg-4  mb-2">
                        <select name="apl_dob_day" id="apl_dob_day" class="form-control apl_dob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'";
								if($applicant_details['apl_dob_day'] == $d)
									echo " selected";
							
							echo ">".$d."</option>";
							}
						?>
                        </select>
						
						<?=form_dropdown('apl_dob_month',$month,$applicant_details['apl_dob_month'],'class="form-control select2 apl_dob_month" placeholder="Month" id="apl_dob_month"')?>
                        
                        
                        <select name="apl_dob_year" id="apl_dob_year" required class="form-control select2 required apl_dob_year"   placeholder="Year">
                        <option value="">Year</option>
                       <?php 
						$back_year = date('Y', strtotime("-18 years"));
						$last_year = date('Y', strtotime("-80 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'";
								if($applicant_details['apl_dob_year'] == $back_year)
									echo " selected";
							
							echo ">".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-4"></div>
                    
                    </div>
                
              	<div class="form-group">
                	<h3>Second applicant contact details</h3>
                    <hr>
                <div class="row form-row mb-3">
                    <div class="col-md-4 text-right font-weight-bold"><label>Telephone</label></div>
                    <div class="col-md-4">
                        <input type="text" name="applicant2_phone" id="applicant2_phone" value="<?=$applicant_details['applicant2_phone']?>" class="form-control required phone" required autocomplete="OFF" maxlength="13">
                    </div>
                    <div class="col-md-4"></div> 
                </div>
				
				<div class="row form-row mb-3">
                    <div class="col-md-4 text-right font-weight-bold"><label>Email address</label></div>
                    <div class="col-md-4">
                        <input type="text" name="applicant2_email" id="applicant2_email" value="<?=$applicant_details['applicant2_email']?>" class="form-control required" required autocomplete="OFF" maxlength="50">
                    </div>
                    <div class="col-md-4"></div> 
                </div>
				
				<div class="row form-row mb-3">
                    <div class="col-md-4 text-right font-weight-bold"><label>Confirm Email address</label></div>
                    <div class="col-md-4">
                        <input type="text" name="applicant2_cemail" id="applicant2_cemail" value="<?=$applicant_details['applicant2_cemail']?>" class="form-control required" required autocomplete="OFF" maxlength="50">
                    </div>
                    <div class="col-md-4"></div> 
                </div>
                
                </div>
                
                <div class="form-group">
                	<h3>Second applicant address</h3>
                    <hr>
                    <div class="mt-5 mb-3">
                        <div class="col-lg-12 no-padding" style="display:inline-block;">
                            
                               <label for="same_address_applicant" class="btn-applicant-same-addres font-weight-bold mt-1"><input type="checkbox" id="same_address_applicant" name="same_address_applicant" value="1" class="badgebox same_address_applicant" <?php if(isset($applicant_details['same_address_applicant']) && $applicant_details['same_address_applicant']==1){ echo "checked";}?>><span class="badge">&check;</span><p class="mt-2">Same address as first applicant</p></label>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-3 same_as_prev_address <?php if(!isset($applicant_details['same_address_applicant'])){ echo "hide";}?>">
                            <?=$previous_address?>
                     </div> 
                     <div class="show_postcode <?php if(isset($applicant_details['same_address_applicant']) && $applicant_details['same_address_applicant']==1){ echo "hide";}?>" id="applicant_address_area">  
                     <div class="row form-row mb-3  afd-typeahead-container afd-form-control">
                        <div class="col-lg-4 text-left text-lg-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-lg-4  afd-typeahead-field">
                                    <div class="afd-typeahead-query">
                                    <input type="text" name="postcode" id="postcode"  value="<?=$applicant_details['postcode']?>" class="form-control postcode" placeholder="Eg SO15 3EW" autocomplete="off" data-afd-control="typeahead">
                                    </div>
                            </div>
                             <div class="afd-search-again" style="display:none">Search Again</div>
								<div class="afd-manual-input-button" style="display:none">Manual Input</div>
								<div class="afd-manual-input-search-button" style="display:none">Address Search</div>
                        <div class="col-lg-4"></div> 
                        
                    </div>
                    <div class="row form-row mb-3">
                    	<div class="col-lg-4"></div><div class="col-lg-4">Please type your address or postcode and select from the list.</div><div class="col-lg-4"></div>
                        <div class="col-lg-4"></div><div class="col-lg-4"><a href="javascript:;" class="add_address_manually">Enter your address manually</a></div><div class="col-lg-4"></div>
                    </div>
                    <div class="form-group extra_add <?=($applicant_details['address1'] != "")?"":"hide";?>  mt-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-lg-4 afd-input-group ">
                                <input type="text" name="address1" id="address1" value="<?=$applicant_details['address1']?>" class="form-control" required  data-afd-result="Property" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($applicant_details['address2'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="address2" id="address2" value="<?=$applicant_details['address2']?>" class="form-control"  data-afd-result="Street" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($applicant_details['town'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="town" id="town" value="<?=$applicant_details['town']?>" class="form-control" required data-afd-result="Town" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($applicant_details['county'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>County</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="county" id="county" value="<?=$applicant_details['county']?>" class="form-control" required  data-afd-result="TraditionalCounty" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($applicant_details['postcode_box'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="postcode_box" id="postcode_box" value="<?=$applicant_details['postcode_box']?>" class="form-control" required data-afd-result="Postcode" maxlength="10"></div>
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
                     
                 </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next_applicant_details" data-step="3">Continue</button></button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="2">Back</button>
            </div>
        </div>
             </form>