<style>
.tile-stats.tile-blue {
    background: #0073b7;
}

.tile-stats {
    position: relative;
    display: block;
    background: #303641;
    padding: 20px;
    margin-bottom: 10px;
    overflow: hidden;
    -webkit-border-radius: 5px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 5px;
    -moz-background-clip: padding;
    border-radius: 5px;
    background-clip: padding-box;
    -moz-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    -webkit-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}

.tile-stats.tile-blue .num, .tile-stats.tile-blue h3, .tile-stats.tile-blue p,.tile-stats.tile-blue a {
    color: #ffffff;
}
.tile-stats .num {
    font-size: 38px;
    font-weight: bold;
}

neon-core.css:6700
.tile-stats .num, .tile-stats h3, .tile-stats p {
    position: relative;
    color: #ffffff;
    z-index: 5;
    margin: 0;
    padding: 0;
}
</style>
<div class="page-content">
    <div class="page-header">
        <h1>
            Dashboard
            <small>
                <i class="icon-double-angle-right"></i>
                Dashboard
            </small>
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
	
	<?php
	//echo "<pre>";
	//print_r($this->session->userdata());
	?>

        <div class="row">
            <div class="col-xs-4">

			<div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                                        <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3>Total Guards</h3>
                   <p>Total project</p>
                </div>
			</div>
       <div class="col-xs-4">			
				<div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                                        <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3>Total Weapons</h3>
                   <p>Total project</p>
                </div>
			</div>
       <div class="col-xs-4">			
				<div class="tile-stats tile-purple">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                                        <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('staff_list');?>" data-postfix="" data-duration="500" data-delay="0"><?php echo $this->db->count_all('staff_list');?></div>
                    
                    <h3>Staff</h3>
                   <p>	<a href="<?php echo base_url(); ?>staff.html" target="_blank">Staff Management</a></p>
                </div>
				
				
				
			
            </div>
      </div>


</div>


