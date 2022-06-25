<?php
$category_dd         = Modules::run('Hierarchy/category_dd');
$user_dd         = Modules::run('Hierarchy/buyer_dd2');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Buyer Management
            <small>
                <i class="icon-double-angle-right"></i>
               Add Order
            </small>
            
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
        <div class="col-xs-12 col-sm-12">

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-inventory',
                'id'    => 'register-form',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Buyer/order_submit'), $attributes);
            ?>    <input type="hidden" name="order_user_id" id="order_user_id" value="">
            <input type="hidden" name="order_remaining_amount" id="order_remaining_amount" value="">
            <input type="hidden" name="old_order_code" id="old_order_code" value="">
            <input type="hidden" name="old_payment_id" id="old_payment_id" value="">
            <input type="hidden" name="old_order_id" id="old_order_id" value="">
            <!-- PAGE CONTENT BEGINS -->
<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">User Info</a>
			</div>
		  	<div id="deal" class="panel-body">
		    	<div class="col-md-6">
				  
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Select User</label>
				    <div class="col-md-9">
				       <?php
                        echo form_dropdown(
                            'new_user',
                            $user_dd,$row[0]->new_user,
                            'class  ="new_user form-control required-field "
                        id     ="new_user" placeholder="User"');
                        ?>
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Name</label>
				    <div class="col-md-9">
					<input type="text" id="name" name="name" value="" placeholder="Name" class="form-control">
				     
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Slip No</label>
				    <div class="col-md-9">
					<input type="text" id="slip_no" name="slip_no" value="" placeholder="Slip No" class="form-control">
				     
				    </div>
				  </div>
				

				  

				</div>

				<div class="col-md-6">
 <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Contact</label>
				    <div class="col-md-9">
				      <input type="text" id="contact" name="contact" value="" placeholder="Contact" class="form-control">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-md-3 control-label">Address </label>
				    <div class="col-md-9">
				      <textarea id="address" name="address" value="" placeholder="Address" class="form-control"></textarea>
				    </div>
				  </div>

			
				  
				  
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Cart Info</a>
			</div>
		  	<div id="deal" class="panel-body">
			<div id="payment" class="panel-body">
		  		<div class="col-md-12">
		  			<table class="table-responsive table-condensed">
		  				<thead>
			  				<tr>
			  					
		  						<th colspan="2">Sr. No: </th>
								<th>Description: </th>
								<th>Quantity: </th>							
								<th>Unit Price: </th>								
								<th>Amount: </th>
			  				</tr>
		  				</thead>
		  				<tbody>
		  					<tr>
		  						<td colspan="2">
								<input type="number" name="srno" id="srno" value="1" />
								</td>
		  						<td colspan="">
		  							<textarea name="des" id="des"></textarea>
		  						</td>
		  						
								
		  						<td>
		  							
									 <input type="number" id="qty" style="" name="qty" class="form-control" placeholder="" value="1">
									
		  						</td>
		  						
		  						<td>
								<input type="text" id="pprice" name="pprice" style=""  class="form-control pprice" placeholder="" value="">
								

								
		  						</td>
		  					
						
								<td>
		  							<input type="text" id="totalp" name="totalp" readonly class="form-control" placeholder="" value="" />
		  						</td>
		  					</tr>
		  				</tbody>
		  				
			</table>
			<div class="pull-right">
		  							<a href="#" id="insert" class="btn btn-primary">Add Card</a>
		  						</div>
								<div style="clear:both;"></div>
								
		  		<div id="ccinfo" class="col-md-12 <?= !empty($cc_details) ? '' : 'hidden' ?>">
		  			<table id="cctable" class="table-responsive table-condensed">
		  			<thead>
			  				<tr>
			  					<th>Action</th>
		  							<th colspan="">Sr. No: </th>
								<th>Description: </th>
								<th>Quantity: </th>							
								<th>Unit Price: </th>								
								<th>Amount: </th>
			  				</tr>
		  				</thead>
		  				<tbody>
		  					<?php
		  						if(!empty($cc_details)){
		  							/* foreach ($cc_details as $cc_detail) { ?>
		  								<tr>
		  									<td><input type='checkbox' name='record'></td>
		  									<td>
		  										<input type='text' readonly name='cc_number[]' value='<?= $cc_detail->cc_number ?> '>
		  									</td>
		  									<td><input type='text' readonly name='cvc[]' value='<?= $cc_detail->cvc ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='exp[]' value='<?= $cc_detail->exp ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='apr[]' value='<?= $cc_detail->apr ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='owe[]' value='<?= $cc_detail->owe ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='avail[]' value='<?= $cc_detail->avail ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='int_rate[]' value='<?= $cc_detail->int_rate ?> '>
		  									</td>
		  									<td>
		  										<input type='text' readonly name='bank[]' value='<?= $cc_detail->bank ?> '>
		  									</td>
		  									<td>
		  										<input type='text'  name='bank_tollfree[]' value='<?= $cc_detail->bank_tollfree ?> '>
											</td>
											<td>
		  										<input type='text'  name='min_pay[]' value='<?= $cc_detail->min_pay ?> '>
											</td>
											<td>
		  										<input type='text'  name='last_pay[]' value='<?= $cc_detail->last_pay ?> '>
											</td>
											<td>
		  										<input type='text'  name='current_pay[]' value='<?= $cc_detail->current_pay ?> '>
											</td>
											<td>
		  										<input type='text'  name='next_pay[]' value='<?= $cc_detail->next_pay ?> '>
											</td>
											<td>
		  										<input type='text'  name='last_pay_date[]' value='<?= $cc_detail->last_pay_date ?> '>
											</td>
											<td>
		  										<input type='text'  name='next_pay_date[]' value='<?= $cc_detail->next_pay_date ?> '>
		  									</td>
		  								</tr>
		  					<?php	} */
		  						}
		  					?>
		  				</tbody>
		  			</table>
		  				<button type="button" id="delete-row" class="delete-row btn btn-danger btn-xs">Delete Record</button>
		  		</div>
				
		  		</div>
		  	</div>
	
			
			</div>
		</div>	
           



<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Payment Info</a>
			</div>
		  	<div id="deal" class="panel-body">
		    	<div class="col-md-6">
				  
				  	<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Previous Price</label>
				    <div class="col-md-9">
				      <input type="text" id="pre_remaining__price" readonly name="pre_remaining__price" value="0" placeholder="" class="form-control pre_remaining__price valid">
				    </div>
				  </div>
				  
				  
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Cart Total Price</label>
				    <div class="col-md-9">
					<input type="text" id="cart_total_price" readonly name="cart_total_price" value="0" placeholder="" class="form-control cart_total_price valid">
				     
				    </div>
				  </div>
				  	 <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Total Price</label>
				    <div class="col-md-9">
					<input type="text" id="total_price" readonly name="total_price" value="0" placeholder="" class="form-control total_price valid">
				     
				    </div>
				  </div>

				  

				</div>

				<div class="col-md-6">
	 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Paid Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="paid_price" name="paid_price" value="" placeholder="Paid Price" class="col-xs-10 col-sm-9 paid_price" />
                    </div>
                </div>
            </div>
					 <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Remaining Price </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="remaining_price" readonly name="remaining_price" value="" placeholder="Remaining Price" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>

			
				  
				  
				</div>
			</div>
		</div>
	

		   <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                  <button class="btn btn-info btn-validate" name="" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>

                </div>
            </div>



            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->

		
	<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
$(document).ready(function(){
	
$("#insert").click(function () {
	$("#ccinfo").removeClass( "hidden" );
	$("#ccinfo input[type=text] input[type=checkbox]").addClass( "form-group" );
	$("#cctable").css("table-layout","fixed").width("100%");
	var cat = $("#search_cat_id").val();
    var scat_id = $("#scat_id").val();
	var srno = $("#srno").val();
	var des = $("#des").val();
	var cname = $("#cname").val();
	var sname = $("#sname").val();
	var pprice = $("#pprice").val();
	var sprice = $("#sprice").val();

	var qty = $("#qty").val();
	var totalp = $("#totalp").val();
	
	var pre_remaining__price = $("#pre_remaining__price").val();
	var cart_total_price = $("#cart_total_price").val();
	var total_price = $("#total_price").val();

	var final_cart_total_price = parseFloat(cart_total_price) + parseFloat(totalp);
	$("#cart_total_price").val(final_cart_total_price);
	
	var final_price = parseFloat(pre_remaining__price) + parseFloat(final_cart_total_price);
	$("#total_price").val(final_price);
	//$("#record").attr("totalprc",totalp);
	
	
    var markup = "<tr><td><input type='checkbox' totalprc='"+totalp+"' class='record' name='record'></td><td><input type='text' class='form-control' readonly name='srno[]' value='" + srno + "'></td><td><input type='text' class='form-control' readonly name='des[]' value='" + des + "'></td><td><input type='text' class='form-control' readonly name='qty[]' value='" + qty + "'></td><td><input type='text' readonly name='pprice[]' class='form-control' value='" + pprice + "'></td><td><input type='text' readonly class='form-control' name='totalp[]' value='" + totalp + "'></td></tr>";
    $("#cctable tbody").append(markup);
    
	
	$("#search_cat_id").val("");
    $("#scat_id").val("");
	$("#srno").val("");
	$("#des").val("");
	$("#cname").val("");
	$("#sname").val("");
	$("#pprice").val("");
	$("#sprice").val("");
	
	$("#qty").val("1");
	
	$("#totalp").val("");
	
	
});


// Find and remove selected table rows
$(".delete-row").click(function(){
    $("#cctable tbody").find('input[name="record"]').each(function(){
    	if($(this).is(":checked")){
			/* var id = $(this).attr("ref");
			//console.log(id);
			 $.ajax({
				type: "POST",
				url: base_url+"Users/delete_cc_details",
				data: {id: id},
				success: function(data){
					console.log(data);
					$("#flashmsg").html(data);
					
				}
			}); */
			var totalp = $(this).attr("totalprc");
			//console.log(totalp);
	var pre_remaining__price = $("#pre_remaining__price").val();
	var cart_total_price = $("#cart_total_price").val();
	var total_price = $("#total_price").val();

	var final_cart_total_price = parseFloat(cart_total_price) - parseFloat(totalp);
	$("#cart_total_price").val(final_cart_total_price);
	
	//var final_price = parseFloat(pre_remaining__price) + parseFloat(final_cart_total_price);
	$("#total_price").val(final_cart_total_price);
		
            $(this).parents("tr").remove();
				
        }
    });
});
});	
	</script>
	
	
	
	
	
	
	
	
             

             




            <!--/////////////////////Deal price ////////////////////////////// -->
           

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