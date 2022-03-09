<?php

require_once 'core.php';
if (isset($_GET['term'])){
    $return_arr = array();

    $searchie = $_GET['term'];

    $search = new Employees();

    $search->query("Select * from emp_info where full_name like '%$searchie%' or pet_id like '%$searchie%' or id like '%$searchie%'");
    $search->execute();


    $row=$search->resultset();

        foreach($row as $rows){

            $return_arr[] = $rows['full_name']." - ".$rows['department']." - ".$rows['pet_id'];

        }



    echo json_encode($return_arr);
}
?>
