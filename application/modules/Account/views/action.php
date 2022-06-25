<?php 
if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
$user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');
$load              = $this->Mdl_hierarchy;
$user_dd         = Modules::run('Hierarchy/user_type_dd');
//print_r($row);
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Users Management
            <small>
                <i class="icon-double-angle-right"></i>
                Users
            </small> 
            <a href="<?php echo base_url('Account/account_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>

        </h1>
    </div><!-- /.page-header -->



    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(  
                'class' => 'form-horizontal form-validate', 
                'id'    => 'register-form', 
                'role'  => 'form'
            );
            echo form_open(base_url('Account/command'), $attributes);
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">





            <div class="space-2"></div>     
            <?php //if($this->session->userdata('user_type') == 1):?>
            <div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">User Type:</label>
            <div class="col-xs-12 col-sm-9">
            <div class="clearfix">

            <?php
             echo form_dropdown(
            'user_type_id',
            $user_dd,$row[0]->user_type,
            'class  ="col-xs-12 col-sm-6 required-field "
            id     ="user_type_id" placeholder="User Type"'); 
            ?>

            </div>
            </div>
            </div>
            <div class="space-2"></div>
            <?php //endif;?>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Name:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" old-name="<?php echo $row[0]->name; ?>" id="name" value="<?php echo $row[0]->name; ?>" name="name" placeholder="Name" class="col-xs-12 col-sm-6 required-field" />
                    </div>
                </div>
            </div>
            <div class="space-2"></div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Email:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="email" id="email" value="<?php echo $row[0]->email; ?>" name="email" placeholder="example@example.com" class="col-xs-12 col-sm-6 required-field" />
                    </div>
                </div>
            </div>
            <div class="space-2"></div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Contact No:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="contact" value="<?php echo $row[0]->contact; ?>" name="contact" placeholder="9999-999999999" class="col-xs-12 col-sm-6 required-field" />
                    </div>
                </div>
            </div>
			
			 <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Address:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
					<textarea cols="20" rows="5" id="address" placeholder="Address" class="col-xs-12 col-sm-6 required-field" name="address"><?php echo $row[0]->address;?></textarea>
					</div>
                </div>
            </div>
			
			
          
            <div class="space-2"></div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Active:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <label class=" inline">
                            <input id="status" name="status"  <?php if($row[0]->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="space-2"></div>


            <div class="clearfix form-actions">
                <div class=" col-md-6">
                    <button class="pull-right btn btn-info btn-validate" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Process
                    </button>

                    <!--         &nbsp; &nbsp; &nbsp;
                    <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                    </button>-->
                </div>
            </div>





            <?php echo form_close();  ?>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->




</div>