<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('AUTHOR','Foresters Friendly Society');
define('PAGE_TITLE','Foresters Friendly - Saving, Investing &amp; Over 50s Life Cover');
define('ASSET_VERSION',time());//'0.216'
define('APP_VERSION','1.0');

define('ADMIN_EMAIL','kanchan@sigam.co.uk');//nhaynes@forestersfriendlysociety.co.uk
define('SEND_EMAILS', true);
define('APP_FROM_EMAIL', 'reporting@lestac.co.uk');
define('APP_FROM_NAME', 'Foresters Friendly Society');
define('APP_FROM_NAME_POIS', 'Post Office Insurance Society (POIS)');
define('APP_SMTP_AUTH', true);
define('APP_SMTP_HOST', 'mail.authsmtp.com');
define('APP_SMTP_PASS', 'xegx4erwt!XE');
define('APP_SMTP_PORT', 25);
define('APP_SMTP_USER', 'ac43669');

define('FFS_PREFIX','FFS');
define('POIS_PREFIX','POIS');

//XML FILE PRFX
define('LISA_FILENAME_XML_DD_PFX','lisa_dd');
define('LISA_FILENAME_XML_LUMPSUM_PFX','lisa_lumpsum');
define('LISA_FILENAME_XML_TRANSFER_PFX','lisa_trf');


define('WORLDPAY_ACCCONT_ID', 1061994);

define('PDF_OPEN_PASSWORD','FRS123');

define('LISA_CUSTOMER_APPLICATION_PFX','LISA1');

define('CFTM_ID_ADDRESS_PROOF', FCPATH . 'maturity_docs/');


define('CUSTOMER_XML_PATH', FCPATH . 'assets/customers/xml');
define('CUSTOMER_PDF_PATH', FCPATH . 'assets/customers/pdf');
define('WORLD_PAY_LISA_REFER_URL', 'lisa/confirmation?');

define("MSG_INVALID_DATE","Day you have selected is not valid for the month and year.");

define('MIN_YEARS_DOB',14539);
define('MAX_YEARS_DOB',14600);
define('MAX_DOB_WARNING_MESSAGE_LISA',"As funds must reach your Lifetime ISA before your 40th birthday, although you can set up a monthly Direct Debit, you must also make a lump sum payment within this application, as it may take longer for your first Direct Debit payment to reach your plan. For new applicants close to their birthday, we accept an initial lump sum payment from &pound;50 rather than the usual &pound;500. You can make just a lump sum payment if you prefer.  If you would like more information we'd be happy to help, please call us on 0800 988 2418.");
define('MAX_DOB_LUMPSUM_MESSAGE_LISA',"Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;50 rather than the usual &pound;500.");

define('LISA_MONTHLY_MIN_AMOUNT',50);//Amount in Pound
define('LISA_MONTHLY_MAX_AMOUNT',333);//Amount in Pound



define('LISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS',500);//Amount in Pound
define('LISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS',4000);//Amount in Pound
define('LISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS',50);//Amount in Pound
define('LISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS',4000);//Amount in Pound
define('LISA_ADMIN_EMAIL_BODY_CONTENT','A new Lifetime ISA application has been received via the website. Please follow the links below to see the PDF details');
define('LISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',250);//Amount in Pound
define('LISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',4000);//Amount in Pound


define('SSISA_CUSTOMER_APPLICATION_PFX','SSISA1');

define('WORLD_PAY_SSISA_REFER_URL', 'ssisa/confirmation?');

define('MAX_DOB_WARNING_MESSAGE_SSISA',"As funds must reach your Stocks & Shares ISA before your 40th birthday, although you can set up a monthly Direct Debit, you must also make a lump sum payment within this application, as it may take longer for your first Direct Debit payment to reach your plan. For new applicants close to their birthday, we accept an initial lump sum payment from &pound;50 rather than the usual &pound;500. You can make just a lump sum payment if you prefer.  If you would like more information we'd be happy to help, please call us on 0800 988 2418.");
define('MAX_DOB_LUMPSUM_MESSAGE_SSISA',"Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;50 rather than the usual &pound;500.");

define('SSISA_MONTHLY_MIN_AMOUNT',50);//Amount in Pound
define('SSISA_MONTHLY_MAX_AMOUNT',1666);//Amount in Pound



define('SSISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS',500);//Amount in Pound
define('SSISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS',20000);//Amount in Pound
define('SSISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS',50);//Amount in Pound
define('SSISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS',500);//Amount in Pound
define('SSISA_ADMIN_EMAIL_BODY_CONTENT','A new Stocks & Shares ISA application has been received via the website. Please follow the links below to see the PDF details');
define('SSISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',250);//Amount in Pound
define('SSISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',20000);//Amount in Pound


define('JISA_CUSTOMER_APPLICATION_PFX','JISA1');

define('WORLD_PAY_JISA_REFER_URL', 'jisa/confirmation?');

define('MAX_DOB_WARNING_MESSAGE_JISA',"As funds must reach your Junior ISA before your 40th birthday, although you can set up a monthly Direct Debit, you must also make a lump sum payment within this application, as it may take longer for your first Direct Debit payment to reach your plan. For new applicants close to their birthday, we accept an initial lump sum payment from &pound;50 rather than the usual &pound;500. You can make just a lump sum payment if you prefer.  If you would like more information we'd be happy to help, please call us on 0800 988 2418.");
define('MAX_DOB_LUMPSUM_MESSAGE_JISA',"Because you are approaching the cut-off age for this product, you are eligible to make a payment from &pound;50 rather than the usual &pound;500.");

define('JISA_MONTHLY_MIN_AMOUNT',50);//Amount in Pound
define('JISA_MONTHLY_MAX_AMOUNT',750);//Amount in Pound



define('JISA_MIN_LUMPSUM_AMOUNT_BELOW_YEARS',500);//Amount in Pound
define('JISA_MAX_LUMPSUM_AMOUNT_BELOW_YEARS',9000);//Amount in Pound
define('JISA_MIN_LUMPSUM_AMOUNT_ABOVE_YEARS',50);//Amount in Pound
define('JISA_MAX_LUMPSUM_AMOUNT_ABOVE_YEARS',500);//Amount in Pound
define('JISA_ADMIN_EMAIL_BODY_CONTENT','A new Junior ISA application has been received via the website. Please follow the links below to see the PDF details');
define('JISA_MIN_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',250);//Amount in Pound
define('JISA_MAX_LUMPSUM_TOPUP_AMOUNT_BELOW_YEARS',9000);//Amount in Pound



define('TESP_CUSTOMER_APPLICATION_PFX','FFS1');

define('MAX_DOB_WARNING_MESSAGE_TESP',"As funds must reach your Tax Exempt Savings Plan ISA before your 40th birthday, although you can set up a monthly Direct Debit, as it may take longer for your first Direct Debit payment to reach your plan. If you would like more information we'd be happy to help, please call us on 0800 988 2418.");

define('TESP_MONTHLY_MIN_AMOUNT',25);//Amount in Pound
define('TESP_ADMIN_EMAIL_BODY_CONTENT','A new TESP application has been received via the website. Please follow the links below to see the PDF details');



define('CTESP_CUSTOMER_APPLICATION_PFX','FFS1');

define('MAX_DOB_WARNING_MESSAGE_CTESP',"As funds must reach your Child Tax Exempt Savings Plan ISA before your 40th birthday, although you can set up a monthly Direct Debit, as it may take longer for your first Direct Debit payment to reach your plan. If you would like more information we'd be happy to help, please call us on 0800 988 2418.");

define('CTESP_MONTHLY_MIN_AMOUNT',25);//Amount in Pound
define('CTESP_ADMIN_EMAIL_BODY_CONTENT','A new CTESP application has been received via the website. Please follow the links below to see the PDF details');

define('ADMIN_EMAIL_CTFM','kanchan@sigam.co.uk');//newbusinessemailgroup@forestersfriendlysociety.co.uk
define('CTFM_CUSTOMER_APPLICATION_PFX','CTFM1');
define('CTFM_ADMIN_EMAIL_BODY_CONTENT','A new Child Trust Fund Maturity Choices form has been received via the website. Please follow the link below to see the PDF details');


define('BOND_CUSTOMER_APPLICATION_PFX','FFS1');
define('BOND_MIN_LUMPSUM_AMOUNT',5000);//Amount in Pound
define('BOND_MAX_LUMPSUM_AMOUNT',150000);//Amount in Pound
define('WORLD_PAY_BOND_REFER_URL', 'bond/confirmation?');

define('BOND_ADMIN_EMAIL_BODY_CONTENT','A new monthly contribution Investment Bond application has been received via the website. Please follow the link below to see the PDF details:');


define('FCTF_CUSTOMER_APPLICATION_PFX','FFS1');
define('FCTF_MONTHLY_MIN_AMOUNT',5);//Amount in Pound
define('FCTF_MONTHLY_MAX_AMOUNT',750);//Amount in Pound
define('FCTF_MIN_LUMPSUM_AMOUNT',50);//Amount in Pound
define('FCTF_MAX_LUMPSUM_AMOUNT',9000);//Amount in Pound
define('WORLD_PAY_FCTF_REFER_URL', 'fctf/confirmation?');
define('FCTF_ADMIN_EMAIL_BODY_CONTENT','A new monthly contribution a Child Trust Fund application has been received via the website. Please follow the link below to see the PDF details:');


define('OVER50_CUSTOMER_APPLICATION_PFX','FFS1');
define('WORLD_PAY_OVER50_REFER_URL', 'over50/confirmation?');

define('OVER50_ADMIN_EMAIL_BODY_CONTENT','A new Over 50s Life Cover application has been received via the website. Please follow the link below to see the PDF details:');



define('MEMBERSHIP_CUSTOMER_APPLICATION_PFX','FFS1');
define('WORLD_PAY_MEMBERSHIP_REFER_URL', 'membership/confirmation?');
define('MEMBERSHIP_TERMS_FEE',25);

define('MEMBERSHIP_ADMIN_EMAIL_BODY_CONTENT','A new Membership application has been received via the website. Please follow the link below to see the PDF details:');




//POIS 
define('POIS_SIP_CUSTOMER_APPLICATION_PFX','POIS1');
define('POIS_SIP_MONTHLY_MIN_AMOUNT',26);//Amount in Pound
define('POIS_SIP_MONTHLY_MAX_AMOUNT',260);//Amount in Pound
define('POIS_SIP_ADMIN_EMAIL_BODY_CONTENT','A new POIS SIP application has been received via the website. Please follow the link below to see the PDF details:');


define('POIS_TESP_CUSTOMER_APPLICATION_PFX','POIS1');
define('POIS_TESP_MONTHLY_AMOUNT',25);//Amount in Pound
define('POIS_TESP_ADMIN_EMAIL_BODY_CONTENT','A new POIS TESP application has been received via the website. Please follow the link below to see the PDF details:');

include_once(APPPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'customer_constant.php');