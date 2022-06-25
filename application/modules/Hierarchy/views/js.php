<script type="text/javascript">
    jQuery(function($) {
        var sor_count = $('#column_count').val();  
        var sorting_arr = [];
        for(var sort = 0; sort <= sor_count; sort++)
        { 
            sorting_arr = {'bSortable':true}; 
        } 
        console.log(sorting_arr);

        var oTable1 = $('#sample-table-2').dataTable( {
            "aoColumns": sorting_arr } );

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
        $('.unique_exception').blur(function(){

            var _value       =  $(this).val();
            var _column      =  $(this).attr('id');
            var _ref_attr    =  $(this).attr('ref-attr');
            var _ref_attr_segemt    =  $(this).attr('ref_attr_segemt');

            var _error_label =  $(this).attr('placeholder');
            var json = {};

            json['input']              = _value;
            json['column']             = _column;
            json['ref']                = _ref_attr;
            json['ref_attr_segemt']    = _ref_attr_segemt;

            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/hierarchy_unique_exception'); ?>",
                type: "POST",
                data: json,
                dataType: "json",

                success : function(_return)
                {
                    if(_return['return'] > 0)
                    {
                        $('#'+_column).val('');
                        $('#'+_column).focus();
                        var change_label = $(this).attr('placeholder');
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Already Exists!',
                            // (string | mandatory) the text inside the notification
                            text: _error_label+' Already Exists.',
                            class_name: 'gritter-success  gritter-light'
                        });

                    }else
                    {
                        return false;
                    } 
                    console.log(_return);
                }
            });  

        });
        $(".status").change(function(){
            var _status = $(this).val();
            var ref     = $(this).attr('ref'); 
            var table   = $(this).attr('table'); 
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
                json['table']    = table;
                var request = $.ajax({
                    url: "<?php echo base_url('Hierarchy/change_user_status_h'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "json",

                    success : function(_return)
                    {
                        if(_return['_return'] > 0)
                        {
                            var change_status_label = '';  
                            switch(table) {

                                case 'city_list': change_status_label = 'City'; break;
                                case 'country_list': change_status_label = 'Country'; break;
                                case 'profession_list':  change_status_label = 'Profession';  break;
                                case 'islamic_qualification_list': change_status_label = 'Islamic Qualification';  break;
                                case 'secular_qualification_list': change_status_label = 'Secular Qualification';  break;
                                case 'organizational_responsibility_list': change_status_label = 'Organizational Responsibility';  break;
                                case 'token_halqa': change_status_label = 'Token Halqa';  break;

                                default: change_status_label = '';
                            }



                            $.gritter.add({
                                // (string | mandatory) the heading of the notification
                                title: 'Status Changed!',
                                // (string | mandatory) the text inside the notification
                                text: change_status_label+' Status Changed Successfully.',
                                class_name: 'gritter-success  gritter-light'
                            });

                            return false;

                        }   
                    }
                });
            } 
        });


        //Madani Year Status Change
        $(".status_year").change(function()
            {
                if($(this).val() == 0)
                { 
                    var status_name = "Active";
                }
                else
                {
                    var status_name = "Unactive";						
                }


                var optsel = window.confirm("Do you want to "+status_name+" Status?");
                if (optsel == true)
                {
                    var _status = $(this).val();
                    var ref     = $(this).attr('ref'); 
                    var table   = $(this).attr('table'); 

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
                            url: "<?php echo base_url('Hierarchy/change_status_year_month'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",

                            success : function(_return)
                            {
                                if(_return['_return'] > 0)
                                {
                                    document.location.reload(true);
                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Madani Year Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });

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

        //Madani Month Status Change
        $(".status_month").change(function(){
            if($(this).val() == 0)
            { 
                var status_name = "Active";
            }
            else
            {
                var status_name = "Unactive";						
            }


            var optsel = window.confirm("Do you want to "+status_name+" Status?");
            if (optsel == true)
            {
                var _status = $(this).val();
                var ref     = $(this).attr('ref'); 
                var table   = $(this).attr('table'); 

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
                        url: "<?php echo base_url('Hierarchy/change_status_year_month'); ?>",
                        type: "POST",
                        data: json,
                        dataType: "json",

                        success : function(_return)
                        {
                            if(_return['_return'] > 0)
                            {
                                document.location.reload(true);
                                $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Status Changed!',
                                    // (string | mandatory) the text inside the notification
                                    text: 'Madani Month Status Changed Successfully.',
                                    class_name: 'gritter-success  gritter-light'
                                });
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


		
		  //Status Change Logo Image
        $(".status_logo").change(function()
        {
            var _status = $(this).val();
            var ref     = $(this).attr('ref'); 
            var table   = $(this).attr('table'); 
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
                            url: "<?php echo base_url('Hierarchy/change_status_logo_image'); ?>",
                            type: "POST",
                            data: json,
                            dataType: "json",
                            success : function(_return)
                            {
                                if(_return['_return'] > 0)
                                {
                                    //document.location.reload(true);
                                    $.gritter.add({
                                        // (string | mandatory) the heading of the notification
                                        title: 'Status Changed!',
                                        // (string | mandatory) the text inside the notification
                                        text: 'Logo Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });
                                    return false;
                                }
                            }
                        });
                    }                 
        });

		
		  //Status Change Logo Title
        $(".status_title").change(function()
        {
            var _status = $(this).val();
            var ref     = $(this).attr('ref'); 
            var table   = $(this).attr('table'); 
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
                            url: "<?php echo base_url('Hierarchy/change_status_logo_title'); ?>",
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
                                        text: 'Logo Title Status Changed Successfully.',
                                        class_name: 'gritter-success  gritter-light'
                                    });
                                    return false;
                                }
                            }
                        });
                    }                 
        });

     
	 
	 
        //Upload Pic token Purpose
        $("#upload_pic_token").click(function() 
            {
                $("input[id='token_file']").click();
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
        $("#token_file").change(function () 
            {
                if (this.files && this.files[0]) 
                {

                    var ext = $('#token_file').val().split('.').pop().toLowerCase();
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



        $(".city_get").change(function(){

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
                    $('.city_id').html(_return); 
                }
            });  

        });


        //City Get
        $(".branch_get").change(function(){

            var json = {};
            json['country_id'] = $("#country_id").val();
            json['city_id'] = $(this).val();

            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_branch_city_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.branch_id').html(_return); 
                }
            });  

        });



        //Get Token Sub Purpose Name
        $(".course_get").change(function()
            {

                var json = {};
                json['token_purpose_id'] = $(this).val();
                var request = $.ajax({
                    url: "<?php echo base_url('Hierarchy/get_subcourse_byid'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",

                    success : function(_return)
                    {
                        //console.log(_return);
                        $('.token_purpose_course_id').html(_return); 
                    }
                });  

        });

        $(".country_dd").change(function(){

            var json = {};
            json['country_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_kabinat_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    $('.kabinat_list').html(_return); 
                }
            });  

        });

        // Faizan work

        $(".country_ddd").change(function(){

            var json = {};
            json['country_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_city_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    $('.city_list').html(_return);
                }
            });

        });


        $(".kabinat_list").change(function(){

            var json = {};
            json['kabinat_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_kabina_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    $('.kabina_list').html(_return); 
                }
            });  

        });  
        $(".kabina_list").change(function(){

            var json = {};
            json['kabina_id'] = $(this).val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_division_byid'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    $('.division_list').html(_return); 
                }
            });  

        });                  

        //Filter State Change 
        $(".filter_city").click(function(){

            var json = {};
            json['country_id'] = $("#country_id").val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_state_by_country'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    console.log(_return);
                    $('.filter_result').html(_return); 
                    // $(".location_change").change();
                }
            });  

        }); 

        //Filter City Change 
        $(".filter_branch").click(function(){

            var json = {};
            json['country_id'] = $("#country_id").val();
            json['city_id'] = $("#city_id").val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_branch_by_country'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.filter_result').html(_return); 
                    // $(".location_change").change();
                }
            });  

        }); 
		
		
		   //Filter Project Change 
        $(".filter_project").click(function(){

            var json = {};
            json['country_id'] = $("#country_id").val();
            json['city_id'] = $("#city_id").val();
            json['branch_id'] = $("#branch_id").val();
            var request = $.ajax({
                url: "<?php echo base_url('Hierarchy/get_project_by_countrycitybracnh'); ?>",
                type: "POST",
                data: json,
                dataType: "html",

                success : function(_return)
                {
                    //console.log(_return);
                    $('.filter_result').html(_return); 
                    // $(".location_change").change();
                }
            });  

        }); 
		
		



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
       $('.required-field').each(function(){
            $(this).rules('add', {

                required: true,
                messages:   {
                    required: $(this).attr('placeholder')+' field is requird !'
                }

            });
        }); 

        // if(!$('.form-validate').valid()){
        //                 return 'error';
        //               }
        // Direct change value in data base on for changing status
        setTimeout(function(){
            $('.alert-success').remove();
            }, 2000);  
        setTimeout(function(){
            $('.alert-danger').remove();
            }, 2000);
    });

    function imageIsLoaded(e) 
    {

        $('#result_pic').removeClass('hide');
        $('#upload_img').removeClass('hide');
        $('#myImg').attr('src', e.target.result);

    }; 

    //Image Cancel preview
    function cancel_preview_image() 
    {
        $('#upload_img').addClass('hide');
        $('#result_pic').addClass('hide');
    }

    //Change Status
    function ChangeStatus()
    {
        var optsel = window.confirm("Do you want to close window?");
        if (optsel == true)
        {
            alert("You clicked OK!");
            var _status = $(this).val();
            var ref     = $(this).attr('ref'); 
            var table   = $(this).attr('table'); 
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
            console.log(status_new);

        }
        else
        {
            var _status = $(this).val();
            console.log(status_new);
            alert("You clicked Cancel!");
        }   
    }

</script>