<!-- Header -->
<?php require "template/header.php";
//echo $product_name;
$state_dd  = $this->Mdl_frontend->state_list(166);
$final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($product_name)) .'__'.$product_code. ".html";
$final_url_category = base_url() .addunderscores(strtolower($category_name)).'/'. addunderscores(strtolower($subcategory_name)) . ".html";
?>


<div class="container">
<header class="page-header">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.html">Home</a>
        </li>
        <li><a href="<?php echo $final_url_category; ?>"><?php echo ucwords($subcategory_name); ?></a>
        </li>
        <li class="active"><?php echo ucwords($product_name); ?></li>
    </ol>
</header>
<div class="row row-col-border" data-gutter="60">
<div class="col-md-9">

<?php

$product_id = $product_result[0]->id;
$product_name_ = $product_result[0]->product_name;
$product_image = $product_result[0]->product_image;
$featured_image = $product_result[0]->featured_image;
$is_new = $product_result[0]->is_new;
$product_featured = $product_result[0]->product_featured;
$product_description = $product_result[0]->product_description;
$product_price = $product_result[0]->product_price;
$discount_price = $product_result[0]->discount_price;
$total_price = $product_result[0]->total_price;
$discount_status = $product_result[0]->discount_status;
$p_category_id = $product_result[0]->category_id;
$p_subcategory_id = $product_result[0]->subcategory_id;
$product_quantity = $product_result[0]->product_quantity;
$is_enable = $product_result[0]->is_enable;
$created_date = $product_result[0]->created_date;
$created_by = $product_result[0]->created_by;
$user_type = $product_result[0]->user_type;

if($product_image != "")
{
    $image_pic = "public_html/frontend/image/product/" . $product_image;
    //echo $image_pic;
    if(file_exists($image_pic))
    {
        $img_url = "public_html/frontend/image/product/" . $product_image;
    }
    else
    {
        $img_url = 'public_html/frontend/image/default_product.jpg';
    }
}
else
{
    $img_url = 'public_html/frontend/image/default_product.jpg';
}


    ?>

    <div class="row">
        <div class="col-md-7">
            <div class="product-page-product-wrap jqzoom-stage">
                <div class="clearfix">
                    <a href="<?php echo  base_url().$img_url;?>" id="jqzoom" data-rel="gal-1">
                        <img src="<?php echo  base_url().$img_url;?>" alt="<?php echo $product_name_;?>" style="height:476px;width:476px;" title="<?php echo $product_name_;?>" />
                    </a>
                </div>
            </div>
            <ul class="jqzoom-list">
                <?php
                if($featured_image!="")
                {
                   // echo '<div class="image-additional" id="gallery_01">';
                    //  echo '<img class="img-responsive" itemprop="image" id="zoom_01" src="'.base_url().$img_url.'" title="'.$product_name_.'" alt="'.$product_name_.'" data-zoom-image="'.base_url().$img_url.'" />';
                    ?>
                    <li>
                        <a class="zoomThumbActive" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo  base_url().$img_url;?>', largeimage: '<?php echo  base_url().$img_url;?>'}">
                            <img src="<?php echo  base_url().$img_url;?>" alt="<?php echo $product_name_;?>" title="<?php echo $product_name_;?>" />
                        </a>
                    </li>
                    <?php
                    //echo $featured_image;
                    $single_image = explode(',', $featured_image);
                    foreach ($single_image as $img)
                    {

                        $image_pic_inner = "public_html/frontend/image/product/" . $img;
                        //echo $image_pic;
                        if(file_exists($image_pic_inner))
                        {
                            $img_url_inner = $image_pic_inner;
                        }
                        else
                        {
                            $img_url_inner = 'public_html/frontend/image/no_image.png';
                        }

                        //  echo $img . "<br/>";
                        ?>
                        <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo  base_url().$img_url_inner;?>', largeimage: '<?php echo  base_url().$img_url_inner;?>'}">
                                <img src="<?php echo  base_url().$img_url_inner;?>" alt="<?php echo $product_name_;?>" title="<?php echo $product_name_;?>" />
                            </a>
                        </li>

                    <?php
                    }


                }else {
                    ?>
                    <li>
                        <a class="zoomThumbActive" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo  base_url().$img_url;?>', largeimage: '<?php echo  base_url().$img_url;?>'}">
                            <img src="<?php echo  base_url().$img_url;?>" alt="<?php echo $product_name_;?>" title="<?php echo $product_name_;?>" />
                        </a>
                    </li>

                <?php
                }
                ?>


            </ul>
        </div>
        <div class="col-md-5">
            <div class="_box-highlight">
                <!--<ul class="product-page-product-rating">
                    <li class="rated"><i class="fa fa-star"></i>
                    </li>
                    <li class="rated"><i class="fa fa-star"></i>
                    </li>
                    <li class="rated"><i class="fa fa-star"></i>
                    </li>
                    <li class="rated"><i class="fa fa-star"></i>
                    </li>
                    <li class="rated"><i class="fa fa-star"></i>
                    </li>
                </ul>
                <p class="product-page-product-rating-sign"><a href="#">238 customer reviews</a>
                </p>-->
                <h1><?php echo $product_name_; ?></h1>
                <p class="product-page-price">
                    <?php if($discount_status ==1)
                    {
                        echo '<del>Rs. '.$product_price.'</del><br/>Rs. '.$total_price.'';

                    }else
                    {
                        echo 'Rs. '.$total_price.'';

                    }
                    ?>


                </p>




                <p class="product-page-desc-lg"><?php echo substr($product_description,0,250); ?></p>
                <?php
                if($product_quantity > 0)
                {
                    echo '<p><b>Availability:</b> <span class="instock">In Stock</span></p>';
                }else
                {
                    echo '<p><b>Availability:</b> <span class="instock">Out Stock</span></p>';
                }
                ?>
				<div class="button-group">
                        <!--<form action="" method="post">-->
                        <form class="cart-submit-home">
                        
<input type="hidden" name="id" value="<?php echo $product_id; ?>">

<input type="hidden" name="name" value="<?php echo $product_name_; ?>">

<input type="hidden" name="price" value="<?php echo $total_price;?>">

<input type="hidden" name="image" value="<?php echo $product_image;?>">
                            <button class="btn-primary" type="submit" onclick=""><span>Add to Cart</span></button>
                                                </form>
                                                <div class="add-to-links">
                            <!--  <button type="button" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart"></i></button>-->
                        </div>
                    </div>
                <?php
                if($user_type == "seller")
                {
                    $company = $this->Mdl_frontend->get_relation_pax('seller_list','company','id',$created_by);
                   // $last_name = $this->Mdl_frontend->get_relation_pax('seller_list','lastname','id',$created_by);
                    echo '<p><b>Seller:</b> <span class="instock">'.$company.'</span></p>';
                }
                ?>
            </div>
        </div>
    </div>
<?php

?>
<div class="gap"></div>
<div class="tabbable product-tabs">
    <ul class="nav nav-tabs" id="myTab">
        <?php
        if($product_description!='')
        {
            echo '<li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>';
        }
        if($product_featured!='')
        {
            echo '<li><a href="#tab-specification" data-toggle="tab">Specification</a></li>';

        }
        ?>


    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab-description">
            <div>
                <?php echo $product_description; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-specification">
            <?php echo $product_featured; ?>
        </div>
    </div>
</div>
<div class="gap"></div>
<h3 class="widget-title">You Might Also Like</h3>
<div class="row row-sm-gap" data-gutter="10">
<?php
$product_list_related = $this->Mdl_frontend->get_product_list($category_id,$subcategory_id,10);
if($product_list_related > 0)
{

    foreach ($product_list_related as $prod)
    {
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
        $user_type = $prod->user_type;
        //$final_url_product=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).'/'.addunderscores(strtolower($product_name)).".html";
        $final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($product_name)) .'__'.$product_code. ".html";
        // $final_url1=base_url().addunderscores(strtolower($scat_name)).".html";
        // echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
        ?>
        <div class="col-md-3">
            <div class="product product-sm-left ">

                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <?php
                    if($product_image != "")
                    {
                        $img_url = "public_html/frontend/image/product/" . $product_image;
                        if (file_exists($img_url)) {
                            ?>
                            <img src="<?php echo  base_url() .$img_url; ?>" style="height: 59px;width: 59px;"
                                 alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                 class="product-img"/>
                        <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                 style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                                 title="<?php echo $product_name; ?>" class="product-img"/>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                             style="height: 59px;width: 59px;" alt="<?php echo $product_name; ?>"
                             title="<?php echo $product_name; ?>" class="product-img"/>
                    <?php
                    }
                    ?>

                </div>
                <a class="product-link" href="<?php echo $final_url_product; ?>"></a>
                <div class="product-caption">
                    <!--<ul class="product-caption-rating">
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>-->
                    <h5 class="product-caption-title"><?php echo substr($product_name,0,35);?></h5>
                    <div class="product-caption-price">
                        <?php if($discount_status ==1)
                        {
                            ?>
                            <span class="product-caption-price-old">Rs. <?php echo $product_price;?></span>
                            <span class="product-caption-price-new">Rs. <?php echo $total_price;?></span>
                        <?php
                        }else
                        {
                            ?>
                          <span class="product-caption-price-new"> Rs. <?php echo $total_price;?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    <?php
    }
}
?>

    </div>

</div>
 <?php require "template/nav_right.php"; ?>

<!--<div class="col-md-3" style="padding: 0px 10px;">
    <div id="returning_account" style="">
        <form class="form-horizontal" id="validateCheckout" action="<?php echo base_url(); ?>checkout_submit.html" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">ORDER FORM</h4>
                </div>
                <div class="panel-body">
                    <fieldset id="account">
<?php
//$user_detail = $this->Mdl_frontend->_get_user_detail($this->session->userdata('id'));
?>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <input type="text" class="form-control" id="fname" <?php //if($this->session->userdata('user_type')=='user'){ echo "readonly"; } ?> placeholder="Name" value="<?php //echo $user_detail[0]->firstname; ?>" name="fname">
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <div class="email_register">
                                <input type="email" class="form-control" <?php //if($this->session->userdata('user_type')=='user'){ echo "readonly"; } ?> value="<?php //echo $user_detail[0]->email; ?>"  id="email_checkout" placeholder="E-Mail" name="email_checkout">
                            </div>
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <input type="number" class="form-control" id="qty" placeholder="Quantity" value="" name="qty">
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <input type="text" class="form-control" id="phone" placeholder="Phone" value="<?php //echo $user_detail[0]->telephone; ?>" name="phone">
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <textarea rows="4" class="form-control" id="address" placeholder="Address" name="address"><?php //echo $user_detail[0]->address; ?></textarea>
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <?php
                            /* echo form_dropdown
                            (
                                'state_id',
                                $state_dd,$user_detail[0]->state_id,
                                'class	= "form-control city_get"
			id     	= "state_id" placeholder="State"'); */
                            ?>
                        </div>
                        <div class="form-group1 form-group required" style="margin:10px 0px !important;">

                            <select name="city_id" id="city_id" placeholder="City"   class="form-control city_id" >

                                <?php
                              /*   if($this->session->userdata('user_type')=='user')
                                {
                                    $city_name = $this->Mdl_frontend->get_relation_pax('city_list','title','id',$user_detail[0]->city_id);
                                    if($user_detail[0]->city_id >0 )
                                    {
                                        echo '<option value='.$user_detail[0]->city_id.'>'.$city_name.'</option>';
                                    }
                                }else
                                {
                                    ?>
                                    <option value="">Select City</option>
                                <?php
                                } */
                                ?>
                            </select>
                            <input type="hidden" name="user_id" id="user_id" value="<?php //echo $this->session->userdata('id'); ?>" />
                            <input type="hidden" name="seller_id" id="seller_id" value="<?php //if($product_result[0]->user_type == "seller"){ echo $product_result[0]->created_by; } ?>" />
                            <input type="hidden" name="product_id" id="proudct_id" value="<?php //echo $product_result[0]->id; ?>" />
                            <input type="hidden" name="product_price" id="product_price" value="<?php //echo $product_result[0]->total_price; ?>" />
                            <input type="hidden" name="shipping_charges" id="shipping_charges" value="300" />
                        </div>
                        <label class="control-label" for="confirm_agree" style="margin:10px 0px !important;">
                            <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm_agree">
                            <span> I accept <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>

                        <label class="control-label" for="confirm_agree" style="margin:10px 0px !important;text-align: left;">
                            <input type="checkbox" value="1" required="" class="validate required" id="shipping_agree" name="shipping_agree">
                            <span> 300 Rs. delivery charges for 30 days </span> </label>

                        <p class="control-label show_total" for="confirm_agree" style="margin:10px 0px !important;text-align: center;font-size: 24px;font-weight: 700;line-height: 1em;margin-bottom: 1px;">
                           Order Total:<br/>
                            <?php
                                //echo 'Rs. '.$product_result[0]->total_price.'';
                              ?>
                          </p>


                        <div class="buttons">
                            <div style="text-align: center;">
                                <input type="submit" class="btn btn-primary" id="confirm_order" value="Confirm Order">
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </form>
    </div>

</div>-->


</div>
</div>
<div class="gap"></div>

<script type="text/javascript">
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


    $(document).on("blur",'#qty',function()
    {
        var price = $("#product_price").val();
        var shipping = $("#shipping_charges").val();
        if($("#qty").val() == "")
        {
            var qty = 1;
        }
        else
        {
            var qty = $("#qty").val();
        }

        var total = (parseInt(qty) * parseInt(price)) + parseInt(shipping);
        if($("#shipping_agree"). prop("checked") == true)
        {
            $(".show_total").html("Order Total:<br/>"+total);
        }
        else
        {
            $(".show_total").html("Order Total:<br/>"+(qty * price));
        }
    });

    $("input[name='shipping_agree']").on("click", function() {
        //alert($(this).val());
        var price = $("#product_price").val();
        var shipping = $("#shipping_charges").val();
        if($("#qty").val() == "")
        {
            var qty = 1;
        }
        else
        {
            var qty = $("#qty").val();
        }

        var total = (parseInt(qty) * parseInt(price)) + parseInt(shipping);
       if($(this). prop("checked") == true)
       {
           $(".show_total").html("Order Total:<br/>"+total);
       }
       else
       {
           $(".show_total").html("Order Total:<br/>"+(qty * price));
       }




    });
    jQuery(function($) {


        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");

        //Form Validation CheckOut
        $(document).on("click", '#confirm_order', function () {
            //alert('Order Button Click');
            $('#validateCheckout').validate(
                {
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        fname: {
                            required: true,
                            lettersonly: true
                        },
                        email_checkout: {
                            required: true,
                            email: true
                        },
                        qty: {
                            required: true
                        },
                        phone: {
                            required: true
                        },
                        address: {
                            required: true
                        },

                        state_id: {
                            required: true
                        },
                        city_id: {
                            required: true
                        },
                        confirm_agree: {
                            required: true
                        },
                        shipping_agree: {
                            required: true
                        }
                    },
                    messages: {
                        fname: {
                            required: " Name field is required.",
                            lettersonly: " Please enter only alphabetical characters."
                        },
                        phone: " Phone field is required.",
                        qty: " Quantity field is required.",

                        email_checkout: {
                            required: " E-Mail field is required.",
                            email: " Please provide a valid email address."
                        },
                        address: " Address field is required.",
                        state_id: " State field is required.",
                        city_id: " City field is required.",
                        confirm_agree: " Please accept Terms & Conditions.",
                        shipping_agree: " Please checked delivery charges.",
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


    });
</script>

<!-- Footer -->
<?php require "template/footer.php"; ?>