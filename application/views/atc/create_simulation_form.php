<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 5/14/2017
 * Time: 4:45 PM
 */
?>

<html lang="en">
<head>
    <title>ATC Create Simulation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }
        .black {
            background-image: url("https://www.thestar.com/content/dam/thestar/news/canada/2013/03/14/jet_ignored_order_to_abort_landing_after_driverless_van_rolled_across_pearson_runway/tower1.jpg.size.custom.crop.1086x444.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: 0 -200px;
            padding: 50px;
            color: white;
            opacity: 0.8;
            transition: padding 1s, opacity 0.5s, font-size 0.5s;
        }
        .black:hover {
            background-image: url("https://www.thestar.com/content/dam/thestar/news/canada/2013/03/14/jet_ignored_order_to_abort_landing_after_driverless_van_rolled_across_pearson_runway/tower1.jpg.size.custom.crop.1086x444.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: 0 -200px;
            padding: 70px;
            color: white;
            opacity: 1;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ATC</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Project <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Start Simulation</a></li>
                    </ul>
                </li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid bg-3 text-center">

</div><br><br>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

</body>
</html>
