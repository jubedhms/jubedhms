<?php 
    function generateExcel($dt=array()) {
    $CI = & get_instance();
    $r=1;$c=0;
    $CI->load->library('excel');
    $object = new PHPExcel();
    $object->setActiveSheetIndex(0);
    foreach($dt as $row){
        if($r==1){
            $object->getActiveSheet()->setCellValueByColumnAndRow($c++, $r, "Sr."); 
            foreach(array_keys($row) as $colum){
                $object->getActiveSheet()->setCellValueByColumnAndRow($c++, $r,$colum);
            }
            $r++;
            $c=0;
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow($c++,$r,($r-1));
        foreach($row as $col){
            $object->getActiveSheet()->setCellValueByColumnAndRow($c++, $r,$col);
        }
        $r++;
        $c=0;
    }
    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
    ob_start();
    $object_writer->save('php://output');
    $xlsData = ob_get_contents();
    ob_end_clean();
    die("data:application/vnd.ms-excel;base64,".base64_encode($xlsData));
}