<?php
require_once 'function/function.php';

require_once 'restriction.php';

/*
if ($sam == "pet1666") {
    // code...
    ?>
    <form class=""  method="post">
        <?php

        $get_id = new Employees();

        $get_id->query("Select pet_id, full_name from emp_info");
        $get_id->execute();

        $row = $get_id->resultset();

        $ptd = array();
        for ($pet=0; $pet < $get_id->rowCount(); $pet++) {
            // code...
            $ptd[] = "<option value='".$row[$pet]['pet_id']." - ".$row[$pet]['full_name']."'>".$row[$pet]['pet_id']."</option>";
        }
        ?>
        <select name="ptd" class="custom-select" >
            <option value=""> </option>
            <?php
                print_r($ptd);
            ?>
        </select>
        <button type="submit" class="btn btn-success col-3" name="login_as">Submit</button>
    </form>
    <?php

}
*/
if (isset($_POST['login_as']) && isset($_POST['ptd'])) {
    // code...

    $ptd_info = explode(" - ", $_POST['ptd']);
    $sam = $ptd_info[0];
    $fullname = $ptd_info[1];
}

require_once 'function/requeststatus.php';
unset($_SESSION['status']);
unset($_SESSION['search']);

//echo $role;
?>
<html>
    <head>
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/preload.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css"href="css/card-design.css"/>
        <link rel="stylesheet" type="text/css"href="css/topbar-notif.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script type="text/javascript">

        $(document).ready(function(){
            $('.account_rqst').hide();
            $('.access_rqst').hide();

            $('select[name=request_category]').change(function(){
                var value = $(this).val();
                if (value == 'Account Request') {
                    $('.account_rqst').show();
                    $('.access_rqst').hide();
                }else if (value == 'Access Request') {
                    $('.access_rqst').show();
                    $('.account_rqst').hide();
                }else{
                    $('.account_rqst').hide();
                    $('.access_rqst').hide();
                }

            });
            $(".dis-checked").prop("checked", true);
            $(".dis-checked").attr("disabled", true);
            $(".dis").attr("disabled", true);

            var x;

            $('.path1').focus(function(){
                /*to make this flexible, I'm storing the current width in an attribute*/
                $(this).attr('data-default', $(this).width());
                $(this).animate({ width: 150 }, 'slow');
            }).blur(function()
            {
                /* lookup the original width */
                var w = $(this).attr('data-default');
                $(this).animate({ width: w }, 'slow');
            });

            $('textarea, input[type=text]').keydown(function (e){
                if(e.keyCode == 186){
                    //alert('you pressed enter ^_^');
                    event.preventDefault();
                }
            });

        });
        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';

        ?>
        <div class="container-fluid">

            <div class="row content">

            <?php

            if (strpos($fullname, 'admin.') !== false) {

                ?>
                <div class="col-md-1">

                </div>
                <div class="col-lg-10 mb-5">
                    <h4><i class="fa fa-users" aria-hidden="true"></i>My Request Pool</h4>

                </div>
                <div class="col-md-1">


                </div>


                <?php

                include 'index/index.admin.php';

            }else{

                ?>
                <div class="col-md-1">

                </div>
                <div class="col-md-10 mb-5">
                    <h4><i class="fa fa-home" aria-hidden="true"></i> Home</h4>

                </div>
                <div class="col-md-1">


                </div>

                <?php

                include 'index/index.nonadmin.php';

            }



             ?>


            </div>


        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
<script type="text/javascript">

$(document).ready(function(){
    $('.account_rqst').hide();
    $('.access_rqst').hide();

    $('select[name=request_category]').change(function(){
        var value = $(this).val();
        if (value == 'Account Request') {
            $('.account_rqst').show();
            $('.access_rqst').hide();
        }else if (value == 'Access Request') {
            $('.access_rqst').show();
            $('.account_rqst').hide();
        }else{
            $('.account_rqst').hide();
            $('.access_rqst').hide();
        }

    });
    $(".dis-checked").prop("checked", true);
    $(".dis-checked").attr("disabled", true);
    $(".dis").attr("disabled", true);

    var x;

    $('.path1').focus(function(){
        /*to make this flexible, I'm storing the current width in an attribute*/
        $(this).attr('data-default', $(this).width());
        $(this).animate({ width: 150 }, 'slow');
    }).blur(function()
    {
        /* lookup the original width */
        var w = $(this).attr('data-default');
        $(this).animate({ width: w }, 'slow');
    });

    $('textarea, input[type=text]').keydown(function (e){
        if(e.keyCode == 186){
            //alert('you pressed enter ^_^');
            event.preventDefault();
        }
    });

});

$(function () {
  $('[toggle="popover"]').popover({
      trigger : 'hover'
  })
});
$(document).ready(function(){
    $('textarea[name=other_location]').hide();
    $('input[type=radio][name=option_directory]').change(function() {
        if (this.value == 'Other') {
            $('textarea[name=other_location]').show();
        }else{
            $('textarea[name=other_location]').hide();
        }
    });

});

$(document).ready(function(){
    $("input[name='file[]']").change(function() {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        var file = console.log(names);
        var n = names.length;
        alert(names);
        $(".filename").text(names);
    });
});

$(function(){
    $('#csr_datetime').appendDtpicker({
            "autodateOnStart": false,
            "dateFormat": "MM/DD/YYYY",
            "futureOnly": true,
            "dateOnly": true,
            //"minTime":"06:30",
            //"maxTime":"21:30",
            "minDate":+5,
            "allowWdays": [1, 2, 3, 4, 5] // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
        });
});

$('.csr_datetime').change(function() {
    var inputDate = $(this).val();

    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output =  (month<10 ? '0' : '') + month + '/' +(day<10 ? '0' : '') + day + '/' +d.getFullYear();

    if (output == inputDate) {

        alert("Same date not allowed, thank you");
        $('#csr_datetime').val("");
    }

});

$(function(){
    $('#cpr_datetime').appendDtpicker({
            "autodateOnStart": false,
        "dateFormat": "MM/DD/YYYY hh:mm",
        //"futureOnly": true,
        "minTime":"06:30",
        "maxTime":"21:30",
        "minDate":+5,
        "allowWdays": [1, 2, 3, 4, 5] // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
    });
});
$(function(){
    $('#drr_datetime').appendDtpicker({
            "autodateOnStart": false,
        "dateFormat": "MM/DD/YYYY hh:mm",
        //"futureOnly": true,
        //"minTime":"06:30",
        //"maxTime":"21:30",
        "minDate":+5,
        "allowWdays": [1, 2, 3, 4, 5] // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
    });
});
$(function(){
    $('#edit_drr_datetime').appendDtpicker({
        "dateFormat": "MM/DD/YYYY hh:mm",
        //"futureOnly": true,
        //"minTime":"06:30",
        //"maxTime":"21:30",
        "minDate":+5,
        "allowWdays": [1, 2, 3, 4, 5] // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
    });
});
$(document).ready(function(){
    $('[search-toggle=search]').click(function(){
        $('.search-bar').toggle();
    });
});

$('input[name=cpr_ip_address]').keypress(function(event) {
  if ((event.which != 46 ) && (event.which < 48 || event.which > 57)) {
        $(".errmsg").html("Digits Only").show();
        return false;
  }
});
$('input[name=csr_ip_address]').keypress(function(event) {
  if ((event.which != 46 ) && (event.which < 48 || event.which > 57)) {
        $(".errmsg").html("Digits Only").show();
        return false;
  }
});

$('#submit_csr').click(function() {

    var myDate = new Date($('.csr_created_date').val());
      myDate.setDate(myDate.getDate()+78);
      function formatDate(date) {
         var d = new Date(date),
             month = '' + (d.getMonth() + 1),
             day = '' + d.getDate(),
             year = d.getFullYear();

         if (month.length < 2) month = '0' + month;
         if (day.length < 2) day = '0' + day;

         return [month, day, year].join('/');
     }

    if ($('select[name=request_category]').val() === 'Software Purchase' || $('select[name=request_category]').val() === 'Hardware Purchase' || $('select[name=request_category]').val() === 'Renewal License' || $('select[name=request_category]').val() === 'Investment') {

        var workingdays = new Date(formatDate(myDate)),
            request = $('select[name=request_category]').val(),
            date_needed = new Date($('#csr_datetime').val());

        if (date_needed < workingdays ) {
            alert("Your Request is "+ request +", please set your date needed to 60 working days or more from Date Request");
            $('#csr_datetime').focus();
            return false;
        }

        //alert(formatDate(myDate));

    }

    if($('#csr_datetime').val().length < 1){
        alert("please input date, Thank you");
        $('#csr_datetime').focus();
        return false;
    } else if ($('input[name=csr_ip_address]').val().length < 1){
        alert("Please input IP address, Thank you");
        $('input[name=csr_ip_address]').focus();
        return false;
    }  else {



    }
});

$('#submit_cpr').click(function() {

    if($('#cpr_datetime').val().length < 1){
        alert("please input date, Thank you");
        $('#cpr_datetime').focus();
        return false;
    } else if ($('input[name=cpr_ip_address]').val().length < 1){
        alert("Please input IP address, Thank you");
        $('input[name=cpr_ip_address]').focus();
        return false;
    }
});

$('#submit_drr').click(function() {

    if($('#drr_datetime').val().length < 1){
        alert("please input date, Thank you");
        $('#drr_datetime').focus();
        return false;
    }
});
</script>
