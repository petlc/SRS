<?php
##### Computer System Request #####
$cnvrtd_crtd_date = date('m/d/Y H:i', strtotime($crtd_date));
$cnvrtd_done_date = date('m/d/Y H:i', strtotime($done_date));
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3 >Quick Assistance</h3>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
    <div class="card-block">
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Request by:</label>
            <label class="col-4 col-form-label text-left"><?php echo $requestor; ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Date Call:</label>
            <label class="col-3 col-form-label text-left"><?php echo $cnvrtd_crtd_date; ?></label>
        </div>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Department:</label>
            <label class="col-4 col-form-label text-left"><?php echo $requestor_department; ?></label>
            <label class="col-3 col-form-label text-right font-weight-bold">Done Date:</label>
            <label class="col-3 col-form-label text-left"><?php echo $cnvrtd_done_date; ?></label>
        </div>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Site :</label>
            <label class="col-4 col-form-label text-left"><?php echo $site; ?></label>
        </div>
        <div class="row">
            <label class="col-2 col-form-label text-right font-weight-bold">Details:</label>
            <textarea class="col-4 col-form-label text-left"><?php echo $dtls; ?></textarea>

        </div>
    </div>
</div>
