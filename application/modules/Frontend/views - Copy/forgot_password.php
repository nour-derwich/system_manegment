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
<!-- Breadcrumb Start-->
    <header class="page-header">
        <h1 class="page-title">Forgot password</h1>
        <ol class="breadcrumb page-breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.html">Home</a>
            </li>
            <li class="active">Forgot password</li>
        </ol>

    </header>


<!-- Breadcrumb End-->
<div class="row">
<!--Middle Part Start-->
<div class="col-sm-9" id="content">
<h1 class="title">Forgot password?</h1>
<p>Please type in your email address. We send you a link to change the password.</p>
<form class="form-horizontal form-validate-forgot" action="<?php echo base_url(); ?>forgot_password_submit.html" method="post">
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


<fieldset>
    <legend></legend>
    <div class="form-group required">
        <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
        <div class="col-sm-10 email_register">
            <input type="email" class="form-control" id="email" placeholder="E-Mail" value="" name="email">
        </div>
    </div>
</fieldset>
<!--<fieldset>
    <legend>Newsletter</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label">Subscribe</label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type="radio" value="1" name="newsletter">
                Yes</label>
            <label class="radio-inline">
                <input type="radio" checked="checked" value="0" name="newsletter">
                No</label>
        </div>
    </div>
</fieldset>-->
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
    $('.form-validate-forgot').validate({

        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {

            email: {
                required: true,
                email:true
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




        //$('body').addClass("rtl");
        //$('#ace-settings-rtl').prop('selected', true);


    });

</script>


<!-- Footer -->
<?php require "template/footer.php"; ?>