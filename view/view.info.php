<?php

if(isset($_GET['ic'])){


    $ic_no  =   $_GET['ic'];

    $view_request       = new Report();

    $view_request->query("Select * from srvcrqst where ic_no=:ic_no");
    $view_request->bind(':ic_no',$ic_no);
    $view_request->execute();

    if($view_request->rowCount() > 0){

        $row = $view_request->single();

        $ic_no                    =   $row['ic_no'];
        $requestor                =   $row['ic_rqstr'];
        $requestor_id             =   $row['ic_rqstr_id'];
        $requestor_department     =   $row['ic_rqstr_dprtmnt'];
        $crtd_date                =   $row['ic_crtd_date'];
        $rqst_date                =   $row['ic_rqst_date'];
        $site                     =   $row['ic_site'];
        $local                    =   $row['ic_local'];
        $ipadd                    =   $row['ic_ipadd'];
        $rqst                     =   $row['ic_rqst'];
        $prif                     =   $row['ic_prif'];
        $prcss_no                 =   $row['prcss_no'];
        $dtls                     =   $row['ic_dtls'];
        $prepared                 =   $row['ic_prepared'];
        $checker                  =   $row['ic_checker'];
        $approver                 =   $row['ic_approver'];
        $status                   =   $row['ic_status'];
        $mis_checker              =   $row['checker'];
        $user_approval            =   $row['user_approval'];
        $attachment               =   $row['ic_attachment'];
        $done_date                =   $row['done_date'];
        $cd_request               =   $row['cd_request'];

        $received_by            = $row['received_by'];
        $received_date          = $row['received_date'];
        $assigned_to            = $row['assigned_to'];
        $assigned_date          = $row['assigned_date'];

        if(empty($attachment)){
            $attached ="No attached file";
        }elseif($attachment == "No attached file"){
            $attached = $attachment;
        }else{
            $attachments = array_filter(explode(',',$attachment));
            foreach ($attachments as $key=>$vals){
                $path_attachment = explode('/',$attachments[$key]);
                $count_path_attachment = count($path_attachment);
                //echo $path_attachment[2]." ";

                $attachment_count = count($attachments);

                $attached ="";

                for($i=0; $i<$attachment_count;$i++){
                    $path_attachment = explode('/',$attachments[$i]);
                    $attached .= "<a href='".$attachments[$i]."'>".$path_attachment[2]."</a> ";
                }

            }
        }

    }

}
?>
