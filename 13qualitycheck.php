<?php include "5data_class.php";
    $stid=$_POST['stid'];
    $user=$_POST['name'];
    $note=$_POST['note'];
    $next=$_POST['next'];
    $uid=$_POST['uid'];
    if($next=='Reassign'){
        $obj=new data();
        $obj->setconnection();
        $obj->reassignmanager($stid,$user,$note);
    }
    else{
        $obj=new data();
        $obj->setconnection();
        $obj->qualitycheck($stid,$user,$note,$uid);
    }

?>