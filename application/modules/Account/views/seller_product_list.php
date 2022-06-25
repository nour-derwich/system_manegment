<div class="page-content">
    <div class="page-header">
        <h1>
           Product Management
            <small>
                <i class="icon-double-angle-right"></i>
                Product List
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
    }
    //print_r($result);
    ?>


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <div class="space-2"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-header">
                                Results for Product List
                            </div>
                            <div class="table-responsive ">
                                <table id="product-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Feature</th>
                                        <th>Images</th>

                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Total Price</th>
                                        <th>Discount Status</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($result as $res):

                                        $category_name = $this->Mdl_Account->get_relation_pax('category_list','category_name','id',$res->category_id);
                                        $subcategory_name = $this->Mdl_Account->get_relation_pax('category_list','category_name','id',$res->subcategory_id);
                                        // $currency_name = $this->Mdl_Product->get_relation_pax('currency_list','code','id',$fc->currency_id);
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <?php
                                                echo $category_name;
                                                ?>
                                            </td>
                                            <td><?php echo $subcategory_name; ?></td>
                                            <td><?php echo $res->product_name;?></td>
                                            <td><?php if($res->is_new == 1){ echo "New"; }else{ echo "Regular"; }?></td>
                                            <td><?php echo $res->product_description;?></td>
                                            <td><?php echo $res->product_featured;?></td>
                                            <td>
                                                <a class="green" target="_blank" href="<?php echo base_url('Product/view_image/'.$res->id.''); ?>">
                                                    <i class="icon-eye-open bigger-130"></i>
                                                </a>
                                            </td>
                                            <td><?php echo $res->product_price;?></td>
                                            <td><?php echo $res->discount_price;?></td>
                                            <td><?php echo $res->total_price;?></td>
                                            <td>
                                                <label class=" inline">
                                                    <input  ref="<?php echo $res->id; ?>"  <?php if($res->discount_status == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 discount_status" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $res->product_quantity;?></td>

                                            <td>
                                                <label class=" inline">
                                                    <input  ref="<?php echo $res->id; ?>"  <?php if($res->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 product_status" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>

                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                                    <a class="green"  href="<?php echo base_url('Product/product_action/'.$res->id.''); ?>">
                                                        <i class="icon-pencil bigger-130"></i>
                                                    </a>

                                                </div>

                                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                    <div class="inline position-relative">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                                            <li>
                                                                <a href="<?php echo base_url('Product/product_action/'.$res->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


