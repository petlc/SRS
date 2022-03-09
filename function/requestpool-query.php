<?php

$start=0;
$limit=10;

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $start=($id-1)*$limit;
}else{
    $id=1;
}

if(isset($_GET['status'])){
    $status             = $_GET['status'];
    $_SESSION['status'] = $_GET['status'];
     unset($_SESSION['searcsrvcrqsth']);

    if(isset($_GET['prcss'])){
        $prcss              = $_GET['prcss'];
        $_SESSION['prcss']  = $_GET['prcss'];
    }else{
        $prcss              = "";
        unset($_SESSION['prcss']);
    }

    if(isset($_GET['deadline'])){
        $deadline               = $_GET['deadline'];
        $_SESSION['deadline']   = $_GET['deadline'];
    }else{
        $deadline               = "";
        unset($_SESSION['deadline']);
    }

    if(isset($_GET['request'])){
        $rqst                   = $_GET['request'];
        $_SESSION['request']    = $_GET['request'];
    }else{
        $rqst              = "";
        unset($_SESSION['request']);
    }

}elseif(isset($_SESSION['status'])){

    $status = $_SESSION['status'];

    if(isset($_SESSION['prcss'])){
        $prcss = $_SESSION['prcss'];
    }

    if(isset($_SESSION['deadline'])){
        $deadline = $_SESSION['deadline'];
    }

    if(isset($_SESSION['request'])){
        $rqst = $_SESSION['request'];
    }
}else {
    // code...
    $status = "";
}



if(empty($deadline) and empty($prcss) and empty($rqst) and !empty($status)){

    //echo "1";

    $querylist = "Select * from srvcrqst where ic_status ='$status' order by ic_id DESC LIMIT $start, $limit";

    $querypage = "Select * from srvcrqst where ic_status ='$status' order by ic_id DESC ";

}elseif(!empty($rqst)){

    //echo "2";

    $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_rqst = '$rqst' order by ic_id DESC LIMIT $start, $limit";

    $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_rqst = '$rqst' order by ic_id DESC ";

}elseif(empty($deadline) and !empty($prcss)){

    //echo "3";

    $querylist = "Select * from srvcrqst where ic_status ='$status' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

    $querypage = "Select * from srvcrqst where ic_status ='$status' and prcss_no like '%$prcss%' order by ic_id DESC ";

}elseif(!empty($deadline)){

    //echo "3";

    switch($deadline){

        case"Ahead";

            $date_now = date('y-m-d');

            $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date > '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date > '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

        case"Ontime";

            $date_now = date('y-m-d');

            $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date like '%$date_now%' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date like '%$date_now%' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

        case"Delay";

            $date_now = date('y-m-d');

            $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date < '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_rqst_date < '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

    }

}else{

    $querylist = "Select * from srvcrqst where ic_status in('New Request', 'Assigned', 'Work in Progress') order by ic_id DESC LIMIT $start, $limit";

    $querypage = "Select * from srvcrqst where ic_status in('New Request', 'Assigned', 'Work in Progress') order by ic_id DESC ";

}


/*
function deadLine($status, $prcss, $deadline){

    switch($deadline){

        case"Ahead";

            $date_now = date('y-m-d');

            $querylist = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date > '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date > '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

        case"Ontime";

            $date_now = date('y-m-d');

            $querylist = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date like '%$date_now%' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date like '%$date_now%' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

        case"Delay";

            $status = "Work in Progress";

            $querylist = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date < '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from ic_2017 where ic_status ='$status' and ic_rqst_date < '$date_now' and prcss_no like '%$prcss%' order by ic_id DESC ";

        break;

        default:

            $querylist = "Select * from ic_2017 where ic_status ='$status' order by ic_id DESC LIMIT $start, $limit";

            $querypage = "Select * from ic_2017 where ic_status ='$status' order by ic_id DESC ";

        break;

    }

}
*/
?>
