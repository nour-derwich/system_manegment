<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends MX_Controller
{
    public $admin_email = array();
    public $productname = "";
    public $categorytname = "";
    public $data="";
    public function removeunderscores($res)
    {
        $abc = str_replace('--',',',$res);
        return  str_replace('_',' ',$abc);
    }
    public function removeunderscores_product($res)
    {
        $abc = str_replace('--',',',$res);
        return  str_replace('-',' ',$abc);
    }

    function __construct()
    {
		echo CI_VERSION;exit;
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('cart');
        $this->load->library('email');
        $this->load->model('Mdl_frontend');
        $this->data['category'] = $this->Mdl_frontend->get_category();
        $this->data['company_category'] = $this->Mdl_frontend->get_company_category();
        $this->data['slider'] = $this->Mdl_frontend->get_slider();
        $this->data['logo'] = $this->Mdl_frontend->get_logo();
        $this->data['brand'] = $this->Mdl_frontend->get_brand();
        $this->admin_email = $this->Mdl_frontend->_get_admin_email();
		$this->data['adds'] = $this->Mdl_frontend->get_adds();
		  $this->data['system_info'] = $this->Mdl_frontend->get_system_setting_list();
		    $this->data['pages'] = $this->Mdl_frontend->get_pages();
    }

    //Show Main Page
    public function index()
    {
        $this->load->view('index',$this->data);
    }

    //ultimate_sign_category Page
    public function ultimate_sign_category($cate_name = "")
    {
        $category_name = $this->removeunderscores($cate_name);
		
		//echo $category_name;
		//exit;
        $this->data['category_name']=$category_name;
        $get_category_id = $this->Mdl_frontend->get_relation_pax('company_category_list','id','category_name',$category_name);
        $get_category_des = $this->Mdl_frontend->get_relation_pax('company_category_list','category_description','category_name',$category_name);
        $this->data['category_id']=$get_category_id;
        $this->data['category_des']=$get_category_des;
        $this->data['gallery_result'] = $this->Mdl_frontend->get_brand_by_category(1,$get_category_id);
        $this->load->view('ultimate_sign_category',$this->data);
    }
	
	//ultimate_solution_category Page
    public function ultimate_solution_category($cate_name = "")
    {
        $category_name = $this->removeunderscores($cate_name);
		
		$this->data['category_name']=$category_name;
        $get_category_id = $this->Mdl_frontend->get_relation_pax('company_category_list','id','category_name',$category_name);
        $get_category_des = $this->Mdl_frontend->get_relation_pax('company_category_list','category_description','category_name',$category_name);
        $this->data['category_id']=$get_category_id;
        $this->data['category_des']=$get_category_des;
        $this->data['gallery_result'] = $this->Mdl_frontend->get_brand_by_category(2,$get_category_id);
        $this->load->view('ultimate_solution_category',$this->data);
    }
	
	

    //All Product Page
    public function all_product($cate_name = "",$scate_name = "",$scat_id = "")
    {
        $category_name = $this->removeunderscores($cate_name);
        $this->data['category_name'] = $category_name;
        $subcategory_name = $this->removeunderscores($scate_name);
        $this->data['subcategory_name'] = $subcategory_name;

       // echo $category_name;
       // echo $subcategory_name;
       // exit;
        $get_category_id = $this->Mdl_frontend->get_relation_pax('category_list','id','category_name',$category_name);
        $this->data['category_id']=$get_category_id;
        $category_array = array
        (
            'category_name' =>   $subcategory_name,
            'parent_category_id' =>   $get_category_id
        );

        $get_subcategory_id = $this->Mdl_frontend->get_relation_pax_multiple('category_list','id',$category_array);
        $this->data['subcategory_id']=$get_subcategory_id;
        $this->data['subcategory_result'] = $this->Mdl_frontend->get_sub_category_list($get_category_id,$get_subcategory_id);

        $config = array();
        $config["base_url"] = base_url() .$cate_name."/".$scate_name.".html";
        $config["total_rows"] = $this->Mdl_frontend->get_product_list_record_count($get_category_id,$get_subcategory_id);

        $config["per_page"] = 20;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["product_list"] = $this->Mdl_frontend->get_product_page_list($get_subcategory_id,$config["per_page"], $page);
        //print_R($this->data["product_list"]);
        //exit;
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('product',$this->data);
    }

    //Single Product Page
    public function single_product($prod_name = "")
    {
        $_product_code = $this->removeunderscores_product($prod_name);
        $product_code = explode('__',$_product_code);
        $this->data['product_code'] = $product_code[1];
        $get_product_result = $this->Mdl_frontend->get_single_product_by_productcode($product_code[1]);
        $this->data['product_result'] = $get_product_result;
        $this->data['product_name'] = $get_product_result[0]->product_name;
        $this->data['product_code'] = $get_product_result[0]->product_code;
        $this->data['category_id'] = $get_product_result[0]->category_id;
        $this->data['subcategory_id'] = $get_product_result[0]->subcategory_id;
        $subcategory_id = $get_product_result[0]->subcategory_id;
        $get_parent_category_id = $this->Mdl_frontend->get_relation_pax('category_list','parent_category_id','id',$subcategory_id);
        $get_category_name = $this->Mdl_frontend->get_relation_pax('category_list','category_name','id',$get_parent_category_id);
        $this->data['category_name']=$get_category_name;
        $get_subcategory_name = $this->Mdl_frontend->get_relation_pax('category_list','category_name','id',$subcategory_id);
        $this->data['subcategory_name']=$get_subcategory_name;
        $this->load->view('product_detail',$this->data);
    }

    //Add Product Cart
    public function product_add_card()
    {
        //User Login Session Add Cart Info
        if($this->session->userdata('user_type')=='user')
        {
            if($this->input->post('quantity') > 0)
            {
                $qty = $this->input->post('quantity');
            }
            else
            {
                $qty = 1;
            }
           $product = $this->Mdl_frontend->check_already_exists('product_id',$this->input->post('id'),'cart_list');
           // print_r($product);
           // exit;
            if($product['row_count'] > 0)
            {
                $old_qty = $product['result_data'][0]->cart_qty;
                $data_update = array(
                    'cart_qty' => $old_qty + $qty
                );
                $this->db->where('product_id', $this->input->post('id'));
                $db_command =  $this->db->update('cart_list', $data_update);


            }
            else
            {
                $data_cart = array
                (
                    'user_id' => $this->session->userdata('id'),
                    'product_id' => $this->input->post('id'),
                    'cart_date' => date('Y-m-d'),
                    'cart_qty' => $qty,
                    'cart_price' => $this->input->post('price'),
                    'cart_type' => 'cart',
                    'cart_status' => 'pending',
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => 1
                );

                $db_command = $this->Mdl_frontend->db_command($data_cart, null, 'cart_list');
            }
            $cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
            if($cart_check>0)
            {
                $i_top = 0;
                $grand_total_top = 0;
                foreach ($cart_check as $item1) {
                    $i_top++;
                    $grand_total_top += ($item1->cart_qty *  $item1->cart_price);
                }
                echo json_encode(array('total_items' => $i_top, 'total_amount' => $grand_total_top));
            }
            else
            {
                echo json_encode(array('total_items' => 0, 'total_amount' => 0));
            }


        }
        else
        {
            if($this->input->post('quantity') > 0)
            {
                $qty = $this->input->post('quantity');
            }
            else
            {
                $qty = 1;
            }
            $insert_data = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'image' => $this->input->post('image'),
                'qty' => $qty
            );
            // This function add items into cart.
            $this->cart->insert($insert_data);
            $cart_check = $this->cart->contents();
            $i_top = 0;
            $grand_total_top = 0;
            foreach ($cart_check as $item1)
            {
                $i_top++;
                $grand_total_top += $item1['subtotal'];
            }
            echo json_encode(array('total_items' => $i_top, 'total_amount' => $grand_total_top));
        }

    }

    //Product View Cart
    public function product_view_card()
    {
        //User Login Session Add Cart Info
        if($this->session->userdata('user_type') == 'user')
        {
            $cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
            if($cart_check>0)
            {
                ?>
                <li>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="5">
                                <h4>SHOPPING CART</h4>
                            </td>
                        </tr>
                        <?php
                        $grand_total = 0;
                        foreach ($cart_check as $item)
                        {
                            $get_product= $this->Mdl_frontend->get_single_record_by_productid($item->product_id);
                            echo form_hidden('cart[' . $item->product_id . '][id]',$item->product_id);
                            echo form_hidden('cart[' . $item->product_id . '][rowid]', $item->cart_id);
                            echo form_hidden('cart[' . $item->product_id . '][name]', $get_product[0]->product_name);
                            echo form_hidden('cart[' . $item->product_id . '][image]', $get_product[0]->product_image);
                            echo form_hidden('cart[' . $item->product_id . '][price]', $item->cart_price);
                            echo form_hidden('cart[' . $item->product_id . '][qty]', $item->cart_qty);
                            $product_image = $get_product[0]->product_image;
                            $product_name = $get_product[0]->product_name;
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($product_image != "") {
                                        $img_url = "public_html/frontend/image/product/" . $product_image;
                                        if (file_exists($img_url)) {
                                            ?>
                                            <img src="<?php echo base_url() . $img_url; ?>"
                                                 style="height:59px;width: 59px;"
                                                 alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                                 class="img-responsive"/>
                                        <?php
                                        } else {
                                            ?>
                                            <img
                                                src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                                title="<?php echo $product_name; ?>" class="img-responsive"/>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <img
                                            src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                            style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                            title="<?php echo $product_name; ?>" class="img-responsive"/>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-left"><?php echo $product_name; ?></td>
                                <td class="text-right"> x <?php echo $item->cart_qty; ?></td>
                                <td class="text-right">Rs. <?php
                                    $final_price = $item->cart_qty * $item->cart_price;
                                    //echo number_format($final_price, 2);
                                    echo $final_price; ?></td>
                                <td class="text-center">

                                    <button class="btn btn-danger btn-xs remove" rel="<?php echo $item->cart_id; ?>"
                                            title="Remove" id="remove_product" type="button"><i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $grand_total = $grand_total + ($item->cart_qty * $item->cart_price);
                        }

                        ?>
                        </tbody>
                    </table>
                </li>
                <li>
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>Sub-Total</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Shipping Charges</strong></td>
                                <td class="text-right">Rs. 200</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Total</strong></td>
                                <td class="text-right">Rs. <?php echo($grand_total + 200); ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="checkout text-right">
                            <a href="<?php echo base_url(); ?>cart.html" class="btn btn-primary"><i
                                    class="fa fa-shopping-cart"></i> View Cart</a>&nbsp;&nbsp;&nbsp;<a
                                href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary"><i
                                    class="fa fa-share"></i>
                                Checkout
                            </a>
                        </p>
                    </div>
                </li>


            <?php
            }
            else
            {
                ?>
                <li>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="5">
                                <h4>SHOPPING CART IS EMPTY</h4>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <p>You have no items in your shopping cart.<br/>
                                    Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </li>
                <?php
            }

        }
        else
        {

        $cart_check = $this->cart->contents();
        // If cart is empty, this will show below message.
        if (empty($cart_check))
        {
            ?>
            <li>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="5">
                            <h4>SHOPPING CART IS EMPTY</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <p>You have no items in your shopping cart.<br/>
                                Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </li>
        <?php
        } else {
            // All values of cart store in "$cart".
            if ($cart = $this->cart->contents()) {
                $i_top = 0;
                $grand_total_top = 0;
                foreach ($cart as $item1) {
                    $i_top++;
                    $grand_total_top += $item1['subtotal'];
                }
                $grand_total = 0;
                $i = 1;
                ?>
                <li>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="5">
                                <h4>SHOPPING CART</h4>
                            </td>
                        </tr>
                        <?php
                        foreach ($cart as $item) {
                            echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']);
                            echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                            echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                            $product_image = $item['image'];
                            $product_name = $item['name'];
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($product_image != "") {
                                        $img_url = "public_html/frontend/image/product/" . $product_image;
                                        if (file_exists($img_url)) {
                                            ?>
                                            <img src="<?php echo base_url() . $img_url; ?>"
                                                 style="height:59px;width: 59px;"
                                                 alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                                 class="img-responsive"/>
                                        <?php
                                        } else {
                                            ?>
                                            <img
                                                src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                                title="<?php echo $product_name; ?>" class="img-responsive"/>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <img
                                            src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                            style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                            title="<?php echo $product_name; ?>" class="img-responsive"/>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-left"><?php echo $item['name']; ?></td>
                                <td class="text-right"> x <?php echo $item['qty']; ?></td>
                                <td class="text-right">Rs. <?php
                                    $final_price = $item['qty'] * $item['price'];
                                    //echo number_format($final_price, 2);
                                    echo $final_price; ?></td>
                                <td class="text-center">
                                    <!-- <a href="<?php echo base_url(); ?>Frontend/product_remove_card/<?php echo $item['rowid']; ?>" title="Remove" class="btn btn-danger btn-xs remove">
                                            <i class="fa fa-times"></i>
                                        </a>-->
                                    <button class="btn btn-danger btn-xs remove" rel="<?php echo $item['rowid']; ?>"
                                            title="Remove" id="remove_product" type="button"><i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $grand_total = $grand_total + $item['subtotal'];
                        }

                        ?>
                        </tbody>
                    </table>
                </li>
                <li>
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>Sub-Total</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Shipping Charges</strong></td>
                                <td class="text-right">Rs. 200</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Total</strong></td>
                                <td class="text-right">Rs. <?php echo($grand_total + 200); ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="checkout text-right">
                            <a href="<?php echo base_url(); ?>cart.html" class="btn btn-primary"><i
                                    class="fa fa-shopping-cart"></i> View Cart</a>&nbsp;&nbsp;&nbsp;<a
                                href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary"><i
                                    class="fa fa-share"></i>
                                Checkout
                            </a>
                        </p>
                    </div>
                </li>
            <?php
            }
        }

    }
        ?>
        <script type="text/javascript">
        //Remove Product
        $(document).on('click','#remove_product',function()
        {
            $.ajax
            ({
                //make ajax request to cart_process.php
                url: "<?php echo base_url();?>Frontend/product_remove_card/"+$("#remove_product").attr('rel'),
                type: "POST",
                dataType: "json", //expect json value from server
                data: ''
            }).done(function (data)
            {
                $("#cart-total").html(data.total_items+' item(s) - Rs.'+data.total_amount);
                $.ajax
                ({ //make ajax request to cart_process.php
                    url: "<?php echo base_url();?>Frontend/product_view_card_show/",
                    type: "POST",
                    dataType: "html", //expect json value from server
                    data: ''
                }).done(function (data)
                {
                    $(".shopping_cart_view").html(data);
                });
                $.ajax({ //make ajax request to cart_process.php
                    url: "<?php echo base_url();?>Frontend/product_view_checkout_show/",
                    type: "POST",
                    dataType: "html", //expect json value from server
                    data: ''
                }).done(function (data) {
                    $(".shopping_cart_checkout_view").html(data);
                });
            });
        });
        </script>
        <?php
    }

    //Show Product View CArd
    public function product_view_card_show()
    {
//User Login Cart Info
        if ($this->session->userdata('user_type') == 'user') {
            $cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
            if ($cart_check > 0) {
                //echo form_open('shopping/update_cart');
                $grand_total = 0;
                $i = 1;
                ?>
                <h1 class="title">Shopping Cart</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Product Name</td>
                            <td class="text-left">Quantity</td>
                            <td class="text-right">Unit Price</td>
                            <td class="text-right">Total</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($cart_check as $item)
                        {
                            $get_product = $this->Mdl_frontend->get_single_record_by_productid($item->product_id);
                            echo form_hidden('cart[' . $item->product_id . '][id]', $item->product_id);
                            echo form_hidden('cart[' . $item->product_id . '][rowid]', $item->cart_id);
                            echo form_hidden('cart[' . $item->product_id . '][name]', $get_product[0]->product_name);
                            echo form_hidden('cart[' . $item->product_id . '][image]', $get_product[0]->product_image);
                            echo form_hidden('cart[' . $item->product_id . '][price]', $item->cart_price);
                            echo form_hidden('cart[' . $item->product_id . '][qty]', $item->cart_qty);
                            $product_image = $get_product[0]->product_image;
                            $product_name = $get_product[0]->product_name;
                            ?>

                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($product_image != "") {
                                        $img_url = "public_html/frontend/image/product/" . $product_image;
                                        if (file_exists($img_url)) {
                                            ?>
                                            <img src="<?php echo base_url() . $img_url; ?>"
                                                 style="height:59px;width: 59px;"
                                                 alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                                 class="img-responsive img-thumbnail"/>
                                        <?php
                                        } else {
                                            ?>
                                            <img
                                                src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                                title="<?php echo $product_name; ?>"
                                                class="img-responsive img-thumbnail"/>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <img
                                            src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                            style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                            title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                                    <?php
                                    }
                                    ?>

                                </td>
                                <td class="text-left"><?php echo $product_name; ?></td>

                                <td class="text-left">
                                    <form id="cart_form" method="post"
                                          action="<?php echo base_url(); ?>Frontend/product_update_card/">
                                        <?php
                                        echo form_hidden('cart[' . $item->product_id . '][id]', $item->product_id);
                                        echo form_hidden('cart[' . $item->product_id . '][rowid]', $item->cart_id);
                                        echo form_hidden('cart[' . $item->product_id . '][name]', $get_product[0]->product_name);
                                        echo form_hidden('cart[' . $item->product_id . '][image]', $get_product[0]->product_image);
                                        echo form_hidden('cart[' . $item->product_id . '][price]', $item->cart_price);
                                        echo form_hidden('cart[' . $item->product_id . '][qty]', $item->cart_qty);

                                        ?>
                                        <div class="input-group btn-block quantity">
                                            <?php
                                            $cls = "quantity" . $item->cart_id;
                                            echo form_input('cart[' . $item->product_id . '][qty]', $item->cart_qty, 'maxlength="3" id="quantity" size="1"  class="form-control ' . $cls . '"'); ?>
                                            <span class="input-group-btn">
                        <button type="submit" title="Update" rel="<?php echo $item->cart_id; ?>"
                                id="update_product_cart" class="btn btn-primary"><i
                                class="fa fa-refresh"></i></button>
                        <button type="button" rel="<?php echo $item->cart_id; ?>" title="Remove"
                                class="btn btn-danger" id="remove_product1"><i class="fa fa-times-circle"></i></button>
                        </span></div>
                                    </form>

                                </td>
                                <td class="text-right">Rs. <?php echo $item->cart_price; ?></td>
                                <td class="text-right">Rs. <?php
                                    $final_price = $item->cart_qty * $item->cart_price;
                                    //echo number_format($final_price, 2);

                                    echo $final_price; ?></td>
                            </tr>

                            <?php
                            $grand_total = $grand_total + ($item->cart_qty * $item->cart_price);
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
                <script type="text/javascript">

                    //Remove Product
                    $(document).on('click', '#remove_product1', function () {
                        //alert('YES');
                        $.ajax({ //make ajax request to cart_process.php
                            url: "<?php echo base_url();?>Frontend/product_remove_card/" + $("#remove_product1").attr('rel'),
                            type: "POST",
                            dataType: "json", //expect json value from server
                            data: ''
                        }).done(function (data) {
                            // console.log(data);
                            $("#cart-total").html(data.total_items + ' item(s) - Rs.' + data.total_amount);
                            // $('.shopping-cart-box').click();
                            //
                            $.ajax({ //make ajax request to cart_process.php
                                url: "<?php echo base_url();?>Frontend/product_view_card_show/",
                                type: "POST",
                                dataType: "html", //expect json value from server
                                data: ''
                            }).done(function (data) {
                                $(".shopping_cart_view").html(data);
                            });


                        });

                    });


                    // update_product_cart
                    $(document).on('click', '#update_product_cart', function () {
                        document.getElementById("cart_form").submit();
                        /*
                         //alert('YES');
                         var json             = {};
                         json['cart_id']   = $("#update_product_cart").attr('rel');
                         json['qty']   = $(".quantity"+$("#update_product_cart").attr('rel')).val();

                         $.ajax({ //make ajax request to cart_process.php


                         url: "
                        <?php echo base_url();?>Frontend/product_update_card/",
                         type: "POST",
                         dataType: "html", //expect json value from server
                         data: json
                         }).done(function (data) {
                         console.log($("#update_product_cart").attr('rel'));
                         console.log($(".quantity"+$("#update_product_cart").attr('rel')).val());
                         console.log(data);


                         //  $("#cart-total").html(data.total_items + ' item(s) - Rs.' + data.total_amount);
                         // $('.shopping-cart-box').click();
                         //
                         $.ajax({ //make ajax request to cart_process.php
                         url: "
                        <?php //echo base_url();?>Frontend/product_view_card_show/",
                         type: "POST",
                         dataType: "html", //expect json value from server
                         data: ''
                         }).done(function (data) {
                         $(".shopping_cart_view").html(data);
                         });


                         });
                         */

                    });


                </script>
<?php
// echo "YES MY CARD";
// This will show insert data in cart.
//redirect(base_url().'index.html','refresh');
                ?>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-right"><strong>Sub-Total:</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Shipping Charges:</strong></td>
                                <td class="text-right">Rs. 200</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Total:</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total + 200; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="buttons" style="margin-bottom: 60px;">
                    <div class="pull-left"><br/><br/><a href="<?php echo base_url(); ?>index.html" class="btn btn-default">Continue
                            Shopping</a>
                    </div>
                    <div class="pull-right"><br/><br/><a href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
                </div>
                <!--Middle Part End -->
            <?php
            } else {
                ?>
                <h1 class="title">Shopping Cart is empty</h1>
                <p>You have no items in your shopping cart.<br/>
                    Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>
				<br/><br/><br/>
            <?php
            }
        } else {
            ?>
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12 shopping_cart_view">
            <?php
            $cart_check = $this->cart->contents();
            if (empty($cart_check)) {
                ?>
                <h1 class="title">Shopping Cart is empty</h1>
                <p>You have no items in your shopping cart.<br/>
                    Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>
            <?php
            } else {
                // All values of cart store in "$cart".
                if ($cart = $this->cart->contents()) {
                    $i_top = 0;
                    $grand_total_top = 0;
                    foreach ($cart as $item1) {
                        $i_top++;
                        $grand_total_top += $item1['subtotal'];
                    }
                    $grand_total = 0;
                    $i = 1;
                    ?>
                    <h1 class="title">Shopping Cart</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($cart as $item) {
                                echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                $product_image = $item['image'];
                                $product_name = $item['name'];
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php
                                        if ($product_image != "") {
                                            $img_url = "public_html/frontend/image/product/" . $product_image;
                                            if (file_exists($img_url)) {
                                                ?>
                                                <img src="<?php echo base_url() . $img_url; ?>"
                                                     style="height:59px;width: 59px;"
                                                     alt="<?php echo $product_name; ?>"
                                                     title="<?php echo $product_name; ?>"
                                                     class="img-responsive img-thumbnail"/>
                                            <?php
                                            } else {
                                                ?>
                                                <img
                                                    src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                    style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                                    title="<?php echo $product_name; ?>"
                                                    class="img-responsive img-thumbnail"/>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <img
                                                src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                                title="<?php echo $product_name; ?>"
                                                class="img-responsive img-thumbnail"/>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-left"><?php echo $item['name']; ?></td>
                                    <td class="text-left">
                                        <form id="cart_form" method="post"
                                              action="<?php echo base_url(); ?>Frontend/product_update_card/">
                                            <?php
                                            echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                            echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                            echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                            ?>
                                            <div class="input-group btn-block quantity">
                                                <?php
                                                $cls = "quantity" . $item['rowid'];
                                                echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" id="quantity" size="1"  class="form-control ' . $cls . '"'); ?>
                                                <span class="input-group-btn">
                                                     <button type="submit" title="Update"
                                                             rel="<?php echo $item['rowid']; ?>"
                                                             id="update_product_cart" class="btn btn-primary"><i
                                                             class="fa fa-refresh"></i></button>
                                                <button type="button" rel="<?php echo $item['rowid']; ?>" title="Remove"
                                                        class="btn btn-danger" id="remove_product1"><i
                                                        class="fa fa-times-circle"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-right">Rs. <?php echo $item['price']; ?></td>
                                    <td class="text-right">Rs. <?php
                                        $final_price = $item['qty'] * $item['price'];
                                        echo $final_price; ?>
                                    </td>
                                </tr>
                                <?php
                                $grand_total = $grand_total + $item['subtotal'];
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
                <script type="text/javascript">
                    //Remove Product
                    $(document).on('click', '#remove_product1', function () {
                        $.ajax
                        ({ //make ajax request to cart_process.php
                            url: "<?php echo base_url();?>Frontend/product_remove_card/" + $("#remove_product1").attr('rel'),
                            type: "POST",
                            dataType: "json", //expect json value from server
                            data: ''
                        }).done(function (data) {
                            $("#cart-total").html(data.total_items + ' item(s) - Rs.' + data.total_amount);
                            $.ajax
                            ({ //make ajax request to cart_process.php
                                url: "<?php echo base_url();?>Frontend/product_view_card_show/",
                                type: "POST",
                                dataType: "html", //expect json value from server
                                data: ''
                            }).done(function (data) {
                                $(".shopping_cart_view").html(data);
                            });
                        });
                    });
                </script>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-right"><strong>Sub-Total:</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Shipping Charges:</strong></td>
                                <td class="text-right">Rs. 200</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Total:</strong></td>
                                <td class="text-right">Rs. <?php echo $grand_total + 200; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="buttons" style="margin-bottom: 60px;">
                    <div class="pull-left"><br/><br/><a href="<?php echo base_url(); ?>index.html" class="btn btn-default">Continue
                            Shopping</a>
                    </div>
                    <div class="pull-right"><br/><br/><a href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
                </div>
                <!--Middle Part End -->
            <?php
            }
        }
    }
    //Show Product View CArd Checkout
    public function product_view_checkout_show()
    {
        ?>
        <div class="panel-body shopping_cart_checkout_view">
        <?php
            $cart_check = $this->cart->contents();
            // If cart is empty, this will show below message.
            if(empty($cart_check))
            {
        ?>

             <p>You have no items in your shopping cart.<br/>
             Click  <a href="<?php echo base_url(); ?>" >here</a> to continue shopping</p>
        <?php
            }
            else
            {
                if ($cart = $this->cart->contents())
                {
                    $i_top = 0;
                    $grand_total_top = 0;
                    foreach ($cart as $item1)
                    {
                        $i_top++;
                        $grand_total_top += $item1['subtotal'];
                    }
                    $grand_total = 0;
                    $i = 1;
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left" style="width:250px !important;">Product Name</td>
                            <td class="text-left">Quantity</td>
                            <td class="text-right">Unit Price</td>
                            <td class="text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($cart as $item)
                    {
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        $product_image = $item['image'];
                        $product_name = $item['name'];
                    ?>
                           <tr>
                               <td class="text-center">
                                   <?php
                                        if ($product_image != "")
                                        {
                                            $img_url = "public_html/frontend/image/product/" . $product_image;
                                            if (file_exists($img_url))
                                            {
                                                ?>
                                                <img src="<?php echo base_url() . $img_url; ?>" style="height:59px;width: 59px;" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                                                    <?php
                                            }
                                            else
                                            {
                                                    ?>
                                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>" style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                                                    <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                 <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>" style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                                        <?php
                                        }
                                        ?>
                               </td>
                               <td class="text-left"><?php echo $item['name']; ?></td>
                               <td class="text-left">
                                                <form id="cart_form" method="post"
                                                      action="<?php echo base_url(); ?>Frontend/product_update_card/">
                                                    <?php
                                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                                    ?>
                                                    <div class="input-group btn-block quantity">
                                                        <?php
                                                        $cls = "quantity" . $item['rowid'];
                                                        echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" id="quantity" size="1"  class="form-control ' . $cls . '"'); ?>
                                                        <span class="input-group-btn">
                                                    <button type="submit" title="Update" rel="<?php echo $item['rowid']; ?>"
                                                            id="update_product_cart" class="btn btn-primary"><i
                                                            class="fa fa-refresh"></i></button>
                                                    <button type="button" rel="<?php echo $item['rowid']; ?>" title="Remove"
                                                            class="btn btn-danger" id="remove_product1"><i class="fa fa-times-circle"></i></button>
                                                    </span></div>
                                                </form>
                               </td>
                               <td class="text-right">Rs. <?php echo $item['price']; ?></td>
                               <td class="text-right">Rs. <?php
                                                $final_price = $item['qty'] * $item['price'];
                                                echo $final_price; ?>
                               </td>
                           </tr>
                           <?php
                                $grand_total = $grand_total + $item['subtotal'];
                    }

                                    ?>
                    </tbody>
                    <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                                        <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Shipping Charges:</strong></td>
                                        <td class="text-right">Rs. 200</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                        <td class="text-right">Rs. <?php echo $grand_total+200; ?></td>
                                    </tr>
                    </tfoot>
                </table>
            </div>
            <?php
                }
             ?>
                <script type="text/javascript">
                   //Remove Product
                   $(document).on('click', '#remove_product1', function ()
                   {
                        $.ajax
                        ({
                            //make ajax request to cart_process.php
                            url: "<?php echo base_url();?>Frontend/product_remove_card/" + $("#remove_product1").attr('rel'),
                            type: "POST",
                            dataType: "json", //expect json value from server
                            data: ''
                        }).done(function (data)
                        {
                            // console.log(data);
                            $("#cart-total").html(data.total_items + ' item(s) - Rs.' + data.total_amount);
                                    $.ajax({ //make ajax request to cart_process.php
                                        url: "<?php echo base_url();?>Frontend/product_view_checkout_show/",
                                        type: "POST",
                                        dataType: "html", //expect json value from server
                                        data: ''
                                    }).done(function (data) {
                                        $(".shopping_cart_checkout_view").html(data);
                                    });

                        });
                   });
                            // update_product_cart
                            $(document).on('click', '#update_product_cart', function ()
                            {
                                document.getElementById("cart_form").submit();
                            });
                </script>
                    <?php
            }
                        ?>
        </div>
        <?php
    }

    //Remove Product Cart
    function product_remove_card($rowid)
    {
        //User Login Cart Info
        if($this->session->userdata('user_type') == 'user')
        {
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->where('cart_id', $rowid);
            $delete =  $this->db->delete('cart_list');
            $cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
            if($cart_check>0)
            {
                $i_top = 0;
                $grand_total_top = 0;
                foreach ($cart_check as $item1) {
                    $i_top++;
                    $grand_total_top += $item1->cart_price;
                }
                echo json_encode(array('total_items' => $i_top, 'total_amount' => $grand_total_top));
            }
            else
            {
                echo json_encode(array('total_items' => 0, 'total_amount' => 0));
            }

        }
        else
        {
            // Check rowid value.
            if ($rowid==="all")
            {
                // Destroy data which store in  session.
                $this->cart->destroy();
            }
            else
            {
                // Destroy selected rowid in session.
                $data = array
                (
                    'rowid'   => $rowid,
                    'qty'     => 0
                );
                $this->cart->update($data);
            }
            $cart_check = $this->cart->contents();
            $i_top = 0;
            $grand_total_top = 0;
            foreach ($cart_check as $item1)
            {
                $i_top++;
                $grand_total_top += $item1['subtotal'];
            }
            echo json_encode(array('total_items' => $i_top, 'total_amount' => $grand_total_top));

        }

    }

    //Update Cart
    function product_update_card()
    {
        //User Login Session Add Cart Info
        if($this->session->userdata('user_type') == 'user')
        {
            // Recieve post values,calcute them and update
            $cart_infos =  $_POST['cart'] ;

            foreach( $cart_infos as $id => $cart)
            {
                $rowid = $cart['rowid'];
                $price = $cart['price'];
                $amount = $price * $cart['qty'];
                $qty = $cart['qty'];

                $data_update = array(
                    'cart_qty' => $qty
                );

                $this->db->where('cart_id', $rowid);
                $this->db->update('cart_list', $data_update);

                //$this->db->where('cart_qty',$qty);
                //$this->db->where('cart_id',$rowid);
                //$this->db->update('cart_list');
                //echo $this->db->last_query();
            }
            redirect(base_url().'cart.html','refresh');

        }
        else
        {
            // Recieve post values,calcute them and update
            $cart_info =  $_POST['cart'] ;
            foreach( $cart_info as $id => $cart)
            {
                $rowid = $cart['rowid'];
                $price = $cart['price'];
                $amount = $price * $cart['qty'];
                $qty = $cart['qty'];
                $data = array
                (
                    'rowid'   => $rowid,
                    'price'   => $price,
                    'amount' =>  $amount,
                    'qty'     => $qty
                );
                $this->cart->update($data);
            }
            redirect(base_url().'cart.html','refresh');
        }

    }


    //Login Page
    public function login()
    {
        $this->load->view('login',$this->data);
    }

    //Register Page
    public function register()
    {
        $this->load->view('register',$this->data);
    }

    //Forgot Password
    public function forgot_password()
    {
        $this->load->view('forgot_password',$this->data);
    }


    //Seller Login Page
    public function seller_login()
    {
        $this->load->view('seller_login',$this->data);
    }

    //Seller Register Page
    public function seller_register()
    {
        $this->load->view('seller_register',$this->data);
    }

    //Seller Forgot Password
    public function seller_forgot_password()
    {
        $this->load->view('seller_forgot_password',$this->data);
    }

    //404 Page
    public function _404_page()
    {
        //echo "$)$ PAGE";
        $this->load->view('_404_page',$this->data);
    }

    //about_us Page
    public function about_us()
    {
        $this->load->view('about_us',$this->data);
    }
	
	 //ultimate_sign Page
    public function ultimate_sign()
    {
        $this->load->view('ultimate_sign',$this->data);
    }
	
	 //ultimate_solution Page
    public function ultimate_solution()
    {
        $this->load->view('ultimate_solution',$this->data);
    }
	
	
    //gallery Page
    public function gallery()
    {
        $this->load->view('gallery',$this->data);
    }
     //Cart Page
    public function cart()
    {
        $this->load->view('cart',$this->data);
    }

    //Checkout Page
    public function checkout()
    {
        /* if($this->session->userdata('user_type')=='user')
        { */
            $this->data['user_info']=$this->Mdl_frontend->get_single_user_byid($this->session->userdata('id'));
            $this->data['city_name']=$this->Mdl_frontend->get_relation_pax('city_list','title','id',$this->data['user_info'][0]->city_id);
            $this->load->view('checkout',$this->data);
       /*  }
        else
        {
            $this->load->view('login',$this->data);
        } */

    }
     //compare Page
    public function compare()
    {
        $this->load->view('compare',$this->data);
    }

    //Contact us Page
    public function contact_us()
    {
        $this->load->view('contact_us',$this->data);
    }
    //Elements Page
    public function elements()
    {
        $this->load->view('elements',$this->data);
    }

    //faq Page
    public function faq()
    {
        $this->load->view('faq',$this->data);
    }
    //Search Page
    public function search()
    {
        $post = $this->input->post();
        $search = $post['search'];
        $this->data["search_title"] = $search;
        $config = array();
        $config["base_url"] = base_url() ."search.html";
        $config["total_rows"] = $this->Mdl_frontend->get_product_search_count($search);
        $config["per_page"] = 20;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["product_list"] = $this->Mdl_frontend->get_product_search_result($search,$config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $this->data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('search',$this->data);
    }

    //Sitemap Page
    public function sitemap()
    {
        $this->load->view('sitemap',$this->data);
    }
    //Wishlist Page
    public function wishlist()
    {
        $this->load->view('wishlist',$this->data);
    }

    //privacy_policy
    public function privacy_policy()
    {
        $this->load->view('privacy_policy',$this->data);
    }

    //My Account Page
    public function account()
    {
        if($this->session->userdata('user_type')=='user')
        {
            $this->data['user_info']=$this->Mdl_frontend->get_single_user_byid($this->session->userdata('id'));
            $this->data['city_name']=$this->Mdl_frontend->get_relation_pax('city_list','title','id',$this->data['user_info'][0]->city_id);
            $this->data['order_info']=$this->Mdl_frontend->get_order_list($this->session->userdata('id'));
            $this->load->view('account',$this->data);
        }
        else
        {
            $this->load->view('login',$this->data);
        }

    }


    //Register Submit
    public function register_submit()
    {
       // $get_code =  random_string('alnum',132);
        $post = $this->input->post();
       // echo "<pre>";
       // print_r($post);

       // $data['is_enable']        = 0;
      //  $data['verify_key']        = $get_code;
        $data['firstname']            = $post['firstname'];
        $data['lastname']         = $post['lastname'];
        $data['telephone']        = $post['telephone'];
        $data['gender']        = $post['gender'];
       // $data['dob']        = $post['date_of_birth'];
        $data['email']        = $post['email'];
        $data['password']        = $this->Mdl_frontend->hash($post['password']);
        $data['created_date']        = date('Y-m-d H:i:s');
        $data['created_by']        = 1;

        $from_email = $this->admin_email[0]->email;
        $to_email = $post['email'];

        //Load email library

        $complete_name = $post['firstname']." ".$post['lastname'];
        $msg = 'Dear '.$complete_name.',<br/>Your account has been successfully created!<br/>
        To learn more about how to shop on Farjee Online Shopping,<a href='.base_url().' >CLICK HERE</a><br/>Thank you for being a part of Farjee!';
        $this->email->from($from_email, 'Farjee Online Shopping');
        $this->email->to($to_email);
        $this->email->subject('Welcome '.$complete_name.' Registration Successfully!');
        $this->email->message($msg);



             #  $this->Mdl_frontend->debug_r($data,1);

       $db_command =  $this->Mdl_frontend->db_command($data,null,'user_list');
        //print_r($db_command);
       if($db_command)
        {
            $this->email->send();
            if($post['id'] != null)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');
            }else
            {
                $this->session->set_flashdata('saved', 'your account successfully created please login to continue');
            }
            //$this->load->view('register',$this->data);
            redirect(base_url().'register.html','refresh');
        }


    }


    //Login Submit
    public function login_submit()
    {

        $this->db->where('email',$this->input->post('email'));
        $this->db->where('password',$this->Mdl_frontend->hash($this->input->post( 'password')));
        $this->db->where('is_enable',1);
        $this->db->where('user_type' ,'user');
        $user = $this->db->get('user_list')->result();
        if (count ($user) > 0) {
            $data = array (
                'id'                => $user[0]->id,
                'email'              => $user[0]->email,
                'firstname'         => $user[0]->firstname,
                'lastname'         => $user[0]->lastname,
                'user_type'         => 'user',
                'loggedin'          => True
            );

            $this->session->set_userdata ( $data );
            redirect(base_url(),'refresh');
        }else
        {
            $this->session->set_flashdata('error', 'Invalid email and password please try again');
            redirect(base_url().'login.html','refresh');
        }




    }

    //Forgot Password Submit
    public function forgot_password_submit()
    {
        $this->load->helper('string');
         $get_code =  random_string('alnum',132);
        //$get_code =  "123";
        $post = $this->input->post();
        $email        = $post['email'];

        $this->db->where('email',$post['email']);
        $this->db->where('is_enable',1);
        $this->db->where('user_type' ,'user');
        $user = $this->db->get('user_list')->result();
        if (count ($user) > 0)
        {
            $from_email = $this->admin_email[0]->email;
            $to_email = $post['email'];

            $id = $user[0]->id;
            $user_email = $user[0]->email;
            $firstname =  $user[0]->firstname;
            $lastname = $user[0]->lastname;

            $now = date('Y-m-d H:i:s');
            $data['modify_date']  = $now;
            $data['modify_by']  = 1;
            $data['is_enable']  = 0;
            $data['verify_key']  = $get_code;

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('user_list');

            $complete_name = $firstname." ".$lastname;
            $msg = "Dear ".$complete_name.",<br/>Did you forget your password?<br/>";
            $msg .= "<a href='".base_url()."reset_password/".$get_code.".html'></a>";
            //<a href='"'.base_url().'"' >CLICK HERE</a>to restore your password.<br/>Thank you for being a part of Farjee!|";
            $this->email->from($from_email, 'Farjee Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Forgot Password?');
            $this->email->message($msg);
            $this->session->set_flashdata('saved', 'your password has been send check email..');
            redirect(base_url().'login.html','refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'We are sorry your email is not exits');
            redirect(base_url().'forgot_password.html','refresh');
        }

    }

    //Reset Password
    public function reset_password($key)
    {
        $this->db->where('verify_key',$key);
        $this->db->where('is_enable',0);
        $this->db->where('user_type' ,'user');
        $user = $this->db->get('user_list')->result();
        if (count ($user) > 0)
        {
            $this->data['key'] = $key;
            $this->data['user_id'] = $user[0]->id;
            $this->load->view('reset_password',$this->data);
        }
        else
        {
            $this->load->view('_404_page',$this->data);
        }
    }

    //Reset Password Submit
    public function reset_password_submit()
    {
        $post = $this->input->post();
        $data['verify_key']   = '';
        $data['is_enable']    = 1;
        $data['password']     = $this->Mdl_frontend->hash($post['password']);
        $data['modify_date']  = date('Y-m-d H:i:s');
        $data['modify_by']    = 1;

        $this->db->set($data);
        $this->db->where('id', $post['user_id']);
        $db_command  = $this->db->update('user_list');
        if($db_command)
        {

            $this->session->set_flashdata('saved', 'your password successfully update please login to continue');
            redirect(base_url().'login.html','refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'your password not update please try arain');
            redirect(base_url()."reset_password/".$post['key'].".html",'refresh');
        }



    }



    //Seller Register Submit
    public function seller_register_submit()
    {
        // $get_code =  random_string('alnum',132);
        $post = $this->input->post();

        // $data['is_enable']        = 0;
        //  $data['verify_key']        = $get_code;
        $data['firstname']            = $post['firstname'];
        $data['lastname']         = $post['lastname'];
        $data['telephone']        = $post['telephone'];


        $data['mobile']        = $post['mobile'];
        $data['gender']        = $post['gender'];
        $data['company']        = $post['company'];
        $data['address']        = $post['address'];
        $data['country_id']        = '166';
        $data['state_id']        = $post['state_id'];
        $data['city_id']        = $post['city_id'];
        $data['username']        = $post['username'];
        $data['postal_code']        = $post['postal_code'];
        // $data['dob']        = $post['date_of_birth'];
        $data['email']        = $post['email'];
        $data['password']        = $this->Mdl_frontend->hash($post['password']);
        $data['created_date']        = date('Y-m-d H:i:s');
        $data['created_by']        = 1;
        $data['admin_status']        = 0;

        //Customer Email Generate
        $from_email = $this->admin_email[0]->email;
        $to_email = $post['email'];
        //Load email library
        $complete_name = $post['firstname'] . " " . $post['lastname'];
        $msg = 'Dear '.$complete_name.',<br/>Your account has been successfully created!<br/>To learn more about how to shop on Online Shopping,<a href='.base_url().' >CLICK HERE</a><br/>Thank you for being a part of Online Shopping!';
        $this->email->from($from_email, 'Online Shopping');
        $this->email->to($to_email);
        $this->email->subject('Welcome '.$complete_name.' Registration Successfully!');
        $this->email->message($msg);
        $this->email->send();
        $this->email->clear();

        //Admin Email Generate
        $from_email1 = $post['email'];
        $to_email1 = $this->admin_email[0]->email;
        //Load email library
        $get_link1 = base_url()."admin";
        $msg1 = "Dear Admin Seller Registration Account at Online Shopping";
        $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view account detail.<br/>Thank you";
        $this->email->from($from_email1, 'Online Shopping');
        $this->email->to($to_email1);
        $this->email->subject('Seller Account at Online Shopping');
        $this->email->message($msg1);
        $this->email->send();


        #  $this->Mdl_frontend->debug_r($data,1);

        $db_command =  $this->Mdl_frontend->db_command($data,null,'seller_list');
        $last_seller_id = $this->db->insert_id();

        $permission_json = '{"1":{"a":0,"e":0,"d":0,"v":1},"2":{"a":0,"e":0,"d":0,"v":1},"3":{"a":0,"e":0,"d":0,"v":0},"20":{"a":1,"e":1,"d":1,"v":1},"4":{"a":0,"e":0,"d":0,"v":0},"5":{"a":0,"e":0,"d":0,"v":0},"6":{"a":0,"e":0,"d":0,"v":0},"7":{"a":0,"e":0,"d":0,"v":0},"21":{"a":0,"e":0,"d":0,"v":0},"15":{"a":0,"e":0,"d":0,"v":0},"16":{"a":0,"e":0,"d":0,"v":0},"8":{"a":0,"e":0,"d":0,"v":1},"9":{"a":0,"e":0,"d":0,"v":0},"10":{"a":0,"e":0,"d":0,"v":0},"11":{"a":1,"e":1,"d":1,"v":1},"17":{"a":1,"e":1,"d":1,"v":1},"18":{"a":1,"e":1,"d":1,"v":1},"19":{"a":1,"e":1,"d":1,"v":1},"12":{"a":1,"e":1,"d":1,"v":1},"13":{"a":1,"e":1,"d":1,"v":1},"14":{"a":1,"e":1,"d":1,"v":1}}';
        $data_per = array
        (
            'userid'     => $last_seller_id,
            'usertype'     => 'seller',
            'permission' => $permission_json,
            'created_date'   => date('Y-m-d H:i:s'),
            'created_by'     => 1
        );
        #$this->Mdl_users->debug_r($data,0);
        $db_command =  $this->Mdl_frontend->db_command($data_per,null,'admin_module_permission');






        //print_r($db_command);
        if($db_command)
        {
            $this->email->send();
            if($post['id'] != null)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');
            }else
            {
                $this->session->set_flashdata('saved', 'your account successfully created please login to continue');
            }
            //$this->load->view('register',$this->data);
            redirect(base_url().'seller_register.html','refresh');
        }


    }


    //Seller Login Submit
    public function seller_login_submit()
    {

        $this->db->where('email',$this->input->post('email'));
        $this->db->where('password',$this->Mdl_frontend->hash($this->input->post( 'password')));
        $this->db->where('is_enable',1);
        $user = $this->db->get('seller_list')->result();
        if (count ($user) > 0) {
            $data = array (
                'id'                => $user[0]->id,
                'email'              => $user[0]->email,
                'firstname'         => $user[0]->firstname,
                'lastname'         => $user[0]->lastname,
                'user_type'         => 'user',
                'loggedin'          => True
            );

            $this->session->set_userdata ( $data );
            redirect(base_url(),'refresh');
        }else
        {
            $this->session->set_flashdata('error', 'Invalid email and password please try again');
            redirect(base_url().'seller_login.html','refresh');
        }




    }

    //Seller Forgot Password Submit
    public function seller_forgot_password_submit()
    {
        $this->load->helper('string');
        $get_code =  random_string('alnum',132);
        //$get_code =  "123";
        $post = $this->input->post();
        $email        = $post['email'];

        $this->db->where('email',$post['email']);
        $this->db->where('is_enable',1);
        $user = $this->db->get('seller_list')->result();
        if (count ($user) > 0)
        {
            $from_email = "dilawarali4@gmail.com";
            $to_email = $post['email'];

            $id = $user[0]->id;
            $user_email = $user[0]->email;
            $firstname =  $user[0]->firstname;
            $lastname = $user[0]->lastname;

            $now = date('Y-m-d H:i:s');
            $data['modify_date']  = $now;
            $data['modify_by']  = 1;
            $data['is_enable']  = 0;
            $data['verify_key']  = $get_code;

            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('seller_list');

            $complete_name = $firstname." ".$lastname;
            $msg = "Dear ".$complete_name.",<br/>Did you forget your password?<br/>";
            $msg .= "<a href='".base_url()."seller_reset_password/".$get_code.".html'></a>";
            //<a href='"'.base_url().'"' >CLICK HERE</a>to restore your password.<br/>Thank you for being a part of Farjee!|";
            $this->email->from($from_email, 'Online Shopping');
            $this->email->to($to_email);
            $this->email->subject('Forgot Password?');
            $this->email->message($msg);
            $this->session->set_flashdata('saved', 'your password has been send check email..');
            redirect(base_url().'seller_login.html','refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'We are sorry your email is not exits');
            redirect(base_url().'seller_forgot_password.html','refresh');
        }

    }

    //Seller Reset Password
    public function seller_reset_password($key)
    {
        $this->db->where('verify_key',$key);
        $this->db->where('is_enable',0);
        $user = $this->db->get('seller_list')->result();
        if (count ($user) > 0)
        {
            $this->data['key'] = $key;
            $this->data['user_id'] = $user[0]->id;
            $this->load->view('seller_reset_password',$this->data);
        }
        else
        {
            $this->load->view('_404_page',$this->data);
        }
    }

    //Seller Reset Password Submit
    public function seller_reset_password_submit()
    {
        $post = $this->input->post();
        $data['verify_key']   = '';
        $data['is_enable']    = 1;
        $data['password']     = $this->Mdl_frontend->hash($post['password']);
        $data['modify_date']  = date('Y-m-d H:i:s');
        $data['modify_by']    = 1;

        $this->db->set($data);
        $this->db->where('id', $post['user_id']);
        $db_command  = $this->db->update('seller_list');
        if($db_command)
        {

            $this->session->set_flashdata('saved', 'your password successfully update please login to continue');
            redirect(base_url().'seller_login.html','refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'your password not update please try arain');
            redirect(base_url()."seller_reset_password/".$post['key'].".html",'refresh');
        }
    }

    //LogOut User
    public function logout_user()
    {
        $this->Mdl_frontend->logout_user();
        redirect(base_url(),'refresh');
    }

    //Login Submit
    public function login_submit_checkout()
    {

        $this->db->where('email',$this->input->post('email'));
        $this->db->where('password',$this->Mdl_frontend->hash($this->input->post( 'password')));
        $this->db->where('is_enable',1);
        $user = $this->db->get('user_list')->result();
        if (count ($user) > 0)
        {
            $data = array (
                'id'                => $user[0]->id,
                'email'              => $user[0]->email,
                'firstname'         => $user[0]->firstname,
                'lastname'         => $user[0]->lastname,
                'user_type'         => 'user',
                'loggedin'          => True
            );

            $this->session->set_userdata ( $data );
            redirect(base_url().'checkout.html','refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'Invalid email and password please try again');
            redirect(base_url().'checkout.html','refresh');
        }




    }
    //Check Out Submit
    public function checkout_submit()
    {
        $post = $this->input->post();
        //echo "<pre>";
        //print_r($post);
        $order_code = $this->Mdl_frontend->get_order_track_number();
        //echo $order_code;
        //exit;
        if($this->session->userdata('user_type')=='user')
        {
            $this->db->trans_start();
            $data_user = array
            (
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'telephone' => $post['telephone'],
                'gender' => $post['gender'],
                'company' => $post['company'],
                'address' => $post['address_1'],
                'country_id' => 166,
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'postal_code' => $post['postal_code'],
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('id',$post['user_id']);
            $db_command = $this->db->update('user_list',$data_user);
            foreach($post['cart'] as $key => $value)
            {
                $product_id =  $post['cart'][$key]['id'];
                $product_price =  $post['cart'][$key]['price'];
                $product_qty =  $post['cart'][$key]['qty'];
                $data_cart = array
                (
                    'order_track' => $order_code
                );
                $this->db->where('user_id',$post['user_id']);
                $this->db->where('product_id',$product_id);
                $this->db->where('order_track',0);
                $db_command = $this->db->update('cart_list',$data_cart);
            }
            $data_order = array
            (
                'order_date' =>  date('Y-m-d'),
                'user_id' =>  $post['user_id'],
                'comments' => $post['comments'],
                'order_price' => $post['sub_total'],
                'shipping_charges' => $post['shipping_total'],
                'order_price_total' => $post['final_total'],
                'payment_mode' => 'cash',
                'order_track' => $order_code,
                'order_status' => 'pending',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order, null, 'order_list');
            $p_order_id = $this->db->insert_id();

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $p_order_id,
                'user_id' =>  $post['user_id'],
                'order_track' => $order_code,
                'order_status' => 'placed',
                'order_info' => 'Order has been placed.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history1, null, 'order_history_list');

            $data_order_history2 = array
            (
                'order_id' => $p_order_id,
                'user_id' =>  $post['user_id'],
                'order_track' => $order_code,
                'order_status' => 'pending',
                'order_info' => 'Ordered item is pending confirmation.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history2, null, 'order_history_list');




            $this->db->trans_complete();


            if ($db_command)
            {
                //Customer Email Generate
                $from_email = $this->admin_email[0]->email;
                $to_email = $this->session->userdata('email');
                //Load email library
                $complete_name = $post['firstname'] . " " . $post['lastname'];
                $msg = 'Dear '.$complete_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_code.'.<br/>You will be contacted shortly for confirmation of your order via SMS/Call.<br/>Thank you for being a part of Farjee!';
                $this->email->from($from_email, 'Farjee Online Shopping');
                $this->email->to($to_email);
                $this->email->subject('Order placed at Farjee.pk');
                $this->email->message($msg);
                $this->email->send();
                $this->email->clear();

                //Admin Email Generate
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $this->admin_email[0]->email;
                //Load email library
                $get_link1 = base_url()."admin";
                $msg1 = "Dear Admin Order placed at Farjee.pk";
                $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view order detail.<br/>Thank you";
                $this->email->from($from_email1, 'Farjee Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Order placed at Farjee.pk');
                $this->email->message($msg1);
                $this->email->send();






                $this->data['shipping_total'] = $post['shipping_total'];
                $this->data['cart_date'] = date('Y-m-d H:i:s');
                $this->data['total_amount'] = $post['final_total'];
                $this->data['card_info'] = $post['cart'];
                $this->data['track_order'] = $order_code;
                $this->data['address'] = $post['address_1'];
                $this->cart->destroy();
                $this->load->view('success',$this->data);
                //redirect(base_url() . 'success.html', 'refresh');
            }


        }
        else
        {

            $this->db->trans_start();
            $data_user = array
            (
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'telephone' => $post['telephone'],
                'gender' => $post['gender'],
                'email' => $post['email_checkout'],
                'password' => $this->Mdl_frontend->hash($post['password']),
                'company' => $post['company'],
                'address' => $post['address_1'],
                'country_id' => 166,
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'postal_code' => $post['postal_code'],
                'user_type' => $post['user_type'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1

            );
            $db_command = $this->Mdl_frontend->db_command($data_user, null, 'user_list');
            $p_user_id = $this->db->insert_id();

            foreach($post['cart'] as $key => $value)
            {
                $product_id =  $post['cart'][$key]['id'];
                $product_price =  $post['cart'][$key]['price'];
                $product_qty =  $post['cart'][$key]['qty'];
                    $data_cart = array
                    (
                        'user_id' =>  $p_user_id,
                        'product_id' => $product_id,
                        'cart_date' => date('Y-m-d'),
                        'cart_qty' => $product_qty,
                        'cart_price' => $product_price,
                        'cart_type' => 'cart',
                        'cart_status' => 'pending',
                        'order_track' => $order_code,
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => 1
                    );
                    $db_command = $this->Mdl_frontend->db_command($data_cart, null, 'cart_list');
                    $p_cart_id = $this->db->insert_id();
            }

            $data_order = array
            (
                'order_date' =>  date('Y-m-d'),
                'user_id' =>  $p_user_id,
                'comments' => $post['comments'],
                'order_price' => $post['sub_total'],
                'shipping_charges' => $post['shipping_total'],
                'order_price_total' => $post['final_total'],
                'payment_mode' => 'cash',
                'order_track' => $order_code,
                'order_status' => 'pending',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order, null, 'order_list');
            $p_order_id = $this->db->insert_id();

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $p_order_id,
                'user_id' =>  $post['user_id'],
                'order_track' => $order_code,
                'order_status' => 'placed',
                'order_info' => 'Order has been placed.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history1, null, 'order_history_list');

            $data_order_history2 = array
            (
                'order_id' => $p_order_id,
                'user_id' =>  $post['user_id'],
                'order_track' => $order_code,
                'order_status' => 'pending',
                'order_info' => 'Ordered item is pending confirmation.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history2, null, 'order_history_list');
            $this->db->trans_complete();
              if ($db_command)
              {
                  //Customer Account Success Msg
                  $from_email2 = $this->admin_email[0]->email;
                  $to_email2 = $post['email_checkout'];
                  $complete_name2 = $post['firstname']." ".$post['lastname'];
                  $msg2 = 'Dear '.$complete_name2.',<br/>Your account has been successfully created!<br/>To learn more about how to shop on Farjee Online Shopping,<a href='.base_url().' >CLICK HERE</a><br/>Thank you for being a part of Farjee!';
                  $this->email->from($from_email2, 'Farjee Online Shopping');
                  $this->email->to($to_email2);
                  $this->email->subject('Welcome '.$complete_name2.' Registration Successfully!');
                  $this->email->message($msg2);
                  $this->email->send();
                  $this->email->clear();


                  //Customer Email Generate
                  $from_email = $this->admin_email[0]->email;
                  $to_email = $post['email_checkout'];
                  //Load email library
                  $complete_name = $post['firstname'] . " " . $post['lastname'];
                  $msg = 'Dear '.$complete_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_code.'.<br/>You will be contacted shortly for confirmation of your order via SMS/Call.<br/>Thank you for being a part of Farjee!';
                  $this->email->from($from_email, 'Farjee Online Shopping');
                  $this->email->to($to_email);
                  $this->email->subject('Order placed at Farjee.pk');
                  $this->email->message($msg);
                  $this->email->send();
                  $this->email->clear();

                  //Admin Email Generate
                  $from_email1 = $post['email_checkout'];
                  $to_email1 = $this->admin_email[0]->email;
                  //Load email library
                  $get_link1 = base_url()."admin";
                  $msg1 = "Dear Admin Order placed at Farjee.pk";
                  $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view order detail.<br/>Thank you";
                  $this->email->from($from_email1, 'Farjee Online Shopping');
                  $this->email->to($to_email1);
                  $this->email->subject('Order placed at Farjee.pk');
                  $this->email->message($msg1);
                  $this->email->send();

                  $data = array (
                      'id'                => $p_user_id,
                      'email'              => $post['email_checkout'],
                      'firstname'         => $post['firstname'],
                      'lastname'         => $post['lastname'],
                      'user_type'         => 'user',
                      'loggedin'          => True
                  );

                  $this->session->set_userdata ( $data );

                $this->data['shipping_total'] = $post['shipping_total'];
                $this->data['cart_date'] = date('Y-m-d H:i:s');
                $this->data['total_amount'] = $post['final_total'];
                $this->data['card_info'] = $post['cart'];
                $this->data['track_order'] = $order_code;
                $this->data['address'] = $post['address_1'];
                $this->cart->destroy();
                $this->load->view('success',$this->data);
                //redirect(base_url() . 'success.html', 'refresh');
              }
        }

    }


/*     //Check Out Submit
    public function checkout_submit()
    {
        $post = $this->input->post();
       // echo "<pre>";
       // print_r($post);
       // exit;
        $final_total = ($post['qty'] * $post['product_price']) + $post['shipping_charges'];
        $order_code = $this->Mdl_frontend->get_order_track_number();

            $this->db->trans_start();
        //User Login
        if($post['user_id'] > 0)
        {
           // echo $post['user_id'];
           // exit;
            $data_user = array
            (
                'telephone' => $post['phone'],
                'address' => $post['address'],
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => $post['user_id']

            );
            $this->db->where('id',$post['user_id']);
            $db_command = $this->db->update('user_list',$data_user);
            $p_user_id = $post['user_id'];


        }
        else
        {
            $data_user = array
            (
                'firstname' => $post['fname'],
                //'lastname' => $post['lastname'],
                'telephone' => $post['phone'],
                //'gender' => $post['gender'],
                'email' => $post['email_checkout'],
                //'password' => $this->Mdl_frontend->hash($post['password']),
                // 'company' => $post['company'],
                'address' => $post['address'],
                'country_id' => 166,
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                //  'postal_code' => $post['postal_code'],
                'user_type' => 'order',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $post['seller_id']

            );
            $db_command = $this->Mdl_frontend->db_command($data_user, null, 'user_list');
            $p_user_id = $this->db->insert_id();

        }


        $data_cart = array
        (
            'user_id' =>  $p_user_id,
            'product_id' => $post['product_id'],
            'cart_date' => date('Y-m-d'),
            'cart_qty' => $post['qty'],
            'cart_price' => $post['product_price'],
            'shipping_charges' => $post['shipping_charges'],
            'cart_type' => 'order',
            'cart_status' => 'pending',
            'order_track' => $order_code,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $post['seller_id']
        );
        $db_command = $this->Mdl_frontend->db_command($data_cart, null, 'cart_list');
        $p_cart_id = $this->db->insert_id();


            $data_order = array
            (
                'user_id' => $p_user_id,
                'name' => $post['fname'],
                'email' => $post['email_checkout'],
                'phone' => $post['phone'],
                'address' => $post['address'],
                'country_id' => '166',
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'product_id' => $post['product_id'],

                'order_date' =>  date('Y-m-d'),
                'quantity' =>  $post['qty'],
                'order_price' => $post['product_price'],
                'shipping_charges' => $post['shipping_charges'],
                'order_price_total' => $final_total,
                'payment_mode' => 'cash',
                'order_track' => $order_code,
                'order_status' => 'pending',
                'seller_id' => $post['seller_id'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order, null, 'order_list');
            $p_order_id = $this->db->insert_id();

            //Order History Add
            $data_order_history1 = array
            (
                'order_id' => $p_order_id,
                'user_id' => $p_user_id,
                'cart_id' => $p_cart_id,
                'product_id' =>  $post['product_id'],
                'seller_id' =>  $post['seller_id'],
                'order_track' => $order_code,
                'order_status' => 'placed',
                'order_info' => 'Order has been placed.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history1, null, 'order_history_list');

            $data_order_history2 = array
            (
                'order_id' => $p_order_id,
                'product_id' =>  $post['product_id'],
                'seller_id' =>  $post['seller_id'],
                'order_track' => $order_code,
                'order_status' => 'pending',
                'order_info' => 'Ordered item is pending confirmation.',
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1
            );
            $db_command = $this->Mdl_frontend->db_command($data_order_history2, null, 'order_history_list');


            $this->db->trans_complete();

              if ($db_command)
              {

                  //Customer Email Generate
                  $from_email = $this->admin_email[0]->email;
                  $to_email = $post['email_checkout'];
                  //Load email library
                  $complete_name = $post['fname'];
                  $msg = 'Dear '.$complete_name.',<br/>Thank you for placing your order with us. Your order ID is '.$order_code.'.<br/>You will be contacted shortly for confirmation of your order via SMS/Call.<br/>Thank you for being a part of Online Shopping!';
                  $this->email->from($from_email, 'Online Shopping');
                  $this->email->to($to_email);
                  $this->email->subject('Order placed at Online Shopping');
                  $this->email->message($msg);
                  $this->email->send();
                  $this->email->clear();

                  //Admin Email Generate
                  $from_email1 = $post['email_checkout'];
                  $to_email1 = $this->admin_email[0]->email;
                  //Load email library
                  $get_link1 = base_url()."admin";
                  $msg1 = "Dear Admin Order placed atOnline Shopping";
                  $msg1 .= "<br/><a href='".$get_link1."' >CLICK HERE</a> to login your account and view order detail.<br/>Thank you";
                  $this->email->from($from_email1, 'Online Shopping');
                  $this->email->to($to_email1);
                  $this->email->subject('Order placed at Online Shopping');
                  $this->email->message($msg1);
                  $this->email->send();
                  $this->data['shipping_total'] = $post['shipping_charges'];
                  $this->data['cart_date'] = date('Y-m-d H:i:s');
                  $this->data['total_amount'] = $final_total;
                  $this->data['product_id'] = $post['product_id'];
                  $this->data['product_qty'] = $post['qty'];
                  $this->data['track_order'] = $order_code;
                  $this->data['address'] = $post['address'];
                  //$this->cart->destroy();
                  $this->load->view('success',$this->data);

              }
              else
              {

                  $this->session->set_flashdata('error', 'your order form has not been Submit');
                  redirect(base_url().'index.html','refresh');
              }


    }
 */

    //Account Personal Information
    public function personal_information_submit()
    {
        $post = $this->input->post();
      // print_r($post);
       // exit;
        if($this->session->userdata('user_type')=='user')
        {
            if($post['date_of_birth'] == "")
            {
                $dob = "";
            }
            else
            {
                $dob =date('Y-m-d', strtotime( $post['date_of_birth'] )) ;
            }
            if($post['change_password_radio'] == "change")
            {
                $password = $this->Mdl_frontend->hash($this->input->post('password'));
            }
            else
            {
                $password = $post['old_password'];
            }
            //echo $dob;
            //exit;
            $this->db->trans_start();
            $data_user = array
            (
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'telephone' => $post['telephone'],
                'gender' => $post['gender'],
                'dob' => $dob,
                'password' => $password,
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('id',$post['user_id']);
            $db_command = $this->db->update('user_list',$data_user);
            $this->db->trans_complete();
            if($db_command)
            {
                $this->session->set_flashdata('update', 'your account successfully Updated');
            }
            else
            {
                $this->session->set_flashdata('error', 'your account has not been Updated');
            }
            redirect(base_url().'account.html','refresh');


        }
        else
        {
            $this->session->set_flashdata('error', 'your account has not been Updated');
            redirect(base_url().'account.html','refresh');
        }

    }

    //Account Address Information
    public function address_information_submit()
    {
        $post = $this->input->post();
         if($this->session->userdata('user_type')=='user')
        {
            $this->db->trans_start();
            $data_user = array
            (
                'company' => $post['company'],
                'address' => $post['address_1'],
                'country_id' => 166,
                'state_id' => $post['state_id'],
                'city_id' => $post['city_id'],
                'postal_code' => $post['postal_code'],
                'modify_date' => date('Y-m-d H:i:s'),
                'modify_by' => 1
            );
            $this->db->where('id',$post['user_id']);
            $db_command = $this->db->update('user_list',$data_user);
            $this->db->trans_complete();
            if($db_command)
            {
                $this->session->set_flashdata('update', 'your account successfully Updated');
            }
            else
            {
                $this->session->set_flashdata('error', 'your account has not been Updated');
            }
            redirect(base_url().'account.html','refresh');


        }
         else
         {
             $this->session->set_flashdata('error', 'your account has not been Updated');
             redirect(base_url().'account.html','refresh');
         }
    }


    //Contact Us Submit
    public function contactus_submit()
    {

        $post = $this->input->post();

        $from_email = $post['email'];
        $to_email = $this->admin_email[0]->email;

        //Load email library

        //$complete_name = $post['firstname']." ".$post['lastname'];
        $msg = 'Name : '.$post['name'].'<br/>Email : '.$post['email'].'<br/>Enquiry : '.$post['enquiry'];
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('User Enquiry Detail!');
        $send = $this->email->message($msg);

        if($send)
        {
            $this->session->set_flashdata('saved', 'Enquiry has been successfully submit');
        }else
        {
            $this->session->set_flashdata('error', 'Enquiry has not been submit try again');
        }
        //$this->load->view('register',$this->data);
        redirect(base_url().'contact_us.html','refresh');

    }

    //Change City List by State Id
    public function get_state_city_byid()
    {
        $country_id         =  $this->input->post('country_id');
        $state_id         =  $this->input->post('state_id');
        $data['result_set'] = $this->Mdl_frontend->city_list_by_state($country_id,$state_id);
        foreach($data['result_set'] as $key => $value):
            $option .= '<option value = '.$key.' >'.$value.'</option>';
        endforeach;
        echo $option;
    }


    public function action($id = null)
    { 

        $id = $this->uri->segment(3);  
        if($id > 0)
        {
            $data['result_set'] = $this->Mdl_frontend->_get_single_record_byid($id);  
        } 

        $data['content']   = 'Users/action';
        $this->load->view('Template/template',$data);

    }


    public function change_user_email()
    {
        $post               =  $this->input->post();
        $email                 =  $post['email'];

        $_return =  $this->Mdl_frontend->_change_user_email($email);
        if($_return == 1)
        {
            echo 1;
        }else
        {
            echo 0;

        }

    }
    //Check Username
    public function check_seller_user()
    {
        $post               =  $this->input->post();
        $username                =  $post['username'];

        $_return =  $this->Mdl_frontend->_check_seller_user($username);
        if($_return == 1)
        {
            echo 1;
        }else
        {
            echo 0;

        }

    }

    public function command()
    { 
        $post = $this->input->post();

        ##@@@ user_type => 1  :: Super Admin
        ##@@@ user_type => 2  :: Markaz Admin
        ##@@@ user_type => 3  :: Markaz User
        //print_r($post);
        //exit;
        $user_type = $this->session->userdata('user_type');  
        # $data['user_type']        = $post['user_type']; 
        ##@@@ getting usertype country if user not a super admin
        if($user_type != 1): $data['user_type'] = $user_type; endif;
        if($user_type == 1): $data['user_type'] = 2;  endif;

        ###@@ changing and checking status on checkbox  
        if($post['status']){$is_enable = 1;}else{$is_enable = 0;} 
        //if($post['is_print']){$is_print = 1;}else{$is_print = 0;} 	   

        if($post['password']): $data['password'] =  Modules::run('Login/_hash',$post['password']); endif;

        /*        //if($post['markaz_id'] == null): $data['user_type'] = 3; $data['markaz_id'] = $this->session->userdata('markaz_id');  else:  $data['user_type']    = 2; $data['markaz_id'] = $post['markaz_id'];  endif;
        */   


        $data['is_enable']        = $is_enable;
        $data['account_title']        = 'User';
        $data['email']            = $post['email']; 
        $data['username']         = $post['username']; 
        $data['mobile_no']        = $post['mobile_no']; 
        $data['ip_address']       = $this->input->ip_address();





        #  $this->Mdl_frontend->debug_r($data,1);

        $db_command =  $this->Mdl_frontend->db_command($data,$post['id'],'login');
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
        }  

    } 
    public function check_user_exists()
    {
        $post               =  $this->input->post();
        $username           =  $post['username'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_frontend->_get_single_record_byusername($username,$id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return; 

    }
    public function change_user_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_frontend->_change_user_status($id,$status);
        $return             = json_encode($_return);
        echo $return; 

    }  

    //User Print Status
    public function change_user_is_print()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_frontend->_change_user_is_print($id,$status);
        $return             = json_encode($_return);
        echo $return; 
    } 


    public function delete($id)
    {
        $delete = $this->Mdl_frontend->_delete($id);

        if($delete == 1)
        {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!'); 
        }else
        {
            $this->session->set_flashdata('error', 'No record found for Deleting !');   
        }
        redirect(base_url().'Users','refresh');  
    }  
    public function data_permission()
    {
        $data['permission_view'] = $this->hierarchy_list();   
        $data['content']    = 'Users/data_permission';
        $this->load->view('Template/template',$data);
    }
    public function module_permission()
    {
        $data['permission_view'] = $this->menulist();   
        $data['content']    = 'Users/module_permission';
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
        #  $this->Mdl_frontend->debug_r($permission,1); 
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



                    # $this->Mdl_frontend->debug_r($permission,1);  
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
        #  $this->Mdl_frontend->debug_r($postdata,1); 
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
        #  $this->Mdl_frontend->debug_r($permission_json,0);   

        $id  = $this->already_exists_row('admin_module_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_frontend->debug_r($data,0);   
        $db_command =  $this->Mdl_frontend->db_command($data,$id,'admin_module_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Users','refresh');  
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
        #$this->Mdl_frontend->debug_r($postdata,1); 
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
        # $this->Mdl_frontend->debug_r($permission_json,1);


        $id  = $this->already_exists_row('admin_data_permission','userid',$userid,'id');

        # return $permission_json;
        $data = array(
            'userid'     => $userid,
            'permission' => $permission_json
        );
        #$this->Mdl_frontend->debug_r($data,0);   
        $db_command =  $this->Mdl_frontend->db_command($data,$id,'admin_data_permission');
        if($db_command)
        {
            if($id > 0)
            {
                $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
                $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Users','refresh');  
        }
    } 
}
