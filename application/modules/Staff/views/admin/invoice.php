<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo ucwords('Invoice/Payment list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo ucwords('Add Invoice/Payment');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
								    <?php
					
					//print_r($this->session->flashdata());
					
    if($success)
    {
    ?>
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        Success !
                    </strong>
                    <?php echo $success; ?>
                </p>
            </div>
        <?php
    } 
if($error)
    {
    ?>
            <div class="alert alert-block alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        Error !
                    </strong>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php
    } 	?>
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>Staff</div></th>
                    		<th><div><?php echo ucwords('title');?></div></th>
                    		<th><div><?php echo ucwords('description');?></div></th>
                    		<th><div><?php echo ucwords('amount');?></div></th>
                    		<th><div><?php echo ucwords('status');?></div></th>
                    		<th><div><?php echo ucwords('date');?></div></th>
                    		<th><div><?php echo ucwords('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->Mdl_staff->get_type_name_by_id1('staff_list',$row['staff_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['amount'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- VIEWING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Staff/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-credit-card"></i>
                                                <?php echo ucwords('view_invoice');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Staff/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo ucwords('edit');?>
                                            </a>
                                                    </li>
                             
                                    
                                    <!-- DELETION LINK -->
                                    <!--<li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo ucwords('delete');?>
                                            </a>
                                                    </li>-->
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url('Staff/invoice_submit/create/') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Staff</label>
                                <div class="col-sm-5">
                                    <select name="student_id" class="form-control" style="width:400px;" >
                                    	<?php 
										$this->db->order_by('staff_id','asc');
										$students = $this->db->get('staff_list')->result_array();
										foreach($students as $row):
										?>
                                    		<option value="<?php echo $row['staff_id'];?>">
                                                <?php echo $row['staff_code'];?> -
												<?php echo $row['name'];?>
                                            </option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords('title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" data-validate="required" data-message-required="Title is Required" class="form-control" name="title"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords('description');?></label>
                                <div class="col-sm-5">
                                    <textarea data-validate="required" data-message-required="Description is Required" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords('amount');?></label>
                                <div class="col-sm-5">
                                    <input type="text" data-validate="required" data-message-required="Amount is Required" class="form-control" name="amount"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords('status');?></label>
                                <div class="col-sm-5">
                                    <select name="status" data-validate="required" data-message-required="Status is Required" class="form-control" style="width:100%;">
                                    	<option value="paid"><?php echo ucwords('paid');?></option>
                                        <option value="unpaid"><?php echo ucwords('unpaid');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords('date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" data-validate="required" data-message-required="Date is Required" class="datepicker form-control" name="date"/>
                                </div>
                            </div>
                        		<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo ucwords('Add Invoice');?></button>
                              </div>
								</div>
                    	</form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

