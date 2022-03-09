<?php

require_once 'restriction.php';
require_once 'function/function.php';
require_once 'function/requeststatus.php';

unset($_SESSION['endorse']);


?>
<html>
    <head>
        <title>
            Service Request
        </title>
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <link rel="stylesheet" type="text/css"href="css/card-design.css"/>
        <link rel="stylesheet" type="text/css"href="css/topbar-notif.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script src="js/view.js"></script>
        <script src="js/requestform.js"></script>
        <script src="js/topbar.js"></script>
        <script>
            $(function () {
              $('[toggle="popover"]').popover({
                  trigger : 'hover'
              })
            });
            $(function(){
			 	// -- append by class just for lower strings count --
				$('.dtpicker2').appendDtpicker({"dateOnly": true, "autodateOnStart": false});

				$('#startdt2').change(function() {
				     var de = new Date($('#startdt2').handleDtpicker('getDate')); // constructor need to avoid linking object
					 de.setDate(de.getDate() + 7);
					 $('#enddt2').handleDtpicker('setMinDate', de); //set min end date is 7 day later then start date
				});
				$('#enddt2').change(function() {
				     var ds = new Date($('#enddt2').handleDtpicker('getDate'));
					 ds.setDate(ds.getDate() - 7);
					 $('#startdt2').handleDtpicker('setMaxDate', ds); //set max end date is 7 day earlier then end date
				});
			});
            $(document).ready(function(){
                $('input[type=radio][name=endorsement]').change(function() {
                    var nchrg = $(this).val();

                    $.get("pool.php", {ic: nchrg}).done(function(data){
                        // Display the returned data in browser
                        $("#result").html(data);
                    });
                    $( "#result" ).on( "click", function() {
                          console.log( $( this ).text() );
                        });
                    //$("#resultDropdown").load("pool.php?ic=" + nchrg);
                    //$("#result").load("pool.php", {ic:nchrg});
                });
            });

        </script>
    </head>
    <body>
        <?php

        include 'function/topbar.php';
        require_once 'function/search-query.php';
         ?>
        <div class="container-fluid">

            <div class="row content">

                <div class="col-xl-3 ">
                </div>
                <div class="col-xl-6 mb-5">

                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-search " aria-hidden="true"></i> Search </h4>
                        </div>
                        <div class="card-block">
                            <form method="get" class="">
                                <div class="row mb-3">
                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label font-weight-bold">Name :</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="name" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label  font-weight-bold">Department :</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="department" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label  font-weight-bold">Control # :</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="control_no" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label  font-weight-bold">Assigned MIS :</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="assigned_mis" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label  font-weight-bold">Details:</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="look_for"  autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4 col-sm-4 text-right ">
                                        <label class="col-form-label  font-weight-bold">PRIF No.:</label>
                                    </div>
                                    <div class="col-8 col-sm-8">
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="prif_no"  autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-4 col-md-4 col-form-label text-right  font-weight-bold">Request :</label>
                                    <div class="col-8 col-md-8">
                                        <select class="custom-select" name="request_category">
                                            <option ></option>
                                            <optgroup label="Account & Access Request">
                                                <option value="Access Request">Access Request</option>
                                                <option value="Account Request">Account Request</option>
                                            </optgroup>

                                            <optgroup label="Purchase Request">
                                                <option value="Software Purchase">Software Purchase</option>
                                                <option value="Hardware Purchase">Hardware Purchase</option>
                                                <option value="Renewal License">Renewal License</option>
                                            </optgroup>
                                            <optgroup label="Software Request">
                                                <option value="Install Software">Install Software</option>
                                                <option value="Modify Software">Modify Software</option>
                                                <option value="Delete Software">Delete Software</option>
                                            </optgroup>
                                            <optgroup label="Configuration Request">
                                                <option value="PC Configuration">PC Configuration</option>
                                                <option value="Laptop Configuration">Laptop Configuration</option>
                                                <option value="Printer Configuration">Printer Configuration</option>
                                                <option value="Plotter Configuration">Plotter Configuration</option>
                                            </optgroup>
                                            <optgroup label="Transfer Request">
                                                <option value="Transfer PC location">Transfer PC location</option>
                                                <option value="Transfer Telephone location">Transfer Telephone location</option>
                                                <option value="Transfer Software location">Transfer Software location</option>
                                            </optgroup>
                                            <optgroup label="Backup Request">
                                                <option value="Backup to CD/DVD">Backup to CD/DVD(Burn)</option>
                                                <option value="Backup Windows file/s">Backup Windows file/s</option>
                                                <option value="Backup CAE file/s">Backup CAE file/s</option>
                                            </optgroup>
                                            <optgroup label="Network">
                                                <option value="No Connection">No Connection</option>
                                                <option value="Add Interenet Connection">Add Interenet Connection</option>
                                            </optgroup>
                                            <optgroup label="Storage Capacity">
                                                <option value="Increase Capacity">Increase Capacity</option>
                                                <option value="Decrease Capacity">Decrease Capacity</option>
                                            </optgroup>
                                            <option value="Borrow">Borrow</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-4 col-sm-4 text-right ">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <button class="btn btn-success font-weight-bold" type="submit" name="adv_search" value="search">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 ">
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php

                    if(!empty($search_result)){

                        $_result = $search_result;
                        $querylist              = $_result[0];
                        $querypage              = $_result[1];
                        //$_SESSION['search']     = $_result[2];

                        $status = "Search Result";
                        require_once 'function/tables.php';

                    }elseif(!empty($searchAdv_result)){

                        $_result = $searchAdv_result;
                        $querylist              = $_result[0];
                        $querypage              = $_result[1];
                        $_SESSION['adv_search'] = $_result[2];

                        $status = "Search Advance Result";


                        include 'function/tables.php';

                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
</html>
<?php
require_once 'view/requestforms.php';

 ?>
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

 </script>
<script src="js/requestform.js"></script>
