<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

				
?>
	<div class="container-fluid">
        <div class="row">
            <div class="title-content d-none d-md-block">
                <h3>CTF Maturities online portal</h3>
            </div>
        </div>
    </div>
    <div class="tabbable" id="pgbar">
        <?=$progressbar?>
    </div>
    <div class="page">
     	
        
        
        <section id="confirmation_section" class="your_details">
         <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Your Details</div>
            </div> 
            <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Payment Options</div>
            </div> 
            <div class="row progressbar">
                <div class="col-md-12 bg-limegreen">Summary</div>
            </div>
            <div class="row progressbar mb-2">
                <div class="col-md-12 bg-limegreen">Confirmation</div>
            </div>
     	   <div class="row">
        	<div class="col-md-12">
            <h3>Thank you</h3>
           
            <hr>
                 <h4>Your CTF Maturities online portal application has been submitted.</h4>
                
               <div class="row form-row">
               			<div class="col-md-12 monthly_conf_text hide"><label>Your monthly contribution by Direct Debit has now been set up. The first payment will be collected on or around 1st <?=date("F Y", strtotime("+38 days"))?>.</label></div>
                       <div class="col-md-12 lumpsum_conf_text hide"><p>Your lump sum payment has been received.</p></div>
                       <div class="col-md-12 transfer_conf_text hide"><p>Your transfer request has been received. We will contact you when this is completed, or if we need any further information. </p></div>
                       
                       <div class="col-md-12"><p><strong>Reference number: <span id="customer_ref_number"><?=$cutomer_ref_number?></span></strong><br>

This reference number will be emailed to you but you can also print this page. Please quote this reference number whenever you talk to us about your CTF Maturities online portal.<br><br>

<strong>What happens next?</strong><br>

You will receive your CTF Maturities online portal pack in the post within 5 working days. Please keep it in a safe place.<br><br>


If you have any questions, please contact our Member Services team:<br>

Email: <a href="mailto:memberservices@forestersfriendlysociety.co.uk">memberservices@forestersfriendlysociety.co.uk</a><br>

Telephone: 0800 988 2418<br><br>

<strong>Or write to:</strong><br>

Foresters Friendly Society<br>Foresters House<br>29/33 Shirley Road<br>Southampton<br>SO15 3EW<br><br>

Thank you for choosing us as the provider of your CTF Maturities online portal.<br>

<a href="https://www.forestersfriendlysociety.co.uk/foresters-customers/foresters-extras" target="_blank">Now you’re a member, don’t forget about your free member benefits</a> </p></div>
                        
                    </div>
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<a href="<?=base_url('ctfm/close_application')?>" class="btn pull-right closebtn">Close this window</a>
            </div>
        </div>
        </section>
        
    </div>
