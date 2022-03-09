<style>
    .request{
        padding: 0 15px;
    }
    .request div a{
        display: block;
        padding: 10px;
    }
    .request div a:hover{
        background-color: #eceeef;
    }
    .request .col-md-3{
        padding: 0;
    }

    .card-header{
        background-color: #3f72af;
        color: #dbe2ef;
    }
</style>

<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header red">
                <h5>Request Monitoring</h5>
            </div>
            <div class="card-block request">
                <div class="row ">
                    <?php

                        $get_info = new Report();

                        $get_info->query("Select ic_status, count(ic_status) as status_count from srvcrqst where ic_rqstr='$fullname' GROUP by ic_status");
                        $get_info->execute();

                        if ($get_info->rowCount() > 0) {
                            // code...
                            $row_info = $get_info->resultset();

                            foreach ($row_info as $key => $row_val) {

                                //$stats          = $row_val['ic_status'];
                                //$stats_count    = $row_val['status_count'];

                                switch ($row_val['ic_status']) {

                                    case 'Newly Created':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];

                                        break;
                                    case 'For Checking':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];

                                        break;
                                    case 'For Approval':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;
                                    case 'New Request':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;
                                    case 'Assigned':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;
                                    case 'Work in Progress':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;
                                    case 'Done':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;
                                    case 'Closed':
                                        // code...
                                        $stats          = $row_val['ic_status'];
                                        $stats_count    = $row_val['status_count'];
                                        break;

                                    default:
                                        // code...
                                        $stats = "";
                                        $stats_count = "";
                                        break;
                                }

                                if ($stats == "Closed") {
                                    // code...
                                    ?>
                                        <div class="col-md-3 col-xl-3">
                                            <a href="index.php?rqst=<?php echo $stats; ?>">
                                                <div class="">
                                                    <?php echo $stats; ?>
                                                </div>
                                                <div class="">
                                                    <?php echo $stats_count; ?>
                                                </div>
                                            </a>
                                    </div>

                                    <?php
                                }elseif (!empty($stats)) {
                                    // code...
                                    ?>
                                    <div class="col-md-3 col-xl-3">
                                        <a href="index.php?rqst=<?php echo $stats; ?>">
                                            <div class="">
                                                <?php echo $stats; ?>
                                            </div>
                                            <div class="">
                                                <?php echo $stats_count; ?>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                }

                            }
                        }

                        $get_checking = new Report();
                        $get_checking->query("SELECT ic_status, count(*) total from srvcrqst where ic_checker='$fullname' and ic_status ='For Checking'");
                        $get_checking->execute();

                        if ($get_checking->rowCount() > 0) {
                            // code...
                            $row_info = $get_checking->single();

                            $stats          = "For My Checking";
                            $stats_count    = $row_info['total'];

                            if ($stats_count > 0) {
                                // code...
                                ?>
                                <div class="col-md-3 col-xl-3">
                                    <a href="index.php?rqst=<?php echo $stats; ?>">
                                        <div class="">
                                            <?php echo $stats; ?>
                                        </div>
                                        <div class="">
                                            <?php echo $stats_count; ?>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }else{

                            }

                        }
                        $get_checked = new Report();
                        $get_checked->query("SELECT ic_status, count(*) total from srvcrqst where ic_checker='$fullname' and ic_status !='For Checking'");
                        $get_checked->execute();

                        if ($get_checked->rowCount() > 0) {
                            // code...
                            $row_info = $get_checked->single();

                            $stats          = "My Checked";
                            $stats_count    = $row_info['total'];

                            if ($stats_count > 0) {
                                // code...
                                ?>
                                <div class="col-md-3 col-xl-3">
                                    <a href="index.php?rqst=<?php echo $stats; ?>">
                                        <div class="">
                                            <?php echo $stats; ?>
                                        </div>
                                        <div class="">
                                            <?php echo $stats_count; ?>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }else{

                            }

                        }

                        $get_approval = new Report();
                        $get_approval->query("SELECT ic_status, count(*) total from srvcrqst where ic_approver='$fullname' and ic_status ='For Approval'");
                        $get_approval->execute();

                        if ($get_approval->rowCount() > 0) {
                            // code...
                            $row_info = $get_approval->single();

                            $stats          = "For My Approval";
                            $stats_count    = $row_info['total'];

                            if ($stats_count > 0) {
                                // code...
                                ?>
                                <div class="col-md-3">
                                    <a href="index.php?rqst=<?php echo $stats; ?>">
                                        <div class="">
                                            <?php echo $stats; ?>
                                        </div>
                                        <div class="">
                                            <?php echo $stats_count; ?>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }else{

                            }
                        }
                        $get_approved = new Report();
                        $get_approved->query("SELECT ic_status, count(*) total from srvcrqst where ic_approver='$fullname' and ic_status !='For Approval'");
                        $get_approved->execute();

                        if ($get_approved->rowCount() > 0) {
                            // code...
                            $row_info = $get_approved->single();

                            $stats          = "My Approved";
                            $stats_count    = $row_info['total'];

                            if ($stats_count > 0) {
                                // code...
                                ?>
                                <div class="col-md-3 col-xl-3">
                                    <a href="index.php?rqst=<?php echo $stats; ?>">
                                        <div class="">
                                            <?php echo $stats; ?>
                                        </div>
                                        <div class="">
                                            <?php echo $stats_count; ?>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }else{

                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'view/requestforms.php';

    $start=0;
    $limit=10;

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $start=($id-1)*$limit;
    }else{
        $id=1;
    }

    if(!empty($_GET['rqst'])){
        $status             = $_GET['rqst'];
        $_SESSION['rqst']   = $_GET['rqst'];

    }elseif(!empty($_SESSION['rqst'])){
        $status             = $_SESSION['rqst'];

    }else{

        unset($_SESSION['rqst']);
    }
    if(!empty($status)){
         switch ($status) {

        case 'For My Checking':
            // code...
            $querylist = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status ='For Checking' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status ='For Checking' order by ic_id DESC ";

            break;

        case 'For My Approval':
            // code...
            $querylist = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status ='For Approval' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status ='For Approval' order by ic_id DESC ";

            break;

        case 'My Checked':
            // code...
            $querylist = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status !='For Checking' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status !='For Checking' order by ic_id DESC ";

            break;

        case 'My Approved':
            // code...
            $querylist = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status !='For Approval' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status !='For Approval' order by ic_id DESC ";

            break;

        case 'Newly Created':
        case 'For Approval':
        case 'For Checking':
        case 'New Request':
        case 'Assigned':
        case 'Work in Progress':
        case 'Done':
        case 'Closed':
            // code...

            $querylist = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status = '$status' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status = '$status' order by ic_id DESC ";

            break;



        default:
            // code...
            $status = "My Request";

            $querylist = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC ";

            break;
        }
    }else{

        $status = "My Request";

        $querylist = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC ";

    }

    /*else{
        $status = "My Request";

        $start=0;
        $limit=10;

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $start=($id-1)*$limit;
        }else{
            $id=1;
        }

        $querylist = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status != 'Closed' order by ic_id DESC ";
    }


    if ($status == "For My Checking") {
        // code...
        $querylist = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status ='For Checking' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status ='For Checking' order by ic_id DESC ";

    }elseif ($status == "For My Approval") {
        // code...
        $querylist = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status ='For Approval' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status ='For Approval' order by ic_id DESC ";

    }elseif ($status == "My Checked") {
        // code...
        $querylist = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status !='For Checking' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_checker = '$fullname' and ic_status !='For Checking' order by ic_id DESC ";

    }elseif ($status == "My Approved") {
        // code...
        $querylist = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status !='For Approval' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_approver = '$fullname' and ic_status !='For Approval' order by ic_id DESC ";

    }else{

        $querylist = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status = '$status' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_rqstr = '$fullname' and ic_status = '$status' order by ic_id DESC ";

        $status = "My ".$status;
    }
    */
    require_once 'function/tables.php';
?>
