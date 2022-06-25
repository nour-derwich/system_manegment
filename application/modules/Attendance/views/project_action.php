<?php


if($get_product){$row = $get_product;}
$id = $this->uri->segment(3);
//$load              = $this->Mdl_hierarchy;
// $markaz_dd         = Modules::run('Hierarchy/markaz_dd');

$country_dd         = Modules::run('Hierarchy/country_dd');
//print_r($row);
//$city_name = $this->Mdl_project->get_relation_pax('city_list','city_name','id',$row[0]->city_id);
//$branch_name = $this->Mdl_project->get_relation_pax('branch_list','branch_name','id',$row[0]->branch_id);
//$project_name = $this->Mdl_project->get_relation_pax('project_list','project_name','id',$row[0]->project_id);


/* $user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');

$category_dd         = Modules::run('Hierarchy/category_dd');
$country_dd         = Modules::run('Hierarchy/country_dd');
$subcategory_name = $this->Mdl_product->get_relation_pax('category_list','category_name','id',$row[0]->subcategory_id);
$state_name = $this->Mdl_product->get_relation_pax('state_list','state_name','id',$row[0]->state);
$city_name = $this->Mdl_product->get_relation_pax('city_list','title','id',$row[0]->city);


$seller_dd         = Modules::run('Hierarchy/get_seller_list'); */


?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Attendance Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Attendance
            </small>
            <a href="<?php echo base_url('Attendance/attendance_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>
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
                'class' => 'form-horizontal form-validate-product',
                'id'    => 'register-form',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Attendance/project_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
     
	        
			
		<div class="row">
        
           
                 <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail3" class="col-md-3 control-label">Guard</label>
                    <div class="col-md-9">
                        <select class="form-control" name="guard" >
                            <option value="">Select Guard Name</option>

                        <?php 
                        $client_personal_list = $this->db->get('client_personal_list')->result();

                        if($client_personal_list)
                        {

                            foreach($client_personal_list as $row)
                            { ?>
                                <option value="<?=$row->id;?>" ><?=$row->name;?></option>

                            <?php }

                        }

                        ?>
                        </select>
                     
                    </div>
                </div>
            
            </div>
   <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail3" class="col-md-3 control-label">Date</label>
                    <div class="col-md-9">
                   <input type="date" class=" form-control"  value="<?=date('Y-m-d')?>" name="Attendance_date">
                     
                    </div>
                </div>
            
            </div>

 <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail3" class="col-md-3 control-label">Time</label>
                    <div class="col-md-9">
                   <input type="time" class=" form-control"  value="<?=date('H:i:s')?>" name="Attendance_time">
                     
                    </div>
                </div>
            
            </div>

        </div>
			
        

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                    <a class="btn"  href="<?php echo base_url('Project/project_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a>
                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-info btn-validate" name="save_product" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>

            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


