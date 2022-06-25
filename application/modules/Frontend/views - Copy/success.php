<?php
require "template/header.php";

//echo $complete_name."<br/>";
//print_r($card_info);
//echo $track_order;

?>

<div id="container">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php echo ucwords('Order Success'); ?></h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active"><?php echo ucwords('Order Success'); ?></li>
            </ol>

        </header>


        <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12 shopping_cart_view">

<div style="text-align: center;"> <h3 class="title">Thank you!</h3></div>
<div style="text-align: center;"> <p>Order # <?php echo $track_order;?></p></div>
<div style="text-align: center;"> <p>We have received your order. If we need to confirm any information regarding your
        <br/> purchase, a Farjee customer service agent will call you shortly. Otherwise,<br/>
        your order will be automatically confirmed.</p></div>


            <h3 class="title">Your Order Detail</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-center">Order Number</td>
                        <td class="text-center">Order Date</td>
                        <td class="text-center">Payment Method</td>
                        <td class="text-center">Total Amount</td>
                        <td class="text-center">Address</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center"><?php echo $track_order; ?></td>
                        <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($cart_date)); ?></td>
                        <td class="text-center"><?php echo 'Cash On Delivery'; ?></td>
                        <td class="text-center">Rs. <?php echo $total_amount; ?></td>
                        <td class="text-center"><?php echo $address; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br/>
            <h3 class="title">Product</h3>
            <table class="table table-bordered">
                <tbody>
                    <?php
                    foreach ($card_info as $item) {
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
                            <td class="text-left"><?php echo $item['name']; ?><br/>
                            Quantity: <?php echo  $item['qty']; ?>
                            </td>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>
                </table>
            <h3 class="title">Track Your Order</h3>
            <p>You can track your order in My account > My orders</p>
            <div class=""><a href="<?php echo base_url(); ?>account.html" class="btn btn-primary">My Orders</a></div>
            <br/><br/>
            </div>



        </div>
    </div>
    </div>
</div>


<?php
require "template/footer.php";
?>