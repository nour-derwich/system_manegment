<?php

$id = $this->uri->segment(3);
?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Authority Management
            <small>
                <i class="icon-double-angle-right"></i>
               Authority Record
            </small>
           
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
            echo form_open_multipart(base_url('Authority/authority_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
           
            	<div id="search_result_client_record" class="search_result_client_record">	
					
   <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                           Result for Authority
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                 <tr>
                                 
                                 <th>Supervisor Name</th>  
                                 <th>CNIC #</th>  
                                 <th>Supervision</th>
                                  <th>Client M/S</th>
                                  <th width="2%">Action</th>
                                  <th width="5%">Attachment</th>  	
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($authority_record as $res):

                                   ?>
                                    <tr>
                                      

                                         <td><?php echo $res->supervisor_name;?></td>
                                        <td><?php echo $res->cnic;?></td>
                                        <td><?php echo $res->supervision;?></td>
                                        <td><?php echo $res->M/S;?></td>
									
                                        
										<td>
                                            <a class="green" target="_blank" href="<?php echo base_url('Authority/edit_authority_detail/'.$res->id.''); ?>">
                                             <i class="icon-pencil bigger-130"></i>
                                            </a>
                                        </td>
                                        
                                      
                                        <td>
                                            <a class="green bigger-50 ws-btn-font  btn" href="<?php echo base_url('Authority/Authorityletter/generate/'.$res->id.''); ?>">
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
                                { "bSortable": false },
                                { "bSortable": false },
                          
                            ]
                    });
            });
        </script>
   	
			
			</div>

	
		
		
		    <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


