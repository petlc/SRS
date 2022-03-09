<?php

define("DB_HOST_dss", "localhost");
define("DB_USER_dss", "root");
define("DB_PASS_dss", "");
define("DB_NAME_dss", "digital_signature");

class DSS{

    private $host      = DB_HOST_dss;
    private $user      = DB_USER_dss;
    private $pass      = DB_PASS_dss;
    private $dbname    = DB_NAME_dss;

    private $dbh;
    private $error;

    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }



    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){

        if (is_null($type)) {
          switch (true) {
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
          }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

}

function stamp($fullname, $docu_name){

    $stamp_query = new DSS();

    $stamp_query->query("Select * from ds_info where ds_crtr=:full_name and ds_docu_name=:docu_name");
    $stamp_query->bind(':full_name', $fullname);
    $stamp_query->bind(':docu_name', $docu_name);
    $stamp_query->execute();

    if ($stamp_query->rowCount() > 0) {
        // code...

        $stamp_info = $stamp_query->single();

        $ds_no      = $stamp_info['ds_no'];
        $name       = explode(".",$stamp_info['ds_crtr']);
        $date       = explode(" ",$stamp_info['ds_crtd_date']);
        $dept       = $stamp_info['ds_crtr_dept'];

        if (count($name)>2) {
            // code...
            $l_name = $name[2];
        }else{
            $l_name = $name[2];
        }

        $stmp_nm = $stamp_info['ds_crtr'][0].".".$l_name;

        ?>

        <div class="circle">
            <div class="dept text-center">PET <?php echo $dept ?></div>
            <div class="sig-divider"></div>
            <div class="date text-center"><?php echo $date[0]; ?></div>
            <div class="sig-divider"></div>
            <div class="name text-center"><?php echo $stmp_nm; ?></div>
        </div>
        <div class="text-center">
            <label class="code text-center"><?php echo $ds_no; ?></label>
        </div>

        <?php
    }

}

function generateStamp($ic_no, $fullname, $firstname, $mid_ini, $lastname, $petid, $department){

    $full_name   = $fullname;
    $first_name  = $firstname;
    $last_name   = $lastname;
    $emp_id      = $petid;
    $emp_dept    = $department;
    $crtd_date   = date("Y-m-d H:i:s");
    $docu_name   = $ic_no;
    $docu_path   = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $ipaddress   = $_SERVER['REMOTE_ADDR'];
    $validation  = "Valid";
    $table       = "ds_".date("Y");

    $regi_stamp = new DSS();

    $regi_stamp->query("Insert into $table (ds_no)Values('')");
    $regi_stamp->execute();

    $ds_id   = $regi_stamp->lastInsertId();
    $autoinc = sprintf("%05d",$ds_id);
    $ds_no   = "DS-".$autoinc.date("-".'y');

    $regi_stamp->query("Update $table set ds_no = :ds_no where ds_id=:ds_id");
    $regi_stamp->bind(":ds_no",$ds_no);
    $regi_stamp->bind(":ds_id",$ds_id);
    $regi_stamp->execute();

    $regi_stamp->query("Insert into ds_info (ds_crtr, ds_crtr_id, ds_crtr_dept, ds_no, ds_crtd_date, ds_ip_address, ds_docu_name, ds_file_path, ds_file_validation)Values(:ds_crtr, :ds_crtr_id, :ds_crtr_dept, :ds_no, :ds_crtd_date,  :ds_ip_address, :ds_docu_name, :ds_file_path, :ds_validation)");
    $regi_stamp->bind(":ds_no",$ds_no);
    $regi_stamp->bind(":ds_crtr",$full_name);
    $regi_stamp->bind(":ds_crtr_id",$emp_id);
    $regi_stamp->bind(":ds_crtr_dept",$emp_dept);
    $regi_stamp->bind(":ds_crtd_date",$crtd_date);
    $regi_stamp->bind(":ds_ip_address",$ipaddress);
    $regi_stamp->bind(":ds_docu_name",$docu_name);
    $regi_stamp->bind(":ds_file_path",$docu_path);
    $regi_stamp->bind(":ds_validation",$validation);
    $regi_stamp->execute();

}


?>
