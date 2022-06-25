<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_myaccount extends CI_Model {

    protected $_table_name     = 'login';
    protected $_order_by       = 'id';
    protected $_primary_column = 'id';


    function __construct()
    {
        parent::__construct();
    }

    public function _this_controller_record ()
    {
        //Seller Account
        if($this->session->userdata('user_type') == 'seller')
        {

        }
        else {
            $user_type = $this->session->userdata('user_type');
            $country_id = $this->session->userdata('country_id');
            $user_id = $this->session->userdata('id');

            $this->db->where('user_type !=', 0);
            $this->db->where('id !=', $this->session->userdata('id'));
            $this->db->order_by($this->_order_by);
            $query = $this->db->get($this->_table_name);
            return $query->result();
        }
    } 

    public function _get_single_record_byid($id)
    {
        //Seller Account
        if($this->session->userdata('user_type') == 'seller')
        {
            $this->db->where('id', $id);
            $this->db->order_by('id','desc');
            $query = $this->db->get('seller_list');
            return $query->result();
        }
        else
        {
            $this->db->where($this->_primary_column, $id);
            $this->db->order_by($this->_order_by);
            $query = $this->db->get($this->_table_name);
            return $query->result();
        }
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
    //State_list
    public function state_list($country_id)
    {
        $this->db->select('id,state_name');
        $this->db->where('country_id',$country_id);
        $this->db->where('is_enable',1);
        $result =  $this->db->get('state_list')->result();
        $array = array(
            '' => 'Select State'
        );

        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->state_name;
            }
        }
        return $array;
    }

    //City List by State
    public function city_list_by_state($country_id,$state_id)
    {
        $this->db->select('id,title');
        $this->db->where('country_id',$country_id);
        $this->db->where('state_id',$state_id);
        $this->db->where('is_enable',1);
        $result =  $this->db->get('city_list')->result();
        $array = array(
            '' => 'Select City'
        );

        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array;
    }
   //check relation reference
    public function get_relation_pax($table,$column,$reference,$input)
    {
        $this->db->select($column);
        $this->db->where($reference,$input);
        $this->db->where('is_enable',1);
        $result =  $this->db->get($table)->result();
        return $result[0]->$column;

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
