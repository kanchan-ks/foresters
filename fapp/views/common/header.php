<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_controller = $this->router->fetch_class();

if(strstr(strtolower($current_controller),"pois_")){
?>
<div class="container-fluid">
        <div class="row main-head-inner">
        <div class="col-12 logo">
            <a href="<?=base_url($current_controller)?>" title="Home">
                <img src="<?=base_url('assets/images/logo/pois-logo.png')?>" alt="Post Office Insurance Society (POIS)" id="logo">
            </a>

            <div class="row">
                <div class="col-12 d-none d-md-block no-padding">
                    <div class="call-us-on">
                        <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:08009882418" class="call-us">0800 622 417</a>
                    </div>
                </div>
            </div>
            </div>
        
    </div>
    </div>
 <?php }else{?>
 	<div class="container-fluid">
        <div class="row main-head-inner">
        <div class="col-12 logo">
            <a href="<?=base_url($current_controller)?>" title="Home">
                <img src="<?=base_url('assets/images/logo/logo.gif')?>" alt="Foresters Friendly Society" id="logo">
            </a>

            <div class="row">
                <div class="col-12 d-none d-md-block no-padding">
                    <div class="call-us-on">
                        <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:08009882418" class="call-us">0800 988 2418</a>
                    </div>
                </div>
            </div>
            </div>
        
    </div>
    </div>
 <?php }?>   
				<!-- Top-header closed -->