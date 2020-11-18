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

$previous_address .= '<input name="child_hidden_address1" type="hidden" value="'.$personal_details['address1'].'">
<input name="child_hidden_address2" type="hidden" value="'.$personal_details['address2'].'">
<input name="child_hidden_town_city" type="hidden" value="'.$personal_details['town'].'">
<input name="child_hidden_county" type="hidden" value="'.$personal_details['county'].'">
<input name="child_hidden_postcode" type="hidden" value="'.$personal_details['postcode_box'].'">';		
}

?>
<form name="frmupdate_childdetails" id="frmupdate_childdetails" action="" method="post">
        <input type="hidden" name="data_type" value="child_details">
        <input type="hidden" name="step" value="2">
        	
     	   	<div class="row">
        	<div class="col-lg-12">
            <h3>Child's details</h3>
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Title</label></div>
                    <div class="col-lg-4">
                    	<?=form_dropdown('title',array(""=>"Title","Miss"=>"Miss","Mr"=>"Mr"),$child_details['title'],'class="required select2 form-control" placeholder="Title"')?>
                       
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>First name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="first_name" id="first_name" value="<?=$child_details['first_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-lg-4">
                        <input type="text" name="last_name" id="last_name" value="<?=$child_details['last_name']?>" class="form-control required" required autocomplete="OFF" maxlength="25">
                    </div>
                    <div class="col-lg-4"></div> 
                </div>
                
                <div class="row form-row mb-2" id="user_dob">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-lg-4  mb-2">
                        <select name="cdob_day" id="cdob_day" class="form-control cdob_day" placeholder="Day">
                        <option value="">Day</option>
                        <?php for($d=1; $d <= 31; $d++){
							echo "<option value='".$d."'";
								if($child_details['cdob_day'] == $d)
									echo " selected";
							
							echo ">".$d."</option>";
							}
						?>
                        </select>
						<?=form_dropdown('cdob_month',$month,$child_details['cdob_month'],'class="form-control select2 cdob_month" placeholder="Month" id="cdob_month"')?>

                        <select name="cdob_year" id="cdob_year" required class="form-control select2 required cdob_year"   placeholder="Year">
                        <option value="">Year</option>
                       <?php 
						$back_year = date('Y');
						$last_year = date('Y', strtotime("-18 years"));
						for($back_year; $back_year > $last_year; $back_year--){
							echo "<option value='".$back_year."'";
								if($child_details['cdob_year'] == $back_year)
									echo " selected";
							
							echo ">".$back_year."</option>";
							}
						?>
                        </select>
                    </div>
                    <div class="col-lg-4"></div>
                    
                    </div>
                
                <div class="row form-row mb-3 <?php if(get_session('child_dob_nin')==false){ echo "hide";}?> child_below_nin">
                    <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>National Insurance number</label></div>
                    <div class="col-lg-4"><input type="text" name="NI1" id="NI1" maxlength="2" class="form-control ni-segment"  autocomplete="OFF" value="<?=$child_details['NI1']?>"> <input type="text" name="NI2" id="NI2" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI2']?>"> <input type="text" name="NI3" id="NI3" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI3']?>"> <input type="text" name="NI4" id="NI4" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI4']?>"> <input type="text" name="NI5" id="NI5" maxlength="1" class="form-control ni-segment required ni-segment-last" autocomplete="OFF" required value="<?=$child_details['NI5']?>"></div>
                    <div class="col-lg-4"></div> 
                </div>
                
                
                
                <div class="form-group">
                	<h3>Child's address</h3>
                    <hr>
                    <div class="mt-5 mb-3">
                        <div class="col-lg-12" style="display:inline-block;">
                            
                               <label for="same_address_child" class="btn-child-same-addres font-weight-bold mt-1"><input type="checkbox" id="same_address_child" name="same_address_child" value="1" class="badgebox same_address_child" <?php if(isset($child_details['same_address_child']) && $child_details['same_address_child']==1){ echo "checked";}?>><span class="badge">&check;</span><p class="mt-2">Same as my address</p></label>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-3 same_as_prev_address <?php if(!isset($child_details['same_address_child'])){ echo "hide";}?>">
                            <?=$previous_address?>
                     </div> 
                     <div class="show_postcode <?php if(isset($child_details['same_address_child']) && $child_details['same_address_child']==1){ echo "hide";}?>" id="child_address_area">  
                     <div class="row form-row mb-3  afd-typeahead-container afd-form-control">
                        <div class="col-lg-4 text-left text-lg-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-lg-4  afd-typeahead-field">
                                    <div class="afd-typeahead-query">
                                    <input type="text" name="postcode" id="postcode"  value="<?=$child_details['postcode']?>" class="form-control postcode" placeholder="Eg SO15 3EW" autocomplete="off" data-afd-control="typeahead">
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
                    <div class="form-group extra_add <?=($child_details['address1'] != "")?"":"hide";?>  mt-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-lg-4 afd-input-group ">
                                <input type="text" name="address1" id="address1" value="<?=$child_details['address1']?>" class="form-control" required  data-afd-result="Property" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['address2'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="address2" id="address2" value="<?=$child_details['address2']?>" class="form-control"  data-afd-result="Street" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['town'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="town" id="town" value="<?=$child_details['town']?>" class="form-control" required data-afd-result="Town" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['county'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>County</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="county" id="county" value="<?=$child_details['county']?>" class="form-control" required  data-afd-result="TraditionalCounty" maxlength="50"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['postcode_box'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-lg-4 text-left text-lg-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-lg-4 afd-input-group">
                                <input type="text" name="postcode_box" id="postcode_box" value="<?=$child_details['postcode_box']?>" class="form-control" required data-afd-result="Postcode" maxlength="10"></div>
                            <div class="col-lg-4"></div> 
                        </div>
                	</div>
                   </div>
                    
                </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-lg-12">
            	<button type="submit" name="continue" class="btn pull-right" id="next_child_details" data-step="2">Continue</button></button><button type="button" name="back" class="btn pull-left m-0 bg-light backbtn"  data-step="1">Back</button>
            </div>
        </div>
             </form>