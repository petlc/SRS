<?php

$PrcssStatus->dstnctRqst($prcss_status,$prcss);



?>

<div class="col-md-1 col-xl-1">

</div>
<div class="col-md-4 col-xl-4 mt-5">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $prcss." - ".$prcss_status ?> list</h5>
        </div>
        <div class="card-block">
            <table class="table table-hover">
                <thead>

                </thead>
                <tbody>
                    <?php
                        for ($i=0; $i < count($PrcssStatus->queryno); $i++) {
                            // code...
                            $row = $PrcssStatus->queryno;
                            echo "<tr>";
                            for ($a=0; $a < count($row[$i]); $a++) {
                                // code...
                                //$row = $PrcssStatus->queryno;

                                //echo $row[$i][$a]."<br>";
                                echo "<td>".$row[$i][$a]."</td>";
                            }
                            echo "</tr>";
                        }


                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-md-7 col-xl-7">

</div>
