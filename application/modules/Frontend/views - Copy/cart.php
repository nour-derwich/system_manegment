<!-- Header -->
<?php require "template/header.php";
?>

<div id="container">
<div class="container">



 <!-- Breadcrumb Start-->

        <header class="page-header">
            <h1 class="page-title">Shopping Cart</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active">Shopping Cart</li>
            </ol>

        </header>

        <!-- Breadcrumb End-->
		
<div class="row">
<!--Middle Part Start-->
<div id="content" class="col-sm-12 shopping_cart_view">
<?php

//User Login Cart Info
if($this->session->userdata('user_type') == 'user')
{
$cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
if($cart_check>0)
{
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
            foreach ($cart_check as $item) {
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
                                <img src="<?php echo base_url() . $img_url; ?>" style="height:59px;width: 59px;"
                                     alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                     class="img-responsive img-thumbnail"/>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                            <?php
                            }
                        } else {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
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
                            echo form_hidden('cart[' . $item->product_id . '][id]',$item->product_id);
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
                    <td class="text-right">Rs. <?php echo$item->cart_price; ?></td>
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
    <div class="pull-left"><br/><br/><a href="<?php echo base_url(); ?>index.html" class="btn btn-default">Continue Shopping</a>
    </div>
    <div class="pull-right"><br/><br/><a href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary">Checkout</a></div>
	<br/><br/><br/>
</div>
<br/><br/><br/>
</div>
<!--Middle Part End -->
    <?php
}
else
{
 ?>
    <h1 class="title">Shopping Cart is empty</h1>
    <p>You have no items in your shopping cart.<br/>
        Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>
<br/><br/><br/>
</div>
    <?php
}
}
else
{


$cart_check = $this->cart->contents();
// If cart is empty, this will show below message.
if (empty($cart_check))
{
    //echo 'To add products to your shopping cart click on "Add to Cart" Button';
    ?>

    <h1 class="title">Shopping Cart is empty</h1>
    <p>You have no items in your shopping cart.<br/>
        Click <a href="<?php echo base_url(); ?>">here</a> to continue shopping</p>

<br/><br/><br/>
</div>
<?php
}else
{
// All values of cart store in "$cart".
if ($cart = $this->cart->contents()) {
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
                echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']);
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
                                <img src="<?php echo base_url() . $img_url; ?>" style="height:59px;width: 59px;"
                                     alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                     class="img-responsive img-thumbnail"/>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
                            <?php
                            }
                        } else {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                 style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                 title="<?php echo $product_name; ?>" class="img-responsive img-thumbnail"/>
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
                        //echo number_format($final_price, 2);

                        echo $final_price; ?></td>
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
    <div class="pull-left"><br/><br/><a href="<?php echo base_url(); ?>index.html" class="btn btn-default">Continue Shopping</a>
    </div>
    <div class="pull-right"><br/><br/><a href="<?php echo base_url(); ?>checkout.html" class="btn btn-primary">Checkout</a></div>
<br/><br/><br/>
</div>

</div>
<!--Middle Part End -->
<?php
}
}
?>


</div>

</div>



<!-- Footer -->
<?php require "template/footer.php"; ?>