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
			<li><a href="<?php echo base_url(); ?>ultimate_sign.html">Ultimate Sign</a>
            </li>
            <li class="active"><?php echo ucwords($category_name); ?></li>
        </ol>

    </header>

  <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">

                <div class="row">
                    <div class="col-sm-12">
                     <?php
                    echo $category_des; 
                    ?>     
					<br/><br/>
					</div>
                </div>
             </div>
		</div>
	
	
	
	
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">

                <div class="row">
                    <div class="">
				<?php
		//Brand List
        foreach($gallery_result as $brand)
        {
            $brand_name = $brand->brand_name;
            $brand_image = $brand->brand_image;
          ?>
		  <div class="col-sm-3" style="margin:15px 0px !important;" >
		  <a style="padding:5px !important;" title="<?php echo $brand_name; ?>" href="<?php echo base_url()."/public_html/frontend/image/brand/".$brand_image; ?>" data-fancybox="images" data-srcset="<?php echo base_url()."/public_html/frontend/image/brand/".$brand_image; ?> 1600w, <?php echo base_url()."/public_html/frontend/image/brand/".$brand_image; ?> 1200w, <?php echo base_url()."/public_html/frontend/image/brand/".$brand_image; ?> 640w">
	<img style="height: 150px;width: 100%" src="<?php echo base_url()."/public_html/frontend/image/brand/".$brand_image; ?>" />
</a>
		  </div>
                               <!--<a class="banner-link" href="#"></a>
                                <div class="banner-caption-left">
                                    <h5 class="banner-title">New Jeans Collection</h5>
                                    <p class="banner-desc">Exeedingly Good Jeans</p>
                                    <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                                    </p>
                                </div>
                                <img class="banner-img" src="img/test_banner/21-i.png" alt="Image Alternative text" title="Image Title" style="bottom: -29px; right: -51px; width: 170px;">
                            </div>-->
		  <?php
		}
?>
					
                    </div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    <br/><br/><br/>
	
	
	
</div>
<!-- Footer -->
<?php require "template/footer.php"; ?>