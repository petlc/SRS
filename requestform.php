<?php

require_once 'function/function.php';
require_once 'restriction.php';
require_once 'function/requeststatus.php';
echo misOnly($department);
unset($_SESSION['endorse']);


?>
<html>
    <head>
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
        <script>

        $(function(){
            /*
            // -- Example Only - Set the date range --
				var d = new Date();
				d.setDate(10);
				$('#start_datetime').val(d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + " 1:00");
				// Example Only - Set the end date to 7 days in the future so we have an actual
				d.setDate(d.getDate() + 7);
				$('#end_datetime').val(d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + " 13:45 ");
				// -- End Example Only Code --
                */
            // Attach a change event to end_time -
            // NOTE we are using '#ID' instead of '*[name=]' selectors in this example to ensure we have the correct field
            $('#start_datetime').appendDtpicker({
                "dateFormat": "YYYY-MM-DD hh:mm",
                //"futureOnly": true,
                "minTime":"06:30",
                "maxTime":"21:30",
                "allowWdays": [1, 2, 3, 4, 5], // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
                //maxDate: $('#end_datetime').val() // when the end time changes, update the maxDate on the start field
            });

            $('#end_datetime').appendDtpicker({
                //minDate: $('.start_datetime').val() // when the start time changes, update the minDate on the end field
                //"minDate": mindate,
                //"futureOnly": true,
                "dateFormat": "YYYY-MM-DD hh:mm",
                "minTime":"06:30",
                "maxTime":"21:30",
                //"minDate":+5,
                "allowWdays": [1, 2, 3, 4, 5]
            });

            $('#end_datetime').change(function(){
                var enddate = $(this).val();
                var startdate =  $('#start_datetime').val();
                //alert(mindate);
                if(startdate == enddate){
                    alert("Note: Same Date is not allowed");
                }

            });

            $('#start_datetime').change(function(){
                var startdate = $(this).val();
                var enddate =  $('#end_datetime').val();
                //alert(mindate);
                if(startdate == enddate){
                    alert("Note: Same Date is not allowed");
                }

            });


            $('#start_datetime').trigger('change');
        });

            $(function () {
              $('[toggle="popover"]').popover({
                  trigger : 'hover'
              })
            });
            $(document).ready(function(){
                $('textarea[name=other_location]').hide();
                $('input[type=radio][name=option_directory]').change(function() {
                    if (this.value == 'Other') {
                        $('textarea[name=other_location]').show();
                    }else{
                        $('textarea[name=other_location]').hide();
                    }
                });

            });

            $(document).ready(function(){
                $("input[name='file[]']").change(function() {
                    var names = [];
                    for (var i = 0; i < $(this).get(0).files.length; ++i) {
                        names.push($(this).get(0).files[i].name);
                    }
                    var file = console.log(names);
                    var n = names.length;
                    alert(names);
                    $(".filename").text(names);
                });
            });

            $(function() {

                //autocomplete
                $(".skills").autocomplete({
                    source: "function/search.php",
                    minLength: 2
                });

            });

            function clickAlert() {
                if(emp.value != ''){
                    //alert(emp.value);
                    var splitted = emp.value.split("-");

                    var fn      = splitted[0];
                    var dept    = splitted[1];

                    document.getElementById("FN").innerHTML = fn;
                    document.getElementById("FN-val").value = fn;
                    document.getElementById("DEPT").innerHTML = dept;
                    document.getElementById("DEPT-val").value = dept;

                } else {
                    alert('wala value');
                }

            }



            $(document).ready(function(){
                $('form[name=qaFor]').submit(function () {
                    var StartDate = $('input[name=start_date]').val();
                    var EndDate   = $('input[name=end_date]').val();

                    var toReturn = true;
                    if (StartDate == EndDate) {
                        alert("Same time, change it "+StartDate+" "+EndDate);
                        $('input[name=end_date]').focus();
                        toReturn = false;
                    }else if( StartDate > EndDate){
                        alert("Same time, change it "+StartDate+" is Greater Than "+EndDate);
                        $('input[name=end_date]').focus();
                        toReturn = false;
                    }

                    return toReturn;
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
                <?php

                  if (!isset($_GET['form'])) {
                    # code...
                 ?>
                <div class="col-xl-2">
                </div>
                <div class="col-xl-8 content mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-database" aria-hidden="true"></i> Create Request for: </h4>
                        </div>
                        <div class="card-block ">
                            <form method="post">
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-4 text-right">
                                        <label class="col-form-label " for="skills">Employee :</label>
                                    </div>
                                    <div class="col-lg-5 col-5 text-right">
                                        <input class="form-control skills" id="emp" name="rqst4">
                                    </div>
                                    <div class="col-lg-3 col-3 text-right">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-3">
                                        <button type="submit" class="btn btn-primary" name="submit" value="qa">QA</button>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <button type="submit" class="btn btn-primary" name="submit" value="csr">CSR</button>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <button type="submit" class="btn btn-primary" name="submit" value="cpr">CPR</button>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <button type="submit" class="btn btn-primary" name="submit" value="drr">DRR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-xl-2">
                </div>
                <?php

                }

                 ?>
                <div class=" col-xl-2 col-0">
                </div>
                <div class=" col-xl-8 col-12 content">
                    <?php

                    require_once 'forms/forms.php';
                    require_once 'view/requestforms.php';

                    if(isset($_POST['submit'])){

                        if(!empty($_POST['rqst4'])){

                            $rqstr = $_POST['rqst4'];
                            $rqst4 = explode(" - ",$_POST['rqst4']);

                            if(count($rqst4)> 1){

                                $rqst4name = $rqst4[0];
                                $rqst4dept = $rqst4[1];

                                $department = $rqst4dept;
                                require_once 'function/endorsement.php';

                                $rqst4checker = array();

                                $row = $checker_avail->resultset();
                                for ($r4c=0; $r4c < $checker_avail->rowCount(); $r4c++) {
                                    // code...
                                    $full_name  =   $row[$r4c]['full_name'];
                                    $pet_id     =   $row[$r4c]['pet_id'];

                                    if (empty($row[$r4c]['email_account'])) {
                                        // code...
                                        $email      =  "No Email";
                                    }else {
                                        $email      =  $row[$r4c]['email_account'];
                                    }

                                    $rqst4checker[] = "<option value='".$full_name."-".$pet_id."-".$email."'>".$full_name."</option>";
                                }

                                $rqst4approver = array();
                                $row = $approver_avail->resultset();
                                for ($r4a=0; $r4a < $approver_avail->rowCount(); $r4a++) {
                                    // code...
                                    $full_name  =   $row[$r4a]['full_name'];
                                    $pet_id     =   $row[$r4a]['pet_id'];

                                    if (empty($row[$r4c]['email_account'])) {
                                        // code...
                                        $email      =  "No Email";
                                    }else {
                                        $email      =  $row[$r4a]['email_account'];
                                    }

                                    $rqst4approver[] = "<option value='".$full_name."-".$pet_id."-".$email."'>".$full_name."</option>";
                                }

                                if($_POST['submit'] == "csr"){

                                    echo csrFor($rqstr, $rqst4checker, $rqst4approver);

                                }elseif($_POST['submit'] == "cpr"){

                                    echo cprFor($rqstr, $rqst4checker, $rqst4approver);

                                }elseif($_POST['submit'] == "drr"){

                                    echo drrFor($rqstr, $rqst4checker, $rqst4approver);

                                }elseif($_POST['submit'] == "qa"){

                                    echo qaFor($rqstr, $rqst4checker, $rqst4approver);

                                }else{

                                }

                            }else{
                                echo"<script>
                                    alert('Please wait for the suggest names');
                                </script>";
                            }

                        }else{
                            echo"<script>
                                alert('Please get the employee name');
                                </script>";
                        }
                    }else{

                        //echo "<div class='empty'></div> <br>";

                        //echo "<div class='content'></div>";
                    }
                    ?>
                </div>
                <div class=" col-xl-2 col-0">
                </div>

            </div>

        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
