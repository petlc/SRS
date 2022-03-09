<?php

require_once 'function/function.php';
require_once 'restriction.php';
require_once 'function/report/members/members.php';
require_once 'function/report/report-query.php';
require_once 'function/requeststatus.php';
echo misOnly($department);

/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();

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
        <link rel="stylesheet" type="text/css"href="css/topbar-notif.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script src="js/view.js"></script>
        <script src="js/requestform.js"></script>
        <script src="js/topbar.js"></script>
        <script>
            $(document).ready(function(){
                $('optgroup[label=Head]').hide();
                $('optgroup[label=Branch]').hide();
                $('select[name=office]').change(function(){
                    if (this.value == 'HO') {
                        $('optgroup[label=Head]').show(); //optgroup label="ho_member"
                        $('optgroup[label=Branch]').hide();
                    }else if (this.value == 'BO'){
                        $('optgroup[label=Branch]').show(); //optgroup label="ho_member"
                        $('optgroup[label=Head]').hide();
                    }else{
                        $('optgroup[label=Head]').hide();
                        $('optgroup[label=Branch]').hide();
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';

         ?>
        <div class="container-fluid">
            <?php
             ?>

            <div class="row content">

                <div class="col-md-1">

                </div>
                <div class="col-md-5 col-sm-5 content">
                    <form method="get">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Monthly Status </h4>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">Month </label>
                                            <select class="form-control col-md-9" name="month">
                                                <option value=""></option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                                <option value="All">All</option>
                                            </select>

                                            <label class="col-md-3 col-form-label mt-3">Year </label>
                                            <select class="form-control col-md-9 mt-3" name="year">
                                                <option value=""></option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>

                                            <label class="col-md-3 col-form-label mt-3">Site </label>
                                            <select class="form-control col-md-9 mt-3" name="site" >
                                                <option value=""></option>
                                                <option value="HO">Head Office</option>
                                                <option value="BO">Branch Office</option>
                                            </select>

                                            <div class="col-md-3 mt-3">
                                            </div>
                                            <button type="submit" class="btn btn-success col-md-9 mt-3" name="get_report">Get Report</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 content">
                    <form method="get">
                        <div class="card">
                            <div class="card-header">
                                <h4>Member Stats</h4>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 ">

                                        <div class="row">
                                            <label class="col-md-3 col-form-label">Year </label>
                                            <select class="form-control col-md-9" name="work_year">
                                                <option value=""></option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>
                                            <label class="col-md-3 col-form-label mt-3">Site </label>
                                            <select class="form-control col-md-9 mt-3" name="office">
                                                <option value=""></option>
                                                <option value="HO">Head Office</option>
                                                <option value="BO">Branch Office</option>
                                            </select>
                                            <label class="col-md-3 col-form-label mt-3">Member </label>
                                            <select class="form-control col-md-9 mt-3" name="member">

                                                <option value=""></option>
                                                <optgroup label="Head">
                                                    <?php echo memberHO(); ?>
                                                </optgroup>
                                                <optgroup label="Branch">
                                                    <?php echo memberBO(); ?>
                                                </optgroup>

                                            </select>

                                            <div class="col-md-3 mt-3">
                                            </div>
                                            <button type="submit" class="btn btn-success col-md-9 mt-3" name="get_stats">Get Stats</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-12 content">
                    <form method="post">
                        <?php require_once 'function/report/report-details.php'; ?>
                    </form>
                </div>
            </div>

        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved <?php  echo date('Y') ?> </div>
        </div>
    </body>
</html>
