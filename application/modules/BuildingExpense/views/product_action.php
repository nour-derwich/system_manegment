<?php


if($get_product){$row = $get_product;}
$id = $this->uri->segment(3);
/* $user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');

$category_dd         = Modules::run('Hierarchy/category_dd');
$country_dd         = Modules::run('Hierarchy/country_dd');
$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);
$state_name = $this->Mdl_product->get_relation_pax('state_list','state_name','id',$row[0]->state);
$city_name = $this->Mdl_product->get_relation_pax('city_list','title','id',$row[0]->city);


$seller_dd         = Modules::run('Hierarchy/get_seller_list'); */


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Product Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Product
            </small>
            <a href="<?php echo base_url('Product/product_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>
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
            echo form_open_multipart(base_url('Product/product_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
     
            <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Media Name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="product_name" name="product_name" value="<?php echo $row[0]->product_name;?>" placeholder="Media Name" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			
			
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Material Cost</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="material_cost" name="material_cost" value="<?php echo $row[0]->material_cost;?>" placeholder="Material Cost" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Other Expense</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="other_expense" name="other_expense" value="<?php echo $row[0]->other_expense;?>" placeholder="Other Expense" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			
			



    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Active:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <label class=" inline">
                    <input id="status" name="status"
                           ref="<?php echo $row[0]->id; ?>" <?php if ($row[0]->is_enable == 0) {
                        echo 'value="0" ';
                    } else if ($row[0]->is_enable == 1) {
                        echo 'value="1" checked="checked"';
                    } ?>  type="checkbox" class="ace ace-switch ace-switch-5 status">
                    <span class="lbl"></span>
                </label>
            </div>
        </div>
    </div>




            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                    <a class="btn"  href="<?php echo base_url('Product/product_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a>
                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-info btn-validate" name="save_product" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>

            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


