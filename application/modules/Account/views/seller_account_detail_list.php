<div class="page-content">
    <div class="page-header">
        <h1>
            Account Management
            <small>
                <i class="icon-double-angle-right"></i>
                Seller Account Detail
            </small>
            <a href="<?php echo base_url('Account/seller_account_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
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
                <div class="col-xs-6">



                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered table-hover">
                            <tr><th colspan="2" style="background-color: #307ecc;color: #fff;"><b>Seller Account Detail</b></th></tr>
                            <tbody>
                            <?php foreach($result_set as $key => $row)
                            { ?>
                                <tr><th colspan="2" align="center"> Personal Details</th></tr>
                                <tr>
                                    <th>First Name</th>
                                    <td><?php echo $row->firstname;?></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td><?php echo $row->lastname;?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $row->email;?></td>
                                </tr>
                                <tr>
                                    <th>Telephone</th>
                                    <td><?php echo $row->telephone;?></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td><?php echo $row->mobile;?></td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td><?php echo $row->gender;?></td>
                                </tr>
                                <tr><th colspan="2" align="center">Address Details</th></tr>
                                <tr>
                                    <th>Company</th>
                                    <td><?php echo $row->company;?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $row->address;?></td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td><?php
                                        //echo $row->country_id;
                                        $country_name = $this->Mdl_Account->get_relation_pax('country_list','country_name','id',$row->country_id);
                                        //print_r($country_name);
                                        echo $country_name;?></td>
                                </tr>
                                <tr>
                                    <th>State/Region</th>
                                    <td><?php $state_name = $this->Mdl_Account->get_relation_pax('state_list','state_name','id',$row->state_id);
                                        echo $state_name;?></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><?php $city_name = $this->Mdl_Account->get_relation_pax('city_list','title','id',$row->city_id);
                                        echo $city_name;?></td>
                                </tr>
                                <tr>
                                    <th>Postal Code</th>
                                    <td><?php echo $row->postal_code;?></td>
                                </tr>

                                <tr><th colspan="2" align="center">Account Details</th></tr>
                                <tr>
                                    <th>User Name</th>
                                    <td><?php echo $row->username;?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php //echo $row->is_enable;

                                        if($row->admin_status == 1)
                                        {
                                            echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Active">Active</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="btn btn-danger btn-sm" title="Un-Active" style="padding:0px 10px;">Un-Active</span>';
                                        }
                                        ?>
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


