<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Over50 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/over50.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/over50.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index($type="one")	{
		$data = array();
		$this->session->sess_destroy();
		
		$data['type'] = $type;
		$data['progressbar'] = over50_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['beneficiary_details'] = beneficiary_details();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('over50', 'over50_form_step', $data);
	}
	
	public function over50_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			$data_type = get_post('data_type');
			
			$this->session->set_userdata('process', true);	
								
			$step = get_post('step')+1;
			$all_fields_post_value = $this->security->xss_clean(get_post());
			
			if(!empty($all_fields_post_value))
			{
				$data['progressbar'] = over50_steps_pregressbar($step);
				unset($all_fields_post_value['data_type']);
				
				$personal_details_blank = personal_details();
				$beneficiary_details_blank = beneficiary_details();
				$premium_options_blank = premium_options();
				$payment_options_blank = payment_options();
				
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				$data['valid_dob'] = false;
				$days = get_post('days');
				$months = get_post('months');
				$years = get_post('years');
				if(isset($days) && $days > ""){
					$get_dob_days = get_age_diff("$days/$months/$years");
					if($get_dob_days > MIN_YEARS_DOB){
						$this->session->set_userdata('valid_dob', true);
						$valid_dob = true;
					}else{
						$this->session->set_userdata('valid_dob', false);
						$valid_dob = false;
					}
					$data['valid_dob'] = $valid_dob;
				}
				
				$data['view_summary_personal_details'] = false;
				if(!empty($this->session->userdata('personal_details'))){
					$data['view_summary_personal_details'] = true;
				
					
					$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
					$data['personal_details_view'] = $this->load->view('over50/summary_personal_details', $data, true);
					
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
						
					$data['view_payment_opt'] = $this->load->view('over50/view_payment_options', $data, true);
					
					
					if(!empty($this->session->userdata('beneficiary_details')))
						$data['beneficiary_details'] = @array_merge($beneficiary_details_blank, $this->session->userdata('beneficiary_details'));
					else
						$data['beneficiary_details'] = $beneficiary_details_blank;	
							
					$data['view_beneficiary_opt'] = $this->load->view('over50/view_beneficiary_details', $data, true);
				}
				
				$data['view_summary_beneficiary_details'] = false;
				if(!empty($this->session->userdata('beneficiary_details'))){
					$data['view_summary_beneficiary_details'] = true;
					$data['beneficiary_details'] = @array_merge($beneficiary_details_blank, $this->session->userdata('beneficiary_details'));
					$data['beneficiary_details_view'] = $this->load->view('over50/summary_beneficiary_details', $data, true);
					
					
				}
				
				$data['view_summary_premium_details'] = false;
				if(!empty($this->session->userdata('premium_details'))){
					$data['view_summary_premium_details'] = true;
					$data['premium_details'] = @array_merge($premium_options_blank, $this->session->userdata('premium_details'));
					$data['premium_details_view'] = $this->load->view('over50/summary_premium_options', $data, true);
					
					
				}
				
				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('over50/summary_payment_options', $data, true);
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
			
			if(get_session('valid_beneficiary_dob')== true){
				$skip_beneficiary_section_step = 2;
				$data['skip_beneficiary_section_step']=2;
			}else{
				$skip_beneficiary_section_step = 1;
				$data['skip_beneficiary_section_step']=1;
			}
			
			$data['progressbar'] = over50_steps_pregressbar($step);
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
			$beneficiary = get_post('beneficiary');
			$get_dob_days = get_age_diff("$days/$months/$years");
			$date_now = new DateTime();
			$selected_date    = new DateTime("$months/$days/$years");
 			/*if($get_dob_days > MIN_YEARS_DOB){
				$this->session->set_userdata('valid_dob', true);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => MAX_DOB_WARNING_MESSAGE_OVER50)));
			}else{
				$this->session->set_userdata('valid_dob', false);
			}*/
			$this->session->set_userdata('valid_dob', false);
			
			if ($date_now < $selected_date) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg' => "You have selected future date.")));
				return false;
			}
			
			if(!checkdate($months, $days, $years))
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg' => MSG_INVALID_DATE)));
				return false;
			}
			
			
			if(isset($beneficiary) && $beneficiary==true){
				$min_age = get_min_age_diff(16, false);
				$max_age = get_max_age_diff(18);
			
				if($get_dob_days >= $min_age && $get_dob_days < $max_age)
				{
					$this->session->set_userdata('beneficiary_dob_nin', true);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'beneficiary_valid'=>true)));
				}else{
					$this->session->set_userdata('beneficiary_dob_nin', false);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'beneficiary_valid'=>false)));
				}	
			}else{
				$min_beneficiary_age = get_min_age_diff(16, false);
				$max_beneficiary_age = get_max_age_diff(18);
				
				if($get_dob_days >= $min_beneficiary_age && $get_dob_days < $max_beneficiary_age)
				{
					$this->session->set_userdata('valid_beneficiary_dob', true);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'beneficiary_valid'=>true)));
				}else{
					$this->session->set_userdata('valid_beneficiary_dob', false);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'beneficiary_valid'=>false)));
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
			$data['progressbar'] = over50_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	
	public function edit_beneficiary()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$data['month'] = list_month();
			$view = $this->load->view('over50/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	public function edit_payment()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$view = $this->load->view('over50/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	public function update_your_details()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$all_fields_post_value = get_post();
			$data_type = get_post('data_type');
			$data['data_type'] = $data_type;
			if(!empty($all_fields_post_value))
			{
				
				$personal_details_blank = personal_details();
				$beneficiary_details_blank = beneficiary_details();
				$payment_options_blank = payment_options();
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				if($data_type == "personal_details"){
						$data['view_summary_personal_details'] = true;
						$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
						$data['personal_details_view'] = $this->load->view('over50/summary_personal_details', $data, true);
				}
				
				if(!empty($this->session->userdata('beneficiary_details'))){
					$data['view_summary_beneficiary_details'] = true;
					$data['beneficiary_details'] = @array_merge($beneficiary_details_blank, $this->session->userdata('beneficiary_details'));
					$data['beneficiary_details_view'] = $this->load->view('over50/summary_beneficiary_details', $data, true);
					
					
				}
				
				if($data_type == "payment_options"){
						$data['view_summary_payment_options'] = true;
						$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
						$data['payment_options_view'] = $this->load->view('over50/summary_payment_options', $data, true);
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
	
	
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = over50_steps_pregressbar(6);
			$personal_details = get_session('personal_details');
			$beneficiary_details = get_session('beneficiary_details');
			$payment_options = get_session('payment_options');
			$premium_details = get_session('premium_details');
			
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			/*$form_forester_id = OVER50_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
			$form_forester_id = generate_app_unique_id(FFS_PREFIX);
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
			
			if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1){
				$payment_data = array('order_id'=>$new_constant_value, 'customer_id' => $form_forester_id, 'create_date_time' => $create_date_time, 'personal_details'=> $personal_details, 'payment_details'=> $payment_options);
				$this->session->set_userdata("payment_data", $payment_data);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'payment' => true)));
			}else{
			
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
				
				
				$customer_xml .= '<Title>'.$title.'</Title>
				
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
									<MembershipType>Over 50s Life Cover</MembershipType>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>
									';
									
							
				$customer_pdf .= 	'<h1>OVER50</h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y").'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Top Up ID: '. @$personal_details['toptup_policy_number'] .'<br>
									Tracking: <br><br>
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
									Membership Type: OVER50<br>
									How did you hear about us: '.$personal_details['HeardAboutUs'].'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';
										
			}
			
			if(!empty($premium_details))
			{
				$customer_xml .= '<MonthlyPremium>£'.@number_format(str_replace(",","",$premium_details['pay_premium']),'0','.',',').'</MonthlyPremium>';
				$customer_pdf .= 	'<h1>Monthly Premium</h1>Amount: &pound;'.@number_format(str_replace(",","",$premium_details['pay_premium']),'0','.',',').'<br>';
			}
			
			if(!empty($beneficiary_details))
				{
						
						$nominate_benificiary = ($beneficiary_details['nominate_benificiary']==1)?"Yes":"No";
						
						$beneficiary_title = ($beneficiary_details['beneficiary_title']=="Other")?$beneficiary_details['beneficiary_other_title']:$beneficiary_details['beneficiary_title'];
						$beneficiary_dob = date("d F Y", strtotime($beneficiary_details['bdob_day'].'-'.$beneficiary_details['bdob_month'].'-'.$beneficiary_details['bdob_year']));
				
						
						$customer_xml .= '<BeneficiaryNominated>'.$nominate_benificiary.'</BeneficiaryNominated>
											<Title>'.$beneficiary_title.'</Title>
											<Forename>'.$beneficiary_details['first_name'].'</Forename>
											<Surname>'.$beneficiary_details['last_name'].'</Surname>
											<DOB>'.$beneficiary_dob.'</DOB>
											<BeneficiaryAmount>£'.$beneficiary_details['beneficiary_amount'].'</BeneficiaryAmount>';
						if(isset($beneficiary_details['beneficiary_hidden_postcode']) && $beneficiary_details['beneficiary_hidden_postcode']!=""){					
						$customer_xml .= '<AddressLine1>'.$beneficiary_details['beneficiary_hidden_address1'].'</AddressLine1>
											<AddressLine2>'.$beneficiary_details['beneficiary_hidden_address2'].'</AddressLine2>
											<Town>'.$beneficiary_details['beneficiary_hidden_town_city'].'</Town>
											<County>'.$beneficiary_details['beneficiary_hidden_county'].'</County>
											<Postcode>'.$beneficiary_details['beneficiary_hidden_postcode'].'</Postcode>
											<Postcode>'.$beneficiary_details['beneficiary_hidden_postcode'].'</Postcode>';
						}else
						{
							$customer_xml .= '<AddressLine1>'.$beneficiary_details['address1'].'</AddressLine1>
												<AddressLine2>'.$beneficiary_details['address2'].'</AddressLine2>
												<Town>'.$beneficiary_details['town'].'</Town>
												<County>'.$beneficiary_details['county'].'</County>
												<Postcode>'.$beneficiary_details['postcode_box'].'</Postcode>';
						}	
						
								
							$customer_pdf .= 	'<h1>Beneficiary Details</h1><br>
												Beneficiary Nominated: '. $nominate_benificiary;
							
						if($beneficiary_details['nominate_benificiary']==1)	{	
							$customer_pdf .= 	'<br>Title: '.$beneficiary_title.'<br>
													Forename: '.$beneficiary_details['first_name'].'<br>
													Surname:'.$beneficiary_details['last_name'].'<br>
													Date of Birth: '.$beneficiary_dob.'<br>
													Beneficiary Amount: &pound;'.$beneficiary_details['beneficiary_amount'].'<br>';
							if(isset($beneficiary_details['beneficiary_hidden_postcode']) && $beneficiary_details['beneficiary_hidden_postcode']!=""){	
							$customer_pdf .= 	'Address Line 1: '.$beneficiary_details['beneficiary_hidden_address1'].'<br>
												Address Line 2: '.$beneficiary_details['beneficiary_hidden_address2'].'<br>
												Town: '.$beneficiary_details['beneficiary_hidden_town_city'].'<br>
												County: '.$beneficiary_details['beneficiary_hidden_county'].'<br>
												Postcode:'.$beneficiary_details['beneficiary_hidden_postcode'].'<br>';	
							}else{
							$customer_pdf .= 	'Address Line 1: '.$beneficiary_details['address1'].'<br>
													Address Line 2: '.$beneficiary_details['address2'].'<br>
													Town: '.$beneficiary_details['town'].'<br>
													County: '.$beneficiary_details['county'].'<br>
													Postcode:'.$beneficiary_details['postcode_box'].'<br>';
							}
						
						}									
					}
					
			
			
			if(!empty($payment_options))
			{
				$customer_pdf .= '<h1>Data Protection</h1>
											Receive post from us: Opt out<br>
											Receive email from us: Opt out<br>
											Receive SMS from us: Opt out<br>
											Receive phone from us: Opt out<br>';
				
				if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1)
				{

					if(isset($payment_options['accept_account_holder_terms']) && @$payment_options['accept_account_holder_terms'] == 1)
						$thirdPartyPayer = "True";
					else
						$thirdPartyPayer = "False";
					
					$customer_xml .= '<ContributionType>Monthly</ContributionType>
				
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										
										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
										
										<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
										
										<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
										
										<ThirdPartyPayer>'.$thirdPartyPayer.'</ThirdPartyPayer>
										
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										
										<IsAccountValid>True</IsAccountValid>';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Direct Debit: True<br>
										Account Holder Name: '.$payment_options['monthly_account_holder_name'].'<br>
										Account Number: '.$payment_options['monthly_account_number'].'<br>
										Sort Code: '.$payment_options['monthly_account_sort_code'].'<br>
										Third party payer: '.$thirdPartyPayer.'<br>
										Is Account Valid: True<br>';						
				}
				
				if(isset($payment_options['accept_account_holder_terms']) && $payment_options['accept_account_holder_terms'] == 1)
				{
						
						$third_party_title = ($payment_options['third_party_title']=="Other")?$payment_options['third_party_other_title']:$payment_options['third_party_title'];
						$customer_xml .= '<ThirdPartyPayerTitle>'. $third_party_title .'</ThirdPartyPayerTitle>
											<ThirdPartyPayerForename>'. $payment_options['third_party_first_name'] .'</ThirdPartyPayerForename>
											<ThirdPartyPayerSurname>'. $payment_options['third_party_last_name'] .'</ThirdPartyPayerSurname>
											<ThirdPartyPayerPhone>'. $payment_options['third_party_phone'] .'</ThirdPartyPayerPhone>
											<ThirdPartyPayerEmail>'. $payment_options['third_party_email'] .'</ThirdPartyPayerEmail>';
											
						$customer_pdf .= '<h1>Third Party Payer Details</h1>
											Title: '.$third_party_title.'<br>
											Forename: '.$payment_options['third_party_first_name'].'<br>
											Surname: '.$payment_options['third_party_last_name'].'<br>
											Phone: '.$payment_options['third_party_phone'].'<br>
											Email: '.$payment_options['third_party_email'].'<br>';					
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
			
			
			$customer_xml .= '</Form>';
			$filename_xml = OVER50_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
			$filename_pdf = OVER50_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'OVER50', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'Lisa Customer PDF', $filename_pdf);
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('over50/download/'.$filename_pdf);
				$body['admin_body_content'] = OVER50_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your Over 50s Life Cover application has been submitted", false, "over50_customer_confirmation");
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (Over 50s)");
				$this->session->sess_destroy();
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'payment'=>false, 'data' => $data)));
			}
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
	
}
