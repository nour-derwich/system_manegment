<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_report extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->module('Hierarchy');
    }


	//All CArt List
    public function _this_cart_record($id)
    {
        $this->db->select('*');
        if($id != "")
        {
            $this->db->where('order_code',$id);
        }
        $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('cart_list');
        return $query->result();
    }
	
	
	
    //Check Relation list exit
    public function get_exist_relation($rel_to,$rel_with,$rel_type)
    {
        $this->db->select('*'); 
        $this->db->from('relation_list');
        $this->db->where('zimadar_id',$this->session->userdata('id'));
        $this->db->where('relation_to',$rel_to);
        $this->db->where('relation_with',$rel_with);
        $this->db->where('relation_type',$rel_type);
        return $this->db->get()->result();
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


    //Check Already data exit
    public function check_already_exists($column,$value,$table)
    {
        $this->db->select('id'); 
        $this->db->where($column,$value); 
        $query =  $this->db->get($table);
        $count = $query->num_rows();
        return $count;
    }

    //Check Already Exit Data multiple
    public function check_already_exists_multiple($table,$get_column,$wheres,$type)
    {
        $this->db->select($get_column);

        foreach($wheres as $key_wh => $wh):
            $this->db->where($key_wh,$wh);
            endforeach;

        $query =  $this->db->get($table);   
        if($type == 1)
        {
            $count  = $query->num_rows();
            $return = $count;
        }
        if($type == 2)
        {
            $Q_result  = $query->result();
            $return = $Q_result;
        }
        if($type == 3)
        {
            $Q_result_array  = $query->result_array();
            $return = $Q_result_array;
        }
        if($type == 4)
        {

            $count  = $query->num_rows();
            $return = $count;

            $Q_result  = $query->result();
            $return = $Q_result;

            $Q_result_array  = $query->result_array();
            $return = $Q_result_array;


            $return = array();
            $return['1']['count'] = $count;
            $return['2']['Query_result'] = $Q_result;
            $return['3']['Query_result_array'] = $Q_result_array;

        }
        return $return;

    }


    public function _change_user_status($id,$status)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;  
            $update =  $this->db_command($data,$id,'ulama_list');  
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
        $delete = $this->db_delete($id,'relation_list');
        return $delete;
    }   
}
?>
