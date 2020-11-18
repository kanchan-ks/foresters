<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ctfm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/ctfm.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/ctfm.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index($type="one")	{
		$data = array();
		$this->session->sess_destroy();
		
		if(strtolower($type) == "topup")
			$this->session->set_userdata('set_topup', true);
		else
			$this->session->set_userdata('set_topup', false);
				
		$data['type'] = $type;
			
		$data['progressbar'] = ctfm_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['list_title'] = ctfm_list_title();
		$data['month'] = list_month();
		$data['list_id_proof_type'] = list_id_proof_type();
		$data['list_address_proof_type'] = list_address_proof_type();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('ctfm', 'ctfm_form_step', $data);
	}
	
	public function get_data()
	{
		if($this->input->is_ajax_request()){
			$uniqueID = get_post('uniqueID');
			$fdob_day = get_post('fdob_day');
			$fdob_month = get_post('fdob_month');
			$fdob_year = get_post('fdob_year');
			$dob = "$fdob_year-$fdob_month-$fdob_day";
			
			
			$data['progressbar'] = ctfm_steps_pregressbar(2);
			$data['personal_details'] = personal_details();
			$data['payment_options'] = payment_options();
			$data['list_title'] = ctfm_list_title();
			$data['month'] = list_month();
			$data['list_id_proof_type'] = list_id_proof_type();
			$data['list_address_proof_type'] = list_address_proof_type();
			
			$this->load->model('customers');
			$customer = $this->customers->get_customer(array('uniqueID'=>$uniqueID, 'dob'=>$dob, 'status'=>0), true);
			if(!empty($customer))
			{
				$data['personal_details'] = $customer;
				$this->session->set_userdata('customer_id', ed('e',$customer->id));
				$data['edit_customer_detail'] = $this->load->view('ctfm/view_list_personal_details', $data, true);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			}else
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false,'msg'=>"Sorry, that number or date of birth do not match our records. Please check the number and re-try. If you are unable to proceed, please call us on 0800 988 2418 and we'll be happy to help.")));
			}
			
		}else{
			show_404();
		}
	}
	
	
	
	public function edit_summary()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = ctfm_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	public function update_your_details()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data['progressbar'] = ctfm_steps_pregressbar(3);
			$id = ed('d', get_post('uid'));
			
			$phone = get_post('phone');
			$new_email = get_post('email');
			$NI1 = get_post('NI1');
			$NI2 = get_post('NI2');
			$NI3 = get_post('NI3');
			$NI4 = get_post('NI4');
			$NI5 = get_post('NI5');
			$ni_segment = $NI1 .' '. $NI2 .' '. $NI3 .' '. $NI4 .' '. $NI5;
			$this->load->model('customers');
			$customer = $this->customers->get_customer(array('id'=>$id, 'status'=>0), true);
			if(!empty($customer))
			{
				if($new_email!="")
					$email = $new_email;
				else
					$email = $customer->email;	
					
				$customer_data = $this->customers->get_customer_data(array('policy_number'=>$customer->policy_number), true);
				
				if(!empty($customer_data))
				{
					$this->session->set_userdata('uid', ed('e', $customer_data->id));
					$insert = $this->customers->update_customer_details(array('id'=>$customer_data->id, 'policy_number'=>$customer->policy_number, 'title'=>$customer->title, 'first_name'=>$customer->first_name, 'last_name'=>$customer->last_name, 'dob'=>$customer->dob, 'ni_number'=>$ni_segment, 'phone'=>$phone, 'email'=>$new_email, 'address1'=>$customer->address1, 'address2'=>$customer->address2, 'town'=>$customer->town, 'county'=>$customer->county, 'postcode'=>$customer->postcode, 'policy_value'=>$customer->policy_value, 'uniqueID'=>$customer->uniqueID, 'created_date'=>db_date()));
				}else{
					$insert = $this->customers->insert_customer_details(array('policy_number'=>$customer->policy_number, 'title'=>$customer->title, 'first_name'=>$customer->first_name, 'last_name'=>$customer->last_name, 'dob'=>$customer->dob, 'ni_number'=>$ni_segment, 'phone'=>$phone, 'email'=>$email, 'address1'=>$customer->address1, 'address2'=>$customer->address2, 'town'=>$customer->town, 'county'=>$customer->county, 'postcode'=>$customer->postcode, 'policy_value'=>$customer->policy_value, 'uniqueID'=>$customer->uniqueID, 'created_date'=>db_date()));
					$this->session->set_userdata('uid', ed('e', $insert));
				}
				
				$data['investment_value'] = str_replace(",","",$customer->policy_value);
				$data['investment_date'] = date("d/m/Y", strtotime($customer->created_date));
				$data['personal_details'] = $this->customers->get_customer_data(array('policy_number'=>$customer->policy_number), true);
				$data['peronal_detail_summary_view'] = $this->load->view('ctfm/summary_personal_details', $data, true);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			}	
		}else{
			show_404();
		}
	}
	
	
	public function update_choice_details()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			
			$customer_id = ed('d', get_session('customer_id'));
			$id = ed('d', get_session('uid'));
			$reinvest_all_money = get_post('reinvest_all_money');
			
			if($reinvest_all_money == 1)
				$data['progressbar'] = ctfm_steps_pregressbar(5);
			else
				$data['progressbar'] = ctfm_steps_pregressbar(4);
					
			$invest_all_in_lifetime = get_post('invest_all_in_lifetime');
			$invest_all_in_ssisa = get_post('invest_all_in_ssisa');
			$invest_all_lifetimeisa = str_replace(",","",get_post('invest_all_lifetimeisa'));
			$invest_all_ssisa = get_post('invest_all_ssisa');
			$invest_some_in_lifetime = get_post('invest_some_in_lifetime');
			$invest_some_in_ssisa = get_post('invest_some_in_ssisa');
			$invest_some_lifetimeisa = str_replace(",","",get_post('invest_some_lifetimeisa'));
			$invest_some_ssisa = str_replace(",","",get_post('invest_some_ssisa'));
			$accept_some_invest_consent = get_post('accept_some_invest_consent');
			
			$this->load->model('customers');
			$customer = $this->customers->get_customer(array('id'=>$customer_id, 'status'=>0), true);
			$customer_data = $this->customers->get_customer_data(array('id'=>$id), true);
			if(!empty($customer_data))
			{
				if($reinvest_all_money == 3){
					$insert_data = array('id'=>$customer_data->id, 'reinvest_all'=>0, 'reinvest_all_in_lifetimeisa'=>0, 'reinvest_all_lifetime_value'=>'0.00', 'reinvest_all_in_ssisa'=>0, 'reinvest_all_ssisa_value'=>'0.00', 'reinvest_some'=>0, 'reinvest_some_in_lifetimeisa'=>0, 'reinvest_some_in_lifetime_value'=>'0.00', 'reinvest_some_in_ssisa'=>0, 'reinvest_some_in_ssisa_value'=>'0.00', 'take_the_money'=>1, 'take_the_money_terms'=>1, 'account_holder_name'=>'', 'account_number'=>'', 'sort_code'=>'', 'building_society_number'=>'');
					$step = 4;
					$this->session->set_userdata('skip_payment', false);
				}else if($reinvest_all_money == 2){
					$insert_data = array('id'=>$customer_data->id, 'reinvest_some'=>1, 'reinvest_some_in_lifetimeisa'=>$invest_some_in_lifetime, 'reinvest_some_in_lifetime_value'=>$invest_some_lifetimeisa, 'reinvest_some_in_ssisa'=>$invest_some_in_ssisa, 'reinvest_some_in_ssisa_value'=>$invest_some_ssisa, 'reinvest_all'=>0, 'reinvest_all_in_lifetimeisa'=>0, 'reinvest_all_lifetime_value'=>'0.00', 'reinvest_all_in_ssisa'=>0, 'reinvest_all_ssisa_value'=>'0.00', 'take_the_money'=>0, 'take_the_money_terms'=>0, 'account_holder_name'=>'', 'account_number'=>'', 'sort_code'=>'', 'building_society_number'=>'');
					$step = 4;
					$this->session->set_userdata('skip_payment', false);
				}else{
					$insert_data = array('id'=>$customer_data->id, 'reinvest_all '=>1, 'reinvest_all_in_lifetimeisa'=>$invest_all_in_lifetime, 'reinvest_all_lifetime_value'=>$invest_all_lifetimeisa, 'reinvest_all_in_ssisa'=>$invest_all_in_ssisa, 'reinvest_all_ssisa_value'=>$invest_all_ssisa, 'reinvest_some'=>0, 'reinvest_some_in_lifetimeisa'=>0, 'reinvest_some_in_lifetime_value'=>'0.00', 'reinvest_some_in_ssisa'=>0, 'reinvest_some_in_ssisa_value'=>'0.00', 'take_the_money'=>0, 'take_the_money_terms'=>0, 'account_holder_name'=>'', 'account_number'=>'', 'sort_code'=>'', 'building_society_number'=>'');
					$step = 5;
					$this->session->set_userdata('skip_payment', true);
				}
				$data['step'] = $step;
				
				$insert = $this->customers->update_customer_details($insert_data);
				
				$data['your_choice_details'] = $this->customers->get_customer_data(array('policy_number'=>$customer_data->policy_number), true);
				$data['summary_your_choice_view'] = $this->load->view('ctfm/summary_your_choice', $data, true);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			}else{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg'=>"Oppsss! Something wrong.")));
			}	
		}else{
			show_404();
		}
	}
	
	
	public function update_payment_details()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			
			$id = ed('d', get_session('uid'));
			
			$data['progressbar'] = ctfm_steps_pregressbar(5);
			
			$bank_details = array();		
			$bank_account_holder_name = get_post('account_holder_name');
			$bank_account_number = get_post('account_number');
			$bank_account_sort_code = get_post('account_sort_code');
			$building_society_number = get_post('building_society_number');
			
			$this->load->model('customers');
			$customer = $this->customers->get_customer_data(array('id'=>$id), true);
			if(!empty($customer))
			{
				
				$insert = $this->customers->update_customer_details(array('id'=>$customer->id, 'account_holder_name'=>$bank_account_holder_name, 'account_number'=>$bank_account_number, 'sort_code'=>$bank_account_sort_code, 'building_society_number'=>$building_society_number));
				
				$data['payment_options'] = $this->customers->get_customer_data(array('policy_number'=>$customer->policy_number), true);
				$data['summary_payment_options_view'] = $this->load->view('ctfm/summary_payment_options', $data, true);
				
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			}else
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg'=>"No record found!")));
			}	
		}else{
			show_404();
		}
	}
	
	public function update_identity_details()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			
			$id = ed('d', get_session('uid'));
			$data['progressbar'] = ctfm_steps_pregressbar(6);
			$bank_details = array();		
			$id_proof_type = get_post('id_proof_type');
			$id_proof_file = '';
			$address_proof_type = get_post('address_proof_type');
			$address_proof_file = '';
			
			$this->load->model('customers');
			$customer_data = $this->customers->get_customer_data(array('id'=>$id), true);
			if(!empty($customer_data))
			{
				
				
				//Delete all ID's before uploading new ID
				array_map( 'unlink', array_filter((array) glob(CFTM_ID_ADDRESS_PROOF . DIRECTORY_SEPARATOR . $customer_data->policy_number . DIRECTORY_SEPARATOR . "*")));
				
				//Upload ID proof
				$upload_path = CFTM_ID_ADDRESS_PROOF;
				$policy_number = $customer_data->policy_number; //creare seperate folder for each user 
				$upload_idPath = $upload_path."/".$policy_number;
				if(!file_exists($upload_idPath)) 
				{
						   mkdir($upload_idPath, 0777, true);
				}
				$config_id_file = array(
				'upload_path' => $upload_idPath,
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'encrypt_name' => TRUE,
				'max_size' => "10240", //10 MB
				);
				$this->load->library('upload', $config_id_file);
				if(!$this->upload->do_upload('id_proof_file')){
					$data['imageError'] =  $this->upload->display_errors();
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg'=> $this->upload->display_errors())));
					return false;
				}else{
					$imageDetailArray = $this->upload->data();
					$id_proof_file =  $imageDetailArray['file_name'];
				}
				
				$config_address_file = array(
				'upload_path' => $upload_idPath,
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'encrypt_name' => TRUE,
				'max_size' => "10240", //10 MB
				);
				$this->load->library('upload', $config_id_file);
				if(!$this->upload->do_upload('address_proof_file')){
					$data['imageError'] =  $this->upload->display_errors();
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg'=> $this->upload->display_errors())));
					return false;
				}else{
					$imageDetailArray = $this->upload->data();
					$address_proof_file =  $imageDetailArray['file_name'];
				}
				
				$insert = $this->customers->update_customer_details(array('id'=>$customer_data->id, 'id_proof_type'=>$id_proof_type, 'id_proof_file'=>$id_proof_file, 'address_proof_type'=>$address_proof_type, 'address_proof_file'=>$address_proof_file));
				
				$customer_idnty_data = $this->customers->get_customer_data(array('id'=>$id), true);
				$data['your_identity_options'] = $customer_idnty_data;
				$data['summary_your_identity_view'] = $this->load->view('ctfm/summary_your_identity', $data, true);
				
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			}	
		}else{
			show_404();
		}
	}
	
	 public function back_step($step=1)	{
		if($this->input->is_ajax_request()){
			$data = array();
			$data_type = get_post('data_type');
			$step = get_post('step');
			if(get_session('skip_payment')== true && $data_type == "your_identity")
				$data['progressbar'] = ctfm_steps_pregressbar(3);
			else
				$data['progressbar'] = ctfm_steps_pregressbar($step);
					
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$id = ed('d',get_session('uid'));
			$customer_id = ed('d',get_session('customer_id'));
			$data['progressbar'] = ctfm_steps_pregressbar(6);
			$this->load->model('customers');
			//$customer = $this->customers->get_customer(array('id'=>$id), true);
			$customer_data = $this->customers->get_customer_data(array('id'=>$id), true);
			if(!empty($customer_data)){
			
			
			$new_constant_value = $customer_data->policy_number;//$customer_dataCUSTOMER_APPLICATION_NO + 1;
			
			
			$form_forester_id = $new_constant_value;//CTFM_CUSTOMER_APPLICATION_PFX . date("dm") . 
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
			$customer_name = "";
			
			$form_forester_id = $customer_data->policy_number;
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
		
			
			$customer_xml = '<Form id="'.$new_constant_value.'" createdate="'.$create_date_time.'" forestersid="'. $form_forester_id .'">
									<returnState>0</returnState>
									<ID>'. $new_constant_value .'</ID>';
			
				$dob = date("d F Y", strtotime($customer_data->dob));
				$ni_number = str_replace("-","",$customer_data->ni_number);
				
				$title = $customer_data->title;
				$customer_name = $title.' ' .$customer_data->first_name.' ' .$customer_data->last_name;
				
				
				$customer_xml .= '	<Title>'.$title.'</Title>
									<Forename>'.$customer_data->first_name.'</Forename>
									<Surname>'.$customer_data->last_name.'</Surname>
									<DOB>'.$dob.'</DOB>
									<NationalInsuranceNumber>'.strtoupper($ni_number).'</NationalInsuranceNumber>
									<AddressLine1>'.$customer_data->address1.'</AddressLine1>
									<AddressLine2>'.$customer_data->address2.'</AddressLine2>
									<Town>'.$customer_data->town.'</Town>
									<County>'.$customer_data->county.'</County>
									<Postcode>'.$customer_data->postcode.'</Postcode>
									<PhoneDay>'.$customer_data->phone.'</PhoneDay>
									<Email>'.$customer_data->email.'</Email>';
									
				$customer_pdf .= 	'<h1>CTFM </h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y").'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Tracking:<br><br>
									<h1>Your Details</h1>
									Title: '.$title.'<br>
									Forename: '.$customer_data->first_name.'<br>
									Surname: '.$customer_data->last_name.'<br>
									Date of Birth: '.$dob.'<br>
									National Insurance Number: '.strtoupper($ni_number).'<br>
									Address Line 1: '.$customer_data->address1.'<br>
									Address Line 2: '.$customer_data->address2.'<br>
									Town: '.$customer_data->town.'<br>
									County: '.$customer_data->county.'<br>
									Postcode:'.$customer_data->postcode.'<br>
									Phone: '.$customer_data->phone.'<br>
									Email: '.$customer_data->email.'<br>';
						
						$customer_pdf .= '<h1>Data Protection</h1>
											Receive post from us: Opt out<br>
											Receive email from us: Opt out<br>
											Receive SMS from us: Opt out<br>
											Receive phone from us: Opt out<br>';	
											
			
			
				if($customer_data->reinvest_all == 1)
				{

					$customer_xml .= '<MakeYourChoice>Reinvest all of your CTF</MakeYourChoice>
				
										<ReinvestAllLifetimeISA>£'.@number_format(str_replace(",","",$customer_data->reinvest_all_lifetime_value),'0','',',').'</ReinvestAllLifetimeISA>
										<ReinvestAllSSISA>£'.@number_format(str_replace(",","",$customer_data->reinvest_all_ssisa_value),'0','',',').'</ReinvestAllSSISA>';
										
					$customer_pdf .= '<h1>Make your choice</h1>
										Reinvest all of your CTF<br>
										Reinvest all in Lifetime ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_all_lifetime_value),'0','',',').'<br>
										Reinvest all in Stocks & Shares ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_all_ssisa_value),'0','',',').'<br>';						
				}
				if($customer_data->reinvest_some == 1)
				{

					$customer_xml .= '<MakeYourChoice>Reinvest some, Take some</MakeYourChoice>
				
										<ReinvestSomeLifetimeISA>£'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_lifetime_value),'0','',',').'</ReinvestSomeLifetimeISA>
										<ReinvestSomeSSISA>£'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_ssisa_value),'0','',',').'</ReinvestSomeSSISA>
										
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										

										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$customer_data->account_holder_name.'</AccountName>
										
										<AccountNumber>'.$customer_data->account_number.'</AccountNumber>
										
										<SortCode>'.$customer_data->sort_code.'</SortCode>
										
										<IsAccountValid>True</IsAccountValid>
										<BuildingSocietyNumber>'.$customer_data->building_society_number .'</BuildingSocietyNumber>';
										
					$customer_pdf .= '<h1>Make your choice</h1>
										Reinvest some, Take some<br>
										Reinvest some in Lifetime ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_lifetime_value),'0','',',').'<br>
										Reinvest some in Stock & Shares ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_ssisa_value),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Account Holder Name: '.$customer_data->account_holder_name.'<br>
										Account Number: '.$customer_data->account_number.'<br>
										Sort Code: '.$customer_data->sort_code.'<br>
										Is Account Valid: True<br>
										Building Society Number: '.$customer_data->sort_code.'<br>';						
				}
				if($customer_data->take_the_money == 1)
				{

					$customer_xml .= '<MakeYourChoice>Take the money</MakeYourChoice>
				
										<TakeTheMoney>Take the money</TakeTheMoney>
										<AccountName>'.$customer_data->account_holder_name.'</AccountName>
										
										<AccountNumber>'.$customer_data->account_number.'</AccountNumber>
										
										<SortCode>'.$customer_data->sort_code.'</SortCode>
										
										<BuildingSocietyNumber>'.$customer_data->building_society_number .'</BuildingSocietyNumber>
										
										<IsAccountValid>True</IsAccountValid>';
										
					$customer_pdf .= '<h1>Make your choice</h1>
										Reinvest some, Take some<br>
										Reinvest all in Lifetime ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_lifetime_value),'0','.',',').'<br>
										Reinvest all in Stock & Shares ISA: &pound;'.@number_format(str_replace(",","",$customer_data->reinvest_some_in_ssisa_value),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Account Holder Name: '.$customer_data->account_holder_name.'<br>
										Account Number: '.$customer_data->account_number.'<br>
										Sort Code: '.$customer_data->sort_code.'<br>
										Is Account Valid: True<br>
										Building Society Number: '.$customer_data->sort_code.'<br>';						
				}
				
				if($customer_data->id_proof_type !="")
				{

					$customer_xml .= '<IDProofType>'. $customer_data->id_proof_type .'</IDProofType>
									<AddressProofType>'. $customer_data->address_proof_type .'</AddressProofType>';
										
					$customer_pdf .= '<h1>Your identity</h1>
										ID Proof Type: '.$customer_data->id_proof_type.'<br>
										Address Proof Type: '.$customer_data->address_proof_type.'<br>';						
				}
			
			
			
			
			$customer_xml .= '</Form>';
			$filename_xml = CTFM_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$customer_data->last_name) .'.xml';
			$filename_pdf = CTFM_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$customer_data->last_name) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'CTFM', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'CTFM Customer PDF', $filename_pdf, '');
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('ctfm/download/'.$filename_pdf);
				$body['admin_body_content'] = CTFM_ADMIN_EMAIL_BODY_CONTENT;
				
				
				
				sendEmailtoCustomer($customer_data->email, $body, "Your Child Trust Fund Choices form has been submitted", false,"ctfm_customer_confirmation");
				
				sendEmailtoAdmin(ADMIN_EMAIL_CTFM, $body, "New Child Trust Fund Choices form submitted");
				
				//$this->customers->update_customer(array('id'=>$customer_id, 'status'=>1));
				$this->session->sess_destroy();
				
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
			}
		}else{
			show_404();
		}	
	}
	
	public function download($filename)
	{
		$filename = CUSTOMER_PDF_PATH.DIRECTORY_SEPARATOR.$filename;
		if(is_file_exists($filename)) {
				$file_content = @file_get_contents($filename); 
				$this->load->helper('download');
				force_download(basename($filename), $file_content,true);
		}else{
			show_404();
		}
	}
	
	public function viewproof($filename)
	{
		$id = ed('d', get_session('uid'));
		$this->load->model('customers');
		$customer_data = $this->customers->get_customer_data(array('id'=>$id), true);
		if(!empty($customer_data)){
			$filename = CFTM_ID_ADDRESS_PROOF.DIRECTORY_SEPARATOR . $customer_data->policy_number . DIRECTORY_SEPARATOR .$filename;
			if(is_file_exists($filename)) {
					$file_content = file_get_contents($filename); 
					$this->load->helper('download');
					force_download(basename($filename), $file_content,true);
			}else{
				show_404();
			}
		}else{
				show_404();
			}	
	}
	
	public function close_application()
	{
		$this->session->sess_destroy();
		redirect('https://www.forestersfriendlysociety.co.uk/','refresh',302);
	}
}
