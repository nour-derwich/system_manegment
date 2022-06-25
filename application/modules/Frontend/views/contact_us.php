<!-- Header -->
<?php require "template/header.php"; ?>

<div id="container">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">Contact Us</h1>
            <ol class="breadcrumb page-breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.html">Home</a>
                </li>
                <li class="active">Contact Us</li>
            </ol>

        </header>

        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">

                <!---->
                
                    <form class="form-horizontal form-validate-contact" action="<?php echo base_url(); ?>contactus_submit.html" method="post">
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
                        <h3 class="subtitle">Send us an Email</h3>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-name">Your Name</label>
                            <div class="col-md-10 col-sm-9">
                                <input type="text" name="name" value="" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                            <div class="col-md-10 col-sm-9">
                                <input type="email" name="email" value="" id="email" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Enquiry</label>
                            <div class="col-md-10 col-sm-9">
                                <textarea name="enquiry" rows="10" id="enquiry" class="form-control"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
			 <div id="content" class="col-sm-3">
			 <h3 class="subtitle">Contact Us</h3>
			 <div class="row">
                  
                    <div class="col-sm-12">
					<strong>Address:</strong><br />
                        <address>
                            <?php echo $system_info[0]->short_address; ?>
                        </address>
                   
					
					<strong>Phone:</strong><br>
                        <?php echo $system_info[0]->mobile; ?><br />
                        <br />
                        <strong>Email:</strong><br>
                        <?php echo "<a style='' href='mailto:".$system_info[0]->email."'>".$system_info[0]->email."</a>"; ?></div>
                 </div>
			 </div>
          <?php //require "template/nav_right.php"; ?>
            <!--Middle Part End -->
        </div>
		<br/><br/><br/>
    </div>
</div>
<script type="text/javascript">

    jQuery(function($) {

       /*  jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters"); */

    //Register Form Validation
    $('.form-validate-contact').validate({

        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            name: {
                required: true,
               // lettersonly: true
            },
            email: {
                required: true,
                email:true
            },
            enquiry: {
                required: true
            }
        },

        messages: {
            name:{
                required: " Name field is required.",
                lettersonly: " Please enter only alphabetical characters."
            },
            email: {
                required: " E-Mail field is required.",
                email: " Please provide a valid email address."
            },
            enquiry: " Enquiry field is required."
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

    });
</script>


<!-- Footer -->
<?php require "template/footer.php"; ?>