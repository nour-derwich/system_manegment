<!-- Header -->
<?php require "template/header2.php"; ?>


<div id="container">
    <div class="container">

            <header class="page-header">
                <h1 class="page-title">Ultimate Solution</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                    </li>
                    <li class="active">Ultimate Solution</li>
                </ol>

            </header>


        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">

                <div class="row">
                    <div class="col-sm-12">
                      <?php
	   $b11 = 1;
		//Adds List
        foreach($adds as $adds)
        {
            $adds_name = $adds->adds_name;
            $adds_image = $adds->adds_image;
            $adds_description = $adds->adds_description;
        
		if($adds_name == "Ultimate Solution")
		  {
			  ?>
			  <p><?php echo $adds_description; ?></p>
		
		<?php
		}
		
		
		$b11++;
		}
		?>
		  
					<br/><br/>
					</div>
                </div>
             </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>


<!-- Footer -->
<?php require "template/footer.php"; ?>