<?php


$row = 1; // 1-based index
$col = 1;

foreach($months as $month_name){
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $month_name);
    $col++;
}
$row++;

$col = 0;
$dates_count = count($dates_info);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Ahead of Time');
$col++;
for ($a=0; $a < $dates_count; $a++) {
    // code...

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $dates_info[$a][0]);
    $col++;
}
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'On Time');
$col++;
for ($a=0; $a < $dates_count; $a++) {
    // code...

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $dates_info[$a][1]);
    $col++;
}
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Delay');
$col++;
for ($a=0; $a < $dates_count; $a++) {
    // code...

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $dates_info[$a][2]);
    $col++;
}
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total Request');
$col++;
for ($a=0; $a < $dates_count; $a++) {
    // code...

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $dates_info[$a][3]);
    $col++;
}
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Average Response Time');
$col++;
for ($a=0; $a < $dates_count; $a++) {
    // code...

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $dates_info[$a][4]);
    $col++;
}
$row++;

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

$file = "generated report/report-".$year.".php";
$filename = str_replace('.php', '.xlsx', $file);
if (file_exists($filename)) {
    unlink($filename) or die("Couldn't delete file");
}
$objWriter->save(str_replace('.php', '.xlsx', $file));


?>
