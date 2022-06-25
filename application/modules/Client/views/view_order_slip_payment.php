<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Builder Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public_html/frontend/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public_html/frontend/print.css' media="print" />
	<!--<script type='text/javascript' src='<?php echo base_url(); ?>public_html/frontend/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>public_html/frontend/example.js'></script>-->

</head>

<body>
<?php
$system_info = $this->Mdl_client->_get_system_info();
//print_r($order_list);
if($last_payment_id == "")
{
  $payment_id= $this->uri->segment(3);
}else
{
	$payment_id= $last_payment_id;
}
  
  $payment_list = $this->Mdl_client->get_payment_list($payment_id);
// print_r($payment_list);
//exit; 
 //echo $order_code;
//$order_list = $this->Mdl_seller->get_order_list_by_code($payment_list[0]->order_code);
//$user_list = $this->Mdl_seller->_this_controller_record($payment_list[0]->user_id);
//$cart_list = $this->Mdl_seller->get_order_cart_list($payment_list[0]->order_code);
$user_list = $this->Mdl_client->_get_client_personal_record_byid($payment_list[0]->client_personal_id);
//echo "<pre>";/
///print_r($payment_list);

$paid = 0 ;
$rem = 0 ;

/* foreach($payment_list as $pay){ */
	
	$paid = $payment_list[0]->old_paid_price;
	//
/* } */
if($payment_list[0]->remaining_price == 0)
{
$rem = $order_list[0]->total_price - $payment_list[0]->old_paid_price;
}
else
{
$rem = $payment_list[0]->remaining_price;	
}
?>
<style type="text/css">
.btn_back
{
	
	border-width: 4px;
    font-size: 13px;
    padding: 4px 9px;
    line-height: 1.39;
    float: left;
    border-width: 4px;
    font-size: 13px;
    padding: 4px 9px;
    line-height: 1.39;
    background-color: #abbac3!important;
    border-color: #abbac3;
    color: #fff;
    /* margin-top: 10px; */
    padding: 10px;
    cursor: pointer;
	text-decoration:none !important;
}
.btn_print
{
	border-width: 4px;
    font-size: 13px;
    padding: 4px 9px;
    line-height: 1.39;
    float: right;
    border-width: 4px;
    font-size: 13px;
    padding: 4px 9px;
    line-height: 1.39;
       background-color: #87b87f!important;
    border-color: #87b87f;
    color: #fff;
    /* margin-top: 10px; */
    padding: 10px;
    cursor: pointer;
	text-decoration:none !important;
}

</style>
<div Style="margin:10px 15px 0px 15px; display:none;" >
<a href="<?php echo base_url(); ?>Seller/order_list" class="btn_back" name="" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Back
                    </a>
					
					<a class="btn_print" onclick="printDiv('page-wrap')" name="" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Print
                    </a>
					<div style="clear:both;"></div>
</div>

	<div id="page-wrap">

		<textarea id="header" style="display:none;" >INVOICE</textarea>
		
		<div id="identity" style="width: 100%;height: 100px !important;">
		
            <div class="logo" style="float:left;">

        
              <img id="image" style="height:50px;width:280px;" src="<?php echo base_url(); ?>public_html/frontend/image/system/<?php echo $system_info[0]->system_image;?>" alt="logo" />
         
		   </div>
		
            <textarea readonly style="float:right;" id="address"><?php echo $system_info[0]->long_address;?>

			
Phone: <?php echo $system_info[0]->mobile;?></textarea>
<div style="clear:both"></div>  
		
		</div>
		
		
		
		<div id="customer">

            <!--<textarea id="customer-title">Widget Corp.
c/o Steve Widget</textarea>-->
<table id="meta" style="float: left;">
                <tr>
                    <td class="meta-head">Name</td>
                    <td align="left"><textarea readonly style="text-align: left;"><?php echo $user_list[0]->name; ?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Contact</td>
                    <td align="left"><textarea readonly style="text-align: left;" id="date"><?php echo $user_list[0]->contact1.", ".$user_list[0]->contact2; ?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Address</td>
                    <td align="left"><div style="text-align: left;" class="due"><?php echo $user_list[0]->postal_address; ?></div></td>
                </tr>

            </table>
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea readonly>0000<?php echo $payment_id; ?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea readonly id="date"><?php
					$order_date = new DateTime($payment_list[0]->payment_date);
                    $order_date_show = $order_date->format('F d, Y');
                    echo $order_date_show;
					
					?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">Rs. <?php echo $rem; ?></div></td>
                </tr>

            </table>
		<div style="clear:both"></div>    
		</div>
		
		<table id="items">
		
		  <!--<tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
			   <th>Other Charges</th>
		      <th>Total Price</th>
		  </tr>
		  -->
		  
		  <tr>

		      <td colspan="3" style="width:63% !important;" class="blank"> </td>
		      <td colspan="3" class="total-line">Previous Amount</td>
		      <td class="total-value"><div id="total">Rs. <?php echo ($pre_payment); ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="3" style="width:63% !important;" class="blank"> </td>
		      <td colspan="3" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">Rs. <?php echo $payment_list[0]->paid; ?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="3" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">Rs. <?php echo $rem; ?></div></td>
		  </tr>
		
		</table>
		<div id="terms">
		  <h5>Terms & Conditions</h5>
		  <textarea></textarea>
		  <textarea></textarea>
		  <textarea></textarea>
		</div>
	</div>
	
	<script type="text/javascript">
	function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
</script>

</body>

</html>