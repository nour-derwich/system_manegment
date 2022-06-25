<?php


//if($get_product){$row = $get_product;}
$personal_id = $this->uri->segment(3);
$id = $this->uri->segment(4);
//$user_type = $this->session->userdata('user_type');
//$country_id = $this->session->userdata('country_id');

//$category_dd         = Modules::run('Hierarchy/category_dd');
$country_dd         = Modules::run('Hierarchy/country_dd');
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
                Add /Edit New File
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
                'class' => 'form-horizontal form-validate-file',
                'id'    => '',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Client/file_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="client_id" id="client_id" value="<?php echo $file_record[0]->client_id; ?>">
            <input type="hidden" name="personal_id" id="personal_id" value="<?php echo $personal_id; ?>">
            <input type="hidden" name="old_image" id="old_image" value="<?php echo $file_record[0]->image_name;?>">
            <input type="hidden" name="file_id" id="file_id" value="<?php echo $file_record[0]->id;?>">
            
			
			<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#">Add / Edit File Detail</a>
			</div>
		  	<div id="deal" class="panel-body">
			
		
		<div id="search_fileid_result" class="search_fileid_result">	
		    <div class="row">
			
			<div class="col-md-4">
				<div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">File Detail</label>
				    <div class="col-md-9">
				       <textarea id="detail" name="detail" value="" placeholder="File Detail" class="form-control required-field"><?php echo $file_record[0]->detail; ?></textarea>
				    </div>
				</div>
			</div>
			
			
			<div class="col-md-4">
			
				  <div class="form-group">
				    <label for="inputEmail3" class="col-md-3 control-label">File</label>
				    <div class="col-md-9">
				      <input type="file" id="client_file" name="client_file" value="<?php echo $file_record[0]->image_name; ?>" placeholder="File" class="form-control required-field">
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


