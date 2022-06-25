<div class="page-content">
    <div class="page-header">
        <h1>
            Account Management
            <small>
                <i class="icon-double-angle-right"></i>
                Sellers Account
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
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->


            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Results for Sellers
                        <!--<a href="<?php echo base_url('Users/action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>-->
                    </div>

                    <div class="table-responsive">
                        <table id="seller_account_list" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Username</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Account Status</th>
                                <th>Status</th>
                                <th>Account Detail</th>
                                <th>Product Detail</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($result_set as $key => $row)
                            { ?>

                                <tr>
                                    <td><?php echo $row->username;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo $row->telephone;?></td>
                                    <td><?php echo $row->mobile;?></td>
                                    <td><?php echo $row->address;?></td>
                                    <td><?php
                                        if($row->admin_status == 1)
                                        {
                                            echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Active">Active</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="btn btn-danger btn-sm" title="Un-Active" style="padding:0px 10px;">Un-Active</span>';
                                        }

                                        ?></td>



                                    <td>
                                        <label class=" inline">
                                            <input  ref="<?php echo $row->id; ?>"  <?php if($row->admin_status == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_seller" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>


                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?php echo base_url('Account/seller_account_list/'.$row->id.''); ?>"
                                            <i class="icon-eye-open bigger-120"></i>

                                            </a>
                                        </div>


                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a target="_blank" href="<?php echo base_url('Account/seller_product_list/'.$row->id.''); ?>"
                                            <i class="icon-eye-open bigger-120"></i>

                                            </a>
                                        </div>


                                    </td>
                                </tr>



                            <?php } ?>




                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Person Add -->
                    <div id="personDetail" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="border-bottom:1px solid #ccc !important;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">User Detail</h4>
                                </div>
                                <div class="modal-body" style="padding-top: 10px !important;">
                                    <div class="show_account_detail"></div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info btn-validate"  data-dismiss="modal" type="button">
                                        <i class="icon-ok bigger-110"></i>
                                        Close
                                    </button>


                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>


</div>


