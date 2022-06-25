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

//print_r($file_record);
?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Client Management
            <small>
                <i class="icon-double-angle-right"></i>
               View File Detail
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
		
		  <a href="<?php echo base_url('Client/file_action/'.$id); ?>" class="pull-left btn bigger-50 ws-btn-font btn-sm  btn-success">Add New </a>
		  <div style="clear:both;"></div>
		  <br/>
		<div id="" class="">	
			 <div class="space-2"></div>
			 
			 
			 
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                          Client File List
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>                                 	  
                                <th>S.No</th>                           
                                <th>Detail</th>
                                <th>File</th>
                                <th>File Date</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
								 $i=1;
                                foreach($file_record as $res):
								$fileid=$res->id;		
                             
                                $create_date=$res->create_date;
                                $image_name=$res->image_name;
                                $detail=$res->detail;
                                   ?>
                                    <tr>
                                   <td><?php echo $i; $i++;?></td>
                                  
                                    <td><?php echo $detail; ?></td>

                                    <td>

                                        <a class="fancybox" href="<?php echo base_url(); ?>public_html/frontend/image/file/<?php echo $image_name; ?>" data-fancybox-group="gallery" title=""><img src="<?php echo base_url(); ?>public_html/frontend/image/file/<?php echo $image_name; ?>" alt="" style="height:50px;width:50px;" /></a>


                                    </td>
                                    <td><?php echo $create_date; ?></td>

                                  
                                        <td>

                                            <a class="btn mini btn-xs black" href="<?php echo base_url("Client/file_action/".$id."/".$fileid); ?>">Edit </a> 
											
											<!--
                                            <a class="btn mini black" href="#" onclick="if (confirm('Are you sure you want to delete ?')) window.location='include/process.php?action=deletefile&id=<?php //echo $fileid; ?>&pid=<?php //echo $pid; ?>'; return false;">Delete</a>
											-->


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
                var oTable1 = $('#product-table1').dataTable(
                    {
                        "aoColumns":
                            [
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


