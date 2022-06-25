<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BuildingExpense extends MX_Controller  
{
    public $admin_email = array();

    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->library('email');
        $this->load->model('Mdl_buildingexpense');
        $this->load->library('Pdf');
        $this->admin_email = $this->Mdl_buildingexpense->_get_admin_email();
    }

    public function index()
    {    
      
    }

    //Expense List
    public function expense_list()
    {
		
        $data['result_set'] = $this->Mdl_buildingexpense->_get_expense_list();
        $data['content']  = 'BuildingExpense/expense_list';
        $this->load->view('Template/template',$data);
    }

	 //With Draw List
    public function withdraw_list()
    {
        $data['result_set'] = $this->Mdl_buildingexpense->_get_withdraw_list();
        $data['content']  = 'Expense/withdraw_list';
        $this->load->view('Template/template',$data);
    }


    //Order List
    public function order_list()
    {
        //$data['code_gen'] = $this->Mdl_ajeer->_get_ajeer_code_generator();
        $data['content']  = 'Expense/order_list';
        $this->load->view('Template/template',$data);
    }
    //Order List
    public function view_order_list()
    {
        $data['result_set'] = $this->Mdl_buildingexpense->_get_order_list();
        $data['content']  = 'Expense/view_order_list';
        $this->load->view('Template/template',$data);
    }
    
	//Category List Action
    public function expense_action()
    {
        $id = $this->uri->segment(3);
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_buildingexpense->_get_expense_list($id);
        }
        $data['content']  = 'BuildingExpense/expense_action';
        $this->load->view('Template/template',$data);
    }
	
	
	
	//Category List Action
    public function withdraw_action()
    {
        $id = $this->uri->segment(3);
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_buildingexpense->_get_withdraw_list($id);
        }
        $data['content']  = 'Expense/withdraw_action';
        $this->load->view('Template/template',$data);
    }

    //Sub Category List Action
    public function sub_category_action()
    {
        $id = $this->uri->segment(3);
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_buildingexpense->_get_sub_category_list($id);
        }
        $data['content']  = 'Expense/sub_category_action';
        $this->load->view('Template/template',$data);
    }


    //Category Submit
    public function expense_submit()
    {

        $post = $this->input->post();
        $id = $this->uri->segment(3);
        if(isset($post['status'])){$is_enable = 1;}else{$is_enable = 0;}
        //print_r($post);
        //echo $is_enable;
        //exit;
        if($post['id'] > 0)
        {
			
			if($this->session->userdata('user_type') == "1")
			{
				$country_id = $post['country_id'];
				$city_id = $post['city_id'];
				$branch_id = $post['branch_id'];
				$project_id = $post['project_id'];
			}
			else
			{
				$country_id = $this->session->userdata('country_id');
				$city_id = $this->session->userdata('city_id');
				$branch_id = $this->session->userdata('branch_id');
				$project_id = $this->session->userdata('project_id');
			}
                    $this->db->trans_start(); // Query will be rolled back
                    //Person Relation info
                    $data_p_relation =
                        array
                        (
                            'country_id' => $country_id,
                            'city_id' => $city_id,
                            'branch_id' => $branch_id,
                            'project_id' => $project_id,
                            'expense_type_id' => $post['expense_type_id'],
                            'exp_des' => $post['exp_des'],
                            'exp_price' => $post['exp_price'],
                            'exp_from' => $post['exp_from'],
                            'exp_type' => 'building_expense',
                           // 'exp_date' => date('Y-m-d'),
                            'is_enable' => $is_enable
                        );
                    $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation, $post['id'], 'building_expense_list');
                    $this->db->trans_complete();
                
            
            if($db_command)
            {
                if($post['id'] > 0)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url().'BuildingExpense/expense_list','refresh');

            }
            else
            {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url().'BuildingExpense/expense_list','refresh');

            }


        } //Add Category
        else
        {

           if($this->session->userdata('user_type') == "1")
			{
				$country_id = $post['country_id'];
				$city_id = $post['city_id'];
				$branch_id = $post['branch_id'];
				$project_id = $post['project_id'];
			}
			else
			{
				$country_id = $this->session->userdata('country_id');
				$city_id = $this->session->userdata('city_id');
				$branch_id = $this->session->userdata('branch_id');
				$project_id = $this->session->userdata('project_id');
			}
            $this->db->trans_start(); // Query will be rolled back
            //Person Relation info
            $data_p_relation =
                array
                (
                            'country_id' => $country_id,
                            'city_id' => $city_id,
                            'branch_id' => $branch_id,
                            'project_id' => $project_id,
                            'expense_type_id' => $post['expense_type_id'],
                            'exp_des' => $post['exp_des'],
                            'exp_price' => $post['exp_price'],
                            'exp_from' => $post['exp_from'],
                            'exp_type' => 'building_expense',
							 'exp_date' => date('Y-m-d'),
                            'is_enable' => $is_enable
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation,null,'building_expense_list');
			//echo $this->db->last_query();exit;
			
            $this->db->trans_complete();
            if($db_command)
            {
                if($post['id'] > 0)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url().'BuildingExpense/expense_list','refresh');

            }
            else
            {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url().'BuildingExpense/expense_list','refresh');

            }



        }

       // exit;


    }

	
	 //Category Submit
    public function withdraw_submit()
    {

        $post = $this->input->post();
        $id = $this->uri->segment(3);
        if(isset($post['status'])){$is_enable = 1;}else{$is_enable = 0;}
        //print_r($post);
        //echo $is_enable;
        //exit;
        if($post['id'] > 0)
        {

                    $this->db->trans_start(); // Query will be rolled back
                    //Person Relation info
                    $data_p_relation =
                        array
                        (
                            'exp_name' => $post['exp_name'],
                            'exp_des' => $post['exp_des'],
                            'exp_price' => $post['exp_price'],
                            'exp_from' => $post['exp_from'],
                            'exp_type' => 'withdraw',  
							//'exp_date' => date('Y-m-d'),
                            'is_enable' => $is_enable
                        );
                    $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation, $post['id'], 'expense_list');
                    $this->db->trans_complete();
                
            
            if($db_command)
            {
                if($post['id'] > 0)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url().'Expense/withdraw_list','refresh');

            }
            else
            {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url().'Expense/withdraw_list','refresh');

            }


        } //Add Category
        else
        {

           // echo $_FILES['cat_img']['name'];
          //  exit;

            $this->db->trans_start(); // Query will be rolled back
            //Person Relation info
            $data_p_relation =
                array
                (
                            'exp_name' => $post['exp_name'],
                            'exp_des' => $post['exp_des'],
                            'exp_price' => $post['exp_price'],
                            'exp_from' => $post['exp_from'],
                            'exp_type' => 'withdraw',
							 'exp_date' => date('Y-m-d'),
                            'is_enable' => $is_enable
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation,null,'expense_list');
            $this->db->trans_complete();
            if($db_command)
            {
                if($post['id'] > 0)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url().'Expense/withdraw_list','refresh');

            }
            else
            {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url().'Expense/withdraw_list','refresh');

            }



        }

       // exit;


    }


  
    //Search Expense List
    public function Expense_search()
    {
        $data_post   	= $this->input->post();
        $search_cat_id = $data_post['search_cat_id'];
        $scat_id = $data_post['scat_id'];
        $this->db->select('*');
        if($search_cat_id > 0)
        {
            $this->db->where('category_id',$search_cat_id);
        }
        if($scat_id > 0)
        {
            $this->db->where('subcategory_id',$scat_id);
        }
        if($this->session->userdata('user_type') == 'seller')
        {
            $this->db->where('created_by',$this->session->userdata('id'));
            $this->db->where('user_type',$this->session->userdata('user_type'));
        }
        $this->db->order_by('id','desc');
        $result =  $this->db->get('Expense_list')->result();
        ?>
    <?php



    }
	
	
	  //Search Order List
    public function order_search()
    {
        $data_post   	= $this->input->post();
        $search_cat_id = $data_post['search_cat_id'];
        $scat_id = $data_post['scat_id'];
        $this->db->select('*');
        if($search_cat_id > 0)
        {
            $this->db->where('category_id',$search_cat_id);
        }
        if($scat_id > 0)
        {
            $this->db->where('subcategory_id',$scat_id);
        }
        if($this->session->userdata('user_type') == 'seller')
        {
            $this->db->where('created_by',$this->session->userdata('id'));
            $this->db->where('user_type',$this->session->userdata('user_type'));
        }
        $this->db->order_by('id','desc');
        $result =  $this->db->get('Expense_list')->result();
        ?>
   <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Expense
                        </div>
                        <div class="table-responsive ">
                            <table id="Expense-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                   
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Name</th>
                                  
                                    <th>Description</th>
                                  

                                    <th>Total Price</th>                                 
                                    <th>Sell Now</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($result as $res):

                                    $category_name = $this->Mdl_buildingexpense->get_relation_pax('category_list','category_name','id',$res->category_id);
                                    if($res->user_type == "seller") {
                                        $seller_name = $this->Mdl_buildingexpense->get_relation_pax('seller_list', 'company', 'id', $res->created_by);
                                    }else
                                    {
                                        $seller_name = "--";
                                    }
                                    $subcategory_name = $this->Mdl_buildingexpense->get_relation_pax('category_list','category_name','id',$res->subcategory_id);
                                   // $currency_name = $this->Mdl_buildingexpense->get_relation_pax('currency_list','code','id',$fc->currency_id);
                                    ?>
                                    <tr>
                                      
                                        <td class="center">
                                            <?php
                                          echo $category_name;
                                            ?>
                                        </td>
                                        <td><?php echo $subcategory_name; ?></td>
                                        <td><?php echo $res->Expense_name;?></td>
                                        <td><?php echo $res->Expense_description;?></td>
                                        
                                 
                                        <td><?php echo $res->total_price;?></td>
                                      
                                     
                                        <td>
                                            <a class="green btn" target="_blank" href="<?php echo base_url('Expense/add_order/'.$res->id.''); ?>">
                                               Buy Now
                                            </a>
                                        </td>

                                   </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($)
            {
                //Expense Status Change
                $(".Expense_status").change(function(){
                    var _status = $(this).val();
                    var ref     = $(this).attr('ref');
                    var reff     = $(this).attr('reff');
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
                        json['seller_id']       = reff;
                        json['status']   = status_new;
                        var request = $.ajax({
                            url: "<?php echo base_url('Expense/change_Expense_status'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",
                           // dataType: "html",

                            success : function(_return)
                            {
                                //console.log(_return);
                                if(_return['_return'] > 0)
                                {

                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Expense Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });

                                    return false;

                                }
                            }
                        });
                    }
                });

  /*              //Discount Status Change
                $(".discount_status").change(function(){
                    var _status = $(this).val();
                    var ref     = $(this).attr('ref');
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
                        var request = $.ajax({
                            url: "<?php //echo base_url('Expense/change_discount_status'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",

                            success : function(_return)
                            {
                                if(_return['_return'] > 0)
                                {

                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Discount Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });

                                    return false;

                                }
                            }
                        });
                    }
                });
*/
                var oTable1 = $('#Expense-table').dataTable(
                    {
                        "aoColumns":
                            [
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ]
                    });
            });
        </script>
    <?php



    }

   //Add New Order
    public function add_order()
    {
		
	/* 	$get_order = $this->Mdl_buildingexpense->_get_order_code_generator();
	
		
		$first_variable="ORD";
		$get_current_date=date('dmy');
        $order_number=$first_variable."-".$get_order."-".$get_current_date;
		echo $order_number;
		exit; */
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->where('id',$id);
        $result =  $this->db->get('Expense_list')->result();
        $data['view_result']  = $result;
        $data['content']  = 'Expense/add_order';
        $this->load->view('Template/template',$data);

    }
	
	
	
	   //Add Payment
    public function add_payment()
    {
        $data['content']  = 'Expense/add_payment';
        $this->load->view('Template/template',$data);
    }
	
	//Payment Submit	
    public function partial_payment_submit()
    {	
        $post = $this->input->post();
		/* echo "<pre>";
		print_r($post);
		exit; */
				$order_remaining_amount1 = $_POST['order_remaining_amount'];
				$old_payment_id = $_POST['old_payment_id'];
				$old_order_code = $_POST['old_order_code'];
				$old_order_id = $_POST['old_order_id'];
				$order_user_id = $_POST['order_user_id'];
				$paid_price = $_POST['paid_price_payment'];
				$remaining_price = $_POST['remaining_price_payment'];
				
				$final_total = 0;
				if($paid_price < $order_remaining_amount1)
				{
					$final_total =  $order_remaining_amount1 - $paid_price;
					$data_p_relation21 =
							array
							(
								'remaining_price'           => '0',				
                            );
					$this->db->where('payment_id', $old_payment_id);
				    $db_command = $this->db->update('payment_list', $data_p_relation21);
					
					$data_p_relation2111 =
						array
						(
							'order_id'              => $old_order_id,
							'user_id'              => $order_user_id,
							'order_code'              => $old_order_code,
							 'paid_price'           => $paid_price,
							 'old_paid_price'           => $paid_price,
							'remaining_price'           => $final_total,				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2111,null,'payment_list');
					
									
				}else if($paid_price == $order_remaining_amount1)
				{
					$final_total = $order_remaining_amount1 - $paid_price;
					$data_p_relation21 =
							array
							(
								'remaining_price'           => '0',				
                            );
					$this->db->where('payment_id', $old_payment_id);
				    $db_command = $this->db->update('payment_list', $data_p_relation21);
					
					$data_p_relation2111 =
						array
						(
							'order_id'              => $old_order_id,
							'user_id'              => $order_user_id,
							'order_code'              => $old_order_code,
							 'paid_price'           => $paid_price,
							 'old_paid_price'           => $paid_price,
							'remaining_price'           => $final_total,				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2111,null,'payment_list');
					
					
					
				}				
					
			
			//$this->db->trans_complete();
            if($db_command)
            {
				
				 $data['user_id'] = $order_user_id;
				 $data['order_id'] = $old_order_id;
				 $data['order_code'] = $old_order_code;
				//$data['content']    = 'Expense/view_order_slip';
				$this->load->view('Expense/view_order_slip',$data);
            }
            else
            {
                $this->session->set_flashdata('Error', 'your payment has not been saved');
                redirect(base_url().'Expense/add_payment','refresh');

            }

	}

	
	
	//Order Submit	
    public function order_submit()
    {
		//$this->load->helper('string');
		//$order_code =  mt_rand(10000, 99999);
		
		$get_order = $this->Mdl_buildingexpense->_get_order_code_generator();
	
		
		$first_variable="ORD";
		$get_current_date=date('dmy');
        $order_number=$first_variable."-".$get_order."-".$get_current_date;
		
		
        $post = $this->input->post();
		/*  echo "<pre>";
			print_r($_POST);
			
			exit;   */
		//echo "<pre>";
		//print_r($post);
		//exit;
        //$id = $this->uri->segment(3);
		//$this->db->trans_start(); // Query will be rolled back
            //Person Relation info
         
				if($post['order_user_id'] == "")
				{
					$data_p_relation1 =
                array
                (
                    'user_type'              => 'user',
					 'account_type'              => 'user',
                    'name'              => $post['name'],
                    'contact'           => $post['contact'],
                    'address'                   => $post['address'],
					'ip_address' => $this->input->ip_address(),
					 'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation1,null,'user_list');
			$last_user_id = $this->db->insert_id();
					
				}else
				{
				$data_p_relation1 =
                array
                (
                    'name'              => $post['name'],
                    'contact'           => $post['contact'],
                    'address'                   => $post['address'],
					'ip_address' => $this->input->ip_address(),
					 'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation1,$post['order_user_id'],'user_list');
			$last_user_id =$post['order_user_id'];
				}
		
			
			
			$data_p_relation_order =
                array
                (
                    'order_code'              => $order_number,
                   'total_price'           => $post['total_price']-$post['pre_remaining__price'],
                    'user_id'           => $last_user_id,
                    'order_date'           => date("Y-m-d"),
                    'payment_mode'           => 'cash',
                    'user_type'           => 'user',
                    'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation_order,null,'order_list');
            //$db_command = $this->db->insert('order_list', $data_p_relation_order);
			$last_order_id = $this->db->insert_id();
            
			
			
			
			 for ($i=0; $i < count($post['pid']); $i++)  
			{
				$pid = $post['pid'][$i];
				$pprice = $post['pprice'][$i];
				$sprice = $post['sprice'][$i];
				$qty = $post['qty'][$i];
				$otherf = $post['otherf'][$i];
				$otherp = $post['otherp'][$i];
				$totalp = $post['totalp'][$i];
				
				
				$data_p_relation_cart =
                array
                (
                    'order_code'              => $order_number,
                   'Expense_id'           => $pid,
                   'Expense_price'           => $pprice,
                   'sell_price'           => $sprice,
                   'qty'           => $qty,
                   'other_features'           => $otherf,
                   'other_charges'           => $otherp,
                   'total_price'           => $totalp,                  
                    'user_id'           => $last_user_id,
                    'cart_date'           => date("Y-m-d"),                   
                    'user_type'           => 'user',
                    'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation_cart,null,'cart_list');
            //$db_command = $this->db->insert('order_list', $data_p_relation_order);
			$last_cart_id = $this->db->insert_id();
				
				
				
				
				 $get_Expense_quantity = $this->Mdl_buildingexpense->get_relation_pax('Expense_list','Expense_quantity','id',$pid);
                $final_quantity = $get_Expense_quantity - $qty;
                //echo $cart_Expense_id." Expense<br/> ".$cart_Expense_qty." qty<br/>".$get_Expense_quantity." pqty<br/>".$final_quantity." finalqty<br/>";
                $data_update = array
                (
                    'Expense_quantity' => $final_quantity
                );
                $this->db->where('id',$pid);
                $db_command = $this->db->update('Expense_list',$data_update);
				
				
				
				
			}
			
			
			
			
			
			
			/* print_r($last_user_id);
			print_r($this->db->last_query());
			exit; */
			
			$order_remaining_amount = $_POST['order_remaining_amount'];
			
			if($order_remaining_amount == 0)
			{
				$data_p_relation2 =
                array
                (
                    'order_id'              => $last_order_id,
                    'user_id'              => $last_user_id,
                    'order_code'              => $order_number,
					 'paid_price'           => $post['paid_price'],
					 'old_paid_price'           => $post['paid_price'],
                    'remaining_price'           => $post['remaining_price'],				
                    'payment_date'           => date("Y-m-d"),
                    'payment_mode'           => 'cash',
                    'user_type'           => 'user',
                    'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2,null,'payment_list');
			$last_payment_id = $this->db->insert_id();
				
			}
			else
			{ 
				
				
				
				$order_remaining_amount1 = $_POST['order_remaining_amount'];
				$old_payment_id = $_POST['old_payment_id'];
				$old_order_code = $_POST['old_order_code'];
				$old_order_id = $_POST['old_order_id'];
				$order_user_id = $_POST['order_user_id'];
				$paid_price = $_POST['paid_price'];
				$remaining_price = $_POST['remaining_price'];
				
				$final_total = 0;
				if($paid_price > $order_remaining_amount1)
				{
					$final_total = $paid_price - $order_remaining_amount1;
					$data_p_relation21 =
							array
							(
								'remaining_price'           => '0',				
                            );
					$this->db->where('payment_id', $old_payment_id);
				    $db_command = $this->db->update('payment_list', $data_p_relation21);
					
					$data_p_relation2111 =
						array
						(
							'order_id'              => $old_order_id,
							'user_id'              => $order_user_id,
							'order_code'              => $old_order_code,
							 'paid_price'           => $order_remaining_amount1,
							 'old_paid_price'           => $order_remaining_amount1,
							'remaining_price'           => '0',				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2111,null,'payment_list');
					
					$data_p_relation2 =
						array
						(
							'order_id'              => $last_order_id,
							'user_id'              => $last_user_id,
							'order_code'              => $order_number,
							 'paid_price'           => $final_total,
							 'old_paid_price'           => $final_total,
							'remaining_price'           => $post['remaining_price'],				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2,null,'payment_list');
					$last_order_id11 = $this->db->insert_id();
					
				}else if($paid_price == $order_remaining_amount1)
				{
					$final_total = $paid_price - $order_remaining_amount1;
					$data_p_relation21 =
							array
							(
								'remaining_price'           => '0',				
                            );
					$this->db->where('payment_id', $old_payment_id);
				    $db_command = $this->db->update('payment_list', $data_p_relation21);
					
					$data_p_relation2111 =
						array
						(
							'order_id'              => $old_order_id,
							'user_id'              => $order_user_id,
							'order_code'              => $old_order_code,
							 'paid_price'           => $order_remaining_amount1,
							 'old_paid_price'           => $order_remaining_amount1,
							'remaining_price'           => '0',				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2111,null,'payment_list');
					
					$data_p_relation2 =
						array
						(
							'order_id'              => $last_order_id,
							'user_id'              => $last_user_id,
							'order_code'              => $order_number,
							 'paid_price'           => $final_total,
							 'old_paid_price'           => $final_total,
							'remaining_price'           => $post['remaining_price'],				
							'payment_date'           => date("Y-m-d"),
							'payment_mode'           => 'cash',
							'user_type'           => 'user',
							'is_enable'                => 1
						);
					$db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2,null,'payment_list');
					$last_order_id11 = $this->db->insert_id();
					
				}				
				else
				{
				

				$data_p_relation2 =
                array
                (
                    'order_id'              => $last_order_id,
                    'user_id'              => $last_user_id,
                    'order_code'              => $order_number,
					 'paid_price'           => $final_total,
					 'old_paid_price'           => $final_total,
                    'remaining_price'           => $post['remaining_price'],				
                    'payment_date'           => date("Y-m-d"),
                    'payment_mode'           => 'cash',
                    'user_type'           => 'user',
                    'is_enable'                => 1
                );
            $db_command = $this->Mdl_buildingexpense->db_command($data_p_relation2,null,'payment_list');
			$last_order_id = $this->db->insert_id();
			
				
				
			}
			
			
			
			
			}
			
			
                   
                    
					
					
			
			//$this->db->trans_complete();
            if($db_command)
            {
				
				
				
				
				
				 $data['user_id'] = $last_user_id;
				 $data['order_id'] = $last_order_id;
				 $data['order_code'] = $order_number;
				//$data['content']    = 'Expense/view_order_slip';
				$this->load->view('Expense/view_order_slip',$data);
            }
            else
            {
                $this->session->set_flashdata('Error', 'your order has not been saved');
                redirect(base_url().'Expense/add_order/'.$post['Expense_id'],'refresh');

            }

	}

	  //Expense View Image
    public function view_image()
    {
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->where('id',$id);
        $result =  $this->db->get('Expense_list')->result();
        $data['view_image']  = $result;
        $data['content']  = 'Expense/Expense_view_image';
        $this->load->view('Template/template',$data);

    }


    //distribution Expense 
    public function distribution()
    {
        $data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/distribution';
        $this->load->view('Template/template',$data);   
    }

   
		

    //Expense Expense 
    public function Expense()
    {
        $data['content']  = 'Expense/Expense';
        $this->load->view('Template/template',$data);   
    }



 
	
	
	
    public function customer_action($id = null)
    { 

        $id = $this->uri->segment(3);  
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_buildingexpense->_get_single_record_byid($id,'customer');  
        } 

        $data['content']   = 'Expense/customer_action';
        $this->load->view('Template/template',$data);
    }


    public function customer_command()
    {
		$this->load->helper('string');
        $get_code =  random_string('alnum',132);
		
		
        $post =  $this->input->post();
		//echo "<pre>";
		//print_r($post);
		
		//Payment Status 
		$payment_receiving = 0;
		$payment_date = "";
		if($post['payment_receiving'] == 1)
		{
			$payment_receiving = 1;
			$payment_date = date('Y-m-d'); 
		}
		else
		{
			$payment_receiving = 0;
			$payment_date = "";
		}
		
        if($post['customer_id'] == null)
        {
            $code_gen = $this->Mdl_buildingexpense->_get_customer_code_generator();		
        }
        $data_amount = array( 'category_id' => $post['category_id'] , 'dis_channel_id' => $post['dis_channel_id']);
        $data_output = array( 'rate'=>'rate','currency_id'=>'currency_id','shipping'=>'shipping' );
        $amount = $this->Mdl_buildingexpense->check_already_exists_multiple('category_channel',$data_output,$data_amount,2);
		$total_quantity = $post['noc'] * 12;
        //echo "<pre>";
        //print_r($post);
        //exit;
		$this->db->trans_start();
        if($post['login_id'] != null)
        {
            $data_login = array
            (
                'account_title' => 'Customer',
                'mobile_no' => $post['mobile_no'],
                'email' => $post['email'],
                'user_type' => 0,
                'ip_address' => $this->input->ip_address(),
                'is_enable' => 1

            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_login,$post['login_id'],'login');
            $last_login_id = $post['login_id'];

        }
        else
        {
            $data_login = array
            (
                'account_title' => 'Customer',
                'email' => $post['email'],
                'mobile_no' => $post['mobile_no'],
                'user_type' => 0,
                'ip_address' => $this->input->ip_address(),
                'is_enable' => 1
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_login,null,'login');
            $last_login_id = $this->db->insert_id();
        }

        if($post['customer_id'] != null)
        {

            $data_customer = array
            (
                'department_id' => $post['department_id'],
                'tanzimi_zimadari' => $post['tanzimi_zimadari'],
                'name' => $post['name'],
                'email' => $post['email'],
                'postal_address' => $post['paddress'],
                'shipping_address' => $post['saddress'],
                'mobile_no' => $post['mobile_no'],
                'country_id' => $post['country_id'],
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id']
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,$post['customer_id'],'customer');
            //$last_login_id = $post['login_id'];
        }
        else
        {	
            $data_customer = array
            (
                'customer_code' => $code_gen,
                'category_id' => $post['category_id'],
                'dis_channel_id' => $post['dis_channel_id'],
                'department_id' => $post['department_id'],
                'tanzimi_zimadari' => $post['tanzimi_zimadari'],
                'login_id' => $last_login_id,                
                'name' => $post['name'],
                'email' => $post['email'],
                'postal_address' => $post['paddress'],
                'shipping_address' => $post['saddress'],
                'mobile_no' => $post['mobile_no'],
                'country_id' => $post['country_id'],
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'frequency_id' => 12,
                'noofcopy' => $post['noc'],             
                'r_noofcopy' => $post['noc'],				
                'payment_type' => 'cash',
                'amount' => $amount[0]->rate,
                'shipping' => $amount[0]->shipping,
                'currency_id' => $amount[0]->currency_id,				
                'payment_status' => $payment_receiving,				
                'payment_date' => $payment_date,				
                'receipt_no' => $post['slip_no'],
				'total_quantity' => $total_quantity,
                'is_enable' => 1
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,null,'customer');
            //$last_login_id = $this->db->insert_id();
        }
		$this->db->trans_complete(); 
        if($db_command)
        {
            if($post['customer_id'] != null)
            {


                $this->session->set_flashdata('update', 'your data successfully Updated');  
                redirect(base_url()."Expense/customer",'refresh'); 
            }
            else
            {
               

                $search_char = substr($post['mobile_no'], 0, 2);			
                if($search_char == "92")
                {
                    $sms_num = $post['mobile_no'];
                }
                else
                {
                    $new_no = substr($post['mobile_no'],1);
                    $sms_num = "92".$new_no;
                }


                $total_amount = ($amount[0]->rate + $amount[0]->shipping) * $post['noc'];
				
				//Registration Send SMS
				if($post['send_sms'] == 1)
				{
					$msg = 'Mahnama Sub:Deposit Rs.'.$total_amount.' to BANK:MCB BR.CODE:0037 Title:DAWAT E ISLAMI TRUST-MAHNAMA A/C#0779283171003236 *Mention Cust.ID:'.$code_gen.' in Deposit Slip.';
					$this->actionSms($sms_num,urlencode($msg));		
				}
		
				//Payment Send SMS
				if($post['payment_receiving'] == 1)
				{			
					$msg_payment = 'Thanks for the Registration with Mahnama Faizan-e-madinah.Your Payment Rs.'.$total_amount.' against ID '.$code_gen.' has been received successfully.';
					$this->actionSms($sms_num,urlencode($msg_payment));			
				
				}
				
                $this->session->set_flashdata('saved', 'your data successfully Saved'); 
                redirect(base_url()."Expense/success/$get_code/$code_gen/$get_code",'refresh'); 
            }


        }
		else
		{
			$this->session->set_flashdata('Error', 'your data not added please try again'); 
            redirect(base_url().'Expense/customer/','refresh'); 

		} 

    }

    //Success List Expense 
    public function success()
    {
        //$data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/success';
        $this->load->view('Template/template',$data);   
    }


	function getfrequency($code) 
	{
		switch ($code) {
			case '1': return 'Monthly';
			case '3': return 'Quarterly';
			case '6': return 'Half Yearly';
			case '12': return 'Annual';

		}
		return false;
	}


    //Payment Receiving Search
    public function payment_receiving()
    {
        //$data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/payment_receiving';
        $this->load->view('Template/template',$data);   
    }


    //Payment Receiving Search
    public function payment_receiving_search()
    {

        $data_post   	= $this->input->post();
        //print_r($data_post);

        $search_payment  	= $data_post['search_payment_input'];
        $result_payment =  $this->Mdl_buildingexpense->_payment_receiving_search($search_payment);
        //echo "<pre>";
        //print_r($result_payment);
        //exit;

        ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Payment Receiving
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="payment_table" class="table table-striped table-responsive table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>  -->
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Category</th>

                                        <th>No. of Copies</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Receipt No/Slip No</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($result_payment as $fc): 

                                        $category_name = $this->Mdl_buildingexpense->get_relation_pax('category_list','title','id',$fc->category_id);
                                        $distribution_name = $this->Mdl_buildingexpense->get_relation_pax('distribution_channel','title','id',$fc->dis_channel_id);
                                        $currency_name = $this->Mdl_buildingexpense->get_relation_pax('currency_list','code','id',$fc->currency_id);
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; ?>" id="checkbox_<?php  //echo $fc->inv_id; ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->

                                                <?php 
                                                if($fc->payment_status == 0)
                                                {
                                                    ?>
                                                    <input type="hidden" name="customer_id[]" id="customer_id" value="<?php echo $fc->id; ?>" />

                                                    <label>
                                                        <input type="checkbox" name="checkbox_customer[]" id="checkbox_customer" value="<?php echo $fc->id; ?>" class="ace checkbox checkbox_customer_payment" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                    <?php
                                                }
                                                ?>
                                            </td>
											<td><?php echo $fc->customer_code; ?></td>
											<td><?php echo $fc->mobile_no;?></td>
											<td><?php echo $fc->created_date;?></td>
											<td><?php echo $fc->name;?></td>
											<td><?php echo $fc->postal_address;?></td>
											
                                            <td><?php echo $category_name; ?></td>
                                           
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td><?php echo $currency_name.' '.(($fc->amount + $fc->shipping) * $fc->noofcopy); ?> </td>
                                            <td><?php
                                                if($fc->payment_type == "bank")
                                                {
                                                    echo '<span class="btn btn-sm" style="padding:0px 10px;" title="Bank">Bank</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="btn btn-warning btn-sm tooltip-warning" title="Cash" style="padding:0px 10px;">Cash</span>';
                                                }

                                            ?> </td>
                                            <td><?php //echo $fc->payment_status; 

                                                if($fc->payment_status == 1)
                                                {
                                                    echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Received">Received</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="btn btn-danger btn-sm" title="Pending" style="padding:0px 10px;">Pending</span>';
                                                }


                                            ?> </td>
											<td>
											 <?php 
                                                if($fc->payment_status == 0)
                                                {
                                                    ?>
											 <input type="text" name="slip_no[<?php echo $fc->id; ?>]" id="slip_no" value="<?php //echo $fc->id; ?>" class="col-xs-3 col-sm-12" />
											 <?php
												}
												else
												{
											
												 echo $fc->receipt_no;
											
												}
											 ?>
											 
											</td>
											
											<td>
											 <?php 
                                                if($fc->payment_status == 0)
                                                {
                                                    ?>
												<div class="clearfix">	
											 <input type="date" name="payment_date[<?php echo $fc->id; ?>]" id="payment_date" value="<?php //echo $fc->id; ?>" class="date-picker col-xs-3 col-sm-9" placeholder="Payment Date" data-date-Expenseat="yyyy-mm-dd"  />
											 </div>
											 <?php
												}
												else
												{
													echo $fc->payment_date; 
												}
											 ?>
											 
											</td>

                                        </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="clearfix Expense-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <!--<button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                <i class="icon-ok bigger-110"></i>
                Submit All
                </button>-->
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate payment_receiving_submit" disabled name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Received
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>		
        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#payment_table').dataTable(
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ] 
                    });      
            });
        </script>
        <?php		 



    }


    //Payment Submit
    public function payment_submit()
    {
        $data_post = $this->input->post();
        //echo "<pre>";
        //print_r($data_post);
		foreach($data_post['checkbox_customer'] as $chk)
        {

            $mobile_no = $this->Mdl_buildingexpense->get_relation_pax('customer','mobile_no','id',$chk);
            $shipping = $this->Mdl_buildingexpense->get_relation_pax('customer','shipping','id',$chk);
            $amount = $this->Mdl_buildingexpense->get_relation_pax('customer','amount','id',$chk);
            $noofcopy = $this->Mdl_buildingexpense->get_relation_pax('customer','noofcopy','id',$chk);
            $customer_code = $this->Mdl_buildingexpense->get_relation_pax('customer','customer_code','id',$chk);

			
			$total_amount = ($amount + $shipping) * $noofcopy;
			
			
            $search_char = substr($mobile_no, 0, 2);			
            if($search_char == "92")
            {
            $sms_num = $post['mobile_no'];
            }
            else
            {
            $new_no = substr($mobile_no,1);
            $sms_num = "92".$new_no;
            }			

			$msg_payment = 'Thanks for the Registration with Mahnama Faizan-e-madinah.Your Payment Rs.'.$total_amount.' against ID '.$customer_code.' has been received successfully.';
			
            //$msg = 'Dawateislami Testing Server​​.';

            $this->actionSms($sms_num,urlencode($msg_payment)); 


            //echo $chk."<br/>";
            $data_customer = array
            (
                'payment_status' => 1
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,$chk,'customer');

        }
		
		foreach($data_post['slip_no'] as $slp_key => $slp_val)
        {
			$data_customer = array
            (
                'receipt_no' => $slp_val
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,$slp_key,'customer');
		}	
		
		foreach($data_post['payment_date'] as $slp_keys => $slp_vals)
        {
			$payment_date = "";
			if(!empty($slp_vals))
			{
				$payment_date = $slp_vals;
			}
			else
			{
				$payment_date = date("Y-m-d");
			}
			$data_customer = array
            (
                'payment_date' => $payment_date
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,$slp_keys,'customer');
		}
		
		
        $this->session->set_flashdata('update', 'your payment has been received successfully');  
        redirect(base_url()."Expense/payment_receiving",'refresh'); 
    }

    //Send SMS API
    public function actionSms($number,$msg)
    {
        $mask="InfoSMS";
        $user = "1289";
        $password="attar";
        //$destination = '923343161260';
        //$message = urlencode('This is testing for.');
        $post_data = "user=" . $user . "&pwd=" . $password . "&mask=" . $mask . "&text=" . $msg . "&dest=" . $number . "";    //post string
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.capitalsms.com/sentadd.asp?" . $post_data );
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/x-www-Expense-urlencoded'));
        echo $result = curl_exec ($ch);
    }

    //Mailing List Expense 
    public function mailing_list()
    {
        //$data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/mailing_list';
        $this->load->view('Template/template',$data);   
    }

    //Mailing Lsit 
    public function get_customer_mailing_list()
    {
        $data_post   	= $this->input->post();
        //print_r($data_post);

        $trans_code  	= $data_post['trans_code'];
        $trans_date  	= $data_post['date_mailing'];
        $Expense_id  	= $data_post['Expense_id'];
        $location_id  	= $data_post['location_id'];
        //echo "<pre>";
        //print_r($data_post);
        //exit;

        $this->db->select('inv_distribution.id as inv_id,inv_distribution.trans_code,inv_distribution.trans_date,customer.*,customer.id,customer.name,customer.email,customer.noofcopy,customer.category_id,inv_distribution.Expense_id,inv_distribution.location_id');
        if($trans_code > 0)
        {
            $this->db->where('inv_distribution.trans_code',$trans_code);
        }
        if($trans_date > 0)
        {
            $this->db->where('inv_distribution.trans_date',$trans_date);
        }
        if($Expense_id > 0)
        {
            $this->db->where('inv_distribution.Expense_id',$Expense_id);
        }
        if($location_id > 0)
        {
            $this->db->where('inv_distribution.location_id',$location_id);
        }
		$this->db->where('dispatch_status',0);
        $this->db->from('inv_distribution');
        $this->db->join('customer','customer.id = inv_distribution.customer_id');

        $result = $this->db->get();


        if( $result->num_rows() > 0 )
        {
            $filtered_customer = $result->result();
        }


        ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Mailing List
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="mailing_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>-->    
                                        </th>
										<th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
										<th>Expense </th>
                                        <th>Location </th>									
                                        <th>No. of Copies</th>
										<th>View/Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($filtered_customer as $fc): 

                                        $Expense_name = $this->Mdl_buildingexpense->get_relation_pax('Expense_list','title','id',$fc->Expense_id);
										 $location_name = $this->Mdl_buildingexpense->get_relation_pax('location_list','title','id',$fc->location_id);
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; ?>" id="checkbox_<?php  //echo $fc->inv_id; ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->
                                                <input type="hidden" name="inv_id[]" id="inv_id" value="<?php echo $fc->inv_id; ?>" />

                                                <label>
                                                    <input type="checkbox" name="checkbox_mailing[]" id="checkbox_mailing" value="<?php echo $fc->inv_id; ?>" class="ace checkbox" />
                                                    <span class="lbl"></span>
                                                </label>

                                            </td>
											
											<td><?php echo $fc->customer_code; ?></td>
											<td><?php echo $fc->mobile_no;?></td>
											<td><?php echo $fc->created_date;?></td>
											<td><?php echo $fc->name;?></td>
											<td><?php echo $fc->shipping_address;?></td>
						
                                            <td><?php echo $Expense_name; ?></td>
                                            <td><?php echo $location_name; ?></td>
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td>
                                                <a href="<?php echo base_url('Expense/print_card/'.$fc->inv_id.''); ?>" class="tooltip-error" data-rel="tooltip" title="View" target="_blank" >
                                                    <span class="purple">
                                                        <i class="icon-eye-open bigger-120"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="clearfix Expense-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate All
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate Selected
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>		
        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#mailing_table').dataTable(
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ] 
                    });      
            });
        </script>
        <?php		 

    }
	
	
	
    //Dispatch Lsit 
    public function get_customer_dispatch_list()
    {
        $data_post   	= $this->input->post();
        //print_r($data_post);

        $trans_code  	= $data_post['trans_code'];
        $trans_date  	= $data_post['date_mailing'];
        $Expense_id  	= $data_post['Expense_id'];
        $location_id  	= $data_post['location_id'];
        //echo "<pre>";
        //print_r($data_post);
        //exit;

        $this->db->select('inv_distribution.id as inv_id,inv_distribution.trans_code,inv_distribution.trans_date,customer.id,customer.*,customer.name,customer.email,customer.noofcopy,customer.category_id,inv_distribution.Expense_id,inv_distribution.location_id');
        if($trans_code > 0)
        {
            $this->db->where('inv_distribution.trans_code',$trans_code);
        }
        if($trans_date > 0)
        {
            $this->db->where('inv_distribution.trans_date',$trans_date);
        }
        if($Expense_id > 0)
        {
            $this->db->where('inv_distribution.Expense_id',$Expense_id);
        }
        if($location_id > 0)
        {
            $this->db->where('inv_distribution.location_id',$location_id);
        }
		$this->db->where('dispatch_status',0);
        $this->db->from('inv_distribution');
        $this->db->join('customer','customer.id = inv_distribution.customer_id');

        $result = $this->db->get();


        if( $result->num_rows() > 0 )
        {
            $filtered_customer = $result->result();
        }


        ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Dispatch List
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="dispatch_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
											<label>
												<input type="checkbox" class="ace" id="ckbCheckAllDispatch" />
												<span class="lbl"></span>
											</label>    
										</th>
                                      	<th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
										<th>Expense </th>
                                        <th>Location </th>									
                                        <th>No. of Copies</th>
									  <!--<th>View/Print</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($filtered_customer as $fc): 

                                        $Expense_name = $this->Mdl_buildingexpense->get_relation_pax('Expense_list','title','id',$fc->Expense_id);
                                        $location_name = $this->Mdl_buildingexpense->get_relation_pax('location_list','title','id',$fc->location_id);
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; ?>" id="checkbox_<?php  //echo $fc->inv_id; ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->
                                                <input type="hidden" name="inv_id[]" id="inv_id" value="<?php echo $fc->inv_id; ?>" />

                                                <label>
                                                    <input type="checkbox" name="checkbox_dispatch[]" id="checkbox_dispatch" value="<?php echo $fc->inv_id; ?>" class="ace checkbox dispatch_quantity" />
                                                    <span class="lbl"></span>
                                                </label>

                                            </td>
											
											<td><?php echo $fc->customer_code; ?></td>
											<td><?php echo $fc->mobile_no;?></td>
											<td><?php echo $fc->created_date;?></td>
											<td><?php echo $fc->name;?></td>
											<td><?php echo $fc->shipping_address;?></td>
						
                                            <td><?php echo $Expense_name; ?></td>
                                            <td><?php echo $location_name; ?></td>
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <!--<td>
                                                <a href="<?php //echo base_url('Expense/print_card/'.$fc->inv_id.''); ?>" class="tooltip-error" data-rel="tooltip" title="View" target="_blank" >
                                                    <span class="purple">
                                                        <i class="icon-eye-open bigger-120"></i>
                                                    </span>
                                                </a>
                                            </td>-->
                                        </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <!--<div class="clearfix Expense-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate All
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate Selected
                </button>
                
            </div>
        </div>-->
		      <div class="clearfix Expense-actions" style="text-align: center;">
                                <div class="col-md-12 ">
                                    <button class="btn pull-right btn-info btn-validate dispatch_sub" disabled type="submit">
                                        <i class="icon-ok bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <!--<button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    Cancel
                                    </button>-->
                                </div>
                            </div>
        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#dispatch_table').dataTable(
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ] 
                    });      
            });
        </script>
        <?php		 

    }
	
	//Dispatch Submit
    public function dispatch_submit()
    {
        $data_post = $this->input->post();
       // echo "<pre>";
        //print_r($data_post);
		//exit;
		$get_customer_data = array();
		$customer_id_get = '';
		$quantity_get = 0;
		$dispatch_quantity_get = 0;
		$final_dispatch_quantity = 0;
		foreach($data_post['checkbox_dispatch'] as $chk)
        {

            //$mobile_no = $this->Mdl_buildingexpense->get_relation_pax('customer','mobile_no','id',$chk);

            /* $search_char = substr($mobile_no, 0, 2);			
            if($search_char == "92")
            {
            $sms_num = $post['mobile_no'];
            }
            else
            {
            $new_no = substr($mobile_no,1);
            $sms_num = "92".$new_no;
            }			

            $msg = 'Dawateislami Testing Server​​.';

            $this->actionSms($sms_num,urlencode($msg)); */

			
           // echo $chk."<br/>";
		   
		   //Quantity ID
			$quantity_id_get = $this->Mdl_buildingexpense->get_relation_pax('inv_distribution','quantity','id',$chk);
			
			
		   //Customer ID
			$customer_id_get = $this->Mdl_buildingexpense->get_relation_pax('inv_distribution','customer_id','id',$chk);
			
			//Dispatch Quantity Get
			$dispatch_quantity_get = $this->Mdl_buildingexpense->get_relation_pax('customer','dispatch_quantity','id',$customer_id_get);
			
			$final_dispatch_quantity = $quantity_id_get + $dispatch_quantity_get;
			
			
			//print_r($get_customer_data);
			
			$data_inv = array
            (
                'dispatch_status' => 1
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_inv,$chk,'inv_distribution'); 
			
			
            $data_customer = array
            (
                'dispatch_quantity' => $final_dispatch_quantity
            );
            $db_command =  $this->Mdl_buildingexpense->db_command($data_customer,$customer_id_get,'customer'); 

        }
		unset($get_customer_data);
		//exit;
		
        $this->session->set_flashdata('update', 'your packed has been dispatch successfully');  
        redirect(base_url()."Expense/dispatch_list",'refresh'); 
    }


    //Print Card Mailing List
    public function print_card()
    {

        $id  = $this->uri->segment(3);

        if($id != null)
        {
            if($id  == 0)
            {
                $this->session->set_flashdata('Invalid Customer ID', 'Sorry system could not find any token related to this Customer ID <i class="icon-eye-open"></i>!'); 
                redirect(base_url().'Expense/mailing_list','refresh');   
            }
            else
            {
                $this->db->where('id',$id);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id',$distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_buildingexpense->get_relation_pax('city_list','title','id',$filtered_customer[0]->city_id);
                $location_name = $this->Mdl_buildingexpense->get_relation_pax('location_list','title','id',$distribution[0]->location_id);
                //echo "<pre>";
                //print_r($distribution);
                //print_r($filtered_customer);
                //exit;

                $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

                $pdf->SetTitle('Print Card');

                $image_logo   = 'public_html/assets/images/logo.jpg';
                $pdf->SetHeaderMargin(2);
                $pdf->SetTopMargin(20);
                $pdf->SetLeftMargin(10);
                $pdf->SetRightMargin(10);
                $pdf->setFooterMargin(20);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->SetAuthor('Author');
                $pdf->SetDisplayMode('real', 'default');

                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25,true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20   ,20    , 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $tbl ='
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">'.$filtered_customer[0]->name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">'.$filtered_customer[0]->postal_address.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">'.$filtered_customer[0]->mobile_no.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">'.$location_name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">'.$distribution[0]->trans_code.'</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">'.$distribution[0]->quantity.'</td>
                </tr>

                </table>
                </div>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
                $pdf->Output('My-File-Name.pdf', 'I');
            }
        }
        $data['content']  = 'Expense/mailing_list';
        $this->load->view('Template/template',$data);

    }


    //Generate Card Single & All
    public function generate_card()
    {
        //Single Card
        if(isset($_POST['submit_selected']))
        {
            $data_post = $this->input->post();

            /* if(count($data_post['checkbox_mailing'])  == 0)
            {
            $this->session->set_flashdata('Invalid Customer ID', 'Sorry system could not find any token related to this Customer ID <i class="icon-eye-open"></i>!'); 
            redirect(base_url().'Expense/mailing_list','refresh');   
            }
            else
            { */

            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Print Card');
            $image_logo   = 'public_html/assets/images/logo.jpg';
            $pdf->SetHeaderMargin(2);
            $pdf->SetTopMargin(20);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);
            $pdf->setFooterMargin(20);
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            ini_set('max_execution_time', 900);
            $page_Expenseat = array
            (
                'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 210),
                'Dur' => 3,
                'trans' => array(
                    'D' => 1.5,
                    'S' => 'Split',
                    'Dm' => 'V',
                    'M' => 'O'
                ),
                'Rotate' => 0,
                'PZ' => 1,
            );

            foreach($data_post['checkbox_mailing'] as $chk)
            {
                $this->db->where('id',$chk);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id',$distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_buildingexpense->get_relation_pax('city_list','title','id',$filtered_customer[0]->city_id);
                $location_name = $this->Mdl_buildingexpense->get_relation_pax('location_list','title','id',$distribution[0]->location_id);


                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25,true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20   ,20    , 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);			

                $tbl ='
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0%" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">'.$filtered_customer[0]->name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">'.$filtered_customer[0]->postal_address.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">'.$filtered_customer[0]->mobile_no.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">'.$location_name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">'.$distribution[0]->trans_code.'</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">'.$distribution[0]->quantity.'</td>
                </tr>
				

                </table>
                </div>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
            }

            $pdf->Output('My-File-Name.pdf', 'I');

            /* } */
        } //All Submit
        else if(isset($_POST['submit_all']))
        {
            $data_post = $this->input->post();
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Print Card');
            $image_logo   = 'public_html/assets/images/logo.jpg';
            $pdf->SetHeaderMargin(2);
            $pdf->SetTopMargin(20);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);
            $pdf->setFooterMargin(20);
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            ini_set('max_execution_time', 900);
            $page_Expenseat = array
            (
                'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 210),
                'Dur' => 3,
                'trans' => array(
                    'D' => 1.5,
                    'S' => 'Split',
                    'Dm' => 'V',
                    'M' => 'O'
                ),
                'Rotate' => 0,
                'PZ' => 1,
            );

            foreach($data_post['inv_id'] as $chk)
            {
                $this->db->where('id',$chk);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id',$distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_buildingexpense->get_relation_pax('city_list','title','id',$filtered_customer[0]->city_id);
                $location_name = $this->Mdl_buildingexpense->get_relation_pax('location_list','title','id',$distribution[0]->location_id);


                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25,true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20   ,20    , 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $tbl ='
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0%" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">'.$filtered_customer[0]->name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">'.$filtered_customer[0]->postal_address.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">'.$filtered_customer[0]->mobile_no.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">'.$location_name.'</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">'.$distribution[0]->trans_code.'</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">'.$distribution[0]->quantity.'</td>
                </tr>

                </table>
                </div>';

                $pdf->writeHTML($tbl, true, false, false, false, '');
            }

            $pdf->Output('My-File-Name.pdf', 'I');
        }
    }

    public function command()
    { 
        //Inventory Action
        if(isset($_POST['save_inventory']))
        {
            $post = $this->input->post();
            if($post['date']== "")
            {
                $data['trans_date']            = date("Y-m-d"); 
            }
            else
            {
                $data['trans_date']            = $post['date']; 
            }			
            $data['Expense_id']         = $post['Expense_id']; 
            $data['quantity']        = $post['qty']; 
            $data['location_id']        = $post['location_id']; 

            $db_command =  $this->Mdl_buildingexpense->db_command($data,$post['id'],'inv_receiving');
            if($db_command)
            {
                if($post['id'] != null)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');  
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');    
                }

                redirect(base_url().'Expense/inventory_receiving','refresh');  
            } 
        }
        else 
        {
            /*  $post = $this->input->post();
            if($post['status']){$is_enable = 1;}else{$is_enable = 0;}      
            $data['email']        = $post['email']; 
            $data['username']     = $post['username']; 
            $data['mobile_no']     = $post['mobile_no']; 
            $data['markaz_id']     = $post['markaz_id'];
            if($post['password'])
            {
            $data['password']     =   Modules::run('Login/_hash',$post['password']); #$this->Mdl_login->hash($post['password']); 
            }
            $data['is_enable']    = $is_enable;
            $data['user_type']    = 0;
            $data['ip_address']   = $this->input->ip_address();
            if(empty($post['markaz_id'])){
            $data['user_type']    = 0;
            }
            if($this->session->userdata('markaz_id')){
            $data['user_type']    = 3;
            $data['markaz_id'] = $this->session->userdata('markaz_id');
            }
            else{
            $data['user_type']    = 2;
            }
            $db_command =  $this->Mdl_users->db_command($data,$post['id'],'login');
            if($db_command)
            {
            if($post['id'] != null)
            {
            $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
            $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Users','refresh');  
            }  */

        }



    }
	
	
	
	//Dispatch List Expense
	public function dispatch_list()
    {
        //$data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/dispatch';
        $this->load->view('Template/template',$data);   
    }
	
	//Recent SMS List Expense
	public function resend_sms()
    {
        //$data['result_set'] = $this->Mdl_buildingexpense->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Expense/resend_sms';
        $this->load->view('Template/template',$data);   
    }
	
	
	//Recent SMS Search
    public function recent_sms_search()
    {

        $data_post   	= $this->input->post();
        //print_r($data_post);

        $search_payment  	= $data_post['search_sms_input'];
        $result_payment =  $this->Mdl_buildingexpense->_payment_receiving_search($search_payment);
        //echo "<pre>";
        //print_r($result_payment);
        //exit;

        ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Recent SMS
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="payment_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>  -->
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Category</th>

                                        <th>No. of Copies</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <!--<th>Receipt No/Slip No</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($result_payment as $fc): 

                                        $category_name = $this->Mdl_buildingexpense->get_relation_pax('category_list','title','id',$fc->category_id);
                                        $distribution_name = $this->Mdl_buildingexpense->get_relation_pax('distribution_channel','title','id',$fc->dis_channel_id);
                                        $currency_name = $this->Mdl_buildingexpense->get_relation_pax('currency_list','code','id',$fc->currency_id);
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; ?>" id="checkbox_<?php  //echo $fc->inv_id; ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->

                                                <?php 
                                               // if($fc->payment_status == 0)
                                               // {
                                                    ?>
                                                    <input type="hidden" name="customer_id[]" id="customer_id" value="<?php echo $fc->id; ?>" />

                                                    <label>
                                                        <input type="checkbox" name="checkbox_sms[]" id="checkbox_sms" value="<?php echo $fc->id; ?>" class="ace checkbox checkbox_sms_customer" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                    <?php
                                               // }
                                                ?>
                                            </td>
											<td><?php echo $fc->customer_code; ?></td>
											<td><?php echo $fc->mobile_no;?></td>
											<td><?php echo $fc->created_date;?></td>
											<td><?php echo $fc->name;?></td>
											<td><?php echo $fc->postal_address;?></td>
											
                                            <td><?php echo $category_name; ?></td>
                                           
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td><?php echo $currency_name.' '.(($fc->amount + $fc->shipping) * $fc->noofcopy); ?> </td>
                                            <td><?php
                                                if($fc->payment_type == "bank")
                                                {
                                                    echo '<span class="btn btn-sm" style="padding:0px 10px;" title="Bank">Bank</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="btn btn-warning btn-sm tooltip-warning" title="Cash" style="padding:0px 10px;">Cash</span>';
                                                }

                                            ?> </td>
                                            <td><?php //echo $fc->payment_status; 

                                                if($fc->payment_status == 1)
                                                {
                                                    echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Received">Received</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="btn btn-danger btn-sm" title="Pending" style="padding:0px 10px;">Pending</span>';
                                                }


                                            ?> </td>
											<!--<td>
											 <?php 
                                               // if($fc->payment_status == 0)
                                                //{
                                                    ?>
											 <input type="text" name="slip_no[<?php //echo $fc->id; ?>]" id="slip_no" value="<?php //echo $fc->id; ?>" class="" />
											 <?php
												//}
												//else
												//{
											?>
												<input type="text" name="slip_no" readonly id="slip_no" value="<?php //echo $fc->receipt_no; ?>" class="" />
											<?php
												//}
											 ?>
											 
											</td>-->

                                        </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="clearfix Expense-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
               <div class="clearfix">
                    <select name="sms_type" class="col-xs-12 col-sm-12 sms_type" id="sms_type" disabled required placeholder="SMS Type">
						<option value="">Select SMS Type</option>
						<option value="registration">Registration</option>
						<option value="payment">Payment Received</option>
					</select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate payment_sms_submit" disabled name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Send SMS
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>		
        <script type="text/javascript">
            jQuery(function($) 
                {
                    var oTable1 = $('#payment_table').dataTable(
                        {
                            "aoColumns": 
                            [
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ] 
                    });      
            });
        </script>
        <?php		 



    }
	
	//Recent SMS Submit
    public function recent_sms_submit()
    {
        $data_post = $this->input->post();
        //echo "<pre>";
        //print_r($data_post);
		//exit;
		foreach($data_post['checkbox_sms'] as $chk)
        {

            $mobile_no = $this->Mdl_buildingexpense->get_relation_pax('customer','mobile_no','id',$chk);
			
			// $mobile_no = $this->Mdl_buildingexpense->get_relation_pax('customer','mobile_no','id',$chk);
            $shipping = $this->Mdl_buildingexpense->get_relation_pax('customer','shipping','id',$chk);
            $amount = $this->Mdl_buildingexpense->get_relation_pax('customer','amount','id',$chk);
            $noofcopy = $this->Mdl_buildingexpense->get_relation_pax('customer','noofcopy','id',$chk);
            $customer_code = $this->Mdl_buildingexpense->get_relation_pax('customer','customer_code','id',$chk);

			
			$total_amount = ($amount + $shipping) * $noofcopy;
			

             $search_char = substr($mobile_no, 0, 2);			
            if($search_char == "92")
            {
            $sms_num = $post['mobile_no'];
            }
            else
            {
            $new_no = substr($mobile_no,1);
            $sms_num = "92".$new_no;
            }			
			
			
			//Registration Type
			if($data_post['sms_type'] == "registration")
			{
				$msg = 'Mahnama Sub:Deposit Rs.'.$total_amount.' to BANK:MCB BR.CODE:0037 Title:DAWAT E ISLAMI TRUST-MAHNAMA A/C#0779283171003236 *Mention Cust.ID:'.$customer_code.' in Deposit Slip.';
				//$this->actionSms($sms_num,urlencode($msg));	

			} //Payment SMS
			else if($data_post['sms_type'] == "payment")
			{
				$msg_payment = 'Thanks for the Registration with Mahnama Faizan-e-madinah.Your Payment Rs.'.$total_amount.' against ID '.$customer_code.' has been received successfully.';
				//$this->actionSms($sms_num,urlencode($msg_payment));		
			}
			
        }
		
        $this->session->set_flashdata('update', 'your SMS has been send successfully');  
        redirect(base_url()."Expense/resend_sms",'refresh'); 
    }


    //Check USer Exit
    public function check_user_exists()
    {
        $post	=  $this->input->post();
        $username	=  $post['username'];
        $id 	=  $post['id'];
        $cmd_return         =  $this->Mdl_buildingexpense->_get_single_record_byusername($username,$id);
        $_return['_return'] =  $cmd_return;
        $return = json_encode($_return);
        echo $return; 
    }

    //Check Email Exit
    public function check_email_exists()
    {
        $post               =  $this->input->post();
        $email           =  $post['email'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_buildingexpense->_get_single_record_byemail($email,$id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return; 

    }

    //Check Phone Exit
    public function check_phone_exists()
    {
        $post               =  $this->input->post();
        $mobile_no           =  $post['mobile_no'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_buildingexpense->_get_single_record_byphone($mobile_no,$id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return; 

    }

    //get Category Price
    public function get_category_channel_list()
    {
        $category_id         =  $this->input->post('category_id');
        $dis_channel_id         =  $this->input->post('dis_channel_id');
        $noc         =  $this->input->post('noc');
        $data = $this->Mdl_buildingexpense->_get_category_channel_list($category_id,$dis_channel_id);



        if($data[0]->rate > 0)
        {
            $currency = $this->Mdl_buildingexpense->get_relation_pax('currency_list','code','id',$data[0]->currency_id);
            $prc = $currency.' '.$data[0]->rate.' per copy for 12 Months';

            $total_price = ($data[0]->rate + $data[0]->shipping ) *  $noc;

            $res = array
            (
                'price' => $prc,
                'total_price' => $currency.' '.$total_price
            );

            echo json_encode($res);

        }
        else
        {
            $res = array
            (
                'total' => '1'

            );

            echo json_encode($res);
        }



    }



    public function change_user_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_ulama->_change_user_status($id,$status);
        $return             = json_encode($_return);
        echo $return; 
    }

    //Get Sub Category List
    public function get_subcategory_byid()
    {
        $search_cat_id         =  $this->input->post('search_cat_id');
        $data['result_set'] = $this->Mdl_buildingexpense->sub_category_list($search_cat_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
        endforeach;
        echo $option;
    }
	
	 //Get Expense By ID
    public function get_Expense_byid()
    {
        $search_cat_id         =  $this->input->post('search_cat_id');
        $scat_id         =  $this->input->post('scat_id');
        $_return['_return'] = $this->Mdl_buildingexpense->_get_single_Expense_byCategory($search_cat_id,$scat_id);
        $return             = json_encode($_return);
        echo $return;
       
    }


    public function delete($id)
    {
        $delete = $this->Mdl_ulama->_delete($id);
        if($delete == 1)
        {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!'); 
        }else
        {
            $this->session->set_flashdata('error', 'No record found for Deleting !');   
        }
        redirect(base_url().'Ulama/search_relation','refresh');  
    }

    //Change Category Status
    public function change_category_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_buildingexpense->_change_category_status($id,$status);
        $return             = json_encode($_return);
        echo $return;

    }

    //Change Expense Status
    public function change_Expense_status()
    {
        $post               =  $this->input->post();
        $seller_id                 =  $post['seller_id'];
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_buildingexpense->_change_Expense_status($id,$status);
        if($_return['_return'] == 1)
        {
            //Active Account
            if($status == 0)
            {
                $seller_detail = $this->Mdl_buildingexpense->_this_seller_controller_record($seller_id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                 //Load email library
                $get_link1 = base_url()."admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear ".$$username."<br/>Your Expense has been Active at Online Shopping";
                $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view your Expenses.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Expense Active at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();

            } //Unactive Account
            else
            {
                $seller_detail = $this->Mdl_buildingexpense->_this_seller_controller_record($seller_id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                //Load email library
                $get_link1 = base_url()."admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear ".$$username."<br/>Your Expense has been De-Active at Online Shopping";
                $msg1 .= "<br/>please contact site admin.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Expense DeActive at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();

            }
           // print_r($seller_detail);
          //  exit;
            $return             = json_encode($_return);
            echo $return;
        }
        else
        {
            $return             = json_encode($_return);
            echo $return;

        }

    }

    //Change Discount Status
    public function change_discount_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_buildingexpense->_change_discount_status($id,$status);
        $return             = json_encode($_return);
        echo $return;

    }

}