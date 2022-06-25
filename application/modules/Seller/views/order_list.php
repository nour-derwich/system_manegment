<?php
$seller_dd         = Modules::run('Hierarchy/seller_dd1');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Seller Management
            <small>
                <i class="icon-double-angle-right"></i>
                Seller List
            </small>
        </h1>
    </div><!-- /.page-header -->

    <?php
    if($this->session->flashdata())
    {
        foreach($this->session->flashdata() as $key => $value):
            if($key == 'update' || $key == 'saved')
            {
                $alert_class = 'alert-success';
            }else
            {
                $alert_class = 'alert-danger';
            }
            ?>
            <div class="alert alert-block <?php echo $alert_class; ?>">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        <?php echo ucwords(strtolower($key)); ?> !
                    </strong>
                    <?php echo $value; ?>

                </p>


            </div>
        <?php
        endforeach;
    }  ?>


	
	
    <div class="row" style="    height: 50px !important;">
        <div class="col-xs-12 col-sm-7">

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal ',
                'id'    => 'register-form',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Seller/seller_search'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Seller</label>
                <div class="col-xs-12 col-sm-6">
                    <div class="clearfix">

                        <?php
                            echo form_dropdown(
                                'seller_id',
                                $seller_dd,$row[0]->seller_id,
                                'class  ="col-xs-12 col-sm-12"
                            id     ="seller_id" placeholder="Seller"');
                            ?>
                    </div>
                </div>
				<div class="col-md-3 ">


                    <button class="btn btn-info btn-validate search_seller" name="search_seller" type="button">
                        <i class="icon-ok bigger-110"></i>
                        Search
                    </button>


                </div>
            </div>
            </div>

    


            <?php echo form_close();  ?>

        </div><!-- /.col -->
   

    <div class="seller_result"></div>



</div>


