<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_dashboard extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    //Get Admin Email
    public function _get_admin_email()
    {
        $this->db->where('user_type' ,1);
        $query =  $this->db->get('login');
        return $query->result();
    }
    //All User List
    public function _this_controller_record($id)
    {
        $this->db->select('*');
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
        if($this->session->userdata('user_type') == 'seller')
        {
           // $this->db->where('created_by',$this->session->userdata('id'));
            
        }
		$this->db->where('user_type','user');
        $this->db->order_by('id','desc');
        $query =  $this->db->get('user_list');
        return $query->result();
    }

    //All Order List
    public function _this_order_record($id)
    {
        $this->db->select('*');
        if($id > 0)
        {
            $this->db->where('user_id',$id);
        }
        if($this->session->userdata('user_type') == 'seller')
        {
            $this->db->where('seller_id',$this->session->userdata('id'));
           // $this->db->where('user_type','order');
        }
        $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('order_list');
        return $query->result();
    }

}
?>
