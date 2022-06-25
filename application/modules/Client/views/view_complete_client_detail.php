<?php


//if($get_product){$row = $get_product;}
$id = $this->uri->segment(3);
//$user_type = $this->session->userdata('user_type');
//$country_id = $this->session->userdata('country_id');

//$category_dd         = Modules::run('Hierarchy/category_dd');
$country_dd         = Modules::run('Hierarchy/country_dd');
//$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);
//$state_name = $this->Mdl_product->get_relation_pax('state_list','state_name','id',$row[0]->state);
//$city_name = $this->Mdl_product->get_relation_pax('city_list','title','id',$row[0]->city);


//$seller_dd         = Modules::run('Hierarchy/get_seller_list');


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Client Management
            <small>
                <i class="icon-double-angle-right"></i>
               View Complete Client Detail
            </small>
            <!--<a href="<?php //echo base_url('Client/client_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>-->
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

	$user_type  = $this->session->userdata('user_type');
	?>


    <div class="row">
        <div class="col-xs-12 col-sm-12">
		<div id="search_result_client_record" class="search_result_client_record">	
			 <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                          Client Personal Detail
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                   
                                <th>File No.</th>
									 <?php
									 if($user_type == "1")
									{	
									?>
									<th>Country</th>
                                    <th>City</th>
                                    <th>Branch</th>
                                    <?php
									
									}
									?>
                                    <th>Name</th>
                                    <th>S/O, D/O, W/O</th>
                                 
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>     
                                    

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($client_record as $res):

                                   ?>
                                    <tr>
                                       <td><?php echo $res->file_no; ?></td>
										 <?php
									 if($user_type == "1")
									{	
									?>
                                        <td><?php echo $country_name; ?></td>
                                        <td><?php echo $city_name; ?></td>
                                        <td><?php echo $branch_name; ?></td>
										<?php
										}
										?>
										
                                        <td><?php echo $res->name; ?></td>
                                        <td><?php echo $res->so_name; ?></td>
                                       
                                        <td><?php echo $res->email; ?></td>
                                        <td><?php echo $res->postal_address; ?></td>
                                        <td><?php echo $res->contact1.", ".$res->contact2; ?></td>
										
                                   </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!--</div>
		</div>-->
        <script type="text/javascript">
            jQuery(function($)
            {
                var oTable1 = $('#product-table1').dataTable(
                    {
                        "aoColumns":
                            [
                                { "bSortable": true },
								 <?php
									 if($user_type == "1")
									{	
									?>
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                <?php
									}
								?>
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
		
		<br/>
         
		<div id="" class="">	
			 <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                          Client Invoice Detail
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                   
                                 <th>Client Code.</th>  
                                    <th>Cottage No</th>
                                    <th>Floor</th>
                                    <th>C/O</th>
                                    <th>Cnic</th>
                                    <th>Nomine</th>
                                    <th>Relation</th>
                                    <th>Nomine Address</th>
                                    <th>Date</th>
                                    <th>Cash</th>
                                    <th>Loan</th>                                  
									<th>Documentation</th>                                   
									<th>Discount</th>								  
									<th>Total Cost</th>
                                   
                                    

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($client_invoice_record as $res):

                                   ?>
                                    <tr>

                                        <td><?php echo $res->client_code;?></td>
                                        <td><?php echo $res->cottage_no;?></td>
                                        <td><?php echo $res->floor;?></td>
                                        <td><?php echo $res->co;?></td>
                                        <td><?php echo $res->cnic;?></td>
                                        <td><?php echo $res->nomine;?></td>
                                        <td><?php echo $res->relation;?></td>
                                        <td><?php echo $res->nomine_address;?></td>
                                        <td><?php echo $res->mydate;?></td>
                                        <td><?php echo $res->cash;?></td>
                                        <td><?php echo $res->loan;?></td>
                                        <td><?php echo $res->documentation;?></td>
                                        <td><?php echo $res->discount;?></td>
                                        
                                 
                                        <td><?php echo $res->total_cost;?></td>
                                      
                                     
                                   </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!--</div>
		</div>-->
        <script type="text/javascript">
            jQuery(function($)
            {
                var oTable1 = $('#product-table').dataTable(
                    {
                        "aoColumns":
                            [
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": true },
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
		
			
		<br/>
         
		<div id="" class="">	
			 <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                          Client Payment Detail
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table2" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                   
                                 <th>Date</th>
                                    <th>Receipt</th>
                                    <th>Payment Type</th>
                                    <th>Description</th>
                                    <th>Running Total</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                   
                                    

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($client_payment_record as $res):
									$payment_type=$res->payment_type;
                                    $check_status=$res->check_status;
                                   ?>
                                    <tr>

                                        <td><?php echo $res->payment_date;?></td>
                                        <td><?php echo $res->payment_code;?></td>
                                     
                                        <td><?php if($payment_type == "check")
									{
										if($check_status == 1)
										{
										echo $payment_type."   <span style='background-color:green;padding:5px;margin-left:10px;color:#fff;'>Clear</span>";
										}
										else
										{
										echo $payment_type."   <span style='background-color:red;padding:5px;margin-left:10px;color:#fff;'>Pending</span>";
										}
									}else
									{
										echo $payment_type;
									}
									?></td>
                                        <td><?php echo $res->description;?></td>
                                        <td><?php echo $res->paid;?></td>
                                        <td><?php echo $res->remarks;?></td>
                                        <td>
										 <a target="_blank" class="btn btn-xs" href="<?php echo base_url('Client/view_payment_slip/'.$res->id); ?>">
                                            View Slip

                                            </a>
										</td>
                                     
                                   </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
							
							<br/><br/>
							<table class="table table-striped table-bordered table-hover">
							<tbody>
							  <tr>
							  
                                    
									<td><b>Total Amount:</b></td>
                                        <td><?php echo $client_payment_total; ?></td>
                                        <td><b>Discount Amount:</b></td>
                                        <td><?php echo $client_discount_total; ?></td>
										 
                                        
                                </tr>
								<tr>
								
										<td><b>Paid Amount:</b></td>
                                        <td><?php echo $client_paid_total; ?></td>
                                        <td><b>Remaining Amount:</b></td>
                                        <td><?php echo ($client_payment_total - $client_paid_total); ?></td>
										
                                        
                                </tr>
							</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!--</div>
		</div>-->
        <script type="text/javascript">
            jQuery(function($)
            {
                var oTable1 = $('#product-table2').dataTable(
                    {
                        "aoColumns":
                            [
                                { "bSortable": true },
                                { "bSortable": true },
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
		
		
		   
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


