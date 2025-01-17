
<?php
//starting session
session_start();


//Connecting to Database
include('../connection.inc.php');
include('../function.inc.php');
include('../constant.inc.php');


$curStr = $_SERVER['REQUEST_URI'];
$curArr = explode('/', $curStr);
$cur_path= $curArr[count($curArr) -1];
//Checking if user is login or not
if(!isset($_SESSION['IS_LOGIN']))
{
    redirect('login.php');
}

$page_title = '';
if($cur_path == '' || $cur_path == 'index.php')
{
    $page_title = 'Dashboard';
}
elseif($cur_path == '' || $cur_path == 'category.php')
{
    $page_title = 'Category';
}
elseif($cur_path == '' || $cur_path == 'add_category.php')
{
    $page_title = 'Add Category';
}
elseif($cur_path == '' || $cur_path =='dish.php')
{
    $page_title = 'Dish';
}
elseif($cur_path == '' || $cur_path == 'add_dish.php')
{
    $page_title = 'Add Dish';
}
elseif($cur_path == '' || $cur_path == 'contact-us.php')
{
    $page_title = 'Contact Us';
}
elseif($cur_path == '' || $cur_path == 'reservation.php')
{
    $page_title = 'Reservation';
}


?><!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?php echo $page_title.SITE_NAME ?></title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                      </li>
                        <li>
                            <a href="dish.php">
                                <i class="fas fa-chart-bar"></i>Dish</a>
                        </li>
                      
                        <li>
                            <a href="category.php">
                                <i class="far fa-check-square"></i>Category</a>
                        </li>
                        <li>
                            <a href="contact-us.php">
                                <i class="far fa-check-square"></i>Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="reservation.php">
                                <i class="far fa-check-square"></i>Reservation Table</a>
                        </li>

                          <li>
                            <a href="logout.php">

                               <i class="fas fa-calendar-alt"></i>Logout</a>
                        </li>



                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li>
                            <a href="dish.php">
                                <i class="fas fa-chart-bar"></i>Dish</a>
                        </li>
                      
                        <li>
                            <a href="category.php">
                                <i class="far fa-check-square"></i>Category</a>
                        </li>
                       
                        <li>
                            <a href="contact-us.php">
                                <i class="far fa-check-square"></i>Contact Us</a>
                        </li>
                        <li>
                            <a href="reservation.php">
                                <i class="far fa-check-square"></i>Reservation Table</a>
                        </li>
                          <li>
                            <a href="logout.php">

                               <i class="fas fa-calendar-alt"></i>Logout</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
          <!-- PAGE CONTAINER-->
        <div class="page-container">
