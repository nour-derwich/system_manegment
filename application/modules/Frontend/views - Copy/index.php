<!DOCTYPE HTML>
<html>

<head>
   
<title><?php echo $system_info[0]->system_title; ?></title>
	<?php if($system_info[0]->system_image != "")
{?>
<link rel="icon" href="<?php echo base_url();?>/public_html/frontend/image/system/<?php echo $system_info[0]->system_image; ?>" type="image/x-icon" />
<?php 
}?>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="TheBox - premium e-commerce template">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/public_html/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/public_html/frontend/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/public_html/frontend/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/public_html/frontend/css/mystyles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/public_html/frontend/gallery/jquery.fancybox.min.css">


    <script src="<?php echo base_url();?>/public_html/frontend/js/jquery.js"></script>
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
<div class="global-wrapper clearfix" id="global-wrapper">
<div class="navbar-before mobile-hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="navbar-before-sign">You Need in the ultimate Solutions</p>
            </div>
            <div class="col-md-6">
                <ul class="nav navbar-nav navbar-right navbar-right-no-mar">
                    <!--<li><a href="seller_register.html">Seller Account</a></li>-->
                    <li><a href="<?php echo base_url(); ?>index.html">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>about_us.html">About Us</a>
                    </li>

                    <li><a href="<?php echo base_url(); ?>contact_us.html">Contact Us</a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
</div>


<nav class="navbar navbar-inverse navbar-main navbar-pad">
    <div class="container">
        <div class="navbar-header"  style="width: 25%;">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav-collapse" area_expanded="false"><span class="sr-only">Main Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo base_url();?>index.html">
                <?php

                //Logo List
                foreach($logo as $logo)
                {

                    $logo_image = $logo->logo_image;
                    $title = $logo->title;
                    $show_title = $logo->show_title;
                    $show_logo = $logo->show_logo;
					if ($logo->title == "Ultimate Sign Main") 
					{
                    if($show_title == 1 && $show_logo ==0)
                    {
                        ?>
                        <h1 ><a style="font-size: 24px;color: #fff;" href="<?php echo base_url(); ?>index.html"><?php echo $title; ?></a></h1>
                    <?php
                    }
                    if($show_title == 0 && $show_logo == 1)
                    {
                        ?>
                        <a href="<?php echo base_url(); ?>index.html">
                            <img class="img-responsive" src="<?php echo base_url()."/public_html/frontend/image/logo/".$logo_image; ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>" style="width:240px;height: 84px;" />
                        </a>
                    <?php
                    }
                    if($show_title == 1 && $show_logo == 1)
                    {
                        ?>
                        <a href="<?php echo base_url(); ?>index.html">
                            <img class="img-responsive" src="<?php echo base_url()."/public_html/frontend/image/logo/".$logo_image; ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>" style="width:240px;height: 84px;" />
                            <!--<h3><?php //echo $title; ?></h3>-->
                        </a>

                    <?php
                    }
					}
                }

                ?>
            </a>


        </div>
    </div>
</nav>
<nav class="navbar-inverse navbar-main yamm">
<div class="container">
<div class="collapse navbar-collapse navbar-collapse-no-pad" id="main-nav-collapse">

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

?>
<ul class='nav navbar-nav navbar-nav-lg'>
<li class="dropdown yamm-fw"><a href="<?php echo base_url(); ?>index.html">Home </a></li>
<li class="dropdown yamm-fw"><a href="<?php echo base_url(); ?>about_us.html">About Us </a></li>
<li class="dropdown yamm-fw"><a href="<?php echo base_url(); ?>ultimate_sign.html">Ultimate Sign </a></li>
<li class="dropdown yamm-fw"><a href="<?php echo base_url(); ?>ultimate_solution.html">Ultimate Solution </a></li>
<li class="dropdown yamm-fw"><a href="<?php echo base_url(); ?>contact_us.html">Contact Us </a></li>
  </ul>    
</div>
</div>
</nav>



    <div class="container">
    <div class="gap gap-small"></div>
 
 
    <div class="gap"></div>
    <div class="row" data-gutter="15">
		 <?php
	   $b11 = 1;
		//Adds List
        foreach($adds as $adds)
        {
            $adds_name = $adds->adds_name;
            $adds_image = $adds->adds_image;
          if($adds_name == "Ultimate Sign")
		  {
			  ?>
			        <div class="col-md-6">
					  <a class="banner-link" title="<?php echo $adds_name; ?>" href="<?php echo base_url(); ?>ultimate_sign.html"></a>
            <div title="<?php echo $adds_name; ?>" class="banner banner-o-hid" style="background-image:url(<?php echo base_url()."/public_html/frontend/image/adds/".$adds_image; ?>);">
              </div>
        </div>
		
		<?php
		}
		
		if($adds_name == "Ultimate Solution")
		  {
			  ?>
			        <div class="col-md-6">
					  <a class="banner-link" title="<?php echo $adds_name; ?>" href="<?php echo base_url(); ?>ultimate_solution.html"></a>
            <div title="<?php echo $adds_name; ?>" class="banner banner-o-hid" style="background-image:url(<?php echo base_url()."/public_html/frontend/image/adds/".$adds_image; ?>);">
              </div>
        </div>
		
		<?php
		}
		
		
		$b11++;
		}
		?>
		
		
      
    </div>
    <div class="gap"></div>
</div>


<footer class="main-footer">
    <div class="container">
        <div class="row row-col-gap" data-gutter="60">
            <div class="col-md-4">
                <h4 class="widget-title-sm">About Us</h4>
                <?php
                    foreach($pages as $ex2) {
                        if ($ex2->page_name == "About Us") {
                            ?>
	 	       <p class=""><?php echo $ex2->short_description; ?>
</p>
          <?php
                        }
                    }
                    ?> 
               
            </div>
            <div class="col-md-4">
                <h4 class="widget-title-sm">Get Social</h4>
                
				 <ul class="main-footer-social-list">
				 
				 
				 <?php
                    foreach($pages as $ex21) {
                        
						if ($ex21->page_name == "Facebook") 
						{
                            ?>
	 	       
<li><a href="<?php echo $ex21->short_description; ?>" title="<?php echo $ex21->page_name; ?>" target="_blank" class="fa fa-facebook"></a></li>
<?php
						}
						if ($ex21->page_name == "Twitter") 
						{
?>
		    <li><a href="<?php echo $ex21->short_description; ?>" class="fa fa-twitter" title="<?php echo $ex21->page_name; ?>" target="_blank"> </a></li>
			<?php
						}
						if ($ex21->page_name == "Gmail") 
						{
?>
			<li><a href="<?php echo $ex21->short_description; ?>" class="fa fa-google-plus" title="<?php echo $ex21->page_name; ?>" target="_blank"> </a></li>
			<?php
						}
						if ($ex21->page_name == "Linkedin") 
						{
?>
			<li><a href="<?php echo $ex21->short_description; ?>" title="<?php echo $ex21->page_name; ?>" class="fa fa-linkedin" target="_blank"></a></li>
			<?php
						}
						if ($ex21->page_name == "Skype") 
						{
?>
			<li><a href="<?php echo $ex21->short_description; ?>" title="<?php echo $ex21->page_name; ?>" class="fa fa-skype" target="_blank"></a></li>
			<?php
						}
?>
			
			
          <?php
                        }
                    
                    ?> 
					
					
                    
                   
                </ul>
				
				
				
            </div>
             <div class="col-md-4">
                <h4 class="widget-title-sm">Contact Us</h4>
               <p>Address: <?php echo $system_info[0]->short_address; ?></p>
		  <p>Phone: <?php echo $system_info[0]->mobile; ?></p>
		  <p>Email: <?php echo "<a style='color:#fff' href='mailto:".$system_info[0]->email."'>".$system_info[0]->email."</a>"; ?> </p>

               
            </div>
        </div>
       
    </div>
</footer>
<div class="copyright-area">
    <div class="container">
        <div class="row">
		<div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="copyright-text" style="text-align:center !important;">
				
				Copyright © 2017 <a href="http://www.ultimateprintingsolutions.com/" >Ultimate Printing Solutions</a>. All rights reserved. | Developed by <a href="https://www.skytechsol.com/" target="_blank">SKY Tech Sol</a>.</p>
		
				</p>
            </div>
		<div class="col-md-3"></div>
           
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url();?>/public_html/frontend/js/jquery.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/icheck.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/ionrangeslider.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/jqzoom.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/card-payment.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/owl-carousel.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/magnific.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/js/custom.js"></script>
<script src="<?php echo base_url();?>/public_html/frontend/gallery/jquery.fancybox.min.js"></script>
<script type="text/javascript">
	$("[data-fancybox]").fancybox({
		// Options will go here
	});
</script>

<!-- ace scripts -->

<script src="<?php echo base_url('public_html/assets/js/ace-elements.min.js')?>">           </script>
<script src="<?php echo base_url('public_html/assets/js/ace.min.js')?>">                    </script>
<!-- Date Picker-->
<script src="<?php echo base_url('public_html/assets/js/date-time/bootstrap-datepicker.min.js')?>"></script>



</body>

</html>
