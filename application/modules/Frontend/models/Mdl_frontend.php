<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_frontend extends CI_Model {

    protected $_table_name     = 'login';
    protected $_order_by       = 'id';
    protected $_primary_column = 'id';


    function __construct()
    {
        parent::__construct();
    }

//System Setting List
    public function get_system_setting_list()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $result = $this->db->get('system_setting_list')->result();
        return $result;
    }
	 //Pages List
    public function get_pages()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $result = $this->db->get('pages_list')->result();
        return $result;
    }
	
		 //Adds List
    public function get_adds()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $this->db->limit('12');
        $result = $this->db->get('adds_list')->result();
        return $result;
    }
	
	
    //Get Admin Email
    public function _get_admin_email()
    {
        $this->db->where('user_type' ,1);
        $query =  $this->db->get('login');
        return $query->result();
    }

    //Get User Detail
    public function _get_user_detail($id)
    {
        $this->db->where('id' ,$id);
        $query =  $this->db->get('user_list');
        return $query->result();
    }


    //Categories List
    public function get_category()
    {
        $this->db->select('*');
        $this->db->where('parent_category_id',0);
        $this->db->where('is_enable',1);
        $this->db->order_by('sort_order','asc');
        $result = $this->db->get('category_list')->result();
        return $result;
    }
	
	 //Categories List
    public function get_company_category()
    {
        $this->db->select('*');
       // $this->db->where('parent_category_id',0);
        $this->db->where('is_enable',1);
        //$this->db->order_by('sort_order','asc');
        $result = $this->db->get('company_category_list')->result();
        return $result;
    }
	
	

    //Sub Categories List
    public function get_sub_category($id)
    {
        $this->db->select('*');
        $this->db->where('parent_category_id',$id);
        $this->db->where('is_enable',1);
        $this->db->order_by('sort_order','asc');
        $result = $this->db->get('category_list');
        $row   = $result->num_rows();
        if($row > 0)
        {
            return $result->result();
        }
        else
        {
            return $row;
        }

    }

    //Sub Categories List
    public function get_sub_category_list($catid,$scatid)
    {
        $this->db->select('*');
        $this->db->where('id',$scatid);
        $this->db->where('parent_category_id',$catid);
        $this->db->where('is_enable',1);
        $this->db->order_by('sort_order','asc');
        $result = $this->db->get('category_list');
        $row   = $result->num_rows();
        if($row > 0)
        {
            return $result->result();
        }
        else
        {
            return $row;
        }

    }

    //Get Product List Count
    public function get_product_list_record_count($catid,$scatid)
    {
        $this->db->select('*');
        if($catid >0)
        {
            $this->db->where('category_id',$catid);
        }
        if($scatid > 0)
        {
            $this->db->where('subcategory_id',$scatid);
        }
        $this->db->where('is_enable',1);
        $result = $this->db->get('product_list');
        $row   = $result->num_rows();
        if($row > 0)
        {
            return $row;
        }
        else
        {
            return $row;
        }
    }

    //Sub Product List Page
    public function get_product_page_list($scatid,$limit, $start)
    {
        $this->db->select('*');
        if($scatid > 0)
        {
            $this->db->where('subcategory_id',$scatid);
        }
        $this->db->where('is_enable',1);
        $this->db->limit($limit, $start);
        $result = $this->db->get('product_list');
        $row   = $result->num_rows();
        //return $this->db->last_query();
        //exit;
        if($row > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }

    }


    //Sub Product List
    public function get_product_list($catid,$scatid,$orderby,$limit)
    {
        $this->db->select('*');
        if($catid >0)
        {
            $this->db->where('category_id',$catid);
        }
        if($scatid > 0)
        {
            $this->db->where('subcategory_id',$scatid);
        }
        $this->db->where('is_enable',1);
        if($orderby != '')
        {
            $this->db->order_by($orderby);
        }
        else
        {
            $this->db->order_by('id','desc');
        }

        if($limit != '')
        {
            $this->db->limit($limit);
        }

        $result = $this->db->get('product_list');
        $row   = $result->num_rows();
        if($row > 0)
        {
            return $result->result();
        }
        else
        {
            return $row;
        }

    }

    //Get Single Product By ID
    public function get_single_product_byname($name)
    {
        $this->db->select('*');
        $this->db->where('product_name',$name);
        $this->db->where('is_enable',1);
        $query =  $this->db->get('product_list')->result();
        return $query;
    }

    //Get Single Product By Product Code
    public function get_single_product_by_productcode($code)
    {
        $this->db->select('*');
        $this->db->where('product_code',$code);
        $this->db->where('is_enable',1);
        $query =  $this->db->get('product_list')->result();
        return $query;
    }

    //Get Single Product By Product ID
    public function get_single_product_by_productid($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->where('is_enable',1);
        $query =  $this->db->get('product_list')->result();
        return $query;
    }

    //Get Product Search Count
    public function get_product_search_count($search)
    {
        $this->db->select('*');
        $this->db->where("product_name LIKE '%$search%'");
        $this->db->where('is_enable',1);
        $result = $this->db->get('product_list');
        $row   = $result->num_rows();
        return $row;
    }

    //Get Product Search Result
    public function get_product_search_result($search,$limit, $start)
    {


            $this->db->select('*');
            $this->db->where("product_name LIKE '%$search%'");
            $this->db->where('is_enable',1);
            $this->db->limit($limit, $start);
            $result = $this->db->get('product_list');
            $row   = $result->num_rows();
            //return $this->db->last_query();
            if($row > 0)
            {
                return $result->result();
                //return $this->db->last_query();
            }
            else
            {
                return false;
            }


    }
    //Logo List
    public function get_logo()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $result = $this->db->get('logo_list')->result();
        return $result;
    }
    //Slider List
    public function get_slider()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $result = $this->db->get('slider_list')->result();
        return $result;
    }

    //Brand List
    public function get_brand()
    {
        $this->db->select('*');
        $this->db->where('is_enable',1);
        $this->db->limit('12');
        $result = $this->db->get('brand_list')->result();
        return $result;
    }
	
	//Brand List
    public function get_brand_by_category($company_id,$category_id)
    {
        $this->db->select('*');
        $this->db->where('company_id',$company_id);
        $this->db->where('category_id',$category_id);
        $this->db->where('is_enable',1);
     //   $this->db->limit('12');
        $result = $this->db->get('brand_list')->result();
        return $result;
    }

    //Siderbar Product List
    public function get_product_sidebar_list($order_column,$order_by,$limit)
    {
       // return $order_column." == ".$order_by;

        $this->db->select('*');
        if($order_column != '' && $order_by != '')
        {
            $this->db->order_by($order_column,$order_by);
        }
        else if($order_by > 0)
        {
            $this->db->order_by('id',$order_by);
        }
        $this->db->where('is_enable',1);
        if($limit > 0)
        {
            $this->db->limit($limit);
        }
        //$this->db->order_by('id','desc');
        $result = $this->db->get('product_list');
        //return $this->db->last_query();
        $row   = $result->num_rows();
        if($row > 0)
        {
            return $result->result();
        }
        else
        {
            return $row;
        }


    }


    //State_list
    public function state_list($country_id)
    {
        $this->db->select('id,state_name');
        $this->db->where('country_id',$country_id);
        $this->db->where('is_enable',1);
        $result =  $this->db->get('state_list')->result();
        $array = array(
            '' => 'Select State'
        );

        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->state_name;
            }
        }
        return $array;
    }

    //City List by State
    public function city_list_by_state($country_id,$state_id)
    {
        $this->db->select('id,title');
        $this->db->where('country_id',$country_id);
        $this->db->where('state_id',$state_id);
        $this->db->where('is_enable',1);
        $result =  $this->db->get('city_list')->result();
        $array = array(
            '' => 'Select City'
        );

        if(count($result)){
            foreach($result as $res){
                $array[$res->id] = $res->title;
            }
        }
        return $array;
    }

    public function _this_controller_record ()
    {
        $user_type  = $this->session->userdata('user_type'); 
        $country_id = $this->session->userdata('country_id'); 
        $user_id    = $this->session->userdata('id'); 

        $this->db->where('user_type !=' ,0); 
        $this->db->where('id !=' ,$this->session->userdata('id')); 

        //  $this->db->where('id !=' ,$this->session->userdata('id')); 

        /* if($user_type == 2)
        {
        $this->db->where('created_by' ,$user_id);   

        }  */


        $this->db->order_by($this->_order_by);

        $query =  $this->db->get($this->_table_name);
        return $query->result(); 
    } 

    //User REcord By ID
    public function get_single_user_byid($id)
    {
        $this->db->where('id' ,$id);
        $query =  $this->db->get('user_list');
        return $query->result();    
    }

    //Order Track Code Generator
    public function get_order_track_number()
    {
        $this->db->select(array('order_track','order_id'));
        $this->db->order_by('order_id','desc');
        $this->db->limit(1);
        $result = $this->db->get('order_list');
        if( $result->num_rows() > 0 )
        {
            $last_num = $result->row_array();
            $initel_num = $last_num['order_track'];
            $regi_code = ($initel_num + 1 );
            return $regi_code;
            //return $last_num['code_no'] + 1;
            //echo "YES".$regi_code;
        }
        else
        {
            $initel_num = '100100';
            $regi_code = $initel_num + 1 ;
            return $regi_code;
            //return 1;
            //echo "NO";
        }
    }


    //GEt Cart Count
    public function get_card_total($user_id)
    {
        $this->db->select('*');
        $this->db->where('user_id' ,$user_id);
        $this->db->where('cart_type' ,'cart');
        $this->db->where('cart_status' ,'pending');
        $this->db->where('order_track' ,'');
        $query =  $this->db->get('cart_list');
        $row   = $query->num_rows();
        if($row > 0)
        {
            $result = $query->result();
            return $result;
        }
        else
        {
            return $row;
        }
    }

    //GEt Order Total
    public function get_order_list($user_id)
    {
        $this->db->select('*');
        $this->db->where('user_id' ,$user_id);
       // $this->db->where('cart_type' ,'cart');
       // $this->db->where('cart_status' ,'pending');
       // $this->db->where('order_track' ,'');
        $query =  $this->db->get('order_list');
        $row   = $query->num_rows();
        if($row > 0)
        {
            $result = $query->result();
            return $result;
        }
        else
        {
            return $row;
        }
    }

    //order History
    public function get_order_history($track_order)
    {
        $this->db->select('*');
        $this->db->where('order_track' ,$track_order);
        // $this->db->where('cart_type' ,'cart');
        // $this->db->where('cart_status' ,'pending');
         $this->db->order_by('id' ,'desc');
        $query =  $this->db->get('order_history_list');
        $row   = $query->num_rows();
        if($row > 0)
        {
            $result = $query->result();
            return $result;
        }
        else
        {
            return $row;
        }
    }
    //Product Single Record By ID
    public function get_single_record_by_productid($id)
    {
        $this->db->where('id' ,$id);
        $query =  $this->db->get('product_list');
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

    public function _change_user_email($email)
    {
        $this->db->select('*');
        $this->db->where('email' ,$email);
        $this->db->where('user_type!=' ,'order');
        $query =  $this->db->get('user_list');
        $row   = $query->num_rows();
            if($row > 0)
            {
                return 1;
            }
            else
            {
                return 0;
            }

    }

    public function _check_seller_user($username)
    {
        $this->db->select('*');
        $this->db->where('username' ,$username);
        $query =  $this->db->get('seller_list');
        $row   = $query->num_rows();
        if($row > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }


    public function logout_user()
    {
        $this->session->sess_destroy();
    }



    public function hash($string) {
        return hash ( 'sha512', $string . config_item ( 'encryption_key' ) );
    }




    public function _change_user_status($id,$status)
    {
        if($id != null)
        {
            $data['is_enable'] = $status;  
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

    //check relation reference multiple
    public function get_relation_pax_multiple($table,$column,$wheres)
    {
        $this->db->select($column);
        //$this->db->where($reference,$input);
        foreach($wheres as $key_wh => $wh):
            $this->db->where($key_wh,$wh);
        endforeach;
        $this->db->where('is_enable',1);
        $result =  $this->db->get($table)->result();
        return $result[0]->$column;

    }

    //Check already Exit
    public function check_already_exists($column,$value,$table)
    {
        $this->db->select('*');
        $this->db->where($column,$value);
        $query =  $this->db->get($table);
        $count = $query->num_rows();
        return array(
            'row_count' => $count,
            'result_data' => $query->result()
        );
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
    public function db_delete($id,$table)
    {
        $this->db->where($this->_primary_key, $id);
        $delete =  $this->db->delete($table);
        if($delete)
        {
            return 1;
        }else
        {
            return 0;
        }
    }

}
?>
