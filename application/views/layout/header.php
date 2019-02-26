<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Meeting Backend System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/common/images/jam.ico');?>" type="image/x-icon">
    <link href="<?=base_url('assets/dist/css/jquery-ui.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/dist/css/jquery-ui.theme.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/dist/css/jquery-ui.structure.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?=base_url('assets/plugins/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
     <!-- <link href="<?=base_url('assets/plugins/datatables/responsive.dataTables.min.css');?>" rel="stylesheet" type="text/css" /> -->
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url('assets/dist/css/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/admin/css/custom.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/dist/css/print.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/dist/css/jquery-customselect.css');?>" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery 2.1.3 -->
    <!-- <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script> -->
    <script src="<?=base_url('assets/dist/js/jquery-1.12.3.js');?>" type="text/javascript"></script>

    <script src="<?=base_url('assets/dist/js/jquery-ui.min.js');?>" type="text/javascript"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>    
    <!-- FastClick -->
    <script src='<?=base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/app.min.js');?>" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url('assets/dist/js/jquery.dataTables.js');?>" type="text/javascript"></script>
        
    <script src="<?=base_url('assets/dist/js/dataTables.buttons.min.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/dist/js/buttons.bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/dist/js/buttons.print.min.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/dist/js/pdfmake.min.js');?>" type="text/javascript"></script>    
    <script src="<?=base_url('assets/dist/js/vfs_fonts.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/dist/js/buttons.html5.min.js');?>" type="text/javascript"></script>
    


    <script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    <!-- <script src="<?=base_url('assets/plugins/datatables/dataTables.responsive.js');?>" type="text/javascript"></script> -->
    <script type="text/javascript" src="<?=base_url('assets/common/plugins/ckeditor/ckeditor.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/chartjs/Chart.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
     <script type="text/javascript" async
      src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
    </script>
    <script type="text/javascript" src="<?=base_url('assets/dist/js/print.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/dist/js/jquery-customselect.js');?>"></script>
    <style>
      #redstar{color: red;}
      select.ui-datepicker-month,select.ui-datepicker-year{color: black;}
      hr {
          border-color: #f05f40;
          border-width: 3px;
          max-width: 50px;
      }
    </style>
  </head>
  <body class="skin-red fixed">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('homeadmin');?>" class="logo"><img width="200px" height="45px" src="<?=base_url('assets/admin/images/img-1.png');?>"></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php if ($notif['total'] != "") { ?><?php echo trim($notif['total']); ?>
                    <?php
                    } else {
                    ?><?php echo ""; ?><?php
                      }
                    ?></span>
                </a> -->
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $notif['total']; ?> messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php foreach($notif['lists'] as $keys) { ?>
                      <li><!-- start message -->
                        <a href="<?=base_url('messages/messagesland/show/'.$keys['contact_id']); ?>">
                          <h4>
                            <?php echo $keys['name']; ?>
                            <small><i class="fa fa-clock-o"></i> <?php echo $keys['created_date']; ?></small>
                          </h4>
                          <p><?php echo $keys['message']; ?></p>
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?=base_url('messages/messagesland'); ?>">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url('assets/common/images/noimage.jpg');?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $admin_user_fullname; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=base_url('assets/common/images/noimage.jpg');?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $admin_user_fullname; ?> - <?php echo $admin_role_name; ?>
                      <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="<?php echo base_url('homeadmin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url('assets/common/images/noimage.jpg');?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $admin_user_fullname; ?></p>
             <?php echo $admin_role_name; ?>
            </div>
          </div>
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li id="dashboard">
              <a href="<?=base_url('homeadmin');?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="#">
                <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="adminuser">
                    <a href="<?=base_url('adminuser/adminuser');?>"><i class="fa fa-circle-o"></i> Pengguna Admin</a>
                </li>
                <li id="memberuser">
                    <a href="<?=base_url('memberuser/memberuser');?>"><i class="fa fa-circle-o"></i> Pengguna Aplikasi</a>
                </li>
                <li id="jabatan">
                    <a href="<?=base_url('jabatan/jabatanland');?>"><i class="fa fa-circle-o"></i> Jabatan</a>
                </li>
                <li id="workunit">
                    <a href="<?=base_url('workunit/workunitland');?>"><i class="fa fa-circle-o"></i> Unit Kerja</a>
                </li>                
                <li id="meeting">
                    <a href="<?=base_url('meeting/meetingland');?>"><i class="fa fa-circle-o"></i> Rapat</a>
                </li>
                <li id="rundown">
                    <a href="<?=base_url('rundown/rundownland');?>"><i class="fa fa-circle-o"></i> Rundown Rapat</a>
                </li>
                <li id="material">
                    <a href="<?=base_url('material/materialland');?>"><i class="fa fa-circle-o"></i> Materi Rapat</a>
                </li>
                <li id="legislation">
                    <a href="<?=base_url('legislation/legislationland');?>"><i class="fa fa-circle-o"></i> Peraturan Perundangan</a>
                </li>
              </ul>
              </li>
              <li id="absent">
                <a href="<?=base_url('absent/absentland');?>">
                  <i class="fa fa-check-square"></i> <span>Manajemen Rapat</span>
                </a>
              </li>              
            
            <!-- <li>
              <a href="<?=base_url('adminuser/');?>">
                <i class="fa fa-pagelines"></i> <span>Admin User</span>
              </a>
              <a href="<?=base_url('memberuser/');?>">
                <i class="fa fa-pagelines"></i> <span>Admin User</span>
              </a>
            </li> -->
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>