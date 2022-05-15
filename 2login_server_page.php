<?php include "5data_class.php";
    $email=$_GET['email'];
    $pass=$_GET['pass'];
    if($email==null||$pass==null){
        $emailmsg="";
        $passmsg="";
        if($email==null){            
            $emailmsg="Email Empty";
        }
        if($pass==null){
            $passmsg="Password Empty";
        }
        header("Location:1index.php?emailmsg=$emailmsg&passmsg=$passmsg");
    }
    elseif($email!=null&&$pass!=null){
        $obj = new data;
        $obj->setconnection();
        $obj->userLogin($email,$pass);
    }
?>
