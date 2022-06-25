
<a href="<?php echo base_url();?>Staff/staff_add" 
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        Add New Staff
    </a> 
<br><br>
		<?php			
    if($success)
    {
    ?>
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        Success !
                    </strong>
                    <?php echo $success; ?>
                </p>
            </div>
        <?php
    } 
if($error)
    {
    ?>
            <div class="alert alert-block alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        Error !
                    </strong>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php
    } 	?>
	
	<br/>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
           
            <th width="80"><div><?php echo ucwords('photo');?></div></th>
            <th><div><?php echo ucwords('name');?></div></th>
            <th class="span3"><div><?php echo ucwords('address');?></div></th>
            <th><div><?php echo ucwords('email');?></div></th>
            <th><div><?php echo ucwords('options');?></div></th>
        </tr>
    </thead>
    <tbody>
	
        <?php 
                $students	=	$this->db->get('staff_list')->result_array();
                foreach($students as $row):
				
					
			$staff_image = "";
			if (!empty($row['staff_image'])) {

							$image_pic1 = "public_html/frontend/image/staff/" . $row['staff_image'];
							//echo $image_pic;
							if(file_exists($image_pic1))
							{
								$staff_image =  base_url()."public_html/frontend/image/staff/" . $row['staff_image'];
							}
							else
							{
								$staff_image =  base_url().'public_html/frontend/user.jpg';
							}
			} else {
                        $staff_image=  base_url().'public_html/frontend/user.jpg';
                    }
			?>
			
			
        <tr>
     
            <td><img src="<?php echo $staff_image; ?>" class="img-circle" width="30" /></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['email'];?></td>
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- STUDENT PROFILE LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Staff/popup/modal_staff_profile/<?php echo $row['staff_id'];?>');">
                                <i class="entypo-user"></i>
                                    <?php echo ucwords('profile');?>
                                </a>
                                        </li>
                        
                        <!-- STUDENT EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Staff/popup/modal_staff_edit/<?php echo $row['staff_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo ucwords('edit');?>
                                </a>
                                        </li>
										<!--
                        <li class="divider"></li>-->
                        
                        <!-- STUDENT DELETION LINK -->
                        <!--<li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/<?php echo $class_id;?>/delete/<?php echo $row['student_id'];?>');">
                                <i class="entypo-trash"></i>
                                    <?php echo ucwords('delete');?>
                                </a>
                                        </li>-->
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>