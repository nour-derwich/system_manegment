<div class="page-content">
    <div class="page-header">
        <h1>
            Order Management
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
   
<input type="hidden" name="user_id" value="<?php echo $result_set[0]->user_id; ?>" />

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="tabbable tabs-left">
             

                <div class="tab-content">
                    <div id="" class="tab-pane active">
                        <h1>Order Information</h1>
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered table-hover">

                                <tbody>
                                <?php
							foreach($result_set as $key => $row) { 
							$user = $this->Mdl_Account->_get_user_list($row->user_id);
                               ?>
									<tr>
                                        <th>User Type</th>
                                        <td><?php echo $user[0]->user_type;?></td>
                                       
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $user[0]->name;?></td>
                                       
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <td><?php echo $user[0]->contact;?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $user[0]->address;?></td>
                                    </tr>
									<tr>
                                        <th>Order Date</th>
                                        <td><?php echo $row->order_date;?></td>
                                    </tr>

                                    <tr>
                                        <th>Order Code</th>
                                        <td><?php echo $row->order_code;?></td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td><?php $product_name = $this->Mdl_Account->get_relation_pax('product_list','product_name','id',$row->product_id);
									
									echo $product_name;?></td>
                                    </tr>
									<tr>
                                        <th>Other Features</th>
                                        <td><?php echo $row->other_features;?></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>Rs. <?php echo $row->sell_price;?></td>
                                    </tr>
                                  <tr>
                                        <th>Quantity</th>
                                        <td><?php echo $row->qty;?></td>
                                    </tr>
									 <tr>
                                        <th>Other Charges</th>
                                        <td>Rs. <?php echo $row->other_charges;?></td>
                                    </tr>
									 <tr>
                                        <th>Total Price</th>
                                        <td>Rs. <?php echo $row->total_price;?></td>
                                    </tr>
									<?php
									
									$payment_list = $this->Mdl_Account->_get_payment_list($row->user_id,$row->order_code);
									$p = 0;
									$r = 0;
									foreach($payment_list as $payment){
										$p = $p + $payment->paid_price;
										$r = $r + $payment->remaining_price;
									}
									
									?>
									 <tr>
                                        <th>Paid Price</th>
                                        <td>Rs. <?php echo $p;?></td>
                                    </tr>
									 <tr>
                                        <th>Remaining Price</th>
                                        <td>Rs. <?php echo $row->total_price - $p;?></td>
                                    </tr>
									
<?php
							}
?>
                                </tbody>
                            </table>
                        </div>

                    </div>

              
                </div>
            </div>




        </div>

    <?php echo form_close();  ?>
    </div>

</div>