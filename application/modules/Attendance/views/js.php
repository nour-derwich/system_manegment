<?php
$script_check =   $this->uri->segment(2);
?>
<script type="text/javascript">
    jQuery(function($) 
        {

            //CAtegory_table
            var oTable1 = $('#category_table').dataTable(
                {
                    "aoColumns":
                        [
                            { "bSortable": true },
                            { "bSortable": true },
                            { "bSortable": true },
                            { "bSortable": false }
                        ]
                });

            //Sub Category_table
            var oTable1 = $('#sub_category_table').dataTable(
                {
                    "aoColumns":
                        [
                            { "bSortable": true },
                            { "bSortable": true },
                            { "bSortable": true },
                            { "bSortable": true },
                            { "bSortable": false }
                        ]
                });
  $(".product_status").change(function(){
                    var _status = $(this).val();
                    var ref     = $(this).attr('ref');
                    var reff     = $(this).attr('reff');
                    if(_status == 0)
                    {
                        $(this).val(1);
                        var status_new = 1;
                        $(this).prop('checked',true);
                    }else
                    {
                        $(this).val(0);
                        var status_new = 0;
                        $(this).prop('checked',false);
                    }

                    if(ref != null)
                    {
                        var json = {};

                        json['id']       = ref;
                        json['seller_id']       = reff;
                        json['status']   = status_new;
                        var request = $.ajax({
                            url: "<?php echo base_url('Product/change_product_status'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",
                           // dataType: "html",

                            success : function(_return)
                            {
                                //console.log(_return);
                                if(_return['_return'] > 0)
                                {

                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Product Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });

                                    return false;

                                }
                            }
                        });
                    }
                });

				
				
						$(".country").change(function(){

            var json = {};
            json['country_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_city_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.city').html(_return); 
                }
            });  

        });

		
		
		
            //Category Status Change
            $(".category_status").change(function(){
                var _status = $(this).val();
                var ref     = $(this).attr('ref');
                if(_status == 0)
                {
                    $(this).val(1);
                    var status_new = 1;
                    $(this).prop('checked',true);
                }else
                {
                    $(this).val(0);
                    var status_new = 0;
                    $(this).prop('checked',false);
                }

                if(ref != null)
                {
                    var json = {};

                    json['id']       = ref;
                    json['status']   = status_new;
                    var request = $.ajax({
                        url: "<?php echo base_url('Product/change_category_status'); ?>",
                        type: "POST",
                        data: json,
                        dataType: "json",

                        success : function(_return)
                        {
                            if(_return['_return'] > 0)
                            {

                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Status Changed!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Category Status Changed Successfully.',
                                    class_name: 'gritter-success  gritter-light'
                                });

                                return false;

                            }
                        }
                    });
                }
            });

$(".country").change(function(){

            var json = {};
            json['country_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_state_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.state').html(_return); 
                }
            });  

        });


        //City Get
        $(".state").change(function(){

            var json = {};
            json['country_id'] = $("#country").val();
            json['state_id'] = $(this).val();

            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_state_city_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.city').html(_return); 
                }
            });  

        });




            //Upload Pic token Purpose
            $("#upload_pic_token").click(function()
            {
                $("input[id='cat_img']").click();
                /* bootbox.confirm("Are you sure? want to upload image with current person", function(result)
                 {
                 if(result)
                 {
                 $("input[id='my_file']").click();
                 //readIMG(this);
                 console.log(this);
                 }
                 }); */

            });
            $("#cat_img").change(function ()
            {
                if (this.files && this.files[0])
                {

                    var ext = $('#cat_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                }
            });

            $("#price").blur(function ()
            {
                var price = $("#price").val();
                var dis_price = $("#dis_price").val();
                var final = price - (price * (dis_price/100));


                if(price > 0)
                {
                    if(dis_price == "")
                    {
                        $('#total_price').val(price);
                    }
                    else
                    {
                        if (dis_price < 100)
                        {
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter discount price less than product price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#dis_price').val('');
                                $('#dis_price').focus();
                                $('#total_price').val(price);
                            }
                            else {
                                $('#total_price').val(Math.floor(final));
                            }

                        }
                        else
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Discount Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than 100 %.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);

                        }
                    }

                }


                /* if (this.files && this.files[0])
                 {

                 var ext = $('#product_img').val().split('.').pop().toLowerCase();
                 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                 {
                 alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                 $('#product_img').val('');
                 }
                 else
                 {

                 }
                 }*/
            });

            $("#dis_price").blur(function ()
            {
                var price = $("#price").val();
                var dis_price = $("#dis_price").val();
                var final = price - (price * (dis_price/100));


                if(price > 0)
                {
                    if(dis_price < 100)
                    {
                        if(final < 0)
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Discount Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than product price.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);
                        }
                        else
                        {
                            $('#total_price').val(Math.floor(final));
                        }

                    }else
                    {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Discount Price Error!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please enter discount price less than 100 %.',
                            class_name: 'gritter-success  gritter-light'
                        });
                        $('#dis_price').val('');
                        $('#dis_price').focus();
                        $('#total_price').val(price);

                    }

                }
                else
                {
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Price Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please enter product price.',
                        class_name: 'gritter-success  gritter-light'
                    });
                    $('#total_price').val('');
                    $('#dis_price').val('');
                    $('#price').focus();
                }


               /* if (this.files && this.files[0])
                {

                    var ext = $('#product_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                        $('#product_img').val('');
                    }
                    else
                    {

                    }
                }*/
            });

			  $("#paid_price").blur(function ()
            {
                var total_price = $("#total_price").val();
                var paid_price = $("#paid_price").val();
                var final = total_price - (paid_price);


                if(total_price > 0)
                {
                    /* if(total_price < paid_price)
                    {
						$.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Paid Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter paid price less than product price.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#remaining_price').val('');
                            $('#paid_price').val('');
                            $('#paid_price').focus();
                      
                       
                    }else
                    { */
                        
                         $('#remaining_price').val(final);
						
                    /* } */

                }
                else
                {
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Price Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please enter Sell price.',
                        class_name: 'gritter-success  gritter-light'
                    });
                   // $('#total_price').val('');
                    $('#paid_price').val('');
                    $('#sprice').focus();
                }


               /* if (this.files && this.files[0])
                {

                    var ext = $('#product_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                        $('#product_img').val('');
                    }
                    else
                    {

                    }
                }*/
            });

			
            $(".mproduct_img").change(function ()
            {
              /*  if (this.files && this.files[0])
                {

                    var ext = $('#mproduct_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                        $('#mproduct_img').val('');

                    }
                    else
                    {

                    }
                }*/
            });

            //Show Sub Category
            $('#search_cat_id').change(function()
            {
                var json             = {};
                json['search_cat_id']   = $(this).val();
                var request = $.ajax(
                    {
                        url: "<?php echo base_url('Product/get_subcategory_byid'); ?>",
                        type: "POST",
                        data: json,
                        dataType: "html",
                        beforeSend : function()
                        {
                            $('.icon-spinner').removeClass('hide');
                        }
                        ,
                        success : function(_return)
                        {
                           // console.log(_return);
                            $('#scat_id').html(_return);
                            //$(".city_get").change();

                        },
                        complete: function ()
                        {
                            $('.icon-spinner').addClass('hide');
                        }
                    });
            });
			
			 //Show Sub Category
            $('#scat_id').change(function()
            {
                var json             = {};
                json['search_cat_id']   = $("#search_cat_id").val();
                json['scat_id']   = $(this).val();
                var request = $.ajax(
                    {
                        url: "<?php echo base_url('Product/get_product_byid'); ?>",
                        type: "POST",
                        data: json,
                        dataType: "json",
                        beforeSend : function()
                        {
                            $('.icon-spinner').removeClass('hide');
                        }
                        ,
                        success : function(_return)
                        {
                            console.log(_return);
                           // $('#scat_id').html(_return);
                            //$(".city_get").change();
							$("#pid").val(_return['_return'][0].id);
							$("#pname").val(_return['_return'][0].product_name);
							$("#pprice").val(_return['_return'][0].product_price);

                        },
                        complete: function ()
                        {
                            $('.icon-spinner').addClass('hide');
                        }
                    });
            });

			$("#sprice1").blur(function ()
            {
				var pre_rem = $("#pre_remaining__price").val();
				var final_rem = 0;
				if(pre_rem > 0)
				{
					final_rem = parseFloat(pre_rem);
				}
				
				if($("#sprice").val() == "")
				{
					var sprice = 0;
				}
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#oqty").val() == "")
				{
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#oqty").val());
                }
				if($("#other_price").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#other_price").val());
                }
				
                var final = (sprice * oqty)+parseFloat(other_price)+parseFloat(pre_rem);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#total_price').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#total_price').val('');
                            }
                            else {
                                $('#total_price').val(Math.floor(parseFloat(final)));
                            }

                        /* }
                        else
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Qty Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than 100 %.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);

                        } */
                    }

                }


                /* if (this.files && this.files[0])
                 {

                 var ext = $('#product_img').val().split('.').pop().toLowerCase();
                 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                 {
                 alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                 $('#product_img').val('');
                 }
                 else
                 {

                 }
                 }*/
            });

			$("#oqty1").blur(function ()
            {
				var pre_rem = $("#pre_remaining__price").val();
				var final_rem = 0;
				if(pre_rem > 0)
				{
					final_rem = parseFloat(pre_rem);
				}
				
               if($("#sprice").val() == "")
				{
					var sprice = 0;
				}
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#oqty").val() == "")
				{
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#oqty").val());
                }
				if($("#other_price").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#other_price").val());
                }
				
                   var final = (sprice * oqty)+parseFloat(other_price)+parseFloat(pre_rem);

                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#total_price').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#total_price').val('');
                            }
                            else {
                                $('#total_price').val(Math.floor(parseFloat(final)));
                            }

                        /* }
                        else
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Qty Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than 100 %.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);

                        } */
                    }

                }


                /* if (this.files && this.files[0])
                 {

                 var ext = $('#product_img').val().split('.').pop().toLowerCase();
                 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                 {
                 alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                 $('#product_img').val('');
                 }
                 else
                 {

                 }
                 }*/
            });

			$("#other_price1").blur(function ()
            {
				var pre_rem = $("#pre_remaining__price").val();
				var final_rem = 0;
				if(pre_rem > 0)
				{
					final_rem = parseFloat(pre_rem);
				}
				
               if($("#sprice").val() == "")
				{
					var sprice = 0;
				}
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#oqty").val() == "")
				{
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#oqty").val());
                }
				if($("#other_price").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#other_price").val());
                }
				
                   var final = (sprice * oqty)+parseFloat(other_price)+parseFloat(pre_rem);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#total_price').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#total_price').val('');
                            }
                            else {
                                 $('#total_price').val(Math.floor(parseFloat(final)));
                            }

                        /* }
                        else
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Qty Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than 100 %.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);

                        } */
                    }

                }


                /* if (this.files && this.files[0])
                 {

                 var ext = $('#product_img').val().split('.').pop().toLowerCase();
                 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                 {
                 alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                 $('#product_img').val('');
                 }
                 else
                 {

                 }
                 }*/
            });

			$("#pre_remaining__price1").blur(function ()
            {
				var pre_rem = $("#pre_remaining__price").val();
				var final_rem = 0;
				if(pre_rem > 0)
				{
					final_rem = parseFloat(pre_rem);
				}
				
               if($("#sprice").val() == "")
				{
					var sprice = 0;
				}
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#oqty").val() == "")
				{
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#oqty").val());
                }
				if($("#other_price").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#other_price").val());
                }
				
                   var final = (sprice * oqty)+parseFloat(other_price)+parseFloat(pre_rem);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#total_price').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#total_price').val('');
                            }
                            else {
                                 $('#total_price').val(Math.floor(parseFloat(final)));
                            }

                        /* }
                        else
                        {
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Qty Price Error!',
                                // (string | mandatory) the text inside the notification
                                text: 'Please enter discount price less than 100 %.',
                                class_name: 'gritter-success  gritter-light'
                            });
                            $('#dis_price').val('');
                            $('#dis_price').focus();
                            $('#total_price').val(price);

                        } */
                    }

                }


                /* if (this.files && this.files[0])
                 {

                 var ext = $('#product_img').val().split('.').pop().toLowerCase();
                 if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                 {
                 alert('Invalid extension Only Upload JPG | PNG | GIF Image!');
                 $('#product_img').val('');
                 }
                 else
                 {

                 }
                 }*/
            });


            //Product Search
            $(".search_product").click(function()
            {

                var json = {};
                json['search_cat_id']  = $('#search_cat_id').val();
                json['scat_id'] = $("#scat_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Product/product_search'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.product_result').html(_return);

                    }
                });

            });
			
			
			  //Order Search
            $(".search_order").click(function()
            {

                var json = {};
                json['search_cat_id']  = $('#search_cat_id').val();
                json['scat_id'] = $("#scat_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Product/order_search'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.order_result').html(_return);

                    }
                });

            });



			
			$("#user_type").change(function(){

            var type = $(this).val();
			if(type == "user"){
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_user_list'); ?>",
                type: "POST",                
                dataType: "html",

                success : function(_return)
                {
					$(".show_user_div").removeClass('hide');
                 
                    $('.new_user').html(_return); 
                }
            });  
			}else
			{
				$(".show_user_div").addClass('hide');
				$("#name").val('');
					$("#contact").val('');
					$("#address").val('');
					$("#pre_remaining__price").val('0');
					$("#order_remaining_amount").val('0');
					$("#order_user_id").val('');
					$("#pre_remaining__price").blur();
			}
        });
		
		
			
			$("#new_user").change(function(){
				
				  

            var type = $(this).val();
			if(type != "new_user")
			{
				var json = {};
                json['user_id']  = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_user_info'); ?>",
                type: "POST",                
                dataType: "html",
				data: json,
                    dataType: "json",
                success : function(_return)
                {
					
                    console.log(_return);
					$("#name").val(_return['name']);
					$("#contact").val(_return['contact']);
					$("#address").val(_return['address']);
					$("#pre_remaining__price").val(_return['remaining']);
					$("#order_remaining_amount").val(_return['remaining']);
					$("#order_user_id").val(_return['user_id']);
					$("#old_order_code").val(_return['order_code']);
					$("#old_payment_id").val(_return['old_payment_id']);
					$("#old_order_id").val(_return['old_order_id']);
					$("#pre_remaining__price").blur();
					
                   // $('.new_user').html(_return); 
                }
            });  
			}else
			{
				$("#name").val('');
					$("#contact").val('');
					$("#address").val('');
					$("#pre_remaining__price").val('0');
					$("#order_remaining_amount").val('0');
					$("#order_user_id").val('');
					$("#old_order_code").val('');
					$("#old_payment_id").val('');
					$("#old_order_id").val('');
					$("#pre_remaining__price").blur();
			}
        });
				
		
		$("#payment_user_id").change(function()
		{
				
				  

           if($(this).val() == "")
		   {
			   $("#pre_remaining_price_payment").val('');
					$("#order_remaining_amount").val('');
					$("#order_user_id").val('');
					$("#old_order_code").val('');
					$("#old_payment_id").val('');
					$("#old_order_id").val('');
			   
		   }else
		   {
				var json = {};
                json['user_id']  = $("#payment_user_id").val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_user_info'); ?>",
                type: "POST",                
                dataType: "html",
				data: json,
                    dataType: "json",
                success : function(_return)
                {
					
                    //console.log(_return);
					if(_return['remaining'] == 0)
					{
						$("#pre_remaining_price_payment").val(_return['remaining']);
					$("#order_remaining_amount").val('');
					$("#order_user_id").val('');
					$("#old_order_code").val('');
					$("#old_payment_id").val('');
					$("#old_order_id").val('');
					$("#paid_price_payment").prop("disabled",true);
					$(".add_payment").prop("disabled",true);
					}
					else
					{
						$("#paid_price_payment").prop("disabled",false);
					$(".add_payment").prop("disabled",false);
						$("#pre_remaining_price_payment").val(_return['remaining']);
					$("#order_remaining_amount").val(_return['remaining']);
					$("#order_user_id").val(_return['user_id']);
					$("#old_order_code").val(_return['order_code']);
					$("#old_payment_id").val(_return['old_payment_id']);
					$("#old_order_id").val(_return['old_order_id']);
					$("#pre_remaining__price").blur();
					}
					
					
                   // $('.new_user').html(_return); 
                }
            });  
		   }
        });
			

			
			
			$("#sprice").blur(function ()
            {
				
				
				
				var final_p = 0;
				
				
				
				if($("#pprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Product Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please select product category.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#search_cat_id').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				else if($("#sprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				/* else if($("#pprice").val() < $("#sprice").val() || $("#pprice").val() <= $("#sprice").val())
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price less than product price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				} */
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#qty").val() == "" || $("#qty").val() == "0")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Quantity Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter  product qty.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#qty').val('');
                                $('#qty').focus();
                                $('#totalp').val('');
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#qty").val());
                }
				if($("#otherp").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#otherp").val());
                }
				
                var final = (sprice * oqty)+parseFloat(other_price);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#totalp').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
                            }
                            else {
                                $('#totalp').val(Math.floor(parseFloat(final)));
                            }
                    }

                }

            });

			$("#qty").blur(function ()
            {
				
				
				
				var final_p = 0;
				
				
				
				if($("#pprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Product Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please select product category.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#search_cat_id').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				else if($("#sprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				/* else if($("#pprice").val() < $("#sprice").val() || $("#pprice").val() <= $("#sprice").val())
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price less than product price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				} */
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#qty").val() == "" || $("#qty").val() == "0")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Quantity Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter  product qty.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#qty').val('');
                                $('#qty').focus();
                                $('#totalp').val('');
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#qty").val());
                }
				if($("#otherp").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#otherp").val());
                }
				
                var final = (sprice * oqty)+parseFloat(other_price);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#totalp').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
                            }
                            else {
                                $('#totalp').val(Math.floor(parseFloat(final)));
                            }
                    }

                }

            });


			$("#otherp").blur(function ()
            {
				
				
				
				var final_p = 0;
				
				
				
				if($("#pprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Product Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please select product category.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#search_cat_id').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				else if($("#sprice").val() == "")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				}
				/* else if($("#pprice").val() < $("#sprice").val() || $("#pprice").val() <= $("#sprice").val())
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Sell Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter sell price less than product price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
					//var sprice = 0;
				} */
				else
				{
					var sprice = parseFloat($("#sprice").val());
                }
				if($("#qty").val() == "" || $("#qty").val() == "0")
				{
					 $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Quantity Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter  product qty.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#qty').val('');
                                $('#qty').focus();
                                $('#totalp').val('');
					var oqty = 0;
				}
				else
				{
					var oqty = parseFloat($("#qty").val());
                }
				if($("#otherp").val() == "")
				{
					var other_price = 0;
				}
				else
				{
					var other_price = parseFloat($("#otherp").val());
                }
				
                var final = (sprice * oqty)+parseFloat(other_price);


                if(sprice > 0)
                {
                    if(oqty == "")
                    {
                        $('#totalp').val('');
                    }
                    else
                    {
                       /*  if (oqty < 100)
                        { */
                            if (final < 0) {
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Discount Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter price less than sell price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#sprice').val('');
                                $('#sprice').focus();
                                $('#totalp').val('');
                            }
                            else {
                                $('#totalp').val(Math.floor(parseFloat(final)));
                            }
                    }

                }

            });
			
			
			
			$("#paid_price_payment").blur(function ()
            {
				var pre_rem = $("#pre_remaining_price_payment").val();
				var paid_rem = $("#paid_price_payment").val();
				var final_rem = 0;			
				if (pre_rem == 0) 
				{
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Previous Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please select user to previous price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#paid_price_payment').val('');
                                $('#payment_user_id').focus();
                                $('#remaining_price_payment').val('');
               }
			   else
			   {
					/* if(paid_rem <= pre_rem )
					{ */
					      
								
						
						var final = parseFloat(pre_rem) - parseFloat(paid_rem);
						$('#remaining_price_payment').val(Math.floor(parseFloat(final)));


					/* }
					else
					{
				$.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Paid Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter paid price less than to previous price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                           
								 $('#paid_price_payment').val('');
                                $('#paid_price_payment').focus();
                                $('#remaining_price_payment').val('');
								
					} */

			   }
            });

			
			
			$("#paid_price").blur(function ()
            {
				var paid_price = $("#paid_price").val();
				var total_price = $("#total_price").val();
				var final_rem = 0;			
				if (total_price == 0) 
				{
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Total Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter total price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                $('#paid_price').val('');
                                $('#paid_price').focus();
                                //$('#remaining_price_payment').val('');
               }
			   else
			   {
					/* if(paid_rem <= pre_rem )
					{ */
					      
								
						
						var final = parseFloat(total_price) - parseFloat(paid_price);
						$('#remaining_price').val(Math.floor(parseFloat(final)));


					/* }
					else
					{
				$.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Paid Price Error!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Please enter paid price less than to previous price.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                           
								 $('#paid_price_payment').val('');
                                $('#paid_price_payment').focus();
                                $('#remaining_price_payment').val('');
								
					} */

			   }
            });


            var oTable1 = $('#product-image').dataTable(
                {
                    "aoColumns":
                        [
                            { "bSortable": true },
                            { "bSortable": false }
                        ]
                });




            var sor_count = $('#column_count').val();  
            var sorting_arr = [];
            for(var sort = 0; sort <= sor_count; sort++)
            { 
                sorting_arr = {'bSortable':true}; 
            } 
            //console.log(sorting_arr);


            //Payment Receiving Js
            $(document).on('click','.checkbox_customer_payment',function()
            {
                    //$('#checkbox_customer').prop('checked',false);
					 if($(this).prop('checked') == true)
                    {
                        $(".payment_receiving_submit").attr("disabled",false);
                    }
                    else
                    {
                        $(".payment_receiving_submit").attr("disabled",true);
                    }
                    
            });
			
			//Recent SMS Js
            $(document).on('click','.checkbox_sms_customer',function()
            {
                    //$('#checkbox_customer').prop('checked',false);
					if($(this).prop('checked') == true)
                    {
                        $(".payment_sms_submit").attr("disabled",false);
                        $(".sms_type").attr("disabled",false);
						
                    }
                    else
                    {
                        $(".payment_sms_submit").attr("disabled",true);
                        $(".sms_type").attr("disabled",true);
                    }
					
                   
            });
			
			//Packaging Checkbox Select
            $(document).on('click','.count_quantity',function()
			{
                var balance_quantity  =   $('#balance_qty').val();
                $('#ckbCheckAll').prop('checked',false);
                if(balance_quantity < 1)
                {
                    $('.count_quantity').prop('checked',false);
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Balance Required!',
                        // (string | mandatory) the text inside the notification
                        text: ' Balance Required For this Product!',
                        class_name: 'gritter-danger  gritter-light'
                    }); 
                    $('.btn-validate').prop('disabled',true);

                }   else{
                    $('#pax_segment').val('')
                    var count_check_quantity =0;
                    $('.count_quantity').each(function(){
                        //                    var 
                        if($(this).prop('checked') == true)
                        {
                            var __pax_id      =  $(this).attr('id');
                            var pax_id        = __pax_id.split('checkbox_');
                            var pax_segment   = $('#pax_segment').val();
                            var new_pax_segment = pax_segment + '_'+pax_id[1]+'';
                            $('#pax_segment').val(new_pax_segment);
                            var noofcopy      =  parseInt($('#noofcopy_'+pax_id[1]).val());
                            count_check_quantity = count_check_quantity +  parseInt(noofcopy);
                        }

                    });
                    $('#selected_qty').val(count_check_quantity);

                    var selected_quantity = count_check_quantity;   


                    if(selected_quantity > balance_quantity)
                    {
                        if($('.btn-validate').prop('disabled') == false){
                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Balance Exceeds!',
                                // (string | mandatory) the text inside the notification
                                text: ' Selected Quantity Exceeds From Balance Quantity Your Transaction Can not be Completed !',
                                class_name: 'gritter-danger  gritter-light'
                            }); 
                            $('.count_quantity').prop('checked',false);
                            $('#ckbCheckAll').prop('checked',false);
                            $('.btn-validate').prop('disabled',true);
                        } 

                    }else
                    {
                        var remaining_quantity = balance_quantity  - selected_quantity;
                        $('#remaning_qty').val(remaining_quantity);
                        $('.btn-validate').prop('disabled',false); 
                    }

                }
                // if(count_check_quantity > 0)
                //               {
                //                       alert(count_check_quantity);
                //               }

            });    
			
			
			//Dispatch List  Check Box			
			$(document).on('click','#ckbCheckAllDispatch',function()
			{
				if($("#ckbCheckAllDispatch").prop('checked') == true)
                {
					$(".dispatch_quantity").prop('checked', true);
					$(".dispatch_sub").prop('disabled',false);
				}
				else
				{
					$(".dispatch_quantity").prop('checked', false);
					$(".dispatch_sub").prop('disabled',true);
				}
			});
			
			$(document).on('click','.dispatch_quantity',function()
			{
			
				if($(".dispatch_quantity").prop('checked') == true)
                {
					$("#ckbCheckAllDispatch").prop('checked', false);
					$(".dispatch_sub").prop('disabled',false);
				}
				else
				{
					//$("#ckbCheckAllDispatch").prop('checked', true);
				}
				
			});
			/* 
			$("#ckbCheckAllDispatch").click(function () 
            {
				console.log("YES");
				$(".dispatch_quantity").prop('checked', true);
            });
			 */
			
           /*  $(document).on('click','.dispatch_quantity',function()
			{
                var balance_quantity  =   $('#balance_qty').val();
                var chk_all = $('#ckbCheckAllDispatch').prop('checked',false);
                if($("#ckbCheckAllDispatch").prop('checked') == true)
                {
                     $('.dispatch_quantity').each(function(){
						 
						  $(this).prop('checked',true);
                       

                    });
                    $('.btn-validate').prop('disabled',true);

                }
				else
				{
					
                    $('.dispatch_quantity').each(function()
					{
                       
                         $(this).prop('checked',true);

                    });



                }
               
            });   */  


            var oTable1 = $('#sample-table-2').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true }, 
                                { "bSortable": true }, 
                                { "bSortable": true },
                                { "bSortable": false }
                    ] 
            });
            var oTable1 = $('#distribution_table').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true },
                        null,null,null,null,
                        { "bSortable": false }
                    ] 
            });
            var oTable1 = $('#mailing_table').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true },
                        null,null,null,null,
                        { "bSortable": false }
                    ] 
            });

            var oTable2 = $('#sample-table-3').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true },
                        null,null,null,null,null,null,
                        { "bSortable": false }
                    ] 
            });

            var oTable3 = $('#sample-table-4').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true },
                        null,null,null,null,null,
                        { "bSortable": false }
                    ] 
            });

            var oTable4 = $('#sample-table-5').dataTable( 
                {
                    "aoColumns": 
                    [
                        { "bSortable": true },
                        null,null,null,null,
                        { "bSortable": false }
                    ] 
            });
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
            function tooltip_placement(context, source) 
            {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();
                var off2 = $source.offset();
                var w2 = $source.width();
                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }

            $('.column_1').hide();  
            $('.column_2').hide();  
            $('.lawahqeen').hide();  
            $('.other').hide(); 
            //Show State 
            $('#country_id').change(function()
                {
                    var json             = {};
                    json['country_id']   = $(this).val();
                    var request = $.ajax(
                        {
                            url: "<?php echo base_url('Hierarchy/get_state_byid'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "html",
                            beforeSend : function()
                            {
                                $('.icon-spinner').removeClass('hide');   
                            }
                            ,
                            success : function(_return)
                            {
                                $('#state_id').html(_return);
                                $(".city_get").change();

                            },
                            complete: function ()
                            {
                                $('.icon-spinner').addClass('hide');      
                            }
                    });
            });

			//Distribution Product Change
			$(".product_change").change(function()
			{
                $(".location_change").change();
            }); 
 
			//Distribution Location change
             $(".location_change").change(function(){

                var json = {};
                json['product_id']  = $('#product_id').val();
                json['location_id'] = $(this).val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/get_balance_by_product'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
						$('#balance_qty').val(_return); 
                        $('#seleted_qty').val(_return); 
                        $('#balance_qty').val(_return); 
					}
                });  

            }); 
			
			
			//Distribution Button Click
			$(".search_distribution").click(function()
			{
                //alert('yes');
                var json = {};
                json['country_id'] = $("#country_id").val();
                json['state_id'] = $("#state_id").val();
                json['city_id'] = $("#city_id").val();
                json['product_id'] = $("#product_id").val();
                json['location_id'] = $("#location_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/get_customer_by_distribution'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        console.log(_return);
                        $('.sample-table-2').html(_return); 
                        // $(".location_change").change();
                    }
                });  

            }); 
			
			

            //Mailing List Js 
            $(".search_mailing").click(function()
			{
				if($("#trans_code").val() == "" && $("#date_mailing").val() == "" && $("#product_id").val() == "" && $("#location_id").val() == "")
                {  
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please select any field',
                        class_name: 'gritter-danger  gritter-light'
                    });   
                }
				else
				{

                //alert('yes');
                var json = {};
                json['trans_code'] = $("#trans_code").val();
                json['date_mailing'] = $("#date_mailing").val();
                json['product_id'] = $("#product_id").val();
                json['location_id'] = $("#location_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/get_customer_mailing_list'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('#mailing_result').html(_return); 
                        // $(".location_change").change();
                    }
                });  
				}

            }); 	

			
			
            //Dispatch List Js 
            $(".search_dispatch").click(function()
			{
				if($("#trans_code").val() == "" && $("#date_mailing").val() == "" && $("#product_id").val() == "" && $("#location_id").val() == "")
                {  
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please select any field',
                        class_name: 'gritter-danger  gritter-light'
                    });   
                }
				else
				{
                //alert('yes');
                var json = {};
                json['trans_code'] = $("#trans_code").val();
                json['date_mailing'] = $("#date_mailing").val();
                json['product_id'] = $("#product_id").val();
                json['location_id'] = $("#location_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/get_customer_dispatch_list'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('#dispatch_result').html(_return); 
                        // $(".location_change").change();
                    }
                }); 
				}

            }); 
			
			
			//Customer List
            $(".filter_customer").click(function(){
                //alert('yes');
                var json = {};
                json['country_id1'] = $("#country_id").val();
                json['state_id1'] = $("#state_id").val();
                json['city_id1'] = $("#city_id").val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/get_customer_list'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('#filter_result_customer').html(_return); 
                        // $(".location_change").change();
                    }
                });  

            }); 

            /* $("#ckbCheckAll").click(function () 
            {
            console.log("YES");
            $(".checkBoxClass").prop('checked', true);
            }); */



            //select all checkboxes
            /* $("#select_all_mailing").change(function(){  //"select all" change 
            var status = this.checked; // "select all" checked status
            $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
            });
            });

            $('.checkbox').change(function(){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){ //if this item is unchecked
            $("#select_all_mailing")[0].checked = false; //change "select all" checked status to false
            }

            //check "select all" if all checkbox items are checked
            if ($('.checkbox:checked').length == $('.checkbox').length ){ 
            $("#select_all_mailing")[0].checked = true; //change "select all" checked status to true
            }
            }); */




            $(".state_get").change(function(){

                var json = {};
                json['country_id'] = $(this).val();
                var request = $.ajax({
                    url: "<?php echo base_url('Hierarchy/get_state_byid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.state_id').html(_return); 
                    }
                });  

            });
            //Shipping Address Checked
            $("#shipping_address").change(function()
                {
                    var postal_address = $("#paddress").val();
                    //alert("YES");

                    if($(this).prop('checked') == true) 
                    {
                        $("#saddress").val(postal_address);
                        //console.log(postal_address);
                    }
                    else
                    {
                        $("#saddress").val('');
                    }		
            });    

            //City Get
            $(".city_get").change(function(){

                var json = {};
                json['country_id'] = $("#country_id").val();
                json['state_id'] = $(this).val();

                var request = $.ajax({
                    url: "<?php echo base_url('Hierarchy/get_state_city_byid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.city_id').html(_return); 
                    }
                });  

            });



            //Check USer NAme Unique

            $('#username').blur(function(){
                var json = {};
                json['username'] = $('#username').val();
                json['id']       = $('#login_id').val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/check_user_exists'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {
                            $('input[name="username"]').rules('add', {
                                equalTo:'1',
                                messages:   {
                                    equalTo: ' User Name Already Exists can not be created again.'
                                }
                            });
                            // trigger immediate validation to update message
                            $('input[name="username"]').valid();
                            $('input[name="username"]').rules('remove','equalTo');

                            var old_username = $('input[name="username"]').attr('old-username');
                            if(old_username != null)
                            {
                                $('input[name="username"]').val(old_username);  
                            }else
                            {
                                $('input[name="username"]').val(''); 
                            }

                        }  
                    }
                });
            });  


            //Check Email Unique

            $('#email123').blur(function(){
                var json = {};
                json['email'] = $('#email').val();
                json['id']       = $('#login_id').val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/check_email_exists'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {
                            $('input[name="email"]').rules('add', {
                                equalTo:'1',
                                messages:   {
                                    equalTo: ' Email Already Exists can not be created again.'
                                }
                            });
                            // trigger immediate validation to update message
                            $('input[name="email"]').valid();
                            $('input[name="email"]').rules('remove','equalTo');

                            var old_email = $('input[name="email"]').attr('old-email');
                            if(old_email != null)
                            {
                                $('input[name="email"]').val(old_email);  
                            }else
                            {
                                $('input[name="email"]').val(''); 
                            }

                        }  
                    }
                });
            });  



            //Check Phone No
            $('#mobile_no').blur(function(){
                var json = {};
                json['mobile_no'] = $('#mobile_no').val();
                json['id']       = $('#login_id').val();
                var request = $.ajax({
                    url: "<?php echo base_url('Form/check_phone_exists'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {
                            $('#mobile_no').rules('add', {
                                equalTo:'1',
                                messages:   {
                                    equalTo: ' Phone No Already Exists can not be created again.'
                                }
                            });
                            // trigger immediate validation to update message
                            $('#mobile_no').valid();
                            $('#mobile_no').rules('remove','equalTo');

                            var old_phone = $('#mobile_no').attr('old-phone');
                            if(old_phone != null)
                            {
                                $('#mobile_no').val(old_phone);  
                            }else
                            {
                                $('#mobile_no').val(''); 
                            }

                        }  
                    }
                });
            });  

            //Category Change To show Price
            $("#category_id").change(function()
            {
                /* if($("#dis_channel_id").val() != "")
                { */
                        /* /*  $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please select Category.',
                        class_name: 'gritter-success  gritter-light'
                        }); 
                        $("#category_id").val('');		
                        $("#dis_channel_id").focus();		
                        }
                        else
                        {  */
                        var json = {};
                        json['category_id'] = $("#category_id").val();
                        json['dis_channel_id'] = $("#dis_channel_id").val();
                        json['noc'] = $("#noc").val();
                        var request = $.ajax
						({
                            url: "<?php echo base_url('Form/get_category_channel_list'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",

                            success : function(_return)
                            {
                                if(_return['total'] == 1)
                                {
                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Price Not Exists!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Price Not Exists.',
                                        class_name: 'gritter-success  gritter-light'
                                    });
                                    $(".price_list").addClass('hide');
                                    $(".total_price").addClass('hide');
                                   // $("#dis_channel_id").val('');
                                   // $("#dis_channel_id").focus();
                                }
                                else
                                {
                                    $(".price_list").removeClass('hide');
                                    //console.log(_return);
                                    $('#price').val(_return['price']); 

                                    $(".total_price").removeClass('hide');
                                    //console.log(_return);
                                    $('#total_price').val(_return['total_price']); 

                                }

                            }
                        });  
               /*  } */ 

            });



            //Category Change To show Price
          /*   $("#dis_channel_id").change(function()
                {
                    if($("#category_id").val() == "")
                    {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Error!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please select Category.',
                            class_name: 'gritter-success  gritter-light'
                        });
                        $("#dis_channel_id").val('');		
                        $("#category_id").focus();		
                    }
                    else if($("#dis_channel_id").val() == "")
                    {
                        $("#dis_channel_id").val('');
                    }
                    else
                    {
                        var json = {};
                        json['category_id'] = $("#category_id").val();
                        json['dis_channel_id'] = $("#dis_channel_id").val();
                        json['noc'] = $("#noc").val();
                        var request = $.ajax({
                            url: "<?php echo base_url('Form/get_category_channel_list'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",

                            success : function(_return)
                            {
                                if(_return['total'] == 1)
                                {
                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Price Not Exists!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Price Not Exists.',
                                        class_name: 'gritter-success  gritter-light'
                                    });
                                    $(".price_list").addClass('hide');
                                    $(".total_price").addClass('hide');
                                    $("#dis_channel_id").val('');
                                    $("#dis_channel_id").focus();
                                }
                                else
                                {
                                    $(".price_list").removeClass('hide');
                                    //console.log(_return);
                                    $('#price').val(_return['price']); 

                                    $(".total_price").removeClass('hide');
                                    //console.log(_return);
                                    $('#total_price').val(_return['total_price']); 

                                }

                            }
                        });  
                    }

            });
 */

            //No of Copy Change To show Price
            $("#noc").keyup(function()
            {
                    if($("#noc").val() == 0)
                    {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Error!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please enter more than 1 copy.',
                            class_name: 'gritter-success  gritter-light'
                        }); 
                        $(".price_list").addClass('hide');
                        $(".total_price").addClass('hide');		
                        $("#noc").val('');		
                        $("#noc").focus();	


                    }
					else if($("#noc").val() > 500)
                    {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Error!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please enter less than 500 copy.',
                            class_name: 'gritter-success  gritter-light'
                        }); 
                        $(".price_list").addClass('hide');
                        $(".total_price").addClass('hide');		
                        $("#noc").val('');		
                        $("#noc").focus();	


                    } 
                    else 
                       // if($("#dis_channel_id").val() != "")
                        {
                            /* /*  $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Error!',
                            // (string | mandatory) the text inside the notification
                            text: 'Please select Category.',
                            class_name: 'gritter-success  gritter-light'
                            }); 
                            $("#category_id").val('');		
                            $("#dis_channel_id").focus();		
                            }
                            else
                            {  */
                            var json = {};
                            json['category_id'] = $("#category_id").val();
                            json['dis_channel_id'] = $("#dis_channel_id").val();
                            json['noc'] = $("#noc").val();
                            var request = $.ajax({
                                url: "<?php echo base_url('Form/get_category_channel_list'); ?>",
                                type: "POST",
                                data: json,
                                dataType: "json",

                                success : function(_return)
                                {
                                    if(_return['total'] == 1)
                                    {
                                        $.gritter.add({
                                            // (string | mandatory) the heading of the notification
                                            title: 'Price Not Exists!',
                                            // (string | mandatory) the text inside the notification
                                            text: 'Price Not Exists.',
                                            class_name: 'gritter-success  gritter-light'
                                        });
                                        $(".price_list").addClass('hide');
                                        $(".total_price").addClass('hide');
                                        //$("#dis_channel_id").val('');
                                       // $("#dis_channel_id").focus();
                                    }
                                    else
                                    {
                                        $(".price_list").removeClass('hide');
                                        //console.log(_return);
                                        $('#price').val(_return['price']); 

                                        $(".total_price").removeClass('hide');
                                        //console.log(_return);
                                        $('#total_price').val(_return['total_price']); 

                                    }

                                }
                            });  
                        } 

            });


			//Show and Hide Slip Input Box
			$('input[type="checkbox"]').click(function() 
			{
				if($("#payment_receiving").prop('checked') == true)
				{
					$('.total_slip').removeClass('hide');	
					$('#slip_no').val('');
				}
				else if($("#payment_receiving").prop('checked') == false)
				{
					$('.total_slip').addClass('hide');
					$('#slip_no').val('');
				}
			});



            //Form Validation Product
            $('.form-validate-product').validate(
                {

                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules:
                    {
                        //Personal Info
                      //  product_img: {	required: true ,  accept: "gif|png|jpg|jpeg"  },
                    //    mproduct_img: {	required: true ,  accept: "gif|png|jpg|jpeg" },
                        qty: {    required: true , number: true },
                        price: {	required: true, number: true	},
                        dis_price: {	 number: true	}

                    },

                    messages: {
                        //name_fname: " Please enter name father name",
                   //     product_img: { accept:" Only jpeg, jpg or png or gif images allow"},
                    //    mproduct_img:{ accept: " Only jpeg, jpg or png or gif images allow"},
                        date_dob: " Please select date of birth",
                        date_ce: " Please select ce date",
                        date_start: " Please select start date"

                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.add_new_ajeer')).show();
                    },

                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                        $(e).remove();
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    },

                });

            jQuery("input[type=file]").each(function() {
                jQuery(this).rules("add", {
                    accept: "png|jpe?g|jpg|gif",
                    messages: {
                        accept: "Only jpeg, jpg or png or gif images allow"
                    }
                });
            });

            //Form Validation Customer
            $('.form-validate-customer').validate({

                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    username: {
                        required: true
                    },

                    password: {
                        required: true,
                        minlength: 5
                    },
                    mobile_no: {
                        required: true,
                        number: true
                    }, 
                    retypepassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },

                },

                messages: {

                    password: {
                        required: " Please specify a password.",
                        minlength: "    Please specify a secure password."
                    },
                    subscription: " Please choose at least one option",
                    gender: "   Please choose gender",
                    agree: "    Please accept our policy"
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.form-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });



            //Form Validation Inventory
            $('.form-validate-inventory').validate(
                {

                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: 
                    {
                        //Personal Info
                        product_id: {	required: true  },
                        qty: {    required: true , number: true, 
                            /*min : 5 , max: 10 */
                        },
                        location_id: {	required: true	},

                    },

                    messages: {
                        //name_fname: " Please enter name father name",
                        date_dob: " Please select date of birth",
                        date_ce: " Please select ce date",
                        date_start: " Please select start date"

                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.add_new_ajeer')).show();
                    },

                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                        $(e).remove();
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    }, 

            }); 


			//Form Validation Recent SMS
            $('.form-validate-recent-sms').validate(
                {

                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: 
                    {
                        //Personal Info
                        sms_type: {	required: true  },
                     
                    },

                    messages: {
                        //name_fname: " Please enter name father name",
                       // date_dob: " Please select date of birth",
                       // date_ce: " Please select ce date",
                       // date_start: " Please select start date"

                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.add_new_ajeer')).show();
                    },

                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                        $(e).remove();
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    }, 

            }); 


            //Customer Search Button Click
            $('.search_payment_customer').click(function()
                {
                    var search_payment_input     = $('#search_payment_input').val();  
                    var json             = {};
                    if($('#search_payment_input').val() == "")
                    {
                        $('#search_payment_input').focus(); 
                    }
                    else
                    {
                        json['search_payment_input']   = search_payment_input;
                        var request = $.ajax(
                            {
                                url: "<?php echo base_url('Form/payment_receiving_search'); ?>",
                                type: "POST",
                                data: json,
                                dataType: "html",
                                beforeSend : function()
                                {
                                    $('.icon-spinner').removeClass('hide');   
                                },
                                success : function(_return)
                                {
                                    //console.log(_return);
                                    $('.payment_result').html(_return); 
                                },
                                complete: function ()
                                {
                                    $('.icon-spinner').addClass('hide');      
                                }
                        }); 
                    }                         
            });
			
			
			//Recent SMS Search Button Click
            $('.search_recent_sms_customer').click(function()
            {
                    var search_sms_input     = $('#search_sms_input').val();  
                    var json             = {};
                    if($('#search_sms_input').val() == "")
                    {
                        $('#search_sms_input').focus(); 
                    }
                    else
                    {
                        json['search_sms_input']   = search_sms_input;
                        var request = $.ajax(
                            {
                                url: "<?php echo base_url('Form/recent_sms_search'); ?>",
                                type: "POST",
                                data: json,
                                dataType: "html",
                                beforeSend : function()
                                {
                                    $('.icon-spinner').removeClass('hide');   
                                },
                                success : function(_return)
                                {
                                    //console.log(_return);
                                    $('.sms_result').html(_return); 
                                },
                                complete: function ()
                                {
                                    $('.icon-spinner').addClass('hide');      
                                }
                        }); 
                    }                         
            });
			
			


            //Payment Search Input
            $('#search_payment_input').keypress(function(event)
                {
                    if(event.keyCode == 13)
                    {
                        $('.search_payment_customer').click();
                        event.preventDefault();
                        return false;
                    }
            }); 

			//Recent SMS Search Input
            $('#search_sms_input').keypress(function(event)
                {
                    if(event.keyCode == 13)
                    {
                        $('.search_recent_sms_customer').click();
                        event.preventDefault();
                        return false;
                    }
            }); 

            
			setTimeout(function(){
                $('.alert-success').remove();
                }, 2000);  
            setTimeout(function(){
                $('.alert-danger').remove();
                }, 2000);


            $('.form-validate').validate({

                errorElement: 'div',
                errorClass  : 'help-block',
                focusInvalid: false,
                rules: {},

                messages: {
                    email: {
                        required    : " Please provide a valid email.",
                        email       : " Please provide a valid email."
                    },
                    password        : {
                        required    : " Please specify a password.",
                        minlength   : " Please specify a secure password."
                    },
                    subscription    : " Please choose at least one option",
                    gender          : " Please choose gender",
                    agree           : " Please accept our policy"
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.form-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });      
            $('.form-validate-distribution').validate({

                errorElement: 'div',
                errorClass  : 'help-block',
                focusInvalid: false,
                rules: {},

                messages: {
                    email: {
                        required    : " Please provide a valid email.",
                        email       : " Please provide a valid email."
                    },
                    password        : {
                        required    : " Please specify a password.",
                        minlength   : " Please specify a secure password."
                    },
                    subscription    : " Please choose at least one option",
                    gender          : " Please choose gender",
                    agree           : " Please accept our policy"
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.form-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });

            $(".form-validate-distribution").on('submit', function(e){


                var balance_qty = $("#balance_qty").val();
                var remaing_qty = parseInt($("#remaning_qty").val());
                var selected_qty = parseInt($("#selected_qty").val());
                //                       alert(balance_qty);
                if(selected_qty > balance_qty)
                {  
                    e.preventDefault();
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Balance Required!',
                        // (string | mandatory) the text inside the notification
                        text: 'Balance Required for Transaction',
                        class_name: 'gritter-danger  gritter-light'
                    });   
                }


            });

            $('.required-field').each(function(){
                $(this).rules('add', {

                    required: true,
                    messages:   {
                        required: $(this).attr('placeholder')+' field is requird !'
                    }

                });
            });

            //Check Cnic Exit
            //Check cnic exit
            $('.check_cnic_exists').blur(function()
                {
                    var search_input     = $(this).val();
                    var search_length    = search_input.length;   
                    var json             = {};
                    if(search_length != 13 )
                    {
                        $(this).val('');
                        //$(this).focus();
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Invalid CNIC Format!',
                            // (string | mandatory) the text inside the notification
                            text: search_input+' this CNIC Format is not valid ',
                            class_name: 'gritter-danger  gritter-light'
                        });   
                    }
                    else
                    {   
                        json['search_input']   = search_input;
                        json['searchType'] = 2;
                        var request = $.ajax({
                            url: "<?php echo base_url('Ajeer/search_ajeer'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",
                            beforeSend : function()
                            {
                                $('.icon-spinner').removeClass('hide');   
                            }
                            ,
                            success : function(_return)
                            {
                                var details = _return['person_information'];     
                                if(details.cnic == search_input)
                                {
                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Alreay Exists!',
                                        // (string | mandatory) the text inside the notification
                                        text: details.cnic+' this CNIC Already Exists with Cardno '+details.id,
                                        class_name: 'gritter-danger  gritter-light'
                                    });
                                    $('.cnic').val(''); 


                                }else
                                {

                                }

                            },
                            complete: function ()
                            {
                                $('.icon-spinner').addClass('hide');      
                            }
                        });
                    }  
            });       

            function change_country_list(country_id,state_id)
            {
                var json             = {};

                json['country_id']   = country_id;

                //json['country_id']   = country_id;

                var request = $.ajax({
                    url: "<?php echo base_url('Ajeer/state_list_by_countryid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",
                    beforeSend : function()
                    {
                        $('.icon-spinner').removeClass('hide');
                    }
                    ,
                    success : function(_return)
                    {
                        // console.log(_return);
                        $('.state_id').html(_return);
                        $('#state_id').val(state_id);
                        //$('#country_id').val(details.country_id);
                        //$("#state_id").trigger("chosen:updated");


                    },
                    complete: function ()
                    {
                        $('.icon-spinner').addClass('hide');
                    }
                });
            }

            function change_state_list(country_id,state_id,city_id)
            {
                var json             = {};
                //console.log($('#country_id').val());
                //console.log($('#city_hidden').val());

                json['country_id']   = country_id;

                json['state_id']   = state_id;

                var request = $.ajax({
                    url: "<?php echo base_url('Ajeer/city_list_by_countryid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",
                    beforeSend : function()
                    {
                        $('.icon-spinner').removeClass('hide');
                    }
                    ,
                    success : function(_return)
                    {
                        //console.log($('#country_id').val());
                        //console.log($('#city_id').val());
                        //console.log(_return);
                        $('.city_id').html(_return);
                        $('#city_id').val(city_id);
                        //$("#city_id").trigger("chosen:updated");
                        //$('#district_id').html(_return);
                        // $('#district_id').val(district_list);

                    },
                    complete: function ()
                    {
                        $('.icon-spinner').addClass('hide');
                    }
                });
            }


            function change_kabina_list(kabinat_id,kabina_list)
            {
                var json             = {};

                json['kabinat_id']   = kabinat_id;

                //json['country_id']   = country_id;

                var request = $.ajax({
                    url: "<?php echo base_url('Ajeer/kabina_list_by_kabinatid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",
                    beforeSend : function()
                    {
                        $('.icon-spinner').removeClass('hide');
                    }
                    ,
                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.kabina_id').html(_return);
                        $('#kabina_id').val(kabina_list);
                        //$('#country_id').val(details.country_id);
                        // $("#kabina_id").trigger("chosen:updated");


                    },
                    complete: function ()
                    {
                        $('.icon-spinner').addClass('hide');
                    }
                });
            }


    });

    function imageIsLoaded(e)
    {

        $('#result_pic').removeClass('hide');
        $('#image_status').val(0);
        $('#upload_img').removeClass('hide');
        $('#myImg').attr('src', e.target.result);

    };

    //Image Cancel preview
    function cancel_preview_image()
    {
        $("#image_status").val(1);
        $('#upload_img').addClass('hide');
        $('#result_pic').addClass('hide');
    }


</script>