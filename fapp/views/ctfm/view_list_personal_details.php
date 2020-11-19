<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

if(isset($personal_details->dob)){
		$dob = @explode("-",@$personal_details->dob);
	}
if(isset($personal_details->ni_number)){
		$ni_number = @explode(" ",@$personal_details->ni_number);
	}


?>
<form name="frmupdate_yourdetails" id="frmupdate_yourdetails" action="" method="post">
        <input type="hidden" name="data_type" value="personal_details">
		<input type="hidden" name="uid" value="<?=ed('e', @$personal_details->id);?>">
        	
     	   	<div class="row">
        	<div class="col-lg-12">
			<h3 class="head_title">Your details</h3>
            <hr>
			<h4 class="mb-5 mt-4"><p class="mb-2">We have pre-filled some of this information to make the form easier for you. Please complete the remaining boxes.</p><p>If any information is incorrect, please call us on 0800 988 2418.</p></h4>
                
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Title</label></div>
                    <div class="col-lg-4">
                    	<?=form_dropdown('title',$list_title,@$personal_details->title,'class="required form-control" placeholder="Title"  disabled="disabled"')?>
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>First name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="first_name" id="first_name" value="<?=isset($personal_details->first_name)?@$personal_details->first_name:'';?>" class="form-control required" required autocomplete="OFF" disabled="disabled">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="last_name" id="last_name" value="<?=isset($personal_details->last_name)?@$personal_details->last_name:'';?>" class="form-control required" required autocomplete="OFF" disabled="disabled">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-2">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-lg-1  mb-2">
                        <select name="dob_day" id="dob_day" class="form-control dob_day" placeholder="Day"  disabled="disabled">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'";
								if($dob[2] == $d)
									echo " selected";
							
							echo ">".$d."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-2  mb-2">
						<?=form_dropdown('dob_month',$month,$dob[1],'class="form-control select2 dob_month" placeholder="Month" id="dob_month"  disabled="disabled"')?>
                    </div>
                    <div class="col-lg-1  mb-2">
                        <select name="dob_year" id="dob_year" required class="form-control select2 required dob_year"   placeholder="Year"  disabled="disabled">
                        <option value="">Year</option>
                        <?php 
						$back_year = date('Y', strtotime("-17 years"));
						$last_year = date('Y', strtotime("-20 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'";
								if($dob[0] == $back_year)
									echo " selected";
							
							echo ">".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-4"></div>
                    
                    </div>
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Child Trust Fund Unique Reference Number</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="unique_ref" id="unique_ref"  value="<?=@$personal_details->uniqueID?>" class="form-control required" required autocomplete="OFF" disabled="disabled">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
				
				 <div class="form-group">
                	<hr>
					<div class="row form-row mb-3">
						<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>National Insurance number</label></div>
						<div class="col-lg-4 d-flex d-lg-flex justify-content-between flex-wrap"><input type="text" name="NI1" id="NI1" maxlength="2" class="form-control ni-segment"  autocomplete="OFF" value=""> <input type="number" name="NI2" id="NI2" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value=""> <input type="number" name="NI3" id="NI3" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value=""> <input type="number" name="NI4" id="NI4" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value=""> <input type="text" name="NI5" id="NI5" maxlength="1" class="form-control ni-segment ni-segment-last" autocomplete="OFF" value=""></div>
						<div class="col-lg-4"></div> 
					</div>
					<div class="row form-row mb-3">
						<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Phone</label></div>
						<div class="col-lg-4">
							<input type="text" name="phone" id="phone"  value="" class="form-control required phone" required  autocomplete="OFF">
						</div>
						<div class="col-lg-4"></div> 
					</div>
					<div class="row form-row mb-3">
						<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Email</label></div>
						<div class="col-lg-4">
							<input type="email" name="email" id="email"  value="" class="form-control required" required autocomplete="OFF">
						</div>
						<div class="col-lg-4"></div> 
					</div>
					
					<div class="row form-row mb-3">
						<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Confirm Email</label></div>
						<div class="col-lg-4">
							<input type="email" name="cemail" id="cemail"  value="" class="form-control required" required autocomplete="OFF">
						</div>
						<div class="col-lg-4"></div> 
					</div>
				
				</div>
				<div class="form-group mb-5 mt-5">
					<h3>Existing policy details</h3>
					<hr>
						<div class="row form-row  mb-3">
							<div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Foresters Friendly Society Child Trust Fund policy number </label></div>
							<div class="col-lg-4">
							   <input type="text" name="policy_number" id="policy_number" value="<?=@$personal_details->policy_number?>" class="form-control policy_number" maxlength="17" disabled="disabled"></div>
							<div class="col-lg-4"></div> 
						</div>
				</div>
              
                
                
                <div class="form-group">
                	<h3>Your address</h3>
                    <hr>
                     
                    <div class="form-group extra_add <?=(@$personal_details->address1 != "")?"":"hide";?>  mt-5">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-lg-4">
                                <input type="text" name="address1" id="address1" value="<?=@$personal_details->address1?>" class="form-control" required disabled="disabled"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=(@$personal_details->address2 != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-lg-4">
                                <input type="text" name="address2" id="address2" value="<?=@$personal_details->address2?>" class="form-control" disabled="disabled"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=(@$personal_details->town != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-lg-4">
                                <input type="text" name="town" id="town" value="<?=@$personal_details->town?>" class="form-control" required disabled="disabled"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=(@$personal_details->county != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>County</label></div>
                            <div class="col-lg-4">
                                <input type="text" name="county" id="county" value="<?=@$personal_details->county?>" class="form-control" required disabled="disabled"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=(@$personal_details->postcode != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-lg-4">
                                <input type="text" name="postcode" id="postcode" value="<?=@$personal_details->postcode?>" class="form-control" required disabled="disabled" ></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    
                </div>
                <div  class="form-group mt-5">
                	<h3 class="use_data_title">How we will use your data</h3>
                    <hr>
                        <div class="col-lg-12 no-padding use_data_content">
                        <p>The information that you provide on this form will be held by Foresters Friendly Society for the purposes of providing a high quality customer experience and to keep you informed of products and services that may interest you. The ways in which we will use your data is laid out in our Privacy Policy. We will never share your data with any other companies for their marketing purposes.</p>
                        <p>We will always respect your preferences as to the information you receive from us and we will tell you how you can opt out in every communication we send you. If you would like to opt out at any time, you can do so by calling 0800 783 4162, emailing <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a>, completing the <a href="https://www.forestersfriendlysociety.co.uk/contactpreferences" target="_blank">online form</a> or writing to us at: Foresters Friendly Society, 29-33 Shirley Road, Southampton SO15 3EW</p>
                        <p>Please note that we will always send you contractual information, such as your annual bonus statement.</p>
                        <p>Where an application is made via a Financial Adviser (FA), you agree to your details being disclosed to that FA until you instruct us otherwise.</p>
                     </div> 
                 
                 </div>  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_your_details" data-step="3">Continue</button>
            </div>
        </div>
             </form>