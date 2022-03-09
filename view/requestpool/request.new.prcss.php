<script type="text/javascript">
    $(document).ready(function(){
        $(".csr-newreq").click(function(){
            $(".csr-newreq-list").fadeToggle("fast");
            $(".cpr-newreq-list").hide("fast");
            $(".drr-newreq-list").hide("fast");
            return false;
        });

        $(".cpr-newreq").click(function(){
            $(".cpr-newreq-list").fadeToggle("fast");
            $(".csr-newreq-list").hide("fast");
            $(".drr-newreq-list").hide("fast");
            return false;
        });

        $(".drr-newreq").click(function(){
            $(".drr-newreq-list").fadeToggle("fast");
            $(".csr-newreq-list").hide("fast");
            $(".cpr-newreq-list").hide("fast");
            return false;
        });

        $(".table-request td").click(function(){
            //$(".csr-newreq-list").fadeToggle("fast");
            var req = $(this).data("val");
            var stat = $(this).data("status");
            //alert(li);
            var url = "http://10.49.5.115/srs/requestpool.php?status="+stat+"&request="+req;
            window.location = url;
            return false;
        });
        $(document).on('click', function(e) {
            $(".csr-newreq-list").hide("fast");
            $(".cpr-newreq-list").hide("fast");
            $(".drr-newreq-list").hide("fast");
        });


    });
</script>

<style>
.drr-newreq-list,
.cpr-newreq-list,
.csr-newreq-list{
    color: #333;
    display: none;
    position: absolute;
    top: 125px;
    right: .5px;
    width: 100%;
    height: 500px;
    padding: 0px;
    background-color: #FAFAFA;
    border:solid 1px rgba(100, 100, 100, .20);
    -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
    z-index: 1;
}
.drr-newreq-list:before,
.cpr-newreq-list:before,
.csr-newreq-list:before {
    content: '';
    display:inline-block;
    width:0;
    height:0;
    top: 30px;
    right: 500px;
    color:transparent;
    border:10px solid #FAFAFA;
    border-color:transparent transparent #000;
    margin-top:-20px;
    float: right;
    margin-right: 235px;
}
.drr-newreq-header,
.cpr-newreq-header,
.csr-newreq-header{
    margin: 10px 5px;
    padding-left: 60px;
}
.drr-newreq-header p,
.cpr-newreq-header p,
.csr-newreq-header p{
    padding-right: 60px;
    margin: 0;
    font-size: 1.1em;
}
.drr-newreq-body,
.cpr-newreq-body,
.csr-newreq-body{
    height: 400px;
    overflow: auto;
    border-top: 2px solid #BDBDBD;
    border-bottom: 2px solid #BDBDBD;
}
.drr-newreq-body div:hover,
.cpr-newreq-body div:hover,
.csr-newreq-body div:hover{
    color: #111;
    text-decoration: none;
    background-color: #BDBDBD;
}

ul.csr-newreq-body{
    padding-left: 0;
}

table.csr-newreq-body li{
    width: 100%;
    margin: 0;
    padding: 10px 0;
    font-size: 1.1em;
    display:inline-block;
    border-bottom: 1px solid #6B6B6B;
}
ul.csr-newreq-body li:last-child{
    border-bottom: 0px solid #000;
}
</style>

<?php

if (!empty($_GET['status'])) {
    // code...
    $prcss_status           = $_GET['status'];
    $_SESSION['status']     = $_GET['status'];
}elseif (!empty($_SESSION['status'])) {
    // code...
    $prcss_status           = $_SESSION['status'];
}

$PrcssStatus = new requestStatus();

$PrcssStatus->prcssStatus($prcss_status,"CSR");
$newCSR = $PrcssStatus->queryno;

$PrcssStatus->prcssStatus($prcss_status,"CPR");
$newCPR = $PrcssStatus->queryno;

$PrcssStatus->prcssStatus($prcss_status,"DRR");
$newDRR = $PrcssStatus->queryno;

?>
<!--
<div class="col-md-1 col-xl-1">

</div>
<div class="col-md-10 col-xl-10 pt-5">
-->
    <div class="row">
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>CSR</h3>
                </div>
                <div class="card-block text-center">
                    <h3 class="csr-newreq">
                        <?php echo $newCSR;  ?>
                    </h3>
                    <div class="csr-newreq-list">
                        <div class="csr-newreq-header">
                            <p><?php echo $prcss_status; ?> List</p>
                        </div>
                        <div class="csr-newreq-body">
                            <table class="table table-hover table-request">
                                <tbody>
                                    <?php
                                        $PrcssStatus->dstnctRqst($prcss_status,"CSR");

                                        for ($i=0; $i < count($PrcssStatus->queryno); $i++) {
                                            // code...
                                            $row = $PrcssStatus->queryno;
                                            echo "<tr data-val='".$row[$i][0]."'>";
                                            for ($a=0; $a < count($row[$i]); $a++) {
                                                // code...
                                                //$row = $PrcssStatus->queryno;

                                                //echo $row[$i][$a]."<br>";
                                                echo "<td data-status='".$prcss_status."' data-val='".$row[$i][0]."'>".$row[$i][$a]."</td>";
                                            }
                                            echo "</tr>";
                                        }


                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>CPR</h3>
                </div>
                <div class="card-block text-center">
                    <!--
                    <h2>
                        <a href="requestpool.php?status=New Request&prcss=CPR"><?php echo $newCPR;  ?></a>
                    </h2> -->
                    <h3 class="cpr-newreq">
                        <?php echo $newCPR;  ?>
                    </h3>
                    <div class="cpr-newreq-list">
                        <div class="cpr-newreq-header">
                            <p><?php echo $prcss_status; ?> List</p>
                        </div>
                        <div class="cpr-newreq-body">
                            <table class="table table-hover table-request">
                                <tbody>
                                    <?php
                                        $PrcssStatus->dstnctRqst($prcss_status,"CPR");

                                        for ($i=0; $i < count($PrcssStatus->queryno); $i++) {
                                            // code...
                                            $row = $PrcssStatus->queryno;
                                            echo "<tr data-val='".$row[$i][0]."'>";
                                            for ($a=0; $a < count($row[$i]); $a++) {
                                                // code...
                                                //$row = $PrcssStatus->queryno;

                                                //echo $row[$i][$a]."<br>";
                                                echo "<td data-status='".$prcss_status."' data-val='".$row[$i][0]."'>".$row[$i][$a]."</td>";
                                            }
                                            echo "</tr>";
                                        }


                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>DRR</h3>
                </div>
                <div class="card-block text-center">
                    <!--
                    <h2>
                        <a href="requestpool.php?status=New Request&prcss=DRR"><?php echo $newDRR;  ?></a>
                    </h2> -->
                    <h3 class="drr-newreq">
                        <?php echo $newDRR;  ?>
                    </h3>
                    <div class="drr-newreq-list">
                        <div class="cpr-newreq-header">
                            <p><?php echo $prcss_status; ?> List</p>
                        </div>
                        <div class="drr-newreq-body">
                            <table class="table table-hover table-request">
                                <tbody>
                                    <?php
                                        $PrcssStatus->dstnctRqst($prcss_status,"DRR");

                                        for ($i=0; $i < count($PrcssStatus->queryno); $i++) {
                                            // code...
                                            $row = $PrcssStatus->queryno;
                                            echo "<tr data-val='".$row[$i][0]."'>";
                                            for ($a=0; $a < count($row[$i]); $a++) {
                                                // code...
                                                //$row = $PrcssStatus->queryno;

                                                //echo $row[$i][$a]."<br>";
                                                echo "<td data-status='".$prcss_status."' data-val='".$row[$i][0]."'>".$row[$i][$a]."</td>";
                                            }
                                            echo "</tr>";
                                        }


                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!--
</div>
<div class="col-md-1 col-xl-1">

</div>
-->

<?php

if(isset($_GET['prcss'])){

    $prcss              = $_GET['prcss'];
    $_SESSION['prcss']  = $_GET['prcss'];

    //require_once 'view/requestpool/request.list.php';

}elseif(isset($_SESSION['prcss'])){

    $prcss = $_SESSION['prcss'];

    //require_once 'view/requestpool/request.list.php';

}else{

    $prcss              = "";
    unset($_SESSION['prcss']);

}



?>
