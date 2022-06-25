<?php 
$param             = $param_view;
$heading           = $param['heading'];  
$links             = $param['links'];  
$column            = $param['column']; 
$fillter           = $param['fillter']; 
$relation          = $param['relation']; 
$relation_ref      = $param['relation_ref']; 
$unique            = $param['unique']; 
$count_fillter     = count($param['fillter']);
$load              = $this->Mdl_hierarchy;
$validate          = $param['input_validation'];
$type              = $param['input_type'];  //Input Type
$class         	   = $param['add_class'];
if($result_set)
{
    $row = $result_set;
} 
$id     		= $this->uri->segment(4);
$db_ref 		= $this->uri->segment(3);
if($id > 0)
{
    if($relation != null)
    {
        $relation_pax = $load->get_relation_pax_dataarray($relation,$id);
    }
}
?>
<div class="page-content">
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
            <a href="<?php echo base_url($links['List_View']); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
			
			<?php
			if($this->uri->segment(3) != "logo_list" && $this->uri->segment(3) != "system_setting_list")
			{
				?>
            <a href="<?php echo base_url($links['edit']); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>
        <?php
			}
		?>
		</h1>
    </div><!-- /.page-header -->



    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(  
                'class' => 'form-horizontal form-validate', 
                'id'    => 'register-form', 
                'role'  => 'form'
            );
            echo form_open_multipart(base_url($links['command']), $attributes);
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

            <input type="hidden" name="markaz_id" id="markaz_id" value="<?php echo $this->session->userdata('markaz_id'); ?>">
            <?php


            if($count_fillter > 0)
            {

                foreach($fillter as $fill_key => $fill)
                {
                    //echo $fill_key; //Product List 
                    /* if($db_ref == "product_list" && $fill_key == "Category")
                    {
                        if($id > 0)
                        {
                            $dd_data = $load->{$fill['table']}($relation_pax[$relation_ref[$fill['table']]]);
                            $selected = $relation_pax[$fill['table']];  
                        }else
                        {
                            if($fill['type'] == 0)
                            {
                                $dd_data =  array('' => 'Select an option');
                            }else
                            {
                                $dd_data = $load->{$fill['table']}();    
                            } 
                        }   
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
                    } //All Dropdown
                    else if($fill_key != 'Currency' && $fill_key != 'Month' && $fill_key != 'Year')
                    { */
                        if($id > 0)
                        {
                            $dd_data = $load->{$fill['table']}($relation_pax[$relation_ref[$fill['table']]]);
                            $selected = $relation_pax[$fill['table']];  
                        }else
                        {
                            if($fill['type'] == 0)
                            {
                                $dd_data =  array('' => 'Select an option');
                            }else
                            {
                                $dd_data = $load->{$fill['table']}();    
                            } 
                        }   
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
                   /*  } */
                }
            } 
            foreach($column as $col => $val):
                if($col == 'is_enable')
                {
                    if($this->uri->segment(3) == "madani_year")
                    { 

                    }else if($this->uri->segment(3) == "madani_month")
                    {

                    }
                    else
                    {
                        ?>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Active:</label>
                            <div class="col-xs-12 col-sm-9">
                                <div class="clearfix">
                                    <label     class    = "inline">
                                        <input type     = "checkbox"
                                            id       = "<?php echo $col; ?>" 
                                            name     = "<?php echo $col; ?>"  
                                            class    = "ace ace-switch ace-switch-5 status" 
                                            <?php if($row[0]->is_enable == 0){ echo 'value="0" ';}else{echo 'value="1" checked="checked"';}  ?>       
                                            />
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                        </div> 
                        <?php
                    } 
                    ?>      
                    <?php }else{ 
                    if($unique[$col]) { $unique_class = 'unique_exception'; }else{ $unique_class = '';} 
                    if($class[$col]) { $add_class = 'date-picker-hierarchy'; }else{ $add_class = '';} 
                    if($validate[$col]) { $add_validation = 'required-field'; }else{ $add_validation = '';} 
					if($type[$col] == "textarea") { $input_type_field = 'textarea'; }else{ if($type[$col] != "text" && $type[$col] != ""){ $input_type_field = $type[$col]; }else{ $input_type_field = 'text';} } 
					
                    //Product List
                   /*  if($db_ref == "category_channel" && $val == "Price")
                    {
                        ?>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="<?php echo $col; ?>"><?php echo $val; ?>:</label>
                            <div class="col-xs-12 col-sm-2">
                                <div class="clearfix">
                                    <input  type         = "text" 
                                        id           = "<?php echo $col; ?>" 
                                        name         = "<?php echo $col; ?>"
                                        value        = "<?php 
                                        if($db_ref == 'token_purpose')
                                        {
                                            if($this->uri->segment(4))
                                            {
                                                if($col == 'valid_date')
                                                {
                                                    $date = new DateTime($row[0]->valid_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                { 
                                                    echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }
                                        else if($db_ref == 'token_purpose_course')
                                        {
                                            if($this->uri->segment(4))
                                            {
                                                if($col == 'opening_date')
                                                {
                                                    $date = new DateTime($row[0]->opening_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                    if($col == 'valid_date')
                                                    {
                                                        $date = new DateTime($row[0]->valid_date);
                                                        $date_show = $date->format('d-m-Y');
                                                        echo $date_show;
                                                    }
                                                    else
                                                    { 
                                                        echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }
                                        else if($db_ref == 'madani_month')
                                        {
                                            if($this->uri->segment(4))
                                            {

                                                if($col == 'start_date')
                                                {
                                                    $date = new DateTime($row[0]->start_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                { 
                                                    echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }										   
                                        else
                                        {
                                            echo $row[0]->$col;
                                        }
                                        ?>" placeholder  = "<?php echo $val; ?>" 
                                        ref-attr     = "<?php echo $db_ref; ?>"
                                        ref_attr_segemt = "<?php echo $id; ?>"
                                        class        = "col-xs-12 col-sm-12 <?php echo $unique_class." ".$add_class." ".$add_validation;  ?>" <?php if(!empty($add_class)){ echo 'data-date-format="dd-mm-yyyy"'; }; ?> />
                                    <?php
                                    foreach($fillter as $fill_key => $fill)
                                    {
                                        if($db_ref == "product_list" && $fill_key == "Currency")
                                        {
                                            if($id > 0)
                                            {
                                                $dd_data = $load->{$fill['table']}($relation_pax[$relation_ref[$fill['table']]]);
                                                $selected = $relation_pax[$fill['table']];  
                                            }else
                                            {
                                                if($fill['type'] == 0)
                                                {
                                                    $dd_data =  array('' => 'Select an option');
                                                }else
                                                {
                                                    $dd_data = $load->{$fill['table']}();    
                                                } 
                                            }   
                                            ?>
                                        </div></div>
                                    <div class="col-xs-12 col-sm-6" style="padding:0px;">
                                        <div class="clearfix">

                                            <?php
                                            echo form_dropdown(
                                                $fill['name'],
                                                $dd_data,$selected  ,
                                                'class  ="col-xs-12 col-sm-5 '.$fill['class'].' "  
                                                id     ="'.$fill['name'].'" placeholder="'.$fill_key.'"');
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="<?php echo $col; ?>">Month & Year:</label>
                            <?php
                            foreach($fillter as $fill_key => $fill)
                            {
                                if($db_ref == "product_list" && $fill_key == "Month" ) 
                                {
                                    if($id > 0)
                                    {
                                        $dd_data = $load->{$fill['table']}($relation_pax[$relation_ref[$fill['table']]]);
                                        $selected = $relation_pax[$fill['table']];  
                                    }else
                                    {
                                        if($fill['type'] == 0)
                                        {
                                            $dd_data =  array('' => 'Select an option');
                                        }else
                                        {
                                            $dd_data = $load->{$fill['table']}();    
                                        } 
                                    }   
                                    ?>
                                    <div class="col-xs-12 col-sm-2">
                                        <div class="clearfix">
                                            <?php
                                            echo form_dropdown(
                                                $fill['name'],
                                                $dd_data,$selected  ,
                                                'class  ="col-xs-12 col-sm-12 '.$fill['class'].' "  
                                                id     ="'.$fill['name'].'" placeholder="'.$fill_key.'"');
                                            ?>                                                
                                    </div> </div>           
                                    <?php 
                                }else if($db_ref == "product_list" && $fill_key == "Year" ) 
                                {
                                    if($id > 0)
                                    {
                                        $dd_data = $load->{$fill['table']}($relation_pax[$relation_ref[$fill['table']]]);
                                        $selected = $relation_pax[$fill['table']];  
                                    }else
                                    {
                                        if($fill['type'] == 0)
                                        {
                                            $dd_data =  array('' => 'Select an option');
                                        }else
                                        {
                                            $dd_data = $load->{$fill['table']}();    
                                        } 
                                    }   
                                    ?>
                                    <div class="col-xs-12 col-sm-6" style="padding:0px;">
                                        <div class="clearfix">									
                                            <?php
                                            echo form_dropdown(
                                                $fill['name'],
                                                $dd_data,$selected  ,
                                                'class  ="col-xs-12 col-sm-5 '.$fill['class'].' "  
                                                id     ="'.$fill['name'].'" placeholder="'.$fill_key.'"');
                                            ?>                                                
                                        </div>		
                                    </div>		             
                                    <?php 
                                }
                            }
                            ?>
                        </div>
                        <?php 
                    }
                    else
                    { */
                        ?>
						<?php
						if($input_type_field == "textarea")
						{
						?>
						<div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="<?php echo $col; ?>"><?php echo $val; ?>:</label>
                            <div class="col-xs-12 col-sm-9">
                                <div class="clearfix">
									<textarea cols="10" rows="5" id="<?php echo $col; ?>" name="<?php echo $col; ?>" placeholder="<?php echo $val; ?>" ref-attr="<?php echo $db_ref; ?>" ref_attr_segemt="<?php echo $id; ?>" class="col-xs-12 col-sm-6 <?php echo $unique_class." ".$add_class." ".$add_validation;  ?>"><?php echo $row[0]->$col; ?></textarea>
								</div>
							</div>
						</div>
						<?php
						} //End Input Textarea Field --/ & Check Other Fields Type
						else
						{
							?>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="<?php echo $col; ?>"><?php echo $val; ?>:</label>
                            <div class="col-xs-12 col-sm-9">
                                <div class="clearfix">
                                    <input  type         = "text" 
                                        id           = "<?php echo $col; ?>" 
                                        name         = "<?php echo $col; ?>"
                                        value        = "<?php 
                                        if($db_ref == 'token_purpose')
                                        {
                                            if($this->uri->segment(4))
                                            {
                                                if($col == 'valid_date')
                                                {
                                                    $date = new DateTime($row[0]->valid_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                { 
                                                    echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }
                                        else if($db_ref == 'token_purpose_course')
                                        {
                                            if($this->uri->segment(4))
                                            {
                                                if($col == 'opening_date')
                                                {
                                                    $date = new DateTime($row[0]->opening_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                    if($col == 'valid_date')
                                                    {
                                                        $date = new DateTime($row[0]->valid_date);
                                                        $date_show = $date->format('d-m-Y');
                                                        echo $date_show;
                                                    }
                                                    else
                                                    { 
                                                        echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }
                                        else if($db_ref == 'madani_month')
                                        {
                                            if($this->uri->segment(4))
                                            {

                                                if($col == 'start_date')
                                                {
                                                    $date = new DateTime($row[0]->start_date);
                                                    $date_show = $date->format('d-m-Y');
                                                    echo $date_show;
                                                }
                                                else
                                                { 
                                                    echo $row[0]->$col; 
                                                }
                                            }
                                            else
                                            {

                                                //echo $row[0]->$col;
                                            }
                                        }										   
                                        else
                                        {
                                            echo $row[0]->$col;
                                        }
                                        ?>" placeholder  = "<?php echo $val; ?>"                               ref-attr     = "<?php echo $db_ref; ?>"
                                        ref_attr_segemt = "<?php echo $id; ?>"
                                        class        = "col-xs-12 col-sm-6 <?php echo $unique_class." ".$add_class." ".$add_validation;  ?>" <?php if(!empty($add_class)){ echo 'data-date-format="dd-mm-yyyy"'; }; ?> />
                                </div>
                            </div>
                        </div>
                        <?php 
						}
                   /*  } */
                }?>
                <div class="space-2"></div>
                <?php endforeach;  ?>
            <?php if($this->uri->segment(3) == "brand_list")
            { 
                if($this->uri->segment(4))
                {
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <?php
                            $brand_image_update = $this->Mdl_hierarchy->get_relation_pax('brand_list','brand_image','id', $this->uri->segment(4));
                            ?>
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo $brand_image_update;?>">
                            <?php


                            if($brand_image_update != "")
                            {
                                ?>     
                                <div class="" id="result_pic"> 
                                    <img id="myImg" src="<?php echo base_url().'public_html/frontend/image/brand/'.$brand_image_update; ?>" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                                <?php
                            }else{
                                ?>         
                                <div class="hide" id="result_pic"> 
                                    <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="hide">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                                <?php } ?>

                        </div>

                    </div>

                    <?php        
                }
                else
                {    
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" name="token_file" class="required-field" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="hide" id="result_pic"> 
                                <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="hide">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php } 
            } 
            ?>

            <?php if($this->uri->segment(3) == "slider_list")
            {
                if($this->uri->segment(4))
                {
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <?php
                            $brand_image_update = $this->Mdl_hierarchy->get_relation_pax('slider_list','slider_image','id', $this->uri->segment(4));
                            ?>
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo $brand_image_update;?>">
                            <?php


                            if($brand_image_update != "")
                            {
                                ?>

                                <div class="" id="result_pic">
                                    <img id="myImg" src="<?php echo base_url().'public_html/frontend/image/slider/'.$brand_image_update; ?>" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php
                            }else{
                                ?>
                                <div class="hide" id="result_pic">
                                    <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="hide">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                <?php
                }
                else
                {
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" class="required-field" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="hide" id="result_pic">
                                <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="hide">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>
			
			
			
			
			 <?php if($this->uri->segment(3) == "logo_list")
            {
				
                if($this->uri->segment(4))
                {
					//echo $this->uri->segment(4);
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <?php
                            $brand_image_update = $this->Mdl_hierarchy->get_relation_pax('logo_list','logo_image','id', $this->uri->segment(4));
							
							//print_r($brand_image_update);
                            ?>
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo $brand_image_update1;?>">
                            <?php


                            if($brand_image_update != "")
                            {
                                ?>

                                <div class="" id="result_pic">
                                    <img id="myImg" src="<?php echo base_url().'public_html/frontend/image/logo/'.$brand_image_update; ?>" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php
                            }else{
								//echo "YES";
                                ?>
                                <div class="" id="result_pic">
									<?php 
										
									?>
									<img id="myImg" src="<?php echo base_url().'public_html/frontend/image/noimage.png'; ?>" style="width: 180px; height: 150px;" alt="your image"  />
									<?php 
										
									?>
                                </div>
                                <div id="upload_img" class="hide">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                <?php
                }
                else
                {
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" class="required-field" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="hide" id="result_pic">
                                <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="hide">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                <?php }
				
				
            }
            ?>
            
			<?php if($this->uri->segment(3) == "system_setting_list")
            {
				
                if($this->uri->segment(4))
                {
					//echo $this->uri->segment(4);
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <?php
                            $brand_image_update11 = $this->Mdl_hierarchy->get_relation_pax('system_setting_list','system_image','id', $this->uri->segment(4));
							
							//print_r($brand_image_update11);
                            ?>
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo $brand_image_update11;?>">
                            <?php


                            if($brand_image_update11 != "")
                            {
                                ?>

                                <div class="" id="result_pic">
                                    <img id="myImg" src="<?php echo base_url().'public_html/frontend/image/system/'.$brand_image_update11; ?>" style="width: 180px; height: 150px;" alt="your image"  />
                                </div>
                                <div id="upload_img" class="">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php
                            }else{
								//echo "YES";
                                ?>
                                <div class="" id="result_pic">
									<?php 
										
									?>
									<img id="myImg" src="<?php echo base_url().'public_html/frontend/image/noimage.png'; ?>" style="width: 180px; height: 150px;" alt="your image"  />
									<?php 
										
									?>
                                </div>
                                <div id="upload_img" class="hide">
                                    <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                        <i class="icon-undo bigger-110"></i>Cancel
                                    </button>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                <?php
                }
                else
                {
                    ?>
                    <div class="form-group">

                        <label class="control-label col-xs-12 col-sm-3" ></label>
                        <div class="col-xs-12 col-sm-2">
                            <div class="clearfix">
                                <button class="btn btn-primary" tabindex="20" id="upload_pic_token" type="button" >
                                    Upload
                                </button>
                                <input type="file" id="token_file" class="required-field" name="token_file" style="display: none;" />

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="hide" id="result_pic">
                                <img id="myImg" src="#" style="width: 180px; height: 150px;" alt="your image"  />
                            </div>
                            <div id="upload_img" class="hide">
                                <button class="btn" type="button" tabindex="23"  onClick="cancel_preview_image()">
                                    <i class="icon-undo bigger-110"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                <?php }
				
				
            }
            ?>
            
			
			<div class="clearfix form-actions">
                <div class="col-md-3"></div>
                <div class="col-md-9 ">
                    <button class="btn btn-info btn-validate" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Process
                    </button>

                    <!--         &nbsp; &nbsp; &nbsp;
                    <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                    </button>-->
                </div>
            </div>
            <?php echo form_close();  ?>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>