<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$previous_address = "";	
$parent_previous_address = "";	
if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode']!=""){
								
if($child_details['child_hidden_address1'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 1:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_address1'].'"></div><div class="col-md-5  mb-3"></div>';

if($child_details['child_hidden_address2'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 2:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_address2'].'"></div><div class="col-md-5 mb-3"></div>';
	
if($child_details['child_hidden_town_city'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Town:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_town_city'].'"></div><div class="col-md-5  mb-4"></div>';

if($child_details['child_hidden_county'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">County:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_county'].'"></div><div class="col-md-5  mb-3"></div>';
	
if($child_details['child_hidden_postcode'] !="")
	$previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Postcode:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_postcode'].'"></div><div class="col-md-5  mb-3"></div>';	

$previous_address .= '<input name="child_hidden_address1" type="hidden" value="'.$child_details['child_hidden_address1'].'">
<input name="child_hidden_address2" type="hidden" value="'.$child_details['child_hidden_address2'].'">
<input name="child_hidden_town_city" type="hidden" value="'.$child_details['child_hidden_town_city'].'">
<input name="child_hidden_county" type="hidden" value="'.$child_details['child_hidden_county'].'">
<input name="child_hidden_postcode" type="hidden" value="'.$child_details['child_hidden_postcode'].'">';


if($child_details['child_hidden_address1'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 1:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_address1'].'"></div><div class="col-md-5  mb-3"></div>';

if($child_details['child_hidden_address2'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 2:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_address2'].'"></div><div class="col-md-5 mb-3"></div>';
	
if($child_details['child_hidden_town_city'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Town:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_town_city'].'"></div><div class="col-md-5  mb-4"></div>';

if($child_details['child_hidden_county'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">County:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_county'].'"></div><div class="col-md-5  mb-3"></div>';
	
if($child_details['child_hidden_postcode'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Postcode:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['child_hidden_postcode'].'"></div><div class="col-md-5  mb-3"></div>';	

$parent_previous_address .= '<input name="parent_child_hidden_address1" type="hidden" value="'.$child_details['child_hidden_address1'].'">
<input name="parent_child_hidden_address2" type="hidden" value="'.$child_details['child_hidden_address2'].'">
<input name="parent_child_hidden_town_city" type="hidden" value="'.$child_details['child_hidden_town_city'].'">
<input name="parent_child_hidden_county" type="hidden" value="'.$child_details['child_hidden_county'].'">
<input name="parent_child_hidden_postcode" type="hidden" value="'.$child_details['child_hidden_postcode'].'">';

		
}



if(isset($child_details['parent_child_hidden_postcode']) && $child_details['parent_child_hidden_postcode']!=""){
								
if($child_details['parent_child_hidden_address1'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 1:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['parent_child_hidden_address1'].'"></div><div class="col-md-5  mb-3"></div>';

if($child_details['parent_child_hidden_address2'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Address line 2:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['parent_child_hidden_address2'].'"></div><div class="col-md-5 mb-3"></div>';
	
if($child_details['parent_child_hidden_town_city'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Town:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['parent_child_hidden_town_city'].'"></div><div class="col-md-5  mb-4"></div>';

if($child_details['parent_child_hidden_county'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">County:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['parent_child_hidden_county'].'"></div><div class="col-md-5  mb-3"></div>';
	
if($child_details['parent_child_hidden_postcode'] !="")
	$parent_previous_address .= '<div class="col-md-3 mb-3 text-right font-weight-bold">Postcode:</div><div class="col-md-4 mb-3"><input type="text" class="form-control" disabled value="'.$child_details['parent_child_hidden_postcode'].'"></div><div class="col-md-5  mb-3"></div>';	

$parent_previous_address .= '<input name="parent_child_hidden_address1" type="hidden" value="'.$child_details['parent_child_hidden_address1'].'">
<input name="parent_child_hidden_address2" type="hidden" value="'.$child_details['parent_child_hidden_address2'].'">
<input name="parent_child_hidden_town_city" type="hidden" value="'.$child_details['parent_child_hidden_town_city'].'">
<input name="parent_child_hidden_county" type="hidden" value="'.$child_details['parent_child_hidden_county'].'">
<input name="parent_child_hidden_postcode" type="hidden" value="'.$child_details['child_hidden_postcode'].'">';		
}
?>
<form name="frmupdate_childdetails" id="frmupdchilddetails" action="" method="post">
        <input type="hidden" name="data_type" value="child_details">
        <input type="hidden" name="step" value="2">
        	
     	   	<div class="row">
        	<div class="col-md-12">
            <hr>
                <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Title</label></div>
                    <div class="col-md-4">
                    	<?=form_dropdown('title',array(""=>"Title","Mr"=>"Mr","Miss"=>"Miss"),$child_details['title'],'class="required form-control" placeholder="Title"')?>
    
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
						$last_year = date('Y', strtotime("-16 years"));
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
                    <div class="form-group extra_add <?=($child_details['address1'] != "")?"":"hide";?>  mt-3">
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
        
        <?php if($personal_details['personal_details_relation_to_child'] !="Parent/Guardian"){?>
        
        <div class="row">
        	<div class="col-md-12">
            <h3>Parent/Guardian</h3>
             <hr>
                <div class="row form-row mb-3">
                    <div class="col-md-1"></div><div class="col-md-6">You have indicated that you are not the child's Parent or Guardian.</div><div class="col-md-5"></div>
                    <div class="col-md-1"></div><div class="col-md-6">We are required to send a copy of the policy document to the child's Parent or Guardian so please enter their details below.</div><div class="col-md-5"></div>
                </div>
                <div class="row form-row  mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Title</label></div>
                    <div class="col-md-4">
                    	<?=form_dropdown('parent_title',$list_title,$child_details['parent_title'],'class="required form-control" placeholder="Title"')?>
                        <input type="text" name="parent_other_title" id="parent_other_title" value="" class="form-control hide mt-2" placeholder='Please enter your title'>
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>First name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="parent_first_name" id="parent_first_name" value="<?=$child_details['parent_first_name']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Last name</label></div>
                    <div class="col-md-4">
                        <input type="text" name="parent_last_name" id="parent_last_name" value="<?=$child_details['parent_last_name']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                
                
               
                
                <div class="form-group">
                	<h3>Parent/Guardian address</h3>
                    <hr>
                    <div class="mt-5 mb-3">
                        <div class="col-md-12" style="display:inline-block;">
                            
                               <label for="same_address_child" class="btn-child-same-addres font-weight-bold mt-1"><input type="checkbox" id="parent_same_address_child" name="parent_same_address_child" value="1" class="badgebox parent_same_address_child" <?php if(isset($child_details['parent_same_address_child']) && $child_details['parent_same_address_child']==1){ echo "checked";}?>><span class="badge">&check;</span></label><p class="mt-2 my-2 mx-5">Same as the child's address</p>
                             
                        </div>
                    </div>
                    <div class="row form-row mt-2 mb-3 same_as_prev_address <?php if(!isset($child_details['parent_same_address_child'])){ echo "hide";}?>">
                            <?=$parent_previous_address?>
                     </div> 
                     <div class="parent_show_postcode <?php if(isset($child_details['parent_same_address_child']) && $child_details['parent_same_address_child']==1){ echo "hide";}?>">  
                     <div class="row form-row mb-3 ">
                        <div class="col-md-3 text-right"><label class=" font-weight-bold">Postcode</label></div>
                        <div class="col-md-2">
                            <input type="text" name="parent_postcode" id="parent_postcode"  value="<?=$child_details['parent_postcode']?>" class="form-control parent_postcode" placeholder="Eg SO15 3EW">
                            </div>
                        <div class="col-md-2  text-right  no-padding">
                            <button type="button" class="btn btn-success btn-sm find_address">Find address</button>
                        </div>
                        <div class="col-md-6"><span class="address-lines"></span></div> 
                        
                    </div>
                    <div class="row form-row mb-3">
                    	<div class="col-md-3"></div><div class="col-md-6">If the Parent/Guardian address is different from the child's, please enter their postcode and click 'Find address'.</div><div class="col-md-3"></div>
                        <div class="col-md-3"></div><div class="col-md-6"><a href="javascript:;" class="add_parent_address_manually">Enter your address manually</a></div><div class="col-md-3"></div>
                    </div>
                    <div class="form-group parent_extra_add <?=($child_details['parent_address1'] != "")?"":"hide";?>  mt-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 1</label></div>
                            <div class="col-md-4">
                                <input type="text" name="parent_address1" id="parent_address1" value="<?=$child_details['parent_address1']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group parent_extra_add <?=($child_details['parent_address2'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Address 2</label></div>
                            <div class="col-md-4">
                                <input type="text" name="parent_address2" id="parent_address2" value="<?=$child_details['parent_address2']?>" class="form-control" ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group parent_extra_add <?=($child_details['parent_town'] != "")?"":"hide";?>">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Town/City</label></div>
                            <div class="col-md-4">
                                <input type="text" name="parent_town" id="parent_town" value="<?=$child_details['parent_town']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group parent_extra_add <?=($child_details['parent_county'] != "")?"":"hide";?> mb-3">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>County</label></div>
                            <div class="col-md-4">
                                <input type="text" name="parent_county" id="parent_county" value="<?=$child_details['parent_county']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                    <div class="form-group parent_extra_add <?=($child_details['parent_postcode_box'] != "")?"":"hide";?> mb-5">
                        <div class="row form-row mb-3">
                            <div class="col-md-3 text-right font-weight-bold"><label>Postcode</label></div>
                            <div class="col-md-4">
                                <input type="text" name="parent_postcode_box" id="parent_postcode_box" value="<?=$child_details['parent_postcode_box']?>" class="form-control" required ></div>
                            <div class="col-md-5"></div> 
                        </div>
                	</div>
                   </div>
                    
                </div>
                
                <div class="form-group">
                	<h3>Parent/Guardian contact details</h3>
                    <hr>
                <div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Daytime phone</label></div>
                    <div class="col-md-4">
                        <input type="text" name="parent_phone" id="parent_phone" value="<?=$child_details['parent_phone']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
				
				<div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Email address</label></div>
                    <div class="col-md-4">
                        <input type="text" name="parent_email" id="parent_email" value="<?=$child_details['parent_email']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
				
				<div class="row form-row mb-3">
                    <div class="col-md-3 text-right font-weight-bold"><label>Confirm Email address</label></div>
                    <div class="col-md-4">
                        <input type="text" name="parent_cemail" id="parent_cemail" value="<?=$child_details['parent_email']?>" class="form-control required" required autocomplete="OFF">
                    </div>
                    <div class="col-md-5"></div> 
                </div>
                
                </div>
                
                
                 <div class="col-md-12" style="display:inline-block;">
                            
                       <label for="parent_accept_terms" class="btn-parent-consent font-weight-bold mt-1"><input type="checkbox" id="parent_accept_terms" name="parent_accept_terms" value="1" class="badgebox  parent_accept_terms required" required <?=($child_details['parent_accept_terms']=="1")?"checked":"";?>><span class="badge">&check;</span></label><p class="mt-2 my-2 mx-5">I confirm that the child's Parent/Guardian consents to me setting up this savings policy.</p>
                     
                </div> 
            </div> 
        </div>
        
        <?php }?>
        <div class="row mt-5">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_child_details" data-step="3">Update</button>
            </div>
        </div>
             </form>