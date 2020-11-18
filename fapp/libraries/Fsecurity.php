<?php
/**
 * @version 1.0
 * @author Kanchan Sinha
 */
class Bbsecurity
{
    protected $_ci;
    protected $securityObs;
    protected $URoles;
    function __construct($items = '')
    {
        $this->_ci = & get_instance();
        if(get_session('secitems')!=null) {
            $this->securityObs = get_session('secitems');
        }
    }
    public function hasAccess($mtype, $param) {
        if (isset($this -> securityObs[$mtype][$param])) {
            if (strtoupper(get_session('ULG')->UserRole) == 'ADMIN') {
                return true;
            } else if ($this -> securityObs[$mtype][$param] === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function Labels($key) {
        if (isset($this -> securityObs['Labels'][$key])) {
            return $this -> securityObs['Labels'][$key];
        } else {
            return "-";
        }
    }

    public function hasRole($roles) {
        $ret = false;
        if(get_session('secitems')!=null) {
            $userRole = get_session('UserRole');
            if(is_array($roles)) {
                if(in_array(strtolower($userRole),array_map('strtolower',$roles)))
                    $ret =  true;
            } else {
               if(strtolower($userRole) == strtolower($roles))
                   $ret =  true;
            }
        }
        return $ret;
    }

}
