<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);


$previous_address = "";	
if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode']!=""){
								
if($child_details['child_hidden_address1'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold"><label>Address line 1:</label></div><div class="col-md-4"><input type="text" disabled="disabled" class="form-control mt-2" value="'.$child_details['child_hidden_address1'].'"></div><div class="col-md-5  mb-3"></div>';

if($child_details['child_hidden_address2'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold"><label>Address line 2:</label></div><div class="col-md-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$child_details['child_hidden_address2'].'"></div><div class="col-md-5 mb-3"></div>';
	
if($child_details['child_hidden_town_city'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold"><label>Town:</label></div><div class="col-md-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$child_details['child_hidden_town_city'].'"></div><div class="col-md-5  mb-4"></div>';

if($child_details['child_hidden_county'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold"><label>County:</label></div><div class="col-md-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$child_details['child_hidden_county'].'"></div><div class="col-md-5  mb-3"></div>';
	
if($child_details['child_hidden_postcode'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold"><label>Postcode:</label></div><div class="col-md-4"><input type="text" class="form-control mt-2" disabled="disabled" value="'.$child_details['child_hidden_postcode'].'"></div><div class="col-md-5  mb-3"></div>';	

$previous_address .= '<input name="child_hidden_address1" type="hidden" value="'.$child_details['child_hidden_address1'].'">
<input name="child_hidden_address2" type="hidden" value="'.$child_details['child_hidden_address2'].'">
<input name="child_hidden_town_city" type="hidden" value="'.$child_details['child_hidden_town_city'].'">
<input name="child_hidden_county" type="hidden" value="'.$child_details['child_hidden_county'].'">
<input name="child_hidden_postcode" type="hidden" value="'.$child_details['child_hidden_postcode'].'">';		
}

?>
<form name="frmupdate_childdetails" id="frmupdchilddetails" action="" method="post">
        <input type="hidden" name="data_type" value="child_details">
        <input type="hidden" name="step" value="3">
        	
     	   	<div class="row">
        	<div class="col-md-12">
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Title</label></div>
                    <div class="col-md-4">
                    	<?=form_dropdown('title',array(""=>"Title","Mr"=>"Mr","Miss"=>"Miss"),$child_details['title'],'class="required form-control" placeholder="Title"')?>
                        <input type="text" name="other_title" id="other_title" value="" class="form-control hide mt-2" placeholder='Please enter your title'>
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>First name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="first_name" id="first_name" value="<?=$child_details['first_name']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" id="last_name" value="<?=$child_details['last_name']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-2">
                    <div class="col-md-3 text-right font-weight-bold"><label>Date of birth</label></div>
                    <div class="col-md-1  mb-2">
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
                    </div>
                    <div class="col-md-2  mb-2">
						<?=form_dropdown('cdob_month',$month,$child_details['cdob_month'],'class="form-control select2 cdob_month" placeholder="Month" id="cdob_month"')?>
                    </div>
                    <div class="col-md-1  mb-2">
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
                    <div class="col-md-5"></div>
                    
                    </div>
                
                <div class="row form-row mb-3 <?php if(get_session('child_dob_nin')==false){ echo "hide";}?> child_below_nin">
                    <div class="col-md-3 text-right font-weight-bold"><label>National Insurance number</label></div>
                    <div class="col-md-4"><input type="text" name="NI1" id="NI1" maxlength="2" class="form-control ni-segment"  autocomplete="OFF" value="<?=$child_details['NI1']?>"> <input type="text" name="NI2" id="NI2" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI2']?>"> <input type="text" name="NI3" id="NI3" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI3']?>"> <input type="text" name="NI4" id="NI4" maxlength="2" class="form-control ni-segment" autocomplete="OFF" value="<?=$child_details['NI4']?>"> <input type="text" name="NI5" id="NI5" maxlength="1" class="form-control ni-segment required ni-segment-last" autocomplete="OFF" required value="<?=$child_details['NI5']?>"></div>
                    <div class="col-md-5"></div> 
                </div>
                
                
                
                <div class="form-group">
                	<h3>Child's address</h3>
                    <hr>
                    <div class="mt-5 mb-3">
                        <div class="col-md-12" style="display:inline-block;">
                            
                               <label for="same_address_child" class="btn-child-same-addres font-weight-bold mt-1"><input type="checkbox" id="same_address_child" name="same_address_child" value="1" class="badgebox same_address_child" <?php if(isset($child_details['same_address_child']) && $child_details['same_address_child']==1){ echo "checked";}?>><span class="badge">&check;</span></label><p class="mt-2 my-2 mx-5">Same as my address</p>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-3 same_as_prev_address <?php if(!isset($child_details['same_address_child'])){ echo "hide";}?>">
                            <?=$previous_address?>
                     </div> 
                     <div class="show_postcode <?php if(isset($child_details['same_address_child']) && $child_details['same_address_child']==1){ echo "hide";}?>">  
                     <div class="row form-row mb-3 ">
                        <div class="col-md-3 text-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-md-2">
                            <input type="text" name="postcode" id="postcode"  value="<?=$child_details['postcode']?>" class="form-control postcode" placeholder="Eg SO15 3EW">
                            </div>
                        <div class="col-md-2  text-right  no-padding">
                            <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                        </div>
                        <div class="col-md-6"><span class="address-lines"></span></div> 
                        
                    </div>
                    <div class="row form-row mb-3">
                    	<div class="col-md-3"></div><div class="col-md-6">Please enter the postcode where the child is living and click 'Find address'.</div><div class="col-md-3"></div>
                        <div class="col-md-3"></div><div class="col-md-6"><a href="javascript:;" class="add_address_manually">Enter your address manually</a></div><div class="col-md-3"></div>
                    </div>
                    <div class="form-group extra_add <?=($child_details['address1'] != "")?"":"hide";?>  mt-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-md-4">
                                <input type="text" name="address1" id="address1" value="<?=$child_details['address1']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['address2'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-md-4">
                                <input type="text" name="address2" id="address2" value="<?=$child_details['address2']?>" class="form-control" ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['town'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-md-4">
                                <input type="text" name="town" id="town" value="<?=$child_details['town']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['county'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>County</label></div>
                            <div class="col-md-4">
                                <input type="text" name="county" id="county" value="<?=$child_details['county']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group extra_add <?=($child_details['postcode_box'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-md-4">
                                <input type="text" name="postcode_box" id="postcode_box" value="<?=$child_details['postcode_box']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                   </div>
                    
                </div>
                  
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_child_details" data-step="3">Update</button>
            </div>
        </div>
             </form>