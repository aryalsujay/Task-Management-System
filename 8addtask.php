<?php include "5data_class.php";
    $tname=$_POST['tname'];
    $tdetail=$_POST['tdetail'];
    $obj= new data();
    $obj->setconnection();
    $obj->addtask($tname,$tdetail);

?>