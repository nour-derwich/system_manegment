<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Authority extends MX_Controller
{
    public $admin_email = array();

    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->library('email');
        $this->load->model('Mdl_authority');
        $this->load->library('Pdf');
        $this->load->library('upload');
      
        $this->admin_email = $this->Mdl_authority->_get_admin_email();
    }

    public function index()
    {
        $authority_record = $this->Mdl_authorityt->_get_authority_list();
        $data['authority_record'] = $authority_record;
        $data['content']  = 'Authority/authority_record';
        $this->load->view('Template/template', $data);
    }

    //authority record List
    public function authority_record()
    {

        $authority_record = $this->Mdl_authority->_get_authority_list();
        $data['authority_record'] = $authority_record;
        $data['content']  = 'Authority/authority_record';
        $this->load->view('Template/template', $data);
    }

    
    //authority List Action
    public function authority_action()
    {
        $data['content']  = 'Authority/authority_action';
        $this->load->view('Template/template', $data);
    }
     //authority Submit
    public function authority_submit()
    {
        $post = $this->input->post();
     
            $data_p_relation =
                array(
                    'supervisor_name'          => $post['name'],
                    'cnic'          => $post['cnic'],
                    'supervision'          => $post['supervision'],
                    'M/S'             => $post['m/s'],
                    
                );
   
            $db_command = $this->Mdl_authority->db_command($data_p_relation, null, 'authority_list');
           $insert_id = $this->db->insert_id();
        //   print_r($insert_id);exit;
            
            if ($db_command) {
             
                $this->session->set_flashdata('saved', 'your data successfully Saved');
                // redirect(base_url() . 'Authority/authority_action', 'refresh');
                 redirect(base_url() . 'Authority/Authorityletter/generate/'.$insert_id, 'refresh');
            } else {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url() . 'Authority/authority_action', 'refresh');
            }
     
    }
     //edit_authority_detail
    public function edit_authority_detail()
    {

        $authority_id = $this->uri->segment(3);

        // Client Record By ID		
        $authority_record = $this->Mdl_authority->_get_authority_record_byid($authority_id);
        
    

        $data['authority_record'] = $authority_record; 
        $data['service_record'] = $service_record;

        $data['content']  = 'Authority/edit_authority_detail';
        $this->load->view('Template/template', $data);
    }
     //edit_authority_submit
    public function edit_authority_submit()
    {
        echo "hello"; exit;
        $post = $this->input->post();
       $data_p_relation =
                array(
                    'supervisor_name'          => $post['name'],
                    'cnic'          => $post['cnic'],
                    'supervision'          => $post['supervision'],
                    'M/S'             => $post['m/s'],
                    
                );
        $db_command = $this->Mdl_authority->db_command($data_p_relation, $post['id'], 'authority_list');
        if ($db_command) {
           
               $this->session->set_flashdata('update', 'your data successfully Updated');
            redirect(base_url() . 'Authority/authority_record', 'refresh');
           
        } else {
            $this->session->set_flashdata('Error', 'your data has not been Update');
            redirect(base_url() . 'Authority/authority_record', 'refresh');
        }
    }



}
?>
