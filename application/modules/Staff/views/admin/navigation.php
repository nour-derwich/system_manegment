<div class="sidebar-menu">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>staff.html">
				<?php echo $system_info[0]->system_name; ?>
				</a>
			</div>
            
			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
                
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		
		<div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            
           
           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>Staff/dashboard">
					<i class="entypo-gauge"></i>
					<span>Dashboard</span>
				</a>
           </li>
           

            
  <!-- DAILY ATTENDANCE -->
           <li class="<?php if($page_name == 'staff_add')echo 'active';?> ">
				<a href="<?php echo base_url();?>Staff/staff_add">
					<i class="fa fa-group"></i>
					<span>Add Staff</span>
				</a>
                
           </li>
		   
		     <!-- DAILY ATTENDANCE -->
           <li class="<?php if($page_name == 'staff_information')echo 'active';?> ">
				<a href="<?php echo base_url();?>Staff/staff_information">
					<i class="fa fa-group"></i>
					<span> View Staff</span>
				</a>
                
           </li>
		   
		   
		   
           <!-- DAILY ATTENDANCE -->
           <li class="<?php if($page_name == 'manage_attendance')echo 'active';?> ">
				<a href="<?php echo base_url();?>Staff/manage_attendance/<?php echo date("d/m/Y");?>">
					<i class="entypo-chart-area"></i>
					<span>Daily Attendance</span>
				</a>
                
           </li>
            
     
            
           <!-- PAYMENT -->
           <li class="<?php if($page_name == 'invoice')echo 'active';?> ">
				<a href="<?php echo base_url();?>Staff/invoice">
					<i class="entypo-credit-card"></i>
					<span>Payment</span>
				</a>
           </li>
          
       
           
           
		</ul>
        		
</div>