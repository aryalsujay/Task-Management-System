<?php include "5data_class.php";
    $name=$_POST['name'];
    $stid=$_POST['stid'];
    //$stid=$_POST['stid'];
    $obj=new data();
    $obj->setconnection();
    $obj->assignstask($name,$stid,);

?>