<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@extract($d);
?>
			
            <div class="row bg-light">
                <div class="col-md-3"><label>ID Proof type</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$your_identity_options->id_proof_type?></label></div>
                <div class="col-md-3"><label>Uploaded ID Proof</label></div>
                <div class="col-md-9 font-weight-bold"><label><a href="<?=base_url('ctfm/viewproof/'. $your_identity_options->id_proof_file)?>" target="_blank">View</a></label></div>
                <div class="col-md-3"><label>Address Proof type</label></div>
                <div class="col-md-9 font-weight-bold"><label><?=$your_identity_options->address_proof_type?></label></div>
                <div class="col-md-3"><label>Uploaded Address Proof</label></div>
                <div class="col-md-9 font-weight-bold"><label><a href="<?=base_url('ctfm/viewproof/'. $your_identity_options->address_proof_file)?>" target="_blank">View</a></label></div>
            </div>  