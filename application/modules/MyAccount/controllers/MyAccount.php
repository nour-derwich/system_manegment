<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyAccount extends MX_Controller  {

    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->model('Mdl_myaccount');
        $this->load->module('Hierarchy');
        #    $this->lang->load('ur',false);
    }
    public function index()
    {
        $id = $this->session->userdata('id');
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_myaccount->_get_single_record_byid($id);
        }

        $data['content']   = 'MyAccount/action';
        $this->load->view('Template/template',$data);
    }
    //Change City List by State Id
    public function get_state_city_byid()
    {
        $country_id         =  $this->input->post('country_id');
        $state_id         =  $this->input->post('state_id');
        $data['result_set'] = $this->Mdl_myaccount->city_list_by_state($country_id,$state_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
        endforeach;
        echo $option;
    }

    public function command()
    {
        if($this->session->userdata('user_type') == 'seller')
        {
            $post = $this->input->post();
            if ($post['password']): $data['password'] = Modules::run('Login/_hash', $post['password']); endif;
            $data['email'] = $post['email'];
            $data['firstname'] = $post['firstname'];
            $data['lastname'] = $post['lastname'];
            $data['gender'] = $post['gender'];
            $data['mobile'] = $post['mobile'];
            $data['telephone'] = $post['telephone'];
            $data['company'] = $post['company'];
            $data['address'] = $post['address'];
            $data['state_id'] = $post['state_id'];
            $data['city_id'] = $post['city_id'];
            $data['postal_code'] = $post['postal_code'];
            //$data['ip_address'] = $this->input->ip_address();
            #  $this->Mdl_myaccount->debug_r($data,1);
            $db_command = $this->Mdl_myaccount->db_command($data, $post['id'], 'seller_list');
            if ($db_command) {
                if ($post['id'] != null) {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                } else {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }

                redirect(base_url() . 'MyAccount', 'refresh');
            }
        }
        else {


            $post = $this->input->post();
            if ($post['password']): $data['password'] = Modules::run('Login/_hash', $post['password']); endif;
            $data['email'] = $post['email'];
            $data['mobile_no'] = $post['mobile_no'];
            $data['ip_address'] = $this->input->ip_address();
            #  $this->Mdl_myaccount->debug_r($data,1);
            $db_command = $this->Mdl_myaccount->db_command($data, $post['id'], 'login');
            if ($db_command) {
                if ($post['id'] != null) {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                } else {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }

                redirect(base_url() . 'MyAccount', 'refresh');
            }
        }

    } 
    public function check_user_exists()
    {
        $post               =  $this->input->post();
        $username           =  $post['username'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_myaccount->_get_single_record_byusername($username,$id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return; 

    }
    public function change_user_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_myaccount->_change_user_status($id,$status);
        $return             = json_encode($_return);
        echo $return; 

    }  

    //User Print Status
    public function change_user_is_print()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_myaccount->_change_user_is_print($id,$status);
        $return             = json_encode($_return);
        echo $return; 
    } 


    public function delete($id)
    {
        $delete = $this->Mdl_myaccount->_delete($id);

        if($delete == 1)
        {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!'); 
        }else
        {
            $this->session->set_flashdata('error', 'No record found for Deleting !');   
        }
        redirect(base_url().'MyAccount','refresh');  
    }  
    public function data_permission()
    {
        $data['permission_view'] = $this->hierarchy_list();   
        $data['content']    = 'MyAccount/data_permission';
        $this->load->view('Template/template',$data);
    }
    public function module_permission()
    {
        $data['permission_view'] = $this->menulist();   
        $data['content']    = 'MyAccount/module_permission';
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
        #  $this->Mdl_myaccount->debug_r($permission,1); 
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



                    # $this->Mdl_myaccount->debug_r($permission,1);  
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
        #  $this->Mdl_myaccount->debug_r($postdata,1); 
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
        #  $this->Mdl_myaccount->debug_r($permission_json,0);   

        $id  = $this->already_exists_row('admin_module_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_myaccount->debug_r($data,0);   
        $db_command =  $this->Mdl_myaccount->db_command($data,$id,'admin_module_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'MyAccount','refresh');  
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
        #$this->Mdl_myaccount->debug_r($postdata,1); 
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
        # $this->Mdl_myaccount->debug_r($permission_json,1);


        $id  = $this->already_exists_row('admin_data_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_myaccount->debug_r($data,0);   
        $db_command =  $this->Mdl_myaccount->db_command($data,$id,'admin_data_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'MyAccount','refresh');  
        }
    } 
}
