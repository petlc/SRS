
<script type="text/javascript">

    </script>


<nav class="topbar">
    <div class="topbar-brand">
        <h3 class="font-weight-bold">Service Request System</h3>
    </div>
    <div class="topbar-menu">


        <ul>
            <li><i class="fa fa-2x fa-home fa-2x" onclick="window.location.href = 'index.php?rqst=My Request'"></i></li>
            <?php
            if (strpos($fullname, 'admin.') !== false) {
                // code...
                ?>
                <li class="">
                    <i class="fa fa-file fa-2x badge1" aria-hidden="true" toggle="popover" data-placement="bottom" data-content="Request Pool" onclick="window.location.href = 'requestpool.php'"></i>
                        <span class="badge1 badgeRP" <?php


                                 if($newRequest > 0 ){
                                     echo "data-badge='".$newRequest."'";
                                 }else{

                                 }
                            ?>
                       ></span>
                </li>

                <li class="">
                    <i class="fa fa-cogs fa-2x" data-toggle="dropdown" id="cog-setting"></i>

                        <div class="settings-forms dropdown-menu dropdown-menu-right">
                        
                            <a class="btn btn-success dropdown-item" href="members.php" >Manage Members</a>

                            <a class="btn btn-success dropdown-item" href="requestform.php" >Create Request for</a>

                            <a class="btn btn-success dropdown-item" href="report.php" >Generate Report</a>
                            
                        </div>
                </li>
                <?php
            }else{

                ?>
                <li><i class="fa fas fa-file-signature fa-2x" data-toggle="dropdown" id="forms-dropdown"></i>
                    <div class="request-forms dropdown-menu dropdown-menu-right">
                        <ul class="">
                            <li class=" justify-content-between" toggle="popover" data-placement="bottom" data-content="Request form for Acquisition of IT related items, modification and installation " data-toggle="modal" data-target="#csrf-form">
                                <div class="">

                                    <a href="#"><i class="fa fa-tasks" aria-hidden="true"></i>Computer System Request</a>
                                </div>
                            </li>
                            <li class=" justify-content-between" toggle="popover" data-placement="bottom" data-content="Report form for troubleshooting of IT related equipment" data-toggle="modal" data-target="#cprf-form">
                                <div class="">

                                     <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i>Computer Problem Report</a>
                                </div>
                            </li>
                            <li class=" justify-content-between" toggle="popover" data-placement="bottom" data-content="Request form for data recovery" data-toggle="modal" data-target="#drrf-form">
                                <div class="">

                                     <a href="#"><i class="fa fa-window-restore" aria-hidden="true"></i>Data Recovery Request</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>


                <?php
            }

            //require 'function/core.php';

            //$name = "Willem R. Leonardo";

            $name = $fullname;

            $get = new Report();
            
            $get->query("SELECT COUNT(ic_no) as Total
            from srvcrqst
            where ic_status not in ('Work in Progress', 'Closed', 'Cancelled') and in_charge ='$fullname'");
            $get->execute();
            $row = $get->single();
            $badge = $row['Total'];
            
            /*
            $get->query("select ic_no, ic_status, user_approval, ic_rqstr, assigned_to, checker, in_charge from srvcrqst where ic_status in ('Assigned','Work in Progress', 'Done') and in_charge ='$fullname'");
            
            $get->execute();

            $badge = $get->rowCount();
            /*
            
            

            
            $row = $get->single();

            $badge = $row['Total'];
            */
            $get->query("select
            srvcrqst.ic_no, 
            srvcrqst.ic_status, 
            srvcrqst.user_approval, 
            srvcrqst.ic_rqstr, 
            srvcrqst.assigned_to, 
            srvcrqst.checker, 
            srvcrqst.in_charge, 
            wrklg.ic_id, 
            wrklg.wrklg_date, 
            wrklg.wrklg_personnel, 
            wrklg.wrklg_status 
            from srvcrqst LEFT JOIN wrklg on srvcrqst.ic_no = wrklg.ic_id 
            where wrklg.ic_id in (select ic_no from srvcrqst where srvcrqst.ic_status not in ('Work in Progress', 'Closed', 'Cancelled') and srvcrqst.in_charge ='$fullname' ) 
            and wrklg.wrklg_id in (select max(wrklg.wrklg_id) FROM wrklg where wrklg.ic_id in (select ic_no from srvcrqst where srvcrqst.ic_status not in ('Work in Progress', 'Closed', 'Cancelled') 
            and srvcrqst.in_charge ='$fullname' ) GROUP by wrklg.ic_id) ORDER BY wrklg.wrklg_date DESC limit 10");
            $get->execute();
            ?>

            <li><i class="fa fas fa-bell fa-2x " data-toggle="dropdown" id="notif-dropdown"></i>
                 <span class="badge1 badgeNotif" <?php

                 if ($badge > 0) {
                     // code...
                     echo "data-badge ='".$badge."'";
                 }

                  ?>
                ></span>
                <div class="dropdown-menu dropdown-menu-right notif">
                    <div class="notif-header">
                        <h6><p>Notification</p></h6>
                    </div>
                    <ul class="notif-body">
                        <?php

                        //echo $get->rowCount();

                        //$get->query("Select wrklg.wrklg_id, wrklg.ic_id, wrklg.wrklg_seen, srvcrqst.ic_no, srvcrqst.ic_rqstr, srvcrqst.ic_checker, srvcrqst.ic_approver, srvcrqst.assigned_to, srvcrqst.ic_status from wrklg left JOIN srvcrqst on srvcrqst.ic_no = wrklg.ic_id where wrklg.wrklg_id in ( SELECT MAX(wrklg.wrklg_id) FROM wrklg GROUP BY wrklg.ic_id ) and '$name' in (srvcrqst.ic_checker, srvcrqst.ic_approver, srvcrqst.assigned_to,srvcrqst.ic_rqstr) order by wrklg.wrklg_id desc limit 10");
                        //$get->execute();

                        if ($get->rowCount() > 0) {
                            // code...
                            $rows = $get->resultset();

                            foreach ($rows as $key => $row) {
                                // code...
                                //echo $row['wrklg_seen']."<br>";
                                $ic_no              = $row['ic_no'];
                                $status             = $row['ic_status'];
                                $user_approval      = $row['user_approval'];
                                $rqstr              = $row['ic_rqstr'];
                                $assigned           = $row['assigned_to'];
                                $mis_checker        = $row['checker'];
                                $incharge           = $row['in_charge'];

                                $get->query("select wrklg.wrklg_date from wrklg left join srvcrqst on wrklg.ic_id = srvcrqst.ic_no where wrklg.ic_id = '$ic_no' and srvcrqst.in_charge ='$fullname' order by wrklg_date desc");
                                $get->execute();

                                if ($get->rowCount() > 0) {

                                    $rowlog = $get->single();

                                    $date_create1 = date_create($rowlog['wrklg_date']);
                                    $date_create2 = date_create(date('y-m-d H:i:s'));
                                    $interval = ($date_create2->getTimestamp() - $date_create1->getTimestamp());
                                    $diff=date_diff($date_create1, $date_create2);
                                    $diff_result = $diff->format("%a");

                                    if ($diff_result> 1) {
                                        // code...
                                        $interval = $diff_result." days ago";

                                    }else{
                                        $interval = $diff->format("%i minutes ago");
                                    }

                                    $date_endorsement = "Endorsed ".$rowlog['wrklg_date'];

                                }else{
                                    $date_endorsement = '';
                                }

                                // notify next personnels
                                if ($status == "For Checking" ) {
                                    // code...
                                    //echo "Notify Checker <br>";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "For your Checking $ic_no"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "For Approval") {
                                    // code...
                                    //echo "Notify Approver";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "For your Approval $ic_no"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Returned") {
                                    // code...
                                    //echo "Notify Approver";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "Your request $ic_no is returned please check"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Change Deadline") {
                                    // code...
                                    //echo "Notify Approver";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "MIS is requesting to change deadline of your request $ic_no please check"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Assigned") {
                                    // code...
                                    //echo "Notify Assigned InCharge";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "This request $ic_no assign to you"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Done" and $incharge == $rqstr and $rqstr == $fullname) {
                                    // code...
                                    //echo "Notify Requestor";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "$assigned is now done to your request $ic_no, for your completion"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Done" and empty($mis_checker) and $user_approval == "Completed" ) {
                                    // code...
                                    //echo "Notify Requestor";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "$rqstr has feedback to your done request $ic_no, please see details"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Done" and empty($mis_checker) and $user_approval == "Rejected" ) {
                                    // code...
                                    //echo "Notify Requestor";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "$rqstr has Rejected to your done request $ic_no, please see details"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }elseif ($status == "Done" and !empty($mis_checker)) {
                                    // code...
                                    //echo "Notify Requestor";
                                    ?>

                                    <li class="active" value="view.php?ic=<?php echo $ic_no; ?>" onclick='watsup(this)'>
                                        <div class="notif-body-content">
                                            <div class="notif-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="notif-info">
                                                <h5><?php echo "$assigned is now done to request $ic_no with requestor feedback, for your checking"; ?></h5>
                                            </div>
                                            <div class="notif-time">
                                                <h6><?php echo $date_endorsement; ?></h6>
                                            </div>
                                        </div>

                                    </li>
                                    <?php
                                }

                            }

                        }

                        ?>


                    </ul>
                    <div class="notif-footer">
                        <p>See All Notification</p>
                    </div>
                </div>
            </li>
            <li class="">
                <i class="fa fa-search fa-2x" aria-hidden="true" toggle="popover" data-placement="bottom" data-content="Search" onclick="window.location.href = 'search.php'"></i>
            </li>
            <li class="">
                <i class="fa fas fa-sign-out-alt fa-2x" aria-hidden="true" toggle="popover" data-placement="left" data-content="Log-out" onclick="window.location.href = 'logout.php'"></i>
            </li>
        </ul>
    </div>
</nav>


<?php



 ?>
