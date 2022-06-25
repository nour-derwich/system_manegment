<?php
$student_info	=	$this->Mdl_staff->get_student_info($param2);
foreach($student_info as $row):?>

<div class="profile-env" >
	
	<header class="row" style="margin-top:0px !important;">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
			
			<?php
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
			
				<img src="<?php echo $staff_image;?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3><?php echo $row['name'];?></h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                
                    <?php if($row['staff_code'] != ''):?>
                    <tr>
                        <td>Staff Code</td>
                        <td><b><?php echo $row['staff_code'];?></b></td>
                    </tr>
                    <?php endif;?>

					
                
                    <?php if($row['birthday'] != ''):?>
                    <tr>
                        <td>Birthday</td>
                        <td><b><?php echo $row['birthday'];?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['sex'] != ''):?>
                    <tr>
                        <td>Gender</td>
                        <td><b><?php echo $row['sex'];?></b></td>
                    </tr>
                    <?php endif;?>
                
                
                    <?php if($row['phone'] != ''):?>
                    <tr>
                        <td>Phone</td>
                        <td><b><?php echo $row['phone'];?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['email'] != ''):?>
                    <tr>
                        <td>Email</td>
                        <td><b><?php echo $row['email'];?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['address'] != ''):?>
                    <tr>
                        <td>Address</td>
                        <td><b><?php echo $row['address'];?></b>
                        </td>
                    </tr>
                    <?php endif;?>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>