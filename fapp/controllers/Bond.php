<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bond extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/bond.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		//$this->fapp->addJS(base_url('/assets/plugins/jquery-validate-tooltip.js'),false);
		$this->fapp->addJS(base_url("/assets/js/custom/bond.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index($type="one")	{
		$data = array();
		$this->session->sess_destroy();
				
		$data['type'] = $type;
			
		$data['progressbar'] = bond_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['employement_status'] = employement_status();
		$data['money_investment_source'] = money_investment_source();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('bond', 'bond_form_step', $data);
	}
	
	public function select_policy_type()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data_type = get_post('data_type');
			$policy_type = get_post('policy_type');
			$data['progressbar'] = bond_steps_pregressbar($step + 1);
			$all_fields_post_value = $this->security->xss_clean(get_post());
			$this->session->set_userdata($data_type, $all_fields_post_value);
			$data['policy_type'] = $this->session->userdata('policy_type', $policy_type);
			$data['view_policy_summary'] = $this->load->view('bond/view_policy_summary', $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	public function bond_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data_type = get_post('data_type');
			if((!empty(get_session('policy_type')) && get_session('policy_type')['policy_type'] == "Single Life") && $data_type == "personal_details")	
				$step = get_post('step') + 2;
			else
				$step = get_post('step') + 1;
			
			
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			$data['employement_status'] = employement_status();
			$data['money_investment_source'] = money_investment_source();
		
		
			$all_fields_post_value = $this->security->xss_clean(get_post());
			
			$this->session->set_userdata('process', true);	
			
			if(!empty($all_fields_post_value))
			{
				$data['progressbar'] = bond_steps_pregressbar($step);
				unset($all_fields_post_value['data_type']);
				
				$policy_type_blank = policy_type_details();
				$personal_details_blank = personal_details();
				$applicant_details_blank = applicant_details();
				$payment_options_blank = payment_options();
				
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				$data['valid_dob'] = false;
				$days = get_post('days');
				$months = get_post('months');
				$years = get_post('years');
				$min_age = get_min_age_diff();
				if(isset($days) && $days > ""){
					$get_dob_days = get_age_diff("$days/$months/$years");
					if($get_dob_days > $min_age){
						$this->session->set_userdata('valid_dob', true);
						$valid_dob = true;
					}else{
						$this->session->set_userdata('valid_dob', false);
						$valid_dob = false;
					}
					$data['valid_dob'] = $valid_dob;
				}
				
				$data['policy_type'] = "";
				
				$data['view_summary_personal_details'] = false;
				if(!empty($this->session->userdata('personal_details'))){
					
					$data['view_summary_personal_details'] = true;
					$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
					
					
					if(!empty($this->session->userdata('applicant_details')))
						$data['applicant_details'] = @array_merge($applicant_details_blank, $this->session->userdata('applicant_details'));
					else
						$data['applicant_details'] = $applicant_details_blank;
						
					if(!empty($this->session->userdata('policy_type')))	
						$data['policy_type'] = get_session('policy_type');	
							
					$data['view_applicant_opt'] = $this->load->view('bond/view_applicant_details', $data, true);

					
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
						
					$data['view_payment_opt'] = $this->load->view('bond/view_payment_options', $data, true);
					
					
					$data['personal_details_view'] = $this->load->view('bond/summary_personal_details', $data, true);
					
				}

				$data['view_summary_applicant_options'] = false;
				if(!empty($this->session->userdata('applicant_details')) && get_session('policy_type')['policy_type'] == "Joint Life"){
				//
					$data['view_summary_applicant_options'] = true;
					$data['applicant_details'] = array_merge($payment_options_blank, $this->session->userdata('applicant_details'));
					$data['applicant_summary_view'] = $this->load->view('bond/summary_applicant_details', $data, true);
				}



				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('bond/summary_payment_options', $data, true);
				}

				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data'=>$data)));
			
			}
            else{
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false,'msg'=>'Please fill required fields.')));
            }		
		}else{
			show_404();
		}
	}
	
	 public function back_step($step=1)	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = bond_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	public function check_dob()
	{
		if($this->input->is_ajax_request()){
			$data = array();
			$days = get_post('days');
			$months = get_post('months');
			$years = get_post('years');
			$get_dob_days = get_age_diff("$days/$months/$years");
			$min_age = get_min_age_diff();
			$max_age = get_max_age_diff();
			if(!checkdate($months, $days, $years))
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg' => MSG_INVALID_DATE)));
				return false;
			}else{
				//if($get_dob_days > MIN_YEARS_DOB && $get_dob_days < MAX_YEARS_DOB){//
				if($get_dob_days > $min_age && $get_dob_days < $max_age){
					$this->session->set_userdata('valid_dob', true);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => MAX_DOB_WARNING_MESSAGE_BOND)));
				}else{
					$this->session->set_userdata('valid_dob', false);
				}
			}
					
		}else{
			show_404();
		}
	}
	
	public function edit_summary()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			$data['progressbar'] = bond_steps_pregressbar($step);
			$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
			$data['employement_status'] = employement_status();
			$data['money_investment_source'] = money_investment_source();
		
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = bond_steps_pregressbar($step);
			$personal_details = get_session('personal_details');
			$applicant_details = get_session('applicant_details');
			$payment_options = get_session('payment_options');
			$policy_type = get_session('policy_type');
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			/*$form_forester_id = BOND_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
			$form_forester_id = generate_app_unique_id(FFS_PREFIX);
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
			
				$payment_data = array('order_id'=>$new_constant_value, 'customer_id' => $form_forester_id, 'create_date_time' => $create_date_time, 'personal_details'=> $personal_details, 'payment_details'=> $payment_options);
				$this->session->set_userdata("payment_data", $payment_data);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'payment' => true)));
				
		}else{
			show_404();
		}	
	}
	
	public function download($filename)
	{
		$filename = CUSTOMER_PDF_PATH.DIRECTORY_SEPARATOR.$filename;
		if(is_file_exists($filename)) {
				$file_content = file_get_contents($filename); 
				$this->load->helper('download');
				force_download(basename($filename), $file_content,true);
		}else{
			show_404();
		}
	}
	
	public function close_application()
	{
		$this->session->sess_destroy();
		redirect('https://www.forestersfriendlysociety.co.uk/','refresh',302);
	}
	
	public function submit_worldPay(){
		$payment_data = get_session('payment_data');
		submit_worldPayGlobal($payment_data, "Investment Bond(Lump Sum Investment)", "BONDLUMPSUM", "Investment Bond lump sum application", WORLD_PAY_BOND_REFER_URL);
	}
	
	public function confirmation()
	{
		
			if((isset($_GET['transStatus']) &&  $_GET['transStatus'] =="Y") && get_session('process')==true){
			$payment_data = get_session('payment_data');
			$new_constant_value = $payment_data['order_id'];
			$policy_type = get_session('policy_type');
			$personal_details = get_session('personal_details');
			$child_details = get_session('child_details');
			$payment_options = get_session('payment_options');
			$form_forester_id = $_GET['cartId'];
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
			$customer_name = "";
			
				$customer_xml = '<Form id="'.$new_constant_value.'" createdate="'.$create_date_time.'" forestersid="'. $form_forester_id .'">
										<returnState>0</returnState>
										<ID>'. $new_constant_value .'</ID>';
			if(!empty($personal_details))
			{
				$dob = date("d F Y", strtotime($personal_details['dob_day'].'-'.$personal_details['dob_month'].'-'.$personal_details['dob_year']));
				
				$old_address_change = (isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == 1)?"Yes":"No";
				$title = ($personal_details['title']=="Other")?$personal_details['other_title']:$personal_details['title'];
				$customer_name = $title.' ' .$personal_details['first_name'].' ' .$personal_details['last_name'];
				$pdf_password = strtoupper($personal_details['last_name']) . $personal_details['dob_year'];
				
				$customer_xml .= '
									<PolicyType>'.$policy_type['policy_type'].'</PolicyType>
									<Title>'.$title.'</Title>
									<Forename>'.$personal_details['first_name'].'</Forename>
									<Surname>'.$personal_details['last_name'].'</Surname>
									<DOB>'.$dob.'</DOB>
									<AddressLine1>'.$personal_details['address1'].'</AddressLine1>
									<AddressLine2>'.$personal_details['address2'].'</AddressLine2>
									<Town>'.$personal_details['town'].'</Town>
									<County>'.$personal_details['county'].'</County>
									<Postcode>'.$personal_details['postcode_box'].'</Postcode>
									<PhoneDay>'.$personal_details['phone'].'</PhoneDay>
									<Email>'.$personal_details['email'].'</Email>
									<AddressChange>Have you changed address in the last 3 months?</AddressChange>
									<AddressChangeValue>'.$old_address_change.'</AddressChangeValue>
									<PrevAddressLine1>'.$personal_details['additional_address1'].'</PrevAddressLine1>
									<PrevAddressLine2>'.$personal_details['additional_address2'].'</PrevAddressLine2>
									<PrevTown>'.$personal_details['additional_town_city'].'</PrevTown>
									<PrevCounty>'.$personal_details['additional_county'].'</PrevCounty>
									<PrevPostcode>'.$personal_details['additional_postcode_box'].'</PrevPostcode>
									<MembershipType>BOND</MembershipType>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>';
									
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_xml .= '<HearAboutIntroducer>'.$personal_details['HeardAboutUs_extra'].'</HearAboutIntroducer>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_xml .= '<HearAboutOther>'.$personal_details['HeardAboutUs_extra'].'</HearAboutOther>';
									
									
									$customer_xml .= '<PromotionalCode>'.$personal_details['offer_code'].'</PromotionalCode>';
									
				$customer_pdf .= 	'<h1>Investment BOND </h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y", strtotime($create_date_time)).'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Tracking: '.$_GET[0].'<br><br>
									<h1>Policy Type: '.$policy_type['policy_type'].'</h1>
									<h1>Your Details</h1>
									Title: '.$title.'<br>
									Forename: '.$personal_details['first_name'].'<br>
									Surname: '.$personal_details['last_name'].'<br>
									Date of Birth: '.$dob.'<br>
									Address Line 1: '.$personal_details['address1'].'<br>
									Address Line 2: '.$personal_details['address2'].'<br>
									Town: '.$personal_details['town'].'<br>
									County: '.$personal_details['county'].'<br>
									Postcode:'.$personal_details['postcode_box'].'<br>
									Phone: '.$personal_details['phone'].'<br>
									Email: '.$personal_details['email'].'<br>
									Have you changed address in the last 3 months? '.$old_address_change.'<br>
									How did you hear about us: '.get_marketing_source_code($personal_details['HeardAboutUs'], $personal_details['HeardAboutUs_extra']).'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';
						
								
			}
			
			if(!empty($applicant_details))
				{
						$applicant_dob = $applicant_details['apl_dob_day'] . "/" . $applicant_details['apl_dob_month'] . "/" . $applicant_details['apl_dob_year'];
						
						
						$customer_xml .= '<Title>'.$applicant_details['applicant_title'].'</Title>
											<Forename>'.$applicant_details['first_name'].'</Forename>
											<Surname>'.$applicant_details['last_name'].'</Surname>
											<DOB>'.$applicant_dob.'</DOB>';
						if(isset($applicant_details['applicant_hidden_postcode']) && $applicant_details['applicant_hidden_postcode']!=""){					
						$customer_xml .= '<AddressLine1>'.$applicant_details['applicant_hidden_address1'].'</AddressLine1>
											<AddressLine2>'.$applicant_details['applicant_hidden_address2'].'</AddressLine2>
											<Town>'.$applicant_details['applicant_hidden_town_city'].'</Town>
											<County>'.$applicant_details['applicant_hidden_county'].'</County>
											<Postcode>'.$applicant_details['applicant_hidden_postcode'].'</Postcode>';
						}else
						{
							$customer_xml .= '<AddressLine1>'.$applicant_details['address1'].'</AddressLine1>
												<AddressLine2>'.$applicant_details['address2'].'</AddressLine2>
												<Town>'.$applicant_details['town'].'</Town>
												<County>'.$applicant_details['county'].'</County>
												<Postcode>'.$applicant_details['postcode_box'].'</Postcode>';
						}					
						$customer_pdf .= 	'<h1>Applicant 2 details</h1>Applicant 2 Name: '.$applicant_details['applicant_title'].' '.$applicant_details['first_name'].' '.$applicant_details['last_name'].'<br>
											Applicant 2 Date of Birth: '.$applicant_dob.'<br>';
						if(isset($applicant_details['applicant_hidden_postcode']) && $applicant_details['applicant_hidden_postcode']!=""){	
						$customer_pdf .= 	'Address Line 1: '.$applicant_details['applicant_hidden_address1'].'<br>
											Address Line 2: '.$applicant_details['applicant_hidden_address2'].'<br>
											Town: '.$applicant_details['applicant_hidden_town_city'].'<br>
											County: '.$applicant_details['applicant_hidden_county'].'<br>
											Postcode:'.$applicant_details['applicant_hidden_postcode'].'<br>';	
						}else{
						$customer_pdf .= 	'Address Line 1: '.$applicant_details['address1'].'<br>
												Address Line 2: '.$applicant_details['address2'].'<br>
												Town: '.$applicant_details['town'].'<br>
												County: '.$applicant_details['county'].'<br>
												Postcode:'.$applicant_details['postcode_box'].'<br>';
						}									
					}
			
			if(!empty($payment_options))
				{
						$customer_pdf .= '<h1>Data Protection</h1>
											Receive post from us: Opt out<br>
											Receive email from us: Opt out<br>
											Receive SMS from us: Opt out<br>
											Receive phone from us: Opt out<br>';	
											
						if($payment_options['lumpsumEmployementStatus'] != ""){
							
							if($policy_type['policy_type'] == "Joint Life")
								$customer_pdf .= '<h2>First Applicant</h2>';
								
								$customer_pdf .= 'Employement Status: '.$payment_options['lumpsumEmployementStatus'];
							
							if($payment_options['lumpsumEmployementStatus'] == "Other")			
								$customer_pdf .= '<br>Employement Status Other: '.$payment_options['lumpsumEmployementStatus_extra'];
							
							$customer_pdf .= '<br>Source Of Income: '.$payment_options['lumpsum_money_investment_source'];
							
							if($payment_options['lumpsum_money_investment_source'] == "Other")			
								$customer_pdf .= '<br>Source Of Income Other: '.$payment_options['lumpsum_money_investment_source_extra'].'<br>';
								
									
						
						}
						
						if($payment_options['lumpsumEmployementStatus_joint'] != ""){
							
							
							if($policy_type['policy_type'] == "Joint Life"){
							
							$customer_pdf .= '<h2>Second Applicant</h2>Employement Status: '.$payment_options['lumpsumEmployementStatus_joint'];
							
							if($payment_options['lumpsumEmployementStatus_joint'] == "Other")			
								$customer_pdf .= '<br>Employement Status Other: '.$payment_options['lumpsumEmployementStatus_extra_joint'];
							
							$customer_pdf .= '<br>Source Of Income: '.$payment_options['lumpsum_money_investment_source_joint'];
							
							if($payment_options['lumpsum_money_investment_source_joint'] == "Other")			
								$customer_pdf .= '<br>Source Of Income Other: '.$payment_options['lumpsum_money_investment_source_extra_joint'].'<br>';
							
							}
						
						}
						
						$customer_pdf .= '<br>Money Laundering Regulations: checked
												<br>Declaration: checked';		
				}
			
			if(!empty($payment_options))
			{
				
				if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1)
				{				
						$customer_xml .= '<LumpSumAmountByDebitCard>£'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'</LumpSumAmountByDebitCard>
											<EmployementStatus>'.$payment_options['lumpsumEmployementStatus'].'</EmployementStatus>
											<EmployementStatusOther>'.$payment_options['lumpsumEmployementStatus_extra'].'</EmployementStatusOther>
											<SourceOfIncome>'.$payment_options['lumpsum_money_investment_source'].'</SourceOfIncome>
											<SourceOfIncomeOther>'.$payment_options['lumpsum_money_investment_source_extra'].'</SourceOfIncomeOther>
											<EmployementStatusSecondApplicant>'.$payment_options['lumpsumEmployementStatus_joint'].'</EmployementStatusSecondApplicant>
											<EmployementStatusOtherSecondApplicant>'.$payment_options['lumpsumEmployementStatus_extra_joint'].'</EmployementStatusOtherSecondApplicant>
											<SourceOfIncomeSecondApplicant>'.$payment_options['lumpsum_money_investment_source_joint'].'</SourceOfIncomeSecondApplicant>
											<SourceOfIncomeOtherSecondApplicant>'.$payment_options['lumpsum_money_investment_source_extra_joint'].'</SourceOfIncomeOtherSecondApplicant>';
											
											
						$customer_pdf .= '<h1>Lump Sum Investment</h1>
											Investment Amount: &pound;'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'<br>';
										
				}
			}
			
			if(!empty($personal_details))
			{
				$old_address_change = (isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == 1)?"Yes":"No";
				$customer_pdf .= 	'<h1>Previous Address</h1>
										Address Line 1: '.$personal_details['additional_address1'].'<br>
										Address Line 2: '.$personal_details['additional_address2'].'<br>
										Town: '.$personal_details['additional_town_city'].'<br>
										County: '.$personal_details['additional_county'].'<br>
										Postcode: '.$personal_details['additional_postcode_box'];
						
			}
			
			if(!empty($payment_options))
			{
				if(isset($_GET[0]) && $_GET[0] != "")
				{				
						$customer_pdf .= '<h1>Worldpay Online Payment</h1>
											Authorisation Date: '.$create_date_time.'<br>
											Reference Number: '.$_GET[0].' <br>
											Transaction Status: Payment Successful<br>
											<h1>Tracking</h1>Tracking: '.$_GET[0].'<br>';				
				}
			}
			
			$customer_xml .= '</Form>';
			$filename_xml = BOND_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
			$filename_pdf = BOND_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'BOND', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'Investment Bond Customer PDF', $filename_pdf, $pdf_password);
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = $_GET[0];//$payment_reference_number;
				$body['pdf_link'] = base_url('bond/download/'.$filename_pdf);
				$body['admin_body_content'] = BOND_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your Investment Bond application has been submitted", false, 'investment_bond_customer_confirmation');
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (Bond)");
					
					$data = array();
					$data['cutomer_ref_number'] = $form_forester_id;
					$data['type'] = "";
					$data['progressbar'] = bond_steps_pregressbar(6);
					$this->session->sess_destroy();
					$this->fapp->show('bond', 'bond_form_confirmation', $data);
					
			}else{
			redirect(base_url('bond'));
			exit;
			}				
	}
	
}
