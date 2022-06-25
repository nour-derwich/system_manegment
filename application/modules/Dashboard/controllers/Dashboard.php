<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller  {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    * 		http://example.com/index.php/welcome
    *	- or -
    * 		http://example.com/index.php/welcome/index
    *	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see https://codeigniter.com/user_guide/general/urls.html
    */
    public $admin_email = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_dashboard');
        $this->load->library('email');
        Modules::run('Login/_login');
    }

    public function index()
    {
        
        if($this->session->userdata('admin_status') == 0 && $this->session->userdata('user_type') == 'seller')
        {
            $this->admin_email = $this->Mdl_dashboard->_get_admin_email();
            $data['result_set_user'] = $this->Mdl_dashboard->_this_controller_record();
            $data['result_set_order'] = $this->Mdl_dashboard->_this_order_record();

            $data['content']  = 'Dashboard/dashboard';
            $this->load->view('Template/seller_template',$data);

        }
        else
        {
            $data['result_set_user'] = $this->Mdl_dashboard->_this_controller_record();
            $data['result_set_order'] = $this->Mdl_dashboard->_this_order_record();

            $data['content']  = 'Dashboard/dashboard';
            $this->load->view('Template/template',$data);

        } 

    }

	
    public function  seller_resend_email()
    {
        //print_r($this->session->userdata());

        //Admin Email Generate
        $from_email1 = $this->session->userdata('email');
        $to_email1 = $this->admin_email[0]->email;
        //Load email library
        $get_link1 = base_url()."admin";
        $msg1 = "Dear Admin Seller Registration Account at Online Shopping";
        $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view account detail.<br/>Thank you";
        $this->email->from($from_email1, 'Online Shopping');
        $this->email->to($to_email1);
        $this->email->subject('Seller Account at Online Shopping');
        $this->email->message($msg1);

        if($this->email->send())
        {
            $this->session->set_flashdata('update', 'your email has been send successfully');
        }else
        {
            $this->session->set_flashdata('error', 'your email has not been send successfully please try again');
        }
        //$this->load->view('register',$this->data);
        $data['content']  = 'Dashboard/dashboard';
        $this->load->view('Template/seller_template',$data);

    }



}
