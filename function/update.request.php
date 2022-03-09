<?php

if (isset($_POST['edit'])) {
    if (isset($_POST['prcss']) || !empty($_POST['prcss'])) {

        $ic_no                  = $_POST['ic_no'];
        //$ic_id                  = $_POST['ic_id'];
        $prcss                  = $_POST['prcss'];
        $rqst_date              = $_POST['request_date'];

        if (!empty($_FILES['file'])) {
            foreach ($_FILES['file']['name'] as $size => $val) {
                $tmp_size = $_FILES['file']['name'][$size];
                //echo $tmp_size;
            }
            if (!empty($tmp_size)) {
                $tmp_path = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
            } else {
                $tmp_path = "";
                $file_name = "";
            }
        } else {
            $tmp_path = "";
            $file_name = "";
        }

        if (stristr($prcss, 'CSR') !== false) {

            if (empty($file_name)) {
                $filename = "No attachment / Attachment not remove";
            } else {
                $filename = "";
                foreach ($file_name as $key => $val) {
                    $upload_file_name = $file_name[$key];
                    $filename .= $upload_file_name . ",";
                }
            }

            $date_request_req   = DateTime::createFromFormat('m/d/Y H:i', $rqst_date);
            $request_date       = $date_request_req->format('Y-m-d H:i');

            //$request_dtls       = $_POST['ip_address'].";".$_POST['request_dtls'];
            $request_dtls       = $_POST['request_dtls'];

            $wrklg_dtls         = "Date Needed: " . $_POST['request_date'] . "<br>" . "Ip address: " . $_POST['ip_address'] . "<br>" . "Details: " . $_POST['request_dtls'] . "<br> Attachment:" . $filename;
        } elseif (stristr($prcss, 'CPR') !== false) {

            if (empty($file_name)) {
                $filename = "No attachment / Attachment not remove";
            } else {
                $filename = "";
                foreach ($file_name as $key => $val) {
                    $upload_file_name = $file_name[$key];
                    $filename .= $upload_file_name . ",";
                }
            }
			
            $date_request_req   = DateTime::createFromFormat('m/d/Y H:i', $rqst_date);
            $request_date       = $date_request_req->format('Y-m-d H:i');
			
            $request_dtls       = $_POST['ip_address'] . ";" . $_POST['request_dtls'];

            $wrklg_dtls         = "Date Needed: " . $_POST['request_date'] . "<br>" . "Ip address: " . $_POST['ip_address'] . "<br>" . "Details: " . $_POST['request_dtls'] . "<br> Attachment:" . $filename;
        } elseif (stristr($prcss, 'DRR') !== false) {

            if (empty($file_name)) {
                $filename = "No attachment / Attachment not remove";
            } else {
                $filename = "";
                foreach ($file_name as $key => $val) {
                    $upload_file_name = $file_name[$key];
                    $filename .= $upload_file_name . ",";
                }
            }

            $date_request_req   = DateTime::createFromFormat('m/d/Y H:i', $rqst_date);
            $request_date       = $date_request_req->format('Y-m-d H:i');

            if ($_POST['option_directory'] == "Original Directory") {
                $directory_info = $_POST['option_directory'];
            } else {
                $directory_info = $_POST['other_location'];
            }

            $request_dtls        = $_POST['filename'] . ";" . $_POST['file_location'] . ";" . $directory_info . ";" . $_POST['option_overwrite'] . ";" . $_POST['request_dtls'];

            $wrklg_dtls         = "File name: " . $_POST['filename'] . "<br>" . "File location: " . $_POST['file_location'] . "<br>" . "Restore to: " . $directory_info . "<br>" . "Overwrite File: " . $_POST['option_overwrite'] . "<br>" . "Reason/s: " . $_POST['request_dtls'] . "<br> Attachment:" . $filename;
        }

        echo editRequest($ic_no, $prcss, $request_date, $request_dtls, $tmp_path, $file_name);


        $edit_by                = $_POST['edit_by'];
        $ic_status              = "Edited";
        $date_log               = date('Y-m-d H:i');
        addWorklog($ic_no, $date_log, $ic_status, $wrklg_dtls, $edit_by, "");
    }
}


if (isset($_POST['decline'])) {
    # code...
    $ic_no                = $_POST['ic_no'];
    $prcss                = $_POST['prcss'];
    $requestor            = $_POST['requestor'];
    $personnel            = $_POST['personnel'];
    $department           = $_POST['department'];
    $role                 = $_POST['role'];
    $status               = $_POST['status'];
    $date_log             = $_POST['date_log'];
    $update_message       = $_POST['update_message'];

    $assigned_to = $_POST['assigned_to'];

    addWorklog($ic_no, $date_log, $status, $update_message, "SRS", $assigned_to);

    $reendorse     = new Report();

    $reendorse->query("Update srvcrqst set ic_status=:status, in_charge=:in_charge where ic_no=:ic_no");
    $reendorse->bind(":in_charge", $assigned_to);
    $reendorse->bind(":status", $status);
    $reendorse->bind(":ic_no", $ic_no);
    $reendorse->execute();


    $to      = getEmail($assigned_to);
    $subject = 'Service Request ' . strtoupper($prcss) . ' ' . $status;
    $message = 'Hello ' . $assigned_to . '<br>
                        <br>
                        ' . $requestor . ' was decline the cancellation of this Request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . strtoupper($prcss) . '</a> please check the work log<br>
                        <br>
                        Thank you,<br>
                        Service Request System';

    $send_mail = new Email();

    $cc = "smb_srs.pet@ph.yazaki.com";
      //  echo $to." test";
    if( $send_mail->send($to, $subject, $message, $cc)){
        
        echo "<script>
                alert('Request Returned to MIS');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
        
    }else{
            echo "<script>
                    alert('Email not sent');
                    window.location.href = 'view.php?ic=" . $ic_no . "';
                </script>";
    }
}

if (isset($_POST['endorse_request'])) {

    $ic_status          = "Assigned";
    //$ic_id              = $_POST['ic_id'];
    $ic_no              = $_POST['ic_no'];
    $received_by        = $_POST['received_by'];
    $received_date      = $_POST['received_date'];

    $assigned           = array_filter(explode(";", $_POST['assign_to']));
    $assigned_to        = $assigned[0];
    $assigned_email     = $assigned[2];
    $assigned_date      = $_POST['assign_date'];

    switch ($_POST['prcss']) {

        case "CSR":
            $needed_date        = $_POST['needed_date'];
            $date_changed       = $_POST['date_change'];
            $adjusted_date      = $_POST['adjusted_date'];
            $request_category   = $_POST['request_category'];

            echo createCsr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $date_changed, $adjusted_date, $needed_date, $request_category);
            break;

        case "CPR":

            $occured_date       = $_POST['needed_date'];
            $problem_category   = $_POST['request_category'];

            echo createCpr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $occured_date, $problem_category);
            break;

        case "DRR":

            $recover_date       = $_POST['needed_date'];
            $file_server         = $_POST['request_category'];

            echo createDrr($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date, $recover_date, $file_server);
            break;

        case "QA":

            echo createQa($ic_status, $ic_no, $received_by, $received_date, $assigned_to, $assigned_date);

            break;

        default:

            $reendorse     = new Report();

            $reendorse->query("Update srvcrqst set ic_status=:status, assigned_to=:assigned_to, assigned_date=:assigned_date, in_charge=:in_charge where ic_no=:ic_no");
            $reendorse->bind(":assigned_to", $assigned_to);
            $reendorse->bind(":in_charge", $assigned_to);
            $reendorse->bind(":assigned_date", $assigned_date);
            $reendorse->bind(":status", $ic_status);
            $reendorse->bind(":ic_no", $ic_no);
            $reendorse->execute();


            break;
    }

    $date_log               = date('Y-m-d H:i');
    $acknowledge_message    = $_POST['message_to_incharge'];
    $personnel              = $_POST['received_by'];

    addWorklog($ic_no, $date_log, $ic_status, $acknowledge_message, $received_by, $assigned_to);
    
    /*
    $mail->From = 'smb_srs.pet@ph.yazaki.com';
    $mail->FromName = '[SRS Endorsement]';

    //$mail->setFrom('smb_srs.pet@ph.yazaki.com', 'Mailer');
    $mail->addReplyTo('smb_srs.pet@ph.yazaki.com', 'Information');
    $mail->addCC('smb_srs.pet@ph.yazaki.com');
    $mail->Priority = 1;
    */

    if (!empty($assigned_email)) {
        $to      = $assigned_email;
        $subject = 'Service Request ' . $ic_no . " " . $ic_status;
        $message = '
                Hello ' . $assigned_to . '<br>
                <br>
                 A new request is assigned to you by ' . $received_by . '<br> reference no. <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no . '</a> is endorsed to you with message:<br>
                 <br>
                 ' . $acknowledge_message . '<br>
                <br>
                Thank you,<br>';

        /*
        $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            "from: smb_srs.pet@ph.yazaki.com" . "\n" . //creating headers
            "reply-to: smb_srs.pet@ph.yazaki.com" . "\n" . //creating headers
            "X-Priority: 1\n" . //headers for priority
            "Priority: Urgent\n" . //headers for priority
            "Importance: high";
            */
        //mail($to, $subject, $message, $headers);
            /*
            $mail->AddAddress($assigned_email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            if (!$mail->Send()) {
                return "Message could not be sent.";
                return "Mailer Error: " . $mail->ErrorInfo;
                exit;
            } else {
                echo "<script>
		                    alert('Sent Approved request to MIS');
                            window.location.href = 'view.php?ic=" . $ic_no . "';
		                    </script>";
            }
            */
        
         $send_mail = new Email();
        
        $send_mail->send($to, $subject, $message);
        
    }
    //alert('Sent to ".$assigned_email."');

    echo "<script>
            window.location.href = 'requestpool.php?status=New%20Request';
        </script>";
}


if (isset($_POST['delete_request'])) {

    $ic_no = $_POST['ic_no'];

    $del_req    = new Report();

    $del_req->query("Delete from srvcrqst where ic_no=:ic_no");
    $del_req->bind(':ic_no', $ic_no);


    if ($del_req->execute() > 0) {
        echo "<script>
                    alert('Your request is now deleted.');
                    window.location.href = 'index.php';
                    </script>";

        $del_req->query("Delete from wrklg where ic_id=:ic_no");
        $del_req->bind(':ic_no', $ic_no);
        $del_req->execute();
    }

    $assigned_email = getEmail($_POST['assigned_to']);

    $to      = $assigned_email;
    $subject = 'Service Request ' . $ic_no . " " . $status;
    $message = '
                Hello ' . $assigned_to . '<br>
                <br>
                 A request assigned to you is know Cancelled by the requestor with reference no. <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no . '</a> <br>
                 <br>
                <br>
                Thank you,<br>
                Service Request System';

    $send_mail = new Email();
    //  echo $to." test";
    if( $send_mail->send($to, $subject, $message)){
                  
        echo "<script>
                alert('Your request is now Cancelled and sent email to assigned MIS Endorsed');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
                  
    }else{
        echo "<script>
               alert('Email not sent');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
    }
}

function editRequest($ic_no, $prcss, $request_date, $request_dtls, $tmp_path, $file_name)
{

    $ic_year = "ic_" . date("Y");

    if (!empty($file_name)) {
        $dir_name = "attachments/" . $ic_no;
        if (file_exists($dir_name)) {
            $uploads_dir = "$dir_name";

            $upload_file = "";
            foreach ($file_name as $key => $val) {
                $upload_file_path = $tmp_path[$key];
                $upload_file_name = $file_name[$key];
                move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                $upload_file .= $uploads_dir . "/" . $upload_file_name . ",";
            }
        } else {
            mkdir("$dir_name");
            $uploads_dir = "$dir_name";

            $upload_file = "";
            foreach ($file_name as $key => $val) {
                $upload_file_path = $tmp_path[$key];
                $upload_file_name = $file_name[$key];
                move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                $upload_file .= $uploads_dir . "/" . $upload_file_name . ",";
            }
        }
    } else {

        $upload_file = "No attached file";
    }
    
    $edit_query = new Report();
    
    if (strpos($request_dtls, ';') !== false) {
        //echo 'true';
        
        $details    = explode(";",$request_dtls);
        
        if(count($details) > 2){
            
            
        $edit_query->query("Update srvcrqst set ic_rqst_date=:ic_rqst_date, ic_dtls=:ic_dtls, ic_attachment=:ic_attachment where ic_no=:ic_no");
        $edit_query->bind(':ic_no', $ic_no);
        $edit_query->bind(':ic_rqst_date', $request_date);
        $edit_query->bind(':ic_dtls', $request_dtls);
        $edit_query->bind(':ic_attachment', $upload_file);
        $edit_query->execute();
            
        }else{
            
            
        $edit_query->query("Update srvcrqst set ic_rqst_date=:ic_rqst_date, ic_ipadd=:ic_ipadd, ic_dtls=:ic_dtls, ic_attachment=:ic_attachment where ic_no=:ic_no");
        $edit_query->bind(':ic_no', $ic_no);
        $edit_query->bind(':ic_rqst_date', $request_date);
        $edit_query->bind(':ic_ipadd', $details[0]);
        $edit_query->bind(':ic_dtls', $details[1]);
        $edit_query->bind(':ic_attachment', $upload_file);
        $edit_query->execute();
            
        }
    }else {
        
        $edit_query->query("Update srvcrqst set ic_rqst_date=:ic_rqst_date, ic_dtls=:ic_dtls, ic_attachment=:ic_attachment where ic_no=:ic_no");
        $edit_query->bind(':ic_no', $ic_no);
        $edit_query->bind(':ic_rqst_date', $request_date);
        $edit_query->bind(':ic_dtls', $request_dtls);
        $edit_query->bind(':ic_attachment', $upload_file);
        $edit_query->execute();
        
    }

    
    header("Location:view.php?ic=$ic_no");
}




if (isset($_POST['update'])) {

    $ic_no                = $_POST['ic_no'];
    $prcss                = $_POST['prcss'];
    $requestor            = $_POST['requestor'];
    $personnel            = $_POST['personnel'];
    $department           = $_POST['department'];
    $role                 = $_POST['role'];
    $status               = $_POST['status'];
    $date_log             = $_POST['date_log'];
    $update_message       = $_POST['update_message'];
    $prif                 = isset($_POST['prif_no']) ? $_POST['prif_no'] : null; //if prif_no isset get the value if not equals null
    $num_affected         = isset($_POST['num_affected']) ? $_POST['num_affected'] : null; //if num_affected isset get the value if not equals null

    if (!empty($_POST['officer'])) {
        $checker_info       = array_filter(explode(";", $_POST['officer']));

        $checker            = $checker_info[0];
        $checker_petid      = $checker_info[1];


        if (empty($checker_info[2]) or $checker_info[2] == "No Email") {
            $checker_email  = "smb_srs.pet@ph.yazaki.com";
        } else {
            $checker_email  = $checker_info[2];
        }
    } elseif (!empty($_POST['assigned_to'])) {
        $checker            = $_POST['assigned_to'];
    } else {
        $checker            = "";
    }

    addWorklog($ic_no, $date_log, $status, $update_message, $personnel, $checker);

    $subject = 'Service Request ' . $ic_no . " " . $status;

    $requestor         = $_POST['requestor'];
    $requestor_id    = $_POST['requestor_id'];

    $requestor_email =  getEmail($requestor);

    if (empty($requestor_email)) {
        /*
        $requestor_email = "";
        $headers .= "Cc: smb_srs.pet@ph.yazaki.com " . "\r\n";
        */
        $to = "smb_srs.pet@ph.yazaki.com";
        $cc = "";
        } else {
        //$headers .= "Cc: $requestor_email" . ", smb_srs.pet@ph.yazaki.com " . "\r\n";
        //$mail->addCC($requestor_email);
        $cc = $requestor_email;
    }
    
    
    
    

    switch($status){
    
        case 'Endorsed to Checker':
            
            $status = "For Checking";

            $to      = $checker_email;

            $message = 'Hello ' . $checker . '<br>
		                <br>
		                ' . $personnel . ' endorse this request to you <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no . '</a> with remarks of "' . $update_message . '", For your checking.<br>
		                <br>
		                Thank you,<br>
		                Service Request System';
            
            break;
            
            
        case 'Endorsed to Approver':
            
            $status = "For Approval";

            $approver    = $checker;

            $to      = $checker_email;

            $message = '
                        Hello ' . $approver . '<br>
                        <br>
                        ' . $personnel . ' endorse this request to you <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no . '</a> with remarks of "' . $update_message . '", For your Approval<br>
                        <br>
                        Thank you,<br>
                        Service Request System';
            break;
            
            
        case 'Endorsed to MIS':
            
            $status = "New Request";

            $requestor = $_POST['requestor'];

            $to = "smb_mis.pet@ph.yazaki.com";

            $message = 'Hello MIS<br>
	                    <br>
	                    A New Request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no . '</a> sent from ' . $department . ' with Requestor Name ' . $requestor . '<br>
	                    <br>
	                    Thank you,<br>
                        Service Request System';
            
            
            break;
            
        
        case "Rejected":
        case "Completed":
            
            $assigned_email =  getEmail($_POST['assigned_to']);
            $assigned_to    = $_POST['assigned_to'];
            
            echo  getEmail($_POST['assigned_to']);
            
                $to      = $assigned_email;
                $subject = 'Service Request ' . strtoupper($prcss) . ' ' . $status;
                $message = 'Hello ' . $assigned_to . '<br>
                            <br>
                            ' . $personnel . ' is ' . $status . ' your done request please check the information <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . strtoupper($prcss) . '</a> for your immediate assistance <br>
                            <br>
                            Thank you,<br>
                            Service Request System';
                
                break;
            
        case "Done":

            if (!empty($requestor_email)) {

                $to      = $requestor_email;

             
            } else {
                
                $to      = "smb_srs.pet@ph.yazaki.com";
                echo "<script>
                        alert('Requestor has no email account please inform him/her for his/her verification, Thank you');
                        window.location.href = 'view.php?ic=" . $ic_no . "';
                    </script>";
            }
            
            $message = 'Hello ' . $requestor . '<br>
                                <br>
                                ' . $personnel . ' of MIS is now done with your request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . strtoupper($prcss) . '</a> for your verification <br>
                                <br>
                                Thank you,<br>
                                Service Request System';
            break;
            
            
        case 'Endorse to Checker':
        case 'MIS Checker':
            // code... 

            $to      = $checker_email;
            $subject = 'Service Request ' . strtoupper($prcss) . ' ' . $status;
            $message = 'Hello ' . $checker . '<br>
    	                    <br>
    	                    ' . $personnel . ' is now completed this Request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . strtoupper($prcss) . '</a> please check<br>
    	                    <br>
    	                    Thank you,<br>
    	                    Service Request System';
            
            break;
            
        case 'Return':
            
            if (!empty($requestor_email)) {

                $to      = $requestor_email;

                $message = 'Hello ' . $requestor . '<br>
                            <br>
                            ' . $personnel . ' of MIS Returned your request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> with work log of "'. $update_message .'" for your Modification please and resend it once your done. <br>
                            <br>
                            If you have concern of question regarding to this request please call MIS<br>
                            <br>
                            Thank you,<br>
                            Service Request System';
            } else {
                
                $requestor_email =  getEmail($requestor);
                $to      = "smb_srs.pet@ph.yazaki.com";
                echo "<script>
                        alert('Requestor has no email account please inform him/her for his/her verification, Thank you');
                        window.location.href = 'view.php?ic=" . $ic_no . "';
                    </script>";
            }
            
            
            
            
            break;
            
        case 'No Good':
            
            if (!empty($requestor_email)) {

                $to      = $requestor_email;

                
            } else {
                
                $to      = "smb_srs.pet@ph.yazaki.com";
                echo "<script>
                        alert('Requestor has no email account please inform him/her for his/her verification, Thank you');
                        window.location.href = 'view.php?ic=" . $ic_no . "';
                    </script>";
            }
            
            $message = 'Hello ' . $requestor . '<br>
                            <br>
                            ' . $personnel . ' '. $status .' your request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> with work log of "'. $update_message .'" for your Modification please and resend it once your done. <br>
                            <br>
                            If you have concern of question regarding to this request please call MIS<br>
                            <br>
                            Thank you,<br>
                            Service Request System';
            
            
            break;

        case 'Cancelled':

            $cc = "";

            if (isset($_POST['assigned_to'])) {
                # code...
                $cc .= getEmail($_POST['assigned_to']);
            }
            

            if (isset($_POST['checker'])) {
                # code...
                $checker_email = getEmail($_POST['checker']);
            }

            if (isset($_POST['approver'])) {
                # code...
                $approver_email = getEmail($_POST['approver']);
            }

            if (!empty($requestor_email)) {

                if (!empty($approver_email)) {
                    $cc      .= $approver_email;
                }

                if (!empty($checker_email)) {
                    $cc      .= $checker_email;
                }

                $to      = $requestor_email;


                $message = 'Hello ' . $requestor . '<br>
                            <br>
                            ' . $personnel . ' of MIS Cancelled your request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> with remarks of "'. $update_message .'". <br>
                            If the remarks is true and you are aware of it please confirm, If not please contact the assigned personnel on this request to ask about the remarks and reject the cancellation.<br>
                            <br>
                            If you have concern of question regarding to this request please call MIS<br>
                            <br>
                            Thank you,<br>
                            Service Request System';
                
            } else {
                
                $to = " ";
                if (!empty($approver_email)) {
                    $to      .= $approver_email;
                }

                if (!empty($checker_email)) {
                    $to      .= $checker_email;
                }

                
                echo "<script>
                        alert('Requestor has no email account please inform him/her for his/her information, Thank you');
                        window.location.href = 'view.php?ic=" . $ic_no . "';
                    </script>";

                $message = 'Hello ' . $requestor . '<br>
                    <br>
                    ' . $personnel . ' of MIS Cancelled your member/s request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> with remarks of "'. $update_message .'". <br>
                    If the remarks is true and you are aware of it please confirm, If not please contact the assigned personnel on this request to ask about the remarks and reject the cancellation.<br>
                    <br>
                    If you have concern of question regarding to this request please call MIS<br>
                    <br>
                    Thank you,<br>
                    Service Request System';
            }
            

        break;

        
        
            
        default:
            
            echo "<script>
                    alert('Thank you!');
                    window.location.href = 'view.php?ic=" . $ic_no . "';
                </script>";
            
            
            
            break;
    }
    
    
    
    if ($status == "For Checking" || $status == "For Approval" || $status == "New Request" || $status == "Endorsed to MIS" ) {
        // code...
        $emp_info = getPersonnel($personnel);

        if (!empty($emp_info)) {
            // code...
            $firstname      = $emp_info[1];
            $mid_ini        = $emp_info[2];
            $lastname       = $emp_info[3];
            $fullname       = $emp_info[4];
            $department     = $emp_info[5];
            $petid          = $emp_info[0];

            generateStamp($ic_no, $fullname, $firstname, $mid_ini, $lastname, $petid, $department);
        }
    }

    
    if (strpos(strtoupper($prcss), 'CPR') !== false) {
        
        updateRequest($ic_no, $date_log, $num_affected, $prcss, $status, $checker);

    }else {

        echo "$status";
        updateRequest($ic_no, $date_log, $prif, $prcss, $status, $checker);

    }
    
    if($status == "Work in Progress" || $status == "Closed"){
        
    }else{
        $send_mail = new Email();
      //  echo $to." test";
        if( $send_mail->send($to, $subject, $message, $cc)){
        
        echo "<script>
                alert('Request Endorsed');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
        
        }else{
            echo "<script>
                    alert('Email not sent');
                    window.location.href = 'view.php?ic=" . $ic_no . "';
                </script>";
        }
    }
    

    
}



########## Request Change of Deadline

if (isset($_POST['change'])) {

    if (isset($_POST['request_category'])) {

        if (!empty($_POST['ic_no'])) {
            $ic_no                  = $_POST['ic_no'];
        }
        if (!empty($_POST['ic_id'])) {
            $ic_id                  = $_POST['ic_id'];
        }

        $prcss                  = $_POST['prcss'];
        $edit_by                = $_POST['edit_by'];
        $ic_status              = "Input Request Category";
        $date_log               = date('Y-m-d H:i', strtotime($_POST['date_log']));


        $reasons_dtls           = $_POST['request_category'];
        $input         = new Report();
        addWorklog($ic_no, $date_log, $ic_status, $reasons_dtls, $edit_by, "");

     
        if (strpos($prcss, "-") !== false) {
            // code...
            $xpld   = explode("-", $prcss);
            $prcss_tbl = $xpld[0] . "_20" . $xpld[2];

            //$input->query("Update $prcss_tbl set csr_rqst_ctgry=:csr_rqst_ctgry where csr_prcss_no=:prcss_no");

            $input->query("Update srvcrqst set ic_rqst = :csr_rqst_ctgry where prcss_no=:prcss_no");
            $input->bind(':prcss_no', $prcss);
            $input->bind(':csr_rqst_ctgry', $reasons_dtls);
            $input->execute();
        } else {

            $input->query("Update srvcrqst set ic_rqst = :csr_rqst_ctgry where ic_no=:ic_no");
            $input->bind(':ic_no', $ic_no);
            $input->bind(':csr_rqst_ctgry', $reasons_dtls);
            $input->execute();
        }


        echo "<script>
        alert('Update Done.');
        </script>";
    } elseif (isset($_POST['reasons_dtls'])) {

        $ic_no                  = $_POST['ic_no'];
        $prcss                  = $_POST['prcss'];
        $reasons                = $_POST['reasons_dtls'];

        $edit_by                = $_POST['edit_by'];
        $ic_status              = "Date Needed Changed Proposal";
        $date_log               = date('Y-m-d H:i');

        $requestor              = $_POST['requestor'];
        $checker                = $_POST['checker'];
        $approver               = $_POST['approver'];

        $status                 = "Change Deadline";

        $format = 'm/d/Y H:i';
        $date_request_pre           = $_POST['change_csr_datetime'];
        $date_request_req           = DateTime::createFromFormat($format, $date_request_pre);
        $change_csr_datetime        = $date_request_req->format('Y-m-d H:i');

        $input = new Report();

        $input->query("Update srvcrqst set cd_request = :change_csr_datetime, in_charge = :requestor where ic_no=:ic_no");
            $input->bind(':ic_no', $ic_no);
            $input->bind(':requestor', $requestor);
            $input->bind(':change_csr_datetime', $change_csr_datetime);
            $input->execute();

        $format = 'Y-m-d H:i';
        $needed_date           = date('Y-m-d H:i', strtotime($_POST['needed_date']));

        $reasons_dtls   = "Change deadline proposal <b>from: </b>" . $needed_date . " <b>to</b> " . $change_csr_datetime . "<br>" . $reasons;


        addWorklog($ic_no, $date_log, $ic_status, $reasons_dtls, $edit_by, "");
        echo "<script>
        alert('Change Date Needed Done.');
        </script>";

        $requestor_email = getEmail($requestor);
        $checker_email = getEmail($checker);
        $approver_email = getEmail($approver);
        $assigned_email = getEmail($edit_by);

        $subject = 'Service Request ' . $ic_no . " Change Deadline";

        if (isset($requestor_email)) {
            # code...
            $cc = [];
            $to = $requestor_email;

            if (isset($checker_email)) {
                # code...
                $cc = $checker_email;
            }

            if (isset($approver_email)) {
                # code...
                $cc = $approver_email;
            }

            if (isset($assigned_email)) {
                # code...
                $cc = $assigned_email;
            }
            
            $message = 'Hello ' . $requestor . '<br>
                            <br>
                            ' . $edit_by . ' of MIS Requesting to change deadline of your request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> <br>
                            <br>
                            If you have concern of question regarding to this request please call MIS<br>
                            <br>
                            Thank you,<br>
                            Service Request System';

        }else {
            # code...
            
            $to = "";
            if (isset($checker_email)) {
                # code...
                $to .= $checker_email;
            }

            if (isset($approver_email)) {
                # code...
                $to .= $approver_email;
            }

            $cc = $assigned_email;
            $message = 'Hello ' . $checker . ' '.''.$approver.'<br>
                    <br>
                    ' . $edit_by . ' of MIS Requesting to change deadline of your member/s request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> .<br>
                    <br>
                    If you have concern of question regarding to this request please call MIS<br>
                    <br>
                    Thank you,<br>
                    Service Request System';
        }
        
        $input         = new Report();
        $input->query("Update srvcrqst set ic_status = :ic_status where ic_no=:ic_no");
        $input->bind(':ic_no', $ic_no);
        $input->bind(':ic_status', $status);
        $input->execute();

        $send_mail = new Email();
      //  echo $to." test";
      if( $send_mail->send($to, $subject, $message, $cc)){
        
        echo "<script>
                alert('Request Endorsed');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
        
        }else{
            echo "<script>
                    alert('Email not sent');
                    window.location.href = 'view.php?ic=" . $ic_no . "';
                </script>";
        }
    }
}

if (isset($_POST['change_respond'])) {
    # code...

    $ic_no                  = $_POST['ic_no'];
    $prcss                  = $_POST['prcss'];
    $respond                = $_POST['respond'];

    $edit_by                = $_POST['edit_by'];
    $ic_status              = "Work in Progress";
    $date_log               = date('Y-m-d H:i');

    $requestor              = $_POST['requestor'];
    $checker                = $_POST['checker'];
    $approver               = $_POST['approver'];

    $status                 = "Work in Progress";

    $cd_request             = $_POST['cd_request'];
    $in_charge              = $_POST['assigned_to'];


    $input = new Report();

    $input->query("Update srvcrqst set ic_rqst_date = :cd_request, in_charge = :in_charge, ic_status = :ic_status where ic_no=:ic_no");
        $input->bind(':ic_no', $ic_no);
        $input->bind(':cd_request', $cd_request);
        $input->bind(':in_charge', $in_charge);
        $input->bind(':ic_status', $ic_status);
        $input->execute();

    $format = 'Y-m-d H:i';
    $needed_date           = date('Y-m-d H:i', strtotime($_POST['needed_date']));

    $respond_dtls   = "Change deadline proposal is <b>" . $respond . " </b> by Requestor";


    addWorklog($ic_no, $date_log, $ic_status, $respond_dtls, $edit_by, "");

    $requestor_email = getEmail($requestor);
    $checker_email = getEmail($checker);
    $approver_email = getEmail($approver);
    $assigned_email = getEmail($in_charge);

    $subject = 'Service Request ' . $ic_no . " Change Deadline";

    $cc = [];
    $to = $assigned_email;

    if (isset($checker_email)) {
        # code...
        $cc = $checker_email;
    }

    if (isset($approver_email)) {
        # code...
        $cc = $approver_email;
    }

    if (isset($requestor_email)) {
        # code...
        $cc = $requestor_email;
    }
        
    $message = 'Hello ' . $in_charge . '<br>
                        <br>
                        ' . $requestor . ' is '.$respond.' to change deadline of his/her request <a href="10.49.1.242:8012/srs/view.php?ic=' . $ic_no . '">' . $ic_no. '</a> <br>
                        <br>
                        If you have concern of question regarding to this request please call the Requestor<br>
                        <br>
                        Thank you,<br>
                        Service Request System';

    $send_mail = new Email();
    //  echo $to." test";
    if( $send_mail->send($to, $subject, $message, $cc)){
    
    echo "<script>
            alert('Request Endorsed');
            window.location.href = 'view.php?ic=" . $ic_no . "';
        </script>";
    
    }else{
        echo "<script>
                alert('Email not sent');
                window.location.href = 'view.php?ic=" . $ic_no . "';
            </script>";
    }
}

function updateRequest($ic_no, $date_log, $num, $prcss, $status, $checker){

    $update_request = new Report();

    switch ($status) {

        case "For Checking";

            $update_request->query("Update srvcrqst set ic_status=:ic_status, ic_checker=:checker, in_charge=:checker where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':checker', $checker);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        case "For Approval";

            $update_request->query("Update srvcrqst set ic_status=:ic_status, ic_approver=:checker, in_charge=:checker where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':checker', $checker);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        case "Return";

            $update_request->query("Update srvcrqst set ic_status=:ic_status, ic_checker=:checker, in_charge=:checker where ic_no=:ic_no ");
            $update_request->bind(':ic_status', "Returned");
            $update_request->bind(':checker', $checker);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        case "New Request";

            $update_request->query("Update srvcrqst set ic_status=:ic_status, in_charge='' where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();

            break;

        case "Work in Progress";

            if (strpos(strtoupper($prcss), 'CPR') !== false) {

                $update_request->query("Update srvcrqst set ic_status=:ic_status, ic_num_affected=:ic_num_affected, acknowledged_date=:acknowledged_date where ic_no=:ic_no ");
                $update_request->bind(':ic_status', $status);
                $update_request->bind(':ic_num_affected', $num);
                $update_request->bind(':acknowledged_date', $date_log);
                $update_request->bind(':ic_no', $ic_no);
                $update_request->execute();

            }else {

                $update_request->query("Update srvcrqst set ic_status=:ic_status, ic_prif=:ic_prif, acknowledged_date=:acknowledged_date where ic_no=:ic_no ");
                $update_request->bind(':ic_status', $status);
                $update_request->bind(':ic_prif', $num);
                $update_request->bind(':acknowledged_date', $date_log);
                $update_request->bind(':ic_no', $ic_no);
                $update_request->execute();

            }
            break;

        case "Done";

            $user_approval = "";
            $update_request->query("Update srvcrqst set user_approval='', ic_status=:ic_status, done_date=:done_date, in_charge=:in_charge where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':in_charge', $checker);
            $update_request->bind(':done_date', $date_log);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            
            break;

        case "Rejected";

            $reject = "Work in Progress";

            $update_request->query("Update srvcrqst set user_approval=:ic_status, ic_status=:ic_wip, in_charge=:in_charge where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_wip', $reject);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->bind(':in_charge', $checker);
            $update_request->execute();
            break;
        case "Completed";
            $update_request->query("Update srvcrqst set user_approval=:ic_status, in_charge=:in_charge where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->bind(':in_charge', $checker);
            $update_request->execute();
            break;
        case "Cancelled";
            $update_request->query("Update srvcrqst set user_approval=:ic_status, ic_status=:ic_status where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        case "Endorse to Checker";
        case "MIS Checker";

            $update_request->query("Update srvcrqst set checker=:checker, done_date=:done_date, in_charge=:checker where ic_no=:ic_no ");
            $update_request->bind(':checker', $checker);
            $update_request->bind(':done_date', $date_log);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;
        
       
        case "Closed";
            
            $update_request->query("Update srvcrqst set ic_status=:ic_status, in_charge='' where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();

            $get_manhr = new Report();

            $get_manhr->query("Select * from srvcrqst where ic_no = :ic_no");
            $get_manhr->bind(':ic_no', $ic_no);
            $get_manhr->execute();

            if ($get_manhr->rowCount() > 0) {
                $row = $get_manhr->single();

                $start_date      = $row['acknowledged_date'];
                $done_date       = $row['done_date'];
                $prcss           = $row['prcss_no'];
                $affected_num    = $row['ic_num_affected'];
            }

            if ($start_date == 0) {
                // code...
                $manhour = 0;
            } else {

                $manhour = manHour($start_date, $done_date, "Manhour");
                
                if (strpos($prcss, 'CPR') !== false) {
                    //CPR manhour (Downtime * Affected User/s)

                    if ($affected_num == " " | $affected_num == 0) {
                        # code...
                        $affected_num  = 1;
                    }else {
                        # code...
                        $affected_num    = $affected_num;
                    }
                    $manhour = $manhour * $affected_num;
                }
                
                
            }

            $update_request->query("Update srvcrqst set man_hour=:man_hour where ic_no=:ic_no ");
            $update_request->bind(':man_hour', $manhour);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();

            break;
        case "Re-assess to in charge";
            $Re_Assess = "Done";
            $update_request->query("Update srvcrqst set ic_status=:ic_status,checker='', in_charge=:in_charge where ic_no=:ic_no ");
            $update_request->bind(':in_charge', $checker);
            $update_request->bind(':ic_status', $Re_Assess);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();

            break;

        case "No Good";
            $update_request->query("Update srvcrqst set user_approval=:ic_status, ic_status=:ic_status, ic_approver='', ic_checker='' where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        case "MIS Checker";

            $update_request->query("Update srvcrqst set checker=:checker, ic_status=:ic_status, in_charge=:checker where ic_no=:ic_no ");
            $update_request->bind(':ic_status', $status);
            $update_request->bind(':checker', $checker);
            $update_request->bind(':ic_no', $ic_no);
            $update_request->execute();
            break;

        default:
            // code...
            break;
    }
}

function getEmail($name){
    
    /*

    if (strpos($name, 'admin.') !== false) {

        $name_info       = array_filter(explode("admin.", $name));
        $name            = $name_info[1];
    }
    
    */
    $get_email = new Employees();

    $get_email->query("Select emp_info.full_name, emp_email.email_account from emp_info LEFT JOIN emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.full_name='$name'");
    $get_email->execute();

    if ($get_email->rowCount() > 0) {

        $row = $get_email->single();
        return $row['email_account'];
    }
}

function manHour($start_date, $done_date, $function){

    if ($function == "Manhour") {
        # code...
        $minutes = 3600;

    } else {
        # code...
        $minutes = 60;
    }
    

    $datetime1 = $start_date;
    $datetime2 = $done_date;
    $date_create1 = date_create($datetime1);
    $date_create2 = date_create($datetime2);
    $interval = ($date_create2->getTimestamp() - $date_create1->getTimestamp()) / $minutes;
    
    $difference = $interval;
    
    if (substr($datetime1, 0, 10) != substr($datetime2, 0, 10)) {
        // code...
        $start = new DateTime(substr($datetime1, 0, 10));
        $end = new DateTime(substr($datetime2, 0, 10));
        //Define our holidays
        //New Years Day
        $holidays = array(
            '2017-08-21',
            '2017-08-27',
            '2017-11-01',
            '2017-11-02',
            '2017-11-30',
            '2017-12-25',
            '2017-12-26',
            '2017-12-27',
            '2017-12-28',
            '2017-12-29',

            '2018-01-01',
            '2018-02-16',
            '2018-03-29',
            '2018-03-30',
            '2018-04-09',
            '2018-05-01',
            '2018-06-12',
            '2018-08-21',
            '2018-08-27',
            '2018-11-01',
            '2018-11-02',
            '2018-11-30',
            '2018-12-24',
            '2018-12-25',
            '2018-12-26',
            '2018-12-27',
            '2018-12-28',
            '2018-12-29',
            '2018-12-30',
            '2018-12-31',
            
            '2019-01-01',
            '2019-02-05',
            '2019-02-25',
            '2019-04-09',
            '2019-04-18',
            '2019-04-19',
            '2019-05-01',
            '2019-06-12',
            '2019-08-21',
            '2019-08-26',
            '2019-11-01',
            '2019-12-23',
            '2019-12-24',
            '2019-12-25',
            '2019-12-26',
            '2019-12-27',
            '2019-12-30',
            '2019-12-31',

            '2020-01-01',
            '2020-02-05',
            '2020-02-25',
            '2020-04-09',
            '2020-04-18',
            '2020-04-19',
            '2020-05-01',
            '2020-06-12',
            '2020-08-21',
            '2020-08-26',
            '2020-11-01',
            '2020-12-23',
            '2020-12-24',
            '2020-12-25',
            '2020-12-26',
            '2020-12-27',
            '2020-12-30',
            '2020-12-31',

            '2021-01-01',
            '2021-02-12', 
            '2021-02-25',
            '2021-04-01',
            '2021-04-02',
            '2021-04-09',
            '2021-05-01',
            '2021-06-12',
            '2021-08-21',
            '2021-08-26',
            '2021-11-01',
            '2021-12-23',
            '2021-12-24',
            '2021-12-25',
            '2021-12-26',
            '2021-12-27',
            '2021-12-30',
            '2021-12-31',
        );
        //Create a DatePeriod with date intervals of 1 day between start and end dates
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        //Holds valid DateTime objects of valid dates
        $days = array();
        $offdays = array();
        //iterate over the period by day
        foreach ($period as $day) {
                //print_r($day);
                //If the day of the week is not a weekend
                $dayOfWeek = $day->format('N');

                if ($dayOfWeek < 6) {
                    //If the day of the week is not a pre-defined holiday
                    $format = $day->format('Y-m-d');
                    if (false === in_array($format, $holidays)) {
                        //Add the valid day to our days array
                        //This could also just be a counter if that is all that is necessary
                        //echo " ".$dayOfWeek."<br>";
                        $days[] = $day;
                    } else {
                        $offdays[] = $day;
                    }
                } else {
                    $format = $day->format('Y-m-d');
                    $offdays[] = $day;
                }
            }
        $rest_multiplier = count($days);
        //echo $rest_multiplier."<br>";
        $off_count = count($offdays);
        //echo $off_count."<br>";
        $rest = 9; // 9hrs off Work
        //$difference = $rest_multiplier * 24;
        $overall_rest = ($rest_multiplier * $rest) + ($off_count * 24);
        /*
                    $hrs_per_day = (24 * $rest_multiplier);
                    $total_hours  = (($hrs_per_day + $difference) - $overall_rest);
                    */
        $total_hours  = ($difference - $overall_rest);
        //echo $total_hours;
        //$hour = (0.0625 * $total_hours);
        //echo number_format((float)$hour, 2, '.', '');
        $hour   =   $total_hours;
    } else {
        //$hour = (0.0625 * $difference);
        //echo number_format((float)$hour, 2, '.', '');
        $hour   =   $difference;
    }

    //echo number_format((float)$hour, 2, '.', '')."<br>";
    $manhour = (number_format((float)$hour, 2, '.', ''));

    return $manhour;
}

 