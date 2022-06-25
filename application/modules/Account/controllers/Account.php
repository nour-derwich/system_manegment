<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller  {

    //public $seller_email = array();
    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->library('email');
        $this->load->model('Mdl_Account');
        $this->load->module('Hierarchy');
        //$this->seller_email = $this->Mdl_dashboard->_get_admin_email();
        #    $this->lang->load('ur',false);
    }
    public function index()
    {    
        $data['result_set'] = $this->Mdl_Account->_this_controller_record();
        $data['content']    = 'Account/account_list';
        $this->load->view('Template/template',$data);
    }

    //Account List
    public function account_list()
    {
        $id= $this->uri->segment(3);
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_Account->_this_controller_record($id);
            $data['content']    = 'Account/account_detail_list';
            $this->load->view('Template/template',$data);
        }
        else
        {
            $data['result_set'] = $this->Mdl_Account->_this_controller_record();
            $data['content']    = 'Account/account_list';
            $this->load->view('Template/template',$data);

        }


    }

    //Seller Account List
    public function seller_account_list()
    {
        $id= $this->uri->segment(3);
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_Account->_this_seller_controller_record($id);
            $data['content']    = 'Account/seller_account_detail_list';
            $this->load->view('Template/template',$data);
        }
        else
        {
            $data['result_set'] = $this->Mdl_Account->_this_seller_controller_record();
            $data['content']    = 'Account/seller_account_list';
            $this->load->view('Template/template',$data);

        }


    }


    //Seller Product List
    public function seller_product_list()
    {
        $id= $this->uri->segment(3);
        $data['result'] = $this->Mdl_Account->_seller_product_list($id);
        $data['content']    = 'Account/seller_product_list';
        $this->load->view('Template/template',$data);
    }


    //Cart List
    public function cart_list()
    {
        $id= $this->uri->segment(3);
        $data['result_set'] = $this->Mdl_Account->_this_cart_record($id);
        $data['content']    = 'Account/cart_list';
        $this->load->view('Template/template',$data);
    }

    //Order List
    public function order_list()
    {
        $id= $this->uri->segment(3);
        $data['result_set'] = $this->Mdl_Account->_this_order_record($id);
        $data['content']    = 'Account/order_list';
        $this->load->view('Template/template',$data);
    }

    //Order Submit
    public function order_submit()
    {
        $post = $this->input->post();
      //  print_r($post);
       // exit;
        $order_status = $post['order_status'];
        $order_message = $post['order_message'];
        $order_no = $post['order_no'];
        $order_id = $this->Mdl_Account->get_relation_pax('order_list','order_id','order_track',$order_no);
        $user_id = $post['user_id'];
        $user_email = $post['user_email'];
        $user_name = $post['user_name'];

        //Order Status pending
        if($post['order_status'] == "pending")
        {
            $this->db->trans_start();
            $data_order = array
            (
                'order_status' => 'pending',
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_id',$order_id);
            $db_command = $this->db->update('order_list',$data_order);

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $order_id,
                'user_id' =>  $user_id,
                'order_track' => $order_no,
                'order_status' => 'pending',
                'order_info' => 'Ordered item is pending confirmation.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_Account->db_command($data_order_history1, null, 'order_history_list');
            $this->db->trans_complete();

            //User Email
            $from_email = $this->session->userdata('email');
            $to_email = $user_email;
            //Load email library
            $msg = 'Dear '.$user_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_no.'.<br/>Your Order has been pending confirmation. You will be contacted shortly for confirmation of your order via SMS/Call.<br/>Thank you for being a part of Online Shopping!';
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Order has been pending confirmation at Online Shopping');
            $this->email->message($order_message);
            $this->email->send();
            //Seller to Send Email Admin
            if($this->session->userdata('user_type') == 'seller')
            {
                $admin_detail = $this->Mdl_Account->_get_admin_email();
                //Admin Email
                $from_email = $this->session->userdata('email');
                $to_email = $admin_detail[0]->email;
                $seller_name = $this->session->userdata('name');
                //Load email library
                $msg = 'Dear Admin<br/>Seller '.$seller_name.'<br/>Order has been pending confirmation at Online Shopping<br/>Oder ID is '.$order_no.'<br/>Thank you for being a part of Online Shopping!';
                $this->email->from($from_email, 'Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order has been pending confirmation at Online Shopping');
                $this->email->message($order_message);
                $this->email->send();
            }

        } //Order Status process
        else if($post['order_status'] == "process")
        {
            $this->db->trans_start();
            $data_order = array
            (
                'order_status' => 'process',
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_id',$order_id);
            $db_command = $this->db->update('order_list',$data_order);

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $order_id,
                'user_id' =>  $user_id,
                'order_track' => $order_no,
                'order_status' => 'process',
                'order_info' => 'Ordered item is processing.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_Account->db_command($data_order_history1, null, 'order_history_list');
            $this->db->trans_complete();
            //User Email Send
            $from_email = $this->session->userdata('email');
            $to_email = $user_email;
            //Load email library
            $msg = 'Dear '.$user_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_no.'.<br/>
            Your Order has been processing. You will be contacted shortly for confirmation of your order via SMS/Call.<br/>Thank you for being a part of Online Shopping!';
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Order has been processing at Online Shopping');
            $this->email->message($order_message);
            $this->email->send();
            //Seller to Send Email Admin
            if($this->session->userdata('user_type') == 'seller')
            {
                $admin_detail = $this->Mdl_Account->_get_admin_email();
                //Admin Email
                $from_email = $this->session->userdata('email');
                $to_email = $admin_detail[0]->email;
                $seller_name = $this->session->userdata('name');
                //Load email library
                $msg = 'Dear Admin<br/>Seller '.$seller_name.'<br/>Order has been processing at Online Shopping<br/>Oder ID is '.$order_no.'.<br/>Thank you for being a part of Online Shopping!';
                $this->email->from($from_email, 'Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order has been processing at Online Shopping');
                $this->email->message($order_message);
                $this->email->send();
            }

        } //Order Status cancel
        else if($post['order_status'] == "cancel")
        {
            $this->db->trans_start();
            $data_order = array
            (
                'order_status' => 'cancel',
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_id',$order_id);
            $db_command = $this->db->update('order_list',$data_order);

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $order_id,
                'user_id' =>  $user_id,
                'order_track' => $order_no,
                'order_status' => 'cancel',
                'order_info' => 'Item has been cancelled.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_Account->db_command($data_order_history1, null, 'order_history_list');
            $this->db->trans_complete();
            //User Email Send
            $from_email = $this->session->userdata('email');
            $to_email = $user_email;
            //Load email library
            $msg = 'Dear '.$user_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_no.'.<br/>
            Your Order has been cancelled.<br/>Thank you for being a part of Online Shopping!';
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Order has been cancelled at Online Shopping');
            $this->email->message($order_message);
            $this->email->send();

            //Seller to Send Email Admin
            if($this->session->userdata('user_type') == 'seller')
            {
                $admin_detail = $this->Mdl_Account->_get_admin_email();
                //Admin Email
                $from_email = $this->session->userdata('email');
                $to_email = $admin_detail[0]->email;
                $seller_name = $this->session->userdata('name');
                //Load email library
                $msg = 'Dear Admin<br/>Seller '.$seller_name.'<br/>Order has been cancelled at Online Shopping<br/>Oder ID is '.$order_no.'.<br/>Thank you for being a part of Online Shopping!';
                $this->email->from($from_email, 'Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order has been cancelled at Online Shopping');
                $this->email->message($order_message);
                $this->email->send();
            }

        } //Order Status diapatch
        else if($post['order_status'] == "dispatch")
        {


            //exit;
            $this->db->trans_start();
            $data_order = array
            (
                'order_status' => 'dispatch',
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_id',$order_id);
            $db_command = $this->db->update('order_list',$data_order);


            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $order_id,
                'user_id' =>  $user_id,
                'order_track' => $order_no,
                'order_status' => 'dispatch',
                'order_info' => 'Order has been dispatched.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_Account->db_command($data_order_history1, null, 'order_history_list');

            //Update Product Qty
            $order_product_detail = $this->Mdl_Account->_this_view_cart_record($order_no);
            foreach($order_product_detail as $prd)
            {
                $cart_product_id = $prd->product_id;
                $cart_product_qty = $prd->cart_qty;
                $get_product_quantity = $this->Mdl_Account->get_relation_pax('product_list','product_quantity','id',$cart_product_id);
                $final_quantity = $get_product_quantity - $cart_product_qty;
                //echo $cart_product_id." product<br/> ".$cart_product_qty." qty<br/>".$get_product_quantity." pqty<br/>".$final_quantity." finalqty<br/>";
                $data_update = array
                (
                    'product_quantity' => $final_quantity
                );
                $this->db->where('id',$cart_product_id);
                $db_command = $this->db->update('product_list',$data_update);
            }

            $this->db->trans_complete();
            //User Email Send
            $from_email = $this->session->userdata('email');
            $to_email = $user_email;
            //Load email library
            $msg = 'Dear '.$user_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_no.'.<br/>
            Your Order has been dispatched.<br/>Thank you for being a part of Online Shopping!';
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Order has been dispatched at Online Shopping');
            $this->email->message($order_message);
            $this->email->send();

            //Seller to Send Email Admin
            if($this->session->userdata('user_type') == 'seller')
            {
                $admin_detail = $this->Mdl_Account->_get_admin_email();
                //Admin Email
                $from_email = $this->session->userdata('email');
                $to_email = $admin_detail[0]->email;
                $seller_name = $this->session->userdata('name');
                //Load email library
                $msg = 'Dear Admin<br/>Seller '.$seller_name.'<br/>Order has been dispatched at Online Shopping<br/>Oder ID is '.$order_no.'.<br/>Thank you for being a part of Online Shopping!';
                $this->email->from($from_email, 'Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order has been dispatched at Online Shopping');
                $this->email->message($order_message);
                $this->email->send();
            }


        } //Order Status complete
        else if($post['order_status'] == "complete")
        {
            $this->db->trans_start();
            $data_order = array
            (
                'order_status' => 'complete',
                'final_date' => date('Y-m-d'),
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_id',$order_id);
            $db_command = $this->db->update('order_list',$data_order);

            $data_cart = array
            (
                'cart_status' => 'complete',
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('order_track',$order_no);
            $db_command = $this->db->update('cart_list',$data_cart);

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $order_id,
                'user_id' =>  $user_id,
                'order_track' => $order_no,
                'order_status' => 'complete',
                'order_info' => 'Order has been complete.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_Account->db_command($data_order_history1, null, 'order_history_list');
            $this->db->trans_complete();

            //User Email Send
            $from_email = $this->session->userdata('email');
            $to_email = $user_email;
            //Load email library
            $msg = 'Dear '.$user_name.',<br/>Thank you for placing your order with us.<br/>
            Your Order has been complete.<br/>Thank you for being a part ofOnline Shopping!';
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Order has been complete atOnline Shopping');
            $this->email->message($order_message);
            $this->email->send();

            //Seller to Send Email Admin
            if($this->session->userdata('user_type') == 'seller')
            {
                $admin_detail = $this->Mdl_Account->_get_admin_email();
                //Admin Email
                $from_email = $this->session->userdata('email');
                $to_email = $admin_detail[0]->email;
                $seller_name = $this->session->userdata('name');
                //Load email library
                $msg = 'Dear Admin<br/>Seller '.$seller_name.'<br/>Order has been complete at Online Shopping<br/>Oder ID is '.$order_no.'.<br/>Thank you for being a part of Online Shopping!';
                $this->email->from($from_email, 'Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order has been complete at Online Shopping');
                $this->email->message($order_message);
                $this->email->send();
            }



        }

        if($db_command)
        {
            $this->session->set_flashdata('update', 'your order has been successfully Updated');
        }
        else
        {
            $this->session->set_flashdata('error', 'your order has not been Updated');
        }
        redirect(base_url().'Account/order_list','refresh');



    }

    //Order List
    public function view_order_list()
    {
        $id= $this->uri->segment(3);
        $data['result_set'] = $this->Mdl_Account->get_order_list_by_code($id);
        $data['content']    = 'Account/view_order_list';
        $this->load->view('Template/template',$data);
    }
   //Payment List
    public function view_payment_list()
    {
		$user_id= $this->uri->segment(3);
        $order_code= $this->uri->segment(4);
        $data['result_set'] = $this->Mdl_Account->_get_payment_list($user_id,$order_code);
       
        $data['content']    = 'Account/payment_list';
        $this->load->view('Template/template',$data);
    }


//Slip List
    public function view_order_slip()
    {
		$user_id= $this->uri->segment(3);
        $order_code= $this->uri->segment(4);
        $data['result_set'] = $this->Mdl_Account->_get_payment_list($user_id,$order_code);
       
        $data['content']    = 'Account/view_order_slip';
        $this->load->view('Template/template',$data);
    }
	
	
	//Slip List
    public function view_order_slip1()
    {
        //$order_code= $this->uri->segment(4);
        //$data['result_set'] = $this->Mdl_Account->_get_payment_list($user_id,$order_code);
       
        $data['content']    = 'Account/view_order_slip1';
        $this->load->view('Template/template',$data);
    }
	
	
	

    public function action($id = null)
    { 

        $id = $this->uri->segment(3);  
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_Account->_get_single_record_byid($id);  
        } 

        $data['content']   = 'Account/action';
        $this->load->view('Template/template',$data);

    }

    public function command()
    { 
        $post = $this->input->post();
		
        if($post['status']){$is_enable = 1;}else{$is_enable = 0;} 
        //if($post['is_print']){$is_print = 1;}else{$is_print = 0;} 	   

   
        

		if($post['id'] != null)
        {
			
			$data['is_enable']        = $is_enable;
			$data['user_type']        = $post['user_type_id'];
			$data['name']            = $post['name']; 
			$data['email']            = $post['email']; 
			$data['contact']         = $post['contact']; 
			$data['address']        = $post['address']; 
			$data['modify_date']        = date('Y-m-d H:i:s'); 
			$data['modify_by']        = $this->session->userdata('id'); 
			
            $this->db->where('id',$post['id']);
            $db_command = $this->db->update('user_list',$data);

		}
		else
		{
			$data['is_enable']        = $is_enable;
			$data['user_type']        = $post['user_type_id'];
			$data['name']            = $post['name']; 
			$data['email']            = $post['email']; 
			$data['contact']         = $post['contact']; 
			$data['address']        = $post['address']; 
			$data['ip_address']       = $this->input->ip_address();
			$db_command =  $this->Mdl_Account->db_command($data,$post['id'],'user_list');
		}
		
       
		if($db_command)
        {
            if($post['id'] != null)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Account/account_list','refresh');  
        }  

    } 
    public function check_user_exists()
    {
        $post               =  $this->input->post();
        $username           =  $post['username'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_Account->_get_single_record_byusername($username,$id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return; 

    }
    public function change_user_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table             =  $post['table'];

        $_return['_return'] =  $this->Mdl_Account->_change_user_status($id,$status,$table);
        $return             = json_encode($_return);
        echo $return; 

    }
    //Seller Status Change
    public function change_seller_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table             =  $post['table'];

        $_return['_return'] =  $this->Mdl_Account->_change_seller_status($id,$status,$table);
        if($_return['_return'] == 1)
        {
            //Active Account
            if($status == 0)
            {
                $seller_detail = $this->Mdl_Account->_this_seller_controller_record($id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                //Load email library
                $get_link1 = base_url()."admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear ".$$username."<br/>Your Seller Account has been Active at Online Shopping";
                $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and add your products.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Account Active at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();

            } //Unactive Account
            else
            {
                $seller_detail = $this->Mdl_Account->_this_seller_controller_record($id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                //Load email library
                $get_link1 = base_url()."admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear ".$$username."<br/>Your Seller Account has been De-Active at Online Shopping";
                $msg1 .= "<br/>please contact site admin.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Account DeActive at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();

            }
            $return             = json_encode($_return);
            echo $return;
        }
        else
        {
            $return             = json_encode($_return);
            echo $return;

        }


    }

    //User Print Status
    public function change_user_is_print()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_Account->_change_user_is_print($id,$status);
        $return             = json_encode($_return);
        echo $return; 
    } 


    public function delete($id)
    {
        $delete = $this->Mdl_Account->_delete($id);

        if($delete == 1)
        {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!'); 
        }else
        {
            $this->session->set_flashdata('error', 'No record found for Deleting !');   
        }
        redirect(base_url().'Account','refresh');  
    }  
    public function data_permission()
    {
        $data['permission_view'] = $this->hierarchy_list();   
        $data['content']    = 'Account/data_permission';
        $this->load->view('Template/template',$data);
    }
    public function module_permission()
    {
        $data['permission_view'] = $this->menulist();   
        $data['content']    = 'Account/module_permission';
        $this->load->view('Template/template',$data);
    }
    function menulist()
    {     

        $this->db->select('*'); 
        $this->db->order_by('sort_order','asc');
        $result   =  $this->db->get('admin_module_list')->result();
        $userid =  $this->uri->segment(3);
        $permission  = json_decode($this->already_exists_row('admin_module_permission','userid',$userid,'permission'));
        $permission = json_decode(json_encode($permission), True); 
        #  $this->Mdl_Account->debug_r($permission,1); 
        $html      = ''; 
        $html_div  = ''; 
        $html .='<div class="tabbable tabs-left">';

        $count = 0; 
        foreach($result as $res):
            $count++; 

            if($res->parent_id == 0):
                if($count == 1): 
                    $html_li .='<li class="active">';
                    $html_div_in.='<div id="'.$res->mdl_name.'" class="tab-pane in active">';
                    else:
                    $html_li .='<li class="">';
                    $html_div_in.='<div id="'.$res->mdl_name.'" class="tab-pane ">';
                    endif;

                $html_li .='<a data-toggle="tab" href="#'.$res->mdl_name.'">
                <i class="blue icon-dashboard bigger-110"></i>
                '.$res->mdl_name.'
                </a></li>';

                $param = array('a'=>'','e'=>'','d'=>'','v'=>'');

                if($permission[$res->id]['a'] != 0):
                    $param['a']        = 'checked="checked"'; 
                    endif;
                if($permission[$res->id]['e'] != 0):
                    $param['e']        = 'checked="checked"'; 
                    endif;
                if($permission[$res->id]['d'] != 0):
                    $param['d']        = 'checked="checked"';    
                    endif;
                if($permission[$res->id]['v'] != 0):
                    $param['v']        = 'checked="checked"';   
                    endif;

                $html_div_in.= '<h3 class="row-fluid header smaller lighter blue">
                <span class="span7">'.$res->mdl_name.'</span><!-- /span -->
                <input type="hidden" name="'.$res->id.'" />
                <span class="span5">
                <label class="pull-right inline">
                <small class="muted">Status:</small>

                <input name="v_'.$res->id.'"  '.$param['v'] .' type="checkbox" class="ace ace-switch ace-switch-5" />
                <span class="lbl"></span>
                </label>
                </span>
                </h3>';

                $id       =    $res->id;
                $submenu  =   $this->get_child($result, $id,$permission);
                $html_div_in .= $submenu;            
                $html_div_in.='</div>';            
                endif;




            endforeach;

        $html_ul .='<ul class="nav nav-tabs" id="myTab3">';  
        $html_ul .= $html_li;
        $html_ul .='</ul>';   
        $html_div.='<div class="tab-content">';   
        $html_div.=$html_div_in;   
        $html_div.='</div>';   


        #  return $menu;
        return $html_ul.$html_div;
    }
    function get_child($items, $id,$permission)
    {
        $submenu     ='';

        foreach($items as $item){

            if($item->parent_id == $id){



                if($item->controller == null && $item->ref_controller == null && $item->function == null):
                    $param = array('a'=>'','e'=>'','d'=>'','v'=>'');

                    if($permission[$item->id]['a'] != 0):
                        $param['a']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['e'] != 0):
                        $param['e']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['d'] != 0):
                        $param['d']        = 'checked="checked"';    
                        endif;
                    if($permission[$item->id]['v'] != 0):
                        $param['v']        = 'checked="checked"';   
                        endif;
                    $submenu.= '<h3 class="row-fluid header smaller lighter blue">
                    <span class="span7">'.$item->mdl_name.'</span><!-- /span -->
                    <input type="hidden" name="'.$item->id.'" />
                    <span class="span5">
                    <label class="pull-right inline">
                    <small class="muted">Status:</small>

                    <input name="v_'.$item->id.'"  '.$param['v'] .' type="checkbox" class="ace ace-switch ace-switch-5" />
                    <span class="lbl"></span>
                    </label>
                    </span>
                    </h3>'; 
                    $id       = $item->id;
                    $innersub =   $this->get_inner_child($items, $id,$permission);
                    $submenu .=$innersub;


                    elseif($item->controller != null && $item->ref_controller == null ):

                    $param = array('a'=>'','e'=>'','d'=>'','v'=>'');

                    if($permission[$item->id]['a'] != 0):
                        $param['a']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['e'] != 0):
                        $param['e']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['d'] != 0):
                        $param['d']        = 'checked="checked"';    
                        endif;
                    if($permission[$item->id]['v'] != 0):
                        $param['v']        = 'checked="checked"';   
                        endif;



                    # $this->Mdl_Account->debug_r($permission,1);  
                    #     if($permission[$item->id]['a'])
                    $submenu ='<h5 class="header smaller lighter blue">
                    <span class="span5"> <small>Permissions</small>   
                    <i class="icon-double-angle-left"></i> 
                    '.$item->mdl_name.'</span><!-- /span -->

                    <span class="span5 pull-right">
                    <input type="hidden" name="'.$item->id.'" />
                    <label>
                    <input name="d_'.$item->id.'" '.$param['d'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> Delete</span>
                    </label>
                    <label>
                    <input name="e_'.$item->id.'"  '.$param['e'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> Edit</span>
                    </label>
                    <label>
                    <input name="a_'.$item->id.'" '.$param['a'].'  class="ace ace-checkbox-2" type="checkbox" />
                    <span class="lbl"> Add</span>
                    </label>
                    <label>
                    <input name="v_'.$item->id.'" '.$param['v'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> View</span>
                    </label>   

                    </span>

                    </h5>'; 

                    endif;    




                $menu_retun.= $submenu;
                $submenu = null;

            }   

        }



        if($menu_retun != null):
            return $menu_retun; 
            endif;

    }  
    function get_inner_child($items, $id,$permission)
    {

        $submenu    = null;
        $menu_retun = null;
        foreach($items as $item){

            if($item->parent_id == $id){

                if($item->controller == null && $item->ref_controller != null && $item->function != null):

                    $param = array('a'=>'','e'=>'','d'=>'','v'=>'');

                    if($permission[$item->id]['a'] != 0):
                        $param['a']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['e'] != 0):
                        $param['e']        = 'checked="checked"'; 
                        endif;
                    if($permission[$item->id]['d'] != 0):
                        $param['d']        = 'checked="checked"';    
                        endif;
                    if($permission[$item->id]['v'] != 0):
                        $param['v']        = 'checked="checked"';   
                        endif;


                    $submenu ='<h5 class="header smaller lighter blue">

                    <span class="span5"> <small>Permissions</small>   
                    <i class="icon-double-angle-left"></i> 
                    '.$item->mdl_name.'</span><!-- /span -->

                    <span class="span7 pull-right">
                    <input type="hidden" name="'.$item->id.'"/>  
                    <label>
                    <input name="d_'.$item->id.'" '.$param['d'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> Delete</span>
                    </label>
                    <label>
                    <input name="e_'.$item->id.'"  '.$param['e'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> Edit</span>
                    </label>
                    <label>
                    <input name="a_'.$item->id.'" '.$param['a'].'  class="ace ace-checkbox-2" type="checkbox" />
                    <span class="lbl"> Add</span>
                    </label>
                    <label>
                    <input name="v_'.$item->id.'" '.$param['v'].' type="checkbox" class="ace ace-checkbox-2" />
                    <span class="lbl"> View</span>
                    </label>  

                    </span>

                    </h5>'; 

                    endif;


                $menu_retun.= $submenu; 
                $submenu  = null;             
            }



        }


        if($menu_retun != null):
            return $menu_retun; 
            endif;
    }  
    public function allow_permission()
    {

        $postdata = $this->input->post();
        $userid   = $postdata['id'];
        #  $this->Mdl_Account->debug_r($postdata,1); 
        foreach($postdata as $key => $value):  

            $param = array('a'=>0,'e'=>0,'d'=>0,'v'=>0);
            if(is_numeric($key) == true):
                if($postdata['a_'.$key] != null):
                    $param['a']        = 1; 
                    endif;
                if($postdata['e_'.$key] != null):
                    $param['e']        = 1;  
                    endif;
                if($postdata['d_'.$key] != null):
                    $param['d']        = 1;   
                    endif;
                if($postdata['v_'.$key] != null):
                    $param['v']        = 1;  
                    endif;
                $permission[$key] = $param;
                endif;

            endforeach; 

        $permission_json = json_encode($permission);
        #  $this->Mdl_Account->debug_r($permission_json,0);   

        $id  = $this->already_exists_row('admin_module_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_Account->debug_r($data,0);   
        $db_command =  $this->Mdl_Account->db_command($data,$id,'admin_module_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Account','refresh');  
        }

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
    public function hierarchy_list()
    {
        // $user_type = $this->session->userdata('user_type');
        //       echo $user_type;
        //       exit;
        $userid                  =  $this->uri->segment(3);
        $admin_data_permission   = json_decode($this->already_exists_row('admin_data_permission','userid',$userid,'permission'));

        $p_country               = json_decode(json_encode($admin_data_permission->country_id), True);
        $p_city                  = json_decode(json_encode($admin_data_permission->city_id), True);


        #@@@ Country Select 


        $this->db->select('*');
        $this->db->where('is_enable',1);
        $country_list  = $this->db->get('country_list')->result();
        $count_kbnt    = 0;

        foreach($country_list as $kbnt_key => $kbnt):
            if($p_country[$kbnt->id] ==  $kbnt->id): $check = 'checked="checked"'; else: $check = null; endif;

            $count_kbnt++;
            if($count_kbnt == 1): 
                $html_li .='<li class="active">';
                $html_div_in.='<div id="__'.$kbnt->id.'" class="tab-pane in active">';
                else:
                $html_li .='<li class="">';
                $html_div_in.='<div id="__'.$kbnt->id.'" class="tab-pane ">';
                endif;

            $html_li .='<a data-toggle="tab" href="#__'.$kbnt->id.'">
            <i class="blue icon-dashboard bigger-110"></i>
            '.$kbnt->country_name.'
            </a></li>';    

            $html_div_in.= '<h3 class="row-fluid header smaller lighter blue">
            <span class="span7">'.$kbnt->title.'</span><!-- /span -->
            <input type="hidden" name="'.$res->id.'" />
            <span class="span5">
            <label class="pull-right inline">
            <small class="muted">Status:</small>

            <input name="country_id__'.$kbnt->id.'"  type="checkbox" '.$check.' country_ref="'.$kbnt->id.'"  type="checkbox" class="ace ace-switch ace-switch-5 country_id_'.$kbnt->id.'" />
            <span class="lbl"></span>
            </label>
            </span>
            </h3>';    

            $this->db->select('*');
            $this->db->where('country_id',$kbnt->id);
            $this->db->where('is_enable',1);
            $city_list  = $this->db->get('city_list')->result();

            $count_cl = 0;            
            foreach($city_list as $cl_key => $cl):
                if($p_city[$cl->id] ==  $cl->id): $check = 'checked="checked"'; else: $check = null; endif;
                $count_cl++;
                $html_div_in .='<ul style="list-style: none !important;">';

                $html_div_in .= '<div class="col-sm-4 col-xs-12">
                <li>  
                <label>
                <input name         ="city_id__'.$cl->id.'" '.$check.'  
                type        ="checkbox" 
                class       ="ace ace-checkbox-2 country_checkbox" 
                />
                <span class="lbl">  '.$cl->title.'</span>
                </label>  
                </li>
                </div>'; 
                $html_div_in .= '</ul>';   
                endforeach; 

            $html_div_in.='</div>';   
            endforeach;    
        $html_ul .='<ul class="nav nav-tabs" id="myTab3">';  
        $html_ul .= $html_li;
        $html_ul .='</ul>';   
        $html_div.='<div class="tab-content">';   
        $html_div.=$html_div_in;   
        $html_div.='</div>';    
        $return_html .= $html.'<div class="row"><div class="col-xs-12"><div class="tabbable tabs-left">'.$html_ul.$html_div.'</div></div></div>';
        $html          = null;  
        $html_ul       = null;  
        $html_li       = null;  
        $html_div_in   = null;  
        $html_div      = null;  





        #  return $menu;
        return $return_html;


    }  
    public function add_data_permission()
    {
        $postdata = $this->input->post();
        $userid   = $postdata['id'];
        #$this->Mdl_Account->debug_r($postdata,1); 
        $permission  = array();

        foreach($postdata as $key => $value):  
            $key_explode = explode("__",$key);     
            if($key_explode[0] == 'country_id'):
                $permission[$key_explode[0]][$key_explode[1]] = $key_explode[1];       
                endif; 
            if($key_explode[0] == 'city_id'):
                $permission[$key_explode[0]][$key_explode[1]] = $key_explode[1];       
                endif;    
            endforeach; 

        $permission_json = json_encode($permission);
        # $this->Mdl_Account->debug_r($permission_json,1);


        $id  = $this->already_exists_row('admin_data_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_Account->debug_r($data,0);   
        $db_command =  $this->Mdl_Account->db_command($data,$id,'admin_data_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Account','refresh');  
        }
    } 
}
