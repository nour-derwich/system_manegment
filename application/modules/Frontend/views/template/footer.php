
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
