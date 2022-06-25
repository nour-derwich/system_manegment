<?php
$heading   = $param_view['heading'];  
$where     = $param_view['where'];
$links     = $param_view['links'];
$fillter_links     = $param_view['fillter_links'];
$column    = $param_view['column'];  
$col_count = count($column);
$fillter           = $param_view['fillter']; 
$count_fillter     = count($param_view['fillter']);
$table =  $this->uri->segment(2);
$load              = $this->Mdl_hierarchy;
# echo '<pre>'.print_r($column,1).'</pre>';
//print_r($where['country_id']);
?>

<div class="page-content">
    <input type="hidden" id="column_count" value="<?php echo $col_count; ?>">
    <div class="page-header">
        <h1>
            <?php
            echo  $heading['h1']; 
            ?>
            <small>
                <i class="icon-double-angle-right"></i>
                <?php  
                echo  $heading['small']; 
                ?> 
            </small>
        </h1>
		
        <?php
        if($count_fillter > 0)
        {
	
            ?>
            <a href="<?php echo base_url($fillter_links['edit']); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New</a>
            <?php  
			  
        }
        ?>
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
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <?php

            //Filter By Search
            if($count_fillter > 0)
            {

                $attributes = array(  
                    'class' => 'form-horizontal form-validate', 
                    'id'    => 'register-form', 
                    'role'  => 'form'
                );
                echo form_open_multipart(base_url($fillter_links['command']), $attributes);


                foreach($fillter as $fill_key => $fill){
                    //                                             echo $relation_pax[$fill['table']];

                    $dd_data = $load->{$fill['table']}();    


                    ?>


                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="<?php echo $fill_key; ?>">
                            <?php echo $fill_key; ?>:
                        </label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <?php

                                echo form_dropdown(
                                    $fill['name'],
                                    $dd_data,$selected  ,
                                    'class  ="col-xs-12 col-sm-6 '.$fill['class'].' "  
                                    id     ="'.$fill['name'].'" placeholder="'.$fill_key.'"');
                                ?>                                                
                            </div>
                        </div>
                    </div>             

                    <div class="space-2"></div>                     

                    <?php 
                }

                ?>

                <div class="clearfix form-actions">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 ">
                        <button class="btn btn-info btn-validate <?php echo $fillter_links['btn_click']; ?>" name="<?php

                            ?>" type="button">
                            <i class="icon-ok bigger-110"></i>
                            Search
                        </button>

                        <!--         &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                        <i class="icon-undo bigger-110"></i>
                        Reset
                        </button>-->
                    </div>
                </div>





                <?php echo form_close();  	

                ?>

                <div class="filter_result"></div>
                <?php



            } else {
                ?>


                <div class="row">
                    <div class="col-xs-12">

                        <div class="table-header">
                            Results for <?php echo $heading['small'];?> 
							<?php
							
							if($table != "logo_list" && $table != "system_setting_list")
							{
				  ?>
                            <a href="<?php echo base_url($links['edit']); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New</a>
							<?php
							}
							?>
                        </div>

                        <div class="table-responsive">
                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach($column as $col => $val)
                                        {
                                            echo '<th>'.$val.'</th>';   
                                        } 
                                        if($table == "token_purpose")
                                        {
                                            echo "<th>Logo</th>";    
                                        }
										if($table != "logo_list" && $table != "system_setting_list")
                                        {
                                        ?>                                                    
                                        <th>Status</th>
										<?php
										}
										?>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach($result_set as $key => $row) { ?>

                                        <tr>
                                            <?php 

                                            //exit;

                                            foreach($column as $col => $val){ 

                                               if($val == "Slider Image")
                                               {



                                                   if($row->$col != "")
                                                   {
                                                   ?>
                                                   <td><img src="<?php echo base_url().'public_html/frontend/image/slider/'.$row->$col; ?>" style="height:100px;width:100px;" /></td>
                                               <?php
                                               }
                                               else
                                               {
                                                   echo "<td></td>";

                                               }


                                               }else  if($val == "Brand Image")
                                               {

                                                   if($row->$col != "")
                                                   {
                                                       ?>
                                                       <td><img src="<?php echo base_url().'public_html/frontend/image/brand/'.$row->$col; ?>" style="height:100px;width:100px;" /></td>
                                                   <?php
                                                   }
                                                   else
                                                   {
                                                       echo "<td></td>";

                                                   }

                                               }
											   else  if($val == "Logo Image")
                                               {

                                                   if($row->$col != "")
                                                   {
                                                       ?>
                                                       <td><img src="<?php echo base_url().'public_html/frontend/image/logo/'.$row->$col; ?>" style="height:100px;width:100px;" /></td>
                                                   <?php
                                                   }
                                                   else
                                                   {
                                                       echo "<td></td>";

                                                   }

                                               }
											   else  if($val == "System Image")
                                               {

                                                   if($row->$col != "")
                                                   {
                                                       ?>
                                                       <td><img src="<?php echo base_url().'public_html/frontend/image/system/'.$row->$col; ?>" style="height:100px;width:100px;" /></td>
                                                   <?php
                                                   }
                                                   else
                                                   {
                                                       echo "<td></td>";

                                                   }

                                               }
											   else  if($val == "Show Logo")
                                               {

                                                   
                                                       ?>
													   <td>
                                                         <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->$col == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_logo" />
                                                        <span class="lbl"></span>
                                                    </label>
													</td>
                                                   <?php
                                                  

                                               }
											   else  if($val == "Show Title")
                                               {

                                                       ?>
													   <td>
                                                        <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->$col == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_title" />
                                                        <span class="lbl"></span>
                                                    </label>
													</td>
                                                   <?php
                                                  

                                               }
											   else
                                               {
												   

                                                   ?>
                                                   <td><?php
                                                       echo $row->$col;
                                                      // echo "<br/>".$val;
                                                       ?></td>
                                               <?php
												   
                                               }
                                                ?>




                                                <!--<td><?php 
                                                //echo $col." ".$val."<br/>";
                                                //echo $row."<br/>";
                                                //echo $row->$col;?></td> -->


                                                <?php }

                                            if($table == "token_purpose")
                                            {
                                                $targetDir = FCPATH."public_html/assets/purposeimage/".$row->id.".jpeg";
                                                if(file_exists($targetDir))
                                                {  
                                                    ?>
                                                    <td><img src="<?php echo base_url().'public_html/assets/purposeimage/'.$row->id.'.jpeg'; ?>" style="height:50px;width:50px;" /></td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<td></td>";    

                                                }
                                            }

                                            ?> 
										
                                       
                                                <?php		 
                                                if($table == "madani_year")
                                                { 
                                                    ?>
													<td>
                                                    <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_year" />
                                                        <span class="lbl"></span>
                                                    </label>
													</td>
                                                    <?php
                                                }else if($table == "madani_month")
                                                {
                                                    ?>
													<td>
                                                    <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_month" />
                                                        <span class="lbl"></span>
                                                    </label>
													</td>
                                                    <?php
                                                }
												else if($table == "logo_list")
                                                {
                                                   /*  ?>
                                                    <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status_month" />
                                                        <span class="lbl"></span>ddd
                                                    </label>
                                                    <?php */
                                                }
												else if($table == "system_setting_list")
                                                {
												}
                                                else
                                                { 
                                                    ?>
												<td>
                                                    <label class=" inline">
                                                        <input  ref="<?php echo $row->id; ?>" table="<?php echo $table; ?>"  <?php if($row->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>    type="checkbox" class="ace ace-switch ace-switch-5 status" />
                                                        <span class="lbl"></span>
                                                    </label>

													</td>
                                                    <?php 
                                                }		
                                                ?>		

                                            

                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                                    <a class="green" href="<?php echo base_url($links['edit'].'/'.$row->id.''); ?>">
                                                        <i class="icon-pencil bigger-130"></i>
                                                    </a>

                                                    <!-- <a class="red" href="<?php echo base_url($links['delete'].'/'.$row->id.''); ?>">
                                                    <i class="icon-trash bigger-130"></i>
                                                    </a>-->
                                                </div>

                                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                    <div class="inline position-relative">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                                            <li>
                                                                <a href="<?php echo base_url($links['edit'].'/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                    <span class="green">
                                                                        <i class="icon-edit bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <!-- <li>
                                                            <a href="<?php echo base_url($links['edit'].'/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                            <span class="red">
                                                            <i class="icon-trash bigger-120"></i>
                                                            </span>
                                                            </a>
                                                            </li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <?php } ?>




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
    </div>


</div>


