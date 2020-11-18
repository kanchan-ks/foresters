<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ctesp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fapp->addCSS(base_url('/assets/css/ctesp.css'));
		$this->fapp->addCSS(base_url("/assets/plugins/select2/select2.min.css"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/ctesp.js"),false);
		$this->fapp->addJS(base_url("/assets/js/custom/custom.js"),false);
		
	}
	
    public function index($type="one")	{
		$data = array();
		$this->session->sess_destroy();
		$data['type'] = $type;
		$data['progressbar'] = ctesp_steps_pregressbar(1);
		$data['personal_details'] = personal_details();
		$data['payment_options'] = payment_options();
		$data['child_details'] = child_details();
		$data['list_title'] = list_title();
		$data['month'] = list_month();
		$data['list_maturity_month'] = list_maturity_month();
		$data['list_how_did_you_hear_aboutus'] = list_how_did_you_hear_aboutus();
		$this->fapp->show('ctesp', 'ctesp_form_step', $data);
	}
	
	public function ctesp_form_submit()	{
      
        if($this->input->is_ajax_request()){
			$data = array();
			$data_type = get_post('data_type');
			$data['list_title'] = list_title();
			$data['month'] = list_month();
			$data['list_maturity_month'] = list_maturity_month();
			$step = get_post('step') + 1;
			$data['progressbar'] = ctesp_steps_pregressbar($step);

			$all_fields_post_value = $this->security->xss_clean(get_post());
			
			if(!empty($all_fields_post_value))
			{
				unset($all_fields_post_value['data_type']);
				
				$personal_details_blank = personal_details();
				$child_details_blank = child_details();
				$plan_details_blank = plan_details();
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
					$data['personal_details_view'] = $this->load->view('ctesp/summary_personal_details', $data, true);
					
					if(!empty($this->session->userdata('child_details')))
						$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					else
						$data['child_details'] = $child_details_blank;
								
					$data['view_child_opt'] = $this->load->view('ctesp/view_child_details', $data, true);
					
					if(!empty($this->session->userdata('payment_options')))
						$data['payment_options'] = @array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					else
						$data['payment_options'] = $payment_options_blank;
						
					$data['view_payment_opt'] = $this->load->view('ctesp/view_payment_options', $data, true);
					
					
				}
				
				$data['view_summary_plan_details'] = false;
				if(!empty($this->session->userdata('plan_details'))){
					$data['view_summary_plan_details'] = true;
					$data['plan_details'] = array_merge($plan_details_blank, $this->session->userdata('plan_details'));
					$data['plan_details_view'] = $this->load->view('ctesp/summary_plan_details', $data, true);
				}

				
				$data['view_summary_child_details'] = false;
				if(!empty($this->session->userdata('child_details'))){
					$data['view_summary_child_details'] = true;
					$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					$data['child_details_view'] = $this->load->view('ctesp/summary_child_details', $data, true);
					
				}
				
				
				$data['view_summary_payment_options'] = false;
				if(!empty($this->session->userdata('payment_options'))){
					$data['view_summary_payment_options'] = true;
					$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
					$data['payment_options_view'] = $this->load->view('ctesp/summary_payment_options', $data, true);
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
			$data['progressbar'] = ctesp_steps_pregressbar($step);
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
			 $selected_date  = new DateTime("$months/$days/$years");
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
			
			if(isset($child) && $child==true){
				$min_age = get_min_age_diff(16, false);
				$max_age = get_max_age_diff(16);
			
				if($get_dob_days < $max_age)
				{
					$this->session->set_userdata('child_dob_nin', true);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'child_valid'=>true)));
				}else{
					$this->session->set_userdata('child_dob_nin', false);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'child_valid'=>false)));
				}	
			}else{
				$min_child_age = get_min_age_diff(16, false);
				$max_child_age = get_max_age_diff(18);
				
				if($get_dob_days > $min_child_age && $get_dob_days < $max_child_age)
				{
					$this->session->set_userdata('valid_child_dob', true);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'child_valid'=>true)));
				}else{
					$this->session->set_userdata('valid_child_dob', false);
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'child_valid'=>false)));
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
			$data['progressbar'] = ctesp_steps_pregressbar($step);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $data)));
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
			if($days !=" " && $months != " " && $years !=" "){
				$get_dob_days = get_age_diff("$days/$months/$years");
				if(!checkdate($months, $days, $years))
				{
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>false, 'msg' => MSG_INVALID_DATE)));
					return false;
				}
			}	
					
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
			$data['list_title'] = list_title();
			if(!empty($all_fields_post_value))
			{
				
				$personal_details_blank = personal_details();
				$plan_details_blank = plan_details();
				$child_details_blank = child_details();
				$payment_options_blank = payment_options();
				
				$new_value = $this->session->set_userdata($data_type, $all_fields_post_value);
				
				if($data_type == "personal_details"){
						$data['view_summary_personal_details'] = true;
						$data['personal_details'] = @array_merge($personal_details_blank, $this->session->userdata('personal_details'));
						$data['personal_details_view'] = $this->load->view('ctesp/summary_personal_details', $data, true);
				}
				
				if(!empty($this->session->userdata('child_details'))){
					$data['personal_details'] = $this->session->userdata('personal_details');
					$data['child_details'] = @array_merge($child_details_blank, $this->session->userdata('child_details'));
					$data['child_details_view'] = $this->load->view('ctesp/summary_child_details', $data, true);
					
				}
				
				if(!empty($this->session->userdata('plan_details'))){
					$data['plan_details'] = array_merge($plan_details_blank, $this->session->userdata('plan_details'));
					$data['plan_details_view'] = $this->load->view('ctesp/summary_plan_details', $data, true);
				}
				
				if($data_type == "payment_options"){
						$data['view_summary_payment_options'] = true;
						$data['payment_options'] = array_merge($payment_options_blank, $this->session->userdata('payment_options'));
						$data['payment_options_view'] = $this->load->view('ctesp/summary_payment_options', $data, true);
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
	
	public function edit_child()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['personal_details'] = $this->session->userdata('personal_details');
			$data['type'] = "topup";
			$data['month'] = list_month();
			$data['list_title'] = list_title();
			$view = $this->load->view('ctesp/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	public function edit_plan()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			$page = get_post('page');
			$data[$page] = $this->session->userdata($page);
			$data['type'] = "topup";
			$data['month'] = list_month();
			$view = $this->load->view('ctesp/edit_list_' . $page, $data, true);
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
			$view = $this->load->view('ctesp/edit_list_' . $page, $data, true);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>true, 'data' => $view)));
		}else{
			show_404();
		}	
	}
	
	
	public function submit_application()	{
		if($this->input->is_ajax_request()){
			$data = array();
			$step = get_post('step');
			
			$data['progressbar'] = ctesp_steps_pregressbar($step + 1);
			$personal_details = get_session('personal_details');
			$child_details = get_session('child_details');
			$plan_details = get_session('plan_details');
			$payment_options = get_session('payment_options');
			$new_constant_value = CUSTOMER_APPLICATION_NO + 1;
			$constFile = fopen(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php',"w");

			fwrite($constFile,'<?php'."\r\n");
			fwrite($constFile,'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');'."\r\n \r\n");
			fwrite($constFile,"define('CUSTOMER_APPLICATION_NO', $new_constant_value);");
			fwrite($constFile,'?>');
			fclose($constFile);
			
			
			/*$form_forester_id = CTESP_CUSTOMER_APPLICATION_PFX . date("dm") . $new_constant_value;*/
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
									<AddressChange>Have you changed address in the last 3 months?</AddressChange>
									<AddressChangeValue>'.$old_address_change.'</AddressChangeValue>
									<PrevAddressLine1>'.$personal_details['additional_address1'].'</PrevAddressLine1>
									<PrevAddressLine2>'.$personal_details['additional_address2'].'</PrevAddressLine2>
									<PrevTown>'.$personal_details['additional_town_city'].'</PrevTown>
									<PrevCounty>'.$personal_details['additional_county'].'</PrevCounty>
									<PrevPostcode>'.$personal_details['additional_postcode_box'].'</PrevPostcode>
									<MembershipType>CTESP</MembershipType>
									<ParentRelationToChild>'.$personal_details['personal_details_relation_to_child'].'</ParentRelationToChild>
									<ParentRelationToChildOther>'.$personal_details['personal_details_relation_other'].'</ParentRelationToChildOther>
									<HearAbout>'.$personal_details['HeardAboutUs'].'</HearAbout>
									<HearAboutIntroducer>'.$personal_details['HeardAboutUs_extra'].'</HearAboutIntroducer>
									<PromotionalCode>'.$personal_details['offer_code'].'</PromotionalCode>';
									
				$customer_pdf .= 	'<h1>CTESP </h1>
									<h1>SUN: 915649</h1><br>
									<h1>Date Created: '.date("d/m/Y", strtotime($create_date_time)).'</h1><br>
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
									Relation to Child: '.$personal_details['personal_details_relation_to_child'].'<br>
									Relation to Child (if Other): '.$personal_details['personal_details_relation_other'].'<br>
									How did you hear about us: '.get_marketing_source_code($personal_details['HeardAboutUs'], $personal_details['HeardAboutUs_extra']).'<br>';
										
								if($personal_details['HeardAboutUs']=="Introducer")	
									$customer_pdf .= 	'Introducer Number: '.$personal_details['HeardAboutUs_extra'].'<br>';
								elseif($personal_details['HeardAboutUs']=="Other")	
									$customer_pdf .= 	'Other: '.$personal_details['HeardAboutUs_extra'].'<br>';
									
						$customer_pdf .= 	'Promotional Code: '.$personal_details['offer_code'].'<br>';					
			}
			
			if(!empty($child_details))
			{
					$child_dob = date("d F Y", strtotime($child_details['cdob_day'] . "-" . $child_details['cdob_month'] . "-" . $child_details['cdob_year']));
					
					
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
					}else{
						$customer_xml .= '<AddressLine1>'.$child_details['address1'].'</AddressLine1>
											<AddressLine2>'.$child_details['address2'].'</AddressLine2>
											<Town>'.$child_details['town'].'</Town>
											<County>'.$child_details['county'].'</County>
											<Postcode>'.$child_details['postcode_box'].'</Postcode>';
					}
					
					if($personal_details['personal_details_relation_to_child'] !="Parent/Guardian"){
					
							$parent_title = ($child_details['parent_title']=="Other")?$child_details['parent_other_title']:$child_details['parent_title'];
							$customer_xml .= '<ParentTitle>'.$parent_title.'</ParentTitle>
										<ParentForename>'.$child_details['parent_first_name'].'</ParentForename>
										<ParentSurname>'.$child_details['parent_last_name'].'</ParentSurname>';
						if(isset($child_details['parent_child_hidden_postcode']) && $child_details['parent_child_hidden_postcode']!="")
						{					
							$customer_xml .= '<ParentAddressLine1>'.$child_details['parent_child_hidden_address1'].'</ParentAddressLine1>
											<ParentAddressLine2>'.$child_details['parent_child_hidden_address2'].'</ParentAddressLine2>
											<ParentTown>'.$child_details['parent_child_hidden_town_city'].'</ParentTown>
											<ParentCounty>'.$child_details['parent_child_hidden_county'].'</ParentCounty>
											<ParentPostcode>'.$child_details['parent_child_hidden_postcode'].'</ParentPostcode>';
						}else{
							$customer_xml .= '<ParentAddressLine1>'.$child_details['parent_address1'].'</ParentAddressLine1>
												<ParentAddressLine2>'.$child_details['parent_address2'].'</ParentAddressLine2>
												<ParentTown>'.$child_details['parent_town'].'</ParentTown>
												<ParentCounty>'.$child_details['parent_county'].'</ParentCounty>
												<ParentPostcode>'.$child_details['parent_postcode_box'].'</ParentPostcode>';
						}
						
						$customer_xml .= '<ParentPhone>'.$child_details['parent_phone'].'</ParentPhone>';
						$customer_xml .= '<ParentEmail>'.$child_details['parent_email'].'</ParentEmail>';
					
					}
					
										
					$customer_pdf .= 	'<h1>Child Details</h1>
												Title: '.$child_details['title'].'<br>
												Forename: '.$child_details['first_name'].'<br>
												Surname: '.$child_details['last_name'].'<br>
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
					
					
					if($personal_details['personal_details_relation_to_child'] !="Parent/Guardian"){
							$parent_title = ($child_details['parent_title']=="Other")?$child_details['parent_other_title']:$child_details['parent_title'];
							$customer_pdf .= 	'<h1>Parent Details</h1>Title: '.$parent_title.'<br>Forename: '. $child_details['parent_first_name'] .'<br>Surname: '. $child_details['parent_last_name'].'<br>';
							
							if(isset($child_details['parent_same_address_child']) && $child_details['parent_same_address_child'] == 1){	
							$customer_pdf .= 	'Parent Address Line1: '.$child_details['parent_hidden_address1'].'<br>
												Parent Address Line2: '.$child_details['parent_hidden_address2'].'<br>
												Parent Town: '.$child_details['parent_hidden_town_city'].'<br>
												Parent County: '.$child_details['parent_hidden_county'].'<br>
												Parent Postcode:'.$child_details['parent_hidden_postcode'].'<br>';	
							}else{
							$customer_pdf .= 	'Parent Address Line1: '.$child_details['parent_address1'].'<br>
													Parent Address Line2: '.$child_details['parent_address2'].'<br>
													Parent Town: '.$child_details['parent_town'].'<br>
													Parent County: '.$child_details['parent_county'].'<br>
													Parent Postcode:'.$child_details['parent_postcode_box'].'<br>';
							}	
							$customer_pdf .= 	'Parent Daytime Phone: '.$child_details['parent_phone'].'<br>';	
							$customer_pdf .= 	'Parent Email Address: '.$child_details['parent_email'].'<br>';
					}
													
				}
			
			if(!empty($plan_details))
			{
				$customer_pdf .= '<h1>Plan Details</h1>';
				if(isset($plan_details['terms_in_years']) && $plan_details['terms_in_years']!= " ")
				{

					$customer_xml .= '<TermsInYears>'.$plan_details['terms_in_years'].' Years</TermsInYears>';
					$customer_pdf .= 'Terms In Years: '.$plan_details['terms_in_years'].' Years<br>';
				}
				
				if(isset($plan_details['specific_matuarity_year']) && $plan_details['specific_matuarity_year']!=" ")
				{
					$specificMatuarityDate = date("d F Y", strtotime($plan_details['specific_matuarity_day'].'-'.$plan_details['specific_matuarity_month'].'-'.$plan_details['specific_matuarity_year']));
					$customer_xml .= '<SpecificMatuarityDate>'.$specificMatuarityDate.'</SpecificMatuarityDate>';
					$customer_pdf .= 'Specific Matuarity Date: '.$specificMatuarityDate.'<br>';
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
				
										<MonthlyContributionAmount>£'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'</MonthlyContributionAmount>
										
										<TaxYear>'.date("Y") .'/'. date("Y", strtotime("+1 year")).'</TaxYear>
										
										<DirectDebit>True</DirectDebit>
										
										<AccountName>'.$payment_options['monthly_account_holder_name'].'</AccountName>
										
										<AccountNumber>'.$payment_options['monthly_account_number'].'</AccountNumber>
										
										<SortCode>'.$payment_options['monthly_account_sort_code'].'</SortCode>
										
										<ThirdPartyPayer>True</ThirdPartyPayer>
										
										<DirectDebitPaymentDate>1</DirectDebitPaymentDate>
										
										<IsAccountValid>'.$thirdPartyPayer.'</IsAccountValid>';
										
					$customer_pdf .= '<h1>Monthly Direct Debit</h1>
										Contribution Amount:: &pound;'.@number_format(str_replace(",","",$payment_options['monthly_innvest_amount']),'0','',',').'<br>
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
			$filename_xml = CTESP_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.xml';
			$filename_pdf = CTESP_CUSTOMER_APPLICATION_PFX . $new_constant_value . '-' .date("d-m-Y").'-'. str_replace(" ","-",$personal_details['last_name']) .'.pdf';
			
			$xml_file_path = generate_xml($customer_xml, 'CTESP', $filename_xml);
			$pdf_file_path = generate_pdf($customer_pdf, 'Child Tax Exempt Savings Plan Customer PDF', $filename_pdf, '');
			
				
				$body = array();
				$body['customer_name'] = $customer_name;
				$body['application_number'] = $form_forester_id;
				$body['payment_reference_number'] = '';//$payment_reference_number;
				$body['pdf_link'] = base_url('ctesp/download/'.$filename_pdf);
				$body['admin_body_content'] = CTESP_ADMIN_EMAIL_BODY_CONTENT;
				
				sendEmailtoCustomer($personal_details['email'], $body, "Your Child Tax Exempt Savings Plan (CTESP) application has been submitted", false, "ctesp_customer_confirmation");
				
				sendEmailtoAdmin(ADMIN_EMAIL, $body, "New online product application (CTESP)");

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
	
	public function transfer_form()
	{
		$this->load->helper('pdf_helper');
		// initiate PDF
		$pdf = new PDF();
		
		// add a page
		$pdf->AddPage();
		
		$mx = 40;
		$my = 50;
		
		// The new content
		
		$pdf->SetFont('zapfdingbats','', 8);
		
		//Customer Personal Information
		$personal_details = get_session('personal_details');
		//echo "<pre>";
		//print_r($personal_details);
		
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
			else
				$pdf->Text($mx + 42,$my, $personal_details['title']);		
				
			$pdf->SetFont("helvetica", "B", 8);				
			if(isset($personal_details['first_name']) && $personal_details['first_name'] != "")
				$pdf->Text($mx - 2,$my + 5, $personal_details['first_name']);
				
			if(isset($personal_details['last_name']) && $personal_details['last_name'] != "")
				$pdf->Text($mx - 2,$my + 10.5, $personal_details['last_name']);
				
			if(isset($personal_details['dob_day']) && $personal_details['dob_day'] != "")
				$pdf->Text($mx + 17,$my + 17.2, wordwrap(str_pad($personal_details['dob_day'], 2, 0, STR_PAD_LEFT), 1 , '    ' , true ));	
				
			if(isset($personal_details['dob_month']) && $personal_details['dob_month'] != "")
				$pdf->Text($mx + 26.5,$my + 17.2, wordwrap(str_pad($personal_details['dob_month'], 2, 0, STR_PAD_LEFT) , 1 , '    ' , true ));
				
			if(isset($personal_details['dob_year']) && $personal_details['dob_year'] != "")
				$pdf->Text($mx + 35.5,$my + 17.2, wordwrap(str_pad($personal_details['dob_year'], 2, 0, STR_PAD_LEFT) , 1 , '    ' , true ));	
				
			if(isset($personal_details['NI1'])){
				$insurance_number = $personal_details['NI1'] . $personal_details['NI2'] . $personal_details['NI3'] . $personal_details['NI4'] . $personal_details['NI5']; 
				$pdf->Text($mx + 17,$my + 25, wordwrap(strtoupper($insurance_number), 1 , '  ' , true ));	
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
			
			$pdf->Output("CTESP_Transfer_Form.pdf", 'D');
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
