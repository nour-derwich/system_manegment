<?php 
if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Module Permission
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
            echo form_open(base_url('Users/allow_permission'), $attributes);
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
            <!-- PAGE CONTENT BEGINS -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable tabs-left">
                        <?php echo  $permission_view ;?> 
                    </div>
                </div><!-- /span -->
            </div>


            <!-- PAGE CONTENT ENDS -->

            <div class="space-2"></div>


            <div class="clearfix form-actions">
                <div class=" col-md-9">
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


