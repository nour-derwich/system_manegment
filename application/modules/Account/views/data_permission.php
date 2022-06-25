<?php 
if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Data Permission
            <small>
                <i class="icon-double-angle-right"></i>
                Users
            </small> 
            <a href="<?php echo base_url('Users'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
            <a href="#" class="pull-right btn bigger-50 ws-btn-font submit_form  btn-success">Add Data Permissions</a>

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
            echo form_open(base_url('Users/add_data_permission'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

            <div class="row">
                <div class="col-xs-12">


                    <?php echo  $permission_view ;?> 


                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->


            <?php echo form_close();  ?>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->




</div>


