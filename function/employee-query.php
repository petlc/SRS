<?php

$emp = new Report();
    
$petid = $_GET['petid'];
    
$emp->query("Select * from employees where pet_id =:petid");
$emp->bind(':petid',$petid);
$emp->execute();
        
if($emp->rowCount() > 0){
    $emp_dtls       = $emp->single();
    $emp_dtls_count = count($emp->single());
    
}
?>
<div class="col-md-12 col-lg-12">
    <div class="card content data">
        <div class="card-header">
            <h4><i class="fa fa-list-alt fa-fw" aria-hidden="true"></i><?php echo $emp_dtls['full_name']; ?></h4>
        </div>
        <div class="card-block">
            <table class="table table-bordered">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $emp_dtls['first_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Middle Initial</td>
                        <td><?php echo $emp_dtls['middle_initial']; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $emp_dtls['last_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Employee Number</td>
                        <td><?php echo $emp_dtls['id']; ?></td>
                    </tr>
                    <tr>
                        <td>Department </td>
                        <td><?php echo $emp_dtls['department']; ?></td>
                    </tr>
                    <tr>
                        <td>Role </td>
                        <td><?php echo $emp_dtls['role']; ?></td>
                    </tr>
                </tbody>
            </table>
            
            
            
        </div>
    </div>
</div>