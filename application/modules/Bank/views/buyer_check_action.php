<?php

if($result_set){$row = $result_set;} 
$id = $this->uri->segment(3);
$user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');

$bank_dd         = Modules::run('Hierarchy/bank_dd');

?>
<div class="page-content">


    <div class="page-header">
        <h1>
            Cheque Management
            <small>
                <i class="icon-double-angle-right"></i>
                Add / Edit Buyer Cheque
            </small>
            <a href="<?php echo base_url('Bank/buyer_check_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
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
        <div class="col-xs-12 col-sm-7">

            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(
                'class' => 'form-horizontal form-validate-inventory',
                'id'    => 'register-form',
                'role'  => 'form'
            );
            echo form_open_multipart(base_url('Bank/buyer_check_submit'), $attributes);
            ?>
            <!-- PAGE CONTENT BEGINS -->
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
           
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Bank</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">

                        <?php
                        echo form_dropdown(
                            'bank_id',
                            $bank_dd,$row[0]->bank,
                            'class  ="col-xs-12 col-sm-9 required-field "
                        id     ="bank_id" placeholder="Bank"');
                        ?>
                    </div>
                </div>
            </div>
 <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Account Name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="account_name" name="account_name" value="<?php echo $row[0]->account_name;?>" placeholder="Account Name" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>           

		   <div class="space-2"></div>
            <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Amount</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="check_amount" name="check_amount" value="<?php echo $row[0]->check_amount;?>" placeholder="Cheque Amount" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Cheque No</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="check_no" name="check_no" value="<?php echo $row[0]->check_no;?>" placeholder="Cheque No" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Branch</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="branch" name="branch" value="<?php echo $row[0]->branch;?>" placeholder="Branch" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Branch Code</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" id="branch_code" name="branch_code" value="<?php echo $row[0]->branch_code;?>" placeholder="Branch Code" class="col-xs-10 col-sm-9 required-field" />
                    </div>
                </div>
            </div>
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Cheque Date</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="date" id="check_date" name="check_date" value="<?php echo $row[0]->check_date;?>" placeholder="Cheque Date" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Cheque Clear Date</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="date" id="check_clear_date" name="check_clear_date" value="<?php echo $row[0]->check_clear_date;?>" placeholder="Cheque Clear Date" class="col-xs-10 col-sm-9" />
                    </div>
                </div>
            </div>
			  <div class="form-group">

                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Name">Cheque Status</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                       
					   
					   	<select name="check_status" id="check_status" placeholder="Cheque Status"  class="col-xs-10 col-sm-9 check_status" >
                             <option value="">--Select--</option>
                    <option <?php if($row[0]->check_status == "Pending"){ echo "selected"; }?> value="Pending">Pending</option>
                    <option <?php if($row[0]->check_status == "Process"){ echo "selected"; }?>  value="Process">Process</option>
                    <option <?php if($row[0]->check_status == "Clear"){ echo "selected"; }?>  value="Clear">Clear</option>                  
                    <option <?php if($row[0]->check_status == "Not Clear"){ echo "selected"; }?>  value="Not Clear" >Not Clear</option>
                        </select>
                    </div>
                </div>
            </div>




            <div class="space-2"></div>

            <div class="clearfix form-actions" style="text-align: center;">
                <div class="col-md-9 ">


                    <a class="btn"  href="<?php echo base_url('Bank/buyer_check_list'); ?>">
                        <i class="icon-undo bigger-110"></i>
                        Cancel
                    </a>
                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-info btn-validate" name="save_sub_check" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Save
                    </button>


                </div>
            </div>


            <?php echo form_close();  ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->


