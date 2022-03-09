<div class="col-md-5 mb-5">
    <div class="card ">
        <div class="card-header">
            <h4><i class="fa fa-users" aria-hidden="true"></i> User Request </h4>
        </div>
        <div class="card-block">
            <table class="table table-bordered cf">
                <thead>
                    <tr>
                        <th>Newly Created</th>
                        <th>For Checking</th>
                        <th>For Approval</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="requestpool.php?status=Newly Created"><?php echo $status_list["Newly Created"]; ?></a>
                        </td>
                        <td>
                            <a href="requestpool.php?status=For Checking"><?php echo $status_list["For Checking"]; ?>
                        </td>
                        <td>
                            <a href="requestpool.php?status=For Approval"><?php echo $status_list["For Approval"]; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
