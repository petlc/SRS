<?php

$start=0;
$limit=10;

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $start=($id-1)*$limit;
}else{
    $id=1;
}

if(isset($_GET['adv_search'])){


    unset($_SESSION['status']);

    if(empty($_GET['name']) && empty($_GET['department']) && empty($_GET['control_no']) && empty($_GET['assigned_mis']) && empty($_GET['look_for']) && empty($_GET['prif_no']) && empty($_GET['request_category']) ){

        echo emptyAdv();

    }else{

        $name           = $_GET['name'];
        $sdeparment     = $_GET['department'];
        $control_no     = $_GET['control_no'];
        $assigned_mis   = $_GET['assigned_mis'];
        $look_for       = $_GET['look_for'];
        $prif_no        = $_GET['prif_no'];
        $rqst_category  = $_GET['request_category'];

        $_SESSION['name']           = $_GET['name'];
        $_SESSION['sdepartment']    = $_GET['department'];
        $_SESSION['control_no']     = $_GET['control_no'];
        $_SESSION['assigned_mis']   = $_GET['assigned_mis'];
        $_SESSION['look_for']       = $_GET['look_for'];
        $_SESSION['prif_no']        = $_GET['prif_no'];
        $_SESSION['request_category']  = $_GET['request_category'];

        //echo $_SESSION['control_no'];

        unset($_SESSION['search']);

        $searchAdv_result = searchAdv($name, $sdeparment, $control_no, $assigned_mis, $look_for, $prif_no, $rqst_category, $start, $limit);
    }



}elseif(isset($_SESSION['adv_search'])){



    if(empty($_SESSION['name']) && empty($_SESSION['sdepartment']) && empty($_SESSION['control_no']) && empty($_SESSION['assigned_mis']) && empty($_SESSION['look_for']) && empty($_SESSION['prif_no']) && empty($_SESSION['request_category'])){

        echo emptyAdv();

    }else{

        $name           = $_SESSION['name'];
        $sdeparment     = $_SESSION['sdepartment'];
        $control_no     = $_SESSION['control_no'];
        $assigned_mis   = $_SESSION['assigned_mis'];
        $look_for       = $_SESSION['look_for'];
        $prif_no        = $_SESSION['prif_no'];
        $rqst_category  = $_SESSION['request_category'];

        $searchAdv_result = searchAdv($name, $sdeparment , $control_no, $assigned_mis, $look_for, $prif_no, $rqst_category, $start, $limit);

    }

}




function search($look_for, $start, $limit){


    $querylist = "Select * from srvcrqst where (`ic_no` like '%$look_for%' or `ic_dtls` like '%$look_for%' or `prcss_no` like '%$look_for%') order by ic_id DESC LIMIT $start, $limit";

    $querypage = "Select * from srvcrqst where (`ic_no` like '%$look_for%' or `ic_dtls` like '%$look_for%' or `prcss_no` like '%$look_for%') order by ic_id DESC ";

    $_SESSION['search'] = $look_for;

    return array($querylist, $querypage, $_SESSION['search']);
}

function searchAdv($name, $deparment, $control_no, $assigned_mis, $look_for, $prif_no, $rqst_category, $start, $limit){

    $querylist      = "";
    $querypage      = "";

    $status = "Search Advance Result";

    if(!empty($name) ){
        $querylist = "Select * from srvcrqst where ic_rqstr like '%$name%' ";

        $querypage = "Select * from srvcrqst where ic_rqstr like '%$name%' ";

        if(!empty($deparment)){
            $querylist .= "and ic_rqstr_dprtmnt like '%$deparment%'";

            $querypage .= "and ic_rqstr_dprtmnt like '%$deparment%'";
        }

        if(!empty($control_no)){
            $querylist .= "and ic_no like '%$control_no%' or `prcss_no` like '%$control_no%'";

            $querypage .= "and ic_no like '%$control_no%' or `prcss_no` like '%$control_no%'";
        }

        if(!empty($assigned_mis)){
            $querylist .= "and assigned_to like '%$assigned_mis%'";

            $querypage .= "and assigned_to like '%$assigned_mis%'";
        }

        if(!empty($look_for)){
            $querylist .= "and ic_dtls like '%$look_for%'";

            $querypage .= "and ic_dtls like '%$look_for%'";
        }
        
        if(!empty($prif_no)){
            $querylist .= "and ic_prif like '%$prif_no%'";

            $querypage .= "and ic_prif like '%$prif_no%'";
        }
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }

    }elseif(!empty($deparment)){

        $querylist = "Select * from srvcrqst where ic_rqstr_dprtmnt like '%$deparment%'";

        $querypage = "Select * from srvcrqst where ic_rqstr_dprtmnt like '%$deparment%'";

        if(!empty($control_no)){
            $querylist .= "and ic_no like '%$control_no%' or `prcss_no` like '%$control_no%'";

            $querypage .= "and ic_no like '%$control_no%' or `prcss_no` like '%$control_no%'";
        }

        if(!empty($assigned_mis)){
            $querylist .= "and assigned_to like '%$assigned_mis%'";

            $querypage .= "and assigned_to like '%$assigned_mis%'";
        }

        if(!empty($look_for)){
            $querylist .= "and ic_dtls like '%$look_for%'";

            $querypage .= "and ic_dtls like '%$look_for%'";
        }
        
        if(!empty($prif_no)){
            $querylist .= "and ic_prif like '%$prif_no%'";

            $querypage .= "and ic_prif like '%$prif_no%'";
            
        }
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }

    }elseif(!empty($control_no)){

        $querylist = "Select * from srvcrqst where ic_no like '%$control_no%' or prcss_no like '%$control_no%'";

        $querypage = "Select * from srvcrqst where ic_no like '%$control_no%' or prcss_no like '%$control_no%'";

        if(!empty($assigned_mis)){

            $querylist .= "and assigned_to like '%$assigned_mis%'";

            $querypage .= "and assigned_to like '%$assigned_mis%'";

        }

        if(!empty($look_for)){
            $querylist .= "and ic_dtls like '%$look_for%'";

            $querypage .= "and ic_dtls like '%$look_for%'";
        }
        
        if(!empty($prif_no)){
            $querylist .= "and ic_prif like '%$prif_no%'";

            $querypage .= "and ic_prif like '%$prif_no%'";
        }
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }

    }elseif(!empty($assigned_mis)){

        $querylist = "Select * from srvcrqst where assigned_to like '%$assigned_mis%'";

        $querypage = "Select * from srvcrqst where assigned_to like '%$assigned_mis%'";

        if(!empty($look_for)){
            $querylist .= "and ic_dtls like '%$look_for%'";

            $querypage .= "and ic_dtls like '%$look_for%'";
        }
        
        if(!empty($prif_no)){
            $querylist .= "and ic_prif like '%$prif_no%'";

            $querypage .= "and ic_prif like '%$prif_no%'";
        }
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }

    }elseif(!empty($look_for)){

        $querylist = "Select * from srvcrqst where ic_dtls like '%$look_for%'";

        $querypage = "Select * from srvcrqst where ic_dtls like '%$look_for%'";
        
        if(!empty($prif_no)){
            $querylist .= "and ic_prif like '%$prif_no%'";

            $querypage .= "and ic_prif like '%$prif_no%'";
        }
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }
        

    }elseif(!empty($prif_no)){
            $querylist = "Select * from srvcrqst where ic_prif like '%$prif_no%'";

            $querypage = "Select * from srvcrqst where ic_prif like '%$prif_no%'";
        
        if(!empty($rqst_category)){
            $querylist .= "and ic_rqst like '%$rqst_category%'";

            $querypage .= "and ic_rqst like '%$rqst_category%'";
        }
        
    }elseif(!empty($rqst_category)){
            $querylist .= "Select * from srvcrqst where ic_rqst like '%$rqst_category%'";

            $querypage .= "Select * from srvcrqst where ic_rqst like '%$rqst_category%'";
    }

    $querylist .= "order by ic_id DESC LIMIT $start, $limit";

    $querypage .= "order by ic_id DESC";

    $_SESSION['adv_search'] = "1";

    return array($querylist, $querypage,$_SESSION['adv_search']);

}

function emptyAdv(){

    return"<script>
            alert('Please input to any textbox of advance search');
            window.location.href = 'http://10.49.1.242:8012/SRS/search.php';
            </script>
            ";
}

?>
