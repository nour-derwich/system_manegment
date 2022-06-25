<?php 
if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
$user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');
$load              = $this->Mdl_hierarchy;
// $markaz_dd         = Modules::run('Hierarchy/markaz_dd');
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
            <a href="<?php echo base_url('Users'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>

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
            echo form_open(base_url('Users/command'), $attributes);
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">





            <div class="space-2"></div>     
            <?php //if($this->session->userdata('user_type') == 1):?>
            <!--<div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Markaz Name:</label>
            <div class="col-xs-12 col-sm-9">
            <div class="clearfix">

            <?php
            /* echo form_dropdown(
            'markaz_id',
            $markaz_dd,$row[0]->markaz_id,
            'class  ="col-xs-12 col-sm-6 required-field "
            id     ="markaz_id" placeholder="Markaz"'); */
            ?>

            </div>
            </div>
            </div>
            <div class="space-2"></div>-->
            <?php //endif;?>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">User Name:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" old-username="<?php echo $row[0]->username; ?>" id="username" value="<?php echo $row[0]->username; ?>" name="username" placeholder="User name" class="col-xs-12 col-sm-6 required-field" />
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
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Mobile No:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="mobile_no" value="<?php echo $row[0]->mobile_no; ?>" name="mobile_no" placeholder="9999-999999999" class="col-xs-12 col-sm-6 required-field" />
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <?php if($id != null){ ?>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Change Password:</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <label class=" inline">
                                <input id="changepassword" name="changepassword" type="checkbox" value="0" class="ace ace-switch ace-switch-5" />
                                <span class="lbl"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <?php } ?>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Password:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="password" <?php if($id != null){echo 'disabled="disabled"';} ?> id="password" name="password" placeholder="Password" class="col-xs-12 col-sm-6" />
                    </div>
                </div>
            </div>
            <div class="space-2"></div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm Password:</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="password" id="retypepassword" <?php if($id != null){echo 'disabled="disabled"';} ?> name="retypepassword" placeholder="Confirm Password" class="col-xs-12 col-sm-6" />
                    </div>
                </div>
            </div>
            <div class="space-2"></div>

            <!--<div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Is Print:</label>
            <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
            <label class=" inline">
            <input id="is_print" name="is_print"  <?php if($row[0]->is_print == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 is_print" />
            <span class="lbl"></span>
            </label>
            </div>
            </div>
            </div>-->

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
                <div class="col-md-offset-6 col-md-9">
                    <button class="btn btn-info btn-validate" type="submit">
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