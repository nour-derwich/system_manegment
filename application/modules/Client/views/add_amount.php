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
$id = $this->uri->segment(3);

?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Client Management
            <small>
                <i class="icon-double-angle-right"></i>
              Add Client Payment
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

 <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-payment',
                'id'    => '',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Client/payment_submit'), $attributes);
            ?>
	        <input type="hidden" id="personal_id" name="personal_id" value="<?php echo $id; ?>">
         
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Client Payment Detail</a>
			</div>
		  	<div id="deal" class="panel-body">
			  <div class="row">
			<div class="col-md-6">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Total Amount </label>
				    <div class="col-md-9">
				     <input type="text" id="total_amount" name="total_amount" value="<?php echo $client_payment_total; ?>" readonly placeholder="File No" class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
			<div class="col-md-6">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Discount Amount </label>
				    <div class="col-md-9">
				     <input type="text" id="discount_amount" name="discount_amount" value="<?php echo $client_discount_total; ?>" readonly placeholder="File No" class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
			<div class="col-md-6">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Paid Amount </label>
				    <div class="col-md-9">
				     <input type="text" id="paid_amount" name="paid_amount" value="<?php echo $client_paid_total; ?>" readonly placeholder="File No" class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
			<div class="col-md-6">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Remaining Amount</label>
				    <div class="col-md-9">
				     <input type="text" id="remaining_amount" name="remaining_amount" value="<?php echo ($client_payment_total - $client_paid_total); ?>" readonly placeholder="File No" class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
			
			</div>
			
			
			</div>
			</div>
	
		
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Add Client Payment</a>
			</div>
		  	<div id="deal" class="panel-body">
			
			
			 
			
		<div id="search_fileid_result" class="search_fileid_result">	
		    <div class="row">
			<div class="col-md-4">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Payment Date</label>
				    <div class="col-md-9">
				     <input type="date" id="mydate" name="mydate" value="" placeholder="Payment Date" class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
			
			<div class="col-md-4">
			
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Paid Amount</label>
				    <div class="col-md-9">
				      <input type="text" id="paid" name="paid" value="" placeholder="Paid Amount" class="form-control required-field">
				    </div>
				</div>
				
			</div>
			<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Payment Type</label>
				    <div class="col-md-9">
				        <select id="payment_type" name="payment_type" class="form-control">
                    <option value="">Select Payment Type</option>
                    <option value="cash">Cash</option>
                    <option value="check">Check</option>
                    <option value="pay">Pay Order</option>			  
                    <option value="online">Online Transfer</option>			  
                </select>
				    </div>
				</div>
			</div>
		</div>
		<p class="result_payment"></p>
		    <div class="row">
			<div class="col-md-4">
			  
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Payment Description</label>
				    <div class="col-md-9">
					<select id="payment_description" name="payment_description" class="form-control">
                    <option value="">Select Description</option>
                    <option value="Booking">Booking</option>
                    <option value="Confirmation">Confirmation</option>
                    <option value="Allocation + Installment">Allocation + Installment</option>			  
                    <option value="Installment">Installment</option>			  
                    <option value="Corner + Installment">Corner + Installment</option>			  
                </select>
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Remarks</label>
				    <div class="col-md-9">
				       <textarea id="remarks" name="remarks" value="" placeholder="Remarks" class="form-control required-field"></textarea>
				    </div>
				</div>
			</div>
				
			</div>
			    <div class="row">
			
			</div>
		</div>
			
			
			
			</div>
		</div>
		
		
            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">

<!--
                    <a class="btn"  href="<?php //echo base_url('Client/client_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a> -->
                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-sm btn-info btn-validate" name="save_product1" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>

            <?php echo form_close();  ?>
		
	

 </div><!-- /.page-content -->

</div>
