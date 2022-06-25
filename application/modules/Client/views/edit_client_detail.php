<?php


//if($get_product){$row = $get_product;}
$id = $this->uri->segment(3);
//$user_type = $this->session->userdata('user_type');
//$country_id = $this->session->userdata('country_id');

//$category_dd         = Modules::run('Hierarchy/category_dd');
$status_dd         = Modules::run('Hierarchy/status_dd');
$religion_dd         = Modules::run('Hierarchy/religion_dd');
$sect_dd         = Modules::run('Hierarchy/sect_dd');
$marital_status_dd         = Modules::run('Hierarchy/marital_status_dd');
//$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);
//$state_name = $this->Mdl_product->get_relation_pax('state_list','state_name','id',$row[0]->state);
//$city_name = $this->Mdl_product->get_relation_pax('city_list','title','id',$row[0]->city);


//$seller_dd         = Modules::run('Hierarchy/get_seller_list');
//echo $file_code;

?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Client Management
            <small>
                <i class="icon-double-angle-right"></i>
                Edit Client Detail
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
    }  ?>


    <div class="row">
        <div class="col-xs-12 col-sm-12">

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-client',
                'id'    => '',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Client/edit_client_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
         
            
			
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Client Personal Detail</a>
			</div>
		  	<div id="deal" class="panel-body">
			
			  <?php
			if($this->session->userdata('user_type') == "1")
			{
			?>
			
			<div class="col-md-4">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Status</label>
				    <div class="col-md-9">
				       <?php
                        echo form_dropdown(
                            'status_id',
                            $status_dd,$row[0]->new_user,
                            'class  ="status_id status form-control required-field "
                        id     ="status_id" placeholder="Status"');
                        ?>
				    </div>
				  </div>
			</div>
			<div class="col-md-4">	  
				  <div class="form-group">
				  <label for="inputEmail3" class="col-md-3 control-label">Sect</label>
				    <div class="col-md-9">
					
					<?php
                        echo form_dropdown(
                            'sect_id',
                            $sect_dd,$row[0]->new_user,
                            'class  ="sect_id sect form-control required-field "
                        id     ="sect_id" placeholder="sect"');
                        ?>		     
				    </div>
				  </div>				  
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Religion</label>
				    <div class="col-md-9">
				     
					<?php
                        echo form_dropdown(
                            'religion_id',
                            $religion_dd,$row[0]->new_user,
                            'class  ="religion_id religion form-control required-field "
                        id     ="religion_id" placeholder="religion"');
                        ?>
				    </div>			    
				  </div>
			</div>
			<?php
			}
			?>
		<div id="search_fileid_result" class="search_fileid_result">	
		    <div class="row">
			<div class="col-md-4">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">Marital Status </label>
				    <div class="col-md-9">
					<?php
                        echo form_dropdown(
                            'marital_status_id',
                            $marital_status_dd,$row[0]->new_user,
                            'class  ="marital_status_id marital_status form-control required-field "
                        id     ="marital_status_id" placeholder="marital_status" value="$client_record[0]->marital_status_id;"');
                        ?>
				    </div>
				  </div>
			</div>
			
			<div class="col-md-4">
			
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Name</label>
				    <div class="col-md-9">
				      <input type="text" id="name" name="name" value="<?php echo $client_record[0]->name; ?>" placeholder="Name" class="form-control required-field">
				    </div>
				</div>
				
			</div>
			<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Father Name</label>
				    <div class="col-md-9">
				      <input type="text" id="f_name" name="f_name" value="<?php echo $client_record[0]->f_name; ?>" placeholder="Father Name" class="form-control required-field">
				    </div>
				</div>
			</div>
		</div>
		    <div class="row">
			<div class="col-md-4">
			  
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Present Address</label>
				    <div class="col-md-9">
					<textarea id="present_address" name="present_address" value="<?php echo $client_record[0]->present_address; ?>" placeholder="Present Address" class="form-control required-field"></textarea>
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Permanent Address</label>
				    <div class="col-md-9">
				       <textarea id="permanent_address" name="permanent_address" value="<?php echo $client_record[0]->permanent_address; ?>" placeholder="Permanent Address" class="form-control required-field"></textarea>
				    </div>
				</div>
			</div>
				<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">NIC Number</label>
				    <div class="col-md-9">
				      <input type="text" id="nic" name="nic_no" value="<?php echo $client_record[0]->nic_no; ?>" placeholder="NIC Number" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			</div>
			    <div class="row">
			<div class="col-md-4">	 			
				<div class="form-group">
				<label for="inputEmail3" class="col-md-3 control-label">Date of Birth</label>
				    <div class="col-md-9">
				      <input type="date" id="dob" name="dob" value="<?php echo $client_record[0]->dob; ?>" placeholder="Date of Birth" class="form-control required-field">
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Education</label>
				    <div class="col-md-9">
				      <input type="text" id="education" name="education" value="<?php echo $client_record[0]->education; ?>" placeholder="Education" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Name/Relation Next of Kin</label>
				    <div class="col-md-9">
				      <input type="text" id="kin_name" name="kin_name" value="<?php echo $client_record[0]->kin_name; ?>" placeholder="Name/Relation Next of Kin" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			</div>
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Address Next of Kin</label>
				    <div class="col-md-9">
				       <textarea id="kin_address" name="kin_address" value="<?php echo $client_record[0]->kin_address; ?>" placeholder="Address Next of Kin" class="form-control required-field"></textarea>
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Cheque (Terms & Condition)</label>
				    <div class="col-md-9">
				      <input type="text" id="terms_cond" name="terms_cond" value="<?php echo $client_record[0]->cheque; ?>" placeholder="Cheque (Terms & Condition)" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Company No. Allocated</label>
				    <div class="col-md-9">
				      <input type="text" id="comp_no" name="comp_no" value="<?php echo $client_record[0]->company_no; ?>" placeholder="Company No. Allocated" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			
			</div>
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Date Of Enrollment</label>
				    <div class="col-md-9">
				      <input type="date" id="enrollment_date" name="enrollment_date" value="<?php echo $client_record[0]->enrollment_date; ?>" placeholder="Date Of Enrollment" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Contact No.</label>
				    <div class="col-md-9">
				      <input type="number" id="contact_no" name="contact_no" value="<?php echo $client_record[0]->contact_no; ?>" placeholder="Contact No." class="form-control required-field">
				    </div>
				</div>
			
			</div>

			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Weapon.</label>
				    <div class="col-md-9">
				    	<select class="form-control" name="weapon" >
				    		<option value="">Select Weapon Name</option>

				    	<?php 
				    	$weapon_list = $this->db->get('weapon_list')->result();

				    	if($weapon_list)
				    	{

				    		foreach($weapon_list as $row)
				    		{ ?>
				    			<option value="<?=$row->id;?>" <?php if($client_record[0]->weapon == $row->id){ echo 'selected';} ?>><?=$row->weapon_name;?> <?=$row->licensenumber;?></option>

				    		<?php }

				    	}

				    	?>
				    	</select>
				     
				    </div>
				</div>
			
			</div>
				<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Daily Wages</label>
				    <div class="col-md-9">
				      <input type="number" id="dailywages" name="dailywages" value="<?php echo $client_record[0]->dailywages; ?>" placeholder="Daily Wages" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			<!-- <div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Upload Picture</label>
				    <div class="col-md-9">
					<input type="hidden" name="old_img" value="<?php echo $client_record[0]->pic; ?>">
				      <input type="file" id="pic" name="pic"  class="form-control required-field" accept="image/*">
				    </div>
				</div>
			
			</div> -->
			</div>
			<div class="row">
					<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Client</label>
				    <div class="col-md-9">
				    	<select class="form-control" name="client" >
				    		<option value="">Select Client Name</option>

				    	<?php 
				    	$user_list = $this->db->get('user_list')->result();

				    	if($user_list)
				    	{

				    		foreach($user_list as $row)
				    		{ ?>
				    			<option value="<?=$row->id;?>" <?php if($client_record[0]->client_id == $row->id){ echo 'selected';} ?>><?=$row->name;?> </option>

				    		<?php }

				    	}

				    	?>
				    	</select>
				     
				    </div>
				</div>
			
			</div>
			<div class="col-md-4">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">File No </label>
				    <div class="col-md-9">
				     <input type="text" id="fileid" name="fileid" value="<?php echo $client_record[0]->file_no;?>" readonly  placeholder="File No"  class="check_fileno_exists form-control required-field">
				    </div>
				  </div>
			</div>
				<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Upload Picture</label>
				    <div class="col-md-9">
					<input type="hidden" name="old_img" value="<?php echo $client_record[0]->pic; ?>">
				      <input type="file" id="pic" name="pic"  class="form-control required-field" accept="image/*">
				    </div>
				</div>
			
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Upload Documents</label>
				    <div class="col-md-9">
					<input type="hidden" name="old_files" value="<?php echo $client_record[0]->documents; ?>">
				      <input type="file" id="docs" name="docs[]" value="" class="form-control required-field" multiple accept=".pdf,.jpg,.png,.jpeg">
				    </div>
				</div>
			
			</div>
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
                    <button class="btn btn-info btn-validate" name="save_product1" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>

            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


