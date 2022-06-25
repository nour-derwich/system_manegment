
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
    	<thead>
        	<tr>
            	<th><?php echo ucwords('select_date');?></th>
            	<th><?php echo ucwords('select_month');?></th>
            	<th><?php echo ucwords('select_year');?></th>
    
            	<th><?php echo ucwords('select_date');?></th>
           </tr>
       </thead>
		<tbody>
        	<form method="post" action="<?php echo base_url();?>Staff/attendance_selector" class="form">
            	<tr class="gradeA">
                    <td>
                    	<select name="date" class="form-control">
                        	<?php for($i=1;$i<=31;$i++):?>
                            	<option value="<?php echo $i;?>" 
                                	<?php if(isset($date) && $date==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                    	<select name="month" class="form-control">
                        	<?php 
							for($i=1;$i<=12;$i++):
								if($i==1)$m='january';
								else if($i==2)$m='february';
								else if($i==3)$m='march';
								else if($i==4)$m='april';
								else if($i==5)$m='may';
								else if($i==6)$m='june';
								else if($i==7)$m='july';
								else if($i==8)$m='august';
								else if($i==9)$m='september';
								else if($i==10)$m='october';
								else if($i==11)$m='november';
								else if($i==12)$m='december';
							?>
                            	<option value="<?php echo $i;?>"
                                	<?php if($month==$i)echo 'selected="selected"';?>>
										<?php echo $m;?>
                                        	</option>
                            <?php 
							endfor;
							?>
                        </select>
                    </td>
                    <td>
                    	<select name="year" class="form-control">
                        	<?php for($i=2020;$i>=2010;$i--):?>
                            	<option value="<?php echo $i;?>"
                                	<?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
               
                    <td align="center"><input type="submit" value="<?php echo ucwords('manage_attendance');?>" class="btn btn-info"/></td>
                </tr>
            </form>
		</tbody>
	</table>

<?php if($date!='' && $month!='' && $year!=''):?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-white-gray">
                <div class="icon"><i class="entypo-suitcase"></i></div>
                <?php
                   $full_date	=	$year.'-'.$month.'-'.$date;
                    $timestamp = strtotime($full_date);
                    $day = strtolower(date('l', $timestamp));
                 ?>
                <h2><?php echo ucwords($day);?></h2>
                
                <h3>Attendance of class <?php echo ($class_id);?></h3>
                <p><?php echo $date.'-'.$month.'-'.$year;?></p>
            </div>
        </div>
    </div>
</center>






<div class="row">
<div class="col-sm-offset-3 col-md-6">
    <table  class="table table-bordered">
		<thead>
			<tr class="gradeA">
            	<th>Staff Code</th>
            	<th><?php echo ucwords('name');?></th>
            	<th><?php echo ucwords('status');?></th>
			</tr>
        </thead>
        <tbody>
        		
        	<?php 
			//STUDENTS ATTENDANCE
			$students	=	$this->db->get('staff_list')->result_array();
				
			foreach($students as $row)
			{
				?>
				<tr class="gradeA">
					<td><?php echo $row['staff_code'];?></td>
					<td><?php echo $row['name'];?></td>
					<td align="center">
						<?php 
						//inserting blank data for students attendance if unavailable
						$verify_data	=	array(	'staff_id' => $row['staff_id'],
													'date' => $full_date);
						
						     $data['staff_id']       = $row['staff_id'];
						     $data['date']       = $full_date;
						     $data['ip_address']       = $this->input->ip_address();
							$data['user_id']       = $this->session->userdata('id');
							$data['is_enable']       = 1;
							$data['created_date']       = date('Y-m-d H:i:s');
							$data['created_by']       = $this->session->userdata('id');
			
						
						
						
						$query = $this->db->get_where('attendance' , $verify_data);
						if($query->num_rows() < 1)
							
						
						
						$this->db->insert('attendance' , $data);
						
						//showing the attendance status editing option
						$attendance = $this->db->get_where('attendance' , $verify_data)->row();
						$status		= $attendance->status;
                    	?>
                        
                        <form method="post" action="<?php echo base_url();?>Staff/manage_attendance/<?php echo $date.'/'.$month.'/'.$year.'/'.$class_id;?>">
                            <select name="status" class="form-control" style="width:100px; float:left;">
                                <option value="0" <?php if($status == 0)echo 'selected="selected"';?>></option>
                                <option value="1" <?php if($status == 1)echo 'selected="selected"';?>>Present</option>
                                <option value="2" <?php if($status == 2)echo 'selected="selected"';?>>Absent</option>
                            </select>
                            <input type="hidden" name="staff_id" 			value="<?php echo $row['staff_id'];?>" />
                            <input type="hidden" name="date" 					value="<?php echo $full_date;?>" />
                            <input type="submit" class="btn btn-default" 	value="save" style="float:left; margin:0px 10px;">
                        </form>
                    </td>
				</tr>
				<?php 
			}
			?>
    </table>
</div>
</div>
<?php endif;?>