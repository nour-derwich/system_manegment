<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends MX_Controller
{
    
     public $page_data="";
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		Modules::run('Login/_login');
		 $this->load->model('Mdl_staff');
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
			  $this->page_data['system_info'] = $this->Mdl_staff->get_system_setting_list();
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
		
	/* 	$this->load->helper('string');
        $get_code =  random_string('numeric',132);
        $get_code1 =  random_string('alnum',132);
        $get_code2 =  random_string('alpha',132);
		
		//echo $get_code;
		echo $get_code2;
		exit; */
        $this->page_data['page_name']  = 'dashboard';
        $this->page_data['page_title'] = 'Admin Dashboard';
        $this->load->view('index', $this->page_data);
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        $this->page_data['page_name']  = 'dashboard';
        $this->page_data['page_title'] = 'Admin Dashboard';
        $this->load->view('index', $this->page_data);
    }
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
	function staff_add()
	{
		$this->page_data['page_name']  = 'staff_add';
		$this->page_data['page_title'] = "Add Staff";
		$this->load->view('index', $this->page_data);
	
	}
	
	function staff_information($class_id = '')
	{		
		$this->page_data['page_name']  	= 'staff_information';
		$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['class_id'] 	= $class_id;
		$this->load->view('index', $this->page_data);
	}
	

	
    function staff_submit($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
			
			$get_code = $this->Mdl_staff->_get_student_code_generator();
            $data['staff_code']        = $get_code;
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['ip_address']       = $this->input->ip_address();
            $data['user_id']       = $this->session->userdata('id');
            $data['is_enable']       = 1;
            $data['created_date']       = date('Y-m-d H:i:s');
            $data['created_by']       = $this->session->userdata('id');
				if($_FILES['userfile']['name']!="")
            {
                $targetDir = FCPATH."public_html/frontend/image/staff/";
                $fileName ="staff_".time().$this->session->userdata('id').'.jpg';
                move_uploaded_file($_FILES['userfile']['tmp_name'], $targetDir.$fileName);
                $cat_image = $fileName;
            }
            else
            {
                $cat_image = "";
            }

			$data['staff_image'] = $cat_image;
           
            $db_command = $this->db->insert('staff_list', $data);
			//echo $this->db->last_query();exit;
            $student_id = mysql_insert_id();
            //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $student_id . '.jpg');
			if($db_command)
			{
				$this->page_data['success'] = "your data successfully Saved.";
			}
			else
			{
				$this->page_data['error'] = "your data has not been Saved.";
			}
			//$this->session->set_flashdata('saved', 'your data successfully Saved');
         // print_r($this->session->flashdata());exit;
           // $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
         //   $this->load->view('backend/admin/staff_add', $msg_data);
			$this->page_data['page_name']  	= 'staff_information';
				$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['class_id'] 	= $class_id;
		$this->load->view('index', $this->page_data);
		
		
        }
        if ($param2 == 'do_update') {
			//echo "YES";exit;
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
			
			
            $data['user_id']       = $this->session->userdata('id');
            $data['modify_date']       = date('Y-m-d H:i:s');
            $data['modify_by']       = $this->session->userdata('id');
			
			
			if($_FILES['userfile']['name']!="")
            {
                $targetDir = FCPATH."public_html/frontend/image/staff/";
                $fileName ="staff_".time().$this->session->userdata('id').'.jpg';
                move_uploaded_file($_FILES['userfile']['tmp_name'], $targetDir.$fileName);
                $cat_image = $fileName;
					$data['staff_image'] = $cat_image;
            }
			
            $this->db->where('staff_id', $param3);
            $db_command = $this->db->update('staff_list', $data);
            //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $param3 . '.jpg');
            $this->Mdl_staff->clear_cache();
         
		 	if($db_command)
			{
				$this->page_data['success'] = "your data successfully Updated.";
			}
			else
			{
				$this->page_data['error'] = "your data has not been Updated.";
			}
			//$this->session->set_flashdata('saved', 'your data successfully Saved');
         // print_r($this->session->flashdata());exit;
           // $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
         //   $this->load->view('backend/admin/staff_add', $msg_data);
			$this->page_data['page_name']  	= 'staff_information';
				$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['class_id'] 	= $class_id;
		$this->load->view('index', $this->page_data);
		
		
           // redirect(base_url() . 'index.php?admin/staff_information/' . $param1, 'refresh');
        } 
		
        if ($param2 == 'delete') {
            $this->db->where('staff_id', $param3);
            $this->db->delete('staff_list');
            redirect(base_url() . 'Staff/staff_information/' . $param1, 'refresh');
        }
    }
   
	
	/****** DAILY ATTENDANCE *****************/
	function manage_attendance($date='',$month='',$year='')
	{
		if($this->session->userdata('admin_login')!=1)redirect('login' , 'refresh');
		
		if($_POST)
		{
			$verify_data	=	array(	'staff_id' 		=> $this->input->post('staff_id'),
										'date' 				=> $this->input->post('date'));
			$attendance = $this->db->get_where('attendance' , $verify_data)->row();
			$attendance_id		= $attendance->attendance_id;
			
			$this->db->where('attendance_id' , $attendance_id);
			
			
			
            $data['status']       = $this->input->post('status');
            $data['user_id']       = $this->session->userdata('id');
            $data['modify_date']       = date('Y-m-d H:i:s');
            $data['modify_by']       = $this->session->userdata('id');
			
			
			$this->db->update('attendance' , $data);
			
			redirect(base_url() . 'Staff/manage_attendance/'.$date.'/'.$month.'/'.$year , 'refresh');
		}
		$this->page_data['date']			=	$date;
		$this->page_data['month']		=	$month;
		$this->page_data['year']			=	$year;
		
		
		$this->page_data['page_name']		=	'manage_attendance';
		$this->page_data['page_title']		=	('manage_daily_attendance');
		$this->load->view('index', $this->page_data);
	}
	function attendance_selector()
	{
		redirect(base_url() . 'Staff/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year') , 'refresh');
	}
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
   

   
	function invoice()
    {
        $this->page_data['page_name']  = 'invoice';
        $this->page_data['page_title'] = ('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $this->page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('index', $this->page_data);
    }
 


	function invoice_submit($param1 = '', $param2 = '', $param3 = '')
    {       
        if ($param1 == 'create') 
		{
            $data['staff_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
			
			
            $data['ip_address']       = $this->input->ip_address();
            $data['user_id']       = $this->session->userdata('id');
            $data['is_enable']       = 1;
            $data['created_date']       = date('Y-m-d H:i:s');
            $data['created_by']       = $this->session->userdata('id');
			
			
            $db_command = $this->db->insert('invoice', $data);
            //redirect(base_url() . 'index.php?admin/invoice', 'refresh');
			
		 	if($db_command)
			{
				$this->page_data['success'] = "your data successfully Saved.";
			}
			else
			{
				$this->page_data['error'] = "your data has not been Saved.";
			}
			//$this->session->set_flashdata('saved', 'your data successfully Saved');
         // print_r($this->session->flashdata());exit;
           // $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
         //   $this->load->view('backend/admin/staff_add', $msg_data);
			//$this->page_data['page_name']  	= 'invoice';
			$this->page_data['page_name']  = 'invoice';
        $this->page_data['page_title'] = ('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $this->page_data['invoices'] = $this->db->get('invoice')->result_array();
		
		//$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['class_id'] 	= $class_id;
		$this->load->view('index', $this->page_data);
		
		
		
        }
        if ($param1 == 'do_update') {
            $data['staff_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $data['user_id']       = $this->session->userdata('id');
            $data['modify_date']       = date('Y-m-d H:i:s');
            $data['modify_by']       = $this->session->userdata('id');
			
            $this->db->where('invoice_id', $param2);
            $db_command = $this->db->update('invoice', $data);
            //redirect(base_url() . 'index.php?admin/invoice', 'refresh');
		
		 	if($db_command)
			{
				$this->page_data['success'] = "your data successfully Updated.";
			}
			else
			{
				$this->page_data['error'] = "your data has not been Updated.";
			}
			//$this->session->set_flashdata('saved', 'your data successfully Saved');
         // print_r($this->session->flashdata());exit;
           // $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
         //   $this->load->view('backend/admin/staff_add', $msg_data);
			//$this->page_data['page_name']  	= 'invoice';
		//$this->page_data['page_title'] 	= 'Staff Information';
		//$this->page_data['class_id'] 	= $class_id;
		$this->page_data['page_name']  = 'invoice';
        $this->page_data['page_title'] = ('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $this->page_data['invoices'] = $this->db->get('invoice')->result_array();
		$this->load->view('index', $this->page_data);
		
		
		
			
        } else if ($param1 == 'edit') {
            $this->page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'Staff/invoice', 'refresh');
        }
    }
 

	function popup($page_name = '' , $param2 = '' , $param3 = '')
	{
		//$account_type		=	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		
		  $page_data['system_info'] = $this->Mdl_staff->get_system_setting_list();
		$this->load->view( 'admin/'.$page_name.'.php' ,$page_data);
		
		echo '<script src="'.base_url().'assets/js/neon-custom-ajax.js"></script>';
	} 
}
