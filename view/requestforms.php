<script type="text/javascript">

$(function() {

    //autocomplete
    $(".skills").autocomplete({
        source: "function/search.php",
        minLength: 2
    });

});
    /*
    $(document).ready(function(){
        $('.Account-Request').hide();
        $('.Access-Request').hide();

        $('select[name=request_category]').change(function(){
            var value = $(this).val();
            if(value == 'Add Account'){
                $('.Account-Request').show();
                $('.Access-Request').hide();
                $('.rqst').html('Add');
                $('.rqst').val('Add');
            }else if(value == 'Modify Account'){
                $('.Account-Request').show();
                $('.Access-Request').hide();
                $('.rqst').html('Modify');
                $('.rqst').val('Modify');
            }else if(value == 'Delete Account'){
                $('.Account-Request').show();
                $('.Access-Request').hide();
                $('.rqst').html('Delete');
                $('.rqst').val('Delete');
            }else if(value == 'Add Access'){
                $('.Account-Request').hide();
                $('.Access-Request').show();
                $('.rqst').html('Delete');
                $('.rqst').val('Delete');
            }else{
                $('.uals').hide();
                $('.Account-Request').hide();
                $('.Access-Request').hide();
            }
        })
    })
    */
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation Account-Request
        var addAccountButton = $('.add_account_button'); //Add button selector
        var accountwrapper = $('.account_field_wrapper'); //Input field wrapper
        var accountfieldHTML = '<div class="row mt-2"> <div class="col-md-2"> <input type="text" name="id[]" placeholder="ID" value=""  class="form-control"> </div> <div class="col-md-4"> <input type="text" name="fname[]" placeholder="First Name" class=" form-control"> </div>  <div class="col-md-1"> <input type="text" name="mi[]" placeholder="M.i"  class=" form-control"> </div> <div class="col-md-4"> <input type="text" name="lname[]" placeholder="Last Name" class=" form-control"> </div> <div class="col-md-1 pt-2"> <a href="javascript:void(0);" class="remove_account_button" title="Remove field"><i class="fas fa-minus fa-lg"></i></a> </div> </div>';
//New input field html

        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addAccountButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(accountwrapper).append(accountfieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(accountwrapper).on('click', '.remove_account_button', function(e){
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation Account-Request
        var addAccessButton = $('.add_access_button'); //Add button selector
        var accesswrapper = $('.access_field_wrapper'); //Input field wrapper
        var accessfieldHTML = '<div class="row pt-2"> <div class="col-md-11 text-right"> <input class="form-control skills" id="emp" name="rqst4"> </div> <div class="col-md-1 pt-2"> <a href="javascript:void(0);" class="remove_access_button" title="Remove field"><i class="fas fa-minus fa-lg"></i></a> </div>';
//New input field html


        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addAccessButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(accesswrapper).append(accessfieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(accesswrapper).on('click', '.remove_access_button', function(e){
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
            x--; //Decrement field counter
        });
        $(accesswrapper).on('click', '.skills', function(e){
            $(".skills").autocomplete({
                source: "function/search.php",
                minLength: 2
            });
        });

    });
</script>

<div class="row">
    <!-- CSR form -->
    <div class="modal fade bd-example-modal-lg" id="csrf-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <form method="post" enctype="multipart/form-data" onsubmit="spinner();">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Computer System Request Form</h5>
                    <input type="hidden" name="request_for" value="no" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row form-group">
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Name :</label>
                          <input type="hidden" name="requestor_id" value="<?php echo $sam;?>" >
                      </div>
                      <div class="col-md-5">
                          <label class="col-form-label "><?php echo $fullname; ?></label>
                          <input type="hidden" name="request_by" value="<?php echo $fullname; ?>">
                      </div>
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Date Request :</label>
                      </div>
                      <div class="col-md-2">
                          <label class="col-form-label "><?php echo date("m/d/Y H:i"); ?></label>
                          <input type="hidden" name="created_date" class="csr_created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                      </div>
                      <div class="col-md-1">

                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Department :</label>
                      </div>
                      <div class="col-md-5">
                          <label class="col-form-label "><?php echo $department; ?></label>
                          <input type="hidden" name="requestor_department" value="<?php echo $department; ?>">
                      </div>
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Date Needed :</label>
                      </div>
                      <input type="text" id="csr_datetime" class="form-control csr_datetime col-md-2" name="request_date" value="" required readonly>

                      <div class="col-md-1">

                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Site :</label>
                      </div>
                      <div class=" col-4 col-md-4">
                        <select class="custom-select" name="branch_site" required>
                            <option value=""></option>
                            <option value="HO">Head Office</option>
                            <option value="BO">Branch Office</option>
                        </select>
                      </div>

                      <div class="col-md-1">

                      </div>

                      <div class="col-md-2 col-xl-2 text-right">
                          <label class="col-form-label font-weight-bold">Local# :</label>
                      </div>
                      <input class="col-md-2 col-xl-2 form-control" type="text" name="requestor_local" required>
                      <div class="col-md-1 col-xl-1 text-right">

                      </div>
                  </div>

                  <div class="dropdown-divider"></div>

                  <div class="row">
                      <div class="col-md-2 text-right">
                      </div>
                      <div class="col-md-8">
                          <small id="fileHelp" class="form-text text-muted">(Choose one only)</small>
                      </div>
                  </div>

                  <div class="row form-group">
                      <label class="col-md-2 col-xl-2 col-form-label text-right font-weight-bold">Request :</label>
                      <div class="col-md-5 col-xl-5">
                          <select class="custom-select" name="request_category" required>
                              <option ></option>
                              <optgroup label="Account & Access Request">
                                  <option value="Access Request">Access Request</option>
                                  <option value="Account Request">Account Request</option>
                              </optgroup>

                              <optgroup label="Purchase Request">
                                  <option value="Software Purchase">Software Purchase</option>
                                  <option value="Hardware Purchase">Hardware Purchase</option>
                                  <option value="Renewal License">Renewal License</option>
                                  <option value="Investment">Investment</option>
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
                                  <option value="Virtual Machine Configuration">Virtual Machine Configuration</option>
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
                                  <option value="Add Internet Connection">Add Internet Connection</option>
                                  <option value="Guest Connection">Guest Connection</option>
                                </optgroup>
                              <optgroup label="Storage Capacity">
                                  <option value="Increase Capacity">Increase Capacity</option>
                                  <option value="Decrease Capacity">Decrease Capacity</option>
                                  <option value="Folder Creation">Folder Creation</option>
                                  <option value="Folder Deletion">Folder Deletion</option>
                              </optgroup>
                              <optgroup label="PC/Workstation Test Request">
                                  <option value="Endurance Test">Endurance Test</option>
                                  <option value="Stress Test">Stress Test</option>
                              </optgroup>
                              <optgroup label="Other">
                                <option value="Borrow">Borrow</option>
                                <option value="Download">Download</option>
                                <option value="Outsources Request">Outsources Request</option>
                                <option value="OMS Request">OMS request</option>
								<option value="OMS Request">Create Qouta in folder</option>
                              </optgroup>
                              
                          </select>
                      </div>
                      <div class="col-md-2 col-xl-2 text-right">
                          <label class="col-form-label font-weight-bold">Ip Address :</label>
                      </div>
                      <input type="text" name="csr_ip_address" class="form-control col-md-2 col-xl-2" required>
                      <span class="errmsg"></span>

                  </div>
                  <div class="row">
                      <div class="col-md-2 text-right">
                      </div>
                      <div class="col-md-8">
                          <small id="fileHelp" class="form-text text-muted">(What need & Why need)</small>
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col-md-2 text-right">
                          <label class="col-form-label font-weight-bold">Details :</label>
                      </div>
                      <div class="col-md-9">
                          <textarea name="request_dtls" class="form-control" required></textarea>
                      </div>
                      <div class="col-md-1 text-right">
                      </div>
                  </div>
                  <div class="dropdown-divider"></div>

                  <div class="account_rqst pt-4">
                      <div class="row ">
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-5">
                              <h6>Account Request Form</h6>

                          </div>
                          <div class="col-md-4">
                              <a href="forms/Account Request Form.xls">Download</a>
                          </div>
                          <div class="col-md-2">
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-2">

                          </div>
                          <div class="col-md-8 alert alert-danger">
                              <p><strong>Note!</strong> download the form and fillup the require information then attach it to the CSR form before sending the request</p>
                          </div>
                          <div class="col-md-2">

                          </div>
                      </div>
                  </div>

                  <div class="access_rqst pt-4">
                      <div class="row ">
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-5">
                              <h6>Access Request Form</h6>

                          </div>
                          <div class="col-md-4">
                              <a href="forms/Access Request Form.xls">Download</a>
                          </div>
                          <div class="col-md-2">
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-2">

                          </div>
                          <div class="col-md-8 alert alert-danger">
                              <p><strong>Note!</strong> download the form and fillup the require information then attach it to the CSR form before sending the request</p>
                          </div>
                          <div class="col-md-2">

                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-2 text-right font-weight-bold">
                          <label>Attachment :</label>
                      </div>
                      <input class="form-control-file col-3" type="file" name="file[]" multiple="" multiple>
                      <small id="fileHelp" class="form-text text-muted">(Attach screenshot or any file to help MIS to identify the problem)</small>
                  </div>
                  <div class="row">
                      <div class="col-md-2 text-right">
                      </div>
                      <div class="col-md-8 ">
                          <div class="filename">Nothing selected</div>
                      </div>
                  </div>
              </div>



              <div class="modal-footer">
                  <div class="col-md-5">
                      <button id="submit_csr" type="submit" class="btn btn-primary submit_csr" name="submit_csr" >Send Request</button>
                  </div>
                  <div class="col-md-5">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- CPR form -->
    <div class="modal fade" id="cprf-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <form method="post" enctype="multipart/form-data" onsubmit="spinner();">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Computer Problem Report Form</h5>
                    <input type="hidden" name="request_for" value="no" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Name :</label>
                              <input type="hidden" name="requestor_id" value="<?php echo $sam;?>" >
                          </div>
                          <div class="col-md-5">
                              <label class="col-form-label "><?php echo $fullname; ?></label>
                              <input type="hidden" name="request_by" value="<?php echo $fullname; ?>">
                          </div>
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Date Request :</label>
                          </div>
                          <div class="col-md-2 text-left ">
                              <label class="col-form-label"><?php echo date("m/d/Y H:i"); ?></label>
                              <input type="hidden" name="created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Department :</label>
                          </div>
                          <div class="col-md-5">
                              <label class="col-form-label "><?php echo $department; ?></label>
                              <input type="hidden" name="requestor_department" value="<?php echo $department; ?>">
                          </div>
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Date Occured :</label>
                          </div>
                          <input type="text" id="cpr_datetime" class="form-control cpr_datetime col-md-2" name="request_date" value="" readonly>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Site :</label>
                          </div>
                          <div class="col-3 col-md-4">
                              <select class="custom-select" name="branch_site" required>
                                  <option value=""></option>
                                  <option value="HO">Head Office</option>
                                  <option value="BO">Branch Office</option>
                              </select>
                          </div>
                          <div class="col-md-1 col-xl-1">

                          </div>
                          <div class="col-md-2 col-xl-2 text-right">
                            <label class="col-form-label font-weight-bold">Local# :</label>
                          </div>
                          <input type="text" name="requestor_local" class="form-control col-md-2 col-xl-2" required>
                                <span class="errmsg"></span>
                      </div>


                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <label class="col-md-2 mt-3 col-form-label text-right font-weight-bold">Problem :</label>
                          <div class="col-md-5">
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
                                      <option value="Server">Server</option>
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
                                      
                                  </optgroup>
                                  <optgroup label="Network">
                                      <option value="No Connection">No Connection</option>
                                  </optgroup>
                              </select>
                          </div>
                          <div class="col-md-2 mt-4 text-right">
                              <label class="col-form-label font-weight-bold">Ip Address :</label>
                          </div>
                          <div class="col-md-2 mt-4">
                              <input type="text" class="form-control" name="cpr_ip_address">
                          </div>
                              <div class="col-md-2">
                                <span class="errmsg"></span>
                              </div>
                      </div>
                      <div class="row">
                          <div class="col-md-2 text-right">
                          </div>
                          <div class="col-md-10">
                              <small id="fileHelp" class="form-text text-muted">(Explanation of problem: state operations before/after problem occured)</small>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Problem :</label>
                          </div>
                          <div class="col-md-10">
                              <textarea name="request_dtls" class="form-control" required></textarea>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <div class="col-2 text-right">
                              <label class="col-form-label font-weight-bold">Attachment :</label>
                          </div>
                          <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
                          <small id="fileHelp" class="form-text text-muted">(Attach screenshot or any file to help MIS to identify the problem)</small>
                      </div>
                      <div class="row">
                          <div class="col-md-2 text-right">
                          </div>
                          <div class="col-md-8 ">
                              <div class="col-form-label font-weight-bold filename">Nothing selected</div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <div class="col-md-5">
                          <button id="submit_cpr" type="submit" class="btn btn-primary submit_cpr" name="submit_cpr">Send Request</button>
                      </div>
                      <div class="col-md-5">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
            </div>
         </form>
      </div>
    </div>

    <!-- DRR form -->
    <div class="modal fade" id="drrf-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <form method="post" enctype="multipart/form-data" onsubmit="spinner();">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Recovery Report Form</h5>
                    <input type="hidden" name="request_for" value="no" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Name :</label>
                              <input type="hidden" name="requestor_id" value="<?php echo $sam;?>" >
                          </div>
                          <div class="col-md-5">
                              <label class="col-form-label "><?php echo $fullname; ?></label>
                              <input type="hidden" name="request_by" value="<?php echo $fullname; ?>">
                          </div>
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Date Request :</label>
                          </div>
                          <div class="col-md-2">
                              <label class="col-form-label "><?php echo date("m/d/Y H:i"); ?></label>
                              <input type="hidden" name="created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Department :</label>
                          </div>
                          <div class="col-md-5">
                              <label class="col-form-label "><?php echo $department; ?></label>
                              <input type="hidden" name="requestor_department" value="<?php echo $department; ?>">
                          </div>
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Recovery Date :</label>
                          </div>
                          <input type="text" id="drr_datetime" class="form-control text-center drr_datetime col-md-2" name="request_date" value="" readonly>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Site :</label>
                          </div>
                          <div class="col-3 col-md-4">
                              <select class="custom-select" name="branch_site" required>
                                  <option value=""></option>
                                  <option value="HO">Head Office</option>
                                  <option value="BO">Branch Office</option>
                              </select>
                          </div>
                          <div class="col-md-1 col-xl-1">

                          </div>
                          <div class="col-md-2 col-xl-2 text-right">
                            <label class="col-form-label font-weight-bold">Local# :</label>
                          </div>
                          <input type="text" name="requestor_local" class="form-control col-md-2 col-xl-2" required>
                                <span class="errmsg"></span>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <label class="col-md-2 col-form-label text-right font-weight-bold">Fileserver :</label>
                          <div class="col-md-4">
                              <select class="custom-select" name="file_server" required>
                                  <option ></option>
                                  <option value="Cae">Cae</option>
                                  <option value="Windows">Windows </option>
                              </select>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Filename :</label>
                          </div>
                          <div class="col-md-10 text-right">
                          <textarea name="filename" class="form-control" required></textarea>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">File Location :</label>
                          </div>
                          <div class="col-md-10 text-right">
                            <textarea name="file_location" class="form-control" required></textarea>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>

                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Restore file :</label>
                          </div>
                          <div class="col-md-3">
                            <label class="btn btn-primary">
                                <input type="radio" name="option_directory" id="option2" value="Original Directory"> Original Directory
                            </label>
                          </div>
                          <div class="col-md-3">
                              <label class="btn btn-danger">
                                  <input type="radio" name="option_directory" id="option3" value="Other"> Other
                              </label>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                          </div>
                          <div class="col-md-10">
                            <textarea name="other_location" class="form-control"></textarea>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Overwrite file :</label>
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
                      <div class="row form-group">
                          <div class="col-md-2 text-right">
                              <label class="col-form-label font-weight-bold">Reason :</label>
                          </div>
                          <div class="col-md-10 text-right">
                            <textarea name="request_dtls" class="form-control" required></textarea>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row form-group">
                          <div class="col-2 text-right">
                              <label class="col-form-label font-weight-bold">Attachment :</label>
                          </div>
                          <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
                          <small id="fileHelp" class="form-text text-muted">(Attach screenshot or any data that can help MIS team to recover specific data)</small>
                      </div>
                      <div class="row">
                          <div class="col-md-2 text-right">
                          </div>
                          <div class="col-md-8 ">
                              <div class="col-form-label font-weight-bold filename">Nothing selected</div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="col-md-5">
                      <button id="submit_drr" type="submit" class="btn btn-primary submit_drr" name="submit_drr">Send Request</button>
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


<!-------- EDIT ----------->

<div class="row">
    <!-- CSR form -->
    <div class="modal fade bd-example-modal-lg" id="edit-csrf-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Computer System Request Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="">

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
                                        <textarea name="request_dtls" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="row">
                                    <div class="col-2 text-right">
                                        <labe>Attachment :</labe>
                                    </div>
                                    <input class="form-control-file col-2" type="file" name="file[]" multiple="" multiple>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 text-right">
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="filename">Nothing selected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary" name="submit_csr">Send Request</button>
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


function cprFor($rqstr, $rqst4checker, $rqst4approver){

    $rqstrInfo = explode(" - ", $rqstr);
    /*
    $rqst4checker_list = array_filter(explode(";", $rqst4checker));

    $rqst4checker_no = count($rqst4checker_list);

    $rqst4approver_list = array_filter(explode(";", $rqst4approver));

    $rqst4approver_no = count($rqst4approver_list);
    */
?>
<form method="post" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Computer Problem Report Form</h5>
            <input type="hidden" name="request_for" value="yes" >
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 ">
                            <div class="row">
                                <div class="col-lg-4 col-4 text-right">
                                    <label class="col-form-label ">Name :</label>
                                    <input type="hidden" name="requestor_id" value="<?php echo $rqstrInfo[2]?>" >
                                </div>
                                <div class="col-lg-8 col-8">
                                    <label class="col-form-label "><?php echo $rqstrInfo[0] ?></label>
                                    <input type="hidden" name="request_by" value="<?php echo $rqstrInfo[0] ?>">
                                </div>
                                <div class=" col-4 text-right">
                                    <label class="col-form-label ">Department :</labe>
                                </div>
                                <div class=" col-8">
                                    <label class="col-form-label " id="DEPT"><?php echo $rqstrInfo[1] ?></label>
                                    <input type="hidden" name="requestor_department" value="<?php echo $rqstrInfo[1] ?>">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xl-4 col-4 text-right">
                                    <label class="col-form-label ">Date Request :</label>
                                </div>
                                <div class="col-xl-4 col-4 text-left">
                                    <label class="col-form-label "><?php echo date("m/d/Y H:i"); ?></label>
                                    <input type="hidden" name="created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                                </div>
                                <div class="col-xl-4 col-4 ">
                                </div>
                                <div class="col-xl-4 col-4 text-right">
                                    <label class="col-form-label ">Date Occured :</label>
                                </div>
                                <input type="text" id="" class="form-control cpr_datetime col-xl-4 col-4 " name="request_date" value="" readonly>
                                <div class="col-xl-4 col-4 ">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Site :</label>
                    </div>
                    <div class="col-3 col-md-4">
                        <select class="custom-select" name="branch_site" required>
                            <option value=""></option>
                            <option value="HO">Head Office</option>
                            <option value="BO">Branch Office</option>
                        </select>
                    </div>
                </div>


                <div class="dropdown-divider"></div>
                <div class="row">
                    <label class="col-md-2 mt-3 col-form-label text-right">Problem :</label>
                    <div class="col-md-3">
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
                                <option value="Server">Server</option>
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
                            </optgroup>
                            <optgroup label="Network">
                                <option value="No Connection">No Connection</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-3 mt-4 text-right">
                        <label>Ip Address :</label>
                    </div>
                    <div class="col-md-3 mt-4">
                        <input type="text" class="form-control" name="cpr_ip_address">
                    </div>
                        <div class="col-md-2">
                          <span class="errmsg"></span>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                    </div>
                    <div class="col-md-10 col-9">
                        <small id="fileHelp" class="form-text text-muted">(Explanation of problem: state operations before/after problem occured)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <labe>Problem :</labe>
                    </div>
                    <div class="col-md-10 col-9">
                        <textarea name="request_dtls" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <labe>Attachment :</labe>
                    </div>
                    <input class="form-control-file col-9" type="file" name="file[]" multiple="" multiple>
                    <div class="col-md-2 col-3 text-right">
                    </div>
                    <div class="col-md-10 col-9">
                    <small id="fileHelp" class="form-text text-muted">(Attach screenshot or any file to help MIS to identify the    problem)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3">
                    </div>
                    <div class="col-md-8 col-9 ">
                        <div class="filename">Nothing selected</div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-md-2 col-4 text-right">
                    <labe>Checker :</labe>
                </div>
                <select name="checker" class="col-6 col-md-3 custom-select  mb-3" >
                    <option value=""> </option>
                    <?php
                        print_r($rqst4checker);
                        /*
                        for($i=0;$i<$rqst4checker_no;$i++){
                            $chckr_details = array_filter(explode("-",$rqst4checker_list[$i]));
                            echo "<option value='".$chckr_details[0]."-".$chckr_details[1]."-".$chckr_details[2]."'>".$chckr_details[0]."</option>";
                        }
                        */
                    ?>
                </select>
                <div class="col-md-2 col-4 text-right">
                    <labe>Approver :</labe>
                </div>
                <select name="approver" class="col-6 col-md-3 custom-select mb-3" >
                    <option value=""> </option>
                    <?php
                        print_r($rqst4approver);
                        /*
                        for($i=0;$i<$rqst4approver_no;$i++){
                            $apprvr_details = array_filter(explode("-",$rqst4approver_list[$i]));
                            echo "<option value='".$apprvr_details[0]."-".$apprvr_details[1]."-".$apprvr_details[2]."'>".$apprvr_details[0]."</option>";
                        }
                        */
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <div class="col-md-2 ">
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary" name="submit_cpr">Send Request</button>
                </div>
                <div class="col-md-5">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
}


function csrFor($rqstr, $rqst4checker, $rqst4approver){

    $rqstrInfo = explode(" - ", $rqstr);
/*
    $rqst4checker_list = array_filter(explode(";", $rqst4checker));

    $rqst4checker_no = count($rqst4checker_list);

    $rqst4approver_list = array_filter(explode(";", $rqst4approver));

    $rqst4approver_no = count($rqst4approver_list);
    */
?>
<form method="post" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Computer System Request Form</h5>
            <input type="hidden" name="request_for" value="yes" >
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="row">
                            <div class="col-lg-4 col-4 text-right">
                                <label class="col-form-label ">Name :</label>
                                <input type="hidden" name="requestor_id" value="<?php echo $rqstrInfo[2];?>" >
                            </div>
                            <div class="col-lg-8 col-8">
                                <label class="col-form-label "><?php echo $rqstrInfo[0] ?></label>
                                <input type="hidden" name="request_by" value="<?php echo $rqstrInfo[0] ?>">
                            </div>
                            <div class=" col-4 text-right">
                                <label class="col-form-label ">Department :</labe>
                            </div>
                            <div class=" col-8">
                                <label class="col-form-label " id="DEPT"><?php echo $rqstrInfo[1] ?></label>
                                <input type="hidden" name="requestor_department" value="<?php echo $rqstrInfo[1] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-4 col-4 text-right">
                                <label class="col-form-label ">Date Request :</label>
                            </div>
                            <div class="col-xl-4 col-4 text-left">
                                <label class="col-form-label "><?php echo date("m/d/Y H:i"); ?></label>
                                <input type="hidden" name="created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                            </div>
                            <div class="col-xl-4 col-4 ">
                            </div>
                            <div class="col-xl-4 col-4 text-right">
                                <label class="col-form-label ">Date Needed :</label>
                            </div>
                            <input type="text" id="" class="form-control csr_datetime col-xl-4 col-4 " name="request_date" value="" readonly>
                            <div class="col-xl-4 col-4 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Site :</label>
                    </div>
                    <div class="col-3 col-md-4">
                        <select class="custom-select" name="branch_site" required>
                            <option value=""></option>
                            <option value="HO">Head Office</option>
                            <option value="BO">Branch Office</option>
                        </select>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="row">
                    <div class="col-md-2 text-right">
                    </div>
                    <div class="col-md-8">
                        <small id="fileHelp" class="form-text text-muted">(Choose one only)</small>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-2 col-form-label text-right">Request :</label>
                    <div class="col-md-3">
                        <select class="custom-select" name="request_category" required>
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
                            <optgroup label="Borrow">
                                <option value="Office PC">Office PC</option>
                                <option value="WorkStation PC">WorkStation PC</option>
                                <option value="Business Trip Laptop">Business Trip Laptop</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-4 text-right">
                        <label class="col-form-label ">Ip Address :</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="csr_ip_address" class="form-control" >
                    </div>

                    <div class="col-md-2">
                      <span class="errmsg"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                    </div>
                    <div class="col-md-10">
                        <small id="fileHelp" class="form-text text-muted">(What need & Why need)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-2 text-right">
                        <label class="col-form-label ">Details :</label>
                    </div>
                    <div class="col-md-10 col-10">
                        <textarea name="request_dtls" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <labe>Attachment :</labe>
                    </div>
                    <input class="form-control-file col-9" type="file" name="file[]" multiple="" multiple>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3">
                    </div>
                    <div class="col-md-8 col-9">
                        <div class="filename">Nothing selected</div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-4 text-right">
                        <labe>Checker :</labe>
                    </div>
                    <select name="checker" class="col-6 col-md-3 custom-select mb-3" >
                        <option value=""> </option>
                        <?php
                            print_r($rqst4checker);
                            /*
                            for($i=0;$i<$rqst4checker_no;$i++){
                                $chckr_details = array_filter(explode("-",$rqst4checker_list[$i]));
                                echo "<option value='".$chckr_details[0]."-".$chckr_details[1]."-".$chckr_details[2]."'>".$chckr_details[0]."</option>";
                            }
                            */
                        ?>
                    </select>
                    <div class="col-md-2 col-4 text-right">
                        <labe>Approver :</labe>
                    </div>
                    <select name="approver" class="col-6 col-md-3 custom-select mb-3" >
                        <option value=""> </option>
                        <?php
                            print_r($rqst4approver);
                            /*
                            for($i=0;$i<$rqst4approver_no;$i++){
                                $apprvr_details = array_filter(explode("-",$rqst4approver_list[$i]));
                                echo "<option value='".$apprvr_details[0]."-".$apprvr_details[1]."-".$apprvr_details[2]."'>".$apprvr_details[0]."</option>";
                            }
                            */
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-2 ">
            </div>
            <div class="col-md-5 ">
                <button type="submit" class="btn btn-primary" name="submit_csr">Send Request</button>
            </div>
            <div class="col-md-5">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</form>

<?php
}

function drrFor($rqstr, $rqst4checker, $rqst4approver){

    $rqstrInfo = explode(" - ", $rqstr);
    /*
    $rqst4checker_list = array_filter(explode(";", $rqst4checker));

    $rqst4checker_no = count($rqst4checker_list);

    $rqst4approver_list = array_filter(explode(";", $rqst4approver));

    $rqst4approver_no = count($rqst4approver_list);
    */
?>
<form method="post" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Recovery Report Form</h5>
            <input type="hidden" name="request_for" value="yes" >
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="row">
                            <div class="col-lg-4 col-4 text-right">
                                <label class="col-form-label ">Name :</label>
                                <input type="hidden" name="requestor_id" value="<?php echo $rqstrInfo[1];?>" >
                            </div>
                            <div class="col-lg-8 col-8">
                                <label class="col-form-label "><?php echo $rqstrInfo[0] ?></label>
                                <input type="hidden" name="request_by" value="<?php echo $rqstrInfo[0] ?>">
                            </div>
                            <div class=" col-4 text-right">
                                <label class="col-form-label ">Department :</labe>
                            </div>
                            <div class=" col-8">
                                <label class="col-form-label " id="DEPT"><?php echo $rqstrInfo[1] ?></label>
                                <input type="hidden" name="requestor_department" value="<?php echo $rqstrInfo[1] ?>">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-4 col-4 text-right">
                                <label class="col-form-label ">Date Request :</label>
                            </div>
                            <div class="col-xl-4 col-4 ">
                                <label class="col-form-label "><?php echo date("m/d/Y H:i"); ?></label>
                                <input type="hidden" name="created_date" value="<?php echo date("Y-m-d H:i"); ?>">
                            </div>
                            <div class="col-xl-4 col-4 ">
                            </div>
                            <div class="col-xl-4 col-4 text-right">
                                <label class="col-form-label ">Date to recover :</label>
                            </div>
                            <input type="text" id="" class="form-control drr_datetime col-xl-4 col-4" name="request_date" value="" readonly>
                            <div class="col-xl-4 col-4 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Site :</label>
                    </div>
                    <div class="col-3 col-md-4">
                        <select class="custom-select" name="branch_site" required>
                            <option value=""></option>
                            <option value="HO">Head Office</option>
                            <option value="BO">Branch Office</option>
                        </select>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <label class="col-md-2 col-form-label text-right">Fileserver:</label>
                    <div class="col-md-4">
                        <select class="custom-select" name="file_server" required>
                            <option ></option>
                            <option value="Cae">Cae</option>
                            <option value="Windows">Windows </option>
                        </select>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <labe>Filename :</labe>
                    </div>
                    <div class="col-md-10 col-9 text-right">
                        <textarea name="filename" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <label>File Location :</label>
                    </div>
                    <div class="col-md-10 col-9 text-right">
                        <textarea name="file_location" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>

                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <label>Restore file :</label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="btn btn-primary">
                            <input type="radio" name="option_directory" id="option2" value="Original Directory"> Original Directory
                        </label>
                    </div>
                    <div class="col-md-5 col-5">
                        <label class="btn btn-danger">
                            <input type="radio" name="option_directory" id="option3" value="Other"> Other
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                    </div>
                    <div class="col-md-10">
                        <textarea name="other_location" class="form-control"></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <label>Overwrite file :</label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="btn btn-primary">
                            <input type="radio" name="option_overwrite" id="option4" value="Yes"> Yes
                        </label>
                    </div>
                    <div class="col-md-5 col-5">
                        <label class="btn btn-danger">
                            <input type="radio" name="option_overwrite" id="option5" value="No"> No
                        </label>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <label>Reason :</label>
                    </div>
                    <div class="col-md-10 col-9 text-right">
                        <textarea name="request_dtls" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                        <labe>Attachment :</labe>
                    </div>
                    <input class="form-control-file col-9" type="file" name="file[]" multiple="" multiple>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3 text-right">
                    </div>
                    <div class="col-md-10 col-9">
                    <small id="fileHelp" class="form-text text-muted">(Attach screenshot or any data that can help MIS team to recover specific data)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-3">
                    </div>
                    <div class="col-md-8 col-9">
                        <div class="filename">Nothing selected</div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-2 col-4 text-right">
                        <labe>Checker :</labe>
                    </div>
                    <select name="checker" class="col-6 col-md-3 custom-select mb-3" >
                        <option value=""> </option>
                        <?php
                            print_r($rqst4checker);

                        ?>
                    </select>
                    <div class="col-md-2 col-4 text-right">
                        <labe>Approver :</labe>
                    </div>
                    <select name="approver" class="col-6 col-md-3 custom-select mb-3" >
                        <option value=""> </option>
                        <?php
                            print_r($rqst4approver);

                        ?>
                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="col-md-2 ">
            </div>
            <div class="col-md-5">
                <button type="submit" class="btn btn-primary" name="submit_drr">Send Request</button>
            </div>
            <div class="col-md-5">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</form>

<?php
}

function qaFor($rqstr, $rqst4checker, $rqst4approver){

    $rqstrInfo = explode(" - ", $rqstr);
    /*
    $rqst4checker_list = array_filter(explode(";", $rqst4checker));

    $rqst4checker_no = count($rqst4checker_list);

    $rqst4approver_list = array_filter(explode(";", $rqst4approver));

    $rqst4approver_no = count($rqst4approver_list);
    */
?>
<form method="post" enctype="multipart/form-data" name="qaFor">
    <div class="modal-content">
        <div class="modal-header mb-2">
            <h5 class="modal-title" id="exampleModalLabel">Quick Assistance Form</h5>
            <input type="hidden" name="request_for" value="yes" >
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col-lg-4 col-4 text-right font-weight-bold">
                                <label class="col-form-label ">Name :</label>
                                <input type="hidden" name="requestor_id" value="<?php echo $rqstrInfo[2];?>" >
                            </div>
                            <div class="col-lg-8 col-8">
                                <label class="col-form-label "><?php echo $rqstrInfo[0] ?></label>
                                <input type="hidden" name="request_by" value="<?php echo $rqstrInfo[0] ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class=" col-4 text-right font-weight-bold">
                                <label class="col-form-label ">Department :</label>
                            </div>
                            <div class=" col-8">
                                <label class="col-form-label " id="DEPT"><?php echo $rqstrInfo[1] ?></label>
                                <input type="hidden" name="requestor_department" value="<?php echo $rqstrInfo[1] ?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 text-right font-weight-bold">
                                <label class="col-form-label ">Site :</label>
                            </div>
                            <div class="col-3 col-md-4">
                                <select class="custom-select" name="branch_site" required>
                                    <option value=""></option>
                                    <option value="HO">Head Office</option>
                                    <option value="BO">Branch Office</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <!--
                            <div class="col-xl-4 col-4 text-right">
                                <label class="col-form-label ">Date Request :</label>
                            </div>
                            <div class="col-xl-4 col-4 ">
                                <label class="col-form-label "><?php echo date("m/d/Y"); ?></label>
                                <input type="hidden" name="created_date" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <div class="col-xl-4 col-4 ">
                            </div>
                        -->

                            <div class="col-md-4 col-3 text-right font-weight-bold">
                                <label class="col-form-label ">Date Start :</label>
                            </div>
                            <div class="col-md-6 col-3 ">
                                <input type="text" id="start_datetime" class="form-control " name="start_date" value="" >
                            </div>
                            <div class="col-md-2 col-3 text-right">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 col-3 text-right font-weight-bold">
                                <label class="col-form-label ">Date End :</label>
                            </div>
                            <div class="col-md-6 col-3">
                                <input type="text" id="end_datetime" class="form-control " name="end_date" value="" >
                            </div>
                            <div class="col-md-2 col-3 text-right">
                            </div>
                        </div>
                            

                        <div class="row form-group">
                            <div class="col-md-4 col-3 text-right font-weight-bold">
                                <label class="col-form-label ">Local# :</label>
                            </div>
                            <div class="col-md-6 col-3">
                                <input type="text" name="requestor_local" class="form-control" required>
                            </div>
                            <div class="col-md-2 col-3 text-right">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 col-3 text-right font-weight-bold">
                                <label class="col-form-label ">Request via :</label>
                            </div>
                            <div class="col-md-6 col-3">
                                <select class="form-control" name="mode_of_request" required>
                                    <option value=""></option>
                                    <option value="Telephone">Telephone</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Lync">Lync</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-3 text-right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider mb-4"></div>
                <div class="row form-group">
                    <div class="col-md-2 col-3 text-right font-weight-bold">
                        <label class="col-form-label ">Category :</label>
                    </div>
                    <div class="col-3 col-md-4">
                        <select class="custom-select" name="category" required>
                            <option value=""></option>
                            <option value="Internal">Internal</option>
                            <option value="CAE">CAE</option>
                        </select>
                    </div>

                    <div class="CAE-request col-md-6">
                        <div class="row">
                            <div class="col-md-4 text-right font-weight-bold">
                                <label class="col-form-label ">Request :</label>
                            </div>
                            <div class="col-md-8">
                                <select class="custom-select" name="request">
                                    <option value=""></option>
                                    <option value="CAE">CAE</option>
                                    <option value="Cadra">Cadra</option>
                                    <option value="Extes">Extes</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-md-2 col-3 text-right font-weight-bold">
                        <label class="col-form-label ">Details :</label>
                    </div>
                    <div class="col-md-9 col-9">
                        <textarea name="request_dtls" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2 col-3 text-right font-weight-bold">
                        <label class="col-form-label ">Assist by :</label>
                    </div>
                    <div class="col-3 col-md-4">
                        <select name="assist_by" class=" custom-select" required>
                            <option value=""> </option>
                            <?php

                            $mis_member = new Employees();


                            $mis_member->query("Select emp_info.full_name, emp_info.pet_id From emp_info  where emp_info.department = 'MIS'  ");
                            $mis_member->execute();



                            $mm_list = array();

                            $row = $mis_member->resultset();

                            for($mm = 0; $mm < $mis_member->rowCount(); $mm++ ){

                                $mm_list[] = "<option value='admin.".$row[$mm]['full_name']."'>".$row[$mm]['full_name']."</option>";

                            }

                            //return $mm_list;

                                //$mis_mem = MISmember($site);
                                print_r($mm_list);
                            ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-2 ">
            </div>
            <div class="col-md-5 ">
                <button type="submit" class="btn btn-primary" name="submit_qa">Send Request</button>
            </div>
            <div class="col-md-5">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</form>

<?php
}

?>
<script type="text/javascript">

    $(document).ready(function(){
        $('.CAE-request').hide();

        $('select[name=category]').change(function(){
            var cat = $(this).val();
            if (cat === "CAE") {
                $('.CAE-request').show();
            }else{
                $('.CAE-request').hide();
            }
        })
    });

</script>
