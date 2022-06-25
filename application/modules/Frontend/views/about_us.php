<!-- Header -->
<?php require "template/header.php"; ?>


<div id="container">
    <div class="container">

            <header class="page-header">
                <h1 class="page-title">About Us</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                    </li>
                    <li class="active">About Us</li>
                </ol>

            </header>


        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">

                <div class="row">
                    <div class="col-sm-12">
                     <?php
                    foreach($pages as $ex2) {
                        if ($ex2->page_name == "About Us") {
                            ?>
	 	       <p class="m_10"><?php echo $ex2->long_description; ?>
</p>
          <?php
                        }
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