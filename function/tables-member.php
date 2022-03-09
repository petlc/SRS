<div class="col-md-12 col-lg-12">
    <div class="card content data">
        <div class="card-header">
            <h4><i class="fa fa-list-alt fa-fw" aria-hidden="true"></i> <?php echo $department; ?> Role List</h4>
        </div>
        <div class="card-block">
            <?php
            $manage = new Report();

            $manage->query("Select * from employees where department ='$department'");
            $manage->execute();
            
            if($manage->rowCount() > 0 ){
                $pstns = new position();
                echo $pstns->pstnName();

                $pstn_list = $pstns->pstn_names;
                $pstn = array_filter(explode(";",$pstn_list));
                $pstn_no = count($pstn);
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $row_dtls = $manage->resultset();
                        for($i=0;$manage->rowCount()>$i;$i++){
                            ?>
                            <form method="post">
                                <tr>
                                    <td><?php echo $row_dtls[$i]['full_name']; ?></td>
                                    <td>
                                        <input type="hidden" name="petid" value="<?php echo $row_dtls[$i]['pet_id']; ?>">
                                        <input type="hidden" name="pre-role" value="<?php echo $row_dtls[$i]['role']; ?>">
                                        <select name="new-role" class="custom-select" required>
                                            <option value="<?php echo $row_dtls[$i]['role']; ?>"><?php echo $row_dtls[$i]['role']; ?></option>
                                            <?php
                                            if($department == "MIS" || $department == "MIS (Iloilo)"){
                                                $pstn_no = 5;
                                            }else{
                                                $pstn_no = 3;
                                            }
                                            for($a=0;$a<$pstn_no;$a++){
                                                if( $row_dtls[$i]['role'] == $pstn[$a] ){
                                                    //echo "<option value='".$pstn[$a]."'>this</option>";
                                                }else{
                                                    
                                                    echo "<option value='".$pstn[$a]."'>".$pstn[$a]."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-success" name="edit-role" value="edit-role" onclick="return confirm('Are you sure to change role of this member? ')">Apply Change</button></td>
                                </tr>
                            </form>
                            <?php
                        }    
                
                    ?>
                </tbody>
            </table>
            
            
            
            <?php
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-md" id="edit-emp-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5>Edit</h5>
                </div>
                <div class="card-block">        
                    <div name="remarks" class="row">
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