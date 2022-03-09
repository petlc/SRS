<?php
function buttonUpdateDate(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-4"></div>
            <button type="submit" class="btn btn-danger col-3" toggle="popover" data-toggle="modal" data-target="#update-date-form">Update Date Time</button>
            <div class="col-3"></div>
            <div class="col-2"></div>

        </div>
    </div>
</div>
<?php
}
function buttonCancelReendorse(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-2"></div>
            <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#change-date-form">Change Date</button>
            <div class="col-1"></div>
            <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#mis-endorse-form">Re-Endorse</button>
            <div class="col-1"></div>
            <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#cancel-request-form">Cancel Request</button>
            <div class="col-1"></div>

        </div>
    </div>
</div>
<?php
}
function buttonEndorsemissupport(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-2"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#mis-endorse-form">Endorse</button>
            <div class="col-1"></div>
            <button type="submit" class="btn btn-warning col-2" toggle="popover" data-toggle="modal" data-target="#return-request-form">Return</button>
            <div class="col-1"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}
function buttonEndorsemischecker(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-3"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#confirm-done-form">Checker</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}
function buttonDone(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-3"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#close-form">Close / Re-Asess</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-3" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonWorkinProgress(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-2"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#worklog-form">Add work log</button>
            <div class="col-1"></div>
            <button type="submit" class="btn btn-warning col-2" toggle="popover" data-toggle="modal" data-target="#done-form">Request Done</button>
            <div class="col-1"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonAssigned(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-2"></div>
            <button type="submit" class="btn btn-warning col-3" toggle="popover" data-toggle="modal" data-target="#acknowledge-form">Acknowledge</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-3" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonViewing(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-5"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonRequestOwner(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-3"></div>
            <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#delete-form">Cancel</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>
        </div>
    </div>
</div>
<?php
}

function buttonRequestOwnerNewlyCreated(){
    ?>
    <div class="card">
        <div class="card-footer">
            <div class="row">
                <div class="col-2"></div>
                <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#endorsment-form">Endorse</button>
                <div class="col-1"></div>
                <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#delete-form">Cancel</button>
                <div class="col-1"></div>
                <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>
            </div>
        </div>
    </div>
    <?php
    }

    ###############
    ### Not MIS ###
    ###############

function buttonEndorsement(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-3"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#endorsment-form">Endorse</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonComplete(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">
            <div class="col-2"></div>
            <button type="submit" class="btn btn-info col-3" toggle="popover" data-toggle="modal" data-target="#complete-form">Complete</button>
            <div class="col-2"></div>
            <button type="button" class="btn btn-secondary col-3" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}

function buttonReturned(){
    ?>
    <div class="card">
        <div class="card-footer">
            <div class="row">
                <div class="col-2"></div>
                <button type="submit" class="btn btn-info col-2" toggle="popover" data-toggle="modal" data-target="#endorse-back">Re-send</button>
                <div class="col-1"></div>
                <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>
                <div class="col-1"></div>
                <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#cancel-request-form">Cancel Request</button>
            </div>
        </div>
    </div>
    <?php
    }

function buttonCancelled(){
    ?>
    <div class="card">
        <div class="card-footer">
            <div class="row">
                <div class="col-2"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#delete-form">Confirm</button>
                <div class="col-1"></div>
                <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>
                <div class="col-1"></div>
                <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#return-cancelled-request-form">Decline</button>
            </div>
        </div>
    </div>
    <?php
    }

function buttonChangeDeadline(){
    ?>
    <div class="card">
        <div class="card-footer">
            <div class="row">
                <div class="col-3"></div>
            <button type="submit" class="btn btn-info col-2" toggle="popover" data-toggle="modal" data-target="#change-date-respond-form">Respond</button>
                <div class="col-2"></div>
                <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>
            </div>
        </div>
    </div>
    <?php
    }

function buttonNotapprove(){
?>
<div class="card">
    <div class="card-footer">
        <div class="row">

            <div class="col-2"></div>
            <button type="submit" class="btn btn-success col-2" toggle="popover" data-toggle="modal" data-target="#endorsment-form">Endorse</button>

            <div class="col-1"></div>
            <button type="submit" class="btn btn-danger col-2" toggle="popover" data-toggle="modal" data-target="#delete-form">Delete</button>
            <div class="col-1"></div>
            <button type="button" class="btn btn-secondary col-2" data-dismiss="modal" onclick="window.history.back()">Back</button>

        </div>
    </div>
</div>
<?php
}
?>
