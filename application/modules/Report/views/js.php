<?php
$script_check =   $this->uri->segment(2);
?>
<script type="text/javascript">
    jQuery(function($) 
        {
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
                    url: "<?php echo base_url('Report/get_balance_by_product'); ?>",
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
                    url: "<?php echo base_url('Report/get_customer_by_distribution'); ?>",
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
                    url: "<?php echo base_url('Report/get_customer_mailing_list'); ?>",
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
                    url: "<?php echo base_url('Report/get_customer_dispatch_list'); ?>",
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
                    url: "<?php echo base_url('Report/get_customer_list'); ?>",
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
                    url: "<?php echo base_url('Report/check_user_exists'); ?>",
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
                    url: "<?php echo base_url('Report/check_email_exists'); ?>",
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
                    url: "<?php echo base_url('Report/check_phone_exists'); ?>",
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
                            url: "<?php echo base_url('Report/get_category_channel_list'); ?>",
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
                            url: "<?php echo base_url('Report/get_category_channel_list'); ?>",
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
                                url: "<?php echo base_url('Report/get_category_channel_list'); ?>",
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

			$("#date_from").change(function()
			{
				if($("#date_column_entry").prop('checked') == false && $("#date_column_payment").prop('checked') == false)
                {
                    $.gritter.add(
					{
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please select date.',
                        class_name: 'gritter-success  gritter-light'
                    });
                    $("#date_from").val('');
                    $("#date_column_entry").focus();
                }
				/* else if()
                {
                    $.gritter.add(
					{
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please select date.',
                        class_name: 'gritter-success  gritter-light'
                    });
                    $("#date_from").val('');
                    $("#date_column_payment").focus();
                } */
			});
			
			$("#date_to").change(function()
			{
				var date_from =  $("#date_from").val();
				var date_to =  $("#date_to").val();
				if(date_to < date_from )
                {
                    $.gritter.add(
					{
                        // (string | mandatory) the heading of the notification
                        title: 'Error!',
                        // (string | mandatory) the text inside the notification
                        text: 'Please enter greater than from date.',
                        class_name: 'gritter-success  gritter-light'
                    });
                    $("#date_to").val('');
                    $("#date_to").focus();
                }
			});
			
			

			//Report Validation Customer
			$('.form-validate-customer-report').validate(
			{

                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                   /*  generate_column: {
                        required: true
                    } */
                },

                messages: 
				{   
                },
                invalidHandler: function (event, validator) { //display error alert on Report submit
                    $('.alert-danger', $('.Report-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });


			
			
            //Report Validation Customer
            $('.Report-validate-customer').validate({

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
                invalidHandler: function (event, validator) { //display error alert on Report submit
                    $('.alert-danger', $('.Report-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });



            //Report Validation Inventory
            $('.Report-validate-inventory').validate(
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
                    invalidHandler: function (event, validator) { //display error alert on Report submit
                        $('.alert-danger', $('.add_new_ajeer')).show();
                    },

                    highlight: function (e) {
                        $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                        $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
                        $(e).remove();
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    }, 

            }); 


			//Report Validation Recent SMS
            $('.Report-validate-recent-sms').validate(
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
                    invalidHandler: function (event, validator) { //display error alert on Report submit
                        $('.alert-danger', $('.add_new_ajeer')).show();
                    },

                    highlight: function (e) {
                        $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                        $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
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
                                url: "<?php echo base_url('Report/payment_receiving_search'); ?>",
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
                                url: "<?php echo base_url('Report/recent_sms_search'); ?>",
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


            $('.Report-validate').validate({

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
                invalidHandler: function (event, validator) { //display error alert on Report submit
                    $('.alert-danger', $('.Report-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });      
            $('.Report-validate-distribution').validate({

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
                invalidHandler: function (event, validator) { //display error alert on Report submit
                    $('.alert-danger', $('.Report-validate')).show();
                },

                highlight: function (e) {
                    $(e).closest('.Report-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.Report-group').removeClass('has-error').addClass('has-info');
                    $(e).remove();
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },

            });

            $(".Report-validate-distribution").on('submit', function(e){


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
</script>