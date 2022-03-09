<?php



if (strpos($role, "Member") !== false && $status == "Newly Created" || $status == "No Good") {

    if ($checker_avail->rowCount() > 0) {

        $endorse = endorsetoChecker($requestor, $fullname);

        $header     = $endorse[0];
        $list       = $endorse[1];
        $endorse_to = "Checker";



        $row = $checker_avail->resultset();
        
        // SPECIAL REQUST FROM WHE 

        if ($department == "WHE") {

            if (
                $rqst != "Software Purchas" || $rqst != "Hardware Purchase" ||
                $rqst != "Renewal License" || $rqst != "Investment" ||
                $rqst != "PC Configuration" || $rqst != "Laptop Configuration" || 
                $rqst != "Printer Configuration" || $rqst != "Plotter Configuration"
            ) {

                foreach ($row as $checker) {
                    # code...
                    if ($checker['pet_id'] == "pet0718") {
                        $full_name  =   $checker['full_name'];
                        $pet_id     =   $checker['pet_id'];
                        $email      =   $checker['email_account'];

                        $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
                    }

                    
                }
            } else {
                # code...
                for ($c = 0; $c < $checker_avail->rowCount(); $c++) {

                    $full_name  =   $row[$c]['full_name'];
                    $pet_id     =   $row[$c]['pet_id'];

                    if (empty($row[$c]['email_account'])) {
                        // code...
                        $email      =   "No Email";
                    } else {
                        $email      =   $row[$c]['email_account'];
                    }

                    $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
                }
            }
        } else {
            # code...
            for ($c = 0; $c < $checker_avail->rowCount(); $c++) {

                $full_name  =   $row[$c]['full_name'];
                $pet_id     =   $row[$c]['pet_id'];

                if (empty($row[$c]['email_account'])) {
                    // code...
                    $email      =   "No Email";
                } else {
                    $email      =   $row[$c]['email_account'];
                }

                $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
            }
        }
    } elseif ($approver_avail->rowCount() > 0) {

        $endorse = endorsetoApprover($requestor, $fullname);

        $header     = $endorse[0];
        $list       = $endorse[1];
        $endorse_to = "Approver";

        $row = $approver_avail->resultset();

        for ($c = 0; $c < $approver_avail->rowCount(); $c++) {

            $full_name  =   $row[$c]['full_name'];
            $pet_id     =   $row[$c]['pet_id'];

            if (empty($row[$c]['email_account'])) {
                // code...
                $email      =   "No Email";
            } else {
                $email      =   $row[$c]['email_account'];
            }

            $personnel_list[] = "<option data-officer='approver' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
        }
    } else {
        echo $header;
    }
}elseif (strpos($role, "Checker") !== false && $status == "Newly Created" || $status == "For Checking") {

    
    $endorse = endorsetoApprover($requestor, $fullname);
    $header     = $endorse[0];
    $list       = $endorse[1];
    $endorse_to = "Approver";

    $row = $approver_avail->resultset();

    for ($c = 0; $c < $approver_avail->rowCount(); $c++) {

        $full_name  =   $row[$c]['full_name'];
        $pet_id     =   $row[$c]['pet_id'];

        if (empty($row[$c]['email_account'])) {
            // code...
            $email      =   "No Email";
        } else {
            $email      =   $row[$c]['email_account'];
        }

        $personnel_list[] = "<option data-officer='approver' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
    }

    $endorse_to = "Checker";

    $row = $checker_avail->resultset();

    if ($department == "WHE") {

        if (
            $rqst == "Access Request" || $rqst == "Account Request" ||
            $rqst == "Transfer PC location" || $rqst == "Transfer Telephone location" ||
            $rqst == "Transfer Software location" || $rqst == "Hardware Purchase"
        ) {

            foreach ($row as $checker) {
                # code...
                if ($checker['pet_id'] == "pet0718") {
                    $full_name  =   $checker['full_name'];
                    $pet_id     =   $checker['pet_id'];
                    $email      =   $checker['email_account'];

                    $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
                }
            }
        } else {
            # code...
            for ($c = 0; $c < $checker_avail->rowCount(); $c++) {

                $full_name  =   $row[$c]['full_name'];
                $pet_id     =   $row[$c]['pet_id'];

                if (empty($row[$c]['email_account'])) {
                    // code...
                    $email      =   "No Email";
                } else {
                    $email      =   $row[$c]['email_account'];
                }

                $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
            }
        }
    } else {
        # code...
        for ($c = 0; $c < $checker_avail->rowCount(); $c++) {

            $full_name  =   $row[$c]['full_name'];
            $pet_id     =   $row[$c]['pet_id'];

            if (empty($row[$c]['email_account'])) {
                // code...
                $email      =   "No Email";
            } else {
                $email      =   $row[$c]['email_account'];
            }

            $personnel_list[] = "<option data-officer='checker' value='" . $full_name . ";" . $pet_id . ";" . $email . "'>" . $full_name . "</option>";
        }
    }
}elseif (strpos($role, "Approver") !== false && $status == "Newly Created" || $status == "For Approval") {
    $endorse = endorsetoMIS($requestor, $fullname);

    $header     = $endorse[0];
    $list       = $endorse[1];
    $endorse_to = "Update";
}







function endorsetoChecker($requestor,$fullname){
    $header = "<h5>Endorsement to Checker";
    $list = '<option> </option>
    <option value="Endorsed to Checker">Checker</option>';

    return array($header, $list);
}

function endorsetoCheckerApprover($requestor,$fullname){
    $header = "<h5>Endorsement to Checker or Approver";
    $list = '<option> </option>
    <option value="Endorsed to Checker">Checker</option>
    <option value="Endorsed to Approver">Approver</option>
    <option value="No Good">Requestor(No Good)</option>';

    return array($header, $list);
}

function endorsetoApprover($requestor,$fullname){
    if($requestor == $fullname){
        $header = "<h5>Endorsement to Approver";
        $list   = '<option> </option>
        <option value="Endorsed to Approver">Approver</option>';
    }else{
        $header = "<h5>Endorsement to Approver";
        $list   = '<option> </option>
        <option value="Endorsed to Approver">Approver</option>
        <option value="No Good">Requestor(No Good)</option>';
    }

    return array($header, $list);
}

function endorsetoApproverMIS($requestor,$fullname){
    $header = "<h5>Endorsement to Approver or MIS";
    $list = '<option> </option>
    <option value="Endorsed to Approver">Approver</option>
    <option value="Endorsed to MIS">MIS</option>
    <option value="No Good">Requestor(No Good)</option>';

    return array($header, $list);
}

function endorsetoMIS($requestor,$fullname){
    if($requestor == $fullname){
        $header = "<h5>Endorsement to MIS";
        $list   = '
        <option value="Endorsed to MIS">MIS</option>';
    }else{
        $header = "<h5>Endorsement to MIS";
        $list   = '<option> </option>
        <option value="Endorsed to MIS">MIS</option>
        <option value="No Good">Requestor(No Good)</option>';
    }

    return array($header, $list);
}

function MISmember($site){

    $mis_member = new Employees();
    /*
    if ($site == "HO") {
        // code...
        $site = "MNL";
    }else{
        $site = "ILO";
    }

    $mis_member->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id Left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.department = 'MIS' and emp_info.branch ='$site' ");
    */
    $mis_member->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id Left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.pet_id like '%-admin%' ");
    $mis_member->execute();



    $mm_list = array();

    $row = $mis_member->resultset();

    for($mm = 0; $mm < $mis_member->rowCount(); $mm++ ){

        $mm_list[] = "<option value='".$row[$mm]['full_name'].";".$row[$mm]['pet_id'].";".$row[$mm]['email_account']."'>".$row[$mm]['full_name']."</option>";

    }

    return $mm_list;

}

function MISChecker(){

    $mis_member = new Employees();

    $mis_member->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id Left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.department = 'MIS' and emp_srs.role like '%SRS Checker%' ");
    $mis_member->execute();


    $mm_list = array();

    $row = $mis_member->resultset();

     for($mm = 0; $mm < $mis_member->rowCount(); $mm++ ){

         $mm_list[] = "<option value='".$row[$mm]['full_name'].";".$row[$mm]['pet_id'].";".$row[$mm]['email_account']."'>".$row[$mm]['full_name']."</option>";
     }

    return $mm_list;

}
?>

<!--- User Button ----------->

<div class="modal fade bd-example-modal-md" id="endorse-back" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                <h5>Endorsement to MIS</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Endorse to:</label>
                        <div class="col-6">
                            <select name="status" class="custom-select" required>
                                <option value="Endorsed to MIS">MIS</option>
                            </select>
                        </div>
                    </div>
                    
                    <div name="remarks" class="row py-3">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">
                        <input type="hidden" name="role" value="<?php echo $rqst_date;?>">
                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update" onClick="checkDate_needed('<?php echo $rqst_date;?>','<?php echo date('Y-m-d H:i');?>','<?php echo $site;?>','<?php echo $rqst;?>')">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="endorsment-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                <?php
                    echo $header;
                ?>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Endorse to:</label>
                        <div class="col-6">
                            <select name="status" class="custom-select" required>
                                <?php
                                    echo $list;
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php 
                    
                    // WHE Request CSR-0614-19
                    
                    ?>

                    <div name="officer" class="row">
                        <label class="col-3 col-form-label text-right officer-role"><?php //echo $endorse_to; ?></label>
                        <div class="col-6">

                            <select name="officer" class="custom-select" >
                                <option value=""> </option>
                                <?php
                                    print_r($personnel_list);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div name="remarks" class="row py-3">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">
                        <input type="hidden" name="request_date" value="<?php echo $rqst_date;?>">
                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update" onClick="checkDate_needed('<?php echo $rqst_date;?>','<?php echo date('Y-m-d H:i');?>','<?php echo $site;?>','<?php echo $rqst;?>')">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="complete-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                    <h5>Complete Result</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Feedback:</label>
                        <div class="col-6">
                            <select name="status" class="custom-select" required>
                                <option value=""></option>
                                <option value="Completed">Complete</option>
                                <option value="Rejected">Reject</option>
                            </select>
                        </div>
                    </div>
                    <div name="remarks" class="row py-3">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="assigned_to" value="<?php echo $assigned_to;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade bd-example-modal-md" id="close-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Close Request</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Checker:</label>
                        <div class="col-6">
                            <select name="status" class="custom-select" required>
                                <option value=""></option>
                                <option value="Closed">Closed</option>
                                <option value="Re-assess to in charge">Re-assess</option>
                                
                            </select>
                        </div>
                    </div>
                    <div name="remarks" class="row py-3">
                        <input type="hidden" name="assigned_to" value="<?php echo $assigned_to;?>">
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="confirm-done-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                    <h5>Done Request</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right">Checker:</label>
                        <div class="col-6">
                            <select name="officer" class="custom-select" required>
                                <option value=""> </option>
                                <?php

                                $mis_chckr = MISChecker();
                                print_r($mis_chckr);

                                ?>
                            </select>
                        </div>
                    </div>
                    <div name="remarks" class="row">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="status" value="MIS Checker">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="done-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                    <h5>Done Request</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Status:</label>
                        <select name="status" class="custom-select col-3 ml-3" required>
                                <option value="Done">Done</option>
                            </select>
                    </div>
                    <div name="remarks" class="row py-3">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="assigned_to" value="<?php echo $requestor;?>">
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <textarea class="col-form-label text-left ml-3" name="update_message" required></textarea>
                    </div>

                    <div class="row">
                        <label for="" class="col-3 col-form-label text-right font-weight-bold">Hours:</label>
                        
                        <input type="number" class="form-control col-3 ml-3">
                        <div class="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade bd-example-modal-md" id="acknowledge-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                    <h5>Acknowledge Request</h5>
                </div>
                <div class="card-block">
                    <div name="remarks" class="row form-group">
                        
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="status" value="Work in Progress">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">
                        <input type="hidden" name="request" value="<?php echo $rqst;?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                        <div class="col-4"></div>
                        
                        
                    </div>
                    <?php 
                    
                        if ($rqst == "Software Purchase" || $rqst == "Hardware Purchase" || $rqst == "Renewal License" ) {
                            ?>
                                <div class="row form-group">
                                    <label class="col-3 col-form-label text-right font-weight-bold">PRIF #:</label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="prif_no" required>
                                    </div>
                                </div>
                            <?php
                        }elseif(strpos(strtoupper($prcss_no), 'CPR') !== false) {
                            ?>
                                <div class="row form-group">
                                    <label class="col-3 col-form-label text-right font-weight-bold"></label>
                                    <div class="col-5">
                                    <small id="fileHelp" class="form-text text-muted">(Number of Affected User/s)</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-3 col-form-label text-right font-weight-bold"></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="num_affected" required>
                                    </div>
                                </div>
                            <?php
                        } else {
                        }
                    
                    ?>
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update" id="acknowledge">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="worklog-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-header">
                    <h5>Add work log</h5>
                </div>
                <div class="card-block">
                    <div name="remarks" class="row py-3">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="status" value="<?php echo $status; ?>">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">
                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        
                        <textarea class="col-form-label text-left ml-3" name="worklog_message" required></textarea>
                    </div>

                    <div class="row">
                        <label for="" class="col-3 col-form-label text-right font-weight-bold">Hours:</label>
                        
                        <input type="number" class="form-control col-3 ml-3">
                        <div class="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="submit_worklog">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="delete-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md " role="document">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Request Form</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="">
                        
                            <input type="hidden" name="assigned_to" value="<?php echo $assigned_to;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                            <input type="hidden" name="edit_by" value="<?php echo $fullname; ?>">
                            <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                            <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="status" value="Deleted">
                            <h6 class="pl-3">Are you sure you want to Cancel this request?</h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-success" name="delete_request">Yes</button>
                    </div>
                    <div class="col-md-5">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="mis-endorse-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" onsubmit="spinner();">
            <div class="card">
                <div class="card-block">
                    <div class="row">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo strtoupper($prcss_no);?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="needed_date" value="<?php echo strtoupper($prcss_no);?>">

                        <label class="col-2 col-form-label text-right font-weight-bold">Control No:</label>

                        <?php
                        

                        
                        ?>


                        <label class="col-2 col-form-label text-left"><?php echo strtoupper($prcss_no);?></label>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <label class="col-2 col-form-label text-right font-weight-bold">Receive by:</label>
                        <label class="col-3 col-md-4 col-form-label text-left"><?php echo $fullname;?></label>
                        <label class="col-2 col-form-label text-right font-weight-bold">Receive date:</label>
                        <label class="col-3 col-md-4 col-form-label text-left"><?php echo date('m/d/Y');?></label>

                        <input type="hidden" name="received_by" value="<?php echo $fullname;?>">
                        <input type="hidden" name="received_id" value="<?php echo $sam;?>">
                        <input type="hidden" name="received_date" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <label class="col-2 col-form-label text-right font-weight-bold">Assign to:</label>
                        <select name="assign_to" class="col-3 col-md-4 custom-select" required>
                            <option value=""> </option>
                            <?php
                                $mis_mem = MISmember($site);
                                print_r($mis_mem);
                            ?>
                        </select>
                        <label class="col-2 col-form-label text-right font-weight-bold">Assign date:</label>
                        <label class="col-3 col-md-4 col-form-label text-left"><?php echo date('m/d/Y');?></label>

                        <input type="hidden" name="assign_date" value="<?php echo date('Y-m-d H:i');?>">
                    </div>

                    <?php

                    if(strtoupper($prcss_no) == "CSR" || strtoupper(substr($prcss_no,0,3)) == "CSR"){

                        ?>
                        <input type="hidden" name="request_category" value="<?php echo $rqst; ?>">
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <label class="col-3 col-form-label text-right font-weight-bold">Date Needed Change :</label>
                            <div class="btn-group">
                                <label class="btn btn-primary">
                                    <input type="radio" name="date_change" id="option5" value="Yes"> Yes
                                </label>

                                <label class="btn btn-danger">
                                    <input type="radio" name="date_change" id="option5" value="No" required> No
                                </label>
                            </div>
                            <label name="adjust_date" class="col-3 col-form-label text-right">Adjusted date:</label>
                            <div name="adjust_date" class="col-3">
                                <input class="form-control text-center" type="date" name="adjusted_date">
                            </div>
                        </div>
                        <?php
                    }elseif(strtoupper($prcss_no) == "CPR" || strtoupper($prcss_no[0]) == "CPR"){
                        //echo cprEndorsement();
                        ?>
                            <input type="hidden" name="request_category" value="<?php echo $rqst; ?>">
                        <?php
                    }elseif(strtoupper($prcss_no) == "DRR" || strtoupper($prcss_no[0]) == "DRR"){
                        //echo drrEndorsement();
                        ?>
                            <input type="hidden" name="request_category" value="<?php echo $rqst; ?>">
                        <?php
                    }

                    ?>
                    <div class="dropdown-divider"></div>
                    <div name="remarks" class="row">
                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <small id="fileHelp" class="form-text text-muted">(Message to assign in charge)</small>

                            <textarea class="col-form-label text-left" name="message_to_incharge" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="endorse_request">Endorse Request</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="modal fade bd-example-modal-lg" id="change-date-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Date Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="">
                                <input type="hidden" name="edit_by" value="<?php echo $fullname; ?>">
                                <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                                <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                                <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                                <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                                <input type="hidden" name="needed_date" value="<?php echo $rqst_date;?>">
                                <input type="hidden" name="checker" value="<?php echo $checker;?>">
                                <input type="hidden" name="approver" value="<?php echo $approver;?>">
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label class="col-form-label font-weight-bold">Date Needed to:</label>
                        </div>
                        <input type="text" class="change_csr_datetime form-control col-6" name="change_csr_datetime" value="" readonly>

                        <div class="col-md-2"></div>
                    </div>

                    <div class="row py-3">
                        <div class="col-4 text-right font-weight-bold">
                            <labe>Reasons :</labe>
                        </div>
                        <textarea name="reasons_dtls" class="form-control col-6" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary" name="change">Submit</button>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="modal fade bd-example-modal-lg" id="change-date-respond-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Date Respond</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="">
                                <input type="hidden" name="edit_by" value="<?php echo $fullname; ?>">
                                <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                                <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                                <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                                <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                                <input type="hidden" name="needed_date" value="<?php echo $rqst_date;?>">
                                <input type="hidden" name="checker" value="<?php echo $checker;?>">
                                <input type="hidden" name="approver" value="<?php echo $approver;?>">
                                <input type="hidden" name="cd_request" value="<?php echo $cd_request;?>">
                                <input type="hidden" name="assigned_to" value="<?php echo $assigned_to;?>">
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label class="col-form-label font-weight-bold">Respond:</label>
                        </div>

                        <select name="respond" id="" class="form-control col-6">
                            <option value=""> -- </option>
                            <option value="Ok"> OK </option>
                            <option value="No Good"> No Good </option>
                        </select>

                        <div class="col-md-2"></div>
                    </div>

                    <div class="row py-3">
                        <div class="col-4 text-right font-weight-bold">
                            <labe>Reasons :</labe>
                        </div>
                        <textarea name="respond_dtls" class="form-control col-6" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-success" name="change_respond">Submit</button>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="modal fade bd-example-modal-lg" id="update-date-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Date Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="">
                                <input type="hidden" name="edit_by" value="<?php echo $fullname; ?>">
                                <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                                <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                                    <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                                    <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                                <input type="hidden" name="created_date" value="<?php echo $crtd_date;?>">
                                <input type="hidden" name="needed_date" value="<?php echo $rqst_date;?>">
                            </div>
                        </div>
                        <?php

                        $prcss = explode("-",$prcss_no);

                        $new_crtd_date = date("m/d/Y", strtotime($crtd_date));
                        $new_rqst_date = date("m/d/Y", strtotime($rqst_date));

                        if($prcss[0] == "CSR"){
                            //echo "Computer System Request";

                        ?>

                        <input type="hidden" name="prcss_name" value="<?php echo $prcss[0];?>">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label ">Requet Date:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="" class="form-control update_datetime" name="crtd_date_change" value="<?php echo $new_crtd_date;?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label ">Needed Date:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="" class="form-control update_datetime" name="rqstd_date_change" value="<?php echo $new_rqst_date;?>" readonly>
                            </div>

                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <label class="col-md-3 col-form-label ">Date Needed change:</label>
                            <div class="btn-group col-md-3">
                                <label class="btn btn-primary">
                                    <input type="radio" name="date_change" id="option5" value="Yes"> Yes
                                </label>

                                <label class="btn btn-danger">
                                    <input type="radio" name="date_change" id="option5" value="No" required> No
                                </label>
                            </div>
                            <label name="adjust_date" class="col-3 col-form-label ">Adjusted date:</label>
                            <div name="adjust_date" class="col-3">
                                <input class="form-control text-center" type="date" name="adjusted_date">
                            </div>
                        </div>
                        <?php
                        }elseif($prcss[0] == "CPR"){
                            echo "Computer Problem Report";
                        ?>
                        <input type="hidden" name="prcss_name" value="<?php echo $prcss[0];?>">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label ">Requet Date:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="" class="form-control update_datetime" name="crtd_date_change" value="<?php echo $new_crtd_date;?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label ">Occured Date:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="" class="form-control update_datetime" name="rqstd_date_change" value="<?php echo $new_rqst_date;?>" readonly>
                            </div>

                        </div>

                        <?php
                        }elseif($prcss[0] == "DRR"){
                            echo "Data Recovery Request";
                        }elseif($prcss[0] == "QA"){
                            echo "Quick Assistance";
                        }

                        ?>

                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary" name="update_date">Update Date</button>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

function csrEndorsement(){
?>


<?php
}

function cprEndorsement(){
?>
<div class="row">
    <label class="col-md-3 col-form-label text-right">Problem Category:</label>
    <div class="col-md-4">
        <small id="fileHelp" class="form-text text-muted">(Choose one only)</small>
        <select class="custom-select" name="problem_category" required>
            <option ></option>
            <optgroup label="Hardware">
                <option value="Keyboard">Keyboard</option>
                <option value="Mouse">Mouse</option>
                <option value="Monitor">Monitor</option>
                <option value="Printer/Plotter">Printer/Plotter</option>
                <option value="IP Phone">IP Phone</option>
                <option value="Projector">Projector</option>
                <option value="Laptop">Laptop</option>
                <option value="PC Power Supply">PC Power Supply</option>
                <option value="PC Harddisk">PC Harddisk</option>
                <option value="PC Ram">PC Ram</option>
                <option value="PC Video Card">PC Video Card</option>
                <option value="WS Power Supply">WS Power Supply</option>
                <option value="WS Harddisk">WS Harddisk</option>
                <option value="WS Ram">WS Ram</option>
                <option value="WS Video Card">WS Video Card</option>
            </optgroup>
            <optgroup label="Software">
                <option value="Operating System">Operating System</option>
                <option value="Solidworks">Solidworks</option>
                <option value="Catia">Catia</option>
                <option value="Matlab">Matlab</option>
                <option value="Mentor Graphics">Mentor Graphics</option>
                <option value="CR5000">CR5000</option>
                <option value="KSWAD">KSWAD</option>
                <option value="MS Office">MS Office</option>
				<option value="Software Canalyzer">Software Canalyzer</option>
            <optgroup label="Network">
                <option value="No Connection">No Connection</option>
            </optgroup>
        </select>
    </div>
</div>

<?php
}

function drrEndorsement(){
?>
<div class="row">
    <label class="col-3 col-form-label text-right">Fileserver:</label>
    <div class="col-3 col-md-4">
        <select class="custom-select" name="file_server" required>
            <option ></option>
            <option value="Cae">Cae</option>
            <option value="Windows">Windows </option>
        </select>
    </div>
</div>
<?php
}

?>

<div class="modal fade bd-example-modal-md" id="return-request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Return Request</h5>
                </div>
                <div class="card-block">
                    <div name="remarks" class="row">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                            <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                            <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="status" value="Return">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="cancel-request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Cancel Request</h5>
                </div>
                <div class="card-block">
                    <div name="remarks" class="row">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        
                        <input type="hidden" name="checker" value="<?php echo $checker;?>">
                        <input type="hidden" name="approver" value="<?php echo $approver;?>">

                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="status" value="Cancelled">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="update">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade bd-example-modal-md" id="return-cancelled-request-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Return Request</h5>
                </div>
                <div class="card-block">
                    <div name="remarks" class="row">

                        <input type="hidden" name="ic_no" value="<?php echo $ic_no;?>">
                        <input type="hidden" name="prcss" value="<?php echo $prcss_no;?>">
                        <input type="hidden" name="requestor" value="<?php echo $requestor;?>">
                        <input type="hidden" name="requestor_id" value="<?php echo $requestor_id;?>">
                        <input type="hidden" name="department" value="<?php echo $department;?>">
                        <input type="hidden" name="role" value="<?php echo $role;?>">
                        <input type="hidden" name="personnel" value="<?php echo $fullname;?>">
                        <input type="hidden" name="assigned_to" value="<?php echo $assigned_to;?>">
                        <input type="hidden" name="status" value="Assigned">
                        <input type="hidden" name="date_log" value="<?php echo date('Y-m-d H:i');?>">

                        <label class="col-3 col-form-label text-right font-weight-bold">Remarks:</label>
                        <div class="col-5">
                            <textarea class="col-form-label text-left" name="update_message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-3" name="decline">Submit</button>
                        <div class="col-2"></div>
                        <button type="button" class="btn btn-secondary col-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

