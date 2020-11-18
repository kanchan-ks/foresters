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

$previous_address .= '<input name="beneficiary_hidden_address1" type="hidden" value="'.$personal_details['address1'].'">
<input name="beneficiary_hidden_address2" type="hidden" value="'.$personal_details['address2'].'">
<input name="beneficiary_hidden_town_city" type="hidden" value="'.$personal_details['town'].'">
<input name="beneficiary_hidden_county" type="hidden" value="'.$personal_details['county'].'">
<input name="beneficiary_hidden_postcode" type="hidden" value="'.$personal_details['postcode_box'].'">';		
}


?>
<form name="frmupdate_beneficiarydetails" id="frmupdate_beneficiarydetails" action="" method="post">
        <input type="hidden" name="data_type" value="beneficiary_details">
        <input type="hidden" name="step" value="3">
        	
     	   	<div class="row">
        	<div class="col-lg-12">
            <h3>Beneficiary</h3>
            <hr>
                
                <div  class="form-group mb-3">
                	<h3>Nominate a beneficiary</h3>
                   
                            <div class="col-lg-12 no-padding use_data_content mb-3">
                                <p>The following notes will give you guidance about nominating a beneficiary.</p>
                                <p>Under the Friendly Society Act 1974 you can nominate any person to receive an amount, not exceeding &pound;5,000, of the sum payable at your death from the policy. The person nominated may not be an employee of Foresters Friendly Society unless a close relative.</p>
                                <p class="font-weight-bold">Please note:</p>
                                <ul>
                                    <li>If you marry after making this nomination then the nomination is annulled and a new nomination should be made.</li>
                                    <li>If you nominate your spouse and get divorced, the nomination remains in place unless you contact us to make a change.</li>
                                    <li>If you wish to revoke the nomination at any time you should contact Foresters Friendly Society.</li>
                                    <li>Please note you cannot nominate yourself as a beneficiary.</li>
                                </ul> 
                         
                               
                                    <div class="row mx-4">
                                        <div class="col-md-12">
                                             <label for="nominate_benificiary_yes" class="btn-gender-relation font-weight-bold mt-1"><input type="radio" id="nominate_benificiary_yes" name="nominate_benificiary" value="1" class="badgebox  required nominate_benificiary" required <?=(isset($beneficiary_details['nominate_benificiary']) && $beneficiary_details['nominate_benificiary'] == "1")?'checked':'';?>><span class="badge">&check;</span></label><p class="mt-3">I have read and understood these terms and would like to nominate a beneficiary</p>
                                        </div> 
                                        <div class="col-md-12">
                                             <label for="nominate_benificiary_no" class="btn-gender-relation font-weight-bold mt-1"><input type="radio" id="nominate_benificiary_no" name="nominate_benificiary" value="0" class="badgebox required nominate_benificiary" required <?=(isset($beneficiary_details['nominate_benificiary']) && $beneficiary_details['nominate_benificiary'] == "0")?'checked':'';?>><span class="badge">&check;</span></label><p class="mt-3">I do not want to nominate a beneficiary at this time</p>
                                        </div> 
                                       
                                </div>
                               
                            </div>
                 </div>           
                
                <div class="beneficiary_details_area <?=(isset($beneficiary_details['nominate_benificiary']) && $beneficiary_details['nominate_benificiary'] == 1)?'':'hide';?>">
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Title</label></div>
                    <div class="col-lg-4">
                    	<?=form_dropdown('beneficiary_title',$list_title,$beneficiary_details['beneficiary_title'],'class="required select2 form-control beneficiary_title" placeholder="Title"')?>
                        <input type="text" name="beneficiary_other_title" id="beneficiary_other_title" value="" class="form-control hide mt-2 beneficiary_other_title" placeholder='Please enter your title'>
                       
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>First name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="first_name" id="first_name" value="<?=$beneficiary_details['first_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="last_name" id="last_name" value="<?=$beneficiary_details['last_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-2" id="user_dob">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-lg-4  mb-2">
                        <select name="bdob_day" id="bdob_day" class="form-control bdob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'";
								if($beneficiary_details['bdob_day'] == $d)
									echo " selected";
							
							echo ">".$d."</option>";
							}
						?>
                        </select>
						<?=form_dropdown('bdob_month',$month,$beneficiary_details['bdob_month'],'class="form-control select2 bdob_month" placeholder="Month" id="bdob_month"')?>

                        <select name="bdob_year" id="bdob_year" required class="form-control select2 required bdob_year"   placeholder="Year">
                        <option value="">Year</option>
                       <?php 
						$back_year = date('Y', strtotime("-1 years"));
						$last_year = date('Y', strtotime("-100 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'";
								if($beneficiary_details['bdob_year'] == $back_year)
									echo " selected";
							
							echo ">".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-4"></div>
                    
                    </div>
                
                
                
                
                
                <div class="form-group">
                	<h3>Beneficiary's address</h3>
                    <hr>
                    <div class="mt-3 mb-3">
                        <div class="col-lg-12" style="display:inline-block;">
                            
                               <label for="same_address_beneficiary" class="btn-beneficiary-same-addres font-weight-bold mt-1"><input type="checkbox" id="same_address_beneficiary" name="same_address_beneficiary" value="1" class="badgebox same_address_beneficiary" <?php if(isset($beneficiary_details['same_address_beneficiary']) && $beneficiary_details['same_address_beneficiary']==1){ echo "checked";}?>><span class="badge">&check;</span><p class="mt-2">Same as my address</p></label>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-3 same_as_prev_address <?php if(!isset($beneficiary_details['same_address_beneficiary'])){ echo "hide";}?>">
                            <?=$previous_address?>
                     </div> 
                     <div class="show_postcode <?php if(isset($beneficiary_details['same_address_beneficiary']) && $beneficiary_details['same_address_beneficiary']==1){ echo "hide";}?>" id="beneficiary_address_area">  
                     <div class="row form-row mb-3  afd-typeahead-container afd-form-control">
                        <div class="col-lg-4 text-left text-lg-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-lg-4  afd-typeahead-field">
                                    <div class="afd-typeahead-query">
                                    <input type="text" name="postcode" id="postcode"  value="<?=$beneficiary_details['postcode']?>" class="form-control postcode" placeholder="Eg SO15 3EW" autocomplete="off" data-afd-control="typeahead">
                                    </div>
                            </div>
                             <div class="afd-search-again" style="display:none">Search Again</div>
								<div class="afd-manual-input-button" style="display:none">Manual Input</div>
								<div class="afd-manual-input-search-button" style="display:none">Address Search</div>
                        <div class="col-lg-4"></div> 
                        
                    </div>
                    <div class="row form-row mb-3">
                    	<div class="col-lg-4"></div><div class="col-lg-4">Please type your beneficiary's address or postcode and select from the list.</div><div class="col-lg-4"></div>
                        <div class="col-lg-4"></div><div class="col-lg-4"><a href="javascript:;" class="add_address_manually">Enter your address manually</a></div><div class="col-lg-4"></div>
                    </div>
                    <div class="form-group extra_add <?=($beneficiary_details['address1'] != "")?"":"hide";?>  mt-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-lg-4 afd-input-group ">
                                <input type="text" name="address1" id="address1" value="<?=$beneficiary_details['address1']?>" class="form-control" required  data-afd-result="Property" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($beneficiary_details['address2'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="address2" id="address2" value="<?=$beneficiary_details['address2']?>" class="form-control"  data-afd-result="Street" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($beneficiary_details['town'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="town" id="town" value="<?=$beneficiary_details['town']?>" class="form-control" required data-afd-result="Town" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($beneficiary_details['county'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>County</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="county" id="county" value="<?=$beneficiary_details['county']?>" class="form-control" required  data-afd-result="TraditionalCounty" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($beneficiary_details['postcode_box'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="postcode_box" id="postcode_box" value="<?=$beneficiary_details['postcode_box']?>" class="form-control" required data-afd-result="Postcode" maxlength="10"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                   </div>
                    
                </div>
                
                <div class="form-group">
                	<h3>The amount your beneficiary will receive</h3>
                    <hr>
                    <div class="mt-3 mb-4">
                        <div class="col-lg-12"><p>The amount your beneficiary receives will depend on the level of cover you have selected and the final policy payout.</p>
                        <p>Please enter the amount you would like this beneficiary to receive in whole pounds, not exceeding &pound;5,000:</p></div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Amount</label></div>
                            <div class="col-lg-4 ">
                            <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">&pound;</span>
                                      </div>
                                      <input type="text" class="form-control" placeholder="Amount" aria-label="beneficiary_amount" name="beneficiary_amount"  id="beneficiary_amount" value="<?=$beneficiary_details['beneficiary_amount']?>" aria-describedby="basic-addon1" autocomplete="off">
                                    </div>
                                   </div>
                            <div class="col-lg-4">
</div> 
                        </div>
                	</div>
                    
                   </div>
                </div>    
            </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next_beneficiary_details" data-step="3">Continue</button></button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="2">Back</button>
            </div>
        </div>
             </form>