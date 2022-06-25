<?php
//if($view_result){$row = $view_result;}
//$id = $this->uri->segment(3);

$user_dd         = Modules::run('Hierarchy/seller_dd');

//$category_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->category_id);
//$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Seller Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add Payment
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


    <div class="row">
        <div class="col-xs-12 col-sm-7">

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-product',
                'id'    => 'register-form',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Seller/partial_payment_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
        
            <input type="hidden" name="order_user_id" id="order_user_id" value="">
            <input type="hidden" name="order_remaining_amount" id="order_remaining_amount" value="">
            <input type="hidden" name="old_order_code" id="old_order_code" value="">
            <input type="hidden" name="old_payment_id" id="old_payment_id" value="">
            <input type="hidden" name="old_order_id" id="old_order_id" value="">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo  $this->session->userdata('id'); ?>">
          
     
		
			
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Select User</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <?php
                        echo form_dropdown(
                            'payment_user_id',
                            $user_dd,$row[0]->user_id,
                            'class  ="col-xs-12 col-sm-9 payment_user_id required-field "
                        id     ="payment_user_id" placeholder="Category"');
                        ?>
                    </div>
                </div>
            </div>

			

			
			<div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Previous Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="pre_remaining_price_payment" readonly name="pre_remaining_price_payment" value="0" placeholder="" class="col-xs-10 col-sm-9 pre_remaining_price_payment" />
                    </div>
                </div>
            </div>
			
		

			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Paid Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="paid_price_payment" name="paid_price_payment" value="" placeholder="Paid Price" class="col-xs-10 col-sm-9 paid_price_payment required-field" />
                    </div>
                </div>
            </div>

			
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Remaining Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="remaining_price_payment" readonly name="remaining_price_payment" value="" placeholder="Remaining Price" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>


			<div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Sales Person </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="sname" name="sname" value="" placeholder="" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>


            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-info btn-validate add_payment" name="save_product" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Submit
                    </button>


                </div>
            </div>

            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


