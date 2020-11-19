<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lisa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/lisa.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		//$this->fapp->addJS(base_url("/assets/js/afd.jquery.1.9.2.min.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/lisa.js"),false);
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
			
		$data['progressbar'] = lisa_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('lisa', 'lisa_form_step', $data);
	}
	
	public function lisa_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data_type = get_post('data_type');
			$step = get_post('step') + 1;
			
			$data['type'] = get_session('set_topup');
			
			
			$all_fields_post_value = $this->security->xss_clean(get_post());
			
			$this->session->set_userdata('process', true);	
			
			if(!empty($all_fields_post_value))
			{
				$data['progressbar'] = lisa_steps_pregressbar($step);
				unset($all_fields_post_value['data_type']);
				
				$personal_details_blank = personal_details();
				$payment_options_blank = payment_options();
				
				//echo "<pre>";
				//print_r($payment_options_blank);
				
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
				
				$data['view_summary_personal_details'] = false;
				if(!empty($this->session->userdata('personal_details'))){
					
					if(isset(get_session('personal_details')['toptup_policy_number']))
						$this->session->set_userdata('set_topup', true);
					else
						$this->session->set_userdata('set_topup', false);
					
					$data['view_summary_personal_details'] = true;
					$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
					$data['personal_details_view'] = $this->load->view('lisa/summary_personal_details', $data, true);
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
						
					$data['view_payment_opt'] = $this->load->view('lisa/add_list_payment_options', $data, true);
				}
				
				
				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('lisa/summary_payment_options', $data, true);
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
			$data['progressbar'] = lisa_steps_pregressbar($step);
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
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => MAX_DOB_WARNING_MESSAGE_LISA)));
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
			$data['progressbar'] = lisa_steps_pregressbar(1);
			/*$data['type'] = "topup";
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			
			$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
			$view = $this->load->view('lisa/edit_list_' . $page, $data, true);*/
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
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				if($data_type == "personal_details"){
						$data['view_summary_personal_details'] = true;
						$data['personal_details'] = @array_merge($personal_details_blank, $all_fields_post_value);
						$data['personal_details_view'] = $this->load->view('lisa/summary_personal_details', $data, true);
				}
				if($data_type == "payment_options"){
						$data['view_summary_payment_options'] = true;
						$data['payment_options'] = array_merge($payment_options_blank, $all_fields_post_value);
						$data['payment_options_view'] = $this->load->view('lisa/summary_payment_options', $data, true);
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
			$data['progressbar'] = lisa_steps_pregressbar(2);
			$view = $this->load->view('lisa/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
		}else{
			show_404();
		}	
	}
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$data['progressbar'] = lisa_steps_pregressbar($step);
			$personal_details = get_session('personal_details');
			$payment_options = get_session('payment_options');
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			
			/*$form_forester_id = LISA_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
			$form_forester_id = generate_app_unique_id(FFS_PREFIX);
			$data['customer_app_id'] = $form_forester_id;
			$create_date_time = date("d/m/Y h:i:s");
			$customer_pdf = "";
			
			$customer_xml_dd = "";
			$customer_xml_lumpsum = "";
			$customer_xml_transfer = "";
			
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
				$dob = date("d/m/Y 00:00:00", strtotime($personal_details['dob_day'].'-'.$personal_details['dob_month'].'-'.$personal_details['dob_year']));
				$national_insurance_number = "";
				$ni_number ='';
				if(get_session('set_topup') == false){
				$ni_number = $personal_details['NI1'] . "" . $personal_details['NI2'] . "" . $personal_details['NI3'] . "" . $personal_details['NI4'] . "" . $personal_details['NI5'];
				$national_insurance_number = 'National Insurance Number: '.strtoupper($ni_number).'<br>';
				}
				$old_address_change = (isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == 1)?"Yes":"No";
				$title = ($personal_details['title']=="Other")?$personal_details['other_title']:$personal_details['title'];
				$customer_name = $title.' ' .$personal_details['first_name'].' ' .$personal_details['last_name'];
				$pdf_password = strtoupper($personal_details['last_name']) . $personal_details['dob_year'];
				
				$customer_xml .= '	
									<Title>'.$title.'</Title>
									<Forename>'.$personal_details['first_name'].'</Forename>
									<Surname>'.$personal_details['last_name'].'</Surname>
									<DOB>'.$dob.'</DOB>
									<NationalInsuranceNumber>'.strtoupper($ni_number).'</NationalInsuranceNumber>
									<AddressLine1>'.$personal_details['address1'].'</AddressLine1>
									<AddressLine2>'.$personal_details['address2'].'</AddressLine2>
									<Town>'.$personal_details['town'].'</Town>
									<County>'.$personal_details['county'].'</County>
									<Country>GB</Country>
									<Postcode>'.$personal_details['postcode_box'].'</Postcode>
									<PhoneDay>'.$personal_details['phone'].'</PhoneDay>
									<Email>'.$personal_details['email'].'</Email>
									<PrevAddressLine1>'.$personal_details['additional_address1'].'</PrevAddressLine1>
									<PrevAddressLine2>'.$personal_details['additional_address2'].'</PrevAddressLine2>
									<PrevTown>'.$personal_details['additional_town_city'].'</PrevTown>
									<PrevCounty>'.$personal_details['additional_county'].'</PrevCounty>
									<PrevPostcode>'.$personal_details['additional_postcode_box'].'</PrevPostcode>
									<MembershipType>LISA</MembershipType>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>';
									
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_xml .= '<HearAboutIntroducer>'.$personal_details['HeardAboutUs_extra'].'</HearAboutIntroducer>';
								elseif($personal_details['HeardAboutUs']=="Other")	
				$customer_xml .= ' <HearAboutOther>'.$personal_details['HeardAboutUs_extra'].'</HearAboutOther>
									<CheckedAntiMoneyLaundering>True</CheckedAntiMoneyLaundering>
      								<CheckedDeclaration>True</CheckedDeclaration>';
									
									
									$customer_xml .= '
									<PromotionalCode>'.$personal_details['offer_code'].'</PromotionalCode>
									';
									
				$customer_pdf .= 	'<h1>LISA </h1>
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
									'.$national_insurance_number.'
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
						
				if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){
								$customer_xml .= '<TopUp>Yes</TopUp>
													<ExistingLISAPolicyNumber>'.$personal_details['toptup_policy_number'].'</ExistingLISAPolicyNumber>';
								//$customer_pdf .= 'Existing LISA Policy Number: '.$personal_details['toptup_policy_number'].'<br>';
								}					
			}
			
			if(!empty($payment_options))
			{
				if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1)
				{

				$customer_xml_dd .= '<ContributionType>Monthly</ContributionType>
									<MonthlyContributionAmount>'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'</MonthlyContributionAmount>
									<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
									<DirectDebit>True</DirectDebit>
									<JointAccount>False</JointAccount>
									<BothSign>False</BothSign>
									<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
									<BranchID>0</BranchID>
									<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
									<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
									<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
									<IsAccountValid>True</IsAccountValid>
									';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
										Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Account Holder Name: '.$payment_options['monthly_account_holder_name'].'<br>
										Account Number: '.$payment_options['monthly_account_number'].'<br>
										Sort Code: '.$payment_options['monthly_account_sort_code'].'<br>
										Is Account Valid: True<br>';						
				}
				if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1)
				{				
				$customer_xml_lumpsum .= '<ContributionType>LumpSum</ContributionType>
									<LumpSumContributionAmount>'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'</LumpSumContributionAmount>
									<WorldPayPaymentAuthorisationDate></WorldPayPaymentAuthorisationDate>
									<WorldPayPaymentReferenceNumber></WorldPayPaymentReferenceNumber>
									<WorldPayPaymentTransactionStatus>Y</WorldPayPaymentTransactionStatus>
									<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
									';
						$customer_pdf .= '<h1>Lump Sum Investment</h1>Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'<br>';
										
				}
				if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1)
				{
				$customer_xml_transfer .= '<TransferPaymentOption>Transfer in from another ISA provider</TransferPaymentOption>
									<TransferPaymentOptionSelected>Yes</TransferPaymentOptionSelected>';
											
						$customer_pdf .= '<h1>Transfer another ISA</h1>Transfer in from another ISA provider: Yes <br>';					
				}	
				
								
					$customer_xml_extra = '
									<ReceivePostFromUs>Opt out</ReceivePostFromUs>
									<ReceiveEmailFromUs>Opt out</ReceiveEmailFromUs>
									<ReceiveSMSFromUs>Opt out</ReceiveSMSFromUs>
									<ReceivePhoneFromUs>Opt out</ReceivePhoneFromUs>
									<SUN>915649</SUN>
									<AffiliateID></AffiliateID>
									';
				
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
						$customer_pdf .= '<h1>Worldpay Online Payment</h1>Authorisation Date: <br>
											Reference Number: <br>
											Transaction Status: Payment Successful<br>
											<h1>Tracking</h1>Tracking: <br>';				
				}
			}
			
			$topup_file_prefx = "_";
			$topup_xml_tag_prefx = "LISAApplications";
			if(get_session('set_topup') == true){
				$topup_file_prefx = "_TOPUP_";
				$topup_xml_tag_prefx = "LISATopup";
			}
				
			if($customer_xml_dd !="")
			{
				$filename_xml = LISA_FILENAME_XML_DD_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_dd_file = $customer_xml;
				$customer_xml_dd_file .= $customer_xml_dd;
				$customer_xml_dd_file .= $customer_xml_extra;
				$customer_xml_dd_file .= '</Form>';
				generate_xml($customer_xml_dd_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			if($customer_xml_lumpsum !="")
			{
				$filename_xml = LISA_FILENAME_XML_LUMPSUM_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_lumpsum_file = $customer_xml;
				$customer_xml_lumpsum_file .= $customer_xml_lumpsum;
				$customer_xml_lumpsum_file .= $customer_xml_extra;
				$customer_xml_lumpsum_file .= '</Form>';
				generate_xml($customer_xml_lumpsum_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			if($customer_xml_transfer !="")
			{
				$filename_xml = LISA_FILENAME_XML_TRANSFER_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_transfer_file = $customer_xml;
				$customer_xml_transfer_file .= $customer_xml_transfer;
				$customer_xml_transfer_file .= $customer_xml_extra;
				$customer_xml_transfer_file .= '</Form>';
				generate_xml($customer_xml_transfer_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			
			$filename_pdf = LISA_CUSTOMER_APPLICATION_PFX . $topup_file_prefx . $form_forester_id . '.pdf';
			$pdf_file_path = generate_pdf($customer_pdf, 'Lisa Customer PDF', $filename_pdf, '');
			
				$heading = "application";
				if(get_session('set_topup'))
					$heading = "Top up";
						
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('lisa/download/'.$filename_pdf);
				$body['admin_body_content'] = LISA_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your LISA $heading has been submitted");
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product $heading (Lifetime ISA)");
die;
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
				$file_content = file_get_contents($filename); 
				$this->load->helper('download');
				force_download(basename($filename), $file_content,true);
		}else{
			show_404();
		}
	}
	
	public function transfer_form()
	{
		$this->load->helper('pdf_helper');
		// initiate PDF
		$pdf = new PDF();
		$pdf->_fullPathToFile = FCPATH . 'LISA_Transfer_Form.pdf';

		
		// add a page
		$pdf->AddPage();
		
		$mx = 40;
		$my = 50;
		
		// The new content
		
		$pdf->SetFont('zapfdingbats','', 8);
		
		//Customer Personal Information
		$personal_details = get_session('personal_details');
		
		if(!empty($personal_details)){
			
			
			
			$pdf->SetTextColor(0, 0, 0);
			if(isset($personal_details['title']) && $personal_details['title'] == "Mr")
				$pdf->Text($mx + 2,$my,4);
			elseif(isset($personal_details['title']) && $personal_details['title'] == "Mrs")
				$pdf->Text($mx + 12,$my,4);
			elseif(isset($personal_details['title']) && $personal_details['title'] == "Miss")
				$pdf->Text($mx + 22,$my,4);	
			elseif(isset($personal_details['title']) && $personal_details['title'] == "Ms")
				$pdf->Text($mx + 32,$my,4);
			elseif(isset($personal_details['title']) && $personal_details['title'] == "Dr"){
				$pdf->SetFont("helvetica", "B", 8);	
				$pdf->Text($mx + 45,$my,"Dr");		
			}else{
				$pdf->SetFont("helvetica", "B", 8);	
				$pdf->Text($mx + 45,$my, trim($personal_details['other_title']));		
			}	
			$pdf->SetFont("helvetica", "B", 8);				
			if(isset($personal_details['first_name']) && $personal_details['first_name'] != "")
				$pdf->Text($mx - 2,$my + 5, trim($personal_details['first_name']));
				
			if(isset($personal_details['last_name']) && $personal_details['last_name'] != "")
				$pdf->Text($mx - 2,$my + 10.5, trim($personal_details['last_name']));
				
			if(isset($personal_details['dob_day']) && $personal_details['dob_day'] != "")
				$pdf->Text($mx + 17,$my + 17.2, wordwrap(str_pad($personal_details['dob_day'], 2, 0, STR_PAD_LEFT), 1 , '    ' , true ));	
				
			if(isset($personal_details['dob_month']) && $personal_details['dob_month'] != "")
				$pdf->Text($mx + 26.5,$my + 17.2, wordwrap(str_pad($personal_details['dob_month'], 2, 0, STR_PAD_LEFT) , 1 , '    ' , true ));
				
			if(isset($personal_details['dob_year']) && $personal_details['dob_year'] != "")
				$pdf->Text($mx + 35.5,$my + 17.2, wordwrap(str_pad($personal_details['dob_year'], 2, 0, STR_PAD_LEFT) , 1 , '    ' , true ));	
				
			if(isset($personal_details['NI1'])){
				$insurance_number = $personal_details['NI1'] . $personal_details['NI2'] . $personal_details['NI3'] . $personal_details['NI4'] . $personal_details['NI5']; 
				$pdf->Text($mx + 17,$my + 25, wordwrap(strtoupper($insurance_number), 1 , '   ' , true ));	
			}
			
			if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){
				$pdf->Text($mx + 25,$my + 38.6, $personal_details['toptup_policy_number']);	
			}
			
			if(isset($personal_details['address1']) && $personal_details['address1'] != ""){
				$pdf->Text($mx + 78,$my - 1, $personal_details['address1']);	
			}
			
			if(isset($personal_details['address2']) && $personal_details['address2'] != ""){
				$pdf->Text($mx + 78,$my + 5.5, $personal_details['address2']);	
			}
			
			if(isset($personal_details['town']) && $personal_details['town'] != ""){
				$pdf->Text($mx + 78,$my + 11, $personal_details['town']);	
			}
			
			if(isset($personal_details['postcode_box']) && $personal_details['postcode_box'] != ""){
				$pdf->Text($mx + 118,$my + 11, $personal_details['postcode_box']);	
			}
			
			if(isset($personal_details['phone']) && $personal_details['phone'] != ""){
				$pdf->Text($mx + 78,$my + 19.2, $personal_details['phone']);	
			}
			
			if(isset($personal_details['email']) && $personal_details['email'] != ""){
				$pdf->Text($mx + 78,$my + 25.2, $personal_details['email']);	
			}	
				
			// THIS PUTS THE REMAINDER OF THE PAGES IN
			if($pdf->numPages>1) {
				for($i=2;$i<=$pdf->numPages;$i++) {
					//$pdf->endPage();
					$pdf->_tplIdx = $pdf->importPage($i);
					$pdf->AddPage();
				}
			}
			
			$pdf->Output("LISA_Transfer_Form.pdf", 'D');
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
		$heading = "";
		if(get_session('set_topup'))
			$heading = "Top up";
		
		submit_worldPayGlobal($payment_data, "Lifetime ISA $heading(Lump Sum Investment)", "LISALUMPSUM", "Lifetime ISA $heading lump sum application", WORLD_PAY_LISA_REFER_URL);
	}
	
	public function confirmation()
	{
		
			if((isset($_GET['transStatus']) &&  $_GET['transStatus'] =="Y") && get_session('process')==true){
			$payment_data = get_session('payment_data');
			$new_constant_value = $payment_data['order_id'];
			$create_date_time = $payment_data['create_date_time'];
			$personal_details = get_session('personal_details');
			$payment_options = get_session('payment_options');
			$form_forester_id = $_GET['cartId'];
			$customer_pdf = "";
			$customer_name = "";
			$customer_xml_dd = "";
			$customer_xml_lumpsum = "";
			$customer_xml_transfer = "";
			
			
				$customer_xml = '<Form id="'.$new_constant_value.'" forestersid="'. $form_forester_id .'" createdate="'.$create_date_time.'">
									<returnState>0</returnState>
									<ID>'. $new_constant_value .'</ID>';
			if(!empty($personal_details))
			{
				$dob = date("d/m/Y h:i:s", strtotime($personal_details['dob_day'].'-'.$personal_details['dob_month'].'-'.$personal_details['dob_year']));
				
				$national_insurance_number = "";
				$ni_number ='';
				if(get_session('set_topup') == false){
				$ni_number = $personal_details['NI1'] . "" . $personal_details['NI2'] . "" . $personal_details['NI3'] . "" . $personal_details['NI4'] . "" . $personal_details['NI5'];
				$national_insurance_number = 'National Insurance Number: '.strtoupper($ni_number).'<br>';
				}
				$old_address_change = (isset($personal_details['old_address_change']) && $personal_details['old_address_change'] == 1)?"Yes":"No";
				$title = ($personal_details['title']=="Other")?$personal_details['other_title']:$personal_details['title'];
				$customer_name = $title.' ' .$personal_details['first_name'].' ' .$personal_details['last_name'];
				$pdf_password = strtoupper($personal_details['last_name']) . $personal_details['dob_year'];
				
				$customer_xml .= '	
									<Title>'.$title.'</Title>
									<Forename>'.$personal_details['first_name'].'</Forename>
									<Surname>'.$personal_details['last_name'].'</Surname>
									<DOB>'.$dob.'</DOB>
									<NationalInsuranceNumber>'.strtoupper($ni_number).'</NationalInsuranceNumber>
									<AddressLine1>'.$personal_details['address1'].'</AddressLine1>
									<AddressLine2>'.$personal_details['address2'].'</AddressLine2>
									<Town>'.$personal_details['town'].'</Town>
									<County>'.$personal_details['county'].'</County>
									<Country>GB</Country>
									<Postcode>'.$personal_details['postcode_box'].'</Postcode>
									<PhoneDay>'.$personal_details['phone'].'</PhoneDay>
									<Email>'.$personal_details['email'].'</Email>
									<PrevAddressLine1>'.$personal_details['additional_address1'].'</PrevAddressLine1>
									<PrevAddressLine2>'.$personal_details['additional_address2'].'</PrevAddressLine2>
									<PrevTown>'.$personal_details['additional_town_city'].'</PrevTown>
									<PrevCounty>'.$personal_details['additional_county'].'</PrevCounty>
									<PrevPostcode>'.$personal_details['additional_postcode_box'].'</PrevPostcode>
									<MembershipType>LISA</MembershipType>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>';
									
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_xml .= '<HearAboutIntroducer>'.$personal_details['HeardAboutUs_extra'].'</HearAboutIntroducer>';
								elseif($personal_details['HeardAboutUs']=="Other")	
				$customer_xml .= ' <HearAboutOther>'.$personal_details['HeardAboutUs_extra'].'</HearAboutOther>
									<CheckedAntiMoneyLaundering>True</CheckedAntiMoneyLaundering>
      								<CheckedDeclaration>True</CheckedDeclaration>';
									
									
									$customer_xml .= '
									<PromotionalCode>'.$personal_details['offer_code'].'</PromotionalCode>
									';
									
				$customer_pdf .= 	'<h1>LISA </h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y").'</h1><br>
									<h1>IDs</h1>
									IFA Number: <br>
									Application ID: '. $form_forester_id .'<br>
									Top Up ID: '. @$personal_details['toptup_policy_number'] .'<br>
									Tracking: '. $_GET[0].'<br><br>
									<h1>Your Details</h1>
									Title: '.$title.'<br>
									Forename: '.$personal_details['first_name'].'<br>
									Surname: '.$personal_details['last_name'].'<br>
									Date of Birth: '.$dob.'<br>
									'.$national_insurance_number.'
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
						
				if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != ""){
					$customer_xml .= '<TopUp>Yes</TopUp>
									<ExistingLISAPolicyNumber>'.$personal_details['toptup_policy_number'].'</ExistingLISAPolicyNumber>
									';
							//$customer_pdf .= 'Existing LISA Policy Number: '.$personal_details['toptup_policy_number'].'<br>';
								}					
			}
			
			if(!empty($payment_options))
			{
				if(isset($payment_options['choose_payment_option_monthly']) && $payment_options['choose_payment_option_monthly'] == 1)
				{

					$customer_xml_dd .= '<ContributionType>Monthly</ContributionType>
										<MonthlyContributionAmount>'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'</MonthlyContributionAmount>
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										<DirectDebit>True</DirectDebit>
										<JointAccount>False</JointAccount>
      									<BothSign>False</BothSign>
										<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
										<BranchID>0</BranchID>
										<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
										<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										<IsAccountValid>True</IsAccountValid>
										';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
										Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'<br>
										Tax Year: '.date("Y") .'/'. date("Y", strtotime("+1 year")).'<br>
										Account Holder Name: '.$payment_options['monthly_account_holder_name'].'<br>
										Account Number: '.$payment_options['monthly_account_number'].'<br>
										Sort Code: '.$payment_options['monthly_account_sort_code'].'<br>
										Is Account Valid: True<br>';						
				}
				if(isset($payment_options['choose_payment_option_lumpsum']) && $payment_options['choose_payment_option_lumpsum'] == 1)
				{				
				$customer_xml_lumpsum .= '<ContributionType>LumpSum</ContributionType>
									<LumpSumContributionAmount>'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'</LumpSumContributionAmount>
									<WorldPayPaymentAuthorisationDate>'.date('d/m/Y', strtotime($_GET['transTime'])).'</WorldPayPaymentAuthorisationDate>
									<WorldPayPaymentReferenceNumber>'.$_GET[0].'</WorldPayPaymentReferenceNumber>
									<WorldPayPaymentTransactionStatus>Y</WorldPayPaymentTransactionStatus>
									<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
									';
						$customer_pdf .= '<h1>Lump Sum Investment</h1>Contribution Amount: &pound;'.@number_format(str_replace(",","",$payment_options['lumpsum_innvest_amount']),'0','',',').'<br>';
										
				}
				if(isset($payment_options['choose_payment_option_transfer']) && $payment_options['choose_payment_option_transfer'] == 1)
				{
					$customer_xml_transfer .= '<TransferPaymentOption>Transfer in from another ISA provider</TransferPaymentOption>
										<TransferPaymentOptionSelected>Yes</TransferPaymentOptionSelected>
											';
											
						$customer_pdf .= '<h1>Transfer another ISA</h1>Transfer in from another ISA provider: Yes <br>';					
				}	
				
								
					$customer_xml_extra = '
									<ReceivePostFromUs>Opt out</ReceivePostFromUs>
									<ReceiveEmailFromUs>Opt out</ReceiveEmailFromUs>
									<ReceiveSMSFromUs>Opt out</ReceiveSMSFromUs>
									<ReceivePhoneFromUs>Opt out</ReceivePhoneFromUs>
									<SUN>915649</SUN>
									<AffiliateID></AffiliateID>
									';
				
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
										<h1>Tracking</h1>Tracking: '.$_GET[0].'<br>';				
				}
			}
			
			
			
			$topup_file_prefx = "_";
			$topup_xml_tag_prefx = "LISAApplications";
			if(get_session('set_topup') == true){
				$topup_file_prefx = "_TOPUP_";
				$topup_xml_tag_prefx = "LISATopup";
			}
				
			if($customer_xml_dd !="")
			{
				$filename_xml = LISA_FILENAME_XML_DD_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_dd_file = $customer_xml;
				$customer_xml_dd_file .= $customer_xml_dd;
				$customer_xml_dd_file .= $customer_xml_extra;
				$customer_xml_dd_file .= '</Form>';
				generate_xml($customer_xml_dd_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			if($customer_xml_lumpsum !="")
			{
				$filename_xml = LISA_FILENAME_XML_LUMPSUM_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_lumpsum_file = $customer_xml;
				$customer_xml_lumpsum_file .= $customer_xml_lumpsum;
				$customer_xml_lumpsum_file .= $customer_xml_extra;
				$customer_xml_lumpsum_file .= '</Form>';
				generate_xml($customer_xml_lumpsum_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			if($customer_xml_transfer !="")
			{
				$filename_xml = LISA_FILENAME_XML_TRANSFER_PFX . $topup_file_prefx . $form_forester_id .'.xml';
				$customer_xml_transfer_file = $customer_xml;
				$customer_xml_transfer_file .= $customer_xml_transfer;
				$customer_xml_transfer_file .= $customer_xml_extra;
				$customer_xml_transfer_file .= '</Form>';
				generate_xml($customer_xml_transfer_file, $topup_xml_tag_prefx, $filename_xml);
			}
			
			
			$filename_pdf = LISA_CUSTOMER_APPLICATION_PFX . $topup_file_prefx . $form_forester_id . '.pdf';
			$pdf_file_path = generate_pdf($customer_pdf, 'Lisa Customer PDF', $filename_pdf, '');
				
					$heading = "application";
					if(get_session('set_topup'))
						$heading = "Top up";
					
					$body = array();
					$body['topup'] = false;
					if(isset($personal_details['toptup_policy_number']) && $personal_details['toptup_policy_number'] != "")
						$body['topup'] = true;
						
					$body['customer_name'] = $customer_name;
					$body['application_number'] = $form_forester_id;
					$body['payment_reference_number'] = $_GET[0];
					$body['pdf_link'] = base_url('lisa/download/'.$filename_pdf);
					$body['admin_body_content'] = LISA_ADMIN_EMAIL_BODY_CONTENT;
					
					sendEmailtoCustomer($personal_details['email'], $body, "Your LISA $heading has been submitted", false, 'lisa_customer_confirmation');
					
					sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product $heading (Lifetime ISA)");
					
					
					$data = array();
					$data['cutomer_ref_number'] = $form_forester_id;
					$data['type'] = "";
					$data['progressbar'] = lisa_steps_pregressbar(4);
					$data['payment_reference_number'] = $_GET[0];
					$this->session->sess_destroy();
					$this->fapp->show('lisa', 'lisa_form_confirmation', $data);
					
			}else{
			redirect(base_url('lisa'));
			exit;
			}				
	}
}
