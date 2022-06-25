<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_account extends CI_Model {

    protected $_table_name     = 'login';
    protected $_order_by       = 'id';
    protected $_primary_column = 'id';


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

	//GEt User List
    public function _get_user_list($id)
    {

            $this->db->select('*');
            $this->db->where('id', $id);
            $query = $this->db->get('user_list');
            return $query->result();

    }
	
	
	//GEt Order List
    public function _get_order_list($id)
    {

            $this->db->select('*');
            $this->db->where('order_id', $id);
            $query = $this->db->get('order_list');
            return $query->result();

    }
	
	
	
	//GEt Payment List
    public function _get_payment_list($user_id,$order_code)
    {

            $this->db->select('*');
            $this->db->where('user_id', $user_id);
            $this->db->where('order_code', $order_code);
            $query = $this->db->get('payment_list');
            return $query->result();

    }
	
	
    //All User List
    public function _this_controller_record($id)
    {

            $this->db->select('*');
            if ($id > 0) {
                $this->db->where('id', $id);
            }else
            {
                //$this->db->where('user_type','user');
            }
       
        //;
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('user_list');
            return $query->result();

    }

    //All Seller List
    public function _this_seller_controller_record($id)
    {

        $this->db->select('*');
        if ($id > 0) {
            $this->db->where('id', $id);
        }
        if($this->session->userdata('user_type') == 'seller')
        {
            $this->db->where('created_by',$this->session->userdata('id'));
            $this->db->where('user_type','order');
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('seller_list');
        return $query->result();

    }

    //_seller_product_list
    public function _seller_product_list($id)
    {
        $this->db->select('*');
        $this->db->where('user_type','seller');
        $this->db->order_by('id','desc');
        $this->db->where('created_by',$id);
        //$this->db->group_by('user_id');

        $query =  $this->db->get('product_list');
        return $query->result();
    }

    //All CArt List
    public function _this_cart_record($id)
    {
        $this->db->select('*');
        if($id > 0)
        {
            $this->db->where('user_id',$id);
        }
        $this->db->order_by('cart_id','desc');
        $this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('cart_list');
        return $query->result();
    }

    //View CArt List
    public function _this_view_cart_record($id)
    {
        $this->db->select('*');
        if($id > 0)
        {
            $this->db->where('order_track',$id);
        }
        $this->db->order_by('cart_id','desc');

        //$this->db->group_by('user_id');

        $query =  $this->db->get('cart_list');
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
       

        $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('order_list');
        return $query->result();
    }
	
	
	    //All Payment List
    public function _this_payment_record($id)
    {
       // $this->db->select("sum(paid_price) as paid_price,sum(remaining_price) as remaining_price");
        $this->db->select("*");
        if($id > 0)
        {
            $this->db->where('user_id',$id);
        }
       

        $this->db->order_by('payment_id','desc');
        //$this->db->where('order_track','');
       // $this->db->group_by('user_id');

        $query =  $this->db->get('payment_list');
        return $query->result();
    }
	
	
	    //All Order List by Code
    public function get_order_list_by_code($order_code)
    {
        $this->db->select('*');
       $this->db->where('order_code',$order_code);
       
        $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('order_list');
        return $query->result();
    }

	    //Paymtnt List
    public function get_payment_list($payment_id)
    {
        $this->db->select('*');
        if($payment_id > 0)
        {
            $this->db->where('payment_id',$payment_id);
        }
       

       // $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('payment_list');
        return $query->result();
    }
	
	
	    //Order Paymtnt List
    public function get_order_payment_list($order_code)
    {
        $this->db->select('*');
       
            $this->db->where('order_code',$order_code);
       

       // $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('payment_list');
        return $query->result();
    }
	
		    //Order Cart List
    public function get_order_cart_list($order_code)
    {
        $this->db->select('*');
       
            $this->db->where('order_code',$order_code);
       

       // $this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('cart_list');
        return $query->result();
    }


    //

    public function _get_single_record_byid($id)
    {
        $this->db->where('id' ,$id);
//        $this->db->order_by($this->_order_by);
        $query =  $this->db->get('user_list');
        return $query->result();    
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

    public function _change_user_status($id,$status,$table)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;

            $this->db->set($data);
            $this->db->where('id', $id);
            $update =  $this->db->update($table);


          //  $update =  $this->db_command($data,$id,$table);
            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }  
    }


    public function _change_seller_status($id,$status,$table)
    {
        if($id != null)
        {

            $data['admin_status'] = $status;

            $this->db->set($data);
            $this->db->where('id', $id);
            $update =  $this->db->update($table);


            //  $update =  $this->db_command($data,$id,$table);
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

    //check relation reference
    public function get_relation_pax($table,$column,$reference,$input)
    {
        $this->db->select($column);
        $this->db->where($reference,$input);
        $this->db->where('is_enable',1);
        $result =  $this->db->get($table)->result();
        return $result[0]->$column;

    }
    public function db_command($data, $id ,$table)
    {
        // Insert
        if ($id == NULL)
        {
            $this->db->set($data);
            $this->db->insert($table);
            $id = $this->db->insert_id();
        }
        // Update
        else
        {
            $filter = 'id';
            $id     = $filter($id);
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update($table);
        }

        return $id;
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
