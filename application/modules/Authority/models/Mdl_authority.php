<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_authority extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->module('Hierarchy');
    }

    //Get Admin Email
    public function _get_admin_email()
    {
        $this->db->where('user_type' ,1);
        $query =  $this->db->get('login');
        return $query->result();
    }
    
	//Get Authority list
	public function _get_authority_list($id)
    {
        $this->db->select('*');
        $this->db->from('authority_list');
        $result = $this->db->get()->result();
		return $result;
    }
	//Get Client Record By Client Record Id
	public function _get_authority_record_byid($id)
    {
		
        $this->db->select('*');
        $this->db->from('authority_list');
		  $this->db->where('id',$id);
		$result = $this->db->get()->row();
		return $result;
	}
	
}
?>
