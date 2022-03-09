<?php

if(!empty($_GET['form'])){

  $form = $_GET['form'];

  switch ($form) {

    case 'CSR':
      # code...

      include 'forms\csr\form.csr.php';

      break;

    case 'CPR':
      # code...
      break;

    case 'DRR':
      # code...
      break;

    case 'QA':
      # code...
      break;

    default:
      # code...
      break;
  }

}


?>
