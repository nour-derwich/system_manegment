<script type="text/javascript">
    jQuery(function($) {
        $('.submit_form').click(function(){
            $('#register-form').submit();
        });
        $('.division_checkbox').click(function(){

            var kabinat_id = $(this).attr('kabinat_ref');
            var kabina_id = $(this).attr('kabina_ref');
            if($(this).prop('checked') == true)
            {
                $(this).prop('checked',true);   
                $('.kabinat_id_'+kabinat_id).prop('checked',true);   
                $('.kabina_id_'+kabina_id).prop('checked',true);   

            }else
            {      
                var count_kabina_check = 0;
                $('.ace-checkbox-2').each(function(){
                    if($(this).attr('kabina_ref') == kabina_id)
                    {
                        count_kabina_check++;    
                    }
                });
                if(count_kabina_check > 0)
                {
                    $('.kabina_id_'+kabina_id).prop('checked',false);    
                }   
            } 

        });

        var oTable1 = $('#account_list').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,null,null,null,
                { "bSortable": false }
            ] } );
        var oTable1 = $('#seller_account_list').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,null,null,null,null,null,
                { "bSortable": false }
            ] } );

        var oTable1 = $('#cart_list_table').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,null,null,null,
                { "bSortable": false }
            ] } );
        var oTable1 = $('#order_list_table').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,null,null,null,
                { "bSortable": false }
            ] } );
			
			var oTable1 = $('#payment_list_table').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,
                { "bSortable": false }
            ] } );
        var oTable1 = $('#product-table').dataTable(
            {
                "aoColumns":
                    [
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": true },
                        { "bSortable": false }
                    ]
            });
        var oTable1 = $('#sample-table-2').dataTable( {
            "aoColumns": [
                { "bSortable": true },
                null,null,null,
                { "bSortable": false }
        ] } );

        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }

        //User Status Change
        $(".status_user").change(function(){
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
                json['table']   = 'user_list';
                var request = $.ajax({
                    url: "<?php echo base_url('Account/change_user_status'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        //console.log(_return);

                        if(_return['_return'] > 0)
                        {

                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Status Changed!',
                                // (string | mandatory) the text inside the notification
                                text: 'User Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }
                    }
                });
            }
        });

        //User Status Change
        $(".status_seller").change(function(){
            if($(this).val() == 0)
            {
                var status_name = "Active";
            }
            else
            {
                var status_name = "Unactive";
            }


            var optsel = window.confirm("Do you want to "+status_name+" Seller Account?");
            if (optsel == true)
            {
                var _status = $(this).val();
                var ref     = $(this).attr('ref');
                var table   = 'seller_list';

                if(_status == 0)
                {
                    $(this).val(1);
                    var status_new = 1;
                    $(this).prop('checked',true);
                    var status_name = "Unactive";
                }
                else if(_status == 1)
                {
                    $(this).val(0);
                    var status_new = 0;
                    $(this).prop('checked',false);
                    var status_name = "Active";
                }
                //alert("You clicked OK!");
                //console.log(status_new);
                if(ref != null)
                {
                    var json = {};

                    json['id']       = ref;
                    json['status']   = status_new;
                    json['table']    = table;
                    var request = $.ajax({
                        url: "<?php echo base_url('Account/change_seller_status'); ?>",
                        type: "POST",
                        data: json,
                        dataType: "json",

                        success : function(_return)
                        {

                            if(_return['_return'] > 0)
                            {
                               // document.location.reload(true);
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Status Changed!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Seller Account Status Changed Successfully.',
                                    class_name: 'gritter-success  gritter-light'
                                });
                                document.location.reload(true);
                                return false;

                            }





                        }
                    });
                }





            }
            else
            {
                if($(this).val() == 0)
                {
                    $(this).prop('checked',false);
                }
                else
                {
                    $(this).prop('checked',true);
                }
            }


        });

//Admin Change Product Status Seller
        $(".product_status").change(function(){
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
                    url: "<?php echo base_url('Product/change_product_status'); ?>",
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
                                text: 'Product Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }
                    }
                });
            }
        });


        $(".status").change(function(){
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
                    url: "<?php echo base_url('Users/change_user_status'); ?>",
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
                                text: 'User Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }   
                    }
                });
            } 
        });


        $(".is_print").change(function(){
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
                    url: "<?php echo base_url('Users/change_user_is_print'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {

                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Is print Status Changed!',
                                // (string | mandatory) the text inside the notification
                                text: 'Is print Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }   
                    }
                });
            } 
        });



        $("#changepassword").change(function(){
            var change_status = $(this).val();

            if(change_status == 0)
            {
                $('input[type="password"]').prop('disabled',false); 
                $(this).val(1);
            }else
            {
                $('input[type="password"]').prop('disabled',true); 
                $(this).val(0);   
            }
        });


        $('#username').blur(function(){
            var json = {};
            json['username'] = $('#username').val();
            json['id']       = $('#id').val();
            var request = $.ajax({
                url: "<?php echo base_url('Users/check_user_exists'); ?>",
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


        $('.form-validate-order').validate({

            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:
            {
                order_status: {
                    required: true
                },
                order_message: {
                    required: true
                }
            },
            messages: {
                order_status: " Please choose at least one option",
                order_message: "   Please type order message"
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
        // Direct change value in data base on for changing status


        $('.form-validate').validate({

            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                user_type_id: {
                    required: true
                },
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email:true
                },
                contact: {
                    required: true
                },
                address: {
                    required: true
                },

            },

            messages: {
                email: {
                    required: " Please provide a valid email.",
                    email: "    Please provide a valid email."
                },               
                user_type_id: " Please choose at least one option",
                name: "   Please enter name",
                contact: "    Please enter contact",
                address: "    Please enter address"
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
        // Direct change value in data base on for changing status
        setTimeout(function(){
            $('.alert-success').remove();
            }, 2000);  
        setTimeout(function(){
            $('.alert-danger').remove();
            }, 2000);
    });


</script>