<?php
require_once 'function/function.php';
require_once 'restriction.php';
require_once 'function/requeststatus.php';
require_once 'function/buttons.php';
require_once 'function/endorsement.php';
//require_once 'function/editforms.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
    </head>
    <body>
        <div class="row">
            <div class=" col-12" id="waitani">
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
        </div>
        <?php

        require_once 'function/topbar.php';
        //echo getenv("username");
         ?>


        <div class="container-fluid">

            <div class="row content">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-xl-8 mb-5">
                            <?php
                            require_once 'view/view.info.php';

                            if (!empty($prcss_no)) {
                                // code...

                                require_once 'view/request_dtls.php';
                            }else{
                                echo "<script>
                                        alert('Request not found or deleted');
                                        window.location.href = 'index.php';
                                    </script>";
                            }

                            ?>
                        </div>


                        <!-- Work log -->
                        <div class="col-md-12 col-xl-4 mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Work log</h4>
                                </div>
                                <div class="worklog1">
                                    <?php
                                    /*
                                    //$view_wrklg  = new workLog();
                                    //echo $view_wrklg->viewWorklog($ic_no);

                                    $wrklgs     = viewWorklog($ic_no);
                                    $wrklg      = array_filter(explode(";",$wrklgs));
                                    $wrklg_no   = count($wrklg);
                                    */
                                    $wrklg_dtls = viewWorklog($ic_no);

                                    for($i=0;$i<count($wrklg_dtls);$i++){

                                    ?>
                                    <div class="card">
                                        <div class="card-block">
                                            <?php echo $wrklg_dtls[$i][2]; ?>
                                        </div>
                                        <div class="card-footer">
                                            <?php
                                            if($wrklg_dtls[$i][1] == "MIS Checker"){
                                                echo "Endorse to <b>".$wrklg_dtls[$i][1]."</b> by ".$wrklg_dtls[$i][3]."<br>".date('m/d/Y H:i', strtotime($wrklg_dtls[$i][0]));
                                            }elseif($wrklg_dtls[$i][1] == "Endorse to Checker"){
                                                echo $wrklg_dtls[$i][1]." <b>". $wrklg_dtls[$i][4]."</b> by ".$wrklg_dtls[$i][3]."<br>".date('m/d/Y H:i', strtotime($wrklg_dtls[$i][0]));
                                            }elseif($wrklg_dtls[$i][1] == "Endorse to Approver"){
                                                echo $wrklg_dtls[$i][1]." <b>". $wrklg_dtls[$i][4]."</b> by ".$wrklg_dtls[$i][3]."<br>".date('m/d/Y H:i', strtotime($wrklg_dtls[$i][0]));
                                            }elseif($wrklg_dtls[$i][1] == "Assigned"){
                                                echo " <b>".$wrklg_dtls[$i][1]."</b> to ". $wrklg_dtls[$i][4]." by ".$wrklg_dtls[$i][3]."<br>".date('m/d/Y H:i', strtotime($wrklg_dtls[$i][0]));
                                            }else{
                                                echo "<b>".$wrklg_dtls[$i][1]."</b> by ".$wrklg_dtls[$i][3]."<br>".date('m/d/Y H:i', strtotime($wrklg_dtls[$i][0]));

                                            }


                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
    <?php


    require_once 'view/pop-ups.php';
    require_once 'view/editforms.php';

    require_once 'view/requestforms.php';
     ?>

</html>
