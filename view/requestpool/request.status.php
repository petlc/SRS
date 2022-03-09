<div class="row">
    
    <div class="col-md-12 col-xl-12 mb-5">
        <div class="card">
            <div class="card-header" >
                <h4><i class="fa fa-heartbeat" aria-hidden="true"></i> Request Status </h4>

            </div>
            <div class="card-block ">

                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3">New Request</th>
                            <th colspan="3">Assigned</th>
                            <th colspan="3">Work in Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td colspan="3"><a href="requestpool.php?status=New Request"><?php echo $status_list["New Request"];?></a></td>
                            <td colspan="3">
                                <a href="requestpool.php?status=Assigned"><?php echo $status_list["Assigned"];?></a>
                            </td>
                            <td colspan="3">
                                <a href="requestpool.php?status=Work in Progress"><?php echo $status_list["Work in Progress"]; ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Ahead of Deadline</td>
                            <td>On Deadline</td>
                            <td>Delay</td>
                            <td>Ahead of Deadline</td>
                            <td>On Deadline</td>
                            <td>Delay</td>
                            <td>Ahead of Deadline</td>
                            <td>On Deadline</td>
                            <td>Delay</td>
                        </tr>
                        <tr>
                            <!--- New Request -->
                            <td>CSR</td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ahead&prcss=CSR"><?php echo $process_list["New RequestCSRahead"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ontime&prcss=CSR"><?php echo $process_list["New RequestCSRontime"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Delay&prcss=CSR"><?php echo $process_list["New RequestCSRdelay"] ?></a></td>
                            <!--- Assigned -->
                            <td><a href="requestpool.php?status=Assigned&deadline=Ahead&prcss=CSR"><?php echo $process_list["AssignedCSRahead"] ?></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Ontime&prcss=CSR"><?php echo $process_list["AssignedCSRontime"] ?></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Delay&prcss=CSR"><?php echo $process_list["AssignedCSRdelay"] ?></a></td>
                            <!--- Work in Progress -->
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ahead&prcss=CSR"><?php echo $process_list["Work in ProgressCSRahead"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ontime&prcss=CSR"><?php echo $process_list["Work in ProgressCSRontime"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Delay&prcss=CSR"><?php echo $process_list["Work in ProgressCSRdelay"] ?></a></td>
                        </tr>
                        <tr>
                            <!--- New Request -->
                            <td>CPR</td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ahead&prcss=CPR"><?php echo $process_list["New RequestCPRahead"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ontime&prcss=CPR"><?php echo $process_list["New RequestCPRontime"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Delay&prcss=CPR"><?php echo $process_list["New RequestCPRdelay"] ?></a></td>
                            <!--- Assigned -->
                            <td><a href="requestpool.php?status=Assigned&deadline=Ahead&prcss=CPR"><?php echo $process_list["AssignedCPRahead"] ?></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Ontime&prcss=CPR"><?php echo $process_list["AssignedCPRontime"] ?></a></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Delay&prcss=CPR"><?php echo $process_list["AssignedCPRdelay"] ?></a></td>
                            <!--- Work in Progress -->
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ahead&prcss=CPR"><?php echo $process_list["Work in ProgressCPRahead"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ontime&prcss=CPR"><?php echo $process_list["Work in ProgressCPRontime"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Delay&prcss=CPR"><?php echo $process_list["Work in ProgressCPRdelay"] ?></a></td>
                        </tr>
                        <tr>
                            <!--- New Request -->
                            <td>DRR</td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ahead&prcss=DRR"><?php echo $process_list["New RequestDRRahead"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ontime&prcss=DRR"><?php echo $process_list["New RequestDRRontime"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Delay&prcss=DRR"><?php echo $process_list["New RequestDRRdelay"] ?></a></td>
                            <!--- Assigned -->
                            <td><a href="requestpool.php?status=Assigned&deadline=Ahead&prcss=DRR"><?php echo $process_list["AssignedDRRahead"] ?></a></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Ontime&prcss=DRR"><?php echo $process_list["AssignedDRRontime"] ?></a></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Delay&prcss=DRR"><?php echo $process_list["AssignedDRRdelay"] ?></a></td>
                            <!--- Work in Progress -->
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ahead&prcss=DRR"><?php echo $process_list["Work in ProgressDRRahead"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ontime&prcss=DRR"><?php echo $process_list["Work in ProgressDRRontime"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Delay&prcss=DRR"><?php echo $process_list["Work in ProgressDRRdelay"] ?></a></td>
                        </tr>
                        <!---
                        <tr>
                            <!--- New Request
                            <td>QA</td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ahead&prcss=QA"><?php echo $process_list["New RequestQAahead"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Ontime&prcss=QA"><?php echo $process_list["New RequestQAontime"] ?></a></td>
                            <td><a href="requestpool.php?status=New Request&deadline=Delay&prcss=QA"><?php echo $process_list["New RequestQAdelay"] ?></a></td>
                            <!--- Assigned
                            <td><a href="requestpool.php?status=Assigned&deadline=Ahead&prcss=QA"><?php echo $process_list["AssignedQAahead"] ?></a></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Ontime&prcss=QA"><?php echo $process_list["AssignedQAontime"] ?></a></td>
                            <td><a href="requestpool.php?status=Assigned&deadline=Delay&prcss=QA"><?php echo $process_list["AssignedQAdelay"] ?></a></td>
                            <!--- Work in Progress

                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ahead&prcss=QA"><?php echo $process_list["Work in ProgressQAahead"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Ontime&prcss=QA"><?php echo $process_list["Work in ProgressQAontime"] ?></td>
                            <td><a href="requestpool.php?status=Work in Progress&deadline=Delay&prcss=QA"><?php echo $process_list["Work in ProgressQAdelay"] ?></a></td>
                        </tr>
                    -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
