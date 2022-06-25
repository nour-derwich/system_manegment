<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller  {

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
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_login');
    }
    public function index()
    { 
        #  $this->session->sess_destroy ();        
        $dashboard = 'Dashboard';
        $this->Mdl_login->loggedin () == FALSE ||  redirect(base_url().$dashboard,'refresh');

        $data['content']  = 'Login/login';
        $this->load->view('Login/login',$data);

    }

    public function check_user()
    {
        //Admin
        $this->db->where('username',$this->input->post('username'));
        $this->db->where('password',$this->Mdl_login->hash($this->input->post( 'password')));
        $this->db->where('is_enable',1);
        $user = $this->db->get('login')->result();

        $user_array = array
        (
            'userid' => $user[0]->id,
            'usertype' =>$user[0]->user_type

        );
        $admin_module_permission  = $this->check_already_exists_multiple('admin_module_permission','permission',$user_array,2);
       $admin_data_permission    = $this->check_already_exists_multiple('admin_data_permission','permission',$user_array,2);
        // print_r($admin_module_permission[0]->permission);
        //exit;

        //Admin Login
        if (count ($user) > 0) {
               // print_r(count ($user));
        // exit();
            $data = array (
                'id'                => $user[0]->id,
                'admin_id'                => $user[0]->id,
                'name'              => $user[0]->username,
                'email'              => $user[0]->email,
                'user_type'         => $user[0]->user_type,
                'branch_id'         => $user[0]->branch_id,
                'country_id'        => $user[0]->country_id,
                'city_id'           => $user[0]->city_id,
                'is_print'           => $user[0]->is_print,
                'permission'        => $admin_module_permission[0]->permission,
                'data_permission'   => $admin_data_permission[0]->permission,
                'admin_login'          => 1, 
                'login_type'          => 'admin', 
                'loggedin'          => True 
            );
						  
			  
            $now = date('Y-m-d H:i:s');
            $login_info['last_login']  = $now;

            $this->db->set($login_info);
            $this->db->where('id', $user[0]->id);
            $this->db->update('login');  

            $this->session->set_userdata ( $data );  
            $dashboard = 'Dashboard';
            redirect(base_url().$dashboard,'refresh');   
        }
        else
        {
            redirect(base_url().'admin/login','refresh');
        }  

    }
    public function logout() 
    {
        $this->Mdl_login->logout ();
        redirect(base_url().'admin/login','refresh');
    }
    public function _login()
    {
        $ri = $this->uri->segment(2);

        if($ri != 'check_user')
        {
            // Login check
            $exception_uris = array(
                'Login',
                'logout'
            );

            if (in_array(uri_string(), $exception_uris) == FALSE) {
                if ($this->Mdl_login->loggedin() == FALSE) {
                    redirect(base_url().'admin/login','refresh');
                }

            }   
        }
    }
    public function _hash($val)
    {
        return $this->Mdl_login->hash($val);  
    }
    public function already_exists_row($table,$ref,$input,$return)
    {


        $this->db->select($return); 
        $this->db->where($ref ,$input); 
        $query =  $this->db->get($table);
        $count = $query->num_rows();
        if($count > 0)
        {
            $result = $query->result();

            return $result[0]->$return;  
        }else{
            return $count;  
        }


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


}
