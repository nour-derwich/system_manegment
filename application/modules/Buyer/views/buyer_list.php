<div class="page-content">
    <div class="page-header">
        <h1>
            Buyer Management
            <small>
                <i class="icon-double-angle-right"></i>
                Buyer Account List
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
                        Results for Buyers
                        <!--<a href="<?php echo base_url('Users/action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>-->
                    </div>

                    <div class="table-responsive">
                        <table id="buyer_list" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Order Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($result_set as $key => $row)
                                { ?>

                                    <tr>
                                        <td><?php echo $row->user_type;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->contact;?></td>
                                        <td><?php echo $row->address;?></td>

                                        <td>
                                            <div class="action-buttons">
                                                <a target="_blank" href="<?php echo base_url('Buyer/order_list/'.$row->id.''); ?>"
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


