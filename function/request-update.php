<?php
ini_set('max_execution_time', 300);
require_once "core.php";

$get_some = new Report();

$get_some->query("select * from srvcrqst where prcss_no like '%CSR%' or prcss_no like '%CPR%' or prcss_no like '%DRR%'");
$get_some->execute();

if ($get_some->rowCount() > 0) {
    // code...
    $row = $get_some->resultset();

    foreach ($row as $key => $value) {
        // code...
        $dtls   =   $value['ic_dtls'];
        $rqst   =   $value['ic_rqst'];
        $ic_id  =   $value['ic_id'];
        $prcss  =   $value['prcss_no'];

        echo "$prcss ";

        if(empty($rqst)) {
            // code...
            if (strpos($prcss, '-') !== false) {

                $yr =   explode("-",$prcss);

                $prcss_code = $yr[0];

                switch ($prcss_code) {
                    case 'CSR':
                        // code...

                        $tbl        =   $prcss_code."_20".$yr[2];
                        $rqst_ctgry =   $prcss_code."_rqst_ctgry";
                        $prcss_col  =   $prcss_code."_prcss_no";

                        break;

                    case 'CPR':
                        // code...

                        $tbl        =   $prcss_code."_20".$yr[2];
                        $rqst_ctgry =   $prcss_code."_prblm_ctgry";
                        $prcss_col  =   $prcss_code."_prcss_no";

                        break;

                    case 'DRR':
                        // code...
                        $tbl        =   $prcss_code."_20".$yr[2];
                        $rqst_ctgry =   $prcss_code."_file_srvr";
                        $prcss_col  =   $prcss_code."_prcss_no";
                        break;
                }

                $get_some->query("select $rqst_ctgry from $tbl where $prcss_col = '$prcss'");
                $get_some->execute();

                $row = $get_some->single();

                $new_rqst = $row[$rqst_ctgry];

                if (!empty($new_rqst)) {
                    // code...
                    echo $new_rqst." ";

                    $get_some->query("update srvcrqst set ic_rqst = '$new_rqst' where prcss_no = '$prcss'");
                    $get_some->execute();

                }else{
                    echo "request not inputed ";
                }

            }else{
                echo "pre reg pa lang";
            }
        }else{
            echo "request modified na ";
        }

        $ask_prcss  =   strpos($prcss, 'DRR');

        if ($ask_prcss === false) {

            if (strpos($dtls, ';') !== false) {
                //echo $value['ic_dtls'];
                $vals   = explode(";",$value['ic_dtls']);
                echo $vals[1]."<br>";
                
                $re_vals1 = addslashes($vals[1]);
                $get_some->query("update srvcrqst set ic_ipadd='$vals[0]', ic_dtls='$re_vals1' where ic_id ='$ic_id' ");
                $get_some->execute();


            }else{

                echo "details modified na :) <br>";
            }

        }else{
            echo "Details is good <br>";
        }





    }
}


 ?>
