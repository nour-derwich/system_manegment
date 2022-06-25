<?php 
$edit_data		=	$this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();
?>

<div class="tab-pane box active" id="edit" style="padding: 20px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        
        
        <div class="pull-left">
			<span style="font-size:20px;font-weight:200;">
				Payment To
            </span>
            <br />
            <?php echo $system_info[0]->system_title; ?>
            <br />
            <?php echo $system_info[0]->system_name; ?>
        </div>
        <div class="pull-right">
			<span style="font-size:20px;font-weight:200;">
				Bill To
            </span>
    <br />
            	Code : 
            	<?php echo $this->db->get_where('staff_list' , array('staff_id'=>$row['staff_id']))->row()->staff_code;?>
            <br />
				Name :
				<?php echo $this->db->get_where('staff_list' , array('staff_id'=>$row['staff_id']))->row()->name;?>
        
        </div>
        <div style="clear:both;"></div>
        <hr />
        <table width="100%">
        	<tr style="background-color:#7087A3; color:#fff; padding:5px;">
            	<td style="padding:5px;"><?php echo ucwords('Invoice Title');?></td>
            	<td width="30%" style="padding:5px;">
					<div class="pull-right">
						<?php echo ucwords('Amount');?>
                    </div>
                </td>
            </tr>
        	<tr>
            	<td>
					<span style="font-size:20px;font-weight:200;">
						<?php echo $row['title'];?>
                    </span>
                    <br />
					<?php echo $row['description'];?>
                </td>
            	<td width="30%" style="padding:5px;">
					<div class="pull-right">
						<span style="font-size:20px;font-weight:200;">
							<?php echo $row['amount'];?>
                        </span>
                    </div>
                </td>
            </tr>
        	<tr>
            	<td></td>
            	<td width="30%" style="padding:5px;">
                	<div class="pull-right">
                    <hr />
                    <?php echo ucwords('Status');?> : <?php echo $row['status'];?>
                    <br />
                    <?php echo ucwords('Invoice Id');?> : <?php echo $row['invoice_id'];?>
                    <br />
                    <?php echo ucwords('Date');?> : <?php echo date('m/d/Y', $row['creation_timestamp']);?>
                    </div>
                </td>
            </tr>
        </table>
<br />
<br />

        
        <?php endforeach;?>
    </div>
</div>