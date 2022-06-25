<?php



$id = $this->uri->segment(3);


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Authority Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add New Authority 
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
                'class' => 'form-horizontal form-validate-authority',
                'id'    => '',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Authority/Authority_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
           
            
			
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Authority Personal Detail</a>
			</div>
		  	<div id="deal" class="panel-body">
			

		
		<div id="search_fileid_result" class="search_fileid_result">	
		    <div class="row">
		
			
			<div class="col-md-4">
			
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Supervisor Name</label>
				    <div class="col-md-9">
				      <input type="text" id="name" name="name" required value="" placeholder="Name" class="form-control required-field">
				    </div>
				</div>
				
			</div>
			<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">CNIC</label>
				    <div class="col-md-9">
				      <input type="number" id="cnic" name="cnic" required value="" placeholder="CNIC" class="form-control required-field">
				    </div>
				</div>
			</div>
			
		</div>
		    <div class="row">
			<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Supervision</label>
				    <div class="col-md-9">
				      <input type="text" id="supervision" required name="supervision" value="" placeholder="Supervision" class="form-control required-field">
				    </div>
				</div>
			</div>
				<div class="col-md-4">	 
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">Client M/S</label>
				    <div class="col-md-9">
				      <input type="text" id="m/s" name="m/s" required value="" placeholder="Client M/S" class="form-control required-field">
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
                    <button class="btn btn-info btn-sm btn-validate" name="save_product1" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>  

                </div>
            </div>

            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

