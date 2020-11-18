<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Membership extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/membership.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		//$this->fapp->addJS(base_url('/assets/plugins/jquery-validate-tooltip.js'),false);
		$this->fapp->addJS(base_url("/assets/js/custom/membership.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index($type="one")	{
		$data = array();
		$this->session->sess_destroy();
		$data['type'] = $type;
		$data['progressbar'] = membership_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['list_maturity_month'] = list_maturity_month();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('membership', 'membership_form_step', $data);
	}
	
	public function membership_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data_type = get_post('data_type');
			$step = get_post('step') + 1;
			$all_fields_post_value = $this->security->xss_clean(get_post());
			$data['list_title'] = list_title();
			
			if(!empty($all_fields_post_value))
			{
				$data['progressbar'] = membership_steps_pregressbar($step);
				unset($all_fields_post_value['data_type']);
				
				$personal_details_blank = personal_details();
				$payment_options_blank = payment_options();
				$membership_details_blank = membership_details();
				
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				$data['valid_dob'] = false;
				
				
				$data['view_summary_personal_details'] = false;
				if(!empty($this->session->userdata('personal_details'))){
					$data['view_summary_personal_details'] = true;
					$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
					$data['personal_details_view'] = $this->load->view('membership/summary_personal_details', $data, true);
					
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
					
					$data['view_payment_opt'] = $this->load->view('membership/view_payment_options', $data, true);
				}
				
				
				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('membership/summary_payment_options', $data, true);
				}
				
				$data['view_summary_membership_details'] = false;
				if(!empty($this->session->userdata('membership_details'))){
					$data['view_summary_membership_details'] = true;
					$data['membership_details'] = array_merge($membership_details_blank, $this->session->userdata('membership_details'));
					$data['membership_details_view'] = $this->load->view('membership/summary_membership_details', $data, true);
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
			$data['progressbar'] = membership_steps_pregressbar($step);
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
			$date_now = new DateTime();
			$selected_date    = new DateTime("$months/$days/$years");
			
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
	
	public function check_maturity_date()
	{
		if($this->input->is_ajax_request()){
			$data = array();
			$days = get_post('days');
			$months = get_post('months');
			$years = get_post('years');
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
			$data['list_title'] = list_title();
			$data['progressbar'] = membership_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
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
				$payment_options_blank = payment_options();
				$membership_details_blank = membership_details();
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				if($data_type == "personal_details"){
						$data['view_summary_personal_details'] = true;
						$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
						$data['personal_details_view'] = $this->load->view('membership/summary_personal_details', $data, true);
				}
				if($data_type == "payment_options"){
						$data['view_summary_payment_options'] = true;
						$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
						$data['payment_options_view'] = $this->load->view('membership/summary_payment_options', $data, true);
				}
				$data['view_summary_membership_details'] = false;
				if(!empty($this->session->userdata('membership_details'))){
					$data['view_summary_membership_details'] = true;
					$data['membership_details'] = array_merge($membership_details_blank, $this->session->userdata('membership_details'));
					$data['membership_details_view'] = $this->load->view('membership/summary_membership_details', $data, true);
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
	
	public function edit_payment()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$view = $this->load->view('membership/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	public function edit_membership()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$data['month'] = list_month();
			$data['list_maturity_month'] = list_maturity_month();
			$view = $this->load->view('membership/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			
			$data['progressbar'] = membership_steps_pregressbar($step);
			$personal_details = get_session('personal_details');
			$membership_details = get_session('membership_details');
			$payment_options = get_session('payment_options');
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			/*$form_forester_id = MEMBERSHIP_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
			$form_forester_id = generate_app_unique_id(FFS_PREFIX);
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
		
			
			$customer_xml = '<Form id="'.$new_constant_value.'" createdate="'.$create_date_time.'" forestersid="'. $form_forester_id .'">
									<returnState>0</returnState>
									<ID>'. $new_constant_value .'</ID>';
			if(!empty($personal_details))
			{
				$dob = date("d F Y", strtotime($personal_details['dob_day'].'-'.$personal_details['dob_month'].'-'.$personal_details['dob_year']));
				
				$old_address_change = (isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == 1)?"Yes":"No";
				
				$title = ($personal_details['title']=="Other")?$personal_details['other_title']:$personal_details['title'];
				$customer_name = trim($title).' ' .trim($personal_details['first_name']).' ' .trim($personal_details['last_name']);
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
									<BranchAllocation>'.$personal_details['branch_allocated'].'</BranchAllocation>
									<AddressChange>Have you changed address in the last 3 months?</AddressChange>
									<AddressChangeValue>'.$old_address_change.'</AddressChangeValue>
									<PrevAddressLine1>'.$personal_details['additional_address1'].'</PrevAddressLine1>
									<PrevAddressLine2>'.$personal_details['additional_address2'].'</PrevAddressLine2>
									<PrevTown>'.$personal_details['additional_town_city'].'</PrevTown>
									<PrevCounty>'.$personal_details['additional_county'].'</PrevCounty>
									<PrevPostcode>'.$personal_details['additional_postcode_box'].'</PrevPostcode>
									<MembershipType>MEMBERSHIP</MembershipType>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>
									<HearAboutIntroducer>'.$personal_details['HeardAboutUs_extra'].'</HearAboutIntroducer>
									<PromotionalCode>'.$personal_details['offer_code'].'</PromotionalCode>';
									
				$customer_pdf .= 	'<h1>MEMBERSHIP</h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y").'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
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
									Branch allocation: '. $personal_details['branch_allocated'].'<br>
									Have you changed address in the last 3 months? '.$old_address_change.'<br>
									How did you hear about us: '.get_marketing_source_code($personal_details['HeardAboutUs'], $personal_details['HeardAboutUs_extra']).'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';				
			}
			
			if(!empty($membership_details))
			{
				$customer_pdf .= '<h1>Membership fee</h1>';
				if(isset($membership_details['accept_membership_fee']) && $membership_details['accept_membership_fee'] == 1)
				{

					$customer_xml .= '<MembershipFee>£'. MEMBERSHIP_TERMS_FEE .'</MembershipFee>';
					$customer_pdf .= 'Membership fee: &pound;'. MEMBERSHIP_TERMS_FEE .'<br>';
				}
				
			
			}							
			
			if(!empty($payment_options))
			{
				if(isset($payment_options['choose_payment_option_annual']) && $payment_options['choose_payment_option_annual'] == 1)
				{

					if(isset($payment_options['accept_account_holder_terms']) && @$payment_options['accept_account_holder_terms'] == 1)
						$thirdPartyPayer = "True";
					else
						$thirdPartyPayer = "False";
						
					$customer_xml .= '<ContributionType>Annually</ContributionType>
				
										<AnnuallyContributionAmount>£'.@number_format(str_replace(",","",$payment_options['annual_innvest_amount']),'0','',',').'</AnnuallyContributionAmount>
										
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										
										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$payment_options['annual_account_holder_name'].'</AccountName>
										
										<AccountNumber>'.$payment_options['annual_account_number'].'</AccountNumber>
										
										<SortCode>'.$payment_options['annual_account_sort_code'].'</SortCode>
										
										<ThirdPartyPayer>'.$thirdPartyPayer.'</ThirdPartyPayer>
										
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										
										<IsAccountValid>True</IsAccountValid>';
										
					$customer_pdf .= '<h1>Annually Direct Debit</h1>
										Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['annual_innvest_amount']),'2','.',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Account Holder Name: '.$payment_options['annual_account_holder_name'].'<br>
										Account Number: '.$payment_options['annual_account_number'].'<br>
										Sort Code: '.$payment_options['annual_account_sort_code'].'<br>
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
			$filename_xml = MEMBERSHIP_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
			$filename_pdf = MEMBERSHIP_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'MEMBERSHIP', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'Tax Exempt Savings Plan Customer PDF', $filename_pdf, $pdf_password);
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('membership/download/'.$filename_pdf);
				$body['admin_body_content'] = MEMBERSHIP_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your Foresters Friendly Society Membership application has been submitted", false, "membership_customer_confirmation");
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (Membership)");
				
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
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
