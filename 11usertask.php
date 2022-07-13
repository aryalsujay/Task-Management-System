<?php include "5data_class.php";
    $userloginid=$_POST['uid'];
    $stid=$_POST['stid'];
    $status=$_POST['status'];
    $note=$_POST['note'];
    $obj=new data();
    $obj->setconnection();
    $obj->taskstatus($stid,$status,$userloginid,$note);
    //Rectified git conflict
?>