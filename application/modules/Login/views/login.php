<!DOCTYPE html>
<html lang="en">
    <?php
    $this->load->view('Template/header');
    ?>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <i class="icon-leaf green"></i>
                                    <span class="red"><?php 
								   $system_info = $this->Mdl_login->_get_system_info();
								   echo $system_info[0]->system_title; ?></span>
                                    <!-- <span class="white"> پروگرام </span> -->
                                </h1>
                               <!-- <h4 class="blue">&copy; </h4>-->
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="icon-coffee green"></i>
                                                Please Enter Your Information
                                            </h4>

                                            <div class="space-6"></div>

                                            <?php echo form_open(base_url().'Login/check_user');?>
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="username" class="form-control" placeholder="Username" />
                                                        <i class="icon-user"></i>
                                                    </span>
                                                </label>

                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="password" name="password" class="form-control" placeholder="Password" />
                                                        <i class="icon-lock"></i>
                                                    </span>
                                                </label>

                                                <div class="space"></div>

                                                <div class="clearfix">
                                                    <label class="inline">
                                                        <input type="checkbox" class="ace" />
                                                        <span class="lbl"> Remember Me</span>
                                                    </label>

                                                    <button type="submit" name="login" value="login"  class="width-35 pull-right btn btn-sm btn-primary">
                                                        <i class="icon-key"></i>
                                                        Login
                                                    </button>
                                                </div>

                                                <div class="space-4"></div>
                                            </fieldset>
                                            <?php echo form_close();?>


                                        </div><!-- /widget-main -->

                                        <div class="toolbar clearfix">
                                            <!-- <div>
                                            <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                                            <i class="icon-arrow-left"></i>
                                            I forgot my password
                                            </a>
                                            </div>

                                            <div>
                                            <a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
                                            I want to register
                                            <i class="icon-arrow-right"></i>
                                            </a>
                                            </div>  -->
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <?php
        $this->load->view('Template/footer');
        ?>
    </body>
</html>
