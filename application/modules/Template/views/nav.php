<body>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-lock"></i>
                   <?php 
					$system_info = $this->Mdl_login->_get_system_info();
					echo $system_info[0]->system_name; ?>
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">


                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                         <span class="">
                            <!--<small>Welcome,</small>-->
                            Welcome, <b><?php echo $this->session->userdata('name'); ?></b>
                        </span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <!-- <li>
                        <a href="#">
                        <i class="icon-cog"></i>
                        Settings
                        </a>
                        </li>

                        <li>
                        <a href="#">
                        <i class="icon-user"></i>
                        Profile
                        </a>
                        </li>   -->

                        <!-- <li class="divider"></li>  -->

                        <li>
                            <a href="<?php echo base_url('Login/logout'); ?>">
                                <i class="icon-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>

<div class="main-container" id="main-container">
<script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
</script>

<div class="main-container-inner">
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>


