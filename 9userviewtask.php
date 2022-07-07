<?php include "5data_class.php";
    $name=$_POST['name'];
    $tid=$_POST['id'];
    $obj=new data();
    $obj->setconnection();
    $obj->assigntask($name,$tid);

?>