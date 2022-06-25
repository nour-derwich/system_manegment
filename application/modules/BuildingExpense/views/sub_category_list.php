
<div class="page-content">
    <div class="page-header">
        <h1>
            Sub Category Management
            <small>
                <i class="icon-double-angle-right"></i>
                Sub Category List
            </small>
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
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->


            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Results for Sub Category
                        <a href="<?php echo base_url('Product/sub_category_action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>
                    </div>

                    <div class="table-responsive">
                        <table id="sub_category_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Category </th>
                                    <th>Sub Category</th>
                                    <th>Image</th>

                                    <th>Status</th>

                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            //print_r($result_set);
                            $parent_name = "";
                            foreach($result_set as $key => $row) {
                                //echo "<pre>";
                               // print_r($result_set);

                                ?>

                                <tr>
                                    <td><?php //echo $row->parent_category_id;

                                        $parent_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row->parent_category_id);
                                        echo $parent_name;

                                        ?></td>
                                    <td><?php echo $row->category_name;?></td>
                                    <td>
                                        <?php
                                        if($row->category_image != "")
                                        {
                                            ?>
                                            <img src="<?php echo base_url()."public_html/frontend/image/categories/".$row->category_image; ?>" style="height:100px;width:100px;"/>"
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <label class=" inline">
                                            <input  ref="<?php echo $row->id; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 category_status" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>



                                    <td>
                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                            <a class="green" href="<?php echo base_url('Product/sub_category_action/'.$row->id.''); ?>">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>

                                            <!--<a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                                                <i class="icon-trash bigger-130"></i>
                                                </a>
                                                <a class="blue" href="<?php //echo base_url('Users/module_permission/'.$row->id.''); ?>">
                                                <i class="icon-lock bigger-130"></i>
                                                </a>
                                                <a class="purple" href="<?php //echo base_url('Users/data_permission/'.$row->id.''); ?>">
                                                <i class="icon-eye-open bigger-130"></i>
                                                </a>-->
                                        </div>

                                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                                            <div class="inline position-relative">
                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                                    <li>
                                                        <a href="<?php echo base_url('Product/sub_category_action/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                        </a>
                                                    </li>
                                                    <!--
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="icon-trash bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/module_permission/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="blue">
                                                                    <i class="icon-lock bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/data_permission/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="purple">
                                                                    <i class="icon-eye-open bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        -->
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            <?php } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>


