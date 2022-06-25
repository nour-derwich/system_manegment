<?php

if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
$user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');

$category_dd         = Modules::run('Hierarchy/category_dd');

?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Sub Category Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Sub Category
            </small>
            <a href="<?php echo base_url('Product/sub_category_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
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
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Product/sub_category_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
            <input type="hidden" name="image_status" id="image_status" value="0" />
            <input type="hidden" name="old_image" id="old_image" value="<?php echo $row[0]->category_image;?>">
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Category</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">

                        <?php
                        echo form_dropdown(
                            'cat_id',
                            $category_dd,$row[0]->parent_category_id,
                            'class  ="col-xs-12 col-sm-9 required-field "
                        id     ="cat_id" placeholder="Category"');
                        ?>
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="cat_name" name="cat_name" value="<?php echo $row[0]->category_name;?>" placeholder="Sub Category Name" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>


            <?php
            if($this->uri->segment(3))
            {
                ?>
                <div class="form-group">

                    <label class="control-label col-xs-12 col-sm-3" >Image</label>
                    <div class="col-xs-12 col-sm-2">
                        <div class="clearfix">
                            <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                Upload
                            </button>
                            <input type="file" id="cat_img" name="cat_img" style="display: none;" />

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <?php


                        if($row[0]->category_image != "")
                        {
                            ?>
                            <div class="" id="result_pic">
                                <img id="myImg" src="<?php echo base_url().'public_html/frontend/image/categories/'.$row[0]->category_image; ?>" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        <?php
                        }else{
                            ?>
                            <div class="hide" id="result_pic">
                                <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="hide">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        <?php } ?>

                    </div>

                </div>

            <?php
            }
            else
            {
                ?>
                <div class="form-group">

                    <label class="control-label col-xs-12 col-sm-3" >Image</label>
                    <div class="col-xs-12 col-sm-2">
                        <div class="clearfix">
                            <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                Upload
                            </button>
                            <input type="file" id="cat_img" name="cat_img" class="required-field" style="display: none;" />

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="hide" id="result_pic">
                            <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                        </div>
                        <div id="upload_img" class="hide">
                            <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                <i class="icon-undo bigger-110"></i>Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>



            <!--
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Image</label>
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


                    <a class="btn"  href="<?php echo base_url('Product/sub_category_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a>
                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-info btn-validate" name="save_sub_category" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>


            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


