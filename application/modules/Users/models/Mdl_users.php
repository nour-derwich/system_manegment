<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_users extends CI_Model {

    protected $_table_name     = 'login';
    protected $_order_by       = 'id';
    protected $_primary_column = 'id';


    function __construct()
    {
        parent::__construct();
    }

    public function _this_controller_record ()
    {
        $user_type  = $this->session->userdata('user_type'); 
        $country_id = $this->session->userdata('country_id'); 
        $user_id    = $this->session->userdata('id'); 

        $this->db->where('user_type !=' ,0); 
        $this->db->where('id !=' ,$this->session->userdata('id')); 

        //  $this->db->where('id !=' ,$this->session->userdata('id')); 

        /* if($user_type == 2)
        {
        $this->db->where('created_by' ,$user_id);   

        }  */


        $this->db->order_by($this->_order_by);

        $query =  $this->db->get($this->_table_name);
        return $query->result(); 
    } 

    public function _get_single_record_byid($id)
    {
        $this->db->where($this->_primary_column ,$id);
        $this->db->order_by($this->_order_by);
        $query =  $this->db->get($this->_table_name);
        return $query->result();    
    }
    public function _get_single_record_byusername($username,$id)
    {  
        $this->db->select('id,username'); 
        $this->db->where('username' ,$username);
        $this->db->order_by($this->_order_by);
        $query =  $this->db->get($this->_table_name);
        $row   = $query->num_rows();  
        if($id != null)
        {
            $result = $query->result();
            if($row > 0)
            {
                if($result[0]->id == $id)
                {
                    return 0;
                }else
                {
                    return 1; 
                } 
            }else
            {
                return $row;
            }   
        }else
        {
            return  $row; 
        }
    }

    public function _change_user_status($id,$status)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;  
            $update =  $this->db_command($data,$id,$this->_table_name);  
            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }  
    }  

    //User Print Status
    public function _change_user_is_print($id,$status)
    {
        if($id != null)
        {
            $data['is_print'] = $status;  
            $update =  $this->db_command($data,$id,$this->_table_name);  
            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }  
    }  

	 //Get Relation Pax
    public function get_relation_pax($table,$column,$reference,$input)
    {
        $this->db->select($column);
        $this->db->where($reference,$input);
        $this->db->where('is_enable',1);
        $result =  $this->db->get($table)->result();
        return $result[0]->$column;

    }
	
    public function _delete($id)
    {
        $delete = $this->db_delete($id,$this->_table_name);
        return $delete;
    } 

    public function  get_usertype($code) {
        switch ($code) {
            case '1': return 'Super Admin';
            case '2': return 'Collection Agent';
            case '3': return 'Distribution Agent';
            case '4': return 'Collection Sub Agent';
            case '5': return 'Distribution Sub Agent';


        }
        return false;
    }  
}
?>
