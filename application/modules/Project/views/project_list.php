<?php
//$category_dd         = Modules::run('Hierarchy/category_dd');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Project Management
            <small>
                <i class="icon-double-angle-right"></i>
                Project List
            </small>
            <a href="<?php echo base_url('Project/add_project'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add View</a>
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


    <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Media
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>                                    
                                    <th>Material Cost</th>
                                    <th>Other Expense</th>
                                    <th>WPN  Type</th>
                                    <th>WPN Calibre</th>
                                    <th>WPN Number</th>
                                    <th>License Number</th>
                                    <th>Status</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($result as $res):

                                    ?>
                                    <tr>
                                       
                                        <td><?php echo $res->weapon_name; ?></td>
                                      
                                      
                                        <td>Rs. <?php echo $res->material_cost;?></td>
                                        <td>Rs. <?php echo $res->other_expense;?></td>

                                         <td>Rs. <?php echo $res->wpntype;?></td>
                                        <td>Rs. <?php echo $res->wpncalibre;?></td>
                                         <td>Rs. <?php echo $res->wpnnumber;?></td>
                                        <td>Rs. <?php echo $res->licensenumber;?></td>
                                      
                                     
                                        <td>
                                            <label class=" inline">
                                                <input  ref="<?php echo $res->id; ?>" reff="<?php if($res->user_type == 'seller'){ echo $res->created_by; } ?>"  <?php if($res->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 " />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                                <a class="green"  href="<?php echo base_url('Project/edit_project/'.$res->id.''); ?>">
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
        <script type="text/javascript">
            jQuery(function($)
            {
                //Product Status Change
              
  /*              //Discount Status Change
                $(".discount_status").change(function(){
                    var _status = $(this).val();
                    var ref     = $(this).attr('ref');
                    if(_status == 0)
                    {
                        $(this).val(1);
                        var status_new = 1;
                        $(this).prop('checked',true);
                    }else
                    {
                        $(this).val(0);
                        var status_new = 0;
                        $(this).prop('checked',false);
                    }

                    if(ref != null)
                    {
                        var json = {};

                        json['id']       = ref;
                        json['status']   = status_new;
                        var request = $.ajax({
                            url: "<?php //echo base_url('Product/change_discount_status'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",

                            success : function(_return)
                            {
                                if(_return['_return'] > 0)
                                {

                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Discount Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });

                                    return false;

                                }
                            }
                        });
                    }
                });
*/
                var oTable1 = $('#product-table').dataTable(
                    {
                        "aoColumns":
                            [
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ]
                    });
            });
        </script>
   

</div>

<!--
<div class="row">
    <div class="col-xs-12">


            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Results for Inventory
                        <a href="<?php //echo base_url('Form/inventory_action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>
                    </div>

                    <div class="table-responsive">
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Date </th>
                                    <th>Product</th>
                                    <th>Quantity</th>

                                    <th>Location</th>

                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php //foreach($result_set as $key => $row) { ?>

                                    <tr>
                                        <td><?php //echo $row->trans_date;?></td>
                                        <td><?php 

                                            //$product_name = $this->Mdl_form->get_relation_pax('product_list','title','id',$row->product_id);
                                          //  echo $product_name;

                                        ?></td>
                                        <td><?php //echo $row->quantity;?></td>
                                        <td><?php //echo $row->location_id;

                                          //  $location_name = $this->Mdl_form->get_relation_pax('location_list','title','id',$row->location_id);
                                         //   echo $location_name;


                                        ?></td>




                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                                <a class="green" href="<?php //echo base_url('Form/inventory_action/'.$row->id.''); ?>">
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
                                                </a>
                                            </div>

                                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                                        <li>
                                                            <a href="<?php //echo base_url('Users/action/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php // echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <?php // } ?>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>-->