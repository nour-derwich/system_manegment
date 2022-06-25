<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title> Ultimate Sign</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public_html/frontend/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public_html/frontend/print.css' media="print" />
	<!--<script type='text/javascript' src='<?php echo base_url(); ?>public_html/frontend/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>public_html/frontend/example.js'></script>-->

</head>

<body>
<?php
$system_info = $this->Mdl_seller->_get_system_info();
//print_r($order_list);
if($new_order_code == "")
{
  $order_code= $this->uri->segment(3);
}
else
{
	$order_code = $new_order_code;
}
  //echo $order_code;
$order_list = $this->Mdl_seller->get_order_list_by_code($order_code);
$user_list = $this->Mdl_seller->_this_controller_record($order_list[0]->user_id);
$cart_list = $this->Mdl_seller->get_order_cart_list($order_code);
$payment_list = $this->Mdl_seller->get_order_payment_list($order_code);
//echo "<pre>";/
///print_r($payment_list);

$paid = 0 ;
$rem = 0 ;

foreach($payment_list as $pay){
	
	$paid = $paid + $pay->paid_price;
	$rem = $rem + $pay->remaining_price;
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
<div Style="margin:10px 15px 0px 15px;" >
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

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity" style="width: 100%;height: 100px !important;">
		
		
            <textarea readonly id="address" style="width: 30%;" >Note: Company are not Responsible for purchases on Chiness Media</textarea>
 <img id="image" style="height:50px;width:280px; margin-top: 3% !important;" src="<?php echo base_url(); ?>public_html/frontend/image/system/<?php echo $system_info[0]->system_image;?>" alt="logo" />  
 
 
            <div class="logo" style="text-align:center !important;" >

        
             
			   <p>JOB ORDER FORM <br/>PANAFLEX</p>
<div style="clear:both"></div>    
       
		   </div>
		  
		   
		   
		   
		
		</div>
		
		
		
		<div id="customer">

            <!--<textarea id="customer-title">Widget Corp.
c/o Steve Widget</textarea>-->
<table id="meta" style="float: left;">
                <tr>
                    <td class="meta-head">Client Name</td>
                    <td align="left" style="border-bottom:1px solid #333;"><textarea readonly style="text-align: center;"><?php echo $user_list[0]->name; ?></textarea></td>
                </tr>
                <tr style="display:none;" >

                    <td class="meta-head">Contact</td>
                    <td align="left"><textarea readonly style="text-align: center;" id="date"><?php echo $user_list[0]->contact; ?></textarea></td>
                </tr>
                <tr style="display:none;">
                    <td class="meta-head">Address</td>
                    <td align="left"><div style="text-align: left;" class="due"><?php echo $user_list[0]->address; ?></div></td>
                </tr>

            </table>
            <table id="meta">
                <tr>
                    <td class="meta-head">Job Order #</td>
                    <td align="center" style="text-align: center;" ><textarea readonly style="border-bottom:1px solid #333;text-align: center;"><?php echo $order_code; ?></textarea></td>
                </tr>
                <tr style="display:none;">

                    <td class="meta-head">Date</td>
                    <td><textarea readonly id="date"><?php
					$order_date = new DateTime($order_list[0]->order_date);
                    $order_date_show = $order_date->format('F d, Y');
                    echo $order_date_show;
					
					?></textarea></td>
                </tr>
                <tr style="display:none;">
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">Rs. <?php echo $rem; ?></div></td>
                </tr>

            </table>
		<div style="clear:both"></div>    
		</div>
		
		
		
		
		
		
		
		
		
		

            <!--<textarea id="customer-title">Widget Corp.
c/o Steve Widget</textarea>-->
<table id="meta" style="width:100%;margin: 3% 0%;" >
                <tr>
                    <td class="meta-head" style="width: 12%;">Sales Person</td>
                    <td align="left"><textarea readonly style="border-bottom:1px solid #333;text-align: center;"><?php echo $payment_list[0]->sales_person; ?></textarea></td>
					
					
					
					<td class="meta-head">Date</td>
                    <td align="left"><textarea readonly id="date" style="border-bottom:1px solid #333;text-align: center;"><?php
					$order_date = new DateTime($order_list[0]->order_date);
                    $order_date_show = $order_date->format('d F, Y');
                    echo $order_date_show;
					
					?></textarea></td>
					
					
					
					<td class="meta-head">Time</td>
                    <td align="left"><textarea readonly style="border-bottom:1px solid #333;text-align: center;"><?php
					$order_date1 = new DateTime($order_list[0]->created_date);
                    $order_time_show = $order_date1->format('h:i');
                    echo $order_time_show; ?></textarea></td>
					
					
					<td class="meta-head" style="width: 15%;">Delivery Date</td>
                    <td align="left"><textarea readonly style="border-bottom:1px solid #333;text-align: center;"><?php echo date("d F, Y"); ?></textarea></td>
                </tr>
                

            </table>
            
	
		
		
		
		
		
		
		
		
		
		
		
		
		<table id="items">
		
		  <tr>
		      <th>S.No</th>
		      <th style="width: 30% !important;">Job Title</th>
		      <th>Finishing Detail</th>
		      <th>Size</th>
		      <th>Qty.</th>
		      <th style="width: 15% !important;">Media</th>
			  <th>Sq.Ft</th>
		      <th>Amount</th>
		  </tr>
		  
		  <?php
		  $c = 1;
		  foreach($cart_list as $cart){
		 ?> 
		  <tr class="item-row">		     
		     
		      <td><span class="cost" readonly><?php echo $c; $c++; ?></span></td>
		      <td><textarea class="cost" readonly><?php echo $cart->job; ?></textarea></td>
		      <td><textarea class="cost" readonly><?php echo $cart->fname; ?></textarea></td>
		      <td><textarea class="qty" readonly><?php echo $cart->size1." x ".$cart->size2; ?></textarea></td>
		      <td><span class="price"><?php echo $cart->qty; ?></span></td>
			   <td class="description"><textarea readonly> <?php
			    $product_name = $this->Mdl_seller->get_relation_pax('product_list','product_name','id',$cart->product_id);
                                            echo $product_name;
			  ?></textarea></td>
		      <td><span class="price"><?php echo $cart->square_feet; ?></span></td>
		      <td><span class="price">Rs. <?php echo $cart->total_price; ?></span></td>
		  </tr>
		  <?php
		  }
		  ?>
		 
		 <!-- <tr style="border-top: 1px solid;">
		      <td colspan="3" class="blank"> </td>
		      <td colspan="3" class="total-line">Subtotal</td>
		      <td class="total-value" colspan="2"><div id="subtotal">Rs. <?php //echo $order_list[0]->total_price; ?></div></td>
		  </tr>-->
		  <tr>

		      <td colspan="3" class="blank"> </td>
		      <td colspan="3" class="total-line">Total</td>
		      <td class="total-value" colspan="2"><div id="total">Rs. <?php echo $order_list[0]->total_price; ?></div></td>
		  </tr>
		  <!--<tr>

		      <td colspan="3" class="blank"> </td>
		      <td colspan="3" class="total-line">Previous Paid</td>
		      <td class="total-value" colspan="2"><div id="total">Rs. <?php echo ($order_list[0]->total_price - ($paid+$rem)); ?></div></td>
		  </tr>-->
		  <tr>
		      <td colspan="3" class="blank">Authorized Signature: _______________  </td>
			  
			  
		      <td colspan="3" class="total-line">Amount Paid</td>

		      <td class="total-value" colspan="2"><div id="paid">Rs. <?php echo $new_paid_price; ?></div></td>
		  </tr>
		  <tr>
		      
		      <td colspan="3" class="blank">Customer Signature: _______________  </td>
		      
		      <td colspan="3" class="total-line">Balance Due</td>
		      <td class="total-value" colspan="2"><div class="due">Rs. <?php echo $rem; ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		 
		  <textarea readonly id="address"><?php echo $system_info[0]->long_address;?>

                            Email: ultimatesign2011@gmail.com			
Phome:021-32603326 Cell: 0321-2421289, 0300-2421289
 <?php /* echo  $system_info[0]->mobile; */ ?> 

</textarea>
		</div>
		
		
		
		
		<div id="identity" style="width: 100%;height: 100px !important;">
		
            

            
		
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