<!-- Header -->
<?php
//echo "<pre>";
//print_r($category);
require "template/header1.php";
$category_url=base_url().addunderscores(strtolower($category_name)).".html";
?>

<div class="container">
    <header class="page-header">
        <h1 class="page-title"><?php echo ucwords($category_name); ?></h1>
        <ol class="breadcrumb page-breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.html">Home</a>
            </li>
            <li class="active"><?php echo ucwords($category_name); ?></li>
        </ol>

    </header>



    <?php

    foreach($subcategory_result as $sub_cate)
    {
        $scat_name =  $sub_cate->category_name;
        $scat_id =  $sub_cate->id;
        $p_cat_id =  $sub_cate->parent_category_id;
        $cat_image =  $sub_cate->category_image;
        $final_url1=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).".html";
        ?>
        <h3 class="subtitle"><?php echo ucwords($scat_name); ?> - <a class="viewall" href="<?php echo $final_url1; ?>">view all</a></h3>
        <?php
        $product_list = $this->Mdl_frontend->get_product_list($category_id,$scat_id,'',4);
        // print_r($product_list);
        if($product_list > 0)
        {
           // print_r($product_list);
            echo '<div class="row" data-gutter="15" style="margin-bottom: 15px !important;">';
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
                $user_type = $prod->user_type;
                //$final_url_product=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).'/'.addunderscores(strtolower($product_name)).".html";
                $final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($prod->product_name)).'__'.$product_code. ".html";
                // $final_url1=base_url().addunderscores(strtolower($scat_name)).".html";
                // echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
                //print_r($product_list);
                ?>


                <div class="col-md-3">
                    <div class="product ">
                        <ul class="product-labels">
                            <?php
                            if($discount_status ==1)
                            {
                                echo "<li>".$discount_price."%</li>";
                            }
                            if($user_type == "seller")
                            {
                                $company = $this->Mdl_frontend->get_relation_pax('seller_list','company','id',$created_by);
                               // $last_name = $this->Mdl_frontend->get_relation_pax('seller_list','lastname','id',$created_by);
                                echo "<li>".$company."</li>";
                            }
                            ?>
                        </ul>
                        <div class="product-img-wrap" style='height:204px'>
						<a class="" href="<?php echo $final_url_product; ?>">

                            <?php
                            if($product_image != "")
                            {
                                $img_url = "public_html/frontend/image/product/" . $product_image;
                                //echo $img_url;
                                if (file_exists($img_url)) {
                                    // echo "YES";
                                    ?>
                                    <img src="<?php echo base_url() . $img_url; ?>" style="height: 204px;width: 204px;"  alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="product-img-primary"/>
                                    <img src="<?php echo base_url() . $img_url; ?>" style="height: 204px;width: 204px;"  alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="product-img-alt"/>
                                <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() . 'public_html/frontend/image/no_image.png'; ?>" style="height: 204px;width: 204px;" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="product-img-primary"/>
                                    <img src="<?php echo base_url() . 'public_html/frontend/image/no_image.png'; ?>" style="height: 204px;width: 204px;" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" class="product-img-alt"/>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo base_url() . 'public_html/frontend/image/no_image.png'; ?>" style="height: 204px;width: 204px;" alt="<?php echo $product_name; ?>"  title="<?php echo $product_name; ?>" class="product-img-primary"/>
                                <img src="<?php echo base_url() . 'public_html/frontend/image/no_image.png'; ?>" style="height: 204px;width: 204px;" alt="<?php echo $product_name; ?>"  title="<?php echo $product_name; ?>" class="product-img-alt"/>
                            <?php
                            }
                            ?>
							</a>
                        </div>
                        
                        <div class="product-caption">
                            <ul class="product-caption-rating">
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
                            </ul>
                            <h5 class="product-caption-title"><?php echo substr($product_name,0,35); ?></h5>
                            <div class="product-caption-price">

                                <?php if($discount_status ==1)
                                {
                                    ?>
                                    <span class="product-caption-price-old">Rs. <?php echo $product_price;?></span>
                                    <span class="product-caption-price-new">Rs. <?php echo $total_price;?></span>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <span class="product-caption-price-new">Rs. <?php echo $total_price;?></span>
                                <?php
                                }
                                ?>
                            </div>
							<div class="button-group">
                        <!--<form action="" method="post">-->
                        <form class="cart-submit-home">
                        
<input type="hidden" name="id" value="<?php echo $product_id; ?>">

<input type="hidden" name="name" value="<?php echo $product_name; ?>">

<input type="hidden" name="price" value="<?php echo $total_price;?>">

<input type="hidden" name="image" value="<?php echo $product_image;?>">
                            <button class="btn-primary" type="submit" onclick=""><span>Add to Cart</span></button>
                                                </form>
                                                <div class="add-to-links">
                            <!--  <button type="button" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart"></i></button>-->
                        </div>
                    </div>
                            <!--<ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>-->
                        </div>
                    </div>
                </div>


            <?php
            }
            echo '</div>';
        }

    }

    ?>

</div>
<!-- Footer -->
<?php require "template/footer.php"; ?>