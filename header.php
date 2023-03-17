<?php include('includes/functions.php') ?>
<?php
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']->access_id == 1 || $_SESSION['user']->access_id == 6) {
    header('location:admin');
  } else if ($_SESSION['user']->access_id == 2 || $_SESSION['user']->access_id == 3 || $_SESSION['user']->access_id == 4) {
    header('location:dental_admin');
  } else {
    header('location:patient');
  }
} ?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <!-- <meta charset="utf-8"> -->
  <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <link href="dist/css/style.min.css" rel="stylesheet" />
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDCMS</title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/flexslider.css">
  <link rel="stylesheet" href="css/jquery.fancybox.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/font-icon.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


  <style>
    .banner1 {
      color: black;
      font-family: Lato, sans-serif;
      font-style: bold;
      color: #fff !important;
      text-shadow: 5px 5px 5px black;
    }
  </style>
</head>

<body>
  <!-- header section -->
  <section class="banner" role="banner" id="banner">
    <header id="header">
      <style>
        .logo {
          height: 40px;
          border-radius:100px;
        }
      </style>

      <div class="header-content clearfix"><img src="images/logo.png" alt="" class="logo"><a class="logo" href="index.php"> PDCMS</a>
        <nav class="navigation" role="navigation">
          <ul class="primary-nav">
            <li><a href="#banner">Home</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#content-3-10">About</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#" data-toggle="modal" data-target="#register_modal">Sign Up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#login_modal">Login</a></li>
          </ul>
        </nav>
        <a href="#" class="nav-toggle">Menu<span></span></a>
      </div>
    </header>