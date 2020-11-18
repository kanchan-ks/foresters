<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Converts an array to an std Object
 *
 * @param       array   Array to be converted
 * @return      object  Convert object
 */
function array_to_object($array) {
    if (is_array($array)) {
        /*
		 * Return array converted to object
		 * Using __FUNCTION__ (Magic constant)
		 * for recursive call
		 */
        return (object) array_map(__FUNCTION__, $array);
    }
    else {
        // Return object
        return $array;
    }
}

/**
 * Converts and std Object to array
 *
 * @param       object  Input std object to be converted
 * @return      Array   Converted Array
 */
function object_to_array($object) {
    if (is_object($object)) {
        $object = get_object_vars($object);
    }

    if (is_array($object)) {
        return array_map(__FUNCTION__, $object);
    }
    else {
        return $object;
    }
}

/**
 * Format a given date to a desired format
 *
 * @param       date    the date to be converted
 * @param       string  the desired format to be displayed, default "d-M-y"
 * @param       string  default value when it's not a valid date provided date is empty
 * @return      string  formatted datetime string
 */
function format_date($dt, $val = "-",$format = 'd-M-y H:i') {
    if(empty($dt))
        $dt = date("d-M-y");

    $tmpdt = strtotime($dt);
    if ($tmpdt <= 1000) {
        $newdt = $val;
    } else {
        $newdt = date($format, $tmpdt);
    }
    return $newdt;
}

/**
 * Encrypt and decrypt a string with AES encryption
 *
 * @param      string  "e" for encryption or "d for decryption
 * @param      string  value to be encrypted and decryptied
 * @return     string  returns the encrypted or decrpted value
 */
function ed($action, $value) {
    $output = false;
    $ci= &get_instance();
    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = $secret_iv = config_item('encryption_key');
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will
    // get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if ($action == 'e') {
        $output = openssl_encrypt($value, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'd') {
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

/**
 * Check the user session and take to the login screen if blank
 *
 * @param      int      level of secrutiy to be checked 1=user,2=admin
 * @return
 */
function security_check($level=1,$page='all') {
    $ci= &get_instance();
    if($level==1) {
        if($ci->session->userdata('ULG')==null) {
            check_ajax_session();

			set_session('return_url',current_url());
            redirect(base_url('users/login'));
        } else {
			$method = $ci->router->fetch_method();
			$stage = get_session('setup_stage');
			if((get_session('CompanyProfile')=='AWAITING_SETUP' || get_session('CompanyProfile')=='AWAITING_PAYMENT')
				&& !in_array($method,config_item('setup_allowed_pages'))) {
				if($stage=='incidentactivate') {
					$link = get_session('setup_incident_link');
					redirect($link,'auto',301);
				} else {
					redirect(href('company/getstarted/'.$stage));
				}
			}
		}
    } else if($level==2) {
        if($ci->session->userdata('ADMIN_USR')==null) {
            check_ajax_session();
            redirect(base_url('users/login'));
        }
    }
    if($page!='all') {
        if(!has_access('MENU',$page)) {
            show_404();
        }
    }
}

/**
 * Summary of check_ajax_session
 */
function check_ajax_session() {
    $ci= &get_instance();
    if($ci->input->is_ajax_request()) {
        echo json_encode(array('status'=>false,'type'=>'error','title'=>lang('SESSION_TERMINATED_TITLE'),'msg'=>lang('SESSION_TERMINATED_MESSAGE'),'loc'=>href('users/login')));
        exit;
    }
}

/**
 * Create a database compatible date format for insert and compare
 *
 * @param      datetime Date string or blank
 * @return     string converted datetime string
 */
function db_date($date=false) {
    if(!$date || empty($date)) {
        return date('Y-m-d H:i:s');
    }
    return date('Y-m-d H:i:s',strtotime($date));
}

function unixdate($date) {
    return strtotime($date);
}

function get_days($startDt,$endDate=false) {
    if(!$endDate)
        $endDate = time();

    $datediff = time() - strtotime($startDt);
    $daysElapsed = floor($datediff / (60 * 60 * 24));
    return $daysElapsed;
}



/**
 * Generates a unique GUID id.
 *
 * @param
 * @return     string unique guid string
 */
function guid() {
    if (function_exists('com_create_guid')) {
        return strtolower(trim(com_create_guid(), '{}'));
    } else {
        mt_srand((double)microtime() * 10000);
        $charid = md5(uniqid(rand(), true));
        $hyphen = chr(45);
        $uuid = substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
        return  strtolower(trim($uuid, '{}'));
    }
}

/**
 * Summary of validate_guid
 * @param mixed $guid
 * @return integer
 */
function validate_guid($guid) {
    $ci= &get_instance();
    if(!preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $guid)) {
        $ci->form_validation->set_message('validate_guid', lang('form_validation_guid'));
		return false;
	} else {
		return true;
	}
}

/**
 * Create array object for the select dropdown with key and value
 *
 * @param      array data list to populate the options
 * @param      string default option on the top with 0 value
 * @param      mixed array or the key for the value field array('key1', 'key2')
 * @param      string array key for the value field
 * @param      string value field seprator if array provided
 * @param      boolean true if values to be encrypted
 * @return     array list of option to bind with the select dropdown
 */
function select_array($arr, $def=false, $lbl='Name',$val='ID',$sep=', ',$enc=false) {
    $retArr = array();
    if($def) {
        $retArr[] = $def;
    }

	if(is_array($arr) && isset($arr[0])) {
        if(!is_array($arr[0]))
            $arr = object_to_array($arr);

        foreach($arr as $v) {
            $newlbl = '';
            if(is_array($lbl)) {
                foreach($lbl as $d) {
                    $newlbl .= $v[$d].$sep;
                }
            } else {
                $newlbl = $v[$lbl];
            }
            if($enc) {
                $retArr[ed('e',$v[$val])] = $newlbl;
            } else {
                $retArr[$v[$val]] = $newlbl;
            }
        }
    }
    return $retArr;
}

/**
 * Get image absolute web URL
 *
 * @param      string   absolute path of the image
 * @param      string   type of image
 * @return     string   http formatted url of the image
 */
function get_img($path, $type='p') {
    if(file_exists(FCPATH.$path) && !empty($path)) {
        return base_url($path);
    } else {
        return base_url(DEFAULT_PROD_IMG);
    }
}

/**
 * Get all value of a single key from an array
 *
 * @param      array   Input array to loop
 * @param      string   key to fetch the values
 * @return     array   array of extracted key values
 */
function get_values_by_key($arr, $key) {
    $newArray = array();
    if(is_object($arr)) {
        foreach ($arr as $k => $v) {
            if($k==$key)
                return $v;

            if(isset($v->{$key}))
                $newArray[] = $v->{$key};
        }
    } else if(is_array($arr)) {
        foreach ($arr as $k => $v) {
            if($k==$key)
                return $v;
            if(is_array($v)) {
                if(isset($v[$key]))
                    $newArray[] = $v[$key];
            } else {
                if(isset($v->{$key}))
                    $newArray[] = $v->{$key};
            }

        }
    }
    return $newArray;
}

/**
 * Return the time elapsed between two dates with years, months,
 * days, hour, minutes and seconds delimnator
 *
 * @param      string   Start date
 * @param      string   End date
 * @param      int        Limit the delimators upto the precision e.g. 2 will only get the result upto minutes
 * @return     string     comma deliminated string with the time elapsed
 */
function time_elapsed($time1, $time2, $precision = 6,$translated=true) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2 then swap time1 and time2
    if ($time1 > $time2) {
        if (($time1 - $time2) > 60) {
            if(empty($time2)) {
                return "-";
            } else {
				if(!$translated)
					return $time2-$time1;

				return "5 sec";
            }
        }
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
    }

	if(!$translated)
		return $time2-$time1;

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');

    $rplintervals = array('yr','mnth','day','hr','min','sec');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            // Create new temp time from time1 and interval
            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
        }

        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . str_replace($intervals, $rplintervals, $interval);
            $count++;
        }
    }

    return implode(", ", $times);
}



/**
 * Get full URL of the Crises control web api method
 *
 * @param    string	Object data of the post
 * @return   mixed	Return the post data from the web object
 */
function get_post($key=false,$default="",$xssclean=true,$method='post') {
    $ci= &get_instance();
    if($key!=null && !empty($key))
        if($ci->input->{$method}($key)!='') {
            if(is_array($ci->input->{$method}($key,$xssclean))) {
                return $ci->input->{$method}($key,$xssclean);
            } else {
                return trim($ci->input->{$method}($key,$xssclean));
            }
        } else {
            return $default;
        }
    else
        return $ci->input->{$method}(null,$xssclean);
}

/**
 * Get full URL of the Crises control web api method
 *
 * @return   object   Return the post data from the web object
 */
function getDevice() {
    $deviceInfo = array();

    $ci= &get_instance();
    $ci->load->library('user_agent');

    $device = "unknown";
    if ($ci->agent->is_browser()) {
        $device = "Desktop";
    } elseif ($ci->agent->is_robot()) {
        $device = "Robot";
    } elseif ($ci->agent->is_mobile()) {
        $device = "Mobile";
    }
    $deviceInfo['browser'] = $ci->agent->browser();
    $deviceInfo['device'] = $device;
    $deviceInfo['os'] = $ci->agent->platform();;
    $deviceInfo['lang'] = $ci->agent->languages;

    return $deviceInfo;
}

/**
 * Get the first element from the provided array
 *
 * @param    array   Array, list of elements
 * @return   object  Return first element of the array
 */

function get_first_elem($array) {
    if(is_array($array)) {
        if(isset($array[0])) {
            return $array[0];
        } else {
            return $array;
        }
    } else {
        return $array;
    }
}


/**
 * Builts the absolute link of the page with encrpted identity value
 *
 * @param    string  page relative url
 * @param    mixed string to be encrpted
 * @return   object  Return first element of the array
 */
function href($page, $query="") {
    $link = base_url($page);
    if(empty($query))
        return $link;

    if(is_array($query)) {
        $link = $link.'?'.http_build_query($query, NULL, '&');
    } else {
        $link = base_url($page.'/'.ed('e',$query));
    }
    return $link;
}

/**
 * Builts the absolute link of the page with encrpted identity value
 *
 * @param    string  session key
 * @param    mixed session value as anything
 * @param    int session expiration in seconds
 * @return
 */
function set_session($key,$val='', $expires=NO_EXPIRE) {
    $ci= &get_instance();
	if(is_array($key)) {
		$ci->session->set_userdata($key);
	} else {
		$ci->session->set_userdata($key,$val,$expires);
	}
}

/**
 * Get the values from the session store by user
 *
 * @param    string  session key
 * @return   mixed  return the content of the session
 */
function get_session($key) {
    $ci= &get_instance();
    return $ci->session->userdata($key);
}

/**
 * Delete the specific session data by providing the key
 *
 * @param    string  session key
 * @return
 */
function unset_session($key) {
    $ci= &get_instance();
    return $ci->session->unset_userdata($key);
}


/**
 * Log application errors and report it to the email address
 *
 * @param   mixed   Exception object or the error message
 * @param   string  Controller name where the error has occured
 * @param   string  Method name where there error has occured
 */

function log_error($emMessage, $controller="unknown", $method="index") {

}


/**
 * Get the array element by searching with the key and value;
 * @param mixed $data
 * @param string $key
 * @param string $value
 * @return mixed
 */
function get_element_by_value($data,$key,$value) {
    if(!is_array($data))
        $data = object_to_array($data);

    if(isset($data[0])) {
        if(!is_array($data[0])) {
            $data = object_to_array($data);
        }
    }
	foreach($data as $v) {
		if(isset($v[$key]))
			if($v[$key] == $value) return $v;
    }
	return null;
}


/**
 * Get all elements of an array matching the key and value
 * @param mixed $arr
 * @param mixed $key
 * @param mixed $val
 * @return array
 */
function value_intersact($arr, $key, $val) {
    if(!is_array($arr))
        $arr = object_to_array($arr);

    if(isset($arr[0])) {
        if(!is_array($arr[0])) {
            $arr = object_to_array($arr);
        }
    }
    $newarr = array();
    if(is_array($arr)) {
        foreach($arr as $v) {
			if(is_array($val)) {
				if(in_array(strtoupper($v[$key]),array_map('strtoupper',$val)))
					$newarr[] = $v;
			} else {
				if(strtoupper($v[$key])==strtoupper($val))
					$newarr[] = $v;
			}
        }
    }
    return $newarr;
}


/**
 * Summary of set_cache
 * @param string $key
 * @param mixed $data
 * @param int $expire
 */
function set_cache($key,$data,$expire=ONE_HOUR) {
    try{
        $ci= &get_instance();
		if(isset($data->Message) && isset($data->ErrorId)) {
			if(!in_array($data->ErrorId,array(104,141,142,107,145,105))) {
				$ci->cache->file->save($key,$data,$expire);
			}
		} else {
			$ci->cache->file->save($key,$data,$expire);
		}
    }
    catch (Exception $exception) {
    }
}


/**
 * Summary of get_cache
 * @param string Unique identifier for the saved cache
 */
function get_cache($key) {
    try {
        $ci= &get_instance();
        return $ci->cache->file->get($key);
    }
    catch (Exception $exception) {
        return null;
    }
}

/**
 * Summary of delete_cache
 * @param string $cache_key
 * @return mixed
 */
function delete_cache($cache_key) {
    try {
        $ci= &get_instance();
        $ci->cache->file->delete($cache_key);
        return true;
    }
    catch (Exception $exception) {
        return false;
    }
}

/**
 * Summary of input_field
 * @param mixed $name
 * @param mixed $type
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function input_field($name,$type='text',$value="",$extra=false, $maxlength=250) {
    if(!isset($extra['class'])) {
        $extra['class'] = 'form-control';
    } else {
        $extra['class'] = $extra['class']. ' form-control';
    }

    if(!isset($extra['id']))
        $extra['id'] = $name;

    if($type!="hidden")
        $extra['maxlength'] = $maxlength;

    return form_input(array('name'=>$name,'type'=>$type),set_value($name,$value,false),$extra);
}

/**
 * Summary of label
 * @param mixed $text
 * @param mixed $for
 * @param mixed $extra
 * @param mixed $req
 * @param mixed $helptext
 * @return mixed
 */
function label($text, $for, $extra=false, $req=false, $helptext=false) {
    if(!$extra || empty($extra))
        if(!isset($extra['class'])) {
            $extra['class'] = 'setformlabel';
        } else {
            $extra['class'] = $extra['class']. ' setformlabel';
        }

    if($req)
        $text .= '<span class="star">*</span>';

    if(!empty($helptext))
        $text .= '&nbsp; <i data-toggle="tooltip" class="text-success fa fa-question-circle" data-original-title="'.$helptext.'"></i>';

    $label = form_label($text, $for, $extra);

    return $label;
}

/**
 * Summary of select
 * @param mixed $name
 * @param mixed $options
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function select($name,$options,$value='',$extra='') {
    if(!isset($extra['id']))
        $extra['id'] = $name;
    return form_dropdown($name,$options,$value,$extra);
}

/**
 * Summary of multiselect
 * @param mixed $name
 * @param mixed $options
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function multiselect($name,$options,$value='',$extra='') {
    if(!isset($extra['id']))
        $extra['id'] = preg_replace("/\[.*\]/",'',$name);

	if(isset($extra['placeholder']))
		$extra['data-placeholder'] = $extra['placeholder'];

	$extra['data-close-on-select'] = 'false';

    return form_multiselect($name,$options,$value,$extra);
}

/**
 * Summary of textarea
 * @param mixed $name
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function textarea($name,$value='',$extra='',$maxlength=250) {
    if(!isset($extra['cols']))
        $extra['cols'] = '80';

    if(!isset($extra['rows']))
        $extra['rows'] = '4';

    if(!isset($extra['class'])) {
        $extra['class'] = 'form-control';
    } else {
        $extra['class'] = $extra['class']. ' form-control';
    }

	if(!isset($extra['id']))
        $extra['id'] = $name;

    $extra['maxlength'] = $maxlength;

    return form_textarea($extra,$value,array('name'=>$name));
}

/**
 * Summary of button
 * @param mixed $name
 * @param mixed $type
 * @param mixed $value
 * @param mixed $extra
 * @param mixed $helptext
 * @return mixed
 */
function button($name,$type='button',$value='Submit',$extra='',$helptext='') {
    if(!isset($extra['class'])) {
        $extra['class'] = 'btn btn-default';
    } else {
        $extra['class'] = 'btn '. $extra['class'];
    }

    if(!empty($helptext)) {
        $value = '<span>'.$value.'</span>';
        $extra['data-original-title'] = $helptext;
        //$extra['data-delay'] = '{\""show\"": \""600\"", \""hide\"":\""0\""}';
        $extra['data-toggle'] = 'tooltip';
    }
    return form_button(array('name'=>$name,'id'=>$name,'type'=>$type),$value,$extra);
}

/**
 * Summary of Radio button
 * @param mixed $name
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function radio($name, $value='', $datavalue, $label_text, $extra='') {
    if(!isset($extra['class'])) {
        $extra['class'] = 'form-control radio';
    } else {
        $extra['class'] = $extra['class']. ' form-control radio';
    }

    if(!isset($extra['id']))
        $extra['id'] = $name;

    $extra['name'] = $name;

    $check = ($datavalue==$value);

    return form_radio($extra, $value, $check, set_radio($name,$datavalue)).form_label($label_text,$extra['id']);
}


/**
 * Summary of Radio button
 * @param mixed $name
 * @param mixed $value
 * @param mixed $extra
 * @return mixed
 */
function checkbox($name,$value='',$datavalue, $label_text, $extra='') {
    if(!isset($extra['class'])) {
        $extra['class'] = 'control checkbox';
    } else {
        $extra['class'] = $extra['class']. ' control checkbox';
    }

    if(!isset($extra['id']))
        $extra['id'] = $name;

    $extra['name'] = $name;

    $check = ($datavalue==$value);

    return form_checkbox($extra, $value, $check, set_checkbox($name,$datavalue)).form_label($label_text,$extra['id']);
}

/**
 * Summary of get_severity
 * @return string[]
 */
function get_severity() {
    return array(''=>lang('SELECT_SEVERITY_DEFAULT'),'1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5');
}

/**
 * Check if physical file exist and not the path only
 * @param string $filePath
 * @return bool
 */
function is_file_exists($filePath) {
    return is_file($filePath) && file_exists($filePath);
}

/**
 * Checks for empty string or zero value
 * @param mixed Send the string, or integer or array to check
 * @return boolean
 */
function zempty($value) {
    if(empty(trim($value)))
        return true;
    if(trim($value)===0 || trim($value)=='0')
        return true;

    return false;
}

/**
 * Summary of week_days_list
 * @return string[]
 */
function week_days_list() {
    return array('1'=>lang('WEEK_SORT_MONDAY'),'2'=>lang('WEEK_SORT_TUESDAY'),'3'=>lang('WEEK_SORT_WEDNESDAY'),'4'=>lang('WEEK_SORT_THURSDAY'),'5'=>lang('WEEK_SORT_FRIDAY'),'6'=>lang('WEEK_SORT_SATURDAY'),'7'=>lang('WEEK_SORT_SUNDAY'));
}

/**
 * Summary of getSchedulerTimeFormat
 * @return string[]
 */
function getSchedulerTimeFormat() {
    return array('Minute'=>lang('SCHEDULER_MINUTES'),'Hour'=>lang('SCHEDULER_HOURS'));
}

/**
 * Summary of get_size
 * @param mixed $size
 * @return string
 */
function get_size($size) {
    $size = $size * 1024;
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power)) . $units[$power];
}

/**
 * Summary of validate_other_names
 * @param mixed $input
 * @return boolean
 */
function validate_other_names($input) {
    $ci= &get_instance();
    if(!preg_match("/^[0-9a-zA-ZÀ-úÀ-ÿ\s'@*+,\n\r\t.#_()\/\]\[&-]*$/", $input)) {
        $ci->form_validation->set_message('validate_other_names', lang('form_validation_validate_other_names'));
        return false;
    } else {
        return true;
    }
}

/**
 * Summary of validate_user_names
 * @param mixed $input
 * @return boolean
 */
function validate_user_names($input) {
    $ci= &get_instance();
    if (preg_match("/^[a-zÀ-úÀ-ÿ'\s.\-]*$/i", $input)) {
        $ci->form_validation->set_message('validate_other_names', lang('form_validation_validate_user_names'));
        return true;
    } else {
        return false;
    }
}

/**
 * Summary of buildTree
 * @param mixed $elements
 * @param mixed $parentId
 * @return array
 */
function buildTree($elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['ParentID'] == $parentId) {
            $children = buildTree($elements, $element['SecurityObjectID']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

/**
 * Summary of build_tree
 * @param mixed $objName
 * @param mixed $array
 * @param mixed Selected options
 * @param mixed $parentkey
 * @param mixed $label
 * @param mixed $val
 * @return mixed
 */
function build_tree($objName, $array, $values, $parentkey, $label, $val) {
    $branch = buildTree($array);
    $mainUl = '<ul id="' . $objName . '">' . "\n";
    $mainUl .= echo_menu($branch, $label, $val,$values);
    $mainUl .= '</ul>' . "\n";
    return $mainUl;
}

/**
 * Summary of echo_menu
 * @param mixed $menu_array
 * @param mixed $label
 * @param mixed $val
 * @param mixed Pre selected values
 * @return mixed
 */
function echo_menu($menu_array, $label, $val, $values) {
    $output = '';
    foreach ($menu_array as $item) {
        $output .= '<li><div class="checkbox check-success"><input type="checkbox" name="GroupItms[]"';

        if(in_array($item[$val],$values)) {
            $output .= ' checked="checked"';
        }

        $output .= ' value="' . $item[$val] . '" id="checkbox' . $item[$val] . '" />
                <label for="checkbox' . $item[$val] . '">' . lang($item[$label]) . '</label>
            </div>' . "\n";
        //see if this menu has children
        if (array_key_exists('children', $item)) {
            $output .= '<ul>' . "\n";
            $output .= echo_menu($item['children'], $label, $val,$values);
            $output .= '</ul>' . "\n";
        }
        $output .= '</li>' . "\n";
    }
    return $output;
}

/**
 * Summary of file_types
 * @param mixed $values
 * @return mixed
 */
function file_types($values) {
    $values = implode(',', @explode('|',$values));
    return preg_replace('/,([^,]*)$/', ' & \1', $values);
}

/**
 * Summary of generate_password
 * @param mixed $length
 * @param mixed $add_dashes
 * @param mixed $available_sets
 * @return string
 */
function generate_password($length = 8, $add_dashes = false, $available_sets = 'luds') {
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%^_*';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
	$password = str_shuffle($password);
    return $password;
}

/**
 * Summary of get_isd_list
 * @return string[]
 */
function get_isd_list() {
    $isd_list = array();
    $country_lookup= get_country_lookup();
    foreach ($country_lookup as $c) {
		if($c->Status==1)
			$isd_list['+' . $c->CountryPhoneCode] = $c->Name. ' (+'.$c->CountryPhoneCode.')';
    }
    return $isd_list;
}

/**
 * Summary of set_currency
 * @param mixed $amnt
 * @param mixed $curcode
 * @return string
 */
function set_currency($amnt, $curcode = '&pound;') {
    $ret = $curcode . '&nbsp;0.00';
    if (is_double($amnt) || is_numeric($amnt)) {
        $ret = $curcode . '&nbsp;' . number_format($amnt, 2);
    }
    return $ret;
}

/**
 * Summary of is_true
 * @param mixed $val
 * @param mixed $return_null
 * @return mixed
 */
function is_true($val, $return_null=false){
    $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );
    return ( $boolval===null && !$return_null ? false : $boolval );
}

/**
 * Summary of get_bool
 * @param mixed $val
 * @return string
 */
function get_bool($val){
	return $val ? 'true' : 'false';
}


/**
 * Summary of str_split_len
 * @param mixed $str
 * @param mixed $len
 * @return string[]
 */
function str_split_len($str, $len) {
	$str = strip_tags($str);
	$output = array();
	while (strlen($str) > $len) {
		$index = strpos($str, ' ', $len);
		$output[] = trim(substr($str, 0, $index));
		$str = substr($str, $index);
	}
	$output[] = trim($str);
	return $output;
}

/**
 * Summary of nl2nobr
 * @param mixed $str
 * @return mixed
 */
function nl2nobr($str) {
	return preg_replace("/\r\n|\r|\n/",'<br/>',$str);
}

function create_path($path) {
	if(!file_exists($path)) {
		return mkdir($path,0775,true);
	}
	return true;
}

function get_random_number($n=8)
{
	return substr(str_shuffle("0123456789"), 0, $n);
}