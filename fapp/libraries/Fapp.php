<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fapp {
    private $data;
    private $js_file;
    private $css_file;
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        date_default_timezone_set('Europe/London');
		$this->CI->load->library('user_agent');

        // default CSS and JS that they must be load in any pages
        $this->addCSS('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
		$this->addCSS('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
		$this->addCSS(base_url('/assets/plugins/sweet-alert/sweetalert.css'));
		$this->addCSS(base_url('/assets/css/select2-bootstrap4.css'));
		$this->addCSS(base_url('/assets/css/jquery.typeahead.afd.css'));
		$this->addCSS(base_url('/assets/css/style.css'));
		

        $this->addJS(base_url('/assets/js/vendors/jquery-3.5.1.min.js'),true);
        $this->addJS(base_url("/assets/plugins/bootstrap-4.1.3/popper.min.js"),false);
        $this->addJS(base_url('/assets/plugins/bootstrap-4.1.3/js/bootstrap.min.js'),false);
		$this->addJS( base_url('/assets/js/jquery.blockui.min.js'),false);
		$this->addJS(base_url('/assets/plugins/jquery.validate.js'),false);
		$this->addJS(base_url('/assets/js/additional-methods.js'),false);
       // $this->addJS(base_url('/assets/plugins/jquery-validate-tooltip.js'),false);
	   $this->addJS(base_url('/assets/plugins/sweet-alert/sweetalert.min.js'),false);
		$this->addJS(base_url('/assets/js/sweet-alert.js'),false);
		$this->addJS(base_url('/assets/js/select2.min.js'),false);
		$this->addJS(base_url('/assets/js/afd.jquery.1.9.2.min.js'),false);
		$this->addJS(base_url('/assets/scripts/app.js'),false);
		//$this->addJS(base_url('/assets/js/custom.js'),false);
	//	$this->addJS(base_url("/assets/js/extends.js"),false);
		$this->addJS(base_url('/assets/js/app.js'),false);
       	$this->addJS(base_url('/assets/js/global.js'),false);
		
    }

    //Loading the view template files
    public function show( $folder, $page, $data=null)
    {
        if($this->CI->session->userdata('session_id')=='')
            $this->CI->session->set_userdata('session_id',session_id());
        
        if ( ! file_exists(APPPATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$page.'.php' )) {
            show_404();
        } else {
            $this->data['d'] = $data;
            $this->load_JS_and_css();
           // $this->init_menu();
            if($this->CI->session->userdata('ULG')!=null) {
                $this->data['ULG'] = $this->CI->session->userdata('ULG');
            } else {
                $this->data['ULG'] = false;
            }
            if(is_array($data))
            	$pageTitle = isset($data['pagetitle'])?$data['pagetitle']:PAGE_TITLE;
            else 
            	$pageTitle = PAGE_TITLE;
            
            $this->data['page_title'] = $pageTitle;
            
            $this->data['content'] = $this->CI->load->view($folder.'/'.$page.'.php', $this->data, true);
            
            $this->CI->load->view('fapp.php', $this->data);
        }
    }

    //Add JS in the head section
    public function addJS($name,$head=true)
    {
        $js = new stdClass();
        $js->file = $name;
		$js->onhead = $head;
        $this->js_file[] = $js;
    }

    //Add CSS in the head section
    public function addCSS( $name,$version=true)
    {
        $css = new stdClass();
        $css->file = $name;
		$css->version = $version;
        $this->css_file[] = $css;
    }

    //Build the heading section html
    private function load_JS_and_css()
    {
        $this->data['html_head'] = '';
		$this->data['js_foot'] = '';

        if ( $this->css_file )
        {
            foreach( $this->css_file as $css )
            {
                if(!$css->version) {
                    $this->data['html_head'] .= "<link rel='stylesheet' type='text/css' href='".$css->file."'>". "\n";
                } else {
                    $this->data['html_head'] .= "<link rel='stylesheet' type='text/css' href='".$css->file."?v=".ASSET_VERSION."'>". "\n";
                }
            }
        }

        if ( $this->js_file )
        {
            foreach( $this->js_file as $js )
            {
				if($js->onhead) {
					$this->data['html_head'] .= "<script type='text/javascript' src='".$js->file."?v=".ASSET_VERSION."'></script>". "\n";
				} else {
					$this->data['js_foot'] .= "<script type='text/javascript' src='".$js->file."?v=".ASSET_VERSION."'></script>". "\n";
				}
            }
        }
    }

}