<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
<div class="row bg-light">   
<?php if($plan_details['terms_in_years'] !=" " ){?>   
    <div class="col-md-3"><label>Term in years</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=$plan_details['terms_in_years']?> Years</label></div>
 <?php }elseif($plan_details['specific_matuarity_day'] !=" " && $plan_details['specific_matuarity_month'] !=" " && $plan_details['specific_matuarity_year'] !=" " ){?>   
    <div class="col-md-3"><label>Specific maturity date</label></div>
    <div class="col-md-9 font-weight-bold"><label><?=date("d F Y", strtotime($plan_details['specific_matuarity_day']."-".$plan_details['specific_matuarity_month']."-".$plan_details['specific_matuarity_year']))?></label></div>
 <?php }?> 
    
</div>