<?php include "5data_class.php";
    $ademail=$_GET['ademail'];
    $adpass=$_GET['adpass'];
    if($ademail==null||$adpass==null){
        $ademailmsg="";
        $adpassmsg="";
        if($ademail==null){            
            $ademailmsg="Email Empty";
        }
        if($adpass==null){
            $adpassmsg="Password Empty";
        }
        header("Location:1index.php?ademailmsg=$ademailmsg&adpassmsg=$adpassmsg");
    }
    elseif($ademail!=null&&$adpass!=null){
        $obj= new data;
        $obj->setconnection();
        $obj->adminLogin($ademail,$adpass);
    }
?>