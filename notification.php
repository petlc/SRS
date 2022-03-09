<?php

require_once 'restriction.php';
require_once 'function/function.php';
require_once 'function/requeststatus.php';

unset($_SESSION['endorse']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <link rel="stylesheet" type="text/css"href="css/card-design.css"/>
        <link rel="stylesheet" type="text/css"href="css/topbar-notif.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script src="js/view.js"></script>
        <script src="js/requestform.js"></script>
        <script src="js/topbar.js"></script>
</head>
<body>
    <?php

    include 'function/topbar.php';
    ?>

    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
            
                <div class="col-3">
                </div>

                <div class="col-6">

                    <div class="card">
                        <div class="card-block">
                        </div>
                    </div>
                </div>

                <div class="col-3">
                </div>
            </div>
        </div>
    </div>
</body>
</html>