<!-- Header -->
<?php require "template/header.php"; ?>

<div id="container">
<div class="container">
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.html"><i class="fa fa-home"></i></a></li>
    <li><a href="#">Search</a></li>
</ul>
<script type="text/javascript">
    $(document).ready(function() {
        $(".cart-submit-product").submit(function (e) {
            //alert("Item added to Carasdasdasdt!");
            var form_data = $(this).serialize();
            //alert(form_data);
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Adding...'); //Loading button text

            $.ajax({ //make ajax request to cart_process.php
                url: "<?php echo base_url();?>Frontend/product_add_card",
                type: "POST",
                dataType: "json", //expect json value from server
                data: form_data
            }).done(function (data) {
                //0 item(s) - Rs. 0
                //console.log(data);
                $("#cart-total").html(data.total_items + ' item(s) - Rs.' + data.total_amount);
                button_content.html('Adding...'); //reset button text to original text

            })
            e.preventDefault();
        });
    });
</script>
<!-- Breadcrumb End-->
<div class="row">

<!--Middle Part Start-->
<div id="content" class="col-sm-12">
<h1 class="title">Search - <?php echo ucwords($search_title); ?></h1>
    <label>Search Criteria</label>
    <div class="row">
        <form class="form-horizontal" action="<?php echo base_url(); ?>search.html" method="post">
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Search" value="<?php echo ucwords($search_title); ?>" id="search" name="search">
            </div>
            <div class="col-sm-3">
                <input type="submit" class="btn btn-primary" id="button-search" value="Search">
            </div>
        </form>
    </div>
    <br/>
<div class="product-filter">
    <div class="row">
        <div class="col-md-4 col-sm-5">
            <div class="btn-group">
                <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="List"><i class="fa fa-th-list"></i></button>
                <button type="button" id="grid-view" class="btn btn-default selected" data-toggle="tooltip" title="" data-original-title="Grid"><i class="fa fa-th"></i></button>
            </div>
            <a href="#"><?php echo ucwords($search_title); ?></a> </div>

    </div>
</div>
<br/>

<?php


if($product_list > 0)
{
    echo '<div class="row products-category">';
    foreach ($product_list as $prod) {
        $product_id = $prod->id;
        $product_code = $prod->product_code;
        $product_name = $prod->product_name;
        $product_image = $prod->product_image;
        $featured_image = $prod->featured_image;
        $is_new = $prod->is_new;
        $product_featured = $prod->product_featured;
        $product_description = $prod->product_description;
        $product_price = $prod->product_price;
        $discount_price = $prod->discount_price;
        $total_price = $prod->total_price;
        $discount_status = $prod->discount_status;
        $p_category_id = $prod->category_id;
        $p_subcategory_id = $prod->subcategory_id;
        $product_quantity = $prod->product_quantity;
        $is_enable = $prod->is_enable;
        $created_date = $prod->created_date;
        $created_by = $prod->created_by;
        //$final_url_product=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).'/'.addunderscores(strtolower($product_name)).".html";
        $final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($product_name)) .'__'.$product_code. ".html";
        // $final_url1=base_url().addunderscores(strtolower($scat_name)).".html";
        // echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
        ?>

        <div class="product-layout product-grid col-lg-5ths col-md-5ths col-sm-3 col-xs-12">
            <div class="product-thumb">
                <div class="image"><a href="<?php echo $final_url_product; ?>">
                        <?php
                        if($product_image != "")
                        {
                            $img_url = "public_html/frontend/image/product/" . $product_image;
                            if (file_exists($img_url)) {
                                ?>
                                <img src="<?php echo  base_url() .$img_url; ?>" style="height: 147px;width: 147px;"
                                     alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                     class="img-responsive"/>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 147px;width: 147px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="img-responsive"/>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                 style="height: 147px;width: 147px;" alt="<?php echo $product_name; ?>"
                                 title="<?php echo $product_name; ?>" class="img-responsive"/>
                        <?php
                        }
                        ?>
                    </a>
                </div>
                <div>
                    <div class="caption">
                        <h4><a href="<?php echo $final_url_product; ?>"> <?php echo substr($product_name,0,35);?> </a></h4>
                        <p class="description"> <?php echo substr($product_description,0,35);?></p>
                        <p class="price">
                            <?php if($discount_status ==1)
                            {
                                ?>
                                <span class="price-new"> Rs. <?php echo $total_price;?></span>
                                <span class="price-old"> Rs. <?php echo $product_price;?></span>
                                <span class="saving"><?php echo $discount_price;?>%</span>
                            <?php
                            }else
                            {
                                ?>
                                <span class="price-new"> Rs. <?php echo $total_price;?></span>
                            <?php
                            }
                            ?>
                        </p>
                    </div>
                    <div class="button-group">
                        <form class="cart-submit-product">
                            <?php
                            $card_product = removeunderscores_cart($product_name);
                            // Create form and send values in 'shopping/add' function.
                            // echo form_open(base_url('Frontend/product_add_card'));
                            echo form_hidden('id', $product_id);
                            echo form_hidden('name', $card_product);
                            echo form_hidden('price', $total_price);
                            echo form_hidden('image', $product_image);
                            ?>
                            <button class="btn-primary" type="submit" onclick=""><span>Add to Cart</span></button>
                            <?php
                            /*$btn = array(
                                'class' => 'fg-button teal btn-primary',
                                'value' => 'Add to Cart',
                                'name' => 'action'
                            );


                            // Submit Button.
                            echo form_submit($btn);*/
                            // echo form_close();
                            ?>
                        </form>
                        <div class="add-to-links">
                            <!-- <button type="button" data-toggle="tooltip" title="" onclick="" data-original-title="Add to Wish List"><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                             <button type="button" data-toggle="tooltip" title="" onclick="" data-original-title="Compare this Product"><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }
    echo '</div><br/>';

}
else
{
    ?>
<p>No Record Found!</p>
    <?php
}



?>


<div class="col-sm-6 text-left">
</div>
<div class="col-sm-6 text-right">
    <ul class="pagination">
        <?php
        foreach ($links as $link)
        {
            echo "<li>". $link."</li>";
        }
        ?>
    </ul>
</div>
<!-- Show pagination links -->


</div>
<!--Middle Part End -->

</div>
</div>
</div>



<!-- Footer -->
<?php require "template/footer.php"; ?>