<?php
    error_reporting(0);
    include 'config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$sitetitle?></title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- Favicone Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="icon" type="image/png" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/favicon.ico">
        <!-- CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.css" rel="stylesheet" type="text/css" />
        <link href="css/plugin/sidebar-menu.css" rel="stylesheet" type="text/css" />
        <link href="css/plugin/animate.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-- SLIDER REVOLUTION CSS SETTINGS -->
        <!-- <link href="plugin/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="screen" /> -->
    </head>
    <body>
        <!-- Site Wraper -->
        <div class="wrapper">
            <?php if ($show_header !== FALSE ) : ?>
            <!-- Header -->
            <header id="header" class="header">
                <div class="container header-inner">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.php">
                            <img class="logo-light" src="img/logo-white.png" alt="Intelleral" />
                            <img class="logo-dark" src="img/logo-black.png" alt="Intelleral" />
                        </a>
                    </div>
                    <!-- End Logo -->
                    <!-- Mobile Navbar Icon -->
                    <div class="nav-mobile nav-bar-icon">
                        <span></span>
                    </div>
                    <!-- End Mobile Navbar Icon -->
                    <!-- Navbar Navigation -->
                    <div class="nav-menu">
                        <ul class="nav-menu-inner">
                            <li>
                                <a href="index.php">Home</a>  
                            </li>
                            <li>
                            <a href="checkout.php?AFID=<?php echo $_GET['AFID']; ?>&SID=<?php echo $_GET['SID']; ?>&click_id=<?php echo $_GET['click_id']; ?>">Shop</a>
                            </li>
                            <li class="nav-menu singlepage-nav">
                            <a href="#contact-info">Contact</a>
                            </li>
                            <li>
                            <a href="terms.php">Terms & Conditions</a>
                            </li>     
                        </ul>
                    </div>
                    <!-- End Navbar Navigation --> 
                </div>
            </header>
            <!-- End Header -->
            <?php endif;?>   