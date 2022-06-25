<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php echo base_url();?>/public_html/frontend/image/favicon.png" rel="icon" />
    <title>Farjee - Online Shopping</title>
    <meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
    <!-- CSS Part Start-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/js/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/css/owl.transitions.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/css/responsive.css" />
   <!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>  -->
    <!-- CSS Part End-->
    <script type="text/javascript" src="<?php echo base_url();?>/public_html/frontend/js/jquery-2.1.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/public_html/frontend/js/swipebox/src/css/swipebox.min.css">


    <script src="<?php echo base_url('public_html/assets/js/jquery.validate.min.js')?>">        </script>

    <!-- Date Picker -->

    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/css/datepicker.css')?>" />

    <style >
        .current
        {
            background-color: #3e7cb4 !important;
            color:#fff !important;
        }
    </style>


    <script>
    $(document).ready(function() {
        $(".cart-submit-home").submit(function (e)
        {
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
            }).done(function (data)
            {
                //0 item(s) - Rs. 0
                //console.log(data);
                var final_total= (data.total_amount+200);
                $("#cart-total").html(data.total_items+' item(s) - Rs.'+final_total);
                button_content.html('Adding...'); //reset button text to original text

            })
            e.preventDefault();
        });

        $('.shopping-cart-box').click(function()
        {
            $.ajax({ //make ajax request to cart_process.php
                url: "<?php echo base_url();?>Frontend/product_view_card",
                type: "POST",
                dataType: "html", //expect json value from server
                data: ''
            }).done(function (data)
            {
                //$("#cart").addClass('open');
                //$(this).attr('aria-expanded',true);


                //0 item(s) - Rs. 0
                //console.log(data);
                $("#cart_result").html(data);
                //button_content.html('Adding...'); //reset button text to original text
                $.ajax({ //make ajax request to cart_process.php
                    url: "<?php echo base_url();?>Frontend/product_view_card_show/",
                    type: "POST",
                    dataType: "html", //expect json value from server
                    data: ''
                }).done(function (data) {
                    $(".shopping_cart_view").html(data);
                });

            });
           // e.preventDefault();

        });

        //Remove Product


    });
    </script>
</head>
<body>
<div class="wrapper-wide">
<div id="header">

<?php

//print_r($nav);


?>
<!-- Top Bar Start-->
<nav id="top" class="htop">
    <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
            <div class="pull-left flip left-top">
                <div class="links">
                    <ul>
                        <li class="mobile"><i class="fa fa-phone"></i>+91 9898777656</li>
                        <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>info@marketshop.com</a></li>
                    </ul>
                </div>
            </div>
            <div id="top-links" class="nav pull-right flip">
                <ul>
                    <?php
                    if($this->session->userdata('user_type')=='user')
                    {
                        ?>
                        <li>Welcome <?php echo $this->session->userdata('firstname')." ".$this->session->userdata('lastname'); ?></li>
                        <li><a href="<?php echo base_url(); ?>account.html">My Account</a></li>
                        <li><a href="<?php echo base_url(); ?>cart.html">My Cart</a></li>
                        <li><a href="<?php echo base_url(); ?>checkout.html">Checkout</a></li>
                        <li><a href="<?php echo base_url(); ?>logout.html">Logout</a></li>
                        <?php
                    }else
                    {
                        ?>
                        <li><a href="<?php echo base_url(); ?>login.html">Login</a></li>
                        <li><a href="<?php echo base_url(); ?>register.html">Register</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Top Bar End-->
<!-- Header Start-->
<header class="header-row">
    <div class="container">
        <div class="table-container">
            <!-- Logo Start -->
            <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
                <div id="logo">
                    <a href="<?php echo base_url(); ?>index.html">
                       <!-- <img class="img-responsive" src="<?php //echo base_url();?>/public_html/frontend/image/logo.png" title="MarketShop" alt="MarketShop">-->
                        Farjee - Online Shopping
                    </a></div>
            </div>
            <!-- Logo End -->
            <!-- Mini Cart Start-->
            <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">


                <div id="cart">
                    <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle shopping-cart-box">
                        <span class="cart-icon pull-left flip"></span>
                        <span id="cart-total">
                            <?php
                            //User Session Cart
                            if($this->session->userdata('user_type')=='user')
                            {
                                //echo "YES";
                                $cart_check = $this->Mdl_frontend->get_card_total($this->session->userdata('id'));
                               //print_r($cart_check);
                                if($cart_check>0)
                                {
                                    $i_top = 0;
                                    $grand_total_top = 0;
                                    foreach ($cart_check as $item1) {
                                        $i_top++;
                                        $grand_total_top += ($item1->cart_qty *  $item1->cart_price);
                                    }
                                    echo $i_top." item(s) - Rs.".($grand_total_top+200);
                                }
                                else
                                {
                                    echo "0 item(s) - Rs. 0";
                                }
                            }
                            else
                            {
                                $cart_check = $this->cart->contents();
                                $i_top = 0;
                                $grand_total_top = 0;
                                foreach ($cart_check as $item1)
                                {
                                    $i_top++;
                                    $grand_total_top += $item1['subtotal'];

                                }
                                if($grand_total_top > 0)
                                {
                                    echo $i_top." item(s) - Rs.".($grand_total_top+200);
                                }
                                else
                                {
                                    echo "0 item(s) - Rs. 0";
                                }
                            }


                            ?>
                        </span></button>
                    <ul id="cart_result" class="dropdown-menu">



                    </ul>

                </div>
            </div>
            <!-- Mini Cart End-->
            <!-- Search Start-->
            <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
                <div id="search" class="input-group">
                    <form class="form-horizontal" action="<?php echo base_url(); ?>search.html" method="post">

                    <input id="search" type="text" name="search" value="" placeholder="Search" class="form-control input-lg">
                    <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- Search End-->
        </div>
    </div>
</header>
<!-- Header End-->


<!-- Main Menu Start-->
<div class="container">
<nav id="menu" class="navbar">
<div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav">
<li><a class="home_link" title="Home" href="index.html"><span>Home</span></a></li>
<li class="mega-menu dropdown sub"><a>Categories</a>
<span class="submore"></span><div class="dropdown-menu" style="margin-left: -43px; display: none;">
<?php
function addunderscores($res)
{
    $abc =  str_replace(' ','_',$res);
    return  str_replace(',','--',$abc);
}

function addunderscores_product($res)
{
    $search = array(',', '+', '.','&','/','#','\"','\'','(',')');
    $str = str_replace($search, '', $res);
    $abc =  str_replace(' ','',$str);
    return  $abc;
}

function removeunderscores_cart($res)
{
    $search = array(',', '+', '.','&','/','#','"','\'','(',')');
    $str = str_replace($search, '', $res);
    //$abc =  str_replace(' ','',$str);
    return  $str;
}

//Category List
foreach($category as $cat)
{
    $cat_name = $cat->category_name;
    $cat_id = $cat->id;
    $p_cat_id = $cat->parent_category_id;
    $cat_image = $cat->category_image;



    $sub_category = $this->Mdl_frontend->get_sub_category($cat_id);
    //print_r($sub_category);
    if($sub_category > 0)
    {
        $final_url=base_url().addunderscores(strtolower($cat_name)).".html";
        //echo $final_url;
        ?>
<div class="column col-lg-2 col-md-3"><a href="<?php echo $final_url; ?>" ><?php echo ucwords($cat_name); ?></a>
<?php
        echo '<span class="submore"></span><div>
        <ul>';
        foreach ($sub_category as $scat) {
            $scat_name = $scat->category_name;
            $scat_id = $scat->id;
            $p_scat_id = $scat->parent_category_id;
            $scat_image = $scat->category_image;
            //$final_url1=base_url().'category/'.addunderscores(strtolower($scat_name)).".html";
            $final_url1=base_url().addunderscores(strtolower($cat_name)).'/'.addunderscores(strtolower($scat_name)).".html";
            echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
        }
        echo "</ul></div>";
        echo '</div>';
    }



}
?>
</li>




<li class="custom-link"><a href="about_us.html">About Us</a></li>

<li class="contact-link"><a href="contact_us.html">Contact Us</a></li>
<!--<li class="custom-link-right"><a href="#" target="_blank"> Buy Now!</a></li>-->
</ul>
</div>
</nav>
</div>
<!-- Main Menu End-->
</div>

  