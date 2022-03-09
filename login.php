<?php

require_once 'function/function.php';
session_start();
/*
$remote_add = $_SERVER['REMOTE_ADDR'];
$arr_info = shell_exec('wmic.exe/node:'.$remote_add.' computersystem get username');
echo $arr_info;
*/
if(empty($_SESSION['url'])){

    $url = "index.php";
}else{
    $url = $_SESSION['url'];
}

?>
<html>
    <head>
        <title>
            Service Request
        </title>
        <link rel="icon" type="image/ico" href="favicon.ico">
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <style>

        .topbar{
            padding: 0 20px;
            background-color: #3f72af;
            color: #dbe2ef;
            overflow: hidden;
            display:block;
        }


        .topbar .topbar-brand{
            width: 350px;
            margin-top: 25px;
            margin-bottom: 29px;
            padding-left: 20px;
            font-size: 26px ;
        }

        .card-footer{
            padding: 0;
            height: 50px;
        }
        .card-header{
            height: 50px;
            background-color: #3f72af;
            border-radius: 0;
            color: #dbe2ef;
        }
        .card-footer .btn-block{
            height: 50px;
            background-color: #3f72af;
            border-radius: 0;
        }
        .blink_me {
          animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
          50% {
            opacity: 0;
          }
          100% {
            opacity: 100;
            color: white;
          }
        }
        </style>
    </head>
    <body class="wrapper">
        <nav class="topbar">
            <div class="topbar-brand">
                <h3 class="font-weight-bold">Service Request System</h3>
            </div>
            <div class="topbar-menu">
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row content">
                <div class="col-md-4 col-xl-4">

                </div>
                <div class="col-md-4 col-xl-4 mt-5 mb-5">
                    <form method="post" class="form-group">
                        <div class="Card">
                            <div class="card-header">
                                <h4 class="">Login</h4>
                                <?php 
                                    
                                ?>
                            </div>
                            <div class="card-block">
                                <input class="form-control" type="hidden" name="lastvisited" value="<?php echo $url; ?>">
                                <input class="form-control mb-3" type="text" name="username" placeholder="Username">
                                <input class="form-control mb-3" type="password" name="password" placeholder="Password">

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block" type="submit" name="login"><i class="fa fa-key" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-xl-4">

                </div>

                <div class="col-md-4 col-xl-4">

                </div>
                <div class="col-md-4 col-xl-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="blink_me"><i class="fas fa-info-circle"></i> Information</h4>
                        </div>
                        <div class="card-block">
                            <p>If interface is no good, Please press <span class="font-weight-bold">Ctrl+F5</span> to update the no good part and use Google Chrome browser to avoid problem. <br><br> Thank you </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">

                </div>

            </div>
        </div>

        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
