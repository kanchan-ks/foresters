<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

$address = "";
if(isset($child_details['same_address_child']) && $child_details['same_address_child'] == 1){	
	if(isset($child_details['child_hidden_address1']) && $child_details['child_hidden_address1']!="")
		$address .= $child_details['child_hidden_address1'];
	
	if(isset($child_details['child_hidden_address2']) && $child_details['child_hidden_address2'] !="")
		$address .= "<br>".$child_details['child_hidden_address2'];
		
	if(isset($child_details['child_hidden_town_city']) && $child_details['child_hidden_town_city'] !="")
		$address .= "<br>".$child_details['child_hidden_town_city'];
	
	if(isset($child_details['child_hidden_county']) && $child_details['child_hidden_county'] !="")
		$address .= "<br>".$child_details['child_hidden_county'];
		
	if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode'] !="")
		$address .= "<br>".$child_details['child_hidden_postcode'];	

}else{	
	if(isset($child_details['address1']) && $child_details['address1'] !="")
		$address .= $child_details['address1'];
	
	if(isset($child_details['address2']) &&  $child_details['address2']!="")
		$address .= "<br>".$child_details['address2'];
		
	if(isset($child_details['town']) && $child_details['town'] !="")
		$address .= "<br>".$child_details['town'];
	
	if(isset($child_details['county']) && $child_details['county'] !="")
		$address .= "<br>".$child_details['county'];
		
	if(isset($child_details['postcode_box']) && $child_details['postcode_box'] !="")
		$address .= "<br>".$child_details['postcode_box'];

}
$parent_address = "";
if($personal_details['personal_details_relation_to_child'] !="Parent/Guardian"){

	if(isset($child_details['parent_same_address_child']) && $child_details['parent_same_address_child'] == 1){	
		if(isset($child_details['parent_hidden_address1']) && $child_details['parent_hidden_address1']!="")
			$parent_address .= $child_details['parent_hidden_address1'];
		
		if(isset($child_details['parent_hidden_address2']) && $child_details['parent_hidden_address2'] !="")
			$parent_address .= "<br>".$child_details['parent_hidden_address2'];
			
		if(isset($child_details['parent_hidden_town_city']) && $child_details['parent_hidden_town_city'] !="")
			$parent_address .= "<br>".$child_details['parent_hidden_town_city'];
		
		if(isset($child_details['parent_hidden_county']) && $child_details['parent_hidden_county'] !="")
			$parent_address .= "<br>".$child_details['parent_hidden_county'];
			
		if(isset($child_details['parent_hidden_postcode']) && $child_details['parent_hidden_postcode'] !="")
			$parent_address .= "<br>".$child_details['parent_hidden_postcode'];
			

	}else{	
		if(isset($child_details['parent_address1']) && $child_details['parent_address1'] !="")
			$parent_address .= $child_details['parent_address1'];
		
		if(isset($child_details['parent_address2']) &&  $child_details['parent_address2']!="")
			$parent_address .= "<br>".$child_details['parent_address2'];
			
		if(isset($child_details['parent_town']) && $child_details['parent_town'] !="")
			$parent_address .= "<br>".$child_details['parent_town'];
		
		if(isset($child_details['parent_county']) && $child_details['parent_county'] !="")
			$parent_address .= "<br>".$child_details['parent_county'];
			
		if(isset($child_details['parent_postcode_box']) && $child_details['parent_postcode_box'] !="")
			$parent_address .= "<br>".$child_details['parent_postcode_box'];
			
	}
}
?>
<div class="row bg-light">      
    <div class="col-md-3"><label>Name</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$child_details['title']?> <?=$child_details['first_name']?> <?=$child_details['last_name']?></label></div>
    <div class="col-md-3"><label>Date of birth</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($child_details['cdob_day'].'-'.$child_details['cdob_month'].'-'.$child_details['cdob_year']))?></label></div>
   
    <div class="col-md-3"><label>Address</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$address?></label></div>
    
</div>


<?php if($personal_details['personal_details_relation_to_child'] !="Parent/Guardian"){?>
     
<div class="row bg-light">  
	<div class="col-md-3"><label class="font-weight-bold">Parent/Guardian</label></div>
    <div class="col-md-9 font-weight-bold">&nbsp;</div> 
    <div class="col-md-3"><label>Name</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=($child_details['parent_title']=="Other")?$child_details['parent_other_title']:$child_details['parent_title']?> <?=$child_details['parent_first_name']?> <?=$child_details['parent_last_name']?></label></div>
   
    <div class="col-md-3"><label>Address</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$parent_address?></label></div>
    
    <div class="col-md-3"><label>Daytime phone</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$child_details['parent_phone']?></label></div>
	
	<div class="col-md-3"><label>Email address</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$child_details['parent_email']?></label></div>
    
</div>

        
        <?php }?>