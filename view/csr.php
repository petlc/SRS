<?php

##### Computer System Request #####
$cnvrtd_crtd_date = date('m/d/Y H:i', strtotime($crtd_date));
$cnvrtd_rqst_date = date('m/d/Y H:i', strtotime($rqst_date));
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h4 >Computer System Request</h4>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
    <div class="card-block">
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Request by :</label>
            <label class="col-4 col-form-label text-left"><?php echo $requestor; ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Request date :</label>
            <label class="col-3 col-form-label text-left"><?php echo $cnvrtd_crtd_date;  ?></label>
        </div>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Department :</label>
            <label class="col-4 col-form-label text-left"><?php echo $requestor_department; ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Needed Date :</label>
            <label class="col-3 col-form-label text-left"><?php echo $cnvrtd_rqst_date; ?></label>
        </div>

        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Site :</label>
            <label class="col-4 col-form-label text-left"><?php echo $site; ?></label>
            <div class="col-1"></div>
            <label class="col-2 col-form-label text-right font-weight-bold">Local# :</label>
            <label class="col-3 col-form-label text-left"><?php echo $local; ?></label>
        </div>
        <div class="dropdown-divider"></div>
        <?php
        if (empty($rqst)) {
            // code...
            echo "<script>
                    $(document).ready(function(){
                        $('#update_rqst_ctgry').modal();
                    });
                    </script>";
        }
         ?>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Request :</label>
            <label class="col-4 col-form-label text-left"><?php

            if ($rqst == "Account Request") {
                // code...
                echo "<a class='text-left' href='http://10.49.5.115/uals/srs.php?ic=$ic_no'>".$rqst."</a>";
            }else{
                echo $rqst;
            }


            ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Ip address :</label>
            <label class="col-2 col-form-label text-left"><?php echo $ipadd; ?></label>

        </div>

        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Details :</label>
            <textarea class="col-8 col-form-label text-left"><?php echo $dtls; ?></textarea>

            <?php

            if ($requestor == $fullname) {
                // code...
                if($status == "Closed" || $status == "Done"){

                }else{
                    ?>
                        <button type="submit" class="btn " toggle="popover" data-toggle="modal" data-target="#edit-form"><i class="far fa-edit"></i></button>
                    <?php
                }
            }

            ?>

        </div>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Attachment :</label>
            <label class="col-10 col-form-label text-left"><?php echo $attached; ?></label>

        </div>

        <div class="dropdown-divider"></div>

        <div class="row">
            <label class="col-4 col-form-label text-center font-weight-bold">Prepared</label>
            <label class="col-4 col-form-label text-center font-weight-bold">Checked</label>
            <label class="col-4 col-form-label text-center font-weight-bold">Approved</label>
        </div>
        <div class="row">

            <?php include "function/stamp-pad.php"; ?>

            <div class="col-4 col-form-label text-center">
                <?php
                    if (isset($requestor)) {
                        // code...

                        $stmp_val = stamps($requestor, $ic_no, 0);

                        if (!empty($stmp_val)) {
                            // code...
                            ?>
                            <div class="circle">
                                <div class="dept text-center">PET <?php echo $stmp_val[0] ?></div>
                                <div class="sig-divider"></div>
                                <div class="date text-center"><?php echo $stmp_val[1]; ?></div>
                                <div class="sig-divider"></div>
                                <div class="name text-center"><?php echo $stmp_val[2]; ?></div>
                            </div>
                            <div class="text-center">
                                <label class="code text-center"><?php echo $stmp_val[3]; ?></label>
                            </div>

                            <?php

                        }else{


                            $result = signatories($requestor, $ic_no, $cnvrtd_crtd_date);

                            ?>
                            <div class="circle">
                                <div class="dept text-center">PET <?php echo $result[2] ?></div>
                                <div class="sig-divider"></div>
                                <div class="date text-center"><?php echo $result[1]; ?></div>
                                <div class="sig-divider"></div>
                                <div class="name text-center"><?php echo utf8_encode($result[0]) ; ?></div>
                            </div>
                            <div class="text-center">
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>

            <div class="col-4 col-form-label text-center"><?php

            if ($status == "For Checking") {
                // code...
            }else{
                //echo $checker;

                if (!empty($checker)) {
                    // code...
                    $stmp_val = stamps($checker, $ic_no, 0);

                    if (!empty($stmp_val)) {
                        // code...
                        ?>
                        <div class="circle">
                            <div class="dept text-center">PET <?php echo $stmp_val[0] ?></div>
                            <div class="sig-divider"></div>
                            <div class="date text-center"><?php echo $stmp_val[1]; ?></div>
                            <div class="sig-divider"></div>
                            <div class="name text-center"><?php echo $stmp_val[2]; ?></div>
                        </div>
                        <div class="text-center">
                            <label class="code text-center"><?php echo $stmp_val[3]; ?></label>
                        </div>

                        <?php

                    }else{

                        $result = signatories($checker, $ic_no, $cnvrtd_crtd_date);
                        ?>
                        <div class="circle">
                            <div class="dept text-center">PET <?php echo $result[2] ?></div>
                            <div class="sig-divider"></div>
                            <div class="date text-center"><?php echo $result[1]; ?></div>
                            <div class="sig-divider"></div>
                            <div class="name text-center"><?php echo $result[0]; ?></div>
                        </div>
                        <div class="text-center">
                        </div>
                        <?php


                    }

                }else{

                }
            }

            ?></div><br>

            <div class="col-4 col-form-label text-center"><?php

            if ($status == "For Approval") {
                // code...
            }else{
                //echo $approver;
                //if($status == "Assigned" || $status == "Work in Progress" || $status == "Done" ||$status == "Endorsed to Checker" ||$status == "Close" ||)

                if (!empty($approver)) {
                    // code...
                    if($requestor == $approver){
                        $stmp_val = stamps($approver, $ic_no, 1);
                    }else{
                        
                        $stmp_val = stamps($approver, $ic_no, 0);
                    }

                    if (!empty($stmp_val)) {
                        // code...
                        ?>
                        <div class="circle">
                            <div class="dept text-center">PET <?php echo $stmp_val[0] ?></div>
                            <div class="sig-divider"></div>
                            <div class="date text-center"><?php echo $stmp_val[1]; ?></div>
                            <div class="sig-divider"></div>
                            <div class="name text-center"><?php echo $stmp_val[2]; ?></div>
                        </div>
                        <div class="text-center">
                            <label class="code text-center"><?php echo $stmp_val[3]; ?></label>
                        </div>

                        <?php

                    }else{

                        $result = signatories($approver, $ic_no, $cnvrtd_crtd_date);

                        ?>
                        <div class="circle">
                            <div class="dept text-center">PET <?php echo $result[2] ?></div>
                            <div class="sig-divider"></div>
                            <div class="date text-center"><?php echo $result[1]; ?></div>
                            <div class="sig-divider"></div>
                            <div class="name text-center"><?php echo $result[0]; ?></div>
                        </div>
                        <div class="text-center">
                        </div>
                        <?php

                    }
                }else{

                }

            }


            ?></div>
        </div>
    </div>
</div>

<?php

function wrklg_stats($ic_no, $status){

    $chck_wrklg = new Report();

    $chck_wrklg->query("Select wrklg_status from wrklg where ic_id ='$ic_no' and wrklg_status ='$status'");
    $chck_wrklg->execute();

    return $chck_wrklg->rowCount();
}



function detailedCsr($csr_change_date, $csr_adjusted_date){

    //$csr_adjusted_date = explode(" ",$csr_adjusted_date);
    if(strtotime($csr_adjusted_date) != null){
        $csr_adjusted_date = date('m/d/Y H:i', strtotime($csr_adjusted_date));
     }else{
         $csr_adjusted_date = "";
     }

?>
<div class="card">
    <div class="card-block">
        <div class="row">
            <label class="col-3 col-form-label text-right font-weight-bold">Date Needed change :</label>
            <label class="col-3 col-form-label "><?php echo $csr_change_date; ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Adjusted date :</label>
            <label class="col-3 col-form-label "><?php echo $csr_adjusted_date;?></label>
        </div>
    </div>
</div>
<?php
}
?>
