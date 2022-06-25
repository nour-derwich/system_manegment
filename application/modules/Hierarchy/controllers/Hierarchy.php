<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hierarchy extends MX_Controller  
{

    private $pakkabina_db; 


    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->model('Mdl_hierarchy'); 
    }
    public function index()
    {   
        redirect(base_url().'Dashboard','refresh');  
    } 

	
	
	public function floor_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Floor Managment','small'=>'Floor list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/floor_list','List_View' => 'Hierarchy/floor_list','edit' => 'Hierarchy/action/floor_list',
                'command'    => 'Hierarchy/command/floor_list'); 
            $param_view['column']  = array(  
                'floor_no'      =>'Floor No',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'floor_no'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'floor_no'      =>'Floor No',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'Floor Managment','small'=>'Floor list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/floor_list','delete' => 'Hierarchy/delete/floor_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'floor_no'      =>'Floor No',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 

    //Unit List 
    public function unit_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'Unit Managment','small'=>'Unit list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/unit_list',
                'List_View' => 'Hierarchy/unit_list',
                'edit' => 'Hierarchy/action/unit_list',
                'command'      => 'Hierarchy/command/unit_list'); 
 $param_view['fillter'] ['Floor']   = array(
                'table'  =>  'floor_list',
                'name'   =>  'floor_id',
                'class'  =>  'required-field',
                'type'   =>   1,
            );  
			
			  $param_view['relation'][]   = array(
                'table'   =>  'unit_list',
                'ref'     =>  'id',
                'column'  =>  'floor_id',
                'dropdown'=>  'floor_list',
            );   
            $param_view['relation_ref'] = array(


                //'state_list'     =>  'country_list',
                'unit_list'     =>  'floor_list',    

            ); 
			
			
           /*  $param_view['fillter'] ['Floor']   = array(
                'table'  =>  'floor_list',
                'name'   =>  'floor_id',
                'class'  =>  'required-field',
                'type'   =>   1,
            );  

            $param_view['relation'][]   = array(
                'table'   =>  'unit_list',
                'ref'     =>  'id',
                'column'  =>  'floor_id',
                'dropdown'=>  'floor_list',
            );  
            $param_view['relation_ref'] = array(
                'floor_list'     =>  'unit_list',

            ); */

            $param_view['column']     = array(  

                //  'state_code'              =>'State Code',
                'unit_no'             =>'Unit No',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //  'state_code'       =>'State Code',
                'unit_no'      =>'Unit No',
            );
            $param_view['input_validation']=array(
                //  'state_code'              =>'required-field',
                'unit_no'             =>'required-field',
            );                            
            ######      ######       ######  

            return $param_view; 
        }
        else
        {

            /* $data_post = $this->input->post();
            if($data_post != null)
            {
                //print_r($data_post);


                $param_view['where']  = array(
                    'flor_id'  => $data_post['country_id'],
                    'state_id'    => $data_post['state_id'],

                );

                $param_view['heading'] = array('h1'   => 'State Managment','small'=>'State List'); 
                $param_view['links']   = array('edit' => 'Hierarchy/action/state_list','delete' => 'Hierarchy/delete/state_list'); 
                $param_view['column']  = array(  
                    'country_id' => 'Country Name',
                    'state_name'             =>'State Name',
                    //    'state_code'              =>'State Code'
                );  
                $param_view['relation_data']['country_id']=array(
                    'tbl'=>'country_list',
                    'rel'=>'country_id',
                    'col'=>'country_name'

                );                             

                ######      ######       ######  
                $uri                   = $this->uri->segment(2);
                $this->load_hierarchy($uri,$param_view); 							

            }
            else
            { */
                //Filter Data
             /*    $param_view['fillter'] ['Country']   = array(
                    'table'  =>  'country_list',
                    'name'   =>  'country_id',
                    'class'  =>  'country_id required-field',
                    'type'   =>   1,
                );
                $param_view['fillter_links']      = array('action'    => 'Hierarchy/command/state_list',
                    'List_View' => 'Hierarchy/state_list',
                    'edit' => 'Hierarchy/action/state_list',
                    'command'      => 'Hierarchy/get_state_by_country',
                    'btn_click'   => 'filter_state'
                );  */


                $param_view['heading'] = array('h1'   => 'Unit Managment','small'=>'Unit List'); 
                $param_view['links']   = array('edit' => 'Hierarchy/action/unit_list','delete' => 'Hierarchy/delete/unit_list'); 
                $param_view['column']  = array(  
                    'floor_id' => 'Floor No',
                    'unit_no'             =>'Unit No',
                    //    'state_code'              =>'State Code'
                );  
                $param_view['relation_data']['floor_id']=array(
                    'tbl'=>'floor_list',
                    'rel'=>'floor_id',
                    'col'=>'floor_no'

                );                             

                ######      ######       ######  
                $uri                   = $this->uri->segment(2);
                $this->load_hierarchy($uri,$param_view);    
            /* } */
        }   

    }

	
	
	//System Setting List
	public function system_setting_list($param)
    {

        $uri                   = $this->uri->segment(2);
		//Action Add & Edit
        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'System Setting','small'=>'System Setting List');
            $param_view['links']   = array('action'     => 'Hierarchy/command/system_setting_list','List_View' => 'Hierarchy/system_setting_list','edit' => 'Hierarchy/action/system_setting_list', 'command'    => 'Hierarchy/command/system_setting_list');
			
			//Show Add New Field Button
			$param_view['show_button'] = array
            (              
                'add'          => 0,              
                
            );
			
			//Show and hide Status 
			$param_view['show_status_button'] = array
            (              
                'status'          => 0,              
                
            );
			
			//Column Pax
            $param_view['column']  = array
			(
                'system_name'    =>'System Name',
                'system_title'   =>'System Title',              
                'short_address'  => 'Short Address',
                'long_address'   => 'Long Address',
                'mobile'         => 'Mobile',
                'email'          => 'Email',
                'website'          => 'Website',
               // 'map_location'   => 'Map Location',
               // 'system_image'   => 'System Image',
                //'is_enable'    =>'Active Status',
            );
			
			//Unique Pax
            $param_view['unique']  = array(

                
            );
			//Add Extra Class
            $param_view['add_class']  = array(

                
            );
			//Add input Validation
            $param_view['input_validation'] = array
            (
				 'system_name'    =>'System Name',
                'system_title'   =>'System Title',              
                'short_address'  => 'Short Address',
                'mobile'         => 'Mobile',
                'email'          => 'Email',
                'website'          => 'Website'
            );
			//Add Input Type
			$param_view['input_type']  = array
			(
			    'short_address'  =>'textarea',
                'long_address'   =>'textarea',
            );
			//Add Input Image
     		$param_view['input_image']  = array
			(					
                'system_image'   =>'System Image',
            );
            ######      ######       ######
			
            return $param_view;
        } //show Record Table
        else
        {
            $param_view['heading'] = array('h1'   => 'System Setting','small'=>'System Setting List');
            $param_view['links']   = array('edit' => 'Hierarchy/action/system_setting_list','delete' => 'Hierarchy/delete/system_setting_list');
            //Show Column
			$param_view['column']  = array
            (
               'system_name'    =>'System Name',
                'system_title'   =>'System Title',              
                'short_address'  => 'Short Address',
                'long_address'   => 'Long Address',
                'mobile'         => 'Mobile',
                'email'          => 'Email',
                'website'          => 'Website',
               // 'map_location'   => 'Map Location',
                'system_image'   => 'System Image',
			
            );
			//Show My Other Fields
			$param_view['show_column'] = array
            (              
                'image'          => 'System Image',              
                'link'           => 'Map Location',              
               // 'status'         =>array( 'value' => 'Status' , 'class' => ''),
				'action'         => array( 'value' => 'Action' , 'edit' => 1 , 'delete' => 0 ),
            );
			//Show Add New Field Button
			$param_view['show_button'] = array
            (              
                'add'          => 0,              
                
            );
           /*  //Where Condition
            $param_view['where']  = array(
                'input'                => $this->session->userdata('language'),
                'ref'                => 'language_id',
            ); */
            //Show Drop Down Language
            $param_view['show_language'] = array
            (
                'show'          => 1,
            );
            ######      ######       ######

            $this->load_hierarchy($uri,$param_view);
        }

    }
	
	
		//Pages List
	 public function pages_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Pages Managment','small'=>'Pages list Edit');
            $param_view['links']   = array('action'     => 'Hierarchy/command/pages_list','List_View' => 'Hierarchy/pages_list','edit' => 'Hierarchy/action/pages_list',
                'command'    => 'Hierarchy/command/pages_list');

			//Show Add New Field Button
			$param_view['show_button'] = array
            (              
                'add'          => 0,              
                
            );
			 //Read Only Column
            $param_view['field_readonly'] = array
            (
                'page_name'          => 'readonly',
            );
            $param_view['column']  = array(
				 'page_name'             =>'Page Name',
                'sub_title'             =>'Sub Title',
                'title'             =>'Title',
                'short_description'        => 'Short Description',
                'long_description'        => 'Description',
                //'pages_image'        => 'Pages Image'
            );
            $param_view['unique']  = array(

                //'title'      =>'Title',
              //  'form_reason_id'      =>'Form Reason',
            );
            $param_view['add_class']  = array(

                //'valid_date'      => 'Valid Date',
            );
            $param_view['input_validation'] = array
            (
			 'page_name'             =>'Page Name',
                'sub_title'          =>'Sub Title',
                'title'          =>'Title',
              //  'valid_date'     => 'Valid Date',
            );
			$param_view['input_type']  = array(
					
                 'short_description'             =>'textarea',
                 'long_description'             =>'textarea',
            );
			 $param_view['input_image']  = array(					
                 'pages_image'             =>'Pages Image',
            );
            ######      ######       ######

            return $param_view;
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Pages Managment','small'=>'Pages list');
            $param_view['links']   = array('edit' => 'Hierarchy/action/pages_list','delete' => 'Hierarchy/delete/pages_list');
            $param_view['column']  = array
            (
              'page_name'             =>'Page Name',
                'sub_title'             =>'Sub Title',
                'title'             =>'Title',
              //  'pages_image'        => 'Pages Image',
               'short_description'        => 'Short Description',
                'long_description'        => 'Description',
            // 'is_enable'    => 'Status',
			//	'action'         => 'Action',
            );
			//Show My Other Fields
			$param_view['show_column'] = array
            (              
                'image'          => 'Pages Image',              
                'link'           => '',              
                'status'         =>array( 'value' => 'Status' , 'class' => ''),
				'action'         => array( 'value' => 'Action' , 'edit' => 1 , 'delete' => 0 ),
            );
			//Show Add New Field Button
			$param_view['show_button'] = array
            (              
                'add'          => 0,              
                
            );
            ######      ######       ######

            $this->load_hierarchy($uri,$param_view);
        }

    }

	
    public function country_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Country Managment','small'=>'Country list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/country_list','List_View' => 'Hierarchy/country_list','edit' => 'Hierarchy/action/country_list',
                'command'    => 'Hierarchy/command/country_list'); 
            $param_view['column']  = array(  
                'country_name'      =>'Country Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'country_name'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'country_name'      =>'Country Name',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'Country Managment','small'=>'Country list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/country_list','delete' => 'Hierarchy/delete/country_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'country_name'      =>'Country Name',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 

    //State List 
    public function state_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'State Managment','small'=>'State list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/state_list',
                'List_View' => 'Hierarchy/state_list',
                'edit' => 'Hierarchy/action/state_list',
                'command'      => 'Hierarchy/command/state_list'); 

            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'country_id required-field',
                'type'   =>   1,
            );  

            $param_view['relation'][]   = array(
                'table'   =>  'state_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );  
            $param_view['relation_ref'] = array(
                'state_list'     =>  'country_list',

            );

            $param_view['column']     = array(  

                //  'state_code'              =>'State Code',
                'state_name'             =>'State Name',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //  'state_code'       =>'State Code',
                'state_name'      =>'State Name',
            );
            $param_view['input_validation']=array(
                //  'state_code'              =>'required-field',
                'state_name'             =>'required-field',
            );                            
            ######      ######       ######  

            return $param_view; 
        }
        else
        {

            $data_post = $this->input->post();
            if($data_post != null)
            {
                //print_r($data_post);


                $param_view['where']  = array(
                    'country_id'  => $data_post['country_id'],
                    'state_id'    => $data_post['state_id'],

                );

                $param_view['heading'] = array('h1'   => 'State Managment','small'=>'State List'); 
                $param_view['links']   = array('edit' => 'Hierarchy/action/state_list','delete' => 'Hierarchy/delete/state_list'); 
                $param_view['column']  = array(  
                    'country_id' => 'Country Name',
                    'state_name'             =>'State Name',
                    //    'state_code'              =>'State Code'
                );  
                $param_view['relation_data']['country_id']=array(
                    'tbl'=>'country_list',
                    'rel'=>'country_id',
                    'col'=>'country_name'

                );                             

                ######      ######       ######  
                $uri                   = $this->uri->segment(2);
                $this->load_hierarchy($uri,$param_view); 							

            }
            else
            {
                //Filter Data
                $param_view['fillter'] ['Country']   = array(
                    'table'  =>  'country_list',
                    'name'   =>  'country_id',
                    'class'  =>  'country_id required-field',
                    'type'   =>   1,
                );
                $param_view['fillter_links']      = array('action'    => 'Hierarchy/command/state_list',
                    'List_View' => 'Hierarchy/state_list',
                    'edit' => 'Hierarchy/action/state_list',
                    'command'      => 'Hierarchy/get_state_by_country',
                    'btn_click'   => 'filter_state'
                ); 


                $param_view['heading'] = array('h1'   => 'State Managment','small'=>'State List'); 
                $param_view['links']   = array('edit' => 'Hierarchy/action/state_list','delete' => 'Hierarchy/delete/state_list'); 
                $param_view['column']  = array(  
                    'country_id' => 'Country Name',
                    'state_name'             =>'State Name',
                    //    'state_code'              =>'State Code'
                );  
                $param_view['relation_data']['country_id']=array(
                    'tbl'=>'country_list',
                    'rel'=>'country_id',
                    'col'=>'country_name'

                );                             

                ######      ######       ######  
                $uri                   = $this->uri->segment(2);
                $this->load_hierarchy($uri,$param_view);    
            }
        }   

    }

    //City List 
    public function city_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'City Managment','small'=>'City list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/city_list',
                'List_View' => 'Hierarchy/city_list',
                'edit' => 'Hierarchy/action/city_list',
                'command'      => 'Hierarchy/command/city_list'); 

            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'required-field',
                'type'   =>   1,
            );  
          /*   $param_view['fillter'] ['State']   = array(
                'table'  =>  'state_list',
                'name'   =>  'state_id',
                'class'  =>  'state_id required-field',
                'type'   =>   0,
            );    */                                           

           /*  $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'state_id',
                'dropdown'=>  'state_list',
            );   */

             $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );   
            $param_view['relation_ref'] = array(


                //'state_list'     =>  'country_list',
                'city_list'     =>  'country_list',    

            ); 

            $param_view['column']     = array(  

                // 'code'              =>'City Code',
                'city_name'             =>'City Name',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //  'code'       =>'City Code',
                'city_name'      =>'City Name',
            );
            $param_view['input_validation']=array(
                //  'code'              =>'required-field',
                'city_name'             =>'required-field',
            );                            
            ######      ######       ######  

            return $param_view; 
        }
        else
        {
			$data_post = $this->input->post();
            if($data_post != null)
            {
                //print_r($data_post);


                $param_view['where']  = array(
                    'country_id'  => $data_post['country_id'],
                   // 'state_id'    => $data_post['state_id'],

                );

				$param_view['heading'] = array('h1'   => 'City Managment','small'=>'City List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/city_list','delete' => 'Hierarchy/delete/city_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
				//	'state_id' => 'State Name',
					'title'             =>'City Name',
					//   'code'              =>'City Code'
				);  
				$param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				/* $param_view['relation_data']['state_id']=array(
					'tbl'=>'state_list',
					'rel'=>'state_id',
					'col'=>'state_name'

				);  */                            

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    						

            }
            else
            {

				$param_view['fillter'] ['Country']   = array(
					'table'  =>  'country_list',
					'name'   =>  'country_id',
					'class'  =>  'country_id required-field',
					'type'   =>   1,
				);  
				/* $param_view['fillter'] ['State']   = array(
					'table'  =>  'state_list',
					'name'   =>  'state_id',
					'class'  =>  'state_id',
					'type'   =>   1,
				); */
				$param_view['fillter_links']      = array('action'    => 'Hierarchy/command/city_list',
					'List_View' => 'Hierarchy/city_list',
					'edit' => 'Hierarchy/action/city_list',
					'command'      => 'Hierarchy/city_list',
					'btn_click'   => 'filter_city'
				); 


				$param_view['heading'] = array('h1'   => 'City Managment','small'=>'City List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/city_list','delete' => 'Hierarchy/delete/city_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
					//'state_id' => 'State Name',
					'city_name'             =>'City Name',
					//   'code'              =>'City Code'
				);  
				/* $param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				$param_view['relation_data']['state_id']=array(
					'tbl'=>'state_list',
					'rel'=>'state_id',
					'col'=>'state_name'

				);                   */           

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    
			}
        }
    }

	    //Branch List 
    public function branch_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'Branch Managment','small'=>'Branch list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/branch_list',
                'List_View' => 'Hierarchy/branch_list',
                'edit' => 'Hierarchy/action/branch_list',
                'command'      => 'Hierarchy/command/branch_list'); 

           /* $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'city_get required-field',
                'type'   =>   1,
            );  
             $param_view['fillter'] ['City']   = array(
                'table'  =>  'city_list',
                'name'   =>  'city_id',
                'class'  =>  'city_id required-field',
                'type'   =>   0,
            );                                               


             $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );   

             $param_view['relation'][]   = array(
                'table'   =>  'branch_list',
                'ref'     =>  'id',
                'column'  =>  'branch_id',
                'dropdown'=>  'branch_list',
            );   
            $param_view['relation_ref'] = array(


                'city_list'     =>  'country_list',
                'branch_list'     =>  'city_list',    

            ); 
*/

            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'city_get required-field',
                'type'   =>   1,
            );  
            $param_view['fillter'] ['City']   = array(
                'table'  =>  'city_list',
                'name'   =>  'city_id',
                'class'  =>  'city_id required-field',
                'type'   =>   0,
            );                                              

            $param_view['relation'][]   = array(
                'table'   =>  'branch_list',
                'ref'     =>  'id',
                'column'  =>  'city_id',
                'dropdown'=>  'city_list',
            );  

            $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );  
            $param_view['relation_ref'] = array(


                'city_list'     =>  'country_list',
                'branch_list'     =>  'city_list',    

            ); 

			
			
            $param_view['column']     = array(  

                // 'code'              =>'City Code',
                'branch_name'             =>'Branch Name',
                'branch_code'             =>'Branch Code',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //  'code'       =>'City Code',
                'branch_name'      =>'Branch Name',
                'branch_code'      =>'Branch Code',
            );
            $param_view['input_validation']=array(
                //  'code'              =>'required-field',
                'branch_name'             =>'required-field',
                'branch_code'             =>'required-field',
            );                            
            ######      ######       ######  

            return $param_view; 
        }
        else
        {
			$data_post = $this->input->post();
            if($data_post != null)
            {
                //print_r($data_post);


                $param_view['where']  = array(
                    'country_id'  => $data_post['country_id'],
                    'city_id'    => $data_post['city_id'],

                );

				$param_view['heading'] = array('h1'   => 'City Managment','small'=>'City List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/city_list','delete' => 'Hierarchy/delete/city_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
					'city_id' => 'City Name',
					'branch_name'             =>'Branch Name',
					//   'code'              =>'City Code'
				);  
				$param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				 $param_view['relation_data']['city_id']=array(
					'tbl'=>'city_list',
					'rel'=>'city_id',
					'col'=>'city_name'

				);                              

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    						

            }
            else
            { 

				$param_view['fillter'] ['Country']   = array(
					'table'  =>  'country_list',
					'name'   =>  'country_id',
					'class'  =>  'city_get country_id required-field',
					'type'   =>   1,
				);  
				 $param_view['fillter'] ['City']   = array(
					'table'  =>  'city_list',
					'name'   =>  'city_id',
					'class'  =>  'city_id',
					'type'   =>   1,
				); 
				$param_view['fillter_links']      = array('action'    => 'Hierarchy/command/branch_list',
					'List_View' => 'Hierarchy/branch_list',
					'edit' => 'Hierarchy/action/branch_list',
					'command'      => 'Hierarchy/branch_list',
					'btn_click'   => 'filter_branch'
				); 


				$param_view['heading'] = array('h1'   => 'Branch Managment','small'=>'Branch List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/branch_list','delete' => 'Hierarchy/delete/branch_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
					'city_id' => 'City Name',
					'branch_name'             =>'Branch Name',
					//   'code'              =>'City Code'
				);  
				 $param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				$param_view['relation_data']['city_id']=array(
					'tbl'=>'city_list',
					'rel'=>'city_id',
					'col'=>'city_name'

				);                              

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    
			 } 
        }
    }

	
		    //Project List 
    public function project_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'Project Managment','small'=>'Project list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/project_list',
                'List_View' => 'Hierarchy/project_list',
                'edit' => 'Hierarchy/action/project_list',
                'command'      => 'Hierarchy/command/project_list'); 

            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'city_get required-field',
                'type'   =>   1,
            );  
            $param_view['fillter'] ['City']   = array(
                'table'  =>  'city_list',
                'name'   =>  'city_id',
                'class'  =>  'city_id branch_get required-field',
                'type'   =>   0,
            ); 
			$param_view['fillter'] ['Branch']   = array(
                'table'  =>  'branch_list',
                'name'   =>  'branch_id',
                'class'  =>  'branch_id required-field',
                'type'   =>   0,
            ); 			
			$param_view['relation'][]   = array(
                'table'   =>  'project_list',
                'ref'     =>  'id',
                'column'  =>  'branch_id',
                'dropdown'=>  'branch_list',
            ); 
			
            $param_view['relation'][]   = array(
                'table'   =>  'branch_list',
                'ref'     =>  'id',
                'column'  =>  'city_id',
                'dropdown'=>  'city_list',
            );  

            $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );  
            $param_view['relation_ref'] = array(


                'city_list'     =>  'country_list',
                'branch_list'     =>  'city_list',    
                'project_list'     =>  'branch_list',    

            ); 

			
			
            $param_view['column']     = array(  

                // 'code'              =>'City Code',
                'project_name'             =>'Project Name',
                'site_address'             =>'Site Address',
                'project_email'             =>'Project Email',
                'project_fax'             =>'Project Fax',
                'contact_person'             =>'Contact Person',
                'contact_no'             =>'Contact No',
               'start_date'             =>'Start Date',
                'end_date'             =>'End Date',
                'project_amount'             =>'Project Amount',
                'total_floor'             =>'Total Floor',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //  'code'       =>'City Code',
                 'project_name'             =>'Project Name',
            );
            $param_view['input_validation']=array(
                //  'code'              =>'required-field',
                'project_name'             =>'required-field',
                'site_address'             =>'required-field',
                'contact_person'             =>'required-field',
                'contact_no'             =>'required-field',
                'start_date'             =>'required-field',
                'end_date'             =>'required-field',
                'project_amount'             =>'required-field',
                'total_floor'             =>'required-field',
            );                            
            ######      ######       ######  
			//Add Input Type
			$param_view['input_type']  = array
			(
			    'site_address'  =>'textarea',
            );
			 $param_view['add_class']  = array(

                'start_date'             =>'Start Date',
                'end_date'             =>'End Date',
            );
			
			
            return $param_view; 
        }
        else
        {
			$data_post = $this->input->post();
            if($data_post != null)
            {
                //print_r($data_post);


                $param_view['where']  = array(
                    'country_id'  => $data_post['country_id'],
                    'city_id'    => $data_post['city_id'],
                    'branch_id'    => $data_post['branch_id'],

                );

				$param_view['heading'] = array('h1'   => 'Project Managment','small'=>'Project List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/city_list','delete' => 'Hierarchy/delete/city_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
					'city_id' => 'City Name',
					'branch_name'             =>'Branch Name',
					//   'code'              =>'City Code'
				);  
				$param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				 $param_view['relation_data']['city_id']=array(
					'tbl'=>'city_list',
					'rel'=>'city_id',
					'col'=>'city_name'

				);                              

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    						

            }
            else
            { 

				$param_view['fillter'] ['Country']   = array(
					'table'  =>  'country_list',
					'name'   =>  'country_id',
					'class'  =>  'city_get country_id required-field',
					'type'   =>   1,
				);  
				 $param_view['fillter'] ['City']   = array(
					'table'  =>  'city_list',
					'name'   =>  'city_id',
					'class'  =>  'branch_get city_id',
					'type'   =>   1,
				); 
				 $param_view['fillter'] ['Branch']   = array(
					'table'  =>  'branch_list',
					'name'   =>  'branch_id',
					'class'  =>  'branch_id',
					'type'   =>   1,
				); 
				$param_view['fillter_links']      = array('action'    => 'Hierarchy/command/project_list',
					'List_View' => 'Hierarchy/project_list',
					'edit' => 'Hierarchy/action/project_list',
					'command'      => 'Hierarchy/project_list',
					'btn_click'   => 'filter_project'
				); 


				$param_view['heading'] = array('h1'   => 'Project Managment','small'=>'Project List'); 
				$param_view['links']   = array('edit' => 'Hierarchy/action/project_list','delete' => 'Hierarchy/delete/project_list'); 
				$param_view['column']  = array(  
					'country_id' => 'Country Name',
					'city_id' => 'City Name',
					'branch_name'             =>'Branch Name',
					//   'code'              =>'City Code'
				);  
				 $param_view['relation_data']['country_id']=array(
					'tbl'=>'country_list',
					'rel'=>'country_id',
					'col'=>'country_name'

				);  
				$param_view['relation_data']['city_id']=array(
					'tbl'=>'city_list',
					'rel'=>'city_id',
					'col'=>'city_name'

				);                              

				######      ######       ######  
				$uri                   = $this->uri->segment(2);
				$this->load_hierarchy($uri,$param_view);    
			 } 
        }
    }

	
	
	//Expense Type List
	public function expense_type_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Expense Type Managment','small'=>'Expense Type list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/expense_type_list','List_View' => 'Hierarchy/expense_type_list','edit' => 'Hierarchy/action/expense_type_list',
                'command'    => 'Hierarchy/command/expense_type_list'); 
            $param_view['column']  = array(  
                'expense_type_name'      =>'Expense Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'expense_type_name'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'expense_type_name'      =>'Expense Name',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'Expense Type Managment','small'=>'Expense Type list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/expense_type_list','delete' => 'Hierarchy/delete/expense_type_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'expense_type_name'      =>'Expense Name',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 


		//Building Expense Type List
	public function building_expense_type_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Building Expense Type Managment','small'=>'Building Expense Type list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/building_expense_type_list','List_View' => 'Hierarchy/building_expense_type_list','edit' => 'Hierarchy/action/building_expense_type_list',
                'command'    => 'Hierarchy/command/building_expense_type_list'); 
            $param_view['column']  = array(  
                'building_expense_type_name'      =>'Expense Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'building_expense_type_name'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'building_expense_type_name'      =>'Expense Name',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'Building Expense Type Managment','small'=>'Building Expense Type list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/building_expense_type_list','delete' => 'Hierarchy/delete/building_expense_type_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'building_expense_type_name'      =>'Expense Name',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 


	
		//User Type List
	public function user_type_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'User Type Managment','small'=>'User Type list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/user_type_list','List_View' => 'Hierarchy/user_type_list','edit' => 'Hierarchy/action/user_type_list',
                'command'    => 'Hierarchy/command/user_type_list'); 
            $param_view['column']  = array(  
                'user_type_name'      =>'User Type Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'user_type_name'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'user_type_name'      =>'User Type Name',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'User Type Managment','small'=>'User Type list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/user_type_list','delete' => 'Hierarchy/delete/user_type_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'user_type_name'      =>'User Type Name',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 

    //Currency List
    public function currency_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Currency Managment','small'=>'Currency list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/currency_list','List_View' => 'Hierarchy/currency_list','edit' => 'Hierarchy/action/currency_list',
                'command'    => 'Hierarchy/command/currency_list'); 
            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'required-field',
                'type'   =>   1,
            );  

            $param_view['column']  = array(  
                'code'      =>'Code',
                'title'      =>'Title',
                // 'cnic_digit'      =>'Cnic Digit',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'code'      =>'Code',
                'title'      =>'Title',
            );

            $param_view['unique']  = array(  
                'code'      =>'Code',
                'title'      =>'Title',

            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Currency Managment','small'=>'Currency list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/currency_list','delete' => 'Hierarchy/delete/currency_list'); 
            $param_view['column']  = array(   
                'country_id' => 'Country Name',
                'title'      =>'Title',
                'code'      =>'Code',

            ); 
            $param_view['relation_data']['country_id']=array(
                'tbl'=>'country_list',
                'rel'=>'country_id',
                'col'=>'country_name'

            );  							
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 


    //Territory List
    public function territory_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Territory Managment','small'=>'Territory list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/territory_list','List_View' => 'Hierarchy/territory_list','edit' => 'Hierarchy/action/territory_list',
                'command'    => 'Hierarchy/command/territory_list'); 
            $param_view['column']  = array(  
                // 'code'      =>'Code',
                'title'      =>'Title',
                // 'cnic_digit'      =>'Cnic Digit',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                // 'code'      =>'Code',
                'title'      =>'Title',
            );

            $param_view['unique']  = array(  
                //    'code'      =>'Code',
                'title'      =>'Title',

            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Territory Managment','small'=>'Territory list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/territory_list','delete' => 'Hierarchy/delete/territory_list'); 
            $param_view['column']  = array(  // 'code'      =>'Code',
                'title'      =>'Title'

            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 



    //Product List 
    public function product_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'Product Managment','small'=>'Product list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/product_list',
                'List_View' => 'Hierarchy/product_list',
                'edit' => 'Hierarchy/action/product_list',
                'command'      => 'Hierarchy/command/product_list'); 

            $param_view['fillter'] ['Category']   = array(
                'table'  =>  'category_list',
                'name'   =>  'category_id',
                'class'  =>  'category_id required-field',
                'type'   =>   1

            );  


            $param_view['relation'][]   = array(
                'table'   =>  'product_list',
                'ref'     =>  'id',
                'column'  =>  'year_id',
                'dropdown'=>  'year_list',
            );

            $param_view['relation'][]   = array(
                'table'   =>  'product_list',
                'ref'     =>  'id',
                'column'  =>  'month_id',
                'dropdown'=>  'month_list',
            );

            $param_view['relation'][]   = array(
                'table'   =>  'product_list',
                'ref'     =>  'id',
                'column'  =>  'category_id',
                'dropdown'=>  'category_list',
            );  
            /* $param_view['relation'][]   = array(
                'table'   =>  'product_list',
                'ref'     =>  'id',
                'column'  =>  'currency_id',
                'dropdown'=>  'currency_list',
            );   */
            $param_view['relation_ref'] = array(
               // 'product_list'     =>  'currency_list',
                'product_list'     =>  'category_list',
                'product_list'     =>  'month_list',
                'product_list'     =>  'year_list',

            );
			
			 $param_view['fillter'] ['Month']   = array(
                'table'  =>  'month_list',
                'name'   =>  'month_id',
                'class'  =>  'month_id required-field',
                'type'   =>   1,
            );

            $param_view['fillter'] ['Year']   = array(
                'table'  =>  'year_list',
                'name'   =>  'year_id',
                'class'  =>  'year_id required-field',
                'type'   =>   1,
            );

            $param_view['column']     = array(  

                'title'              =>'Product Name',
              //  'unit_price'             =>'Price',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                'title'       =>'Product Name',
                /* 'state_name'      =>'State Name', */
            );
            $param_view['input_validation']=array(
                'title'              =>'required-field',
                //'unit_price'             =>'required-field',
            );    


          /*   $param_view['fillter'] ['Currency']   = array(
                'table'  =>  'currency_list',
                'name'   =>  'currency_id',
                'class'  =>  'currency_id required-field',
                'type'   =>   1,
            );   */

           

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Product Managment','small'=>'Product List'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/product_list','delete' => 'Hierarchy/delete/product_list'); 
            $param_view['column']  = array(  
                'category_id' => 'Category',
                'title'             =>'Product Name',
                //'unit_price'              =>'Price',								 
               // 'currency_id' => 'Currency',
                'month_id' => 'Month',
                'year_id' => 'Year',
            );  
           /*  $param_view['relation_data']['currency_id']=array(
                'tbl'=>'currency_list',
                'rel'=>'currency_id',
                'col'=>'title'           
            );  */    
            $param_view['relation_data']['month_id']=array(
                'tbl'=>'month_list',
                'rel'=>'month_id',
                'col'=>'title'           
            );     
            $param_view['relation_data']['year_id']=array(
                'tbl'=>'year_list',
                'rel'=>'year_id',
                'col'=>'title'           
            );     		   
            $param_view['relation_data']['category_id']=array(
                'tbl'=>'category_list',
                'rel'=>'category_id',
                'col'=>'title'           
            );            		   

            ######      ######       ######  
            $uri                   = $this->uri->segment(2);
            $this->load_hierarchy($uri,$param_view);    
        }   

    }



    //Location List 
    public function location_list($param)
    {
        if($param != null)
        {
            $param_view['heading']    = array('h1'        => 'Location Managment','small'=>'Location list Edit'); 
            $param_view['links']      = array('action'    => 'Hierarchy/command/location_list',
                'List_View' => 'Hierarchy/location_list',
                'edit' => 'Hierarchy/action/location_list',
                'command'      => 'Hierarchy/command/location_list'); 

            $param_view['fillter'] ['Country']   = array(
                'table'  =>  'country_list',
                'name'   =>  'country_id',
                'class'  =>  'state_get required-field',
                'type'   =>   1,
            );  
            $param_view['fillter'] ['State']   = array(
                'table'  =>  'state_list',
                'name'   =>  'state_id',
                'class'  =>  'city_get state_list state_id required-field',
                'type'   =>   1,
            );
            $param_view['fillter'] ['City']   = array(
                'table'  =>  'city_list',
                'name'   =>  'city_id',
                'class'  =>  'city_id city_list required-field',
                'type'   =>   1,
            );														  

            $param_view['relation'][]   = array(
                'table'   =>  'location_list',
                'ref'     =>  'id',
                'column'  =>  'city_id',
                'dropdown'=>  'city_list',
            );  

            $param_view['relation'][]   = array(
                'table'   =>  'city_list',
                'ref'     =>  'id',
                'column'  =>  'state_id',
                'dropdown'=>  'state_list',
            );  
            $param_view['relation'][]   = array(
                'table'   =>  'state_list',
                'ref'     =>  'id',
                'column'  =>  'country_id',
                'dropdown'=>  'country_list',
            );  
            $param_view['relation_ref'] = array(

                'state_list'     =>  'country_list',
                'city_list'     =>  'state_list',
                'location_list'     =>  'city_list',

            ); 

            $param_view['column']     = array(  

                //'code'              =>'City Code',
                'title'             =>'Title',
                'is_enable'         =>'Active Status',
            ); 
            $param_view['unique']  = array(  
                //'code'       =>'City Code',
                'title'      =>'Title',
            );
            $param_view['input_validation']=array(
                //'code'              =>'required-field',
                'title'             =>'required-field',
            );                            
            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Location Managment','small'=>'Location List'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/location_list','delete' => 'Hierarchy/delete/location_list'); 
            $param_view['column']  = array(  
                'country_id' => 'Country Name',
                'state_id' => 'State Name',
                'city_id'             =>'City Name',
                'title'              =>'Title'
            );  
            $param_view['relation_data']['country_id']=array(
                'tbl'=>'country_list',
                'rel'=>'country_id',
                'col'=>'country_name'

            );  
            $param_view['relation_data']['state_id']=array(
                'tbl'=>'state_list',
                'rel'=>'state_id',
                'col'=>'state_name'

            );   
            $param_view['relation_data']['city_id']=array(
                'tbl'=>'city_list',
                'rel'=>'city_id',
                'col'=>'title'

            ); 		   

            ######      ######       ######  
            $uri                   = $this->uri->segment(2);
            $this->load_hierarchy($uri,$param_view);    
        }
    }

    //Category List
    public function category_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Category Managment','small'=>'Category list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/category_list','List_View' => 'Hierarchy/category_list','edit' => 'Hierarchy/action/category_list',
                'command'    => 'Hierarchy/command/category_list'); 
            $param_view['column']  = array(  
                // 'country_code'      =>'Country Code',
                'title'      =>'Category Name',
                //'amount'      =>'Amount',
                //'cnic_digit'      =>'Cnic Digit',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                //'country_code'              =>'required-field',
                'title'             =>'required-field',
              //  'amount'             =>'required-field',
            );

            $param_view['unique']  = array(  
                //   'country_code'      =>'Country Code',
                'title'      =>'Category Name',
                //	 'cnic_digit'      =>'Cnic Digit',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Category Managment','small'=>'Category list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/category_list','delete' => 'Hierarchy/delete/category_list'); 
            $param_view['column']  = array( // 'country_code'      =>'Country Code',
                'title'      =>'Category Name',
               // 'amount'      =>'Amount'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 

    //Year List
    public function year_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Year Managment','small'=>'Year list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/year_list','List_View' => 'Hierarchy/year_list','edit' => 'Hierarchy/action/year_list',
                'command'    => 'Hierarchy/command/year_list'); 
            $param_view['column']  = array(  
                // 'country_code'      =>'Country Code',
                'title'      =>'Year',
                //'cnic_digit'      =>'Cnic Digit',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                //'country_code'              =>'required-field',
                'title'             =>'required-field',
            );

            $param_view['unique']  = array(  
                //   'country_code'      =>'Country Code',
                'title'      =>'Year',
                //	 'cnic_digit'      =>'Cnic Digit',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Year Managment','small'=>'Year list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/year_list','delete' => 'Hierarchy/delete/year_list'); 
            $param_view['column']  = array( // 'country_code'      =>'Country Code',
                'title'      =>'Year',
                //'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    }

	
	//Department List
	public function department_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Department Managment','small'=>'Department list Edit'); 
            $param_view['links']   = array('action'     => 'Hierarchy/command/department_list','List_View' => 'Hierarchy/department_list','edit' => 'Hierarchy/action/department_list',
                'command'    => 'Hierarchy/command/department_list'); 
            $param_view['column']  = array(  
                'department_name'      =>'Department Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['input_validation']=array(
                'department_name'             =>'required-field',
            );

            $param_view['unique']  = array(  
                'department_name'      =>'Department Name',
            );

            ######      ######       ######  

            return $param_view; 
        }
        else
        {
            /* //Filter Data
            $param_view['fillter'] ['Country']   = array(
            'table'  =>  'country_list',
            'name'   =>  'country_id',
            'class'  =>  'country_id state_get required-field',
            'type'   =>   0,
            );  
            $param_view['fillter'] ['State']   = array(
            'table'  =>  'state_list',
            'name'   =>  'state_id',
            'class'  =>  'state_id required-field',
            'type'   =>   0,
            ); */     



            $param_view['heading'] = array('h1'   => 'Department Managment','small'=>'Department list'); 
            $param_view['links']   = array('edit' => 'Hierarchy/action/department_list','delete' => 'Hierarchy/delete/department_list'); 
            $param_view['column']  = array(  //'country_code'      =>'Country Code',
                'department_name'      =>'Department Name',
                // 'cnic_digit'      =>'Cnic Digit'
            ); 
            ######      ######       ######  

            $this->load_hierarchy($uri,$param_view);    
        }                                        

    } 



	
    //Get State List By Country Id
    public function get_state_by_country()
    {

        $country_id = $this->input->post('country_id');  
		if($country_id > 0)
		{
        $this->db->where('country_id',$country_id);
        }
		//$this->db->where('is_enable',1);
        //$this->db->where('r_noofcopy >',0);
        $filtered_state = $this->db->get('city_list')->result();


        $country_names=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$country_id);

        ?>
        <div class="table-header">
            Results for City <?php //echo $country_names; ?>
        </div>

        <table id="state_table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Country Name </th>
                    <th>City Name</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($filtered_state as $row): ?>
                    <tr>
                        <td><?php //echo $fc->product_id; 


                            $country_name=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$row->country_id);
                            echo $country_name;
                        ?></td>
                        <td><?php echo $row->city_name; ?></td>
                        <td>
                            <label class=" inline">
                                <input  ref="<?php echo $row->id; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                                <span class="lbl"></span>
                            </label>
                        </td>


                        <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                            <a class="green" href="<?php echo base_url('Hierarchy/action/city_list/'.$row->id.''); ?>">
                                <i class="icon-pencil bigger-130"></i>
                            </a>    
                            <!--
                            <a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                            <i class="icon-trash bigger-130"></i>
                            </a>-->
                        </div>

                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="<?php echo base_url('Hierarchy/action/city_list/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <!--<li>
                                    <a href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                    <i class="icon-trash bigger-120"></i>
                                    </span>
                                    </a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>



                    </tr>
                    <?php endforeach; ?>
            </tbody>

        </table>

        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#state_table').dataTable( 
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }
                            ] 
                    });      
            });
        </script>

        <?php

    }



    //Get State List By Country Id
    public function get_city_by_country()
    {

        $country_id = $this->input->post('country_id');  
       // $state_id = $this->input->post('state_id');  
         if($country_id > 0)
        {
		$this->db->where('country_id',$country_id);
		}
	   /*  if($state_id > 0)
        {
            $this->db->where('state_id',$state_id);
        } */
        //$this->db->where('is_enable',1);
        //$this->db->where('r_noofcopy >',0);
        $filtered_city = $this->db->get('city_list')->result();


        $country_names=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$country_id);
      //  $state_names=$this->Mdl_hierarchy->get_relation_pax('state_list','state_name','id',$state_id);

        ?>
        <div class="table-header">
            Results for City <?php //echo $country_names; ?> <?php 
            //echo $state_names;
            ?>
        </div>

        <table id="state_table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Country Name </th>
                  
                    <th>City Name</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($filtered_city as $row): ?>
                    <tr>
                        <td><?php //echo $fc->product_id; 


                            $country_name=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$row->country_id);
                            echo $country_name;
                        ?></td>

                      
                        <td><?php echo $row->city_name; ?></td>
                        <td>
                            <label class=" inline">
                                <input  ref="<?php echo $row->id; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                                <span class="lbl"></span>
                            </label>
                        </td>


                        <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                            <a class="green" href="<?php echo base_url('Hierarchy/action/city_list/'.$row->id.''); ?>">
                                <i class="icon-pencil bigger-130"></i>
                            </a>    
                            <!--
                            <a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                            <i class="icon-trash bigger-130"></i>
                            </a>-->
                        </div>

                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="<?php echo base_url('Hierarchy/action/city_list/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <!--<li>
                                    <a href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                    <i class="icon-trash bigger-120"></i>
                                    </span>
                                    </a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>



                    </tr>
                    <?php endforeach; ?>
            </tbody>

        </table>

        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#state_table').dataTable( 
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true }
                            ] 
                    });      
            });
        </script>

        <?php

    }

	//Get Branch List By Country Id
    public function get_branch_by_country()
    {

        $country_id = $this->input->post('country_id');  
        $city_id = $this->input->post('city_id');  
         if($country_id > 0)
        {
		$this->db->where('country_id',$country_id);
		}
	   if($city_id > 0)
        {
            $this->db->where('city_id',$city_id);
        } 
        //$this->db->where('is_enable',1);
        //$this->db->where('r_noofcopy >',0);
        $filtered_city = $this->db->get('branch_list')->result();


        $country_names=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$country_id);
       

        ?>
        <div class="table-header">
            Results for Branch <?php //echo $country_names; ?> <?php 
            //echo $state_names;
            ?>
        </div>

        <table id="state_table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Country Name </th>
                  
                    <th>City Name</th>
                    <th>Branch Name</th>
                    <th>Branch Code</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($filtered_city as $row): ?>
                    <tr>
                        <td><?php //echo $fc->product_id; 


                            $country_name=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$row->country_id);
                            echo $country_name;
                        ?></td>

                      
                        <td><?php 
						 $city_names=$this->Mdl_hierarchy->get_relation_pax('city_list','city_name','id',$row->city_id);
						echo $city_names; ?></td>
                        <td><?php echo $row->branch_name; ?></td>
                        <td><?php echo $row->branch_code; ?></td>
                        <td>
                            <label class=" inline">
                                <input  ref="<?php echo $row->id; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                                <span class="lbl"></span>
                            </label>
                        </td>


                        <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                            <a class="green" href="<?php echo base_url('Hierarchy/action/branch_list/'.$row->id.''); ?>">
                                <i class="icon-pencil bigger-130"></i>
                            </a>    
                            <!--
                            <a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                            <i class="icon-trash bigger-130"></i>
                            </a>-->
                        </div>

                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="<?php echo base_url('Hierarchy/action/branch_list/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <!--<li>
                                    <a href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                    <i class="icon-trash bigger-120"></i>
                                    </span>
                                    </a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>



                    </tr>
                    <?php endforeach; ?>
            </tbody>

        </table>

        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#state_table').dataTable( 
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true }
                            ] 
                    });      
            });
        </script>

        <?php

    }
	
	
	
	//Get Project List By Country City Branch Id
    public function get_project_by_countrycitybracnh()
    {

        $country_id = $this->input->post('country_id');  
        $city_id = $this->input->post('city_id');  
        $branch_id = $this->input->post('branch_id');  
         if($country_id > 0)
        {
		$this->db->where('country_id',$country_id);
		}
	   if($city_id > 0)
        {
            $this->db->where('city_id',$city_id);
        } 
		
	   if($branch_id > 0)
        {
            $this->db->where('branch_id',$branch_id);
        } 
        //$this->db->where('is_enable',1);
        //$this->db->where('r_noofcopy >',0);
        $filtered_city = $this->db->get('project_list')->result();


        ?>
        <div class="table-header">
            Results for Project <?php //echo $country_names; ?> <?php 
            //echo $state_names;
            ?>
        </div>

        <table id="state_table1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Project Detail </th>                  
                    <th>Site Address</th>                   
                    <th>Project Amount</th>                   
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($filtered_city as $row): ?>
                    <tr>
                        <td>
						<b>Country:</b> <?php
                            $country_name=$this->Mdl_hierarchy->get_relation_pax('country_list','country_name','id',$row->country_id);
                            echo $country_name;
                        ?><br/><br/>
						<b>City:</b> <?php 
						 $city_names=$this->Mdl_hierarchy->get_relation_pax('city_list','city_name','id',$row->city_id);
						echo $city_names; ?><br/><br/>
						<b>Branch:</b> <?php 
						 $b_names=$this->Mdl_hierarchy->get_relation_pax('branch_list','branch_name','id',$row->branch_id);
						echo $b_names; ?><br/><br/>
						<b>Project Name:</b> <?php echo $row->project_name; ?>
						</td>

						<td>
						<b>Site Address:</b> <?php echo $row->site_address; ?><br/><br/>
						<b>Email:</b> <?php echo $row->project_email; ?><br/><br/>
						<b>Fax:</b> <?php echo $row->project_fax; ?><br/><br/>
						<b>Contact Person:</b> <?php echo $row->contact_person; ?><br/><br/>
						<b>Contact No:</b> <?php echo $row->contact_no; ?><br/><br/>
						<b>Total Floor:</b> <?php echo $row->total_floor; ?><br/><br/>
						
						
						</td>
                        <td>
						<b>Start Date:</b> <?php echo $row->start_date; ?><br/><br/>
						<b>End Date:</b> <?php echo $row->end_date; ?><br/><br/>
						<b>Project Amount:</b> Rs. <?php echo $row->project_amount; ?><br/><br/>
						
						</td>
                        
                    
						<td>
                            <label class=" inline">
                                <input table="project_list"  ref="<?php echo $row->id; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                                <span class="lbl"></span>
                            </label>
                        </td>


                        <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                            <a class="green" href="<?php echo base_url('Hierarchy/action/project_list/'.$row->id.''); ?>">
                                <i class="icon-pencil bigger-130"></i>
                            </a>    
                            <!--
                            <a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                            <i class="icon-trash bigger-130"></i>
                            </a>-->
                        </div>

                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="<?php echo base_url('Hierarchy/action/project_list/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

						</td>

                    </tr>
                    <?php endforeach; ?>
            </tbody>

        </table>

        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#state_table1').dataTable( 
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true }
                            ] 
                    });    

    $(".status").change(function(){
            var _status = $(this).val();
            var ref     = $(this).attr('ref'); 
            var table   = $(this).attr('table'); 
            if(_status == 0)
            { 
                $(this).val(1);
                var status_new = 1; 
                $(this).prop('checked',true); 
            }else
            {
                $(this).val(0);
                var status_new = 0;
                $(this).prop('checked',false);   
            }

            if(ref != null)
            {
                var json = {};

                json['id']       = ref;
                json['status']   = status_new;
                json['table']    = table;
                var request = $.ajax({
                    url: "<?php echo base_url('Hierarchy/change_user_status_h'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {
                            var change_status_label = '';  
                            switch(table) {

                                case 'city_list': change_status_label = 'City'; break;
                                case 'country_list': change_status_label = 'Country'; break;
                                case 'profession_list':  change_status_label = 'Profession';  break;
                                case 'islamic_qualification_list': change_status_label = 'Islamic Qualification';  break;
                                case 'secular_qualification_list': change_status_label = 'Secular Qualification';  break;
                                case 'organizational_responsibility_list': change_status_label = 'Organizational Responsibility';  break;
                                case 'token_halqa': change_status_label = 'Token Halqa';  break;

                                default: change_status_label = '';
                            }



                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Status Changed!',
                                // (string | mandatory) the text inside the notification
                                text: change_status_label+' Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }   
                    }
                });
            } 
        });

					
            });
        </script>

        <?php

    }
	//Logo List
	 public function logo_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Logo Managment','small'=>'Logo list Edit');
            $param_view['links']   = array('action'     => 'Hierarchy/command/logo_list','List_View' => 'Hierarchy/logo_list','edit' => 'Hierarchy/action/logo_list',
                'command'    => 'Hierarchy/command/logo_list');


            $param_view['column']  = array(
                'title'             =>'Title',
                //'is_enable'         =>'Active Status',
            );
            $param_view['unique']  = array(

                //'title'      =>'Title',
              //  'form_reason_id'      =>'Form Reason',
            );
            $param_view['add_class']  = array(

                //'valid_date'      => 'Valid Date',
            );
            $param_view['input_validation'] = array
            (
              //  'title'          =>'Title',
              //  'valid_date'     => 'Valid Date',
            );

            ######      ######       ######

            return $param_view;
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Logo Managment','small'=>'Logo list');
            $param_view['links']   = array('edit' => 'Hierarchy/action/logo_list','delete' => 'Hierarchy/delete/logo_list');
            $param_view['column']  = array
            (
              //  'form_reason_id'    =>'Form Reason',
                'title'             =>'Title',
                'logo_image'        => 'Logo Image',
                'show_logo'        => 'Show Logo',
                'show_title'        => 'Show Title'
            );
            ######      ######       ######

            $this->load_hierarchy($uri,$param_view);
        }

    }

	
    public function slider_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Slider Managment','small'=>'Slider list Edit');
            $param_view['links']   = array('action'     => 'Hierarchy/command/slider_list','List_View' => 'Hierarchy/slider_list','edit' => 'Hierarchy/action/slider_list',
                'command'    => 'Hierarchy/command/slider_list');


            $param_view['column']  = array(
                'slider_name'             =>'Slider Name',
                'is_enable'         =>'Active Status',
            );
            $param_view['unique']  = array(

                //'title'      =>'Title',
              //  'form_reason_id'      =>'Form Reason',
            );
            $param_view['add_class']  = array(

                //'valid_date'      => 'Valid Date',
            );
            $param_view['input_validation'] = array
            (
              //  'title'          =>'Title',
              //  'valid_date'     => 'Valid Date',
            );

            ######      ######       ######

            return $param_view;
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Slider Managment','small'=>'Slider list');
            $param_view['links']   = array('edit' => 'Hierarchy/action/slider_list','delete' => 'Hierarchy/delete/slider_list');
            $param_view['column']  = array
            (
              //  'form_reason_id'    =>'Form Reason',
                'slider_name'             =>'Slider Name',
                'slider_image'        => 'Slider Image'
            );
            ######      ######       ######

            $this->load_hierarchy($uri,$param_view);
        }

    }

    public function brand_list($param)
    {

        $uri                   = $this->uri->segment(2);

        if($param != null)
        {
            $param_view['heading'] = array('h1'         => 'Brand Managment','small'=>'Brand list Edit');
            $param_view['links']   = array('action'     => 'Hierarchy/command/brand_list','List_View' => 'Hierarchy/brand_list','edit' => 'Hierarchy/action/brand_list',
                'command'    => 'Hierarchy/command/brand_list');


            $param_view['column']  = array(
                'brand_name'             =>'Brand Name',
                'brand_description'             =>'Brand Description',
                'is_enable'         =>'Active Status',
            );
            $param_view['unique']  = array(

                //'title'      =>'Title',
                //  'form_reason_id'      =>'Form Reason',
            );
            $param_view['add_class']  = array(

               // 'brand_description'      => 'Valid Date',
            );
            $param_view['input_validation'] = array
            (
                'brand_name'             =>'Brand Name',
                 'title'          =>'Title',
                //  'valid_date'     => 'Valid Date',
            );



            ######      ######       ######

            return $param_view;
        }
        else
        {
            $param_view['heading'] = array('h1'   => 'Brand Managment','small'=>'Brand list');
            $param_view['links']   = array('edit' => 'Hierarchy/action/brand_list','delete' => 'Hierarchy/delete/brand_list');
            $param_view['column']  = array
            (
                //  'form_reason_id'    =>'Form Reason',
                'brand_name'             =>'Brand Name',
                'brand_image'             =>'Brand Image',
                'brand_description'             =>'Brand Description'
                //   'valid_date'        => 'Valid Date'
            );

                ######      ######       ######

                $this->load_hierarchy($uri,$param_view);
        }

    }


	

    public function country_dd($id)
    {
        return $this->Mdl_hierarchy->country_list($id);
    }
	//Status Drop Down
    public function status_dd($id)
    {
        return $this->Mdl_hierarchy->status_list($id);
    }
    //Religion Drop Down
    public function religion_dd($id)
    {
        return $this->Mdl_hierarchy->religion_list($id);
    }
    //Sect Drop Down
    public function sect_dd($id)
    {
        return $this->Mdl_hierarchy->sect_list($id);
    }
    //Marital Status Drop Down
    public function marital_status_dd($id)
    {
        return $this->Mdl_hierarchy->marital_status_list($id);
    }
	//Expense Drop Down
	  public function expense_dd($id)
    {
        return $this->Mdl_hierarchy->expense_type_list($id);
    }
	//Building Expense Drop Down
	 public function building_expense_dd($id)
    {
        return $this->Mdl_hierarchy->building_expense_type_list($id);
    }

    //category List
    public function category_dd($id)
    {
        return $this->Mdl_hierarchy->category_list($id);
    }

	//bank List
    public function bank_dd($id)
    {
        return $this->Mdl_hierarchy->bank_list($id);
    }


    //Product List
    public function product_dd($id)
    {
        return $this->Mdl_hierarchy->product_list($id);
    }
	
	//user List
    public function user_dd($id)
    {
        return $this->Mdl_hierarchy->get_user_list($id);
    }

	//user List
    public function buyer_dd($id)
    {
        return $this->Mdl_hierarchy->get_buyer_list($id);
    }
	
	//user List
    public function seller_dd($id)
    {
        return $this->Mdl_hierarchy->get_seller_list($id);
    }

	//user List
    public function buyer_dd1($id)
    {
        return $this->Mdl_hierarchy->get_buyer_list1($id);
    }
	
	//user List
    public function seller_dd1($id)
    {
        return $this->Mdl_hierarchy->get_seller_list1($id);
    }
	
	//user List
    public function buyer_dd2($id)
    {
        return $this->Mdl_hierarchy->get_buyer_list2($id);
    }
	
	//user List
    public function seller_dd2($id)
    {
        return $this->Mdl_hierarchy->get_seller_list2($id);
    }

	//User Type List
    public function user_type_dd($id)
    {
        return $this->Mdl_hierarchy->get_user_type_list($id);
    }
	
    //Location List
    public function location_dd($id)
    {
        return $this->Mdl_hierarchy->location_list($id);
    }


    //Location List
    public function territory_dd($id)
    {
        return $this->Mdl_hierarchy->territory_list($id);
    }

	//Trans Code List
    public function trans_code_dd($id)
    {
        return $this->Mdl_hierarchy->trans_code_list($id);
    }
	
	
    //get city dropdown
    public function get_city_byid1()
    {
        $country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->city_list($country_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
        echo $option;
    }



    public function get_city_byid()
    {
        $country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->city_list($country_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
        echo $option;
    }

    public function get_state_city_byid()
    {
        $country_id         =  $this->input->post('country_id');
        $state_id         =  $this->input->post('state_id');
        $data['result_set'] = $this->Mdl_hierarchy->city_list_by_state($country_id,$state_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
        echo $option;
    } 

	 public function get_branch_city_byid()
    {
        $country_id         =  $this->input->post('country_id');
        $city_id         =  $this->input->post('city_id');
		//echo $country_id."<br/>".$city_id;
		//exit;
		$data['result_set'] = $this->Mdl_hierarchy->branch_list_by_city($country_id,$city_id);
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
        echo $option;
    } 

	
	 public function get_project_by_branch()
    {
        $country_id         =  $this->input->post('country_id');
        $city_id         =  $this->input->post('city_id');
        $branch_id         =  $this->input->post('branch_id');
		//echo $country_id."<br/>".$city_id;
		//exit;
		$data['result_set'] = $this->Mdl_hierarchy->project_list_by_branch($country_id,$city_id,$branch_id);
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
        echo $option;
    } 

	
	
    public function load_hierarchy($uri,$param_view)
    {

        $data['param_view'] = $param_view;
        $where =  $param_view['where'];
        $data['result_set'] = $this->Mdl_hierarchy->_this_hierarchy_record($uri,$where['ref'],$where['input']);

        foreach($data['result_set'] as $fetch):

            foreach($param_view['relation_data'] as $key => $rel)
            {
                if($fetch->$key != null)
                {
                    $fetch->$key  =   $this->Mdl_hierarchy->get_relation_pax($rel['tbl'],$rel['col'],'id',$fetch->$key);

                }
            }


            endforeach;

        #  exit;
        $data['content']    = 'Hierarchy/hierarchy';
        $this->load->view('Template/template',$data);       
    }
    public function action($id = null)
    { 

        $table = $this->uri->segment(3);  
        $id    = $this->uri->segment(4);  

        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_hierarchy->_get_single_record_byid($table,$id);   
        } 
        $param_view = $this->{$table}(1); 
        // print_r($param_view);
        //          exit;
        $data['param_view'] = $param_view; 


        $data['content'] = 'Hierarchy/action';

        $this->load->view('Template/template',$data);

    }



    public function command()
    { 

        $uri       = $this->uri->segment(3);
        $post_view = $this->input->post();

        //print_r($post_view);
        //exit;

        $markaz_id = $post_view['markaz_id'];
        //Token Halqa
        if($uri == 'token_halqa')
        {

            $exists =  $this->Mdl_hierarchy->check_already_exists('markaz_id',$markaz_id,$uri);

            if($exists > 0)
            {

                $this->session->set_flashdata('Error', 'Data Already Exists ');

                redirect(base_url().'Hierarchy/'.$uri,'refresh');
            }
        }

        /* //Token Darja Course
        if($uri == 'token_halqa_course')
        {

        $exists =  $this->Mdl_hierarchy->check_already_exists('markaz_id',$markaz_id,$uri);

        if($exists > 0)
        {

        $this->session->set_flashdata('Error', 'Data Already Exists ');

        redirect(base_url().'Hierarchy/'.$uri,'refresh');
        }
        }

        //Token Purpose Course
        if($uri == 'token_purpose_course')
        {

        $exists =  $this->Mdl_hierarchy->check_already_exists('markaz_id',$markaz_id,$uri);

        if($exists > 0)
        {

        $this->session->set_flashdata('Error', 'Data Already Exists ');

        redirect(base_url().'Hierarchy/'.$uri,'refresh');
        }
        } */


        //Token Purpose 
        if($uri == 'token_purpose')
        {
            $date = new DateTime($post_view['valid_date']);
            $post_view['valid_date'] = $date->format('Y-m-d');

            /*
            $openingDate = new DateTime($post_view['opening_date']);
            $post_view['opening_date'] = $openingDate->format('Y-m-d');   */
        }
        if($uri == 'token_purpose_course')
        {
            $date = new DateTime($post_view['valid_date']);
            $post_view['valid_date'] = $date->format('Y-m-d');  


            $openingDate = new DateTime($post_view['opening_date']);
            $post_view['opening_date'] = $openingDate->format('Y-m-d');  
        }

        //Token Purpose 
        if($uri == 'madani_month')
        {
            $date = new DateTime($post_view['start_date']);
            $post_view['start_date'] = $date->format('Y-m-d');

            /*
            $openingDate = new DateTime($post_view['opening_date']);
            $post_view['opening_date'] = $openingDate->format('Y-m-d');   */
        }

        if($uri == 'madani_month' || $uri == 'pages_list' || $uri == 'madani_year' || $uri == 'logo_list' || $uri == 'system_setting_list')
        {

        }else
        {
            if(!isset($post_view['is_enable'])){$post_view['is_enable'] = 0;}  
        }      

        $column    = $this->Mdl_hierarchy->get_exist_column($uri);

        $post_data = array();
        foreach($column as $key)
        {
            if(array_key_exists($key, $post_view))
            {
                $post_data[$key] = $post_view[$key];
            }
        }


        //   print_r($post_data);
        //       echo $uri;
        //       exit;

        if($uri == 'slider_list')
        {




            //$update_id = $this->uri->segment(4);
            if($post_view['id'] != null)
            {
                if($_FILES['token_file']['name'] != "")
                {
                    $old_image = $post_view['old_image'];
                    unlink("public_html/frontend/image/slider/".$old_image);
                    $targetDir = FCPATH."public_html/frontend/image/slider/";
                    $fileName ="slider_".time().$this->session->userdata('id').'.jpg';
                    move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                    $cat_image = $fileName;
                }
            }
            else
            {


                if($_FILES['token_file']['name'] != "")
                {
                    $targetDir = FCPATH."public_html/frontend/image/slider/";
                    $fileName ="slider_".time().$this->session->userdata('id').'.jpg';
                    move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                    $cat_image = $fileName;
                }
                else
                {
                    $cat_image = "";
                }

            }
            $post_data['slider_image'] = $cat_image;
            $db_command =  $this->Mdl_hierarchy->db_command($post_data,$post_view['id'],$uri);
            $last_insert_id = $this->db->insert_id();

            if($db_command)
            {
                if($post_view['id'] != null)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');  
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');    
                }

                redirect(base_url().'Hierarchy/'.$uri,'refresh');  
            }


        }
        else 
        if($uri == 'logo_list')
        {




            //$update_id = $this->uri->segment(4);
            if($post_view['id'] != null)
            {
                if($_FILES['token_file']['name'] != "")
                {
                    $old_image = $post_view['old_image'];
                    unlink("public_html/frontend/image/logo/".$old_image);
                    $targetDir = FCPATH."public_html/frontend/image/logo/";
                    $fileName ="logo_".time().$this->session->userdata('id').'.jpg';
                    move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                    $cat_image = $fileName;
                }
            }
            else
            {


                if($_FILES['token_file']['name'] != "")
                {
                    $targetDir = FCPATH."public_html/frontend/image/logo/";
                    $fileName ="slider_".time().$this->session->userdata('id').'.jpg';
                    move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                    $cat_image = $fileName;
                }
                else
                {
                    $cat_image = "";
                }

            }
            $post_data['logo_image'] = $cat_image;
            $db_command =  $this->Mdl_hierarchy->db_command($post_data,$post_view['id'],$uri);
            $last_insert_id = $this->db->insert_id();

            if($db_command)
            {
                if($post_view['id'] != null)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');  
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');    
                }

                redirect(base_url().'Hierarchy/'.$uri,'refresh');  
            }


        }
        else
            if($uri == 'brand_list')
            {




                //$update_id = $this->uri->segment(4);
                if($post_view['id'] != null)
                {
                    if($_FILES['token_file']['name'] != "")
                    {
                        $old_image = $post_view['old_image'];
                        unlink("public_html/frontend/image/brand/".$old_image);
                        $targetDir = FCPATH."public_html/frontend/image/brand/";
                        $fileName ="brand_".time().$this->session->userdata('id').'.jpg';
                        move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                        $cat_image = $fileName;
                    }
                }
                else
                {


                    if($_FILES['token_file']['name'] != "")
                    {
                        $targetDir = FCPATH."public_html/frontend/image/brand/";
                        $fileName ="brand_".time().$this->session->userdata('id').'.jpg';
                        move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                        $cat_image = $fileName;
                    }
                    else
                    {
                        $cat_image = "";
                    }

                }
                $post_data['brand_image'] = $cat_image;
                $db_command =  $this->Mdl_hierarchy->db_command($post_data,$post_view['id'],$uri);
                $last_insert_id = $this->db->insert_id();

                if($db_command)
                {
                    if($post_view['id'] != null)
                    {
                        $this->session->set_flashdata('update', 'your data successfully Updated');
                    }else
                    {
                        $this->session->set_flashdata('saved', 'your data successfully Saved');
                    }

                    redirect(base_url().'Hierarchy/'.$uri,'refresh');
                }


            }
            else
            if($uri == 'system_setting_list')
            {




                //$update_id = $this->uri->segment(4);
                if($post_view['id'] != null)
                {
                    if($_FILES['token_file']['name'] != "")
                    {
                        $old_image = $post_view['old_image'];
                        unlink("public_html/frontend/image/system/".$old_image);
                        $targetDir = FCPATH."public_html/frontend/image/system/";
                        $fileName ="system_".time().$this->session->userdata('id').'.jpg';
                        move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                        $cat_image = $fileName;
                    }else
					{
						$cat_image = $post_view['old_image'];
					}
                }
                else
                {


                    if($_FILES['token_file']['name'] != "")
                    {
                        $targetDir = FCPATH."public_html/frontend/image/system/";
                        $fileName ="system_".time().$this->session->userdata('id').'.jpg';
                        move_uploaded_file($_FILES['token_file']['tmp_name'], $targetDir.$fileName);
                        $cat_image = $fileName;
                    }
                    else
                    {
                        $cat_image = "";
                    }

                }
                $post_data['system_image'] = $cat_image;
                $db_command =  $this->Mdl_hierarchy->db_command($post_data,$post_view['id'],$uri);
                $last_insert_id = $this->db->insert_id();

                if($db_command)
                {
                    if($post_view['id'] != null)
                    {
                        $this->session->set_flashdata('update', 'your data successfully Updated');
                    }else
                    {
                        $this->session->set_flashdata('saved', 'your data successfully Saved');
                    }

                    redirect(base_url().'Hierarchy/'.$uri,'refresh');
                }


            }
            
			else
            {

            $db_command =  $this->Mdl_hierarchy->db_command($post_data,$post_view['id'],$uri);

            if($db_command)
            {
                if($post['id'] != null)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');  
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');    
                }

                redirect(base_url().'Hierarchy/'.$uri,'refresh');  
            }

        }  

    } 
    public function change_user_status_h()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table              =  $post['table'];


        $_return['_return'] =  $this->Mdl_hierarchy->_change_user_status_h($id,$status,$table);
        $return             = json_encode($_return);
        echo $return; 

    }
    //Status Change Year & Month
    public function change_status_year_month()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table              =  $post['table'];

        $_return['_return'] =  $this->Mdl_hierarchy->_change_status_year_month($id,$status,$table);
        $return             =  json_encode($_return);
        echo $return; 
    }

	   //Status Change Logo Image
    public function change_status_logo_image()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table              =  $post['table'];

        $_return['_return'] =  $this->Mdl_hierarchy->_change_status_logo_image($id,$status,$table);
        $return             =  json_encode($_return);
        echo $return; 
    }

	   //Status Change Logo Title
    public function change_status_logo_title()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];
        $table              =  $post['table'];

        $_return['_return'] =  $this->Mdl_hierarchy->_change_status_logo_title($id,$status,$table);
        $return             =  json_encode($_return);
        echo $return; 
    }

	
	public function get_user_list()
    {
        //$country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->get_user_list();
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
			 $option .= '<option value = "new_user" >Add New</option>';
        echo $option;
    }
	
	public function get_buyer_list()
    {
        //$country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->get_buyer_list();
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
			 $option .= '<option value = "new_user" >Add New</option>';
        echo $option;
    }
	
	
		
	public function get_seller_list()
    {
        //$country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->get_seller_list();
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
			 $option .= '<option value = "new_user" >Add New</option>';
        echo $option;
    }
	
	public function get_buyer_list1()
    {
        //$country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->get_buyer_list();
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
			 $option .= '<option value = "all" >All</option>';
        echo $option;
    }
	
	
		
	public function get_seller_list1()
    {
        //$country_id         =  $this->input->post('country_id');
        $data['result_set'] = $this->Mdl_hierarchy->get_seller_list();
		
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
            endforeach;
			 $option .= '<option value = "all" >All</option>';
        echo $option;
    }
	
	
	
	public function get_user_info()
    {
        $user_id         =  $this->input->post('user_id');


        $data_user = $this->Mdl_hierarchy->get_user_info($user_id);
        $data_payment = $this->Mdl_hierarchy->get_payment_info($user_id);
		
		$remaining = 0;
		foreach($data_payment as $rem)
		{
			$remaining += $rem->remaining_price;
		}
		$_return['name'] = $data_user[0]->name;
		$_return['contact'] = $data_user[0]->contact;
		$_return['address'] = $data_user[0]->address;
		$_return['user_id'] = $data_user[0]->id;
		$_return['remaining'] = $remaining;
		$_return['order_code'] = $data_payment[0]->order_code;
		$_return['old_order_id'] = $data_payment[0]->order_id;
		$_return['old_payment_id'] = $data_payment[0]->payment_id;
       
	   $return             =  json_encode($_return);
        echo $return; 
		
		
	   
    }

    public function hierarchy_unique_exception()
    {
        $value  = $this->input->post('input');
        $column = $this->input->post('column');
        $table  = $this->input->post('ref');
        $_ref_attr_segemt  = $this->input->post('ref_attr_segemt');

        $this->db->select('id'); 
        $this->db->where($column,$value); 
        $query =  $this->db->get($table);
        $count = $query->num_rows();

        if($count > 0)
        {
            $_result = $query->result(); 
            if($_result[0]->id == $_ref_attr_segemt)
            {
                $count = 0 ;  
            }
        }

        $array['return'][0] = $count;


        echo json_encode($array);
    } 
    public function delete()
    {
        $table  = $this->uri->segment(3);
        $id    = $this->uri->segment(4);
        $delete = $this->Mdl_hierarchy->_delete($id,$table);

        if($delete == 1)
        {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!'); 
        }else
        {
            $this->session->set_flashdata('error', 'No record found for Deleting !');   
        }
        redirect(base_url().'Hierarchy/'.$table,'refresh');   
    } 




    ###################### Pakkabina work starting from Here ####################


    public function get_dvn_parent_details()
    {

        $data      = $this->input->post();
        $act       = $data['act'];
        $searchby  = $data['searchby'];
        $keyword   = $data['keyword'];
        $div       = $data['div'];
        $inputbox  = $data['inputbox'];
        $html      = '';    
        $get_dvn_bycode =  $this->isAscii($keyword);           

        $param_view['relation'][]   = array(
            'table'   =>  'division_list',
            'ref'     =>  'id',
            'column'  =>  'kabina_id',
            'dropdown'=>  'kabina_list ',

        );    
        $param_view['relation'][]   = array(
            'table'   =>  'kabina_list',
            'ref'     =>  'id',
            'column'  =>  'kabinat_id',
            'dropdown'=>  'kabinat_list',
        );             
        $param_view['relation'][]   = array(
            'table'   =>  'kabinat_list',
            'ref'     =>  'id',
            'column'  =>  'country_id',
            'dropdown'=>  'country_list',
        ); 

        if($get_dvn_bycode ==1):

            $get_searched_data =  $this->get_dvn_bycode($keyword);        
            else:

            $get_searched_data =  $this->get_dvn_byname($keyword);      
            endif;        

        foreach($get_searched_data as $gsd) :

            $relation_pax = $this->_get_relation_pax_dataarray($param_view['relation'],$gsd->id);
            $rp           = $relation_pax;
            $segment_data =  $rp['country_list'].'___'.$rp['kabinat_list'].'___'.$rp['kabina_list'].'___'.$gsd->id;

            //                       $segment_data
            $html .= '<li class="ui-menu-item">
            <a id="Datadiv" class="ui-corner-all" onclick="setSearchData(\''.$div.'\',\''.$gsd->code.' | '.$gsd->title.'\',\''.$inputbox.'\',\''.$segment_data.'\');">
            '.$gsd->code.' | '.$gsd->title.'
            </a>
            </li>';
            endforeach;   

        echo $html ;

    }

    public function isAscii($str) 
    {
        return 0 == preg_match('/[^\x00-\x7F]/', $str);
    }

    public function _get_relation_pax_dataarray($param,$default)
    {
        foreach($param as $key => $parm):

            if($key > 0)
            {
                $pax = end($_return); 
            }else
            {
                $pax = $default;   
            } 
            $_return[trim($parm['dropdown'])] = $this->_get_relation_pax($parm['table'],$parm['column'],$parm['ref'],$pax);

            endforeach;  
        return $_return;
    }

    public function _get_relation_pax($table,$column,$reference,$input)
    {
        $this->pakkabina_db->select($column);
        $this->pakkabina_db->where($reference,$input);
        $this->pakkabina_db->where('is_enable',1);
        $result =  $this->pakkabina_db->get($table)->result();
        return $result[0]->$column;

    } 


    ###################### Pakkabina work Ending from Here ####################



}
