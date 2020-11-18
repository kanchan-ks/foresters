<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
			<div class="row bg-light">
                <div class="col-md-3"><label>Monthly premium</label></div>
                <div class="col-md-9 font-weight-bold"><label>&pound;<?=@number_format(str_replace(",","",$premium_details['pay_premium']),'0','.',',')?></label></div>
            </div>             