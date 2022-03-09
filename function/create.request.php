<?php
$request_info       = new request();
if(isset($_POST['submit_csr'])){

    $format = 'm/d/Y H:i';

    $date_request_pre   = $_POST['request_date'];
	//	echo  $date_request_pre." test";
    $date_request_req   = DateTime::createFromFormat($format, $date_request_pre);
    $request_date       = $date_request_req->format('Y-m-d H:i') ;

    $requestor_id       =   $_POST['requestor_id'];
    $requestor_name     =   $_POST['request_by'];
    $requestor_dpt      =   $_POST['requestor_department'];
    $created_date       =   $_POST['created_date'];
    $process            =   "CSR";
    $site               =   $_POST['branch_site'];
    $ipadd              =   $_POST['csr_ip_address'];
    $request            =   $_POST['request_category'];
    $details            =   $_POST['request_dtls'];
    $local              =   isset($_POST['requestor_local']) ? $_POST['requestor_local'] : "";
    $mode_of_request    =   "Web";

    if(isset($_FILES['file'])){
        foreach($_FILES['file']['name'] as $size=>$val){
            $tmp_size = $_FILES['file']['name'][$size];
            //echo $tmp_size;
        }if(!empty($tmp_size)){
            $tmp_path = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
        }else{
            $tmp_path ="";
            $file_name ="";
        }
    }


    $ic_no = createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $local, $mode_of_request, $ipadd, $request, $details, $tmp_path, $file_name);

    if(isset($_POST['request_for'])){

        if($_POST['request_for'] == "yes"){

            $set_checker      =   array_filter(explode("-",$_POST['checker']));
            $set_approver     =   array_filter(explode("-",$_POST['approver']));
            $set_status       =   "New Request";

            echo $request_info->statusUpdate($ic_no, $process, "For Checking", $created_date, $set_checker[0]);
            echo $request_info->statusUpdate($ic_no, $process, "For Approval", $created_date, $set_approver[0]);
            echo $request_info->statusUpdate($ic_no, $process, "New Request", $created_date, $set_approver);

        }elseif($_POST['request_for'] == "no"){

        }

    }
	//alert('".$ic_no."');
    echo"<script>
                window.location.href = 'view.php?ic=".$ic_no."';
                </script>";



}elseif(isset($_POST['submit_cpr'])){

    $format = 'm/d/Y H:i';
    $date_request_pre   = $_POST['request_date'];
    $date_request_req   = DateTime::createFromFormat($format, $date_request_pre);
    $request_date       = $date_request_req->format('Y-m-d H:i') ;

    $requestor_id       =   $_POST['requestor_id'];
    $requestor_name     =   $_POST['request_by'];
    $requestor_dpt      =   $_POST['requestor_department'];
    $created_date       =   $_POST['created_date'];
    $process            =   "CPR";
    $site               =   $_POST['branch_site'];
    $ipadd              =   $_POST['cpr_ip_address'];
    $request            =   $_POST['problem_category'];
    $details            =   $_POST['request_dtls'];
    $local              =   isset($_POST['requestor_local']) ? $_POST['requestor_local'] : "";
    $mode_of_request    =   "Web";

    if(isset($_FILES['file'])){
        foreach($_FILES['file']['name'] as $size=>$val){
            $tmp_size = $_FILES['file']['name'][$size];
            //echo $tmp_size;
        }if(!empty($tmp_size)){
            $tmp_path = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
        }else{
            $tmp_path ="";
            $file_name ="";
        }
    }

    $ic_no = createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $local, $mode_of_request, $ipadd, $request, $details, $tmp_path, $file_name);

    if(isset($_POST['request_for'])){

        if($_POST['request_for'] == "yes"){

            $set_checker      =   array_filter(explode("-",$_POST['checker']));
            $set_approver     =   array_filter(explode("-",$_POST['approver']));
            $set_status       =   "New Request";

            echo $request_info->statusUpdate($ic_no, $process, "For Checking", $created_date, $set_checker[0]);
            echo $request_info->statusUpdate($ic_no, $process, "For Approval", $created_date, $set_approver[0]);
            echo $request_info->statusUpdate($ic_no, $process, "New Request", $created_date, $set_approver);

        }elseif($_POST['request_for'] == "no"){

        }

    }
	//alert('".$ic_no."');
    echo"<script>

                window.location.href = 'view.php?ic=".$ic_no."';
                </script>";




}elseif(isset($_POST['submit_drr'])){

    $format = 'm/d/Y H:i';
    $date_request_pre   = $_POST['request_date'];
    $date_request_req   = DateTime::createFromFormat($format, $date_request_pre);
    $request_date       = $date_request_req->format('Y-m-d H:i') ;

    $requestor_id       =   $_POST['requestor_id'];
    $requestor_name     =   $_POST['request_by'];
    $requestor_dpt      =   $_POST['requestor_department'];
    $created_date       =   $_POST['created_date'];
    $process            =   "DRR";
    $site               =   $_POST['branch_site'];
    $ipadd              =   "";
    $request            =   $_POST['file_server'];
    $local              =   isset($_POST['requestor_local']) ? $_POST['requestor_local'] : "";
    $mode_of_request    =   "Web";

    if($_POST['option_directory'] == "Original Directory"){
        $directory_info = $_POST['option_directory'];
    }else{
        $directory_info = $_POST['other_location'];
    }

    if(isset($_FILES['file'])){
        foreach($_FILES['file']['name'] as $size=>$val){
            $tmp_size = $_FILES['file']['name'][$size];
            //echo $tmp_size;
        }if(!empty($tmp_size)){
            $tmp_path = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
        }else{
            $tmp_path ="";
            $file_name ="";
        }
    }

    $details            =   $_POST['filename'].";".$_POST['file_location'].";".$directory_info.";".$_POST['option_overwrite'].";".$_POST['request_dtls'];




    $ic_no = createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $local, $mode_of_request, $ipadd, $request, $details, $tmp_path, $file_name);

    if(isset($_POST['request_for'])){

        if($_POST['request_for'] == "yes"){

            $set_checker      =   array_filter(explode("-",$_POST['checker']));
            $set_approver     =   array_filter(explode("-",$_POST['approver']));
            $set_status       =   "New Request";

            echo $request_info->statusUpdate($ic_no, $process, "For Checking", $created_date, $set_checker[0]);
            echo $request_info->statusUpdate($ic_no, $process, "For Approval", $created_date, $set_approver[0]);
            echo $request_info->statusUpdate($ic_no, $process, "New Request", $created_date, $set_approver);

        }elseif($_POST['request_for'] == "no"){

        }

    }
	//alert('".$ic_no."');
    echo"<script>

                window.location.href = 'view.php?ic=".$ic_no."';
                </script>";


}elseif(isset($_POST['submit_qa'])){

    $format = 'm/d/Y H:i';
    $request_date       =   $_POST['start_date'];

    $requestor_id       =   $_POST['requestor_id'];
    $requestor_name     =   $_POST['request_by'];
    $requestor_dpt      =   $_POST['requestor_department'];
    $created_date       =   $_POST['start_date'];
    $process            =   "QA";
    $site               =   $_POST['branch_site'];
    $request            =   "";
    $ipadd              =   "";
    $details            =   $_POST['request_dtls'];
    $assist_by          =   explode("-",$_POST['assist_by']);
    $status             =   "Closed";
    $local              =   $_POST['requestor_local'];
    $mode_of_request    =   $_POST['mode_of_request'];

    if(isset($_FILES['file'])){
        foreach($_FILES['file']['name'] as $size=>$val){
            $tmp_size = $_FILES['file']['name'][$size];
            //echo $tmp_size;
        }if(!empty($tmp_size)){
            $tmp_path = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
        }else{
            $tmp_path ="";
            $file_name ="";
        }
    }else{
        $tmp_path ="";
        $file_name ="";
    }

    if (isset($_POST['category']) == "CAE") {
        // code...
        if (!empty($_POST['request'])) {
            // code...
            $request = $_POST['category']."-".$_POST['request'];
        }
    }

    $ic_no = createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $local, $mode_of_request, $ipadd, $request, $details, $tmp_path, $file_name);

    if(isset($_POST['request_for'])){

        if($_POST['request_for'] == "yes"){

            $set_status       =   "Closed";

            echo $request_info->statusUpdate($ic_no, $process, $set_status, $created_date, "");
            echo createQa($set_status, $ic_no, "", $created_date, $assist_by[0], $request_date);
            require 'function/update.request.php';
            echo updateRequest($ic_no, $created_date, $prif, $process, "Work in Progress", "");
            echo updateRequest($ic_no, $_POST['end_date'],  $prif, $process, "Done", "");
            echo updateRequest($ic_no, $_POST['end_date'],  $prif, $process, $set_status, "");

        }elseif($_POST['request_for'] == "no"){

        }

    }
	//alert('".$ic_no."');
    echo"<script>

        window.location.href = 'view.php?ic=".$ic_no."';
        </script>";
}


function createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $local, $mode_of_request, $ipadd, $request, $details, $tmp_path, $file_name){

    //global $dbCon;

    $create_ic = new Report();

    $ic_year    = "ic_".date("Y");

    $create_ic->query("Insert into $ic_year (ic_no, prcss_no)Values('', '')");
    $create_ic->execute();

    $ic_id = $create_ic->lastInsertId();
    $autoinc = sprintf("%04d",$ic_id);
    $ic_no=  "IC-". $autoinc . date("-".'y');

    $update_query = new Report();

    $update_query->query("update $ic_year set ic_no = :ic_no, prcss_no = :prcss_no where srvc_rqst_id =:ic_id");
    $update_query->bind(':ic_no',$ic_no);
    $update_query->bind(':ic_id',$ic_id);
    $update_query->bind(':prcss_no',$process);

    $update_query->execute();

    $status = "Newly Created";

    if(!empty($file_name)){
        $dir_name = "attachments/".$ic_no;
        if(file_exists($dir_name)){

        }else{
            mkdir("$dir_name");
            $uploads_dir = "$dir_name";

            $upload_file = "";
            foreach($file_name as $key=>$val ){
                $upload_file_path = $tmp_path[$key];
                $upload_file_name = $file_name[$key];
                move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                $upload_file .= $uploads_dir."/".$upload_file_name.",";
            }


        }
    }else{

        $upload_file = "No attached file";

    }

    $create_query = new Report();
    //$requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $site, $ipadd, $request, $details, $tmp_path, $file_name
    //$create_query->query("Insert into srvcrqst (ic_no, ic_rqstr_id, ic_rqstr, ic_rqstr_dprtmnt, ic_crtd_date, ic_rqst_date, prcss_no, ic_site, ic_local, ic_ipadd, ic_rqst, ic_dtls, ic_attachment, ic_status)VALUES(:ic_no, :ic_rqstr_id, :ic_rqstr, :ic_rqstr_dprtmnt, :ic_crtd_date, :ic_rqst_date, :prcss_no, :ic_site, :ic_local, :ipadd, :request, :ic_dtls, :ic_attachment, :status)");
    $create_query->query("Insert into srvcrqst (ic_no, ic_rqstr_id, ic_rqstr, ic_rqstr_dprtmnt, ic_crtd_date, ic_rqst_date, prcss_no, ic_site, ic_local, ic_mode, ic_ipadd, ic_rqst, ic_dtls, ic_attachment, ic_status)VALUES(:ic_no, :ic_rqstr_id, :ic_rqstr, :ic_rqstr_dprtmnt, :ic_crtd_date, :ic_rqst_date, :prcss_no, :ic_site, :ic_local, :ic_mode, :ipadd, :request, :ic_dtls, :ic_attachment, :status)");
    $create_query->bind(':ic_rqstr_id',$requestor_id);
    $create_query->bind(':ic_rqstr',$requestor_name);
    $create_query->bind(':ic_rqstr_dprtmnt',$requestor_dpt);
    $create_query->bind(':ic_crtd_date',$created_date);
    $create_query->bind(':ic_rqst_date',$request_date);
    $create_query->bind(':prcss_no',$process);
    $create_query->bind(':ic_site',$site);
    $create_query->bind(':ic_local',$local);
    $create_query->bind(':ic_mode',$mode_of_request);
    $create_query->bind(':ipadd',$ipadd);
    $create_query->bind(':request',$request);
    $create_query->bind(':ic_dtls',$details);
    $create_query->bind(':ic_attachment',$upload_file);
    $create_query->bind(':status',$status);
    $create_query->bind(':ic_no',$ic_no);
    $create_query->execute();

    //$ic_no = $dbCon->lastInsertId();
    /*
    $this->ic_no = $ic_no;

    return $this->ic_no;
    */
    return $ic_no;

    /*
    echo"<script>
            alert('".$ic_no."');
            window.location.href = 'index.php';
            </script>";
    */
}


function createCsr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $date_changed, $adjusted_date, $needed_date, $rqst_ctgry){

    $create_csr = new Report();

    $csr_table = "csr_".date("Y");

    $create_csr->query("Insert into $csr_table ( csr_change_date, csr_adjusted_date, csr_needed_date, csr_rqst_ctgry)VALUES(:csr_change_date, :csr_adjusted_date, :csr_needed_date, :csr_rqst_ctgry)");
    $create_csr->bind(':csr_change_date',$date_changed);
    $create_csr->bind(':csr_adjusted_date',$adjusted_date);
    $create_csr->bind(':csr_needed_date',$needed_date);
    $create_csr->bind(':csr_rqst_ctgry',$rqst_ctgry);
    $create_csr->execute();

    $csr_id = $create_csr->lastInsertId();
    $autoinc = sprintf("%04d",$csr_id);
    $csr_prcss_no =  "CSR-". $autoinc . date("-".'y');

    $update_csr = new Report();

    $update_csr->query("update $csr_table set csr_prcss_no = :csr_prcss_no where csr_id=:csr_id");
    $update_csr->bind(':csr_prcss_no',$csr_prcss_no);
    $update_csr->bind(':csr_id',$csr_id);
    $update_csr->execute();

    $ic_year = "ic_".date("Y");

    $update_ic = new Report();

    $update_ic->query("update srvcrqst set prcss_no = :csr_prcss_no, ic_status =:status, received_by=:received_by,  received_date=:received_date, assigned_to=:assigned_to, assigned_date=:assigned_date, in_charge=:assigned_to where ic_no=:ic_no");
    $update_ic->bind(':status',$ic_status);
    $update_ic->bind(':csr_prcss_no',$csr_prcss_no);
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':received_by',$received_by);
    $update_ic->bind(':received_date',$received_date);
    $update_ic->bind(':assigned_to',$assigned_to);
    $update_ic->bind(':assigned_date',$assigned_date);
    $update_ic->execute();

    $update_ic->query("update $ic_year set  prcss_no = :prcss_no where ic_no = :ic_no");
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':prcss_no',$csr_prcss_no);
    $update_ic->execute();

    /*
    echo"<script>
            alert('".$csr_prcss_no."');
            window.location.back;
        </script>";
    */
    echo"<script>
            alert('".$csr_prcss_no."');
            window.location.back;
        </script>";

}

function createCpr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $occured_date, $problem_category){

    $create_cpr = new Report();

    $cpr_table = "cpr_".date("Y");

    $create_cpr->query("Insert into $cpr_table (cpr_occured_date, cpr_prblm_ctgry)Values(:cpr_occured_date, :cpr_prblm_ctgry)");
    $create_cpr->bind(':cpr_occured_date', $occured_date);
    $create_cpr->bind(':cpr_prblm_ctgry', $problem_category);
    $create_cpr->execute();

    $cpr_id         = $create_cpr->lastInsertId();
    $autoinc        = sprintf("%04d",$cpr_id);
    $cpr_prcss_no   = "CPR-".$autoinc.date("-".'y');

    $update_cpr = new Report();

    $update_cpr->query("update $cpr_table set cpr_prcss_no=:cpr_prcss_no where cpr_id=:cpr_id");
    $update_cpr->bind(':cpr_prcss_no',$cpr_prcss_no);
    $update_cpr->bind(':cpr_id',$cpr_id);
    $update_cpr->execute();

    $ic_year = "ic_".date("Y");

    $update_ic = new Report();

    $update_ic->query("update srvcrqst set prcss_no = :cpr_prcss_no, ic_status =:status, received_by=:received_by, received_date=:received_date, assigned_to=:assigned_to, assigned_date=:assigned_date, in_charge=:assigned_to where ic_no=:ic_no");
    $update_ic->bind(':status',$ic_status);
    $update_ic->bind(':cpr_prcss_no',$cpr_prcss_no);
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':received_by',$received_by);
    $update_ic->bind(':received_date',$received_date);
    $update_ic->bind(':assigned_to',$assigned_to);
    $update_ic->bind(':assigned_date',$assigned_date);
    $update_ic->execute();

    $update_ic->query("update $ic_year set  prcss_no = :prcss_no where ic_no = :ic_no");
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':prcss_no',$cpr_prcss_no);
    $update_ic->execute();

    echo"<script>
            alert('".$cpr_prcss_no."');
            window.location.back;
        </script>";
}

function createDrr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $recover_date, $file_server){

    $create_drr = new Report();

    $drr_table = "drr_".date("Y");

    $create_drr->query("Insert into $drr_table (drr_rcvr_date, drr_file_srvr)Values(:drr_rcvr_date, :drr_file_srvr)");
    $create_drr->bind(':drr_rcvr_date', $recover_date);
    $create_drr->bind(':drr_file_srvr', $file_server);
    $create_drr->execute();

    $drr_id         = $create_drr->lastInsertId();
    $autoinc        = sprintf("%04d",$drr_id);
    $drr_prcss_no   = "DRR-".$autoinc.date("-".'y');

    $update_drr = new Report();

    $update_drr->query("update $drr_table set drr_prcss_no=:drr_prcss_no where drr_id=:drr_id");
    $update_drr->bind(':drr_prcss_no',$drr_prcss_no);
    $update_drr->bind(':drr_id',$drr_id);
    $update_drr->execute();

    $ic_year = "ic_".date("Y");

    $update_ic = new Report();

    $update_ic->query("update srvcrqst set prcss_no = :drr_prcss_no, ic_status =:status, received_by=:received_by, received_date=:received_date, assigned_to=:assigned_to, assigned_date=:assigned_date, in_charge=:assigned_to where ic_no=:ic_no");
    $update_ic->bind(':status',$ic_status);
    $update_ic->bind(':drr_prcss_no',$drr_prcss_no);
    $update_ic->bind(':received_by',$received_by);
    $update_ic->bind(':received_date',$received_date);
    $update_ic->bind(':assigned_to',$assigned_to);
    $update_ic->bind(':assigned_date',$assigned_date);
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->execute();

    $update_ic->query("update $ic_year set  prcss_no = :prcss_no where ic_no = :ic_no");
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':prcss_no',$drr_prcss_no);
    $update_ic->execute();

    echo"<script>
                alert('".$drr_prcss_no."');
                window.location.back;
            </script>";
}

function createQa($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date){

    $create_qa = new Report();

    $qa_table = "qa_".date("Y");

    $create_qa->query("Insert into $qa_table (qa_prcss_no)Values('')");
    $create_qa->execute();

    $qa_id          = $create_qa->lastInsertId();
    $autoinc        = sprintf("%04d",$qa_id);
    $qa_prcss_no    = "QA-".$autoinc.date("-".'y');

    $update_drr = new Report();

    $update_drr->query("update $qa_table set qa_prcss_no=:qa_prcss_no where qa_id=:qa_id");
    $update_drr->bind(':qa_prcss_no',$qa_prcss_no);
    $update_drr->bind(':qa_id',$qa_id);
    $update_drr->execute();

    $ic_year = "ic_".date("Y");

    $update_ic = new Report();

    $update_ic->query("update srvcrqst set prcss_no = :qa_prcss_no, ic_status =:status, received_by=:received_by, received_date=:received_date, assigned_to=:assigned_to, assigned_date=:assigned_date, in_charge=:assigned_to where ic_no=:ic_no");
    $update_ic->bind(':status',$ic_status);
    $update_ic->bind(':qa_prcss_no',$qa_prcss_no);
    $update_ic->bind(':received_by',$received_by);
    $update_ic->bind(':received_date',$received_date);
    $update_ic->bind(':assigned_to',$assigned_to);
    $update_ic->bind(':assigned_date',$assigned_date);
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->execute();

    $update_ic->query("update $ic_year set  prcss_no = :prcss_no where ic_no = :ic_no");
    $update_ic->bind(':ic_no',$ic_no);
    $update_ic->bind(':prcss_no',$qa_prcss_no);
    $update_ic->execute();

    echo"<script>
            alert('".$qa_prcss_no."');
            window.location.back;
        </script>";
}
?>
