<?php
$script_check =   $this->uri->segment(2);
?>
<script type="text/javascript">
    jQuery(function($) 
        {
	
			setTimeout(function(){
                $('.alert-success').remove();
                }, 2000);  
            setTimeout(function(){
                $('.alert-danger').remove();
                }, 2000);

     
    });

</script>