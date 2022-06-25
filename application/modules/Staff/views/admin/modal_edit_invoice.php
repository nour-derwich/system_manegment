<?php 
//echo $param2;


 $this->db->select('*');
 $this->db->where('invoice_id',$param2);
$edit_data1		=	$this->db->get('invoice')->result_array();
//echo $this->db->last_query();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php 
		
		foreach($edit_data1 as $row)
		{
		
		//print_r($edit_data1);
?>
        <?php echo form_open(base_url().'Staff/invoice_submit/do_update/'.$row['invoice_id'], array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('student');?></label>
                    <div class="col-sm-5">
                        <select name="student_id" class="form-control" style="width:400px;" >
                            <?php 
                           // $this->db->order_by('class_id','asc');
                            $students = $this->db->get('staff_list')->result_array();
                            foreach($students as $row2):
                            ?>
                                <option value="<?php echo $row2['staff_id'];?>">
                                  
                                    <?php echo $row2['staff_code'];?> -
                                    <?php echo $row2['name'];?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('title');?></label>
                    <div class="col-sm-5">
                        <input type="text" data-validate="required" data-message-required="Title is Required" class="form-control" name="title" value="<?php echo $row['title'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('description');?></label>
                    <div class="col-sm-5">
                        <textarea type="text" data-validate="required" data-message-required="Description is Required" class="form-control" name="description" ><?php echo $row['description'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('amount');?></label>
                    <div class="col-sm-5">
                        <input type="text" data-validate="required" data-message-required="Amount is Required" class="form-control" name="amount" value="<?php echo $row['amount'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('status');?></label>
                    <div class="col-sm-5">
                        <select name="status" data-validate="required" data-message-required="Status is Required" class="form-control">
                            <option value="paid" <?php if($row['status']=='paid')echo 'selected';?>><?php echo ucwords('paid');?></option>
                            <option value="unpaid" <?php if($row['status']=='unpaid')echo 'selected';?>><?php echo ucwords('unpaid');?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords('date');?></label>
                    <div class="col-sm-5">
                        <input type="text" data-validate="required" data-message-required="Date is Required" class="datepicker form-control" name="date" 
                            value="<?php echo date('m/d/Y', $row['creation_timestamp']);?>"/>
                    </div>

                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo ucwords('edit_invoice');?></button>
                  </div>
                </div>
        </form>
        <?php }?>
    </div>
</div>