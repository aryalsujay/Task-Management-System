<?php include "5data_class.php";
    //session_start();
    $userloginid=$_GET['userlogid'];
    //$userloginid=$_SESSION["userid"] = $_GET['userlogid'];
    if(empty($_SESSION['userid'])){
        header("Location:1index.php?msg=Invalid");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       
    <title>Document</title>
</head>
<style>
    .container,
    .row,
    .innerdiv{
        text-align: center;
        margin-top: 100px;
    }
    .imglogo{
        margin:auto;
    }
    .greenbtn{
        cursor: pointer;
        background-color: greenyellow;
        box-sizing: content-box;
        border-radius: 1rem;
        box-shadow: rgb(16,170,16);
        margin-top: 8px;
        width:92%;
        height: 40px;

    }
    .leftinnerdiv{
        float:left;
        width:25%;
    }
    .rightinnerdiv{
        float:right;
        width:75%;
    }
    .innerright{
        background-color: rgb(105, 221, 105);
    }
    th{
        background-color: orange;
        text-align: center;
    }
    td{
        background-color: wheat;
        text-align: center;
    }
    .a{
        text-decoration: none;
    }
</style>
<body>
    <?php 
    //include "5data_class.php"; ?>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.PNG"/></div>
            
            <div class="leftinnerdiv">
                <button class="greenbtn">Welcome</button>
                <button class="greenbtn" onclick="openpart('myaccount')">My Account</button>
                <button class="greenbtn" onclick="openpart('reqbook')">Request Book</button>
                <button class="greenbtn" onclick="openpart('bookreport')">Book Report</button>
                <a href="1index.php"><button class="greenbtn">LOGOUT</button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){echo "display:none";}else{echo "";}?>">
                   <button class="greenbtn">My Account</button>
                   <?php
                        $userloginid=$_GET['userlogid'];
                        $obj=new data;
                        $obj->setconnection();
                        $obj->userdetail($userloginid);
                        $recordset=$obj->userdetail($userloginid);

                        foreach($recordset as $row){
                            $name=$row[1];
                            $email=$row[2];
                            $type=$row[4];
                        }
                        
                    ?>
                    <p style=color:black><u>Person Name: </u> &nbsp&nbsp<?php echo "$name" ?></p>
                    <p style="color:black"><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?></p>
                    <p style="color:black"><u>Account Type:</u> &nbsp&nbsp<?php echo $type ?></p>
        
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ echo "display:none"; } else { echo "display:none"; } ?>">
                    <button class="greenbtn">Book Issued Report</button>
                    <?php

                        $userlogid=$_SESSION["userid"] = $_GET['userlogid'];
                        $obj=new data;
                        $obj->setconnection();
                        $obj->bookissued($userloginid);
                        $recordset=$obj->bookissued($userloginid);

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                        padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th><th>Return</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            "<td>$row[1]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td><a href='6user_service_dashboard.php?userlogid=$userloginid&returnid=$row[0]'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";
                        echo $table;
                    ?>
                </div>       
            </div>

            <div class="rightinnerdiv">
                <div id="return" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else { echo "display:none"; }?>">
                    <?php
                        //$returnid=$_GET['returnid'];
                        $obj= new data;
                        $obj->setconnection();
                        $obj->returnbook($returnid);
                        $recordset=$obj->returnbook($returnid);
                    ?>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="reqbook" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid']; echo "display:none";} else { echo "display:none";}?>">
                    <button class="greenbtn">Request Book</button>
                    <?php
                       //$userloginid=$_SESSION["userid"] = $_GET['userlogid'];
                       $obj= new data();
                       $obj->setconnection();
                       $obj->getbookissue();
                       $recordset=$obj->getbookissue(); 

                       $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
                        <th>Image</th><th>Book Name</th><th>Book Authour</th><th>branch</th><th>price</th></th><th>Request Book</th></tr>";

                       foreach($recordset as $row){
                        $table.="<tr>";
                        "<td>$row[0]</td>";
                        $table.="<td><img src='uploads/$row[1]' width='100px' height='100px'></td>";
                        $table.="<td>$row[2]</td>";
                        $table.="<td>$row[4]</td>";
                        $table.="<td>$row[7]</td>";
                        $table.="<td>$row[8]</td>";
                        $table.="<td><a href='13reqbook.php?userid=$userloginid&bookid=$row[0]'><button type='button' class='btn btn-primary'>REQUEST</button></a></td>";
                        $table.="</tr>";
                    }
                    $table.="</table>";
                    echo $table;          
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openpart(portion){
            var i;
            var x = document.getElementsByClassName("portion");
            for(i=0; i < x.length ; i++){
                x[i].style.display="none";
            }
            document.getElementById(portion).style.display="block";
        }
    </script>

</body>
</html>