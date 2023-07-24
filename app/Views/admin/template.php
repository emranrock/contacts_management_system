<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= !empty($title) ? esc($title) : "no-title"; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?= base_url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?= base_url('assets/admin/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/admin/js/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- Theme style -->

    <link href="<?= base_url('assets/admin/plugins/iCheck/minimal/blue.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- <link href="<?= base_url('assets/admin/plugins/datatables//jquery.dataTables.min.css'); ?>" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url('assets/admin/plugins/select2/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/plugins/pace/pace.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />
    
    <style>
        .error {
            color: red;
            font-weight: normal;
        }

        .bar {
            position: absolute;
            z-index: 10001;
            background-color: rgba(255, 255, 255, .15);
            width: 100%;
            text-align: center;
            font-size: 16px;

        }

        div#codeigniter_profiler {
            margin-left: 233px;
        }
    </style>
    <script type="text/javascript">
        var baseURL = "<?= base_url('admin/'); ?>";
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- <body class="sidebar-mini skin-black-light"> -->

<body class="skin-blue-light sidebar-mini sidebar-collapse">
<?php $session = session(); ?>
    <div class="wrapper">
        <div id="statusBar"></div>
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url('/admin/'); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Y</b>L</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Your</b>-Libaas</span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= base_url(); ?>" target="_blank">Visit Site</a></li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/admin/dist/img/avatar.png'); ?>" class="user-image" alt="User Image" />
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('assets/admin/dist/img/avatar.png'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $session->has('name') ? $session->get('name') : "No Name"; ?>
                                        <small><?= $session->has('roleText') ? $session->get('roleText') : "Anonymous"; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('admin/loadChangePass'); ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar control-sidebar ">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-right info">
                        <p><?= $session->has('userId') ? $session->get('roleText') : 'Guest' ?></p>
                        <a href="#">
                            <div id="status"><i class="fa fa-circle text-success"></i><?php echo 'online'; ?> </div>
                        </a>

                    </div>
                </div>
                
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="<?php echo base_url('admin'); ?>">
                            <i class="fa fa-dashboard"></i><span> <?php echo 'Dashboard'; ?></span>
                        </a>
                    </li>
                  
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o"></i><span><?php echo 'Contacts'; ?>
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('admin/contacts/add'); ?>">
                                    <i class="fa fa-circle-o"></i>Add</a>
                            </li>
                            <li><a href="<?php echo base_url('admin/contacts/manage'); ?>">
                                    <i class="fa fa-circle-o"></i>Manage</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o"></i><span><?php echo 'Groups'; ?>
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('admin/groups/manage'); ?>">
                                    <i class="fa fa-circle-o"></i>Manage</a>
                            </li>
                        </ul>
                    </li>
                    
            </section>
            <!-- /.sidebar -->
        </aside>
        <?= $this->renderSection('content') ?>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>YourLibaas</b> Admin System | Version 1.0
            </div>
            <strong>Copyright &copy; 2016-<?= date('Y'); ?> <a href="http://www.yourlibaas.com" target="_blank">YourLibaas</a>.</strong> All rights reserved.
        </footer>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('assets/admin/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/admin/js/jquery.validate.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/select2/select2.full.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
        <?= $this->section('javascript') ?>
            var AdminLTEOptions = {
                //Add slimscroll to navbar menus
                //This requires you to load the slimscroll plugin
                //in every page before app.js
                navbarMenuSlimscroll: true,
                navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
                navbarMenuHeight: "200px", //The height of the inner menu
                //General animation speed for JS animated elements such as box collapse/expand and
                //sidebar treeview slide up/down. This option accepts an integer as milliseconds,
                //'fast', 'normal', or 'slow'
                animationSpeed: 500,
                //Sidebar push menu toggle button selector
                sidebarToggleSelector: "[data-toggle='offcanvas']",
                //Activate sidebar push menu
                sidebarPushMenu: true,
                //Activate sidebar slimscroll if the fixed layout is set (requires SlimScroll Plugin)
                sidebarSlimScroll: true,
                //Enable sidebar expand on hover effect for sidebar mini
                //This option is forced to true if both the fixed layout and sidebar mini
                //are used together
                sidebarExpandOnHover: false,
                //BoxRefresh Plugin
                enableBoxRefresh: true,
                //Bootstrap.js tooltip
                enableBSToppltip: true,
                BSTooltipSelector: "[data-toggle='tooltip']",
                //Enable Fast Click. Fastclick.js creates a more
                //native touch experience with touch devices. If you
                //choose to enable the plugin, make sure you load the script
                //before AdminLTE's app.js
                enableFastclick: true,
                //Control Sidebar Tree Views
                enableControlTreeView: true,
                //Control Sidebar Options
                enableControlSidebar: false,
                controlSidebarOptions: {
                    //Which button should trigger the open/close event
                    toggleBtnSelector: "[data-toggle='control-sidebar']",
                    //The sidebar selector
                    selector: ".control-sidebar",
                    //Enable slide over content
                    slide: true
                },
                //Box Widget Plugin. Enable this plugin
                //to allow boxes to be collapsed and/or removed
                enableBoxWidget: true,
                //Box Widget plugin options
                boxWidgetOptions: {
                    boxWidgetIcons: {
                        //Collapse icon
                        collapse: 'fa-minus',
                        //Open icon
                        open: 'fa-plus',
                        //Remove icon
                        remove: 'fa-times'
                    },
                    boxWidgetSelectors: {
                        //Remove button selector
                        remove: '[data-widget="remove"]',
                        //Collapse button selector
                        collapse: '[data-widget="collapse"]'
                    }
                },
                //Define the set of colors to use globally around the website
                colors: {
                    lightBlue: "#3c8dbc",
                    red: "#f56954",
                    green: "#00a65a",
                    aqua: "#00c0ef",
                    yellow: "#f39c12",
                    blue: "#0073b7",
                    navy: "#001F3F",
                    teal: "#39CCCC",
                    olive: "#3D9970",
                    lime: "#01FF70",
                    orange: "#FF851B",
                    fuchsia: "#F012BE",
                    purple: "#8E24AA",
                    maroon: "#D81B60",
                    black: "#222222",
                    gray: "#d2d6de"
                },
                //The standard screen sizes that bootstrap uses.
                //If you change these in the variables.less file, change
                //them here too.
                screenSizes: {
                    xs: 480,
                    sm: 768,
                    md: 992,
                    lg: 1200
                }
            };
            <?= $this->endSection() ?>
        <script src="<?= base_url('assets/admin/dist/js/app.js'); ?>" type="text/javascript"></script>
        
        <script src="<?= base_url('assets/admin/js/common.js'); ?>" type="text/javascript"></script>
        
</body>

</html>