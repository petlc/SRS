<?php

require_once 'function/function.php';
require_once 'restriction.php';
require_once 'function/requeststatus.php';
require_once 'function/endorsement-query.php';
unset($_SESSION['status']);

?>
<html>
    <head>
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script>
            $(function () {
              $('[toggle="popover"]').popover({
                  trigger : 'hover'
              })
            });
            $(document).ready(function(){
                $('input[type=radio][name=endorsement]').change(function() {
                    var nchrg = $(this).val();

                    $.get("pool.php", {ic: nchrg}).done(function(data){
                        // Display the returned data in browser
                        $("#result").html(data);
                    });
                    $( "#result" ).on( "click", function() {
                          console.log( $( this ).text() );
                        });
                    //$("#resultDropdown").load("pool.php?ic=" + nchrg);
                    //$("#result").load("pool.php", {ic:nchrg});
                });
            });
        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';

         ?>
        <div class="container-fluid">

            <div class="row body">
                <div class="col-md-1 col-xl-1">

                </div>
                <div class="col-lg-10 content">
                    <h4><i class="fa fa-globe" aria-hidden="true"></i> Endorsement </h4>
                </div>
                <div class="col-md-1 col-xl-1">

                </div>

                <div class="col-md-1 col-xl-1">

                </div>
                <div class="col-md-5">
                    <?php

                    if($department == "MIS" || $department == "MIS (Iloilo)"){
                        echo userRequestcount();
                    }

                    ?>
                </div>
                <div class="col-md-5">
                </div>
                <div class="col-md-1 col-xl-1">

                </div>
                <?php

                require_once 'function/tables.php';

                ?>
            </div>

            <div class="row navbar navbar-light red footer">
                <div class="text-center">&copy; all rights reserved 2016</div>
            </div>
        </div>
    </body>
</html>
