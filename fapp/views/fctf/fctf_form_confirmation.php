<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

				
?>
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="title-content">
                    <h3>Child Trust Fund Top up</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="tabbable" id="pgbar">
        <?=$progressbar?>
    </div>
    <div class="page">
     	
        
        
        <section id="confirmation_section" class="your_details">
        <div class="row progressbar">
        <div class="col-lg-12 bg-limegreen">Policy number</div>
        </div>
         <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Your details</div>
        </div>
         <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Child's details</div>
        </div>
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Payment details</div>
        </div>
        <div class="row progressbar">
            <div class="col-lg-12 bg-limegreen">Summary</div>
        </div>
        <div class="row progressbar mb-2">
            <div class="col-lg-12 bg-limegreen">Confirmation</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Thank you</h3>
    
                <hr>
                <h4>Your Child Trust Fund Top up has been submitted.</h4>
                
               <div class="row form-row">
               			
                       
                       <div class="col-md-12"><p><strong>Reference number: <span id="customer_ref_number"><?=$cutomer_ref_number?></span></strong><br>

This reference number will be emailed to you but you can also print this page. Please quote this reference number whenever you talk to us about your Child Trust Fund.<br><br>

<strong>What happens next?</strong><br>

If you have any questions, please contact our Member Services team.<br><br>
Email: <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a><br>

Telephone: 0800 988 2418<br><br>

<strong>Or write to:</strong><br>

Foresters Friendly Society<br>Foresters House<br>29/33 Shirley Road<br>Southampton<br>SO15 3EW<br><br>

Thank you for choosing us as the provider of your Child Trust Fund.<br>

<a href="https://www.forestersfriendlysociety.co.uk/foresters-customers/foresters-extras" target="_blank">Don't forget about the free extra benefits available to members.</a></p></div>
                        
                    </div>
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<a href="<?=base_url('fctf/close_application')?>" class="btn pull-right closebtn">Close this window</a>
            </div>
        </div>
        </section>
        
    </div>
