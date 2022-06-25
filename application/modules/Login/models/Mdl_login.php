<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_login extends CI_Model {

    protected $_table_name = 'user';
    protected $_order_by = 'username';

    function __construct()
    {
        parent::__construct();
    }

	//Get System Info
    public function _get_system_info()
    {
        //$this->db->where('user_type' ,1);
        $query =  $this->db->get('system_setting_list');
        return $query->result();
    }
    public function loggedin() {
        return ( bool ) $this->session->userdata ( 'loggedin' );
    }
    public function logout() {
        $now = date('Y-m-d H:i:s');
        $login_info['last_logout']  = $now;
        $this->db->set($login_info);
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('login');
        $this->session->sess_destroy ();
    }
    public function hash($string) {
        return hash ( 'sha512', $string . config_item ( 'encryption_key' ) );
    }

    function get($order_by)
    {
        #  $this->db->order_by($order_by);
        $query =  $this->db->get('login');
        return $query ; 
    }
}
?>
