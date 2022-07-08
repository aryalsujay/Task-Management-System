<?php include "5data_class.php";
    $name=$_POST['addname'];
    $email=$_POST['addemail'];
    $pass=$_POST['addpass'];
    $type=$_POST['type'];
    $obj=new data();
    $obj->setconnection();
    $obj->adduser($name,$email,$pass,$type);
?>