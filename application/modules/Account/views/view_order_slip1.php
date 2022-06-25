<html>
<head>
<style>
	body{
		margin: 0in 0in 0in 0in;
		background-color:#f5f5f5;
		height: 11in;
	}

	*{
		font-family:arial;
		font-size:12px;
	}

	th {
		background-color:gray;
		color:white;
		font-weight:bold;
	}

	td {
		vertical-align:top;
	}

	.store-info div {
		font-size:1.2em;
	}

	.store-info div.company-name {
		font-size:1.5em;
		font-weight: bold;
	}

	table.order-info td {
		
		padding: 2px 4px 2px 4px;
	}

	table.order-info tr td.label {
		font-weight:bold;
		text-align:right;
		border-right:solid 1px #c0c0c0;

	}

	table.order-info tr td.label.first {

	}

	table.order-info tr td.label.last {

	}

	table.line-items {
		margin-top:0.1in;
		padding: 0.1in 0in 0.1in 0in;
	}

	table.line-items th {
		padding:2px;
	}
	
	table.footer 
	{
		border-top:solid 1px #707070;
	}
	
	table.footer td.label
	{
		font-weight:bold;
		text-align:right;
	}
	
	td.notes 
	{
		padding: 0.1in;
		font-style: italic;
	}
	
	.barcode
	{
		font-family:"Free 3 of 9 Extended";
		font-size:48pt;
	}
	
	.btn, .btn-default, .btn:focus, .btn-default:focus {
    background-color: #abbac3!important;
    border-color: #abbac3;
}
.btn {
   padding: 10px 30px;
    display: inline-block;
    color: #FFF!important;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.25)!important;
    background-image: none!important;
    /* border: 5px solid #FFF; */
    border-radius: 0;
    box-shadow: none!important;
    -webkit-transition: all ease .15s;
    transition: all ease .15s;
    cursor: pointer;
    vertical-align: middle;
    margin: 0;
    position: relative;
    font-size: 20px;
    text-decoration: none;
}
</style>
</head>

<body>
<?php


	//	$payment_id= $this->uri->segment(3);
        $order_code= $this->uri->segment(3);

$order_list = $this->Mdl_Account->get_order_list_by_code($order_code);
$cart_list = $this->Mdl_Account->get_order_cart_list($order_code);
$payment_list = $this->Mdl_Account->get_order_payment_list($order_code);
//echo "<pre>";/
///print_r($payment_list);

$paid = 0 ;
$rem = 0 ;

foreach($payment_list as $pay){
	
	$paid = $paid + $pay->paid_price;
	$rem = $rem + $pay->remaining_price;
}

$user = $this->Mdl_Account->_get_user_list($order_list[0]->user_id);

?>
<div style="height:10in; width:7.5in;margin:0px auto;">

<!-- Order Header - THIS SECTION CAN BE MODIFIED AS NEEDED -->

<table cellspacing=0 cellpadding="2" border=0 style="width:7.5in">
<thead>
	<tr>
		<th colspan="3">
			Order Slip
		</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td colspan="2" style="width:4.5in" class="store-info">
			<div class="company-name">Company Name Here</div>
			<div>Main Address: 683 W. Edgar Rd<br/>Linden, NJ 07036</div>
		</td>
		<td style="width:3.5in;" align="right" valign="top">
			
		</td>
	</tr>
	<tr>
		<td style="height:0.15in"></td>
	</tr>
	<tr>
		<td align="right" style="width:1in">
			<b>Ship To:</b>
		</td>
		<td style="width:3.5in; font-size:14px">
			<div><?php 
			/* if($user_list[0]->delivery_address != "")
			{
				echo $user_list[0]->delivery_address;
			}else
			{ */
				echo $user[0]->address;
			/* } */
			 ?></div>
		</td>
		<td style="width:2.5in">
			<table cellspacing="0" border="0" class="order-info">
			<tr>
				<td align="right" class="label first">Order #</td>
				<td><?php echo $order_list[0]->order_code; ?></td>
			</tr>
			<tr>
				<td align="right" class="label">Date</td>
				<td><?php echo  date("d/m/Y", strtotime($order_list[0]->order_date)); ?></td>
			</tr>
			<tr>
				<td align="right" class="label">User</td>
				<td><?php echo $user[0]->name; ?></td>
			</tr>
			<tr>
				<td align="right" class="label last">Ship Date</td>
				<td><?php echo date("d/m/Y"); ?></td>
			</tr>
			</table>
		</td>
	</tr>
</tbody>
</table>

<!-- END Order Header -->

<table cellspacing=0 cellpadding="2" border="0" style="width:100%" class="line-items">
<thead>

<!-- Order Items Header - THIS SECTION CAN BE MODIFIED AS NEEDED -->

	<tr>
		<th align="left" style="width:1.5in" class="sku">
			Item #
		</th>
		<th align="left">
			Description
		</th>
		<th align="right" style="width:0.75in" class="price">
			Price
		</th>
		<th align="center" style="width:0.75in">
			Qty
		</th>
		<th align="right" style="width:0.75in" class="price">
			Ext. Price
		</th>
	</tr>

<!-- END Order Items Header -->

</thead>
<tbody>


<!-- Order Items - THIS SECTION CAN BE MODIFIED AS NEEDED -->
  <?php
                                   $final_total = 0;
                                $shipping_charges = 0;
                                $product_id_array = "";
                              foreach($cart_list as $key => $row) { 
                                    ?>
                                    <tr>
                                        <td class="sku"><?php //echo $row->username;
                                            $product_code = $this->Mdl_Account->get_relation_pax('product_list','product_code','id',$row->product_id);
											echo $product_code; ?>
                                          

                                        </td>

                                        <td><?php
										
										//echo $order_list[0]->product_id;
                                          //  $product_id_array = $order_list[0]->product_id.",".$product_id_array;
                                            $product_name = $this->Mdl_Account->get_relation_pax('product_list','product_name','id',$row->product_id);
                                            echo $product_name;

                                            ?></td>
										<td align="right" class="price">Rs. <?php echo $row->sell_price; ?></td>
                                        <td align="center">
                                            <?php echo $row->qty; ?>

                                        </td>
                                       
                                        <td align="right" class="price"> Rs. <?php
                                            $sub_total = ($row->qty * $row->sell_price);
                                            echo $sub_total;
                                            $final_total = $final_total + $sub_total;
                                            $shipping_charges = $shipping_charges +  $row->other_charges;
                                            ?></td>
                                    </tr>
                                <?php
                             } 


								//print_r($order_list);
                                ?>
					


<!-- END Order Items -->

</tbody>
</table>

<!-- Order Footer - THIS SECTION CAN BE MODIFIED AS NEEDED -->

<table cellspacing=0 cellpadding="2" border="0" style="width:100%" class="footer">
<tbody>
	<tr>
		<td rowspan="5" class="notes" >
			Sample Notes to Buyer
		</td>
		<td align="right" style="width:1in" class="label price">
			Sub Total:
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php echo $sub_total; ?></td>
	</tr>
	<tr>
		<td align="right" class="label price">
			Other Charges: 
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php echo $shipping_charges; ?></td>
	</tr>
	<!--<tr>
		<td align="right" class="label price">
			Sale Tax (<?php //echo $order_list[0]->sale_tax; ?>%): 
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php //echo $order_list[0]->sale_tax_charges; ?></td>
	</tr>-->
	<tr>
		<td align="right" class="label price">
			Total:
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php echo $order_list[0]->total_price; ?></td>
	</tr>
	<tr>
		<td align="right" class="label price">
			Paid Price:
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php echo $paid; ?></td>
	</tr>
	<tr>
		<td align="right" class="label price">
			Remaining Price:
		</td>
		<td style="width:0.75in" align="right" class="price">Rs. <?php 
		//$rem = $order_list[0]->total_price - $payment_list[0]->paid_price;
		echo $rem; ?></td>
	</tr>
</tbody>
</table>

<!-- END Order Footer -->
<a class="btn btn-sm" href="<?php echo base_url(); ?>Account/order_list" >Back</a>
</div>



</body>
</html>