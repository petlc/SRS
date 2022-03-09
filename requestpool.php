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

                <div class="row page-title">
                    <div class="col-md-10 ">
                        <h4><i class="fa fa-file" aria-hidden="true"></i> Request Pool
                            <?php

                            if (!empty($_GET['status'])) {
                                // code...
                                $prcss_status           = $_GET['status'];
                                $_SESSION['status']     = $_GET['status'];
                            }elseif (!empty($_SESSION['status'])) {
                                // code...
                                $prcss_status           = $_SESSION['status'];
                            }else {
                                // code...
                                $prcss_status = "";
                            }

                            echo $prcss_status;
                            ?></h4>
                    </div>

                    <!--
                    <div class="col-md-2 ">
                        <button type="button" name="button" class="btn btn-primary float-right" data-toggle="dropdown" id="dropdownMenu2" >
                            <h4><i class="fas fa-cog " ></i></h4>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right tool-grp" aria-labelledby="dropdownMenu2">
                            <a class="btn btn-success dropdown-item" href="requestform.php" role="button">Create Request for</a>

                            <a class="btn btn-success dropdown-item" href="report.php" role="button">Generate Report</a>
                        </div>


                    </div>
                        -->


                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary float-right" data-toggle="dropdown" id="dropdownMenu2">
                            <i class="fas fa-users"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right tool-grp members-assigned px-2" aria-labelledby="dropdownMenu2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Member
                                        </th>
                                        <th>
                                            Assigned Count
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        foreach ($members as $member) {
                                            # code...
                                            ?>
                                            <tr>

                                                <td>
                                                    <?php echo $member['assigned_to']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $member['COUNT(*)']; ?>
                                                </td>
                                            
                                            <tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <?php

                
                
                if (!empty($_GET['status'])) {
                    // code...
                    //require_once 'view/requestpool/request.new.prcss.php';
                }else {
                    // code...
                    //require_once 'view/requestpool/request.php';
                    $_GET['status'] = "New Request";
                }
                
                require_once 'view/requestpool/request.status.php';

                require_once 'function/requestpool-query.php';

                require_once 'function/tables.php';

                ?>

            </div>
        </div>
        <div class="row navbar navbar-light red footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
