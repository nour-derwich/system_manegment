<!-- Header -->
<?php require "template/header.php"; ?>
<style>
    .help-block
    {
        /*display: none !important;*/
    }

</style>
<div id="container">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">Seller Reset Password</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active">Seller Reset Password</li>
            </ol>

        </header>

        <div class="row">
            <!--Middle Part Start-->
            <div class="col-sm-9" id="content">
                <h1 class="title">Reset Password?</h1>
                <form class="form-horizontal form-validate-reset" action="<?php echo base_url(); ?>seller_reset_password_submit.html" method="post">
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

                    <input type="hidden" class="form-control" id="key" value="<?php echo $key; ?>" name="key">
                    <input type="hidden" class="form-control" id="user_id" value="<?php echo $user_id;?>" name="user_id">

                    <fieldset>
                     <div class="form-group required">
        <label for="input-password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="Password" value="" name="password">
        </div>
    </div>
    <div class="form-group required">
        <label for="input-confirm" class="col-sm-2 control-label">Password Confirm</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="confirm_password" placeholder="Password Confirm" value="" name="confirm_password">
        </div>
    </div>

                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right ">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
            <?php require 'template/nav_right.php'; ?>
            <!--
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Account</h3>
                <div class="list-group">
                    <ul class="list-item">
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="#">Forgotten Password</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Address Books</a></li>
                        <li><a href="wishlist.html">Wish List</a></li>
                        <li><a href="#">Order History</a></li>
                        <li><a href="#">Downloads</a></li>
                        <li><a href="#">Reward Points</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Transactions</a></li>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Recurring payments</a></li>
                    </ul>
                </div>
            </aside>-->
            <!--Right Part End -->
        </div>
    </div>
</div>
<script type="text/javascript">
    //Register Form Validation
    $('.form-validate-reset').validate({

        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
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
            /*firstname: {
             required: " Please provide a first name.",
             lettersonly: " Please  ."
             },
             email: {
             required: " Please provide a valid email.",
             email: "    Please provide a valid email."
             },

             email: {
             required: " Please provide a valid email.",
             email: "    Please provide a valid email."
             },
             password: {
             required: " Please specify a password.",
             minlength: "    Please specify a secure password."
             },
             subscription: " Please choose at least one option",
             subscription: " Please choose at least one option",
             subscription: " Please choose at least one option",
             subscription: " Please choose at least one option",
             subscription: " Please choose at least one option",
             gender: "   Please choose gender",
             agree: "    Please accept our policy"*/
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
                            $('.email_register').html('<input type="email" class="form-control email" id="email" placeholder="E-Mail" value="" name="email"><br/><div for="password" class="help-block">Email is already exit</div>');
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