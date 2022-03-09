<?php

function csrEdit($dtls, $rqst_date, $ipadd){
    /*
$edtls = explode(";",$dtls);
*/
    $request_date         = date("m/d/Y H:i", strtotime($rqst_date));

?>
<div class="row">
    
    <div class="col-md-2 text-right">
        <label class="col-form-label ">Date Needed :</label>
    </div>
    <div class="col-md-3">
    <input type="text" id="" class="form-control change_csr_datetime" name="request_date" value="<?php echo $request_date; ?>" readonly>
    </div>
    
    <div class="col-md-2">
        <label class="col-form-label ">Ip Address :</label>
    </div>
    <div class="col-md-3">
        <input type="text" name="ip_address" class="form-control" value="<?php echo $ipadd; ?>">
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-10">
        <small id="fileHelp" class="form-text text-muted">(What need & Why need)</small>
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-right">
        <label class="col-form-label ">Details :</label>
    </div>
    <div class="col-md-10">
        <textarea name="request_dtls" class="form-control" required><?php echo $dtls; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-2 text-right">
        <label>Attachment :</label>
    </div>
    <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
    <small id="fileHelp" class="form-text text-muted">(If you have attachment please re-attach it again)</small>
</div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-8 ">
        <div class="filename">Nothing selected</div>
    </div>
</div>



<?php
}

function cprEdit($dtls, $rqst_date, $ipadd){
    /*
$edtls = explode(";",$dtls);
*/
    //$date_request_req   = DateTime::createFromFormat('Y-m-d H:i:S', $rqst_date);
    //$request_date       = $date_request_req->format('m/d/Y H:i:s');
    $request_date         = date("m/d/Y H:i", strtotime($rqst_date));

?>
<div class="row">

</div>
<div class="row">
    
    <div class="col-md-2">
        <label>Date Occur</label>
    </div>
    <div class="col-md-3">
        <input type="text" id="edit_cpr_datetime" class="form-control" name="request_date" value="<?php echo $request_date; ?>" readonly>
    </div>
    <div class="col-md-2">
        <label>Ip Address :</label>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" name="ip_address" value="<?php echo $ipadd; ?>">
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-10">
        <small id="fileHelp" class="form-text text-muted">(Explanation of problem: state operations before/after problem occured)</small>
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>Problem :</label>
    </div>
    <div class="col-md-10">
        <textarea name="request_dtls" class="form-control" required><?php echo $dtls; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-2 text-right">
        <label>Attachment :</label>
    </div>
    <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
    <small id="fileHelp" class="form-text text-muted">(If you have attachment please re-attach it again)</small>
</div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-8 ">
        <div class="filename">Nothing selected</div>
    </div>
</div>
<?php
}
function drrEdit($dtls, $rqst_date, $ipadd){
    /*
$edtls = explode(";",$dtls);
*/
    $request_date         = date("m/d/Y H:i", strtotime($rqst_date));

?>
<div class="row">
    <div class="col-md-3 text-right">
        <label class="col-form-label ">Date to be recovered</label>
    </div>
    <div class="col-md-3">
        <input type="text" id="edit_drr_datetime" class="form-control text-center" name="request_date" value="<?php echo $request_date; ?>">
    </div>
</div>

<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>Filename:</label>
    </div>
    <div class="col-md-10 text-right">
        <textarea name="filename" class="form-control" required><?php echo $ipadd; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>File Location :</label>
    </div>
    <div class="col-md-10 text-right">
        <textarea name="file_location" class="form-control" required><?php echo $dtls[1]; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>Restore file :</label>
    </div>
    <div class="col-md-3">
        <label class="btn btn-primary">
            <input type="radio" name="option_directory" id="option2" value="Original Directory"> Original Directory
        </label>
    </div>
    <div class="col-md-5">
        <label class="btn btn-danger">
            <input type="radio" name="option_directory" id="option3" value="Other"> Other
        </label>
    </div>
</div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-10">
        <textarea name="other_location" class="form-control"><?php echo $dtls[2]; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>Overwrite file:</label>
    </div>
    <div class="col-md-2">
        <label class="btn btn-primary">
            <input type="radio" name="option_overwrite" id="option4" value="Yes"> Yes
        </label>
    </div>
    <div class="col-md-5">
        <label class="btn btn-danger">
            <input type="radio" name="option_overwrite" id="option5" value="No"> No
        </label>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-md-2 text-right">
        <label>Reason :</label>
    </div>
    <div class="col-md-10 text-right">
        <textarea name="request_dtls" class="form-control" required><?php echo $dtls[4]; ?></textarea>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-2 text-right">
        <label>Attachment :</label>
    </div>
    <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
    <small id="fileHelp" class="form-text text-muted">(If you have attachment please re-attach it again)</small>
</div>
<div class="row">
    <div class="col-md-2 text-right">
    </div>
    <div class="col-md-8 ">
        <div class="filename">Nothing selected</div>
    </div>
</div>

<?php
}

?>


<div class="row">
    <div class="modal fade bd-example-modal-lg" id="edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" enctype="multipart/form-data"  onsubmit="spinner();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Request Form</h5>
                        <small id="fileHelp" class="form-text text-muted">(NOTE: please re-input again your date)</small>
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
                                <?php
                                /*
                                if($prcss_no == "CSR"){
                                    echo csrEdit($dtls, $rqst_date);
                                }elseif($prcss_no == "CPR"){
                                    echo cprEdit($dtls, $rqst_date);
                                }elseif($prcss_no == "DRR"){
                                    echo drrEdit($dtls, $rqst_date);
                                }
                                */

                                if(stristr($prcss_no, 'CSR') !== FALSE){
                                    echo csrEdit($dtls, $rqst_date, $ipadd);
                                }elseif(stristr($prcss_no, 'CPR') !== FALSE){
                                    echo cprEdit($dtls, $rqst_date, $ipadd);
                                }elseif(stristr($prcss_no, 'DRR') !== FALSE){
                                    echo drrEdit($dtls, $rqst_date, $ipadd);
                                }else{
                                    echo "No fields available";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary" name="edit" onclick="hideModal()">Save Edit</button>
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

<script type="text/javascript">

    function saveEdit(){

        var edit_by         = $('input[name=edit_by]').val();
        var ic_no           = $('input[name=ic_no]').val();
        var prcss           = $('input[name=prcss]').val();
        var request_dtls    = $('textarea[name=request_dtls]').val();

        alert(edit_by +" "+ ic_no +" "+ prcss +" "+request_dtls);
    }

    function hideModal(){
        $('#edit-form"').modal('hide');
    }

    $(document).ready(function(){


        /*
        $("button[name=edit]").click(function(){
            var edit_by         = $('input[name=edit_by]').val();
            var ic_no           = $('input[name=ic_no]').val();
            var prcss           = $('input[name=prcss]').val();
            var ip_address      = $('input[name=ip_address]').val();
            var request_dtls    = $('textarea[name=request_dtls]').val();
            var request_date    = $('input[name=request_date]').val();

            //alert(edit_by +" "+ ic_no +" "+ prcss +" "+request_dtls);
            //console.log(edit_by +" "+ ic_no +" "+ prcss +" "+request_dtls);

            $.post("function/function.php", { edit: "1", edit_by: edit_by, ic_no : ic_no, prcss: prcss, ip_address:ip_address, request_dtls: request_dtls, request_date:request_date },function(result){
                alert(result);

            });
        });
        */

    });
</script>
