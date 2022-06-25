<div class="col-md-3">
    <h4 class="widget-title-sm">Recently Viewed</h4>
    <ul class="product-list">

        <?php
        $product_list_bestsellers = $this->Mdl_frontend->get_product_sidebar_list('id','random',3);
        if($product_list_bestsellers > 0)
        {

            foreach ($product_list_bestsellers as $prod)
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
                //$final_url_product=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).'/'.addunderscores(strtolower($product_name)).".html";
                $final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($product_name)) .'__'.$product_code. ".html";
                // $final_url1=base_url().addunderscores(strtolower($scat_name)).".html";
                // echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
                ?>


                <li>
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <?php
                            if($product_image != "")
                            {
                                $img_url = "public_html/frontend/image/product/" . $product_image;
                                if (file_exists($img_url)) {
                                    ?>
                                    <img src="<?php echo  base_url() .$img_url; ?>" style="height: 74px;width: 74px;"
                                         alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                         class="product-img"/>
                                <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                         style="height: 74px;width: 74px;" alt="<?php echo $product_name; ?>"
                                         title="<?php echo $product_name; ?>" class="product-img"/>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 74px;width: 74px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="product-img"/>
                            <?php
                            }
                            ?>



                        </div>
                        <a class="product-link" href="<?php echo $final_url_product; ?>"></a>
                        <div class="product-caption">

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
                                    <span class="product-caption-price-new">Rs. <?php echo $total_price;?></span>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php
            }
        }
        ?>



   </ul>
    <div class="gap gap-small"></div>
    <h4 class="widget-title-sm">Recommended to You</h4>
    <ul class="product-list">

        <?php
        $product_list_specials = $this->Mdl_frontend->get_product_sidebar_list('id','asc',3);
        if($product_list_specials > 0)
        {

            foreach ($product_list_specials as $prod)
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
                //$final_url_product=base_url().addunderscores(strtolower($category_name)).'/'.addunderscores(strtolower($scat_name)).'/'.addunderscores(strtolower($product_name)).".html";
                $final_url_product = base_url() . 'product/' . addunderscores_product(strtolower($product_name)) .'__'.$product_code. ".html";
                // $final_url1=base_url().addunderscores(strtolower($scat_name)).".html";
                // echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
                ?>

                <li>
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <?php
                            if($product_image != "")
                            {
                                $img_url = "public_html/frontend/image/product/" . $product_image;
                                if (file_exists($img_url)) {
                                    ?>
                                    <img src="<?php echo  base_url() .$img_url; ?>" style="height: 74px;width: 74px;"
                                         alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                         class="product-img"/>
                                <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                         style="height: 74px;width: 74px;" alt="<?php echo $product_name; ?>"
                                         title="<?php echo $product_name; ?>" class="product-img"/>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 74px;width: 74px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="product-img"/>
                            <?php
                            }
                            ?>



                        </div>
                        <a class="product-link" href="<?php echo $final_url_product; ?>"></a>
                        <div class="product-caption">

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
                                    <span class="product-caption-price-new">Rs. <?php echo $total_price;?></span>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </li>




               <?php
            }
        }
        ?>



   </ul>
    <div class="gap gap-small"></div>

</div>
