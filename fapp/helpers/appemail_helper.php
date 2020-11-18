<?php

/**
 * appemail_helper short summary.
 *
 * appemail_helper description.
 *
 * @version 1.0
 * @author Kanchan
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function sendEmailtoCustomer($emailID,$body,$subject,$attachment=false, $template = "customer_confirmation") {
    $ci = &get_instance();
    
    $messagebody = $ci->load->view('emailtemplate/'.$template,$body,true);   
    
    $status = email($emailID,$messagebody,$subject,$attachment);
    return $status;
}

function sendEmailtoAdmin($emailID,$body,$subject,$attachment=false) {
    $ci = &get_instance();
    
    $messagebody = $ci->load->view('emailtemplate/admin_confirmation',$body,true);   
    
    $status = email($emailID,$messagebody,$subject,$attachment);
    return $status;
}

function sendEmailtoPOISAdmin($emailID,$body,$subject,$attachment=false) {
    $ci = &get_instance();
    
    $messagebody = $ci->load->view('emailtemplate/admin_pois_confirmation',$body,true);   
    
    $status = email($emailID,$messagebody,$subject,$attachment);
    return $status;
}

function email($rcpnt, $body, $subject, $attachment=false) {
    if(!SEND_EMAILS)
        return true;
    
    $ci = &get_instance();
    
    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => APP_SMTP_HOST,
        'smtp_port' => APP_SMTP_PORT,
        'mailtype'  => 'html',
         'priority' => 1,
        'charset'   => 'utf-8'
    );
    if(APP_SMTP_AUTH) {
        $config['smtp_user'] = APP_SMTP_USER;
        $config['smtp_pass'] = APP_SMTP_PASS;
    }
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
    
    $ci->load->library('email', $config);
    
    $ci->email->from(APP_FROM_EMAIL, APP_FROM_NAME);
    $ci->email->to($rcpnt);
    if($attachment)
        $ci->email->attach($attachment);

    $ci->email->subject($subject);
    $ci->email->message($body);

   
    
    if($ci->email->send()) {
        $ci->email->clear(true);
        return true;
    } else {
        $ci->email->clear(true);
        return false;
    }
}