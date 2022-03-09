<?php
require_once 'function/function.php';

require_once 'restriction.php';

require_once 'function/requeststatus.php';
//unset($_SESSION['endorse']);
unset($_SESSION['status']);
unset($_SESSION['search']);

//echo $role;
?>
<html>
    <head>
        <meta http-equiv="cache-control" content="no-cache">
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/preload.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css"href="css/card-design.css"/>
        <link rel="stylesheet" type="text/css"href="css/topbar-notif.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/view.js"></script>
        <script src="js/requestform.js"></script>
        <script src="js/topbar.js"></script>
        <script type="text/javascript">

        $(function() {

            //autocomplete
            $(".loginas").autocomplete({
                source: "function/search.php",
                minLength: 2
            });

        });


        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';

        ?>
        <div class="" id="waitani">
            <div class="sk-fading-circle waitani" >
                <h1 class="mid">Loading</h1>
              <div class="sk-circle1 sk-circle"></div>
              <div class="sk-circle2 sk-circle"></div>
              <div class="sk-circle3 sk-circle"></div>
              <div class="sk-circle4 sk-circle"></div>
              <div class="sk-circle5 sk-circle"></div>
              <div class="sk-circle6 sk-circle"></div>
              <div class="sk-circle7 sk-circle"></div>
              <div class="sk-circle8 sk-circle"></div>
              <div class="sk-circle9 sk-circle"></div>
              <div class="sk-circle10 sk-circle"></div>
              <div class="sk-circle11 sk-circle"></div>
              <div class="sk-circle12 sk-circle"></div>
            </div>
        </div>
        <div class="container-fluid">


            <div class="row mt-5">
            <?php

                include 'function\login.as.php';

            ?>



            </div>
            <?php

            if (strpos($fullname, 'admin.') !== false) {

                ?>
                <div class="row page-title">
                    <h4><i class="fa fa-users" aria-hidden="true"></i>My Request Pool</h4>

                </div>


                <?php

                include 'index/index.admin.php';

            }else{

                ?>
                <div class="row page-title">
                    <h4><i class="fa fa-home" aria-hidden="true"></i> Home</h4>

                </div>

                <?php

                include 'index/index.nonadmin.php';
                
            }



             ?>

        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
