<div class="row">
	<div class="col-md-6">
    	<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php 
							$check	=	array(	'date' => date('Y-m-d') , 'status' => '1' );
							$query = $this->db->get_where('attendance' , $check);
							$present_today		=	$query->num_rows();
						?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3>Attendance</h3>
                   <p>Total present staff today</p>
                </div>
                
            </div>
		 
		 
        </div>
    </div>
    
	<div class="col-md-6">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('staff_list');?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>Staff</h3>
                   <p>Total Staff</p>
                </div>
                
            </div>
    
         
    	</div>
    </div>
	
</div>
