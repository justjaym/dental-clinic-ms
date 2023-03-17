<?php include('../includes/functions.php') ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
  <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
  <meta name="robots" content="noindex,nofollow" />
  <title>PDCMS</title>
  <!-- Favicon icon -->
  <link rel="icon" type="../image/png" sizes="16x16" href="../images/logo.png" />

  <!-- Custom CSS -->
  <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="../dist/css/style.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <script src='../js/calendar.js'></script>
</head>
<style>
  #navbarSupportedContent {
    background: #2255a1 !important;
  }

  nav.navbar-dark,
  header.topbar,
  a.navbar-brand,
  aside.left-sidebar,
  #sidebarnav,
  a.sidebar-link {
    background: #2255a9 !important;
  }

  .logo {
    height: 40px;
  }

  body {
    font-family: 'Nunito Sans' !important;
  }
</style>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="index.php">
            <!-- Logo icon -->
            <img src="../images/logo.png" alt="" class="logo">
            <h2 class="ms-4">PDCMS</h2>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-start me-auto">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>

            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
          <ul class="navbar-nav float-end">
            <!-- <li class="nav-item">
              <a class="nav-link waves-effect waves-dark sidebar-link " href="../logout.php" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Log Out</span></a>
            </li> -->

            <?php $id = $_SESSION['user']->id ?>
            <?php $default = get_one("select u.id,ui.first_name,ui.municipality,ui.barangay,ui.email,ui.contact,u.username,u.password from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
              </a>
              <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"><i class="fa fa-user me-1 ms-1"></i><?= ucfirst($default->first_name); ?></a>
                <a class="dropdown-item" href="../logout.php"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
              </ul>
            </li>
          </ul>

        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav ">
          <ul id="sidebarnav" class="pt-4">
            <!-- <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link bg-dark" href="#" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"><?= $_SESSION['user']->username ?></span></a>
            </li> -->
            <li class="sidebar-item">
              <a href="#" class="sidebar-link waves-effect waves-dark sidebar-link bg-dark" disabled onMouseOver="this.style.background='unset'">
                <i class="mdi mdi-view-dashboarasdd"></i>
                <?= ucfirst($default->first_name) ?>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link bg-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
            </li>

            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'appointments') !== false) {
              query("DELETE from tbl_notification where dentist_id = " . $_SESSION['user']->id);
            }
            $count = get_one("select count(*) as result from tbl_notification where dentist_id = " . $_SESSION['user']->id)->result ?? 0;
            ?>
            <?php
            if (isset($_SESSION['user'])) {
              if ($_SESSION['user']->access_id == 2) {
                echo "<li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='staffs.php' aria-expanded='false'><i class='mdi mdi-account-multiple-plus'></i><span class='hide-menu'>Manage Dentist/Clerk</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='appointments.php' aria-expanded='false'><i class='mdi mdi-calendar-today'></i><span class='hide-menu'>Appointments (<?= $count ?>)</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='services.php' aria-expanded='false'><i class='mdi mdi-source-branch'></i><span class='hide-menu'>Services</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='products.php' aria-expanded='false'><i class='mdi mdi-store'></i><span class='hide-menu'>Products</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='sales_report.php' aria-expanded='false'><i class='mdi mdi-file'></i><span class='hide-menu'>Sales Report</span></a>
                </li>
            
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='edit_clinic_details.php?id=" . $_SESSION['user']->id . "' aria-expanded='false'><i class='mdi mdi-pencil'></i><span class='hide-menu'>Edit Clinic Details</span></a>
                </li>
                ";
              } else if ($_SESSION['user']->access_id == 3) {
                echo "
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='appointments.php' aria-expanded='false'><i class='mdi mdi-calendar-today'></i><span class='hide-menu'>Appointments (<?= $count ?>)</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='services.php' aria-expanded='false'><i class='mdi mdi-source-branch'></i><span class='hide-menu'>Services</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='products.php' aria-expanded='false'><i class='mdi mdi-store'></i><span class='hide-menu'>Products</span></a>
                </li>
                ";
              } else if ($_SESSION['user']->access_id == 4) {
                echo "
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='appointments.php' aria-expanded='false'><i class='mdi mdi-calendar-today'></i><span class='hide-menu'>Appointments (<?= $count ?>)</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='services.php' aria-expanded='false'><i class='mdi mdi-source-branch'></i><span class='hide-menu'>Services</span></a>
                </li>
                <li class='sidebar-item'>
                <a class='sidebar-link waves-effect waves-dark sidebar-link bg-dark' href='products.php' aria-expanded='false'><i class='mdi mdi-store'></i><span class='hide-menu'>Products</span></a>
                </li>
                ";
              }
            }
            ?>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>