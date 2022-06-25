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
               Client Record
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
            echo form_open_multipart(base_url('Client/client_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
            <input type="hidden" name="old_image" id="old_image" value="<?php echo $row[0]->product_image;?>">
            <input type="hidden" name="old_subimage" id="old_subimage" value="<?php echo $row[0]->featured_image;?>">
            
			
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Client Record</a>
			</div>
		  	<div id="deal" class="panel-body">
			<?php
			if($this->session->userdata('user_type') == "1")
			{
			?>
			<div class="col-md-4">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Country</label>
				    <div class="col-md-9">
				       <?php
                        echo form_dropdown(
                            'country_id',
                            $country_dd,$row[0]->new_user,
                            'class  ="country_id country form-control required-field "
                        id     ="country_id" placeholder="Country"');
                        ?>
				    </div>
				  </div>
			</div>
			<div class="col-md-4">	  
				  <div class="form-group">
				  <label for="inputEmail3" class="col-md-3 control-label">City</label>
				    <div class="col-md-9">
					
					<select id="city_id" required name="city_id" placeholder="City" class="city city_id form-control ">
                                    <option value="">Select City</option>

                                </select>			     
				    </div>
				  </div>				  
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Branch</label>
				    <div class="col-md-9">
				     
					<select id="branch_id" required name="branch_id" placeholder="Branch" class="branch branch_id form-control ">
                                    <option value="">Select Branch</option>

                                </select>	
				    </div>			    
				  </div>
			</div>
		<?php
			}
		?>
			<div class="col-md-4">	  
				  <div class="form-group">
				    <label class="col-md-3 control-label">File No </label>
				    <div class="col-md-9">
				     <input type="text" id="fileid" name="fileid" value="" placeholder="File No" class="form-control required-field">
				    </div>
				  </div>
			</div>
				<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Date</label>
				    <div class="col-md-9">
				      <input type="date" id="date" name="date" value="" placeholder="Date" class="form-control required-field">
				    </div>
				</div>
			</div>
			
			<div class="col-md-4">
			
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Name</label>
				    <div class="col-md-9">
				      <input type="text" id="name" name="name" value="" placeholder="Name" class="form-control required-field">
				    </div>
				</div>
				
			</div>
		
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Contact Number</label>
				    <div class="col-md-9">
				      <input type="text" id="contact1" name="contact1" value="" placeholder="Contact Number" class="form-control required-field">
				    </div>
				</div>
			
			</div>
			
			 <div class="col-md-4">
<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label"></label>
				    <div class="col-md-9">

				<button class="btn btn-sm btn-info btn-validate" name="search_client_record_submit" id="search_client_record_submit" type="button">
                        <i class="icon-search bigger-110"></i>
                        Search
                    </button>
				    </div>
				</div>                

				  </div>
			

		</div>
		</div>
		<div id="search_result_client_record" class="search_result_client_record">	
			 <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                           Result for Client Record
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                 <th width="5%">Picture</th>
                                 <th>File No.</th>  
                                 <th>Name</th>  
                                 <th>NIC No.</th>
                                  <th>Contact No.</th>
                                  <th>Weapon</th>
                                  <th width="2%">Action</th>
                                  <th width="5%">Detail</th>  	
                                  <th width="5%">Attachment</th>  	
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($client_record as $res):

                                   ?>
                                    <tr>
                                      
                                        <td>
                                        <?php if($res->pic !== null && !empty($res->pic)){ ?>
                                         <img id="pic" width="101" src="<?php echo base_url('public_html/frontend/image/guard').'/'.$res->pic;?>" alt="Profile pic" />
                                        <?php  }?>
                                        </td>
                                        <td><?php echo $res->file_no;?></td>
                                        <td><?php echo $res->name;?></td>
                                        <td><?php echo $res->nic_no;?></td>
                                        <td><?php echo $res->contact_no;?></td>
                                        <td><?php if($res->weapon > 0){ echo  $this->db->get('weapon_list')->row()->weapon_name;} ?></td>
                                        <td><a class="green" href="<?php echo base_url('Client/edit_client_detail/'.$res->id.''); ?>" target="_blank">
                                                        <i class="icon-pencil bigger-130"></i>
                                                    </a>
                                                </td>
                                     
                                        <td>
                                            <a class=" btn bigger-50 ws-btn-font  btn-success" target="_blank" href="<?php echo base_url('Client/view_client_detail/'.$res->id.''); ?>">
                                               View Detail
                                            </a>
                                        </td>
                                        <td>
                                            <a class="green bigger-50 ws-btn-font  btn" target="_blank" href="<?php echo base_url('Client/view_client_detail/'.$res->id.''); ?>">
                                               Attachment
                                            </a>
                                        </td>

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
                                { "bSortable": true },
                                { "bSortable": true },
                                { "bSortable": false }
                            ]
                    });
            });
        </script>
  
			
			
			</div>
		
		
		    <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


