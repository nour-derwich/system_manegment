<?php
$controller = $this->uri->segment(1);
$view        = $this->uri->segment(2);
if($view == 'action')
{
    $view = $this->uri->segment(3); 
}

?>
<div class="sidebar " id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="icon-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="icon-group"></i>
            </button>

            <button class="btn btn-danger">
                <i class="icon-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- #sidebar-shortcuts -->




    <ul class="nav nav-list">
        <?php  echo   Modules::run('Template/sidebar',$controller,$view);   ?>
        <!-- <li <?php if($controller == 'Dashboard'): echo 'class="active"';  endif; ?>>
        <a href="<?php echo base_url('Dashboard'); ?>">
        <i class="icon-dashboard"></i>
        <span class="menu-text"> Dashboard </span>
        </a>
        </li>
        <li <?php if($controller == 'Hierarchy' || $controller == 'Users'): echo 'class="active"';  endif; ?>>
        <a href="#" class="dropdown-toggle">
        <i class="icon-list"></i>
        <span class="menu-text"> Admin </span>

        <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
        <li <?php if($controller == 'Users'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Users'); ?>">
        <i class="icon-double-angle-right"></i>
        Users Managment
        </a>
        </li> 

        <li <?php if($controller == 'Hierarchy' && $view != 'madani_month'  && $view != 'token_purpose' && $view != 'token_halqa' ): echo 'class="active"'; endif; ?>>
        <a href="#" class="dropdown-toggle">
        <i class="icon-double-angle-right"></i>
        System Hierarchy
        <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">

        <li <?php if($view == 'country_list'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Hierarchy/country_list'); ?>">
        <i class="icon-bolt"></i>
        ملک کی فہرست
        </a>
        </li>
        <li <?php if($view == 'kabinat_list'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Hierarchy/kabinat_list'); ?>">
        <i class="icon-bolt"></i>
        کابینات  فہرست
        </a>
        </li>
        <li <?php if($view == 'kabina_list'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Hierarchy/kabina_list'); ?>">
        <i class="icon-bolt"></i>
        کابینہ فہرست
        </a>
        </li>
        <li <?php if($view == 'division_list'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Hierarchy/division_list'); ?>">
        <i class="icon-bolt"></i>
        ڈویژن فہرست
        </a>
        </li>  
        <li <?php if($view == 'area_list'): echo 'class="active"'; endif; ?>>
        <a href="<?php echo base_url('Hierarchy/area_list'); ?>">
        <i class="icon-bolt"></i>
        Area List
        </a>
        </li>   

        </ul>
        </li>


        </ul>
        </li>-->

    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

<div class="main-content">