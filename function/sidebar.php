<?php

#### Side Bar Bar ####

function sideBar($department, $role){
    
    switch($department){
            
            case "MIS (Iloilo)";
            
                switch($role){
                        
                    case "Support":
                        ?>
                        <div class="list-group col-12">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="endorsement.php">Endorsement</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request Pool</a>
                            <a class="list-group-item list-group-item-action" href="#">Search</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>

                        <?php
                    break;
                        
                    case "Service Desk":
                        ?>
                        <div class="list-group col-12">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="requestpool.php?status=New Request">MIS Request Pool</a>
                            <a class="list-group-item list-group-item-action" href="endorsement.php">Endorsement</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request Pool</a>
                            <a class="list-group-item list-group-item-action" href="#">Report</a>
                            <a class="list-group-item list-group-item-action" href="#">Search</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>

                        <?php
                    break;
                    case "Approver";   
                    case "Checker";
                        ?>
                        <div class="list-group col-12 ">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="requestpool.php?status=New Request">MIS Request Pool</a>
                            <a class="list-group-item list-group-item-action" href="endorsement.php">Endorsement</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request Pool</a>
                            <a class="list-group-item list-group-item-action" href="#">Report</a>
                            <a class="list-group-item list-group-item-action" href="#">Search</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>

                        <?php
                    break;   
                }
            
            break;
            
            default:
            
                switch($role){
                        
                    case "Member";
                        ?>
                        <div class="list-group col-12">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>  
                        <?php
                    break;
                        
                    case "Checker";
                        ?>
                        <div class="list-group col-12">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request</a>
                            <a class="list-group-item list-group-item-action" href="endorsement.php">Endorsement</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>  
                        <?php
                    break;
                        
                    case "Approver";
                        ?>
                        <div class="list-group col-12">
                            <a class="list-group-item list-group-item-action" href="index.php">Home</a>
                            <a class="list-group-item list-group-item-action" href="requestform.php">Create Request</a>
                            <a class="list-group-item list-group-item-action" href="myrequest.php">My Request</a>
                            <a class="list-group-item list-group-item-action" href="endorsement.php">Endorsement</a>
                            <a class="list-group-item list-group-item-action btn-danger" href="logout.php">Log Out</a>
                        </div>  
                        <?php
                    break;
                        
                }
            
    }
}

function endorsementTopbar($department, $role){
    
    
    switch($department){
            
            case "MIS";
                switch($role){
                        
                    case "Member";
                        ?>
                        <div class="col-md-4 text-center">
                            <label class="btn btn-primary">
                                <input type="radio" name="endorsement" id="option1" autocomplete="off" value="Assigned"> Assigned
                            </label>
                        </div>
                        <div class="col-md-4 text-center">
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="btn btn-primary">
                                <input type="radio" name="endorsement" id="option2" autocomplete="off" value="Work in Progress"> Work in Progress
                            </label>
                        </div>
                        <?php
                    break;
                        
                    case "Checker";
                        ?>
                        <div class="col-md-4 text-center">
                            <a class="btn btn-primary"  href="endorsement.php?endorse=Assigned" role="button">Assigned</a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="btn btn-primary"  href="endorsement.php?endorse=Work in Progress" role="button">Work in Progress</a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="btn btn-primary"  href="endorsement.php?endorse=Done" role="button">For Checking</a>
                        </div>
                        <?php
                    break;
                    
                }
            break;
                
            
            default;
            
                switch($role){
                       
                    case "Checker";

                        $_GET['endorse'] = "For Checking";
                        break;

                    case "Approver";

                        $_GET['endorse'] = "For Approval";
                        
                        break;
                }
                
            break;
            
    }
}

?>