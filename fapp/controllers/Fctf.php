<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fctf extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/fctf.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		//$this->fapp->addJS(base_url('/assets/plugins/jquery-validate-tooltip.js'),false);
		$this->fapp->addJS(base_url("/assets/js/custom/fctf.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index()	{
		$data = array();
		$this->session->sess_destroy();
		$data['progressbar'] = fctf_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['child_details'] = child_details();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('fctf', 'fctf_form_step', $data);
	}
	
	public function select_policy_type()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data_type = get_post('data_type');
			$child_trust_fund_number = get_post('child_trust_fund_number');
			$data['progressbar'] = fctf_steps_pregressbar($step + 1);
			$all_fields_post_value = $this->security->xss_clean(get_post());
			$this->session->set_userdata($data_type, $child_trust_fund_number);
			$this->session->userdata('child_trust_fund_number', $child_trust_fund_number);
			$data['child_trust_fund_number'] = $child_trust_fund_number;
			$data['view_policy_summary'] = $this->load->view('fctf/view_policy_summary', $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	public function fctf_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			$data_type = get_post('data_type');
			
			$this->session->set_userdata('process', true);	
			
			if(get_session('valid_child_dob')== true && $data_type=="personal_details"){
				$skip_child_section_step = 2;
				$data['skip_child_section_step']=2;
			}else{
				$skip_child_section_step = 1;
				$data['skip_child_section_step']=1;
			}					
			$step = get_post('step') + $skip_child_section_step;
			$all_fields_post_value = $this->security->xss_clean(get_post());
			
			if(!empty($all_fields_post_value))
			{
				$data['progressbar'] = fctf_steps_pregressbar($step);
				unset($all_fields_post_value['data_type']);
				
				$personal_details_blank = personal_details();
				$child_details_blank = child_details();
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
					
					if(isset(get_session('personal_details')['toptup_policy_number']))
						$this->session->set_userdata('set_topup', true);
					else
						$this->session->set_userdata('set_topup', false);
					
					$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
					$data['personal_details_view'] = $this->load->view('fctf/summary_personal_details', $data, true);
					
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
						
					$data['view_payment_opt'] = $this->load->view('fctf/view_payment_options', $data, true);
					
					
					if(!empty($this->session->userdata('child_details')))
						$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					else
						$data['child_details'] = $child_details_blank;		
					$data['view_child_opt'] = $this->load->view('fctf/view_child_details', $data, true);
				}
				
				$data['view_summary_child_details'] = false;
				if(!empty($this->session->userdata('child_details'))){
					$data['view_summary_child_details'] = true;
					$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					$data['child_details_view'] = $this->load->view('fctf/summary_child_details', $data, true);
					
					
				}
				
				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('fctf/summary_payment_options', $data, true);
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
			
			if(get_session('valid_child_dob')== true){
				$skip_child_section_step = 2;
				$data['skip_child_section_step']=2;
			}else{
				$skip_child_section_step = 1;
				$data['skip_child_section_step']=1;
			}
			
			$data['progressbar'] = fctf_steps_pregressbar($step);
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
			$child = get_post('child');
			$get_dob_days = get_age_diff("$days/$months/$years");
			$date_now = new DateTime();
			$selected_date    = new DateTime("$months/$days/$years");

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
			
		}else{
			show_404();
		}
	}
	
	public function edit_summary()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = fctf_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	
	public function edit_child()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$data['month'] = list_month();
			$view = $this->load->view('fctf/edit_list_' . $page, $data, true);
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
			$view = $this->load->view('fctf/edit_list_' . $page, $data, true);
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
				$child_details_blank = child_details();
				$payment_options_blank = payment_options();
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				if($data_type == "personal_details"){
						$data['view_summary_personal_details'] = true;
						$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
						$data['personal_details_view'] = $this->load->view('fctf/summary_personal_details', $data, true);
				}
				
				if(!empty($this->session->userdata('child_details'))){
					$data['view_summary_child_details'] = true;
					$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					$data['child_details_view'] = $this->load->view('fctf/summary_child_details', $data, true);
					
					
				}
				
				if($data_type == "payment_options"){
						$data['view_summary_payment_options'] = true;
						$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
						$data['payment_options_view'] = $this->load->view('fctf/summary_payment_options', $data, true);
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
			$data['progressbar'] = fctf_steps_pregressbar(6);
			$policy_details = get_session('policy_details');
			$personal_details = get_session('personal_details');
			$child_details = get_session('child_details');
			$payment_options = get_session('payment_options');
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			/*$form_forester_id = FCTF_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
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
				
				$customer_xml .= '<ChildTrustFundNumber>'.$policy_details.'</ChildTrustFundNumber>
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
									<MembershipType>FCTF</MembershipType>
									<ParentRelationToChild>'.$personal_details['personal_details_relation_to_child'].'</ParentRelationToChild>
									<ParentRelationToChildOther>'.$personal_details['personal_details_relation_other'].'</ParentRelationToChildOther>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>';
									
							
				$customer_pdf .= 	'<h1>FCTF</h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y", strtotime($create_date_time)).'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Tracking: <br><br>
									<h1>Child Trust Fund Number: '.$policy_details.'</h1>
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
									Relation to Child: '.$personal_details['personal_details_relation_to_child'].'<br>
									Relation to Child (if Other): '.$personal_details['personal_details_relation_other'].'<br>
									Have you changed address in the last 3 months? '.$old_address_change.'<br>
									Membership Type: FCTF<br>
									How did you hear about us: '.$personal_details['HeardAboutUs'].'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';
						
						if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){
								$customer_xml .= '<TopUp>Yes</TopUp>
													<ExistingFCTFPolicyNumber>'.$personal_details['toptup_policy_number'].'</ExistingFCTFPolicyNumber>';
							}					
			}
			
			if(!empty($child_details))
				{
						$child_dob = $child_details['cdob_day'] . "/" . $child_details['cdob_month'] . "/" . $child_details['cdob_year'];
						
						$customer_xml .= '<Title>'.$child_details['title'].'</Title>
											<Forename>'.$child_details['first_name'].'</Forename>
											<Surname>'.$child_details['last_name'].'</Surname>
											<DOB>'.$child_dob.'</DOB>';
						if(isset($child_details['same_address_child']) && $child_details['same_address_child'] == 1){					
						$customer_xml .= '<AddressLine1>'.$child_details['child_hidden_address1'].'</AddressLine1>
											<AddressLine2>'.$child_details['child_hidden_address2'].'</AddressLine2>
											<Town>'.$child_details['child_hidden_town_city'].'</Town>
											<County>'.$child_details['child_hidden_county'].'</County>
											<Postcode>'.$child_details['child_hidden_postcode'].'</Postcode>';
						}else
						{
							$customer_xml .= '<AddressLine1>'.$child_details['address1'].'</AddressLine1>
												<AddressLine2>'.$child_details['address2'].'</AddressLine2>
												<Town>'.$child_details['town'].'</Town>
												<County>'.$child_details['county'].'</County>
												<Postcode>'.$child_details['postcode_box'].'</Postcode>';
						}					
						$customer_pdf .= 	'<h1>Child Details</h1>Title: '.$child_details['title'].'<br>
												Forename: '.$child_details['first_name'].'<br>
												Surname:'.$child_details['last_name'].'<br>
												Date of Birth: '.$child_dob.'<br>';
						if(isset($child_details['same_address_child']) && $child_details['same_address_child'] == 1){	
						$customer_pdf .= 	'Address Line 1: '.$child_details['child_hidden_address1'].'<br>
											Address Line 2: '.$child_details['child_hidden_address2'].'<br>
											Town: '.$child_details['child_hidden_town_city'].'<br>
											County: '.$child_details['child_hidden_county'].'<br>
											Postcode:'.$child_details['child_hidden_postcode'].'<br>';	
						}else{
						$customer_pdf .= 	'Address Line 1: '.$child_details['address1'].'<br>
												Address Line 2: '.$child_details['address2'].'<br>
												Town: '.$child_details['town'].'<br>
												County: '.$child_details['county'].'<br>
												Postcode:'.$child_details['postcode_box'].'<br>';
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

					$customer_xml .= '<ContributionType>Monthly</ContributionType>
				
										<MonthlyContributionAmount>£'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'</MonthlyContributionAmount>
										
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										
										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
										
										<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
										
										<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
										
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										
										<IsAccountValid>True</IsAccountValid>';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
											Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Direct Debit: True<br>
										Account Holder Name: '.$payment_options['monthly_account_holder_name'].'<br>
										Account Number: '.$payment_options['monthly_account_number'].'<br>
										Sort Code: '.$payment_options['monthly_account_sort_code'].'<br>
										Is Account Valid: True<br>';						
				}
				if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1)
				{				
						$customer_xml .= '<LumpSumAmountByDebitCard>£'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'</LumpSumAmountByDebitCard>';
						$customer_pdf .= '<h1>Lump Sum Investment</h1>Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'<br>';
										
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
			$filename_xml = FCTF_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
			$filename_pdf = FCTF_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'FCTF', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'Child Trust Fund Customer PDF', $filename_pdf, '');
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('fctf/download/'.$filename_pdf);
				$body['admin_body_content'] = FCTF_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your Child Trust Fund Top up application has been submitted", false, "fctf_customer_confirmation");
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (Child Trust Fund Top up)");
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
	
	public function submit_worldPay(){
		$payment_data = get_session('payment_data');
		submit_worldPayGlobal($payment_data, "Child Trust Fund Top up(Lump Sum Investment)", "FCTFLUMPSUM", "Child Trust Fund Top up", WORLD_PAY_FCTF_REFER_URL);
	}
	
	public function confirmation()
	{
		
			if((isset($_GET['transStatus']) &&  $_GET['transStatus'] =="Y") && get_session('process')==true){
			$payment_data = get_session('payment_data');
			$new_constant_value = $payment_data['order_id'];
			$create_date_time = $payment_data['create_date_time'];
			$policy_details = get_session('policy_details');
			$personal_details = get_session('personal_details');
			$child_details = get_session('child_details');
			$payment_options = get_session('payment_options');
			$form_forester_id = $_GET['cartId'];
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
				
				$customer_xml .= '<ChildTrustFundNumber>'.$policy_details.'</ChildTrustFundNumber>
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
									<MembershipType>FCTF</MembershipType>
									<ParentRelationToChild>'.$personal_details['personal_details_relation_to_child'].'</ParentRelationToChild>
									<ParentRelationToChildOther>'.$personal_details['personal_details_relation_other'].'</ParentRelationToChildOther>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>';
									
							
				$customer_pdf .= 	'<h1>FCTF</h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y", strtotime($create_date_time)).'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Tracking: '.$_GET[0].'<br><br>
									<h1>Child Trust Fund Number: '.$policy_details.'</h1>
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
									Membership Type: FCTF<br>
									Relation to Child: '.$personal_details['personal_details_relation_to_child'].'<br>
									Relation to Child (if Other): '.$personal_details['personal_details_relation_other'].'<br>
									How did you hear about us: '.$personal_details['HeardAboutUs'].'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';
						
						if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){
								$customer_xml .= '<TopUp>Yes</TopUp>
													<ExistingFCTFPolicyNumber>'.$personal_details['toptup_policy_number'].'</ExistingFCTFPolicyNumber>';
							}					
			}
			
			if(!empty($child_details))
				{
						$child_dob = $child_details['cdob_day'] . "/" . $child_details['cdob_month'] . "/" . $child_details['cdob_year'];
					//	$child_ni_number = $child_details['NI1'] . " " . $child_details['NI2'] . " " . $child_details['NI3'] . " " . $child_details['NI4'] . " " . $child_details['NI5'];
						
						$customer_xml .= '<Title>'.$child_details['title'].'</Title>
											<Forename>'.$child_details['first_name'].'</Forename>
											<Surname>'.$child_details['last_name'].'</Surname>
											<DOB>'.$child_dob.'</DOB>';
						if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode']!=""){					
						$customer_xml .= '<AddressLine1>'.$child_details['child_hidden_address1'].'</AddressLine1>
											<AddressLine2>'.$child_details['child_hidden_address2'].'</AddressLine2>
											<Town>'.$child_details['child_hidden_town_city'].'</Town>
											<County>'.$child_details['child_hidden_county'].'</County>
											<Postcode>'.$child_details['child_hidden_postcode'].'</Postcode>';
						}else
						{
							$customer_xml .= '<AddressLine1>'.$child_details['address1'].'</AddressLine1>
												<AddressLine2>'.$child_details['address2'].'</AddressLine2>
												<Town>'.$child_details['town'].'</Town>
												<County>'.$child_details['county'].'</County>
												<Postcode>'.$child_details['postcode_box'].'</Postcode>';
						}					
						$customer_pdf .= 	'<h1>Child Details</h1>Title: '.$child_details['title'].'<br>
												Forename: '.$child_details['first_name'].'<br>
												Surname:'.$child_details['last_name'].'<br>
												Date of Birth: '.$child_dob.'<br>';
						if(isset($child_details['child_hidden_postcode']) && $child_details['child_hidden_postcode']!=""){	
						$customer_pdf .= 	'Address Line 1: '.$child_details['child_hidden_address1'].'<br>
											Address Line 2: '.$child_details['child_hidden_address2'].'<br>
											Town: '.$child_details['child_hidden_town_city'].'<br>
											County: '.$child_details['child_hidden_county'].'<br>
											Postcode:'.$child_details['child_hidden_postcode'].'<br>';	
						}else{
						$customer_pdf .= 	'Address Line 1: '.$child_details['address1'].'<br>
												Address Line 2: '.$child_details['address2'].'<br>
												Town: '.$child_details['town'].'<br>
												County: '.$child_details['county'].'<br>
												Postcode:'.$child_details['postcode_box'].'<br>';
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

					$customer_xml .= '<ContributionType>Monthly</ContributionType>
				
										<MonthlyContributionAmount>£'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'</MonthlyContributionAmount>
										
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										
										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
										
										<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
										
										<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
										
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										
										<IsAccountValid>True</IsAccountValid>';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
											Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Direct Debit: True<br>
										Account Holder Name: '.$payment_options['monthly_account_holder_name'].'<br>
										Account Number: '.$payment_options['monthly_account_number'].'<br>
										Sort Code: '.$payment_options['monthly_account_sort_code'].'<br>
										Is Account Valid: True<br>';						
				}
				if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1)
				{				
						$customer_xml .= '<LumpSumAmountByDebitCard>£'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'</LumpSumAmountByDebitCard>';
						$customer_pdf .= '<h1>Lump Sum Investment</h1>Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'<br>';
										
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
				if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1)
				{				
						$customer_pdf .= '<h1>Worldpay Online Payment</h1>
											Authorisation Date: '.$create_date_time.'<br>
											Reference Number: '.$_GET[0].' <br>
											Transaction Status: Payment Successful<br>
											<h1>Tracking</h1>Tracking: <br>';				
				}
			}
				
				
				$customer_xml .= '</Form>';
				$filename_xml = FCTF_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
				$filename_pdf = FCTF_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
				
				$xml_file_path = generate_xml($customer_xml, 'FCTF', $filename_xml);
				$pdf_file_path = generate_pdf($customer_pdf, 'Child Trust Fund Top up Customer PDF', $filename_pdf, '');
				
					
					$body = array();
					$body['customer_name'] = $customer_name;
					$body['application_number'] = $form_forester_id;
					$body['payment_reference_number'] = $_GET[0];
					$body['pdf_link'] = base_url('fctf/download/'.$filename_pdf);
					$body['admin_body_content'] = FCTF_ADMIN_EMAIL_BODY_CONTENT;
					
					sendEmailtoCustomer($personal_details['email'], $body, "Your Child Trust Fund Top up application has been submitted", false, "fctf_customer_confirmation");
				
					sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (Child Trust Fund Top up)");
					
					$data = array();
					$data['cutomer_ref_number'] = $form_forester_id;
					$data['type'] = "";
					$data['progressbar'] = fctf_steps_pregressbar(5);
					$this->session->sess_destroy();
					$this->fapp->show('fctf', 'fctf_form_confirmation', $data);
					
			}else{
			redirect(base_url('fctf'));
			exit;
			}				
	}
}
