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
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <?php

                                if ($_GET['pet_id']) {
                                    # code...
                                    $pet_id = $_GET['pet_id']."-admin";
                                    $infos = getInfo($pet_id);
                                    

                                    if ($infos) {
                                        # code...
                                    }else {
                                        # code...
                                        
                                        $pet_id = $_GET['pet_id'];
                                        $infos = getInfo($pet_id);

                                        ?>

                                            <div class="card">
                                                <div class="card-header">
                                                    Admin Account Registration
                                                </div>
                                                <div class="card-body pt-3">
                                                    <form  method="post">

                                                        <div class="form-group">
                                                            <div class="row my-3">
                                                                <label class="col-4 col-form-label text-right font-weight-bold">PET ID :</label>
                                                                <label class="col-8 col-form-label text-left"><?php echo $infos[0]['pet_id']."-admin"; ?></label>
                                                            </div>
                                                            <div class="row my-3">
                                                                <label class="col-4 col-form-label text-right font-weight-bold">Name :</label>
                                                                <label class="col-8 col-form-label text-left"><?php echo "admin.".$infos[0]['full_name']; ?></label>
                                                            </div>
                                                            <div class="row my-3">
                                                                <label class="col-4 col-form-label text-right font-weight-bold">Role :</label>
                                                                <select name="role" id="" class="col-4 form-control " >
                                                                    <option value=""></option>
                                                                    <option value="Support">Support</option>
                                                                    <option value="SRS Checker">Checker</option>
                                                                    <option value="SRS Approver">Approver</option>
                                                                    <option value="Service Desk"> Service Desk</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="row my-3">
                                                                <label class="col-4 col-form-label text-right font-weight-bold"></label>

                                                                <input type="hidden" name="pet_id" value="<?php echo $infos[0]['pet_id']."-admin"; ?>">
                                                                <input type="hidden" name="full_name" value="<?php echo "admin.".$infos[0]['full_name']; ?>">
                                                                <input type="hidden" name="first_name" value="<?php echo $infos[0]['first_name']; ?>">
                                                                <input type="hidden" name="middle_initial" value="<?php echo $infos[0]['middle_initial']; ?>">
                                                                <input type="hidden" name="last_name" value="<?php echo $infos[0]['last_name']; ?>">
                                                                <input type="hidden" name="department" value="<?php echo $infos[0]['department']; ?>">
                                                                <input type="hidden" name="branch" value="<?php echo $infos[0]['branch']; ?>">
                                                                
                                                                <button type="submit" class="btn btn-primary col-4 " name="save">Save</button>   
                                                            </div>
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        


                                        <?php
                                    }
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
