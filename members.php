<?php

require_once 'function/function.php';

require_once 'restriction.php';
require_once 'function/requeststatus.php';
require_once 'function/misonly.php';
unset($_SESSION['endorse']);

//echo basename($_SERVER['REQUEST_URI']);

?>
<html>
    <head>
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
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
        <script>

            $(document).ready(function(){
                //$(".form-group-login").hide();
                $(".tool").click(function(){
                    $(".tool-grp").fadeToggle("fast");
                    return false;
                });

                $(document).on('click', function(e) {
                    $(".tool-grp").hide("fast");
                });

            });
        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';
         ?>
        <div class="wrapper">
            <div class="container-fluid">

                <?php 
                    require_once 'function/DeptMem.php';
                ?>    

                <div class="row mt-5">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <?php

                                foreach ($mis_members as $member) {
                                    # code...
                                    ?>
                                        <li class="list-group-item  justify-content-between"><?php echo $member['full_name']; ?> 
                                        
                                            <div class="">

                                                <a href="info.php?pet_id=<?php echo $member['pet_id']; ?>">
                                                    <i class="fa fa-address-card" aria-hidden="true"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php
                                }

                            ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row navbar navbar-light red footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
