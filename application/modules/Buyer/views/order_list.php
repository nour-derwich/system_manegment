<div class="page-content">
    <div class="page-header">
        <h1>
            Buyer Management
            <small>
                <i class="icon-double-angle-right"></i>
                Order List
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
                        Results for Order List

                    </div>

                    <div class="table-responsive">
                        <table id="order_list_table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>User Details</th>
                               
                                <th>Order Code</th>
                                <th>Order Date</th>
                               
                                <th>Total Price</th>
								<th>Remaining Price</th>
                                <th>Order Detail</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //print_r($result_set);
                            foreach($result_set as $key => $row) { ?>

                                <tr>
                                    <td><?php
									$user = $this->Mdl_buyer->_get_user_list($row->user_id);
									

									//echo $row->order_date;
									?>
									<p>User Type: <?php echo $user[0]->user_type; ?></p>
									<p>Name: <?php echo $user[0]->name; ?></p>
									<p>Contact: <?php echo $user[0]->contact; ?></p>
									<p>Address: <?php echo $user[0]->address; ?></p>
									
									</td>
                                   

                                    <td><?php 
									
										$order = $this->Mdl_buyer->_get_order_list($row->order_id);
										echo $order[0]->order_code;?></td>
                                    <td><?php echo $order[0]->order_date;?></td>
                                    <td>Rs. <?php echo $order[0]->total_price;?></td>
									
									<?php
									
									/* $payment_list = $this->Mdl_Account->_get_payment_list($row->user_id,$row->order_code);
									$p = 0;
									$r = 0;
									foreach($payment_list as $payment){
										$p = $p + $payment->paid_price;
										$r = $r + $payment->remaining_price;
									} */
									
									?>
                               


									<td>
                                       Rs. <?php
									    $payment = $this->Mdl_buyer->get_remainig_payment_list($order[0]->order_code);
									  echo $payment[0]->remaining_price;
									   
									   ?>


                                    </td>
									 <td><?php 
									
								
									
									/* $product_name = $this->Mdl_buyer->get_relation_pax('product_list','product_name','id',$order[0]->product_id);
									
									echo $product_name; */
									?>
									
                                        <div class="action-buttons">
                                            <a target="_blank" class="btn btn-xs" href="<?php echo base_url('Buyer/cart_list/'.$row->order_code.''); ?>">
                                           View Cart

                                            </a>
                                        </div>
										</td>
									
									
									<td>
									
									 <!-- <div class="action-buttons">
                                            <a target="_blank" class="btn btn-xs" href="<?php echo base_url('Buyer/view_order_slip1/'.$row->order_code.''); ?>">
                                            View Slip

                                            </a>
                                        </div> -->
										
										
										
                                        <div class="action-buttons">
                                            <a class="btn btn-xs" target="_blank" href="<?php echo base_url('Buyer/view_payment_list/'.$row->user_id.'/'.$row->order_code.''); ?>">
                                           View Payment

                                            </a>
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


