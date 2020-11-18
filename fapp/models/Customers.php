
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Customer_model
 *
 * @package Group
 */

class Customers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

   function insert_customer($params)
   {
		$this->db->set($params);
		$this->db->insert('frs_ctf_data');
		return $this->db->insert_id();
   }
   
   function insert_customer_details($params)
   {
		$this->db->set($params);
		$this->db->insert('frs_ctf_customer');
		return $this->db->insert_id();
   }
   
 
   function update_customer($params)
   {
		$where="";
        if(isset($params['id'])){
            $where = array('id'=>$params['id']);
        }
        $this->db->where($where);
        $this->db->update('frs_ctf_data',$params);
		
		return true;
   }
   
  
   function get_customer($params,$limitone=false)
   {
		$query = $this->db->select("*")
							->from('frs_ctf_data')
							->where($params)->get();
							
		if($query->num_rows()>0) {
			if($limitone) {
				$customers_list = $query->first_row();
			} else {
				$customers_list = $query->result();
			}
		}else{
			return false;
		}
		
     return $customers_list;
      
    }
	
	function get_customer_data($params,$limitone=false)
	{
		$query = $this->db->select("*")
			->from('frs_ctf_customer')
			->where($params)->get();
		if($query->num_rows()>0) {
			if($limitone) {
				$customers_list = $query->first_row();
			} else {
				$customers_list = $query->result();
			}
		}else{
			return false;
		}
		
		return $customers_list;
	
	}
	
	function update_customer_details($params)
	{
		$where="";
		if(isset($params['id'])){
			$where = array('id'=>$params['id']);
		}
		$this->db->where($where);
		$this->db->update('frs_ctf_customer',$params);
	//	/echo $this->db->last_query();
		///die;
		return true;
	}

}

?>