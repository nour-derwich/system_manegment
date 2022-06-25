<!-- Header -->
<?php require "template/header.php";

$state_dd  = $this->Mdl_frontend->state_list(166);

 ?>
<style>
.form-group1
{
	margin:0px 0px 15px 0px !important;
}
.help-block
{
	color:#a94442 !important;
}
</style>
<div id="container">
<div class="container">


  <header class="page-header">
            <h1 class="page-title">Checkout</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a></li>
                <li><a href="<?php echo base_url(); ?>cart.html">Shopping Cart</a></li>
                <li class="active">Checkout</li>
            </ol>

        </header>
		

<div class="row">
<!--Middle Part Start-->
<div id="content" class="col-sm-12">
<h1 class="title">Checkout</h1>
<?php
	$cart_check_ = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
	$cart_check = $this->cart->contents();
    // If cart is empty, this will show below message.
    if(empty($cart_check) && $cart_check_ == 0)
    {
?>
	<!--<h3>Shopping Cart is Empty</h3>-->
	<p>You have no items in your shopping cart to checkout.<br/>
	Click  <a href="<?php echo base_url(); ?>" >here</a> to continue shopping.</p>
<?php
	}
	else
	{
		?>

<?php
if($this->session->flashdata())
{
    foreach($this->session->flashdata() as $key => $value):
        if($key == 'update' || $key == 'saved')
        {
            $alert_class = 'alert-success';
        }else
        {
            $alert_class = 'alert-danger';
        }
        ?>
        <div class="alert alert-block <?php echo $alert_class; ?>">
            <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
            </button>

            <p>
                <strong>
                    <i class="icon-ok"></i>
                    <?php echo ucwords(strtolower($key)); ?> !
                </strong>
                <?php echo $value; ?>

            </p>


        </div>
    <?php
    endforeach;
}  ?>
<div class="row">
<div class="col-sm-4">
<?php
if($this->session->userdata('user_type')=='user')
{
    //print_r($user_info);
}
else
{
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-sign-in"></i> Create an Account or Login</h4>
    </div>
    <div class="panel-body">
		
        <div class="radio">
            <label>
                <input type="radio" value="register" name="account" class="rbtn_account">
                Register Account</label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" checked="checked" value="guest" name="account" class="rbtn_account">
                Guest Checkout</label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" value="returning" name="account" class="rbtn_account">
                Returning Customer</label>
        </div>
    </div>
</div>
<?php
}
?>

<div id="login_account" class="hide">

<form class="form-horizontal" id="validateLogin" action="<?php echo base_url(); ?>checkout_login_submit.html" method="post">
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-user"></i> Returning Customer</h4>
    </div>
    <div class="panel-body">
        <fieldset id="account">
           
            <div class="form-group1 form-group required">
                <label for="input-payment-email" class="control-label">E-Mail</label>
                <input type="email" class="form-control" id="email" placeholder="E-Mail" value="" name="email">
            </div>
           
            <div class="form-group1 form-group required">
                <label for="input-payment-fax" class="control-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" value="" name="password">
            </div>
			<div class="form-group form-group1">

                                <a href="http://localhost/development/farjee_final/forgot_password.html">Forgot password?</a>
                                <input type="submit" value="Login" id="account_login" class="btn btn-primary pull-right">
                            </div>
							
        </fieldset>
    </div>
</div>
</form>
</div>

<div id="returning_account">
<form class="form-horizontal" id="validateCheckout" action="<?php echo base_url(); ?>checkout_submit.html" method="post">
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
    </div>
    <div class="panel-body">
        <fieldset id="account">
            <input type="hidden" name="user_id" value="<?php echo $user_info[0]->id; ?>" />
            <div class="form-group1 form-group required">
                <label for="input-payment-firstname" class="control-label">First Name</label>
                <input type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $user_info[0]->firstname; ?>" name="firstname">
                <input type="hidden" class="form-control" id="user_type" placeholder="" value="guest" name="user_type">
            </div>
            <div class="form-group1 form-group required">
                <label for="input-payment-lastname" class="control-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $user_info[0]->lastname; ?>" name="lastname">
            </div>			
		    <div class="form-group1 form-group required">
                <label for="input-payment-telephone" class="control-label">Telephone</label>
                <input type="text" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo $user_info[0]->telephone; ?>" name="telephone">
            </div>
			<div class="form-group1 form-group required">
                <label for="input-payment-lastname" class="control-label">Gender</label>
                <select class="form-control" id="gender" name="gender">
					<option value="">Please Select</option>
					<option value="male" <?php if($user_info[0]->gender == 'male'){ echo "selected"; } ?>> Male</option>
					<option value="female" <?php if($user_info[0]->gender == 'female'){ echo "selected";} ?>> Female</option>
				</select>			
	       </div>
            <div class="form-group1 form-group required">
                <label for="input-payment-email" class="control-label">E-Mail</label>
                <div class="email_register">
                    <input type="email" class="form-control"  <?php if($this->session->userdata('user_type')=='user'){ echo "disabled"; }else{ echo 'id="email_checkout"'; } ?> placeholder="E-Mail" value="<?php echo $user_info[0]->email; ?>" name="email_checkout">
                </div>
            </div>
            <?php
            if($this->session->userdata('user_type')=='user')
            {

            }
            else
            {

            ?>
            <div class="form-group1 form-group required">
                <label for="input-payment-fax" class="control-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" value="" name="password">
            </div>
            <?php
            }
            ?>
        </fieldset>
    </div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
</div>
<div class="panel-body">
<fieldset id="address" class="">
<div class="form-group1 form-group">
    <label for="input-payment-company" class="control-label">Company</label>
    <input type="text" class="form-control" id="company" placeholder="Company" value="<?php echo $user_info[0]->company; ?>" name="company">
</div>
<div class="form-group1 form-group required">
    <label for="input-payment-address-1" class="control-label">Address 1</label>
	<textarea rows="4" class="form-control" id="address_1" placeholder="Address 1" name="address_1"><?php echo $user_info[0]->address; ?></textarea>
</div>
<!--<div class="form-group1 form-group">
    <label for="input-payment-address-2" class="control-label">Address 2</label>
	<textarea rows="4" class="form-control" id="address_2"  placeholder="Address 2" name="address_2" ><?php //echo $user_info[0]->address_2; ?></textarea>
</div>-->


<div class="form-group1 form-group required">
    <label for="input-payment-zone" class="control-label">Region / State</label>
	<?php
		echo form_dropdown
		(
            'state_id',
            $state_dd,$user_info[0]->state_id,
            'class	= "form-control city_get"
			id     	= "state_id" placeholder="State"'); 
    ?>   
</div>
<div class="form-group1 form-group required">
    <label for="input-payment-city" class="control-label">City</label>
	<select name="city_id" id="city_id" placeholder="City"   class="form-control city_id" >3
        <?php
        if($this->session->userdata('user_type')=='user')
        {
            if($user_info[0]->city_id >0 )
            {
                echo '<option value='.$user_info[0]->city_id.'>'.$city_name.'</option>';
            }
        }
        ?>
	</select>

</div>
<div class="form-group1 form-group required">
    <label for="input-payment-postcode" class="control-label">Postal Code</label>
    <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" value="<?php echo $user_info[0]->postal_code; ?>" name="postal_code">
</div>

<!--
<div class="checkbox">
    <label>
        <input type="checkbox" checked="checked" value="1" name="shipping_address">
        My delivery and billing addresses are the same.</label>
</div>-->
</fieldset>
</div>
</div>
</div>
</div>
<div class="col-sm-8">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
                </div>
                <div class="panel-body">
                    <p>Please select the preferred shipping method to use on this order.</p>
                    <div class="radio">
                        <label>
                            <input type="radio" checked="checked" name="Free Shipping">
                            Shipping Charges - Rs. 200</label>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
                </div>
                <div class="panel-body">
                    <p>Please select the preferred payment method to use on this order.</p>
                    <div class="radio">
                        <label>
                            <input type="radio" checked="checked" name="Cash On Delivery">
                            Cash On Delivery</label>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                </div>
                <div class="panel-body shopping_cart_checkout_view">
                    <?php
                    if ($this->session->userdata('user_type') == 'user')
                    {
                        
                        if ($cart_check_ > 0) 
						{
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
                                    foreach ($cart_check_ as $item) {
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
                                                             alt="<?php echo $product_name; ?>"
                                                             title="<?php echo $product_name; ?>"
                                                             class="img-responsive img-thumbnail"/>
                                                    <?php
                                                    } else {
                                                        ?>
                                                        <img
                                                            src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                            style="height: 59px;width: 59px;"
                                                            alt="<?php echo $product_name; ?>"
                                                            title="<?php echo $product_name; ?>"
                                                            class="img-responsive img-thumbnail"/>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <img
                                                        src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                        style="height: 59px;width: 59px;"
                                                        alt="<?php echo $product_name; ?>"
                                                        title="<?php echo $product_name; ?>"
                                                        class="img-responsive img-thumbnail"/>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                            <td class="text-left"><?php echo $product_name; ?></td>

                                            <td class="text-left">
                                                <!--<form id="cart_form" method="post" action="<?php echo base_url(); ?>Frontend/product_update_card/">-->
                                                <?php
                                                // echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                                //     echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                                ?>
                                                <!--  <input type="hidden" name="type_page" value="checkout" />-->
                                                <div class="input-group btn-block quantity">
                                                    <span class="form-control"
                                                          style="width:52px"><?php echo $item->cart_qty; ?></span>
                                                    <?php

                                                    //  echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" id="quantity" size="1" readonly  style="width:52px" class="form-control"');
                                                    ?>
                                                    <!--<span class="input-group-btn">
                        <button type="submit" title="Update" rel="<?php //echo $item['rowid']; ?>"
                                id="update_product_cart" class="btn btn-primary"><i
                                class="fa fa-refresh"></i></button>
                        <button type="button" rel="<?php //echo $item['rowid']; ?>" title="Remove"
                                class="btn btn-danger" id="remove_product1"><i class="fa fa-times-circle"></i></button>
                        </span>-->

                                                </div>


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
                                    <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                                        <td class="text-right">Rs. <?php echo $grand_total; ?></td>
                                        <input type="hidden" name="sub_total" value="<?php echo $grand_total; ?>"/>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Shipping Charges:</strong></td>
                                        <td class="text-right">Rs. 200</td>
                                        <input type="hidden" name="shipping_total" value="200"/>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                        <td class="text-right">Rs. <?php echo $grand_total + 200; ?></td>
                                        <input type="hidden" name="final_total"
                                               value="<?php echo $grand_total + 200; ?>"/>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

<?php
                        }
                    }
                    else
                    {
                        $cart_check = $this->cart->contents();

                        // All values of cart store in "$cart".
                        if ($cart = $this->cart->contents()) 
						{
                            $i_top = 0;
                            $grand_total_top = 0;
                            foreach ($cart as $item1) {
                                $i_top++;
                                $grand_total_top += $item1['subtotal'];

                            }
                            ?>

                            <?php
                            //echo form_open('shopping/update_cart');
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
                                    foreach ($cart as $item) {
                                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                        echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']);
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
                                                            style="height: 59px;width: 59px;"
                                                            alt="<?php echo $product_name; ?>"
                                                            title="<?php echo $product_name; ?>"
                                                            class="img-responsive img-thumbnail"/>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <img
                                                        src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                                        style="height: 59px;width: 59px;"
                                                        alt="<?php echo $product_name; ?>"
                                                        title="<?php echo $product_name; ?>"
                                                        class="img-responsive img-thumbnail"/>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                            <td class="text-left"><?php echo $item['name']; ?></td>

                                            <td class="text-left">
                                                <!--<form id="cart_form" method="post" action="<?php echo base_url(); ?>Frontend/product_update_card/">-->
                                                <?php
                                                // echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                                //     echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                                //    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                                ?>
                                                <!--  <input type="hidden" name="type_page" value="checkout" />-->
                                                <div class="input-group btn-block quantity">
                                                    <span class="form-control"
                                                          style="width:52px"><?php echo $item['qty']; ?></span>
                                                    <?php

                                                    //  echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" id="quantity" size="1" readonly  style="width:52px" class="form-control"');
                                                    ?>
                                                    <!--<span class="input-group-btn">
                        <button type="submit" title="Update" rel="<?php //echo $item['rowid']; ?>"
                                id="update_product_cart" class="btn btn-primary"><i
                                class="fa fa-refresh"></i></button>
                        <button type="button" rel="<?php //echo $item['rowid']; ?>" title="Remove"
                                class="btn btn-danger" id="remove_product1"><i class="fa fa-times-circle"></i></button>
                        </span>-->

                                                </div>


                                            </td>
                                            <td class="text-right">Rs. <?php echo $item['price']; ?></td>
                                            <td class="text-right">Rs. <?php
                                                $final_price = $item['qty'] * $item['price'];
                                                //echo number_format($final_price, 2);

                                                echo $final_price; ?></td>
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
                                        <input type="hidden" name="sub_total" value="<?php echo $grand_total; ?>"/>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Shipping Charges:</strong></td>
                                        <td class="text-right">Rs. 200</td>
                                        <input type="hidden" name="shipping_total" value="200"/>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                        <td class="text-right">Rs. <?php echo $grand_total + 200; ?></td>
                                        <input type="hidden" name="final_total"
                                               value="<?php echo $grand_total + 200; ?>"/>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        <?php
                        }
                    }

                        ?>

                   
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
                </div>
                <div class="panel-body">
                    <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                    <br>
                    <label class="control-label" for="confirm_agree">
                        <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
                        <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
                    <div class="buttons">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-primary" id="confirm_order" value="Confirm Order">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 </form>
 <?php
	}
 ?>
</div>
<!--Middle Part End -->
</div>
</div>
</div>
<script type="text/javascript">

		$("input[name='account']").on("click", function() {
            //alert($(this).val());
			var type = $(this).val();
			if(type == "returning")
			{
				$("#login_account").removeClass('hide');
				$("#returning_account").addClass('hide');
				$("#confirm_order").attr("disabled",true);
				$("#user_type").val("");
			}
			else
			{
				$("#login_account").addClass('hide');
				$("#returning_account").removeClass('hide');
				$("#confirm_order").attr("disabled",false);
				$("#user_type").val(type);
			}
			
			
			
        });
		
						
	//City Get
   // $(document).on("click",'',function()
  //  {
	//	var type = $(this).val();
//		con
		
//	});

	//City Get
    $(document).on("change",'.city_get',function()
    {
		//alert("YES");
        var json = {};
        json['country_id'] = "166";
        json['state_id'] = $(this).val();
        var request = $.ajax(
		{
            url: "<?php echo base_url('Frontend/get_state_city_byid'); ?>",
            type: "POST",
            data: json,
            dataType: "html",
            success : function(_return)
			{
                //console.log(_return);
				$('.city_id').html(_return); 
            }
        });  
    });
	
	jQuery(function($)
    {
		

		
	
		jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
		}, "Only alphabetical characters");
	
		//Form Validation Login  
		//$(document).on("click",'#account_login',function()
		//{
			//alert('Order Button Click');
			$('#validateLogin').validate(
			{
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: 
				{
					email: {
						required: true,
						email:true
					},
					password: {
						required: true,
						minlength: 5
					},
				},
				messages: 
				{
					
					email: {
						required: " E-Mail field is required.",
						email: " Please provide a valid email address."
					},
					password: {
						required: " Password field is required.",
						minlength: " Please specify a secure password."
					},           
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					$('.alert-danger', $('.form-validate')).show();
				},
				highlight: function (e) {
					$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},
				success: function (e) {
					$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
					$(e).remove();
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
					// $(".form-validate-register").validationEngine('attach', { promptPosition: "topLeft" });
				}
			});
			// Direct change value in data base on for changing status
		//});	
	
	
		//Form Validation CheckOut  
		$(document).on("click",'#confirm_order',function()
		{
			//alert('Order Button Click');
			$('#validateCheckout').validate(
			{
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: 
				{
					firstname: {
						required: true,
						lettersonly: true
					},
					lastname: {
						required: true,
						lettersonly: true
					},
					telephone: {
						required: true
					},
					gender: {
						required: true
					},
					email: {
						required: true,
						email:true
					},
					password: {
						required: true,
						minlength: 5
					},
					address_1: {
						required: true
					},
					state_id: {
						required: true
					},
					city_id: {
						required: true
					},
					postal_code: {
						required: true
					}
				},
				messages: 
				{
					firstname:{
						required: " First Name field is required.",
						lettersonly: " Please enter only alphabetical characters."
					},
					lastname: {
						required: " Last Name field is required.",
						lettersonly: " Please enter only alphabetical characters."
					},
					 telephone: " Telephone field is required.",
					  gender: " Please choose at least one option",

					email: {
						required: " E-Mail field is required.",
						email: " Please provide a valid email address."
					},
					password: {
						required: " Password field is required.",
						minlength: " Please specify a secure password."
					},
					address_1: " Address field is required.",
					state_id: " State field is required.",
					city_id: " City field is required.",
					postal_code: " Postal Code field is required.",           
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					$('.alert-danger', $('.form-validate')).show();
				},
				highlight: function (e) {
					$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},
				success: function (e) {
					$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
					$(e).remove();
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
					// $(".form-validate-register").validationEngine('attach', { promptPosition: "topLeft" });
				}
			});
			// Direct change value in data base on for changing status
		});


        //Refresh Islamic Education List
        $(document).on("blur",'#email_checkout',function()
        {
            var json             = {};
            json['email']   = $("#email_checkout").val();
            var email = $("#email_checkout").val();
            var request = $.ajax(
                {
                    url: "<?php echo base_url('Frontend/change_user_email'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",
                    beforeSend : function()
                    {
                        $('.icon-spinner').removeClass('hide');
                    },
                    success : function(_return)
                    {
                        if(_return == 1)
                        {
                            $('.email_register').html('<input type="email" class="form-control email_checkout" id="email_checkout" placeholder="E-Mail" value="" name="email_checkout"><br/><div for="email" class="help-block">Email is already exit</div>');
                            $('#email_checkout').focus();
                        }
                        else
                        {
                            $('.email_register').html('<input type="email" class="form-control email_checkout" id="email_checkout" placeholder="E-Mail" value="'+email+'" name="email_checkout">');
                        }

                    },
                    complete: function ()
                    {
                        $('.icon-spinner').addClass('hide');
                        //$('.city').addClass("select2-select-00");
                    }
                });
        });
	
	});
</script>


<!-- Footer -->
<?php require "template/footer.php"; ?>