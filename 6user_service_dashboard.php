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
      <link rel="stylesheet" href="!style.css">
    <!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
            <div class="row"><img class="imglogo" src="images/tm.png"/></div>

            <div class="leftinnerdiv">
                <button class="greenbtn">Welcome</button>
                <button class="greenbtn" onclick="openpart('myaccount')">My Account</button>
                <button class="greenbtn" onclick="openpart('assignedtask')">Assigned Task</button>
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
                        }

                    ?>
                    <p style=color:black><u>Person Name: </u> &nbsp&nbsp<?php echo "$name" ?></p>
                    <p style="color:black"><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?></p>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="assignedtask" class="innerright portion" style="display:none">
                    <button class="greenbtn">View Task</button>
                    <form action="11usertask.php" method="post" enctype="multipart/form-data">
                    <?php
                            $userloginid=$_GET['userlogid'];
                            $u= new data;
                            $u->setconnection();
                            $u->assignedtask($userloginid);
                            $rec=$u->assignedtask($userloginid);
                    ?>
                        <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='2%'></th>
                                <th class='table-header' width='20%'>TaskName</th>
                                <th class='table-header' width='35%'>Task Assigned</th>
                                <th class='table-header' width='5%'>Done?</th>
                                <th class='table-header' width='15%'>Note</th>
                                <th class='table-header' width='10%'>Submit?</th>
                                <th class='table-header' width='10%'>Status</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                        if(!empty($rec)) {
                            foreach($rec as $row) {
                        ?>
                        <form action="11usertask.php" method="post" enctype="multipart/form-data">
                        <tr class='table-row'>
                            <?php $tid=$row['tid']; $stid=$row['stid'];
                                if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                }
                                else{
                                    $t1=$row['t1'];
                                }
                            ?>

                            <td>
                                <div id="ifYes" style="display: none;">
                                <select name="stid">
                            <?php echo "<option value='" . $row['stid'] . "'>" . $row['stid'] . "</option>"; ?>
                                </select>
                                <select name="uid">
                            <?php echo "<option value='" . $row['uid'] . "'>" . $row['uid'] . "</option>"; ?>
                                </select>
                                </div>
                            </td>

                            <td><?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                            </td>
                            <td>
                                <?php
                                    if($stid % 10==1){
                                        echo $t1;
                                    }
                                    elseif($stid % 10==2){
                                        echo $t2;
                                    }
                                    else{
                                        echo $t3;
                                    }
                                ?>
                            </td>
                            <td><!-- onchange="yesnoCheck(this);" -->
                                <select name="status">
                                    <option value="Select">Select</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Need Clarification">Need Clarification</option>
                                </select>
                            </td>

                            <td>
                            <!-- <div id="ifYes" style="display: none;"> -->
                                <textarea rows = "3" cols = "30" maxlength = "200" name = "note"></textarea>
                            <!-- </div> -->
                            </td>

                            <td><input class="btn primary" type="submit" value="Submit"></button></td>
                            <td><?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->status($stid);
                                    $rec1=$obj->status($stid);
                                    foreach($rec1 as $row){
                                        $done=$row['status'];
                                    }
                                    echo $done;
                                ?>
                            </td>
                        </tr>

                        </form>
                        <?php
                            }
                        }
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
        function yesnoCheck(that){
            if (that.value == "Need Clarification") {
                alert("check");
                document.getElementById("ifYes").style.display = "block";
            }else{
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>

</body>
</html>