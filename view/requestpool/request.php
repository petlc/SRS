<!--
<div class="col-md-1 col-xl-1">

</div>
<div class="col-md-10 col-xl-10 pt-5">
-->
    <div class="row">
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>New Request</h3>
                </div>
                <div class="card-block text-center">
                    <h3 class="">
                        <a href="requestpool.php?status=New Request"><?php echo $status_list["New Request"];?></a>
                    </h3>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Assigned</h3>
                </div>
                <div class="card-block text-center">
                    <h3 class="">
                        <a href="requestpool.php?status=Assigned"><?php echo $status_list["Assigned"];?></a>
                    </h3>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-xl-4 mb-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Work in Progress</h3>
                </div>
                <div class="card-block text-center">
                    <h3 class="">
                        <a href="requestpool.php?status=Work in Progress"><?php echo $status_list["Work in Progress"]; ?></a>
                    </h3>

                </div>
            </div>

        </div>
    </div>
<!---
</div>
<div class="col-md-1 col-xl-1">

</div>

-->
