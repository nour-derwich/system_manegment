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
               View Client Detail
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
								
									<th>Name</th>
                                    <th>Father Name</th>
                                    <th>Contact No.</th>
                                    <th>CNIC No.</th>
                                    <th>Present Address</th>
                                    <th>Status</th>
                                    <th>Marital Status</th>
                                    <th>Sect</th>
                                    <th>Religion</th>
                                    <th>Date of Birth</th>
                                    <th>Education</th>
                                    <th>Name/Relation Next of Kin</th>
                                    <th>Address Next of Kin</th>
                                    <th>Cheque (Terms & Condition)</th>
                                    <th>Company No. Allocated</th>
                                    <th>Date Of Enrollment</th>
                                    <th>Weapon</th>
                                </tr>
                                </thead>
                                <tbody>
                               
                                    <tr>
                                       <td><?php echo $client_record->file_no; ?></td>
									
                                        <td><?php echo $client_record->name; ?></td>
                                        <td><?php echo $client_record->f_name; ?></td>
                                        <td><?php echo $client_record->ocntact_no; ?></td>
                                        <td><?php echo $client_record->cnic_no; ?></td>
                                        <td><?php echo $client_record->present_address; ?></td>
                                        <td><?php echo $client_record->status_name; ?></td>
                                       
                                        <td><?php echo $client_record->marital_status_name; ?></td>
                                        <td><?php echo $client_record->sect_name; ?></td>
                                        <td><?php echo $client_record->religion_name; ?></td>
                                        <td><?php echo $client_record->dob; ?></td>
                                        <td><?php echo $client_record->education; ?></td>
                                        <td><?php echo $client_record->kin_name; ?></td>
                                        <td><?php echo $client_record->kin_address; ?></td>
                                        <td><?php echo $client_record->cheque; ?></td>
                                        <td><?php echo $client_record->company_no; ?></td>
                                        <td><?php echo $client_record->enrollment_date;?></td>

										 <td><?php if($client_record->weapon > 0){ echo  $this->db->get('weapon_list')->row()->weapon_name;} ?></td>
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
         

		
		
		   
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


