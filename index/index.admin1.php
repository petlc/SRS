<style>

    .card-header{
        background-color: #3f72af;
        color: #dbe2ef;
    }
</style>

<div class="col-md-1 col-lg-1">

</div>
<div class="col-md-10">
    <?php

        //echo $fullname;
        echo userRequestcount($fullname, $role);


    ?>
</div>
<div class="col-md-1 col-lg-1">

</div>
<?php
require_once 'function/endorsement-query.php';
require_once 'function/tables.php';




function userRequestcount($fullname, $role){
    //global $my_assigned, $my_WiP, $my_done, $my_Checking, $role;

    $get_info = new Report();

    $get_info->query("Select ic_status, COUNT(ic_status) as status_count from srvcrqst WHERE assigned_to = '$fullname' and checker = '' and in_charge = '$fullname' GROUP by ic_status");
    $get_info->execute();

    if ($get_info->rowCount() > 0) {
        // code...
        $row_info = $get_info->resultset();
         /*
        print_r($row_info);

        for ($i=0; $i < count($row_info); $i++) {
            // code...
             "$".$row_info[$i]['ic_status'];
            //echo $row_info[$i]['ic_status']."<br>";
        }
        */



        foreach ($row_info as $key => $row_val) {
            // code...
            $stats          = $row_val['ic_status'];
            $stats_count    = $row_val['status_count'];

            if ($stats == "Assigned") {
                // code...
                $my_assigned_count = $stats_count;
                $my_assigned = "<a href='index.php?endorse=Assigned'>$my_assigned_count</a>";
            }

            if ($stats == "Work in Progress") {
                // code...
                $my_WiP_count = $stats_count;
                $my_WiP =  "<a href='index.php?endorse=Work in Progress'>$my_WiP_count</a>";
            }

            if ($stats == "Done") {
                // code...
                $my_done_count = $stats_count;
                $my_done =  "<a href='index.php?endorse=Done'>$my_done_count</a>";
            }
        }



    }else{
        $my_assigned = "<a href='#'>0</a>";
        $my_WiP =  "<a href='#'>0</a>";
        $my_done =  "<a href='#'>0</a>";

    }


    $get_info->query("Select ic_status, COUNT(ic_status) as status_count from srvcrqst WHERE checker = '$fullname' and ic_status = 'Done' and in_charge = '$fullname' GROUP by ic_status");
    $get_info->execute();

    if ($get_info->rowCount() > 0) {

        $row_info = $get_info->single();

        $stats_count = $row_info['status_count'];

        $my_Checking =  "<a href='index.php?endorse=Endorse to Checker'>$stats_count</a>";
    }else{
        $my_Checking = "<a href='#'>0</a>";
    }

    if($role == "Support" || $role == "Member" || $role == "Service Desk" ){
?>
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Assigned</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Assigned">
                        <?php
                            if(isset($my_assigned)){

                                echo $my_assigned;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Work in Progress</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Work in Progress">
                        <?php
                            if(isset($my_WiP)){

                                echo $my_WiP;
                            }else{
                                echo "0";
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>User Approval</h5>
                </div>
                <div class="card-block">
                    <a href="index.php?endorse=Done">
                        <?php
                            if(isset($my_done)){

                                echo $my_done;
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

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5>Assigned</h5>
            </div>
            <div class="card-block">
                <?php
                    if(isset($my_assigned)){

                        echo $my_assigned;
                    }else{
                        echo "0";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5>Work in Progress</h5>
            </div>
            <div class="card-block">
                <?php
                    if(isset($my_WiP)){

                        echo $my_WiP;
                    }else{
                        echo "0";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5>User Approval</h5>
            </div>
            <div class="card-block">
                <?php
                    if(isset($my_done)){

                        echo $my_done;
                    }else{
                        echo "0";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5>For My Checking</h5>
            </div>
            <div class="card-block">
                <?php
                    if(isset($my_Checking)){

                        echo $my_Checking;
                    }else{
                        echo "0";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>
