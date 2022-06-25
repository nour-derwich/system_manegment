<!-- Header -->
<?php require "template/header.php"; ?>
<style>
    .help-block
    {
        color:#a94442 !important;
    }

</style>
<div id="container">
<div class="container">
    <header class="page-header">
        <h1 class="page-title">Register Account</h1>
        <ol class="breadcrumb page-breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.html">Home</a>
            </li>
            <li class="active">Register Account</li>
        </ol>

    </header>


<div class="row">
<!--Middle Part Start-->
<div class="col-sm-9" id="content">
<h1 class="title">Register Account</h1>
<p>If you already have an account with us, please login at the <a href="<?php echo base_url(); ?>login.html">Login Page</a>.</p>
<form class="form-horizontal form-validate-register" action="<?php echo base_url(); ?>register_submit.html" method="post">
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
<fieldset id="account">
    <legend>Your Personal Details</legend>
    <div class="errorTxt"></div>
    <div class="form-group required">
        <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" placeholder="First Name" value="" name="firstname">
        </div>
    </div>
    <div class="form-group required">
        <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control col-sm-12" id="lastname" placeholder="Last Name" value="" name="lastname">
        </div>
    </div>

    <div class="form-group required">
        <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
        <div class="col-sm-10">
            <input type="tel" class="form-control col-sm-12" id="telephone" placeholder="Telephone" value="" name="telephone">
        </div>
    </div>
    <div class="form-group required">
        <label for="input-fax" class="col-sm-2 control-label">Gender</label>
        <div class="col-sm-10">
            <select class="form-control" id="gender" name="gender">
                <option value="">Please Select</option>
                <option value="male"> Male</option>
                <option value="female"> Female</option>
            </select>
        </div>
    </div>
    <!-- <div class="form-group">
      <label for="input-telephone" class="col-sm-2 control-label">Birthday</label>
      <div class="col-sm-10">
          <input type="text" class="form-control date-picker" id="date_of_birth"  placeholder="Birthday" value="" name="date_of_birth">

        </div>

    </div>-->
</fieldset>
<fieldset>
    <legend>Your Account Details</legend>
    <div class="form-group required">
        <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
        <div class="col-sm-10 email_register">
            <input type="email" class="form-control" id="email" placeholder="E-Mail" value="" name="email">
        </div>
    </div>
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
        <input type="checkbox" value="1" name="agree">
        &nbsp;I have read and agree to the <a class="agree" target="_blank" href="privacy_policy.html"><b>Privacy Policy</b></a> &nbsp;
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
</div>
</form>
    <br/><br/><br/>
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
    $('.form-validate-register').validate({

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
            },
            agree:
            {
                required: true
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
            },
            agree: " Privacy Policy field is required."
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

    jQuery(function($)
    {

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");



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