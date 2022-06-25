<!-- Left Part Start-->
<aside id="column-left" class="col-sm-3 hidden-xs">
<h3 class="subtitle">Categories</h3>
<div class="box-category">




    <ul id="cat_accordion">
        <?php
        // print_r($category);
        //Category List
        foreach($category as $cat)
        {

            $cat_name =  $cat->category_name;
            $cat_id =  $cat->id;
            $p_cat_id =  $cat->parent_category_id;
            $cat_image =  $cat->category_image;
            $final_url=base_url().addunderscores(strtolower($cat_name)).".html";
            echo '<li><a href="'.$final_url.'">'.$cat_name.'</a>';

            $sub_category = $this->Mdl_frontend->get_sub_category($cat_id);
            //print_r($sub_category);
            if($sub_category > 0)
            {
                echo '<span class="down"></span> <ul>';
                foreach ($sub_category as $scat) {
                    $scat_name = $scat->category_name;
                    $scat_id = $scat->id;
                    $p_scat_id = $scat->parent_category_id;
                    $scat_image = $scat->category_image;
                    $final_url1=base_url().addunderscores(strtolower($cat_name)).'/'.addunderscores(strtolower($scat_name)).".html";
                    echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
                }
                echo "</ul>";
            }
            echo '</li>';


        }

        ?>
    </ul>
    <!-- <ul>
    <ul id="cat_accordion">
         <li><a href="category.html">Men</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
             </ul>
         </li>
         <li><a href="category.html">Women</a></li>
         <li><a href="category.html">Girls</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
             </ul>
         </li>
         <li><a href="category.html">Boys</a></li>
         <li><a href="category.html">Baby</a></li>
         <li><a href="category.html">Accessories</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
     </ul>
 </li>
 <li><a href="category.html">Electronics</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Laptops</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
             </ul>
         </li>
         <li class="custom_id68"><a href="category.html">Desktops</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
             </ul>
         </li>
         <li><a href="category.html">Cameras</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
         <li><a href="category.html">Mobile Phones</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
         <li><a href="category.html">TV &amp; Home Audio</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories New</a></li>
             </ul>
         </li>
         <li><a href="category.html">MP3 Players</a></li>
     </ul>
 </li>
 <li><a href="category.html">Shoes</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Men</a></li>
         <li><a href="category.html">Women</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories</a></li>
             </ul>
         </li>
         <li><a href="category.html">Girls</a></li>
         <li><a href="category.html">Boys</a></li>
         <li><a href="category.html">Baby</a></li>
         <li><a href="category.html">Accessories</a><span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">Sub Categories</a></li>
             </ul>
         </li>
     </ul>
 </li>
 <li><a href="category.html">Watches</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Men's Watches</a></li>
         <li><a href="category.html">Women's Watches</a></li>
         <li><a href="category.html">Kids' Watches</a></li>
         <li><a href="category.html">Accessories</a></li>
     </ul>
 </li>
 <li><a href="category.html">Jewellery</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Silver</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
         <li><a href="category.html">Gold</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">test 1</a></li>
                 <li><a href="category.html">test 2</a></li>
             </ul>
         </li>
         <li><a href="category.html">Diamond</a></li>
         <li><a href="category.html">Pearl</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
         <li><a href="category.html">Men's Jewellery</a></li>
         <li><a href="category.html">Children's Jewellery</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">New Sub Categories</a></li>
             </ul>
         </li>
     </ul>
 </li>
 <li><a href="category.html">Health &amp; Beauty</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Perfumes</a></li>
         <li><a href="category.html">Makeup</a></li>
         <li><a href="category.html">Sun Care</a></li>
         <li><a href="category.html">Skin Care</a></li>
         <li><a href="category.html">Eye Care</a></li>
         <li><a href="category.html">Hair Care</a></li>
     </ul>
 </li>
 <li><a href="category.html">Kids &amp; Babies</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Toys</a></li>
         <li><a href="category.html">Games</a> <span class="down"></span>
             <ul>
                 <li><a href="category.html">test 25</a></li>
             </ul>
         </li>
         <li><a href="category.html">Puzzles</a></li>
         <li><a href="category.html">Hobbies</a></li>
         <li><a href="category.html">Strollers</a></li>
         <li><a href="category.html">Health &amp; Safety</a></li>
     </ul>
 </li>
 <li><a href="category.html">Sports</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Cycling</a></li>
         <li><a href="category.html">Running</a></li>
         <li><a href="category.html">Swimming</a></li>
         <li><a href="category.html">Football</a></li>
         <li><a href="category.html">Golf</a></li>
         <li><a href="category.html">Windsurfing</a></li>
     </ul>
 </li>
 <li><a href="category.html">Home &amp; Garden</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Bedding</a></li>
         <li><a href="category.html">Food</a></li>
         <li><a href="category.html">Furniture</a></li>
         <li><a href="category.html">Kitchen</a></li>
         <li><a href="category.html">Lighting</a></li>
         <li><a href="category.html">Tools</a></li>
     </ul>
 </li>
 <li><a href="category.html">Wines &amp; Spirits</a> <span class="down"></span>
     <ul>
         <li><a href="category.html">Wine</a></li>
         <li><a href="category.html">Whiskey</a></li>
         <li><a href="category.html">Vodka</a></li>
         <li><a href="category.html">Liqueurs</a></li>
         <li><a href="category.html">Beer</a></li>
     </ul>
 </li>
</ul>-->
</div>
<h3 class="subtitle">Bestsellers</h3>
<div class="side-item">
<?php
    $product_list_bestsellers = $this->Mdl_frontend->get_product_sidebar_list('id','random',10);
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
            <div class="product-thumb clearfix">


                <div class="image"><a href="<?php echo $final_url_product; ?>">
                        <?php
                        if($product_image != "")
                        {
                            $img_url = "public_html/frontend/image/product/" . $product_image;
                            if (file_exists($img_url)) {
                                ?>
                                <img src="<?php echo  base_url() .$img_url; ?>" style="height: 50px;width: 50px;"
                                     alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                     class="img-responsive"/>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 50px;width: 50px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="img-responsive"/>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                 style="height: 50px;width: 50px;" alt="<?php echo $product_name; ?>"
                                 title="<?php echo $product_name; ?>" class="img-responsive"/>
                        <?php
                        }
                        ?>
                    </a>
                </div>



                <div class="caption">
                    <h4><a href="<?php echo $final_url_product; ?>"> <?php echo substr($product_name,0,35);?> </a></h4>

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
                  <!--  <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>-->
                </div>
            </div>
        <?php
        }
    }
    ?>

</div>
<h3 class="subtitle">Specials</h3>
<div class="side-item">
    <?php
    $product_list_specials = $this->Mdl_frontend->get_product_sidebar_list('id','asc',10);
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
            <div class="product-thumb clearfix">


                <div class="image"><a href="<?php echo $final_url_product; ?>">
                        <?php
                        if($product_image != "")
                        {
                            $img_url = "public_html/frontend/image/product/" . $product_image;
                            if (file_exists($img_url)) {
                                ?>
                                <img src="<?php echo  base_url() .$img_url; ?>" style="height: 50px;width: 50px;"
                                     alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>"
                                     class="img-responsive"/>
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                     style="height: 50px;width: 50px;" alt="<?php echo $product_name; ?>"
                                     title="<?php echo $product_name; ?>" class="img-responsive"/>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo base_url() . '/public_html/frontend/image/no_image.png'; ?>"
                                 style="height: 50px;width: 50px;" alt="<?php echo $product_name; ?>"
                                 title="<?php echo $product_name; ?>" class="img-responsive"/>
                        <?php
                        }
                        ?>
                    </a>
                </div>



                <div class="caption">
                    <h4><a href="<?php echo $final_url_product; ?>"> <?php echo substr($product_name,0,35);?> </a></h4>

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
                    <!--<div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>-->
                </div>
            </div>
        <?php
        }
    }
    ?>

</div>

<!--
<div class="list-group">
    <h3 class="subtitle">Custom Content</h3>
    <p>This is a CMS block edited from admin. You can insert any content (HTML, Text, Images) Here. </p>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
</div>
<div class="banner owl-carousel">
    <div class="item"> <a href="#"><img src="<?php //echo base_url();?>/public_html/frontend/image/banner/small-banner1-265x350.jpg" alt="small banner" class="img-responsive" /></a> </div>
    <div class="item"> <a href="#"><img src="<?php //echo base_url();?>/public_html/frontend/image/banner/small-banner-265x350.jpg" alt="small banner1" class="img-responsive" /></a> </div>
</div>-->
<!--
<h3 class="subtitle">Latest</h3>
<div class="side-item">
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/iphone_6-50x50.jpg" alt="Hair Care Cream for Men" title="Hair Care Cream for Men" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Hair Care Cream for Men</a></h4>
            <p class="price"> $134.00 </p>
            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/nikon_d300_5-50x50.jpg" alt="Hair Care Products" title="Hair Care Products" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Hair Care Products</a></h4>
            <p class="price"> <span class="price-new">$66.80</span> <span class="price-old">$90.80</span> <span class="saving">-27%</span> </p>
            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/nikon_d300_4-50x50.jpg" alt="Bed Head Foxy Curls Contour Cream" title="Bed Head Foxy Curls Contour Cream" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Bed Head Foxy Curls Contour Cream</a></h4>
            <p class="price"> $88.00 </p>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/macbook_5-50x50.jpg" alt="Shower Gel Perfume for Women" title="Shower Gel Perfume for Women" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Shower Gel Perfume for Women</a></h4>
            <p class="price"> <span class="price-new">$95.00</span> <span class="price-old">$99.00</span> <span class="saving">-4%</span> </p>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/macbook_4-50x50.jpg" alt="Perfumes for Women" title="Perfumes for Women" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Perfumes for Women</a></h4>
            <p class="price"> $85.00 </p>
            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/macbook_3-50x50.jpg" alt="Make Up for Naturally Beautiful Better" title="Make Up for Naturally Beautiful Better" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Make Up for Naturally Beautiful Better</a></h4>
            <p class="price"> $123.00 </p>
        </div>
    </div>
    <div class="product-thumb clearfix">
        <div class="image"><a href="product.html"><img src="<?php //echo base_url();?>/public_html/frontend/image/product/macbook_2-50x50.jpg" alt="Pnina Tornai Perfume" title="Pnina Tornai Perfume" class="img-responsive" /></a></div>
        <div class="caption">
            <h4><a href="product.html">Pnina Tornai Perfume</a></h4>
            <p class="price"> $110.00 </p>
        </div>
    </div>
</div>-->
</aside>
<!-- Left Part End-->



