<?php

$prcss_id = explode("-",$prcss_no);
$process     = $prcss_id[0];
/*
$crtd_date = explode(" ",$crtd_date);
$rqst_date = explode(" ",$rqst_date);
$done_date = explode(" ",$done_date);
*/
if($process == "CSR"){

    // CSR view form
    require_once 'view/csr.php';

}elseif($process == "CPR"){

    // CPR view form
    require_once 'view/cpr.php';

}elseif($process == "DRR"){
    $dtls = explode(";",$dtls);
    $dtls_no = count($dtls);

    if($dtls_no > 2){

    }else{

        $dtls[0] = "";
        $dtls[2] = "";
        $dtls[3] = "";
        $dtls[4] = "";
    }

    // DRR view form
    require_once 'view/drr.php';

}elseif($process == "QA"){

    // QA view form
    require_once 'view/qa.php';
}



if(strlen($prcss_no) > 3 ){

    $prcss_id = explode("-",$prcss_no);
    $procss     = $prcss_id[0];

    $process = explode("-", $prcss_no);
    $prcss_count = count($process);

    if($prcss_count > 1){
        //$process_table = strtolower($process[0].$process[2]);   // table name
        $process_id     = strtolower($process[0]."_id");         // table id
        $prcss_no       = strtolower($prcss_no);
        $process[0]     = strtolower($process[0]);

        $prcss_table   = $process[0]."_20".$process[2];
        //echo $process[0];
        //echo $process_id;

        $view_query = new Report();

        $view_query->query("Select * from $prcss_table where $process_id=:prcss_no");
        $view_query->bind(':prcss_no',$process[1]);
        $view_query->execute();

        if($view_query->rowCount() > 0){

            $row = $view_query->single();

            switch($process[0]){

                case"csr";
                    $csr_change_date          = $row[$process[0].'_change_date'];
                    $csr_adjusted_date        = $row[$process[0].'_adjusted_date'];
                    //$csr_rqst_ctgry           = $row[$process[0].'_rqst_ctgry'];
                        /*
                        $this->csr_purchase_require     = $row[$process[0].'_purchase_require'];
                        $this->csr_managers_approval    = $row[$process[0].'_managers_approval'];
                        $this->csr_purchase_conforms    = $row[$process[0].'_purchase_conforms'];
                        $this->csr_conforms_explain     = $row[$process[0].'_conforms_explain'];
                        */
                break;
                case"cpr";
                    $cpr_prblm_ctgry          = $row[$process[0].'_prblm_ctgry'];
                break;
                case"drr";
                    $drr_file_srvr            = $row[$process[0].'_file_srvr'];
                break;
            }


        }
    }

    echo misDetails($prcss_no, $status, $received_by, $received_date, $assigned_to, $assigned_date, $prif);

    switch($prcss_id[0]){

        case"CSR";
            /*
            $csr_change_date        = $view_procss->csr_change_date;
            $csr_adjusted_date      = $view_procss->csr_adjusted_date;
            $csr_rqst_ctgry         = $view_procss->csr_rqst_ctgry;
            */
            //echo detailedCsr($csr_change_date, $csr_adjusted_date,$csr_rqst_ctgry);
            echo detailedCsr($csr_change_date, $csr_adjusted_date);
            break;

        case"CPR";
            //$cpr_prblm_ctgry        = $view_procss->cpr_prblm_ctgry;

            echo detailedCpr($cpr_prblm_ctgry);

            break;

        case"DRR";
            //$drr_file_srvr          = $view_procss->drr_file_srvr;

            echo detailedDrr($drr_file_srvr);

            break;

        case"QA";
            break;
    }
}

//echo $status." ". $requestor. " ". $fullname;

switch($status){

    case "New Request":
	
        if($department == "MIS"){

            if($role == "Support" ){
                echo buttonViewing();
            }else{

                echo buttonEndorsemissupport();

            }
        }else{
            echo buttonViewing();
        }
        break;

    case "Assigned":


        if($requestor == $fullname){
            echo buttonRequestOwner();
        }elseif($assigned_to == $fullname){
            echo buttonAssigned();
        }else{
            echo buttonViewing();
        }
        break;

    case "Work in Progress":


        if($requestor == $fullname){
            echo buttonRequestOwner();
        }elseif($assigned_to == $fullname){
            echo buttonWorkinProgress();
        }else{
            echo buttonViewing();
        }
        break;


    case "Done":
        //echo $requestor." ".$fullname; 
        
        if($requestor == $fullname and empty($user_approval)){
            echo buttonComplete();
        }elseif($assigned_to == $fullname and $user_approval =="Rejected"){
            echo buttonWorkinProgress();
        }elseif($assigned_to == $fullname and $user_approval =="Completed" and empty($mis_checker)){
            echo buttonEndorsemischecker();
        }elseif($mis_checker == $fullname and $user_approval == "Completed"){
            echo buttonDone();
        }else{
            echo buttonViewing();
        }
        break;


    case "Reject":

        if(empty($assigned_to)){
            echo buttonViewing();
        }else{

            if($assigned_to == $fullname){
            echo buttonWorkinProgress();
            }else{
                echo buttonViewing();
            }
        }

        break;

    case "Complete":


        if($assigned_to == $fullname and $user_approval =="Completed"){
            echo buttonEndorsemischecker();
        }else{
            echo buttonViewing();
        }
        break;

    case "Endorse to Checker" :
	case "MIS Checker":

        if($mis_checker == $fullname and $user_approval == "Completed"){
            echo buttonDone();
        }else{
           echo buttonViewing();
        }
        break;


############# USER / REQUESTOR BUTTONS


    case  "Newly Created":
		
        if($requestor == $fullname){
            echo buttonRequestOwnerNewlyCreated();
        }else{
            echo buttonViewing();
        }
        break;

    case "For Checking":

        if($requestor == $fullname){
            echo buttonRequestOwner();
        }elseif($checker == $fullname){
            echo buttonEndorsement();
        }else{
            echo buttonViewing();
        }
        break;

    case "For Approval":
        if($requestor == $fullname){
            echo buttonRequestOwner();
        }elseif($approver == $fullname){
            echo buttonEndorsement();
        }else{
            echo buttonViewing();
        }
        break;

    case "Returned":

        if($requestor == $fullname){
            echo buttonReturned();
        }else{
            echo buttonViewing();
        }

        break;

    case  "No Good":
    case "Cancelled":

        if($requestor == $fullname){
            
            echo buttonCancelled();
            
        }else{
            echo buttonViewing();
        }
        break;
    
    case "Change Deadline":

        if($requestor == $fullname){
            
            echo buttonChangeDeadline();
            
        }else{
            echo buttonViewing();
        }

        break;
        
    case "Closed":
        echo buttonViewing();
        break;

    default;
        //echo buttonViewing();
        break;


}

if($department == "MIS" && strpos($fullname, 'admin.')!== false){

    switch($role){
        case "Member":
		case "Checker":
		case "Approver":
		case "Service Desk":

            if($status != "Cancelled"){

                echo buttonCancelReendorse();
            }

        break;

        case"Support":

            if($position == "Staff"){
                echo buttonUpdateDate();
            }

        break;
            
            case"SRS Checker":

            echo buttonCancelReendorse();

        break;
            case"Service Desk":

            echo buttonCancelReendorse();

        break;

    }
}

function misDetails($prcss_no, $status, $received_by, $received_date, $assigned_to, $assigned_date, $prif){

    $received_date = explode(" ",$received_date);
    $assigned_date = explode(" ",$assigned_date);

?>
<div class="card">
    <div class="card-block">
        <div class="row">
            <label class="col-2 col-form-label text-right"> <b>Control No :</b> </label>
            <label class="col-4 col-form-label text-left"><?php echo strtoupper($prcss_no);?></label>
            <label class="col-3 col-form-label text-right"> <b>Status :</b> </label>
            <label class="col-3 col-form-label text-left"><?php echo $status;?></label>
        </div>
        <?php
            if (strpos($prcss_no, 'qa') !== false) {
                // code...
                ?>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <label class="col-2 col-form-label text-right"> <b>Assign to :</b> </label>
                    <label class="col-4 col-form-label text-left"><?php echo $assigned_to;?></label>
                </div>
                <?php

            }else{

                if (!empty($prif)) {
                    ?>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <label class="col-2 col-form-label text-right"> <b>PRIF# :</b> </label>
                        <label class="col-4 col-form-label text-left"><?php echo $prif;?></label>
                    </div>
                    <?php
                    }
                ?>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <label class="col-2 col-form-label text-right"> <b>Receive by :</b> </label>
                    <label class="col-4 col-form-label text-left"><?php echo $received_by;?></label>
                    <label class="col-3 col-form-label text-right"> <b>Receive date :</b> </label>
                    <label class="col-3 col-form-label text-left"><?php echo date('m/d/Y H:i', strtotime($received_date[0]));?></label>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <label class="col-2 col-form-label text-right"> <b>Assign to :</b> </label>
                    <label class="col-4 col-form-label text-left"><?php echo $assigned_to;?></label>
                    <label class="col-3 col-form-label text-right"> <b>Assign date :</b> </label>
                    <label class="col-3 col-form-label text-left"><?php echo date('m/d/Y H:i', strtotime($assigned_date[0]));?></label>

                    <input type="hidden" name="assign_date" value="<?php echo date('Y-m-d');?>">
                </div>

                <?php
            }

         ?>

    </div>
</div>
<?php
}
?>
