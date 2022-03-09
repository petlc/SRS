<style>

    .card-header{
        background-color: #3f72af;
        color: #dbe2ef;
    }
</style>

<div class="row">

    <div class="col-md-12">
        <?php

            //echo $fullname;
            echo userRequestcount($fullname, $role);


        ?>
    </div>

</div>
<?php
require_once 'function/endorsement-query.php';
require_once 'function/tables.php';




function userRequestcount($fullname, $role){
    //global $my_assigned, $my_WiP, $my_done, $my_Checking, $role;
    //echo "$fullname";

    $my_assigned = statusCount($fullname, 'Assigned');
    $my_WiP      = statusCount($fullname, 'Work in Progress');
    $my_done     = statusCount($fullname, 'Done');
    $my_Checking = checkingCount($fullname, 'MIS Checker');
    $no_feedback = forUserApproval($fullname, "UserApproval");

    if($role == "Support" || $role == "Member" || $role == "Service Desk"){
?>
    <div class="row">

        <div class="col-md-3 col-xl-3 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>Assigned</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Assigned">
                        <?php
                            if(!empty($my_assigned)){

                                echo $my_assigned;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>Work in Progress</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Work in Progress">
                        <?php
                            if(!empty($my_WiP)){

                                echo $my_WiP;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>User Approval</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Done">
                        <?php
                            if(!empty($my_done)){

                                echo $my_done;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>No Feedback</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=UserApproval">
                        <?php
                            if(!empty($no_feedback)){

                                echo $no_feedback;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
    }else{
?>
<div class="row request">

    <div class="col-md-3 col-xl-3 mb-5">
        <div class="card">
            <div class="card-header">
                <h5>Assigned</h5>
            </div>
            <div class="card-block">
                <?php echo $my_assigned; ?>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 mb-5">
        <div class="card">
            <div class="card-header">
                <h5>Work in Progress</h5>
            </div>
            <div class="card-block">
                <?php echo $my_WiP; ?>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 mb-5">
        <div class="card">
            <div class="card-header">
                <h5>User Approval</h5>
            </div>
            <div class="card-block">
                <?php echo $my_done; ?>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-xl-3 mb-5">
        <div class="card">
            <div class="card-header">
                <h5>For My Checking</h5>
            </div>
            <div class="card-block">
                <?php echo $my_Checking; ?>
            </div>
        </div>
    </div>
</div>
<?php
    }
}

function statusCount($fullname, $stats){
    $get_count = new Report();

    $get_count->query("Select ic_status from srvcrqst WHERE ic_status ='$stats' and assigned_to = '$fullname' and checker = '' and in_charge = '$fullname'");
    $get_count->execute();

    if ( $get_count->rowCount() > 0 ) {
        // code...
        $count  =   $get_count->rowCount();
        $val    =   "<a href='index.php?endorse=$stats'>$count</a>";
    }else{
        $val    =   "<a href='#'>0</a>";
    }


    return $val;
}

function checkingCount($fullname, $stats){
    $get_count = new Report();

    $get_count->query("Select ic_status from srvcrqst WHERE ic_status ='Done' and checker = '$fullname' and in_charge = '$fullname'");
    $get_count->execute();

    if ( $get_count->rowCount() > 0 ) {
        // code...
        $count  =   $get_count->rowCount();
        $val    =   "<a href='index.php?endorse=$stats'>$count</a>";
    }else{
        $val    =   "<a href='#'>0</a>";
    }


    return $val;
}

function forUserApproval($fullname, $stats){
    $get_count = new Report();

    $get_count->query("Select ic_status from srvcrqst WHERE ic_status ='Done' and assigned_to = '$fullname' and user_approval = '' and in_charge != '$fullname'");
    $get_count->execute();

    if ( $get_count->rowCount() > 0 ) {
        // code...
        $count  =   $get_count->rowCount();
        $val    =   "<a href='index.php?endorse=$stats'>$count</a>";
    }else{
        $val    =   "<a href='#'>0</a>";
    }


    return $val;
}
?>
