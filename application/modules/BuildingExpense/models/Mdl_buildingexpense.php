<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_buildingexpense extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->module('Hierarchy');
    }
	
 //Get Category List
    public function _get_expense_list($id)
    {
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
		if($this->session->userdata('user_type') != "1")
		{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('project_id',$this->session->userdata('project_id'));
		}	
        $this->db->where('exp_type','building_expense');
        $query =  $this->db->get('building_expense_list');
        return $query->result();
    }
	
	public function _get_withdraw_list($id)
    {
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
		if($this->session->userdata('user_type') != "1")
		{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
        $this->db->where('exp_type','withdraw');
        $query =  $this->db->get('expense_list');
        return $query->result();
    }
	   //Order Code Generator
    public function _get_order_code_generator()
    {
		$this->db->select('*');
        $this->db->order_by('order_id','desc');
        $this->db->limit(1);
        $result = $this->db->get('order_list');
        if( $result->num_rows() > 0 )
        {
            $last_num = $result->row_array();
            $initel_num = $last_num['order_id'];
            $regi_code = ($initel_num + 1 );
            return $regi_code;
            //return $last_num['code_no'] + 1;
            //echo "YES".$regi_code;
        }
        else
        {
           // $initel_num = '';
            $regi_code = 1 ;
            return $regi_code;
            //return 1;
            //echo "NO";
        }
    }
	
	
    //Get Admin Email
    public function _get_admin_email()
    {
        $this->db->where('user_type' ,1);
        $query =  $this->db->get('login');
        return $query->result();
    }
    //All Seller List
    public function _this_seller_controller_record($id)
    {

        $this->db->select('*');
        if ($id > 0) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get('seller_list');
        return $query->result();

    }
    //Customer Code Generator
    public function _get_product_code_generator()
    {
        $this->db->select(array('product_code','id'));
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $result = $this->db->get('product_list');
        if( $result->num_rows() > 0 )
        {
            $last_num = $result->row_array();
            $initel_num = $last_num['product_code'];
            $regi_code = ($initel_num + 1 );
            return $regi_code;
            //return $last_num['code_no'] + 1;
            //echo "YES".$regi_code;
        }
        else
        {
            $initel_num = '987654';
            $regi_code = $initel_num + 1 ;
            return $regi_code;
            //return 1;
            //echo "NO";
        }
    }

    //Get Category List
    public function _get_category_list($id)
    {
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
        $this->db->where('parent_category_id',0);
        $query =  $this->db->get('category_list');
        return $query->result();
    }
	    
		//Get Product List
    public function _get_product_list($id)
    {
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
		$this->db->order_by('id','desc');
        //$this->db->where('parent_category_id',0);
        $query =  $this->db->get('product_list');
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
	 //Get Order List
    public function _get_order_list($id)
    {
        if($id > 0)
        {
            $this->db->where('order_id',$id);
        }
       // $this->db->where('parent_category_id',0);
        $query =  $this->db->get('order_list');
        return $query->result();
    }

    //Get Sub Category List
    public function _get_sub_category_list($id)
    {
        if($id > 0)
        {
            $this->db->where('id',$id);
        }
        $this->db->where('parent_category_id !=',0);
        $query =  $this->db->get('category_list');
        return $query->result();
    }

    //Sub Category List
    public function sub_category_list($parm)
    {
        $this->db->select('id,category_name');
        $this->db->where('is_enable',1);
        $this->db->where('parent_category_id',$parm);
        $result =  $this->db->get('category_list')->result();
        $array = array(
            '' => 'Select Sub Category'
        );
        if($parm !=null){
            $array = array(
                  '' => 'Select Sub Category'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->category_name;
            }
        }
        //echo $this->db->last_query();
       // exit;
        return $array;
    }


	//Product List By Single Id
    public function _get_single_product_byCategory($search_cat_id,$scat_id)
    {
        $this->db->select('*');
        $this->db->where('category_id',$search_cat_id);
        $this->db->where('subcategory_id',$scat_id);
        $result =  $this->db->get('product_list')->result();
        return $result;
    }

	
    //Product List By Single Id
    public function _get_single_product($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $result =  $this->db->get('product_list')->result();
        return $result;
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
	
		//GEt User List
    public function _get_user_list($id)
    {

            $this->db->select('*');
            $this->db->where('id', $id);
            $query = $this->db->get('user_list');
            return $query->result();

    }
	
	 public function get_order_list($order_id)
    {
        $this->db->select('*');
        if($order_id > 0)
        {
            $this->db->where('order_id',$order_id);
        }
        
        //$this->db->order_by('order_id','desc');
        //$this->db->where('order_track','');
        //$this->db->group_by('user_id');

        $query =  $this->db->get('order_list');
        return $query->result();
    }
	
	
	

    //Get Trans Code Distribution	
    public function _get_trans_code()
    {
        $this->db->select(array('trans_code	','id'));
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $result = $this->db->get('inv_distribution');
        if( $result->num_rows() > 0 )
        {
            $last_num = $result->row_array();
            return $last_num['trans_code'];
        }
        else
        {
            return "0001";
        }
    }

    //Get Single Record by Customer
    public function _get_single_record_customer_code11($code)
    {
        $this->db->where('customer_code' ,$code);
        $query =  $this->db->get('customer');
        return $query->result();    
    }

    //Inventory Record All
    public function _this_controller_record_inventory()
    {
        //$user_type  = $this->session->userdata('user_type'); 
        //$country_id = $this->session->userdata('country_id'); 
        //$user_id    = $this->session->userdata('id'); 

        $this->db->where('is_enable' ,1); 
        $query =  $this->db->get('inv_receiving');
        return $query->result(); 
    } 
    public function _get_single_record_byid($id,$table)
    {
        $this->db->where('id' ,$id);
        $query =  $this->db->get($table);
        return $query->result();    
    }
    //Inventory Record by Id
    public function _get_single_inventory_byid($id)
    {
        $this->db->where('id' ,$id);
        //$this->db->order_by($this->_order_by);
        $query =  $this->db->get('inv_receiving');
        return $query->result();    
    }
    //Customer Record All
    public function _this_controller_record_customer()
    {
        //$user_type  = $this->session->userdata('user_type'); 
        //$country_id = $this->session->userdata('country_id'); 
        //$user_id    = $this->session->userdata('id'); 

        $this->db->where('is_enable' ,1); 
        $query =  $this->db->get('customer');
        return $query->result(); 
    }
    public function _this_controller_record_customer_distribution()
    {
        //$user_type  = $this->session->userdata('user_type'); 
        //$country_id = $this->session->userdata('country_id'); 
        //$user_id    = $this->session->userdata('id'); 

        $this->db->where('is_enable'     ,1); 
        $this->db->where('r_noofcopy > ' ,0); 
        $query =  $this->db->get('customer');
        return $query->result(); 
    }

    //Check USername Exit Login Table
    public function _get_single_record_byusername($username,$id)
    {  
        $this->db->select('id,username'); 
        $this->db->where('username' ,$username);
        //$this->db->order_by($this->_order_by);
        $query =  $this->db->get('login');
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

    //Check Email Exit Login Table
    public function _get_single_record_byemail($email,$id)
    {  
        $this->db->select('id,email'); 
        $this->db->where('email' ,$email);
        //$this->db->order_by($this->_order_by);
        $query =  $this->db->get('login');
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


	
	
 //Customer Code Generator
    public function _get_customer_code_generator()
    {
        /* $this->load->helper('string');
        $get_code =  random_string('alnum',8);

        $this->db->select('*');
        $this->db->where('customer_code',$get_code);
        $result = $this->db->get('customer');
        if($result->num_rows() > 0 )
        {
        $this->_get_customer_code_generator();
        }
        else
        {
        return $get_code;
        }		 */

        $this->db->select(array('customer_code','id'));
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $result = $this->db->get('customer');
        if($result->num_rows() > 0 )
        {
            $last_num = $result->row_array();
            $initel_num = $last_num['customer_code'];
            $regi_code = ($initel_num + 1 );
            return $regi_code; 
            //return $last_num['code_no'] + 1;
            //echo "YES".$regi_code;
        }
        else
        {
            $initel_num = '100000';
            $regi_code = $initel_num + 1 ;
            return $regi_code; 
            //return 1;
            //echo "NO";
        }
    }

    //Category List
    public function category_list($parm)
    {
        $this->db->select('id,title');
        $this->db->where('is_enable',1);
        $result =  $this->db->get('category_list')->result();
        $array = array(
            '' => 'Select Category'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array; 
    }

    //Month List
    public function month_list($parm)
    {
        $this->db->select('id,title');
        $this->db->where('is_enable',1);
        $result =  $this->db->get('month_list')->result();
        $array = array(
            '' => 'Select Month'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array; 
    }

    //Year List
    public function year_list($parm)
    {
        $this->db->select('id,title');
        $this->db->where('is_enable',1);
        $result =  $this->db->get('year_list')->result();
        $array = array(
            '' => 'Select Year'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array; 
    }


    //Department List
    public function department_list($parm)
    {
        $this->db->select('id,department_name');
        $this->db->where('is_enable',1);
        $result =  $this->db->get('department_list')->result();
        $array = array(
            //'' => 'Select Department'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->department_name;
            }
        }
        return $array; 
    }

    //Distribution Channel List
    public function distribution_channel_list($parm)
    {
        $this->db->select('id,title');
        $this->db->where('is_enable',1);
        $this->db->limit(1);
        $result =  $this->db->get('distribution_channel')->result();
        /* $array = array(
           // '' => 'Select Delivery Charges'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        } */
        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array; 
    }

	//Trans Code Mailing List
    public function trans_code_mailing_list($parm)
    {
        $this->db->select('*');
    	$this->db->order_by('id','asc');
        $this->db->group_by('trans_code');
		$this->db->where('dispatch_status',0);
	    $result =  $this->db->get('inv_distribution')->result();
        $array = array(
            '' => 'Select Packed Code'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->trans_code] = $res->trans_code;
            }
        }
        return $array; 
    }
	
	//Trans Code Dispatch List
    public function trans_code_dispatch_list($parm)
    {
        $this->db->select('*');
    	$this->db->order_by('id','asc');
        $this->db->group_by('trans_code');
		$this->db->where('dispatch_status',0);
	    $result =  $this->db->get('inv_distribution')->result();
        $array = array(
            '' => 'Select Packed Code'
        );
        if($parm !=null){
            $array = array(
                //  '' => 'Select Country'
            );
        }
        if(count($result)){
            foreach($result as $res){
                $array[$res->trans_code] = $res->trans_code;
            }
        }
        return $array; 
    }
	
	
	
    //State List
    public function _state_list_by_countryid($country_id)
    {
        $this->db->select('id,state_name');
        $this->db->where('country_id',$country_id);
        $this->db->where('is_enable',1);
        return $this->db->get('state_list')->result();
    }

    //City List
    public function _city_list_by_countryid($country_id,$state_id)
    {
        $this->db->select('id,city_name');
        $this->db->where('country_id',$country_id);
        $this->db->where('state_id',$state_id);
        $this->db->where('is_enable',1);
        return $this->db->get('city_list')->result();
    }

    //Kabina List
    public function _kabina_list_by_kabinatid($kabinat_id)
    {
        $this->db->select('id,title');
        $this->db->where('kabinat_id',$kabinat_id);
        $this->db->where('is_enable',1);
        return $this->db->get('kabina_list')->result();
    }

    //Check Phone Exit Login Table
    public function _get_single_record_byphone($mobile_no,$id)
    {  
        $this->db->select('id,mobile_no'); 
        $this->db->where('mobile_no' ,$mobile_no);
        //$this->db->order_by($this->_order_by);
        $query =  $this->db->get('login');
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

    //Get Distribution
    public function _get_category_channel_list($category_id,$dis_channel_id)
    {
        $this->db->select('*');
        $this->db->from('category_channel');
        $this->db->where('category_id',$category_id);
        $this->db->where('dis_channel_id',$dis_channel_id);
        return $result = $this->db->get()->result();

    }

    //Get Customer Searching Payment
    public function _payment_receiving_search($search_payment)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_code',$search_payment);
        $this->db->or_where('mobile_no',$search_payment);
        return $result = $this->db->get()->result();

    }



    //Get Relation  Type Prefix
    public function get_relation_prefix($relation_id)
    {

        $this->db->select('*');
        $this->db->from('relation_type');
        $this->db->where('id',$relation_id);
        return $result = $this->db->get()->result();

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
        //$this->db->where('is_enable',1);
        $result =  $this->db->get($table)->result();
        return $result[0]->$column;

    }

/* 	//Check relation reference Multiple 
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
 */


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

    //Change Category Status
    public function _change_category_status($id,$status)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;
            $update =  $this->db_command($data,$id,'building_expense_list');
            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }
    }

    //Change Product Status
    public function _change_product_status($id,$status)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;

            $this->db->set($data);
            $this->db->where('id', $id);
            $update =  $this->db->update('product_list');

            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }
    }

    //Change Discount Status
    public function _change_discount_status($id,$status)
    {
        if($id != null)
        {
            $data['discount_status'] = $status;
            $update =  $this->db_command($data,$id,'product_list');
            if($update)
            {
                return 1;
            }else
            {
                return 0;
            }
        }
    }
}
?>
