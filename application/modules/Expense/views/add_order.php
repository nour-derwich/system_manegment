<?php


if($view_result){$row = $view_result;}
$id = $this->uri->segment(3);



$category_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->category_id);
$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Product Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Order
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
            echo form_open_multipart(base_url('Product/order_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $row[0]->id ?>">
            <input type="hidden" name="order_user_id" id="order_user_id" value="">
            <input type="hidden" name="order_remaining_amount" id="order_remaining_amount" value="">
            <input type="hidden" name="old_order_code" id="old_order_code" value="">
            <input type="hidden" name="old_payment_id" id="old_payment_id" value="">
            <input type="hidden" name="old_order_id" id="old_order_id" value="">
          
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Category</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
						<input type="text" readonly id="search_cat_id" name="search_cat_id" value="<?php echo $category_name;?>" placeholder="Product Name" class="col-xs-10 col-sm-9 required-field" />
                        
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Sub Category</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
					<input type="text" readonly id="search_cat_id" name="search_cat_id" value="<?php echo $subcategory_name;?>" placeholder="Product Name" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Product Name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="product_name" readonly name="product_name" value="<?php echo $row[0]->product_name;?>" placeholder="Product Name" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label lbl_color col-xs-12 col-sm-3 no-padding-right" for="form-field-1">Product Description:</label>

                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                       <!-- <textarea class="required-field col-xs-10 col-sm-9" data-provide="markdown" name="product_des" id="product_des" rows="6" placeholder="Product Description"><?php echo $row[0]->postal_address; ?></textarea>
                        -->
                        <textarea class="required-field col-xs-10 col-sm-9" name="product_des" id="product_des" rows="6" placeholder="Product Description"><?php echo $row[0]->product_description;?></textarea>
                    </div>
                </div>
            </div>

			
			  <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Product Price</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="pprice" name="pprice" readonly value="<?php echo $row[0]->total_price;?>" placeholder="Product Price" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Sell Price</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="sprice" name="sprice" value="" placeholder="sell Price" class="col-xs-10 col-sm-9 required-field sprice" />
                    </div>
                </div>
            </div>
			<div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Order Quantity</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="number" id="oqty" name="oqty" value="1" placeholder="Order Quantity" class="col-xs-10 col-sm-9 required-field oqty" />
                    </div>
                </div>
            </div>
			
			

            <div class="form-group">
                <label class="control-label lbl_color col-xs-12 col-sm-3 no-padding-right" for="form-field-1">Other Features:</label>

                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <textarea class="col-xs-10 col-sm-9" name="other_fea" id="other_fea" rows="6" placeholder="Other Features"></textarea>
                    </div>
                </div>
            </div>

<div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Other Charges/Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="other_price" name="other_price" value="" placeholder="Other Charges/Price" class="col-xs-10 col-sm-9 other_price" />
                    </div>
                </div>
            </div>
          

			
			
			
			
 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">User Type</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <select  id="user_type" name="user_type" class="col-xs-10 col-sm-9" >
						<option value="">Select Type</option>
						<option value="guest">Guest</option>
						<option value="user">User</option>
						
						</select>
                    </div>
                </div>
            </div>

			
			 <div class="form-group show_user_div hide">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Select User</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <select  id="new_user" name="new_user" class="col-xs-10 col-sm-9 new_user" >
						
						
						</select>
                    </div>
                </div>
            </div>

			
			

<div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="name" name="name" value="" placeholder="Name" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>
		
			
			<div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Contact</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="contact" name="contact" value="" placeholder="Contact" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>
			
			<div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Address</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="address" name="address" value="" placeholder="Address" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>

			
			<div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Previous Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="pre_remaining__price" name="pre_remaining__price" value="0" placeholder="" class="col-xs-10 col-sm-9 pre_remaining__price" />
                    </div>
                </div>
            </div>
			
			
			
            <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Total Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="total_price" readonly name="total_price" value="" placeholder="Total Price" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>
			
			

			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Paid Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="paid_price" name="paid_price" value="" placeholder="Paid Price" class="col-xs-10 col-sm-9 paid_price" />
                    </div>
                </div>
            </div>

			
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Remaining Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="remaining_price" readonly name="remaining_price" value="" placeholder="Remaining Price" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>




            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                    <a class="btn"  href="<?php echo base_url('Product/order_list'); ?>">
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


