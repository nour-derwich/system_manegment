<?php 
$edit_data		=	$this->db->get_where('staff_list' , array('staff_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					Update Staff
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('Staff/staff_submit/update/do_update/'.$row['staff_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
					$staff_image = "";
			if (!empty($row['staff_image'])) {

							$image_pic1 = "public_html/frontend/image/staff/" . $row['staff_image'];
							//echo $image_pic;
							if(file_exists($image_pic1))
							{
								$staff_image =  base_url()."public_html/frontend/image/staff/" . $row['staff_image'];
							}
							else
							{
								$staff_image =  base_url().'public_html/frontend/user.jpg';
							}
			} else {
                        $staff_image=  base_url().'public_html/frontend/user.jpg';
                    }
			?>
			
			
			        
                	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo ucwords('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $staff_image; ?>" alt="">
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
						<label for="field-1" class="col-sm-3 control-label"><?php echo ucwords('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="Name is Required" value="<?php echo $row['name'];?>">
						</div>
					</div>
					
			
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" data-validate="required" data-message-required="Gender is Required" class="form-control">
                              <option value=""><?php echo ucwords('select');?></option>
                              <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo ucwords('male');?></option>
                              <option value="female"<?php if($row['sex'] == 'female')echo 'selected';?>><?php echo ucwords('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('address');?></label>
                        
						<div class="col-sm-5">
							<textarea data-validate="required" data-message-required="Address is Required"  class="form-control" name="address" value="" ><?php echo $row['address'];?></textarea>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo ucwords('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" data-message-required="Phone is Required" name="phone" value="<?php echo $row['phone'];?>" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo ucwords('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" data-message-required="Email is Required" name="email" value="<?php echo $row['email'];?>">
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Update Staff</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>