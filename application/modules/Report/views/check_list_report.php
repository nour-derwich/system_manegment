<?php
function getfrequency($code) {
    switch ($code) {
        case '1': return 'Monthly';
        case '3': return 'Quarterly';
        case '6': return 'Half Yearly';
        case '12': return 'Annual';

    }
    return false;
}
$bank_dd         = Modules::run('Hierarchy/bank_dd');
//$category_dd         = $this->Mdl_report->category_list($id);
//$department_dd         = $this->Mdl_report->department_list($id);
//$user_dd         = $this->Mdl_report->user_list($id);
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Cheque List Report
            <small>
                <i class="icon-double-angle-right"></i>
                Cheque List Report
            </small>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>
        </h1>
		<!--<a href="<?php //echo base_url('Form/customer_action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>-->
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

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-customer-report',
                'id'    => 'register-form',
                'role'  => 'form'
				//'target' => '_blank'
            );
            echo form_open(base_url('Report/check_report_action'), $attributes);
            ?>


			


            <div class="col-sm-12" style="margin-top:5px; padding:0px;">
                <!--<div class="col-sm-4 form-group mr0" style="margin-bottom: 0px;">
                    <label class="col-xs-12 col-sm-12" for="Token Purpose">
                        User Type:
                    </label>
                    <div class="col-xs-12 col-sm-12">
                        <div class="clearfix">
                            <select name="user_type" class="col-xs-12 col-sm-12 " id="user_type" placeholder="User Type">
<option value="" selected="selected">Select User</option>
<option value="buyer">Buyer</option>
<option value="seller">Seller</option>
</select>
                        </div>
                    </div>
                </div>-->
                <div class="col-xs-12 col-sm-4 form-group mro" style="margin-bottom: 0px;">
                    <label class="col-xs-12 col-sm-12" for="Token Purpose">
                        Bank:
                    </label>
                    <div class="col-xs-12 col-sm-12">
                        <div class="clearfix">
                             <?php
                        echo form_dropdown(
                            'bank_id',
                            $bank_dd,$row[0]->bank,
                            'class  ="col-xs-12 col-sm-12"
                        id     ="bank_id" placeholder="Bank"');
                        ?>

                        </div>
                    </div>

                </div>


                <div class="col-xs-12 col-sm-4 form-group mr0" style="margin-bottom: 0px;">
                    <label class="col-xs-12 col-sm-12" for="Token Purpose">
                        Date:
                    </label>
                    <div class="col-xs-12 col-sm-12">
                        <div class="clearfix">
                            <input type="text" value="" id="date_from" name="date_from" placeholder="Date From" data-date-format="yyyy-mm-dd" class="col-xs-12 col-sm-12 date-picker" />

                        </div>
                    </div>

                </div>
              
<div class="col-sm-4 form-group mr0" style="margin-bottom: 0px;">
                    <label class="col-xs-12 col-sm-12" for="Token Purpose">
                        Cheque Status:
                    </label>
                    <div class="col-xs-12 col-sm-12">
                        <div class="clearfix">
                            	<select name="check_status" id="check_status" placeholder="Cheque Status"  class="col-xs-12 col-sm-12 check_status" >
                             <option value="">--Select--</option>
                    <option <?php if($row[0]->check_status == "Pending"){ echo "selected"; }?> value="Pending">Pending</option>
                    <option <?php if($row[0]->check_status == "Process"){ echo "selected"; }?>  value="Process">Process</option>
                    <option <?php if($row[0]->check_status == "Clear"){ echo "selected"; }?>  value="Clear">Clear</option>                  
                    <option <?php if($row[0]->check_status == "Not Clear"){ echo "selected"; }?>  value="Not Clear" >Not Clear</option>
                        </select>
                        </div>
                    </div>
                </div>


            </div>
		
			
		</div>
       <div class="col-xs-12 col-sm-12">

           <div class="col-sm-12" style="margin-top:30px; padding:0px;">
               <div class="col-sm-4 form-group mr0" style="margin-bottom: 0px;">


               </div>
               <div class="col-sm-4 form-group mr0" style="margin-bottom: 0px;">
                   <button class="btn btn-info btn-validate customer_report_excel" name="customer_report_excel" type="submit">
                       <i class="icon-ok bigger-110"></i>
                       Download Report
                   </button>

               </div>
           </div>
</div>
		

                <?php echo form_close();  ?>
				 </div>
                <div id="filter_result_customer"></div>
                       
    </div>


</div>


