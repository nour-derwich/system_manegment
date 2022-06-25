<style>
.green1 td
{
	background-color:#dff0d8!important;
}
/* .green1 td a
{dff0d8
	background-color:#69aa46 !important;
} */
</style>
<div class="page-content">
    <div class="page-header">
        <h1>
            Cheque Management
            <small>
                <i class="icon-double-angle-right"></i>
                Buyer Cheque List
            </small>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>
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


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->


            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Results for Buyer Cheque List
                        <a href="<?php echo base_url('Bank/buyer_check_action'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">Add New </a>
                    </div>

                    <div class="table-responsive">
                        <table id="check_table1" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Bank </th>
                                    <th>Account Name</th>
                                    <th>Amount</th>
                                    <th>Cheque No</th>
                                    <th>Branch</th>
                                    <th>Branch Code</th>
                                    <th>Cheque Date</th>
                                    <th>Cheque Clear Date</th>
                                    <th>Cheque Status</th>
                                    <th>Cheque Status Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            //print_r($result_set);
                            $parent_name = "";
                            foreach($result_set as $key => $row) {
                                //echo "<pre>";
                               // print_r($result_set);

                                ?>

                                <tr <?php if($row->check_status == "Clear"){ echo "class='green1'"; }?>>
                                    <td><?php //echo $row->parent_category_id;

                                        $bank_name = $this->Mdl_bank->get_relation_pax('bank_list','bank_name','id',$row->bank);
                                        echo $bank_name;

                                        ?></td>
                                    <td><?php echo $row->account_name;?></td>
                                    <td><?php echo $row->check_amount;?></td>
                                    <td><?php echo $row->check_no;?></td>
                                    <td><?php echo $row->branch;?></td>
                                    <td><?php echo $row->branch_code;?></td>
                                    <td><?php echo $row->check_date;?></td>
                                    <td><?php echo $row->check_clear_date;?></td>
                                    <td><?php //echo $row->check_status;?>
									
									
									<select name="check_status" id="check_status" onchange="check_status2(this.value, <?= $row->id; ?>)" placeholder="Cheque Status"  class="col-xs-10 col-sm-12 fee_status" >
                             <option value="">--Select--</option>
                    <option <?php if($row->check_status == "Pending"){ echo "selected"; }?> value="Pending">Pending</option>
                    <option <?php if($row->check_status == "Process"){ echo "selected"; }?>  value="Process">Process</option>
                    <option <?php if($row->check_status == "Clear"){ echo "selected"; }?>  value="Clear">Clear</option>                  
                    <option <?php if($row->check_status == "Not Clear"){ echo "selected"; }?>  value="Not Clear" >Not Clear</option>
                        </select>
						
						
									
									
									
									</td>
                                    <td><?php echo $row->modify_date;?></td>
                                


                                    <td>
                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                            <a class="blue" href="<?php echo base_url('Bank/buyer_check_action/'.$row->id.''); ?>">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>

                                            <!--<a class="red" href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>">
                                                <i class="icon-trash bigger-130"></i>
                                                </a>
                                                <a class="blue" href="<?php //echo base_url('Users/module_permission/'.$row->id.''); ?>">
                                                <i class="icon-lock bigger-130"></i>
                                                </a>
                                                <a class="purple" href="<?php //echo base_url('Users/data_permission/'.$row->id.''); ?>">
                                                <i class="icon-eye-open bigger-130"></i>
                                                </a>-->
                                        </div>

                                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                                            <div class="inline position-relative">
                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">


                                                    <li>
                                                        <a href="<?php echo base_url('Bank/buyer_check_action/'.$row->id.''); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                        </a>
                                                    </li>
                                                    <!--
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/delete/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="red">
                                                                    <i class="icon-trash bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/module_permission/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="blue">
                                                                    <i class="icon-lock bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php //echo base_url('Users/data_permission/'.$row->id.''); ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <span class="purple">
                                                                    <i class="icon-eye-open bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        -->
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

        </div>
    </div>


</div>
<script>

//Revert Form
function check_status2(val, id){
    var base_url = '<?php echo base_url();?>';
    $.ajax(
	{
        type: "POST",
        url: base_url+"Bank/check_status",
        data: {value:val, id: id},
        success: function(data){
			//console.log(data);
           // $("#flashmsg").html(data);
		    $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Status Changed!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Check Status Changed Successfully.',
                                    class_name: 'gritter-success  gritter-light'
                                });
								
           // window.location=base_url+'Bank/check_list';
        }
    });
}




</script>

