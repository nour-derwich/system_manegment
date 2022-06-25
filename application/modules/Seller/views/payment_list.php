<div class="page-content">
    <div class="page-header">
        <h1>
            Seller Management
            <small>
                <i class="icon-double-angle-right"></i>
                Payment List
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
                        Results for Payment List

                    </div>

                    <div class="table-responsive">
                        <table id="payment_list_table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                
                                <th>Order Code</th>
                                <th>Sales Person</th>
                                <th>Payment Date</th>
                               
                              
                                <th>Paid Price</th>
                              
                                 <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            //print_r($result_set);
							$p = 0;
							$total_price = 0;
							//$r = 0;
                            foreach($result_set as $key => $row) 
							{ ?>

                                <tr>
                                   

                                    <td><?php echo $row->order_code;?></td>
                                    <td><?php echo $row->sales_person;?></td>
                                    <td><?php echo $row->payment_date;?></td>
                                   
									
									<?php
									$total_price= $this->Mdl_seller->get_relation_pax('order_list','total_price','order_code',$row->order_code);
									
									$p = $p + $row->paid_price;
									//$r = $r + $row->paid_price;
									
									?>
 <td>Rs. <?php echo $row->paid_price;?></td>                                   
								


									<td>
                                        <div class="action-buttons">
                                            <a target="_blank" class="btn btn-xs" href="<?php echo base_url('Seller/view_order_slip/'.$row->payment_id.'/'.$row->order_code.''); ?>">
                                            View Slip

                                            </a>
                                        </div>


                                    </td>

                                </tr>


                            <?php } ?>




                            </tbody>
                        </table>

<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<td style="width:50%;" colspan="2"></td>
<td style="text-align:right;"><b>Total Price: </b></td>
<td>Rs. <?php echo $total_price; ?></td>
</tr>

<tr>
<td style="width:50%;" colspan="2"></td>
<td style="text-align:right;"><b>Paid Price: </b></td>
<td>Rs. <?php echo $p; ?></td>
</tr>


<tr>
<td style="width:50%;" colspan="2"></td>
<td style="text-align:right;"><b>Remaining Price: </b></td>
<td>Rs. <?php echo $total_price-$p; ?></td>
</tr>


</tbody>
</table>						
						
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>


