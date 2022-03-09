<!--
<div class="col-md-1 col-lg-1">

</div>
<div class="col-md-10 col-lg-10">
-->
    <div class="card data">
        <div class="card-header red text-black">
            <h4><i class="fa fa-list-alt fa-fw" aria-hidden="true"></i>
                <?php
                    //echo $status;
                    if (!empty($_GET['request'])) {
                        // code...
                        echo $_GET['request']." - ";
                    }/*elseif (!empty($_SESSION['request'])) {
                        // code...
                        echo " - ".$_SESSION['request']." - ";
                    }*/elseif (!empty($_GET['status'])) {
                        // code...
                        echo $_GET['status']." - ";
                    }/*elseif (!empty($_SESSION['status'])) {
                        // code...
                        echo " - ".$_SESSION['status']." - ";
                    }*/else {
                        // code...
                        echo "Request";
                    }
                ?> List</h4>
        </div>
        <div class="card-block">
            <?php
            $requestlist_query = $dbCon->prepare($querylist);
            $requestlist_query->execute();

            if($requestlist_query->rowCount() > 0){
            ?>
            <table class="table table-hover cf">
                <thead>
                    <tr>
                        <th>Site</th>
                        <th>Referrence No.</th>
                        <th>Request Date</th>
                        <?php

                        if (strpos($status, 'My') !== false) {

                        }else{
                            ?>
                            <th>Requestor</th>
                            <?php
                        }


                        ?>
                        
                        <th>Request</th>
                        <th>Details</th>
                        <th>Status</th>
                        <?php

                        if($status == "My Request"){
                            ?>
                            <th>Assigned</th>
                            <?php
                        }


                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row=$requestlist_query->FETCH(PDO::FETCH_ASSOC)){

                            $prcss = $row['prcss_no'];

                            if($prcss == "CSR"){
                                $ref_no = $row['ic_no'];
                            }elseif ($prcss == "CPR") {
                                $ref_no = $row['ic_no'];
                            }elseif ($prcss == "DRR") {
                                $ref_no = $row['ic_no'];
                            }elseif ($prcss == "QA") {
                                $ref_no = $row['ic_no'];
                            }else{
                                $ref_no = $prcss;
                            }

                            $request_date = date('m/d/Y', strtotime($row['ic_crtd_date']))
                    ?>
                    <tr>
                         <?php 
                            echo "<td>".$row['ic_site']."</td>";
                            ?>
                        <td>
                            <a href="view.php?ic=<?php echo $row['ic_no']; ?>"><?php echo $ref_no; ?></a>
                        </td>
                        <td>
                            <?php echo $request_date; ?>
                        </td>
                        <?php

                        if (strpos($status, 'My') !== false) {

                        }else{
                            ?>
                            <td><?php echo $row['ic_rqstr']; ?></td>
                            <?php
                        }


                        ?>
                        <td>
                            <?php echo $row['ic_rqst']; ?>
                        </td>
                        <td>
                            <?php
                                $specific_dtl = str_replace(" ","",explode(";",$row['ic_dtls']));
                                echo substr(str_replace(";"," ",$row['ic_dtls']),0,50)."...";
                            ?>
                        </td>
                        <td>
                            <?php echo $row['ic_status']; ?>
                        </td>
                        <?php

                        if($status == "My Request"){
                            ?>
                            <td class="assigned"><?php echo $row['assigned_to']; ?></td>
                            <?php
                        }


                        ?>
                    </tr>
                    <?php
                }
            }else{
                echo "No result";
            }
            ?>
                </tbody>
            </table>

            <div class="">
                <ul class="pagination justify-content-center">
                    <?php
                    if(empty($querypage)){

                    }else{
                        $requestpage_query = $dbCon->prepare($querypage);
                        $requestpage_query->execute();
                        //echo $requestpage_query->rowCount();
                        $requestrows = $requestpage_query->rowCount();
                        $requestpages = ceil($requestrows/$limit);

                        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
                            // cast var as int
                            $currentpage = (int) $_GET['id'];
                        } else {
                            // default page num
                            $currentpage = 1;
                        }

                        $url = basename($_SERVER['REQUEST_URI']);

                        //echo $url;

                        if ($currentpage > 3) {
                            // show << link to go back to page 1
                            if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=1";
                            }elseif(strpos($url, 'id') !== false){
                                $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=1";
                            }elseif(strpos($url, 'status') !== false){
                                $url = $url."&id=1";
                            }elseif(strpos($url, 'endorse') !== false){
                                $url = $url."&id=".$x;
                            }else{
                                $url = basename($_SERVER['REQUEST_URI']);
                                $url = $url."&id=1";
                            }

                            //$url = $url."id=1";
                            print'<li class="page-item">';
                            echo " <a class='page-link' href='$url'><<</a> ";
                            print'</li>';
                            // get previous page num
                            if($currentpage >= 11 ){
                                $prevpage = $currentpage - 10;
                                // show < link to go back to 1 page
                                /*
                                if(strpos($url, 'id') !== false){
                                    $baseURL = explode("?",basename($_SERVER['REQUEST_URI']));
                                    $url = $baseURL[0];
                                    $url = $url."?id=".$prevpage;
                                }elseif(strpos($url, 'status') !== false){
                                    $url = $url."&id=".$prevpage;
                                }else{
                                    $url = basename($_SERVER['REQUEST_URI']);
                                    $url = $url."?id=".$prevpage;
                                }
                                */
                                if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                    $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                    $url = $baseURL[0];
                                    $url = $url."&id=".$prevpage;
                                }elseif(strpos($url, 'id') !== false){
                                    $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                    $url = $baseURL[0];
                                    $url = $url."&id=".$prevpage;
                                }elseif(strpos($url, 'status') !== false){
                                    $url = $url."&id=".$prevpage;
                                }elseif(strpos($url, 'endorse') !== false){
                                    $url = $url."&id=".$x;
                                }else{
                                    $url = basename($_SERVER['REQUEST_URI']);
                                    $url = $url."&id=".$prevpage;
                                }

                                echo " <a class='page-link' href='$url'>$prevpage</a> ";
                                echo " <a class='page-link'>...</a> ";
                            }
                        }

                        if ($currentpage > 1) {
                            $prevpage = $currentpage - 1;
                            /*
                            if(strpos($url, 'id') !== false){
                                $baseURL = explode("?",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."?id=".$prevpage;
                            }elseif(strpos($url, 'status') !== false){
                                $url = $url."&id=".$prevpage;
                            }else{
                                $url = basename($_SERVER['REQUEST_URI']);
                                $url = $url."?id=".$prevpage;
                            }
                            */
                            if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=".$prevpage;
                            }elseif(strpos($url, 'id') !== false){
                                $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=".$prevpage;
                            }elseif(strpos($url, 'status') !== false){
                                $url = $url."&id=".$prevpage;
                            }elseif(strpos($url, 'endorse') !== false){
                                $url = $url."&id=".$x;
                            }else{
                                $url = basename($_SERVER['REQUEST_URI']);
                                $url = $url."&id=".$prevpage;
                            }

                            print'<li class="page-item">';
                            print"<a class='page-link' href='$url'>previous</a>";
                            print'</li>';
                            //echo " <a href='{$_SERVER['PHP_SELF']}?id=$prevpage'>previous</a> ";

                            $onleft = "$url";
                        }else{
                            $onleft = " ";
                        }  //echo " <a>...</a> ";

                        $range = 2;

                        // loop to show links to range of pages around current page
                        for ($x = ($currentpage - $range); $x < (($currentpage + $range)  + 1); $x++) {
                            // if it's a valid page number...
                            print'<li class="page-item">';
                            if (($x > 0) && ($x <= $requestpages)) {
                                // if we're on current page...
                                if ($x == $currentpage) {
                                    // 'highlight' it but don't make a link
                                    echo " <b class='page-link bg-success'>$x</b> ";
                                    // if not current page...
                                } else {
                                    // make it a link
                                    //echo $url;
                                    
                                    if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                        $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                        $url = $baseURL[0];
                                        $url = $url."&id=".$x;
                                    }elseif(strpos($url, 'id') !== false){
                                        $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                        $url = $baseURL[0];
                                        $url = $url."&id=".$x;
                                    }elseif(strpos($url, 'status') !== false){
                                        $url = $url."&id=".$x;
                                    }elseif(strpos($url, 'endorse') !== false){
                                        $url = $url."&id=".$x;
                                    }else{
                                        $url = basename($_SERVER['REQUEST_URI']);
                                        $url = $url."?id=".$x;
                                    }
                                    
                                    /*
                                    if(strpos($url, '?') !== false){
                                        echo "meron";
                                    }else{
                                        echo "wala ?";
                                    }
                                    */
                                    /*
                                    if(strpos($url, '=') !== false){
                                        $baseURL = explode("?",basename($_SERVER['REQUEST_URI']));
                                        $url = $baseURL[0];
                                        $url = $url."?id=".$x;
                                    }
                                    */
                                    echo " <a class='page-link' href='$url'>$x</a> ";
                                } // end else
                            } // end if
                            print'</li>';
                        } // end for
                        if ($currentpage != $requestpages) {
                            $nextpage = $currentpage + 1;
                            if($requestpages != 0){

                                if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                    $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                    $url = $baseURL[0];
                                    $url = $url."&id=".$nextpage;
                                }elseif(strpos($url, 'id') !== false){
                                    $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                    $url = $baseURL[0];
                                    $url = $url."&id=".$nextpage;
                                }elseif(strpos($url, 'status') !== false){
                                    $url = $url."&id=".$nextpage;
                                }elseif(strpos($url, 'endorse') !== false){
                                    $url = $url."&id=".$x;
                                }else{
                                    $url = basename($_SERVER['REQUEST_URI']);
                                    $url = $url."&id=".$nextpage;
                                }

                                print'<li class="page-item">';
                                print"<a class='page-link' href='$url'>Next</a>";
                                print'</li>';
                                //echo " <a href='{$_SERVER['PHP_SELF']}?id=$nextpage'>next</a> ";
                                $onright = "$url";
                            }else{
                                $onright = " ";
                            }
                        }else{
                            $onright = " ";
                        }
                        if (($requestpages - $currentpage) > 2) {
                            if($requestpages > 11 ){
                                // get next page
                                $nextpage = $currentpage + 10;
                                // echo forward link for next page

                                if($nextpage > $requestpages){

                                }else{
                                    if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                        $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                        $url = $baseURL[0];
                                        $url = $url."&id=".$nextpage;
                                    }elseif(strpos($url, 'id') !== false){
                                        $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                        $url = $baseURL[0];
                                        $url = $url."&id=".$nextpage;
                                    }elseif(strpos($url, 'status') !== false){
                                        $url = $url."&id=".$nextpage;
                                    }elseif(strpos($url, 'endorse') !== false){
                                        $url = $url."&id=".$x;
                                    }else{
                                        $url = basename($_SERVER['REQUEST_URI']);
                                        $url = $url."&id=".$nextpage;
                                    }


                                    echo " <a class='page-link'>...</a> ";
                                    print'<li class="page-item">';
                                    echo " <a class='page-link' href='$url'> $nextpage</a> ";
                                    print'</li>';
                                }

                            }
                            // echo forward link for lastpage
                            /*
                            if(strpos($url, 'id') !== false){
                                $baseURL = explode("?",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."?id=".$requestpages;
                            }elseif(strpos($url, 'status') !== false){
                                $url = $url."&id=".$requestpages;
                            }else{
                                $url = basename($_SERVER['REQUEST_URI']);
                                $url = $url."?id=".$requestpages;
                            }
                            */
                            if(strpos($url, 'id') !== false && strpos($url, 'status') !== false || strpos($url, 'rqst') !== false ){
                                $baseURL = explode("&id",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=".$requestpages;
                            }elseif(strpos($url, 'id') !== false){
                                $baseURL = explode("&",basename($_SERVER['REQUEST_URI']));
                                $url = $baseURL[0];
                                $url = $url."&id=".$requestpages;
                            }elseif(strpos($url, 'status') !== false){
                                $url = $url."&id=".$requestpages;
                            }elseif(strpos($url, 'endorse') !== false){
                                $url = $url."&id=".$x;
                            }else{
                                $url = basename($_SERVER['REQUEST_URI']);
                                $url = $url."&id=".$requestpages;
                            }
                            print'<li class="page-item">';
                            echo " <a class='page-link' href='$url'>>></a> ";
                            print'</li">';
                        } // end if
                        /****** end build pagination links ******/
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
<!--
</div>
<div class="col-md-1 col-lg-1">

</div>
-->
