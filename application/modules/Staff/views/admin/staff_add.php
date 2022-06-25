<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Staff Form
            	</div>
            </div>
			<div class="panel-body">
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

			
                <?php echo form_open(base_url('Staff/staff_submit/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Name</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="Name is Required" value="" autofocus>
						</div>
					</div>
					
				
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Birthday</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2"  class="col-sm-3 control-label"><?php echo ucwords('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" data-validate="required" data-message-required="Gender is Required" class="form-control">
                              <option value=""><?php echo ucwords('select');?></option>
                              <option value="male"><?php echo ucwords('male');?></option>
                              <option value="female"><?php echo ucwords('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('address');?></label>
                        
						<div class="col-sm-5">
							<textarea class="form-control" data-validate="required" data-message-required="Address is Required" name="address" value="" ></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" data-validate="required" data-message-required="Phone is Required" class="form-control" name="phone" value="" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo ucwords('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" data-message-required="Email is Required" name="email" value="">
						</div>
					</div>
					
				
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo ucwords('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Add Staff</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>