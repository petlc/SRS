<script type="text/javascript">

$(function() {

    //autocomplete
    $(".skills").autocomplete({
        source: "function/search.php",
        minLength: 2
    });

});
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

        $('select[name=accnt]').change(function(){
            var value_accnt = $(this).val();
            if(value_accnt == 'Windows'){
                alert('tae');
            }else if(value == 'Modify Account'){
            }else if(value == 'Delete Account'){
            }else if(value == 'Add Access'){
            }else{
                $('.uals').hide();
                $('.Account-Request').hide();
                $('.Access-Request').hide();
            }
        })
    });

    $(document).ready(function(){
        $('.Account-Request').hide();
        $('.Access-Request').hide();


    });
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation Account-Request
        var addAccountButton = $('.add_account_button'); //Add button selector
        var accountwrapper = $('.account_field_wrapper'); //Input field wrapper
        var accountfieldHTML = '<tr><td><input type="text" name="id[]" value=""  class="form-control"> </td> <td> <div class="row"> <div class="col-5"> <input type="text" name="fname[]" placeholder="First Name" class=" form-control"> </div> <div class="col-2"> <input type="text" name="mi[]" placeholder="M.i"  class=" form-control"> </div> <div class="col-5"> <input type="text" name="lname[]" placeholder="Last Name" class=" form-control"> </div> </td>   <td> <a href="javascript:void(0);" class="remove_account_button"><i class="fas fa-minus-circle fa-2x"></i></a> </td> </tr>';
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
        var accessfieldHTML = '<tr> <td> <div class="row"> <div class="col-lg-12 text-right"> <input class="form-control skills" id="emp" name="rqst4"> </div></div></td><td><a href="javascript:void(0);" class="remove_access_button" title="Add field"><i class="fas  fa-minus-circle fa-2x"></i></a></td>  </tr>';
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
<form method="post" enctype="multipart/form-data">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Computer System Request Form</h5>

    </div>
    <div class="modal-body" id="UALS">
        <div class="form-group">
            <div class="">
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Name :</label>
                        <input type="hidden" name="requestor_id" value="<?php echo $sam;?>" >
                    </div>
                    <div class="col-md-5">
                        <label class="col-form-label "><?php echo $fullname; ?></label>
                        <input type="hidden" name="request_by" value="<?php echo $fullname; ?>">
                    </div>
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Date Request :</label>
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label "><?php echo date("m/d/Y"); ?></label>
                        <input type="hidden" name="created_date" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Department :</labe>
                    </div>
                    <div class="col-md-5">
                        <label class="col-form-label "><?php echo $department; ?></label>
                        <input type="hidden" name="requestor_department" value="<?php echo $department; ?>">
                    </div>
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Date Needed :</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" id="csr_datetime" class="form-control" name="request_date" value="" readonly>
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
                    <label class="col-2 col-form-label text-right">Request Category:</label>
                    <div class="col-3 col-md-4">
                        <select class="custom-select" name="request_category" required>
                            <option ></option>
                            <optgroup label="Access Request">
                                <option value="Add Access">Add Access</option>
                                <option value="Modify Access">Modify Access</option>
                                <option value="Delete Access">Delete Access</option>
                            </optgroup>
                            <optgroup label="Account Request">
                                <option value="Add Account">Add Account</option>
                                <option value="Modify Account">Modify Account</option>
                                <option value="Delete Account">Delete Account</option>
                            </optgroup>
                            <optgroup label="Borrow Request">
                                <option value="Laptop for BT">Laptop for BT</option>
                                <option value="Laptop for Guest">Laptop for Guest</option>
                                <option value="Laptop for Training">Laptop for Training</option>
                                <option value="PC for BT">PC for BT</option>
                                <option value="PC for Guest">PC for Guest</option>
                                <option value="PC for Training">PC for Training</option>
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

                        </select>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-2 text-right">
                        <label class="col-form-label ">Ip Address :</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="csr_ip_address" class="form-control" >
                    </div>
                    <div class="col-md-2">
                      <span class="errmsg"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                    </div>
                    <div class="col-md-8">
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
                    <input class="form-control-file col-10" type="file" name="file[]" multiple="" multiple>
                </div>
                <div class="row">
                    <div class="col-md-2 text-right">
                    </div>
                    <div class="col-md-8 ">
                        <div class="filename">Nothing selected</div>
                    </div>
                </div>
                <div class="Account-Request">
                    <div class="dropdown-divider"></div>
                    <table class="table table-bordered">
                        <thead>
                            <div class="">
                                <tr>
                                    <th colspan ="2" class="text-center"> <h4>Account Request Information</h4> </th>

                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <label class="col-md-2 col-form-label text-right">Department :</label>
                                            <select class="col-md-2 custom-select" name="dept[]">
                                                <option value=""></option>
                                                <option value="ADM">ADM</option>
                                                <option value="CON">CON</option>
                                                <option value="ES">ES</option>
                                                <option value="EV">EV</option>
                                            </select>

                                            <label class="col-md-2 col-form-label text-right">Request :</label>


                                            <label class="col-md-1 col-form-label rqst"></label>
                                            <input type="hidden" name="rqst" class="col-form-label rqst" value="">

                                            <label class="col-md-2 col-form-label text-right">Account :</label>


                                            <select class="custom-select col-md-2" name="accnt">
                                                <option value=""></option>
                                                <option value="Windows">Windows</option>
                                                <option value="Email">Email</option>
                                                <option value="Seine2">Seine2</option>
                                                <option value="Cmms">Cmms</option>
                                            </select>

                                        </div>
                                    </th>
                                </tr>
                            </div>
                            <div class="">
                                <tr>
                                    <th class="text-center ">
                                        <label>I.D no.</label>
                                    </th>
                                    <th class="text-center ">
                                        <label>Name</label>
                                    </th>


                                </tr>
                            </div>
                        </thead>
                        <tbody class="account_field_wrapper">

                            <div class="form-group " id="" method="post">
                                <tr>

                                    <td>
                                        <input type="text" name="id[]" value=""  class="form-control">
                                    </td>
                                    <td>

                                        <div class="row">
                                            <div class="col-5">
                                                <input type="text" name="fname[]" placeholder="First Name" class=" form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="mi[]" placeholder="M.i"  class=" form-control">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" name="lname[]" placeholder="Last Name" class=" form-control">
                                            </div>
                                        </div>

                                    </td>

                                    <td><a href="javascript:void(0);" class="add_account_button" title="Add field"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                                </tr>

                            </div>

                        </tbody>
                    </table>
                </div>

                <div class="Access-Request">
                    <div class="dropdown-divider"></div>
                    <table class="table table-bordered">
                        <thead>


                            <div class="Access-Request">
                                <tr>
                                    <th colspan ="2" class="text-center">
                                        <h4>Access Request Information</h4>
                                    </th>

                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                  <span class="input-group-addon" id="basic-addon1">Folder Path</span>
                                                  <input type="text" class="form-control" placeholder="\\10.49.1.97\" aria-describedby="basic-addon1" name="path_name">
                                                </div>
                                            </div>
                                            <label class="col-md-2 col-form-label text-right">Access Rights :</label>


                                            <select class="custom-select col-md-2" name="accss_rights">
                                                <option value=""></option>
                                                <option value="FullControl">Full Control</option>
                                                <option value="Modify">Modify</option>
                                                <option value="ReadnExecute">Read & Execute</option>
                                                <option value="ListFolderContents">List Folder Contents</option>
                                                <option value="Read">Read</option>
                                                <option value="Write">Write</option>
                                            </select>
                                        </div>
                                    </th>
                                </tr>

                            </div>
                            <div class="">
                                <tr>
                                    <th class="text-center " colspan="2">
                                        <label>Name</label>
                                    </th>


                                </tr>
                            </div>
                        </thead>
                        <tbody class="access_field_wrapper">

                            <div class="form-group " id="" method="post">
                                <tr>
                                    <td>

                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <input class="form-control skills" id="emp" name="access_for[]">
                                            </div>
                                        </div>
                                    </td>

                                    <td><a href="javascript:void(0);" class="add_access_button" title="Add field"><i class="fas fa-plus-circle fa-2x"></i></a></td>
                                </tr>

                            </div>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <div class="col-md-5">
            <button id="submit_csr" type="submit" class="btn btn-primary" name="submit_csr" >Send Request</button>
        </div>
        <div class="col-md-5">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</form>
