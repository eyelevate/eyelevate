<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eyelevate Admin</title>

<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link href="/assets/css/admins/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="/assets/css/admins/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/admins/maps/jquery-jvectormap-2.0.1.css" />
    <link href="/assets/css/admins/icheck/flat/green.css" rel="stylesheet" />
    <link href="/assets/css/admins/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="/assets/js/admins/jquery.min.js"></script>
    <script src="/assets/js/admins/nprogress.js"></script>
    <script>
    </script>
      @yield('stylesheets')
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{!! route('admins_index') !!}" class="site_title"> <span>Eyelevate - Admin</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="/assets/images/profile-images/perm/{!!$this_user_profile_image!!}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{!! $this_username !!}</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu clearfix">

                        <div class="menu_section">
                            <ul class="nav side-menu clearfix">
                                <li class="li-menus"><a><i class="fa fa-wrench"></i> Billing <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li>Projects</li>
                                        <li class="navLi"><a href="{!! route('projects_index') !!}">Projects</a></li>
                                        <li>Taxes</li>
                                        <li class="navLi"><a href="{!! route('taxes_index') !!}">Index</a></li>
                                        <li class="navLi"><a href="{!! route('taxes_add') !!}">Add</a></li>
                                        <li>Invoices</li>
                                        <li class="navLi"><a href="{!! route('invoices_index') !!}">Index</a></li>
                                        <li class="navLi"><a href="{!! route('invoices_add') !!}">Add</a></li>
                                    </ul>
                                </li>                                    
                                <li class="li-menus"><a><i class="fa fa-wrench"></i> Control Panel <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li>Categories</li>
                                        <li class="navLi"><a href="{!! route('category_view') !!}">Category</a></li>
                                        <li>Flags</li>
                                        <li class="navLi"><a href="{!! route('flags_index') !!}">Flags</a></li>
                                        <li>Tasks</li>
                                        <li class="navLi"><a href="{!! route('tasks_index') !!}">Tasks</a></li>
                                        <li>Users</li>
                                        <li class="navLi"><a href="{!! route('users_index') !!}">Users</a></li>
                                    </ul>
                                </li>
                                <li class="li-menus"><a><i class="fa fa-edit"></i> Utilities<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li>Access Control</li>
                                        <li class="navLi"><a href="{!! route('roles_index') !!}">Roles</a></li>
                                        <li class="navLi"><a href="{!! route('permissions_index') !!}">Permissions</a></li>
                                        <li class="navLi"><a href="{!! route('permission_roles_index') !!}">Permision Roles</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
<!--                         <div class="menu_section">
                            <h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="e_commerce.html">E-commerce</a>
                                        </li>
                                        <li><a href="projects.html">Projects</a>
                                        </li>
                                        <li><a href="project_detail.html">Project Detail</a>
                                        </li>
                                        <li><a href="contacts.html">Contacts</a>
                                        </li>
                                        <li><a href="profile.html">Profile</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="page_404.html">404 Error</a>
                                        </li>
                                        <li><a href="page_500.html">500 Error</a>
                                        </li>
                                        <li><a href="plain_page.html">Plain Page</a>
                                        </li>
                                        <li><a href="/admins/logout">Login Page</a>
                                        </li>
                                        <li><a href="pricing_tables.html">Pricing Tables</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                                </li>
                            </ul>
                        </div> -->

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    @if($notif['isset'] == true)
                                        <span class="badge" style="color:#d9534f;background:white">{{$notif['count']}} Task</span>
                                    @endif
                                    <img src="/assets/images/profile-images/perm/{!!$this_user_profile_image!!}" alt="">{!! $this_username !!}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li>
                                        @if(Auth::user())
                                        <a href="/admins/logout">
                                            <i class="fa fa-sign-out pull-right"></i> Log Out
                                        </a>
                                        @else
                                        <a href="/admins/login">
                                            <i class="fa fa-sign-out pull-right"></i> Log In
                                        </a>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="row">
                    @include('flash::message')
					@yield('content')
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="/assets/js/admins/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="/assets/js/admins/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="/assets/js/admins/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="/assets/js/admins/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="/assets/js/admins/icheck/icheck.min.js"></script>


    <script src="/assets/js/admins/custom.js"></script>
        @yield('scripts')

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->



    <!-- /footer content -->
</body>

</html>