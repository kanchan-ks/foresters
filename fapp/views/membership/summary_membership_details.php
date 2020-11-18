<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
<div class="row bg-light">   
<?php if($membership_details['accept_membership_fee'] == 1 ){?>   
    <div class="col-md-3"><label>Amount</label></div>
    <div class="col-md-9 font-weight-bold"><label>&pound;<?=MEMBERSHIP_TERMS_FEE?></label></div>
 <?php }?> 
    
</div>