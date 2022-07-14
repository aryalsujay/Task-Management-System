<?php include "5data_class.php";
    $stid=$_POST['stid'];
    $user=$_POST['name'];
    $note=$_POST['note'];
    $obj=new data();
    $obj->setconnection();
    $obj->reassign($stid,$user,$note);
?>