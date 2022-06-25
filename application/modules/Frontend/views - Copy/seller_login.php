<!-- Header -->
<?php require "template/header.php"; ?>
<style>
    .help-block{
        color:#a94442 !important;
    }

</style>
<div id="container">
    <div class="container">

        <header class="page-header">
            <h1 class="page-title">Seller Login</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active">Seller Login</li>
            </ol>

        </header>

        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">

                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="subtitle">New Seller</h2>
                        <p><strong>Register Account</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <a href="<?php echo base_url(); ?>seller_register.html" class="btn btn-primary">Continue</a> </div>
                    <div class="col-sm-6">
                        <h2 class="subtitle">Returning Seller</h2>
                        <form class="form-validate-login" action="<?php echo base_url(); ?>seller_login_submit.html" method="post">
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
                        <p><strong>I am a returning seller</strong></p>
                        <div class="form-group">
                            <label class="control-label" for="input-email">E-Mail Address</label>
                            <input type="text" name="email" value="" placeholder="E-Mail Address" id="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-password">Password</label>
                            <input type="password" name="password" value="" placeholder="Password" id="password" class="form-control" />

                        </div>
                            <div class="form-group">

                                <a href="<?php echo base_url(); ?>seller_forgot_password.html">Forgot password?</a>
                                <input type="submit" value="Login" class="btn btn-primary pull-right" />
                            </div>


                            </form>
                    </div>
                </div>
            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
                <?php require "template/nav_right.php";?>
             <!--Right Part End -->
        </div>
    </div>
</div>
<script type="text/javascript">
    //Register Form Validation
    $('.form-validate-login').validate({

        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            email: {
                required: true,
                email:true
            },
            password: {
                required: true
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


    });

</script>



<!-- Footer -->
<?php require "template/footer.php"; ?>