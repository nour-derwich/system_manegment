<!-- Header -->
<!-- Header -->
<?php require "template/header.php";

$state_dd  = $this->Mdl_frontend->state_list(166);

?>
<style>
    .form-group1
    {
        margin:0px 0px 15px 0px !important;
    }
    .help-block
    {
        color:#a94442 !important;
    }
</style>


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->

        <header class="page-header">
            <h1 class="page-title">My Account</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active">My Account</li>
            </ol>

        </header>

        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
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

                <h1 class="title">My Account</h1>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed" href="#accordion-1" aria-expanded="false">Personal Information</a></h4>
                        </div>
                        <div id="accordion-1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body ">
                                <form class="form-horizontal" id="form-validate-personal" action="<?php echo base_url(); ?>personal_information_submit.html" method="post">
                                <fieldset id="account" class="col-sm-9">
                                    <input type="hidden" name="user_id" value="<?php echo $user_info[0]->id; ?>" />
                                    <input type="hidden" name="old_password" value="<?php echo $user_info[0]->password; ?>" />
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-firstname" class="control-label">First Name</label>
                                        <input type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $user_info[0]->firstname; ?>" name="firstname">
                                        <input type="hidden" class="form-control" id="user_type" placeholder="" value="guest" name="user_type">
                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-lastname" class="control-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $user_info[0]->lastname; ?>" name="lastname">
                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-telephone" class="control-label">Telephone</label>
                                        <input type="text" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo $user_info[0]->telephone; ?>" name="telephone">
                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-lastname" class="control-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Please Select</option>
                                            <option value="male" <?php if($user_info[0]->gender == 'male'){ echo "selected"; } ?>> Male</option>
                                            <option value="female" <?php if($user_info[0]->gender == 'female'){ echo "selected";} ?>> Female</option>
                                        </select>
                                    </div>
                                   <div class="form-group1 form-group">
                                            <label for="input-payment-email" class="control-label">Birthday</label>
                                            <div class="">
                                                <input type="text" class="form-control date-picker" id="date_of_birth" placeholder="Birthday" value="<?php if($user_info[0]->dob != ""){ echo $user_info[0]->dob; }?>" name="date_of_birth">
                                           </div>
                                   </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-email" class="control-label">E-Mail</label>
                                        <div class="email_register">
                                            <input type="email" class="form-control"  <?php if($this->session->userdata('user_type')=='user'){ echo "disabled"; }else{ echo 'id="email_checkout"'; } ?> placeholder="E-Mail" value="<?php echo $user_info[0]->email; ?>" name="email_checkout">
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="checkbox" value="change" name="change_password_radio" id="change_password_radio" class="rbtn_account">
                                            Change Password</label>
                                    </div>
                                    <div class="change_password_div hide">
                                        <div class="form-group1 form-group required">
                                            <label for="input-payment-fax" class="control-label">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" value="" name="password">
                                        </div>
                                        <div class="form-group1 form-group required">
                                            <label for="input-payment-fax" class="control-label">Password Confirm</label>
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Password Confirm" value="" name="confirm_password">

                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <div class="pull-right ">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                    </form>
                                </fieldset>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed" href="#accordion-2" aria-expanded="false">Address Information</a></h4>
                        </div>
                        <div id="accordion-2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <form class="form-horizontal" id="form-validate-address" action="<?php echo base_url(); ?>address_information_submit.html" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_info[0]->id; ?>" />
                                <fieldset id="address" class="col-sm-9">
                                    <div class="form-group1 form-group">
                                        <label for="input-payment-company" class="control-label">Company</label>
                                        <input type="text" class="form-control" id="company" placeholder="Company" value="<?php echo $user_info[0]->company; ?>" name="company">
                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-address-1" class="control-label">Address 1</label>
                                        <textarea rows="4" class="form-control" id="address_1" placeholder="Address 1" name="address_1"><?php echo $user_info[0]->address; ?></textarea>
                                    </div>
                                    <!--<div class="form-group1 form-group">
    <label for="input-payment-address-2" class="control-label">Address 2</label>
	<textarea rows="4" class="form-control" id="address_2"  placeholder="Address 2" name="address_2" ><?php //echo $user_info[0]->address_2; ?></textarea>
</div>-->


                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-zone" class="control-label">Region / State</label>
                                        <?php
                                        echo form_dropdown
                                        (
                                            'state_id',
                                            $state_dd,$user_info[0]->state_id,
                                            'class	= "form-control city_get"
			id     	= "state_id" placeholder="State"');
                                        ?>
                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-city" class="control-label">City</label>
                                        <select name="city_id" id="city_id" placeholder="City"   class="form-control city_id" >3
                                            <?php
                                            if($this->session->userdata('user_type')=='user')
                                            {
                                                if($user_info[0]->city_id >0 )
                                                {
                                                    echo '<option value='.$user_info[0]->city_id.'>'.$city_name.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group1 form-group required">
                                        <label for="input-payment-postcode" class="control-label">Postal Code</label>
                                        <input type="text" class="form-control" id="postal_code" placeholder="Postal Code" value="<?php echo $user_info[0]->postal_code; ?>" name="postal_code">
                                    </div>

                                    <div class="buttons">
                                        <div class="pull-right ">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                </fieldset>
                                    </form>


                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed" href="#accordion-4" aria-expanded="false">My Orders</a></h4>
                        </div>
                        <div id="accordion-4" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <?php


                                if($order_info == 0)
                                {
                                    ?>
                                    <!--<h3>Shopping Cart is Empty</h3>-->
                                    <p>You have no order found.</p>
                                <?php
                                }
                                else
                                {
                                    ?>

                                    <h3 class="title">My Order Details</h3>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td class="text-left">Order Number</td>
                                                <td class="text-left">Order Date</td>
                                                <td class="text-left">Payment Method</td>
                                                <td class="text-left">Product Detail</td>
                                                <td class="text-left">Total Amount</td>
                                                <td class="text-left">Status</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($order_info as $order)
                                            {


                                                ?>
                                                <tr>
                                                    <td class="text-left"><?php echo $order->order_track; ?></td>
                                                    <td class="text-left"><?php
                                                        echo date("d/m/Y H:i:s", strtotime($order->created_date));
                                                        ?></td>
                                                    <td class="text-left"><?php echo 'Cash On Delivery'; ?></td>
                                                    <td class="text-left"><?php
                                                            $single_product = $this->Mdl_frontend->get_single_product_by_productid($order->product_id);
                                                            echo '<b>Product Name: </b>'.$single_product[0]->product_name.'<br/><b>Price: </b>Rs. '.$order->order_price.'<br/><b>Quantity:</b>'.$order->quantity;


                                                         ?></td>
                                                    <td class="text-left">Rs. <?php echo $order->order_price_total; ?></td>
                                                    <td class="text-left">

                                                        <div> <a href="#order<?php echo $order->order_track; ?>" data-parent="#accordion" data-toggle="collapse" class="panel-title collapsed" aria-expanded="false">Current Status <i class="fa fa-caret-down"></i></a>
                                                            <div id="order<?php echo $order->order_track; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="panel-body">
                                                                    <?php
                                                                    $order_history = $this->Mdl_frontend->get_order_history($order->order_track);
                                                                    foreach($order_history as $ord)
                                                                    {
                                                                        echo "<p>".date("d/m/Y H:i:s", strtotime($ord->created_date))."<p><p><b>".$ord->order_info."</b></p>";
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <?php //echo $order->order_status; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
            <!--Middle Part End -->
            <?php require "template/nav_right.php"; ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    //Change Password

    $("input[type=checkbox]").on("click", function()
    {
        if($(this).is(':checked')==true)
        {
            $(".change_password_div").removeClass('hide');
        }
        else
        {
            $(".change_password_div").addClass('hide');
        }
    });

    //City Get
    $(document).on("change",'.city_get',function()
    {
        //alert("YES");
        var json = {};
        json['country_id'] = "166";
        json['state_id'] = $(this).val();
        var request = $.ajax(
            {
                url: "<?php echo base_url('Frontend/get_state_city_byid'); ?>",
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
    //Register Form Validation
    $('#form-validate-personal').validate(
        {

        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            firstname: {
                required: true,
                lettersonly: true
            },
            lastname: {
                required: true,
                lettersonly: true
            },
            telephone: {
                required: true
            },
            gender: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }

        },

        messages: {
            firstname:{
                required: " First Name field is required.",
                lettersonly: " Please enter only alphabetical characters."
            },
            lastname: {
                required: " Last Name field is required.",
                lettersonly: " Please enter only alphabetical characters."
            },
            telephone: " Telephone field is required.",
            gender: " Please choose at least one option",

            email: {
                required: " E-Mail field is required.",
                email: " Please provide a valid email address."
            },
            password: {
                required: " Password field is required.",
                minlength: " Please specify a secure password."
            },
            confirm_password: {
                required: " Confirm Password field is required.",
                minlength: " Please specify a secure password."
            }
        },
        // errorElement : 'div',
        //  errorLabelContainer: '.errorTxt',

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
            // $(".form-validate-register").validationEngine('attach', { promptPosition: "topLeft" });
        }

    });
    // Direct change value in data base on for changing status

    $('#form-validate-address').validate(
        {
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:
            {
                address_1: {
                    required: true
                },
                state_id: {
                    required: true
                },
                city_id: {
                    required: true
                },
                postal_code: {
                    required: true
                }
            },
            messages:
            {
                address_1: " Address field is required.",
                state_id: " State field is required.",
                city_id: " City field is required.",
                postal_code: " Postal Code field is required.",
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
                // $(".form-validate-register").validationEngine('attach', { promptPosition: "topLeft" });
            }
        });
    // Direct change value in data base on for changing status

    jQuery(function($)
    {

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


        var today = new Date();
        $('.date-picker').datepicker({autoclose:true,
            //startDate: '01-01-2010',
            endDate: today

        }).next().on(ace.click_event, function()
        {
            $(this).prev().focus();
        });

        $('.date-picker-hierarchy').datepicker({autoclose:true });
        //$('body').addClass("rtl");
        //$('#ace-settings-rtl').prop('selected', true);

        //Refresh Islamic Education List
        $(document).on("blur",'#email',function()
        {
            var json             = {};
            json['email']   = $("#email").val();
            var email = $("#email").val();
            var request = $.ajax(
                {
                    url: "<?php echo base_url('Frontend/change_user_email'); ?>",
                    type: "POST",
                    data: json,
                    dataType: "html",
                    beforeSend : function()
                    {
                        $('.icon-spinner').removeClass('hide');
                    },
                    success : function(_return)
                    {
                        if(_return == 1)
                        {
                            $('.email_register').html('<input type="email" class="form-control email" id="email" placeholder="E-Mail" value="" name="email"><br/><div for="email" class="help-block">Email is already exit</div>');
                            $('#email').focus();
                        }
                        else
                        {
                            $('.email_register').html('<input type="email" class="form-control email" id="email" placeholder="E-Mail" value="'+email+'" name="email">');
                        }

                    },
                    complete: function ()
                    {
                        $('.icon-spinner').addClass('hide');
                        //$('.city').addClass("select2-select-00");
                    }
                });
        });

    });

</script>


<!-- Footer -->
<?php require "template/footer.php"; ?>