<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);

?>
<form name="frmupdate_membershipdetails" id="frmupdate_membershipdetails" action="" method="post">
        <input type="hidden" name="data_type" value="membership_details">
        	
     	   	<div class="row">
        	<div class="col-md-12">
            <hr>
            <?php //if(isset($membership_details['terms_in_years']) && $membership_details['terms_in_years']!=""){?>
                <div class="row form-row mb-3">
                    	<div class="col-md-3 text-right font-weight-bold"><label>Term in years</label></div>
                        	<div class="col-md-2">
                            			<select name="terms_in_years" id="terms_in_years" class="form-control terms_in_years matuarity_membership" placeholder="Years">
                                                <option value=" ">Years</option>
                                                <?php for($d=10; $d <= 25; $d++){
                                                    echo "<option value='".$d."'";
																if(@$membership_details['terms_in_years'] == $d)
																	echo " selected";
															
															echo ">".$d." Years</option>";
                                                    }
                                                ?>
                                                </select>
                               </div>
                    </div>
					<div class="row form-row mb-3">
                    	<div class="col-md-4 text-right">OR</div>
                    </div> 
                    <?php //}else{?>
                    <div class="row form-row mb-2">
                        <div class="col-md-3 text-right font-weight-bold"><label>Specific maturity date</label></div>
                        <div class="col-md-1  mb-2">
                            <select name="specific_matuarity_day" id="specific_matuarity_day" class="form-control specific_matuarity_day " placeholder="Day">
                            <option value=" ">Day</option>
                            <?php for($d=1; $d <= 31; $d++){
                                echo "<option value='".$d."'";
									if(@$membership_details['specific_matuarity_day'] == $d)
										echo " selected";
								
								echo ">".$d."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-2  mb-2">
                            <?=form_dropdown('specific_matuarity_month',$list_maturity_month,@$membership_details['specific_matuarity_month'],'class="form-control select2 specific_matuarity_month" placeholder="Month" id="specific_matuarity_month"')?>
                        </div>
                        <div class="col-md-1  mb-2">
                            <select name="specific_matuarity_year" id="specific_matuarity_year" class="form-control select2 specific_matuarity_year matuarity_membership"   placeholder="Year">
                            <option value=" ">Year</option>
                            <?php 
                            $maturity_year = date('Y', strtotime("+10 years"));
                            $maturity_next_year = date('Y', strtotime("+35 years"));
                            for($maturity_year; $maturity_year <= $maturity_next_year; $maturity_year++){
                               echo "<option value='".$maturity_year."'";
								if(@$membership_details['specific_matuarity_year'] == $maturity_year)
									echo " selected";
							
							echo ">".$maturity_year."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-5"></div>
                    
                    </div> 
                    <?php //}?>
            </div> 
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<button type="submit" name="continue" class="btn pull-right" id="update_paln_details" data-step="2">Update</button>
            </div>
        </div>
             </form>