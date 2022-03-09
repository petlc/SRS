
<style >
    .circle {
        margin: auto;
        padding-top: 8px;
        border:2px solid red;
        height:85px;
        border-radius:50%;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;
        width:85px;
        }
    .sig-divider{
        margin: 3px 0px;
        border:1px solid red;
        width: 80px;
    }
    .dept, .date, .name, .code{
        font-size: 10px;
    }

</style>
<?php

function signatories($fullname, $ic_no, $cnvrtd_crtd_date){
    global $requestor_department;

    $employee_query = new Employees();

    $employee_query->query("Select * from emp_info where full_name=:full_name");
    $employee_query->bind(':full_name', $fullname);
    $employee_query->execute();

    if ($employee_query->rowCount() > 0) {
        // code...
        $emp_row = $employee_query->single();

        $firstname      = $emp_row['first_name'];
        $mid_ini        = $emp_row['middle_initial'];
        $lastname       = $emp_row['last_name'];
        $department     = $emp_row['department'];
        $petid          = $emp_row['id'];

        $stmp_nm        = $firstname[0].".".$lastname;

    }else{
        
        if (strpos($fullname, '.') !== false) {
            // code...
            $name       = explode(".",$fullname);

        }else{

            if (strpos($fullname, '  ') !== false) {
                $name       = explode("  ",$fullname);
            }else{
                $name       = explode(" ",$fullname);
            }

        }

        if (count($name)>2) {
            // code...
            $l_name = $name[2];
        }else{
            $l_name = $name[1];
        }
        
        $stmp_nm = $fullname[0].".".$l_name;
        $department = $requestor_department;
    }

    $wrklg = new Report();
    //$wrklg->query("Select wrklg_date from wrklg where ic_id=:ic_id and wrklg_personnel = :wrklg_prsnnl order by wrklg_id desc");
    $wrklg->query("Select wrklg_date from wrklg where ic_id=:ic_id and wrklg_personnel = :wrklg_prsnnl");
    $wrklg->bind(':ic_id',$ic_no);
    $wrklg->bind(':wrklg_prsnnl',$fullname);
    $wrklg->execute();

    if ($wrklg->rowCount() > 0) {
        // code...
        $wrklg_row = $wrklg->single();

        $wrklg_date     = explode(" ",$wrklg_row['wrklg_date']);

        $stmp_date        = date('m/d/Y', strtotime($wrklg_date[0]));

    }else{

        $stmp_date = $cnvrtd_crtd_date;
    }


    return array($stmp_nm, $stmp_date, $department);
}



function stamps($fullname, $docu_name){

    $stamp_query = new DSS();

    $stamp_query->query("Select * from ds_info where ds_crtr=:full_name and ds_docu_name=:docu_name");
    $stamp_query->bind(':full_name', $fullname);
    $stamp_query->bind(':docu_name', $docu_name);
    $stamp_query->execute();

    if ($stamp_query->rowCount() > 0) {
        // code...

        $stamp_info = $stamp_query->single();

        $ds_no      = $stamp_info['ds_no'];

        $date       = explode(" ",$stamp_info['ds_crtd_date']);
        $dept       = $stamp_info['ds_crtr_dept'];

        if (strpos($stamp_info['ds_crtr'], '.') !== false) {
            // code...
            $name       = explode(".",$stamp_info['ds_crtr']);

        }else{

            if (strpos($stamp_info['ds_crtr'], '  ') !== false) {
                $name       = explode("  ",$stamp_info['ds_crtr']);
            }else{
                $name       = explode(" ",$stamp_info['ds_crtr']);
            }

        }

        if (count($name)>2) {
            // code...
            $l_name = $name[2];
        }else{
            $l_name = $name[1];
        }

        $stmp_nm = $stamp_info['ds_crtr'][0].".".$l_name;

        $stmp_val = array($dept, $date[0], $stmp_nm, $ds_no);


    }else{
        $stmp_val = "";
    }

    return $stmp_val;
}

 ?>
