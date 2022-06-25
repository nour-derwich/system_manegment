<?php

if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
$country_dd         = Modules::run('Hierarchy/country_dd');
$expense_dd         = Modules::run('Hierarchy/expense_dd');
$city_name = $this->Mdl_expense->get_relation_pax('city_list','city_name','id',$row[0]->city_id);
?>
<div class="page-content">


    <div class="page-header">
        <h1>
            General Expense Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Expense
            </small>
            <a href="<?php echo base_url('Expense/expense_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
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
                'class' => 'form-horizontal form-validate-inventory',
                'id'    => 'register-form',
                'role'  => 'form',
            );
            echo form_open_multipart(base_url('Expense/expense_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->

            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
           <div class="space-2"></div>
		   
		   <?php
			if($this->session->userdata('user_type') == "1")
			{
			?>
		    <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Country</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                       
						  <?php
                        echo form_dropdown(
                            'country_id',
                            $country_dd,$row[0]->country_id,
                            'class  ="country_id country col-xs-10 col-sm-9 required-field "
                        id     ="country_id" placeholder="Country"');
                        ?>
						
						
                    </div>
                </div>
            </div>
			
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">City</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <select id="city_id" required name="city_id" placeholder="City" class="city city_id col-xs-10 col-sm-9 required-field">
						<?php
						if($id > 0 )
						{
							?>
							<option value="<?php echo $row[0]->city_id; ?>"><?php echo $city_name; ?></option>
							<?php
						}else
						{
						?>
						
                                    <option value="">Select City</option>
						<?php
						}
						?>
                                </select>	
                    </div>
                </div>
            </div>
	
			<?php
			}
			?>
			 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Expense Type</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                          <?php
                        echo form_dropdown(
                            'expense_type_id',
                            $expense_dd,$row[0]->expense_type_id,
                            'class  ="expense_type_id col-xs-10 col-sm-9 required-field "
                        id     ="expense_type_id" placeholder="Expense Type"');
                        ?>
                    </div>
                </div>
            </div>
			
			
    

           <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Description</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <textarea id="exp_des" name="exp_des" placeholder="Expense Description" class="col-xs-10 col-sm-9 required-field"><?php echo $row[0]->exp_des;?></textarea>
                    </div>
                </div>
            </div>


			
			           <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Price</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="exp_price" name="exp_price" value="<?php echo $row[0]->exp_price;?>" placeholder="Expense Price" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>


			
			           <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Expense User</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="exp_from" name="exp_from" value="<?php echo $row[0]->exp_from;?>" placeholder="Expense From" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>




           <!-- <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name"></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="file" id="cat_img" name="cat_img" value="<?php echo $row[0]->category_image;?>" class="col-xs-10 col-sm-9">
                    </div>
                </div>
            </div>
-->


            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Active:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <label class=" inline">
                            <input id="status" name="status" ref="<?php echo $row[0]->id; ?>"  <?php if($row[0]->is_enable == 0){ echo 'value="0" ';}else if($row[0]->is_enable == 1){ echo 'value="1" checked="checked"';} ?>  type="checkbox" class="ace ace-switch ace-switch-5 status">
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>
            </div>





            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">
                    <a class="btn"  href="<?php echo base_url('Expense/expense_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a>

                    &nbsp; &nbsp; &nbsp;

                    <button class="btn btn-info btn-validate" name="save_inventory" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>
                </div>
            </div>


            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


