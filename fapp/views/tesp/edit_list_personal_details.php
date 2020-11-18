<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

if(!isset($personal_details['old_address_change']))
	$personal_details['old_address_change'] = 0;
?>
<form name="frmupdate_yourdetails" id="frmupdate_yourdetails" action="" method="post">
        <input type="hidden" name="data_type" value="personal_details">
        	
     	   	<div class="row">
        	<div class="col-md-12">
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Title</label></div>
                    <div class="col-md-4">
                    	<?=form_dropdown('title',$list_title,$personal_details['title'],'class="required form-control title" placeholder="Title"')?>
                        <input type="text" name="other_title" id="other_title" value="<?=$personal_details['other_title']?>" class="form-control <?=($personal_details['title']=="Other")?"":"hide";?> mt-2 other_title" placeholder='Please enter your title'>
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>First name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="first_name" id="first_name" value="<?=$personal_details['first_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" id="last_name" value="<?=$personal_details['last_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-2">
                    <div class="col-md-3 text-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-md-1  mb-2">
                        <select name="dob_day" id="dob_day" class="form-control dob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'";
								if($personal_details['dob_day'] == $d)
									echo " selected";
							
							echo ">".$d."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-md-2  mb-2">
						<?=form_dropdown('dob_month',$month,$personal_details['dob_month'],'class="form-control select2 dob_month" placeholder="Month" id="dob_month"')?>
                    </div>
                    <div class="col-md-1  mb-2">
                        <select name="dob_year" id="dob_year" required class="form-control select2 required dob_year"   placeholder="Year">
                        <option value="">Year</option>
                        <?php 
						$back_year = date('Y', strtotime("-18 years"));
						$last_year = date('Y', strtotime("-81 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'";
								if($personal_details['dob_year'] == $back_year)
									echo " selected";
							
							echo ">".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-md-5"></div>
                    
                    </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>National Insurance number</label></div>
                    <div class="col-md-4"><input type="text" name="NI1" id="NI1" maxlength="2" class="form-control ni-segment"  autocomplete="OFF" value="<?=$personal_details['NI1']?>"> <input type="text" name="NI2" id="NI2" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$personal_details['NI2']?>"> <input type="text" name="NI3" id="NI3" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$personal_details['NI3']?>"> <input type="text" name="NI4" id="NI4" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$personal_details['NI4']?>"> <input type="text" name="NI5" id="NI5" maxlength="1" class="form-control ni-segment required ni-segment-last" autocomplete="OFF" required value="<?=$personal_details['NI5']?>"></div>
                    <div class="col-md-5"></div> 
                </div>
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Phone</label></div>
                    <div class="col-md-4">
                        <input type="text" name="phone" id="phone"  value="<?=$personal_details['phone']?>" class="form-control required phone" required  autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Email</label></div>
                    <div class="col-md-4">
                        <input type="email" name="email" id="email"  value="<?=$personal_details['email']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                 <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Confirm email</label></div>
                    <div class="col-md-4">
                        <input type="email" name="cemail" id="cemail"  value="<?=$personal_details['cemail']?>" class="form-control required" required  autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
               <?php if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){?>
                    <div class="form-group mb-5 mt-5">
                        <h3>Existing policy details</h3>
                        <hr>
                            <div class="row form-row  mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>Existing Tax Exempt Savings Plan policy number</label></div>
                                <div class="col-md-4">
                                   <input type="text" name="toptup_policy_number" id="toptup_policy_number" value="<?=$personal_details['toptup_policy_number']?>" class="form-control toptup_policy_number" maxlength="17"></div>
                                <div class="col-md-5"></div> 
                            </div>
                            
                    </div>
                <?php }?>
                
                
                <div class="form-group">
                	<h3>Your address</h3>
                    <hr>
                     <div class="row form-row mb-3">
                        <div class="col-md-3 text-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-md-2">
                            <input type="text" name="postcode" id="postcode"  value="<?=$personal_details['postcode']?>" class="form-control postcode" placeholder="Eg SO15 3EW">
                            </div>
                        <div class="col-md-2  text-right  no-padding">
                            <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                        </div>
                        <div class="col-md-6"><span class="address-lines"></span></div> 
                        
                    </div>
                    <div class="row form-row mb-3">
                    	<div class="col-md-3"></div><div class="col-md-6">Please enter your postcode and click 'Find address'.</div><div class="col-md-3"></div>
                        <div class="col-md-3"></div><div class="col-md-6"><a href="javascript:;" class="add_address_manually">Enter your address manually</a></div><div class="col-md-3"></div>
                    </div>
                    <div class="form-group extra_add <?=($personal_details['address1'] != "")?"":"hide";?>  mt-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-md-4">
                                <input type="text" name="address1" id="address1" value="<?=$personal_details['address1']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($personal_details['address1'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-md-4">
                                <input type="text" name="address2" id="address2" value="<?=$personal_details['address2']?>" class="form-control" ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($personal_details['address1'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-md-4">
                                <input type="text" name="town" id="town" value="<?=$personal_details['town']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($personal_details['address1'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>County</label></div>
                            <div class="col-md-4">
                                <input type="text" name="county" id="county" value="<?=$personal_details['county']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($personal_details['address1'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-md-4">
                                <input type="text" name="postcode_box" id="postcode_box" value="<?=$personal_details['postcode_box']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <!-- <div class="form-row">
                    	<div class="col-md-12 text-center mb-3 font-weight-bold">Have you changed address in the last 3 months?</div>
                    </div>-->
                    <div class="form-row mt-5">
                        <div class="col-md-3 font-weight-bold">Have you changed address in the last 3 months?</div>
                            <div class="col-md-4">
                                <div class="toggle">
                                    <input type="radio" name="old_address_change" value="1" id="old_address_change_yes_sumry" class="yes_box" <?=($personal_details['old_address_change'] == "1")?"checked":"";?>/>
                                    <label for="old_address_change_yes_sumry">Yes</label>
                                    <input type="radio" name="old_address_change" value="0" id="old_address_change_no_sumry" class="no_box" <?=($personal_details['old_address_change'] == "0")?"checked":"";?>/>
                                    <label for="old_address_change_no_sumry">No</label>
                                </div>
                           </div>
                        <div class="col-md-5"></div>
                    </div>
                    <div class="form-group old_address <?=($personal_details['old_address_change'] == "1")?"":"hide";?> mt-2">
                    	<!--<div class="row form-group mb-3">
                            <div class="col-md-3"></div><div class="col-md-6">Please enter your previous address here:</div><div class="col-md-3"></div>
                        </div>-->
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right"><label class=" font-weight-bold">Postcode</label></div>
                            <div class="col-md-2">
                                <input type="text" name="postcode_additional" id="postcode_additional" value="<?=$personal_details['postcode_additional']?>" class="form-control"  placeholder="Eg SO15 3EW">
                                </div>
                            <div class="col-md-2  text-right  no-padding">
                                <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                            </div>
                            <div class="col-md-5"></div> 
                            
                        </div>
                        <div class="row form-row mt-2 mb-3">
                            <div class="col-md-3"></div><div class="col-md-6">Please enter your postcode and click 'Find address'.</div><div class="col-md-3"></div>
                            <div class="col-md-3"></div><div class="col-md-5"><a href="javascript:;" class="add_old_address_manually">Enter your address manually</a></div><div class="col-md-4"></div>
                        </div>
                        
                        <div class="form-group add_old_add_manually <?=($personal_details['additional_address1'] != "")?"":"hide";?>">
                            <div class="row form-row mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>Address 1</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="additional_address1" id="additional_address1" value="<?=$personal_details['additional_address1']?>" class="form-control" required ></div>
                                <div class="col-md-5"></div> 
                            </div>
                        </div>
                        <div class="form-group add_old_add_manually <?=($personal_details['additional_address1'] != "")?"":"hide";?>">
                            <div class="row form-row mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>Address 2</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="additional_address2" id="additional_address2" value="<?=$personal_details['additional_address2']?>" class="form-control" required ></div>
                                <div class="col-md-5"></div> 
                            </div>
                        </div>
                        <div class="form-group add_old_add_manually <?=($personal_details['additional_address1'] != "")?"":"hide";?>">
                            <div class="row form-row mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>Town/City</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="additional_town_city" id="additional_town_city" value="<?=$personal_details['additional_town_city']?>" class="form-control" required ></div>
                                <div class="col-md-5"></div> 
                            </div>
                        </div>
                        <div class="form-group add_old_add_manually <?=($personal_details['additional_address1'] != "")?"":"hide";?>  mb-3">
                            <div class="row form-row mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>County</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="additional_county" id="additional_county" value="<?=$personal_details['additional_county']?>" class="form-control" required ></div>
                                <div class="col-md-5"></div> 
                            </div>
                        </div>  
                        <div class="form-group add_old_add_manually <?=($personal_details['additional_address1'] != "")?"":"hide";?>  mb-5">
                            <div class="row form-row mb-3">
                                <div class="col-md-3 text-right font-weight-bold"><label>Postcode</label></div>
                                <div class="col-md-4">
                                    <input type="text" name="additional_postcode_box" id="additional_postcode_box" value="<?=$personal_details['additional_postcode_box']?>" class="form-control" required ></div>
                                <div class="col-md-5"></div> 
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div  class="form-group mt-5">
                	<h3 class="use_data_title">How we will use your data</h3>
                    <hr>
                        <div class="col-md-12 no-padding use_data_content">
                        <p>The information that you provide on this form will be held by Foresters Friendly Society for the purposes of providing a high quality customer experience and to keep you informed of products and services that may interest you. The ways in which we will use your data is laid out in our Privacy Policy. We will never share your data with any other companies for their marketing purposes.</p>
                        <p>We will always respect your preferences as to the information you receive from us and we will tell you how you can opt out in every communication we send you. If you would like to opt out at any time, you can do so by calling 0800 783 4162, emailing <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a>, completing the online form or writing to us at: Foresters Friendly Society, 29-33 Shirley Road, Southampton SO15 3EW</p>
                        <p>Please note that we will always send you contractual information, such as your annual bonus statement.</p>
                        <p>Where an application is made via a Financial Adviser (FA), you agree to your details being disclosed to that FA until you instruct us otherwise.</p>
                     </div> 
                     
                     <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>How did you hear about us? (Optional)</label></div>
                    <div class="col-md-4">
                    <?=form_dropdown('HeardAboutUs',$list_how_did_you_hear_aboutus,$personal_details['HeardAboutUs'],'class="form-control HeardAboutUs" placeholder="Please Select" id="HeardAboutUs"')?>
                        
                        <input type="text" name="HeardAboutUs_extra" id="HeardAboutUs_extra" value="<?=$personal_details['HeardAboutUs_extra']?>" class="form-control <?=($personal_details['HeardAboutUs_extra'] != "")?"":"hide";?> mt-2 HeardAboutUs_extra" placeholder='Please enter Introducer number'>
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Offer code (Optional)</label></div>
                    <div class="col-md-4">
                       <input type="text" name="offer_code" id="offer_code" value="<?=$personal_details['offer_code']?>" class="form-control" maxlength="4"></div>
                    <div class="col-md-5"></div> 
                </div>
                 
                 </div>  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_your_details" data-step="2">Update</button>
            </div>
        </div>
             </form>